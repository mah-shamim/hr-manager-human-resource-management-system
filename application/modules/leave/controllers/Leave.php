<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends MX_Controller {

public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'Leave_model'
		));	
		if (! $this->session->userdata('isLogIn'))
			redirect('login');	 
	}

public function weekly_leave_view()
	{   
        // $this->permission->method('leave','read')->redirect();
        $this->permission->check_label('weekly_holiday')->read()->access();

		$data['title']    = display('selection');  ;
		$data['weeklev']  = $this->Leave_model->viewWeekly();
		$data['module']   = "leave";
		$data['page']     = "weeklyleave_view";   
		echo Modules::run('template/layout', $data); 
	} 

public function create_weekleave()
	{ 

		$this->permission->check_label('weekly_holiday')->create()->access();

		$data['title'] = display('selectionlist');
		#-------------------------------#
		$this->form_validation->set_rules('dayname[]',display('dayname[]'),'max_length[30]');
		if ($this->form_validation->run() === true) {


			 $Specilized_category = $this->input->post('dayname',true);
  $data=array('dayname'=>implode(",", $Specilized_category),
  );  

			if ($this->Leave_model->weekleave_create($data)) { 
				$this->session->set_flashdata('exception',  display('please_try_again'));
				
				
			} else {
				
				$this->session->set_flashdata('message', display('save_successfully'));
			}
			redirect("leave/Leave/create_weekleave");
		} 
		else {
			$data['title']    = display('create');
			$data['module']   = "leave";
			$data['page']     = "weeklyform"; 
			$data['weeklev']  = $this->Leave_model->viewWeekly();
			echo Modules::run('template/layout', $data);   
			
		}   
	}
public function delete_weekleave($id = null) 
	{ 
		$this->permission->check_label('weekly_holiday')->delete()->access();

        // $this->permission->method('leave','delete')->redirect();

		if ($this->Leave_model->weekleave_delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));

		}
		redirect("leave/Leave/weekly_leave_view");
	}

public function update_weekleave_form($id = null){

		$this->permission->check_label('weekly_holiday')->update()->access();

 		$this->form_validation->set_rules('wk_id');
 		$this->form_validation->set_rules('dayname[]',display('dayname'),'max_length[30]');
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			 $Specilized_category = $this->input->post('dayname',true);
  $dataf=array('wk_id'=>$this->input->post('wk_id',true),
      'dayname'=>implode(",", $Specilized_category),
  
  );  		
			if ($this->Leave_model->update_weeklev($dataf)) { 
				$this->session->set_flashdata('message', display('successfully_updated'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("leave/Leave/create_weekleave");

		} else {
			$data['title']     = display('update');
		    $data['data']      =$this->Leave_model->weekleave_updateForm($id);
			$data['module']    = "leave";	
			$data['page']      = "update_wkleave_form";   
			echo Modules::run('template/layout', $data); 
		}
 
	}

	public function holiday_view()
	{   
        // $this->permission->method('leave','read')->redirect();
        $this->permission->check_label('holiday')->read()->access();

		$data['title']    = display('selection');  ;
		$data['holiday']  = $this->Leave_model->viewholiday();
		$data['weekend'] = $this->db->select('dayname')->from('weekly_holiday')->get()->row()->dayname;
		$data['module']   = "leave";
		$data['page']     = "holiday_form";   
		echo Modules::run('template/layout', $data); 
	} 

public function manage_holiday(){   
        // $this->permission->method('leave','read')->redirect();
        $this->permission->check_label('holiday')->read()->access();

		$data['title']    = display('selection');  ;
		$data['holiday']  = $this->Leave_model->viewholiday();
		$data['module']   = "leave";
		$data['page']     = "holiday_view";   
		echo Modules::run('template/layout', $data); 
	} 


public function create_holiday(){ 

	$this->permission->check_label('holiday')->create()->access();

		$data['title'] = display('ab');
		#-------------------------------#
		$this->form_validation->set_rules('holiday_name',display('holiday_name'),'required|max_length[50]');
		$this->form_validation->set_rules('start_date',display('start_date'),'required|max_length[12]');
		$this->form_validation->set_rules('end_date',display('end_date'),'required|max_length[12]');
		$this->form_validation->set_rules('no_of_days',display('no_of_days'),'required|max_length[12]');
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$postData = [
				'holiday_name'       => $this->input->post('holiday_name',true),
				'start_date' 	     => $this->input->post('start_date',true),
				'end_date' 	         => $this->input->post('end_date',true),
				'no_of_days' 	     => $this->input->post('no_of_days',true),
				
			];   

			if ($this->Leave_model->holiday_create($postData)) { 
				$this->session->set_flashdata('message', display('successfully_saved'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("leave/Leave/holiday_view");



		} else {
			$data['title']  = display('create');
			$data['module'] = "leave";
			$data['page']   = ""; 
			echo Modules::run('template/layout', $data);   
			
		}   
	}


public function delete_holiday($id = null){ 

        // $this->permission->module('leave','delete')->redirect();
        $this->permission->check_label('holiday')->delete()->access();

		if ($this->Leave_model->holiday_delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("leave/Leave/holiday_view");
	}

	public function update_holiday_form($id = null){

		$this->permission->check_label('holiday')->update()->access();

 		$this->form_validation->set_rules('payrl_holi_id',null,'required|max_length[11]');
 		$this->form_validation->set_rules('holiday_name',display('holiday_name'),'max_length[30]');
 		$this->form_validation->set_rules('start_date',display('start_date'),'max_length[30]');
 		$this->form_validation->set_rules('end_date',display('end_date'),'max_length[30]');
 		$this->form_validation->set_rules('no_of_days',display('no_of_days'),'max_length[30]');
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$postData = [
			    'payrl_holi_id'  => $this->input->post('payrl_holi_id',true),
				'holiday_name'   => $this->input->post("holiday_name",true),
				'start_date'     => $this->input->post("start_date",true),
                'end_date'       => $this->input->post("end_date",true),
                'no_of_days'     => $this->input->post("no_of_days",true),


			]; 
			
			if ($this->Leave_model->update_holiday($postData)) { 
				$this->session->set_flashdata('message', display('successfully_updated'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("leave/Leave/holiday_view");

		} else {
			$data['title']     = display('update');
		    $data['data']      =$this->Leave_model->holiday_updateForm($id);
		   
			$data['module']    = "leave";	
			$data['page']      = "update_holiday_form";   
			echo Modules::run('template/layout', $data); 
		}
 
	}

public function application(){ 
	
		$this->permission->check_label('leave_application')->create()->access();

        $data['title'] = display('application');
        #-------------------------------#
        $this->form_validation->set_rules('employee_id',display('employee_id'));
		$this->form_validation->set_rules('apply_strt_date',display('apply_strt_date'));
		$this->form_validation->set_rules('apply_end_date',display('apply_end_date'),'max_length[50]');
		$this->form_validation->set_rules('leave_aprv_strt_date',display('leave_aprv_strt_date')  ,'max_length[100]');
		$this->form_validation->set_rules('leave_aprv_end_date',display('leave_aprv_end_date')  ,'max_length[32]');
		$this->form_validation->set_rules('num_aprv_day',display('num_aprv_day')  ,'max_length[100]');
		$this->form_validation->set_rules('reason',display('reason')  ,'max_length[100]');
		    $this->load->library('Fileupload');
          $img = $this->fileupload->do_upload(
            './application/modules/leave/assets/images/', 
            'apply_hard_copy'); 
		$this->form_validation->set_rules('apply_date',display('apply_date')  ,'max_length[100]');
		$this->form_validation->set_rules('approve_date',display('approve_date')  ,'max_length[100]');
		$this->form_validation->set_rules('approved_by',display('approved_by'));
		$this->form_validation->set_rules('leave_type',display('leave_type'));
        
      
        #-------------------------------#
        if ($this->form_validation->run() === true) {
				$postData = [
			'employee_id'           => $this->input->post('employee_id',true),
			'apply_strt_date' 	    => $this->input->post('apply_strt_date',true),
			'apply_end_date' 	    => $this->input->post('apply_end_date',true),
			'leave_aprv_strt_date' 	=> $this->input->post('leave_aprv_strt_date',true),
			'leave_aprv_end_date' 	=> $this->input->post('leave_aprv_end_date',true),
			'num_aprv_day' 	        => $this->input->post('num_aprv_day',true),
			'reason' 	            => $this->input->post('reason',true),
			'apply_date' 	        => $this->input->post('apply_date',true),
			'approve_date' 	        => $this->input->post('approve_date',true),
			'approved_by' 	        => $this->input->post('approved_by',true),
			'leave_type' 	        => $this->input->post('leave_type',true),
            'apply_hard_copy'       => $img,
                
            ];   

            if ($this->Leave_model->application_create($postData)) { 
                $this->session->set_flashdata('message', display('successfully_created'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("leave/Leave/application");



        } else {
            $data['title']   = display('leave');
            $data['module']  = "leave";
            $data['dropdown']= $this->Leave_model->dropdown();
            $data['mang']    = $this->Leave_model->manageleave();
            $data['page']    = "application_form";    
          echo Modules::run('template/layout', $data); 
        }   
    }

    // others leave info
  public function others_leave(){ 

        $data['title'] = display('application');
        #-------------------------------#
        $this->form_validation->set_rules('employee_id',display('employee_id'),'required');
		$this->form_validation->set_rules('apply_strt_date',display('apply_strt_date'),'required');
		$this->form_validation->set_rules('apply_end_date',display('apply_end_date'),'max_length[50]|required');
		$this->form_validation->set_rules('leave_type_id',display('leave_type'),'required');

		$this->load->library('Fileupload');
		$this->load->library('myupload');

		// Check file uploaded then, if the file valid or not
		if(isset($_FILES['apply_hard_copy']['name']) && !empty($_FILES['apply_hard_copy']['name'])){

			$extension = pathinfo($_FILES['apply_hard_copy']['name'], PATHINFO_EXTENSION);

			if(!$this->myupload->valid_file_extension($extension)){

				$this->session->set_flashdata('exception',  "Please select a valid file !");
				redirect('leave/Leave/others_leave');
			}
		}
		// End of file extension validation

          $img = $this->fileupload->do_upload(
            './application/modules/leave/assets/images/', 
            'apply_hard_copy'); 
		$this->form_validation->set_rules('apply_date',display('apply_date')  ,'max_length[100]');
		$this->form_validation->set_rules('approve_date',display('approve_date')  ,'max_length[100]');
      
        #-------------------------------#
        if ($this->form_validation->run() === true) {

        	$this->permission->check_label('leave_application')->create()->access();

				$postData = [
			'employee_id'           => $this->input->post('employee_id',true),
			'leave_type_id'         => $this->input->post('leave_type_id',true),
			'apply_strt_date' 	    => $this->input->post('apply_strt_date',true),
			'apply_end_date' 	    => $this->input->post('apply_end_date',true),
			'leave_aprv_strt_date' 	=> (!empty($this->input->post('leave_aprv_strt_date',true))?$this->input->post('leave_aprv_strt_date',true):'0000-00-00'),
			'leave_aprv_end_date' 	=> (!empty($this->input->post('leave_aprv_end_date',true))?$this->input->post('leave_aprv_end_date',true):'0000-00-00'),
			'num_aprv_day' 	        => (!empty($this->input->post('num_aprv_day',true))?$this->input->post('num_aprv_day',true):0),
			'reason' 	            => $this->input->post('reason',true),
			'apply_date' 	        => $this->input->post('apply_date',true),
			'approve_date' 	        => (!empty($this->input->post('approve_date',true))?$this->input->post('approve_date',true):'0000-00-00'),
			'apply_day'             => $this->input->post('apply_day',true),
			'approved_by' 	        => (!empty($this->input->post('approved_by',true))?$this->input->post('approved_by',true):0),
            'apply_hard_copy'       => (!empty($img)?$img:null),
                
            ];   


            if ($this->Leave_model->application_create($postData)) { 
                $this->session->set_flashdata('message', display('successfully_created'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("leave/Leave/others_leave");

        } else {

        	$this->permission->check_label('leave_application')->read()->access();

            $data['title']   = display('leave');
            $data['module']  = "leave";
            $data['type']    = $this->Leave_model->get_leave_type();
            $data['dropdown']= $this->Leave_model->dropdown();
            $data['mang']    = $this->Leave_model->manageleave();
            $data['supr']    = $this->Leave_model->supervisorList();
            $data['weekend'] = $this->db->select('dayname')->from('weekly_holiday')->get()->row()->dayname;
            $data['page']    = "other_leave_application_form";    
          echo Modules::run('template/layout', $data); 
        }   
    }


public function download(){
    $this->load->helper('download');
    $filepath = $this->input->get('file',true);
    if (file_exists($filepath)) {
        return force_download($filepath, NULL);
    } else {
        return false;
    }
} 
    // add others leave type form
	public function add_leave_type()
	 {

	  $data['title'] = display('leave_type');
	  #-------------------------------#
	  $this->form_validation->set_rules('leave_type', display('leave_type_name')  ,'required|max_length[100]');
	  $this->form_validation->set_rules('leave_days',display('number_of_leave_days'),'max_length[30]');
	  #-------------------------------#
	  if ($this->form_validation->run() === true) {
		   $postData = [
		   'leave_type'    => $this->input->post('leave_type', true),
		   'leave_days'    => $this->input->post('leave_days', true) 
		  ];
	 
	  	if ($this->Leave_model->save_leave_type($postData)) { 

  	 		$this->permission->check_label('add_leave_type')->create()->access();

            $this->session->set_flashdata('message', display('successfully_created'));

	    }else{
	            $this->session->set_flashdata('exception',  display('please_try_again'));
	    }

	        redirect("leave/Leave/add_leave_type");
	    }
	   else { 

	   	 $this->permission->check_label('add_leave_type')->read()->access();

	    $data['title'] = display('leave_type');
	    $data['module'] = "leave";
	    $data['type']= $this->Leave_model->get_all_leave_type();
	    $data['page']   = "leave_type_form";   
	    echo Modules::run('template/layout', $data); 
	   }   
	 }

 // update leave type 
  public function update_leave_type($id = nul){

  	$this->permission->check_label('add_leave_type')->update()->access();

  		$data['title'] = display('update');
	  #-------------------------------#
	  $this->form_validation->set_rules('leave_type', display('leave_type_name')  ,'required|max_length[100]');
	  $this->form_validation->set_rules('leave_days',display('number_of_leave_days'),'max_length[30]');
	  #-------------------------------#
	  if ($this->form_validation->run() === true) {
		   $postData = [
		   	'leave_type_id' => $this->input->post('leave_type_id', true),
		   'leave_type'    => $this->input->post('leave_type', true),
		   'leave_days'    => $this->input->post('leave_days', true) 
		  ];
	 
	  if ($this->Leave_model->save_update_leave_type($postData)) { 
	           $this->session->set_flashdata('message', display('successfully_created'));
	           redirect("leave/Leave/add_leave_type");
	        } else {
	            $this->session->set_flashdata('exception',  display('please_try_again'));
	            redirect("leave/Leave/add_leave_type");
	        }
	        
	    }
	   else { 
	    $data['title'] = display('update');
	    $data['module'] = "leave";
	    $data['data']= $this->Leave_model->get_leave_type_by_id($id);
	    $data['page']   = "update_leave_type_form";   
	    echo Modules::run('template/layout', $data); 
	   }   
  }

 // delete leave type
  public function delete_leave_type($id = null){ 

  		$this->permission->check_label('add_leave_type')->delete()->access();

        // $this->permission->module('leave','delete')->redirect();

		if ($this->Leave_model->delete_leave_type($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("leave/Leave/add_leave_type");
	}

  public function delete_application($id = null){ 

  		$this->permission->check_label('leave_application')->delete()->access();

        // $this->permission->module('leave','delete')->redirect();

		if ($this->Leave_model->application_delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("leave/Leave/application_view");
	}
	public function application_view(){   

        // $this->permission->method('leave','read')->redirect();
        $this->permission->check_label('leave_application')->read()->access();

		$data['title']  = display('selection');  ;
		$data['mang']   = $this->Leave_model->manageleave();
		$data['module'] = "leave";
		$data['page']   = "application_view";   
		echo Modules::run('template/layout', $data); 
	} 
	public function update_application_form($id = null){

		$this->permission->check_label('leave_application')->update()->access();

 		$this->form_validation->set_rules('leave_appl_id',null,'max_length[11]');
 		$this->form_validation->set_rules('apply_strt_date',display('apply_strt_date'),'required');
 		$this->form_validation->set_rules('employee_id',display('employee'),'required');
		$this->form_validation->set_rules('apply_end_date',display('apply_end_date'),'required');
		if($this->session->userdata('isAdmin')==1 || $this->session->userdata('supervisor')==1 || $this->permission->check_label('leave_approval')->update()->access()){
			$this->form_validation->set_rules('leave_aprv_strt_date',display('leave_aprv_strt_date')  ,'required|max_length[100]');
			$this->form_validation->set_rules('leave_aprv_end_date',display('leave_aprv_end_date')  ,'required|max_length[32]');
			$this->form_validation->set_rules('num_aprv_day',display('num_aprv_day')  ,'max_length[100]');
		}
		
		$this->form_validation->set_rules('reason',display('reason')  ,'max_length[100]');

		$this->load->library('Fileupload');
		$this->load->library('myupload');

		// Check file uploaded then, if the file valid or not

		if(isset($_FILES['apply_hard_copy']['name']) && !empty($_FILES['apply_hard_copy']['name'])){ 

			$extension = pathinfo($_FILES['apply_hard_copy']['name'], PATHINFO_EXTENSION);

			if(!$this->myupload->valid_file_extension($extension)){

				$this->session->set_flashdata('exception',  "Please select a valid file !");
				redirect('leave/Leave/others_leave');
			}
		}
		// End of file extension validation

        $img = $this->myupload->do_upload(
            './application/modules/leave/assets/images/', 
            'apply_hard_copy');    
		$this->form_validation->set_rules('apply_date',display('apply_date')  ,'max_length[100]');
		$this->form_validation->set_rules('approve_date',display('approve_date')  ,'max_length[100]');
		$this->form_validation->set_rules('approved_by',display('approved_by'));
		$this->form_validation->set_rules('leave_type_id',display('leave_type'),'required');
		
		$empdata = $this->db->select('email')->from('employee_history')->where('employee_id',$this->input->post('employee_id',true))->get()->row();
		$userdata = $this->db->select('*')->from('user')->where('email',$empdata->email)->get()->row();
		
		$settingdata = $this->db->select('*')->from('appsetting')->get()->row();
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$leave_apply_data = $this->db->select('*')->from('leave_apply')->where('leave_appl_id',$this->input->post('leave_appl_id',true))->get()->row();
			if($leave_apply_data->status == 1){
				if(!$this->session->userdata('isAdmin')==1 && !$this->session->userdata('supervisor')==1 && !$this->permission->check_label('leave_approval')->update()->access()){

					$this->session->set_flashdata('exception',  "Leave already approved !");
					redirect('leave/Leave/others_leave');
				}
			}

			$postData = [
			'leave_appl_id' 	    => $this->input->post('leave_appl_id',true),
		    'employee_id'           => $this->input->post('employee_id',true),
			'apply_strt_date' 	    => $this->input->post('apply_strt_date',true),
			'apply_end_date' 	    => $this->input->post('apply_end_date',true),
			'leave_aprv_strt_date' 	=> (!empty($this->input->post('leave_aprv_strt_date',true))?$this->input->post('leave_aprv_strt_date',true):'0000-00-00'),
			'leave_aprv_end_date'   => (!empty($this->input->post('leave_aprv_end_date',true))?$this->input->post('leave_aprv_end_date',true):'0000-00-00'),
			'num_aprv_day' 	        => (!empty($this->input->post('num_aprv_day',true))?$this->input->post('num_aprv_day',true):0),
			'reason' 	            => $this->input->post('reason',true),
			'apply_date' 	        => $this->input->post('apply_date',true),
			'approve_date' 	        => (!empty($this->input->post('approve_date',true))?$this->input->post('approve_date',true):'0000-00-00'),
			'approved_by' 	        => $this->input->post('approved_by',true),
			'apply_day'             => $this->input->post('apply_day',true),
			'leave_type' 	        => $this->input->post('leave_type',true),
            'apply_hard_copy'       => (!empty($img) ? $img : $this->input->post('old_apply_hard_copy')),
            'leave_type_id'           => $this->input->post('leave_type_id',true),

			]; 
			
			if ($this->Leave_model->update_application($postData)) { 
			  if($this->input->post('status',true) == 1){
			    $icon='https://newhrm.bdtask.com/hrm_app_version/assets/img/icons/2017-07-22/HRM.png';
                		    $fields3 = array(
                    		'to'=> $userdata->token_id,
                    		'data'=>array(
                    			'title'=> 'Your leave has been granted',
                    			'body'=> 'You are approved for'.$this->input->post('num_aprv_day',true).' days leave' ,
                    			'image'=>$icon,
                    			'media_type'=>"image",
                    			"action"=> "1",
                    		),
                    		'notification'=>array(
                    			'sound'=>"default",
                    			'title'=>'Your leave has been granted',
                    			'body'=> 'You are approved for'.$this->input->post('num_aprv_day',true).' days leave' ,
                    			'image'=>$icon,
                    		)
                    	);
                	$post_data3 = json_encode($fields3);
                	$url = "https://fcm.googleapis.com/fcm/send";
                	$ch3  = curl_init($url); 
                	curl_setopt($ch3, CURLOPT_FAILONERROR, TRUE); 
                	curl_setopt($ch3, CURLOPT_RETURNTRANSFER, TRUE);
                	curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0); 
                	curl_setopt($ch3, CURLOPT_POSTFIELDS, $post_data3);
                	curl_setopt($ch3, CURLOPT_HTTPHEADER, array($settingdata->googleapi_authkey,
                	    'Content-Type: application/json')
                	);
                	$result3 = curl_exec($ch3);
                	curl_close($ch3);   
			  }
			    
				$this->session->set_flashdata('message', display('successfully_updated'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("leave/Leave/application_view");

		}else{
			$data['title']     = display('update');
		    $data['data']      = $this->Leave_model->application_updateForm($id);
		    $data['dropdown']  = $this->Leave_model->dropdown();
		    $data['bb']        = $this->Leave_model->get_id($id);
		    $data['type']      = $this->Leave_model->get_leave_type();
		    $data['supr']      = $this->Leave_model->supervisorList();
		    $data['weekend'] = $this->db->select('dayname')->from('weekly_holiday')->get()->row()->dayname;
			$data['module']    = "leave";	
			$data['page']      = "update_application_form";   
			echo Modules::run('template/layout', $data); 
		}
 
	}
	// Leave free for employee
	public function free_leave(){
		$employee_id    = $this->input->post('employee_id',true);
		$type           = $this->input->post('leave_type',true);
		$employee_leave = $this->db->select('SUM(num_aprv_day) as lv')->from('leave_apply')->where('employee_id',$employee_id)->where('leave_type_id',$type)->get()->row();
		$totalleave = $this->db->select('leave_days')->from('leave_type')->where('leave_type_id',$type)->get()->row();
		$data = array(
			'enjoy' => (!empty($employee_leave->lv)?$employee_leave->lv:0),
			'due'   => (!empty($totalleave->leave_days)?$totalleave->leave_days:0),
		);
		echo json_encode($data);
	}
	
	
		public function approve_application_form($id = null){

		$this->permission->check_label('leave_approval')->update()->access();

 		$this->form_validation->set_rules('leave_appl_id',null,'max_length[11]');
 		$this->form_validation->set_rules('apply_strt_date',display('apply_strt_date'));
		$this->form_validation->set_rules('apply_end_date',display('apply_end_date'),'max_length[50]');
		$this->form_validation->set_rules('leave_aprv_strt_date',display('leave_aprv_strt_date')  ,'max_length[100]|required');
		$this->form_validation->set_rules('leave_aprv_end_date',display('leave_aprv_end_date')  ,'max_length[32]|required');
		$this->form_validation->set_rules('num_aprv_day',display('num_aprv_day')  ,'max_length[100]');
		$this->form_validation->set_rules('reason',display('reason')  ,'max_length[100]');
		$this->load->library('Fileupload');
        $img = $this->fileupload->do_upload(
            './application/modules/leave/assets/images/', 
            'apply_hard_copy');    
		$this->form_validation->set_rules('apply_date',display('apply_date')  ,'max_length[100]');
		$this->form_validation->set_rules('approve_date',display('approve_date')  ,'max_length[100]');
		$this->form_validation->set_rules('approved_by',display('approved_by'));
		$this->form_validation->set_rules('leave_type',display('leave_type'));
			$this->form_validation->set_rules('status',display('status')  ,'max_length[2]|required');
		$empdata = $this->db->select('email')->from('employee_history')->where('employee_id',$this->input->post('employee_id',true))->get()->row();
		$userdata = $this->db->select('*')->from('user')->where('email',$empdata->email)->get()->row();
		
		$settingdata = $this->db->select('*')->from('appsetting')->get()->row();
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$postData = [
			'leave_appl_id' 	    => $this->input->post('leave_appl_id',true),
		    'employee_id'           => $this->input->post('employee_id',true),
			'apply_strt_date' 	    => $this->input->post('apply_strt_date',true),
			'apply_end_date' 	    => $this->input->post('apply_end_date',true),
			'leave_aprv_strt_date' 	=> (!empty($this->input->post('leave_aprv_strt_date',true))?$this->input->post('leave_aprv_strt_date',true):'0000-00-00'),
			'leave_aprv_end_date'   => (!empty($this->input->post('leave_aprv_end_date',true))?$this->input->post('leave_aprv_end_date',true):'0000-00-00'),
			'num_aprv_day' 	        => (!empty($this->input->post('num_aprv_day',true))?$this->input->post('num_aprv_day',true):0),
			'reason' 	            => $this->input->post('reason',true),
			'apply_date' 	        => $this->input->post('apply_date',true),
			'approve_date' 	        => (!empty($this->input->post('approve_date',true))?$this->input->post('approve_date',true):'0000-00-00'),
			'approved_by' 	        => $this->input->post('approved_by',true),
			'apply_day'             => $this->input->post('apply_day',true),
			'leave_type' 	        => $this->input->post('leave_type',true),
            'apply_hard_copy'       => (!empty($img) ? $img : $this->input->post('old_apply_hard_copy')),
            'leave_type_id'           => $this->input->post('leave_type_id',true),
            'status'                => $this->input->post('status',true),

			]; 
			
			if ($this->Leave_model->update_application($postData)) { 
			  if($this->input->post('status',true) == 1){
			    $icon='https://newhrm.bdtask.com/hrm_app_version/assets/img/icons/2017-07-22/HRM.png';
                		    $fields3 = array(
                    		'to'=> $userdata->token_id,
                    		'data'=>array(
                    			'title' => 'Your leave has been granted',
                    			'body'  => 'You are approved for'.$this->input->post('num_aprv_day',true).' days leave' ,
                    			'image'=>$icon,
                    			'media_type'=>"image",
                    			"action"=> "1",
                    		),
                    		'notification'=>array(
                    			'sound' =>"default",
                    			'title' =>'Your leave has been granted',
                    			'body'  => 'You are approved for'.$this->input->post('num_aprv_day',true).' days leave' ,
                    			'image'=>$icon,
                    		)
                    	);
                	$post_data3 = json_encode($fields3);
                	$url = "https://fcm.googleapis.com/fcm/send";
                	$ch3  = curl_init($url); 
                	curl_setopt($ch3, CURLOPT_FAILONERROR, TRUE); 
                	curl_setopt($ch3, CURLOPT_RETURNTRANSFER, TRUE);
                	curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0); 
                	curl_setopt($ch3, CURLOPT_POSTFIELDS, $post_data3);
                	curl_setopt($ch3, CURLOPT_HTTPHEADER, array($settingdata->googleapi_authkey,
                	    'Content-Type: application/json')
                	);
                	$result3 = curl_exec($ch3);
                	curl_close($ch3);   
			  }
			    
				$this->session->set_flashdata('message', display('successfully_updated'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("leave/Leave/application_view");

		}else{
			$data['title']     = display('approve');
		    $data['data']      = $this->Leave_model->application_updateForm($id);
		    $data['dropdown']  = $this->Leave_model->dropdown();
		    $data['bb']        = $this->Leave_model->get_id($id);
		    $data['type']      = $this->Leave_model->get_leave_type();
		    $data['supr']      = $this->Leave_model->supervisorList();
		    $data['weekend'] = $this->db->select('dayname')->from('weekly_holiday')->get()->row()->dayname;
			$data['module']    = "leave";	
			$data['page']      = "leave_approve_form";   
			echo Modules::run('template/layout', $data); 
		}
 
	}

}
