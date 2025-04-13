<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_report extends MX_Controller {

    public function __construct()
    {
      parent::__construct();
     $this->db->query('SET SESSION sql_mode = ""');
      $this->load->model(array(
         'leave_model'
     ));
     if (! $this->session->userdata('isLogIn'))
            redirect('login');		 
  }

  public function employee_on_leave(){
    $department          = $this->input->post('department_id');
    $from_date           = $this->input->post('from_date');
    $to_date             = $this->input->post('to_date');
    $leave_type          = $this->input->post('leave_type',true);
    $data['title']       = 'Employee On Leave'; 
    $data['departments'] = $this->leave_model->departments();
    $data['dropdownemp'] = $this->leave_model->employeeList();
    $data['leave']       = $this->leave_model->leave_type();
    if($leave_type){
    $data['results']    = $this->leave_model->on_leave($leave_type,$department,$from_date,$to_date);
  }
    $data['leavtype']   = (!empty($leave_type)?$leave_type:'');
    $data['from_date']   = (!empty($from_date)?$from_date:'');
    $data['to_date']     = (!empty($to_date)?$to_date:'');
    $data['department_id']= (!empty($department)?$department:'');
    $data['issearch']     = (!empty($leave_type)?$leave_type:'');
    $data['module']      = "reports";
    $data['page']        = "leave/employee_on_leave";   
    echo Modules::run('template/layout', $data); 
  }


public function leave_balance(){
    $employee_id         = $this->input->post('department_id');
    $year                = $this->input->post('year',true);
    $data['dropdownemp'] = $this->leave_model->employeeList();
    if($employee_id){
    $data['results']    = $this->leave_model->on_leave($employee_id,$year);
     }
    $data['year']        = (!empty($year)?$year:'');
    $data['employee_id'] = (!empty($employee_id)?$employee_id:'');
    $data['issearch']    = (!empty($employee_id)?$employee_id:'');
    $data['module']      = "reports";
    $data['page']        = "leave/leave_balance";   
    echo Modules::run('template/layout', $data); 
}
 
}