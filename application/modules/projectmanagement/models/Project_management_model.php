<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_management_model extends CI_Model {

    /*Getting employee who are created as supervisor*/
    public function supervisor_dropdown()
    {
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_status',1);
        $this->db->where('is_super_visor',1);
        $query = $this->db->get();
        $data = $query->result();
       
        $list = array('' => 'Select One...');
        if (!empty($data) ) {
            foreach ($data as $value) {
                $list[$value->employee_id] = $value->first_name." ".$value->last_name;
            } 
        }
        return $list;
    }

    /*Getting employee who are created as supervisor when logged in as supervisor / project_lead*/
    public function project_manager_supervisor_dropdown($employee_id = null)
    {
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_id',$employee_id);
        $this->db->where('employee_status',1);
        $this->db->where('is_super_visor',1);
        $query = $this->db->get();
        $data = $query->result();
       
        $list = array('' => 'Select One...');
        if (!empty($data) ) {
            foreach ($data as $value) {
                $list[$value->employee_id] = $value->first_name." ".$value->last_name;
            } 
        }
        return $list;
    }

    //Get projects for version creation and backlogs task transfer
    public function version_projects($employee_id = null)
    {
        $query_string = "project_lead = ".$employee_id;

        $this->db->select('*');
        $this->db->from('pm_projects');
        $this->db->where('is_completed',1);
        $this->db->where($query_string);
        $query = $this->db->get();
        $data = $query->result();
       
        $list = array('' => 'Select One...');
        if (!empty($data) ) {
            foreach ($data as $value) {
                $list[$value->project_id ] = $value->project_name;
            } 
        }
        return $list;
    }

    //Get projects for version_no
    public function version_counts($project_id = null)
    {
        $query_string = "project_id = ".$project_id." OR first_parent_project_id = ".$project_id;

         return $result = $this->db->select('*')
             ->from('pm_projects')
             ->where($query_string)
             ->get()
             ->num_rows();

    }

    /*Getting employee who are not created as supervisor*/
    public function empdropdown()
    {
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_status',1);
        $this->db->where('is_super_visor',0);
        $query = $this->db->get();
        $data = $query->result();
       
        $list = array('' => 'Select One...');
        if (!empty($data) ) {
            foreach ($data as $value) {
                $list[$value->employee_id] = $value->first_name." ".$value->last_name;
            } 
        }
        return $list;
    }

    public function departmentdrpdown()
    {
        $this->db->select('*');
        $this->db->from('department');
        $query = $this->db->get();
        $data = $query->result();
       
        $list = array('' => 'Select One...');
        if (!empty($data) ) {
            foreach ($data as $value) {
                $list[$value->dept_id ] = $value->department_name;
            } 
        }
        return $list;
    }

    /*Get all clients*/
    public function all_clients()
    {

        return $result = $this->db->select('*') 
             ->from('pm_clients')
             ->order_by('client_id','desc')
             ->get()
             ->result();
    }

    public function client_insert($data = []){

        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();
        $data['created_by'] = $user['id'];
        $data['created_at'] = date("Y-m-d h:i:s");

        return $this->db->insert('pm_clients',$data);
    }

    public function single_client_data($id){
          return $result = $this->db->select('*') 
             ->from('pm_clients')
             ->where('client_id', $id)
             ->get()
             ->row();
    } 

    public function update_client($data = [])
    {
        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();

        $client_id = $data['client_id'];
        unset($data['client_id']);
        
        $data['updated_at'] = date("Y-m-d h:i:s");
        $data['updated_by'] = $user['id'];

        return $this->db->where('client_id',$client_id)
            ->update('pm_clients',$data); 
    }

    public function client_delete($id){

        $this->db->where('client_id', $id)
            ->delete("pm_clients");

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    } 

    public function client_associated_project($client_id = null){

        return $result = $this->db->select('*') 
            ->from('pm_projects')
            ->where('client_id ', $client_id)
            ->get()
            ->result();
    }

    /*Clients End*/

    /*Projects Starts*/

    /*Get all projects*/
    public function all_projects()
    {
        return $result = $this->db->select('pm_projects.*,e.first_name,e.last_name,pmc.client_name') 
             ->from('pm_projects')
             ->join('employee_history e', 'pm_projects.project_lead = e.employee_id', 'left')
             ->join('pm_clients pmc', 'pm_projects.client_id = pmc.client_id ', 'left')
             ->order_by('pm_projects.project_id ','desc')
             ->get()
             ->result();
    }

    /*Get all projects by project_manager / project lead*/
    public function project_manager_projects($project_lead = null)
    {
        return $result = $this->db->select('pm_projects.*,e.first_name,e.last_name,pmc.client_name') 
             ->from('pm_projects')
             ->join('employee_history e', 'pm_projects.project_lead = e.employee_id', 'left')
             ->join('pm_clients pmc', 'pm_projects.client_id = pmc.client_id ', 'left')
             ->where('project_lead', $project_lead)
             ->order_by('pm_projects.project_id ','desc')
             ->get()
             ->result();
    }

    /*Getting clients for whom project will be develoed*/
    public function clientdropdown()
    {
        $this->db->select('*');
        $this->db->from('pm_clients');
        $query = $this->db->get();
        $data = $query->result();
       
        $list = array('' => 'Select One...');
        if (!empty($data) ) {
            foreach ($data as $value) {
                $list[$value->client_id] = $value->client_name;
            } 
        }
        return $list;
    }

    public function project_insert($data = []){

        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();
        $data['created_by'] = $user['id'];
        $data['created_at'] = date("Y-m-d h:i:s");

        return $this->db->insert('pm_projects',$data);
    }

    public function single_project_data($id){

        return $result = $this->db->select('*') 
            ->from('pm_projects')
            ->where('project_id', $id)
            ->get()
            ->row();
    }

    public function single_project_by_name($project_name = null){

        return $result = $this->db->select('*') 
            ->from('pm_projects')
            ->where('project_name', $project_name)
            ->get()
            ->row();
    }

    public function update_project($data = [])
    {
        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();

        $project_id  = $data['project_id'];
        unset($data['project_id']);
        
        $data['updated_at'] = date("Y-m-d h:i:s");
        $data['updated_by'] = $user['id'];

        return $this->db->where('project_id',$project_id)
            ->update('pm_projects',$data);
    }

    public function project_delete($id){

        $this->db->where('project_id', $id)
            ->delete("pm_projects");

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }


    // Get all backlogs task where is_task = 0 and must match the project_id
    public function all_backlogs($project_id = null)
    {
        return $result = $this->db->select('pm_tasks_list.*,e.first_name as team_mem_firstname,e.last_name as team_mem_lastname,p.project_name,ep.first_name as proj_lead_firstname,ep.last_name as proj_lead_lastname') 
             ->from('pm_tasks_list')
             ->join('pm_projects p', 'pm_tasks_list.project_id = p.project_id', 'left')
             ->join('employee_history ep', 'pm_tasks_list.project_lead = ep.employee_id', 'left')
             ->join('employee_history e', 'pm_tasks_list.employee_id = e.employee_id', 'left')
             ->join('pm_sprints pms', 'pm_tasks_list.sprint_id = pms.sprint_id  ', 'left')
             ->where('pm_tasks_list.project_id',$project_id)
             ->where('pm_tasks_list.is_task',0)
             ->order_by('pm_tasks_list.task_id','desc')
             ->get()
             ->result();
    }

    // Get all backlogs task where is_task = 0, priority is desc and must match the project_id
    public function all_backlogs_tasks($project_id = null)
    {
        return $result = $this->db->select('pm_tasks_list.*,e.first_name as team_mem_firstname,e.last_name as team_mem_lastname,p.project_name,ep.first_name as proj_lead_firstname,ep.last_name as proj_lead_lastname') 
             ->from('pm_tasks_list')
             ->join('pm_projects p', 'pm_tasks_list.project_id = p.project_id', 'left')
             ->join('employee_history ep', 'pm_tasks_list.project_lead = ep.employee_id', 'left')
             ->join('employee_history e', 'pm_tasks_list.employee_id = e.employee_id', 'left')
             ->where('pm_tasks_list.project_id',$project_id)
             ->where('pm_tasks_list.is_task',0)
             ->order_by('pm_tasks_list.priority','desc')
             ->order_by('pm_tasks_list.task_id','desc')
             ->get()
             ->result();
    }

    // Get all previues version project backlogs task where is_task = 0 and must match the project_id
    public function total_previous_project_backlogs($project_id = null)
    {
        return $result = $this->db->select('*') 
             ->from('pm_tasks_list')
             ->where('project_id',$project_id)
             ->where('is_task',0)
             ->get()
             ->num_rows();
    }

    /*Get sprint*/
    public function get_sprints($project_id = null)
    {
        $result = $this->db->select('*') 
             ->from('pm_sprints')
             ->where('project_id',$project_id)
             ->where('is_finished',0)
             ->get()
             ->result();

        $list = array('' => 'Select One...');
        if (!empty($result) ) {
            foreach ($result as $value) {
                $list[$value->sprint_id ] = $value->sprint_name;
            } 
        }
        return $list;
    } 

    public function task_insert($data = []){

        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();
        $data['created_by'] = $user['id'];
        $data['created_at'] = date("Y-m-d h:i:s");

        return $this->db->insert('pm_tasks_list',$data);
    }

    public function all_sprints($project_id)
    {
        return $result = $this->db->select('pm_sprints.*,p.project_name') 
             ->from('pm_sprints')
             ->join('pm_projects p', 'pm_sprints.project_id = p.project_id', 'left')
             ->where('pm_sprints.project_id',$project_id)
             ->order_by('pm_sprints.sprint_id','desc')
             ->get()
             ->result();
    }

    public function project_sprints_count($project_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_sprints')
             ->where('project_id',$project_id)
             ->get()
             ->num_rows();
    }

    public function duplicate_sprint_check($project_id = null , $sprint_name = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_sprints')
             ->where('project_id',$project_id)
             ->where('sprint_name',$sprint_name)
             ->get()
             ->row();
    }

    // Check sprint, when transferring tasks from sprint to backlogs
    public function sprint_check($project_id = null , $sprint_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_sprints')
             ->where('project_id',$project_id)
             ->where('sprint_id',$sprint_id)
             ->where('is_finished',0)
             ->get()
             ->row();
    }

    // Check available sprint for project, to insert start date to the project table by project_id...
    public function sprint_nums($project_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_sprints')
             ->where('project_id',$project_id)
             ->get()
             ->num_rows();
    }

    // Check first_sprint_by_project, to update start date of the project...
    public function first_sprint_by_project($project_id = null)
    {
        return $result = $this->db->select('MIN(sprint_id ) as first_sprint_id')
             ->from('pm_sprints')
             ->where('project_id',$project_id)
             ->get()
             ->row();
    }

    // Insert start_date to the project table by project_id...
    public function update_project_start_date($data = [])
    {
        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();

        $project_id  = $data['project_id'];
        unset($data['project_id']);
        
        $data['updated_at'] = date("Y-m-d h:i:s");
        $data['updated_by'] = $user['id'];

        return $this->db->where('project_id',$project_id)
            ->update('pm_projects',$data);
    }

    // Check if running sprint still not finished..
    public function sprint_not_finished($project_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_sprints')
             ->where('project_id',$project_id)
             ->where('is_finished',0)
             ->get()
             ->row();
    }

    public function days_spend_for_sprint($project_id = null)
    {
        $total_days = 0;

        $result = $this->db->select('*')
             ->from('pm_sprints')
             ->where('project_id',$project_id)
             ->where('is_finished',1)
             ->get()
             ->result();
             
        foreach ($result as $value) {

            $total_days = $total_days + (int)$value->duration;
        }
        return $total_days;
    }

    public function verify_project($project_id = null , $project_lead = null)
    {
        $result = $this->db->select('*') 
             ->from('pm_projects')
             ->where('project_id',$project_id)
             ->where('project_lead',$project_lead)
             ->get()
             ->row();

        return $result;
    }

    public function sprint_insert($data = []){

        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();
        $data['created_by'] = $user['id'];
        $data['created_at'] = date("Y-m-d h:i:s");

        return $this->db->insert('pm_sprints',$data);
    }

    public function single_sprint_data($id){

        return $result = $this->db->select('*') 
            ->from('pm_sprints')
            ->where('sprint_id', $id)
            ->get()
            ->row();
    }

    public function update_sprint($data = [])
    {
        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();

        $sprint_id  = $data['sprint_id'];
        unset($data['sprint_id']);
        
        // If sprint is closed then save the close date for the sprint..
        if($data['is_finished']){
            $data['close_date'] = date("Y-m-d");
        }

        $data['updated_at'] = date("Y-m-d h:i:s");
        $data['updated_by'] = $user['id'];

        return $this->db->where('sprint_id',$sprint_id)
            ->update('pm_sprints',$data);
    }

    public function sprint_asscociate_task($sprint_data){

        return $result = $this->db->select('*') 
            ->from('pm_tasks_list')
            ->where('sprint_id', $sprint_data->sprint_id)
            ->where('project_id', $sprint_data->project_id)
            ->get()
            ->num_rows();
    }

    public function sprint_delete($id){

        $this->db->where('sprint_id', $id)
            ->delete("pm_sprints");

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function single_backlog_task_data($id){

        return $result = $this->db->select('*') 
            ->from('pm_tasks_list')
            ->where('task_id', $id)
            ->get()
            ->row();
    }

    public function valid_backlog_task($task_id = null , $project_id = null){

        return $result = $this->db->select('*') 
            ->from('pm_tasks_list')
            ->where('task_id', $task_id)
            ->where('project_id', $project_id)
            ->where('is_task', 0)
            ->get()
            ->row();
    }

    public function valid_task_check($task_id = null , $project_id = null){

        return $result = $this->db->select('*') 
            ->from('pm_tasks_list')
            ->where('task_id', $task_id)
            ->where('project_id', $project_id)
            ->get()
            ->row();
    }

    public function valid_employee_task_check($task_id = null , $project_id = null, $employee_id = null){

        return $result = $this->db->select('*') 
            ->from('pm_tasks_list')
            ->where('task_id', $task_id)
            ->where('project_id', $project_id)
            ->where('employee_id', $employee_id)
            ->get()
            ->row();
    }

    public function update_backlog_task($data = [])
    {
        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();

        $task_id  = $data['task_id'];
        unset($data['task_id']);
        
        $data['updated_at'] = date("Y-m-d h:i:s");
        $data['updated_by'] = $user['id'];

        return $this->db->where('task_id',$task_id)
            ->update('pm_tasks_list',$data);
    }

    public function backlog_task_delete($id){

        $this->db->where('task_id', $id)
            ->where('is_task', 0)
            ->delete("pm_tasks_list");

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    // When transferring from backlogs.. backlog tasks will be updated as only tasks along with selected sprint_id and will vanish from backlog
    public function update_task_from_backlogs($data = [])
    {
        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();

        $task_id  = $data['task_id'];
        unset($data['task_id']);
        
        $data['updated_at'] = date("Y-m-d h:i:s");
        $data['updated_by'] = $user['id'];

        return $this->db->where('task_id',$task_id)
            ->update('pm_tasks_list',$data);
    }

    // employee info
    public function employee_info($employee_id){
        return $result = $this->db->select('first_name,last_name,employee_id,email')->from('employee_history')->where('employee_id',$employee_id)->get()->row();
    }
    
    // user info
    public function user_details($email){
        return $result = $this->db->select('firstname,lastname,id,email')->from('user')->where('email',$email)->get()->row();
    }

    // Get all tasks for the sprint where task_status = 1 means it's not 'In Progress' or 'Done'.
    public function all_sprints_tasks($sprint_id = null, $project_id = null)
    {
        return $result = $this->db->select('pm_tasks_list.*,e.first_name as team_mem_firstname,e.last_name as team_mem_lastname,p.project_name,pms.sprint_name,ep.first_name as proj_lead_firstname,ep.last_name as proj_lead_lastname') 
             ->from('pm_tasks_list')
             ->join('pm_projects p', 'pm_tasks_list.project_id = p.project_id', 'left')
             ->join('employee_history ep', 'pm_tasks_list.project_lead = ep.employee_id', 'left')
             ->join('employee_history e', 'pm_tasks_list.employee_id = e.employee_id', 'left')
             ->join('pm_sprints pms', 'pm_tasks_list.sprint_id = pms.sprint_id', 'left')
             ->where('pm_tasks_list.project_id',$project_id)
             ->where('pm_tasks_list.sprint_id',$sprint_id)
             ->where('pm_tasks_list.task_status',1)
             ->where('pm_tasks_list.is_task',1)
             ->order_by('pm_tasks_list.priority','desc')
             ->order_by('pm_tasks_list.task_id','desc')
             ->get()
             ->result();
    }

    // Check sprint, when transferring tasks from sprint to backlogs
    public function sprint_task_check($project_id = null , $sprint_id = null ,$task_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_tasks_list')
             ->where('project_id',$project_id)
             ->where('sprint_id',$sprint_id)
             ->where('task_id',$task_id)
             ->get()
             ->row();
    }

    // When transferring from backlogs.. backlog tasks will be updated as only tasks along with selected sprint_id and will vanish from backlog
    public function update_task_from_sprints($data = [])
    {
        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();

        $task_id  = $data['task_id'];
        unset($data['task_id']);
        
        $data['updated_at'] = date("Y-m-d h:i:s");
        $data['updated_by'] = $user['id'];

        return $this->db->where('task_id',$task_id)
            ->update('pm_tasks_list',$data);
    }

    // Check finished_sprint_tasks in pm_tasks_list table where task_status = 3 , when transferring tasks from sprint to backlogs
    public function finished_sprint_tasks($project_id = null , $sprint_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_tasks_list')
             ->where('project_id',$project_id)
             ->where('sprint_id',$sprint_id)
             ->where('pm_tasks_list.task_status',3)
             ->get()
             ->num_rows();
    }

    // Check total sprint tasks in pm_tasks_list table, when transferring tasks from sprint to backlogs
    public function total_sprint_tasks($project_id = null , $sprint_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_tasks_list')
             ->where('project_id',$project_id)
             ->where('sprint_id',$sprint_id)
             ->get()
             ->num_rows();
    }

    // If returns true means, close/open dropdown will show when updating any sprint.. to close the sprint.
    public function sprint_close_open($project_id = null , $sprint_id = null){

        $total_tasks = 0;
        $open_tasks = 0;
        $closed_tasks = 0;
        $status = false;

        $total_tasks = $this->db->select('*')->from('pm_tasks_list')
             ->where('project_id',$project_id)
             ->where('sprint_id',$sprint_id)
             ->get()
             ->num_rows();

        if($total_tasks > 0){

            $open_tasks = $this->db->select('*')->from('pm_tasks_list')
                 ->where('project_id',$project_id)
                 ->where('sprint_id',$sprint_id)
                 ->where('task_status !=',3)
                 ->get()
                 ->num_rows();

            $closed_tasks = $this->db->select('*')->from('pm_tasks_list')
                 ->where('project_id',$project_id)
                 ->where('sprint_id',$sprint_id)
                 ->where('task_status',3)
                 ->get()
                 ->num_rows();

            if($open_tasks < $closed_tasks){
                $status = true;
            }
        }

        return $status;

        
    }

    public function employee_projects($team_member_id){

        $arr_result = array();
        $projects_info = array();

        $query=$this->db->query("SELECT DISTINCT project_id FROM pm_tasks_list WHERE employee_id=$team_member_id ORDER BY project_id DESC");

        foreach ($query->result() as $row) {

            $arr_result[] = $row->project_id;
            $projects_info[] = $this->project_details($row->project_id);
        }

        return $projects_info;
    }

    public function project_details($project_id = null)
    {
        return $result = $this->db->select('pm_projects.*,e.first_name,e.last_name,pmc.client_name') 
             ->from('pm_projects')
             ->join('employee_history e', 'pm_projects.project_lead = e.employee_id', 'left')
             ->join('pm_clients pmc', 'pm_projects.client_id = pmc.client_id ', 'left')
             ->where('pm_projects.project_id', $project_id)
             ->get()
             ->row();
    }

    // Duplicate of above function, if required then can use later
    public function employee_projects_duplicate($user_id){

        $this->db->select('project_id');
        $this->db->distinct();
        $this->db->where('employee_id',$user_id);
        $query = $this->db->get('pm_tasks_list');
        return $query->result();
    }

    public function projects_lead_projects($projects_lead_id = null)
    {
        return $result = $this->db->select('pm_projects.*,e.first_name,e.last_name,pmc.client_name') 
             ->from('pm_projects')
             ->join('employee_history e', 'pm_projects.project_lead = e.employee_id', 'left')
             ->join('pm_clients pmc', 'pm_projects.client_id = pmc.client_id ', 'left')
             ->where('pm_projects.project_lead', $projects_lead_id)
             ->get()
             ->result();
    }

    public function sprint_tasks($sprint_id)
    {
        return $result = $this->db->select('pm_tasks_list.*,e.first_name,e.last_name,epid.first_name as ep_firstname,epid.last_name as ep_lastname,p.project_name,pms.sprint_name') 
             ->from('pm_tasks_list')
             ->join('pm_projects p', 'pm_tasks_list.project_id = p.project_id', 'left')
             ->join('pm_sprints pms', 'pm_tasks_list.sprint_id = pms.sprint_id', 'left')
             ->join('employee_history e', 'pm_tasks_list.project_lead = e.employee_id', 'left')
             ->join('employee_history epid', 'pm_tasks_list.employee_id = epid.employee_id', 'left')
             ->where('pm_tasks_list.sprint_id',$sprint_id)
             ->order_by('pm_tasks_list.task_id','desc')
             ->get()
             ->result();
    }

    public function project_tasks($project_id)
    {
        return $result = $this->db->select('pm_tasks_list.*,e.first_name,e.last_name,epid.first_name as ep_firstname,epid.last_name as ep_lastname,p.project_name,pms.sprint_name,pms.is_finished as sprint_status,u.firstname,u.lastname') 
             ->from('pm_tasks_list')
             ->join('pm_projects p', 'pm_tasks_list.project_id = p.project_id', 'left')
             ->join('pm_sprints pms', 'pm_tasks_list.sprint_id = pms.sprint_id', 'left')
             ->join('employee_history e', 'pm_tasks_list.project_lead = e.employee_id', 'left')
             ->join('employee_history epid', 'pm_tasks_list.employee_id = epid.employee_id', 'left')
             ->join('user u', 'pm_tasks_list.created_by = u.id', 'left')
             ->where('pm_tasks_list.project_id',$project_id)
             ->order_by('pm_tasks_list.task_id','desc')
             ->get()
             ->result();
    }

    public function project_lead_check($project_id = null, $project_lead_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_projects')
             ->where('project_id', $project_id)
             ->where('project_lead', $project_lead_id)
             ->get()
             ->row();
    }

    public function project_employee_check($project_id = null, $employee_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_tasks_list')
             ->where('project_id', $project_id)
             ->where('employee_id', $employee_id)
             ->get()
             ->num_rows();
    }

    public function project_task_check($task_id = null, $project_lead_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_tasks_list')
             ->where('task_id', $task_id)
             ->where('project_lead', $project_lead_id)
             ->get()
             ->row();
    }

    public function employee_task_check($task_id = null, $employee_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_tasks_list')
             ->where('task_id', $task_id)
             ->where('employee_id', $employee_id)
             ->get()
             ->row();
    }

    // Check sprint, when transferring tasks from sprint to backlogs
    public function sprint_check_by_project($project_id = null , $sprint_id = null)
    {
        return $result = $this->db->select('*')
             ->from('pm_sprints')
             ->where('project_id',$project_id)
             ->where('sprint_id',$sprint_id)
             ->get()
             ->row();
    }

    // update_task_from_pm_kanban board
    public function update_task_from_kanban($task_id = null , $task_status = null)
    {
        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();
        
        $data['updated_at'] = date("Y-m-d h:i:s");
        $data['updated_by'] = $user['id'];
        $data['task_status'] = $task_status;

        return $this->db->where('task_id',$task_id)
            ->update('pm_tasks_list',$data);
    }

    // update_task_from_pm_kanban board
    public function task_details($task_id = null)
    {

        return $result = $this->db->select('*')
         ->from('pm_tasks_list')
         ->where('task_id',$task_id)
         ->get()
         ->row();
    }

    // update_task_from_pm_kanban board
    public function tasks_completed_by_project($project_id = null)
    {

        return $result = $this->db->select('*')
         ->from('pm_tasks_list')
         ->where('project_id',$project_id)
         ->where('task_status',3)
         ->get()
         ->num_rows();
    }

    // update_task_from_pm_kanban board
    public function all_tasks_by_project($project_id = null)
    {

        return $result = $this->db->select('*')
         ->from('pm_tasks_list')
         ->where('project_id',$project_id)
         ->get()
         ->num_rows();
    }

    public function valid_sprint_check($sprint_id = null){

        return $result = $this->db->select('*') 
            ->from('pm_sprints')
            ->where('sprint_id', $sprint_id)
            ->where('is_finished', 1)
            ->get()
            ->row();
    }

    public function project_task_check_by_employee($project_id = null, $employee_id = null)
    {
        return $result = $this->db->select('*')
         ->from('pm_tasks_list')
         ->where('project_id',$project_id)
         ->where('employee_id',$employee_id)
         ->get()
         ->num_rows();
    }

    public function employee_project_tasks($project_id = null, $employee_id = null)
    {
        return $result = $this->db->select('pm_tasks_list.*,e.first_name,e.last_name,epid.first_name as ep_firstname,epid.last_name as ep_lastname,p.project_name,pms.sprint_name,pms.is_finished as sprint_status') 
             ->from('pm_tasks_list')
             ->join('pm_projects p', 'pm_tasks_list.project_id = p.project_id', 'left')
             ->join('pm_sprints pms', 'pm_tasks_list.sprint_id = pms.sprint_id', 'left')
             ->join('employee_history e', 'pm_tasks_list.project_lead = e.employee_id', 'left')
             ->join('employee_history epid', 'pm_tasks_list.employee_id = epid.employee_id', 'left')
             ->where('pm_tasks_list.project_id',$project_id)
             ->where('pm_tasks_list.employee_id',$employee_id)
             ->where('pm_tasks_list.sprint_id >',0)
             ->order_by('pm_tasks_list.task_id','desc')
             ->get()
             ->result();
    }

    public function sprint_tasks_by_employee($project_id = null, $employee_id = null, $sprint_id = null)
    {
        return $result = $this->db->select('pm_tasks_list.*,e.first_name,e.last_name,epid.first_name as ep_firstname,epid.last_name as ep_lastname,p.project_name,pms.sprint_name,pms.is_finished as sprint_status') 
             ->from('pm_tasks_list')
             ->join('pm_projects p', 'pm_tasks_list.project_id = p.project_id', 'left')
             ->join('pm_sprints pms', 'pm_tasks_list.sprint_id = pms.sprint_id', 'left')
             ->join('employee_history e', 'pm_tasks_list.project_lead = e.employee_id', 'left')
             ->join('employee_history epid', 'pm_tasks_list.employee_id = epid.employee_id', 'left')
             ->where('pm_tasks_list.project_id',$project_id)
             ->where('pm_tasks_list.employee_id',$employee_id)
             ->where('pm_tasks_list.sprint_id',$sprint_id)
             ->order_by('pm_tasks_list.task_id','desc')
             ->get()
             ->result();
    }

    public function sprint_all_tasks($project_id = null, $sprint_id = null)
    {
        return $result = $this->db->select('pm_tasks_list.*,e.first_name,e.last_name,epid.first_name as ep_firstname,epid.last_name as ep_lastname,p.project_name,pms.sprint_name,pms.is_finished as sprint_status') 
             ->from('pm_tasks_list')
             ->join('pm_projects p', 'pm_tasks_list.project_id = p.project_id', 'left')
             ->join('pm_sprints pms', 'pm_tasks_list.sprint_id = pms.sprint_id', 'left')
             ->join('employee_history e', 'pm_tasks_list.project_lead = e.employee_id', 'left')
             ->join('employee_history epid', 'pm_tasks_list.employee_id = epid.employee_id', 'left')
             ->where('pm_tasks_list.project_id',$project_id)
             ->where('pm_tasks_list.sprint_id',$sprint_id)
             ->order_by('pm_tasks_list.task_id','desc')
             ->get()
             ->result();
    }

    public function sprint_to_do_tasks($project_id = null , $sprint_id = null){

        return $result = $this->db->select('*') 
            ->from('pm_tasks_list')
            ->where('sprint_id', $sprint_id)
            ->where('project_id', $project_id)
            ->where('task_status', 1)
            ->get()
            ->num_rows();
    }

    public function sprint_in_progress_tasks($project_id = null , $sprint_id = null){

        return $result = $this->db->select('*') 
            ->from('pm_tasks_list')
            ->where('sprint_id', $sprint_id)
            ->where('project_id', $project_id)
            ->where('task_status', 2)
            ->get()
            ->num_rows();
    }

    public function sprint_done_tasks($project_id = null , $sprint_id = null){

        return $result = $this->db->select('*') 
            ->from('pm_tasks_list')
            ->where('sprint_id', $sprint_id)
            ->where('project_id', $project_id)
            ->where('task_status', 3)
            ->get()
            ->num_rows();
    }

    public function sprint_undone_tasks($project_id = null , $sprint_id = null){

        $query_string = "task_status < 3 AND task_status > 0";

        return $result = $this->db->select('task_id') 
            ->from('pm_tasks_list')
            ->where('sprint_id', $sprint_id)
            ->where('project_id', $project_id)
            ->where($query_string)
            ->get()
            ->result();
    }

    //Total tasks for an individual project .. elminating backlogs tasks
    public function project_associated_tasks($project_id = null){

        return $result = $this->db->select('*')
            ->from('pm_tasks_list')
            ->where('project_id',$project_id)
            ->where('is_task', 1)
            ->get()
            ->num_rows();
 
    }

    // Get all backlogs task where is_task = 0, priority is desc and must match the project_id
    public function previous_project_backlogs($project_id = null)
    {
        return $result = $this->db->select('pm_tasks_list.*,e.first_name as team_mem_firstname,e.last_name as team_mem_lastname,p.project_name,ep.first_name as proj_lead_firstname,ep.last_name as proj_lead_lastname') 
             ->from('pm_tasks_list')
             ->join('pm_projects p', 'pm_tasks_list.project_id = p.project_id', 'left')
             ->join('employee_history ep', 'pm_tasks_list.project_lead = ep.employee_id', 'left')
             ->join('employee_history e', 'pm_tasks_list.employee_id = e.employee_id', 'left')
             ->where('pm_tasks_list.project_id',$project_id)
             ->where('pm_tasks_list.is_task',0)
             ->order_by('pm_tasks_list.priority','desc')
             ->order_by('pm_tasks_list.task_id','desc')
             ->get()
             ->result();
    }
    
    //Check employee/team_member tasks for project_management
    public function employee_tasks($employee_id = null)
    {
        return $result = $this->db->select('*')
         ->from('pm_tasks_list')
         ->where('employee_id',$employee_id)
         ->get()
         ->num_rows();
    }

    //Check employee/team_member tasks for project_management
    public function supervisor_projects($employee_id = null)
    {
        return $result = $this->db->select('*')
         ->from('pm_projects')
         ->where('project_lead',$employee_id)
         ->get()
         ->num_rows();
    }

    /*Getting employee/team_members who will be assignes to this project*/
    public function team_members()
    {
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_status',1);
        $this->db->where('is_super_visor',0);
        $query = $this->db->get();
        $data = $query->result();
        
        $i = 0;
        $emp_arr = array();

        if (!empty($data) ) {
            foreach ($data as $value) {

                $list['employee_id']    = $value->employee_id;
                $list['employee_name']  = $value->first_name." ".$value->last_name;

                $emp_arr[ $i] = $list;

                $i++;
            } 
        }
        return $emp_arr;
    }

    public function team_members_insert($data = [] , $project_id = null){

        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $status = false;

        $this->db->where('project_id', $project_id)
            ->delete("pm_employee_projects");

        foreach ($data as  $employee_id) {

            $insert_data['created_at'] = date("Y-m-d h:i:s");
            $insert_data['updated_at'] = date("Y-m-d h:i:s");

            $insert_data['project_id'] = $project_id;
            $insert_data['employee_id'] = $employee_id;

            if($this->db->insert('pm_employee_projects',$insert_data)){

                $status = true;
            }
        }
    }

    public function existing_team_members($project_id = null)
    {
        $this->db->select('*');
        $this->db->from('pm_employee_projects');
        $this->db->where('project_id',$project_id);
        $query = $this->db->get();
        $data = $query->result();
        
        $emp_arr = array();

        if (!empty($data) ) {
            foreach ($data as $value) {

                $emp_arr[] = $value->employee_id;
            } 
        }
        return $emp_arr;
    }

    public function clientinfo($client_id = null)
    {
        $this->db->select('*');
        $this->db->from('pm_clients');
        $this->db->where('client_id ',$client_id);
        $query = $this->db->get();
        $data = $query->row();
       
        return $data;
    }

    /*Getting employee who are not created as supervisor*/
    public function assigned_empdropdown($project_id)
    {
        $team_members = $this->existing_team_members($project_id);
       
        $list = array('' => 'Select One...');
        if (!empty($team_members) ) {

            foreach ($team_members as $value) {

                $this->db->select('employee_id,first_name,last_name');
                $this->db->from('employee_history');
                $this->db->where('employee_id',$value);
                $this->db->where('employee_status',1);
                $this->db->where('is_super_visor',0);
                $query = $this->db->get();
                $data = $query->row();

                if($data){
                    
                    $list[$data->employee_id] = $data->first_name." ".$data->last_name;
                }
            }
        }
        return $list;
    }

    public function assigned_project_employee_check($project_id = null, $employee_id = null)
    {
        return $result = $this->db->select('*')
         ->from('pm_employee_projects')
         ->where('project_id',$project_id)
         ->where('employee_id',$employee_id)
         ->get()
         ->num_rows();
    }

    //Total tasks alonfg with backlogs for an individual project
    public function project_all_backlogs_tasks($project_id = null){

        return $result = $this->db->select('*')
            ->from('pm_tasks_list')
            ->where('project_id',$project_id)
            ->get()
            ->num_rows();
 
    }

    // all_project_employees along with project_lead to share reward point for the project...
    public function project_all_employees($project_id){

        $this->db->select('employee_id');
        $this->db->distinct();
        $this->db->where('project_id',$project_id);
        $query = $this->db->get('pm_tasks_list');

        $all_employees = $query->result();
        $emp_arr = array();

        foreach ($all_employees as $employee) {
            
            $emp_arr[] = $employee->employee_id;
        }

        $project_info = $this->single_project_data($project_id);

        array_push($emp_arr,$project_info->project_lead);

        return $emp_arr;
    }

    public function share_reward_to_employees($project_id , $project_all_employees = []){

        $user = $this->session->userdata();
        $created_by = $user['id'];
        $create_date = date("Y-m-d h:i:sa");

        $project_info = $this->single_project_data($project_id);

        foreach ($project_all_employees as $employee) {
            
            $point_mamanagement_data['employee_id'] = $employee;
            $point_mamanagement_data['point_category'] = 1;
            $point_mamanagement_data['description'] = "Reward points for the project completion of ".$project_info->project_name;
            $point_mamanagement_data['point'] = $project_info->project_reward_point;
            $point_mamanagement_data['create_date'] = $create_date;
            $point_mamanagement_data['created_by'] = $created_by;

            if($this->add_management_point_to_reward($point_mamanagement_data)){

                $this->db->insert('point_management', $point_mamanagement_data);
            } 
        }
    }

    /*Insert management point to employee point_reward database table*/
    private function add_management_point_to_reward($data = array())
    {
        $user = $this->session->userdata();

        $dt = new DateTime($data['create_date']);
        $date = $dt->format('Y-m-d');
        $date_y = $dt->format('Y');
        $date_m = $dt->format('m');
        $time = $dt->format('H:i:s');
        $data['date'] = $date;

        $point_reward_rec = $this->db->select("*")->from("point_reward")
            ->where('employee_id',$data['employee_id'])
            ->where("YEAR(date)=".$date_y,NULL, FALSE)
            ->where("MONTH(date)=".$date_m,NULL, FALSE)
            ->get()
            ->row();

        if($point_reward_rec && $point_reward_rec->id != null){

            // Adding management point with existing management reward point, if employee already exists in point_reward table..
            $management_point = (int)$point_reward_rec->management + (int)$data['point'];
            $total = (int)$point_reward_rec->attendence + (int)$point_reward_rec->collaborative + $management_point;
            $point_reward_data['management'] = $management_point;
            $point_reward_data['total'] = $total;

            $update_reward_point = $this->db->where('id', $point_reward_rec->id)
            ->update("point_reward", $point_reward_data);

            if($update_reward_point){
                return true;
            }else{
                return false;
            }

        }else{

            // Inserting management point, if employee not exists in point_reward table..
            $point_reward_insert['date'] = date("Y-m-d");
            $point_reward_insert['management'] = $data['point'];
            $point_reward_insert['total'] = $data['point'];
            $point_reward_insert['employee_id'] = $data['employee_id'];

            $insert_reward_point = $this->db->insert('point_reward', $point_reward_insert);

            if($insert_reward_point){
                return true;
            }else{
                return false;
            }
        }

    }


    public function activity_log_insert($description = ""){

        // Getting timezone
        $timezone = $this->db->select('timezone')->from('setting')->get()->row();
        date_default_timezone_set($timezone->timezone);

        $user = $this->session->userdata();
        $data['description'] = $description;
        $data['user_id'] = $user['id'];
        $data['date_time'] = date("Y-m-d h:i:s");

        return $this->db->insert('pm_activity_logs',$data);
    }

}

