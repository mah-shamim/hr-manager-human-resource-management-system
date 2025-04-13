<?php defined('BASEPATH') or exit('No direct script access allowed');

class Api_handler extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
  $this->db->query('SET SESSION sql_mode = ""');
  
  $this->load->model('rewardpoint/rewardpoints_model');
  $this->load->model('employee/employees_model'); 
   
  }
  
  // Check stauts
  public function check_status(){
      
      $status = "";
      if($this->input->post('status',true) == 1){
          $data['status'] = "ok";
      }else{
          $data['status'] = "fail";
      }
      
      echo json_encode($data);
      
  }
  
   // For uploading/creating attendence history
   public function create_attendence(){
    
       $attendance_history['uid'] = $this->input->post('uid');
       $attendance_history['id'] = $this->input->post('id');
       $attendance_history['state'] = $this->input->post('state',true);
       $attendance_history['time'] = $this->input->post('time');
       
       $respo_attendance_history = $this->db->insert('attendance_history', $attendance_history);
       $atten_his_last_id = $this->db->insert_id();
       
       /*request to attendence point system through rewardpoints_model*/
       
       if($respo_attendance_history){
           
            $respo = $this->rewardpoints_model->insert_attendence_point($attendance_history);
            
            if($respo){
                
                $data = [
                    'status' => 'ok',
                    'msg' => 'successfully inserted and updated point system !'
                ];
                
            }else{
                
                $this->db->where('atten_his_id',$atten_his_last_id)->delete('attendance_history');
                
                if($this->db->affected_rows()){
                    
                     $data = [
                        'status' => 'fail',
                        'msg' => 'attendence history deleted and can not update point system'
                    ];
                    
                }else{
                    $data = [
                        'status' => 'fail',
                        'msg' => 'can not delete attendence history'
                    ];
                }
                
            }
            
       }else{
            $data = [
                'status' => 'fail',
                'msg' => 'can not insert attendence history'
            ];
       }
       
       /*end of request to attendence point system through rewardpoints_model*/
		
	    echo json_encode($data);
       
   }
   
   //creating employee
   public function employee_create(){
       
       $new_employee_id = (int)$this->get_employee_last_id() + 1;
       
       $postData['employee_id'] = $new_employee_id;
       $postData['first_name'] = $this->input->post('first_name',true);
       $postData['last_name'] = $this->input->post('last_name',true);
       $postData['email'] = $this->input->post('email',true);
       $postData['phone'] = $this->input->post('phone',true);
       $postData['is_super_visor'] = 0;
       $postData['password'] = md5($this->input->post('password',true));
       
       $coa = $this->employees_model->headcode();
		if($coa->HeadCode!=NULL){
			$headcode=$coa->HeadCode+1;
		}else{
			$headcode="502020000001";
		}
	    $c_code = $new_employee_id;
		$c_name = $this->input->post('first_name',true).$this->input->post('last_name',true);
		$c_acc=$c_code.'-'.$c_name;
		$createby = 1;
		$createdate = date('Y-m-d H:i:s');
		$coa_data['aco']  = (Object) $coaData = [
			'HeadCode'         => $headcode,
			'HeadName'         => $c_acc,
			'PHeadName'        => 'Account Payable',
			'HeadLevel'        => '2',
			'IsActive'         => '1',
			'IsTransaction'    => '1',
			'IsGL'             => '0',
			'HeadType'         => 'L',
			'IsBudget'         => '0',
			'IsDepreciation'   => '0',
			'DepreciationRate' => '0',
			'CreateBy'         => $createby,
			'CreateDate'       => $createdate,
		];
		
		// Check if employee already existis using email
		$existing_employee = $this->get_employee_by_email($this->input->post('email',true));
		
		if($existing_employee){
		    $data = [
                    'status' => 'fail',
                    'msg' => "email already exists !"
                ];
		}else{
		
    		if($this->employees_model->create_employee($postData)){
    		    
    		    $userData = array(
    				'firstname' => $this->input->post('first_name',true),
    				'lastname' 	=> $this->input->post('last_name',true),
    				'email'     => $this->input->post('email',true),
    				'password'  => md5($this->input->post('password',true)),
    				'is_admin'  => 0,
    				'image'     => '',
    			);
    			
    			//Create user based on employee data
    			$this->db->insert('user',$userData);
                $user_id = $this->db->insert_id();
                
    			$rolData = array(
    				'fk_role_id' 	=> 1,
    				'fk_user_id' 	=> $user_id
    			);
    			
    			//Set user role as employee
    			$this->db->insert('sec_user_access_tbl',$rolData);
    			
    			//Create Acc Coa based on employee data
    			$respo_coa = $this->employees_model->create_coa($coaData);
    			
    			if($respo_coa){
    			    $data = [
                        'status' => 'ok',
                        'msg' => 'successful !'
                    ];
    			}else{
    			    $data = [
                        'status' => 'fail',
                        'msg' => 'not successful'
                    ];
    			}
    		}else{
    		    
    		     $data = [
                    'status' => 'fail',
                    'msg' => 'not successful'
                ];
                
    		}
        }
       
        echo json_encode($data);
   }
   
   //updating existing employee
   public function employee_update(){
       
       $postData['employee_id'] = $this->input->post('employee_id');
       $postData['first_name'] = $this->input->post('first_name',true);
       $postData['last_name'] = $this->input->post('last_name',true);
       $postData['email'] = $this->input->post('email',true);
       $postData['phone'] = $this->input->post('phone',true);
       
       $existing_employees = $this->duplicate_employee_by_email($this->input->post('employee_id'), $this->input->post('email',true));
       
       if($existing_employees <= 0){
           
           $check_employee = $this->check_employee_by_id($this->input->post('employee_id'));
          
           if($check_employee >= 1){
               
                if ($this->employees_model->update_employee($postData)) {
                    $data = [
                        'status' => 'ok',
                        'msg' => 'successful'
                    ];
                
                }else{
                
                    $data = [
                        'status' => 'fail',
                        'msg' => 'please try again'
                    ];
                }
                
           }else{
               
                $data = [
                    'status' => 'fail',
                    'msg' => 'employee does not exist'
                ];
           }
           
          
       }else{
           $data = [
                'status' => 'fail',
                'msg' => 'email already used for another employee'
            ];
       }
           
        echo json_encode($data);
   }
   
   //delete employee
   public function employee_delete(){
       
       $employee_id = $this->input->post('employee_id');
       
       if ($this->employees_model->emplyee_history_delete($employee_id)) {
            $data = [
                'status' => 'ok',
                'msg' => 'successful'
            ];
            
       }else{
           
            $data = [
                'status' => 'fail',
                'msg' => 'please try again'
            ];
       }
       
       echo json_encode($data);
   }
   
   //getting last created employee id
   public function get_employee_last_id(){
       
        $lastid = 0;
        $row = $this->db->query('SELECT MAX(employee_id) AS `lastid` FROM `employee_history`')->row();
        if ($row) {
            $lastid = $row->lastid; 
        }
        
        return $lastid;
   }
   
   //getting employee by employee_id
   public function get_employee_by_id(){
       
        $employee_id = $this->input->post('employee_id');
        
        $emp_data = $this->db->select("emp_his_id,employee_id,first_name,last_name,email,phone")
            ->from('employee_history')
            ->where('employee_id',$employee_id) 
            ->get()
            ->row();
        
        if($emp_data){
            
            $arr_data = [
                'status' => "ok",
                'msg' => "successful",
                'data' => $emp_data
            ];
        
        }else{
            $arr_data = [
                'status' => "fail",
                'msg' => "Employee doesn't exists"
            ];
        }
        
        
        echo json_encode($arr_data);
   }
   
   public function check_employee_by_id($employee_id){
        
        $emp_data = $this->db->select("emp_his_id,employee_id,first_name,last_name,email,phone")
            ->from('employee_history')
            ->where('employee_id',$employee_id) 
            ->get()
            ->num_rows();
        
        return $emp_data;
   }
   
   
   //getting employee by id
   public function get_employee_by_email($employee_email = null){
        
        $emp_exists = $this->db->select("*")
            ->from('employee_history')
            ->where('email',$employee_email) 
            ->get()
            ->num_rows();
        
        return $emp_exists;
   }
   
   //check duplicate employee by eamil...  except employee id which is updating
   public function duplicate_employee_by_email($employee_id = null , $employee_email = null){
       
       $emp_his = $this->db->select("emp_his_id,employee_id,first_name,last_name,email,phone")
            ->from('employee_history')
            ->where('email',$employee_email)
            ->where_not_in('employee_id', $employee_id)
            ->get()
            ->num_rows();
        
        return $emp_his;
   }
   
  /*request to attendence point system through rewardpoints_model*/
  public function review_attendance($attendance_history){
      
        $respo = $this->rewardpoints_model->insert_attendence_point($attendance_history);
        
        return $respo;
        
            
   }
   /*End of request to attendence point system*/
   
   
   public function ip_finder(){

        $ip = "";
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'].'gg';  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'].'tt';  
         }  
        //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'].'pp';  
         } 
         
         $ip_data = [
         	
         	"ci_generated__ip" => $this->input->ip_address(),
         	"remote_ip" => $_SERVER['REMOTE_ADDR'],
         	"proxy_ip" => $_SERVER['HTTP_X_FORWARDED_FOR']
         
         ];
         
         echo json_encode($ip_data);
          
    }
   
}