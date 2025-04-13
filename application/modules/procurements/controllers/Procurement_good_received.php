<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement_good_received extends MX_Controller {

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


	public function good_received_list(){

		$this->permission->check_label('good_received_list')->read()->redirect();

		$data['good_received']  = $this->procurements_model->good_received_data();
		$data['title'] = display('good_received');
		$data['module'] = "procurements";
		$data['page']   = "good_received/good_received_list";

		echo Modules::run('template/layout', $data); 

	}

	public function good_received_form(){

		$this->permission->check_label('good_received_form')->create()->redirect();

		$data['title'] = display('good_received');

		$this->form_validation->set_rules('vendor_name',display('vendor_name'),'required|max_length[500]');
        $this->form_validation->set_rules('purchase_order_id',display('purchase_order_no'),'required');
        $this->form_validation->set_rules('received_by_name',display('name'),'required');
        $this->form_validation->set_rules('received_by_title',display('title'),'required');
        $this->form_validation->set_rules('created_date',display('date'),'required');

        $purchase_form_description = $this->input->post('description_material',TRUE);
        $purchase_form_unit = $this->input->post('unit_id',TRUE);
        $purchase_form_qty = $this->input->post('quantity',TRUE);
        $purchase_form_price = $this->input->post('price_per_unit',TRUE);
        $purchase_form_total = $this->input->post('total',TRUE);

        $this->load->library('myupload');
		$received_by_signature = $this->myupload->do_upload(
			'./application/modules/procurements/assets/images/', 
			'received_by_signature'

		);

		// if signature_and_stamp is uploaded then resize the signature_and_stamp
		if ($received_by_signature !== false && $received_by_signature != null) {
			$this->myupload->do_resize(
				$received_by_signature,
				300,
				120
			);
		}

		$data['product'] = (object)$postData = [
            'vendor_name' 			 => $this->input->post('vendor_name',TRUE),
            'vendor_id' 			 => $this->input->post('vendor_id',TRUE),
            'purchase_order_id'  	 => $this->input->post('purchase_order_id',TRUE),
            'received_by_name'   	 => $this->input->post('received_by_name',TRUE),
            'received_by_title'  	 => $this->input->post('received_by_title',TRUE),
            'unit_price_total'   	 => $this->input->post('unit_price_total',TRUE),
            'total'   		 		 => $this->input->post('sub_total',TRUE),
            'discount'   		 	 => $this->input->post('discount_amount',TRUE)?$this->input->post('discount_amount',TRUE):0,
            'grand_total'   		 => $this->input->post('grand_total_amount',TRUE),
            'payment_type'   		 => $this->input->post('parent_type',TRUE),
            'headnode'   		 	 => $this->input->post('headcode',TRUE),
            'created_date'   		 => $this->input->post('created_date',TRUE),
            'received_by_signature'  => $received_by_signature,

        ];

         #-------------------------------#
        if ($this->form_validation->run() === true) {

        	$this->permission->check_label('purchase_order_form')->create()->redirect();

        	if ($this->procurements_model->create_good_received($postData)) {

        		$good_rcv_id = $this->db->insert_id();

                	if($good_rcv_id){

                		//updaitng good_received_id in Purchase Order , which used in this Good received
				        $updateGoodRcv['purchase_order_id'] = $postData['purchase_order_id'];
				        $updateGoodRcv['good_received_id'] = $good_rcv_id;

				        if($this->procurements_model->purchase_update_from_good_received($updateGoodRcv)) {

	                		for ($i = 0, $n = count($purchase_form_description); $i < $n; $i++) {

					            $purch_form_desc 	 = $purchase_form_description[$i];
					            $purch_form_unit 	 = $purchase_form_unit[$i];
					            $purch_form_qty 	 = $purchase_form_qty[$i];
					            $purch_form_price 	 = $purchase_form_price[$i];
					            $purch_form_total 	 = $purchase_form_total[$i];

					            $good_rcv_itm = array(
					                'form_id'     			=> $good_rcv_id,
					                'description_material'  => $purch_form_desc,
					                'unit'  				=> $purch_form_unit,
					                'quantity'  			=> $purch_form_qty,
					                'price_per_unit' 		=> $purch_form_price,
					                'total' 				=> $purch_form_total,
					                'item_type' 			=> "good_received",
					            );

								$this->db->insert('procurement_items', $good_rcv_itm);
				      	    }

							// Create Debit voucher for selected payment type of this good received
							$predefine_account = $this->db->select('*')->from('acc_predefine_account')->get()->row();
							$Narration = "Good Received";
							$Comment = $this->input->post('month_year');
							$COAID = $predefine_account->purchaseCode;
							$amnt_type = 'Debit';

							if($postData['grand_total']){

								$good_rcv_amount = $postData['grand_total'];

								$reVID = $parent_type = $this->input->post('parent_type',TRUE);
								// Insert good received data in ac_voucher table
								$insrt_good_rcved_dv = $this->insert_good_received_voucher($COAID,$amnt_type,$good_rcv_amount,$Narration,$Comment,$reVID);

								//Update Good received table with the voucher_id
								if($insrt_good_rcved_dv){
									$upData = [
							            'voucher_id'       => $insrt_good_rcved_dv,
							            'good_received_id' => $good_rcv_id,
							        ];
        							$this->procurements_model->update_good_received($upData);
								}
							}
							// End of creation acc_transaction for vendor of this good received
				      	}
                	}
                	#set success message
                   $this->session->set_flashdata('message', display('save_successfully'));

        	}else{
        		$this->session->set_flashdata('exception', display('please_try_again'));
        	}
        	redirect("procurements/procurement_good_received/good_received_list");

        }else{

        	$data['units'] = $this->procurements_model->unit_list();
        	$data['purchase_orders'] = $this->procurements_model->good_received_purchase_order_list();
        	$data['paytype']    = $this->accounts_model->paytype();

        	$data['module'] = "procurements";
			$data['page']   = "good_received/good_received_form";

			echo Modules::run('template/layout', $data);
        }

	}

	// insert_good_received_debitvoucher
    public function insert_good_received_voucher($dbtid = null,$amnt_type = null,$amnt = null,$Narration = null,$Comment = null,$reVID = null){  

        $maxid = $this->accounts_model->getMaxFieldNumber('id','acc_vaucher','Vtype','DV','VNo');             
        $vaucherNo = "DV-". ($maxid +1);
        $fyear = $this->session->userdata('fyear');          
        $VDate = date('Y-m-d');
        $CreateBy=$this->session->userdata('id');
        $createdate=date('Y-m-d H:i:s');              
       
        $debitinsert = array(     
                  'fyear'          =>  $fyear,
                  'VNo'            =>  $vaucherNo,
                  'Vtype'          =>  'DV',
                  'VDate'          =>  $VDate,
                  'COAID'          =>  $dbtid,     
                  'Narration'      =>  $Narration,     
                  'ledgerComment'  =>  $Comment,   
                  'RevCodde'       =>  $reVID,    
                  'isApproved'     =>  0,                      
                  'CreateBy'       => $CreateBy,
                  'CreateDate'     => $createdate,      
                  'status'         => 0,      
        	);

        if($amnt_type == 'Debit'){
        	
        	$debitinsert['Debit']  = $amnt;
        	$debitinsert['Credit'] =  0.00;    
        }else{

        	$debitinsert['Debit']  = 0.00;
        	$debitinsert['Credit'] =  $amnt; 
        }
    	
    	// return $debitinsert;

      	if($this->db->insert('acc_vaucher',$debitinsert)){

      		return $this->db->insert_id();
      	}

	    return false;
	}


	public function good_received_view($id = null){

		$this->permission->check_label('good_received_form')->read()->redirect();

		$data['title'] = display('good_received');

        $this->form_validation->set_rules('vendor_name',display('vendor_name'),'required|max_length[500]');
        $this->form_validation->set_rules('received_by_name',display('name'),'required');
        $this->form_validation->set_rules('received_by_title',display('title'),'required');
        $this->form_validation->set_rules('created_date',display('date'),'required');

        $purchase_form_description = $this->input->post('description_material',TRUE);
        $purchase_form_unit = $this->input->post('unit_id',TRUE);
        $purchase_form_qty = $this->input->post('quantity',TRUE);
        $purchase_form_price = $this->input->post('price_per_unit',TRUE);
        $purchase_form_total = $this->input->post('total',TRUE);

        //Upload image
        $this->load->library('myupload');
		$received_by_signature = $this->myupload->do_upload(
			'./application/modules/procurements/assets/images/', 
			'received_by_signature'

		);

		// if signature_and_stamp is uploaded then resize the signature_and_stamp
		if ($received_by_signature !== false && $received_by_signature != null) {
			$this->myupload->do_resize(
				$received_by_signature,
				300,
				120
			);
		}

         #-------------------------------#

		$good_received_id = $this->input->post('good_received_id',TRUE);

        $data['product'] = (object)$postData = [
        	'good_received_id'   	=> (!empty($good_received_id)?$good_received_id:null),
            'received_by_name'   	 => $this->input->post('received_by_name',TRUE),
            'received_by_title'  	 => $this->input->post('received_by_title',TRUE),
            'unit_price_total'   	 => $this->input->post('unit_price_total',TRUE),
            'total'   		 		 => $this->input->post('sub_total',TRUE),
            'discount'   		 	 => $this->input->post('discount_amount',TRUE)?$this->input->post('discount_amount',TRUE):0,
            'grand_total'   		 => $this->input->post('grand_total_amount',TRUE),
            'created_date'   		 => $this->input->post('created_date',TRUE),
            'received_by_signature'  => (!empty($received_by_signature) ? $received_by_signature : $this->input->post('old_received_by_signature',TRUE))

        ];

        if ($this->form_validation->run() === true) {

        	if ($id){

        		$this->permission->check_label('good_received_form')->update()->redirect();

				if ($this->procurements_model->update_good_received($postData)) {

					$this->db->where('form_id', $id)
					 ->where('item_type', "good_received")
				     ->delete("procurement_items");

					for ($i = 0, $n = count($purchase_form_description); $i < $n; $i++) {

			            $purch_form_desc 	 = $purchase_form_description[$i];
			            $purch_form_unit 	 = $purchase_form_unit[$i];
			            $purch_form_qty 	 = $purchase_form_qty[$i];
			            $purch_form_price 	 = $purchase_form_price[$i];
			            $purch_form_total 	 = $purchase_form_total[$i];

			            $good_received_itm = array(
			                'form_id'     			=> $id,
			                'description_material'  => $purch_form_desc,
			                'unit'  				=> $purch_form_unit,
			                'quantity'  			=> $purch_form_qty,
			                'price_per_unit' 		=> $purch_form_price,
			                'total' 				=> $purch_form_total,
			                'item_type' 			=> "good_received",
			            );

						$this->db->insert('procurement_items', $good_received_itm);
				    }

				$this->session->set_flashdata('message', display('update_successfully'));
				} else {
				$this->session->set_flashdata('exception', display('please_try_again'));
				} 
				redirect("procurements/procurement_good_received/good_received_list");

        	}

        }else{

        	if(!empty($id)){

	            $data['title']    = display('good_received');
	            $data['good_received']  = $this->procurements_model->single_good_received_data($id);

	            $HeadName = $this->db->select('*')->from('acc_coa')->where('HeadCode',$data['good_received']->headnode)->get()->row()->HeadName;
	            $data['headcode'] = $HeadName;

	            $data['good_received_items'] = $this->procurements_model->good_received_item_list($id);

	            // PDF Generator for Quotation Form_
			    $data['setting'] = $this->accounts_model->setting();
			    $data['invoice_no']       =  'INV-'.sprintf('%05s', $id);

			    $this->load->library('pdfgenerator');
			    $dompdf = new DOMPDF();
			    $page = $this->load->view('procurements/good_received/good_received_form_pdf',$data,true);
			    $dompdf->load_html($page);
			    $dompdf->render();
			    $output = $dompdf->output();
			    file_put_contents('assets/data/pdf/Good Receive Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf', $output);
			    $data['pdf']    = 'assets/data/pdf/Good Receive Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf';
			    //PDF Generator Ends

            }

            $data['units'] = $this->procurements_model->unit_list();
            $data['purchase_orders'] = $this->procurements_model->purchase_order_list();
            $data['id']       =  $id;
			$data['module'] = "procurements";
			$data['page']   = "good_received/update_good_received";

			echo Modules::run('template/layout', $data); 

        }

		 

	}

	public function delete_good_received($id = null) {

		$this->permission->check_label('good_received_form')->delete()->redirect();

		$good_received  = $this->procurements_model->single_good_received_data($id);

		// Check the voucher related is approved or not
		$voucher_approved  = $this->procurements_model->acc_voucher_is_approved($good_received->voucher_id);
		if($voucher_approved){

			$this->session->set_flashdata('exception', display('can_not_delete_as_voucher_already_approved'));
			redirect("procurements/procurement_good_received/good_received_list");
		}

		if ($this->procurements_model->delete_good_received($id)) {

			// Delete all transactions from acc_transaction and make purchase order re usable.. for this good receved
			$purchase_order_data = $this->procurements_model->single_purchase_order_data($good_received->purchase_order_id);

			$purchaseOrderData = [
	        	'good_received_id'   	=> null,
	            'purchase_order_id'   	=> $good_received->purchase_order_id
	        ];
	        if ($this->procurements_model->update_purchase_order($purchaseOrderData)) {

	        	$this->db->where('StoreID', $id)
	            ->where('Vtype', "Vendor Expense")
	            ->delete("acc_transaction");
	            
	        }

	        // Also delete the voucher.. related with this Good received
	        $this->procurements_model->acc_voucher_is_deleted($good_received->voucher_id);

			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {

			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect("procurements/procurement_good_received/good_received_list");
    }

    public function get_purchase_info() {

    	$purchase_order_id = $this->input->post('purchase_order_id',true);

    	$purchase_order_data = $this->procurements_model->single_purchase_order_data($purchase_order_id);
    	$quote_data = $this->procurements_model->single_quotaion_data($purchase_order_data->quotation_id);

    	echo json_encode($quote_data);

    }


	public function get_purchase_items() {

	$purchase_order_id = $this->input->post('purchase_order_id',true);

	$purchase_order_data = $this->procurements_model->single_purchase_order_data($purchase_order_id);

	if($purchase_order_data){

			$purchase_items = $this->procurements_model->purchase_item_list($purchase_order_id);
			$units = $this->procurements_model->unit_list();

			$total_purchaseitems = count($purchase_items);
		    $sl = 0;
		    $unit_price_total = 0;

		    $html ='';
			$trow ='';
			$tbody ='';
			$total_good_rcv_items ='';

			$html.='';
			$trow.='';
			$tbody.='';
			$total_good_rcv_items.='';

			$total_good_rcv_items.= '<input type="hidden" id="total_good_rcv_items" value="'.$total_purchaseitems.'"/>';

			$html.='<thead>
	    			<tr>
	                    <th class="text-center">'.display('description').'<i class="text-danger">*</i></th>
	                    <th class="text-center">'.display('unit').'<i class="text-danger">*</i></th>
	                    <th class="text-center">'.display('quantity').'<i class="text-danger">*</i></th>
	                    <th class="text-center">'.display('price_per_unit').'<i class="text-danger">*</i></th>
	                    <th class="text-center">'.display('total').'<i class="text-danger">*</i></th>

	                    <th class="text-center">'.display('action').'<i class="text-danger"></i></th>
	                </tr>
	            </thead>';

			foreach ($purchase_items as $purchase_item) {

				$unit_opts = '';
				$sl = $sl + 1;

				$unit_price_total = $unit_price_total + $purchase_item['price_per_unit'];

				if(!empty($units)){
					foreach ($units as $unit) {

						$selected = '';

						if($purchase_item['unit']==$unit['id']){
							$selected = 'selected';
						}

						$unit_opts.= '<option value="'.$unit['id'].'" '.$selected.'>'.$unit['unit'].'</option>';

					}
				}

				$tr = '<td width="25%"><textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="'.display('description').'" tabindex="10" required>'.$purchase_item['description_material'].'</textarea></td>

					<td width="20%"><select name="unit_id[]" class="form-control" required=""><option value=""> Select Unit</option>'.$unit_opts.'</select> </td>

					<td width="17%" class=""><input type="number" onkeyup="calculate_good_receive('.$sl.');" onchange="calculate_good_receive('.$sl.');" id="quantity_'.$sl.'" class="form-control text-right" value="'.(int)$purchase_item['quantity'].'" name="quantity[]" placeholder="0.00"  required  min="0"/></td>

					<td width="17%" width="17%" class="">
		               <input type="number" tabindex="3" onkeyup="calculate_good_receive('.$sl.');" onchange="calculate_good_receive('.$sl.');" id="price_per_unit_'.$sl.'" class="form-control text-right sub_total_item_price" name="price_per_unit[]" placeholder="0.00" value="'.(int)$purchase_item['price_per_unit'].'"  required/>

		            </td>

		            <td width="15%" class="">
		                <input type="text" tabindex="3" class="form-control text-right total_item_price" readonly="" name="total[]" placeholder="0.00" value="'.(int)$purchase_item['total'].'"  id="total_price_'.$sl.'"  required/>
		            </td>

					<td width="100"><a class="btn btn-danger btn-sm"  value="" onclick="deleteGoodRecvItemRow(this)" ><i class="fa fa-close" aria-hidden="true"></i></a></td>';

			    $trow.='<tr>'.$tr.'</tr>';

			 }

		 	$tbody.='<tbody id="good_received_item">'
		 			 .$total_good_rcv_items
					 .$trow.
				  '</tbody>';

		 	$html.= $tbody;

		 	$html.='<tfoot>
	                    <tr>
	                        
	                        <td class="text-right" colspan="4"><b>'.display('total').':</b></td>

	                        <td class="text-right">

	                            <input type="number" id="Total" class="text-right form-control" name="sub_total" placeholder="0.00" value="'.$purchase_order_data->total.'" readonly="readonly"/>

	                        </td>


	                        <td>
	                        	<a id="good_received_item" class="btn btn-info btn-sm" name="good-received-item"" onclick="addGoodRecvItem('."'good_received_item'".')" tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a>

	                            <input type="hidden" name="baseUrl" class="baseUrl" value="'.base_url().'"/>
	                            <input type="hidden" id="vendor_company_name" value="'.$purchase_order_data->vendor_name.'"/>
	                        </td>
	                    </tr>

	                    <tr>
                                            
                                <td class="text-right" colspan="4"><b>'.display('discount').':</b></td>
                                <td class="text-right">

                                    <input type="number" id="Discount" class="text-right form-control discount" name="discount_amount" placeholder="0.00" onkeyup="calculate_good_receive()" value="'.$purchase_order_data->discount.'" readonly="readonly" />

                                </td>
                                <td>


                                </td>
                            </tr>

                            <tr>
                                
                                <td class="text-right" colspan="4"><b>Grand '.display('total').':</b></td>
                                <td class="text-right">

                                    <input type="number" id="grandTotal" class="text-right form-control" name="grand_total_amount" placeholder="0.00" value="'.$purchase_order_data->grand_total.'" readonly="readonly" />

                                </td>
                                <td>


                                </td>
                            </tr>

	            </tfoot>';


			echo $html;

		}
	}


  public function retrieve_paytypedata()
  { 
    $paytype  = $this->input->post('paytype',true);
    $typeinfo = $this->procurements_model->get_paymenthead($paytype);
    echo json_encode($typeinfo);
  }


}