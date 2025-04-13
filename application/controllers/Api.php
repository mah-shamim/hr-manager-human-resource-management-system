<?php 
class Api extends CI_Controller {
    
        public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Api_model'
        )); 
    }
    
        //Index is loading first
        public function index(){

            $json['response'] = array(
                'status' => display('ok')
            );
            
            echo json_encode($json,JSON_UNESCAPED_UNICODE);
        }
        
        /*
        |--------------------------------------------------
        |
        |LANGUAGE LIST
        |-------------------------------------------------
        */
        public function language(){
            $json['response'] = array(
                'login'               => display('login'),
                'add_attendance'      => display('add_attendance'),
                'attendance_list'     => display('attendance_list'),
                'attendance_history'  => display('attendance_history'),
                'home'                => display('home'),
                'give_attendance'     => display('give_attendance'),
                'ledger_history'      => display('ledger_history'),
                'request_leave'       => display('request_leave'),
                'my_profile'          => display('my_profile'),
                'notice_board'        => display('notice'),
                'notice'              => display('notices'),
                'salary_statement'    => display('salary_statement'),
                'profile'             => display('profile'),
                'working_hour'        => display('working_hour'),
                'qr_attendance'       => display('qr_attendance'),
                'loan_amount'         => display('loan_amount'),
                'leave_remaining'     => display('leave_remaining'),
                'total_attendance'    => display('total_attendance'),
                'day_absent'          => display('day_absent'),
                'day_present'         => display('day_present'),
                'next'                => display('next'),
                'previous'            => display('previous'),
                'network_alert'       => display('network_alert'),
                'select_date'         => display('select_date'),
                'from'                => display('from'),
                'to'                  => display('to'),
                'search'              => display('search'),
                'attendance_log'      => display('attendance_log'),
                'date'                => display('date'),
                'time'                => display('times'),
                'in'                  => display('in'),
                'out'                 => display('out'),
                'work_hour'           => display('work_hour'),
                'action'              => display('action'),
                'load_more'           => display('load_more'),
                'data_not_found'      => display('data_not_found'),
                'view'                => display('view'),
                'worked'              => display('worked'),
                'wastage'             => display('wastage'),
                'net_hours'           => display('net_hour'),
                'sl'                  => display('sl'),
                'status'              => display('status'),
                'punch_time'          => display('punch_time'),
                'loading'             => display('loading'),
                'wrong_info_alert'    => display('wrong_info_alert'),
                'from_to_date_alrt'   => display('from_to_date_alrt'),
                'qr_scan'             => display('qr_scan'),
                'stop_scan'           => display('stop_scan'),
                'scan_again'          => display('scan_again'),
                'confirm_attendance'  => display('confirm_attendance'),
                'scan_alert'          => display('scan_alert'),
                'attn_success_mgs'    => display('attn_success_mgs'),
                'you_r_not_in_office' => display('you_r_not_in_office'),
                'out_of_range'        => display('out_of_range'),
                'debit'               => display('debit'),
                'credit'              => display('credit'),
                'balance'             => display('balance'),
                'request_for_leave'   => display('request_for_leave'),
                'leave_type'          => display('leave_type'),
                'select_type'         => display('select_type'),
                'leave_reason'        => display('leave_reason'),
                'write_reason'        => display('write_reason'),
                'send_request'        => display('send_request'),
                'leave_his_status'    => display('leave_his_status'),
                'amount'              => display('amount'),
                'name'                => display('name'),
                'salary_type'         => display('sal_type'),
                'total_tax'           => display('total_tax'),
                'basic_salary'        => display('basic_salary'),
                'total_salary'        => display('total_salary'),
                'bank_name'           => display('bank_name'),
                'paid_by'             => display('paid_by'),
                'employee'            => display('employee'),
                'no'                  => display('no'),
                'email'               => display('email'),
                'phone'               => display('phone'),
                'employee_id'         => display('employee_id'),
                'employment_date'     => display('employment_date'),
                'state'               => display('state'),
                'company_name'        => display('company_name'),
                'city'                => display('city'),
                'zip'                 => display('zip'),
                'present_address'     => display('present_address'),
                'parmanent_address'   => display('parmanent_address'),
                'education'           => display('education'),
                'university_name'     => display('university_name'),
                'notice_by'           => display('notice_by'),
                'notice_date'         => display('notice_date'),
                'notice_details'      => display('notice_details'),
                'no_notice_to_show'   => display('no_notice_to_show'),
                'welcome_msg'         => display('welcome_msg'),
                'enter_your_email'    => display('enter_your_email'),
                'enter_your_password' => display('enter_your_password'),
                'cannot_remember_pass'=> display('cannot_remember_pass'),
                'forgot_password'     => display('forgot_password'),
                'email_pass_cannot_empt'     => display('email_pass_cannot_empt'),
                'email_format_was_not_right'     => display('email_format_was_not_right'),
                'email_or_pass_not_matched'     => display('email_or_pass_not_matched'),
                'reset_your_password' => display('reset_your_password'),
                'reset'               => display('reset'),
                'your_remember_password' => display('your_remember_password'),
                'back_to_login'       => display('back_to_login'),
                'email_fild_can_not_empty'     => display('email_fild_can_not_empty'),
                'email_not_found'     => display('email_not_found'),
                'successfully_send_email'     => display('successfully_send_email'),
                'email_is_not_valid'     => display('email_is_not_valid'),
                'sorry_email_not_sent'     => display('sorry_email_not_sent'),
                'day_leave'             => display('day_leave'),
                'search_work_details'             => display('search_work_details'),
                'request_not_send'             => display('request_not_send'),
                'leave_request_success'             => display('leave_request_success'),
                'all_field_are_required'             => display('all_field_are_required'),
                'plz_select_data_properly'             => display('plz_select_data_properly'),
                'pending'             => display('pending'),
                'approved'            => display('approved'),
                'logout'              => display('logout'),
                'paid'                => display('paid'),
                'unpaid'              => display('unpaid'),
                'salary_details'      => display('salary_details'),
                'worked_days'        => display('worked_days'),
            );
            
            echo json_encode($json,JSON_UNESCAPED_UNICODE);
        }
            
        

        /*
        |---------------------------------------------------
        |Web Settings Data 
        |---------------------------------------------------
        */

        public function webSetting(){

            $settings = $this->db->query("
            SELECT * 
            FROM setting
        ")->row();

            if (!empty($settings)) {

                $json['response'] = [
                        'status'         => display('ok'),
                        'attendance_url' => base_url().'Api/add_attendance',
                        'base_url'       => base_url(),
                        'logo_url'       => base_url().$settings->logo,
                        'settings'       => $settings,
                        
                    ];

            } else {

                $json['response'] = [

                        'status'  => display('error'),
                        'message' => display('settings_not_found')

                    ];
                
            }

            echo $json_encode = json_encode($json, JSON_UNESCAPED_UNICODE);

        }


   /*
   |----------------------------------------------------------------------
   |User Registration Information
   |----------------------------------------------------------------------
   */

public function user_registration(){
 $firstname = $this->input->get('firstname',true);
 $lastname  = $this->input->get('lastname',true);  
 $email     = $this->input->get('email',true);
 $password  =  $this->input->get('password'); 
    
  $postData = array(
                    'firstname'   => $firstname,
                    'lastname'    => $lastname,
                    'email'       => $email,
                    'password'    => md5($password),
                    'status'      => 1
                ); 

            $user = $this->Api_model->registration_checkUser($email);
           
            if($user->num_rows() < 1) {
                if($this->Api_model->insert_user($postData)){
                
                    $json['response'] = [
                    'status'  => 'ok',
                    'message' => display('successfully_saved'),
                    
                ];
                }else{
                  $json['response'] = [
                    'status'  => display('error'),
                    'message' => display('please_try_again'),
                     
                ];  
                }
                    
               
                
            }else{
                $json['response'] = [
                    'status'  => display('error'),
                    'message' => 'User Already Exist !! Please Try another.',
                    
                ];
            }
 echo json_encode($json, JSON_UNESCAPED_UNICODE);                
}


    /*
    |---------------------------------------------------
    |    Login info
    |---------------------------------------------------
    */

    public function login(){  
         $email = $this->input->get('email',true);
         $password =  $this->input->get('password',true); 
         $token   = $this->input->get('token_id');
         $userinfo = $this->Api_model->userdata($email);
        if (empty($email) || empty($password)) {
            $json['response'] = [
                'status'      => display('error'),
                'type'        => 'required_field',
                'message'     => 'required_field',
                 'permission' => 'read'
            ];

        } else {


            $data['user'] = (object) $userData =  [
                'email'      => $email,
                'password'   => $password
            ];


            $user = $this->Api_model->checkUser($userData);
         $img = $userinfo->profile_pic;
         $img = substr($img, 2); 

            if($user->num_rows() > 0) {
                $token_data = array(
                    'token_id' => $token,
                    );
              $this->db->where('email',$email)
                       ->update('user',$token_data);
             
         
                $sData = array(
                    'user_id'     => $user->row()->id,
                    'tokendata'   => $token,
                    'password'    => $password,
                    'profile_pic' => (!empty($img)? base_url($img):""),
                    'userdata'    => $userinfo,
                );
                
               
                
                $json['response'] = [
                    'status'  => 'ok',
                    'user_data'    => $sData,
                    'message' => display('successfully_login'),
                     
                ];

            } else {

                $json['response'] = [
                    'status'  => display('error'),
                    'message' => display('no_data_found'),
                     
                ];

            } 

        }
        
        

        echo json_encode($json, JSON_UNESCAPED_UNICODE); 

    }
    
  /*-----------------------------------------------------
    |  CHANGE PASSWORD 
    |
    |---------------------------------------------------
    */
    
    public function password_recovery(){
    $this->form_validation->set_rules('email', display('email'), 'required|valid_email|max_length[100]|trim');  
    $userData = array(
            'email' => $this->input->post('email',true)
        );
    if ($this->form_validation->run())
        {
    $user = $this->Api_model->password_recovery($userData);
     $ptoken = date('ymdhis');
        if($user->num_rows() > 0) {
            $email =$user->row()->email;
            $precdat = array(
            'email'      => $email,
            'password_reset_token' => $ptoken,
                
        );
        
        $this->db->where('email',$email)
            ->update('user',$precdat);
             $send_email = '';
             if (!empty($email)) {
                $send_email = $this->setmail($email,$ptoken);
                
             }
           if($send_email){
            $json['response'] = [
                    'status'     => 'ok',
                    'message'    => 'check Your email',
                   
                ];
           }else{
          $json['response'] = [
                    'status'     => 'error',
                    'message'    => 'Sorry Email Not Sent',
                    
                ];
           }

        }else{
            $json['response'] = [
                    'status'     => 'error',
                    'message'    => 'Email Not Found',
                    
                ];
        }
    }else{
            $json['response'] = [
                    'status'     => 'error',
                    'message'    => 'Email Is Not Valid',
                    
                ];
        }

           echo json_encode($json,JSON_UNESCAPED_UNICODE);
    }
    /*-----------------------------------------------------
    |  SEND MAIL TO USER
    |
    |---------------------------------------------------
    */
    
     public function setmail($email,$ptoken)
    {

  
 $msg = "Click on this url for change your password :".base_url().'api/recovery_form/'.$ptoken;

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,100);

// send email
mail($email,"Password Recovery",$msg); 
  
  
}

/*-----------------------------------------------------
|  PASSWORD CHANGE FORM
|
|---------------------------------------------------
*/
public function recovery_form($token_id){
$https = false;
 if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}

$dirname = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/').'/';
$root=$protocol.$_SERVER['HTTP_HOST'].$dirname;
 $burl = $root;
 
       $tokeninfo = $this->Api_model->token_matching($token_id);
      if($tokeninfo->num_rows() > 0) {
        $data['token'] = $token_id;
        $data['title'] = 'Recovery Form';
        $this->load->view('recovery_form', $data);
      }else{
         redirect($burl);  
       }   
    
}

/*-----------------------------------------------------
|  RECOVER PASSWORD
|
|---------------------------------------------------
*/
public function recovery_submit(){
    $token = $this->input->post('token',true);
    $newpassword = $this->input->post('password',true);
    $userdata = array(
        'password'      =>  md5($newpassword),
        'security_code' => ''
        );
        $this->db->where('password_reset_token',$token)
            ->update('user',$userdata);
            redirect(base_url()); 
}

/*-----------------------------------------------------
|  ADD  ATTENDANCE 
|
|---------------------------------------------------
*/
public function add_attendance(){
    
 $ulatitude       = $this->input->get('latitude',true);
 $ulongitude      = $this->input->get('longitude',true);
 $employee_id     = $this->input->get('employee_id');
 $time            = $this->input->get('datetime');
 $checklatitude = $this->db->select('*')->from('appsetting')->where('latitude',$ulatitude)->where('longitude',$ulongitude)->get()->num_rows();
  $userid          = $this->input->get('user_id');
 $user_data = $this->db->select('firstname,lastname,token_id')->from('user')->where('id',$userid)->get()->row();
 $settingdata = $this->db->select('*')->from('appsetting')->get()->row();
 
    $lat1 = $settingdata->latitude;
    $lon1 = $settingdata->longitude;
    $lat2 = $ulatitude;
    $lon2 = $ulongitude;
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                              $dist = acos($dist);
                              $dist = rad2deg($dist);
                              $miles= $dist * 60 * 1.1515;
                              $unit = 'K';
                              $metre   = ($miles*1.609344)*1000;

                              $distance =  number_format($metre,1);

   $attendance_history = [
                'uid'    => $employee_id,
                'state'  => 1,
                'id'     => 0,
                'time'   => $time,
                
            ]; 
            if($settingdata->acceptablerange > $distance){
     if ($this->Api_model->atten_create($attendance_history)) { 
                $json['response'] = [
                    'status'     => 'ok',
                    'range'     => $distance,
                    'message'    => 'Successfully Saved',
                    
                ];
                
                  $icon='';
                            $fields3 = array(
                            'to'=> $user_data->token_id,
                            'data'=>array(
                                'title'=>"Attendance",
                                'body'=>"Dear ".$user_data->firstname.' '.$user_data->lastname." Your Attendance Successfully Saved",
                                'image'=>$icon,
                                'media_type'=>"image",
                                "action"=> "2",
                            ),
                            'notification'=>array(
                                'sound'=>"default",
                                'title'=>"Attendance",
                                'body'=>"Dear ".$user_data->firstname.' '.$user_data->lastname." Your Attendance Successfully Saved",
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
            } else {
                $json['response'] = [
                    'status'     => 'error',
                    'range'      => $distance,
                    'lat'        => $lat1,
                    'dfrange'    => $settingdata->acceptablerange,
                    'message'    => 'Please Try Again',
                   
                ];
            } 
            }else{
                 $json['response'] = [
                    'status'     => 'error',
                      'range'    => $distance,
                    'message'    => 'out of range',
                   
                ];
            }
           
              echo json_encode($json,JSON_UNESCAPED_UNICODE);
            
            
            
}

/*-----------------------------------------------------
|   ATTENDANCE HISTORY FOR ALL ATTENDANCE DATA
|
|------------------------------------------------
*/

public function attendance_history(){
    $start = $this->input->get('start', TRUE);
    $employee_id = $this->input->get('employee_id');
     $total_attn = $this->Api_model->count_att_history($employee_id);
    if(empty($start)){
      $attendance = $this->Api_model->attendance_history($employee_id);  
    }else{
        $attendance = $this->Api_model->attendance_historylimit($employee_id,$start);
    }
    
    
    $add_data = [];
    foreach($attendance as $myattendance){
        $date = date( "Y-m-d", strtotime($myattendance['time']));
      $add_data[] = $this->db->select("a.*,CONCAT_WS(' ', b.first_name, b.last_name) AS employee_name,DATE(time) as date,TIME(time) as time,(SELECT timediff(MAX(time),MIN(time)) as totalhours FROM attendance_history WHERE uid = '$employee_id' AND DATE(time) = '$date') as totalhours")
        ->from('attendance_history a')
        ->join('employee_history b','b.employee_id = a.uid','left')
        ->like('a.time',date( "Y-m-d", strtotime($myattendance['time'])),'after')
        ->where('a.uid',$employee_id)
        ->order_by('a.atten_his_id','ASC')
        ->group_by('a.atten_his_id')
        ->get()
        ->result();
         
    }
  
    

    
    if(!empty($attendance)){
     $json['response'] = [
                    'status'      => 'ok',
                    'length'      => "$total_attn",
                    'historydata' => $add_data,
                    'message'     => 'found some data',
                   
                ];
       
}else{
    $json['response'] = [
                    'status'     => 'error',
                    'length'      => "",
                    'historydata' => [],
                    'message'    => 'No Record Found',
                   
                ]; 
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
}

/*-----------------------------------------------------
|  DATE WISE ATTENDANCE
|
|------------------------------------------------
*/

public function attendance_datewise(){
    
   $employee_id = $this->input->get('employee_id');
   $fromdate = $this->input->get('from_date');
   $todate = $this->input->get('to_date');
   $attendance = $this->Api_model->attendance_history_datewise($employee_id,$fromdate,$todate);
   
  

    if(!empty($attendance)){
     $json['response'] = [
                    'status'      => 'ok',
                    'historydata' =>  $attendance,
                    'message'     => 'found some data',
                   
                ];
       
}else{
    $json['response'] = [
                    'status'     => 'error',
                    'message'    => 'No Record Found',
                   
                ]; 
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
    
}

/*-----------------------------------------------------
|  NOTICE BOARD
|
|------------------------------------------------
*/

public function noticeinfo(){
    
    $start=$this->input->get('start', TRUE);
    $totlanotice = $this->Api_model->count_notice();
   if(empty($start)){
  $notice = $this->Api_model->notice_boardall();
   }else{
    $notice = $this->Api_model->notice_board($start);
  } 

    if(!empty($notice)){
     $json['response'] = [
                    'status'      => 'ok',
                    'length'      => $totlanotice,
                    'historydata' =>  $notice,
                    'message'     => 'found some data',
                   
                ];
       
}else{
    $json['response'] = [
                    'status'     => 'error',
                    'message'    => 'No Record Found',
                   
                ]; 
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
    
}


/*-----------------------------------------------------
| Total Hours of current month
|
|------------------------------------------------
*/

public function current_month_totalhours(){
    
    
    $query_date = date('Y-m-d');
   $employee_id = $this->input->get('employee_id');
   $fromdate = date('Y-m-01', strtotime($query_date));
   $todate = date('Y-m-t', strtotime($query_date));
   $allhours = $this->Api_model->attendance_history_datewise($employee_id,$fromdate,$todate);
 $totalhour=[];
 $idx=1;
 
   foreach($allhours as $hours){

        $hou = 0;
        $min = 0;
        $sec = 0;
       
         $split = explode(":", @$hours['nethours']); 
                    $hou += @$split[0];
                    $min += @$split[1];
                    $sec += @$split[2];

            $seconds = $sec % 60;
            $minutes = $sec / 60;
            $minutes = (integer)$minutes;
            $minutes += $min;
            $hours = $minutes / 60;
            $minutes = $minutes % 60;
            $hours = (integer)$hours;
            $hours += $hou % 24;
       
           $totalnethours = $hours.":".$minutes.":".$seconds;
            $totalhour[$idx] = $totalnethours;
            
            $idx++;
   }
   
   $seconds = 0;
foreach($totalhour as $t)
{
$timeArr = array_reverse(explode(":", $t));

foreach ($timeArr as $key => $value)
{
    if ($key > 2) break;
    $seconds += pow(60, $key) * $value;
}

}

$hours = floor($seconds / 3600);
$mins = floor(($seconds - ($hours*3600)) / 60);
$secs = floor($seconds % 60);

$ntotalhours  =  $hours.':'.$mins.':'.$secs;
   
    if(!empty($allhours)){
     $json['response'] = [
                    'status'      => 'ok',
                    'totalhours'  =>  $ntotalhours,
                    'message'     => 'found some data',
                   
                ];
       
}else{
    $json['response'] = [
                    'status'     => 'error',
                    'message'    => 'No Record Found',
                   
                ]; 
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
    
}



/*-----------------------------------------------------
| Total Working Day of current month
|
|------------------------------------------------
*/

public function current_month_totalday(){
    
    
   $query_date = date('Y-m-d');
   $employee_id = $this->input->get('employee_id');
   $fromdate = date('Y-m-01', strtotime($query_date));
   $todate = date('Y-m-t', strtotime($query_date));
   $alldays = $this->Api_model->attendance_totalday_currentmonth($employee_id,$fromdate,$todate);
 
   
    if(!empty($alldays)){
     $json['response'] = [
                    'status'      => 'ok',
                    'totalday'    =>  "$alldays",
                    'message'     => 'found some data',
                   
                ];
       
}else{
    $json['response'] = [
                    'status'     => 'error',
                     'totalday' =>  "",
                    'message'    => 'No Record Found',
                   
                ]; 
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
    
}


/*-----------------------------------------------------
| Loan Amount Remaining info
|
|------------------------------------------------
*/

public function loan_amount(){
    
    
   $employee_id = $this->input->get('employee_id');
   $totaldue = $this->Api_model->total_loan_amount($employee_id);
 
   
    if(!empty($totaldue)){
     $json['response'] = [
                    'status'      => 'ok',
                    'totalamount' =>  "$totaldue",
                    'message'     => 'found some data',
                   
                ];
       
}else{
    $json['response'] = [
                    'status'     => 'error',
                    'totalamount' =>  "",
                    'message'     => 'found some data',
                   
                ]; 
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
    
}


/*-----------------------------------------------------
| Leave Remaining info
|
|------------------------------------------------
*/

public function leave_remaining(){
    
    
   $employee_id = $this->input->get('employee_id');
   $totalremaining = $this->Api_model->leave_remaining($employee_id);
 
   
    if(!empty($totalremaining)){
     $json['response'] = [
                    'status'      => 'ok',
                    'total'        =>  "$totalremaining",
                    'message'     => 'found some data',
                   
                ];
       
}else{
    $json['response'] = [
                    'status'     => 'error',
                    'total'        => "",
                    'message'    => 'No Record Found',
                   
                ]; 
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
    
}


/*-----------------------------------------------------
| Dashboard Graph info
|
|------------------------------------------------
*/

public function graph_info(){
    
   $query_date = date('Y-m-d');
   $employee_id = $this->input->get('employee_id');
   $fromdate = date('Y-m-01', strtotime($query_date));
   $todate = date('Y-m-d', strtotime($query_date));
   $alldays = $this->Api_model->attendance_totalday_currentmonth($employee_id,$fromdate,$todate);
    $takenleave = $this->Api_model->takenleave($employee_id);
    $weekend    = $this->Api_model->weekends();
    $totaldaycurrentdate = $this->Api_model->totaldayofcurrentstage();
    
    
    $absentdays = $totaldaycurrentdate - ($alldays + (!empty($takenleave)?$takenleave:0) + (!empty($weekend)?$weekend:0));
    if($absentdays > 0){
       $absentdays = $absentdays; 
    }else{
        $absentdays = '';
    }
    
    
    if(!empty($alldays)){
     $json['response'] = [
                    'status'         => 'ok',
                    'totalpresent'   => "$alldays",
                    'takenleave'     => (!empty($takenleave)?$takenleave:''),
                    'weekendholiday' => "$weekend",
                    'Monthname'      => date('F'),
                    'date'           => date('Y-m-d'),
                    'absent'         => "$absentdays",
                    'message'        => 'found some data',
                   
                ];
       
      }else{
    $json['response'] = [
                   'status'          => 'ok',
                    'totalpresent'   => '',
                    'takenleave'     => '',
                    'weekendholiday' => '',
                    'Monthname'      => date('F'),
                    'date'           => date('Y-m-d'),
                    'absent'         => '',
                   
                ]; 
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
    
}

/*-----------------------------------------------------
| LEAVE APPLICATION 
|
|------------------------------------------------
*/

public function leave_application(){
 $employee_id = $this->input->get('employee_id'); 
 $from_date   = $this->input->get('from_date');
 $to_date     = $this->input->get('to_date');
 $startdate   = date_create($from_date);
 $enddate     = date_create($to_date);
 $diff        = date_diff($startdate,$enddate);
 $apply_day   = $diff->format("%a");
 $leave_type  = $this->input->get('type_id',true);
 $reason      = $this->input->get('reason',true);
 
 $employee_leave = $this->db->select('SUM(num_aprv_day) as lv')->from('leave_apply')->where('employee_id',$employee_id)->where('leave_type_id',$leave_type)->get()->row();
 
  $userid  = $this->input->get('user_id');
 $user_data = $this->db->select('firstname,lastname,token_id')->from('user')->where('id',$userid)->get()->row();
 $settingdata = $this->db->select('*')->from('appsetting')->get()->row();
 
$totalleave = $this->db->select('leave_days')->from('leave_type')->where('leave_type_id',$leave_type)->get()->row();
 if($employee_leave->lv < $totalleave->leave_days){
 
 $data = array(
     'employee_id'     => $employee_id,
     'leave_type_id'   => $leave_type,
     'apply_strt_date' => $from_date,
     'apply_end_date'  => $to_date,
     'apply_day'       => $apply_day+1,
     'reason'          => $reason,
     'apply_date'      => date('Y-m-d'),
     'status'          => 0
     );
  
    if($this->Api_model->insert_leave_application($data)){
     $json['response'] = [
                    'status'        => 'ok',
                    'message'       => 'Successfully Saved',
                   
                ];
                
                          $icon='';
                            $fields3 = array(
                            'to'=> $user_data->token_id,
                            'data'=>array(
                                'title'=>"Leave Application",
                                'body'=>"Dear ".$user_data->firstname.' '.$user_data->lastname." Your Leave Request Successfull",
                                'image'=>$icon,
                                'media_type'=>"image",
                                "action"=> "3",
                            ),
                            'notification'=>array(
                                'sound'=>"default",
                                'title'=>"Leave Application",
                                'body'=>"Dear ".$user_data->firstname.' '.$user_data->lastname." Your Leave Request Successfull",
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
                
       
}else{
    $json['response'] = [
                    'status'     => 'error',
                    'message'    => 'Please Try Again !',
                   
                ]; 
}
}else{
   $json['response'] = [
                    'status'     => 'error',
                    'message'    => 'You Already Enjoyed All leaves',
                   
                ];    
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
    
}

/*
-------------------------------------------------------------------
|
|LEAVE TYPE LIST
|
--------------------------------------------------------------------
*/
public function leave_type_list(){
    $typelist = $this->Api_model->type_list();
    
    if(!empty($typelist)){
         $json['response'] = [
                    'status'        => 'ok',
                    'type_list'     => $typelist,
                    'message'       => 'found some data',
                   
                ];
    }else{
             $json['response'] = [
                    'status'     => 'error',
                    'message'    => 'No Record Found',
                   
                ]; 
    }
    
    echo json_encode($json,JSON_UNESCAPED_UNICODE);
}

/*
-------------------------------------------------------------------
|
|LEAVE  LIST
|
--------------------------------------------------------------------
*/
public function leave_list(){
    $start=$this->input->get('start', TRUE);
     $employee_id = $this->input->get('employee_id');
    $countdata =  $this->Api_model->count_leave($employee_id);
    if(empty($start)){
    $leavelist = $this->Api_model->leave_list($employee_id);
    }else{
      $leavelist = $this->Api_model->leave_listlimit($employee_id,$start);   
    }
    
    if(!empty($leavelist)){
         $json['response'] = [
                    'status'        => 'ok',
                    'type_list'     => $leavelist,
                    'length'        => $countdata,
                    'message'       => 'found some data',
                   
                ];
    }else{
             $json['response'] = [
                    'status'     => 'error',
                    'message'    => 'No Record Found',
                   
                ]; 
    }
    
    echo json_encode($json,JSON_UNESCAPED_UNICODE);
}

// /*
// -------------------------------------------------------------------
// |
// |Ledger
// |


    public function ledger(){

        $start=$this->input->get('start', TRUE);
        $employee_id = $this->input->get('employee_id');

        // Subtype define
        $subtype = 2;
        $acc_info = $this->Api_model->account_head_by_subtype($subtype);
        $accounthead = $acc_info->HeadCode;
        $subcode = $this->Api_model->getSubcode_info($subtype,$employee_id);
        $transaction_head = $subcode->id;

        $respo = $this->Api_model->get_general_ledger_data($accounthead,1,0,$subtype,$transaction_head);

        $total_ledger = count($respo);

        if(empty($start)){
            $ledger = $this->Api_model->get_general_ledger_data($accounthead,1,0,$subtype,$transaction_head);
        }else{
            $ledger = $this->Api_model->lget_general_ledger_data_limit($accounthead,1,0,$subtype,$transaction_head,$start);    
        }
        
        $totaldebit = 0;
        $totalcredit = 0;
         if (!empty($ledger)) {
                foreach ($ledger as $k => $v) {
                    $totaldebit += $ledger[$k]['Debit'];
                    $totalcredit += $ledger[$k]['Credit'];
                    $ledger[$k]['balance'] = $totaldebit - $totalcredit;
                }
         }
        
        if(!empty($ledger)){
             $json['response'] = [
                        'status'        => 'ok',
                        'length'        => "$total_ledger",
                        'type_list'     => $ledger,
                        'message'       => 'found some data',
                       
                    ];
        }else{
                 $json['response'] = [
                        'status'     => 'error',
                         'length'        => "",
                         'type_list'     => [],
                        'message'    => 'No Record Found',
                       
                    ]; 
        }
        
        echo json_encode($json,JSON_UNESCAPED_UNICODE);
    }



    /*-----------------------------------------------------
    | Salary info
    |
    |-----------------------------------------------------
    */

    public function salary_info(){
        $start=$this->input->get('start', TRUE);    
        $employee_id = $this->input->get('employee_id');
        $total = $this->Api_model->count_payroll_salaryinfo($employee_id);

        if(empty($start)){
            $salaryinfo = $this->Api_model->payroll_salaryinfo($employee_id);
        }else{
            $salaryinfo = $this->Api_model->payroll_salaryinfolimit($employee_id,$start);    
        }
      
        if(!empty($salaryinfo)){
            $json['response'] = [
                    'status'        => 'ok',
                    'lenght'        => "$total",
                    'salary_info'       => $salaryinfo,
                    'message'           => 'found some data',
                           
                ];
           
        }else{
            $json['response'] = [
                    'status'                 => 'error',
                    'lenght'                 => "",
                    'salary_info'            => [],
                    'message'                => 'No Record Found',
                           
                ]; 
        }

        echo json_encode($json,JSON_UNESCAPED_UNICODE);
        
    }


  }

