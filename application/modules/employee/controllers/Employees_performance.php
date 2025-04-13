<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_performance extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'Employees_model',
			'Country_model',
			'Employee_performance_model',
			
		));

		if (!$this->session->userdata('isLogIn')){
			redirect('login');
		}

	}

	public function paerformance_sub_category_view()
	{   

		$this->permission->check_label('emp_performance')->read()->access();

		$data['title']           = display('perform_sub_category');
		$data['perform_sub_categories']  = $this->Employee_performance_model->paerformance_sub_categories();
		$data['module']   		 = "employee";
		$data['page']     		 = "emp_performance/list";   


		echo Modules::run('template/layout', $data); 
	} 

	public function create_performance_sub_category()
	{ 
		$this->permission->module('performance_category','create')->redirect();

		$data['title'] = display('perform_sub_category');
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


			if ($this->Employee_performance_model->create_paerformance_sub_category($postData)) { 
				$this->session->set_flashdata('message', display('successfully_saved'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}

		} else {
			$this->session->set_flashdata('exception',  validation_errors());
			
		} 

		redirect("employee/employees_performance/paerformance_sub_category_view");  
	}

	public function manage_performance_sub_category()
	{   
		$this->permission->module('performance_category','read')->redirect();

		$data['title']           		 = display('manage_sub_category');
		$data['perform_sub_categories']  = $this->Employee_performance_model->paerformance_sub_categories();
		$data['module']   		 		 = "employee";
		$data['page']     		 		 = "emp_performance/manage_performance_subcategory";   

		echo Modules::run('template/layout', $data); 
	}

	public function update_performance_sub_category($id = null){

		$this->permission->module('performance_category','update')->redirect();

		$data['title'] = display('update_sub_category');

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
			
			if ($this->Employee_performance_model->update_paerformance_sub_category($postData)) { 
				$this->session->set_flashdata('message', display('successfully_updated'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("employee/employees_performance/manage_performance_sub_category");  

		} else {

			$data['data']=$this->Employee_performance_model->paerformance_sub_category_by_id($id);
			$data['module'] = "employee";
			$data['page']   = "emp_performance/update_performance_subcategory";

			echo Modules::run('template/layout', $data); 
		}

	}

	public function delete_performance_sub_category($id = null) 
	{ 
		$this->permission->module('performance_category','delete')->redirect();

		if ($this->Employee_performance_model->paerformance_sub_category_delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("employee/employees_performance/manage_performance_sub_category");  
	}





	/*Points giving starts*/

	public function category_performance_view()
	{   
		$this->permission->module('category_wise_performance','read')->redirect();

		$data['title']           			 = display('category_wise_performance');
		$data['category_wise_performances']  = $this->Employee_performance_model->category_wise_performances();
		$data['employee']      			     = $this->Employees_model->employee();
		$data['paerform_sub_category_list']  = $this->Employee_performance_model->paerform_sub_category_list();
		$data['module']   		 			 = "employee";
		$data['page']     		 			 = "emp_performance/emp_cat_perform_list";   

		echo Modules::run('template/layout', $data); 
	} 

	public function add_performance_by_sub_category()
	{ 
		$this->permission->module('category_wise_performance','create')->redirect();

		$data['title'] = display('category_wise_performance');
		#-------------------------------#
		$this->form_validation->set_rules('employee_id',display('employee_name'),'required');
		$this->form_validation->set_rules('sub_cat_id',display('sub_category')  ,'required');
		$this->form_validation->set_rules('points',display('point')  ,'required');
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$postData = [
				'employee_id' => $this->input->post('employee_id',true),
				'sub_cat_id'  => $this->input->post('sub_cat_id',true),
				'points' 	  => $this->input->post('points',true),
			];  

			$postData['CreateDate'] = date('Y-m-d');
			$postData['CreateBy'] = $this->session->userdata('id');

			// Check point already given for any specific category to an employee, then not allow to create same..
			$paerform_by_sub_category_and_empid = $this->Employee_performance_model->paerform_by_sub_category_and_empid($postData['employee_id'],$postData['sub_cat_id']);
			if($paerform_by_sub_category_and_empid){

				$this->session->set_flashdata('exception',  "Point given to the employee for the selected category for current month !");
				redirect("employee/employees_performance/category_performance_view"); 
			}


			if ($this->Employee_performance_model->performance_by_sub_category($postData)) { 
				$this->session->set_flashdata('message', display('successfully_saved'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}

		} else {
			$this->session->set_flashdata('exception',  validation_errors());
			
		} 

		redirect("employee/employees_performance/category_performance_view"); 
	}

	public function manage_category_wise_performance_view()
	{   
		$this->permission->module('category_wise_performance','read')->redirect();

		$data['title']           		     = display('manage_category_wise_performance');
		$data['category_wise_performances']  = $this->Employee_performance_model->category_wise_performances();
		$data['module']   		 			 = "employee";
		$data['page']     		 		     = "emp_performance/manage_category_wise_performance";   


		echo Modules::run('template/layout', $data); 
	}

	public function update_category_wise_performance($id = null){

		$this->permission->module('category_wise_performance','update')->redirect();

		$data['data'] = $category_wise_performance_info =$this->Employee_performance_model->category_wise_performances_by_id($id);

		$data['title'] = display('update_category_wise_performance');

		$this->form_validation->set_rules('id',null,'required|max_length[11]');

		$this->form_validation->set_rules('points',display('point')  ,'required');

		#-------------------------------#

		if ($this->form_validation->run() === true) {

			$postData = [
				'id' 	  => $this->input->post('id',true),
				'points' 	  => $this->input->post('points',true),
				
			]; 

			$postData['UpdateDate'] = date('Y-m-d');
			$postData['UpdateBy'] = $this->session->userdata('id');

			// Check, if the update request exceeds the existing record(which going tp update) creation month and year comparing with current date...
			$exsting_record_create_year  = date('Y',strtotime($category_wise_performance_info->CreateDate));
			$exsting_record_create_month = date('m',strtotime($category_wise_performance_info->CreateDate));

			if((int)$exsting_record_create_year == (int)date('Y') && (int)$exsting_record_create_month == (int)date('m')){


				if ($this->Employee_performance_model->up_category_wise_performance($postData)) { 
					$this->session->set_flashdata('message', display('successfully_updated'));
				} else {
					$this->session->set_flashdata('exception',  display('please_try_again'));
				}

			}else{

				$this->session->set_flashdata('exception',  "You can not update old performace record !");
			}

			redirect("employee/employees_performance/manage_category_wise_performance_view"); 

		} else {

			$data['employee']      			     = $this->Employees_model->employee();
			$data['paerform_sub_category_list']  = $this->Employee_performance_model->paerform_sub_category_list();
			$data['module'] = "employee";
			$data['page']   = "emp_performance/update_category_wise_performance";

			echo Modules::run('template/layout', $data); 
		}

	}

	public function delete_category_wise_performance($id = null) 
	{ 
		$this->permission->module('category_wise_performance','delete')->redirect();

		if ($this->Employee_performance_model->category_wise_performance_delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("employee/employees_performance/manage_category_wise_performance_view");  
	}

	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	/* Employee performance as per Gambia client Appraisal shared file*/

	public function emp_performance_list()
	{   
		// $this->permission->module('emp_performance','read')->redirect();
		$this->permission->check_label('emp_performance')->read()->access();

		$data['title']            = display('emp_performance');
		$data['emp_performances'] = $this->Employee_performance_model->emp_performance_appraisal_list();
		$data['module']   		  = "employee";
		$data['page']     		  = "emp_perform_appraisal/list";   


		echo Modules::run('template/layout', $data); 
	}


	public function add_employee_performance()
	{   
		// $this->permission->module('emp_performance','create')->redirect();
		$this->permission->check_label('emp_performance')->create()->access();

		$data['title']       = display('emp_performance');
		$data['employee']    = $this->Employees_model->employee();
		$data['module']      = "employee";
		$data['page']        = "emp_perform_appraisal/add_employee_performance";   


		echo Modules::run('template/layout', $data); 
	}

	public function save_employee_performance()
	{

		$this->permission->check_label('emp_performance')->create()->access();


		$data['title'] = display('emp_performance');
		#-------------------------------#
		$this->form_validation->set_rules('employee_id',display('employee_name'),'required');
		$this->form_validation->set_rules('review_period',display('review_period')  ,'required');
		$this->form_validation->set_rules('employee_comments',display('employee_comments')  ,'max_length[500]');
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$recommand_areas    = $this->input->post('recommand_areas',true);
			$expected_outcomes  = $this->input->post('expected_outcomes',true);
			$responsible_person = $this->input->post('responsible_person',true);
			$start_date         = $this->input->post('start_date',true);
			$end_date           = $this->input->post('end_date',true);

			$key_goals 			= $this->input->post('key_goals',true);
			$completion_period  = $this->input->post('completion_period',true);

			$demonstrated_score = (int)$this->input->post('demonstrated_score',true);
			$timeliness_score   = (int)$this->input->post('timeliness_score',true);
			$impact_score       = (int)$this->input->post('impact_score',true);
			$overall_score      = (int)$this->input->post('overall_score',true);
			$beyond_duty        = (int)$this->input->post('beyond_duty',true);

			$interpersonal= (int)$this->input->post('interpersonal_score',true);
			$attendance   = (int)$this->input->post('attendance_score',true);
			$communication= (int)$this->input->post('communication_score',true);
			$contributing = (int)$this->input->post('contributing_score',true);

			$assesment_a_score = $demonstrated_score + $timeliness_score + $impact_score + $overall_score + $beyond_duty;
			$assesment_b_score = $interpersonal + $attendance + $communication + $contributing;
			$assesment_score = 0;
			$assesment_score = $assesment_a_score + $assesment_b_score;

			$postData = [
				'employee_id'    		 => $this->input->post('employee_id',true),
				'review_period'  		 => $this->input->post('review_period',true),
				'position_of_supervisor' => $this->input->post('position_of_supervisor',true),
				'total_scores' 			 => $assesment_score,
				'employee_comments' 	 => $this->input->post('employee_comments',true),
			];  

			$postData['date']        = date('Y-m-d');
			$postData['create_date'] = date('Y-m-d');
			$postData['create_by']   = $this->session->userdata('id');
			// Performance Serial key generate
			$time = strtotime("now");
			$postData['perform_sl']  = 'SL'.$time.rand(0,1000).$this->input->post('employee_id',true);

			$emp_per_id  = $this->Employee_performance_model->create_emp_paerformance($postData);

			if($emp_per_id ){ 

				/*Assesment_a data*/
				$postData_a_demonstrated = [
					'emp_per_id'    		   => $emp_per_id,
					'emp_perform_type_id'  	   => 1,
					'emp_perform_criteria_id'  => 1,
					'emp_perform_eval' 		   => (int)$this->input->post('demonstrated',true),
					'score' 		           => (int)$this->input->post('demonstrated_score',true),
					'comments' 		           => $this->input->post('demonstrated_comments',true),
				]; 
				$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

				$postData_a_demonstrated = [
					'emp_per_id'    		   => $emp_per_id,
					'emp_perform_type_id'  	   => 1,
					'emp_perform_criteria_id'  => 2,
					'emp_perform_eval' 		   => (int)$this->input->post('timeliness',true),
					'score' 		           => (int)$this->input->post('timeliness_score',true),
					'comments' 		           => $this->input->post('timeliness_score_commnets',true),
				]; 
				$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

				$postData_a_demonstrated = [
					'emp_per_id'    		   => $emp_per_id,
					'emp_perform_type_id'  	   => 1,
					'emp_perform_criteria_id'  => 3,
					'emp_perform_eval' 		   => (int)$this->input->post('impact',true),
					'score' 		           => (int)$this->input->post('impact_score',true),
					'comments' 		           => $this->input->post('impact_score_commnets',true),
				]; 
				$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

				$postData_a_demonstrated = [
					'emp_per_id'    		   => $emp_per_id,
					'emp_perform_type_id'  	   => 1,
					'emp_perform_criteria_id'  => 4,
					'emp_perform_eval' 		   => (int)$this->input->post('overall',true),
					'score' 		           => (int)$this->input->post('overall_score',true),
					'comments' 		           => $this->input->post('overall_score_commnets',true),
				]; 
				$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

				$postData_a_demonstrated = [
					'emp_per_id'    		   => $emp_per_id,
					'emp_perform_type_id'  	   => 1,
					'emp_perform_criteria_id'  => 5,
					'emp_perform_eval' 		   => (int)$this->input->post('beyond_duty',true),
					'score' 		           => (int)$this->input->post('beyond_duty',true),
					'comments' 		           => $this->input->post('beyond_duty_commnets',true),
				]; 
				$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);



				/*Assesment_b data*/
				$postData_a_demonstrated = [
					'emp_per_id'    		   => $emp_per_id,
					'emp_perform_type_id'  	   => 2,
					'emp_perform_criteria_id'  => 6,
					'emp_perform_eval' 		   => (int)$this->input->post('interpersonal',true),
					'score' 		           => (int)$this->input->post('interpersonal_score',true),
					'comments' 		           => $this->input->post('interpersonal_commnets',true),
				]; 
				$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

				$postData_a_demonstrated = [
					'emp_per_id'    		   => $emp_per_id,
					'emp_perform_type_id'  	   => 2,
					'emp_perform_criteria_id'  => 7,
					'emp_perform_eval' 		   => (int)$this->input->post('attendance',true),
					'score' 		           => (int)$this->input->post('attendance_score',true),
					'comments' 		           => $this->input->post('attendance_commnets',true),
				]; 
				$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

				$postData_a_demonstrated = [
					'emp_per_id'    		   => $emp_per_id,
					'emp_perform_type_id'  	   => 2,
					'emp_perform_criteria_id'  => 8,
					'emp_perform_eval' 		   => (int)$this->input->post('communication',true),
					'score' 		           => (int)$this->input->post('communication_score',true),
					'comments' 		           => $this->input->post('communication_commnets',true),
				]; 
				$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

				$postData_a_demonstrated = [
					'emp_per_id'    		   => $emp_per_id,
					'emp_perform_type_id'  	   => 2,
					'emp_perform_criteria_id'  => 9,
					'emp_perform_eval' 		   => (int)$this->input->post('contributing',true),
					'score' 		           => (int)$this->input->post('contributing_score',true),
					'comments' 		           => $this->input->post('contributing_commnets',true),
				]; 
				$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

				// Insert E. DEVELOPMENT PLAN data into database
				for ($i=0; $i < count($recommand_areas); $i++) {
					$development_plan = [
						'recommand_areas'    => $recommand_areas[$i],
						'expected_outcomes'  => isset($expected_outcomes[$i])?$expected_outcomes[$i]:'',
						'responsible_person' => isset($responsible_person[$i])?$responsible_person[$i]:'',
						'start_date' 	     => (isset($start_date[$i]) && !empty($start_date[$i]))?$start_date[$i]:null,
						'end_date' 	         => (isset($end_date[$i]) && !empty($end_date[$i]))?$end_date[$i]:null,
						'emp_per_id' 	     => $emp_per_id,
					];
					if(!empty($recommand_areas[$i])){
						$this->db->insert('gmb_perform_development_plan', $development_plan);
					}
				}

				// Insert F. KEY GOALS FOR NEXT REVIEW PERIOD
				for ($i=0; $i < count($key_goals); $i++) {
					$key_goals_data = [
						'key_goals'         => $key_goals[$i],
						'completion_period' => (isset($completion_period[$i]) && !empty($completion_period[$i]))?$completion_period[$i]:null,
						'emp_per_id' 	    => $emp_per_id,
					];
					if(!empty($key_goals[$i])){
						$this->db->insert('gmb_perform_key_goals', $key_goals_data);
					}
				}

				// Activity Logs
				addActivityLog("employee_performance", "create", $emp_per_id , "employee_performance", 1, $postData);

				$this->session->set_flashdata('message', display('successfully_saved'));
			} else {

				$this->session->set_flashdata('exception',  display('please_try_again'));
			}

		} else {
			$this->session->set_flashdata('exception',  validation_errors());
			
		} 

		redirect("employee/employees_performance/emp_performance_list");

	}

	public function employee_performance_update($id){

		$this->permission->check_label('emp_performance')->update()->access();

		$data['title']                = display('emp_performance');
		$data['employee']             = $this->Employees_model->employee();
		$employee_performance = $this->Employee_performance_model->employee_performance_by_id($id);

		$data['setting'] = $this->db->get('setting')->row();

		// Get all performance criteria data
		$data['id'] = $id;
		$data['employee_id'] = $employee_performance->employee_id;
		$data['perform_sl'] = $employee_performance->perform_sl;
		$data['review_period'] = $employee_performance->review_period;
		$data['position_of_supervisor'] = $employee_performance->position_of_supervisor;
		$data['employee_comments'] = $employee_performance->employee_comments;

		$assesment_a_total_score = 0;
		$assesment_b_total_score = 0;

		$employee_performance = $this->Employee_performance_model->employee_performance_criteria_values($id,1);
		foreach ($employee_performance as $key => $value) {
			if((int)$value->emp_perform_criteria_id == 1){
				$data['demonstrated']          = $value->emp_perform_eval;
				$data['demonstrated_score']    = $value->score;
				$data['demonstrated_comments'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 2){
				$data['timeliness']                = $value->emp_perform_eval;
				$data['timeliness_score']          = $value->score;
				$data['timeliness_score_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 3){
				$data['impact']                = $value->emp_perform_eval;
				$data['impact_score']          = $value->score;
				$data['impact_score_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 4){
				$data['overall']                = $value->emp_perform_eval;
				$data['overall_score']          = $value->score;
				$data['overall_score_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 5){
				$data['beyond_duty']          = $value->score;
				$data['beyond_duty_commnets'] = $value->comments;
			}

			$assesment_a_total_score = $assesment_a_total_score + (int)$value->score;
		}
		$data['assesment_a_total_score'] = $assesment_a_total_score;

		$employee_performance = $this->Employee_performance_model->employee_performance_criteria_values($id,2);
		foreach ($employee_performance as $key => $value) {
			if((int)$value->emp_perform_criteria_id == 6){
				$data['interpersonal']          = $value->emp_perform_eval;
				$data['interpersonal_score']    = $value->score;
				$data['interpersonal_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 7){
				$data['attendance']                = $value->emp_perform_eval;
				$data['attendance_score']          = $value->score;
				$data['attendance_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 8){
				$data['communication']                = $value->emp_perform_eval;
				$data['communication_score']          = $value->score;
				$data['communication_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 9){
				$data['contributing']                = $value->emp_perform_eval;
				$data['contributing_score']          = $value->score;
				$data['contributing_commnets'] = $value->comments;
			}
			$assesment_b_total_score = $assesment_b_total_score + (int)$value->score;
		}
		$data['assesment_b_total_score'] = $assesment_b_total_score;
		$data['score_final'] = $assesment_a_total_score + $assesment_b_total_score;

		$data['development_plans'] = $this->Employee_performance_model->development_plans($id);
		$data['data_key_goals']    = $this->Employee_performance_model->key_goals_data($id);

		$data['module']               = "employee";
		$data['page']                 = "emp_perform_appraisal/update_employee_performance";   

		echo Modules::run('template/layout', $data); 

	}

	public function save_updated_employee_performance($id){

		$this->permission->check_label('emp_performance')->update()->access();

		$data['title'] = display('emp_performance');
		#-------------------------------#
		$this->form_validation->set_rules('employee_id',display('employee_name'),'required');
		$this->form_validation->set_rules('review_period',display('review_period')  ,'required');
		$this->form_validation->set_rules('employee_comments',display('employee_comments')  ,'max_length[500]');
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$recommand_areas    = $this->input->post('recommand_areas',true);
			$expected_outcomes  = $this->input->post('expected_outcomes',true);
			$responsible_person = $this->input->post('responsible_person',true);
			$start_date         = $this->input->post('start_date',true);
			$end_date           = $this->input->post('end_date',true);

			$key_goals 			= $this->input->post('key_goals',true);
			$completion_period  = $this->input->post('completion_period',true);

			$demonstrated_score = (int)$this->input->post('demonstrated_score',true);
			$timeliness_score   = (int)$this->input->post('timeliness_score',true);
			$impact_score       = (int)$this->input->post('impact_score',true);
			$overall_score      = (int)$this->input->post('overall_score',true);
			$beyond_duty        = (int)$this->input->post('beyond_duty',true);

			$interpersonal= (int)$this->input->post('interpersonal_score',true);
			$attendance   = (int)$this->input->post('attendance_score',true);
			$communication= (int)$this->input->post('communication_score',true);
			$contributing = (int)$this->input->post('contributing_score',true);

			$assesment_a_score = $demonstrated_score + $timeliness_score + $impact_score + $overall_score + $beyond_duty;
			$assesment_b_score = $interpersonal + $attendance + $communication + $contributing;
			$assesment_score = 0;
			$assesment_score = $assesment_a_score + $assesment_b_score;

			$postData = [
				'emp_per_id'    		 => $id,
				'employee_id'    		 => $this->input->post('employee_id',true),
				'review_period'  		 => $this->input->post('review_period',true),
				'position_of_supervisor' => $this->input->post('position_of_supervisor',true),
				'total_scores' 			 => $assesment_score,
				'employee_comments' 	 => $this->input->post('employee_comments',true),
			];  

			$postData['date']        = date('Y-m-d');
			$postData['create_date'] = date('Y-m-d');
			$postData['create_by']   = $this->session->userdata('id');


			$update_respo  = $this->Employee_performance_model->update_emp_paerformance($postData);

			if($update_respo){ 

				$respo_all_delete = $this->Employee_performance_model->delete_all_performance_criteria_values($id);

				if($respo_all_delete){

					$emp_per_id = $id;

					/*Assesment_a data*/
					$postData_a_demonstrated = [
						'emp_per_id'    		   => $emp_per_id,
						'emp_perform_type_id'  	   => 1,
						'emp_perform_criteria_id'  => 1,
						'emp_perform_eval' 		   => (int)$this->input->post('demonstrated',true),
						'score' 		           => (int)$this->input->post('demonstrated_score',true),
						'comments' 		           => $this->input->post('demonstrated_comments',true),
					]; 
					$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

					$postData_a_demonstrated = [
						'emp_per_id'    		   => $emp_per_id,
						'emp_perform_type_id'  	   => 1,
						'emp_perform_criteria_id'  => 2,
						'emp_perform_eval' 		   => (int)$this->input->post('timeliness',true),
						'score' 		           => (int)$this->input->post('timeliness_score',true),
						'comments' 		           => $this->input->post('timeliness_score_commnets',true),
					]; 
					$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

					$postData_a_demonstrated = [
						'emp_per_id'    		   => $emp_per_id,
						'emp_perform_type_id'  	   => 1,
						'emp_perform_criteria_id'  => 3,
						'emp_perform_eval' 		   => (int)$this->input->post('impact',true),
						'score' 		           => (int)$this->input->post('impact_score',true),
						'comments' 		           => $this->input->post('impact_score_commnets',true),
					]; 
					$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

					$postData_a_demonstrated = [
						'emp_per_id'    		   => $emp_per_id,
						'emp_perform_type_id'  	   => 1,
						'emp_perform_criteria_id'  => 4,
						'emp_perform_eval' 		   => (int)$this->input->post('overall',true),
						'score' 		           => (int)$this->input->post('overall_score',true),
						'comments' 		           => $this->input->post('overall_score_commnets',true),
					]; 
					$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

					$postData_a_demonstrated = [
						'emp_per_id'    		   => $emp_per_id,
						'emp_perform_type_id'  	   => 1,
						'emp_perform_criteria_id'  => 5,
						'emp_perform_eval' 		   => (int)$this->input->post('beyond_duty',true),
						'score' 		           => (int)$this->input->post('beyond_duty',true),
						'comments' 		           => $this->input->post('beyond_duty_commnets',true),
					]; 
					$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);



					/*Assesment_b data*/
					$postData_a_demonstrated = [
						'emp_per_id'    		   => $emp_per_id,
						'emp_perform_type_id'  	   => 2,
						'emp_perform_criteria_id'  => 6,
						'emp_perform_eval' 		   => (int)$this->input->post('interpersonal',true),
						'score' 		           => (int)$this->input->post('interpersonal_score',true),
						'comments' 		           => $this->input->post('interpersonal_commnets',true),
					]; 
					$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

					$postData_a_demonstrated = [
						'emp_per_id'    		   => $emp_per_id,
						'emp_perform_type_id'  	   => 2,
						'emp_perform_criteria_id'  => 7,
						'emp_perform_eval' 		   => (int)$this->input->post('attendance',true),
						'score' 		           => (int)$this->input->post('attendance_score',true),
						'comments' 		           => $this->input->post('attendance_commnets',true),
					]; 
					$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

					$postData_a_demonstrated = [
						'emp_per_id'    		   => $emp_per_id,
						'emp_perform_type_id'  	   => 2,
						'emp_perform_criteria_id'  => 8,
						'emp_perform_eval' 		   => (int)$this->input->post('communication',true),
						'score' 		           => (int)$this->input->post('communication_score',true),
						'comments' 		           => $this->input->post('communication_commnets',true),
					]; 
					$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

					$postData_a_demonstrated = [
						'emp_per_id'    		   => $emp_per_id,
						'emp_perform_type_id'  	   => 2,
						'emp_perform_criteria_id'  => 9,
						'emp_perform_eval' 		   => (int)$this->input->post('contributing',true),
						'score' 		           => (int)$this->input->post('contributing_score',true),
						'comments' 		           => $this->input->post('contributing_commnets',true),
					]; 
					$this->db->insert('gmb_emp_perform_values', $postData_a_demonstrated);

				}

				// Insert E. DEVELOPMENT PLAN data into database
				$respo_dev_plan_delete = $this->Employee_performance_model->delete_all_performance_dev_plan($emp_per_id);

				if($respo_dev_plan_delete){

					for ($i=0; $i < count($recommand_areas); $i++) {
						$development_plan = [
							'recommand_areas'    => $recommand_areas[$i],
							'expected_outcomes'  => isset($expected_outcomes[$i])?$expected_outcomes[$i]:'',
							'responsible_person' => isset($responsible_person[$i])?$responsible_person[$i]:'',
							'start_date' 	     => (isset($start_date[$i]) && !empty($start_date[$i]))?$start_date[$i]:null,
							'end_date' 	         => (isset($end_date[$i]) && !empty($end_date[$i]))?$end_date[$i]:null,
							'emp_per_id' 	     => $emp_per_id,
						];
						if(!empty($recommand_areas[$i])){
							$this->db->insert('gmb_perform_development_plan', $development_plan);
						}
					}
				}

				// Insert F. KEY GOALS FOR NEXT REVIEW PERIOD
				$respo_key_goals_delete = $this->Employee_performance_model->delete_all_performance_key_goals($emp_per_id);

				if($respo_key_goals_delete){

					for ($i=0; $i < count($key_goals); $i++) {
						$key_goals_data = [
							'key_goals'         => $key_goals[$i],
							'completion_period' => (isset($completion_period[$i]) && !empty($completion_period[$i]))?$completion_period[$i]:null,
							'emp_per_id' 	    => $emp_per_id,
						];
						if(!empty($key_goals[$i])){
							$this->db->insert('gmb_perform_key_goals', $key_goals_data);
						}
					}
				}

				// Activity Logs
				addActivityLog("employee_performance", "update", $id , "employee_performance", 2, $postData);

				$this->session->set_flashdata('message', display('update_successfully'));
			} else {

				$this->session->set_flashdata('exception',  display('please_try_again'));
			}

		} else {
			$this->session->set_flashdata('exception',  validation_errors());
			
		} 

		redirect("employee/employees_performance/emp_performance_list");
	}

	public function employee_performance_delete($id){

		$this->permission->check_label('emp_performance')->delete()->access();

		if ($this->Employee_performance_model->delete_employee_performance($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("employee/employees_performance/emp_performance_list");
	}

	public function employee_performance_view($id){

		$this->permission->check_label('emp_performance')->read()->access();

		$data['title']                = display('emp_performance');
		$data['employee']             = $this->Employees_model->employee();
		$employee_performance = $this->Employee_performance_model->employee_performance_by_id($id);
		$employee_info        = $this->Employee_performance_model->employee_performance_for_view_by_id($employee_performance->employee_id);

		// Get all performance criteria data
		$data['id'] = $id;
		$data['employee_id'] = $employee_performance->employee_id;
		$data['empplyee_name'] = $employee_info->first_name.' '.$employee_info->last_name;
		$data['department_name'] = $employee_info->department_name;
		$data['job_title'] = $employee_info->position_name;
		$data['perform_sl'] = $employee_performance->perform_sl;
		$data['review_period'] = $employee_performance->review_period;
		$data['position_of_supervisor'] = $employee_performance->position_of_supervisor;
		$data['employee_comments'] = $employee_performance->employee_comments;
		$data['performance_year'] = date('Y',strtotime($employee_performance->date));

		$data['setting'] = $this->db->get('setting')->row();

		$assesment_a_total_score = 0;
		$assesment_b_total_score = 0;

		$employee_performance = $this->Employee_performance_model->employee_performance_criteria_values($id,1);
		foreach ($employee_performance as $key => $value) {
			if((int)$value->emp_perform_criteria_id == 1){
				$data['demonstrated']          = $value->emp_perform_eval;
				$data['demonstrated_score']    = $value->score;
				$data['demonstrated_comments'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 2){
				$data['timeliness']                = $value->emp_perform_eval;
				$data['timeliness_score']          = $value->score;
				$data['timeliness_score_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 3){
				$data['impact']                = $value->emp_perform_eval;
				$data['impact_score']          = $value->score;
				$data['impact_score_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 4){
				$data['overall']                = $value->emp_perform_eval;
				$data['overall_score']          = $value->score;
				$data['overall_score_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 5){
				$data['beyond_duty']          = $value->score;
				$data['beyond_duty_commnets'] = $value->comments;
			}

			$assesment_a_total_score = $assesment_a_total_score + (int)$value->score;
		}
		$data['assesment_a_total_score'] = $assesment_a_total_score;

		$employee_performance = $this->Employee_performance_model->employee_performance_criteria_values($id,2);
		foreach ($employee_performance as $key => $value) {
			if((int)$value->emp_perform_criteria_id == 6){
				$data['interpersonal']          = $value->emp_perform_eval;
				$data['interpersonal_score']    = $value->score;
				$data['interpersonal_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 7){
				$data['attendance']                = $value->emp_perform_eval;
				$data['attendance_score']          = $value->score;
				$data['attendance_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 8){
				$data['communication']                = $value->emp_perform_eval;
				$data['communication_score']          = $value->score;
				$data['communication_commnets'] = $value->comments;
			}
			if((int)$value->emp_perform_criteria_id == 9){
				$data['contributing']                = $value->emp_perform_eval;
				$data['contributing_score']          = $value->score;
				$data['contributing_commnets'] = $value->comments;
			}
			$assesment_b_total_score = $assesment_b_total_score + (int)$value->score;
		}
		$data['assesment_b_total_score'] = $assesment_b_total_score;
		$data['score_final'] = $assesment_a_total_score + $assesment_b_total_score;

		$data['development_plans'] = $this->Employee_performance_model->development_plans($id);
		$data['data_key_goals']    = $this->Employee_performance_model->key_goals_data($id);

		$data['module']               = "employee";
		$data['page']                 = "emp_perform_appraisal/view_employee_performance";   

		echo Modules::run('template/layout', $data); 

	}

	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////


}