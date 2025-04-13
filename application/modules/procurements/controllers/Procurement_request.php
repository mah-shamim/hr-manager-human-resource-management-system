<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement_request extends MX_Controller {

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

	public function request_list(){

		$this->permission->check_label('request_list')->read()->redirect();

		$data['requests']  = $this->procurements_model->request_data();
		$data['title'] = display('requests');
		$data['module'] = "procurements";
		$data['page']   = "request_list";

		echo Modules::run('template/layout', $data); 

	}

	public function request_form($id = null){

		$this->permission->check_label('request_form')->read()->redirect();

		$data['title'] = display('add_request');

        $this->form_validation->set_rules('requesting_person',display('requesting_person'),'required|max_length[20]');
        $this->form_validation->set_rules('requesting_dept',display('requesting_dept'),'required|max_length[20]');
        $this->form_validation->set_rules('expected_start_time',display('attendence_start'),'required');
        $this->form_validation->set_rules('expected_end_time',display('attendence_start'),'required');
        $this->form_validation->set_rules('requesting_reason',display('reason_for_requesting'),'required|max_length[500]');

        $request_item_desc = $this->input->post('description_material',TRUE);
        $request_item_unit = $this->input->post('unit_id',TRUE);
        $request_item_qty = $this->input->post('quantity',TRUE);

         #-------------------------------#
        $data['product'] = (object)$postData = [
        	'request_form_id'   => (!empty($this->input->post('request_form_id'))?$this->input->post('request_form_id'):null),
            'requesting_person' 	=> $this->input->post('requesting_person',TRUE),
            'requesting_dept'  		=> $this->input->post('requesting_dept',TRUE),
            'expected_start_time'   => $this->input->post('expected_start_time',TRUE),
            'expected_end_time'     => $this->input->post('expected_end_time',TRUE),
            'requesting_reason'    	=> $this->input->post('requesting_reason',TRUE),
        ];
        if(!empty($this->input->post('request_form_id'))){

        }

         #-------------------------------#
        if ($this->form_validation->run() === true) {

        	#if empty $id then insert data
            if (empty($id)) {

				$this->permission->check_label('request_form')->create()->redirect();

                if ($this->procurements_model->create_request($postData)) {

                	$request_id = $this->db->insert_id();

                    for ($i = 0, $n = count($request_item_desc); $i < $n; $i++) {

			            $req_itm_desc = $request_item_desc[$i];
			            $req_itm_unit = $request_item_unit[$i];
			            $req_itm_qty = $request_item_qty[$i];

			            $req_itm = array(
			                'form_id'     	=> $request_id,
			                'description_material'  => $req_itm_desc,
			                'unit'  				=> $req_itm_unit,
			                'quantity' 				=> $req_itm_qty,
			                'item_type' 				=> "request",
			            );

			            $this->db->insert('procurement_items', $req_itm);
			        }
                    #set success message
                   $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                 $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect("procurements/procurement_request/request_list");
            }else{

				$this->permission->check_label('request_form')->update()->redirect();

				// Checking if the request record already used for any quote, then not allow to update the request till delete the quotation
				$request_data  = $this->procurements_model->single_request_data($id);

				if($request_data->quoted){

					$quotation_data  = $this->procurements_model->get_quotaion_data_from_request($id);
					$quotation_num = 'QT-'.sprintf('%05s', $quotation_data->quotation_form_id);

					$this->session->set_flashdata('exception', "This request already used for ".$quotation_num);

					redirect("procurements/procurement_request/request_form/".$id);
				}
				// Ends

				if ($this->procurements_model->update_request($postData)) {

					$this->db->where('form_id', $id)
					 ->where('item_type', "request")
				     ->delete("procurement_items");

					for ($i = 0, $n = count($request_item_desc); $i < $n; $i++) {

						$req_itm_desc = $request_item_desc[$i];
						$req_itm_unit = $request_item_unit[$i];
			            $req_itm_qty = $request_item_qty[$i];

						$req_itm = array(
			                'form_id'     	=> $id,
			                'description_material'  => $req_itm_desc,
			                'unit'  				=> $req_itm_unit,
			                'quantity' 				=> $req_itm_qty,
			                'item_type' 				=> "request",
			            );

						$this->db->insert('procurement_items', $req_itm);
					}
				$this->session->set_flashdata('message', display('update_successfully'));
				} else {
				$this->session->set_flashdata('exception', display('please_try_again'));
				} 
				redirect("procurements/procurement_request/request_list");
            }

        }else{

        	if(!empty($id)){
	            $data['title']    = display('edit_request');
	            $data['request']  = $this->procurements_model->single_request_data($id);
	            $data['request_items'] = $this->procurements_model->request_item_list($id);

				//PDF Generator for Request Form
			    $data['setting'] = $this->accounts_model->setting();
			    $data['sl_no']       =  sprintf('%05s', $id);

			    $this->load->library('pdfgenerator');
			    $dompdf = new DOMPDF();
			    $page = $this->load->view('procurements/request_form_pdf',$data,true);
			    $dompdf->load_html($page);
			    $dompdf->render();
			    $output = $dompdf->output();
			    file_put_contents('assets/data/pdf/Request Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf', $output);
			    $data['pdf']    = 'assets/data/pdf/Request Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf';
			    //PDF Generator Ends

            }

            $data['id']       =  $id;
			$data['employee']= $this->procurements_model->empdropdown();
	        $data['department']= $this->procurements_model->departmentdrpdown();
	        $data['units'] = $this->procurements_model->unit_list();
			$data['module'] = "procurements";
			$data['page']   = "request_form"; 

			echo Modules::run('template/layout', $data); 

        }

	}

	public function request_approval($id = null){

		$this->permission->check_label('request_approval')->create()->redirect();

		$data['title'] = display('request_approval');

        $this->form_validation->set_rules('requesting_person',display('requesting_person'),'required|max_length[20]');
        $this->form_validation->set_rules('requesting_dept',display('requesting_dept'),'required|max_length[20]');
        $this->form_validation->set_rules('expected_start_time',display('attendence_start'),'required');
        $this->form_validation->set_rules('expected_end_time',display('attendence_start'),'required');
        $this->form_validation->set_rules('requesting_reason',display('reason_for_requesting'),'required|max_length[500]');
        $this->form_validation->set_rules('reason',display('reason_for_approval'),'required|max_length[500]');

        $request_item_desc = $this->input->post('description_material',TRUE);
        $request_item_unit = $this->input->post('unit_id',TRUE);
        $request_item_qty = $this->input->post('quantity',TRUE);

         #-------------------------------#
        $data['product'] = (object)$postData = [
        	'request_form_id'   	=> (!empty($this->input->post('request_form_id'))?$this->input->post('request_form_id'):null),
            'requesting_person' 	=> $this->input->post('requesting_person',TRUE),
            'requesting_dept'  		=> $this->input->post('requesting_dept',TRUE),
            'expected_start_time'   => $this->input->post('expected_start_time',TRUE),
            'expected_end_time'     => $this->input->post('expected_end_time',TRUE),
            'requesting_reason'    	=> $this->input->post('requesting_reason',TRUE),
            'reason'    			=> $this->input->post('reason',TRUE),
            'is_approve'    		=> 1,
        ];

         #-------------------------------#
        if ($this->form_validation->run() === true) {

        	#if empty $id then insert data
            if (!empty($id)){

				$this->permission->check_label('request_approval')->create()->redirect();

				if ($this->procurements_model->update_request($postData)) {

					$this->db->where('form_id', $id)
					 ->where('item_type', "request")
				     ->delete("procurement_items");

					for ($i = 0, $n = count($request_item_desc); $i < $n; $i++) {

						$req_itm_desc = $request_item_desc[$i];
						$req_itm_unit = $request_item_unit[$i];
			            $req_itm_qty = $request_item_qty[$i];

						$req_itm = array(
			                'form_id'     	=> $id,
			                'description_material'  => $req_itm_desc,
			                'unit'  				=> $req_itm_unit,
			                'quantity' 				=> $req_itm_qty,
			                'item_type' 				=> "request",
			            );

						$this->db->insert('procurement_items', $req_itm);
					}
				$this->session->set_flashdata('message', display('update_successfully'));
				} else {
				$this->session->set_flashdata('exception', display('please_try_again'));
				} 
				redirect("procurements/procurement_request/request_list");
            }

        }else{

        	if(!empty($id)){
	            $data['title']    = display('request_approval');
	            $data['request']  = $this->procurements_model->single_request_data($id);
	            $data['request_items'] = $this->procurements_model->request_item_list($id);

				//PDF Generator for Request Form
			    $data['setting'] = $this->accounts_model->setting();
			    $data['sl_no']       =  sprintf('%05s', $id);

			    $this->load->library('pdfgenerator');
			    $dompdf = new DOMPDF();
			    $page = $this->load->view('procurements/request_form_pdf',$data,true);
			    $dompdf->load_html($page);
			    $dompdf->render();
			    $output = $dompdf->output();
			    file_put_contents('assets/data/pdf/Request Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf', $output);
			    $data['pdf']    = 'assets/data/pdf/Request Form_'.sprintf('%05s', $id).' Pdf As On '.date("Y-m-d").'.pdf';
			    //PDF Generator Ends

            }

            $data['id']       		=  $id;
            $data['request_approve']=  1;
			$data['employee']		= $this->procurements_model->empdropdown();
	        $data['department']		= $this->procurements_model->departmentdrpdown();
	        $data['units'] = $this->procurements_model->unit_list();
			$data['module'] 		= "procurements";
			$data['page']   		= "request_form"; 

			echo Modules::run('template/layout', $data); 

        }

	}

	public function delete_request($id = null) {

		$this->permission->check_label('request_form')->delete()->redirect();

		$request_data  = $this->procurements_model->single_request_data($id);

		if($request_data->quoted){

			$this->session->set_flashdata('exception', "This request already Quoted");

			redirect("procurements/procurement_request/request_list");
		}

		if ($this->procurements_model->delete_request($id)) {

			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {

			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect("procurements/procurement_request/request_list");
    }


}
