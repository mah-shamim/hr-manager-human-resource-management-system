<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csv_model extends CI_Model {

    
    function get_addressbook() { 
$query =$this->db->select("count(DISTINCT(e.att_id)) as att_id,e.*,p.employee_id,p.first_name,p.last_name")->join('employee_history p','e.employee_id = p.employee_id','left')->group_by('e.att_id')->order_by('e.att_id', 'desc')->get('emp_attendance e');


        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    function insert_csv($data) {
        $this->db->insert('emp_attendance', $data);
    }


public function delete_attn($id = null)
    {
        $this->db->where('att_id',$id)
            ->delete('emp_attendance');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    } 

    public function attendance_delete($id = null)
    {
        $this->db->where('atten_his_id',$id)
            ->delete('attendance_history');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function atten_create($data = array())
    {
        return $this->db->insert('attendance_history', $data);
    }

   
    
public function update_attn($data = array())
    {
        return $this->db->where('att_id', $data["att_id"])
            ->update("emp_attendance", $data);
    }
    public function attn_updateForm($id){
        $this->db->where('att_id',$id);
        $query = $this->db->get('emp_attendance');
        return $query->row();
    }

   public  function get_atn_dropdown($id)
    {
        $query=$this->db->get_where('emp_attendance',array('att_id'=>$id));
        return $query->row_array();
    }  


    public function Employeename()
    {
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_status',1);
        $query=$this->db->get();
        $data=$query->result();
        
       $list = array('' => 'Select One...');
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->employee_id]=$value->first_name.' '.$value->last_name."(".$value->employee_id.")";
            }
        }
        return $list;
    }


    /********* Repor Start  #################% ********/
     public function userReport($format_start_date,$format_end_date){
      
$this->db->select('e.*,count(DISTINCT(p.emp_his_id)) as emp_his_id,p.employee_id,p.first_name,p.last_name');

$this->db->from('emp_attendance e');
$this->db->join('employee_history p','e.employee_id = p.employee_id','left');
$this->db->where('e.date >=', $format_start_date);
$this->db->where('e.date <=', $format_end_date);
$this->db->group_by('e.att_id');
$query = $this->db->get();
$result = $query->result();
return $result;

    }
function search($id,$start_date,$end_date)
    {
        if (!empty($id)){
        $this->db->from('emp_attendance');
        $this->db->like('employee_id', $id);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date); 
        $query = $this->db->get();
        return $query->result();
        }
        else {echo 'Sorry Enter Employee Id';}
    }


    function search_intime($date,$start_time,$end_time)
    {
        if (!empty($date)){
        $this->db->select('count(DISTINCT(e.att_id)) as att_id,e.*,p.employee_id,p.first_name,p.last_name');

$this->db->from('emp_attendance e');
$this->db->join('employee_history p','e.employee_id = p.employee_id','left');
        $this->db->like('e.date', $date);
        $this->db->where('e.sign_in >=', $start_time);
        $this->db->where('e.sign_in <=', $end_time); 
        $query = $this->db->get();
        return $query->result();
        }
        else {echo 'Sorry Enter Date';}
    }

    public function atnrp($id){
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_id',$id);
        $ab = $this->db->get();
        return $ab->result();
}

// Attendance Log info
public function att_log($limit = null, $start = null){
     $this->db->select('*');
        $this->db->from('attendance_history');
        $this->db->order_by('atten_his_id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
    } 
    // attendance count
    public function count_atn()
    {
        $this->db->select('*');
        $this->db->from('attendance_history');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
    }
   
// Attendance log report
public function att_report($limit = null, $start = null){
        $this->db->select('*,DATE(time) as mydate');
        $this->db->from('attendance_history');
        $this->db->group_by('mydate');
        $this->db->order_by('time', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
}

// Attendance log report
public function emp_att_report($limit = null, $start = null, $employee_id){
        $this->db->select('*,DATE(time) as mydate');
        $this->db->from('attendance_history');
        $this->db->where('uid',$employee_id);
        $this->db->group_by('mydate');
        $this->db->order_by('time', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
}


// count attendance log
 public function count_att_report()
    {
        $this->db->select('*,DATE(time) as mydate');
        $this->db->from('attendance_history');
        $this->db->group_by('mydate');
        $this->db->order_by('time', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
    }

// count individual employee attendance log
 public function count_emp_att_report($employee_id)
    {
        $this->db->select('*,DATE(time) as mydate');
        $this->db->from('attendance_history');
        $this->db->where('uid',$employee_id);
        $this->db->group_by('mydate');
        $this->db->order_by('time', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
    }

// Attendance log report user wise
public function att_report_userwise($limit = null, $start = null,$id){
        $this->db->select('*,DATE(time) as mydate');
        $this->db->from('attendance_history');
        $this->db->where('uid',$id);
        $this->db->group_by('mydate');
        $this->db->order_by('time', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
    } 

// count attendance log
 public function count_atn_log($id)
    {
        $this->db->select('*,DATE(time) as mydate');
        $this->db->from('attendance_history');
        $this->db->where('uid',$id);
        $this->db->group_by('mydate');
        $this->db->order_by('time', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
    }
// attendance log datebetween search
public function att_log_datebetween($id,$from_date,$to_date){
    $att = "SELECT *, DATE(time) as mydate FROM `attendance_history` WHERE `uid`=$id AND DATE(time) BETWEEN '" . $from_date . "' AND  '" . $to_date . "' GROUP BY mydate ORDER BY time desc";
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
// User inforamtion
public function deviceuser($id){
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_id',$id);
        $ab = $this->db->get();
        return $ab->row();
}

public function userlist()
    {
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_status',1);
        $query=$this->db->get();
        $data=$query->result();
        
       $list = array('' => 'Select One...');
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->employee_id]=$value->first_name.' '.$value->last_name;
            }
        }
        return $list;
    }

    // User inforamtion
public function company_info(){
        $this->db->select('*');
        $this->db->from('setting');
        $ab = $this->db->get();
        return $ab->row();
}
//Device Ip info
    public function create_device_ip($data = [])
    {    
        return $this->db->insert('deviceinfo',$data);
    }
 public function devicinfoById($id = null)
    {
        return $this->db->select("*")
            ->from('deviceinfo')
            ->where('id',$id) 
            ->get()
            ->row();
    } 
 
    public function update_device_ip($postData = [])
    {
        return $this->db->where('id',$postData['id'])
            ->update('deviceinfo',$postData); 
    } 

   public function attendance_editdata($id){

        $this->db->where('atten_his_id',$id);
        $query = $this->db->get('attendance_history');

        $atten_his_data = $query->row();


        $dt = date("Y-m-d", strtotime($atten_his_data->time));
        $date_t = "(DATE(attendance_history.time) = '$dt')";

        $all_attn_data = $this->db->select("*")->from("attendance_history")
            ->where('attendance_history.uid',$atten_his_data->uid)
            ->where($date_t)
            ->order_by('attendance_history.time','ASC')
            ->get()
            ->result();

        $i = 1;
        foreach ($all_attn_data as $value) {
            
            if($atten_his_data->time == $value->time){
                break;
            }

            $i++;
        }

        if($i % 2 == 0){
            $atten_his_data->status = 'out';
        }else{
            $atten_his_data->status = 'in';
        }

        return $atten_his_data;
    }

     public function atten_update($postData = [])
    {
        return $this->db->where('atten_his_id',$postData['atten_his_id'])
            ->update('attendance_history',$postData); 
    } 
    

}

