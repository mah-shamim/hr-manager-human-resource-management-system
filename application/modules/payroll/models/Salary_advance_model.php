<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salary_advance_model extends CI_Model {

	// Create
	public function insert_salary_advance($data = array())
	{
		$this->db->insert('gmb_salary_advance', $data);

		return $this->db->insert_id();
	}

	public function salary_advance_list()
	{
		return $this->db->select('sadv.*,emp.first_name,emp.last_name')	
			->from('gmb_salary_advance sadv')
			->join('employee_history emp', 'sadv.employee_id = emp.employee_id', 'left')
			->get()
			->result();
	}

	public function duplicate_salary_month_for_employee($data = array())
	{
		return $this->db->select('*')	
			->from('gmb_salary_advance')
			->where('employee_id', $data['employee_id'])
			->where('salary_month', $data['salary_month'])
			->get()
			->row();
	}

	public function salary_advance_to_be_paid($data = array())
	{
		return $this->db->select('*')	
			->from('gmb_salary_advance')
			->where('employee_id', $data['employee_id'])
			->where('paid', 0)
			->get()
			->row();
	}

	public function salary_advance_by_id($id)
	{
		return $this->db->select('*')	
			->from('gmb_salary_advance')
			->where('id', $id)
			->get()
			->row();
	}

	// Update
	public function updte_salary_advance($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("gmb_salary_advance", $data);
	}

	public function salary_advance_released_on_salary_generate($data = array())
	{
		$query = 'SELECT * FROM `gmb_salary_advance` WHERE `salary_month` = '."'".$data["salary_month"]."'".' AND `employee_id` = '.$data["employee_id"].' AND (`amount` - `release_amount`) = 0';

		return $this->db->query($query)->result();
	}

	// Update
	public function salary_advance_delete($id)
	{
		$this->db->where('id',$id)
				->delete('gmb_salary_advance');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}



}