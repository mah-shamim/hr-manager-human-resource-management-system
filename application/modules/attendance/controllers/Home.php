<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->load->helper('url');
        $this->load->model(array(
            'Csv_model'
        )); 
        $this->load->library('excel');   
        $this->load->library('zklibrary'); 
        if (! $this->session->userdata('isLogIn'))
            redirect('login');     
    }
    
    function index($id = null) {
        $this->permission->module('attendance','read')->redirect();
        $data['title']            = display('attendance_list');
        $data['addressbook']      = $this->Csv_model->get_addressbook();
        $data['dropdownatn']      = $this->Csv_model->Employeename();
        if(!empty($id)){
        $data['editdata']         = $this->Csv_model->attendance_editdata($id);
        }
        $data['module']           = "attendance";
        $data['page']             = "atnview";   
        echo Modules::run('template/layout', $data); 
    }


    function manageatn() {
        $data['title']            = display('attendance_list'); 
        $data['addressbook']      = $this->Csv_model->get_addressbook();
        $data['module']           = "attendance";
        $data['page']             = "manage_attendance";   
        echo Modules::run('template/layout', $data); 
    }
    function importcsv() {
                  if(isset($_FILES["upload_csv_file"]["name"]))
        {
            $path = $_FILES["upload_csv_file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $sale)
            {
                $highestRow = $sale->getHighestRow();
                $highestColumn = $sale->getHighestColumn();
                for($row=2; $row<=$highestRow; $row++)
                {

                $employee_id = $sale->getCellByColumnAndRow(0, $row)->getValue();    
                $date = $sale->getCellByColumnAndRow(1, $row)->getValue();
                // print_r($date);exit();
                $atn_time = date('Y-m-d H:i:s', strtotime($date));
                $attendance= array(
                'uid'         => $employee_id,
                'time'        => $date,
                'id'          => 0,
                'state'       => 1
                        );
                $this->db->insert('attendance_history',$attendance);
   
}
}
          
    $this->session->set_flashdata('message', display('successfully_uploaded'));
            redirect('attendance/home/att_log_report');
}
    } 
    public function create_atten()
    { 
        $data['title'] = display('employee');
        $time = $this->input->post('intime');
        $att_time = date('Y-m-d H:i:s', strtotime($time));
        $id = $this->input->post('attendanc_id');
        #-------------------------------#intime
        $this->form_validation->set_rules('employee_id',display('employee_id'),'required');
         $this->form_validation->set_rules('intime',display('time'),'required');
        #-------------------------------#
        if ($this->form_validation->run() === true) {
          $attendance_history = [
                'uid'    => $this->input->post('employee_id',true),
                'state'  => 1,
                'id'     => 0,
                'time'   => $att_time,
                
            ]; 

               $update_attendance = [
                'atten_his_id'=> $id,
                'uid'    => $this->input->post('employee_id',true),
                'state'  => 1,
                'id'     => 0,
                'time'   => $att_time,
                
            ]; 

            if(empty($id)){

            if ($this->Csv_model->atten_create($attendance_history)) { 
                $this->session->set_flashdata('message', display('save_successfull'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }

           redirect("attendance/Home/att_log_report");
       }else{
         if ($this->Csv_model->atten_update($update_attendance)) { 
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }

           redirect("attendance/Home/user_attendanc_details/".$this->input->post('employee_id',true));

       }

        } else {
            $data['title']  = display('create');
            $data['module'] = "attendance";
            $data['page']   = "attendance_form";
            $data['dropdownatn'] =$this->Csv_model->Employeename();
            echo Modules::run('template/layout', $data);   
            
        }   
    }
    public function delete_atn($id = null) 
    { 
        $this->permission->method('attendance','delete')->redirect();

        if ($this->Csv_model->delete_attn($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect("attendance/Home/manageatn");
    }

    public function update_atn_form($id = null){
        $this->permission->method('attendance','delete')->redirect();
        $this->form_validation->set_rules('att_id',null,'required|max_length[11]');
        $this->form_validation->set_rules('employee_id',display('employee_id'),'required');
        $this->form_validation->set_rules('date',display('date')  ,'required');
        $this->form_validation->set_rules('sign_in',display('sign_in')  ,'required');
        $this->form_validation->set_rules('sign_out',display('sign_out'));
        $this->form_validation->set_rules('staytime',display('staytime'));
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $postData = [
                'att_id'               => $this->input->post('att_id',true),
                'employee_id'              => $this->input->post('employee_id',true),
                'date'                 => $this->input->post('date',true),
                'sign_in'              => $this->input->post('sign_in',true),
                'sign_out'             => $this->input->post('sign_out',true),
                'staytime'             => $this->input->post('staytime',true),
                
            ]; 
            
            if ($this->Csv_model->update_attn($postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
                redirect("attendance/Home/index");

        } else {
         $data['data']=$this->Csv_model->attn_updateForm($id);
         $data['module']      = "attendance";
         $data['dropdownatn'] =$this->Csv_model->Employeename();
         $data['query']       = $this->Csv_model->get_atn_dropdown($id);
         $data['page']        = "update_atn";   
         echo Modules::run('template/layout',$data); 
     }

 }
    //// checkout atn ///
 public function checkout(){
    $timezone = $this->db->select('timezone')->from('setting')->get()->row();
   date_default_timezone_set($timezone->timezone);

   $sign_out =  date("h:i:s a", time());
   $sign_in  =  $this->input->post('sign_in',true);
   $in=new DateTime($sign_in);
   $Out=new DateTime($sign_out);
   $interval=$in->diff($Out);
   $stay =  $interval->format('%H:%I:%S');
   $postData = [
    'att_id'               => $this->input->post('att_id',true),
    'sign_out'             =>  $sign_out,
    'staytime'             => $stay,
]; 
$update = $this->db->where('att_id',$this->input->post('att_id',true))
            ->update("emp_attendance", $postData);
            if ($update) { 
                $this->session->set_flashdata('message', display('successfully_checkout'));
                  redirect("attendance/Home/index");
            }

}

/* ########## Report Start ####################*/
public function report_user(){

    $data['title']            = display('attendance_list');
    $data['module']           = "attendance";
    $data['page']             = "user_views_report";   
    echo Modules::run('template/layout', $data); 
    }//

    public function report_byId(){

        $data['title']            = display('attendance_list');
        $data['module']           = "attendance";
        $data['page']             = "attn_Id_report";   
        echo Modules::run('template/layout', $data); 
    }//

    public function report_view(){

        $this->permission->module('attendance','read')->redirect();
        $format_start_date = $this->input->post('start_date');
        $format_end_date   = $this->input->post('end_date');
        $data['date']      = $format_start_date;
        $data['date']      = $format_end_date;
        $data['query']     = $this->Csv_model->userReport($format_start_date,$format_end_date);
        $data['module']    = "attendance";
        $data['page']      = "user_views_report";   
        echo Modules::run('template/layout', $data); 
    }
    public function AtnReport_view(){

        $this->permission->module('attendance','read')->redirect();
        $data['title']    = display('attendance_repor');
        $id            = $this->input->post('employee_id');
        $start_date    = $this->input->post('s_date');
        $end_date      = $this->input->post('e_date');
        $data['employee_id']  = $id;
        $data['date']  = $start_date;
        $data['date']  = $end_date;
        $data['ab']   = $this->Csv_model->atnrp($id);
        $data['query'] = $this->Csv_model->search($id,$start_date,$end_date);

        $data['module']= "attendance";
        $data['page']  = "att_reportview";   
        echo Modules::run('template/layout', $data); 
    }
    public function atntime_report(){

        $data['title']            = display('attendance_list');
        $data['module']           = "attendance";
        $data['page']             = "Date_time_report";   
        echo Modules::run('template/layout', $data); 
    }//

    public function AtnTimeReport_view(){

        $this->permission->module('attendance','read')->redirect();
        $data['title']           = display('attendance_repor');
        $date                 = $this->input->post('date');
        $start_time           = $this->input->post('s_time');
        $end_time             = $this->input->post('e_time');
        $data['date']         = $date;
        $data['sign_in']      = $start_time;
        $data['sign_in']      = $end_time;
        $data['query']        = $this->Csv_model->search_intime($date,$start_time,$end_time);
        $data['module']       = "attendance";
        $data['page']         = "Date_time_report";   
        echo Modules::run('template/layout', $data); 
    }

    /**** ###### Id checking ######### */


    function attenlist() {
        $data['title']            = display('attendance_report');  ;
        $data['addressbook']      = $this->Csv_model->get_addressbook();
        $data['module']           = "attendance";
        $data['page']             = "attendance_list";
        $data['dropdownatn']      =  $this->Csv_model->Employeename();   
        echo Modules::run('template/layout', $data); 
    } 

    /*  atn edit */
    public function edit_atn_form($id = null){
        $this->permission->method('attendance','delete')->redirect();
        $this->form_validation->set_rules('att_id',null,'required|max_length[11]');
        $this->form_validation->set_rules('employee_id',display('employee_id'),'required');
        $this->form_validation->set_rules('date',display('date')  ,'required');
        $this->form_validation->set_rules('sign_in',display('sign_in')  ,'required');
        $this->form_validation->set_rules('sign_out',display('sign_out'));
        $this->form_validation->set_rules('staytime',display('staytime'));
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $postData = [
                'att_id'               => $this->input->post('att_id',true),
                'employee_id'          => $this->input->post('employee_id',true),
                'date'                 => $this->input->post('date',true),
                'sign_in'              => $this->input->post('sign_in',true),
                'sign_out'             => $this->input->post('sign_out',true),
                'staytime'             => $this->input->post('staytime',true),
                
            ]; 
            
            if ($this->Csv_model->update_attn($postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
           redirect("attendance/Home/index");

        } else {
         $data['data']=$this->Csv_model->attn_updateForm($id);
         $data['module']      = "attendance";
         $data['dropdownatn'] =$this->Csv_model->Employeename();
         $data['query']       = $this->Csv_model->get_atn_dropdown($id);
         $data['page']        = "edit_attendance";   
         echo Modules::run('template/layout',$data); 
     }

 }
 /*
 |-----------------------------------------------------------
 |   Device Connectivity
 |
 |------------------------------------------------------------
 */
 public function device_connection(){
      $div_data = $this->db->count_all('deviceinfo');
      if(!empty($div_data)){
        $id = 1;
      }else{
        $id = null;
      }

        $this->form_validation->set_rules('device_ip',display('device_ip'),'required|max_length[50]');
        $data['device_data'] = (Object) $postData = [
                'id'   => $this->input->post('id'),
                'device_ip' => $this->input->post('device_ip')
            ];

        #-------------------------------#
        if ($this->form_validation->run()) { 

            if (empty($postData['id'])) {

                $this->permission->method('attendance','create')->redirect();
                if ($this->Csv_model->create_device_ip($postData)) { 
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception',  display('please_try_again'));
                }
                redirect("attendance/home/device_connection");

            } else {

                $this->permission->method('attendance','update')->redirect();

                if ($this->Csv_model->update_device_ip($postData)) { 
                 
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception',  display('please_try_again'));
                }
                redirect("attendance/home/device_connection/".$postData['id']);  
            }
 

        } else { 
            if(!empty($id)) {
                $data['title'] = display('update');
                $data['deviceinfo']   = $this->Csv_model->devicinfoById($id);
            }
               $data['module'] = "attendance";
               $data['page']   = "device_connect_form";     
            echo Modules::run('template/layout', $data); 
        }
 }
 /*
 |--------------------------------------------------------
 | Finger print Device information
 |--------------------------------------------------------
 */
 public function deviceData(){
    return $this->db->select('*')->from('deviceinfo')->get()->row();
 }
 /*
 |-----------------------------------------------------------
 | Attendance Log
 |-----------------------------------------------------------
 */
 function atten_log() {
    $device_ip = $this->deviceData()->device_ip;
    $zk = new ZKLibrary($device_ip, 4370);
        $zk->connect();
        $zk->disableDevice();
        $attendanced = $zk->getAttendance();
            foreach ($attendanced as $attendancedata) {
                 $attdata = [
                'uid'       => $attendancedata[1],
                'id'        => $attendancedata[0],
                'state'     => $attendancedata[2],
                'time'      => $attendancedata[3]
            ]; 
            $att_insertdata = $this->db->insert('attendance_history',$attdata);
            if(!empty($attendancedata[0])){
            $zk->deleteAttendance($attendancedata[0]);
            }
        }
        $this->session->set_flashdata('message', "Succesfully Uploaded");
        redirect("attendance/Home/att_log_report");
        // $data['title']   = 'Attendance Log';
        // $config["base_url"] = base_url('attendance/home/atten_log');
        // $config["total_rows"]  = $this->Csv_model->count_atn();
        // $config["per_page"]    = 20;
        // $config["uri_segment"] = 4;
        // $config["last_link"] = "Last"; 
        // $config["first_link"] = "First"; 
        // $config['next_link'] = 'Next';
        // $config['prev_link'] = 'Prev';  
        // $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        // $config['full_tag_close'] = "</ul>";
        // $config['num_tag_open'] = '<li>';
        // $config['num_tag_close'] = '</li>';
        // $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        // $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        // $config['next_tag_open'] = "<li>";
        // $config['next_tag_close'] = "</li>";
        // $config['prev_tag_open'] = "<li>";
        // $config['prev_tagl_close'] = "</li>";
        // $config['first_tag_open'] = "<li>";
        // $config['first_tagl_close'] = "</li>";
        // $config['last_tag_open'] = "<li>";
        // $config['last_tagl_close'] = "</li>";
        // /* ends of bootstrap */
        // $this->pagination->initialize($config);
        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // $data["links"] = $this->pagination->create_links();
        // $data['module']  = "attendance";
        // $data['attendance']=$this->Csv_model->att_log($config["per_page"], $page);
        // $data['page']   = "attendance_log";
        $zk->enableDevice();
        $zk->disconnect();
        // echo Modules::run('template/layout', $data); 
    } 
    //Attendance Log report
    public function att_log_report(){
        $data['title']   = 'Attendance Log';
        $config["base_url"] = base_url('attendance/home/att_log_report/');
        $config["total_rows"]  = $this->Csv_model->count_att_report();
        $config["per_page"]    = 10;
        $config["uri_segment"] = 4;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['module']  = "attendance";
        $data['queryd']=$this->Csv_model->att_report($config["per_page"], $page);
        $data['userlist'] =$this->Csv_model->userlist();
        $data['page']    = "attendance_log_datewise";
        echo Modules::run('template/layout', $data); 
    }
     //Attendance Log report userwise
    public function user_attendanc_details($id){
        $data['title']   = 'Attendance Log';
         $config["base_url"] = base_url('attendance/home/user_attendanc_details/'.$id);
        $config["total_rows"]  = $this->Csv_model->count_atn_log($id);
        $config["per_page"]    = 3;
        $config["uri_segment"] = 5;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['module']  = "attendance";
        $data['queryd']  = $this->Csv_model->att_report_userwise($config["per_page"], $page, $id);
        $data['id'] = $id;
        $data['company'] = $this->Csv_model->company_info();
        $data['user']  = $this->Csv_model->deviceuser($id);
        $data['page']    = "attendance_log_userdetails";
        echo Modules::run('template/layout', $data); 
    }
    // Date between and user wise attendance log
    public function datebetween_attendance(){
        $id = $this->input->get('employee_id');
        $from_date =$this->input->get('start_date');
        $to_date = $this->input->get('end_date');
        $data['module']  = "attendance";
        $data['atten_in'] =  $this->Csv_model->att_log_datebetween($id,$from_date,$to_date);
        $data['userlist'] =$this->Csv_model->userlist();
        $data['start'] = $from_date;
        $data['end']   = $to_date;
        $data['user']  = $this->Csv_model->deviceuser($id);
        $data['company'] = $this->Csv_model->company_info();
           $this->load->library('pdfgenerator');
            $dompdf = new DOMPDF();
            $page = $this->load->view('attendance/individual_att_history_pdf',$data,true);
            $dompdf->load_html($page);
            $dompdf->render();
            $output = $dompdf->output();
            file_put_contents('assets/data/pdf/attendance/Attendance History of '.$id.' '.$from_date.' To '.$to_date.'.pdf', $output);


            $data['pdf']    = 'assets/data/pdf/attendance/Attendance History of '.$id.' '.$from_date.' To '.$to_date.'.pdf';


        $data['page']   = "attendance_log_datebetween";
        echo Modules::run('template/layout', $data);
    }

    public function delete_attendance($id,$user_id){
    if ($this->Csv_model->attendance_delete($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));

        }
        redirect("attendance/home/user_attendanc_details/".$user_id);
    }
}

