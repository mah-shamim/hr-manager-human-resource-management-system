<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model {
 public function departments()
	{
		$data = $this->db->select("*")
            ->from('department') 
            ->get()
            ->result();

        $list[''] = display('select_department');
        $list['all'] = display('all');
        if (!empty($data)) {
            foreach($data as $value)
                $list[$value->dept_id] = $value->department_name;
            return $list;
        } else {
            return false; 
        }
	}

	public function daily_present_data($dempatment = null,$date = null){
     $this->db->select('a.first_name,a.last_name,d.department_name,min(at.time) as intime,max(at.time) as outtime,at.uid');
        $this->db->from('employee_history a');
        $this->db->join('department d','d.dept_id = a.dept_id');
        $this->db->join('attendance_history at','at.uid = a.employee_id');
        if($dempatment != 'all'){
        $this->db->where('a.dept_id',$dempatment);
        }
        $this->db->where('DATE(at.time)',$date);
        $this->db->order_by('at.time', 'asc');
        $this->db->group_by('at.uid');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}

    public function daily_absent_data($dempatment = null,$date = null){

        $attend = $this->db->select('*')
                   ->from('attendance_history')
                   ->where('DATE(time)',$date)
                   ->group_by('uid')
                   ->get()
                   ->result_array();

                   $present[] = '0';
            foreach($attend as $row) {
                $present[] = $row['uid'];
            }

         $leave = $this->db->select('*')
                    ->from('leave_apply')
                    ->where('leave_aprv_strt_date <=',$date)
                    ->where('leave_aprv_end_date >=',$date)
                    ->get()
                    ->result_array();                   
                   

                   $levemp[] = '0';
                   foreach ($leave as $lvemp) {
                     $levemp[] = $lvemp['employee_id'];
                   }

        $this->db->select('a.*,b.department_name');
        $this->db->from('employee_history a');
        $this->db->join('department b','b.dept_id = a.dept_id','left');
        $this->db->where_not_in('a.employee_id', $present);
        $this->db->where_not_in('a.employee_id', $levemp);
        if($dempatment != 'all'){
        $this->db->where('a.dept_id',$dempatment);
        }
        $det = $this->db->get()->result_array();
                   if(!empty($det)){
                    $details = $det;
                   }else{
                    $details = [];
                   }
                   return $details;
    }

        public function find_weekend($date){
        $day = date('l', strtotime($date));
        $this->db->select('*');
        $this->db->from('weekly_holiday');
        $this->db->where("FIND_IN_SET('".$day."', dayname)");
        $query=$this->db->get();
        $data=$query->num_rows();
        return $data;
    }

     public function employeeList()
    {
        $data = $this->db->select("*")
            ->from('employee_history') 
            ->where('employee_status',1)
            ->get()
            ->result();

        $list['']    = display('select_employee');
        $list['all'] = display('all');
        if (!empty($data)) {
            foreach($data as $value)
                $list[$value->employee_id] = $value->first_name.' '.$value->last_name;
            return $list;
        } else {
            return false; 
        }
    }

        public function monthly_present_data($employee_id,$dempatment = null,$date = null){
     $this->db->select('a.first_name,a.last_name,d.department_name,min(at.time) as intime,max(at.time) as outtime,at.uid');
        $this->db->from('employee_history a');
        $this->db->join('department d','d.dept_id = a.dept_id');
        $this->db->join('attendance_history at','at.uid = a.employee_id');
        if($employee_id != 'all'){
        $this->db->where('a.employee_id',$employee_id);
        }
        if($dempatment != 'all'){
        $this->db->where('a.dept_id',$dempatment);
        }
        $this->db->where('DATE(at.time)',$date);
        $this->db->order_by('at.time', 'asc');
        $this->db->group_by('at.uid');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return [];
    }



    public function allday_of_yearmonth($year=null,$month=null){
   $list=array();
    $month = $month;
    $year = $year;

    for($d=1; $d<=31; $d++)
    {
        $time=mktime(12, 0, 0, $month, $d, $year);          
        if (date('m', $time)==$month)       
            $list[]=date('Y-m-d', $time);
    }

    return $list;

    }
 }