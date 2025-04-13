<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_model extends CI_Model {
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


    public function leave_type()
    {
        $data = $this->db->select("*")
            ->from('leave_type') 
            ->get()
            ->result();

        $list['']    = display('select_type');
        $list['all'] = display('all');
        if (!empty($data)) {
            foreach($data as $value)
                $list[$value->leave_type_id] = $value->leave_type;
            return $list;
        } else {
            return false; 
        }
    }


  public function on_leave($lv_id,$department,$from_date,$to_date){


        $this->db->select('a.*,b.leave_type as ltype,c.first_name,c.last_name,d.department_name');
        $this->db->from('leave_apply a');
        $this->db->join('leave_type b','b.leave_type_id=a.leave_type_id');
        $this->db->join('employee_history c','c.employee_id=a.employee_id');
        $this->db->join('department d','d.dept_id = c.dept_id');
        $this->db->where('a.leave_aprv_strt_date >=',$from_date);
        $this->db->where('a.leave_aprv_end_date <=',$to_date);
        if($lv_id != 'all'){
        $this->db->where('a.leave_type_id',$lv_id);
        }
        if($department != 'all'){
        $this->db->where('c.dept_id',$department);
        }
        $this->db->group_by('a.leave_appl_id');
        $leave = $this->db->get()->result_array();
        return $leave;
     

  }
     

 }  
