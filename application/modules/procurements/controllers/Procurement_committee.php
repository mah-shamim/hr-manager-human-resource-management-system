<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement_committee extends MX_Controller {

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
	 public function committee_list($id = null){

		$this->permission->check_label('committee_list')->read()->redirect();

		$data['title'] = display('committee_list');

		$data['committee_lists']  = $this->procurements_model->all_committee_list();
		$data['title'] = display('committee_list');
		$data['module'] = "procurements";
		$data['page']   = "committee/committee_list";

		echo Modules::run('template/layout', $data); 

	 }

    /*unit_list create and edit*/
	 public function create_committee(){

	  $this->permission->check_label('committee_list')->read()->redirect();

	  $data['title'] = display('add_committee');
	  #-------------------------------#
	  $this->form_validation->set_rules('name', display('committee_list')  ,'required|max_length[100]');
	  #-------------------------------#

		$this->load->library('myupload');
		$signature = $this->myupload->do_upload(
			'./application/modules/procurements/assets/signature/', 
			'sign_image'

		);
		// if signature_and_stamp is uploaded then resize the signature/sign image
		if ($signature !== false && $signature != null) {
			$this->myupload->do_resize(
				$signature, 
				300,
				120
			);
		}

	   $data['committee_list']   = (Object) $postData = [
	   'id'          => $this->input->post('id'), 
	   'name'        => $this->input->post('name',true),
	   'sign_image'  => $signature,	
	  ];


	  if ($this->form_validation->run()) { 

		   if (empty($postData['id'])) {

		    $this->permission->check_label('committee_list')->create()->redirect();

		    if ($this->procurements_model->committee_create($postData)) { 
		     	$this->session->set_flashdata('message', display('save_successfully'));
		     	redirect('procurements/procurement_committee/committee_list');
		    }else {
		     	$this->session->set_flashdata('exception',  display('please_try_again'));
		    }
		    	redirect('procurements/procurement_committee/committee_list/');

		   }

		  } else {

				$data['title'] = display('committee_list');
				$data['module'] = "procurements";
				$data['page']   = "committee/create_committee";

				echo Modules::run('template/layout', $data); 
		   }  

	 }

    /*unit_list create and edit*/
	 public function update_committee($id = null){

	  $this->permission->check_label('committee_list')->read()->redirect();

	  $data['title'] = display('update_committee');
	  #-------------------------------#
	  $this->form_validation->set_rules('name', display('committee_list')  ,'required|max_length[100]');
	  #-------------------------------#

		$this->load->library('myupload');
		$signature = $this->myupload->do_upload(
			'./application/modules/procurements/assets/signature/', 
			'sign_image'

		);
		// if signature_and_stamp is uploaded then resize the signature/sign image
		if ($signature !== false && $signature != null) {
			$this->myupload->do_resize(
				$signature, 
				300,
				120
			);
		}

	   $data['committee_list']   = (Object) $postData = [
	   'id'          => $this->input->post('id'), 
	   'name'        => $this->input->post('name',true),
	   'sign_image'  => (!empty($signature) ? $signature : $this->input->post('old_sign_image')),
	  ];


	  if ($this->form_validation->run()) { 

		   if (!empty($postData['id'])) {

		    	$this->permission->check_label('committee_list')->update()->redirect();

			    if ($this->procurements_model->committee_update($postData)) { 
			     	$this->session->set_flashdata('message', display('update_successfully'));
			    } else {
			     	$this->session->set_flashdata('exception',  display('please_try_again'));
			    }
			    redirect("procurements/procurement_committee/committee_list/");  
		   }

		  } else { 

				if(!empty($id)) {
				    $data['title'] = display('update_committee');
				    $data['committeeinfo']   = $this->procurements_model->findById_committee($id);
				}

				$data['title'] = display('committee_list');
				$data['module'] = "procurements";
				$data['page']   = "committee/update_committee";

				echo Modules::run('template/layout', $data); 
		   }  

	 }


	 public function delete_committee_list($id = null) {

		$this->permission->check_label('committee_list')->delete()->redirect();

		if ($this->procurements_model->committee_delete($id)) {

			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {

			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect("procurements/procurement_committee/committee_list");
    }


}
