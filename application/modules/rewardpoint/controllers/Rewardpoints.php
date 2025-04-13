<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewardpoints extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'rewardpoints_model',
			'country_model'
			
		));	

		if (! $this->session->userdata('isLogIn'))
		redirect('login');
	}

	public function point_settings(){

		$this->permission->check_label('point_settings')->read()->redirect();

		redirect("rewardpoint/Rewardpoints/manage_point_settings"); 
	}

	/*Crate or edit point settings*/
	public function manage_point_settings(){

		$this->form_validation->set_rules('general_point',display('general_point'),'required|max_length[50]');
		$this->form_validation->set_rules('collaborative_start',"collaborative point start day",'required|max_length[50]');
		$this->form_validation->set_rules('collaborative_end',"collaborative point end day",'required|max_length[50]');
		$this->form_validation->set_rules('attendence_point',display('attendence_point'),'required|max_length[50]');
		$this->form_validation->set_rules('attendence_start',display('attendence_start'),'required');
		$this->form_validation->set_rules('attendence_end',display('attendence_end'),'required');
		
		$data['point_settings']   = (Object)$postData = [
				'id'           => $this->input->post('id',true),
				'general_point'           => $this->input->post('general_point',true),
				'attendence_point' 	         => $this->input->post('attendence_point',true),
				'attendence_start'           => $this->input->post('attendence_start',true),
				'attendence_end' 	         => $this->input->post('attendence_end',true),
				'collaborative_start' 	         => $this->input->post('collaborative_start',true),
				'collaborative_end'           => $this->input->post('collaborative_end',true),
			];

		#-------------------------------#
		if ($this->form_validation->run() === true) {

			//Current month last day
			$month_last_day = date('Y-m-t');
			$dt = new DateTime($month_last_day);
			$curr_year = $dt->format('y');
			$curr_month = $dt->format('m');
	        $month_last_day_d = $dt->format('d');

	        $collaborative_start_date = $postData['collaborative_start'];
			$dt_coll_s = new DateTime($collaborative_start_date);
			$collaborative_start_date_y = $dt_coll_s->format('y');
			$collaborative_start_date_m = $dt_coll_s->format('m');
	        $collaborative_start_date_d = $dt_coll_s->format('d');

	        $collaborative_end_date = $postData['collaborative_end'];
			$dt_coll_e = new DateTime($collaborative_end_date);
			$collaborative_end_date_y = $dt_coll_e->format('y');
			$collaborative_end_date_m = $dt_coll_e->format('m');
	        $collaborative_end_date_d = $dt_coll_e->format('d');

	        if($collaborative_start_date_d >= $collaborative_end_date_d || $collaborative_end_date_d > $month_last_day_d || $collaborative_start_date_m != $curr_month || $collaborative_end_date_m != $curr_month || $curr_year != $collaborative_start_date_y || $curr_year != $collaborative_end_date_y){
	        	$this->session->set_flashdata('exception', "Collaborative point start and end date should be in current month and start date must be lesser than end date.");
			    redirect('rewardpoint/Rewardpoints/manage_point_settings');
	        }

	        if($postData['attendence_start'] >= $postData['attendence_end']){
	        	$this->session->set_flashdata('exception', "Attendance start time should be lesser than Attendance end time.");
			    redirect('rewardpoint/Rewardpoints/manage_point_settings');
	        }

			if(empty($postData['id'])){

				$this->permission->check_label('point_settings')->create()->redirect();

			    if ($this->rewardpoints_model->point_settings_create($postData)) { 
			     $this->session->set_flashdata('message', display('save_successfully'));
			     redirect('rewardpoint/Rewardpoints/manage_point_settings');
			    } else {
			     $this->session->set_flashdata('exception',  display('please_try_again'));
			    }
			    redirect("rewardpoint/Rewardpoints/manage_point_settings"); 

			}else{

				$this->permission->check_label('point_settings')->update()->redirect();

			    if ($this->rewardpoints_model->point_settings_update($postData)) { 
			     $this->session->set_flashdata('message', display('update_successfully'));
			    } else {
			     $this->session->set_flashdata('exception',  display('please_try_again'));
			    }
			    redirect("rewardpoint/Rewardpoints/manage_point_settings/".$postData['type_id']); 

			}

		} else {

			if(!empty($id)) {
			    $data['title'] = display('point_settings');
			    $data['point_settings_info']   = $this->rewardpoints_model->findById_point_settings($id);
	   		}else{
	   			$data['point_settings_info']   = $this->rewardpoints_model->get_last_record();
	   		}
			$data['title'] = display('point_settings');
			$data['module'] = "rewardpoint";
			$data['page']   = "point_settings"; 
			echo Modules::run('template/layout', $data);  
			
		}  

	}

	 /*Point Categories create and edit*/
	 public function point_categories($id = null){

	  $this->permission->check_label('point_categories')->read()->redirect();

	  $data['title'] = display('add_point_category');
	  #-------------------------------#
	  $this->form_validation->set_rules('point_category', display('point_category')  ,'required|max_length[100]');
	  #-------------------------------#
	   $data['point_category']   = (Object) $postData = [
	   'id'          => $this->input->post('id'), 
	   'point_category'        => $this->input->post('point_category',true)
	  ];


	  if ($this->form_validation->run()) { 

		   if (empty($postData['id'])) {

		    $this->permission->check_label('point_categories')->create()->redirect();

		    if ($this->rewardpoints_model->point_categoriy_create($postData)) { 
		     	$this->session->set_flashdata('message', display('save_successfully'));
		     	redirect('rewardpoint/Rewardpoints/point_categories');
		    }else {
		     	$this->session->set_flashdata('exception',  display('please_try_again'));
		    }
		    	redirect('rewardpoint/Rewardpoints/point_categories');

		   } else {

		    	$this->permission->check_label('point_categories')->update()->redirect();

			    if ($this->rewardpoints_model->point_category_update($postData)) { 
			     	$this->session->set_flashdata('message', display('update_successfully'));
			    } else {
			     	$this->session->set_flashdata('exception',  display('please_try_again'));
			    }
			    redirect("rewardpoint/Rewardpoints/point_categories/".$postData['id']);  
		   }

		  } else { 
			   if(!empty($id)) {
				    $data['title'] = display('update_point_category');
				    $data['pointcategoryinfo']   = $this->rewardpoints_model->findById_point_category($id);
			   }
			   $data['module'] = "rewardpoint";
			   $data['page']   = "point_categories"; 
			   $data["point_categories"] = $this->rewardpoints_model->point_categories_list(); 
			   echo Modules::run('template/layout', $data); 
		   }  

	 }

	 /*Delete Point Category*/
	 public function delete_point_category($id=null){

        $this->permission->check_label('point_categories')->delete()->redirect();

        if($this->rewardpoints_model->point_category_delete($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('rewardpoint/Rewardpoints/point_categories');
    }

    /*Management Points handling*/

    public function management_point_view(){   

		$this->permission->check_label('management_point')->read()->redirect();

		$data['title']    = display('management_point');  ;
		$data['management_points']   = $this->rewardpoints_model->management_pointsView();
		$data['module']   = "rewardpoint";
		$data['page']     = "management_point_view";   
		echo Modules::run('template/layout', $data); 
	} 

	/*Create management point also update in reward_table*/
    public function management_point(){ 

    	$this->permission->check_label('management_point')->read()->redirect();

		$data['title'] = display('management_point');
		#-------------------------------#
		$this->form_validation->set_rules('employee_id',display('employee_id'),'required|max_length[50]');
		$this->form_validation->set_rules('point_category',display('point_category'),'required|max_length[50]');
		$this->form_validation->set_rules('description',display('description'),'required|max_length[500]');
		$this->form_validation->set_rules('point',display('point'),'required|max_length[50]');
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$postData = [
				'employee_id'        => $this->input->post('employee_id',true),
				'point_category' 	  => $this->input->post('point_category',true),
				'description' 	  => $this->input->post('description',true),
				'point' 	  => $this->input->post('point',true),
			];

			if ($this->rewardpoints_model->management_point_create($postData)) {

				$this->session->set_flashdata('message', display('successfully_saved'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("rewardpoint/Rewardpoints/management_point");
		} else {
			$data['title']  = display('management_point');
			$data['module'] = "rewardpoint";
			$data['page']   = "management_point";
			$data['employee']   = $this->rewardpoints_model->empdropdown();
			$data['point_categories']   = $this->rewardpoints_model->pointcatdropdown();
			$data['management_points']   = $this->rewardpoints_model->management_pointsView();
			echo Modules::run('template/layout', $data);   
			
		}   
	}

	/*Update management point also update in reward_table*/

	public function update_management_point($id = null){

		$this->permission->check_label('management_point')->update()->redirect();

		$data['title'] = display('update_management_point');
		#-------------------------------#
		$this->form_validation->set_rules('employee_id',display('employee_id'),'required|max_length[50]');
		$this->form_validation->set_rules('point_category',display('point_category'),'required|max_length[50]');
		$this->form_validation->set_rules('description',display('description'),'required|max_length[500]');
		$this->form_validation->set_rules('point',display('point'),'required|max_length[50]');
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$postData = [
				'id'        => $this->input->post('id',true),
				'employee_id'        => $this->input->post('employee_id',true),
				'point_category' 	  => $this->input->post('point_category',true),
				'description' 	  => $this->input->post('description',true),
				'point' 	  => $this->input->post('point',true),
				'previous_point' 	  => $this->input->post('previous_point',true),
			];
			
			if ($this->rewardpoints_model->update_management_point($postData)) { 

				$this->session->set_flashdata('message', display('successfully_updated'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("rewardpoint/Rewardpoints/management_point_view");

		} else {
			$data['title']  = display('update_management_point');
			$data['employee']   = $this->rewardpoints_model->empdropdown();
			$data['point_categories']   = $this->rewardpoints_model->pointcatdropdown();
			$data['data']   =$this->rewardpoints_model->find_ById_managepoint($id);
			$data['module'] = "rewardpoint";
			$data['page']   = "update_management_point";   
			echo Modules::run('template/layout', $data); 
		}

	}

	/*Delete management point and also update in reward_table*/
	public function delete_management_point($id = null){ 

		$this->permission->check_label('management_point')->delete()->redirect();

		if ($this->rewardpoints_model->delete_management_point($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("rewardpoint/Rewardpoints/management_point_view");
	}

	/*Management Points handling Ends*/

	/*Collaborative Points handling*/

	public function collaborative_point_view(){ 

		$user = $this->session->userdata();

		$this->permission->check_label('collaborative_point')->read()->redirect();

		$data['title']    = display('collaborative_point');
		if($user['isAdmin']){
			$data['collaborative_points']   = $this->rewardpoints_model->collaborative_pointsView();
		}else{
			if($user['employee_id']){
				$data['collaborative_points']   = $this->rewardpoints_model->collaborative_pointsView_employee($user['employee_id']);
			}
		}
		$data['module']   = "rewardpoint";
		$data['page']     = "collaborative_point_view";   
		echo Modules::run('template/layout', $data); 
	}

	/*Create collaborative point also update in reward_table*/
    public function collaborative_point(){

    	$date_time = date("Y-m-d h:i:sa");
    	$dt = new DateTime($date_time);
		$date_d = $dt->format('d');

    	$user = $this->session->userdata();

    	$this->permission->check_label('collaborative_point')->read()->redirect();

		$data['title'] = display('collaborative_point');
		#-------------------------------#
		$this->form_validation->set_rules('employee_id',display('employee_name'),'required|max_length[50]');
		$this->form_validation->set_rules('reason',display('reason'),'required|max_length[500]');
		$this->form_validation->set_rules('point',display('point'),'numeric|required|greater_than[0]|less_than[2]');
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$this->permission->check_label('collaborative_point')->create()->redirect();

		    $point_shared_with = $this->input->post('employee_id',true);
		    $point = $this->input->post('point',true);

		    if((int)$point != 1){
		        
		        $this->session->set_flashdata('exception', "Point value must be 1 !");

			    redirect("rewardpoint/Rewardpoints/collaborative_point");
		    }

			$postData = [
				'point_shared_with' => $this->input->post('employee_id',true),
				'reason' 	  		=> $this->input->post('reason',true),
				'point' 	  		=> $this->input->post('point',true),
			];

			//Get point settings
			$point_settings = $this->rewardpoints_model->get_last_record();

			//collaborative point start date
			$collaborative_start = $point_settings->collaborative_start;
			$dt_collaborative_start = new DateTime($collaborative_start);
	        $collaborative_start_d = $dt_collaborative_start->format('d');

	        //collaborative point start date
	        $collaborative_end = $point_settings->collaborative_end;
	        $dt_collaborative_end = new DateTime($collaborative_end);
	        $collaborative_end_d = $dt_collaborative_end->format('d');

			//Checking collaborative point start and end date
			if((int)$date_d >= (int)$collaborative_start_d && (int)$date_d <= (int)$collaborative_end_d){

				//Checking if trying to share point with own self
				if((int)$point_shared_with == (int)$user['employee_id']){

					$this->session->set_flashdata('exception', "You can't share point with yourself !");
				}else{

					//Getting Collaborative point for the logged in employee for current month..
					$collaborative_point_count = $this->rewardpoints_model->collaborative_point_count();

					if((int)$collaborative_point_count >= (int)$point_settings->general_point){

						$this->session->set_flashdata('exception', "You can share maximum ".$point_settings->general_point." points for a month !");
					}else{

						//Check employee sharing point more than one with point receiver employee for current month
						$check_emp_collab_point = $this->rewardpoints_model->check_emp_collab_point($point_shared_with);

						if((int)$check_emp_collab_point < (int)$point_settings->attendence_point){

							if ($this->rewardpoints_model->collaborative_point_create($postData)) {

								$this->session->set_flashdata('message', display('successfully_saved'));
							} else {
								$this->session->set_flashdata('exception',  display('please_try_again'));
							}
						}else{

							$this->session->set_flashdata('exception', "You can share only one point with an employee for a month !");
						}

					}

				}

			}else{
				$this->session->set_flashdata('exception', "Points can be shared between day ".$collaborative_start_d." to day ".$collaborative_end_d." of current month !");
			}

			redirect("rewardpoint/Rewardpoints/collaborative_point");

		} else {
			$data['title']  = display('collaborative_point');
			$data['module'] = "rewardpoint";
			$data['page']   = "collaborative_point";
			$data['employee']   = $this->rewardpoints_model->empdropdown();
			if($user['isAdmin']){
			$data['collaborative_points']   = $this->rewardpoints_model->collaborative_pointsView();
			}else{
				if($user['employee_id']){
					$data['collaborative_points']   = $this->rewardpoints_model->collaborative_pointsView_employee($user['employee_id']);
				}
			}
			echo Modules::run('template/layout', $data);
			
		}   
	}

	/*Delete collaborative point and also update in reward_table*/
	public function delete_collaborative_point($id = null){ 

		$this->permission->check_label('collaborative_point')->delete()->redirect();

		if ($this->rewardpoints_model->delete_collaborative_point($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("rewardpoint/Rewardpoints/collaborative_point_view");
	}

	/*Collaborative Points Ends*/

	/*Reward Points View Starts and it's related works*/

	public function employee_point2(){ 

		$this->permission->check_label('employee_point')->read()->redirect();

		$data['title']    = display('employee_point');
		$data['employee_points']   = $this->rewardpoints_model->employee_pointsView();
		$data['module']   = "rewardpoint";
		$data['page']     = "employee_point_view";   
		echo Modules::run('template/layout', $data); 
	}

	/*End Reward Points View Starts and it's related works*/

	/*Start of Attendence point... which will be calculating from attendence form in_time*/
	public function attendence_point(){ 

		$this->permission->check_label('attendence_point')->read()->redirect();

		$data['title']    = display('attendence_point');
		$data['attendence_points']   = $this->rewardpoints_model->attendence_pointsView();
		$data['module']   = "rewardpoint";
		$data['page']     = "attendence_point_view";   
		echo Modules::run('template/layout', $data); 
	}
	/*Ends of Attendence point...*/

	/*Testing from 2nd Jan 2021*/

	public function employee_point(){ 

		$this->permission->check_label('employee_point')->read()->redirect();
		
		//Redirect to individual employee points report page..
        if($this->session->userdata['employee_id']){

            redirect("rewardpoint/Rewardpoints/individual_employee_point");

        }
        //End of redirection to individual employee points report page..

		$data['title']    = display('employee_point');
		$data['total_emp_points']   = $this->rewardpoints_model->employee_points_rec_count();
		$data['module']   = "rewardpoint";
		$data['page']     = "employee_point_view2"; 

		echo Modules::run('template/layout', $data); 
	}
	
	public function individual_employee_point(){

		$employee_id = $this->session->userdata['employee_id'];

		$data['title']    = display('employee_point');
		$data['employee']   = $this->rewardpoints_model->empdropdown();
		$data['total_emp_points']   = $this->rewardpoints_model->indv_employee_points_rec_count($employee_id);
		$data['employee_id']   = $this->session->userdata['employee_id'];
		$data['module']   = "rewardpoint";
		$data['page']     = "individual_employee_point_view";

		echo Modules::run('template/layout', $data); 
	}

	public function CheckEmpPointList(){

        $postData = $this->input->post();

        $data = $this->rewardpoints_model->getEmpPointList($postData);
        echo json_encode($data);
        
    }
    
    public function CheckIndvEmpPointList(){

        $postData = $this->input->post();

        $data = $this->rewardpoints_model->getIndvEmpPointList($postData);
        echo json_encode($data);
        
    }

}
