<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewardpoints_model extends CI_Model {

	/*handling Point settings database starts*/
	public function point_settings_create($data = array())
    {
    	$user = $this->session->userdata();
    	$data['created_by'] = $user['id'];
    	$data['created_at'] = date("Y-m-d h:i:sa");

        return $this->db->insert('point_settings', $data);
    }

    public function point_settings_update($data = [])
    {
    	$user = $this->session->userdata();
    	$data['updated_by'] = $user['id'];
    	$data['update_at'] = date("Y-m-d h:i:sa");

        return $this->db->where('id',$data['id'])
            ->update('point_settings',$data); 
    } 

    public function findById_point_settings($id = null)
    { 
        return $this->db->select("*")->from("point_settings")
            ->where('id',$id)
            ->get()
            ->row();

    } 

    public function find_attendance_history($data = [])
    { 
        return $this->db->select("atten_his_id")->from("attendance_history")
            ->where('uid',$data['uid'])
            ->where('time',$data['time'])
            ->get()
            ->row();

    } 

    /*Get Point Settings*/
    public function get_last_record(){

    	return $this->db->order_by('id',"desc")
            ->limit(1)
            ->get('point_settings')
            ->row();
    }

    /*handling Point Settings database ends*/

    /*handling Point Categories database starts*/
    public function point_categoriy_create($data = array())
    {
    	$user = $this->session->userdata();
    	$data['created_by'] = $user['id'];
    	$data['created_at'] = date("Y-m-d h:i:sa");

        return $this->db->insert('point_categories', $data);
    }

    public function point_category_update($data = [])
    {
    	$user = $this->session->userdata();
    	$data['update_by'] = $user['id'];
    	$data['update_at'] = date("Y-m-d h:i:sa");

        return $this->db->where('id',$data['id'])
            ->update('point_categories',$data); 
    } 

    public function point_categories_list($id = null)
    { 
        $this->db->select('*');
        $this->db->from('point_categories');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;

    } 

    public function findById_point_category($id = null)
    { 
        return $this->db->select("*")->from("point_categories")
            ->where('id',$id)
            ->get()
            ->row();

    } 

    public function point_category_delete($id = null)
    {
        $this->db->where('id',$id)
            ->delete('point_categories');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    } 
    /*handling Point Categories database ends*/

    /*handling Management points database starts*/

    public function empdropdown()
	{
		$this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_status',1);
        $query = $this->db->get();
        $data = $query->result();
       
        $list = array('' => 'Select One...');
       	if (!empty($data) ) {
       		foreach ($data as $value) {
       			$list[$value->employee_id] = $value->first_name." ".$value->last_name;
       		} 
       	}
       	return $list;
	}

	 public function pointcatdropdown()
	{
		$this->db->select('*');
        $this->db->from('point_categories');
        $query = $this->db->get();
        $data = $query->result();
       
        $list = array('' => 'Select One...');
       	if (!empty($data) ) {
       		foreach ($data as $value) {
       			$list[$value->id] = $value->point_category;
       		} 
       	}
       	return $list;
	}

    public function management_pointsView()
	{
		return $result = $this->db->select('point_management.*,p.first_name,p.last_name,pc.point_category')	
			 ->from('point_management')
			 ->join('employee_history p', 'point_management.employee_id = p.employee_id', 'left')
			 ->join('point_categories pc', 'point_management.point_category = pc.id', 'left')
             ->order_by('point_management.create_date','desc')
			 ->get()
			 ->result();
	}

	//Creating management point and at the same time also pushing point to point_reward table
	public function management_point_create($data = array())
	{
		$user = $this->session->userdata();
    	$data['created_by'] = $user['id'];
    	$data['create_date'] = date("Y-m-d h:i:sa");

    	if($this->add_management_point_to_reward($data)){
    		return $this->db->insert('point_management', $data);
    	}else{
    		return false;
    	}
	}

	public function find_ById_managepoint($id = null)
    {
         return $this->db->select("*")->from("point_management")
            ->where('id',$id)
            ->get()
            ->row();
    } 

    public function update_management_point($data = array())
	{
		$user = $this->session->userdata();
    	$data['update_by'] = $user['id'];
    	$data['update_date'] = date("Y-m-d h:i:sa");

    	if($this->update_management_point_to_reward($data)){

    		unset($data['previous_point']);

    		return $this->db->where('id', $data["id"])
			->update("point_management", $data);

    	}else{
    		return false;
    	}
	}

	/*Delete management point and also from point_reward table for the employee for the date time of management point*/
	public function delete_management_point($id = null)
    {
    	$management_point = $this->find_ById_managepoint($id);

    	$dt = new DateTime($management_point->create_date);
		$date = $dt->format('Y-m-d');
		$date_y = $dt->format('Y');
		$date_m = $dt->format('m');
		$time = $dt->format('H:i:s');

		$point_reward_rec = $this->db->select("*")->from("point_reward")
            ->where('employee_id',$management_point->employee_id)
            ->where("YEAR(date)=".$date_y,NULL, FALSE)
            ->where("MONTH(date)=".$date_m,NULL, FALSE)
            ->get()
            ->row();

		if($point_reward_rec && $point_reward_rec->id != null){

			// Deducting management point from existing management reward point..
			$management_point_upd = (int)$point_reward_rec->management - (int)$management_point->point;
            $total = (int)$point_reward_rec->total - (int)$management_point->point;
			$point_reward_data['management'] = $management_point_upd;
            $point_reward_data['total'] = $total;

			$update_reward_point = $this->db->where('id', $point_reward_rec->id)
			->update("point_reward", $point_reward_data);

			if($update_reward_point){

				$this->db->where('id',$id)
		            ->delete('point_management');

		        if ($this->db->affected_rows()) {
		            return true;
		        } else {
		            return false;
		        }

			}else{
				return false;
			}
		}
    } 
	
    /*handling Management points database ends*/

    /*Insert management point to employee point_reward database table*/
 	private function add_management_point_to_reward($data = array())
	{
		$user = $this->session->userdata();

		$dt = new DateTime($data['create_date']);
		$date = $dt->format('Y-m-d');
		$date_y = $dt->format('Y');
		$date_m = $dt->format('m');
		$time = $dt->format('H:i:s');
		$data['date'] = $date;

		$point_reward_rec = $this->db->select("*")->from("point_reward")
            ->where('employee_id',$data['employee_id'])
            ->where("YEAR(date)=".$date_y,NULL, FALSE)
            ->where("MONTH(date)=".$date_m,NULL, FALSE)
            ->get()
            ->row();

        if($point_reward_rec && $point_reward_rec->id != null){

        	// Adding management point with existing management reward point, if employee already exists in point_reward table..
        	$management_point = (int)$point_reward_rec->management + (int)$data['point'];
            $total = (int)$point_reward_rec->attendence + (int)$point_reward_rec->collaborative + $management_point;
        	$point_reward_data['management'] = $management_point;
            $point_reward_data['total'] = $total;

        	$update_reward_point = $this->db->where('id', $point_reward_rec->id)
        	->update("point_reward", $point_reward_data);

			if($update_reward_point){
				return true;
			}else{
				return false;
			}

        }else{

        	// Inserting management point, if employee not exists in point_reward table..
        	$point_reward_insert['date'] = date("Y-m-d");
        	$point_reward_insert['management'] = $data['point'];
            $point_reward_insert['total'] = $data['point'];
       		$point_reward_insert['employee_id'] = $data['employee_id'];

       		$insert_reward_point = $this->db->insert('point_reward', $point_reward_insert);

       		if($insert_reward_point){
				return true;
			}else{
				return false;
			}
        }

	}

	/*Update management point to employee point_reward database table*/
 	private function update_management_point_to_reward($data = array())
	{
		//This previous point will first deduct from poit_reward table management point then will add the new updated point for the wmployee..
		$previous_point = $data['previous_point'];

		$management_reward_point = $this->find_ById_managepoint($data['id']);

		$dt = new DateTime($management_reward_point->create_date);
		$date = $dt->format('Y-m-d');
		$date_y = $dt->format('Y');
		$date_m = $dt->format('m');
		$time = $dt->format('H:i:s');
		$data['date'] = $date;

		$point_reward_rec = $this->db->select("*")->from("point_reward")
            ->where('employee_id',$data['employee_id'])
            ->where("YEAR(date)=".$date_y,NULL, FALSE)
            ->where("MONTH(date)=".$date_m,NULL, FALSE)
            ->get()
            ->row();

        if($point_reward_rec && $point_reward_rec->id != null){

        	// Updating management point with existing management reward point, if employee already exists in point_reward table..
        	$point_add = 0;
        	$point_deduct = 0;
        	$final_management_point = 0;
            $total = 0;

        	if((int)$previous_point <= (int)$data['point']){
        		$point_add = (int)$data['point'] - (int)$previous_point;
        		$final_management_point = (int)$point_reward_rec->management + $point_add;
        	}else{
        		$point_deduct = (int)$previous_point - (int)$data['point'];
        		$final_management_point = (int)$point_reward_rec->management - $point_deduct;
        	}
            $total = (int)$point_reward_rec->attendence + (int)$point_reward_rec->collaborative + $final_management_point;
        	
        	$point_reward_data['management'] = $final_management_point;
            $point_reward_data['total'] = $total;

        	$update_reward_point = $this->db->where('id', $point_reward_rec->id)
        	->update("point_reward", $point_reward_data);

			if($update_reward_point){
				return true;
			}else{
				return false;
			}

        }

	}

	/*Collaborative points handling*/

	public function collaborative_pointsView()
	{
		return $this->db->select('point_collaborative.*,p.first_name as shared_firstname,p.last_name as shared_lastname,q.first_name as received_firstname,q.last_name as received_lastname')	
			 ->from('point_collaborative')
			 ->join('employee_history p', 'point_collaborative.point_shared_by = p.employee_id', 'left')
			 ->join('employee_history q', 'point_collaborative.point_shared_with = q.employee_id', 'left')
             ->order_by('point_collaborative.create_date','desc')
			 ->get()
			 ->result();
	}

    public function collaborative_pointsView_employee($employee_id = null)
    {

        return $this->db->select('point_collaborative.*,p.first_name as shared_firstname,p.last_name as shared_lastname,q.first_name as received_firstname,q.last_name as received_lastname')   
             ->from('point_collaborative')
             ->join('employee_history p', 'point_collaborative.point_shared_by = p.employee_id', 'left')
             ->join('employee_history q', 'point_collaborative.point_shared_with = q.employee_id', 'left')
             ->where('point_collaborative.point_shared_by',$employee_id)
             ->order_by('point_collaborative.create_date','desc')
             ->get()
             ->result();
    }

    public function find_ById_collaborativepoint($id = null)
    {
         return $this->db->select("*")->from("point_collaborative")
            ->where('id',$id)
            ->get()
            ->row();
    } 

	/*Adding Collaborative point to point_reward table*/
	public function collaborative_point_create($data = array())
	{
		$user = $this->session->userdata();

        //Only Employee can share collaborative point..
        if($user['employee_id'] != null){

            $data['point_shared_by'] = $user['employee_id'];
            $data['created_by'] = $user['id'];
            $data['create_date'] = date("Y-m-d h:i:sa");

            $current_date = date("Y-m-d h:i:sa");
            $dt = new DateTime($current_date);
            $date = $dt->format('Y-m-d');
            $date_y = $dt->format('Y');
            $date_m = $dt->format('m');
            $date_m = $dt->format('m');
            $date_d = $dt->format('d');
            $time = $dt->format('H:i:s');

            $date_m = $date_m - 1;
            if($date_m == 0){
                $date_y = $date_y - 1;
                $date_m = 12;
            }
            $date = $date_y."-".$date_m."-".$date_d;
            $point_date = date($date);
            $point_dt = new DateTime($point_date);
            $data['point_date'] = $point_dt->format('Y-m-d');

            if($this->add_collaborative_point_to_reward($data)){
                return $this->db->insert('point_collaborative', $data);
            }else{
                return false;
            }
        }else{
            return false;
        }
		
	}

    /*Collaborative point record count for logged in employee in application for current month*/
    public function collaborative_point_count($employee_id = null)
    {
        $user = $this->session->userdata();

        $logged_employee_id = $user['employee_id'];

        $current_date = date("Y-m-d h:i:sa");
        $dt = new DateTime($current_date);
        $date = $dt->format('Y-m-d');
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');
        $date_m = $dt->format('m');
        $date_d = $dt->format('d');
        $time = $dt->format('H:i:s');

        $date_m = $date_m - 1;
        if($date_m == 0){
            $date_y = $date_y - 1;
            $date_m = 12;
        }
        $date = $date_y."-".$date_m."-".$date_d;

        $collaborative_point_recs = $this->db->select("*")->from("point_collaborative")
            ->where('point_shared_by',$logged_employee_id)
            ->where("YEAR(point_date)=".$date_y,NULL, FALSE)
            ->where("MONTH(point_date)=".$date_m,NULL, FALSE)
            ->get()
            ->num_rows();

        return $collaborative_point_recs;

    }

    /*Check employee sharing point more than one with point receiver employee for current month*/
    public function check_emp_collab_point($employee_id = null)
    {
        $user = $this->session->userdata();

        $point_shared_with = $employee_id;
        $point_shared_by = $user['employee_id'];

        $current_date = date("Y-m-d h:i:sa");
        $dt = new DateTime($current_date);
        $date = $dt->format('Y-m-d');
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');
        $date_d = $dt->format('d');
        $time = $dt->format('H:i:s');

        $date_m = $date_m - 1;
        if($date_m == 0){
            $date_y = $date_y - 1;
            $date_m = 12;
        }
        $date = $date_y."-".$date_m."-".$date_d;

        $collaborative_point_rec = $this->db->select("*")->from("point_collaborative")
            ->where('point_shared_with',$point_shared_with)
            ->where('point_shared_by',$point_shared_by)
            ->where("YEAR(point_date)=".$date_y,NULL, FALSE)
            ->where("MONTH(point_date)=".$date_m,NULL, FALSE)
            ->get()
            ->num_rows();

        return $collaborative_point_rec;

    }

    /*Insert collaborative point to employee point_reward database table*/
    private function add_collaborative_point_to_reward($data = array())
    {
        $user = $this->session->userdata();

        $dt = new DateTime($data['create_date']);
        $date = $dt->format('Y-m-d');
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');
        $date_d = $dt->format('d');
        $time = $dt->format('H:i:s');
        $data['date'] = $date;

        //Get point settings
        $point_settings = $this->get_last_record();

        //collaborative point start date
        $collaborative_start = $point_settings->collaborative_start;
        $dt_collaborative_start = new DateTime($collaborative_start);
        $collaborative_start_d = $dt_collaborative_start->format('d');

        //collaborative point start date
        $collaborative_end = $point_settings->collaborative_end;
        $dt_collaborative_end = new DateTime($collaborative_end);
        $collaborative_end_d = $dt_collaborative_end->format('d');

        /*Managing collaborative Points between collaborative_start_d and collaborative_end_d in current month for previous month*/
        if((int)$date_d >= (int)$collaborative_start_d && (int)$date_d <= (int)$collaborative_end_d){

            $date_m = $date_m - 1;

            if($date_m == 0){
                $date_y = $date_y - 1;
                $date_m = 12;
            }
            $date = $date_y."-".$date_m."-".$date_d;

            $point_reward_rec = $this->db->select("*")->from("point_reward")
                ->where('employee_id',$data['point_shared_with'])
                ->where("YEAR(date)=".$date_y,NULL, FALSE)
                ->where("MONTH(date)=".$date_m,NULL, FALSE)
                ->get()
                ->row();

            if($point_reward_rec && $point_reward_rec->id != null){

                // Adding collaborative point with existing collaborative reward point, if employee already exists in point_reward table..
                $collaborative_point = (int)$point_reward_rec->collaborative + (int)$data['point'];
                $total = (int)$point_reward_rec->attendence + (int)$point_reward_rec->management + $collaborative_point;
                $point_reward_data['collaborative'] = $collaborative_point;
                $point_reward_data['total'] = $total;

                $update_reward_point = $this->db->where('id', $point_reward_rec->id)
                ->update("point_reward", $point_reward_data);

                if($update_reward_point){
                    return true;
                }else{
                    return false;
                }

            }else{

                // Inserting collaborative point, if employee not exists in point_reward table..
                $point_reward_insert['date'] = $date;
                $point_reward_insert['collaborative'] = $data['point'];
                $point_reward_insert['total'] = $data['point'];
                $point_reward_insert['employee_id'] = $data['point_shared_with'];

                $insert_reward_point = $this->db->insert('point_reward', $point_reward_insert);

                if($insert_reward_point){
                    return true;
                }else{
                    return false;
                }
            }

        }else{
           return false;
        }
        /*End of Managing collaborative Points between day 1 and 5 in current month for previous month*/
    }

    /*Delete management point and also from point_reward table for the employee for the date time of management point*/
    public function delete_collaborative_point($id = null)
    {
        $collaborative_point = $this->find_ById_collaborativepoint($id);

        $dt = new DateTime($collaborative_point->point_date);
        $date = $dt->format('Y-m-d');
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');
        $time = $dt->format('H:i:s');

        $point_reward_rec = $this->db->select("*")->from("point_reward")
            ->where('employee_id',$collaborative_point->point_shared_with)
            ->where("YEAR(date)=".$date_y,NULL, FALSE)
            ->where("MONTH(date)=".$date_m,NULL, FALSE)
            ->get()
            ->row();

        if($point_reward_rec && $point_reward_rec->id != null){

            // Deducting management point from existing management reward point..
            $collaborativ_point = (int)$point_reward_rec->collaborative - (int)$collaborative_point->point;
            $total = (int)$point_reward_rec->total - (int)$collaborative_point->point;
            $point_reward_data['collaborative'] = $collaborativ_point;
            $point_reward_data['total'] = $total;

            $update_reward_point = $this->db->where('id', $point_reward_rec->id)
            ->update("point_reward", $point_reward_data);

            if($update_reward_point){

                $this->db->where('id',$id)
                    ->delete('point_collaborative');

                if ($this->db->affected_rows()) {
                    return true;
                } else {
                    return false;
                }

            }else{
                return false;
            }
        }
    } 


	/*Ends of Collaborative points handling*/

    /*Employee Points view*/
    public function employee_pointsView()
    {
        return $this->db->select('pointr.*,p.first_name as firstname,p.last_name as lastname')
             ->from('point_reward pointr')
             ->join('employee_history p', 'pointr.employee_id = p.employee_id', 'left')
             ->order_by('pointr.date','desc')
             ->get()
             ->result();
    }

    public function dshboard_employee_points()
    {
        $current_date = date("Y-m-d h:i:sa");
        $dt = new DateTime($current_date);
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');

        $date_m = $date_m - 1;

        if($date_m == 0){
            $date_y = $date_y - 1;
            $date_m = 12;
        }

        return $this->db->select('pointr.*,p.first_name as firstname,p.last_name as lastname')
             ->from('point_reward pointr')
             ->join('employee_history p', 'pointr.employee_id = p.employee_id', 'left')
             ->where("YEAR(pointr.date)=".$date_y,NULL, FALSE)
             ->where("MONTH(pointr.date)=".$date_m,NULL, FALSE)
             ->order_by('pointr.total','desc')
             ->order_by('pointr.date','desc')
             ->get()
             ->result();
    }

    /*Attendence points starts*/
    public function attendence_pointsView()
    {
        return $this->db->select('poinattn.*,p.first_name as firstname,p.last_name as lastname')
             ->from('point_attendence poinattn')
             ->join('employee_history p', 'poinattn.employee_id = p.employee_id', 'left')
             ->order_by('poinattn.create_date','desc')
             ->get()
             ->result();
    }

    /*Insert attendence point when gets call from Attendence module for employee , this will both calculate attendence point on add , update and delete of attendence*/
    public function insert_attendence_point($data = array()){

        /* Getting from point settings*/
        $point_settings = $this->rewardpoints_model->get_last_record();
        $attendence_start = strtotime($point_settings->attendence_start);
        $attendence_end = strtotime($point_settings->attendence_end);
        $attendence_point = $point_settings->attendence_point;

        /*Getting Year,Month,day and time from Employee attendence in_time of Attendence Form*/
        $dt = new DateTime($data['time']);
        $date = $dt->format('Y-m-d');
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');
        $date_d = $dt->format('d');
        $time_to_insert = $dt->format('H:i');
        $time = $dt->format('H:i:s');

        $in_time = strtotime($dt->format('H:i'));

        $user = $this->session->userdata();

        //Getting Year,Month,day from current date
        $current_dt = new DateTime(date("Y-m-d"));
        $current_date = $current_dt->format('Y-m-d');

        //Checking if attendence point already exists in point_attendence table 
        $point_attendence_rec = $this->db->select("*")->from("point_attendence")
            ->where('employee_id',$data['uid'])
            ->where("YEAR(create_date)=".$date_y,NULL, FALSE)
            ->where("MONTH(create_date)=".$date_m,NULL, FALSE)
            ->where("DAY(create_date)=".$date_d,NULL, FALSE)
            ->get()
            ->row(); 

        $respo_s = true;

        if(!$point_attendence_rec){

            //point attendence data to insert in point_attendence table
            $atten_data['employee_id'] = $data['uid'];
            $atten_data['create_date'] = $date;
            if($user['id']){
                $atten_data['created_by'] = $user['id'];
            }
            $atten_data['in_time'] = $time_to_insert;
            $atten_data['point'] = 0;

            $respo_s = $this->db->insert('point_attendence', $atten_data);

        }else{

            $point_attendence_data['update_date'] = $date;
            if($user['id']){
                $point_attendence_data['update_by'] = $user['id'];
            }

            $worked_hour = $this->employee_worked_hour_today($data['uid'],$data['time']);
            $emp_in_time = $this->employee_attn_in_time($data);
            $attn_in_time = strtotime($emp_in_time);

            $point_attendence_data['in_time'] = $emp_in_time;

            //Checking if attendence punch time is occured more than once
            $attn_history = $this->employee_attn_history($data);

            if($attn_history >= 2){

                //Check worked hour is more than 8 or equal 8 hours
                if($worked_hour >= 8 && (int)$attn_in_time <= (int)$attendence_end){

                    //Reward point data to insert in point_reward table
                    $point_reward_data['employee_id'] = $data['uid'];
                    $point_reward_data['attendence_point'] = (int)$attendence_point;
                    $point_reward_data['date'] = $date;
                    //If point_attendence is zero for today
                    if((int)$point_attendence_rec->point <= 0){
                        $add_reward_point = $this->add_attendence_point_to_reward($point_reward_data);

                        $point_attendence_data['point'] = (int)$attendence_point;
                        if($add_reward_point){
                            $respo_s = $this->db->where('id', $point_attendence_rec->id)->update("point_attendence", $point_attendence_data);
                        }
                    } 


                }else{
                    //if get point that will deduct from point_attendence and point_reward 
                    if((int)$point_attendence_rec->point >= (int)$attendence_point){

                        $point_attendence_data['point'] = 0;
                        $update_attendence_point_a = $this->db->where('id', $point_attendence_rec->id)->update("point_attendence", $point_attendence_data);

                         if($update_attendence_point_a){
                            //Reward point data to insert in point_reward table
                            $point_reward_data_d['employee_id'] = $data['uid'];
                            $point_reward_data_d['deduct_attendence_point'] = (int)$attendence_point;
                            $point_reward_data_d['date'] = $date;

                            $respo_s = $this->deduct_attendence_point_to_reward($point_reward_data_d);
                         }
                    }
                }

            }else{
                if((int)$point_attendence_rec->point >= (int)$attendence_point){

                    $point_attendence_data['point'] = 0;
                    $update_attendence_point_b = $this->db->where('id', $point_attendence_rec->id)->update("point_attendence", $point_attendence_data);
                    if($update_attendence_point_b){
                        //Reward point data to insert in point_reward table
                        $point_reward_data_e['employee_id'] = $data['uid'];
                        $point_reward_data_e['deduct_attendence_point'] = (int)$attendence_point;
                        $point_reward_data_e['date'] = $date;

                        $respo_s = $this->deduct_attendence_point_to_reward($point_reward_data_e);
                     }
                }
                
            } 
        }

        if($respo_s){
            return true;
        }else{
            return false;
        }
        
    }

    /*Insert attendence point to employee point_reward database table*/
    private function add_attendence_point_to_reward($data = array())
    {
        $user = $this->session->userdata();

        $dt = new DateTime($data['date']);
        $date = $dt->format('Y-m-d');
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');
        $data['date'] = $date;

        $point_reward_rec = $this->db->select("*")->from("point_reward")
            ->where('employee_id',$data['employee_id'])
            ->where("YEAR(date)=".$date_y,NULL, FALSE)
            ->where("MONTH(date)=".$date_m,NULL, FALSE)
            ->get()
            ->row();

        if($point_reward_rec && $point_reward_rec->id != null){

            // Adding attendence point with existing attendence reward point, if employee already exists in point_reward table..
            $attendence_point = (int)$point_reward_rec->attendence + (int)$data['attendence_point'];
            $total = (int)$point_reward_rec->management + (int)$point_reward_rec->collaborative + $attendence_point;
            $point_reward_data['attendence'] = $attendence_point;
            $point_reward_data['total'] = $total;

            $update_reward_point = $this->db->where('id', $point_reward_rec->id)
            ->update("point_reward", $point_reward_data);

            if($update_reward_point){
                return true;
            }else{
                return false;
            }

        }else{

            // Inserting attendence point, if employee not exists in point_reward table..
            $point_reward_insert['date'] = $date;
            $point_reward_insert['attendence'] = $data['attendence_point'];
            $point_reward_insert['total'] = $data['attendence_point'];
            $point_reward_insert['employee_id'] = $data['employee_id'];

            $insert_reward_point = $this->db->insert('point_reward', $point_reward_insert);

            if($insert_reward_point){
                return true;
            }else{
                return false;
            }
        }

    } 

    /*Deduct attendence point to employee point_reward database table*/
    private function deduct_attendence_point_to_reward($data = array())
    {
        $user = $this->session->userdata();

        $dt = new DateTime($data['date']);
        $date = $dt->format('Y-m-d');
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');
        $data['date'] = $date;

        $point_reward_rec = $this->db->select("*")->from("point_reward")
            ->where('employee_id',$data['employee_id'])
            ->where("YEAR(date)=".$date_y,NULL, FALSE)
            ->where("MONTH(date)=".$date_m,NULL, FALSE)
            ->get()
            ->row();

        if($point_reward_rec && $point_reward_rec->id != null){

            // Adding attendence point with existing attendence reward point, if employee already exists in point_reward table..
            $attendence_point = (int)$point_reward_rec->attendence - (int)$data['deduct_attendence_point'];
            $total = (int)$point_reward_rec->management + (int)$point_reward_rec->collaborative + $attendence_point;
            $point_reward_data['attendence'] = $attendence_point;
            $point_reward_data['total'] = $total;

            $update_reward_point = $this->db->where('id', $point_reward_rec->id)
            ->update("point_reward", $point_reward_data);

            if($update_reward_point){
                return true;
            }else{
                return false;
            }

        }

    } 

    /*Attendence points end*/

    /*Testing*/

    public function employee_points_rec_count(){
         return $this->db->count_all("point_reward");
    }
    
    public function indv_employee_points_rec_count($employee_id){

        $query = $this->db->where('employee_id', $employee_id)->get('point_reward');

        return $query->num_rows();
    }

    public function getEmpPointList($postData=null){
        $response = array();
        $fromdate = $this->input->post('fromdate',true);
        $todate   = $this->input->post('todate',true);

        //Correcting date format of fromdate...
        if(!empty($fromdate)){
            $fromdate = date('Y-m-d', strtotime($fromdate));
        }else{
            $fromdate = "";
        }
        if(!empty($todate)){
            $todate = date('Y-m-t', strtotime($todate));
        }else{
            $todate = "";
        }

        if(!empty($fromdate)){
            $datbetween = "(a.date BETWEEN '$fromdate' AND '$todate')";
        }else{
            $datbetween = "";
        }
        ## Read value
        $searchValue = "";
        $draw         = $postData['draw'];
        $start        = $postData['start'];
        $rowperpage   = $postData['length']; // Rows display per page
        $columnIndex  = $postData['order'][0]['column']; // Column index
        $columnName   = $postData['columns'][$columnIndex]['data']; 
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue  = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";
        if($searchValue != ''){

            $searchQuery = " (b.first_name like '%".$searchValue."%' or b.last_name like '%".$searchValue."%' or a.attendence like'%".$searchValue."%' or a.management like'%".$searchValue."%' or a.total like'%".$searchValue."%' or a.collaborative like'%".$searchValue."%')";

        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('point_reward a');
        $this->db->join('employee_history b', 'b.employee_id = a.employee_id','left');


        if(!empty($fromdate) && !empty($todate)){
            $this->db->where($datbetween);
        }
        if($searchValue != '')
            $this->db->where($searchQuery);

        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('point_reward a');
        $this->db->join('employee_history b', 'b.employee_id = a.employee_id','left');

        if(!empty($fromdate) && !empty($todate)){
         $this->db->where($datbetween);
        }
        if($searchValue != '')
        $this->db->where($searchQuery);

        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select("a.*,b.first_name as firstname,b.last_name as lastname");
        $this->db->from('point_reward a');
        $this->db->join('employee_history b', 'b.employee_id = a.employee_id','left');

        if(!empty($fromdate) && !empty($todate)){
         $this->db->where($datbetween);
        }
        if($searchValue != '')
        $this->db->where($searchQuery);

        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        $data = array();
        $sl =1;

         foreach($records as $record ){
          $button = '';
          $base_url = base_url();
            
            $data[] = array( 
                'sl'                    =>$sl,
                'employee_name'         =>$record->firstname." ".$record->lastname,
                'attendence_point'      =>$record->attendence != null?$record->attendence:0,
                'collaborative_point'   =>$record->collaborative != null?$record->collaborative:0,
                'management_point'      =>$record->management != null?$record->management:0,
                'total'                 =>$record->total != null?$record->total:0,
                'date'                  =>date('F, Y', strtotime($record->date)),
                
            );

            $sl++;
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data,
         );

         return $response; 
         
    }
    
        public function getIndvEmpPointList($postData=null){
        $response = array();
        $fromdate = $this->input->post('fromdate',true);
        $todate   = $this->input->post('todate',true);
        $employee_id   = $this->input->post('employee_id',true);

        //Correcting date format of fromdate...
        if(!empty($fromdate)){
            $fromdate = date('Y-m-d', strtotime($fromdate));
        }else{
            $fromdate = "";
        }
        if(!empty($todate)){
            $todate = date('Y-m-t', strtotime($todate));
        }else{
            $todate = "";
        }
        if(!empty($employee_id)){
            $employee_id = (int)$employee_id;
        }else{
            $employee_id = "";
        }

        if(!empty($fromdate)){
            $datbetween = "(a.date BETWEEN '$fromdate' AND '$todate')";
        }else{
            $datbetween = "";
        }
        ## Read value
        $searchValue = "";
        $draw         = $postData['draw'];
        $start        = $postData['start'];
        $rowperpage   = $postData['length']; // Rows display per page
        $columnIndex  = $postData['order'][0]['column']; // Column index
        $columnName   = $postData['columns'][$columnIndex]['data']; 
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue  = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";
        if($searchValue != ''){

            $searchQuery = " (b.first_name like '%".$searchValue."%' or b.last_name like '%".$searchValue."%' or a.attendence like'%".$searchValue."%' or a.management like'%".$searchValue."%' or a.total like'%".$searchValue."%' or a.collaborative like'%".$searchValue."%')";

        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('point_reward a');
        $this->db->join('employee_history b', 'b.employee_id = a.employee_id','left');


        if(!empty($fromdate) && !empty($todate)){
            $this->db->where($datbetween);
        }
        if(!empty($employee_id)){
            $this->db->where('a.employee_id',(int)$employee_id);
        }
        if($searchValue != '')
            $this->db->where($searchQuery);

        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('point_reward a');
        $this->db->join('employee_history b', 'b.employee_id = a.employee_id','left');

        if(!empty($fromdate) && !empty($todate)){
         $this->db->where($datbetween);
        }
        if(!empty($employee_id)){
            $this->db->where('a.employee_id',(int)$employee_id);
        }
        if($searchValue != '')
        $this->db->where($searchQuery);

        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select("a.*,b.first_name as firstname,b.last_name as lastname");
        $this->db->from('point_reward a');
        $this->db->join('employee_history b', 'b.employee_id = a.employee_id','left');

        if(!empty($fromdate) && !empty($todate)){
         $this->db->where($datbetween);
        }
        if(!empty($employee_id)){
            $this->db->where('a.employee_id',(int)$employee_id);
        }
        if($searchValue != '')
        $this->db->where($searchQuery);

        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        $data = array();
        $sl =1;

         foreach($records as $record ){
          $button = '';
          $base_url = base_url();
            
            $data[] = array( 
                'sl'                    =>$sl,
                'attendence_point'      =>$record->attendence != null?$record->attendence:0,
                'collaborative_point'   =>$record->collaborative != null?$record->collaborative:0,
                'management_point'      =>$record->management != null?$record->management:0,
                'total'                 =>$record->total != null?$record->total:0,
                'date'                  =>date('F, Y', strtotime($record->date)),
                
            );

            $sl++;
         }


         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data,
         );

         return $response;
         
    }
    /*Testing Ends*/

     /*Calculating totalnetworkhours for an employee current_day*/
     public function employee_worked_hour_today($employee_id,$mydate){

        $totalhour = 0;
        $totalwasthour = 0;
        $totalnetworkhour = 0;

        $attenddata = $this->db->select('a.time,MIN(a.time) as intime,MAX(a.time) as outtime,a.uid')
        ->from('attendance_history a')
        ->like('a.time',date( "Y-m-d", strtotime($mydate)),'after')
        ->where('a.uid',$employee_id)
        ->get()
        ->result();

        //Getting totalWorkHours
        $date_a = new DateTime($attenddata[0]->outtime);
        $date_b = new DateTime($attenddata[0]->intime);
        $interval = date_diff($date_a,$date_b);

        $totalwhour = $interval->format('%h:%i:%s');

        //End of Getting totalWorkHours

        $att_dates = date( "Y-m-d", strtotime($attenddata[0]->time));            
        $att_in = $this->db->select('a.*,b.first_name,b.last_name')
        ->from('attendance_history a')
        ->join('employee_history b','a.uid = b.employee_id','left')
        ->like('a.time',$att_dates,'after')
        ->where('a.uid',$attenddata[0]->uid)
        ->order_by('a.time','ASC')
        ->get()
        ->result();

        $ix=1;
        $in_data = [];
        $out_data = [];
        foreach ($att_in as $attendancedata) {

            if($ix % 2){
                $status = "IN";
                $in_data[$ix] = $attendancedata->time;

            }else{
                $status = "OUT";
                $out_data[$ix] = $attendancedata->time;
            }
            $ix++;
        } 

        $result_in = array_values($in_data);
        $result_out = array_values($out_data);
        $total = [];
        $count_out = count($result_out);

        if($count_out >= 2){
        $n_out = $count_out-1;
        }else{
         $n_out = 0;   
        }
        for($i=0;$i < $n_out; $i++) {

                $date_a = new DateTime($result_in[$i+1]);
                $date_b = new DateTime($result_out[$i]);
                $interval = date_diff($date_a,$date_b);

            $total[$i] =  $interval->format('%h:%i:%s');
        }

        $hou = 0;
        $min = 0;
        $sec = 0;
        $totaltime = '00:00:00';
        $length = sizeof($total);

        for($x=0; $x <= $length; $x++){
                $split = explode(":", @$total[$x]); 
                $hou += @(integer)$split[0];
                $min += @$split[1];
                $sec += @$split[2];
        }

        $seconds = $sec % 60;
        $minutes = $sec / 60;
        $minutes = (integer)$minutes;
        $minutes += $min;
        $hours = $minutes / 60;
        $minutes = $minutes % 60;
        $hours = (integer)$hours;
        $hours += $hou % 24;

        $totalwasthour = $hours.":".$minutes.":".$seconds;

        $date_a = new DateTime($totalwhour);
        $date_b = new DateTime($totalwasthour);
        $networkhours = date_diff($date_a,$date_b);

        $totalnetworkhour = $networkhours->format('%h');

        return (int)$totalnetworkhour;

     }

     public function employee_attn_history($data){

        $att_dates = date( "Y-m-d", strtotime($data['time']));            
        $att_in = $this->db->select('*')
        ->from('attendance_history a')
        ->like('a.time',$att_dates,'after')
        ->where('a.uid',$data['uid'])
        ->order_by('a.atten_his_id','ASC')
        ->get()
        ->num_rows();

        return $att_in;

     }

     public function employee_attn_in_time($data){

        $attendence = $this->db->select('a.time,MIN(a.time) as intime,MAX(a.time) as outtime,a.uid')
        ->from('attendance_history a')
        ->like('a.time',date( "Y-m-d", strtotime($data['time'])),'after')
        ->where('a.uid',$data['uid'])
        ->order_by('a.time','ASC')
        ->get()
        ->result();

        $dt = new DateTime($attendence[0]->intime);
        $in_time = $dt->format('H:i');

        return $in_time;

     }

     public function get_attendence($data){

        $date_start = $data['start_date'];
        $date_end = $data['end_date'];
        
        $datbetween = "(DATE(attendance_history.time) >= '$date_start' AND DATE(attendance_history.time) <= '$date_end')";
        $attn_his = $this->db->select('*')
        ->from('attendance_history')
        ->where($datbetween)
        ->order_by('attendance_history.uid','ASC')
        ->order_by('attendance_history.time','ASC')
        ->get()
        ->result();

        return $attn_his;


     }
    /*End of Calculation totalnetworkhour for an employee*/
    
    // Get individual employee dashborad box data
    public function get_employee_box_data(){

        $data_boxes = array();

        $employee_id = $this->session->userdata['employee_id'];

        $current_date = date("Y-m-d h:i:sa");
        $dt = new DateTime($current_date);
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');

        //Total points of employee
        $this->db->select_sum('total');
        $this->db->from('point_reward');
        $this->db->where('employee_id',$employee_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data_total = $query->result();
        } else {
            $data_total = array('total' => 0);
        }

        $data_boxes['total'] = $data_total[0]->total;

        //Attendence point current year
        $this->db->select_sum('point');
        $this->db->from('point_attendence');
        $this->db->where('employee_id',$employee_id);
        $this->db->where("YEAR(create_date)=".$date_y,NULL, FALSE);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data_attendence = $query->result();
        } else {
            $data_attendence = array('point' => 0);
        }

        $data_boxes['attendence'] = $data_attendence[0]->point;

        //Collaborative point current year

        $this->db->select_sum('point');
        $this->db->from('point_collaborative');
        $this->db->where('point_shared_with',$employee_id);
        $this->db->where("YEAR(point_date)=".$date_y,NULL, FALSE);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data_collaborative = $query->result();
        } else {
            $data_collaborative = array('point' => 0);
        }

        $data_boxes['collaborative'] = $data_collaborative[0]->point;

        //Management point current year
        $this->db->select_sum('point');
        $this->db->from('point_management');
        $this->db->where('employee_id',$employee_id);
        $this->db->where("YEAR(create_date)=".$date_y,NULL, FALSE);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data_management = $query->result();
        } else {
            $data_management = array('point' => 0);
        }

        $data_boxes['management'] = $data_management[0]->point;

        return $data_boxes;


    }


}


