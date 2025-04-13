<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_type extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'Employees_model',
			'Country_model',
			'Employee_type_model',
			
		));

		if (!$this->session->userdata('isLogIn')){
			redirect('login');
		}

	}

	public function employee_types_view()
	{   
		$this->permission->module('employee_type','read')->redirect();

		$data['title']           = display('employee_types');
		$data['employee_types']  = $this->Employee_type_model->employee_types();
		$data['module']   		 = "employee";
		$data['page']     		 = "employee_types/list";   

		echo Modules::run('template/layout', $data); 
	} 

	public function create_type()
	{ 
		$this->permission->module('employee_type','create')->redirect();

		$data['title'] = display('employee_type');
		#-------------------------------#
		$this->form_validation->set_rules('name',display('name'),'required|max_length[50]');
		$this->form_validation->set_rules('details',display('details')  ,'max_length[200]');
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$postData = [
				'name' 	 => $this->input->post('name',true),
				'details' 	 => $this->input->post('details',true),
			];  

			$postData['CreateDate'] = date('Y-m-d');
			$postData['CreateBy'] = $this->session->userdata('id');


			if ($this->Employee_type_model->create_employee_type($postData)) { 
				$this->session->set_flashdata('message', display('successfully_saved'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}

		} else {
			$this->session->set_flashdata('exception',  validation_errors());
			
		} 

		redirect("employee/employee_type/employee_types_view");  
	}

	public function manage_employee_types()
	{   
		$this->permission->module('employee_type','read')->redirect();

		$data['title']           = display('employee_types');
		$data['employee_types']  = $this->Employee_type_model->employee_types();
		$data['module']   		 = "employee";
		$data['page']     		 = "employee_types/manage_employee_types";   


		echo Modules::run('template/layout', $data); 
	}

	public function update_employee_type($id = null){

		$this->permission->module('employee_type','update')->redirect();

		$data['title'] = display('update_employee_type');

		$this->form_validation->set_rules('id',null,'required|max_length[11]');
		$this->form_validation->set_rules('name',display('name'),'required|max_length[50]');
		$this->form_validation->set_rules('details',display('details')  ,'max_length[200]');

		#-------------------------------#

		if ($this->form_validation->run() === true) {

			$postData = [
				'id' 	  => $this->input->post('id',true),
				'name' 	  => $this->input->post('name',true),
				'details' => $this->input->post('details',true),
				
			]; 

			$postData['UpdateDate'] = date('Y-m-d');
			$postData['UpdateBy'] = $this->session->userdata('id');
			
			if ($this->Employee_type_model->update_employee_type($postData)) { 
				$this->session->set_flashdata('message', display('successfully_updated'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("employee/employee_type/manage_employee_types");

		} else {
			$data['data']=$this->Employee_type_model->employee_type_by_id($id);
			$data['module'] = "employee";
			$data['page']   = "employee_types/update_employee_type";   


			echo Modules::run('template/layout', $data); 
		}

	}

	public function delete_employee_type($id = null) 
	{ 
		$this->permission->module('employee_type','delete')->redirect();

		if ($this->Employee_type_model->employee_type_delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("employee/employee_type/manage_employee_types");
	}


}