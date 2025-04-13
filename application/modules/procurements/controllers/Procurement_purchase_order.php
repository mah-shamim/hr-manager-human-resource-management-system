<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement_purchase_order extends MX_Controller {

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


	public function purchase_order_list(){

		$this->permission->check_label('purchase_order_list')->read()->redirect();

		$data['purchase_orders']  = $this->procurements_model->purchase_order_data();
		$data['title'] = display('purchase_order');
		$data['module'] = "procurements";
		$data['page']   = "purchase_order/purchase_order_list"; 

		echo Modules::run('template/layout', $data); 

	}

	public function purchase_order_form(){

		$this->permission->check_label('purchase_order_form')->create()->redirect();

		$data['title'] = display('purchase_order');

		$this->form_validation->set_rules('vendor_name',display('vendor_name'),'required|max_length[500]');
        $this->form_validation->set_rules('location',display('location'),'required|max_length[200]');
        $this->form_validation->set_rules('quotation_id',display('quotation'),'required');
        $this->form_validation->set_rules('address',display('address'),'required|max_length[500]');
        $this->form_validation->set_rules('notes',display('notes'),'required|max_length[500]');
        $this->form_validation->set_rules('authorizer_name',display('name'),'required');
        $this->form_validation->set_rules('authorizer_title',display('title'),'required');
        $this->form_validation->set_rules('authorizer_date',display('date'),'required');

        $purchase_form_company = $this->input->post('company',TRUE);
        $purchase_form_description = $this->input->post('description_material',TRUE);
        $purchase_form_unit = $this->input->post('unit_id',TRUE);
        $purchase_form_qty = $this->input->post('quantity',TRUE);
        $purchase_form_price = $this->input->post('price_per_unit',TRUE);
        $purchase_form_total = $this->input->post('total',TRUE);

        $this->load->library('myupload');
		$authorizer_signature = $this->myupload->do_upload(
			'./application/modules/procurements/assets/images/', 
			'authorizer_signature'

		);

		// if signature_and_stamp is uploaded then resize the signature_and_stamp
		if ($authorizer_signature !== false && $authorizer_signature != null) {
			$this->myupload->do_resize(
				$authorizer_signature,
				300,
				120
			);
		}

		$data['product'] = (object)$postData = [
            'vendor_name' 			=> $this->input->post('vendor_name',TRUE),
            'location'  			=> $this->input->post('location',TRUE),
            'quotation_id'  		=> $this->input->post('quotation_id',TRUE),
            'address'   			=> $this->input->post('address',TRUE),
            'notes'   				=> $this->input->post('notes',TRUE),
            'authorizer_name'   	=> $this->input->post('authorizer_name',TRUE),
            'authorizer_title'  	=> $this->input->post('authorizer_title',TRUE),
            'total'   				=> $this->input->post('total_amount',TRUE),
            'discount'   			=> $this->input->post('discount_amount',TRUE)?$this->input->post('discount_amount',TRUE):0,
            'grand_total'   		=> $this->input->post('grand_total_amount',TRUE),
            'authorizer_date'   	=> $this->input->post('authorizer_date',TRUE),
            'authorizer_signature'  => $authorizer_signature,

        ];

         #-------------------------------#
        if ($this->form_validation->run() === true) {

        	$this->permission->check_label('purchase_order_form')->create()->redirect();

        	if ($this->procurements_model->create_purchase_order($postData)) {

        		$po_id = $this->db->insert_id();

                	if($po_id){

                		//updaitng bid_analysis_id in Quote , which used in this Bid
				        $updateQuote['quotation_id'] = $postData['quotation_id'];
				        $updateQuote['purchase_order_id'] = $po_id;

				        if ($this->procurements_model->quote_update_from_purchase($updateQuote)) {

	                		for ($i = 0, $n = count($purchase_form_description); $i < $n; $i++) {

	                			$purch_form_company  = $purchase_form_company[$i];
					            $purch_form_desc 	 = $purchase_form_description[$i];
					            $purch_form_unit 	 = $purchase_form_unit[$i];
					            $purch_form_qty 	 = $purchase_form_qty[$i];
					            $purch_form_price 	 = $purchase_form_price[$i];
					            $purch_form_total 	 = $purchase_form_total[$i];

					            $bid_itm = array(
					                'form_id'     			=> $po_id,
					                'company' 				=> $purch_form_company,
					                'description_material'  => $purch_form_desc,
					                'unit'  				=> $purch_form_unit,
					                'quantity'  			=> $purch_form_qty,
					                'price_per_unit' 		=> $purch_form_price,
					                'total' 				=> $purch_form_total,
					                'item_type' 			=> "purchase_order",
					            );

								$this->db->insert('procurement_items', $bid_itm);
					        }

				    	}

                	}

                	#set success message
                   $this->session->set_flashdata('message', display('save_successfully'));

        	}else{
        		$this->session->set_flashdata('exception', display('please_try_again'));
        	}
        	redirect("procurements/procurement_purchase_order/purchase_order_list");

        }else{

        	$data['units'] = $this->procurements_model->unit_list();
        	$data['bids'] = $this->procurements_model->bid_list();
        	$data['quotations'] = $this->procurements_model->purchase_quote_list();

        	$data['module'] = "procurements";
			$data['page']   = "purchase_order/purchase_order_form";

			echo Modules::run('template/layout', $data);
        }

		 

	}


	public function purchase_order_update($id = null){

		$this->permission->check_label('purchase_order_form')->update()->redirect();

		$data['title'] = display('update_purchase_order');

        $this->form_validation->set_rules('vendor_name',display('vendor_name'),'required|max_length[500]');
        $this->form_validation->set_rules('location',display('location'),'required|max_length[200]');
        $this->form_validation->set_rules('address',display('address'),'required|max_length[500]');
        $this->form_validation->set_rules('notes',display('notes'),'required|max_length[500]');
        $this->form_validation->set_rules('authorizer_name',display('name'),'required');
        $this->form_validation->set_rules('authorizer_title',display('title'),'required');
        $this->form_validation->set_rules('authorizer_date',display('date'),'required');

        $purchase_form_company = $this->input->post('company',TRUE);
        $purchase_form_description = $this->input->post('description_material',TRUE);
        $purchase_form_unit = $this->input->post('unit_id',TRUE);
        $purchase_form_qty = $this->input->post('quantity',TRUE);
        $purchase_form_price = $this->input->post('price_per_unit',TRUE);
        $purchase_form_total = $this->input->post('total',TRUE);

        //Upload image
        $this->load->library('myupload');
		$authorizer_signature = $this->myupload->do_upload(
			'./application/modules/procurements/assets/images/', 
			'authorizer_signature'

		);

		// if signature_and_stamp is uploaded then resize the signature_and_stamp
		if ($authorizer_signature !== false && $authorizer_signature != null) {
			$this->myupload->do_resize(
				$authorizer_signature,
				300,
				120
			);
		}

         #-------------------------------#

		$purchase_order_id = $this->input->post('purchase_order_id',TRUE);

        $data['product'] = (object)$postData = [
        	'purchase_order_id'   	=> (!empty($purchase_order_id)?$purchase_order_id:null),
            'vendor_name' 			=> $this->input->post('vendor_name',TRUE),
            'location'  			=> $this->input->post('location',TRUE),
            'address'   			=> $this->input->post('address',TRUE),
            'notes'   				=> $this->input->post('notes',TRUE),
            'authorizer_name'   	=> $this->input->post('authorizer_name',TRUE),
            'authorizer_title'  	=> $this->input->post('authorizer_title',TRUE),
            'total'   				=> $this->input->post('total_amount',TRUE),
            'discount'   			=> $this->input->post('discount_amount',TRUE)?$this->input->post('discount_amount',TRUE):0,
            'grand_total'   		=> $this->input->post('grand_total_amount',TRUE),
            'authorizer_date'   	=> $this->input->post('authorizer_date',TRUE),
            'authorizer_signature'  => (!empty($authorizer_signature) ? $authorizer_signature : $this->input->post('old_authorizer_signature',TRUE))

        ];

        if ($this->form_validation->run() === true) {

        	// Checking if the purchase_order record already used for any good_received, then not allow to update the purchase_order till delete the good_received
			$good_received_data  = $this->procurements_model->good_received_from_purchase_order($id);

			if($good_received_data->purchase_order_id){

				$good_received_num = 'GR-'.sprintf('%05s', $good_received_data->good_received_id);

				$this->session->set_flashdata('exception', "This Purchase Order already used for ".$good_received_num);

				redirect("procurements/procurement_purchase_order/purchase_order_update/".$id);
			}
			// Ends

        	if ($id){

        		$this->permission->check_label('purchase_order_form')->update()->redirect();

				if ($this->procurements_model->update_purchase_order($postData)) {

					$this->db->where('form_id', $id)
					 ->where('item_type', "purchase_order")
				     ->delete("procurement_items");

					for ($i = 0, $n = count($purchase_form_description); $i < $n; $i++) {

						$purch_form_company  = $purchase_form_company[$i];
			            $purch_form_desc 	 = $purchase_form_description[$i];
			            $purch_form_unit 	 = $purchase_form_unit[$i];
			            $purch_form_qty 	 = $purchase_form_qty[$i];
			            $purch_form_price 	 = $purchase_form_price[$i];
			            $purch_form_total 	 = $purchase_form_total[$i];

			            $purchase_itm = array(
			                'form_id'     			=> $id,
			                'company' 				=> $purch_form_company,
			                'description_material'  => $purch_form_desc,
			                'unit'  				=> $purch_form_unit,
			                'quantity'  			=> $purch_form_qty,
			                'price_per_unit' 		=> $purch_form_price,
			                'total' 				=> $purch_form_total,
			                'item_type' 			=> "purchase_order",
			            );

						$this->db->insert('procurement_items', $purchase_itm);
				    }

				$this->session->set_flashdata('message', display('update_successfully'));
				} else {
				$this->session->set_flashdata('exception', display('please_try_again'));
				} 
				redirect("procurements/procurement_purchase_order/purchase_order_list");

        	}

        }else{

        	if(!empty($id)){

	            $data['title']    = display('update_purchase_order');
	            $data['purchase_order']  = $this->procurements_model->single_purchase_order_data($id);
	            $data['purchase_order_items'] = $this->procurements_model->purchase_order_item_list($id);

	            //PDF Generator for Quotation Form
			    $data['setting'] = $this->accounts_model->setting();
			    $data['po_no']       =  'PO-'.sprintf('%05s', $id);

			    $this->load->library('pdfgenerator');
			    $dompdf = new DOMPDF();
			    $page = $this->load->view('procurements/purchase_order/purchase_form_pdf',$data,true);
			    $dompdf->load_html($page);
			    $dompdf->render();
			    $output = $dompdf->output();
			    file_put_contents('assets/data/pdf/Purchase Order Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf', $output);
			    $data['pdf']    = 'assets/data/pdf/Purchase Order Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf';
			    //PDF Generator Ends

            }

            $data['units'] = $this->procurements_model->unit_list();
            $data['bids'] = $this->procurements_model->bid_list();
            $data['quotations'] = $this->procurements_model->quote_list();
            $data['id']       =  $id;
			$data['module'] = "procurements";
			$data['page']   = "purchase_order/update_purchase_order";

			echo Modules::run('template/layout', $data); 

        }

		 

	}

	public function delete_purchase_order($id = null) {

		$this->permission->check_label('purchase_order_form')->delete()->redirect();

		$purchase_order  = $this->procurements_model->single_purchase_order_data($id);

		// Checking if purchase order already being used for any Good Received...
		if($purchase_order->good_received_id){

			$good_rcv_num = 'GR-'.sprintf('%05s', $purchase_order->good_received_id);

			$this->session->set_flashdata('exception', "This purchase order already used for ".$good_rcv_num);

			redirect("procurements/procurement_purchase_order/purchase_order_list");
		}

		$quotationData = [
        	'purchase_order_id'   	=> null,
            'quotation_form_id'   	=> $purchase_order->quotation_id
        ];

		if ($this->procurements_model->delete_purchase_order($id)) {

			// After deleting making the Quotation reusable for new purchase order...
			$this->procurements_model->update_quote($quotationData);

			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {

			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect("procurements/procurement_purchase_order/purchase_order_list");
    }


	public function get_quotation_info() {

    	$quote_id = $this->input->post('quote_id',true);

    	$quote_data = $this->procurements_model->single_quotaion_data($quote_id);

    	echo json_encode($quote_data);

    }


    public function get_quotation_items() {

    	$quote_id = $this->input->post('quote_id',true);

    	$quote_data = $this->procurements_model->single_quotaion_data($quote_id);

    	if($quote_data){

	    	$quotation_items = $this->procurements_model->quotaion_item_list($quote_id);
	    	$units = $this->procurements_model->unit_list();

	    	$total_qteitems = count($quotation_items);
            $sl = 0;

            $html ='';
	    	$trow ='';
	    	$tbody ='';
	    	$total_purchase_items ='';

	    	$html.='';
	    	$trow.='';
	    	$tbody.='';
	    	$total_purchase_items.='';

	    	$total_purchase_items.= '<input type="hidden" id="total_purchase_item" value="'.$total_qteitems.'"/>';

	    	$html.='<thead>
		    			<tr>
	                        <th class="text-center">'.display('company').'<i class="text-danger">*</i></th>
	                        <th class="text-center">'.display('description').'<i class="text-danger">*</i></th>
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

	    		$tr = '<td width="20%" class=""><input type="text" tabindex="3" class="form-control" value="'.$quote_data->name_of_company.'" name="company[]" placeholder="'.display('company').'" readonly/></td>

	                <td width="20%"><textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="'.display('description').'" tabindex="10" required>'.$quotation_item['description_material'].'</textarea></td>

	    			<td width="15%"><select name="unit_id[]" class="form-control" required=""><option value=""> Select Unit</option>'.$unit_opts.'</select> </td>

	    			<td width="12%" class=""><input type="number" onkeyup="calculate_purchase('.$sl.');" onchange="calculate_purchase('.$sl.');" id="quantity_'.$sl.'" class="form-control text-right" value="'.(int)$quotation_item['quantity'].'" name="quantity[]" placeholder="0.00"  required  min="0"/></td>

	    			<td width="12%" width="17%" class="">
	                   <input type="number" tabindex="3" onkeyup="calculate_purchase('.$sl.');" onchange="calculate_purchase('.$sl.');" id="price_per_unit_'.$sl.'" class="form-control text-right" name="price_per_unit[]" placeholder="0.00" value="'.(int)$quotation_item['price_per_unit'].'"  required/>

	                </td>

	                <td width="15%" class="">
	                    <input type="text" tabindex="3" class="form-control text-right total_item_price" readonly="" name="total[]" placeholder="0.00" value="'.(int)$quotation_item['total'].'"  id="total_price_'.$sl.'"  required/>
	                </td>

	    			<td width="100"><a class="btn btn-danger btn-sm"  value="" onclick="deletePurchaseOrderItemRow(this)" ><i class="fa fa-close" aria-hidden="true"></i></a></td>';

			    $trow.='<tr>'.$tr.'</tr>';

			 }

			 $tbody.='<tbody id="purchase_order_item">'
			 			 .$total_purchase_items
						 .$trow.
					  '</tbody>';

			 $html.= $tbody;

			 $html.='<tfoot>
                            <tr>
                                
                                <td class="text-right" colspan="5"><b>'.display('total').':</b></td>
                                <td class="text-right">

                                    <input type="number" id="Total" class="text-right form-control" name="total_amount" placeholder="0.00" value="'.$quote_data->total.'" readonly="readonly" />

                                </td>
                                <td>
                                	<a id="purchase_order_item" class="btn btn-info btn-sm" name="purchase-order-item" onclick="addPurchaseOrderItem('."'purchase_order_item'".')" tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a>

                                    <input type="hidden" name="baseUrl" class="baseUrl" value="'.base_url().'"/>
                                    <input type="hidden" id="vendor_company_name" value="'.$quote_data->name_of_company.'"/>
                                </td>
                            </tr>

                            <tr>
                                            
                                <td class="text-right" colspan="5"><b>'.display('discount').':</b></td>
                                <td class="text-right">

                                    <input type="number" id="Discount" class="text-right form-control discount" name="discount_amount" placeholder="0.00" onkeyup="calculate_purchase()" value=""/>

                                </td>
                                <td>


                                </td>
                            </tr>

                            <tr>
                                
                                <td class="text-right" colspan="5"><b>Grand '.display('total').':</b></td>
                                <td class="text-right">

                                    <input type="number" id="grandTotal" class="text-right form-control" name="grand_total_amount" placeholder="0.00" value="'.$quote_data->total.'" readonly="readonly" />

                                </td>
                                <td>


                                </td>
                            </tr>

                    </tfoot>';


			echo $html;

    	}
    }


}