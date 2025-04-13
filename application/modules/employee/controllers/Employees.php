<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'Employees_model',
			'Country_model'
			
		));	

		$this->load->model('rewardpoint/rewardpoints_model'); 

			if (! $this->session->userdata('isLogIn'))
			redirect('login');
	}

	/* ################ Employee Salary Setup Start   #######################....*/

	public function emp_salary_setup_view()
	{   
		$this->permission->module('employee','read')->redirect();

		$data['title']    = display('view_salary_setup');  ;
		$data['emp_sl']   = $this->Employees_model->salary_setupView();
		$data['module']   = "employee";
		$data['page']     = "emp_sal_setupview";   
		echo Modules::run('template/layout', $data); 
	} 


	public function create_salary_setup()
	{ 
		$data['title'] = display('selectionlist');
		#-------------------------------#
		$this->form_validation->set_rules('emp_sal_name',display('emp_sal_name'),'required|max_length[50]');
		$this->form_validation->set_rules('emp_sal_type',display('emp_sal_type'));
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$postData = [
				'emp_sal_name'           => $this->input->post('emp_sal_name',true),
				'emp_sal_type' 	         => $this->input->post('emp_sal_type',true),	
			];   

			if ($this->Employees_model->emp_salsetup_create($postData)) { 
				$this->session->set_flashdata('message', display('message_sent'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("employee/Employees/create_salary_setup");



		} else {
			$data['title']  = display('create');
			$data['module'] = "employee";
			$data['page']   = "emp_salarysetup_form"; 
			echo Modules::run('template/layout', $data);   
			
		}   
	}
	public function delete_emp_salarysetup($id = null) 
	{ 
		$this->permission->module('employee','delete')->redirect();

		if ($this->Employees_model->emp_salstup_delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("employee/Employees/emp_salary_setup_view");
	}




	public function update_salsetup_form($id = null){
		$this->form_validation->set_rules('emp_sal_set_id',null,'required|max_length[11]');
		$this->form_validation->set_rules('emp_sal_name',display('emp_sal_name'),'required|max_length[50]');
		$this->form_validation->set_rules('emp_sal_type',display('emp_sal_type')  ,'required|max_length[20]');
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$postData = [
				'emp_sal_set_id' 	 => $this->input->post('emp_sal_set_id',true),
				'emp_sal_name' 	     => $this->input->post('emp_sal_name',true),
				'emp_sal_type' 		 => $this->input->post('emp_sal_type',true),
			]; 
			
			if ($this->Employees_model->update_em_salstup($postData)) { 
				$this->session->set_flashdata('message', display('message_sent'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("employee/Employees/update_salsetup_form/". $id);

		} else {
			$data['title']  = display('update');
			$data['data']   =$this->Employees_model->salarysetup_updateForm($id);
			$data['module'] = "employee";
			$data['page']   = "update_salarysetup_form";   
			echo Modules::run('template/layout', $data); 
		}

	}

	/* ################ Employee Salary Setup End   #######################....*/
/* <<<<<<<<<<<<<##############^^^^^^@@@@^^^^^###############>>>>>>>

/* ################ Employee Performance Start   #######################....*/

public function emp_performance_view()
{   
	$this->permission->module('employee','read')->redirect();

	$data['title']         = display('view_employee_performance');  ;
	$data['emp_perform']   = $this->Employees_model->emp_performanceView();
	$data['module']        = "employee";
	$data['page']          = "emp_performanceview";   
	echo Modules::run('template/layout', $data); 
} 


public function create_emp_performance()
{ 
	$data['title'] = display('performancelist');
		#-------------------------------#
	$this->form_validation->set_rules('employee_id',display('employee_id'),'required|max_length[50]');
	$this->form_validation->set_rules('note',display('note'),'max_length[200]');
	$this->form_validation->set_rules('date',display('date'));
	$this->form_validation->set_rules('score',display('score'),'required');

		#-------------------------------#
	if ($this->form_validation->run() === true) {
		$postData = [
			'employee_id'            => $this->input->post('employee_id',true),
			'note' 	                 => $this->input->post('note',true),
			'date'                   => $this->input->post('date',true),
			'note_by' 	             =>  $this->session->userdata('fullname'),
			'score'         		 => $this->input->post('score',true),
			'create_by'         	 => $this->session->userdata('id'),
			'create_date'         	 => date('Y-m-d'),		
		];   

		if ($this->Employees_model->emp_performance_create($postData)) { 
			$this->session->set_flashdata('message', display('successfully_saved'));
		} else {
			$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("employee/Employees/create_emp_performance");
	} else {
		$data['title']         = display('create');
		$data['module']        = "employee";
		$data['page']          = "emp_performance_form"; 
		$data['employee']      = $this->Employees_model->employee();
		$data['emp_perform']   = $this->Employees_model->emp_performanceView();
		echo Modules::run('template/layout', $data);   

	}   
}
public function delete_emp_performance($id = null) 
{ 
	$this->permission->module('employee','delete')->redirect();

	if ($this->Employees_model->emp_performance_delete($id)) {
			#set success message
		$this->session->set_flashdata('message',display('delete_successfully'));
	} else {
			#set exception message
		$this->session->set_flashdata('exception',display('please_try_again'));
	}
	redirect("employee/Employees/emp_performance_view");
}



public function update_emp_performance_form($id = null){
	$this->form_validation->set_rules('emp_per_id',null,'max_length[11]');
	$this->form_validation->set_rules('employee_id',display('employee_id'),'max_length[50]');
	$this->form_validation->set_rules('note',display('note'),'max_length[200]');
	$this->form_validation->set_rules('date',display('date'));
	$this->form_validation->set_rules('note_by',display('note_by'));
	$this->form_validation->set_rules('score',display('score'),'required');

		#-------------------------------#
	if ($this->form_validation->run() === true) {

		$postData = [
			'emp_per_id' 	         => $this->input->post('emp_per_id',true),
			'employee_id'            => $this->input->post('employee_id',true),
			'note' 	                 => $this->input->post('note',true),
			'date'                   => $this->input->post('date',true),
			'note_by' 	             => $this->input->post('note_by',true),
			'updated_by' 	         => $this->session->userdata('fullname'),
			'score'         		 => $this->input->post('score',true),
			'updated_by'         	 => $this->session->userdata('id'),
			'update_date'         	 => date('Y-m-d'),	
		]; 

		if ($this->Employees_model->update_em_performance($postData)) { 
			$this->session->set_flashdata('message', display('successfully_updated'));
		} else {
			$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("employee/Employees/update_emp_performance_form/". $id);

	} else {
		$data['title']  = display('update');
		$data['data']   = $this->Employees_model->emp_performance_updateForm($id);
		$data['query']  = $this->Employees_model->get_performaceempid($id);
		$data['employee'] = $this->Employees_model->employee();
		$data['module'] = "employee";
		$data['page']   = "update_performance_form";   
		echo Modules::run('template/layout', $data); 
	}

}

/* ################ Employee Performance End   #######################....*/


/* ################ Employee Payment start   #######################....*/

public function create_payment()
{ 
	$data['title'] = display('add_payment');
		#-------------------------------#
	$this->form_validation->set_rules('employee_id',display('employee_id'),'max_length[50]');
	$this->form_validation->set_rules('total_salary',display('total_salary'));
	$this->form_validation->set_rules('total_working_minutes',display('total_working_minutes'));
	$this->form_validation->set_rules('working_period',display('working_period'));
	$this->form_validation->set_rules('payment_due',display('payment_due'));
	$this->form_validation->set_rules('payment_date',display('payment_date'));
	$this->form_validation->set_rules('paid_by',display('paid_by'));


		#-------------------------------#
	if ($this->form_validation->run() === true) {

		$postData = [
			'employee_id'                  => $this->input->post('employee_id',true),
			'total_salary' 	               => $this->input->post('total_salary',true),
			'total_working_minutes'        => $this->input->post('total_working_minutes',true),
			'working_period' 	           => $this->input->post('working_period',true),
			'payment_due'                  => $this->input->post('payment_due',true),
			'payment_date' 	               => $this->input->post('payment_date',true),
			'paid_by' 	                   => $this->input->post('paid_by',true),
		];   

		if ($this->Employees_model->create_employee_payment($postData)) { 
			$this->session->set_flashdata('message', display('message_sent'));
		} else {
			$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("employee/Employees/create_payment");



	} else {
		$data['title']  = display('create');
		$data['module'] = "employee";
		$data['page']   = "emp_payment_form"; 
		echo Modules::run('template/layout', $data);   

	}   
}



public function delete_payment($id = null) 
{ 
	$this->permission->module('employee','delete')->redirect();

	if ($this->Employees_model->emp_payment_delete($id)) {
			#set success message
		$this->session->set_flashdata('message',display('delete_successfully'));
	} else {
			#set exception message
		$this->session->set_flashdata('exception',display('please_try_again'));
	}
	redirect($_SERVER['HTTP_REFERER']);
}


public function update_payment_form($id = null){
	$this->form_validation->set_rules('emp_sal_pay_id',null,'required|max_length[11]');
	$this->form_validation->set_rules('employee_id',display('employee_id'),'max_length[50]');
	$this->form_validation->set_rules('total_salary',display('total_salary'));
	$this->form_validation->set_rules('total_working_minutes',display('total_working_minutes'));
	$this->form_validation->set_rules('working_period',display('working_period'));
	$this->form_validation->set_rules('payment_due',display('payment_due'));
	$this->form_validation->set_rules('payment_date',display('payment_date'));

		#-------------------------------#
	if ($this->form_validation->run() === true) {

		$postData = [
			'emp_sal_pay_id' 	           => $this->input->post('emp_sal_pay_id',true),
			'employee_id'                  => $this->input->post('employee_id',true),
			'total_salary' 	               => $this->input->post('total_salary',true),
			'total_working_minutes'        => $this->input->post('total_working_minutes',true),
			'working_period' 	           => $this->input->post('working_period',true),
			'payment_due'                  => $this->input->post('payment_due',true),
			'payment_date' 	               => $this->input->post('payment_date',true),
			'paid_by' 	                   => $this->session->userdata('fullname'),
		]; 

		if ($this->Employees_model->update_payment($postData)) { 
			$this->session->set_flashdata('message', display('successfully_paid'));
		} else {
			$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("employee/Employees/emp_payment_view/". $id);

	} else {
		$data['title']  = display('update');
		$data['data']   =$this->Employees_model->payment_updateForm($id);
		$data['module'] = "employee";
		$data['page']   = "update_payment_form";   
		echo Modules::run('template/layout', $data); 
	}

}

/* ################ Employee Payment end   #######################....*/



/* ################ Employee Salary Pay Type Start   #######################....*/


public function emp_sal_payType_view()
{   
	$this->permission->module('employee','read')->redirect();

	$data['title']         = display('view_employee_payment');  ;
	$data['paytype']       = $this->Employees_model->emp_salPaytypeView();
	$data['module']        = "employee";
	$data['page']          = "sal_pay_type_tview";   
	echo Modules::run('template/layout', $data); 
} 

public function create_payment_type(){
	$data['title'] = display('add_payment_type');
	$this->form_validation->set_rules('payment_period',display('payment_period'),'required|max_length[50]');
		#-------------------------------#
	if ($this->form_validation->run() === true) {

		$postData = [
			'payment_period'    => $this->input->post('payment_period',true),
		];   

		if ($this->Employees_model->insert_payment_type($postData)) { 
			$this->session->set_flashdata('message', display('message_sent'));
		} else {
			$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("employee/Employees/create_payment_type");



	} else {
		$data['title']  = display('create');
		$data['module'] = "employee";
		$data['page']   = "emp_payment_type_form"; 
		echo Modules::run('template/layout', $data);   

	}   
}

public function delete_payment_type($id = null) 
{ 
	$this->permission->module('employee','delete')->redirect();

	if ($this->Employees_model->emp_payment_type_delete($id)) {
			#set success message
		$this->session->set_flashdata('message',display('delete_successfully'));
	} else {
			#set exception message
		$this->session->set_flashdata('exception',display('please_try_again'));
	}
	redirect("employee/Employees/emp_sal_payType_view");
}




	/* cv    */
	public function cv()
	{   

		$this->permission->check_label('manage_employee')->read()->access();

		$data['title']          = display('view details');  
		$id                     = $this->uri->segment(4);
		$data['row']            = $this->Employees_model->employee_details($id);
		$data['edu']            = $this->Employees_model->updateedu($id);
		$data['benifit']        = $this->Employees_model->benifit($id);
		$data['award']          = $this->Employees_model->award($id);

		$data['perform_score']  = $this->Employees_model->perform_score($id);

		$data['module']   = "employee";
		$data['page']     = "resumepdf";  
		
		echo Modules::run('template/layout', $data); 
	} 

	/* ########## NEW EMPLOYEE ADD ################*/
	public function viewEmhistory()
	{   
		$this->permission->module('employee','read')->redirect();

		$data['title']        	= display('view_salary_setup');  ;
		$data['emp_history']  	= $this->Employees_model->emp_historyview();
		$data['module']       	= "employee";
		$data['designation']  	= $this->Employees_model->designation();
		$data['dropdowndept'] 	= $this->Employees_model->dropdowndept();
		$data['supervisor']   	= $this->Employees_model->supervisorlist();
		$data['country_list'] 	= $this->Country_model->state();
		$data['atten_time_list']= $this->Employees_model->get_time_rules();
		$data['employee_types'] = $this->Employees_model->employee_types();

		$data['page']         	= "employ_form";   
		echo Modules::run('template/layout', $data); 
	} 


	public function manageemployee()
	{   
		$this->permission->module('employee','read')->redirect();

		$data['title']      = display('view_salary_setup');  ;
		$data['emp_history']= $this->Employees_model->emp_list();
		$data['module']     = "employee";
		$data['page']       = "employee_view";   
		echo Modules::run('template/layout', $data); 
	} 

	public function create_employee()
	{ 
		/***** file upload code start ***********/
		#-------------------------------#

		$data['title'] = display('create_employee');
		#-------------------------------#

		$this->form_validation->set_rules('first_name',display('first_name'),'required|max_length[50]');
		$this->form_validation->set_rules('last_name',display('last_name'),'required|max_length[50]');
		$this->form_validation->set_rules('middle_name',display('middle_name'),'max_length[50]');
		$this->form_validation->set_rules('maiden_name',display('maiden_name'),'max_length[50]');
		$this->form_validation->set_rules('present_address',display('present_address'),'max_length[250]');
		$this->form_validation->set_rules('parmanent_address',display('parmanent_address'),'max_length[250]');
        $this->form_validation->set_rules('termreason',display('termreason'),'max_length[250]');
       $this->form_validation->set_rules('email',display('email'),'required|valid_email|is_unique[employee_history.email]|max_length[50]');
       $this->form_validation->set_rules('h_phone',display('home_phone'),'numeric');
       $this->form_validation->set_rules('w_phone',display('business_phone'),'numeric');
       $this->form_validation->set_rules('c_phone',display('cell_phone'),'numeric');

       $this->form_validation->set_rules('em_contact',display('emerg_contct'),'numeric');
       $this->form_validation->set_rules('e_w_phone',display('emrg_w_phone'),'numeric');
       $this->form_validation->set_rules('a_e_w_phone',display('alt_emg_w_phone'),'numeric');
       $this->form_validation->set_rules('e_h_phone',display('emerg_home_phone'),'numeric');
       $this->form_validation->set_rules('a_e_h_phone',display('alt_emg_h_phone'),'numeric');
		
		$this->load->library('myupload');

		// Check image uploaded then, if the image valid or not
		if(isset($_FILES['picture']['name']) && !empty($_FILES['picture']['name'])){

			$extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

			if(!$this->myupload->valid_image_extension($extension)){

				$this->session->set_flashdata('exception',  "Please select a valid Photograph image !");
				redirect('employee/Employees/create_employee');
			}
		}
		// End of image extension validation

		$img = $this->myupload->do_upload(
			'./application/modules/employee/assets/images/', 
			'picture'

		);
		$this->form_validation->set_rules('c_f_name[]','Custom Field Name');
		$this->form_validation->set_rules('c_f_type[]','Custom Field Type');
		$this->form_validation->set_rules('customvalue[]','Custom Value');
		$employee_h= $this->db->select('employee_id')
		 ->from('employee_history')
		 ->order_by('emp_his_id','desc')
		 ->get()
		 ->row();
		$max_id = $employee_h->employee_id;
		if(!empty($max_id)){
		$employee_id = $max_id+1;	
		}else{
			$employee_id=1;
		}
		$customr_field      = $this->input->post('c_f_name',true);
		$customr_field_type = $this->input->post('c_f_type',true);
		$customr_value      = $this->input->post('customvalue',true);
		$benifit_code       = $this->input->post('benifit_c_code',true);
		$benifit_code_desc  = $this->input->post('benifit_c_code_d',true);
		$benifit_acc_date   = $this->input->post('benifit_acc_date',true);
		$benift_status = $this->input->post('benifit_sst',true);
		#-------------------------------#
		if ($this->form_validation->run() === true) {
			$this->load->library('myupload');
			$postData = [
				'employee_id'             => $employee_id,
				'pos_id' 	              => $this->input->post('pos_id',true),
				'first_name' 	          => $this->input->post('first_name',true),
				'middle_name'             => $this->input->post('middle_name',true),
				'last_name' 	          => $this->input->post('last_name',true),
				'maiden_name'             => $this->input->post('maiden_name'),
				'email' 	              => $this->input->post('email',true),
				'attendance_time' 	      => $this->input->post('attendance_time',true),
				'monthly_work_hours' 	  => $this->input->post('monthly_work_hours',true),
				'employee_type' 	      => $this->input->post('employee_type',true),
				'phone' 	              => $this->input->post('phone',true),
				'alter_phone' 	          => $this->input->post('alter_phone',true),
				'present_address' 	      => $this->input->post('present_address',true),
				'parmanent_address' 	  => $this->input->post('parmanent_address',true),
				'picture' 	              => $img,
				'dept_id'                 => $this->input->post('division',true),
				'state'                   => $this->input->post('state',true),
				'city'                    => $this->input->post('city',true),
				'zip'                     => $this->input->post('zip_code',true),
				'citizenship'             => $this->input->post('citizenship',true),
				'duty_type'               => $this->input->post('duty_type',true),
				'hire_date'               => date("Y-m-d", strtotime(!empty($this->input->post('hiredate',true))?$this->input->post('hiredate',true):date('Y-m-d'))),
				'original_hire_date'      => date("Y-m-d", strtotime(!empty($this->input->post('ohiredate',true))?$this->input->post('ohiredate',true):date('Y-m-d'))),

				'termination_date'        => !empty($this->input->post('terminatedate',true))?date("Y-m-d", strtotime($this->input->post('terminatedate',true))):null,

				'termination_reason'      => $this->input->post('termreason',true),
				'voluntary_termination'   => $this->input->post('volunt_termination',true),

				'rehire_date'             => !empty($this->input->post('rehiredate',true))?date("Y-m-d", strtotime($this->input->post('rehiredate',true))):null,

				'rate_type'               => $this->input->post('rate_type',true),
				'rate'                    => $this->input->post('rate',true),
				'pay_frequency'           => $this->input->post('pay_frequency',true),
				'pay_frequency_txt'       => $this->input->post('pay_f_text',true),
				'hourly_rate2'            => $this->input->post('h_rate2',true),
				'hourly_rate3'            => $this->input->post('h_rate3',true),
				'home_department'         => $this->input->post('h_department',true),
				'department_text'         => $this->input->post('h_dep_text',true),
				'class_code'              => $this->input->post('c_code',true),
				'class_code_desc'         => $this->input->post('c_code_d',true),

				'class_acc_date'          => !empty($this->input->post('class_acc_date',true))?date("Y-m-d", strtotime($this->input->post('class_acc_date',true))):null,

				'class_status'            =>  $this->input->post('class_sst',true),
				'is_super_visor'          => $this->input->post('is_supervisor',true),
				'super_visor_id'          => $this->input->post('supervisorname',true),
				'supervisor_report'       => $this->input->post('reports',true),

				'dob'                     => !empty($this->input->post('dob',true))?date("Y-m-d", strtotime($this->input->post('dob',true))):null,

				'gender'                  => $this->input->post('gender',true),
				'marital_status'          => $this->input->post('marital_status',true),
				'ethnic_group'            => $this->input->post('ethnic',true),
				'eeo_class_gp'            => $this->input->post('eeo_class',true),
				'sos'                     => $this->input->post('sos',true),
				'work_in_state'           => $this->input->post('w_s',true),
				'live_in_state'           => $this->input->post('l_in_s',true),
				'home_email'              => $this->input->post('h_email',true),
				'business_email'          => $this->input->post('b_email',true),
				'home_phone'              => $this->input->post('h_phone',true),
				'business_phone'          => $this->input->post('w_phone',true),
				'cell_phone'              => $this->input->post('c_phone',true),
				'em_contact_person'       => $this->input->post('em_contact_person',true),
				'emerg_contct'            => $this->input->post('em_contact',true),
				'emrg_h_phone'            => $this->input->post('e_h_phone',true),
				'emrg_w_phone'            => $this->input->post('e_w_phone',true),
				'emgr_contct_relation'    => $this->input->post('e_c_relation',true),
				'alt_em_contct'           => $this->input->post('alt_em_cont',true),
				'alt_emg_h_phone'         => $this->input->post('a_e_h_phone',true),
				'alt_emg_w_phone'         => $this->input->post('a_e_w_phone',true),
				'password'                => md5($this->input->post('password',true)),
			];

			$data['bank_info']  = (Object) $bankInfo = [
				'employee_id'   => $employee_id,
				'acc_number'    => $this->input->post('acc_number',true),
				'bank_name'     => $this->input->post('bank_name',true),
				'bban_num'      => $this->input->post('bban_num',true),
				'branch_address'=> $this->input->post('branch_address',true),
			];

			$data['employee_file'] = (Object) $employeeFile = [
				'employee_id'      => $employee_id,
				'tin_no'           => $this->input->post('tin_no',true),
				'gross_salary'     => $this->input->post('gross_salary',true),
				'basic'            => $this->input->post('basic',true),
				'transport'        => $this->input->post('transport',true),
				'medical_benefit'        => $this->input->post('medical_benefit',true),
				'family_benefit'         => $this->input->post('family_benefit',true),
				'transportation_benefit' => $this->input->post('transportation_benefit',true),
				'other_benefit' 		 => $this->input->post('other_benefit',true),
			];

			$data['acc_subcode']  = (Object) $accSubcode = [
				'subTypeId'    =>  2, // For employee from acc_subtype table
				'name'         => $this->input->post('first_name',true).' '.$this->input->post('last_name',true),
				'referenceNo'  => $employee_id,
				'created_date' => date('Y-m-d'),
			];


			$inser_id = $this->Employees_model->create_employee($postData);
			if($inser_id){

				$userData = array(
					'firstname' => $this->input->post('first_name',true),
					'lastname' 	=> $this->input->post('last_name',true),
					'email'     => $this->input->post('user_email',true),
					'password'  => md5($this->input->post('password',true)),
					'is_admin'  => 0,
					'image'     => (!empty($img) ? substr($img,2): ''),
				);

				$this->db->insert('user',$userData);
                $user_id = $this->db->insert_id();

				$rolData = array(
					'fk_role_id' 	=> 1,
					'fk_user_id' 	=> $user_id
				);
				$this->db->insert('sec_user_access_tbl',$rolData);

				$this->Employees_model->create_acc_subocde($accSubcode);

				for ($i=0; $i < count($customr_field); $i++) {
					$custom = [
						'custom_field'            => $customr_field[$i],
						'custom_data_type' 	      => $customr_field_type[$i],
						'custom_data' 	          => $customr_value[$i],
						'employee_id' 	          => $employee_id,
					];
					if(!empty($customr_field[$i])){
						$this->db->insert('custom_table', $custom);
					}
				}

				for ($i=0; $i < count($benifit_code); $i++) {

					$benifit = [
						'bnf_cl_code'           =>  $benifit_code[$i],
						'bnf_cl_code_des' 	    => $benifit_code_desc[$i],
						'bnff_acural_date' 	    => date("Y-m-d", strtotime(!empty($benifit_acc_date[$i])?$benifit_acc_date[$i]:date('Y-m-d'))),
						'bnf_status'            => $benift_status[$i],
						'employee_id' 	        => $employee_id,
					];
					if(!empty($benifit_code[$i])){
						$this->db->insert('employee_benifit', $benifit);
					}
				}

				// Insert data into gmb_setup_rules table for attendance_time dropdown selection

				$attendance_time_map = [
					'rule_id'      => $postData['attendance_time'],
					'employee_id'  => $employee_id,
					'type' 	       => 'time',
					'status' 	   => 1,
				];

				$this->Employees_model->insert_rules_map_data($attendance_time_map);

				// End of insert data into gmb_setup_rules table

				// Insert Bank information and employee file data for salary

				$this->Employees_model->insert_bank_info_data($bankInfo);

				$this->Employees_model->insert_employee_file_data($employeeFile);

				// End of Insert Bank information and employee file data for salary

				addActivityLog("employee", "create", $employee_id, "employee_history", 1, $postData);

				$this->session->set_flashdata('message', display('save_successfully'));
				redirect("employee/Employees/viewEmhistory");
			}else{

				$this->session->set_flashdata('exception', "Please try again");
				redirect("employee/Employees/viewEmhistory");
			}

		} else {
			$data['title'] = display('create');
			$data['module'] = "employee";
			$data['designation']  = $this->Employees_model->designation();
			$data['dropdowndept'] = $this->Employees_model->dropdowndept();
			$data['supervisor']   = $this->Employees_model->supervisorlist();
			$data['country_list'] = $this->Country_model->state();
			$data['atten_time_list']= $this->Employees_model->get_time_rules();
			$data['page']   = "employ_form"; 
			echo Modules::run('template/layout', $data);   
			
		}   
	}
	public function delete_employhistory($id = null) 
	{ 
		$this->permission->module('employee','delete')->redirect();
		
		$this->load->model('projectmanagement/project_management_model');

		$employee_tasks = 0;
		$supervisor_projects = 0;

		$employee_details = $this->Employees_model->employee_details($id);

		if(!$employee_details->is_super_visor){

			$employee_tasks = $this->project_management_model->employee_tasks($id);

			if($employee_tasks > 0){

				#set exception message
				$this->session->set_flashdata('exception',"This employee is associated with project management, So can't delete , only can inactive.");
				redirect("employee/Employees/manageemployee");
			}
		}else{

			$supervisor_projects = $this->project_management_model->supervisor_projects($id);

			if($supervisor_projects > 0){

				#set exception message
				$this->session->set_flashdata('exception',"This Supervisor is associated with project management, So can't delete , only can inactive.");
				redirect("employee/Employees/manageemployee");
			}
		}


        $device_ip = $this->deviceData()->device_ip;
		if ($this->Employees_model->emplyee_history_delete($id)) {

			// If employee is eligible to dleete then , delete employee file info and other related bank, acc_subcode
			$this->db->where('subTypeId ',2)->where('referenceNo ',$id)->delete('acc_subcode');
			$this->db->where('employee_id ',$id)->delete('gmb_bank_info');
			$this->db->where('employee_id ',$id)->delete('gmb_employee_file');

			$postData = array('');
			addActivityLog("employee", "delete", $id, "employee_history", 3, $postData);

			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("employee/Employees/manageemployee");
	}


	public function download($id)
	{
        # load download helper
		$this->load->helper('download');
        # search for filename by id
		$id = $this->uri->segment(4);
		$this->db->select('*');
		$this->db->where('employee_id', $id);
		$q = $this->db->get('employee_history');
        # if exists continue
		if($q->num_rows() > 0)
		{
			$row  = $q->row();
			$file = FCPATH . 'files/'. $row->filename;
			if(file_exists($file))
				force_download($file, NULL);
		}
		else
			show_404();
	}
	public   function DOWNLOAD_pdf(){
		$data=array();
		$data['cv']=$this->Employees_model->employee_details();
		$html=$this->load->view('cv',$data,TRUE);
		pdf_create($html,'User List');
	}

	public function position_view()
	{   
		$this->permission->check_label('position')->read()->access();

		$data['title']    = display('circularprocess_list');  ;
		$data['position'] = $this->Employees_model->viewPosition();
		$data['module'] = "employee";
		$data['page']   = "positionview";   
		echo Modules::run('template/layout', $data); 
	} 


	
	public function create_position()
	{ 
	    $this->permission->check_label('position')->create()->access();
	    
		$data['title'] = display('employee');
		#-------------------------------#
		$this->form_validation->set_rules('position_name',display('position_name'),'required|max_length[50]');
		$this->form_validation->set_rules('position_details',display('position_details')  ,'max_length[200]');
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$postData = [
				'position_name' 	 => $this->input->post('position_name',true),
				'position_details' 	 => $this->input->post('position_details',true),
			];   

			if ($this->Employees_model->position_create($postData)) { 
				$this->session->set_flashdata('message', display('successfully_saved'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("employee/Employees/create_position");



		} else {
			$data['title'] = display('create');
			$data['module'] = "employee";
			$data['position'] = $this->Employees_model->viewPosition();
			$data['page']   = "position_form"; 
			echo Modules::run('template/layout', $data);   
			
		}   
	}



	public function delete_pos($id = null) 
	{ 
	    $this->permission->check_label('position')->delete()->access();

		if ($this->Employees_model->delete_p($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('employee/Employees/position_view');
	}

	public function update_form($id = null){
		$this->form_validation->set_rules('pos_id',null,'required|max_length[11]');
		$this->form_validation->set_rules('position_name',display('position_name'),'required|max_length[50]');
		$this->form_validation->set_rules('position_details',display('position_details')  ,'max_length[30]');



		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$postData = [
				'pos_id' 	         => $this->input->post('pos_id',true),
				'position_name' 	 => $this->input->post('position_name',true),
				'position_details' 	 => $this->input->post('position_details',true),
				
			]; 
			
			if ($this->Employees_model->update_position($postData)) { 
				$this->session->set_flashdata('message', display('successfully_updated'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect('employee/Employees/position_view');

		} else {
			$data['data']=$this->Employees_model->pos_updateForm($id);
			$data['module'] = "employee";
			$data['page']   = "update_position";   
			echo Modules::run('template/layout', $data); 
		}

	}
	//************Employee Update Part***********//
	public function update_employee_form($id = null)
	{ 
		/***** file upload code start ***********/ 

		$data['title'] = display('employee_update_form');
        $device_ip = $this->deviceData()->device_ip;
			$this->form_validation->set_rules('first_name',display('first_name'),'required|max_length[50]');
		$this->form_validation->set_rules('last_name',display('last_name'),'required|max_length[50]');
		$this->form_validation->set_rules('middle_name',display('middle_name'),'max_length[50]');
		$this->form_validation->set_rules('maiden_name',display('maiden_name'),'max_length[50]');
		$this->form_validation->set_rules('present_address',display('present_address'),'max_length[250]');
		$this->form_validation->set_rules('parmanent_address',display('parmanent_address'),'max_length[250]');
        $this->form_validation->set_rules('termreason',display('termreason'),'max_length[250]');
		$this->load->library('myupload');

		$this->form_validation->set_rules('h_phone',display('home_phone'),'numeric');
		$this->form_validation->set_rules('w_phone',display('business_phone'),'numeric');
		$this->form_validation->set_rules('c_phone',display('cell_phone'),'numeric');

		$this->form_validation->set_rules('em_contact',display('emerg_contct'),'numeric');
		$this->form_validation->set_rules('e_w_phone',display('emrg_w_phone'),'numeric');
		$this->form_validation->set_rules('a_e_w_phone',display('alt_emg_w_phone'),'numeric');
		$this->form_validation->set_rules('e_h_phone',display('emerg_home_phone'),'numeric');
		$this->form_validation->set_rules('a_e_h_phone',display('alt_emg_h_phone'),'numeric');

		// Check image uploaded then, if the image valid or not
		if(isset($_FILES['picture']['name']) && !empty($_FILES['picture']['name'])){

			$extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

			if(!$this->myupload->valid_image_extension($extension)){

				$this->session->set_flashdata('exception',  "Please select a valid Photograph image !");
				redirect('employee/Employees/update_employee_form/'.$id);
			}
		}
		// End of image extension validation

		$img = $this->myupload->do_upload(
			'./application/modules/employee/assets/images/', 
			'picture'

		);
		$this->form_validation->set_rules('c_f_name[]','Custom Field Name');
		$this->form_validation->set_rules('c_f_type[]','Custom Field Type');
		$this->form_validation->set_rules('customvalue[]','Custom Value');
		$customr_field = $this->input->post('c_f_name',true);
		$customr_field_type = $this->input->post('c_f_type',true);
		$customr_value = $this->input->post('customvalue',true);

		$benifit_code = $this->input->post('benifit_c_code',true);
		$benifit_code_desc = $this->input->post('benifit_c_code_d',true);
		$benifit_acc_date = $this->input->post('benifit_acc_date',true);
		$benift_status = $this->input->post('benifit_sst',true);

		$c_code = $id;
		$c_name = $this->input->post('first_name',true).$this->input->post('last_name',true);
		$c_acc=$c_code.'-'.$c_name;

		$old_accname = $id.'-'.$this->input->post('oldfirstname',true).$this->input->post('oldlastname',true);

		#-------------------------------#
		if ($this->form_validation->run() === true) {


			$data['employee']   = (Object) $postData = [
				'employee_id'             => $this->input->post('employee_id',true),
				'pos_id' 	              => $this->input->post('pos_id',true),
				'first_name' 	          => $this->input->post('first_name',true),
				'maiden_name'             => $this->input->post('maiden_name'),
				'last_name' 	          => $this->input->post('last_name',true),
				'maiden_name'             => $this->input->post('maiden_name'),
				'email' 	              => $this->input->post('email',true),
				'phone' 	              => $this->input->post('phone',true),
				'attendance_time' 	      => $this->input->post('attendance_time',true),
				'monthly_work_hours' 	  => $this->input->post('monthly_work_hours',true),
				'employee_type' 	      => $this->input->post('employee_type',true),
				'alter_phone' 	          => $this->input->post('alter_phone',true),
				'present_address' 	      => $this->input->post('present_address',true),
				'parmanent_address' 	  => $this->input->post('parmanent_address',true),
				'picture' 	              => (!empty($img) ? $img : $this->input->post('old_image')),
				'dept_id'                 => $this->input->post('division',true),
				'state'                   => $this->input->post('state',true),
				'city'                    => $this->input->post('city',true),
				'zip'                     => $this->input->post('zip_code',true),
				'citizenship'             => $this->input->post('citizenship',true),
				'duty_type'               => $this->input->post('duty_type',true),

				'hire_date'               => !empty($this->input->post('hiredate',true))?date("Y-m-d", strtotime($this->input->post('hiredate',true))):null,

				'original_hire_date'      => !empty($this->input->post('ohiredate',true))?date("Y-m-d", strtotime($this->input->post('ohiredate',true))):null,

				'termination_date'        => !empty($this->input->post('terminatedate',true))?date("Y-m-d", strtotime($this->input->post('terminatedate',true))):null,

				'termination_reason'      => $this->input->post('termreason',true),
				'voluntary_termination'   => $this->input->post('volunt_termination',true),

				'rehire_date'             => !empty($this->input->post('rehiredate',true))?date("Y-m-d", strtotime($this->input->post('rehiredate',true))):null,

				'rate_type'               => $this->input->post('rate_type',true),
				'rate'                    => $this->input->post('rate',true),
				'pay_frequency'           => $this->input->post('pay_frequency',true),
				'pay_frequency_txt'       => $this->input->post('pay_f_text',true),
				'hourly_rate2'            => $this->input->post('h_rate2',true),
				'hourly_rate3'            => $this->input->post('h_rate3',true),
				'home_department'         => $this->input->post('h_department',true),
				'department_text'         => $this->input->post('h_dep_text',true),
				'class_code'              => $this->input->post('c_code',true),
				'class_code_desc'         => $this->input->post('c_code_d',true),

				'class_acc_date'        => !empty($this->input->post('class_acc_date',true))?date("Y-m-d", strtotime($this->input->post('class_acc_date',true))):null,

				'class_status'            =>  $this->input->post('class_sst',true),
				'is_super_visor'          => $this->input->post('is_supervisor',true),
				'super_visor_id'          => $this->input->post('supervisorname',true),
				'supervisor_report'       => $this->input->post('reports',true),

				'dob'        => !empty($this->input->post('dob',true))?date("Y-m-d", strtotime($this->input->post('dob',true))):null,

				'gender'                  => $this->input->post('gender',true),
				'marital_status'          => $this->input->post('marital_status',true),
				'ethnic_group'            => $this->input->post('ethnic',true),
				'eeo_class_gp'            => $this->input->post('eeo_class',true),
				'sos'                     => $this->input->post('sos',true),
				'work_in_state'           => $this->input->post('w_s',true),
				'live_in_state'           => $this->input->post('l_in_s',true),
				'home_email'              => $this->input->post('h_email',true),
				'business_email'          => $this->input->post('b_email',true),
				'home_phone'              => $this->input->post('h_phone',true),
				'business_phone'          => $this->input->post('w_phone',true),
				'cell_phone'              => $this->input->post('c_phone',true),
				'em_contact_person'       => $this->input->post('em_contact_person',true),
				'emerg_contct'            => $this->input->post('em_contact',true),
				'emrg_h_phone'            => $this->input->post('e_h_phone',true),
				'emrg_w_phone'            => $this->input->post('e_w_phone',true),
				'emgr_contct_relation'    => $this->input->post('e_c_relation',true),
				'alt_em_contct'           => $this->input->post('alt_em_cont',true),
				'alt_emg_h_phone'         => $this->input->post('a_e_h_phone',true),
				'alt_emg_w_phone'         => $this->input->post('a_e_w_phone',true),
				'password'                => (!empty($this->input->post('password',true))?md5($this->input->post('password',true)):$this->input->post('old_password',true))
			];

			$data['bank_info']  = (Object) $bankInfo = [
				'employee_id'   => $id,
				'acc_number'    => $this->input->post('acc_number',true),
				'bank_name'     => $this->input->post('bank_name',true),
				'bban_num'      => $this->input->post('bban_num',true),
				'branch_address'=> $this->input->post('branch_address',true),
			];

			$data['employee_file'] = (Object) $employeeFile = [
				'employee_id'      		 => $id,
				'tin_no'           		 => $this->input->post('tin_no',true),
				'gross_salary'     		 => $this->input->post('gross_salary',true),
				'basic'            		 => $this->input->post('basic',true),
				'transport'        		 => $this->input->post('transport',true),
				'medical_benefit'        => $this->input->post('medical_benefit',true),
				'family_benefit'         => $this->input->post('family_benefit',true),
				'transportation_benefit' => $this->input->post('transportation_benefit',true),
				'other_benefit' 		 => $this->input->post('other_benefit',true),
			];

			$data['acc_subcode']  = (Object) $accSubcode = [
				'name'         => $this->input->post('first_name',true).' '.$this->input->post('last_name',true),
			];

			$coa = $this->Employees_model->headcode();
			if($coa->HeadCode!=NULL){
				$headcode=$coa->HeadCode+1;
			}else{
				$headcode="502020000001";
			}

			$employee_id = $this->input->post('employee_id',true);

			$createby = $this->session->userdata('fullname');
			$createdate = date('Y-m-d H:i:s');


			if ($this->Employees_model->update_employee($postData)) { 

				$employee_old_useremail = $this->input->post('old_useremail',true);
				$user_his= $this->db->select('*')
				 ->from('user')
				 ->where('email',$employee_old_useremail)
				 ->get()
				 ->num_rows();

				 if($user_his > 0){

					$userData = array(
						'firstname' => $this->input->post('first_name',true),
						'lastname' 	=> $this->input->post('last_name',true),
						'email'     => $this->input->post('user_email',true),
						'password'  => (!empty($this->input->post('password',true))?md5($this->input->post('password',true)):$this->input->post('old_password',true)),
						'is_admin'  => 0,
						'image'     => (!empty($img) ? substr($img,2): $this->input->post('old_image'))
					);
					$this->db->where('email', $this->input->post('old_useremail',true))
					        ->update("user", $userData);

				 }

				// Update subcode if already created, otherwise create new
				 $subcode_respo = $this->Employees_model->get_acc_subocde($employee_id);
				 if($subcode_respo){
				 	$this->db->where('subTypeId', 2)->where('referenceNo', $employee_id)->update("acc_subcode", $accSubcode);
				 }else{
				 	$accSubcode['subTypeId']    = 2;
				 	$accSubcode['referenceNo']  = $employee_id;
				 	$accSubcode['created_date'] = date('Y-m-d');

				 	$this->Employees_model->create_acc_subocde($accSubcode);
				 }

				// End

				$this->db->where('employee_id',$this->input->post('employee_id',true))
				->delete('custom_table');
				$this->db->where('employee_id',$this->input->post('employee_id',true))
				->delete('employee_benifit');
				for ($i=0; $i < sizeof($customr_field); $i++) {
					$custom = [
						'custom_field'            =>  $customr_field[$i],
						'custom_data_type' 	      => $customr_field_type[$i],
						'custom_data' 	          => $customr_value[$i],
						'employee_id' 	          => $this->input->post('employee_id',true),
					];
					if(!empty($customr_field[$i])){
						$this->db->insert('custom_table', $custom);
					}
				}

				for ($i=0; $i < count($benifit_code); $i++) {

					$benifit = [
						'bnf_cl_code'           =>  $benifit_code[$i],
						'bnf_cl_code_des' 	    => $benifit_code_desc[$i],
						'bnff_acural_date' 	    => date("Y-m-d", strtotime(!empty($benifit_acc_date[$i])?$benifit_acc_date[$i]:date('Y-m-d'))),
						'bnf_status'            => $benift_status[$i],
						'employee_id' 	        => $this->input->post('employee_id',true),
					];
					if(!empty($benifit_code[$i])){
						$this->db->insert('employee_benifit', $benifit);
					}
				}

				// Insert data into gmb_setup_rules table for attendance_time dropdown selection

				$attendance_time_map = [
					'rule_id'      => $postData['attendance_time'],
					'employee_id'  => $employee_id,
					'type' 	       => 'time',
					'status' 	   => 1,
				];

				$this->Employees_model->update_rules_map_data($attendance_time_map);

				// End of insert data into gmb_setup_rules table

				// Update and insert into bank_info and employee_file table
				$bank_info = $this->Employees_model->bank_info($employee_id);
				if($bank_info){

					$this->db->where('employee_id', $employee_id)->update("gmb_bank_info", $bankInfo);
				}else{

					$this->Employees_model->insert_bank_info_data($bankInfo);
				}

				$employee_file = $this->Employees_model->employee_file_info($employee_id);
				if($employee_file){

					$this->db->where('employee_id', $employee_id)->update("gmb_employee_file", $employeeFile);
				}else{

					$this->Employees_model->insert_employee_file_data($employeeFile);
				}

				// End of Update and insert into bank_info and employee_file table

				addActivityLog("employee", "update", $employee_id, "employee_history", 2, $postData);

				$this->session->set_flashdata('message', display('update_successfully'));
				redirect("employee/Employees/cv/". $id);
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}	
		} else {
			$data['data']=$this->Employees_model->employee_updateForm($id);
			$data['module']       = "employee";
			$data['page']         = "update_employee_form";
			$data['dropdowndept'] = $this->Employees_model->dropdowndept();
			$data['designation']  = $this->Employees_model->designation();
			$data['supervisor']   = $this->Employees_model->supervisorlist();
			$data['custominfo']   = $this->Employees_model->customifo($id);
			$data['benifit']      = $this->Employees_model->benifit($id);
			$data['bb']           = $this->Employees_model->get_pos($id);
			$data['country_list'] = $this->Country_model->state();
			$data['atten_time_list']= $this->Employees_model->get_time_rules();

			$data['bank_info']      = $this->Employees_model->bank_info($id);
			$data['employee_file']  = $this->Employees_model->employee_file_info($id);
			$data['employee_types'] = $this->Employees_model->employee_types();

			
			echo Modules::run('template/layout', $data); 
			
		}   
	}


	public function randID()
	{
		$result = ""; 
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		$charArray = str_split($chars);
		for($i = 0; $i < 7; $i++) {
			$randItem = array_rand($charArray);
			$result .="".$charArray[$randItem];
		}
		return "E".$result;
	}

    // employee search
	public function employee_search()
	{
		$keyword = $this->input->post('what_you_search',true);
		$search_result = $this->Employees_model->employee_search($keyword);
		$data['emp_history'] = $search_result;
		$data['module']      = "employee";
		$data['page']        = "employee_view";   
		echo Modules::run('template/layout', $data);
	}


	// Employee Salary Paid info
	public function EmployeePayment(){
		$sal_id = $this->input->post('sal_id');
		$employee_id = $this->input->post('employee_id');
		$emplyeeinfo = $this->db->select('first_name,last_name')->from('employee_history')->where('employee_id',$employee_id)->get()->row();
		$data = array(
			'employee_id' => $employee_id,
			'Ename'       => $emplyeeinfo->first_name.$emplyeeinfo->last_name,
			'salP_id'     => $sal_id,
		);
		echo json_encode($data);
	}

	// confirm payment 
	
	public function payconfirm($id = null)
	{

	$this->form_validation->set_rules('paytype', display('payment_type')  ,'required');
         if ($this->form_validation->run()) { 
		$postData = [
			'emp_sal_pay_id' 	           => $this->input->post('emp_sal_pay_id',true),
			'payment_due'                  => 'paid',
			'payment_date' 	               => date('Y-m-d'),
			'payment_type'                 => $this->input->post('paytype',true),
			'bank_name'                    => $this->input->post('bank_name',true),
			'paid_by' 	                   => $this->session->userdata('fullname'),
		]; 

		$emp_id = $this->input->post('employee_id',true);
		$c_name = $this->db->select('first_name,last_name')->from('employee_history')->where('employee_id',$emp_id)->get()->row();
		$c_acc=$emp_id.'-'.$c_name->first_name.$c_name->last_name;
       $coatransactionInfo = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$c_acc)->get()->row();
       $COAID = $coatransactionInfo->HeadCode;
        $pay_type = $this->input->post('paytype',true);

         $bankname = $this->input->post('bank_name',true);
         $bankhead = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$bankname)->get()->row()->HeadCode;
			
			 $CashinHandDebit = array(
      'VNo'         => $this->input->post('emp_sal_pay_id',true),
      'Vtype'       => 'Salary',
      'VDate'       => date('Y-m-d'),
      'COAID'       => 1020101,
      'Narration'   => 'Cash in hand Debit For Employee Id'.$this->input->post('employee_id',true),
      'Debit'       => 0,
      'Credit'      => intval(str_replace(',', '', $this->input->post('total_salary',true))),
      'IsPosted'    => 1,
      'CreateBy'    => $this->session->userdata('id'),
      'CreateDate'  => date('Y-m-d H:i:s'),
      'IsAppove'    => 1
    ); 

	// Expense for salary payment
			 $expense = array(
      'VNo'         => $this->input->post('emp_sal_pay_id',true),
      'Vtype'       => 'Salary',
      'VDate'       => date('Y-m-d'),
      'COAID'       => 401,
      'Narration'   => 'salary payment for '.$this->input->post('employee_id',true),
      'Debit'       => intval(str_replace(',', '', $this->input->post('total_salary',true))),
      'Credit'      => 0,
      'IsPosted'    => 1,
      'CreateBy'    => $this->session->userdata('id'),
      'CreateDate'  => date('Y-m-d H:i:s'),
      'IsAppove'    => 1
    ); 		 
 	$accpayable = array(
      'VNo'            => $this->input->post('emp_sal_pay_id',true),
      'Vtype'          => 'Salary',
      'VDate'          => date('Y-m-d'),
      'COAID'          => $COAID,
      'Narration'      => 'Salary For Employee Id'.$this->input->post('employee_id',true),
      'Debit'          => intval(str_replace(',', '', $this->input->post('total_salary',true))),
      'Credit'         => 0,
      'IsPosted'       => 1,
      'CreateBy'       => $this->session->userdata('id'),
      'CreateDate'     => date('Y-m-d H:i:s'),
      'IsAppove'       => 1
    ); 

         $banktransaction = array(
      'VNo'            =>  $this->input->post('emp_sal_pay_id',true),
      'Vtype'          =>  'Salary',
      'VDate'          =>  date('Y-m-d'),
      'COAID'          =>  $bankhead,
      'Narration'      =>  'Employee Salary Payment',
      'Debit'          =>  0,
      'Credit'         =>  intval(str_replace(',', '', $this->input->post('total_salary',true))),
      'IsPosted'       =>  1,
      'CreateBy'       =>  $this->session->userdata('id'),
      'CreateDate'     =>  date('Y-m-d H:i:s'),
      'IsAppove'       =>  1
    );
      


		if ($this->Employees_model->update_payment($postData)) { 
			
			$this->db->insert('acc_transaction',$accpayable);
			$this->db->insert('acc_transaction',$expense);
			  if($pay_type == 1){
                $this->db->insert('acc_transaction',$CashinHandDebit); 
              }else{
                $this->db->insert('acc_transaction',$banktransaction);
              }
			 redirect('payroll/Payroll/payslip/'.$this->input->post('emp_sal_pay_id',true));
		} else {
			$this->session->set_flashdata('exception',  display('please_try_again'));
			 redirect($_SERVER['HTTP_REFERER']);
		}


     
		
		}else{
      $this->session->set_flashdata('exception',  display('please_try_again'));
     redirect($_SERVER['HTTP_REFERER']);
     }
	}
	/*
	|------------------------------------------------------
	| Finger Print Device Information
	|--------------------------------------------------------
	*/
	 function device_user() {
        $this->permission->module('employee','read')->redirect();
         $device_ip = $this->deviceData()->device_ip;
        $data['connect']      = '';
        $data['disableDevice']= '';
        $data['users']        = '';
        $data['enableDevice'] = '';
        $data['disconnect']   = '';
        $data['module']       = "employee";
        $data['page']         = "device/userlist";   
        echo Modules::run('template/layout', $data); 
    }
     /*
 |--------------------------------------------------------
 | Finger print Device information
 |--------------------------------------------------------
 */
 public function deviceData(){
    return $this->db->select('*')->from('deviceinfo')->get()->row();
 }

 public function payslip(){   
		$data['title']    = 'payslip'; 
		$data['module']   = "employee";
		$data['page']     = "payslip";   
		echo Modules::run('template/layout', $data); 
 }

 public function change_employee_status(){

 	$employee_id = $this->input->get("employee_id");
 	$employee_details = $this->Employees_model->employee_details($employee_id);

 	if($employee_details->employee_status == 1){

 		$data['employee']   = (Object) $postData = [
				'employee_id'     => $employee_id,
				'employee_status' => 0,
		];

 		if($this->Employees_model->update_employee($postData)){
 			$data = ["successfully deactivated the employee !"];

 			addActivityLog("employee deactivated", "update", $employee_id, "employee_history", 2, $postData);

 		}else{
 			$data = ["Unsuccessful"];
 		}

 	}else{

 		$data['employee']   = (Object) $postData = [
				'employee_id'     => $employee_id,
				'employee_status' => 1,
		];

		if($this->Employees_model->update_employee($postData)){
 			$data = ["successfully activated the employee !"];

 			addActivityLog("employee activated", "update", $employee_id, "employee_history", 2, $postData);
 		}else{
 			$data = ["Unsuccessful"];
 		}
 	}

 	echo json_encode($data);

 	
 }

}
