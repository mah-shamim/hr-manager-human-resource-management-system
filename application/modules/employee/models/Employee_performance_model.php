<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_performance_model extends CI_Model {

	public function paerformance_sub_categories()
	{
		return $this->db->select('*')	
			->from('gmb_prform_sub_category')
			->get()
			->result();
	}

	// Create
	public function create_paerformance_sub_category($data = array())
	{
		return $this->db->insert('gmb_prform_sub_category', $data);
	}

	// Update
	public function update_paerformance_sub_category($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("gmb_prform_sub_category", $data);
	}

	public function paerformance_sub_category_by_id($id = null)
	{
		return $this->db->select('*')	
			->from('gmb_prform_sub_category')
			->where('id',$id)
			->get()
			->row();
	}

	public function paerformance_sub_category_delete($id = null)
	{
		$this->db->where('id',$id)
			->delete('gmb_prform_sub_category');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 


	/*Category wise performance data opertation starts*/

	public function category_wise_performances()
	{
		return $this->db->select('scp.*,emp.first_name,emp.last_name,pcp.name as perform_category_name')	
			->from('gmb_sub_cat_perform scp')
			->join('employee_history emp', 'scp.employee_id = emp.employee_id', 'left')
			->join('gmb_prform_sub_category pcp', 'scp.sub_cat_id = pcp.id', 'left')
			->get()
			->result();
	}

	public function paerform_sub_category_list()
	{
		$this->db->select('*');
        $this->db->from('gmb_prform_sub_category');
        $query = $this->db->get();
        $data = $query->result();  
        $list = array('' => 'Select One...');
       	if (!empty($data) ) {
       		foreach ($data as $value) {
       			$list[$value->id] = $value->name;
       		} 
       	}
       	return $list;
	}

	public function paerform_by_sub_category_and_empid($employee_id, $sub_cat_id)
	{
		return $this->db->select('*')	
			->from('gmb_sub_cat_perform')
			->where("YEAR(CreateDate)=".date('Y'),NULL, FALSE)
            ->where("MONTH(CreateDate)=".date('m'),NULL, FALSE)
			->where('employee_id',$employee_id)
			->where('sub_cat_id',$sub_cat_id)
			->get()
			->row();
	}

	// Create
	public function performance_by_sub_category($data = array())
	{
		return $this->db->insert('gmb_sub_cat_perform', $data);
	}

	public function category_wise_performances_by_id($id = null)
	{
		return $this->db->select('*')	
			->from('gmb_sub_cat_perform')
			->where('id',$id)
			->get()
			->row();
	}

	// Update
	public function up_category_wise_performance($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("gmb_sub_cat_perform", $data);
	}

	public function category_wise_performance_delete($id = null)
	{
		$this->db->where('id',$id)
			->delete('gmb_sub_cat_perform');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	/*Category wise performance data opertation ends*/

	public function emp_performance_appraisal_list()
	{
		return $this->db->select('empp.*, e.first_name,e.last_name')	
			->from('employee_performance empp')
			->join('employee_history e', 'empp.employee_id = e.employee_id', 'left')
			->get()
			->result();
	}

	// Create
	public function create_emp_paerformance($data = array())
	{
		$this->db->insert('employee_performance', $data);

		return $this->db->insert_id();
	}

	public function employee_performance_by_id($id = null)
	{
		return $this->db->select('*')	
			->from('employee_performance')
			->where('emp_per_id',$id)
			->get()
			->row();
	}

	public function employee_performance_criteria_values($emp_per_id,$emp_perform_type_id)
	{
		return $this->db->select('*')	
			->from('gmb_emp_perform_values')
			->where('emp_per_id',$emp_per_id)
			->where('emp_perform_type_id',$emp_perform_type_id)
			->get()
			->result();
	}

	public function delete_all_performance_criteria_values($emp_per_id){

		$this->db->where('emp_per_id',$emp_per_id)->delete('gmb_emp_perform_values');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	// Update
	public function update_emp_paerformance($data = array())
	{
		$emp_per_id = $data['emp_per_id'];
		unset($data['emp_per_id']);

		return $this->db->where('emp_per_id', $emp_per_id)
			->update("employee_performance", $data);
	}

	public function development_plans($id)
	{
		return $this->db->select('*')	
			->from('gmb_perform_development_plan')
			->where('emp_per_id',$id)
			->get()
			->result();
	}

	public function delete_all_performance_dev_plan($emp_per_id){

		$this->db->where('emp_per_id',$emp_per_id)->delete('gmb_perform_development_plan');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	public function key_goals_data($id)
	{
		return $this->db->select('*')	
			->from('gmb_perform_key_goals')
			->where('emp_per_id',$id)
			->get()
			->result();
	}

	public function delete_all_performance_key_goals($emp_per_id){

		$this->db->where('emp_per_id',$emp_per_id)->delete('gmb_perform_key_goals');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_employee_performance($emp_per_id){

		$respo_delete = $this->db->where('emp_per_id',$emp_per_id)->delete('employee_performance');

		if($this->db->affected_rows()){

			$this->db->where('emp_per_id',$emp_per_id)->delete('gmb_emp_perform_values');
			$this->db->where('emp_per_id',$emp_per_id)->delete('gmb_perform_development_plan');
			$this->db->where('emp_per_id',$emp_per_id)->delete('gmb_perform_key_goals');

			return true;
			
		}else{

			return false;
		}
	}

	public function employee_performance_for_view_by_id($employee_id = null)
	{
		return $this->db->select('emp.first_name,emp.last_name,d.department_name,p.position_name')	
			->from('employee_history emp')
			->join('department d', 'emp.dept_id = d.dept_id', 'left')
			->join('position p', 'emp.pos_id = p.pos_id', 'left')
			->where('employee_id',$employee_id)
			->get()
			->row();
	}

}