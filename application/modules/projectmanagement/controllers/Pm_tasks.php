<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pm_tasks extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'project_management_model',
		));	

		if (! $this->session->userdata('isLogIn'))
		redirect('login');
	}

	/*tasks list*/

	public function transfer_tasks(){

		$sess_data = $this->session->userdata();
		$project_id = $sess_data['project_id'];

		$this->form_validation->set_rules('sprint_id',display('sprints'),'required');

		#-------------------------------#

		$sprint_project_id = $this->input->post('project_id',TRUE);
		$sprint_id = $this->input->post('sprint_id',TRUE);
	    $backlogs_tasks = $this->input->post('backlog_tasks');

	     #-------------------------------#
	    if ($this->form_validation->run() === true) {

			if($project_id != $sprint_project_id){

				$this->session->set_flashdata('exception', "You are not authorized with the project, as you opened a project in another tab !");
				redirect("projectmanagement/pm_tasks/transfer_tasks");
			}

			// If not select any backlogs , then show exception message and redirect to transfer_tasks page.
			if(count($backlogs_tasks) <= 0){

				$this->session->set_flashdata('exception', "Please select backlogs to transfer into tasks !");
				redirect("projectmanagement/pm_tasks/transfer_tasks");
			}

	    	if(!empty($sprint_id)){

	    		$this->permission->check_label('task')->update()->redirect();

	    		$backlog_transfer_status = false;

	    		foreach ($backlogs_tasks as $key => $value) {
	    			
	    			$backlogData = [
	    				'task_id'  		=> $value,
			            'sprint_id' 	=> $sprint_id,
			            'is_task'  		=> 1,
			        ];

	    			$respo = $this->project_management_model->update_task_from_backlogs($backlogData);
	    			if($respo){
	    				
	    				$backlog_transfer_status = true;
	    			}

	    		}

		        if ($backlog_transfer_status) {

		        	// Activity Log Insert
					$description = "Backlogs tasks transferred to sprint where sprint id is ".$sprint_id." and project id is ".$sprint_project_id;
					$this->project_management_model->activity_log_insert($description);
		           
		           #set success message
		           $this->session->set_flashdata('message', "Transferred successfully !");

		        }else {

		         $this->session->set_flashdata('exception', display('please_try_again'));
		        }
		        redirect("projectmanagement/pm_tasks/transfer_tasks");
	    	}

	    }else{

		    // Get all backlogs tasks for the project where is_task = 0  means it still consists in backlogs.
			$data['backlogs_tasks'] = $this->project_management_model->all_backlogs_tasks($project_id);

			// Get the active sprint for the project.. which is_finished = 0 , means the sprints is still not finished.
			$data['srpints'] = $this->project_management_model->get_sprints($project_id);

			$data['project_info']  = $this->project_management_model->single_project_data($project_id);

			$data['title'] = display("transfer_tasks");

			$data['module'] = "projectmanagement";
			$data['page']   = "tasks/transfer_tasks";

			echo Modules::run('template/layout', $data); 

	    }

	}

	// From inside backlogs, get the backlog tasks from parent project, which was selected when created the project.
	public function get_parent_project_tasks($current_project_id = null){

		$sess_data = $this->session->userdata();
		$project_id = $sess_data['project_id'];

		// Redirect to projects page.. if anyone access backlogs of another project in another tab of same browser and then try to access or request to save data in this funciton/page.
		if($project_id != $current_project_id){

			$this->session->set_flashdata('exception', "Invalid Request , you are already switched into another project !");
			redirect("projectmanagement/pm_projects/projects");
		}

		$data['project_info']  = $project_info = $this->project_management_model->single_project_data($current_project_id);

		//Previous project info
		$data['previous_project_info']  = $previous_project_info = $this->project_management_model->single_project_data($project_info->second_parent_project_id);

		$this->form_validation->set_rules('previous_project_name',display('previous_version'),'required');

		#-------------------------------#

	    $backlogs_tasks = $this->input->post('backlog_tasks');

	     #-------------------------------#
	    if ($this->form_validation->run() === true) {

			// If not select any backlogs , then show exception message and redirect to transfer_tasks page.
			if(count($backlogs_tasks) <= 0){

				$this->session->set_flashdata('exception', "Please select tasks to transfer at backlogs of ".$project_info->project_name." !");
				redirect("projectmanagement/pm_tasks/get_parent_project_tasks/".$current_project_id);
			}

	    	if($current_project_id){

	    		$this->permission->check_label('task')->update()->redirect();

	    		$backlog_transfer_status = false;

	    		foreach ($backlogs_tasks as $key => $value) {
	    			
	    			$backlogData = [
	    				'task_id'  		=> $value,
			            'project_id' 	=> $current_project_id,
			            'is_task'  		=> 0,
			            'sprint_id'  	=> null,
			            'task_status'   => 1,
			        ];

	    			$respo = $this->project_management_model->update_task_from_backlogs($backlogData);
	    			if($respo){
	    				
	    				$backlog_transfer_status = true;
	    			}

	    		}

		        if ($backlog_transfer_status) {
		           
		           #set success message
		           $this->session->set_flashdata('message', "Successfully transferred from ".$previous_project_info->project_name." to ".$project_info->project_name." !");

		        }else {

		         $this->session->set_flashdata('exception', display('please_try_again'));
		        }
		        redirect("projectmanagement/pm_tasks/get_parent_project_tasks/".$current_project_id);
	    	}

	    }else{

		    // Get all backlogs task by the second_parent_project_id which was selected when created the project.
			$data['previous_project_backlogs']  = $this->project_management_model->previous_project_backlogs($project_info->second_parent_project_id);

			$data['title'] = display("transfer_tasks");

			$data['module'] = "projectmanagement";
			$data['page']   = "tasks/get_parent_project_tasks";

			echo Modules::run('template/layout', $data); 

	    }
	}

	public function manage_tasks(){

		$sess_data = $this->session->userdata();

		// Project Lead/Team Members/ available Projects

		if($sess_data['isAdmin']){

			// isAdmin user
			$data['project_lists'] = $project_lists = $this->project_management_model->all_projects();

			$data['title'] = display("manage_tasks");

			$data['module'] = "projectmanagement";
			$data['page']   = "tasks/manage_tasks";

			echo Modules::run('template/layout', $data); 

		}
		elseif($sess_data['supervisor'] && !empty($sess_data['employee_id'])){
			// Project lead or supervisor
			redirect("projectmanagement/pm_tasks/projects_lead/".$sess_data['employee_id']);
		}
		elseif(!$sess_data['supervisor'] && !empty($sess_data['employee_id'])) {
			// Team Members or employees
			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}

	}

	// Need to work on this function for projects_lead projects
	public function projects_lead($projects_lead_id = null){

		$sess_data = $this->session->userdata();

		if($sess_data['employee_id'] != $projects_lead_id){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/projects_lead/".$sess_data['employee_id']);
		}

		$data['project_lists'] = $project_lists = $this->project_management_model->projects_lead_projects($projects_lead_id);

		$data['title'] = display("projects");

		$data['module'] = "projectmanagement";
		$data['page']   = "tasks/pm_projects";

		echo Modules::run('template/layout', $data); 

	}


	// Get project lead all tasks by individual project_id
	public function pm_project_all_tasks($project_id = null){

		$sess_data = $this->session->userdata();

		$data['project_info']  = $project_info = $this->project_management_model->single_project_data($project_id);

		if($project_info->is_completed == 1){

			$this->session->set_flashdata('exception',"Project already closed !");
			redirect("projectmanagement/pm_tasks/projects_lead/".$sess_data['employee_id']);
		}

		// Check, if the request project_id is for the logged in supervisor/project_lead and existis in the project_lists for the supervisor...
		$project_lead_check = $this->project_management_model->project_lead_check($project_id, $sess_data['employee_id']);

		if(!$project_lead_check){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/projects_lead/".$sess_data['employee_id']);
		}

		//store project_id to session for future use like kanban board..
		$sData['project_id'] = $project_id;
		$this->session->set_userdata($sData);
		$sess_data = $this->session->userdata();

		$data['all_tasks'] = $all_tasks = $this->project_management_model->project_tasks($project_id);

		// this will use as reporter / project_lead, who will lead the project
		$data['project_leads'] = $this->project_management_model->project_manager_supervisor_dropdown($sess_data['employee_id']);
		// this will use as assignee / team_members, who will work on the project
		$data['team_members'] = $this->project_management_model->assigned_empdropdown($project_id);
		// available sprints for the project
		$data['available_sprints'] = $this->project_management_model->get_sprints($project_id);

		$data['title'] = "Project Tasks";

		$data['module'] = "projectmanagement";
		$data['page']   = "tasks/pm_project_all_tasks";

		echo Modules::run('template/layout', $data); 

	}

	public function pm_create_task($project_id = null){

		$this->permission->check_label('task')->create()->redirect();

		$sess_data = $this->session->userdata();
		$sess_project_id = $sess_data['project_id'];
		$superVisor = $sess_data['supervisor'];

		// If not supervisor / prject_lead , then redirect to manage_tasks.. when not login as super_admin
		if(!$sess_data['isAdmin']){

			if(!$superVisor){

				$this->session->set_flashdata('exception',"Invalid Request !");
				redirect("projectmanagement/pm_tasks/manage_tasks");
			}
		}

		// If anyone tries to change project_id from inspect element, then will catch exception here.
		if($sess_project_id != $project_id){

			$this->session->set_flashdata('exception',"Invalid Request , You have already opened a project in another tab!");

			if(!$sess_data['isAdmin']){
				// If not login as super_admin, then redirect to this page
				redirect("projectmanagement/pm_tasks/pm_project_all_tasks/".$sess_project_id);
			}else{
				redirect("projectmanagement/pm_tasks/project_tasks/".$sess_project_id);
			}
			
		}

		$project_info  = $this->project_management_model->single_project_data($project_id);

		//Total tasks for an individual project is over then not allow to create any further task for the project
		$project_all_backlogs_tasks  = $this->project_management_model->project_all_backlogs_tasks($project_id);
		if($project_all_backlogs_tasks >= $project_info->approximate_tasks){

			$this->session->set_flashdata('exception',"Sorry, yuor approximate tasks limit is over !");

			if(!$sess_data['isAdmin']){
				// If not login as super_admin, then redirect to this page
				redirect("projectmanagement/pm_tasks/pm_project_all_tasks/".$sess_project_id);
			}else{
				redirect("projectmanagement/pm_tasks/project_tasks/".$sess_project_id);
			}
		}
        
        $this->form_validation->set_rules('summary',display('summary'),'required');
        $this->form_validation->set_rules('description',display('description'),'required');
        $this->form_validation->set_rules('employee_id',display('assignee'),'required');
        $this->form_validation->set_rules('priority',display('priority'),'required');
        $this->form_validation->set_rules('sprint_id',display('sprint'),'required');

        #-------------------------------#

        // File type check and show message for invalid file..

        if(isset($_FILES['file_attachment']['name']) && !empty($_FILES['file_attachment']['name'])){

	        $path = $_FILES['file_attachment']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$is_valid_file = $this->file_type($ext);

			if(!$is_valid_file){

				$this->session->set_flashdata('exception', "Invalid file request !");

				if(!$sess_data['isAdmin']){
				// If not login as super_admin, then redirect to this page
					redirect("projectmanagement/pm_tasks/pm_project_all_tasks/".$sess_project_id);
				}else{
					redirect("projectmanagement/pm_tasks/project_tasks/".$sess_project_id);
				}
			}
		}
		// End of file validation check..

        $this->load->library('myupload');
		$file_attachment = $this->myupload->do_upload(
			'./application/modules/projectmanagement/assets/attachments/', 
			'file_attachment'

		);

        $data['task'] = (object)$postData = [

            'project_id' 	=> $project_info->project_id,
            'summary'  		=> $this->input->post('summary',TRUE),
            'description'   => $this->input->post('description',TRUE),
            'project_lead'  => $project_info->project_lead,
            'employee_id'   => $this->input->post('employee_id',TRUE),
            'sprint_id'   	=> $this->input->post('sprint_id',TRUE),
            'priority'   	=> $this->input->post('priority',TRUE),
            'attachment'   	=> $file_attachment?$file_attachment:null,

        ];

        #-------------------------------#

        if ($this->form_validation->run() === true) {

        	if(!empty($postData['sprint_id'])){

				$postData['is_task'] = 1;

			}else{
				$postData['is_task'] = 0;
			}

        	if ($respo = $this->project_management_model->task_insert($postData)) {

        		#set success message
        		if($postData['is_task'] == 1){

        			// Activity Log Insert
					$description = "Task created for sprint ".$postData['sprint_id']." where task name is ".$postData['summary']." and project id is ".$project_info->project_id;
					$this->project_management_model->activity_log_insert($description);

        			$this->session->set_flashdata('message', "Saved successfully and transferrd to selected Sprint !");

        		}else{

        			$this->session->set_flashdata('message', display('save_successfully'));
        		} 

        	}else {

             $this->session->set_flashdata('exception', display('please_try_again'));

            }
            
        }else{

        	$this->session->set_flashdata('exception', validation_errors());
        }

        if(!$sess_data['isAdmin']){
        	// If not login as super_admin, then redirect to this page
			redirect("projectmanagement/pm_tasks/pm_project_all_tasks/".$sess_project_id);

		}else{

			redirect("projectmanagement/pm_tasks/project_tasks/".$sess_project_id);
		}

	}

	// update task as Project Lead
	public function task_update($task_id = null){

		$this->permission->check_label('task')->update()->redirect();

		$sess_data = $this->session->userdata();
		$project_id = $sess_data['project_id'];
		
		if(!$sess_data['isAdmin']){

			//Check, if the task_id is for the logged in supervisor/project_lead and existis in the pm_tasks_list for the supervisor...

			$project_task_check = $this->project_management_model->project_task_check($task_id, $sess_data['employee_id']);

			if(!$project_task_check || $sess_data['supervisor'] != 1){

				$this->session->set_flashdata('exception',"Invalid Request !");
				redirect("dashboard/home");
			}
		}

		// Verify, if this task is associated or not with the project_leader/Reporter..
		$valid_task = $this->project_management_model->valid_task_check($task_id,$project_id);

		if(!$valid_task){

			$this->session->set_flashdata('exception', "You are not associated with this task , please close the project which you have already opened!");

			if(!$sess_data['isAdmin']){
	        	// If not login as super_admin, then redirect to this page
				redirect("projectmanagement/pm_tasks/pm_project_all_tasks/".$project_id);

			}else{

				redirect("projectmanagement/pm_tasks/project_tasks/".$project_id);
			}
		}

		$this->form_validation->set_rules('summary',display('summary'),'required');
        $this->form_validation->set_rules('description',display('description'),'required');
        $this->form_validation->set_rules('priority',display('priority'),'required');

		#-------------------------------#

		// File type check and show message for invalid file..

        if(isset($_FILES['file_attachment']['name']) && !empty($_FILES['file_attachment']['name'])){

	        $path = $_FILES['file_attachment']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$is_valid_file = $this->file_type($ext);

			if(!$is_valid_file){

				$this->session->set_flashdata('exception', "Invalid file request !");
				
				if(!$sess_data['isAdmin']){
				// If not login as super_admin, then redirect to this page
					redirect("projectmanagement/pm_tasks/pm_project_all_tasks/".$project_id);
				}else{
					redirect("projectmanagement/pm_tasks/project_tasks/".$project_id);
				}
			}
		}
		// End of file validation check..

        $this->load->library('myupload');
		$file_attachment = $this->myupload->do_upload(
			'./application/modules/projectmanagement/assets/attachments/', 
			'file_attachment'

		);

		$old_attachment = $this->input->post('old_attachment',TRUE);

		// Get task_details by it's id
		$task_details = $this->project_management_model->task_details($task_id);
		$employee_id = $task_details->employee_id;

		if($this->input->post('employee_id',TRUE)){

			$employee_id = $this->input->post('employee_id',TRUE);
		}
		
        $data['task'] = (object)$postData = [

        	'task_id'  		=> $task_id,
            'summary'  		=> $this->input->post('summary',TRUE),
            'description'   => $this->input->post('description',TRUE),
            'employee_id'   => $employee_id,
            'sprint_id'   	=> $this->input->post('sprint_id',TRUE),
            'priority'   	=> $this->input->post('priority',TRUE),
            'task_status'   => $this->input->post('task_status',TRUE),
            'attachment'   	=> $file_attachment?$file_attachment:$old_attachment,

        ];

        #-------------------------------#

		if ($this->form_validation->run() === true) {

			if(!empty($postData['sprint_id'])){

				$postData['is_task'] = 1;

			}else{
				$postData['is_task'] = 0;
			}

        	if ($respo = $this->project_management_model->update_backlog_task($postData)) {

        		//// Updating project's completed_tasks
        		$tasks_completed_by_project = 0;

				$task_details = $this->project_management_model->task_details($task_id);
				$tasks_completed_by_project = $this->project_management_model->tasks_completed_by_project($task_details->project_id);

				// Update project completed_tasks...
				$project_data['project_id'] = $task_details->project_id;
				$project_data['complete_tasks'] = $tasks_completed_by_project;

				$update_project = $this->project_management_model->update_project($project_data);
				//// End of Updating project's completed_tasks

				// Activity Log Insert
				$description = "Task updated for sprint ".$postData['sprint_id']." where task name is ".$postData['summary']." and project id is ".$project_id;
				$this->project_management_model->activity_log_insert($description);

        		#set success message
               $this->session->set_flashdata('message', display('save_successfully'));

        	}else {

             $this->session->set_flashdata('exception', display('please_try_again'));
            }

            if(!$sess_data['isAdmin']){
	        	// If not login as super_admin, then redirect to this page
				redirect("projectmanagement/pm_tasks/pm_project_all_tasks/".$project_id);

			}else{

				redirect("projectmanagement/pm_tasks/project_tasks/".$project_id);
			}

		}else{

			// Showing , if there any validation errors
			if(validation_errors()){

				$this->session->set_flashdata('exception', validation_errors());

				if(!$sess_data['isAdmin']){
		        	// If not login as super_admin, then redirect to this page
					redirect("projectmanagement/pm_tasks/pm_project_all_tasks/".$project_id);

				}else{

					redirect("projectmanagement/pm_tasks/project_tasks/".$project_id);
				}
			}
			// End of showing validatin errors

			if($task_id){
				
				$data['id'] = $task_id;

	    		// Sprint finished, still trying to access the task to update , then show exception that.. sprint sinished!!!
	    		$is_sprint_finished = $this->project_management_model->valid_sprint_check($valid_task->sprint_id);

	    		if($is_sprint_finished){

	    			$this->session->set_flashdata('exception', "Sprint already finished !");

	    			if(!$sess_data['isAdmin']){
			        	// If not login as super_admin, then redirect to this page
						redirect("projectmanagement/pm_tasks/pm_project_all_tasks/".$project_id);

					}else{

						redirect("projectmanagement/pm_tasks/project_tasks/".$project_id);
					}
	    		}

	    		$data['task_data'] = $task_data = $this->project_management_model->single_backlog_task_data($task_id);

	    		$data['project_info']  = $this->project_management_model->single_project_data($project_id);
				// this will use as reporter / project_lead, who will lead the project
				$data['project_leads'] = $this->project_management_model->supervisor_dropdown();
				// this will use as assignee / team_members, who will work on the project
				$data['team_members'] = $this->project_management_model->assigned_empdropdown($project_id);
				// available sprints for the project
				$data['available_sprints'] = $this->project_management_model->get_sprints($project_id);
			}

			$data['title'] = display('update').' '.display('task');

			$data['module'] = "projectmanagement";
			$data['page']   = "tasks/pm_task_update";

			echo Modules::run('template/layout', $data); 

		}

	}

	// Sprints will show For project_lead when login as project_lead / supervisor
	public function pm_project_sprints($project_id){

		$this->permission->check_label('sprint')->read()->redirect();

		$sess_data = $this->session->userdata();

		// Check, if the request project_id is for the logged in supervisor/project_lead and existis in the project_lists for the supervisor...
		$project_lead_check = $this->project_management_model->project_lead_check($project_id, $sess_data['employee_id']);

		if(!$project_lead_check){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/projects_lead/".$sess_data['employee_id']);
		}

		//store project_id to session for future use like kanban board..
		$sData['sprint_project_id'] = $project_id;
		$this->session->set_userdata($sData);
		$sess_data = $this->session->userdata();
		
		$data['sprint_lists']  = $this->project_management_model->all_sprints($project_id);

		$data['title'] = display('sprints');

		$data['module'] = "projectmanagement";
		$data['page']   = "tasks/pm_sprints_list";

		echo Modules::run('template/layout', $data); 

	}

	// Sprint tasks will show For project_lead when login as project_lead / supervisor
	public function pm_sprint_tasks($sprint_id){

		$this->permission->check_label('task')->read()->redirect();

		$sess_data = $this->session->userdata();
		$sprint_project_id = $sess_data['sprint_project_id'];

		// Check, if the request sprint_id is for the sprint_project...
		$sprint_check_by_project = $this->project_management_model->sprint_check_by_project($sprint_project_id, $sprint_id);

		if(!$sprint_check_by_project){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/pm_project_sprints/".$sprint_project_id);
		}

		// Check if the sprint is finished or not, if finish then redirect and say that, sprint already finished
		$sprint_check_respo = $this->project_management_model->sprint_check($sprint_project_id, $sprint_id);

		if(!$sprint_check_respo){

			$this->session->set_flashdata('exception',"Sprint already finished !");
			redirect("projectmanagement/pm_tasks/pm_project_sprints/".$sprint_project_id);
		}

		$data['sprint_id'] = $sprint_id;

		$data['all_tasks']  = $this->project_management_model->sprint_tasks($sprint_id);

		$data['title'] = display('sprint')." ".display('all_tasks');

		$data['module'] = "projectmanagement";
		$data['page']   = "tasks/pm_sprints_tasks";

		echo Modules::run('template/layout', $data); 
	}

	// kanban_board will show For project_lead when login as project_lead / supervisor
	public function pm_kanban_board($sprint_id){

		$sess_data = $this->session->userdata();
		$sprint_project_id = $sess_data['sprint_project_id'];

		// Check, if the request sprint_id is for the sprint_project or sprint closed then redirect to pm_project_sprints page
		$sprint_check_by_project = $this->project_management_model->sprint_check_by_project($sprint_project_id, $sprint_id);

		if(!$sprint_check_by_project){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/pm_project_sprints/".$sprint_project_id);

		}elseif($sprint_check_by_project->is_finished == 1){

			$this->session->set_flashdata('exception',"Sprint already closed !");
			redirect("projectmanagement/pm_tasks/pm_project_sprints/".$sprint_project_id);
		}

		// Task Status
		$data['statusResult']  =  $status_lists = array (
		   array("id" => 1,"status_name" => "To Do"),
		   array("id" => 2,"status_name" => "In Progress"),
		   array("id" => 3,"status_name" => "Done")
		);

		$data['sprint_id'] = $sprint_id;

		$data['title'] = display('kanban_board');

		$data['module'] = "projectmanagement";
		$data['page']   = "tasks/pm_kanban_board";

		echo Modules::run('template/layout', $data);

	}

	// kanban task board task update when login as project_lead/supervisor / Employee/Team Members
	public function kanban_task_update(){

		$task_status = $this->input->get("task_status",true);
		$task_id = $this->input->get("task_id",true);

		// Check, if the request sprint_id is for the sprint_project...
		$update_task_kanban = $this->project_management_model->update_task_from_kanban($task_id, $task_status);

		if($update_task_kanban){

			$tasks_completed_by_project = 0;

			$task_details = $this->project_management_model->task_details($task_id);
			$tasks_completed_by_project = $this->project_management_model->tasks_completed_by_project($task_details->project_id);

			// Update project completed_tasks...
			$data['project_id'] = $task_details->project_id;
			$data['complete_tasks'] = $tasks_completed_by_project;

			$update_project = $this->project_management_model->update_project($data);

			// Activity Log Insert
			$description = "Task updated from kanban board where task id is ".$task_id." Status ".$task_status." , project id is ".$data['project_id'];
			$this->project_management_model->activity_log_insert($description);

			echo json_encode($update_project);

		}

		
	}

	// Need to work on this function for employee_projects
	public function employee_projects($employee_id = null){

		$sess_data = $this->session->userdata();

		if($sess_data['employee_id'] != $employee_id){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}

		$data['project_lists'] = $project_lists = $this->project_management_model->employee_projects($employee_id);

		$data['title'] = display("projects");

		$data['module'] = "projectmanagement";
		$data['page']   = "employee_tasks/employee_projects";

		echo Modules::run('template/layout', $data);

	}

	// Get an employee all tasks by his/her project
	public function empl_project_tasks($project_id = null){

		$sess_data = $this->session->userdata();

		$data['project_info']  = $project_info = $this->project_management_model->single_project_data($project_id);

		if($project_info->is_completed == 1){

			$this->session->set_flashdata('exception',"Project already closed !");
			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}

		// Check, if the request project_id is for the logged in employee/team_member..
		$project_tasks_check = $this->project_management_model->project_task_check_by_employee($project_id, $sess_data['employee_id']);

		if(!$project_tasks_check > 0){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}

		//store project_id to session for future use like kanban board..
		$sData['project_id'] = $project_id;
		$this->session->set_userdata($sData);
		$sess_data = $this->session->userdata();

		$data['all_tasks'] = $all_tasks = $this->project_management_model->employee_project_tasks($project_id, $sess_data['employee_id']);

		// this will use as reporter / project_lead, who will lead the project
		$data['project_leads'] = $this->project_management_model->project_manager_supervisor_dropdown($project_info->project_lead);
		// available sprints for the project
		$data['available_sprints'] = $this->project_management_model->get_sprints($project_id);

		$data['title'] = "Project Tasks";

		$data['module'] = "projectmanagement";
		$data['page']   = "employee_tasks/project_employee_all_tasks";

		echo Modules::run('template/layout', $data); 

	}

	// When login as employee, then if request to create task form project own_tasks_list.. this function will use.
	public function create_task_by_employee($project_id = null){

		$this->permission->check_label('task')->create()->redirect();

		$sess_data = $this->session->userdata();
		$sess_project_id = $sess_data['project_id'];

		// If anyone tries to change project_id from inspect element, then will catch exception here.
		if($sess_project_id != $project_id){

			$this->session->set_flashdata('exception',"Invalid Request, Seems you already opened a project in another tab!");
			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}

		//Check if employee is assigned to this project or not..
		$assigned_project_employee_check = $this->project_management_model->assigned_project_employee_check($project_id, $sess_data['employee_id']);

		if(!$assigned_project_employee_check > 0){

			$this->session->set_flashdata('exception',"You are not assigned to this project anymore !");
			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}

		$project_info  = $this->project_management_model->single_project_data($project_id);
		
		//Total tasks for an individual project is over then not allow to create any further task for the project
		$project_all_backlogs_tasks  = $this->project_management_model->project_all_backlogs_tasks($project_id);
		if($project_all_backlogs_tasks >= $project_info->approximate_tasks){

			$this->session->set_flashdata('exception',"Sorry, yuor approximate tasks limit is over !");

			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}

		// Check, if the request project_id is for the logged in employee/team_member..
		$project_tasks_check = $this->project_management_model->project_task_check_by_employee($project_id, $sess_data['employee_id']);

		if(!$project_tasks_check > 0){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}
        
        $this->form_validation->set_rules('summary',display('summary'),'required');
        $this->form_validation->set_rules('description',display('description'),'required');
        $this->form_validation->set_rules('priority',display('priority'),'required');
        $this->form_validation->set_rules('sprint_id',display('sprint'),'required');

        #-------------------------------#

        // File type check and show message for invalid file..

        if(isset($_FILES['file_attachment']['name']) && !empty($_FILES['file_attachment']['name'])){

	        $path = $_FILES['file_attachment']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$is_valid_file = $this->file_type($ext);

			if(!$is_valid_file){

				$this->session->set_flashdata('exception', "Invalid file request !");
				redirect("projectmanagement/pm_tasks/empl_project_tasks/".$project_id);
			}
		}
		// End of file validation check..

        $this->load->library('myupload');
		$file_attachment = $this->myupload->do_upload(
			'./application/modules/projectmanagement/assets/attachments/', 
			'file_attachment'

		);

        $data['task'] = (object)$postData = [

            'project_id' 	=> $project_info->project_id,
            'summary'  		=> $this->input->post('summary',TRUE),
            'description'   => $this->input->post('description',TRUE),
            'project_lead'  => $project_info->project_lead,
            'employee_id'   => $sess_data['employee_id'],
            'sprint_id'   	=> $this->input->post('sprint_id',TRUE),
            'priority'   	=> $this->input->post('priority',TRUE),
            'attachment'   	=> $file_attachment?$file_attachment:null,

        ]; 

        #-------------------------------#

        if ($this->form_validation->run() === true) {

        	if(!empty($postData['sprint_id'])){

				$postData['is_task'] = 1;

			}else{
				$postData['is_task'] = 0;
			}

        	if ($respo = $this->project_management_model->task_insert($postData)) {

        		#set success message
        		if($postData['is_task'] == 1){

        			$this->session->set_flashdata('message', "Saved successfully and transferrd to selected Sprint !");

        		}else{

        			$this->session->set_flashdata('message', display('save_successfully')." at project backlogs.");
        		} 

        	}else {

             $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect("projectmanagement/pm_tasks/empl_project_tasks/".$project_id);
        }

	}

	// For employee, can see all the tasks of a project he is assigned to..
	public function project_all_tasks($project_id = null){

		$sess_data = $this->session->userdata();

		// Check, if the request project_id is for the logged in employee/team_member..
		$project_tasks_check = $this->project_management_model->project_task_check_by_employee($project_id, $sess_data['employee_id']);

		if(!$project_tasks_check > 0){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}

		$data['all_tasks'] = $all_tasks = $this->project_management_model->project_tasks($project_id);

		$data['title'] = "Project Tasks";

		$data['module'] = "projectmanagement";
		$data['page']   = "employee_tasks/project_all_tasks";

		echo Modules::run('template/layout', $data); 

	}


	// update task as Project Lead
	public function employee_task_update($task_id = null){

		$this->permission->check_label('task')->update()->redirect();

		$sess_data = $this->session->userdata();
		$project_id = $sess_data['project_id'];

		$task_details = $this->project_management_model->task_details($task_id);

		// If anyone tries to change project_id from inspect element, then will catch exception here.
		if($task_details->project_id != $project_id){

			$this->session->set_flashdata('exception',"Invalid Request, Seems you already opened a project in another tab!");
			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}

		//Check if employee is assigned to this project or not..
		$assigned_project_employee_check = $this->project_management_model->assigned_project_employee_check($project_id, $sess_data['employee_id']);

		if(!$assigned_project_employee_check > 0){

			$this->session->set_flashdata('exception',"You are not assigned to this project anymore !");
			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}

		// Check, if the task_id is for the logged in employee/team member and existis in the pm_tasks_list for the employee/team member...
		$employee_task_check = $this->project_management_model->employee_task_check($task_id, $sess_data['employee_id']);

		if(!$employee_task_check || $sess_data['supervisor'] != 0){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("dashboard/home");
		}

		$this->form_validation->set_rules('summary',display('summary'),'required');
        $this->form_validation->set_rules('description',display('description'),'required');
        $this->form_validation->set_rules('priority',display('priority'),'required');

		#-------------------------------#

		// File type check and show message for invalid file..

        if(isset($_FILES['file_attachment']['name']) && !empty($_FILES['file_attachment']['name'])){

	        $path = $_FILES['file_attachment']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$is_valid_file = $this->file_type($ext);

			if(!$is_valid_file){

				$this->session->set_flashdata('exception', "Invalid file request !");
				redirect("projectmanagement/pm_tasks/empl_project_tasks/".$project_id);
			}
		}
		// End of file validation check..

        $this->load->library('myupload');
		$file_attachment = $this->myupload->do_upload(
			'./application/modules/projectmanagement/assets/attachments/', 
			'file_attachment'

		);

		$old_attachment = $this->input->post('old_attachment',TRUE);

        $data['task'] = (object)$postData = [

        	'task_id'  		=> $task_id,
            'sprint_id'   	=> $this->input->post('sprint_id',TRUE),
            'priority'   	=> $this->input->post('priority',TRUE),
            'task_status'   => $this->input->post('task_status',TRUE),
            'attachment'   	=> $file_attachment?$file_attachment:$old_attachment,

        ];

        #-------------------------------#

		if ($this->form_validation->run() === true) {

			if(!empty($postData['sprint_id'])){

				$postData['is_task'] = 1;

			}else{
				$postData['is_task'] = 0;
			}

        	if ($respo = $this->project_management_model->update_backlog_task($postData)) {

        		//// Updating project's completed_tasks
        		$tasks_completed_by_project = 0;

				$tasks_completed_by_project = $this->project_management_model->tasks_completed_by_project($task_details->project_id);

				// Update project completed_tasks...
				$project_data['project_id'] = $task_details->project_id;
				$project_data['complete_tasks'] = $tasks_completed_by_project;

				$update_project = $this->project_management_model->update_project($project_data);
				//// End of Updating project's completed_tasks

        		#set success message
               $this->session->set_flashdata('message', display('save_successfully'));

        	}else {

             $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect("projectmanagement/pm_tasks/empl_project_tasks/".$project_id);

		}else{
			if($task_id){
				
				$data['id'] = $task_id;

				// Verify, if this task is associated or not with the project_leader/Reporter..
	    		$valid_employee_task = $this->project_management_model->valid_employee_task_check($task_id,$project_id,$sess_data['employee_id']);

	    		if(!$valid_employee_task){

	    			$this->session->set_flashdata('exception', "You are not associated with this task !");
	    			redirect("projectmanagement/pm_tasks/empl_project_tasks/".$project_id);
	    		}

	    		// Sprint finished, still trying to access the task to update , then show exception that.. sprint sinished!!!
	    		$is_sprint_finished = $this->project_management_model->valid_sprint_check($valid_employee_task->sprint_id);

	    		if($is_sprint_finished){

	    			$this->session->set_flashdata('exception', "Sprint already finished !");
	    			redirect("projectmanagement/pm_tasks/empl_project_tasks/".$project_id);
	    		}

	    		$data['task_data'] = $task_data = $this->project_management_model->single_backlog_task_data($task_id);

	    		$data['project_info']  = $this->project_management_model->single_project_data($project_id);
				// this will use as reporter / project_lead, who will lead the project
				$data['project_leads'] = $this->project_management_model->supervisor_dropdown();
				// this will use as assignee / team_members, who will work on the project
				$data['team_members'] = $this->project_management_model->empdropdown();
				// available sprints for the project
				$data['available_sprints'] = $this->project_management_model->get_sprints($project_id);
			}

			$data['title'] = display('update').' '.display('task');

			$data['module'] = "projectmanagement";
			$data['page']   = "employee_tasks/employee_task_update";

			echo Modules::run('template/layout', $data); 

		}

	}

	// Sprints will show For employee/team member when login as employee / team member
	public function empl_project_sprints($project_id){

		$this->permission->check_label('sprint')->read()->redirect();

		$sess_data = $this->session->userdata();

		// Check, if the request project_id is for the logged in employee/team_member and existis in the pm_tasks_list for the employee_id...
		$project_employee_check = $this->project_management_model->project_employee_check($project_id, $sess_data['employee_id']);

		// If greater than 0 , means the employee/team_member is associated with the project..
		if(!$project_employee_check > 0){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/employee_projects/".$sess_data['employee_id']);
		}

		//store project_id to session for future use like kanban board..
		$sData['sprint_project_id'] = $project_id;
		$this->session->set_userdata($sData);
		$sess_data = $this->session->userdata();
		
		$data['sprint_lists']  = $this->project_management_model->all_sprints($project_id);

		$data['title'] = display('sprints');

		$data['module'] = "projectmanagement";
		$data['page']   = "employee_tasks/employee_sprints_list";

		echo Modules::run('template/layout', $data); 

	}

	// Get an employee/team_member own tasks by his/her project sprint
	public function empl_sprint_own_tasks($sprint_id = null){

		$sess_data = $this->session->userdata();
		$sprint_project_id = $sess_data['sprint_project_id'];
		$employee_id = $sess_data['employee_id'];

		// Check, if the request sprint_id is for the logged in employee/team_member..
		$sprint_tasks_by_employee = $this->project_management_model->sprint_tasks_by_employee($sprint_project_id, $employee_id, $sprint_id);

		if(!count($sprint_tasks_by_employee) > 0){

			$this->session->set_flashdata('exception',"You have no tasks for this sprint or you have opened a project in another tab !");
			redirect("projectmanagement/pm_tasks/empl_project_sprints/".$sprint_project_id);
		}

		// Check, if the request sprint is closed or open?..
		$single_sprint_data = $this->project_management_model->single_sprint_data($sprint_id);

		if($single_sprint_data->is_finished){

			$this->session->set_flashdata('exception',"Sprint is already closed !");
			redirect("projectmanagement/pm_tasks/empl_project_sprints/".$sprint_project_id);
		}

		$data['all_tasks'] = $all_tasks = $this->project_management_model->sprint_tasks_by_employee($sprint_project_id, $employee_id, $sprint_id);

		$data['sprint_id'] = $sprint_id;

		$data['title'] = "Sprint Tasks";

		$data['module'] = "projectmanagement";
		$data['page']   = "employee_tasks/employee_sprint_tasks";

		echo Modules::run('template/layout', $data); 

	}

	// kanban_board will show For project_lead when login as project_lead / supervisor
	public function employee_kanban_board($sprint_id){

		$sess_data = $this->session->userdata();
		$sprint_project_id = $sess_data['sprint_project_id'];
		$employee_id = $sess_data['employee_id'];

		// Check, if the request sprint_id is for the logged in employee/team_member..
		$sprint_tasks_by_employee = $this->project_management_model->sprint_tasks_by_employee($sprint_project_id, $employee_id, $sprint_id);

		if(!count($sprint_tasks_by_employee) > 0){

			$this->session->set_flashdata('exception',"You have no tasks for this sprintor you have opened a project in another tab !");
			redirect("projectmanagement/pm_tasks/empl_project_sprints/".$sprint_project_id);
		}

		// Task Status
		$data['statusResult']  =  $status_lists = array (
		   array("id" => 1,"status_name" => "To Do"),
		   array("id" => 2,"status_name" => "In Progress"),
		   array("id" => 3,"status_name" => "Done")
		);

		$data['employee_id'] = $employee_id;
		$data['project_id'] = $sprint_project_id;
		$data['sprint_id'] = $sprint_id;

		$data['title'] = display('kanban_board');

		$data['module'] = "projectmanagement";
		$data['page']   = "employee_tasks/employee_kanban_board";

		echo Modules::run('template/layout', $data);

	}

	// Get an sprint all tasks by employee/team_member to realise what tasks going on for the project sprint
	public function empl_sprint_all_tasks($sprint_id = null){

		$sess_data = $this->session->userdata();
		$sprint_project_id = $sess_data['sprint_project_id'];
		$employee_id = $sess_data['employee_id'];

		// Check, if the request sprint_id is for the logged in employee/team_member..
		$sprint_all_tasks = $this->project_management_model->sprint_all_tasks($sprint_project_id, $sprint_id);

		if(!count($sprint_all_tasks) > 0){

			$this->session->set_flashdata('exception',"No tasks available for this sprint !");
			redirect("projectmanagement/pm_tasks/empl_project_sprints/".$sprint_project_id);
		}

		$data['all_tasks'] = $all_tasks = $this->project_management_model->sprint_all_tasks($sprint_project_id, $sprint_id);

		$data['sprint_id'] = $sprint_id;

		$data['title'] = "Sprint Tasks";

		$data['module'] = "projectmanagement";
		$data['page']   = "employee_tasks/empl_sprint_all_tasks";

		echo Modules::run('template/layout', $data); 

	}

	// Only for admin user
	public function project_sprints($project_id = null){

		$sess_data = $this->session->userdata();

		if(!$sess_data['isAdmin']){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/manage_tasks/");
		}

		//store project_id to session for future use like kanban board..
		$sData['admin_sprint_project_id'] = $project_id;
		$this->session->set_userdata($sData);
		$sess_data = $this->session->userdata();

		$data['sprints_lists'] = $sprints_lists = $this->project_management_model->all_sprints($project_id);

		$data['title'] = display("sprints");

		$data['module'] = "projectmanagement";
		$data['page']   = "tasks/sprint_list";

		echo Modules::run('template/layout', $data); 

	}

	// Only for admin user
	public function sprint_tasks($sprint_id = null){

		$this->permission->check_label('task')->read()->redirect();

		$sess_data = $this->session->userdata();
		$admin_sprint_project_id = $sess_data['admin_sprint_project_id'];

		if(!$sess_data['isAdmin']){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/manage_tasks/");
		}

		// Check, if the request sprint_id is for the sprint_project...
		$sprint_check_by_project = $this->project_management_model->sprint_check_by_project($admin_sprint_project_id, $sprint_id);

		if(!$sprint_check_by_project){

			$this->session->set_flashdata('exception',"Invalid Request , if you open another project then please close that and reopen this project!");
			redirect("projectmanagement/pm_tasks/project_sprints/".$admin_sprint_project_id);
		}

		// Check if the sprint is finished or not, if finish then redirect and say that, sprint already finished
		$sprint_check_respo = $this->project_management_model->sprint_check($admin_sprint_project_id, $sprint_id);

		if(!$sprint_check_respo){

			$this->session->set_flashdata('exception',"Sprint already finished !");
			redirect("projectmanagement/pm_tasks/project_sprints/".$admin_sprint_project_id);
		}

		$data['sprint_id'] = $sprint_id;

		$data['sprints_tasks'] = $sprints_tasks = $this->project_management_model->sprint_tasks($sprint_id);

		$data['title'] = display("sprint")." ".display("task");

		$data['module'] = "projectmanagement";
		$data['page']   = "tasks/sprint_tasks";

		echo Modules::run('template/layout', $data); 

	}

	// Only for admin user
	public function project_tasks($project_id = null){

		$sess_data = $this->session->userdata();

		if(!$sess_data['isAdmin']){

			$this->session->set_flashdata('exception',"Invalid Request !");
			redirect("projectmanagement/pm_tasks/manage_tasks/");
		}

		$data['project_info']  = $project_info = $this->project_management_model->single_project_data($project_id);

		if($project_info->is_completed == 1){

			$this->session->set_flashdata('exception',"Project already closed !");
			redirect("projectmanagement/pm_tasks/project_tasks/".$project_id);
		}

		//store project_id to session for future use like kanban board..
		$sData['project_id'] = $project_id;
		$this->session->set_userdata($sData);
		$sess_data = $this->session->userdata();

		// this will use as reporter / project_lead, who will lead the project
		$data['project_leads'] = $this->project_management_model->supervisor_dropdown();
		// this will use as assignee / team_members, who will work on the project
		$data['team_members'] = $this->project_management_model->assigned_empdropdown($project_id);
		// available sprints for the project
		$data['available_sprints'] = $this->project_management_model->get_sprints($project_id);

		$data['project_tasks'] = $project_tasks = $this->project_management_model->project_tasks($project_id);

		$data['title'] = "Project Tasks";

		$data['module'] = "projectmanagement";
		$data['page']   = "tasks/project_tasks";

		echo Modules::run('template/layout', $data); 

	}

	/*
		File validation check
	*/
	public function file_type($type = ""){

		$file_types = ['jpg','jpeg','png','pdf','doc','docx'];

		if(in_array($type, $file_types)){

			return true;

		}else{

			return false;
		}
	}


}
