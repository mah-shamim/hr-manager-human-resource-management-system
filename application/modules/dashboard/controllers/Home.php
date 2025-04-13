<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->db->query('SET SESSION sql_mode = ""');
 		$this->load->model('home_model'); 
 		$this->load->model('rewardpoint/rewardpoints_model');

		if (! $this->session->userdata('isLogIn'))
			redirect('login');
 	}
 
		function index(){

        //Getting permission_exception from Permission library and showing exception message..
        if ($this->session->userdata('isLogIn') && $this->session->userdata('permission_exception')){

            $this->session->unset_userdata('permission_exception');
            $this->session->set_flashdata('exception', "You do not have permission to access. Please contact with administrator.");

        }
        //End of getting permission exception

	    $data['title']      = "Dashboard";
	    $data['ttle_empl']	 = $this->db->count_all('employee_history');
	    $data['present_empl']= $this->home_model->count_attent_employee();
	    $data['male']	     = $this->home_model->count_male_employee();
	    $data['female']	     = $this->home_model->count_female_employee();	
        $data['todys_leave'] = $this->home_model->leave_employee()->leave_total;
        $last_30days = $data['last_30days'] = $this->home_model->last_thirtydays_attendance();

        $attendancelabel='';
	                  foreach($last_30days as $alldays) {
                              
                               if (!empty($alldays['mydate'])) {
                                    $attendancelabel.=$alldays['mydate'].",";
                                     }else{
                                $attendancelabel.=",";
                               }
                            } 
         $attendancedata='';
	                  foreach($last_30days as $alldays) {
                               $value = $this->home_model->count_30daysattendance($alldays['mydate']);
                               if (!empty($value)) {
                                    $attendancedata.=$value.",";
                                     }else{
                                $attendancedata.=",";
                               }
                            } 
                     $tlvmonth = '';
                    $month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                    for ($i=0; $i <= 11; $i++) {
                        $tlvmonth.=  $month[$i].',';
                            }
               
        $data['month']          = $tlvmonth;
         $recruitedemployee='';
	                  for ($i=1; $i <= 12; $i++) {
                               $hired = $this->home_model->hired_employee_current_year($i);
                               if (!empty($hired)) {
                                    $recruitedemployee.=$hired.",";
                                     }else{
                                $recruitedemployee.=",";
                               }
                            } 
        $data['recruitedemp']   = $recruitedemployee;
        $data['attendanclabel'] = $attendancelabel;
        $data['attendancdata'] = $attendancedata;
        $absent_15days = $this->home_model->last_15days_absent();
         $totalabsentfftdayslabel='';
		       foreach($absent_15days as $allabdate){
		        $abdate =  $allabdate['mydate'];
		         if (!empty($abdate)) {
		                $totalabsentfftdayslabel.=$abdate.",";}else{
		                 $totalabsentfftdayslabel.=","; }
		      }

		$totalabsentfftdaysval='';
		       foreach($absent_15days as $allabdate){
		        $absbalue = $this->home_model->count_15daysabsent($allabdate['mydate']);
		         if (!empty($absbalue)) {
		             $totalabsentfftdaysval.=$absbalue.","; }else{
		             $totalabsentfftdaysval.=",";  }
		      }
		$data['abdfftdaylabel'] = $totalabsentfftdayslabel; 
		$data['abdfftdayval']  = $totalabsentfftdaysval;

		$loanstatisticpayment='';
	                  for ($i=1; $i <= 12; $i++) {
                                 $loanpayment = $this->home_model->givenloan($i);
                               if (!empty($loanpayment)) {
                                    $loanstatisticpayment.=$loanpayment.",";
                                     }else{
                                $loanstatisticpayment.=",";
                               }
                            }  

       $loanstatisticreceived='';
	                  for ($i=1; $i <= 12; $i++) {
                                 $loanreceived = $this->home_model->receivedloan($i);
                               if (!empty($loanreceived)) {
                                    $loanstatisticreceived.=$loanreceived.",";
                                     }else{
                                $loanstatisticreceived.=",";
                               }
                            }
        $awardedemployee = '';
                  for ($i=1; $i <= 12; $i++) {
                               $awarded = $this->home_model->awarded_person($i);
                               if (!empty($awarded)) {
                                    $awardedemployee .= $awarded.",";
                               }else{
                                $awardedemployee .= ",";
                               }
                            }
        $data['loanstatisticpayment'] = $loanstatisticpayment; 
        $data['loanstatisticreceived'] = $loanstatisticreceived;
        $data['awardedempl']  =  $awardedemployee;                      
        $data['notice']      = $this->home_model->notice_list();
		$data['lnamountpaid']= $this->home_model->paidloanamnt();
		$data['lnreceiveamount'] = $this->home_model->receiveloanamnt();
		$data['latestrecruitedemple'] = $this->home_model->latest_recuited_employee();
		$data['employee_points']   = $this->rewardpoints_model->dshboard_employee_points();
		$data['employee_box_data']   = $this->rewardpoints_model->get_employee_box_data();
		$data['module']      = "dashboard";
		$data['page']        = "home/index";
		echo Modules::run('template/layout', $data); 
	}
	



	public function profile()
	{
		$data['title']  = "Profile";
		$data['module'] = "dashboard";  
		$data['page']   = "home/profile";  
		$id = $this->session->userdata('id');//
		$data['user']   = $this->home_model->profile($id);
		echo Modules::run('template/layout', $data);  
	}

	public function setting()
	{ 
		$data['title']    = "Profile Setting";
		$id = $this->session->userdata('id');
		/*-----------------------------------*/
		$this->form_validation->set_rules('firstname', 'First Name','required|max_length[50]');
		$this->form_validation->set_rules('lastname', 'Last Name','required|max_length[50]');
		#------------------------#
       	$this->form_validation->set_rules('email', 'Email Address', "required|valid_email|max_length[100]");
       	/*---#callback fn not supported#---*/ 
		#------------------------#
		$this->form_validation->set_rules('password', 'Password','max_length[32]|md5');
		$this->form_validation->set_rules('about', 'About','max_length[1000]');
		/*-----------------------------------*/
        $config['upload_path']          = './assets/img/user/';
        $config['allowed_types']        = 'gif|jpg|png'; 

        $this->load->library('upload', $config);
 
        if ($this->upload->do_upload('image')) {  
            $data = $this->upload->data();  
            $image = $config['upload_path'].$data['file_name']; 

			$config['image_library']  = 'gd2';
			$config['source_image']   = $image;
			$config['create_thumb']   = false;
			$config['maintain_ratio'] = TRUE;
			$config['width']          = 115;
			$config['height']         = 90;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->session->set_flashdata('message', "Image Upload Successfully!");
        }

        	

		/*-----------------------------------*/
		$data['user'] = (object)$userData = array(
			'id' 		  => $this->input->post('id'),
			'firstname'   => $this->input->post('firstname',true),
			'lastname' 	  => $this->input->post('lastname',true),
			'email' 	  => $this->input->post('email',true),
			'password' 	  => (!empty($this->input->post('password',true))?md5($this->input->post('password',true)):$this->input->post('oldpassword',true)),
			'about' 	  => $this->input->post('about',true),
			'image'   	  => (!empty($image)?$image:$this->input->post('old_image')) 
		);

		/*-----------------------------------*/
		if ($this->form_validation->run()) {
		    
            $old_email = $this->input->post('old_email',true);
            
            if($old_email != $this->input->post('email',true)){
            	$this->session->set_flashdata('exception',  'Please contact with admin to change email from Employee section !');
            	redirect("dashboard/home/setting");
            
            }

	      if ($image === false) {
			$this->session->set_flashdata('exception', display('invalid_logo'));
		}


			if ($this->home_model->setting($userData)) {

				$this->session->set_userdata(array(
					'fullname'   => $this->input->post('firstname',true). ' ' .$this->input->post('lastname',true),
					'email' 	  => $this->input->post('email',true),
					'image'   	  => (!empty($image)?$image:$this->input->post('old_image'))
				));


				$this->session->set_flashdata('message', display('update_successfully'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("dashboard/home/setting");

		} else {
			$data['module'] = "dashboard";  
			$data['page']   = "home/profile_setting"; 
			if(!empty($id))
			$data['user']   = $this->home_model->profile($id);
			echo Modules::run('template/layout', $data);
		}
	}
	///// Notice 
	 public function view_details(){
        $id = $this->uri->segment(4);
		$data['module'] = "dashboard";  
		$data['page']   = "home/notice_details";  
		$data['detls']   = $this->evencal->details($id);
       echo Modules::run('template/layout', $data); 

    }


	public function incomeinfo(){
     $year = $this->input->post('year',true);
     echo json_encode($year);
	}

	public function hired_employee_current_year($month){
      $data = $this->home_model->hired_employee_current_year($month);
     echo json_encode($data);
	}

	//get_employee_attendence for current month for employee dashboard gaph reports
	public function monthly_employee_attendence(){

		$employee_id = $this->session->userdata['employee_id'];
		$data_arr = [];

		$current_date = date("Y-m-d h:i:sa");
        $dt = new DateTime($current_date);
        $date = $dt->format('Y-m-d');
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');
        $time = $dt->format('H:i:s');

		$this->db->select('*');
        $this->db->from('point_attendence');
        $this->db->where('employee_id',$employee_id);
        $this->db->where('point',1);
        $this->db->where("YEAR(create_date)=".$date_y,NULL, FALSE);
        $this->db->where("MONTH(create_date)=".$date_m,NULL, FALSE);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data_arr = $query->result();  
        }else{
        	$data_arr = array();
        }

        // for each day in the month
        $data_points_fianl = [];
        $data_points = [];

		for($i = 1; $i <=  date('t'); $i++)
		{
		   // add the date to the dates array
		   $dates[] = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
		   $days[] = str_pad($i, 2, '0', STR_PAD_LEFT);

		   $day = str_pad($i, 2, '0', STR_PAD_LEFT);

		   foreach ($data_arr as $key => $value) {

		   		if((int)$day == (int)date( "d", strtotime($value->create_date)) && (int)$value->point == 1){
		   			$data_points[$day] = 1;
		   		}
		   }
		}

		// create days and points based array
		foreach ($days as $key => $value) {

			$respo_days[] = (string)$value;

			if (array_key_exists($value,$data_points))
			{
				$data_points_fianl[$value] = $data_points[$value];
			}
			else{
				$data_points_fianl[$value] = 0;

			}

		}

		$respo_data['days'] = $respo_days;
		$respo_data['points'] = array_values($data_points_fianl);

		echo json_encode($respo_data);
	}

	//yearly_employee_points for employee dashboard gaph reports .. calculating from point_reward table..
	public function yearly_employee_points(){

		$employee_id = $this->session->userdata['employee_id'];
		$data_arr = [];

		$current_date = date("Y-m-d h:i:sa");
        $dt = new DateTime($current_date);
        $date_y = $dt->format('Y');

        $this->db->select('*');
        $this->db->from('point_reward');
        $this->db->where('employee_id',$employee_id);
        $this->db->where("YEAR(date)=".$date_y,NULL, FALSE);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data_arr = $query->result();  
        }else{
        	$data_arr = array();
        }

        $data_reward = array();
        $data_respo_final = array();

        // for each month in the year
        for ($i=1; $i <= 12; $i++) {

        	 $months[] = $i;

        	foreach ($data_arr as $key => $value) {

        		if($i == (int)date( "m", strtotime($value->date))){
        			$data_reward[$i] = (int)$value->total;
        		}
        	}

        }

        // create yearly points array based months and data_reward array
        foreach ($months as $key => $value) {

        	if (array_key_exists($value,$data_reward))
			{
				$data_reward_final[] = $data_reward[$value];
			}else{
				$data_reward_final[] = 0;
			}
        }

		echo json_encode($data_reward_final);

	}
	
    //get_employee_attendence for current month for employee dashboard graph reports
	public function monthly_employee_points(){

        $data_boxes = array();

        $employee_id = $this->session->userdata['employee_id'];

        //Attendence data
        $this->db->select_sum('point');
        $this->db->from('point_attendence');
        $this->db->where('employee_id',$employee_id);
        $this->db->where("create_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data_attendence = $query->result();
        } else {
            $data_attendence = array('point' => 0);
        }

        $data_boxes['attendence'] = $data_attendence[0];

        //Collaborative data
        $current_date = date("Y-m-d h:i:sa");
        $dt = new DateTime($current_date);
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');

        $date_m = $date_m - 1;
        if($date_m == 0){
            $date_y = $date_y - 1;
            $date_m = 12;
        }

        $this->db->select_sum('point');
        $this->db->from('point_collaborative');
        $this->db->where('point_shared_with',$employee_id);
        $this->db->where("YEAR(point_date)=".$date_y,NULL, FALSE);
        $this->db->where("MONTH(point_date)=".$date_m,NULL, FALSE);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data_collaborative = $query->result();
        } else {
            $data_collaborative = array('point' => 0);
        }

        $data_boxes['collaborative'] = $data_collaborative[0];

        //Management data
        $this->db->select_sum('point');
        $this->db->from('point_management');
        $this->db->where('employee_id',$employee_id);
        $this->db->where("create_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data_management = $query->result();
        } else {
            $data_management = array('point' => 0);
        }

        $data_boxes['management'] = $data_management[0];

        $data_points = array();

        if($data_boxes){
                $data_points[] = (int)$data_boxes['attendence']->point;
                $data_points[] = (int)$data_boxes['management']->point;
                $data_points[] = (int)$data_boxes['collaborative']->point;
        }
        else{
            $data_points[] = 0;
            $data_points[] = 0;
            $data_points[] = 0;
        }

        echo json_encode($data_points);

	}

}
