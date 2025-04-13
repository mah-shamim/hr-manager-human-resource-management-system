<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->load->helper('url');
        $this->load->model(array(
            'Csv_model',
             'Attendance_model'
        )); 
        $this->load->library('excel');
        
        $this->load->model('rewardpoint/rewardpoints_model');

        if (! $this->session->userdata('isLogIn'))
            redirect('login');     
    }
    
    function index($id = null) {

        $this->permission->check_label('atn_form')->create()->redirect();

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

    //Importing attendance data from csv file, and data must be in format of given sample file without AM/PM in each data cell... also if not possible to remove AM/PM, then need to give a white space at left side of that attendance time cell...
    function importcsv() {

        if(isset($_FILES["upload_csv_file"]["name"]) && $_FILES["upload_csv_file"]["name"])
        {

            $extension = pathinfo($_FILES['upload_csv_file']['name'], PATHINFO_EXTENSION);

            if($extension != 'xlsx'){

                $this->session->set_flashdata('exception', "You must upload excel file as given sample !");
                redirect('attendance/home/index');
            }

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
                    $in = trim($sale->getCellByColumnAndRow(2, $row)->getValue());
                    $out = trim($sale->getCellByColumnAndRow(3, $row)->getValue());
                    $attdate = date('Y-m-d', strtotime($date));
                    $in_time = date('H:i:s', strtotime($in));
                    $out_time = date('H:i:s', strtotime($out));
                    $indatetime = $attdate.' '.$in_time;
                    $outdatetime = $attdate.' '.$out_time;

                    $indata = array(
                        'uid'    => $employee_id,
                        'state'  => 1,
                        'id'     => 0,
                        'time'   => $indatetime,
                    );
                    $outdata = array(
                        'uid'    => $employee_id,
                        'state'  => 1,
                        'id'     => 0,
                        'time'   => $outdatetime,
                    );


                    //Forming message if employee id is/not available in excel sheet
                    if(empty($employee_id)){
                        $employee_msg = "";
                    }else{
                        $employee_msg = "For employee id ";
                    }

                    //Checking In time avalable or not
                    if(!empty($in)){

                        $respo_atten = $this->rewardpoints_model->find_attendance_history($indata);
                        if(empty($respo_atten)){

                            $this->db->insert('attendance_history',$indata);
                        } 
                    }else{

                        $this->session->set_flashdata('exception', "".$employee_msg.""."".$employee_id." In time data is missing at row no ".$row." , Please correct your data and upload again.");
                        redirect('attendance/home/index');
                    }

                    //Checking Out time avalable or not
                    if(!empty($out)){

                        $respo_atten = $this->rewardpoints_model->find_attendance_history($outdata);
                        if(empty($respo_atten)){

                            $this->db->insert('attendance_history',$outdata);
                        }
                    }else{

                       $this->session->set_flashdata('exception', "".$employee_msg.""."".$employee_id." Out time data is missing at row no ".$row." , Please correct your data and upload again.");
                        redirect('attendance/home/index');
                    }
   
            }

        }
                  
            $this->session->set_flashdata('message', display('successfully_uploaded'));
            redirect('attendance/home/att_log_report');
        }else{

            $this->session->set_flashdata('exception', "Please select a file to upload attendance as given sample file.");
            redirect('attendance/home/index');
        }
    } 

    //Exporting attendence data
    public function exportattn() {

        $this->form_validation->set_rules('start_date',display('start_date'),'required');
        $this->form_validation->set_rules('end_date',display('end_date'),'required');

        if ($this->form_validation->run() === true) {

            $data = $this->input->post();

            // create file name
            $fileName = 'attendence-'.date('d-m-Y').'.xlsx';
            // load excel library
            $this->load->library('excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
            // set Header
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Employee ID');
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date Format');
            $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'In time');
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Out time'); 

            //fetch data from db starts
            $appData = $this->rewardpoints_model->get_attendence($data);

            $temp_uid = "";
            $temp_date = "";
            $ix = 1;

            $final_data = "";
            $i=1;

            // set Row
            $rowCount = 2;
            foreach ($appData as $value) 
            {
                $dt = new DateTime($value->time);

                if($temp_uid != $value->uid ){

                    $temp_uid = $value->uid;
                    $temp_date = $value->time;
                    $ix++;
                    $i=1;

                 }
                 else if(date("Y-m-d", strtotime($temp_date)) != date("Y-m-d", strtotime($value->time))){
                    
                    $rowCount++;
                    $temp_date = $value->time;

                    $i=1;
                 }

                if($i%2 !=0){

                    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, @$value->uid);
                    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, @date("Y-m-d", strtotime($value->time)));
                    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $dt->format('H:i:s'));

                } else {

                    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $dt->format('H:i:s'));
                    $rowCount++;
                }

                $i++;
            }
     
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save($fileName);
            // download file
            header("Content-Type: application/vnd.ms-excel");
            redirect(site_url().$fileName);

        }else{
             $this->session->set_flashdata('exception', display('please_try_again'));
             redirect('attendance/home');
        }

        
    }
    //End of exporting attendence data

    function monthly_manual_attendance() {
        $this->permission->module('attendance','create')->redirect();
        $data['title']            = display('monthly_attendance');
        $data['addressbook']      = $this->Csv_model->get_addressbook();
        $data['dropdownatn']      = $this->Csv_model->Employeename();
        $data['module']           = "attendance";
        $data['page']             = "monthly_manual_attendance";   
        echo Modules::run('template/layout', $data); 
    }

    public function missing_attendance(){
        $this->permission->module('attendance','create')->redirect();
        $data['title']            = display('missing_attendance');
        $data['module']           = "attendance";
        $data['page']             = "missing_attendance";   
        echo Modules::run('template/layout', $data); 
    }


    public function monthly_attendance_add(){
            $this->form_validation->set_rules('emp_id[]',display('employee_id'),'required|max_length[50]');
            $this->form_validation->set_rules('status[]',display('status'));
            $this->form_validation->set_rules('intimes[]',display('intime'));
            $this->form_validation->set_rules('outtimes[]',display('out_time'));

        #-------------------------------#
            if ($this->form_validation->run() === true) {

        $emp_id              = $this->input->post('emp_id',true);
        $checkinput          = $this->input->post('checkItem',true);
        $intimes             = $this->input->post('intimes',true);
        $outtimes            = $this->input->post('outtimes',true);
        $stat                = $this->input->post('status',true);
        
        for ($i = 0, $n = count($checkinput); $i < $n; $i++) {
            $checkdata   = $checkinput[$i];
            $employee_id = $emp_id[$i];
            $intime      = $intimes[$i];
            $out_time    = $outtimes[$i];
            $status      = $stat[$i];
            $indata = array(
                'uid'    => $employee_id,
                'state'  => 1,
                'id'     => 0,
                'time'   => $intime,
            );
             $outdata = array(
                'uid'    => $employee_id,
                'state'  => 1,
                'id'     => 0,
                'time'   => $out_time,
            );
            if ($status == 0) {
                $this->db->insert('attendance_history', $indata);
                $this->db->insert('attendance_history', $outdata);

            }
            }
        $this->session->set_flashdata('message', display('save_successfull'));
        redirect("attendance/Home/monthly_manual_attendance");
    }else{
    $this->session->set_flashdata('exception',  display('please_try_again')); 
     redirect("attendance/Home/monthly_manual_attendance");   
    }
}

// add missing attendance
 public function missing_attendance_add(){
            $this->form_validation->set_rules('emp_id[]',display('employee_id'),'required|max_length[50]');
            $this->form_validation->set_rules('status[]',display('status'));
            $this->form_validation->set_rules('intimes[]',display('intime'),'required');
            $this->form_validation->set_rules('outtimes[]',display('out_time'));
        

        #-------------------------------#
            if ($this->form_validation->run() === true) {

        $emp_id              = $this->input->post('emp_id',true);
        $checkinput          = $this->input->post('checkItem',true);
        $intimes             = $this->input->post('intimes',true);
        $outtimes            = $this->input->post('outtimes',true);
        $stat                = $this->input->post('status',true);
        $date                = $this->input->post('mdate');
        
        for ($i = 0, $n = count($checkinput); $i < $n; $i++) {
            $checkdata   = $checkinput[$i];
            $employee_id = $emp_id[$i];
            $intime      = $intimes[$i];
            $out_time    = $outtimes[$i];
            $status      = $stat[$i];
            $indata = array(
                'uid'    => $employee_id,
                'state'  => 2,
                'id'     => 0,
                'time'   => $date.' '.$intime.':00',
            );
             $outdata = array(
                'uid'    => $employee_id,
                'state'  => 2,
                'id'     => 0,
                'time'   => $date.' '.$out_time.':00',
            );
            if ($status == 0) {
                $this->db->insert('attendance_history', $indata);
                if(!empty($out_time)){
                $this->db->insert('attendance_history', $outdata);
            }

            }
            }
        $this->session->set_flashdata('message', display('save_successfull'));
        redirect("attendance/Home/missing_attendance");
    }else{
    $this->session->set_flashdata('exception',  display('please_try_again')); 
     redirect("attendance/Home/missing_attendance");   
    }
}
    public function create_atten()
    { 
        $data['title'] = display('employee');
        $time = $this->input->post('intime');
        $out_time = $this->input->post('out_time');
        $att_time = date('Y-m-d H:i:s', strtotime($time));
        $out_time = date('Y-m-d H:i:s', strtotime($out_time));
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
             $outtime = [
                'uid'    => $this->input->post('employee_id',true),
                'state'  => 1,
                'id'     => 0,
                'time'   => $out_time,
                
            ]; 

               $update_attendance = [
                'atten_his_id'=> $id,
                'uid'    => $this->input->post('employee_id',true),
                'state'  => 1,
                'id'     => 0,
                'time'   => $att_time,
                
            ]; 

            if(empty($id)){

                // If logged in as employee and not supervisor , then checking if trying to change readonly attendance time from browser inspect element..
                if($this->session->userdata['employee_id'] && !$this->session->userdata['supervisor'] && strtotime($time) != strtotime($this->session->userdata['attendance_time'])){

                    $this->session->set_flashdata('exception',  display('please_try_again'));
                    redirect("attendance/Home/index");

                }

            if ($this->Csv_model->atten_create($attendance_history)) {

                /*request to attendence point system through rewardpoints_model*/

                $respo = $this->rewardpoints_model->insert_attendence_point($attendance_history);

                //From attenview , currently no out_time field value coming.. handling all time through in_time filed time..
                if(!empty($this->input->post('out_time'))){
                    $this->db->insert('attendance_history',$outtime);

                    //Inserting attenndence history when taking input in attendence form..

                    $respo = $this->rewardpoints_model->insert_attendence_point($outtime);

                }

                /*End of request to attendence point system*/

                $this->session->set_flashdata('message', display('save_successfull'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }

           redirect("attendance/Home/att_log_report");
       }else{
         if ($this->Csv_model->atten_update($update_attendance)) { 
                /*update request to attendence point system through rewardpoints_model*/
                $respo = $this->rewardpoints_model->insert_attendence_point($update_attendance);
                
                /*End of update request to attendence point system*/
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }

           redirect("attendance/Home/user_attendanc_details/".$this->input->post('employee_id',true));

       }

        } else {
            $data['title']  = display('create');
            $data['addressbook']      = $this->Csv_model->get_addressbook();
            $data['dropdownatn']      = $this->Csv_model->Employeename();
            $data['module'] = "attendance";
            $data['page']   = "atnview";
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
    }

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
    }

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
                'device_ip' => $this->input->post('device_ip',true)
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
    } 
    //Attendance Log report
    public function att_log_report(){

        //Redirect to individual employee attendence log report page..
        if($this->session->userdata['employee_id']){

            redirect("attendance/home/emp_att_log_report/");

        }
        //End of redirection to individual employee attendence log report page..

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

    //Individual employee attendance Log report .. as employee can see only his attendence logs
    public function emp_att_log_report(){

        $employee_id = $this->session->userdata['employee_id'];

        $data['title']   = 'Employee attendance Log';
        $config["base_url"] = base_url('attendance/home/emp_att_log_report/');
        $config["total_rows"]  = $this->Csv_model->count_emp_att_report($employee_id);
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
        $data['queryd']=$this->Csv_model->emp_att_report($config["per_page"], $page, $employee_id);
        $data['userlist'] =$this->Csv_model->userlist();
        $data['employee_id']  = $employee_id;
        $data['page']    = "emp_attendance_log_datewise";

        echo Modules::run('template/layout', $data); 
    }
    //End of individual employee attendance Log report

     //Attendance Log report userwise
    public function user_attendanc_details($id){
        
        $user_attn_page_data = array(
                'user_attn_page'  => $this->uri->segments[5]
        );
        
        $this->session->set_userdata($user_attn_page_data);

        $employee_id = $this->session->userdata['employee_id'];
        $supervisor = $this->session->userdata['supervisor'];
        
        if($employee_id && $employee_id != $id && !$supervisor){
            redirect("attendance/home/emp_att_log_report/");
        }

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

    //When login as employee, then on clicking Details button in user_attendance_log_details... will call this function
    public function user_attendanc_date_details($id , $date){

        $employee_id = $this->session->userdata['employee_id'];

        if($employee_id != $id){
            redirect("attendance/home/emp_att_log_report/");
        }

        $data['id'] = $id;
        $data['attendance_date'] = $date;
        $data['company'] = $this->Csv_model->company_info();
        $data['user']  = $this->Csv_model->deviceuser($id);

        $data['module']  = "attendance";
        $data['page']    = "attendance_log_datewisedetails";

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
            $dompdf->set_paper('Legal', 'landscape');
            $page = $this->load->view('attendance/individual_att_history_pdf',$data,true);
            $dompdf->load_html($page);
            $dompdf->render();
            $output = $dompdf->output();
            file_put_contents('assets/data/pdf/attendance/Attendance History of '.$id.' '.$from_date.' To '.$to_date.'.pdf', $output);


            $data['pdf']    = 'assets/data/pdf/attendance/Attendance History of '.$id.' '.$from_date.' To '.$to_date.'.pdf';


        $data['page']   = "attendance_log_datebetween";
        echo Modules::run('template/layout', $data);
    }

    // Date between and user wise attendance log for particular employee login
    public function emp_datebetween_attendance(){
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

        $data['employee_id']  = $id;
        $data['page']   = "emp_attendance_log_datebetween";
        echo Modules::run('template/layout', $data);
    }

    public function delete_attendance($id,$user_id){
        
        //Redirect to same page from where attendeance deleted...
        $user_attn_page = $this->session->userdata['user_attn_page'];

        $attendance_data =  $this->db->select("*")->from("attendance_history")
        ->where('atten_his_id',$id)
        ->get()
        ->row();

        $attn_data = (array)$attendance_data;

        if ($this->Csv_model->attendance_delete($id)) {

            $respo = $this->rewardpoints_model->insert_attendence_point($attn_data);

            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));

        }
        redirect("attendance/home/user_attendanc_details/".$user_id."/".$user_attn_page);
    }

    /* Started for gambia client for lateness and early closing report*/

    public function lateness_early_closing() {

        $this->permission->module('attendance','read')->redirect();

        $data['title']            = display('lateness_early_closing');
        $data['dropdownatn']      = $this->Csv_model->Employeename();
        $data['module']           = "attendance";
        $data['page']             = "lateness_early_closing"; 

        echo Modules::run('template/layout', $data); 
    }

    public function lateness_early_closing_report() {

        $this->permission->module('attendance','read')->redirect();

        $employee_id = $this->input->post('employee_id');
        $year        = $this->input->post('year');
        $month       = $this->input->post('month');

        if($employee_id == "" || $year == "" || $month == ""){

            $this->session->set_flashdata('message',"Please fill up all required fields.");
            redirect("attendance/home/lateness_early_closing/");
        }
        // Get all the data based on the filter request data

        $data['late_early_closings']  = $this->Attendance_model->get_employee_late_closing_attendence($employee_id,$year,$month);
        $data['employee_info']        = $this->Attendance_model->get_employee_info($employee_id);
        $data['attendence_rule']      = $this->Attendance_model->get_employee_attendence_rule($employee_id,$data['employee_info']->attendance_time);
        $data['attendence_rule_info']      = $this->Attendance_model->get_employee_attendence_rule_info($data['attendence_rule']->rule_id);

        $data['setting'] = $this->db->get('setting')->row();
        $data['user_info'] = $this->session->userdata();
        
        // PDF Generator
        
        $monthName = date('F', mktime(0, 0, 0, $month, 10));
        $date_m = $monthName.$year;

        $this->load->library('pdfgenerator');
        $dompdf = new DOMPDF();
        $dompdf->set_paper('Legal', 'landscape');
        $page = $this->load->view('lateness_early_closing_pdf',$data,true);
        $dompdf->load_html($page);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('assets/data/pdf/lateness_early_closing_for_'.$date_m.'.pdf', $output);
        $data['pdf']    = 'assets/data/pdf/lateness_early_closing_for_'.$date_m.'.pdf'; 


        // Ends

        $data['title']            = display('lateness_early_closing_report');
        $data['dropdownatn']      = $this->Csv_model->Employeename();
        $data['module']           = "attendance";
        $data['page']             = "lateness_early_closing_report";

        echo Modules::run('template/layout', $data); 
    }

    //Exporting lateness attendence data
    public function export_late_attn() {

        $this->permission->module('attendance','read')->redirect();

        $employee_id = $this->input->post('expt_employee_id');
        $year        = $this->input->post('expt_year');
        $month       = $this->input->post('expt_month');

        if($employee_id == "" || $year == "" || $month == ""){

            $this->session->set_flashdata('message',"Something went wrong, please try again !");
            redirect("attendance/home/lateness_early_closing/");
        }
        // Get all the data based on the filter request data

        $late_early_closings  = $this->Attendance_model->get_employee_late_closing_attendence($employee_id,$year,$month);
        $employee_info        = $this->Attendance_model->get_employee_info($employee_id);
        $attendence_rule      = $this->Attendance_model->get_employee_attendence_rule($employee_id,$employee_info->attendance_time);
        $attendence_rule_info = $this->Attendance_model->get_employee_attendence_rule_info($attendence_rule->rule_id);

        if (!empty($late_early_closings)) {

            // create file name
            $fileName = 'lateness of attendence for '.$employee_info->first_name.' '.$employee_info->last_name.'-'.date('d-m-Y').'.xlsx';
            // load excel library
            $this->load->library('excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
            // set Header
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl');
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date');
            $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'In time');
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Attendance Setup(In Time)'); 
            $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Late Time'); 
            $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Out Time'); 
            $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Attendance Setup(Out Time)'); 
            $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Early Closing'); 

            $i = 1;
            // set Row
            $rowCount = 2;

            foreach ($late_early_closings as $key => $data) {

                $atten_data = $data[0];

                $date = date('Y-m-d',strtotime($atten_data->intime));
                $in_time = date('H:i',strtotime($atten_data->intime));
                $out_time = date('H:i',strtotime($atten_data->outtime));

                $attendence_setup_in_time = strtotime($attendence_rule_info->start_time);
                $attendence_setup_end_time = strtotime($attendence_rule_info->end_time);

                // Evaluate late in time
                $in_time_diff = '';

                if($attendence_setup_in_time < strtotime($in_time)){

                  $in_t_diff = strtotime($in_time) - $attendence_setup_in_time;
                  $in_time_diff = gmdate('H:i',$in_t_diff);

                }else{

                  $in_time_diff = '00:00';
                }

                // Evaluate out time

                $show_out_time = '00:00';

                if($in_time != $out_time){
                   $show_out_time = $out_time;
                }

                // Evaluate late out time

                $out_time_diff = '';

                if($attendence_setup_end_time > strtotime($out_time) && $in_time != $out_time){

                  $out_t_diff =  $attendence_setup_end_time - strtotime($out_time);
                  $out_time_diff = gmdate('H:i',$out_t_diff);

                }else{

                  $out_time_diff = '00:00';
                }


                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $date);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $in_time);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $attendence_rule_info->start_time);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $in_time_diff);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $show_out_time);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $attendence_rule_info->end_time);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $out_time_diff);

                $rowCount++;

                $i++;
            }
     
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save($fileName);
            // download file
            header("Content-Type: application/vnd.ms-excel");
            redirect(site_url().$fileName);

        }else{

             $this->session->set_flashdata('exception', display('please_try_again'));
             redirect("attendance/home/lateness_early_closing/");
        }

        
    }
    //End of exporting lateness attendence data

    /* Ends */

}

