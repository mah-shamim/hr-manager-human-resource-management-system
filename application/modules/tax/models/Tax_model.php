<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax_model extends CI_Model {
 
    public function viewTaxsetup()
	{
		return $this->db->select('*')	
			->from('payroll_tax_setup')
			->order_by('start_amount', 'desc')
			->get()
			->result();
	}
	public function taxsetup_create($data = array())
	{
 

$this->db->insert('payroll_tax_setup',$data);
	}

	public function taxsetup_delete($id = null)
	{
		$this->db->where('tax_setup_id',$id)
			->delete('payroll_tax_setup');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 




public function update_taxsetup($data = array())
	{
		return $this->db->where('tax_setup_id', $data["tax_setup_id"])
			->update("payroll_tax_setup", $data);


	}
	public function taxsetup_updateForm($id){
        $this->db->where('tax_setup_id',$id);
        $query = $this->db->get('payroll_tax_setup');
        return $query->row();
    }

    public function viewcollection()
	{
		return $this->db->select('*')	
			->from('payroll_tax_collection')
			->order_by('tax_coll_id', 'desc')
			->get()
			->result();
	}

	public function taxcollect_delete($id = null)
	{
		$this->db->where('tax_coll_id',$id)
			->delete('payroll_tax_collection');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 


	public function getTaxsetupList()
	{
		return $this->db->select('*')	
			->from('gmb_tax_calculation')
			->order_by('tax_sl', 'asc')
			->get()
			->result();
	}

	public function tax_setup_delete($tax_sl){

		$del_info =  $this->db->where('tax_sl',$tax_sl)
			->delete('gmb_tax_calculation');

        if($del_info){

            return true;

        }else{

            return false;

        }
    }

   public function tax_stup_data_by_slno($tax_sl = null){

        $this->db->where('tax_sl',$tax_sl);
        $query = $this->db->get('gmb_tax_calculation');
        return $query->row();

   }

   public function update_tax_stup_by_level($data=[],$tax_sl){

        $respo = $this->db->where('tax_sl', $tax_sl)
				->update("gmb_tax_calculation", $data);

        if($respo){

            return true; 
        }else{

            return false;
        }
    }

    public function save_tax_stup($data=[]){

        $respo_insert = $this->db->insert('gmb_tax_calculation',$data);

        if($respo_insert){
            return true;
         }else{
            return false;
        }
    }

}
