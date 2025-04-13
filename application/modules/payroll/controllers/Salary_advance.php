<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salary_advance extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'employee/Employees_model',
			'Salary_advance_model',
			
		));

		if (!$this->session->userdata('isLogIn')){
			redirect('login');
		}

	}

	public function salary_advance_view()
	{   

		$this->permission->check_label('salary_advance')->read()->redirect();

		$data['title']           = display('salary_advance');
		$data['salary_adv_list'] = $this->Salary_advance_model->salary_advance_list();
		$data['employee']      	 = $this->Employees_model->employee();
		$data['module']   		 = "payroll";
		$data['page']     		 = "salary_advance/list";   


		echo Modules::run('template/layout', $data); 
	} 

	public function create_salary_advance()
	{ 

		$this->permission->check_label('salary_advance')->create()->redirect();

		$data['title'] = display('salary_advance');
		#-------------------------------#
		$this->form_validation->set_rules('employee_id',display('employee_name'),'required|max_length[50]');
		$this->form_validation->set_rules('amount',display('amount')  ,'required');
		$this->form_validation->set_rules('salary_month',display('salary_month')  ,'required');
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$salary_month = $this->input->post('salary_month',true);

			list($month,$year) = explode(' ',$salary_month);
			$month = $this->adv_sal_month_number_check($month);

			$postData = [
				'employee_id' 	=> $this->input->post('employee_id',true),
				'amount' 	    => $this->input->post('amount',true),
				'salary_month' 	=> $salary_month,
			];  

			// Check salary month is not current or greater..
			if((int)$month < (int)date('m')){

				$this->session->set_flashdata('exception',  "Salary month should be current or greater.");
				redirect("payroll/salary_advance/salary_advance_view");  
			}
			// Check advance salary already generated for the selected month year...
			$duplicate_salary_month = $this->Salary_advance_model->duplicate_salary_month_for_employee($postData);
			if($duplicate_salary_month){

				$this->session->set_flashdata('exception',  "Salary advance already generated for the employee for selected month !");
				redirect("payroll/salary_advance/salary_advance_view");  
			}


			$postData['CreateDate'] = date('Y-m-d');
			$postData['CreateBy'] = $this->session->userdata('id');

			$insert_id = $this->Salary_advance_model->insert_salary_advance($postData);

			if($insert_id){ 

				// Activity Logs
				addActivityLog("salary_advance", "create", $insert_id, "gmb_salary_advance", 1, $postData);

				$this->session->set_flashdata('message', display('successfully_saved'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}

		} else {
			$this->session->set_flashdata('exception',  validation_errors());
			
		} 

		redirect("payroll/salary_advance/salary_advance_view");  
	}

	public function manage_salary_advance()
	{   

		$this->permission->check_label('salary_advance')->read()->redirect();

		$data['title']           = display('manage_salary_advance');
		$data['salary_adv_list'] = $this->Salary_advance_model->salary_advance_list();
		$data['employee']      	 = $this->Employees_model->employee();
		$data['module']   		 = "payroll";
		$data['page']     		 = "salary_advance/manage_salary_advance";  


		echo Modules::run('template/layout', $data); 
	}

	public function update_salary_advance($id = null){


		$this->permission->check_label('salary_advance')->update()->redirect();

		$data['data'] = $salary_advance_info = $this->Salary_advance_model->salary_advance_by_id($id);

		$data['title'] = display('update_salary_advance');

		$this->form_validation->set_rules('amount',display('amount')  ,'required');

		#-------------------------------#

		if ($this->form_validation->run() === true) {

			$postData = [
				'id' 			=> $this->input->post('id',true),
				'employee_id' 	=> $salary_advance_info->employee_id,
				'amount' 	    => $this->input->post('amount',true),
				'salary_month' 	=> $salary_advance_info->salary_month,
			];

			// Check, if the salary advance already released from the selected month salary
			$salary_advance_released = $this->Salary_advance_model->salary_advance_released_on_salary_generate($postData);
			if($salary_advance_released){

				$this->session->set_flashdata('exception',  "This salary advance already deducted from employee salary !");
				redirect("payroll/salary_advance/manage_salary_advance");  
			}

			$postData['UpdateDate'] = date('Y-m-d');
			$postData['UpdateBy'] = $this->session->userdata('id');

			
			if ($this->Salary_advance_model->updte_salary_advance($postData)) { 

				// Activity Logs
				addActivityLog("salary_advance", "update", $id, "gmb_salary_advance", 2, $postData);

				$this->session->set_flashdata('message', display('successfully_updated'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("payroll/salary_advance/manage_salary_advance");  

		} else {


			$data['employee']      	 = $this->Employees_model->employee();
			$data['module'] = "payroll";
			$data['page']   = "salary_advance/update_salary_advance";   


			echo Modules::run('template/layout', $data); 
		}

	}

	public function delete_salary_advance($id = null) 
	{ 

		$this->permission->check_label('salary_advance')->delete()->redirect();

		$salary_advance_info = $this->Salary_advance_model->salary_advance_by_id($id);

		$postData = [
			'id' 			=> $id,
			'employee_id' 	=> $salary_advance_info->employee_id,
			'amount' 	    => $salary_advance_info->amount,
			'release_amount'=> $salary_advance_info->release_amount,
			'salary_month' 	=> $salary_advance_info->salary_month,
		];

		// Check, if the salary advance already released from the selected month salary
		$salary_advance_released = $this->Salary_advance_model->salary_advance_released_on_salary_generate($postData);
		if($salary_advance_released){

			$this->session->set_flashdata('exception',  "This salary advance already deducted from employee salary !");
			redirect("payroll/salary_advance/manage_salary_advance");  
		}

		if ($this->Salary_advance_model->salary_advance_delete($id)) {

			// Activity Logs
			addActivityLog("salary_advance", "delete", $id, "gmb_salary_advance", 3, $postData);

			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}

		redirect("payroll/salary_advance/manage_salary_advance");  
	}


		// Check month number based on month name
	public function adv_sal_month_number_check($month_name)
	{ 
		$month = '';

		switch($month_name)
        {
            case "January":
                $month = '1';
                break;
            case "February":
                $month = '2';
                break;
            case "March":
                $month = '3';
                break;
            case "April":
                $month = '4';
                break;
            case "May":
                $month = '5';
                break;
            case "June":
                $month = '6';
                break;
            case "July":
                $month = '7';
                break;
            case "August":
                $month = '8';
                break;
            case "September":
                $month = '9';
                break;
            case "October":
                $month = '10';
                break;
            case "November":
                $month = '11';
                break;
            case "December":
                $month = '12';
                break;
        }

        return $month;

	}


}