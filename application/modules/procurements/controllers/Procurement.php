<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'procurements_model',
			
		));	

		if (! $this->session->userdata('isLogIn'))
		redirect('login');
	}

	 /*unit_list create and edit*/
	 public function unit_list($id = null){

	  $this->permission->check_label('unit_list')->read()->redirect();

	  $data['title'] = display('add_unit');
	  #-------------------------------#
	  $this->form_validation->set_rules('unit', display('unit_list')  ,'required|max_length[100]');
	  #-------------------------------#
	   $data['point_category']   = (Object) $postData = [
	   'id'          => $this->input->post('id'), 
	   'unit'        => $this->input->post('unit',true)
	  ];


	  if ($this->form_validation->run()) { 

		   if (empty($postData['id'])) {

		    $this->permission->check_label('unit_list')->create()->redirect();

		    if ($this->procurements_model->unit_create($postData)) { 
		     	$this->session->set_flashdata('message', display('save_successfully'));
		     	redirect('procurements/procurement/unit_list');
		    }else {
		     	$this->session->set_flashdata('exception',  display('please_try_again'));
		    }
		    	redirect('procurements/procurement/unit_list/');

		   } else {

		    	$this->permission->check_label('unit_list')->update()->redirect();

			    if ($this->procurements_model->unit_update($postData)) { 
			     	$this->session->set_flashdata('message', display('update_successfully'));
			    } else {
			     	$this->session->set_flashdata('exception',  display('please_try_again'));
			    }
			    redirect("procurements/procurement/unit_list/".$postData['id']);  
		   }

		  } else { 

				if(!empty($id)) {
				    $data['title'] = display('update_unit');
				    $data['unitinfo']   = $this->procurements_model->findById_unit($id);
				}

				$data['units']  = $this->procurements_model->all_units();
				$data['title'] = display('unit_list');
				$data['module'] = "procurements";
				$data['page']   = "unit_list";

				echo Modules::run('template/layout', $data); 
		   }  

	 }

	 /*Delete unit*/
	 public function delete_unit_list($id=null){

        $this->permission->check_label('unit_list')->delete()->redirect();

        if($this->procurements_model->unit_delete($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('procurements/procurement/unit_list/');
    }


}
