<?php defined('BASEPATH') or exit('No direct script access allowed');

class Api_handler_v2 extends CI_Controller {
    
  public function __construct()
  {
    parent::__construct();
    
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Content-Type: application/json");
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    
    $this->db->query('SET SESSION sql_mode = ""');
    
    $this->load->model('rewardpoint/rewardpoints_model');
    $this->load->model('employee/employees_model'); 
   
  }
  
  // Check stauts
  public function check_status(){
      
      $request_data =  json_decode(file_get_contents("php://input"));

      $status = $request_data->status;
      
      if($status == 1){
          $data['status'] = "ok";
      }else{
          $data['status'] = "fail";
      }
      
      echo json_encode($data);
      
  }
  
  // After successfull install and app verificaiton... request form hrm scheduler to insert purchase_key and api_domain/base_url

  public function insert_purchase_info(){

        $request_data =  json_decode(file_get_contents("php://input"));

        $data['domain'] = $request_data->domain;
        $data['purchase_key'] = $request_data->purchase_key;

        // Check, if purchase_key and domain already inserted into databse
        $query_string = "purchase_key is NOT NULL AND domain is NOT NULL";
        $result = $this->db->select('*')
            ->from('schdule_purchse_info')
            ->where($query_string)
            ->get()
            ->num_rows();

        if($result > 0){

            $data['status'] = false;
            $data['msg'] = "Purchase info already exists !";

        }else{

            if($request_data->domain == null || $request_data->purchase_key == null){

                $data['status'] = false;
                $data['msg'] = "Purchase key or domain is empty !";

            }else{

                $respo_schdule_purchse_info = $this->db->insert('schdule_purchse_info', $data);

                if($respo_schdule_purchse_info){

                    $data['status'] = true;
                    $data['msg'] = "Successfully inserted into database !";

                }else{

                    $data['status'] = false;
                    $data['msg'] = "Unable to insert data ,Please try again.";
                }
            }  
        }

        echo json_encode($data);
  }


  //Fetching the data from database for Hrm scheduler installation

  public function get_purchase_info(){

        // Check, if purchase_key and domain already inserted into databse
        $query_string = "purchase_key is NOT NULL AND domain is NOT NULL";
        $result = $this->db->select('purchase_key,domain,created_at')
            ->from('schdule_purchse_info')
            ->where($query_string)
            ->get()
            ->result();

        if(count($result) > 0){

            $data['status'] = true;
            $data['data'] = $result;
        }else{

            $data['status'] = false;
            $data['msg'] = "Data not available ,Please try again.";
        }

        echo json_encode($data);
  }

  // when request form hrm scheduler to insert ip_address and port
  public function insert_zkt_ip(){

        $request_data =  json_decode(file_get_contents("php://input"));

        $data['ip_address'] = $request_data->ip_address;
        $data['port'] = $request_data->port;

        if($request_data->ip_address == null || $request_data->port == null){

            $data['status'] = false;
            $data['msg'] = "IP adderess or Port is null !";

        }else{

            $available_ip_ports = $this->db->select('*')
                ->from('schdule_purchse_info')
                ->where('ip_address',$request_data->ip_address)
                ->get()
                ->num_rows();

            if($available_ip_ports > 0){

                $data['status'] = false;
                $data['msg'] =  "The IP ".$request_data->ip_address." already exists in database !";

            }else{

                $respo_schdule_purchse_info = $this->db->insert('schdule_purchse_info', $data);

                if($respo_schdule_purchse_info){

                    $data['status'] = true;
                    $data['msg'] = "Successfully inserted into database !";

                }else{

                    $data['status'] = false;
                    $data['msg'] = "Unable to insert data ,Please try again.";
                }
            }
        }

        echo json_encode($data);
  }

   //Getting ip_address for Hrm scheduler

   public function get_all_ip_address(){

        // Check, if purchase_key and domain already inserted into databse
        $query_string = "ip_address is NOT NULL AND port is NOT NULL";
        $result = $this->db->select('ip_address,port,created_at')
            ->from('schdule_purchse_info')
            ->where($query_string)
            ->get()
            ->result();

        if(count($result) > 0){

            $data['status'] = true;
            $data['data'] = $result;
        }else{

            $data['status'] = false;
            $data['msg'] = "Data not available ,Please try again.";
        }

        echo json_encode($data);        
   }

    // when request form hrm scheduler to delete zkt ip_address
    public function delete_zkt_ip(){

        $request_data =  json_decode(file_get_contents("php://input"));

        $this->db->where('ip_address', $request_data->ip_address)
            ->delete("schdule_purchse_info");

        if ($this->db->affected_rows()) {

            $data['status'] = true;
            $data['msg'] = "ZKT IP deleted successfully.";

        } else {

            $data['status'] = false;
            $data['msg'] = "Can not delete ZKT IP.";
        }

        echo json_encode($data); 
    }
  
   // For uploading/creating attendence history
   public function create_attendence(){
       
       $request_data =  json_decode(file_get_contents("php://input"));
    
       $attendance_history['uid'] = $request_data->uid;
       $attendance_history['id'] = $request_data->id;
       $attendance_history['state'] = $request_data->state;
       $attendance_history['time'] = $request_data->time;

       // Check if attendance data already inserted or not
       $dulicate_attendance_check = $this->db->select('*')
            ->from('attendance_history')
            ->where('time',$request_data->time)
            ->where('uid',$request_data->uid)
            ->get()
            ->num_rows();

       if($dulicate_attendance_check > 0){

            $data = [
                'status' => 'fail',
                'msg' => 'Duplicate entry !'
            ];

       }else{
       
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
       
       }
       /*end of request to attendence point system through rewardpoints_model*/
    
      echo json_encode($data);
       
   }
   
   // For uploading/creating bulk attendence history from hrm_scheduler
   public function bulk_attendance_push(){
       
       //get bulk data
       $request_data =  json_decode(file_get_contents("php://input"));

       $data = array();

       $total_records            = count($request_data);
       $total_inserted           = 0;
       $total_upadte_points      = 0;
       $total_dulicate           = 0;
       $total_upadte_points_fail = 0;
       $total_fail               = 0; 
      
       if($total_records > 0){

           foreach ($request_data as $attn_data) {
        
               $attendance_history['uid']   = $attn_data->uid;
               $attendance_history['id']    = $attn_data->id;
               $attendance_history['state'] = $attn_data->state;
               $attendance_history['time']  = $attn_data->time;

               // Check if attendance data already inserted or not
               $dulicate_attendance_check = $this->db->select('*')
                    ->from('attendance_history')
                    ->where('time',$attn_data->time)
                    ->where('uid',$attn_data->uid)
                    ->get()
                    ->num_rows();

               if($dulicate_attendance_check > 0){

                    $total_dulicate = $total_dulicate + 1;

               }else{
               
                   $respo_attendance_history = $this->db->insert('attendance_history', $attendance_history);
                   $atten_his_last_id = $this->db->insert_id();
                   
                   /*request to attendence point system through rewardpoints_model*/
                   
                   if($respo_attendance_history){

                        $total_inserted = $total_inserted + 1;
                       
                        $respo = $this->rewardpoints_model->insert_attendence_point($attendance_history);
                        
                        if($respo){

                            $total_upadte_points = $total_upadte_points + 1;
                            
                        }else{

                            $total_upadte_points_fail = $total_upadte_points_fail + 1;
                            
                            $this->db->where('atten_his_id',$atten_his_last_id)->delete('attendance_history');
                            
                        }
                        
                   }else{

                        $total_fail = $total_fail + 1;
                   }
               
               }

            }

            $data['status']                   = true;
            $data['total_records']            = $total_records;
            $data['total_inserted']           = $total_inserted;
            $data['total_upadte_points']      = $total_upadte_points;
            $data['total_dulicate']           = $total_dulicate;
            $data['total_upadte_points_fail'] = $total_upadte_points_fail;
            $data['total_fail']               = $total_fail;

        }else{

            $data['status']         = false;
            $data['total_records']  = 0;
            $data['msg']            = "You have no attendance records to push !";
        }

       /*end of request to attendence point system through rewardpoints_model*/
    
      echo json_encode($data);
       
   }
   
   //getting employee by employee_id
   public function get_employee_by_id(){
       
        $request_data =  json_decode(file_get_contents("php://input"));
       
        $employee_id = $request_data->employee_id;
        
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
   
   // Get settings data
   public function setting_info(){

        $setting_data = $this->db->select("*")
            ->from('setting')
            ->get()
            ->row();

        $respo_data = array();
        
        $respo_data['title'] = $setting_data->title;
        $respo_data['address'] = $setting_data->address;
        $respo_data['email'] = $setting_data->email;
        $respo_data['phone'] = $setting_data->phone;
        $respo_data['language'] = $setting_data->language;
        $respo_data['logo'] = base_url().$setting_data->logo;
        $respo_data['favicon'] = base_url().$setting_data->favicon;
        $respo_data['timezone'] = $setting_data->timezone;
        $respo_data['site_align'] = $setting_data->site_align;
        $respo_data['footer_text'] = $setting_data->footer_text;

        echo json_encode($respo_data);   
   }
   
   //creating employee
   public function employee_create(){
       
       $new_employee_id = (int)$this->get_employee_last_id() + 1;
       
       $postData['employee_id'] = $new_employee_id;
       $postData['first_name'] = $this->input->post('first_name');
       $postData['last_name'] = $this->input->post('last_name');
       $postData['email'] = $this->input->post('email');
       $postData['phone'] = $this->input->post('phone');
       $postData['is_super_visor'] = 0;
       $postData['password'] = md5($this->input->post('password'));
       
       $coa = $this->employees_model->headcode();
    if($coa->HeadCode!=NULL){
      $headcode=$coa->HeadCode+1;
    }else{
      $headcode="502020000001";
    }
      $c_code = $new_employee_id;
    $c_name = $this->input->post('first_name').$this->input->post('last_name');
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
    $existing_employee = $this->get_employee_by_email($this->input->post('email'));
    
    if($existing_employee){
        $data = [
                    'status' => 'fail',
                    'msg' => "email already exists !"
                ];
    }else{
    
        if($this->employees_model->create_employee($postData)){
            
            $userData = array(
            'firstname' => $this->input->post('first_name',true),
            'lastname'  => $this->input->post('last_name',true),
            'email'     => $this->input->post('email',true),
            'password'  => md5($this->input->post('password',true)),
            'is_admin'  => 0,
            'image'     => '',
          );
          
          //Create user based on employee data
          $this->db->insert('user',$userData);
                $user_id = $this->db->insert_id();
                
          $rolData = array(
            'fk_role_id'  => 1,
            'fk_user_id'  => $user_id
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
       $postData['first_name'] = $this->input->post('first_name');
       $postData['last_name'] = $this->input->post('last_name');
       $postData['email'] = $this->input->post('email');
       $postData['phone'] = $this->input->post('phone');
       
       $existing_employees = $this->duplicate_employee_by_email($this->input->post('employee_id'), $this->input->post('email'));
       
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
   
   //getting employee by employee_id for javascript(fetch methodology) api call
   public function employee_by_id(){
       
        $employee_data =  json_decode(file_get_contents("php://input"));
       
        $employee_id = $employee_data->employee_id;
        
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