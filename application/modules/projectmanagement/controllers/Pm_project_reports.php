<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pm_project_reports extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'project_management_model',
			'project_reports_model'
		));	

		if (! $this->session->userdata('isLogIn'))
		redirect('login');
	}


	/*project_lists*/
	 public function project_lists(){

	 	$this->permission->check_label('project_lists')->read()->redirect();

	 	$sessData = $this->session->userdata();
	 	$isAdmin = $sessData['isAdmin'];
	 	$isSupervisor = $sessData['supervisor'];
	 	$employee_id = $sessData['employee_id'];

	 	if($isSupervisor){

	 		$project_lead = $sessData['employee_id']; // if employee is supervisor, then he will be the project lead
	 		$data['project_lists']  = $this->project_management_model->project_manager_projects($project_lead);
	 		// this will use as reporter / project_lead, who will lead the project
			$data['project_leads'] = $this->project_management_model->project_manager_supervisor_dropdown($project_lead);
	 	}

	 	if($isAdmin){

	 		$data['project_lists']  = $this->project_management_model->all_projects();
	 		// this will use as reporter / project_lead, who will lead the project
			$data['project_leads'] = $this->project_management_model->supervisor_dropdown();
	 	}

	 	if(!$isSupervisor && $employee_id){

	 		redirect("projectmanagement/pm_project_reports/employee_project_lists");
	 	}

		$data['clients'] = $this->project_management_model->clientdropdown();
		$data['title'] = display('projects');
		$data['module'] = "projectmanagement";
		$data['page']   = "reports/project_list";

		echo Modules::run('template/layout', $data); 
	 }

	 /*employee_project_lists*/
	 public function employee_project_lists(){

	 	$this->permission->check_label('project_lists')->read()->redirect();

	 	$sessData = $this->session->userdata();
	 	$employee_id = $sessData['employee_id'];

	 	$data['project_lists'] = $project_lists = $this->project_management_model->employee_projects($employee_id);

		$data['clients'] = $this->project_management_model->clientdropdown();
		$data['title'] = display('projects');
		$data['module'] = "projectmanagement";
		$data['page']   = "reports/employee_project_list";

		echo Modules::run('template/layout', $data); 
	 }

	 public function project_wise_report($project_id = null){

	 	$this->permission->check_label('project_lists')->read()->redirect();

	 	//store project_id to session for project_wise_reports 
		$sData['project_id'] = $project_id;
		$this->session->set_userdata($sData);

		//Checking project_id request is valid or not
		$sessData = $this->session->userdata();
		$isAdmin = $sessData['isAdmin'];
	 	$isSupervisor = $sessData['supervisor'];
	 	$employee_id = $sessData['employee_id'];

	 	if($isSupervisor){
	 		// Check the requested project is for the project_lead / supervisor
	 		$verify_project = $this->project_management_model->verify_project($project_id , $employee_id);
	 		if(!$verify_project){

	 			$this->session->set_flashdata('exception', "You are not associated with the project !");
	 			redirect("projectmanagement/pm_project_reports/project_lists");
	 		}
	 	}
	 	if(!$isSupervisor && $employee_id){
	 		// Check the requested project is for the employee / team_member
	 		$verify_employee_project = $this->project_management_model->project_employee_check($project_id , $employee_id);
	 		if(!$verify_employee_project > 0){

	 			$this->session->set_flashdata('exception', "You are not associated with the project !");
	 			redirect("projectmanagement/pm_project_reports/project_lists");
	 		}
	 	}

		$data['project_info'] = $project_info = $this->project_management_model->single_project_data($project_id);

		$data['project_all_employees_id'] = $get_project_all_employees = $this->project_reports_model->get_project_all_employees($project_id);

		$data['project_id'] = $project_id;

		$data['title'] = display('pm_reports');
		$data['module'] = "projectmanagement";
		$data['page']   = "reports/project_report";

		echo Modules::run('template/layout', $data); 
	 }

	 public function project_remaining_completed(){

	 	$sess_data = $this->session->userdata();
	 	$project_id = $sess_data['project_id'];

	 	$project_info = $this->project_management_model->single_project_data($project_id);

		// Getting value for approximate_tasks vs completed_tasks to show in donut chart report in project_wise_report
        $percentage = 100;
        $complete_percentage = 0;
        $remianing_percentage = 0;

        $progrss_complete = "";
        $progrss_remains = "";

        $approximate_tasks = $project_info->approximate_tasks?$project_info->approximate_tasks:0;
        $complete_tasks = $project_info->complete_tasks?$project_info->complete_tasks:0;

        $complete_percentage = ($complete_tasks / $approximate_tasks) * 100;
        $complete_percentage = round($complete_percentage);

        $remianing_percentage = $percentage - $complete_percentage;
        $remianing_percentage = round($remianing_percentage);

        $respo_data = array();
        $respo_data[] = $complete_percentage;
        $respo_data[] = $remianing_percentage;

		echo json_encode($respo_data);
	 }

	 public function project_various_status_tasks(){

	 	$sess_data = $this->session->userdata();
	 	$project_id = $sess_data['project_id'];

	 	$project_info = $this->project_management_model->single_project_data($project_id);

	 	//Get To Do tasks
	 	$project_to_do_tasks = $this->project_reports_model->project_to_do_tasks($project_id);

	 	//Get In Progress tasks
	 	$project_in_progress_tasks = $this->project_reports_model->project_in_progress_tasks($project_id);

	 	//Get Done tasks
	 	$project_done_tasks = $this->project_reports_model->project_done_tasks($project_id);

	 	$respo_data = array();
        $respo_data[] = $project_to_do_tasks?$project_to_do_tasks:0;
        $respo_data[] = $project_in_progress_tasks?$project_in_progress_tasks:0;
        $respo_data[] = $project_done_tasks?$project_done_tasks:0;

		echo json_encode($respo_data);

	 }

	 //Get a project's all employee id in acsending order
	 public function project_all_employees_id(){

	 	$sess_data = $this->session->userdata();
	 	$project_id = $sess_data['project_id'];

	 	$get_project_all_employees = $this->project_reports_model->get_project_all_employees($project_id);

	 	return $get_project_all_employees;

	 }

	 //Get a project_all_employees_name by id in acsending order
	 public function project_all_employees_name(){

	 	$sess_data = $this->session->userdata();
	 	$project_id = $sess_data['project_id'];

	 	$arr_employee_name = array();

	 	$get_project_all_employees = $this->project_reports_model->get_project_all_employees($project_id);

	 	foreach ($get_project_all_employees as $employee_id) {

	 		$respo = $this->db->select('first_name,last_name')
			 		->from('employee_history')
			 		->where('employee_id', $employee_id)
			 		->get()
			 		->row();
	 		
	 		$arr_employee_name[] = $respo->first_name.' '.$respo->last_name;
	 	}

	 	echo json_encode($arr_employee_name);

	 }

	  //Get a project's task_to_do_by_employee
	 public function task_to_do_by_employee(){

	 	$sess_data = $this->session->userdata();
	 	$project_id = $sess_data['project_id'];

	 	$arr_employee_todo_tasks = array();

	 	$get_project_all_employees = $this->project_reports_model->get_project_all_employees($project_id);

	 	foreach ($get_project_all_employees as $employee_id) {

	 		$num_of_todo_tasks = $this->db->select('*')
			 		->from('pm_tasks_list')
			 		->where('project_id', $project_id)
			 		->where('employee_id', $employee_id)
			 		->where('task_status', 1)
			 		->get()
			 		->num_rows();
	 		
	 		$arr_employee_todo_tasks[] = $num_of_todo_tasks;
	 	}

	 	echo json_encode($arr_employee_todo_tasks);

	 }

	 //Get a project's task_in_progress_by_employee
	 public function task_in_progress_by_employee(){

	 	$sess_data = $this->session->userdata();
	 	$project_id = $sess_data['project_id'];

	 	$arr_employee_inprogress_tasks = array();

	 	$get_project_all_employees = $this->project_reports_model->get_project_all_employees($project_id);

	 	foreach ($get_project_all_employees as $employee_id) {

	 		$num_of_inprogress_tasks = $this->db->select('*')
			 		->from('pm_tasks_list')
			 		->where('project_id', $project_id)
			 		->where('employee_id', $employee_id)
			 		->where('task_status', 2)
			 		->get()
			 		->num_rows();
	 		
	 		$arr_employee_inprogress_tasks[] = $num_of_inprogress_tasks;
	 	}

	 	echo json_encode($arr_employee_inprogress_tasks);

	 }

	 //Get a project's task_done_by_employee
	 public function task_done_by_employee(){

	 	$sess_data = $this->session->userdata();
	 	$project_id = $sess_data['project_id'];

	 	$arr_employee_done_tasks = array();

	 	$get_project_all_employees = $this->project_reports_model->get_project_all_employees($project_id);

	 	foreach ($get_project_all_employees as $employee_id) {

	 		$num_of_done_tasks = $this->db->select('*')
			 		->from('pm_tasks_list')
			 		->where('project_id', $project_id)
			 		->where('employee_id', $employee_id)
			 		->where('task_status', 3)
			 		->get()
			 		->num_rows();
	 		
	 		$arr_employee_done_tasks[] = $num_of_done_tasks;
	 	}

	 	echo json_encode($arr_employee_done_tasks);

	 }

	 //Get project_all_employees_list if any single task created for any employee.
	 public function project_all_employees_list(){

	 	$list = array('' => 'Select One...');

	 	$project_all_employees_info = $this->project_reports_model->get_project_all_employees_info();

	 	foreach ($project_all_employees_info as $employee_id) {

	 		$respo = $this->db->select('emp_his_id,employee_id,first_name,middle_name,last_name')
			 		->from('employee_history')
			 		->where('employee_id', $employee_id)
			 		->where('employee_status', 1)
			 		->get()
			 		->row();
	 		
	 		$list[$respo->employee_id]=$respo->first_name.' '.$respo->last_name;
	 	}

	 	return $list;

	 }

	  //Get project_lead_all_employees_list if any single task created for any employee.
	 public function project_lead_all_employees_list($project_lead = null){

	 	$list = array('' => 'Select One...');

	 	$project_all_employees_info = $this->project_reports_model->get_project_lead_all_employees_info($project_lead);

	 	foreach ($project_all_employees_info as $employee_id) {

	 		$respo = $this->db->select('emp_his_id,employee_id,first_name,middle_name,last_name')
			 		->from('employee_history')
			 		->where('employee_id', $employee_id)
			 		->where('employee_status', 1)
			 		->get()
			 		->row();
	 		
	 		$list[$respo->employee_id]=$respo->first_name.' '.$respo->last_name;
	 	}

	 	return $list;

	 }

	 public function team_member_search(){

	 	$this->permission->check_label('team_member')->read()->redirect();

	 	$sessData = $this->session->userdata();
	 	$isAdmin = $sessData['isAdmin'];
	 	$isSupervisor = $sessData['supervisor'];
	 	$employee_id = $sessData['employee_id']; // if supervisor, then it will be the project_lead

	 	if($isAdmin){

	 		$data['project_all_employees_list'] = $project_info = $this->project_all_employees_list();

	 	}
	 	if($isSupervisor){

	 		$data['project_all_employees_list'] = $project_info = $this->project_lead_all_employees_list($employee_id);

	 	}
		

		$data['title'] = display('pm_reports');
		$data['module'] = "projectmanagement";
		$data['page']   = "reports/team_member_project";

		echo Modules::run('template/layout', $data); 
	 }

	 public function get_employee_projects(){

	 	$employee_id = $this->input->post('employee_id',true);

	 	$sessData = $this->session->userdata();
	 	$isAdmin = $sessData['isAdmin'];
	 	$isSupervisor = $sessData['supervisor'];
	 	$project_lead = $sessData['employee_id']; // if supervisor, then it will be the project_lead

	 	if($isAdmin){

	 		$project_lists = $this->project_management_model->employee_projects($employee_id);
	 	}
	 	if($isSupervisor){

	 		$project_lists = $this->project_reports_model->get_employee_projects($employee_id, $project_lead);
	 	}

        echo  "<option>Select Project</option>";
        $html = "";
        foreach($project_lists as $data){
            $html .="<option value='$data->project_id'>$data->project_name</option>";
            
        }

        echo $html;

	 }

	 public function employee_project_tasks(){

	 	$this->permission->check_label('team_member')->read()->redirect();

	 	$employee_id = $this->input->post('employee_id',true);
	 	$project_id = $this->input->post('project_id',true);

	 	$employee_info = $this->db->select('emp_his_id,employee_id,first_name,middle_name,last_name')
			 		->from('employee_history')
			 		->where('employee_id', $employee_id)
			 		->get()
			 		->row();

	 	$data['project_info'] = $project_info = $this->project_management_model->single_project_data($project_id);

	 	// Get all tasks form table pm_tasks_list by employee_id and project_id
	 	$data['project_tasks_list'] = $project_tasks_list = $this->project_reports_model->employee_project_tasks_list($employee_id,$project_id);

		$data['title'] = display('all_tasks');
		$data['panel_title'] = display('all_tasks')." for ".$employee_info->first_name." ".$employee_info->last_name." from ".$project_info->project_name;
		$data['module'] = "projectmanagement";
		$data['page']   = "reports/project_tasks_list";


		echo Modules::run('template/layout', $data); 
	 }


}