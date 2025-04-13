<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends CI_Model {
 
    public function bank_list()
	{
		return $this->db->select('*')	
			->from('bank_information')
			->order_by('bank_name', 'asc')
			->get()
			->result();
	}
	public function create_bank($data = array())
	{
return $this->db->insert('bank_information',$data);
	}

	public function delete($id = null)
	{
		$bankname = $this->db->select('bank_name')->from('bank_information')->where('id',$id)->get()->row()->bank_name;
		$this->db->where('id',$id)
			->delete('bank_information');
		$this->db->where('HeadName',$bankname)
			->delete('acc_coa');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

    public function findById($id = null)
    { 
        return $this->db->select("*")->from("bank_information")
            ->where('id',$id) 
            ->get()
            ->row();

    } 



public function update($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("bank_information", $data);


	}

	 	public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '102010200%'");
        return $query->row();

    }
     public function create_coa($data = [])
    {
        $this->db->insert('acc_coa',$data);
        return true;
    }


    public function update_coa($data = array())
	{
		$updata = array('HeadName' => $data["HeadName"], );
		return $this->db->where('HeadName', $data["old_head"])
			->update("acc_coa", $updata);


	}

}
