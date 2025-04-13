<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_reports_model extends CI_Model {

	public function project_to_do_tasks($project_id = null){

        return $result = $this->db->select('*') 
            ->from('pm_tasks_list')
            ->where('project_id', $project_id)
            ->where('task_status', 1)
            ->get()
            ->num_rows();
    }

    public function project_in_progress_tasks($project_id = null){

        return $result = $this->db->select('*') 
            ->from('pm_tasks_list')
            ->where('project_id', $project_id)
            ->where('task_status', 2)
            ->get()
            ->num_rows();
    }

	public function project_done_tasks($project_id = null){

        return $result = $this->db->select('*') 
            ->from('pm_tasks_list')
            ->where('project_id', $project_id)
            ->where('task_status', 3)
            ->get()
            ->num_rows();
    }

    public function get_project_all_employees($project_id = null){

        $arr_result = array();

        $query=$this->db->query("SELECT DISTINCT employee_id FROM pm_tasks_list WHERE project_id=$project_id ORDER BY employee_id ASC");

        foreach ($query->result() as $row) {

            $arr_result[] = $row->employee_id;
        }

        return $arr_result;
    }

    public function get_project_all_employees_info(){

        $arr_result = array();

        $query=$this->db->query("SELECT DISTINCT employee_id FROM pm_tasks_list ORDER BY employee_id ASC");

        foreach ($query->result() as $row) {

            $arr_result[] = $row->employee_id;
        }

        return $arr_result;
    }

    public function get_project_lead_all_employees_info($project_lead = null){

        $arr_result = array();

        $query=$this->db->query("SELECT DISTINCT employee_id FROM pm_tasks_list WHERE project_lead=$project_lead ORDER BY employee_id ASC");

        foreach ($query->result() as $row) {

            $arr_result[] = $row->employee_id;
        }

        return $arr_result;
    }

    // Get all pm_tasks_list where priority is desc and must match the project_id and empployee_id
    public function employee_project_tasks_list($employee_id = null , $project_id = null)
    {
        return $result = $this->db->select('pm_tasks_list.*,e.first_name as team_mem_firstname,e.last_name as team_mem_lastname,p.project_name,ep.first_name as proj_lead_firstname,ep.last_name as proj_lead_lastname,ps.sprint_name') 
             ->from('pm_tasks_list')
             ->join('pm_projects p', 'pm_tasks_list.project_id = p.project_id', 'left')
             ->join('employee_history ep', 'pm_tasks_list.project_lead = ep.employee_id', 'left')
             ->join('employee_history e', 'pm_tasks_list.employee_id = e.employee_id', 'left')
             ->join('pm_sprints ps', 'pm_tasks_list.sprint_id = ps.sprint_id ', 'left')
             ->where('pm_tasks_list.project_id',$project_id)
             ->where('pm_tasks_list.employee_id',$employee_id)
             ->order_by('pm_tasks_list.priority','desc')
             ->order_by('pm_tasks_list.task_id','desc')
             ->get()
             ->result();
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

    public function get_employee_projects($team_member_id = null , $project_lead_id = null){

        $arr_result = array();
        $projects_info = array();

        $query=$this->db->query("SELECT DISTINCT project_id FROM pm_tasks_list WHERE project_lead=$project_lead_id AND employee_id=$team_member_id ORDER BY project_id DESC");

        foreach ($query->result() as $row) {

            $arr_result[] = $row->project_id;
            $projects_info[] = $this->project_details($row->project_id);
        }

        return $projects_info;
    }
	
}