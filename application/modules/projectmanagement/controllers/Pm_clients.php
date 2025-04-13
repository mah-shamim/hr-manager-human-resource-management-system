<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pm_clients extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'project_management_model',
			'country_model',
		));	

		if (! $this->session->userdata('isLogIn'))
		redirect('login');
	}

	/*clients list*/
	 public function clients(){

	 	$this->permission->check_label('clients')->read()->redirect();

		$data['client_lists']  = $this->project_management_model->all_clients();
		$data['country_list'] = $this->country_model->state();
		$data['title'] = display('clients');
		$data['module'] = "projectmanagement";
		$data['page']   = "clients/client_list";

		echo Modules::run('template/layout', $data); 
	 }

	 public function create_client(){

	 	$this->permission->check_label('clients')->create()->access();

        $this->form_validation->set_rules('client_name',display('client_name'),'required|is_unique[pm_clients.client_name]');
        $this->form_validation->set_rules('country',display('state'),'required');
        $this->form_validation->set_rules('email',display('email'),'required|is_unique[pm_clients.email]|max_length[100]');
        $this->form_validation->set_rules('company',display('company'),'required');
        $this->form_validation->set_rules('address',display('address'),'required');

        #-------------------------------#

        $data['vendor'] = (object)$postData = [

            'client_name' 	=> $this->input->post('client_name',TRUE),
            'country'  		=> $this->input->post('country',TRUE),
            'email'   		=> $this->input->post('email',TRUE),
            'company_name'  => $this->input->post('company',TRUE),
            'address'   	=> $this->input->post('address',TRUE),

        ];

         #-------------------------------#

        if ($this->form_validation->run() === true) {

        	if ($respo = $this->project_management_model->client_insert($postData)) {

        		#set success message
               $this->session->set_flashdata('message', display('save_successfully'));
        	}else {

             $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect("projectmanagement/pm_clients/clients");

        }else{

        	$this->session->set_flashdata('exception', validation_errors());
        	redirect("projectmanagement/pm_clients/clients");
        }

	 }

	/*manage_clients list*/
	public function manage_clients(){

		$this->permission->check_label('clients')->read()->redirect();

		$data['client_lists']  = $this->project_management_model->all_clients();
		$data['country_list'] = $this->country_model->state();
		$data['title'] = display('manage_clients');
		$data['module'] = "projectmanagement";
		$data['page']   = "clients/manage_clients";

		echo Modules::run('template/layout', $data); 
	}

	//Update Quotation data
	public function client_update($id = null){

		$this->permission->check_label('clients')->update()->redirect();

		$data['title'] = display('update_client');

        $this->form_validation->set_rules('country',display('state'),'required');
        $this->form_validation->set_rules('company',display('company'),'required');
        $this->form_validation->set_rules('address',display('address'),'required');

	    if($this->input->post('email',TRUE) != $this->input->post('old_email',TRUE)){

	    	$this->form_validation->set_rules('email',display('email'),'required|is_unique[pm_clients.email]|max_length[100]');
	    }

	    if($this->input->post('client_name',TRUE) != $this->input->post('old_client_name',TRUE)){

	    	$this->form_validation->set_rules('client_name',display('client_name'),'required|is_unique[pm_clients.client_name]|max_length[250]');
	    }

	     #-------------------------------#

	    $client_id = $this->input->post('client_id',TRUE);

	    $data['client'] = (object)$postData = [

	    	'client_id'				=> $client_id,
	        'client_name' 		=> $this->input->post('client_name',TRUE),
	        'country'  		=> $this->input->post('country',TRUE),
	        'email'   			=> $this->input->post('email',TRUE),
	        'company_name'			=> $this->input->post('company',TRUE),
	        'address'    			=> $this->input->post('address',TRUE),

	    ];

	     #-------------------------------#
	    if ($this->form_validation->run() === true) {

	    	if(!empty($client_id)){

	    		$this->permission->check_label('clients')->update()->redirect();

		        if ($this->project_management_model->update_client($postData)) {
		           
		           #set success message
		           $this->session->set_flashdata('message', display('save_successfully'));

		        }else {

		         $this->session->set_flashdata('exception', display('please_try_again'));
		        }
		        redirect("projectmanagement/pm_clients/manage_clients");
	    	}

	    }else{

	    	if($id){
	    		$data['id'] = $id;
	    		$data['client_data']  = $this->project_management_model->single_client_data($id);
	    	}
	    	$data['country_list'] = $this->country_model->state();

			$data['module'] = "projectmanagement";
			$data['page']   = "clients/client_update"; 

			echo Modules::run('template/layout', $data); 

	    }

	}

	public function delete_client($id = null){

		$this->permission->check_label('clients')->delete()->redirect();

		// Check if this client already associated with any project.
		$client_associated_projects = $this->project_management_model->client_associated_project($id);

		if(count($client_associated_projects) > 0){

			$this->session->set_flashdata('exception', "Can't be deleted, as it's already associated with a project !");
			redirect("projectmanagement/pm_clients/manage_clients");
		}

		if ($this->project_management_model->client_delete($id)) {

			

			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {

			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect("projectmanagement/pm_clients/manage_clients");
	}

}
