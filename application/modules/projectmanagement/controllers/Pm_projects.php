<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pm_projects extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'project_management_model',
			'dashboard/message_model',
			'country_model',
		));	

		if (! $this->session->userdata('isLogIn'))
		redirect('login');
	}

	/*clients list*/
	 public function projects(){

	 	$this->permission->check_label('projects')->read()->redirect();

	 	$sessData = $this->session->userdata();
	 	$isAdmin = $sessData['isAdmin'];
	 	$isSupervisor = $sessData['supervisor'];

	 	if($isSupervisor){

	 		$project_lead = $sessData['employee_id']; // if employee is supervisor, then he will be the project lead
	 		$data['project_lists']  = $this->project_management_model->project_manager_projects($project_lead);
	 		// this will use as reporter / project_lead, who will lead the project
			$data['project_leads'] = $this->project_management_model->project_manager_supervisor_dropdown($project_lead);
			//Get projects for version creation and backlogs task transfer
			$data['version_projects'] =$version_projects = $this->project_management_model->version_projects($project_lead);
	 	}

	 	if($isAdmin){

	 		$data['project_lists']  = $this->project_management_model->all_projects();
	 		// this will use as reporter / project_lead, who will lead the project
			$data['project_leads'] = $this->project_management_model->supervisor_dropdown();
	 	}

		$data['clients'] = $this->project_management_model->clientdropdown();
		$data['title'] = display('projects');
		$data['module'] = "projectmanagement";
		$data['page']   = "projects/project_list";

		echo Modules::run('template/layout', $data); 
	 }

	 // *********** This funciton will upload to server...
	 public function new_project(){

	 	$this->permission->check_label('projects')->create()->access();

	 	$sessData = $this->session->userdata();
	 	$isAdmin = $sessData['isAdmin'];
	 	$isSupervisor = $sessData['supervisor'];

	 	if($isSupervisor){

	 		$project_lead = $sessData['employee_id']; // if employee is supervisor, then he will be the project lead
	 		// this will use as reporter / project_lead, who will lead the project
			$data['project_leads'] = $this->project_management_model->project_manager_supervisor_dropdown($project_lead);
			//Get projects for version creation and backlogs task transfer
			$data['version_projects'] =$version_projects = $this->project_management_model->version_projects($project_lead);
	 	}

	 	if($isAdmin){

	 		// this will use as reporter / project_lead, who will lead the project
			$data['project_leads'] = $this->project_management_model->supervisor_dropdown();
	 	}

	 	$data['country_list'] = $this->country_model->state();
	 	// this will use as assignee / team_members, who will work on the project
		$data['team_members'] = $this->project_management_model->team_members();
		$data['clients'] = $this->project_management_model->clientdropdown();
		$data['title'] = display('projects');
		$data['module'] = "projectmanagement";
		$data['page']   = "projects/create_project";

		echo Modules::run('template/layout', $data);

	 }

	 // *********** This funciton will upload to server...
	 public function get_client_info(){

	 	// Client name or email
	 	$postData = $this->input->post('client',TRUE);

	 	//Fetch cient details using the name or email
	 	$where = '(client_name="'.$postData.'" or email = "'.$postData.'")';

	 	$result = $this->db->select('*') 
             ->from('pm_clients')
             ->where($where)
             ->get()
        	 ->row();

        if($result){

        	$data['client'] = "<span class='text-success'>".$result->client_name."</span>";
	 		$data['client_id'] = $result->client_id;

        }else{

        	$data['client'] = "<span class='text-danger'>Invalid Client</span>";
        	$data['client_id'] = null;
        }

	 	echo json_encode($data);

	 }

	// *********** This funciton will upload to server...
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

				$clientId = $this->db->insert_id();

				$data['client'] = $this->input->post('client_name',TRUE);
				$data['client_id_no'] = $clientId;
				$data['status'] = true;
				$data['message'] = display('save_successfully');

				// Activity Log Insert
				$description = "Created new client ".$data['client'].".";
				$this->project_management_model->activity_log_insert($description);

			}else {

				$data['status'] = false;
                $data['exception'] = display('please_try_again');
			}

		}else{

			$data['status'] = false;
            $data['exception'] = validation_errors();

		}

		echo json_encode($data);

	}

	 public function create_project(){

	 	$this->permission->check_label('projects')->create()->access();

        $this->form_validation->set_rules('client_id',display('client_name'),'required');
        $this->form_validation->set_rules('project_lead',display('project_lead'),'required');
        $this->form_validation->set_rules('approximate_tasks',display('approximate_tasks'),'required');
        $this->form_validation->set_rules('summary',display('summary'),'required');
        $this->form_validation->set_rules('project_start_date',display('starting_date'),'required');
        $this->form_validation->set_rules('project_duration',display('project_duration'),'required');
        $this->form_validation->set_rules('project_reward_point',display('reward_points'),'required');

        #-------------------------------#

        // Validation check, if project exists with the same name, must add something postfix like version(ex: v1).

        $project_name = $this->input->post('project_name',TRUE);
        $prohect_details = $this->project_management_model->single_project_by_name($project_name);

        if($prohect_details){

        	$this->session->set_flashdata('exception', "Project name must be unique, similar project exists with the name ".$project_name);
        	redirect("projectmanagement/pm_projects/projects");
        }
        if(empty($this->input->post('team_members',TRUE))){
        	$this->form_validation->set_rules('team_members',display('team_members'),'required');
        }
        // End of validation check

        // Previous version project handling, also keeping record of previous version for the new created project.

        $previous_version = $project_id = $this->input->post('previous_version',TRUE);

        $first_parent_project_id  = 0;
        $second_parent_project_id = 0;
        $version_no   			  = 1;

        if($previous_version){

        	$previous_version_details = $this->project_management_model->single_project_data($project_id);

        	if($previous_version_details->is_completed != 1){

        		$this->session->set_flashdata('exception', "Then selected previous version project must be completed !");
        		redirect("projectmanagement/pm_projects/projects");

        	}else{

        		// if not selected the first version of any project , then the selected project_id will be the second_parent_project_id and first_parent_project_id of the selected project will be the first_parent_project_id of new project.
        		if($previous_version_details->first_parent_project_id > 0){

        			$version_count = $this->project_management_model->version_counts($previous_version_details->first_parent_project_id);


		            $first_parent_project_id  = $previous_version_details->first_parent_project_id;
		            $second_parent_project_id = $previous_version_details->project_id;
		            $version_no   			  = (int)$version_count + 1;

        		}else{

        			// if selected the first version of any project , then the selected project_id will be taken for the first_parent_project_id and second_parent_project_id for new version of the newly created project.
        			$version_count = $this->project_management_model->version_counts($previous_version_details->project_id);

			        $first_parent_project_id  = $previous_version_details->project_id;
		            $second_parent_project_id = $previous_version_details->project_id;
		            $version_no   			  = (int)$version_count + 1;

        		}
        	}
        }

        // End of Previous version project handling

        $data['project'] = (object)$postData = [

            'project_name' 				=> $this->input->post('project_name',TRUE),
            'client_id'  				=> $this->input->post('client_id',TRUE),
            'project_lead'   			=> $this->input->post('project_lead',TRUE),
            'approximate_tasks' 		=> $this->input->post('approximate_tasks',TRUE),
            'project_summary' 			=> $this->input->post('summary',TRUE),
            'project_start_date' 		=> $this->input->post('project_start_date',TRUE),
            'project_duration'  		=> $this->input->post('project_duration',TRUE),
            'project_reward_point' 		=> $this->input->post('project_reward_point',TRUE),
            'first_parent_project_id'   => $first_parent_project_id,
            'second_parent_project_id' 	=> $second_parent_project_id,
            'version_no'  				=> $version_no,

        ];

         #-------------------------------#
        if ($this->form_validation->run() === true) {

        	if ($respo = $this->project_management_model->project_insert($postData)) {

        		$new_project_id = $this->db->insert_id();

        		$this->project_management_model->team_members_insert($this->input->post('team_members',TRUE),$new_project_id);

        		// Activity Log Insert
				$description = "Created new project ".$postData['project_name']." where project id is ".$new_project_id;
				$this->project_management_model->activity_log_insert($description);

        		#set success message
               $this->session->set_flashdata('message', display('save_successfully'));
        	}else {

             $this->session->set_flashdata('exception', display('please_try_again'));
            }
            
        }else {

         	$this->session->set_flashdata('exception', validation_errors());
        }
        redirect("projectmanagement/pm_projects/projects");

	 }

	/*manage_clients list*/
	public function manage_projects(){

		$this->permission->check_label('projects')->read()->redirect();

		$sessData = $this->session->userdata();
	 	$isAdmin = $sessData['isAdmin'];
	 	$isSupervisor = $sessData['supervisor'];

	 	if($isSupervisor){

	 		$project_lead = $sessData['employee_id'];
	 		$data['project_lists']  = $this->project_management_model->project_manager_projects($project_lead);
	 	}

	 	if($isAdmin){

	 		$data['project_lists']  = $this->project_management_model->all_projects();
	 	}

		$data['title'] = display('manage_projects');
		$data['module'] = "projectmanagement";
		$data['page']   = "projects/manage_projects";

		echo Modules::run('template/layout', $data); 
	}

	//Update Quotation data
	public function project_update($id = null){

		// Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

		$sessData = $this->session->userdata();
    	$isAdmin = $sessData['isAdmin'];
    	$superVisor = $sessData['supervisor'];
    	$project_manager = $sessData['employee_id']; // Projecr manager / Project Lead / Supervisor id 
    	$project_id = $id;

    	$data['project_data']  = $project_info = $this->project_management_model->single_project_data($project_id);

		$this->permission->check_label('projects')->update()->redirect();

		$data['title'] = display('update_project');

        
        $this->form_validation->set_rules('client_id',display('client_name'),'required');
        $this->form_validation->set_rules('project_lead',display('project_lead'),'required');
        $this->form_validation->set_rules('approximate_tasks',display('approximate_tasks'),'required');
        $this->form_validation->set_rules('project_start_date',display('starting_date'),'required');
        $this->form_validation->set_rules('summary',display('summary'),'required');
        $this->form_validation->set_rules('project_reward_point',display('reward_points'),'required');

        $this->form_validation->set_rules('project_duration',display('project_duration'),'required');

        // validation check
	    if($this->input->post('project_name',TRUE) != $this->input->post('old_project_name',TRUE)){

	    	$this->form_validation->set_rules('project_name',display('project_name'),'required|is_unique[pm_projects.project_name]');
	    }
		if(empty($this->input->post('team_members',TRUE))){
        	$this->form_validation->set_rules('team_members',display('team_members'),'required');
        }
        // End of validation check

	     #-------------------------------#

	    $project_lead = $this->input->post('project_lead',TRUE);
	    $project_status = $this->input->post('is_completed',TRUE);

	    $data['project'] = (object)$postData = [

	    	'project_id'			=> $project_id,
	        'project_name' 			=> $this->input->post('project_name',TRUE),
	        'client_id'  			=> $this->input->post('client_id',TRUE),
	        'project_lead'   		=> $project_lead,
	        'approximate_tasks'		=> $this->input->post('approximate_tasks',TRUE),
	        'project_summary'   	=> $this->input->post('summary',TRUE),
	        'project_start_date'  	=> $this->input->post('project_start_date',TRUE),
	        'project_duration'  	=> $this->input->post('project_duration',TRUE),
	        'project_reward_point' 	=> $this->input->post('project_reward_point',TRUE),
	        'is_completed'  		=> $project_status == 1?$project_status:0,
	        'close_date'  			=> $project_status == 1?date("Y-m-d"):null,

	    ];

	     #-------------------------------#
	    if($this->form_validation->run() === true) {

	    	if($project_info->is_completed == 1){

	    		$this->session->set_flashdata('exception', "This project is already closed !");
			    redirect("projectmanagement/pm_projects/manage_projects");
	    	}

	    	// if project_status is 1 , means requesting for closing the project.
	    	if($project_status == 1){
	    		
	    		// Check if sprint finished/closed or not
	    		$sprint_not_finished = $this->project_management_model->sprint_not_finished($project_id);
	    		
	    		if($sprint_not_finished){

	    			$this->session->set_flashdata('exception', $sprint_not_finished->sprint_name." is not closed yet, please close the sprint first.");
			        redirect("projectmanagement/pm_projects/manage_projects");
	    		}

	    		//when closing project, then also count all_tasks as approximate_tasks, completed_tasks and update the project in database.
	    		$all_tasks_by_project = 0;
	    		$tasks_completed_by_project = 0;
	    		
	    		$all_tasks_by_project = $this->project_management_model->all_tasks_by_project($project_id);
	    		$tasks_completed_by_project = $this->project_management_model->tasks_completed_by_project($project_id);

				$postData['approximate_tasks'] 	= $all_tasks_by_project;
				$postData['complete_tasks'] 	= $tasks_completed_by_project;
	    	}

	    	//if there already associated sprints or tasks  with the project, then not allow to update Project Manager/Project Lead.. 
	    	$project_sprints_count = 0;
	    	$project_associated_tasks = 0;

	    	if($project_lead != $project_info->project_lead){

	    		$project_sprints_count = $this->project_management_model->project_sprints_count($project_id);
	    		$project_associated_tasks = $this->project_management_model->project_associated_tasks($project_id);

	    		if($project_sprints_count > 0 || $project_associated_tasks > 0){

		    		$this->session->set_flashdata('exception', "Can't update Project Lead, as this project already associated with sprint and tasks !");
				    redirect("projectmanagement/pm_projects/manage_projects");
		    	}
	    	}

	    	// Checking if project_id available, then finally updating project info.
	    	if(!empty($project_id)){

	    		$this->permission->check_label('projects')->update()->redirect();

		        if ($this->project_management_model->update_project($postData)) {

		        	// Updating team_members in pm_employee_projects table
		        	$this->project_management_model->team_members_insert($this->input->post('team_members',TRUE),$project_id);

		        	// Sharing reward point to all employees of the project.. when closing the project
		        	if($project_status == 1){

			        	$project_all_employees = $this->project_management_model->project_all_employees($project_id);
			        	$respo = $this->project_management_model->share_reward_to_employees($project_id,$project_all_employees);
					}

					// Activity Log Insert
					$description = "Updated project ".$postData['project_name']." where project id is ".$project_id;
					$this->project_management_model->activity_log_insert($description);
		           
		           #set success message
		           $this->session->set_flashdata('message', display('save_successfully'));

		        }else {

		         $this->session->set_flashdata('exception', display('please_try_again'));
		        }
		        redirect("projectmanagement/pm_projects/manage_projects");
	    	}

	    }else{

	    	if(validation_errors()){

	    		$this->session->set_flashdata('exception', validation_errors());
	    		redirect("projectmanagement/pm_projects/manage_projects");
	    	}

	    	if($id){

	    		$data['id'] = $id;

	    		// if project_sprints_open is true/1 , means close_open dropdown can be shown to send request for closing the project.
	    		$data['project_sprints_count'] = $project_sprints_count = $this->project_management_model->project_sprints_count($project_id);

	    		// Check if not Admin, then if any project_manager request for another project_manager project.. redirect and say Invalid Request.
				if(!$isAdmin && $superVisor){

					$project_lead_check = $this->project_management_model->project_lead_check($project_id, $project_manager);
					if(!$project_lead_check){

						$this->session->set_flashdata('exception', "Invalid Request");
			        	redirect("projectmanagement/pm_projects/manage_projects");
					}
				}

	    	}
	    	
	    	// this will use as reporter / project_lead, who will lead the project
	    	if(!$isAdmin && $superVisor){

				$data['project_leads'] = $this->project_management_model->project_manager_supervisor_dropdown($project_manager);
	    	}
	    	if($isAdmin){

		 		$data['project_leads'] = $this->project_management_model->supervisor_dropdown();
		 	}

		 	$data['country_list'] = $this->country_model->state();
			$data['clientinfo'] = $this->project_management_model->clientinfo($project_info->client_id);
			// this will use as assignee / team_members, who will work on the project
			$data['team_members'] = $this->project_management_model->team_members();
			$data['existing_team_members']  = $this->project_management_model->existing_team_members($project_id);

			$data['module'] = "projectmanagement";
			$data['page']   = "projects/project_update";


			echo Modules::run('template/layout', $data); 
		}
	}

	public function delete_project($id = null){

		$this->permission->check_label('projects')->delete()->redirect();

		// Check if this project is associated with any sprints/tasks
		$project_sprints_count = $this->project_management_model->project_sprints_count($id);
	    $project_associated_tasks = $this->project_management_model->project_associated_tasks($id);

	    if($project_sprints_count > 0 || $project_associated_tasks > 0){

	    	$this->session->set_flashdata('exception', "Can't be deleted, as the project already associated with sprints or tasks !");
	    	redirect("projectmanagement/pm_projects/manage_projects");
	    }

	    // Here starts the condition to delete the project.
		if ($this->project_management_model->project_delete($id)) {

			 // Delete all the employees for the project from pm_employee_projects table..
			 $this->db->where('project_id', $id)->delete("pm_employee_projects");

			 // Activity Log Insert
			$description = "Deleted project where project id was ".$id;
			$this->project_management_model->activity_log_insert($description);

			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {

			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect("projectmanagement/pm_projects/manage_projects");
	}
	
	/*
		Backlogs starts
	*/

	public function get_backlogs(){

		$project_id = $this->input->get('project_id',TRUE);

		//store project_id to session for backlogs 
		$sData['project_id'] = $project_id;
		$this->session->set_userdata($sData);

		$sess_data = $this->session->userdata();
		echo json_encode($sess_data);
		

	}

	// This will handle the backlogs task which will create under a project and will be transferred to task_lists for that specific project 
	public function backlogs(){

		$sess_data = $this->session->userdata();
		$project_id = $sess_data['project_id'];

        if(!$sess_data['isAdmin']){

			// Checking if supervisor or not... otherwise not allow to enter backlogs page..
			if(!$sess_data['supervisor']){

				$this->session->set_flashdata('exception', "You are not allowed to access this page !");
				redirect("projectmanagement/pm_projects/manage_projects");

			}else{

				// Be sure if anyone request form inspect with project_id, and that project_id is related with the session supervisor/project_lead
				$project_lead = $sess_data['employee_id'];
				$respo_project = $this->project_management_model->verify_project($project_id,$project_lead);

				if(!$respo_project){

					$this->session->set_flashdata('exception', "You are not authorized user of this project !");
					redirect("projectmanagement/pm_projects/manage_projects");
				}
				
			}

		}

		$data['project_info'] = $project_info = $this->project_management_model->single_project_data($project_id);

		// Check previous project backlogs, if available then keep open 'Get Retros' button open. 
		$previous_project_backlogs = 0;
		if($project_info->second_parent_project_id > 0){

			$previous_project_backlogs = $this->project_management_model->total_previous_project_backlogs($project_info->second_parent_project_id);
		}

		$data['previous_project_backlogs'] = $previous_project_backlogs;

		// Ebd of check previous project backlogs
		
		$data['backlog_lists']  = $this->project_management_model->all_backlogs($project_id);

		// this will use as reporter / project_lead, who will lead the project
		$data['project_leads'] = $this->project_management_model->supervisor_dropdown();
		// this will use as assignee / team_members, who will work on the project
		$data['team_members'] = $this->project_management_model->assigned_empdropdown($project_id);
		// available sprints for the project
		$data['available_sprints'] = $this->project_management_model->get_sprints($project_id);

		$data['title'] = display('backlogs');

		$data['module'] = "projectmanagement";
		$data['page']   = "backlogs/backlog_tasks_list";

		echo Modules::run('template/layout', $data); 

	}

	public function create_task($req_project_id){

		$this->permission->check_label('task')->create()->redirect();

		$sess_data = $this->session->userdata();
		$project_id = $sess_data['project_id'];

		// If anyone tries to change project_id from inspect element, then will catch exception here.
		if($req_project_id != $project_id){

			$this->session->set_flashdata('exception',"Invalid Request , You have already opened a project in another tab!");

			redirect("projectmanagement/pm_projects/backlogs");
			
		}

		$project_info = $this->project_management_model->single_project_data($project_id);

		//Total tasks for an individual project is over then not allow to create any further task for the project
		$project_all_backlogs_tasks  = $this->project_management_model->project_all_backlogs_tasks($project_id);
		if($project_all_backlogs_tasks >= $project_info->approximate_tasks){

			$this->session->set_flashdata('exception',"Sorry, yuor approximate tasks limit is over !");

			redirect("projectmanagement/pm_projects/backlogs");
		}
        
        $this->form_validation->set_rules('summary',display('summary'),'required');
        $this->form_validation->set_rules('description',display('description'),'required');
        $this->form_validation->set_rules('employee_id',display('assignee'),'required');
        $this->form_validation->set_rules('priority',display('priority'),'required');

        #-------------------------------#

        // File type check and show message for invalid file..

        if(isset($_FILES['file_attachment']['name']) && !empty($_FILES['file_attachment']['name'])){

	        $path = $_FILES['file_attachment']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$is_valid_file = $this->file_type($ext);

			if(!$is_valid_file){

				$this->session->set_flashdata('exception', "Invalid file request !");
				redirect("projectmanagement/pm_projects/backlogs");
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
					$description = "New task created from backlogs named as ".$postData['summary']." where project id is ".$project_info->project_id;
					$this->project_management_model->activity_log_insert($description);

        			$this->session->set_flashdata('message', "Saved successfully and transferrd to selected Sprint !");

        		}else{

        			// Activity Log Insert
					$description = "New backlog created named as ".$postData['summary']." where project id is ".$project_info->project_id;
					$this->project_management_model->activity_log_insert($description);

        			$this->session->set_flashdata('message', display('save_successfully'));
        		} 

        	}else {

             $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect("projectmanagement/pm_projects/backlogs");
        }

	}

	// This will handle the backlogs task which will create under a project and will be transferred to task_lists for that specific project 
	public function manage_backlogs(){

		$sess_data = $this->session->userdata();
		$project_id = $sess_data['project_id'];

		
		$data['backlog_lists']  = $this->project_management_model->all_backlogs($project_id);

		$data['title'] = display('manage_backlogs');

		$data['module'] = "projectmanagement";
		$data['page']   = "backlogs/manage_backlog_tasks";

		echo Modules::run('template/layout', $data); 

	}

	public function backlog_task_update($id = null){
		
		$this->permission->check_label('task')->update()->redirect();

		$sess_data = $this->session->userdata();
		$project_id = $sess_data['project_id'];

		// Verify, if this task is associated or not with the project_leader/Reporter..
		$valid_backlog_task = $this->project_management_model->valid_backlog_task($id,$project_id);

		if(!$valid_backlog_task){

			$this->session->set_flashdata('exception', "You are not associated with this task , you have opened a project in another tab!");
			redirect("projectmanagement/pm_projects/manage_backlogs");
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
				redirect("projectmanagement/pm_projects/manage_backlogs");
			}
		}
		// End of file validation check..

        $this->load->library('myupload');
		$file_attachment = $this->myupload->do_upload(
			'./application/modules/projectmanagement/assets/attachments/', 
			'file_attachment'

		);

		$old_attachment = $this->input->post('old_attachment',TRUE);
		$sprint_id = $this->input->post('sprint_id',TRUE);

        $data['task'] = (object)$postData = [

        	'task_id'  		=> $id,
            'summary'  		=> $this->input->post('summary',TRUE),
            'description'   => $this->input->post('description',TRUE),
            'employee_id'   => $this->input->post('employee_id',TRUE),
            'sprint_id'   	=>$sprint_id?$sprint_id:null,
            'priority'   	=> $this->input->post('priority',TRUE),
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

        		#set success message
        		if($postData['is_task'] == 1){

        			// Activity Log Insert
					$description = "Task updated from backlogs named as ".$postData['summary']." where project id is ".$project_id;
					$this->project_management_model->activity_log_insert($description);

        			$this->session->set_flashdata('message', "Saved succesfully and transferrd to selected Sprint !");

        		}else{

        			// Activity Log Insert
					$description = "Backlog updated named as ".$postData['summary']." where project id is ".$project_id;
					$this->project_management_model->activity_log_insert($description);

        			$this->session->set_flashdata('message', display('save_successfully'));
        		}  

        	}else{

             	$this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect("projectmanagement/pm_projects/manage_backlogs");
        }else{

        	if($id){

	    		$data['id'] = $id;

	    		$data['backlog_task_data'] = $backlog_task_data = $this->project_management_model->single_backlog_task_data($id);

	    		$data['project_info']  = $this->project_management_model->single_project_data($backlog_task_data->project_id);
				// this will use as reporter / project_lead, who will lead the project
				$data['project_leads'] = $this->project_management_model->supervisor_dropdown();
				// this will use as assignee / team_members, who will work on the project
				$data['team_members'] = $this->project_management_model->assigned_empdropdown($backlog_task_data->project_id);
				// available sprints for the project
				$data['available_sprints'] = $this->project_management_model->get_sprints($backlog_task_data->project_id);
	    	}

	    	$data['title'] = display('update').' '.display('backlogs');

			$data['module'] = "projectmanagement";
			$data['page']   = "backlogs/update_backlog_task";

			echo Modules::run('template/layout', $data); 
        }
	}

	public function delete_backlog_task($id = null){

		$this->permission->check_label('task')->delete()->redirect();

		if($this->project_management_model->backlog_task_delete($id)){

			// Activity Log Insert
			$description = "Backlog task deleted where task id is ".$id;
			$this->project_management_model->activity_log_insert($description);

			$this->session->set_flashdata('message', display('delete_successfully'));

		}else{

			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect("projectmanagement/pm_projects/manage_backlogs");

	}

	/*
		Backlogs ends
	*/

	/*
		Sprints starts
	*/

	public function get_sprints(){

		$project_id = $this->input->get('project_id',TRUE);

		//store sprint_project_id to session for sprints
		$sData['sprint_project_id'] = $project_id;
		$this->session->set_userdata($sData);

		$sess_data = $this->session->userdata();
		echo json_encode($sess_data);
		

	}

	// This will handle the sprints which will create under a project and one sprint will be active at a time 
	public function sprints(){

		$this->permission->check_label('sprint')->read()->redirect();

		$sess_data = $this->session->userdata();
		$sprint_project_id = $sess_data['sprint_project_id'];
		
		$data['sprint_lists']  = $this->project_management_model->all_sprints($sprint_project_id);

		$total_sprint = $this->project_management_model->project_sprints_count($sprint_project_id);
		$data['sprint_no']  = "Sprint-".strval($total_sprint + 1);

		$data['project_info']  = $this->project_management_model->single_project_data($sprint_project_id);

		$data['title'] = display('sprints');

		$data['module'] = "projectmanagement";
		$data['page']   = "sprints/sprint_list";


		echo Modules::run('template/layout', $data); 

	}

	public function create_sprint($req_project_id){

		// Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

		$this->permission->check_label('sprint')->create()->redirect();

		$sess_data = $this->session->userdata();
		$sprint_project_id = $sess_data['sprint_project_id'];

		// If anyone tries to change project_id from inspect element, then will catch exception here.
		if($sprint_project_id != $req_project_id){

			$this->session->set_flashdata('exception',"Invalid Request , You have already opened a project in another tab!");

			redirect("projectmanagement/pm_projects/sprints");
			
		}
        
        $this->form_validation->set_rules('sprint_name',display('sprint_name'),'required');
        $this->form_validation->set_rules('duration',display('duration'),'required');
        $this->form_validation->set_rules('start_date',display('start_date'),'required');
        $this->form_validation->set_rules('sprint_goal',display('sprint_goal'),'required');

        #-------------------------------#

        $project_id = $sprint_project_id;
        $sprint_name = $this->input->post('sprint_name',TRUE);
        $start_date = $this->input->post('start_date',TRUE);
        $duration = $this->input->post('duration',TRUE);

        $data['sprint'] = (object)$postData = [
            'project_id' 	=> $project_id,
            'sprint_name'  	=> $sprint_name,
            'duration'   	=> $duration,
            'start_date'  	=> $start_date,
            'sprint_goal'   => $this->input->post('sprint_goal',TRUE),

        ];

        #-------------------------------#

        if ($this->form_validation->run() === true) {


        	// Validation after form submit when creating Sprint for any project..
        	$exception = false;

        	$project_info  = $this->project_management_model->single_project_data($project_id);
        	$days_spend_for_sprints  = $this->project_management_model->days_spend_for_sprint($project_id);
        	$duplicate_sprint_check = $this->project_management_model->duplicate_sprint_check($project_id,$sprint_name);
        	$sprint_not_finished = $this->project_management_model->sprint_not_finished($project_id);

        	$remain_project_days = $project_info->project_duration - $days_spend_for_sprints;
        	$total_sprint_days = $days_spend_for_sprints + $duration;

        	if($total_sprint_days > $project_info->project_duration){

        		$this->session->set_flashdata('exception', $remain_project_days." days remaining for this project, so can't set more than this for a sprint !");
        		$exception = true;

        	}elseif($sprint_not_finished){

        		$this->session->set_flashdata('exception', $sprint_not_finished->sprint_name." is not finished yet !");
        		$exception = true;

        	}elseif($duplicate_sprint_check){

        		$this->session->set_flashdata('exception', $sprint_name." already exists for this project.");
        		$exception = true;

        	}elseif(strtotime($start_date) < strtotime(date("Y-m-d"))){

        		$this->session->set_flashdata('exception', "Start Date must be current date or greater.");
        		$exception = true;

        	}elseif($duration > 14 || $duration <= 0){

        		$this->session->set_flashdata('exception', "Sprint duration must in 1-14 days.");
        		$exception = true;
        	}

        	if($exception){
        		redirect("projectmanagement/pm_projects/sprints");
        	}

        	if ($respo = $this->project_management_model->sprint_insert($postData)) {

        		// Update the project start date.. if this is the first sprint(when sprint_nums is 1) of the project..
        		$sprint_nums  = $this->project_management_model->sprint_nums($project_id);
        		if($sprint_nums == 1){

        			 $data['project'] = (object)$updateData = [
			            'project_id' 	=> $project_id,
			            'start_date'  	=> $start_date,
			        ];

        			$respo_project_up = $this->project_management_model->update_project_start_date($updateData);

        			// Activity Log Insert
					$description = "New sprint created named as ".$postData['sprint_name']." where project id is ".$project_id;
					$this->project_management_model->activity_log_insert($description);

        		}

        		#set success message
               $this->session->set_flashdata('message', display('save_successfully'));

        	}else {

             $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect("projectmanagement/pm_projects/sprints");
        }else{

        	if(validation_errors()){

        		$this->session->set_flashdata('exception', validation_errors());
        		redirect("projectmanagement/pm_projects/sprints");
        	}
        }

	}

	// This will handle the sprints which will create under a project and one sprint will be active at a time 
	public function manage_sprints(){

		$this->permission->check_label('sprint')->read()->redirect();

		$sess_data = $this->session->userdata();
		$sprint_project_id = $sess_data['sprint_project_id'];
		
		$data['sprint_lists']  = $this->project_management_model->all_sprints($sprint_project_id);

		$data['title'] = display('manage_sprints');

		$data['module'] = "projectmanagement";
		$data['page']   = "sprints/manage_sprints";

		echo Modules::run('template/layout', $data); 

	}

	public function sprint_update($id = null){

		// Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

		$this->permission->check_label('sprint')->create()->redirect();

		// Get session data for the sprint
		$sess_data = $this->session->userdata();

	 	$isSupervisor = $sess_data['supervisor'];
		$project_lead = $sess_data['employee_id'];

		$project_id = $sess_data['sprint_project_id'];
		$old_sprint_name = $sess_data['old_sprint_name'];
        $old_start_date = $sess_data['old_start_date'];
        $sprint_id = $sess_data['sprint_id'];

        $current_sprint_data = $this->project_management_model->single_sprint_data($id);

        if($current_sprint_data->project_id != $project_id){

        	$this->session->set_flashdata('exception',"Invalid Request , You have already opened a project in another tab!");

			redirect("projectmanagement/pm_projects/sprints");
        }
        
        $this->form_validation->set_rules('sprint_name',display('sprint_name'),'required');
        $this->form_validation->set_rules('duration',display('duration'),'required');
        $this->form_validation->set_rules('start_date',display('start_date'),'required');
        $this->form_validation->set_rules('sprint_goal',display('sprint_goal'),'required');

        #-------------------------------#

        $sprint_name = $this->input->post('sprint_name',TRUE);
        $start_date = $this->input->post('start_date',TRUE);
        $duration = $this->input->post('duration',TRUE);
        $is_finished = $this->input->post('sprint_status',TRUE);
   
        $data['sprint'] = (object)$postData = [
        	'sprint_id' 	=> $sprint_id,
            'project_id' 	=> $project_id,
            'sprint_name'  	=> $sprint_name,
            'duration'   	=> $duration,
            'start_date'  	=> $start_date,
            'sprint_goal'   => $this->input->post('sprint_goal',TRUE),
            'is_finished'  	=> $this->input->post('sprint_status',TRUE)?$this->input->post('sprint_status',TRUE):0,

        ];

        #-------------------------------#

        if ($this->form_validation->run() === true) {

        	// Validation after form submit when creating Sprint for any project..
        	$exception = false;

        	$project_info  = $this->project_management_model->single_project_data($project_id);
        	$days_spend_for_sprints  = $this->project_management_model->days_spend_for_sprint($project_id);
        	$duplicate_sprint_check = $this->project_management_model->duplicate_sprint_check($project_id,$sprint_name);

        	$remain_project_days = $project_info->project_duration - $days_spend_for_sprints;
        	$total_sprint_days = $days_spend_for_sprints + $duration;

        	if($total_sprint_days > $project_info->project_duration){

        		$this->session->set_flashdata('exception', $remain_project_days." days remaining for this project, so can't set more than this for a sprint !");
        		$exception = true;

        	}elseif($sprint_name != $old_sprint_name){

        		if($duplicate_sprint_check){

        			$this->session->set_flashdata('exception', $sprint_name." already exists for this project.");
        			$exception = true;
        		}

        	}elseif($start_date != $old_start_date){

        		if(strtotime($start_date) < strtotime(date("Y-m-d"))){

        			$this->session->set_flashdata('exception', "Start Date must be current date or greater.");
        			$exception = true;
        		}

        	}elseif($duration > 14 || $duration <= 0){

        		$this->session->set_flashdata('exception', "Sprint duration must be 1-14 days.");
        		$exception = true;
        	}

        	if($exception){
        		redirect("projectmanagement/pm_projects/manage_sprints");
        	}

        	if ($respo = $this->project_management_model->update_sprint($postData)) {

        		// Update the project start date.. if this is the first sprint of the project..
        		$data['project'] = (object)$updateData = [
		            'project_id' 	=> $project_id,
		            'start_date'  	=> $start_date,
		        ];

        		// get the first_sprint_id of the project
				$first_sprint_by_project = $this->project_management_model->first_sprint_by_project($project_id);

				// Check if this is the first sprint
				if($sprint_id == $first_sprint_by_project->first_sprint_id){

		        	// update_project_start_date, if the first sprint is updated
        			$respo_project_up = $this->project_management_model->update_project_start_date($updateData);
				}

				// Also, take all undone tasks of the sprint to backlogs of the sprint project and also update project completed_tasks.

	        	if($is_finished){

	        		$undone_tasks = $this->project_management_model->sprint_undone_tasks($project_id , $sprint_id);

	        		foreach ($undone_tasks as $tasks) {
	        			$task_details = $this->project_management_model->task_details($tasks->task_id);

	        			$taskData = [
	        				'task_id' 		=> $task_details->task_id,
				        	'sprint_id' 	=> null,
				            'is_task' 		=> 0,
				            'task_status' 	=> 1,

				        ];

				        $task_update_respo = $this->project_management_model->update_backlog_task($taskData);

	        		}

	        		// Update Project completed_tasks after updating the sprint as closed and transfer remaining tasks to backlogs.
	        		$tasks_completed_by_project = 0;
	        		$tasks_completed_by_project = $this->project_management_model->tasks_completed_by_project($project_id);

					// Update project completed_tasks...
					$project_data['project_id'] = $project_id;
					$project_data['complete_tasks'] = $tasks_completed_by_project;

					$update_project = $this->project_management_model->update_project($project_data);
					// End of Updating project's completed_tasks
	        	}

	        	// Activity Log Insert
				$description = $postData['sprint_name']." is updated where project id is ".$project_id;
				$this->project_management_model->activity_log_insert($description);

        		#set success message
                $this->session->set_flashdata('message', display('save_successfully'));

        	}else {

             $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect("projectmanagement/pm_projects/manage_sprints");

        }else{

        	if($id){
	    		$data['id'] = $id;
	    		$data['sprint_data']  = $sprint_data = $this->project_management_model->single_sprint_data($id);
	    		$data['project_info']  = $this->project_management_model->single_project_data($sprint_data->project_id);
	    		// if close_open is true , means close_open dropdow can be shown to send request for closing a sprint.
	    		$data['close_open'] = $this->project_management_model->sprint_close_open($sprint_data->project_id, $id);

	    		if($sprint_data->is_finished){

	    			$this->session->set_flashdata('exception', $sprint_data->sprint_name." is already finished !");
	    			redirect("projectmanagement/pm_projects/manage_sprints");
	    		}else{

	    			//store sprint_data to session for sprints , so that when updating the sprint, no dulicate data allowed
					$sData['sprint_id'] = $sprint_data->sprint_id;
					$sData['old_sprint_name'] = $sprint_data->sprint_name;
					$sData['old_start_date'] = $sprint_data->start_date;
					$this->session->set_userdata($sData);
	    		}

	    		// Check if the sprint belongs to the supervisor / project_lead's project who is logged in the application.
	    		if($isSupervisor){

	    			$verify_project = $this->project_management_model->verify_project($sprint_data->project_id, $project_lead);
	    			
	    			if(!$verify_project){

	    				$this->session->set_flashdata('exception', "You are not associated with this sprint !");
	    				redirect("projectmanagement/pm_projects/manage_sprints");

	    			}
	    		}

	    	}

	    	$data['title'] = display("sprint");
			$data['module'] = "projectmanagement";
			$data['page']   = "sprints/sprint_update";

			echo Modules::run('template/layout', $data); 
        }

	}

	// This function calling through ajax and returning response
	public function get_sprint_undone_tasks(){

		$sess_data = $this->session->userdata();

		$project_id = $sess_data['sprint_project_id'];
        $sprint_id = $sess_data['sprint_id'];

        $to_do_tasks = 0;
        $in_progress_tasks = 0;
        $done_tasks = 0;

        $to_do_tasks = $this->project_management_model->sprint_to_do_tasks($project_id , $sprint_id);
        $in_progress_tasks = $this->project_management_model->sprint_in_progress_tasks($project_id , $sprint_id);
        $done_tasks = $this->project_management_model->sprint_done_tasks($project_id , $sprint_id);

        $respo_data['to_do_tasks'] = $to_do_tasks;
        $respo_data['in_progress_tasks'] = $in_progress_tasks;
        $respo_data['done_tasks'] = $done_tasks;

		echo json_encode($respo_data);
	}

	public function delete_sprint($id = null){

		$this->permission->check_label('sprint')->delete()->redirect();

		$exception = false;
		$is_first_sprint = false;

		$sprint_data = $this->project_management_model->single_sprint_data($id);
		$sprint_asscociate_task = $this->project_management_model->sprint_asscociate_task($sprint_data);

		// If sprint is already finished, then not allow to delete the sprint...
		if($sprint_data->is_finished){

			$this->session->set_flashdata('exception', $sprint_data->sprint_name." is already finished !");
			$exception = true;

		}elseif($sprint_asscociate_task >= 1){

			// If sprint is associated with any task, then also not allow to delete the sprint...

			$this->session->set_flashdata('exception', " Tasks are already associated with".$sprint_data->sprint_name);
			$exception = true;
		}

		if($exception){
			redirect("projectmanagement/pm_projects/manage_sprints");
		}

		// Check if this sprint is the first sprint_id($id) of the project, which is trying to delete
		$first_sprint_respo = $this->project_management_model->first_sprint_by_project($sprint_data->project_id);

		if($first_sprint_respo->first_sprint_id == $id){

			$is_first_sprint = true;
		}

		// Check, the sprint to be deleted is the only sprint of any project.
		$sprint_nums  = $this->project_management_model->sprint_nums($sprint_data->project_id);
		if($sprint_nums == 1){

			// updateData.. as this is the first sprint data of the project now..
    		$data['project'] = (object)$updateData = [
	            'project_id' 	=> $sprint_data->project_id,
	            'start_date'  	=> null,
	        ];
		}


		// 	now delete the sprint after check all the possible validation...
		if($this->project_management_model->sprint_delete($id)){

			// Check if this sprint project has many other sprints, then if this was the first sprint, need to update project start_date by finding the first sprint
			
			if($is_first_sprint == true && $sprint_nums > 0){

				// if delete first sprint, then get the first_sprint_id where will get the first sprint data also
				$first_sprint_by_project = $this->project_management_model->first_sprint_by_project($sprint_data->project_id);
				$first_sprint_data = $this->project_management_model->single_sprint_data($first_sprint_by_project->first_sprint_id);

				// updateData.. as this is the first sprint data of the project now..
        		$data['project'] = (object)$updateData = [
		            'project_id' 	=> $sprint_data->project_id,
		            'start_date'  	=> $first_sprint_data->start_date,
		        ];

        		// update_project_start_date with the new first_sprint_id
        		$respo_project_up = $this->project_management_model->update_project_start_date($updateData);

			}else{
				
				// update_project_start_date with the new first_sprint_id
        		$respo_project_up = $this->project_management_model->update_project_start_date($updateData);
			}

			// Activity Log Insert
			$description = "Sprint ".$sprint_data->sprint_name." is deleted where project id is ".$sprint_data->project_id;
			$this->project_management_model->activity_log_insert($description);

			$this->session->set_flashdata('message', display('delete_successfully'));

		}else{

			$this->session->set_flashdata('exception', display('please_try_again'));
		}

		redirect("projectmanagement/pm_projects/manage_sprints");

	}

	public function transfer_sprint_tasks($sprint_id = null){

		// Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

		// Get session data for the sprint
		$sess_data = $this->session->userdata();
		$project_id = $sess_data['sprint_project_id'];

		$data['project_info'] = $project_info  = $this->project_management_model->single_project_data($project_id);

		$data['sprint_info'] = $sprint_info  = $this->project_management_model->sprint_check($project_id,$sprint_id);

		// Check valid sprint for the project, if anyone request by invalid sprint_id.. show invalid request...
		if(!$sprint_info){

			$this->session->set_flashdata('exception', "Invalid Request, you have already opened a project in another tab!");
			redirect("projectmanagement/pm_projects/manage_sprints");
		}

		#-------------------------------#

		$this->form_validation->set_rules('project_id',display('project_name'),'required');

		$sprint_tasks = $this->input->post('sprint_tasks');

		#-------------------------------#

	    if ($this->form_validation->run() === true) {

	    	$sprint_tasks_transfer_status = false;

    		foreach ($sprint_tasks as $key => $value) {

    			$task_id = $value;

    			//Sprint task check, if valid or not(it will happen if anyone try to take input from inspect element for sprint_tasks[] value)
				$sprint_task_check = $this->project_management_model->sprint_task_check($project_id,$sprint_id,$task_id);

				if($sprint_task_check){
    			
	    			$sprintTaskData = [
	    				'task_id'  		=> $task_id,
			            'sprint_id' 	=> null,
			            'is_task'  		=> 0,
			        ];

			        // Updating Task for the above data in pm_task_list table to move it again in backlogs..
	    			$respo = $this->project_management_model->update_task_from_sprints($sprintTaskData);
	    			if($respo){
	    				
	    				$sprint_tasks_transfer_status = true;
	    			}

    			}

    		}

    		// if sprint tasks update successfully, then redirect to sprint transfer task with success message..
    		if ($sprint_tasks_transfer_status){

				$employee_info  = $this->project_management_model->employee_info($project_info->project_lead);
				$user_details  = $this->project_management_model->user_details($employee_info->email);

				//Check open task for a sprint in pm_task_list table...
				$finished_sprint_tasks  = $this->project_management_model->finished_sprint_tasks($project_id,$sprint_id);
				$total_sprint_tasks  = $this->project_management_model->total_sprint_tasks($project_id,$sprint_id);

				$message = "";

				if($finished_sprint_tasks == $total_sprint_tasks){ 
					$message = "Tasks are transferred successfully from  ".$sprint_info->sprint_name." to backlogs of ".$project_info->project_name." , as you don't have any open task remaining for the sprint. So please close the sprint.";
				}else{
					$message = "Tasks are transferred successfully from  ".$sprint_info->sprint_name." to backlogs of ".$project_info->project_name." , please check your backlogs.";
				}

				// Notification message for closing sprint, if there not any tasks... if still there tasks for any sprint then it will continue.
				$data['message'] = (object)$notificaitonData = array(
		            'sender_id'   => 1,
		            'receiver_id' => $user_details->id,
		            'subject'     => $sprint_info->sprint_name.", Task Transfer of ".$project_info->project_name.".",
		            'message'     => $message,
		            'datetime'    => date("Y-m-d h:i:s"),
		            'sender_status'   => 1, 
		            'receiver_status' => 0, 
		        );

		        if ($this->message_model->create($notificaitonData)) {

		            #set success message
	           		$this->session->set_flashdata('message', "Transferred to backlogs successfully !");
		        } else {
		            #set exception message
		            $this->session->set_flashdata('exception', display('please_try_again'));
		        } 

	        }else {

	         $this->session->set_flashdata('exception', display('please_try_again'));
	        }
	        redirect("projectmanagement/pm_projects/transfer_sprint_tasks/".$sprint_id);


	    }else{

	    	$data['id'] = $sprint_id;

	    	// Get all tasks for the sprint where task_status = 0 means it's not 'In progress' or 'Done'.
			$data['sprint_tasks'] = $this->project_management_model->all_sprints_tasks($sprint_id, $project_id);

			$data['title'] = display("transfer_to_backlogs");

			$data['module'] = "projectmanagement";
			$data['page']   = "sprints/transfer_tasks";

			echo Modules::run('template/layout', $data);
	    }

	}

	/*
		Sprints ends
	*/

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
