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
     $this->db->insert('bank_information',$data);
     return $this->db->insert_id();
	}

	public function delete($id = null)
	{
		 $isDel = true;
		 $coainfo = $this->db->select('COAID')->from('bank_information')->where('id',$id)->get()->row();
		 $COAID = $coainfo->COAID;		
         $isDel = $this->check_istransation_account($COAID);
         if($isDel) {
         	$this->db->where('HeadCode',$COAID)
			->delete('acc_coa');
			if ($this->db->affected_rows()) {
				$this->db->where('id',$id)
			    ->delete('bank_information');
			   return true;
			} else {
				return false;
			}
         } else {
        	return false;
         }
	} 


    // Check if transation occur
    public function check_istransation_account($id) {
        $this->db->select('ID');
        $this->db->from('acc_transaction');
        $this->db->where('COAID',$id);       
        $rs = $this->db->get();
        if($rs->num_rows() > 0) {
           return false;
        } else {
            return true;
        }
    }



    // checking transatin then delete
	public function delete_account_bychecking_transation($id){
    $isDel = true;
    $checkTransation =  $this->accounts_model->check_istransation_account($id);
    $checkSub = $this->accounts_model->check_child_account($id);
    if($checkSub) {
      foreach($checkSub as $sub) {
        if($sub->HeadLevel ==4) {
          $chtran =  $this->accounts_model->check_istransation_account($sub->HeadCode);
         if(!$chtran) {
          $isDel = false;
         }
        } else {
          $checkSub = $this->accounts_model->check_child_account($sub->HeadCode);
          if($checkSub) {
            foreach($checkSub as $sub) {
              if($sub->HeadLevel ==4) {
                $chtran =  $this->accounts_model->check_istransation_account($sub->HeadCode);
               if(!$chtran) {
                $isDel = false;
               }
             }
           }
          }
         
        }
      }
    }
    if(!$checkTransation) {
       $isDel = false;
    }
    if($isDel) {
      $this->db->where('HeadCode', $id);
       $deldata = $this->db->delete('acc_coa');
      
       $this->db->where('pheadcode', $id);
       $deldatap = $this->db->delete('acc_coa');
    } else {
       $deldata  = false;
       $deldatap  = false;
    }
       
       if($deldata || $deldatap) {
         $info['status'] =  'success';  
       } else {
         $info['status'] =  'faild';  
       }  
    echo json_encode($info);
  }

    public function findById($id = null)
    { 
        return $this->db->select("*")->from("bank_information")
            ->where('id',$id) 
            ->get()
            ->row();

    } 



    public function update($data = array()) {
		return $this->db->where('id', $data["id"])
			->update("bank_information", $data);
	}


	public function headcode($phead){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' AND HeadType = 'A' AND pheadcode = '$phead'");
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
