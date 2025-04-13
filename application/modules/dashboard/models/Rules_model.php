<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_model extends CI_Model {
 
	private $table = "gmb_setup_rules";

	/*create rule*/
	public function create($data = [])
	{	 
		$respo = $this->db->insert($this->table,$data);

		if($respo){
			return $this->db->insert_id();
		}
		return false;
		
	}
 	
 	/*Read rule*/
	public function get_rule_by_id($rule_id)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('rule_id',$rule_id)
			->where('is_deleted',0)
			->get()
			->row();
	} 

	/*get_all_rules*/
	public function get_all_rules()
	{
		return $this->db->select("*")
			->from($this->table)
			->where('is_deleted',0)
			->get()
			->result();
	} 
	
	/*update rule*/
  	public function update($data = [])
	{
		return $this->db->where('rule_id',$data['rule_id'])->where('is_deleted',0)
			->update($this->table,$data); 
	} 

	/*delete rule*/
	public function delete($data = [])
	{

		$rule_id = $data['rule_id'];
		unset($data['rule_id']);

		return $this->db->where('rule_id',$rule_id)->where('is_deleted',0)
			->update($this->table,$data); 
	}

	/*Read rule by type and rule name*/
	public function get_rule_by_type_name($type,$name)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('type',$type)
			->where('name',$name)
			->where('is_deleted',0)
			->get()
			->row();
	} 

}
