<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_report extends MX_Controller {

    public function __construct()
    {
      parent::__construct();
     $this->db->query('SET SESSION sql_mode = ""');
      $this->load->model(array(
         'attendance_model','report_model'
     ));
     if (! $this->session->userdata('isLogIn'))
            redirect('login');		 
  }

  public function daily_presents(){
    $department          = $this->input->post('department_id');
    $date                = $this->input->post('date'); 
    $data['title']       = 'Present Report'; 
    $data['departments'] = $this->attendance_model->departments();
    $data['results']     = $this->attendance_model->daily_present_data($department,$date);
    $data['date']        = (!empty($date)?$date:'');
    $data['department_id']= (!empty($department)?$department:'');
    $data['issearch']     = (!empty($department)?$department:'');
    $data['module']      = "reports";
    $data['page']        = "attendance/daily_present";   
    echo Modules::run('template/layout', $data); 
  }

   public function daily_absent(){
    $department          = $this->input->post('department_id');
    $date                = $this->input->post('date'); 
    $data['title']       = 'Absent Report'; 
    $data['departments'] = $this->attendance_model->departments();
    if($date){
    $data['results']     = $this->attendance_model->daily_absent_data($department,$date);
  }
    $data['dropdownemp'] = $this->report_model->employee_drop();
    $data['date']        = (!empty($date)?$date:'');
    $data['department_id']= (!empty($department)?$department:'');
    $data['issearch']     = (!empty($department)?$department:'');
    $data['module']       = "reports";
    $data['page']         = "attendance/daily_absent";   
    echo Modules::run('template/layout', $data); 
  }

  public function monthly_presents(){
    $department          = $this->input->post('department_id');
    $employee_id         = $this->input->post('employee_id');
    $year                = $this->input->post('year',true); 
    $month               = $this->input->post('month',true);
    $data['title']       = 'Present Report'; 
    $data['departments'] = $this->attendance_model->departments();
    if($department){
    $data['results']     = $this->attendance_model->allday_of_yearmonth($year,$month);
  }
    $data['dropdownemp']  = $this->attendance_model->employeeList();
    $data['employee_id']  = (!empty($employee_id)?$employee_id:'');
    $data['year']         = (!empty($year)?$year:'');
    $data['month']        = (!empty($month)?$month:'');
    $data['department_id']= (!empty($department)?$department:'');
    $data['issearch']     = (!empty($department)?$department:'');
    $data['module']       = "reports";
    $data['page']         = "attendance/monthly_presents";   
    echo Modules::run('template/layout', $data); 
  }


     /*MONTHLY ABSENT REPORT*/
     public function monthly_absent(){
    $department          = $this->input->post('department_id');
    $employee_id         = $this->input->post('employee_id');
    $year                = $this->input->post('year',true); 
    $month               = $this->input->post('month',true); 
    $data['title']       = 'Absent Report'; 
    $data['departments'] = $this->attendance_model->departments();
    if($department){
    $data['results']     = $this->attendance_model->allday_of_yearmonth($year,$month);
  }
    $data['dropdownemp']  = $this->attendance_model->employeeList();
    $data['employee_id']  = (!empty($employee_id)?$employee_id:'');
    $data['year']         = (!empty($year)?$year:'');
    $data['month']        = (!empty($month)?$month:'');
    $data['department_id']= (!empty($department)?$department:'');
    $data['issearch']     = (!empty($department)?$department:'');
    $data['module']       = "reports";
    $data['page']         = "attendance/monthly_absent";   
    echo Modules::run('template/layout', $data); 
  }

}