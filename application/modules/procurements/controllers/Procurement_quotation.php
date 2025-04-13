<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement_quotation extends MX_Controller {

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

	public function quotation_list(){

		$this->permission->check_label('quotation')->read()->redirect();

		$data['quotations']  = $this->procurements_model->quotation_data();
		$data['title'] = display('quotation');
		$data['module'] = "procurements";
		$data['page']   = "quotation_list"; 

		echo Modules::run('template/layout', $data); 

	}

	// Quote is converting from request where $id is the request id which also saving as request_form_id in procurement_quotation table..
	
	public function quotation_form($id = null){

		$this->permission->check_label('quotation')->read()->redirect();

		$data['title'] = display('quotation_form');

        $this->form_validation->set_rules('vendor_id',display('name_of_company'),'required');
        $this->form_validation->set_rules('address',display('address'),'required|max_length[500]');
        $this->form_validation->set_rules('pin_or_equivalent',display('pin_or_equivalent'),'required|is_unique[procurement_quotation.pin_or_equivalent]|max_length[50]');
        $this->form_validation->set_rules('expected_date_delivery',display('expected_date_delivery'),'required');
        $this->form_validation->set_rules('place_of_delivery',display('place_of_delivery'),'required|max_length[200]');
        $this->form_validation->set_rules('create_date',display('date'),'required');

        $quotation_form_desc = $this->input->post('description_material',TRUE);
        $quotation_form_unit = $this->input->post('unit_id',TRUE);
        $quotation_form_qty = $this->input->post('quantity',TRUE);
        $quotation_form_price = $this->input->post('price_per_unit',TRUE);
        $quotation_form_total = $this->input->post('total',TRUE);

        $this->load->library('myupload');
		$signature_and_stamp = $this->myupload->do_upload(
			'./application/modules/procurements/assets/images/', 
			'signature_and_stamp'

		);

		// if signature_and_stamp is uploaded then resize the signature_and_stamp
		if ($signature_and_stamp !== false && $signature_and_stamp != null) {
			$this->myupload->do_resize(
				$signature_and_stamp, 
				300,
				120
			);
		}

         #-------------------------------#
		$quotation_form_id = $this->input->post('quotation_form_id');

        $data['product'] = (object)$postData = [
        	'quotation_form_id'   	=> (!empty($quotation_form_id)?$quotation_form_id:null),
        	'request_form_id'   	=> $id,
            'vendor_id' 		=> $this->input->post('vendor_id',TRUE),
            'address'  				=> $this->input->post('address',TRUE),
            'pin_or_equivalent'   	=> $this->input->post('pin_or_equivalent',TRUE),
            'expected_date_delivery'=> $this->input->post('expected_date_delivery',TRUE),
            'place_of_delivery'    	=> $this->input->post('place_of_delivery',TRUE),
            'total'   				=> $this->input->post('total_amount',TRUE),
            'create_date'    		=> $this->input->post('create_date',TRUE),
            'signature_and_stamp'   => $signature_and_stamp,

        ];

         #-------------------------------#
        if ($this->form_validation->run() === true) {

        	#if empty $id then insert data
            if (empty($quotation_form_id)) {

				$this->permission->check_label('quotation')->create()->redirect();

                if ($this->procurements_model->create_quote($postData)) {

                	$quote_id = $this->db->insert_id();

                	if($quote_id){

                		for ($i = 0, $n = count($quotation_form_desc); $i < $n; $i++) {

				            $quote_form_desc 	= $quotation_form_desc[$i];
				            $quote_form_unit 	= $quotation_form_unit[$i];
				            $quote_form_qty 	= $quotation_form_qty[$i];
				            $quote_form_price 	= $quotation_form_price[$i];
				            $quote_form_total 	= $quotation_form_total[$i];

				            $quote_itm = array(
				                'form_id'     			=> $quote_id,
				                'description_material'  => $quote_form_desc,
				                'unit'  				=> $quote_form_unit,
				                'quantity' 				=> $quote_form_qty,
				                'price_per_unit' 		=> $quote_form_price,
				                'total' 				=> $quote_form_total,
				                'item_type' 			=> "quote",
				            );

							$this->db->insert('procurement_items', $quote_itm);
				        }

				        // Updating the request as quoted
				        $this->procurements_model->request_is_quoted($id);

                	}

                    
                    #set success message
                   $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                 $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect("procurements/procurement_quotation/quotation_list");

            }

        }else{

        	if(!empty($id)){
	            $data['title']    = display('quotation_form');
	            $data['request']  = $this->procurements_model->single_request_data($id);
	            $data['request_items'] = $this->procurements_model->request_item_list($id);

            }

            $data['units'] = $this->procurements_model->unit_list();
            $data['vendor_lists'] = $this->procurements_model->vendor_list();
            $data['id']       =  $id;
			$data['module'] = "procurements";
			$data['page']   = "quotation_form";

			echo Modules::run('template/layout', $data); 

        }

	}

	//Update Quotation data
	public function quotation_update($id = null) {

		$this->permission->check_label('quotation')->update()->redirect();

		$data['title'] = display('update_quotation');

        $this->form_validation->set_rules('name_of_company',display('name_of_company'),'required|max_length[200]');
        $this->form_validation->set_rules('address',display('address'),'required|max_length[500]');
        $this->form_validation->set_rules('pin_or_equivalent',display('pin_or_equivalent'),'required');
        $this->form_validation->set_rules('expected_date_delivery',display('expected_date_delivery'),'required');
        $this->form_validation->set_rules('place_of_delivery',display('place_of_delivery'),'required|max_length[200]');
        $this->form_validation->set_rules('create_date',display('date'),'required');

        $quotation_form_desc = $this->input->post('description_material',TRUE);
        $quotation_form_unit = $this->input->post('unit_id',TRUE);
        $quotation_form_qty = $this->input->post('quantity',TRUE);
        $quotation_form_price = $this->input->post('price_per_unit',TRUE);
        $quotation_form_total = $this->input->post('total',TRUE);

        //Upload image
        $this->load->library('myupload');
		$signature_and_stamp = $this->myupload->do_upload(
			'./application/modules/procurements/assets/images/', 
			'signature_and_stamp'

		);
		// if signature_and_stamp is uploaded then resize the signature_and_stamp
		if ($signature_and_stamp !== false && $signature_and_stamp != null) {
			$this->myupload->do_resize(
				$signature_and_stamp, 
				300,
				120
			);
		}

         #-------------------------------#

		$quotation_form_id = $this->input->post('quotation_form_id',TRUE);

        $data['product'] = (object)$postData = [
        	'quotation_form_id'   	=> (!empty($quotation_form_id)?$quotation_form_id:null),
            'name_of_company' 		=> $this->input->post('name_of_company',TRUE),
            'address'  				=> $this->input->post('address',TRUE),
            'pin_or_equivalent'   	=> $this->input->post('pin_or_equivalent',TRUE),
            'expected_date_delivery'=> $this->input->post('expected_date_delivery',TRUE),
            'place_of_delivery'    	=> $this->input->post('place_of_delivery',TRUE),
            'total'   				=> $this->input->post('total_amount',TRUE),
            'create_date'    		=> $this->input->post('create_date',TRUE),
            'signature_and_stamp'   => (!empty($signature_and_stamp) ? $signature_and_stamp : $this->input->post('old_signature_and_stamp'))

        ];

        if ($this->form_validation->run() === true) {

	    	// Checking if the quotation record already used for any Bid, then not allow to update the quote till delete the Bid
			$quotation_data  = $this->procurements_model->single_quotaion_data($id);

			if($quotation_data->bid_analysis_id){

				$bid_analysis_num = 'BID-'.sprintf('%05s', $quotation_data->bid_analysis_id);

				$this->session->set_flashdata('exception', "This Quote already used for ".$bid_analysis_num);

				redirect("procurements/procurement_quotation/quotation_update/".$id);
			}
			// Ends

        	if ($id){

        		$this->permission->check_label('quotation')->update()->redirect();

				if ($this->procurements_model->update_quote($postData)) {

					$this->db->where('form_id', $id)
					 ->where('item_type', "quote")
				     ->delete("procurement_items");

					for ($i = 0, $n = count($quotation_form_desc); $i < $n; $i++) {

						$quote_form_desc 	= $quotation_form_desc[$i];
			            $quote_form_unit 	= $quotation_form_unit[$i];
			            $quote_form_qty  	= $quotation_form_qty[$i];
			            $quote_form_price 	= $quotation_form_price[$i];
				        $quote_form_total 	= $quotation_form_total[$i];

			            $quote_itm = array(
			                'form_id'     			=> $id,
			                'description_material'  => $quote_form_desc,
			                'unit'  				=> $quote_form_unit,
			                'quantity' 				=> $quote_form_qty,
			                'price_per_unit' 		=> $quote_form_price,
				            'total' 				=> $quote_form_total,
			                'item_type' 			=> "quote",
			            );

						$this->db->insert('procurement_items', $quote_itm);
					}
				$this->session->set_flashdata('message', display('update_successfully'));
				} else {
				$this->session->set_flashdata('exception', display('please_try_again'));
				} 
				redirect("procurements/procurement_quotation/quotation_list");

        	}

        }else{

        	if(!empty($id)){

	            $data['title']    = display('update_quotation');
	            $data['quotation']  = $this->procurements_model->single_quotaion_data($id);
	            $data['quotation_items'] = $this->procurements_model->quotaion_item_list($id);

	            //PDF Generator for Quotation Form
			    $data['setting'] = $this->accounts_model->setting();
			    $data['sl_no']       =  sprintf('%05s', $id);

			    $this->load->library('pdfgenerator');
			    $dompdf = new DOMPDF();
			    $page = $this->load->view('procurements/quotation_form_pdf',$data,true);
			    $dompdf->load_html($page);
			    $dompdf->render();
			    $output = $dompdf->output();
			    file_put_contents('assets/data/pdf/Quotation Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf', $output);
			    $data['pdf']    = 'assets/data/pdf/Quotation Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf';
			    //PDF Generator Ends

            }

            $data['units'] = $this->procurements_model->unit_list();
            $data['id']       =  $id;
			$data['module'] = "procurements";
			$data['page']   = "update_quotation_form"; 

			echo Modules::run('template/layout', $data); 

        }


	}

	public function delete_quotation($id = null) {

		$this->permission->check_label('quotation')->delete()->redirect();

		$quotation_data  = $this->procurements_model->single_quotaion_data($id);
		$bid_analys_data  = $this->procurements_model->single_bid_analysis($quotation_data->bid_analysis_id);

		$request_form_id = $quotation_data->request_form_id;

		// Checking if quotation already related with any bid_analysis...
		if($bid_analys_data->quotation_form_id){

			$bid_analysis_num = 'BID-'.sprintf('%05s', $quotation_data->bid_analysis_id);

			$this->session->set_flashdata('exception', "This Quote is already used for ".$bid_analysis_num);

			redirect("procurements/procurement_quotation/quotation_list");
		}

		$requestFormData = [
        	'quoted'   			=> 0
        ];

		if ($this->procurements_model->delete_quotation($id)) {
			
			// After deleting making the Request conver to quote again...
			$this->procurements_model->update_request_from_quote($requestFormData,$request_form_id);

			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {

			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect("procurements/procurement_quotation/quotation_list");
    }


}
