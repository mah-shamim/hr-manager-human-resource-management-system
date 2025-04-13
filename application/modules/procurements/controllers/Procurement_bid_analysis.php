<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement_bid_analysis extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'procurements_model',
			'accounts/accounts_model',
			
		));	

		if (! $this->session->userdata('isLogIn'))
		redirect('login');
	}

	public function bid_analysis_list(){

		$this->permission->check_label('bid_analysis_list')->read()->redirect();

		$data['bid_analysis']  = $this->procurements_model->bid_analysis_data();
		$data['title'] = display('bid_analysis');
		$data['module'] = "procurements";
		$data['page']   = "bid_analysis_list"; 

		echo Modules::run('template/layout', $data); 

	}

	public function bid_analysis_form(){

		$this->permission->check_label('bid_analysis_form')->create()->redirect();

		$data['title'] = display('bid_analysis');

		$this->form_validation->set_rules('sba_no',display('sba_no'),'required|is_unique[procurement_bid_analysis.sba_no]|max_length[200]');
        $this->form_validation->set_rules('location',display('location'),'required|max_length[500]');
        $this->form_validation->set_rules('quotation_id',display('quotation'),'required');
        $this->form_validation->set_rules('create_date',display('date'),'required');

        // Bid Items
        $bid_form_company = $this->input->post('company',TRUE);
        $bid_form_description = $this->input->post('description_material',TRUE);
        $bid_form_unit = $this->input->post('unit_id',TRUE);
        $bid_form_qty = $this->input->post('quantity',TRUE);
        $bid_form_rof = $this->input->post('reason_of_choosing',TRUE);
        $bid_form_remarks = $this->input->post('remarks',TRUE);
        $bid_form_price = $this->input->post('price_per_unit',TRUE);
        $bid_form_total = $this->input->post('total',TRUE);

        // Bid committee list
        $bid_committee_ids = $this->input->post('committee_id',TRUE);
        $bid_sign_images = $this->input->post('sign_image',TRUE);
        $bid_committee_dates = $this->input->post('dates',TRUE);

        $this->load->library('myupload');
		$attachment = $this->myupload->do_upload(
			'./application/modules/procurements/assets/attachments/', 
			'attachment'

		);

		$data['product'] = (object)$postData = [
            'sba_no' 				=> $this->input->post('sba_no',TRUE),
            'location'  			=> $this->input->post('location',TRUE),
            'quotation_form_id'  	=> $this->input->post('quotation_id',TRUE),
            'create_date'   		=> $this->input->post('create_date',TRUE),
            'total'   				=> $this->input->post('total_amount',TRUE),
            'attachment'   			=> $attachment,

        ];

         #-------------------------------#
        if ($this->form_validation->run() === true) {

        	// Checking upload file type
			if($attachment == false && $attachment == null){

				$this->session->set_flashdata('exception', "Only pdf|docx|jpg|png|jpeg type file allowed for Bid");
				redirect("procurements/procurement_bid_analysis/bid_analysis_form");

			}
        	// End

        	$this->permission->check_label('bid_analysis_form')->create()->redirect();

        	if ($this->procurements_model->create_bid($postData)) {

        		$bid_id = $this->db->insert_id();

                	if($bid_id){

                		//updaitng bid_analysis_id in Quote , which used in this Bid
				        $updateQuote['quotation_id'] = $postData['quotation_form_id'];
				        $updateQuote['bid_analysis_id'] = $bid_id;

				        if ($this->procurements_model->quote_update_from_bid($updateQuote)) {

	                		// Inserting Bid items into procurement_items table

	                		for ($i = 0, $n = count($bid_form_company); $i < $n; $i++) {

					            $bid_analys_form_company = $bid_form_company[$i];
					            $bid_analys_form_desc 	 = $bid_form_description[$i];
					            $bid_analys_form_unit 	 = $bid_form_unit[$i];
					            $bid_analys_form_qty 	 = $bid_form_qty[$i];
					            $bid_analys_form_rof 	 = $bid_form_rof[$i];
					            $bid_analys_form_remarks = $bid_form_remarks[$i];
					            $bid_analys_form_price 	 = $bid_form_price[$i];
					            $bid_analys_form_total   = $bid_form_total[$i];

					            $bid_itm = array(
					                'form_id'     			=> $bid_id,
					                'company'  				=> $bid_analys_form_company,
					                'description_material'  => $bid_analys_form_desc,
					                'unit'  				=> $bid_analys_form_unit,
					                'quantity'  			=> $bid_analys_form_qty,
					                'reason_of_choosing' 	=> $bid_analys_form_rof,
					                'remarks' 				=> $bid_analys_form_remarks,
					                'price_per_unit' 		=> $bid_analys_form_price,
					                'total' 				=> $bid_analys_form_total,
					                'item_type' 			=> "bid",
					            );

								$this->db->insert('procurement_items', $bid_itm);
					        }

					        // End of Inserting Bid items into procurement_items table

					        // Inserting Bid committee lsit into procurement_committe list table

					        for ($i = 0, $n = count($bid_committee_ids); $i < $n; $i++) {

					        	$bid_committee_id 	= $bid_committee_ids[$i];
					            $bid_sign_image 	= $bid_sign_images[$i];
					            $bid_committee_date = $bid_committee_dates[$i];

					            $bid_committee = array(
					                'bid_id'     		=> $bid_id,
					                'bid_committee_id'  => $bid_committee_id,
					                'sign_image'  		=> $bid_sign_image,
					                'date'  			=> $bid_committee_date,
					                'type' 				=> "bid",
					            );

					            $this->db->insert('procurement_commitee_list', $bid_committee);
					        }

					        // End of Inserting Bid committee lsit into procurement_committe list table

				    	}

                	}

                	#set success message
                   $this->session->set_flashdata('message', display('save_successfully'));

        	}else{
        		$this->session->set_flashdata('exception', display('please_try_again'));
        	}
        	redirect("procurements/procurement_bid_analysis/bid_analysis_list");

        }else{

        	$data['units'] = $this->procurements_model->unit_list();
        	$data['quotations'] = $this->procurements_model->bid_quote_list();
        	$data['committee_lists']  = $this->procurements_model->all_committee_list();

        	$data['module'] = "procurements";
			$data['page']   = "bid_analysis_form";

			echo Modules::run('template/layout', $data);
        }

		 

	}

	public function bid_analys_update($id = null){

		$this->permission->check_label('bid_analysis_form')->update()->redirect();

		$data['title'] = display('bid_analysis');

		$this->form_validation->set_rules('sba_no',display('sba_no'),'required|max_length[200]');
        $this->form_validation->set_rules('location',display('location'),'required|max_length[500]');
        $this->form_validation->set_rules('quotation_id',display('quotation'));
        $this->form_validation->set_rules('create_date',display('date'),'required');

        // Bid Items
        $bid_form_company = $this->input->post('company',TRUE);
        $bid_form_description = $this->input->post('description_material',TRUE);
        $bid_form_unit = $this->input->post('unit_id',TRUE);
        $bid_form_qty = $this->input->post('quantity',TRUE);
        $bid_form_rof = $this->input->post('reason_of_choosing',TRUE);
        $bid_form_remarks = $this->input->post('remarks',TRUE);
        $bid_form_price = $this->input->post('price_per_unit',TRUE);
        $bid_form_total = $this->input->post('total',TRUE);

        // Bid committee list
        $bid_committee_ids = $this->input->post('committee_id',TRUE);
        $bid_sign_images = $this->input->post('sign_image',TRUE);
        $bid_committee_dates = $this->input->post('dates',TRUE);

        $this->load->library('myupload');
		$attachment = $this->myupload->do_upload(
			'./application/modules/procurements/assets/attachments/', 
			'attachment'

		);

		$data['product'] = (object)$postData = [
			'bid_analysis_form_id'  => $this->input->post('bid_analysis_form_id',TRUE),
            'sba_no' 				=> $this->input->post('sba_no',TRUE),
            'location'  			=> $this->input->post('location',TRUE),
            'create_date'   		=> $this->input->post('create_date',TRUE),
            'total'   				=> $this->input->post('total_amount',TRUE),
            'attachment'   			=> (!empty($attachment) ? $attachment : $this->input->post('old_attatchment')),

        ];

         #-------------------------------#
        if ($this->form_validation->run() === true) {

        	// Checking upload file type
        	if(!empty($_FILES['attachment']['name'])){
				if($attachment == false && $attachment == null){

					$this->session->set_flashdata('exception', "Only pdf|docx|jpg|png|jpeg type file allowed for Bid");
					redirect("procurements/procurement_bid_analysis/bid_analys_update/".$id);

				}
        	}
        	// End

        	if ($id){

				$this->permission->check_label('bid_analysis_form')->update()->redirect();

	        	if ($this->procurements_model->update_bid($postData)) {

	        			// Inserting Bid items into procurement_items table

	        			$this->db->where('form_id', $id)
						 ->where('item_type', "bid")
					     ->delete("procurement_items");

                		for ($i = 0, $n = count($bid_form_company); $i < $n; $i++) {

				            $bid_analys_form_company = $bid_form_company[$i];
				            $bid_analys_form_desc 	 = $bid_form_description[$i];
				            $bid_analys_form_unit 	 = $bid_form_unit[$i];
				            $bid_analys_form_qty 	 = $bid_form_qty[$i];
				            $bid_analys_form_rof 	 = $bid_form_rof[$i];
				            $bid_analys_form_remarks = $bid_form_remarks[$i];
				            $bid_analys_form_price 	 = $bid_form_price[$i];
				            $bid_analys_form_total   = $bid_form_total[$i];

				            $bid_itm = array(
				                'form_id'     			=> $id,
				                'company'  				=> $bid_analys_form_company,
				                'description_material'  => $bid_analys_form_desc,
				                'unit'  				=> $bid_analys_form_unit,
				                'quantity'  			=> $bid_analys_form_qty,
				                'reason_of_choosing' 	=> $bid_analys_form_rof,
				                'remarks' 				=> $bid_analys_form_remarks,
				                'price_per_unit' 		=> $bid_analys_form_price,
				                'total' 				=> $bid_analys_form_total,
				                'item_type' 			=> "bid",
				            );

							$this->db->insert('procurement_items', $bid_itm);
				        }

				        // End of Inserting Bid items into procurement_items table

				        // Inserting Bid committee lsit into procurement_committe list table

				        $this->db->where('bid_id', $id)
						 ->where('type',"bid")
					     ->delete("procurement_commitee_list");

				        for ($i = 0, $n = count($bid_committee_ids); $i < $n; $i++) {

				        	$bid_committee_id 	= $bid_committee_ids[$i];
				            $bid_sign_image 	= $bid_sign_images[$i];
				            $bid_committee_date = $bid_committee_dates[$i];

				            $bid_committee = array(
				                'bid_id'     		=> $id,
				                'bid_committee_id'  => $bid_committee_id,
				                'sign_image'  		=> $bid_sign_image,
				                'date'  			=> $bid_committee_date,
				                'type' 				=> "bid",
				            );

				            $this->db->insert('procurement_commitee_list', $bid_committee);
				        }

				        // End of Inserting Bid committee lsit into procurement_committe list table

	                	#set success message
	                   $this->session->set_flashdata('message', display('save_successfully'));

	        	}else{
	        		$this->session->set_flashdata('exception', display('please_try_again'));
	        	}
	        	redirect("procurements/procurement_bid_analysis/bid_analysis_list");
        	}


        }else{

        	$data['units'] = $this->procurements_model->unit_list();
        	$data['quotations'] = $this->procurements_model->quote_list();
        	$data['committee_lists']  = $this->procurements_model->all_committee_list();
        	$data['bid_committee_lists']  = $bid_pdf_committee_lists = $this->procurements_model->bid_committee_list($id);

        	// Generating committee list for pdf.. as name was missing for bid commitee list
        	$pdf_commitee_lists = array();
        	$sl = 0;
        	foreach ($bid_pdf_committee_lists as $key => $value) {
        		$respo_commitee = $this->procurements_model->findById_committee($value->bid_committee_id);
        		$pdf_commitee_lists[$sl]['name'] = $respo_commitee->name;
        		$pdf_commitee_lists[$sl]['date'] = $value->date;
        		$pdf_commitee_lists[$sl]['signature'] = $value->sign_image;
        		$sl++;
        	}
        	$data['pdf_commitee_lists']  = $pdf_commitee_lists;
        	//ends

        	$data['bid_analysis'] = $bid_analysis = $this->procurements_model->single_bid_analysis($id);
        	$data['quote_data'] = $this->procurements_model->single_quotaion_data($bid_analysis->quotation_form_id);
        	$data['bid_analysis_items'] = $this->procurements_model->bid_analysis_items($id);

        	//PDF Generator for Bid Analysys Form
		    $data['setting'] = $this->accounts_model->setting();
		    $data['sl_no']       =  sprintf('%05s', $id);

		    $this->load->library('pdfgenerator');
		    $dompdf = new DOMPDF();
		    $page = $this->load->view('procurements/bid_analysis_form_pdf',$data,true);
		    $dompdf->load_html($page);
		    $dompdf->render();
		    $output = $dompdf->output();
		    file_put_contents('assets/data/pdf/Bid Analysis Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf', $output);
		    $data['pdf']    = 'assets/data/pdf/Bid Analysis Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf';
		    //PDF Generator Ends

        	$data['id']       =  $id;
        	$data['module'] = "procurements";
			$data['page']   = "bid_analysis_update"; 

			echo Modules::run('template/layout', $data);
        }

		 

	}

	public function delete_bid_analys($id = null) {

		$this->permission->check_label('bid_analysis_form')->delete()->redirect();

		$bid_analys_data  = $this->procurements_model->single_bid_analysis($id);
		$quotation_data = $this->procurements_model->single_quotaion_data($bid_analys_data->quotation_form_id);

		// Checking if bid_analys already related with any purchase order...
		if($quotation_data->purchase_order_id){

			$purchase_order_num = 'PO-'.sprintf('%05s', $quotation_data->purchase_order_id);

			$this->session->set_flashdata('exception', "This Bid is related with ".$purchase_order_num.", please delete it first.");

			redirect("procurements/procurement_bid_analysis/bid_analysis_list");
		}

		$quotationData = [
        	'bid_analysis_id'   	=> null,
            'quotation_form_id'   	=> $bid_analys_data->quotation_form_id
        ];

		if ($this->procurements_model->delete_bid($id)) {

			// After deleting making the Quotation reusable for new bid_analysis...
			$this->procurements_model->update_quote($quotationData);

			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {

			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect("procurements/procurement_bid_analysis/bid_analysis_list");
    }

    public function get_quotation_items() {

    	$quote_id = $this->input->post('quote_id',true);

    	$quote_data = $this->procurements_model->single_quotaion_data($quote_id);

    	if($quote_data){

	    	$quotation_items = $this->procurements_model->quotaion_item_list($quote_id);
	    	$units = $this->procurements_model->unit_list();

	    	$total_qteitems = count($quotation_items);
            $sl = 0;

	    	$html.='';
	    	$trow.='';
	    	$tbody.='';
	    	$total_bid_items.='';

	    	$total_bid_items.= '<input type="hidden" id="total_bid_item" value="'. $total_qteitems.'"/>';

	    	$html.='<thead>
		    			<tr>
	                        <th class="text-center">'.display('company').'<i class="text-danger">*</i></th>
	                        <th class="text-center">'.display('description').'<i class="text-danger">*</i></th>
	                        <th class="text-center">'.display('reason_of_choosing').'<i class="text-danger">*</i></th>
	                        <th class="text-center">'.display('remarks').'<i class="text-danger">*</i></th>
	                        <th class="text-center">'.display('unit').'<i class="text-danger">*</i></th>
	                        <th class="text-center">'.display('quantity').'<i class="text-danger">*</i></th>
	                        <th class="text-center">'.display('price_per_unit').'<i class="text-danger">*</i></th>
	                        <th class="text-center">'.display('total').'<i class="text-danger">*</i></th>

	                        <th class="text-center">'.display('action').'<i class="text-danger"></i></th>
	                    </tr>
                    </thead>';

	    	foreach ($quotation_items as $quotation_item) {

	    		$unit_opts = '';
	    		$sl = $sl + 1;

	    		if(!empty($units)){
	    			foreach ($units as $unit) {

	    				$selected = '';

	    				if($quotation_item['unit']==$unit['id']){
	    					$selected = 'selected';
	    				}

	    				$unit_opts.= '<option value="'.$unit['id'].'" '.$selected.'>'.$unit['unit'].'</option>';

	    			}
	    		}

	    		$tr = '<td width="12%" class=""><input type="text" tabindex="3" class="form-control" value="'.$quote_data->name_of_company.'" name="company[]" placeholder="'.display('company').'" readonly/></td>

	                <td width="15%"><textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="'.display('description').'" tabindex="10" required>'.$quotation_item['description_material'].'</textarea></td>

	    			<td width="13%" class=""><input type="text" class="form-control" value="'.$quotation_item['reason_of_choosing'].'" name="reason_of_choosing[]" placeholder="'.display('reason_of_choosing').'" required/></td>

	    			<td width="13%" class=""><input type="text" class="form-control" value="'.$quotation_item['remarks'].'" name="remarks[]" placeholder="'.display('remarks').'" required/></td>

	    			<td width="10%"><select name="unit_id[]" class="form-control" required=""><option value=""> Select Unit</option>'.$unit_opts.'</select> </td>

	    			<td width="8%" class=""><input type="number" onkeyup="calculate_bid('.$sl.');" onchange="calculate_bid('.$sl.');" id="quantity_'.$sl.'" class="form-control" value="'.(int)$quotation_item['quantity'].'" text-right" name="quantity[]" placeholder="0.00"  required  min="0"/></td>

	    			<td width="10%" class="">
	                   <input type="number" tabindex="3" onkeyup="calculate_bid('.$sl.');" onchange="calculate_bid('.$sl.');" id="price_per_unit_'.$sl.'" class="form-control text-right" name="price_per_unit[]" placeholder="0.00" value="'.(int)$quotation_item['price_per_unit'].'"  required/>

	                </td>

	                <td width="12%" class="">
	                    <input type="text" tabindex="3" class="form-control text-right total_item_price" readonly="" name="total[]" placeholder="0.00" value="'.(int)$quotation_item['total'].'"  id="total_price_'.$sl.'"  required/>
	                </td>

	    			<td width="100"><a  id="add_bid_item" class="btn btn-info btn-sm" name="add-bid-item" onClick="addBidItem('."'bid_analysis_item'".')"><i class="fa fa-plus-square" aria-hidden="true"></i></a> <a class="btn btn-danger btn-sm"  value="" onclick="deleteBidItemRow(this)" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';

			    $trow.='<tr>'.$tr.'</tr>';

			 }

			 $tbody.='<tbody id="bid_analysis_item">'
			 			 .$total_bid_items
						 .$trow.
					  '</tbody>';

			 $html.= $tbody;

			 $html.='<tfoot>
                            <tr>
                                
                                <td class="text-right" colspan="7"><b>'.display('total').':</b></td>
                                <td class="text-right">

                                    <input type="number" id="Total" class="text-right form-control" name="total_amount" placeholder="0.00" value="'.$quote_data->total.'" readonly="readonly" />

                                </td>
                                <td>
                                    <input type="hidden" name="baseUrl" class="baseUrl" value="'.base_url().'"/>
                                    <input type="hidden" id="vendor_company_name" value="'.$quote_data->name_of_company.'"/>
                                </td>
                            </tr>
                    </tfoot>';


			echo $html;

    	}
    }

	public function get_commitee_details() {

	$commitee_id = $this->input->post('commitee_id',true);

	if($commitee_id){
		$committeeinfo = $this->procurements_model->findById_committee($commitee_id);

		echo json_encode($committeeinfo);
	}

	}

}
