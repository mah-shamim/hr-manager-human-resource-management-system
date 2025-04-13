<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model {

     
    function insert_csv($data) {
        $this->db->insert('emp_attendance', $data);
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


	function find_leave($employee_id,$date){
		$query = $this->db->select("*")
		                 ->from('leave_apply')
		                 ->where('employee_id',$employee_id)
		                 ->where('leave_aprv_strt_date <=',$date)
		                 ->where('leave_aprv_end_date >=',$date)
		                 ->get();
						if($query->num_rows() > 0){
							return $query->num_rows();
						}else{
							return 0;
						}
	}

	function get_employee_attendence($data){

		$date_start = $data['date'];
		$dateis = "(DATE(attendance_history.time) = '$date_start')";

		$attn_his = $this->db->select('*')
        ->from('attendance_history')
        ->where($dateis)
        ->where('attendance_history.uid',$data['emp_id'])
        ->order_by('attendance_history.time','ASC')
        ->get()
        ->result();

        return $attn_his;
	}


	function get_employee_late_closing_attendence($employee_id,$year,$month){



		$from_date = $year.'-'.$month.'-'.'1';
		$to_date   = date("Y-m-t", strtotime($from_date));

	    $att = "SELECT *, DATE(time) as mydate FROM `attendance_history` WHERE `uid`=$employee_id AND DATE(time) BETWEEN '" . $from_date . "' AND  '" . $to_date . "' GROUP BY mydate ORDER BY time asc";
	    $query = $this->db->query($att)->result();
	    $att_in = [];

		$i=1;

		foreach ($query as $attendance) {

		    $att_in[$i] = $this->db->select('a.time,MIN(a.time) as intime,MAX(a.time) as outtime,a.uid')
				->from('attendance_history a')
				->like('a.time',date( "Y-m-d", strtotime($attendance->mydate)),'after')
				->where('a.uid',$attendance->uid)
				->order_by('a.time','DESC')
				->get()
				->result();

			$i++;
		}

		return $att_in;

	}

	// employee info
    public function get_employee_info($employee_id){

        return $result = $this->db->select('*')->from('employee_history')->where('employee_id',$employee_id)->get()->row();
    }

    // get_employee_attendence_rule
	public function get_employee_attendence_rule($employee_id, $rule_id){

		$attendence_rule = $this->db->select('*')
				->from('gmb_rules_map')
				->where('employee_id',$employee_id)
				->where('rule_id',$rule_id)
				->where('type','time')
				->where('status',1)
				->get()
				->row();

		return $attendence_rule;
	}

	// employee info
    public function get_employee_attendence_rule_info($rule_id){
    	
        return $result = $this->db->select('*')->from('gmb_setup_rules')->where('rule_id',$rule_id)->get()->row();
    }


}

