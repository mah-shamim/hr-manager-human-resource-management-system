<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends MX_Controller {

public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'Tax_model'
		));
		if (! $this->session->userdata('isLogIn'))
			redirect('login');		 
	}

public function tax_setup_view(){   
		$this->permission->module('tax','read')->redirect();
		$data['title']    = display('tax_setup');  ;
		$data['taxs']     = $this->Tax_model->viewTaxsetup();
		$data['module']   = "tax";
		$data['page']     = "tax_setup_view";   
		echo Modules::run('template/layout', $data); 
	} 


	// Newly Tax setup

	public function tax_setup(){

        $this->form_validation->set_rules('level_name[]',display('no'),'required');
        $this->form_validation->set_rules('start_range[]',display('start_amount'),'required');
        $this->form_validation->set_rules('end_range[]',display('end_amount'),'required');
        $this->form_validation->set_rules('tax_percent[]',display('tax_percent'),'required');

		if ($this->form_validation->run() === true) {

			$levels      = $this->input->post('level_name',true);
			$start_range = $this->input->post('start_range',true);
			$end_range   = $this->input->post('end_range',true);
            $tax_percent = $this->input->post('tax_percent',true);
            $add_amount  = $this->input->post('add_smount',true);

			for ($i=0; $i < count($levels); $i++) {

				$start_range_val = intval($start_range[$i]);
				$end_range_val   = intval($end_range[$i]);
                $tax_percent_val = intval($tax_percent[$i]);
                $add_amount_val  = intval($add_amount[$i]);

				if(!is_int($start_range_val) || !is_int($end_range_val) || !is_int($tax_percent_val) || !is_int($add_amount_val)){

					$this->session->set_flashdata('exception', "All input fileds must contain number !");
					redirect("tax/Tax/tax_setup");
				}
			}
            // Now process to dave/update data

            $save_tax = false;

            for ($i=0; $i < count($levels); $i++) {

                $tax_sl = intval($levels[$i]);
                $start_range_val = intval($start_range[$i]);
                $end_range_val = intval($end_range[$i]);
                $tax_percent_val = intval($tax_percent[$i]);
                $add_amount_val  = intval($add_amount[$i]);

                //Arrange level data for create and update level..
                $tax_stupData = array(
                    'tax_sl'       => $i+1,
                    'min'          => $start_range_val,
                    'max'          => $end_range_val,
                    'tax_percent'  => $tax_percent_val,
                    'add_smount'   => $add_amount_val,
                );

                $tax_stup_respo_data = $this->Tax_model->tax_stup_data_by_slno($tax_sl);

                if($tax_stup_respo_data){
                    // tax setup update
                    $tax_stup_update = $this->Tax_model->update_tax_stup_by_level($tax_stupData,$tax_stup_respo_data->tax_sl);
                    if($tax_stup_update){
                        $save_tax = true;
                    }
                    
                }else{
                    // tax setup update
                    if($this->Tax_model->save_tax_stup($tax_stupData)){
                        $save_tax = true;
                    }
                }
            }
            // End of Save level data to database..

            if($save_tax){
                $this->session->set_flashdata('message', display('successfully_saved'));

            }else{
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect("tax/Tax/tax_setup");

		}else{
			
			$data['title'] = display('list_tax_setup');
			$data['module']   = "tax";
			$data['page']     = "tax_cal_setupform"; 
			$data['taxs']     = $this->Tax_model->getTaxsetupList();

			echo Modules::run('template/layout', $data);
		}

		
	}

	public function remove_tax_setup($tax_sl){

		if($tax_sl){

				// Delete tax_setup form gmb_tax_calculation table..
				$tax_setup_del = $this->Tax_model->tax_setup_delete($tax_sl);

				if($tax_setup_del){

					$response = [ 
						'status' => true,
						'msg' => 'level '.$tax_sl.' is successfully deleted !'
					];
				}else{

					$response = [
						'status' => false,
						'msg' => 'level '.$tax_sl.' can not be deleted !'
					];
				}
				
		}

		echo json_encode($response);
	}


	public function create_tax_setup(){ 
		$data['title'] = display('list_tax_setup');
		#-------------------------------#
		$this->form_validation->set_rules('start_amount[]',display('start_amount'),'required|max_length[30]');
		$this->form_validation->set_rules('end_amount[]',display('end_amount'),'required|max_length[30]');
		$this->form_validation->set_rules('rate[]',display('rate'),'required|max_length[30]');
		$sm = $this->input->post('start_amount',true);
		$em = $this->input->post('end_amount',true);
		$rt = $this->input->post('rate',true);
		#-------------------------------#
		if ($this->form_validation->run() === true) {
			for ($i=0; $i < sizeof($sm); $i++) {
				$postData = [
					'start_amount'  => $sm[$i],
					'end_amount' 	=> $em[$i],
					'rate' 	        => $rt[$i],					
				];     
				$this->Tax_model->taxsetup_create($postData);
			}
			$this->session->set_flashdata('message', display('save_successfully'));
			redirect("tax/Tax/create_tax_setup");
		}else {
			$data['title']    = display('create');
			$data['module']   = "tax";
			$data['page']     = "tax_setupform"; 
			$data['taxs']     = $this->Tax_model->viewTaxsetup();
			echo Modules::run('template/layout', $data);   
			
		}   
	}
	public function delete_taxsetup($id = null){ 

			$this->permission->module('tax','delete')->redirect();

		if ($this->Tax_model->taxsetup_delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("tax/Tax/tax_setup_view");
	}

	public function update_taxsetup_form($id = null){
		$this->form_validation->set_rules('tax_setup_id',null,'required|max_length[11]');
		$this->form_validation->set_rules('start_amount',display('start_amount'),'required|max_length[30]');
		$this->form_validation->set_rules('end_amount',display('end_amount'),'required|max_length[30]');
		$this->form_validation->set_rules('rate',display('rate'),'required|max_length[30]');		
		#-------------------------------#
		if ($this->form_validation->run() === true) {
			$postData = [
				'tax_setup_id' 	  => $this->input->post('tax_setup_id',true),
				'start_amount' 	  => $this->input->post('start_amount',true),
				'end_amount'      => $this->input->post("end_amount",true),
				'rate'            => $this->input->post("rate",true),
			]; 		
			if ($this->Tax_model->update_taxsetup($postData)) { 
				$this->session->set_flashdata('message', display('successfully_updated'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("tax/Tax/update_taxsetup_form/". $id);

		} else {
			$data['title']     = display('update');
			$data['data']      =$this->Tax_model->taxsetup_updateForm($id);   
			$data['module']    = "tax";	
			$data['page']      = "taxserupt_update_form"; 
			echo Modules::run('template/layout', $data); 
		}
	}


	public function tax_collection_view(){

			$this->permission->module('tax','read')->redirect();

		$data['title']    = display('tax_setup');  ;
		$data['collect']  = $this->Tax_model->viewcollection();
		$data['module']   = "tax";
		$data['page']     = "tax_collection_view";   
		echo Modules::run('template/layout', $data); 
	} 

	public function delete_taxcollection($id = null) { 

			$this->permission->module('tax','delete')->redirect();

		if ($this->Tax_model->taxcollect_delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("tax/Tax/tax_collection_view");
	}
}
