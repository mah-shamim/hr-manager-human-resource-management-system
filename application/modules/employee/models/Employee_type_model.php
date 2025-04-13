<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_type_model extends CI_Model {

	// Create
	public function create_employee_type($data = array())
	{
		return $this->db->insert('gmb_employee_types', $data);
	}

	// Update
	public function update_employee_type($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("gmb_employee_types", $data);
	}

	public function employee_types()
	{
		return $this->db->select('*')	
			->from('gmb_employee_types')
			->get()
			->result();
	}

	public function employee_type_by_id($id = null)
	{
		return $this->db->select('*')	
			->from('gmb_employee_types')
			->where('id',$id)
			->get()
			->row();
	}

	public function employee_type_delete($id = null)
	{
		$this->db->where('id',$id)
			->delete('gmb_employee_types');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

}