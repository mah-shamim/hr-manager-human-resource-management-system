<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_model extends CI_Model {


    public function read($select_items, $table, $where_array)
    {
        $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
        }
        return $this->db->get()->row();
    }

     function get_accountList()
    {
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('IsActive',1);
        $this->db->order_by('HeadName');
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_userlist()
      {
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('IsActive',1);
        $this->db->order_by('HeadName');
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function paytype(){
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('isBankNature', 1); 
        $this->db->or_where('isCashNature', 1);
        $this->db->order_by('HeadName','asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function dfs($HeadName,$HeadCode,$oResult,$visit,$d) {
        if($d==0) echo "<li class=\"jstree-open \" id='" . $HeadCode . "'>$HeadName";
        else if($d==1) echo "<li class=\"jstree-open\"  id='" . $HeadCode . "'><a href='javascript:' onclick=\"loadData('".$HeadCode."')\">$HeadName</a>";
        else echo "<li id='" . $HeadCode . "'><a href='javascript:' onclick=\"loadData( this.id,'".$HeadCode."')\">$HeadName</a>";
        $p=0;       
        for($i=1;$i<= count($oResult);$i++)
        {
            if (!$visit[$i])
            {
                if ($HeadCode==$oResult[$i]->pheadcode)
                {
                    $visit[$i]=true;
                    if($p==0) echo "<ul>";
                    $p++;                   
                    $this->dfs($oResult[$i]->HeadName,$oResult[$i]->HeadCode,$oResult,$visit,$d+1);
                }
            }
        }
        if($p==0)
            echo "</li>";
        else
            echo "</ul>";
    }


public function dfs_4($HeadName,$HeadCode,$oResult,$visit,$d)
    {

        $sbalance = 0;
        $sopening = 0;
        $balance  = ($sbalance ? number_format($sbalance, 2) : number_format(0, 2));
        $opening  = ($sopening ? number_format($sopening, 2) : number_format(0, 2));

        if ($d == 0) echo "<li class=\"jstree-open\" >$HeadName <a href=/'javascript:void(0)/' class=\"form-control headanchor\"><span class=\"coa_hd\"><b>Head Name</b></span><span class=\"bal_opening\"><b></b></span><span class=\"bal_span\"><b> </b></span></a>";
        else if ($d == 1) echo "<li class=\"jstree-open\" id='" . $HeadCode . "'><a href='javascript:' class='form-control jstreelip' onclick=\"loadData('" . $HeadCode . "')\">$HeadName <span class=\"bal_opening\"> </span><span class=\"bal_span_pre\"></span></a>";
        else echo "<li id='" . $HeadCode . "'><a href='javascript:' class='form-control'  onclick=\"loadData('" . $HeadCode . "')\">$HeadName <span class=\"bal_opening\"> </span> <span class=\"bal_span_pre\"></span></a>";
        $p=0;
        for($i=1;$i< count($oResult);$i++)
        {

            if (!$visit[$i])
            {
                if ($HeadCode==$oResult[$i]->PHeadCode)
                {
                    $visit[$i]=true;
                    if($p==0) echo "<ul>";
                    $p++;
                    $this->dfs($oResult[$i]->HeadName,$oResult[$i]->HeadCode,$oResult,$visit,$d+1);
                }
            }
        }
        if($p==0)
            echo "</li>";
        else
            echo "</ul>";
    }


 public function AssetLiabilities()
    {
      return  $data = $this->db->select("*")
            ->from('acc_coa')
            ->where('HeadLevel', 4)  
            ->where('IsActive', 1)
            ->where_in('HeadType', array('A','L'))            
            ->order_by('HeadType')
            ->get()
            ->result();
    }


// Accounts list
    public function Transacc()
    {
      return  $data = $this->db->select("*")
            ->from('acc_coa')
            ->where('IsTransaction', 1)  
            ->where('IsActive', 1) 
            ->order_by('HeadName')
            ->get()
            ->result();
    }

// Accounts list
    public function getTransationHead()
    {
      return  $data = $this->db->select("*")
            ->from('acc_coa')
            ->where('isBankNature', 0)  
            ->where('isCashNature', 0)  
            ->where('HeadLevel', 4)  
            ->where('IsActive', 1) 
            ->order_by('HeadName')
            ->get()
            ->result();
    }

// Accounts list
    public function getCashbankHead( )
    {
      return  $data = $this->db->select("*")
            ->from('acc_coa')            
            ->where('HeadLevel', 4)  
            ->where('IsActive', 1) 
            ->where('isBankNature', 1)  
            ->or_where('isCashNature', 1)  
            ->order_by('HeadName')
            ->get()
            ->result();
    }

// get subcode by subtype
  public function getSubcode($id){          
       $subcodes = $this->db->select('*')
                  ->from('acc_subcode')
                  ->where('subTypeId',$id)
                  ->get(); 
                  if($subcodes->num_rows() > 0) {
                    return $subcodes->result();
                  }
        return false;
   }

// count debit voucher
    public function count_voucher($type)
    {
        $data = $this->db->select("id")
            ->from('acc_transaction')  
            ->where('Vtype', $type)  
            ->group_by('VNo')                  
            ->order_by('id', 'DESC')            
            ->get();
        if ($data->num_rows() > 0) {
            return $data->num_rows();    
        }
        return 0;
    }


 // get debit voucher
    public function get_voucher($type = null)
    {
      $data = $this->db->select("av.*, fy.yearName , ac.HeadName, st.subtypeName, sc.name, rc.HeadName as reverseHead")
            ->from('acc_vaucher av') 
            ->join('financial_year fy','av.fyear = fy.id', 'left')
            ->join('acc_coa ac','av.COAID = ac.HeadCode', 'left')  
            ->join('acc_coa rc','av.RevCodde = rc.HeadCode', 'left')         
            ->join('acc_subtype st','av.subType = st.id', 'left') 
            ->join('acc_subcode sc', 'av.subCode = sc.id', 'left')  
            ->where('Vtype', $type)       
            ->order_by('av.id', 'DESC')
            ->get();          
        if ($data->num_rows() > 0) {
            return $data->result();    
        }
        return false;
    }
 // get voucher
    public function get_voucher_byDate($start, $end, $status=0)
    {
      $data = $this->db->select("av.*, fy.yearName , ac.HeadName, st.subtypeName, sc.name, rc.HeadName as reverseHead")
            ->from('acc_vaucher av') 
            ->join('financial_year fy','av.fyear = fy.id', 'left')
            ->join('acc_coa ac','av.COAID = ac.HeadCode', 'left')  
            ->join('acc_coa rc','av.RevCodde = rc.HeadCode', 'left')         
            ->join('acc_subtype st','av.subType = st.id', 'left') 
            ->join('acc_subcode sc', 'av.subCode = sc.id', 'left')  
            ->where('av.VDate >=', $start)  
            ->where('av.VDate <=', $end)  
            ->where('av.isApproved', $status)      
            ->order_by('av.id', 'DESC')
            ->get();          
        if ($data->num_rows() > 0) {
            return $data->result();    
        }
        return false;
    }

    // get voucher
    public function get_day_book_voucher_byDate($start, $end, $status=0)
    {
      $data = $this->db->select("VNo, Vtype")
            ->from('acc_vaucher')           
            ->where('VDate >=', $start)  
            ->where('VDate <=', $end)  
            ->where('isApproved', $status)  
            ->group_by('VNo')     
            ->order_by('id', 'ASC')
            ->get();          
        if ($data->num_rows() > 0) {
            return $data->result();    
        }
        return false;
    }

// get opening balance
    public function opening_balance($limit = null, $start = null)
    {
      $data = $this->db->select("ob.*, fy.yearName , ac.HeadName, st.subtypeName, sc.name")
            ->from('acc_opening_balance ob') 
            ->join('financial_year fy','ob.fyear = fy.id', 'left')
            ->join('acc_coa ac','ob.COAID = ac.HeadCode', 'left')         
            ->join('acc_subtype st','ob.subType = st.id', 'left') 
            ->join('acc_subcode sc', 'ob.subCode = sc.id', 'left')           
            ->order_by('ob.id', 'DESC')
            ->limit($limit, $start)
            ->get();
        if ($data->num_rows() > 0) {
            return $data->result();    
        }
        return false;
    }


// count opening balance
    public function count_opening_balance()
    {
        $data = $this->db->select("id")
            ->from('acc_opening_balance')                     
            ->order_by('id', 'DESC')            
            ->get();
        if ($data->num_rows() > 0) {
            return $data->num_rows();    
        }
        return 0;
    }


// get opening balance by id
    public function getopeningBalanceById($id = null)
    {
      $data = $this->db->select("ob.*, fy.yearName , ac.HeadName, st.subtypeName, sc.name")
            ->from('acc_opening_balance ob') 
            ->join('financial_year fy','ob.fyear = fy.id', 'left')
            ->join('acc_coa ac','ob.COAID = ac.HeadCode', 'left')         
            ->join('acc_subtype st','ob.subType = st.id', 'left') 
            ->join('acc_subcode sc', 'ob.subCode = sc.id', 'left')           
            ->where('ob.id', $id)           
            ->get();
        if ($data->num_rows() > 0) {
            return $data->row();   
        }
        return false;
    }

// count financial year list
    public function financial_year($limit = null, $start = null)
    {
      $data = $this->db->select("*")
            ->from('financial_year')            
            ->order_by('id', 'DESC')
            ->limit($limit, $start)
            ->get();
        if ($data->num_rows() > 0) {
            return $data->result();    
        }
        return false;
    }
  
// count financial year list
public function get_current_financial_year() {
       $data = $this->db->select("*")
            ->from('financial_year')            
            ->where('status', 1) 
            ->where('isCloseReq', 0) 
            ->limit(1)
            ->order_by('id', "ASC")
            ->get();
        if ($data->num_rows() > 0) {
            return $data->row();    
        }
        return false;
    }


// count financial year list
    public function count_financial_year()
    {
        $data = $this->db->select("*")
            ->from('financial_year')            
            ->order_by('status', 'DESC')            
            ->get();
        if ($data->num_rows() > 0) {
            return $data->num_rows();    
        }
        return 0;
    }
// count financial year list
    public function check_financial_year($sdate,$edate, $yn)
    {
        $data = $this->db->select("*")
            ->from('financial_year')    
            ->where('startDate', $sdate)         
            ->where('endDate', $edate)         
            ->where('yearName', $yn)  
            ->get();
        if ($data->num_rows() > 0) {
            return false;    
        }
        return true;
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

//  financial year create
    public function financial_year_create($data)
    {
        if(is_array($data)) {
         $res =    $this->db->insert('financial_year',$data);
        }
        if ($res) {
            addActivityLog("financial_year", "create",$this->db->insert_id(), "financial_year", 1, $data);
            return $this->db->insert_id();    
        }
        return false;
    }


//  subaccount create
    public function subaccount_create($data)
    {
        if(is_array($data)) {
         $res =    $this->db->insert('acc_subcode',$data);
        }
        if ($res) {
             addActivityLog("sub_account", "create",$this->db->insert_id(), "acc_subcode", 1, $data); 
            return $this->db->insert_id();    
        }
        return false;
    }


// update subaccount
    public function subaccount_update($data = [])
    {
        return $this->db->where('id',$data['id'])
            ->update('acc_subcode',$data); 
    } 


// get Subtypes
    public function get_subTypeItems($id)
    {
        $data = $this->db->select("id,name")
            ->from('acc_subcode')  
            ->where('subTypeId', $id)                   
            ->order_by('id', 'ASC')            
            ->get();
        if ($data->num_rows() > 0) {
            return $data->result();    
        }
        return 0;
    }
// Delete  sub account
    public function delete_sub_account($id) {

        $this->db->where('id',$id)
            ->delete('acc_subcode');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }




// update financial year
    public function update_financial_year($data = [])
    {
        return $this->db->where('id',$data['id'])
            ->update('financial_year',$data); 
    } 

// Delete financial year
    public function delete_financial_year($id) {

        $this->db->where('id',$id)
            ->delete('financial_year');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }


// Credit Account Head
     public function Cracc()
    {
      return  $data = $this->db->select("*")
            ->from('acc_coa') 
            ->like('HeadCode',1020102, 'after')
            ->where('IsTransaction', 1) 
            ->order_by('HeadName')
            ->get()
            ->result();
    }

    // Chech sub account is exist
     public function check_child_account($id)
    {
        $data = $this->db->select("HeadCode, HeadLevel")
            ->from('acc_coa')
            ->where('pheadcode', $id) 
            ->get();
            if($data->num_rows() >0) {
               return  $data->result();
            } else {
                return false;
            }             
    }

    // Insert opening Balance 
    public function insert_openingBalance(){  
            $fyear = $this->input->post('fyear',true); 
            $isSubtype = $this->input->post('isSubtype',true); 
            $subtype = $this->input->post('subtype',true); 
            $dAID = $this->input->post('cmbCode',true);
            $Debit =$this->input->post('txtDebit',true);
            $Credit= $this->input->post('txtCredit',true);
            $VDate = $this->input->post('dtpDate');           
           
            $CreateBy=$this->session->userdata('id');
            $createdate=date('Y-m-d H:i:s');

           
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Debit[$i];
                $Camnt=$Credit[$i]; 
                $isSubtypev=$isSubtype[$i]; 
                if($isSubtypev != 1) {
                     $subcode = $subtype[$i];
                } else {
                     $subcode = null;
                }               
           
            $openingbalancetinsert = array(     
                      'fyear'          =>  $fyear,
                      'COAID'          =>  $dbtid,     
                      'subType'        =>  $isSubtypev,     
                      'subCode'        =>  $subcode,     
                      'openDate'       =>  $VDate,
                      'Debit'          =>  $Damnt,
                      'Credit'         =>  $Camnt,     
                      'CreateBy'       => $CreateBy,
                      'CreateDate'     => $createdate,      
                    ); 

 $this->db->insert('acc_opening_balance',$openingbalancetinsert);         
              addActivityLog("opening_balance", "create",$this->db->insert_id(), "acc_opening_balance", 1, $openingbalancetinsert);                      
    } 
    return true;
}
 // Update opening Balance 
    public function update_openingBalance(){  
            $fyear = $this->input->post('fyear',true); 
            $isSubtype = $this->input->post('isSubtype',true); 
            $subtype = $this->input->post('subtype',true); 
            $dAID = $this->input->post('cmbCode',true);
            $Debit =$this->input->post('txtDebit',true);
            $Credit= $this->input->post('txtCredit',true);
            $VDate = $this->input->post('dtpDate');           
            $id = $this->input->post('opid');   
            $CreateBy=$this->session->userdata('id');
            $createdate=date('Y-m-d H:i:s');

           
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Debit[$i];
                $Camnt=$Credit[$i]; 
                $isSubtypev=$isSubtype[$i]; 
                if($isSubtypev != 1) {
                     $subcode = $subtype[$i];
                } else {
                     $subcode = null;
                }               
           
            $openingbalancetinsert = array(     
                      'fyear'          =>  $fyear,
                      'COAID'          =>  $dbtid,     
                      'subType'        =>  $isSubtypev,     
                      'subCode'        =>  $subcode,     
                      'openDate'       =>  $VDate,
                      'Debit'          =>  $Damnt,
                      'Credit'         =>  $Camnt,     
                      'CreateBy'       => $CreateBy,
                      'CreateDate'     => $createdate,      
                    ); 


             $this->db->where('id', $id);           
             $this->db->update('acc_opening_balance',$openingbalancetinsert);
              addActivityLog("opening_balance", "update",$id, "acc_opening_balance", 2, $openingbalancetinsert);                         
    } 
    return true;
}


 // Insert opening Balance 
    public function insert_openingBalance_by_closing($data){ 
            $this->db->insert('acc_opening_balance',$data);         
            addActivityLog("opening_balance", "create",$this->db->insert_id(), "acc_opening_balance", 1, $data);
        return true;
    }


// Delete opening Balance
public function delete_openingBalance($id) {
    $this->db->where('id', $id);           
    $this->db->delete('acc_opening_balance'); 
 return true;
}

//get max field
public function getMaxFieldNumber($field, $table,$where=null,$type=null,$fild2=null) {
  
    $this->db->select("$field,$fild2");
    $this->db->from($table); 
    if($where != null) {
        $this->db->where($where, $type);
    } 
    $this->db->order_by('id','desc')->limit(1) ; 
    $record = $this->db->get() ; 
    if($record->num_rows() >0) {     
     if($fild2 != null) {
        $num = $record->row($fild2);
        list($txt, $intval) = explode('-', $num);        
        return $intval;
     } else { 
     $num = $record->row($field);       
       return $num;
     }     
    } else {
        return 0;
    }
}
// get referance no
    public function getReferanceNo($id)
    {
        $data = $this->db->select("referenceNo")
            ->from('acc_subcode')  
            ->where('id', $id)                   
            ->limit(1)            
            ->get();
        if ($data->num_rows() > 0) {
            $val = $data->row();
            return $val->referenceNo;    
        } 
        return null;
    }

 // Insert Debit voucher  
    public function insert_debitvoucher(){  
            $maxid = $this->getMaxFieldNumber('id','acc_vaucher','Vtype','DV','VNo');             
            $vaucherNo = "DV-". ($maxid +1);
            $fyear = $this->session->userdata('fyear');
            $isSubtype = $this->input->post('isSubtype',true); 
            $txtComment = $this->input->post('txtComment',true); 
            $checkno = $this->input->post('checkno',true);
            $checkdate = $this->input->post('chequeDate',true);
            $ishonours = $this->input->post('ishonours',true);
            $subtype = $this->input->post('subtype',true); 
            $dAID = $this->input->post('cmbCode',true);
            $reVID = $this->input->post('cmbDebit',true);
            $Debit =$this->input->post('txtAmount',true);            
            $VDate = $this->input->post('dtpDate');           
            $txtComment = $this->input->post('txtComment');           
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $CreateBy=$this->session->userdata('id');
            $createdate=date('Y-m-d H:i:s');

           
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Debit[$i];
                $Camnt=$Debit[$i]; 
                $Comment=$txtComment[$i]; 
                $isSubtypev=$isSubtype[$i]; 
                if($isSubtypev != 1) {
                     $subcode = $subtype[$i];
                     $refno = $this->getReferanceNo($subcode);
                } else {
                     $subcode = null;
                     $refno = null;
                }  
                if(isset($ishonours)) {
                  $ishonour = 1;
                } else {
                  $ishonour = 0;
                }          
           
            $debitinsert = array(     
                      'fyear'          =>  $fyear,
                      'VNo'            =>  $vaucherNo,
                      'Vtype'          =>  'DV',
                      'referenceNo'    =>  $refno,
                      'VDate'          =>  $VDate,
                      'COAID'          =>  $dbtid,     
                      'Narration'      =>  $Narration, 
                      'chequeNo'       =>  $checkno,
                      'chequeDate'     =>  $checkdate,
                      'isHonour'       =>  $ishonour,    
                      'ledgerComment'  =>  $Comment,     
                      'Debit'          =>  $Damnt, 
                      'Credit'         =>  0.00,    
                      'RevCodde'       =>  $reVID,    
                      'subType'        =>  $isSubtypev,     
                      'subCode'        =>  $subcode,     
                      'isApproved'     =>  0,                      
                      'CreateBy'       => $CreateBy,
                      'CreateDate'     => $createdate,      
                      'status'         => 0,      
                    ); 

          $this->db->insert('acc_vaucher',$debitinsert); 
          addActivityLog("debit_vaucher", "create",$vaucherNo, "acc_vaucher",1, $debitinsert);                             
    } 
    return true;
}


// Update debit voucher
   public function update_debitvoucher(){
           $vaucherNo = $this->input->post('txtVNo',true);
           $isApproved = $this->input->post('isApproved',true);
           $this->db->where('VNo',$vaucherNo)
            ->delete(' acc_vaucher');             
            $fyear = $this->input->post('fyear',true);
            $CreateBy = $this->input->post('CreateBy',true);
            $CreateDate = $this->input->post('CreateDate',true);
            $isSubtype = $this->input->post('isSubtype',true); 
            $txtComment = $this->input->post('txtComment',true); 
            $subtype = $this->input->post('subtype',true); 
            $dAID = $this->input->post('cmbCode',true);
            $reVID = $this->input->post('cmbDebit',true);
            $Debit =$this->input->post('txtAmount',true);            
            $VDate = $this->input->post('dtpDate');     
            $checkno = $this->input->post('checkno',true);
            $checkdate = $this->input->post('chequeDate',true);
            $ishonours = $this->input->post('ishonours',true);      
            $txtComment = $this->input->post('txtComment');           
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $updatedBy=$this->session->userdata('id');
            $updatedDate=date('Y-m-d H:i:s');

           
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Debit[$i];
                $Camnt=$Debit[$i]; 
                $Comment=$txtComment[$i]; 
                $isSubtypev=$isSubtype[$i]; 
                if($isSubtypev != 1) {
                     $subcode = $subtype[$i];
                     $refno = $this->getReferanceNo($subcode);
                } else {
                     $subcode = null;
                     $refno = null;
                } 
                if(isset($ishonours)) {
                  $ishonour = 1;
                } else {
                  $ishonour = 0;
                }                 
           
            $debitinsert = array(     
                      'fyear'          =>  $fyear,
                      'VNo'            =>  $vaucherNo,
                      'Vtype'          =>  'DV',
                      'referenceNo'    =>  $refno,
                      'VDate'          =>  $VDate,
                      'COAID'          =>  $dbtid,     
                      'Narration'      =>  $Narration,  
                      'chequeNo'       =>  $checkno,
                      'chequeDate'     =>  $checkdate,
                      'isHonour'       =>  $ishonour,      
                      'ledgerComment'  =>  $Comment,     
                      'Debit'          =>  $Damnt, 
                      'Credit'         =>  0.00,    
                      'RevCodde'       =>  $reVID,    
                      'subType'        =>  $isSubtypev,     
                      'subCode'        =>  $subcode,     
                      'isApproved'     =>  0,                      
                      'CreateBy'       => $CreateBy,
                      'CreateDate'     => $CreateDate,      
                      'UpdateBy'       => $updatedBy,      
                      'UpdateDate'     => $updatedDate,      
                      'status'         => 0,      
                    ); 
        
          $this->db->insert('acc_vaucher',$debitinsert);
           addActivityLog("debit_vaucher", "update",$vaucherNo, "acc_vaucher",2, $debitinsert);                              
    } 
    return true;
 }


//Generate Voucher No
public function voNO()
    {
      return  $data = $this->db->select("VNo as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'DV-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->row();
           
    }

    public function Cashvoucher()
    {
      return  $data = $this->db->select("VNo as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'CHV-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->row();
        
    }
// balance Adjustment voucher
        public function balanceadjvoucher()
    {
      return  $data = $this->db->select("VNo as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'BLA-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->row();
          
    }

// bank voucher
       public function bankvoucher()
    {
      return  $data = $this->db->select("VNo as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'BAD-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->row();
          
    }

    // Credit voucher no
    public function crVno()
    {
      return  $data = $this->db->select("VNo as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'CV-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->row();
         
    }

 // Contra voucher 

    public function contra()
    {
      return  $data = $this->db->select("Max(VNo) as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'Contra-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->result_array();
         
    }


 // Insert Debit voucher  
    public function insert_creditvoucher(){  
             $maxid = $this->getMaxFieldNumber('id','acc_vaucher','Vtype','CV','VNo');             
            $vaucherNo = "CV-". ($maxid +1);
            $fyear = $this->session->userdata('fyear');
            $isSubtype = $this->input->post('isSubtype',true); 
            $txtComment = $this->input->post('txtComment',true); 
            $subtype = $this->input->post('subtype',true); 
            $dAID = $this->input->post('cmbCode',true);
            $reVID = $this->input->post('cmbDebit',true);
            $Creit =$this->input->post('txtAmount',true);            
            $VDate = $this->input->post('dtpDate');       
            $checkno = $this->input->post('checkno',true);
            $checkdate = $this->input->post('chequeDate',true);
            $ishonours = $this->input->post('ishonours',true);    
            $txtComment = $this->input->post('txtComment');           
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $CreateBy=$this->session->userdata('id');
            $createdate=date('Y-m-d H:i:s');

           
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Creit[$i];
                $Camnt=$Creit[$i]; 
                $Comment=$txtComment[$i]; 
                $isSubtypev=$isSubtype[$i]; 
                if($isSubtypev != 1) {
                     $subcode = $subtype[$i];
                     $refno = $this->getReferanceNo($subcode);
                } else {
                     $subcode = null;
                     $refno = null;
                }
                if(isset($ishonours)) {
                  $ishonour = 1;
                } else {
                  $ishonour = 0;
                }                  
           
            $creditinsert = array(     
                      'fyear'          =>  $fyear,
                      'VNo'            =>  $vaucherNo,
                      'Vtype'          =>  'CV',
                      'referenceNo'    =>  $refno,
                      'VDate'          =>  $VDate,
                      'COAID'          =>  $dbtid,     
                      'Narration'      =>  $Narration,
                      'chequeNo'       =>  $checkno,
                      'chequeDate'     =>  $checkdate,
                      'isHonour'       =>  $ishonour,        
                      'ledgerComment'  =>  $Comment,     
                      'Debit'          =>  0.00, 
                      'Credit'         =>  $Camnt,    
                      'RevCodde'       =>  $reVID,    
                      'subType'        =>  $isSubtypev,     
                      'subCode'        =>  $subcode,     
                      'isApproved'     =>  0,                      
                      'CreateBy'       => $CreateBy,
                      'CreateDate'     => $createdate,      
                      'status'         => 0,      
                    ); 
        
          $this->db->insert('acc_vaucher',$creditinsert);   
           addActivityLog("credit_vaucher", "create",$vaucherNo, "acc_vaucher",1, $creditinsert);                           
    } 
    return true;
}

// Insert Countra voucher   
    public function insert_contravoucher(){  
            $maxid = $this->getMaxFieldNumber('id','acc_vaucher','Vtype','CT','VNo');             
            $vaucherNo = "CT-". ($maxid +1);
            $fyear = $this->session->userdata('fyear');           
            $txtComment = $this->input->post('txtComment',true);              
            $dAID = $this->input->post('cmbCode',true);
            $reVID = $this->input->post('cmbDebit',true);
            $Debit =$this->input->post('txtAmount',true);            
            $Credit =$this->input->post('txtAmountcr',true);            
            $VDate = $this->input->post('dtpDate');           
            $txtComment = $this->input->post('txtComment');           
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $CreateBy=$this->session->userdata('id');
            $createdate=date('Y-m-d H:i:s');

           
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Debit[$i];
                $Camnt=$Credit[$i]; 
                $Comment=$txtComment[$i];  
            $contrainsert = array(     
                      'fyear'          =>  $fyear,
                      'VNo'            =>  $vaucherNo,
                      'Vtype'          =>  'CT',
                      'referenceNo'    =>  null,
                      'VDate'          =>  $VDate,
                      'COAID'          =>  $dbtid,     
                      'Narration'      =>  $Narration,  
                      'chequeNo'       =>  null,
                      'chequeDate'     =>  null,
                      'isHonour'       =>  0,      
                      'ledgerComment'  =>  $Comment,     
                      'Debit'          =>  $Damnt, 
                      'Credit'         =>  $Camnt,    
                      'RevCodde'       =>  $reVID,    
                      'subType'        =>  1,     
                      'subCode'        =>  null,     
                      'isApproved'     =>  0,                      
                      'CreateBy'       => $CreateBy,
                      'CreateDate'     => $createdate,      
                      'status'         => 0,      
                    ); 
        
          $this->db->insert('acc_vaucher',$contrainsert);   
           addActivityLog("contra_vaucher", "create",$vaucherNo, "acc_vaucher",1, $contrainsert);                           
    } 
    return true;
}

 // Insert Journal voucher  
    public function insert_journalvoucher(){  
            $maxid = $this->getMaxFieldNumber('id','acc_vaucher','Vtype','JV','VNo');             
            $vaucherNo = "JV-". ($maxid +1);
            $fyear = $this->session->userdata('fyear');
            $isSubtype = $this->input->post('isSubtype',true); 
            $txtComment = $this->input->post('txtComment',true); 
            $subtype = $this->input->post('subtype',true); 
            $dAID = $this->input->post('cmbCode',true);
            $reVID = $this->input->post('cmbDebit',true);
            $Devit =$this->input->post('txtAmount',true); 
            $Creit =$this->input->post('txtAmountcr',true);            
                      
            $VDate = $this->input->post('dtpDate');           
            $txtComment = $this->input->post('txtComment');           
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $CreateBy=$this->session->userdata('id');
            $createdate=date('Y-m-d H:i:s');

           
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $reAccount=$reVID[$i];
                $Damnt=$Devit[$i];
                $Camnt=$Creit[$i]; 
                $Comment=$txtComment[$i]; 
                $isSubtypev=$isSubtype[$i]; 
                if($isSubtypev != 1) {
                     $subcode = $subtype[$i];
                     $refno = $this->getReferanceNo($subcode);
                } else {
                     $subcode = null;
                     $refno = null;
                }               
           
            $jurnalinsert = array(     
                      'fyear'          =>  $fyear,
                      'VNo'            =>  $vaucherNo,
                      'Vtype'          =>  'JV',
                      'referenceNo'    =>  $refno,
                      'VDate'          =>  $VDate,
                      'COAID'          =>  $dbtid,     
                      'Narration'      =>  $Narration,
                      'chequeNo'       =>  null,
                      'chequeDate'     =>  null,
                      'isHonour'       =>  0,     
                      'ledgerComment'  =>  $Comment,     
                      'Debit'          =>  $Damnt, 
                      'Credit'         =>  $Camnt,    
                      'RevCodde'       =>  $reAccount,    
                      'subType'        =>  $isSubtypev,     
                      'subCode'        =>  $subcode,     
                      'isApproved'     =>  0,                      
                      'CreateBy'       => $CreateBy,
                      'CreateDate'     => $createdate,      
                      'status'         => 0,      
                    ); 
         
         $this->db->insert('acc_vaucher',$jurnalinsert);   
         addActivityLog("journal_vaucher", "create",$vaucherNo, "acc_vaucher",1, $jurnalinsert);                           
    } 
    return true;
}

// journal voucher
public function journal()
    {
      return  $data = $this->db->select("Max(VNo) as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'Journal-', 'after')
            ->order_by('id','desc')
            ->get()
            ->result_array();    
    }

    //Get all Bank name
    public function get_all_bank_list() {
        return  $data = $this->db->select("HeadCode, HeadName")
            ->from('acc_coa') 
            ->where('isBankNature', 1)
            ->order_by('id','ASC')
            ->get()
            ->result();   
    }

// voucher reconciliation 
    public function reconciliation_voucher($dtpFromDate, $dtpToDate, $bankCode=null, $status=0){
           $values = array("DV");      
           $this->db->select('v.*,sum(v.Credit) as Credit,sum(v.Debit) as Debit, a.HeadName as Bankname, ac.HeadName as accountName');
           $this->db->from('acc_vaucher v');
           $this->db->join('acc_coa a','v.RevCodde = a.HeadCode', 'left');
           $this->db->join('acc_coa ac','v.COAID = ac.HeadCode', 'left');
           $this->db->where_in('Vtype',$values);
           $this->db->where('v.isApproved',1);                             
           $this->db->where('v.chequeno !=',null);                             
           $this->db->where('a.isBankNature',1);  
           if($bankCode != null ) {
            $this->db->where('v.RevCodde',$bankCode);
           } 
           if($status == 1 ) {
             $this->db->where('v.isHonour',1);
           }  else if($status == 2) {
             $this->db->where('v.isHonour',0);
           }                         
           $this->db->where('v.VDate BETWEEN "'.$dtpFromDate. '" and "'.$dtpToDate.'"');
           $this->db->group_by('v.VNo');
           $approveinfo  =  $this->db->get();
           if($approveinfo->num_rows()>0) {
             return $approveinfo->result();
           }   
           return false;        
       }

    // reconciliation all
    public function reconciliation_all($data){
        $udata = array(
            'isHonour'  => 1
        );
        $uptransation = $this->db->where_in('VNo',$data)
            ->update('acc_transaction',$udata); 
        $upvoucher = $this->db->where_in('VNo',$data)
            ->update('acc_vaucher',$udata); 
        if($uptransation && $upvoucher) {
            return true;
        } else {
            return false;
        }
    } 


    // voucher Aprove 
    public function approve_voucher(){
        $values = array("DV", "CV", "JV","CT");
      
       return $approveinfo = $this->db->select('acc_vaucher.*,sum(Credit) as Credit,sum(Debit) as Debit, acc_coa.HeadName')
                               ->from('acc_vaucher')
                               ->join('acc_coa','acc_vaucher.COAID = acc_coa.HeadCode', 'left')
                               ->where_in('Vtype',$values)
                               ->where('isApproved',0)
                               ->group_by('VNo')
                               ->get()
                               ->result();

    }

   public function journal_updata($id){
      return  $vou_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->get()
                 ->result_array();
    }

    public function approved($data = [])
    {
        return $this->db->where('VNo',$data['VNo'])
            ->update('acc_transaction',$data); 
    } 
    // Approved Vaucher
    public function approved_vaucher($id,$action)
    {
        $vaucherdata = $this->db->select('*')
                 ->from('acc_vaucher')
                 ->where('VNo',$id)
                 ->get()->result();
       $ApprovedBy=$this->session->userdata('id');
       $approvedDate=date('Y-m-d H:i:s');
       if($vaucherdata) {
        foreach($vaucherdata as $row) {           
            $transationinsert = array(     
                      'vid'            =>  $row->id,
                      'fyear'          =>  $row->fyear,
                      'VNo'            =>  $row->VNo,
                      'Vtype'          =>  $row->Vtype,
                      'referenceNo'    =>  $row->referenceNo,
                      'VDate'          =>  $row->VDate,
                      'COAID'          =>  $row->COAID,     
                      'Narration'      =>  $row->Narration,
                      'chequeNo'       =>  $row->chequeNo,
                      'chequeDate'     =>  $row->chequeDate,
                      'isHonour'       =>  $row->isHonour,        
                      'ledgerComment'  =>  $row->ledgerComment,     
                      'Debit'          =>  $row->Debit, 
                      'Credit'         =>  $row->Credit,    
                      'StoreID'        =>  0,    
                      'IsPosted'       =>  1,    
                      'RevCodde'       =>  $row->RevCodde,    
                      'subType'        =>  $row->subType,     
                      'subCode'        =>  $row->subCode,     
                      'IsAppove'       =>  1,                      
                      'CreateBy'       => $ApprovedBy,
                      'CreateDate'     => $approvedDate
                    );          
            $instran = $this->db->insert('acc_transaction',$transationinsert); 
             addActivityLog("approved_vaucher_transation", "create",$this->db->insert_id(), "acc_transaction",1, $transationinsert);
            // update Monthly record
            if($instran) {
            $this->store_transation_summery($row->COAID, $row->VDate);
            $revercetransationinsert = array( 
                      'vid'            =>  $row->id,    
                      'fyear'          =>  $row->fyear,
                      'VNo'            =>  $row->VNo,
                      'Vtype'          =>  $row->Vtype,
                      'referenceNo'    =>  $row->referenceNo,
                      'VDate'          =>  $row->VDate,
                      'COAID'          =>  $row->RevCodde,     
                      'Narration'      =>  $row->Narration,
                      'chequeNo'       =>  $row->chequeNo,
                      'chequeDate'     =>  $row->chequeDate,
                      'isHonour'       =>  $row->isHonour,     
                      'ledgerComment'  =>  $row->ledgerComment,     
                      'Debit'          =>  $row->Credit, 
                      'Credit'         =>  $row->Debit,    
                      'StoreID'        =>  0,    
                      'IsPosted'       =>  1,    
                      'RevCodde'       =>  $row->COAID,    
                      'subType'        =>  $row->subType,     
                      'subCode'        =>  $row->subCode,     
                      'IsAppove'       =>  1,                      
                      'CreateBy'       => $ApprovedBy,
                      'CreateDate'     => $approvedDate
                    ); 
                     $this->db->insert('acc_transaction',$revercetransationinsert); 
                     addActivityLog("approved_vaucher_reversetransation", "create",$this->db->insert_id(), "acc_transaction",1, $revercetransationinsert);
                     // update Monthly record
                     $this->store_transation_summery($row->RevCodde, $row->VDate);

            }
            
        }
       }
       $action = ($action=='active'?1:0);
       $upData = array(
                  'VNo'      => $id,
                  'isApproved' => $action,
                  'approvedBy' => $ApprovedBy,
                  'approvedDate' => $approvedDate,
                  'status' => $action
                );
        return $this->db->where('VNo',$id)
            ->update('acc_vaucher',$upData); 
    } 

    //debit update voucher
    public function get_dbvoucher_info($id){
      return  $vou_info = $this->db->select('*')
                 ->from('acc_vaucher')
                 ->where('VNo',$id)                
                 ->get()
                 ->result();
  
    }
  //debit update voucher
    public function dbvoucher_updata($id){
      return  $vou_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Credit <',1)
                 ->get()
                 ->result();
  
    }

     //credit voucher update 
    public function crdtvoucher_updata($id){
      return  $vou_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Debit <',1)
                 ->get()
                 ->result();
 
    }
   public function getheadename($vno,$coaid,$Drcrflag){
                $this->db->select('acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Narration, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID,acc_coa.HeadName, acc_coa.PHeadName, acc_coa.pheadcode, acc_coa.HeadType');
                $this->db->from('acc_transaction');
                $this->db->join('acc_coa','acc_transaction.COAID = acc_coa.HeadCode', 'left');
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('acc_transaction.COAID!=',$coaid);
                if($Drcrflag=="Dr"){
                $this->db->where('acc_transaction.Credit>',0);
                }
                else{
                    $this->db->where('acc_transaction.Debit>',0);
                }
                $this->db->where('acc_transaction.VNo',$vno);
                $this->db->order_by('acc_transaction.VDate','Asc');
                $query = $this->db->get();
                $getdata=$query->result();
                //echo $this->db->last_query();
                return $getdata;
        }
    public function update_journalvoucher(){
         
           $vaucherNo = addslashes(trim($this->input->post('txtVNo',true)));
            $Vtype="JV";     
            $this->db->where('VNo',$vaucherNo)
            ->delete(' acc_vaucher');         
            $fyear = $this->session->userdata('fyear');
            $isSubtype = $this->input->post('isSubtype',true); 
            $txtComment = $this->input->post('txtComment',true); 
            $subtype = $this->input->post('subtype',true); 
            $dAID = $this->input->post('cmbCode',true);
            $reVID = $this->input->post('cmbDebit',true);
            $Devit =$this->input->post('txtAmount',true); 
            $Creit =$this->input->post('txtAmountcr',true);            
                      
            $VDate = $this->input->post('dtpDate');           
            $txtComment = $this->input->post('txtComment');           
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $updatedBy=$this->session->userdata('id');
            $updatedDate=date('Y-m-d H:i:s');

           
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $reAccount=$reVID[$i];
                $Damnt=$Devit[$i];
                $Camnt=$Creit[$i]; 
                $Comment=$txtComment[$i]; 
                $isSubtypev=$isSubtype[$i]; 
                if($isSubtypev != 1) {
                     $subcode = $subtype[$i];
                     $refno = $this->getReferanceNo($subcode);
                } else {
                     $subcode = null;
                     $refno = null;
                }               
           
            $jurnalinsert = array(     
                      'fyear'          =>  $fyear,
                      'VNo'            =>  $vaucherNo,
                      'Vtype'          =>  'JV',
                      'referenceNo'    =>  $refno,
                      'VDate'          =>  $VDate,
                      'COAID'          =>  $dbtid,     
                      'Narration'      =>  $Narration,     
                      'ledgerComment'  =>  $Comment,     
                      'Debit'          =>  $Damnt, 
                      'Credit'         =>  $Camnt,    
                      'RevCodde'       =>  $reAccount,    
                      'subType'        =>  $isSubtypev,     
                      'subCode'        =>  $subcode,     
                      'isApproved'     =>  0,                      
                      'UpdateBy'       => $updatedBy,      
                      'UpdateDate'     => $updatedDate,  
                      'status'         => 0,      
                    ); 
         
         $this->db->insert('acc_vaucher',$jurnalinsert);
         addActivityLog("journal_vaucher", "update",$vaucherNo, "acc_vaucher",2, $debitinsert);
            

    }
     
    return true;
}

 public function update_contravoucher(){
            $vaucherNo = addslashes(trim($this->input->post('txtVNo',true)));
            $Vtype="CT";
            $this->db->where('VNo',$vaucherNo)
            ->delete('acc_vaucher');   
            $fyear = $this->session->userdata('fyear');           
            $txtComment = $this->input->post('txtComment',true);              
            $dAID = $this->input->post('cmbCode',true);
            $reVID = $this->input->post('cmbDebit',true);
            $Debit =$this->input->post('txtAmount',true);            
            $Credit =$this->input->post('txtAmountcr',true);            
            $VDate = $this->input->post('dtpDate');           
            $txtComment = $this->input->post('txtComment');           
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $updatedBy=$this->session->userdata('id');
            $updatedDate=date('Y-m-d H:i:s');
           
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Debit[$i];
                $Camnt=$Credit[$i]; 
                $Comment=$txtComment[$i];  
            $contrainsert = array(     
                      'fyear'          =>  $fyear,
                      'VNo'            =>  $vaucherNo,
                      'Vtype'          =>  'CT',
                      'referenceNo'    =>  null,
                      'VDate'          =>  $VDate,
                      'COAID'          =>  $dbtid,     
                      'Narration'      =>  $Narration,     
                      'ledgerComment'  =>  $Comment,     
                      'Debit'          =>  $Damnt, 
                      'Credit'         =>  $Camnt,    
                      'RevCodde'       =>  $reVID,    
                      'subType'        =>  1,     
                      'subCode'        =>  null,     
                      'isApproved'     =>  0,                      
                      'UpdateBy'       => $updatedBy,      
                      'UpdateDate'     => $updatedDate,       
                      'status'         => 0,      
                    ); 
        
          $this->db->insert('acc_vaucher',$contrainsert);    
          addActivityLog("contra_vaucher", "update",$vaucherNo, "acc_vaucher",2, $debitinsert);                          
    }  
        return true;
   }
     //credit voucher update 
    public function debitvoucher_updata($id){
      return $cr_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Credit<',1)
                 ->get()
                 ->row();
    }
     // debit update voucher credit info
    public function crvoucher_updata($id){
       return $v_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Debit<',1)
                 ->get()
                 ->row();
   
    }

    // update Credit voucher
     public function update_creditvoucher(){
            $vaucherNo = $this->input->post('txtVNo',true);
            $isApproved = $this->input->post('isApproved',true);
            $this->db->where('VNo',$vaucherNo)
            ->delete(' acc_vaucher');             
            $fyear = $this->input->post('fyear',true);
            $CreateBy = $this->input->post('CreateBy',true);
            $CreateDate = $this->input->post('CreateDate',true);
            $isSubtype = $this->input->post('isSubtype',true); 
            $txtComment = $this->input->post('txtComment',true); 
            $subtype = $this->input->post('subtype',true); 
            $dAID = $this->input->post('cmbCode',true);
            $reVID = $this->input->post('cmbDebit',true);
            $Credit =$this->input->post('txtAmount',true);            
            $VDate = $this->input->post('dtpDate');         
            $checkno = $this->input->post('checkno',true);
            $checkdate = $this->input->post('chequeDate',true);
            $ishonours = $this->input->post('ishonours',true);  
            $txtComment = $this->input->post('txtComment');           
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $updatedBy=$this->session->userdata('id');
            $updatedDate=date('Y-m-d H:i:s');


            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Credit[$i];
                $Camnt=$Credit[$i]; 
                $Comment=$txtComment[$i]; 
                $isSubtypev=$isSubtype[$i]; 
                if($isSubtypev != 1) {
                     $subcode = $subtype[$i];
                     $refno = $this->getReferanceNo($subcode);
                } else {
                     $subcode = null;
                     $refno = null;
                } 
                if(isset($ishonours)) {
                  $ishonour = 1;
                } else {
                  $ishonour = 0;
                }                
           
            $creditinsert = array(     
                      'fyear'          =>  $fyear,
                      'VNo'            =>  $vaucherNo,
                      'Vtype'          =>  'CV',
                      'referenceNo'    =>  $refno,
                      'VDate'          =>  $VDate,
                      'COAID'          =>  $dbtid,     
                      'Narration'      =>  $Narration, 
                      'chequeNo'       =>  $checkno,
                      'chequeDate'     =>  $checkdate,
                      'isHonour'       =>  $ishonour,    
                      'ledgerComment'  =>  $Comment,     
                      'Debit'          =>  0.00, 
                      'Credit'         =>  $Camnt,    
                      'RevCodde'       =>  $reVID,    
                      'subType'        =>  $isSubtypev,     
                      'subCode'        =>  $subcode,     
                      'isApproved'     =>  0,                      
                      'CreateBy'       => $CreateBy,
                      'CreateDate'     => $CreateDate,      
                      'UpdateBy'       => $updatedBy,      
                      'UpdateDate'     => $updatedDate,      
                      'status'         => 0,      
                    ); 
        
          $this->db->insert('acc_vaucher',$creditinsert);  
          addActivityLog("credit_vaucher", "update",$vaucherNo, "acc_vaucher",2, $debitinsert);

    } 
    return true;
 }



 // //Trial Balance Report 
    public function trial_balance_report($FromDate,$ToDate,$WithOpening){

        if($WithOpening)
            $WithOpening=true;
        else
            $WithOpening=false;

        $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND IsActive=1 AND HeadType IN ('A','L') ORDER BY HeadCode";
        $oResultTr = $this->db->query($sql);
        
        $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND IsActive=1 AND HeadType IN ('I','E') ORDER BY HeadCode";
        $oResultInEx = $this->db->query($sql);

        $data = array(
            'oResultTr'   => $oResultTr->result_array(),
            'oResultInEx' => $oResultInEx->result_array(),
            'WithOpening' => $WithOpening
        );

        return $data;
    }


    // check if transation is appear specific financial year
    public function check_istransation($y) {
        $this->db->select('ID');
        $this->db->from('acc_transaction');
        $this->db->where('fyear',$y);       
        $rs = $this->db->get();
        if($rs->num_rows() > 0) {
           return false;
        } else {
            return true;
        }
    }

   public  function get_vouchar(){


         $date=date('Y-m-d');
          $sql="SELECT *, VNo, Vtype,VDate, SUM(Debit+Credit)/2 as Amount FROM acc_transaction  WHERE VDate='$date' AND VType IN ('DV','JV','CV') GROUP BY VNO, Vtype, VDate ORDER BY VDate";
         
          $query = $this->db->query($sql);
          return $query->result();
    }
    
    public  function get_vouchar_view($date){
        $sql="SELECT acc_income_expence.COAID,SUM(acc_income_expence.Amount) AS Amount, acc_coa.HeadName FROM acc_income_expence INNER JOIN acc_coa ON acc_coa.HeadCode=acc_income_expence.COAID WHERE Date='$date' AND acc_income_expence.IsApprove=1 AND acc_income_expence.Paymode='Cash' GROUP BY acc_income_expence.COAID, acc_coa.HeadName ORDER BY acc_coa.HeadName";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public  function get_cash(){
        $date=date('Y-m-d');


        $sql="SELECT SUM(Debit) as Amount FROM acc_transaction WHERE VDate='$date' AND COAID ='1020101' AND VType NOT IN ('DV','JV','CV') AND IsAppove='1'";
        $query = $this->db->query($sql);
        return $query->row();

    }
    
    public  function get_general_ledger(){

        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('HeadLevel',4);
        $this->db->where('isCashNature',0);
        $this->db->where('isBankNature',0);
        $this->db->order_by('HeadName', 'asc');
        $query = $this->db->get();
        return $query->result();

    }
    
    public function get_transational_head_by_id($Headid){

        $sql="SELECT * FROM acc_coa WHERE HeadCode='$Headid' ";
        $query = $this->db->query($sql);
        $rs=$query->row();
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('HeadLevel',4);
        $this->db->where('pheadcode',$rs->HeadCode);
        $this->db->where('IsActive',1);
        $this->db->order_by('HeadName', 'asc');
        $res = $this->db->get();
        if($res) {
            return $res->result();
        } else {
            return false;
        }
        
    }
    public function voucher_report_serach($vouchar){
        $sql="SELECT SUM(Debit) as Amount FROM acc_transaction WHERE VDate='$vouchar' AND COAID ='1020101' AND VType NOT IN ('DV','JV','CV') AND IsAppove='1'";
        $query = $this->db->query($sql);
        return $query->row();

    }
// get old all financial Year
    public function get_old_financialyear(){
       return $oldyear = $this->db->select('id,yearName')
                       ->from('financial_year')->where('status',0)->order_by('endDate','DESC')->get()->result();

    }

    public function general_led_report_headname($cmbGLCode){
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('HeadCode',$cmbGLCode);
        $query = $this->db->get()->row();
        return $query;
    }


    public function getPredefineCode() {
        return $fields = $this->db->list_fields('acc_predefine_account');        
    }

    public function getPredefineCodeValues() {
        return $result = $this->db->select('*')->from('acc_predefine_account')->get()->row();
    }

    public function getCoaHeads()
    {
         $result = $this->db->select('*')->from('acc_coa')->where('isActive',1)->get()->result();
         $list = array('' => display('select_account'));
         if (!empty($result)) {
             foreach ($result as $value) {
                 $list[$value->HeadCode] = $value->HeadName;
             }
         }
         return $list;
    }

     public function update_content($table,$data,$where) {
         $this->db->where($where)
         ->update($table,$data);
        return true;
    }


public function general_led_report_headname_bysubtype($sub){
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('subType',$sub);
        $this->db->limit(1);
        $query = $this->db->get()->row();
        return $query;
    }


    // transational Account
    public function get_financial_years($id=null) {
        $this->db->select('*');
        $this->db->from('financial_year');
        if($id != null) {
            $this->db->where('id',$id);
        }        
        $this->db->order_by('endDate','DESC');
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            if($id != null) {
                return $result->row();                
            } else {
                return $result->result();
            }
        }
        return false;
   }

// transational Account
public function get_transational_accounts() {
   $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('HeadLevel',4);
        $this->db->order_by('HeadType','Asc');
        $query = $this->db->get()->result();
        return $query;
}


    // get gl head
    public function get_gl_headname($cmbGLCode){
       return $chac = $this->db->select('HeadCode,HeadName')
                       ->from('acc_coa')
                       ->where('HeadCode',$cmbGLCode)->get()->row();
    }


    public function transational_charteraccount2($cmbGLCode) {
      $chac = $this->db->select('HeadName')
                       ->from('acc_coa')
                       ->where('HeadCode',$cmbGLCode)->get()->row();

        $hcode = array();
        $this->db->select('HeadCode, HeadName');
        $this->db->from('acc_coa');
        $this->db->where('pheadcode',$chac->HeadCode);
        $query = $this->db->get()->result();
        if(!empty($query)) {
          foreach($query as $q) {
             array_push($hcode, $q->HeadCode);
          }
        $accid =  implode(',', $hcode);
        return $query;
        }
        return false;
    }

    public function transational_charteraccount($type,$headname) {
      $chac = $this->db->select('HeadName')
                       ->from('acc_coa')
                       ->where('HeadCode',$cmbGLCode)->get()->row();

        $hcode = array();
        $this->db->select('HeadCode, HeadName');
        $this->db->from('acc_coa');
        $this->db->where('pheadcode',$chac->HeadCode);
        $query = $this->db->get()->result();
        if(!empty($query)) {
          foreach($query as $q) {
             array_push($hcode, $q->HeadCode);
          }
        $accid =  implode(',', $hcode);
        return $query;
        }
        return false;
    }

public function get_charter_accounts_by_headNae2($type,$phead) {
    $CharterAccounts = $this->db->select('HeadCode,HeadName')
                       ->from('acc_coa')
                       ->where('HeadType',$type)
                       ->where('pheadcode',$phead)->get()->result();
    return $CharterAccounts;
}
//get Acccount head by assetcode
public function get_charter_accounts_by_assetCode($type,$assetCode) {
    $CharterAccounts = $this->db->select('HeadCode,HeadName,pheadcode, assetCode, depCode,DepreciationRate')
                       ->from('acc_coa')
                       ->where('depCode',$assetCode)
                       ->where('HeadType',$type)->get()->row();
    if($CharterAccounts) {
        return $CharterAccounts;
    } else {
        return false;
    }
}

public function get_charter_accounts_by_headNae($type,$phead, $except = null) {
       $this->db->select('HeadCode,HeadName,pheadcode,assetCode,DepreciationRate,subType');
       $this->db->from('acc_coa');
       $this->db->where('HeadType', $type);
       if($except != null) {
        $this->db->where("HeadCode !=",$except);
       }
       $this->db->where('pheadcode',$phead);
       $CharterAccounts = $this->db->get();
       if($CharterAccounts->num_rows() > 0) {
         return $CharterAccounts->result();
       } else {
        return false;
       }
    
}
public function get_charter_accounts_by_pheadNae($type,$phead, $except = null) {
       $this->db->select('HeadCode,HeadName,pheadcode,assetCode,DepreciationRate,subType');
       $this->db->from('acc_coa');
       $this->db->where('HeadType', $type);
       if($except != null) {
        $this->db->where("HeadCode !=",$except);
       }
       $this->db->where('PHeadName',$phead);
       $CharterAccounts = $this->db->get();
       if($CharterAccounts->num_rows() > 0) {
         return $CharterAccounts->result();
       } else {
        return false;
       }
    
}

public function get_head_summery($type,$phead,$dtpFromDate,$dtpToDate, $resultType) {
    $secondLevel = $this->get_charter_accounts_by_pheadNae($type,$phead);
    $mainHead= array();
    $sumTotal = 0; 
    if($secondLevel) {    
       $secondArray = array();
        foreach($secondLevel as $chac) {
            $subTotal = 0;
            $innerArray = array();
            $thirdLevel = $this->get_charter_accounts_by_headNae($type,$chac->HeadCode);
            if($thirdLevel) {
                $thirdLevelArray = array();
                foreach($thirdLevel as $tdl) {
                    $balance= 0;                     
                    $transationLevel = $this->get_charter_accounts_by_headNae($type,$tdl->HeadCode);

                    if($transationLevel){
                        $tDebit =0; $tCredit = 0;
                        foreach($transationLevel as $trans) {
                            $tval  = $this->get_general_ledger_report($trans->HeadCode,$dtpFromDate,$dtpToDate, 0, 0);
                            if($tval) {
                                foreach($tval as $amounts){
                                    $tDebit += $amounts->debit;
                                    $tCredit += $amounts->credit;
                                }
                            }                            
                        }
                        if($type == 'A' || $type == 'E') {

                            $balance = $tDebit - $tCredit;
                        } else {
                            $balance = $tCredit - $tDebit;
                        }
                       $sumTotal +=  $balance;
                       $subTotal += $balance;
                    }
                    $cdata = array( 'headCode'=>$tdl->HeadCode,
                          'headName'=>$tdl->HeadName,
                          'amount' => $balance
                      );
                   array_push( $innerArray,  $cdata);
                }
            }
            $data = array( 'headCode'=>$chac->HeadCode,
                          'headName'=>$chac->HeadName,
                          'subtotal' => $subTotal,
                          'innerHead'=> $innerArray
                          
                      );  
                      array_push($secondArray,  $data);              
        }
    }
     $maina = array('head'=>$phead,
                    'gtotal'=>  $sumTotal,
                    'nextlevel' =>$secondArray);
    
     array_push($mainHead,  $maina); 
     
     if($resultType==0) {
        return $mainHead;
     }   else if($resultType==1) {
       return $sumTotal;
     }   
    
}
// get monthly transation summery
 private function get_monthly_summery($head, $fyear) {
    $statements = $this->db->select('*')
                           ->from('acc_monthly_balance')
                           ->where('COAID',$head)
                           ->where('fyear',$fyear)->get()->row();
       if( $statements) {
         return  $statements;
       } else {
        return false;
       }

 }


//get monthly Income summery
public function get_monthly_income($type,$phead,$fyear) {
    $secondLevel = $this->get_charter_accounts_by_pheadNae($type,$phead, 401);
    $mainHead= array();
    $sumTotal1  = 0; 
    $sumTotal2  = 0; 
    $sumTotal3  = 0; 
    $sumTotal4  = 0; 
    $sumTotal5  = 0; 
    $sumTotal6  = 0; 
    $sumTotal7  = 0; 
    $sumTotal8  = 0; 
    $sumTotal9  = 0; 
    $sumTotal10 = 0; 
    $sumTotal11 = 0; 
    $sumTotal12 = 0; 
    if($secondLevel) {    
       $secondArray = array();
        foreach($secondLevel as $chac) {
             
            $subTotal1  = 0;
            $subTotal2  = 0;
            $subTotal3  = 0;
            $subTotal4  = 0;
            $subTotal5  = 0;
            $subTotal6  = 0;
            $subTotal7  = 0;
            $subTotal8  = 0;
            $subTotal9  = 0;
            $subTotal10 = 0;
            $subTotal11 = 0;
            $subTotal12 = 0;
            $innerArray = array();
            $thirdLevel = $this->get_charter_accounts_by_headNae($type,$chac->HeadCode);
            if($thirdLevel) {
                $thirdLevelArray = array();
                foreach($thirdLevel as $tdl) {
                    $balance1  = 0;                     
                    $balance2  = 0;                     
                    $balance3  = 0;                     
                    $balance4  = 0;                     
                    $balance5  = 0;                     
                    $balance6  = 0;                     
                    $balance7  = 0;                     
                    $balance8  = 0;                     
                    $balance9  = 0;                     
                    $balance10 = 0;                     
                    $balance11 = 0;                     
                    $balance12 = 0;                     
                    $transationLevel = $this->get_charter_accounts_by_headNae($type,$tdl->HeadCode);

                    if($transationLevel){
                       
                        foreach($transationLevel as $trans) {
                            $tval  = $this->get_monthly_summery($trans->HeadCode,$fyear);
                            if($tval) {
                                $balance1  += $tval->balance1 ;                     
                                $balance2  += $tval->balance2 ;                     
                                $balance3  += $tval->balance3 ;                     
                                $balance4  += $tval->balance4 ;                     
                                $balance5  += $tval->balance5 ;                     
                                $balance6  += $tval->balance6 ;                     
                                $balance7  += $tval->balance7 ;                     
                                $balance8  += $tval->balance8 ;                     
                                $balance9  += $tval->balance9 ;                     
                                $balance10 += $tval->balance10 ;                     
                                $balance11 += $tval->balance11 ;                     
                                $balance12 += $tval->balance12 ; 
                            }                            
                        }
                       
                       $sumTotal1  +=  $balance1;
                       $sumTotal2  +=  $balance2;
                       $sumTotal3  +=  $balance3;
                       $sumTotal4  +=  $balance4;
                       $sumTotal5  +=  $balance5;
                       $sumTotal6  +=  $balance6;
                       $sumTotal7  +=  $balance7;
                       $sumTotal8  +=  $balance8;
                       $sumTotal9  +=  $balance9;
                       $sumTotal10 +=  $balance10;
                       $sumTotal11 +=  $balance11;
                       $sumTotal12 +=  $balance12;
                       $subTotal1  += $balance1;
                       $subTotal2  += $balance2;
                       $subTotal3  += $balance3;
                       $subTotal4  += $balance4;
                       $subTotal5  += $balance5;
                       $subTotal6  += $balance6;
                       $subTotal7  += $balance7;
                       $subTotal8  += $balance8;
                       $subTotal9  += $balance9;
                       $subTotal10 += $balance10;
                       $subTotal11 += $balance11;
                       $subTotal12 += $balance12;
                    }
                    $cdata = array( 'headCode'=>$tdl->HeadCode,
                          'headName' =>$tdl->HeadName,
                          'amount1'  => $balance1,
                          'amount2'  => $balance2,
                          'amount3'  => $balance3,
                          'amount4'  => $balance4,
                          'amount5'  => $balance5,
                          'amount6'  => $balance6,
                          'amount7'  => $balance7,
                          'amount8'  => $balance8,
                          'amount9'  => $balance9,
                          'amount10' => $balance10,
                          'amount11' => $balance11,
                          'amount12' => $balance12,
                      );
                   array_push( $innerArray,  $cdata);
                }
            }
            $data = array( 'headCode' =>$chac->HeadCode,
                          'headName'  =>$chac->HeadName,
                          'subtotal'  => $subTotal1,
                          'subtota2'  => $subTotal2,
                          'subtota3'  => $subTotal3,
                          'subtota4'  => $subTotal4,
                          'subtota5'  => $subTotal5,
                          'subtota6'  => $subTotal6,
                          'subtota7'  => $subTotal7,
                          'subtota8'  => $subTotal8,
                          'subtota9'  => $subTotal9,
                          'subtotal0' => $subTotal10,
                          'subtotal1' => $subTotal11,
                          'subtotal2' => $subTotal12,
                          'innerHead' => $innerArray                          
                      );  
                      array_push($secondArray,  $data);              
        }
    }
     $maina = array('head'         =>  $phead,
                    'gtotal1'      =>  $sumTotal1,
                    'gtotal2'      =>  $sumTotal2,
                    'gtotal3'      =>  $sumTotal3,
                    'gtotal4'      =>  $sumTotal4,
                    'gtotal5'      =>  $sumTotal5,
                    'gtotal6'      =>  $sumTotal6,
                    'gtotal7'      =>  $sumTotal7,
                    'gtotal8'      =>  $sumTotal8,
                    'gtotal9'      =>  $sumTotal9,
                    'gtotal10'     =>  $sumTotal10,
                    'gtotal11'     =>  $sumTotal11,
                    'gtotal12'     =>  $sumTotal12,
                    'nextlevel'    =>  $secondArray);
    
     array_push($mainHead,  $maina);     

        return $mainHead;       
    
}

//get monthly Income summery
public function get_from_secondlevel_expenses($type,$hCode,$fyear) {
        $phead = $this->get_gl_headname($hCode);      
            $secondArray = array(); 
            $subTotal1  = 0;
            $subTotal2  = 0;
            $subTotal3  = 0;
            $subTotal4  = 0;
            $subTotal5  = 0;
            $subTotal6  = 0;
            $subTotal7  = 0;
            $subTotal8  = 0;
            $subTotal9  = 0;
            $subTotal10 = 0;
            $subTotal11 = 0;
            $subTotal12 = 0;
            $thirdLevel = $this->get_charter_accounts_by_headNae($type,$phead->HeadCode);
            if($thirdLevel) {
                $innerArray = array();
                foreach($thirdLevel as $tdl) {
                    $balance1  = 0;                     
                    $balance2  = 0;                     
                    $balance3  = 0;                     
                    $balance4  = 0;                     
                    $balance5  = 0;                     
                    $balance6  = 0;                     
                    $balance7  = 0;                     
                    $balance8  = 0;                     
                    $balance9  = 0;                     
                    $balance10 = 0;                     
                    $balance11 = 0;                     
                    $balance12 = 0;                     
                    $transationLevel = $this->get_charter_accounts_by_headNae($type,$tdl->HeadCode);

                    if($transationLevel){
                       
                        foreach($transationLevel as $trans) {
                            $tval  = $this->get_monthly_summery($trans->HeadCode,$fyear);
                            if($tval) {
                                $balance1  += $tval->balance1 ;                     
                                $balance2  += $tval->balance2 ;                     
                                $balance3  += $tval->balance3 ;                     
                                $balance4  += $tval->balance4 ;                     
                                $balance5  += $tval->balance5 ;                     
                                $balance6  += $tval->balance6 ;                     
                                $balance7  += $tval->balance7 ;                     
                                $balance8  += $tval->balance8 ;                     
                                $balance9  += $tval->balance9 ;                     
                                $balance10 += $tval->balance10 ;                     
                                $balance11 += $tval->balance11 ;                     
                                $balance12 += $tval->balance12 ; 
                            }                            
                        }
                       
                       $sumTotal1  +=  $balance1;
                       $sumTotal2  +=  $balance2;
                       $sumTotal3  +=  $balance3;
                       $sumTotal4  +=  $balance4;
                       $sumTotal5  +=  $balance5;
                       $sumTotal6  +=  $balance6;
                       $sumTotal7  +=  $balance7;
                       $sumTotal8  +=  $balance8;
                       $sumTotal9  +=  $balance9;
                       $sumTotal10 +=  $balance10;
                       $sumTotal11 +=  $balance11;
                       $sumTotal12 +=  $balance12;
                       $subTotal1  += $balance1;
                       $subTotal2  += $balance2;
                       $subTotal3  += $balance3;
                       $subTotal4  += $balance4;
                       $subTotal5  += $balance5;
                       $subTotal6  += $balance6;
                       $subTotal7  += $balance7;
                       $subTotal8  += $balance8;
                       $subTotal9  += $balance9;
                       $subTotal10 += $balance10;
                       $subTotal11 += $balance11;
                       $subTotal12 += $balance12;
                    }
                    $cdata = array( 'headCode'=>$tdl->HeadCode,
                          'headName' =>$tdl->HeadName,
                          'amount1'  => $balance1,
                          'amount2'  => $balance2,
                          'amount3'  => $balance3,
                          'amount4'  => $balance4,
                          'amount5'  => $balance5,
                          'amount6'  => $balance6,
                          'amount7'  => $balance7,
                          'amount8'  => $balance8,
                          'amount9'  => $balance9,
                          'amount10' => $balance10,
                          'amount11' => $balance11,
                          'amount12' => $balance12,
                      );
                   array_push( $innerArray,  $cdata);
                }
            }
            $data = array( 'headCode' =>$hCode,
                          'headName'  =>$phead->HeadName,
                          'subtota1'  => $subTotal1,
                          'subtota2'  => $subTotal2,
                          'subtota3'  => $subTotal3,
                          'subtota4'  => $subTotal4,
                          'subtota5'  => $subTotal5,
                          'subtota6'  => $subTotal6,
                          'subtota7'  => $subTotal7,
                          'subtota8'  => $subTotal8,
                          'subtota9'  => $subTotal9,
                          'subtota10' => $subTotal10,
                          'subtota11' => $subTotal11,
                          'subtota12' => $subTotal12,
                          'innerHead' => $innerArray                          
                      );  
                      array_push($secondArray,  $data);              
              

        return $secondArray;       
    
}

//get monthly Income summery
public function get_fixedasset_report($type,$hCode,$fyear) {
    $fiscalyear = $this->get_financial_years($fyear);
        $phead = $this->get_gl_headname($hCode);      
            $secondArray = array(); 
            $subTotal1 = 0; $subTotal2 = 0; $subTotal3 = 0; $subTotal4 = 0; $subTotal5 = 0; $subTotal6 = 0; $subTotal7 = 0; $subTotal8 = 0; $subTotal9 = 0; $subTotal10 = 0;           
            $thirdLevel = $this->get_charter_accounts_by_headNae($type,$phead->HeadCode);
            if($thirdLevel) {
                $innerArray = array();
                foreach($thirdLevel as $tdl) {
                    $openig        = 0;     
                    $curentDebit   = 0;    
                    $curentCredit  = 0;    
                    $curentValue   = 0; 
                    $depAmount     = 0;   
                    $revOpening    = 0;      
                    $revCredit     = 0;    
                    $revDebit      = 0; 
                    $revBalance    = 0;
                    $famount       = 0;   
                    $transationLevel = $this->get_charter_accounts_by_headNae($type,$tdl->HeadCode);
                    if($transationLevel){                       
                      $transArray= array();
                      foreach($transationLevel as $trans) {
                        $abalence = 0; $bbalence = 0; $cbalence = 0; $dbalence = 0;$ebalence = 0;
                        $fbalence = 0;$gbalence = 0; $hbalence = 0;$ibalence = 0; $jbalence = 0;
                        $deprate = 0;
                        $depreciatio = $this->get_charter_accounts_by_assetCode($type,$trans->assetCode);
                        $lastbalance = $this->get_last_year_balance($type,$trans->HeadCode,$fiscalyear->startDate , $fiscalyear->endDate);
                            if($lastbalance) {
                                 $abalence += $lastbalance;
                            }
                            $tval  = $this->get_general_ledger_report($trans->HeadCode,$fiscalyear->startDate, $fiscalyear->endDate, 0, 0);
                            if($tval) {
                                foreach($tval as $amounts){
                                    $bbalence += $amounts->debit;
                                    $cbalence += $amounts->credit;
                                }
                            }                             
                            if($depreciatio) {
                                $lastrevbalance = $this->get_last_year_balance($type,$depreciatio->HeadCode,$fiscalyear->startDate , $fiscalyear->endDate);
                                if($lastrevbalance) {
                                   $fbalence += $lastrevbalance;
                                }  
                                $rtval  = $this->get_general_ledger_report($trans->HeadCode,$fiscalyear->startDate, $fiscalyear->endDate, 0, 0);
                                if($rtval) {
                                    foreach($rtval as $revamount){
                                        $hbalence += $revamount->debit;
                                        $gbalence += $revamount->credit;
                                    }
                                }  
                            } else {

                            }                       
                            
                            $dbalence += $abalence + ($bbalence - $cbalence);
                            if($trans->DepreciationRate != 0) {
                                $ebalence += $dbalence * ($trans->DepreciationRate / 100);
                                $deprate = $trans->DepreciationRate;
                            }                            
                            $ibalence += $fbalence + ($gbalence - $hbalence);      
                            $jbalence += ($dbalence - $ibalence);

                         $openig         += $abalence;
                         $curentDebit    += $bbalence;
                         $curentCredit   += $cbalence;
                         $curentValue    += $dbalence;
                         $depAmount      += $ebalence;
                         $revOpening     += $fbalence;
                         $revCredit      += $gbalence;
                         $revDebit       += $hbalence;
                         $revBalance     += $ibalence;
                         $famount        += $jbalence;
                          
                          $trdata = array( 
                           'headCode'      =>$trans->HeadCode,
                           'headName'      =>$trans->HeadName,                          
                           'openig'        => $abalence,                          
                           'curentDebit'   => $bbalence,                          
                           'curentCredit'  => $cbalence,                          
                           'curentValue'   => $dbalence,                         
                           'depRate'       => $deprate,                         
                           'depAmount'     => $ebalence,                          
                           'revOpening'    => $fbalence,                          
                           'revCredit'     => $gbalence,                          
                           'revDebit'      => $hbalence,                          
                           'revBalance'    => $ibalence,                          
                           'famount'       => $jbalence                       
                      );
                   array_push( $transArray,  $trdata);
                    }                       
                       
                         $subTotal1   +=  $openig;                        
                         $subTotal2   +=  $curentDebit;                        
                         $subTotal3   +=  $curentCredit;                        
                         $subTotal4   +=  $curentValue;                        
                         $subTotal5   +=  $depAmount;                        
                         $subTotal6   +=  $revOpening;                        
                         $subTotal7   +=  $revCredit;                        
                         $subTotal8   +=  $revDebit;                        
                         $subTotal9   +=  $revBalance;                        
                         $subTotal10  +=  $famount;                        
                    }
                    $cdata = array( 
                           'headCode'      =>$tdl->HeadCode,
                           'headName'      =>$tdl->HeadName,                          
                           'openig'        => $openig,                          
                           'curentDebit'   => $curentDebit,                          
                           'curentCredit'  => $curentCredit,                          
                           'curentValue'   => $curentValue,                         
                           'depAmount'     => $depAmount,                          
                           'revOpening'    => $revOpening,                          
                           'revCredit'     => $revCredit,                          
                           'revDebit'      => $revDebit,                          
                           'revBalance'    => $revBalance,                          
                           'famount'       => $famount ,
                           'innerHead'       => $transArray ,

                      );
                   array_push( $innerArray,  $cdata);
                }
            }
            $data = array( 'headCode'  =>$hCode,
                          'headName'   =>$phead->HeadName,
                          'subtotal1'  => $subTotal1,                          
                          'subtotal2'  => $subTotal2,                          
                          'subtotal3'  => $subTotal3,                          
                          'subtotal4'  => $subTotal4,                          
                          'subtotal5'  => $subTotal5,                          
                          'subtotal6'  => $subTotal6,                          
                          'subtotal7'  => $subTotal7,                          
                          'subtotal8'  => $subTotal8,                          
                          'subtotal9'  => $subTotal9,                          
                          'subtotal10' => $subTotal10,                          
                          'nextlevel'  => $innerArray                          
                      );  
                      array_push($secondArray,  $data); 
        return $secondArray;   
}

// get previoue financial year name
 public function get_previous_financial_year($numYear){
      $fyearStartDate = $this->session->userdata('fyearStartDate');
      $fyearEndDate = $this->session->userdata('fyearEndDate');
      $yearArray = array();
      for($i=1; $i <= $numYear; $i++ ) {
        $previousStartDate = date('Y-m-d',strtotime($fyearStartDate. ' -'.$i.' year'));
        $previousEnddate = date('Y-m-d',strtotime($fyearEndDate. ' -'.$i.' year'));
        $fyear =  $this->db->select('yearName')->from('financial_year')->where('startDate',$previousStartDate)->where('endDate',$previousEnddate)->get()->row();
         if($fyear) {
            array_push($yearArray,$fyear->yearName );
         }     
      }
      return $yearArray; 
    }


private function get_last_year_balance($type,$HeadCode,$fstartDate , $fendDate)
{
      $previousStartDate = date('Y-m-d',strtotime($fstartDate. ' -1 year'));
      $previousEnddate = date('Y-m-d',strtotime($fendDate. ' -1 year'));
      $fyear =  $this->db->select('id')->from('financial_year')->where('startDate',$previousStartDate)->where('endDate',$previousEnddate)->get()->row();
      $oldbalanced = $this->db->select('Debit, Credit')->from('acc_opening_balance')->where('COAID',$HeadCode)->where('fyear',$fyear->id)->get()->row();
      if($oldbalanced) {
            if($type == 'A') {
              if($oldbalanced->Debit > $oldbalanced->Credit) {
                return $oldbalanced->Debit;
              } else if($oldbalanced->Credit > $oldbalanced->Debit) {
                 return '-'.$oldbalanced->Credit;
              } else {
                return 0 ;
              }

           } else {
             if($oldbalanced->Debit > $oldbalanced->Credit) {
                return '-'.$oldbalanced->Debit;
              } else if($oldbalanced->Credit > $oldbalanced->Debit) {
                 return $oldbalanced->Credit;
              } else {
                return 0 ;
              }                  
            } 
      }  else {
         return 0;        
     } 
}


// get previoue year balanc sheet amount by account head
 private function get_previous_year_balance_sheet($cid,$type, $numYear){
      $fyearStartDate = $this->session->userdata('fyearStartDate');
      $fyearEndDate = $this->session->userdata('fyearEndDate');
      $previousStartDate = date('Y-m-d',strtotime($fyearStartDate. ' -'.$numYear.' year'));
      $previousEnddate = date('Y-m-d',strtotime($fyearEndDate. ' -'.$numYear.' year'));
      $fyear =  $this->db->select('id')->from('financial_year')->where('startDate',$previousStartDate)->where('endDate',$previousEnddate)->get()->row();
      $oldbalanced = $this->db->select('Debit, Credit')->from('acc_opening_balance')->where('COAID',$cid)->where('fyear',$fyear->id)->get()->row();
      if($oldbalanced) {
            if($type == 'A') {
              if($oldbalanced->Debit > $oldbalanced->Credit) {
                return $oldbalanced->Debit;
              } else if($oldbalanced->Credit > $oldbalanced->Debit) {
                 return '-'.$oldbalanced->Credit;
              } else {
                return 0 ;
              }

           } else {
             if($oldbalanced->Debit > $oldbalanced->Credit) {
                return '-'.$oldbalanced->Debit;
              } else if($oldbalanced->Credit > $oldbalanced->Debit) {
                 return $oldbalanced->Credit;
              } else {
                return 0 ;
              }                  
            }   

      } else {
        return 0;
      }          
    }

// Get balance sheet report
public function get_balancedheet_summery($type,$phead,$dtpFromDate,$dtpToDate) {
    $returnarning = $this->db->select('CPLCode')->from('acc_predefine_account')->get()->row(); 
     
    $secondLevel = $this->get_charter_accounts_by_pheadNae($type,$phead);
    $mainHead= array();
    $sumTotal = 0; 
    $sumTotal1 = 0; 
    $sumTotal2 = 0; 
    $sumTotal3 = 0; 
    if($secondLevel) {    
       $secondArray = array();
        foreach($secondLevel as $chac) {
            $subTotal = 0;
            $subTotal1 = 0;
            $subTotal2 = 0;
            $subTotal3 = 0;
            $innerArray = array();
            $thirdLevel = $this->get_charter_accounts_by_headNae($type,$chac->HeadCode);
            if($thirdLevel) {
                $thirdLevelArray = array();
                foreach($thirdLevel as $tdl) {
                    $balance= 0; 
                    $returnern = 0;
                    $secondbalance =0; 
                    $thirdbalance=0;  
                    $fourthbalance=0;                 
                    $transationLevel = $this->get_charter_accounts_by_headNae($type,$tdl->HeadCode);

                    if($transationLevel){
                        $tbalence =0;$tDebit =0; $tCredit = 0; $scyear=0; $tdyear=0;$fryear=0;
                        foreach($transationLevel as $trans) {
                           // $tval  = $this->get_general_ledger_report($trans->HeadCode,$dtpFromDate,$dtpToDate, 0, 0);
                            $tval  = $this->get_clossing_balance($trans->HeadCode,$dtpToDate);
                            if($tval) {
                                $tbalence += $tval;                               
                            } 
                            $scyear += $this->get_previous_year_balance_sheet($trans->HeadCode,$type, 1); 
                            $tdyear += $this->get_previous_year_balance_sheet($trans->HeadCode,$type, 2);
                            $fryear += $this->get_previous_year_balance_sheet($trans->HeadCode,$type, 3);
                            if($returnarning->CPLCode == $trans->HeadCode) {
                                $income = $this->get_head_summery('I','Income',$dtpFromDate,$dtpToDate,1); 
                                $expense = $this->get_head_summery('E','Expenses',$dtpFromDate,$dtpToDate,1);
                                $returnern += ($income - $expense);
                             } 
                        }                        
                        if($returnern != 0) {
                            $balance = $tbalence + $returnern;
                        } else {
                           $balance = $tbalence; 
                        }


                        $secondbalance = $scyear; 
                        $thirdbalance  = $tdyear;  
                        $fourthbalance = $fryear;
                        $sumTotal   +=  $balance;
                        $sumTotal1  +=  $secondbalance;
                        $sumTotal2  +=  $thirdbalance;
                        $sumTotal3  +=  $fourthbalance;
                        $subTotal   +=  $balance;
                        $subTotal1  += $secondbalance;
                        $subTotal2  += $thirdbalance;
                        $subTotal3  += $fourthbalance;
                    }
                    $cdata = array( 'headCode'=>$tdl->HeadCode,
                          'headName'=>$tdl->HeadName,
                          'amount' => $balance,
                          'secondyear' => $secondbalance,
                          'thirdyear' =>  $thirdbalance,
                          'fourthyear' => $fourthbalance,
                      );
                   array_push( $innerArray,  $cdata);
                }
            }
            $data = array( 'headCode' => $chac->HeadCode,
                          'headName'  => $chac->HeadName,
                          'subtotal'  => $subTotal,
                          'ssubtotal' => $subTotal1,
                          'tsubtotal' => $subTotal2,
                          'fsubtotal' => $subTotal3,
                          'innerHead' => $innerArray
                          
                      );  
                      array_push($secondArray,  $data);
              
        }
    }
     $maina = array('head'      =>  $phead,
                    'gtotal'    =>  $sumTotal,
                    'sgtotal'   =>  $sumTotal1,
                    'tgtotal'   =>  $sumTotal2,
                    'fgtotal'   =>  $sumTotal3,
                    'nextlevel' =>  $secondArray);
    
     array_push($mainHead,  $maina);      
    return $mainHead;
}

// year_closing


public function check_one($type,$phead,$dtpFromDate,$dtpToDate) {

return $secondLevel = $this->get_charter_accounts_by_pheadNae($type,$phead);

}


public function year_closing_summery($type,$phead,$dtpFromDate,$dtpToDate,$fyear) {
   

    $returnarning = $this->db->select('LPLCode')->from('acc_predefine_account')->get()->row(); 
    $CreateBy=$this->session->userdata('id');
    $createdate=date('Y-m-d H:i:s');  
    $openDate = date('Y-m-d', strtotime($dtpToDate . ' +1 day'));    
    $secondLevel = $this->get_charter_accounts_by_pheadNae($type,$phead);  
    $sta= array();  
    if($secondLevel) { 
        foreach($secondLevel as $chac) {
             $thirdLevel = $this->get_charter_accounts_by_headNae($type,$chac->HeadCode);
            if($thirdLevel) { 
                foreach($thirdLevel as $tdl) {  
                    $transationLevel = $this->get_charter_accounts_by_headNae($type,$tdl->HeadCode);
                    if($transationLevel){
                        foreach($transationLevel as $trans){
                            $Damnt = 0 ;
                            $Camnt = 0;
                            if($trans->subType == 1) {
                                $tval  = $this->get_clossing_balance($trans->HeadCode,$dtpToDate);                                
                                if($tval) {                                     
                                    if($type == 'A') {
                                        $Camnt =  0 ;
                                        $Damnt = $tval;
                                    } else {
                                        $Damnt = 0 ;
                                        $Camnt = $tval;
                                    }                              
                                } 
                                $openingbalancetinsert = array(     
                                  'fyear'          =>  $fyear,
                                  'COAID'          =>  $returnarning->LPLCode,     
                                  'subType'        =>  1,     
                                  'subCode'        =>  null,     
                                  'openDate'       =>  $openDate,
                                  'Debit'          =>  $Damnt,
                                  'Credit'         =>  $Camnt,     
                                  'CreateBy'       =>  $CreateBy,
                                  'CreateDate'     =>  $createdate,    
                                );  
                                $openin = $this->insert_openingBalance_by_closing($openingbalancetinsert);

                            } else {
                                $subcodes  =  $this->getSubcode($trans->subType);
                                if($subcodes) {
                                    
                                    foreach($subcodes as $subcode) {
                                        $tval  = $this->get_clossing_balance($trans->HeadCode,$dtpToDate,$dtpToDate,$trans->subType,$subcode->id);
                                        if($tval) {                                            
                                            if($type   == 'A') {
                                                $Camnt =  0 ;
                                                $Damnt = $tval;
                                            } else {
                                                $Damnt = 0 ;
                                                $Camnt = $tval;
                                            }                              
                                        } 
                                        $openingbalancetinsert = array(     
                                          'fyear'          =>  $fyear,
                                          'COAID'          =>  $returnarning->LPLCode,     
                                          'subType'        =>  $trans->subType,     
                                          'subCode'        =>  $subcode->id,     
                                          'openDate'       =>  $openDate,
                                          'Debit'          =>  $Damnt,
                                          'Credit'         =>  $Camnt,     
                                          'CreateBy'       =>  $CreateBy,
                                          'CreateDate'     =>  $createdate,    
                                        ); 
                                       $openin = $this->insert_openingBalance_by_closing($openingbalancetinsert);
                                    }
                                } 
                            }
                            if($returnarning->LPLCode == $trans->HeadCode) {
                                $income = $this->get_head_summery('I','Income',$dtpFromDate,$dtpToDate,1); 
                                $expense = $this->get_head_summery('E','Expenses',$dtpFromDate,$dtpToDate,1);
                                if($income > $expense) {
                                     $Camnt =  $income - $expense ;
                                     $Damnt = 0;
                                 } else {
                                     $Damnt =  $income - $expense ;
                                     $Camnt = 0;
                                 }
                                $openingbalancetinsert = array(     
                                  'fyear'          =>  $fyear,
                                  'COAID'          =>  $returnarning->LPLCode,     
                                  'subType'        =>  1,     
                                  'subCode'        =>  null,     
                                  'openDate'       =>  $openDate,
                                  'Debit'          =>  $Damnt,
                                  'Credit'         =>  $Camnt,     
                                  'CreateBy'       =>  $CreateBy,
                                  'CreateDate'     =>  $createdate,      
                                ); 
                               $openin = $this->insert_openingBalance_by_closing($openingbalancetinsert);     
                            } 
                        }
                    }
                }
            }
        }

    }
    
    return true;
}



//Get old year clossing balance
    public function get_old_year_closingBalance($hCode,$year,$hType=null,$subtype=1,$subcode= null) {      
       $this->db->select('SUM(Debit) as Debit, SUM(Credit) as Credit');
       $this->db->from('acc_opening_balance');
       if($subtype != 1 & $subcode != null) {
          $this->db->where('subCode',$subcode);
          $this->db->where('subType',$subtype);
       } 
        $this->db->where('COAID',$hCode);      
       
       $this->db->where('fyear',$year);            
      $closing =  $this->db->get();
      if($closing->num_rows() > 0) {
        $closingvalue = $closing->row();
        if($hType == 'A') {
           return ($closingvalue->Debit -  $closingvalue->Credit);
        } else {
          return ($closingvalue->Credit -  $closingvalue->Debit);
        }        
      }
      return false;
   }

 public function get_opening_balance_subtype($hCode,$dtpFromDate,$dtpToDate,$subtype=1,$subcode=null){  
                    $coaHead = $this->general_led_report_headname($hCode); 

                    $fyearStartDate = $this->session->userdata('fyearStartDate');
                    $fyearEndDate = $this->session->userdata('fyearEndDate');
                    $oldDate = date('Y-m-d',strtotime($dtpFromDate. ' -1 year'));
                    $prevDate = date('Y-m-d', strtotime($dtpFromDate .' - 1day'));
              
                if($coaHead->HeadType == 'L' || $coaHead->HeadType =='A') {                 
                    if($dtpFromDate >= $fyearStartDate && $dtpFromDate <= $fyearEndDate) { 
                        $fyear = $this->db->select('*')->from('financial_year')->where('startDate <=',$oldDate)->where('endDate >=',$oldDate)->get()->row();
                       
                    } else {                   
                        $fyear = $this->db->select('*')->from('financial_year')->where('startDate <=',$oldDate)->where('endDate >=',$oldDate)->get()->row();
                    }  

                        $oldBalance = $this->get_old_year_closingBalance($hCode,$fyear->id,$coaHead->HeadType,$subtype, $subcode);
                } else {
                    $oldBalance =0;
               } 
              $opening =  $this->get_general_ledger_report($hCode,$fyearStartDate,$prevDate,0,0,$subtype,$subcode);

              if($opening) {
                 foreach($opening as $open) {
                     if($coaHead->HeadType == 'A' || $coaHead->HeadType == 'E') {
                         $balance= ($open->debit - $open->credit);
                      } else {
                         $balance=($open->credit - $open->debit);
                      }
                  }
                 
              } else {
                $balance= 0;
              }   
        return $newBalance = $oldBalance + $balance ; 
                         
    }





//Get Opening balance
     public function get_opening_balance($hCode,$dtpFromDate,$dtpToDate){  
               $coaHead = $this->general_led_report_headname($hCode); 

                    $fyearStartDate = $this->session->userdata('fyearStartDate');
                    $fyearEndDate = $this->session->userdata('fyearEndDate');
                    $oldDate = date('Y-m-d',strtotime($dtpFromDate. ' -1 year'));
                    $prevDate = date('Y-m-d', strtotime($dtpFromDate .' - 1day'));
              
                if($coaHead->HeadType == 'L' || $coaHead->HeadType =='A') {                 
                    if($dtpFromDate >= $fyearStartDate && $dtpFromDate <= $fyearEndDate) { 
                        $fyear = $this->db->select('*')->from('financial_year')->where('startDate <=',$oldDate)->where('endDate >=',$oldDate)->get()->row();
                       
                    } else {                   
                        $fyear = $this->db->select('*')->from('financial_year')->where('startDate <=',$oldDate)->where('endDate >=',$oldDate)->get()->row();
                    }  
           
                    $oldBalance = $this->get_old_year_closingBalance($hCode,$fyear->id,$coaHead->HeadType,$coaHead->subType);
                } else {
                    $oldBalance =0;
               } 


              $opening =  $this->get_general_ledger_report($hCode,$fyearStartDate,$prevDate,0,0);

              if($opening) {
                 foreach($opening as $open) {
                     if($coaHead->HeadType == 'A' || $coaHead->HeadType == 'E') {
                         $balance= ($open->debit - $open->credit);
                      } else {
                         $balance=($open->credit - $open->debit);
                      }
                 }
                 
              } else {
                $balance= 0;
              }             

        return $newBalance = $oldBalance + $balance ; 
                         
    }
  public function get_monthly_balance($coaid, $fyear) {
           $this->db->select('id');
           $this->db->from('acc_monthly_balance');
           $this->db->where('COAID',$coaid);
           $this->db->where('fyear',$fyear); 
           $res =  $this->db->get();
           if($res->num_rows() > 0) {
              return $res->row();
           } else {
            return false;
           }

  }

    public function get_clossing_balance($hCode,$dtpFromDate,$dtpToDate=null,$subtype=1,$subcode=null,$hType=null) {
           if($dtpToDate!=null) {
            $toDate = $dtpToDate;
           } else {
            $toDate = $dtpFromDate;
           }
           $coaHead = $this->general_led_report_headname($hCode);
           $opening = $this->get_opening_balance($hCode,$dtpFromDate,$toDate);
           $current =  $this->get_general_ledger_report($hCode,$toDate,$toDate,0,0); 
              if($current) {
                 foreach($current as $cur) {
                     if($coaHead->HeadType == 'A' || $coaHead->HeadType == 'E') {
                         $balance= ($cur->debit - $cur->credit);
                      } else {
                         $balance=($cur->credit - $cur->debit);
                      }
                 }
                 
              } else {
                $balance= 0;
              }            
          return  $closingbalance = $opening +  $balance;

    }
    // get openingg balance summery
    public function get_openningSummery($id, $startdate,$enddate) {
     $sumval = 0;
     $headItem = $this->get_transational_head_by_id($id);
     if($headItem) { 
        foreach($headItem as $row) {
           $balance = $this->get_opening_balance($row->HeadCode, $startdate, $enddate);
           if($balance) {
             $sumval += $balance;
           }
        }
      }
      return $sumval;
    }
    // get clossing balance summery
    public function get_clossingSummery($id, $reportDate) {
     $sumval = 0;
     $headItem = $this->get_transational_head_by_id($id);
     if($headItem) { 
        foreach($headItem as $row) {
           $balance = $this->get_clossing_balance($row->HeadCode,$reportDate);
           if($balance) {
             $sumval += $balance;
           }
        }
      }
      return $sumval;
    }
    public function get_receipt_payment_head($phead, $accountID) {
           $this->db->select('*');
           $this->db->from('acc_coa');
           $this->db->where('pheadcode',$phead);
           $this->db->where('IsActive',1); 
           if($accountID) {
            $this->db->where_in('HeadCode',$accountID); 
           }
           $res =  $this->db->get();
           if($res->num_rows() > 0) {
              return $res->result();
           } else {
            return false;
           }
    }public function get_chartered_account_by_level($level) {
           $this->db->select('*');
           $this->db->from('acc_coa');
           $this->db->where('HeadLevel',$level);
           $this->db->where('IsActive',1); 
           $res =  $this->db->get();
           if($res->num_rows() > 0) {
              return $res->result();
           } else {
            return false;
           }
    }
    private function get_all_transational_voucher($reportType,$startDate,$endDate,$vType) {
           $this->db->distinct();
           $this->db->select('COAID');
           $this->db->from('acc_transaction');
           $this->db->where('VDate >=',$startDate);
           $this->db->where('VDate <=',$endDate); 
           if($vType =='DV') {
            $this->db->where('Debit !=',0.00);  
            }   else {
                $this->db->where('Credit !=',0.00);  
            }  
           if( $reportType =='Accrual Basis') {
           $this->db->group_start();
           $this->db->where('Vtype',$vType);
           $this->db->or_where('Vtype',"JV");
           $this->db->group_end();             
           } else {
            $this->db->where('Vtype',$vType);
           }
           $res =  $this->db->get();
           if($res->num_rows() > 0) {
              $transationarray= array();
              foreach ($res->result() as  $value) {
                  array_push($transationarray, $value->COAID);
              }              
              return $transationarray; 
           } else {
            return false;
           }

    }
  //
    public function get_item_ledger_receipt_payment($reportType,$startDate,$endDate,$vType)
     {
        $vaucherhead = $this->get_all_transational_voucher($reportType,$startDate,$endDate,$vType);
        $thirdhead = $this->get_chartered_account_by_level(3);
        if($thirdhead) { 
           $finalarray= array();
            foreach($thirdhead as $third) {
            $paymentHead = $this->get_receipt_payment_head($third->HeadCode, $vaucherhead);
            if($paymentHead) { 
                $subtotal = 0;
              $paymentheadarray = array();
              foreach($paymentHead as $payhead) { $dbalance=0; $cbalance = 0;
              $headBalance = $this->get_general_ledger_report($payhead->HeadCode,$startDate,$endDate,0,0);
              if($headBalance) { 
                foreach($headBalance as $balance) {       
                    if($vType == 'DV') {
                       $dbalance += $balance->debit;
                       $subtotal += $balance->debit;
                    } else if($vType == 'CV') {
                        $cbalance += $balance->credit;
                        $subtotal += $balance->credit;
                    }

                }
                $darray = array('code' => $payhead->HeadCode,
                              'headName' =>$payhead->HeadName,
                              'debit' =>$dbalance,
                              'credit' =>$cbalance
                             );
                   array_push($paymentheadarray, $darray);

              }

             
            }
             if(count($paymentheadarray) > 0) {
                $parray= array('hcode' => $third->HeadCode,
                              'headName' =>$third->HeadName,
                              'innerHead' =>$paymentheadarray,
                              'subtotal' =>$subtotal,

                              

             );
             array_push($finalarray,$parray );

             }
             
            }

           }

        } 
      return $finalarray;

     }

public function store_transation_summery($coaid, $date) {     
    $curentmonth = date('n',  strtotime($date));
    $fyear = $this->session->userdata('fyear');
    $summery =  $this->get_clossing_balance($coaid,$date);
    $oldrecord = $this->get_monthly_balance($coaid,$fyear);   
    $data=array(
        'fyear' =>  $fyear,
        'COAID' =>  $coaid,
        'balance'.$curentmonth =>  $summery,       
        'updatedDate' =>  date('Y-m-d h:i:s')        
     );

    if(!$oldrecord) {
        $up = $this->db->insert('acc_monthly_balance',$data);
    } else {
         $this->db->where('COAID',$coaid);
         $this->db->where('fyear',$fyear); 
         $up = $this->db->update('acc_monthly_balance',$data);
    }
    if($up) {
        return true;
    } else {
        return false;
    }
}

  // Delete Voucher
   public function deleteVoucher($vno) {
     $this->db->where('VNo', $vno);
     $del = $this->db->delete('acc_vaucher');
     if($del) {
        return true;
     }
     return false;
   }

// Reverse Voucher
   public function reverseVoucher($vno) {
    $vaucherdata = $this->db->select('*')
                 ->from('acc_vaucher')
                 ->where('VNo',$vno)
                 ->get()->result();
     $this->db->where('VNo', $vno);
     $del = $this->db->delete('acc_transaction');
     $updatedBy=$this->session->userdata('id');
     $updateddate=date('Y-m-d H:i:s');
     $uparray = array(
                 'isApproved'  => 0,
                 'status'      => 0,
                 'UpdateBy'    => $updatedBy, 
                 'UpdateDate'  => $updateddate, 
             );     
     if($del) {
        $this->db->where('VNo', $vno);
        $up = $this->db->update('acc_vaucher', $uparray);
        if($up) {
            if($vaucherdata) {
                foreach($vaucherdata as $row) {  
                  $store = $this->store_transation_summery($row->COAID, $row->VDate);
                  $store2 = $this->store_transation_summery($row->RevCodde, $row->VDate);                
                }
                if($store) {
                   return true;
                } else {
                   return false;
                } 
            }
        }        
    }
     return false;
}

   // get general ledger report
    public function get_general_ledger_report($cmbCode,$dtpFromDate,$dtpToDate, $chkIsTransction, $isfyear=0,$subtype=1, $subcod=null){
             if($chkIsTransction == 1) {
                $this->db->select('acc_transaction.VNo,acc_transaction.COAID,, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Narration, acc_transaction.ledgerComment, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID,acc_coa.HeadName, acc_coa.PHeadName,acc_coa.pheadcode, acc_coa.HeadType');
                $this->db->from('acc_transaction');
                $this->db->join('acc_coa','acc_transaction.RevCodde = acc_coa.HeadCode', 'left');                
                if($subtype!=1 && $subcod != null ) {
                 $this->db->join('acc_subtype st','acc_transaction.subType = st.id', 'left');
                 $this->db->join('acc_subcode sc','acc_transaction.subCode = sc.id', 'left');
                 $this->db->where('acc_transaction.subType',$subtype);
                 $this->db->where('acc_transaction.subCode',$subcod);
                } 
                $this->db->where('acc_transaction.COAID',$cmbCode);                
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('VDate BETWEEN "'.$dtpFromDate. '" and "'.$dtpToDate.'"');               
                if($isfyear!=0) {
                  $this->db->where('acc_transaction.fyear',$this->session->userdata('fyear')); 
                }                
   
                $this->db->order_by('acc_transaction.VDate','Asc');
                $this->db->order_by('acc_transaction.Vtype','Asc');
                $query = $this->db->get();

                return $query->result();

             } else {
                $this->db->select('COAID, Vtype, sum(Debit) as debit, sum(Credit) as credit ');
                $this->db->from('acc_transaction');               
                $this->db->where('IsAppove',1);
                $this->db->where('VDate BETWEEN "'.$dtpFromDate. '" and "'.$dtpToDate.'"');
                $this->db->where('COAID',$cmbCode);
                if($isfyear!=0) {
                  $this->db->where('acc_transaction.fyear',$this->session->userdata('fyear')); 
                }
                $query = $this->db->get(); 
            
                return $query->result();
             }       
    }



    public function general_led_report_trialbalance($cmbCode,$dtpFromDate,$dtpToDate,$chkIsTransction=null){

       
                $this->db->select('acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Narration, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID,acc_coa.HeadName, acc_coa.PHeadName, acc_coa.pheadcode, acc_coa.HeadType');
                $this->db->from('acc_transaction');
                $this->db->join('acc_coa','acc_transaction.RevCodde = acc_coa.HeadCode', 'left');
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('VDate BETWEEN "'.$dtpFromDate. '" and "'.$dtpToDate.'"');
                $this->db->where('acc_transaction.COAID',$cmbCode);
                $this->db->where('acc_transaction.fyear',$this->session->userdata('fyear')); 
  
                $this->db->order_by('acc_transaction.VDate','Asc');
                $this->db->order_by('acc_transaction.Vtype','Asc');
                $query = $this->db->get();

                return $query->result_array();
           
    }


    public function general_led_report_headname2($cmbCode,$dtpFromDate,$dtpToDate,$chkIsTransction=null){

           if($chkIsTransction){
       
                $this->db->select('acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Narration, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID,acc_coa.HeadName, acc_coa.PHeadName,acc_coa.pheadcode, acc_coa.HeadType');
                $this->db->from('acc_transaction');
                $this->db->join('acc_coa','acc_transaction.COAID = acc_coa.HeadCode', 'left');
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('VDate BETWEEN "'.$dtpFromDate. '" and "'.$dtpToDate.'"');
                $this->db->where('acc_transaction.COAID',$cmbCode);
                $this->db->where('acc_transaction.fyear',$this->session->userdata('fyear'));       
                $this->db->order_by('acc_transaction.VDate','Asc');
                $this->db->order_by('acc_transaction.ID','Asc');
                $query = $this->db->get();

                return $query->result();
            }
            else{

                $this->db->select('acc_transaction.COAID, acc_transaction.VNo, acc_transaction.Debit, acc_transaction.Credit, acc_coa.HeadName, acc_transaction.IsAppove, acc_transaction.VDate, acc_coa.PHeadName,acc_coa.pheadcode, acc_coa.HeadType');
                $this->db->from('acc_transaction');
                $this->db->join('acc_coa','acc_transaction.COAID = acc_coa.HeadCode', 'left');
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('VDate BETWEEN "'.$dtpFromDate. '" and "'.$dtpToDate.'"');
                $this->db->where('acc_transaction.COAID',$cmbCode);
                $this->db->where('acc_transaction.fyear',$this->session->userdata('fyear'));  
                $this->db->order_by('acc_transaction.VDate','Asc');
                $this->db->order_by('acc_transaction.ID','Asc');
                $query = $this->db->get();

                return $query->result();
            }

    }
    // prebalance calculation
      public function general_led_report_prebalance($cmbCode,$dtpFromDate){

                $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
                $this->db->from('acc_transaction');
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('VDate < ',$dtpFromDate);
                $this->db->where('acc_transaction.COAID',$cmbCode);
                $query = $this->db->get()->row();
                return $balance=$query->predebit - $query->precredit;

    }

    public function get_status(){

        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('IsTransaction',1);
        $this->db->like('HeadCode','1020102','after');
        $this->db->order_by('HeadName', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

 public function get_all_bank(){

        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('isBankNature',1);       
        $this->db->order_by('HeadName', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
 

public function get_all_cash(){

        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('isCashNature',1);       
        $this->db->order_by('HeadName', 'asc');
        $query = $this->db->get();
        return $query->result();
    }


 public function get_predefined_head($field){

        $this->db->select($field);
        $this->db->from('acc_predefine_account');
        $this->db->limit(1);       
        $query = $this->db->get()->row();
        return $query->$field;
    }
   
    // get account subtype 
    public function getsubTypeData($id=null) {
        $this->db->select('*');
        $this->db->from('acc_subtype');
        if($id != null) {
          $this->db->where('id',$id);
        }        
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
           return $query->result();
        }
        return false;
    }

 // get account subtype 
    public function getsubTypeDatahasSubcode() {
        $this->db->distinct();
        $this->db->select('st.id, st.subtypeName');
        $this->db->from('acc_subtype st'); 
        $this->db->join('acc_subcode sc', 'sc.subTypeId = st.id');           
        $this->db->order_by('st.id', 'asc');
        $query = $this->db->get();       
        if($query->num_rows() > 0) {
           return $query->result();
        }
        return false;
    }

// get subcode account 
    public function get_subaccount($id= null) {
        $this->db->distinct();
        $this->db->select('sc.*, st.subtypeName');
        $this->db->from('acc_subcode sc'); 
        $this->db->join('acc_subtype st', 'sc.subTypeId = st.id ');  
        if($id != null) {
          $this->db->where('sc.id',$id);
        }         
        $this->db->order_by('st.id', 'asc');
        $query = $this->db->get();       
        if($query->num_rows() > 0) {
           if($id != null) {
             return $query->row();
           } else {
            return $query->result();
           }
        }
        return false;
    }




// get sub ledger head 
    public function get_subcode_byid($id) {       
        $this->db->select('id,name');
        $this->db->from('acc_subcode'); 
        $this->db->where('id',$id);      
        $this->db->limit(1);
        $query = $this->db->get();       
        if($query->num_rows() > 0) {
           return $query->row();
        }
        return false;
    }

public function get_account_head_by_subtype($id) {
     $result =  $this->db->select('HeadCode,HeadName')
      ->from('acc_coa')
      ->where('subType',$id)
      ->get(); 
      if($result->num_rows() > 0) {
        return $result->result();
      } else {
        return false;
      }
}

     //Profict loss report search
    public function profit_loss_serach(){
       
        $sql="SELECT * FROM acc_coa WHERE acc_coa.HeadType='I'";
        $sql1 = $this->db->query($sql);

        $sql="SELECT * FROM acc_coa WHERE acc_coa.HeadType='E'";
        $sql2 = $this->db->query($sql);
        
        $data = array(
          'oResultAsset'     => $sql1->result(),
          'oResultLiability' => $sql2->result(),
        );
        return $data;
    } 
    public function profit_loss_serach_date($dtpFromDate,$dtpToDate){
       $sqlF="SELECT  acc_transaction.VDate, acc_transaction.COAID, acc_coa.HeadName FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.VDate BETWEEN '$dtpFromDate' AND '$dtpToDate' AND acc_transaction.IsAppove = 1 AND  acc_transaction.COAID LIKE '301%'";
       $query = $this->db->query($sqlF);
       return $query->result();
    }

    public function treeview_selectform($id){
     $data = $this->db->select('*')
            ->from('acc_coa')
            ->where('HeadCode',$id)
            ->get()
            ->row();
            return $data;

    }
     public function get_supplier(){
        $this->db->select('*');
        $this->db->from('supplier_information');
        $this->db->where('status',1);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();  
    }
  

    public function Spayment()
    {
      return  $data = $this->db->select("VNo as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'PM-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->result_array();
         
    }
// customer code
     public function Creceive()
    {
      return  $data = $this->db->select("VNo as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'CR-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->result_array();
    }

public function insert_cashadjustment(){
           $voucher_no = $this->input->post('txtVNo',true);
            $Vtype="AD";
            $amount =$this->input->post('txtAmount',true);
            $type = $this->input->post('type',true);
            if($type == 1){
              $debit = $amount;
              $credit = 0;
            }
            if($type == 2){
              $debit = 0;
              $credit = $amount;
            }
            $VDate = $this->input->post('dtpDate',true);
            $Narration=$this->input->post('txtRemarks',true);
            $IsPosted=1;
            $IsAppove=1;
            $CreateBy=$this->session->userdata('user_id');
           $createdate=date('Y-m-d H:i:s');
            $fyear = $this->db->select("yearName")
            ->from('financial_year')            
            ->where('status', 1) 
            ->limit(1)            
            ->get()
            ->row();
 
     $cc = array(
      'VNo'            =>  $voucher_no,
      'fyear'          =>  $fyear->yearName,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  1020101,
      'Narration'      =>  'Cash Adjustment ',
      'Debit'          =>  $debit,
      'Credit'         =>  $credit,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $CreateBy,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 

              $this->db->insert('acc_transaction',$cc);
          
 return true;

}

//insert bank adjustment
public function insert_bankadjustment(){
           $voucher_no = $this->input->post('txtVNo',true);
           $headname = $this->input->post('bank_name',true);
           $headcode = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$headname)->get()->row()->HeadCode;
            $Vtype="BAD";
            $amount =$this->input->post('txtAmount',true);
            $type = $this->input->post('type',true);
            if($type == 1){
              $debit = $amount;
              $credit = 0;
            }
            if($type == 2){
              $debit = 0;
              $credit = $amount;
            }
            $VDate = $this->input->post('dtpDate');
            $Narration=$this->input->post('txtRemarks',true);
            $IsPosted=1;
            $IsAppove=1;
            $CreateBy=$this->session->userdata('user_id');
           $createdate=date('Y-m-d H:i:s');
            $fyear = $this->db->select("yearName")
            ->from('financial_year')            
            ->where('status', 1) 
            ->limit(1)            
            ->get()
            ->row();
 
     $cc = array(
      'VNo'            =>  $voucher_no,
      'fyear'          =>  $fyear->yearName,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $headcode,
      'Narration'      =>  $Narration,
      'Debit'          =>  $debit,
      'Credit'         =>  $credit,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $CreateBy,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 

              $this->db->insert('acc_transaction',$cc);
          
 return true;

}

/*--------------------------
    | Get voucher details info
    *--------------------------*/
    public function getVoucherDetails($VNo){
        $query = $this->db->select("trans.*, coa.HeadName as dbtcrdHead, rc.HeadName as xy,  CONCAT_WS(' ', emp1.firstname, emp1.lastname) as created_by")
                          ->from('acc_vaucher trans')
                          ->join('acc_coa rc', 'rc.HeadCode = trans.COAID', 'left')
                          ->join('acc_coa coa', 'coa.HeadCode=trans.RevCodde', 'left')                       
                          ->join('user emp1', 'emp1.id=trans.CreateBy', 'left')
                          ->where('trans.VNo', $VNo)
                          ->get()->row();

        if(!empty($query)) {
            $query->details = $this->db->select('trans1.*, acc_coa.HeadName,rv.HeadName as rHead, acc_subcode.name as subname')
                          ->from('acc_vaucher trans1')                          
                          ->join('acc_coa', 'acc_coa.HeadCode=trans1.COAID', 'left')
                          ->join('acc_coa rv', 'rv.HeadCode=trans1.RevCodde', 'left')
                          ->join('acc_subcode', 'acc_subcode.id=trans1.subCode', 'left')
                          ->where('trans1.VNo', $VNo)
                          ->get()->result();
            return  $query;
        }else{
            return false;
        }      
    }



public function supplierinfo($supplier_id){
  return $this->db->select('*')
                  ->from('supplier_information')
                  ->where('supplier_id',$supplier_id)
                  ->get()
                  ->result_array();
}

public function supplierpaymentinfo($voucher_no,$coaid){
  return   $this->db->select('*')
                  ->from('acc_transaction')
                  ->where('VNo',$voucher_no)
                  ->where('COAID',$coaid)
                  ->get()
                  ->result_array();

}



public function banklist(){
  return $this->db->select('*')
                  ->from('bank_information')
                  ->order_by('bank_name','asc')
                  ->get()
                  ->result_array();
}


// =================== Settings data ==============================
public function software_setting_info(){
        $this->db->select('*');
        $this->db->from('web_setting');
        $this->db->where('setting_id', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
}

public function setting()
  {
    return $this->db->get('setting')->row();
  }

    public function paymentparentcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='3' And HeadCode LIKE '10201000%'");
        return $query->row();

       

    }

     public function paymenchildcode(){
         $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '1020102000%'");
        return $query->row();

    }

    public function create_coa($data = [])
    {
        $this->db->insert('acc_coa',$data);
        return $this->db->insert_id();
    }

  // Balance Adjustment
  public function insert_balanceadjustment(){
            $voucher_no = $this->input->post('txtVNo',true);
            $Vtype="ADJ";
            $amount = $this->input->post('amount',true);
            $parenthead = $this->input->post('parent_type',true);
            $parentheadcode = $this->db->select('*')->from('acc_coa')->where('HeadName',$parenthead)->get()->row()->HeadCode;
            $childheadcodes   = $this->input->post('headcode',true);
            $type = $this->input->post('type',true);
            if($type == 1){
              $debit = intval(str_replace(',', '', $amount));
              $credit = 0;
            }
            if($type == 2){
              $debit = 0;
              $credit = intval(str_replace(',', '', $amount));
            }
            $VDate = $this->input->post('dtpDate');
            $Narration=$this->input->post('txtRemarks',true);
            $IsPosted=1;
            $IsAppove=1;
            $CreateBy=$this->session->userdata('user_id');
           $createdate=date('Y-m-d H:i:s');
            $fyear = $this->db->select("yearName")
            ->from('financial_year')            
            ->where('status', 1) 
            ->limit(1)            
            ->get()
            ->row();
 
     $cc = array(
      'VNo'            =>  $voucher_no,
      'fyear'          =>  $fyear->yearName,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  (!empty($childheadcodes)?$childheadcodes:$parentheadcode),
      'Narration'      =>  $Narration,
      'Debit'          =>  $debit,
      'Credit'         =>  $credit,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $CreateBy,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 

    $this->db->insert('acc_transaction',$cc);
          
 return true;

}  
//balance sheet
public function fixed_assets()
    {
             return   $this->db->select('*')
                      ->from('acc_coa')
                      ->where('PHeadName','Assets')
                      ->get()
                      ->result_array();
    }
    public function liabilities_data()
    {
      return   $this->db->select('*')
                      ->from('acc_coa')
                      ->where('PHeadName','Liabilities')
                      ->get()
                      ->result_array();
    }
    public function equity()
    {
      return   $this->db->select('*')
                      ->from('acc_coa')
                      ->where('PHeadName','Equity')
                      ->get()
                      ->result_array();
    }
    public function income_fields()
    {
      return   $this->db->select('*')
                      ->from('acc_coa')
                      ->where('PHeadName','Income')
                      ->get()
                      ->result_array();
    }
    public function expense_fields()
    {
       return   $this->db->select('*')
                      ->from('acc_coa')
                      ->where('PHeadName','Expence')
                      ->get()
                      ->result_array();
    }
    public function assets_info($head_name)
    {
             $this->db->select("*");
             $this->db->from('acc_coa');
             $this->db->where('PHeadName',$head_name);
             $this->db->group_by('HeadCode');
           return  $records = $this->db->get()->result_array();     
    
    } 
    
    public function asset_childs($head_name,$from_date,$to_date)
    {
             $this->db->select("*");
             $this->db->from('acc_coa');
             $this->db->where('PHeadName',$head_name);
             $this->db->group_by('HeadCode');
             $records = $this->db->get()->result_array();  

             return $records;
 
    }
    
    public function assets_balance($head_code,$from_date,$to_date)
    {
             $this->db->select("(sum(Debit)-sum(Credit)) as balance");
             $this->db->from('acc_transaction');
             $this->db->where('COAID',$head_code);
             $this->db->where('VDate >=',$from_date);
             $this->db->where('VDate <=',$to_date);
             $this->db->where('IsAppove',1);
             $records = $this->db->get()->result_array();
             return $records;
    }
    public function assets_balanceac($head_code,$from_date,$to_date)
    {
             $this->db->select("(sum(Debit)-sum(Credit)) as balance");
             $this->db->from('acc_transaction');

             $this->db->where('COAID',$head_code);
             $this->db->where('VDate >=',$from_date);
             $this->db->where('VDate <=',$to_date);
             $this->db->where('IsAppove',1);
             $records = $this->db->get()->result_array();

             return $records;
    }
    public function equity_info($head_name)
    {
    
             $this->db->select("*");
             $this->db->from('acc_coa');
             $this->db->where('PHeadName',$head_name);
           return  $records = $this->db->get()->result_array();   
    
    }
    public function equity_balance($head_code,$from_date,$to_date)
    {
       $this->db->select("(sum(Credit)-sum(Debit)) as balance,COAID");
             $this->db->from('acc_transaction');
             $this->db->where('COAID',$head_code);
             $this->db->where('VDate >=',$from_date);
             $this->db->where('VDate <=',$to_date);
             $this->db->where('IsAppove',1);
           $records = $this->db->get()->result_array(); 
          
           return $records;
    }
    public function liabilities_info($head_name)
    {
    
             $this->db->select("*");
             $this->db->from('acc_coa');
             $this->db->where('PHeadName',$head_name);
             $records = $this->db->get()->result_array(); 

             return $records;
    
    }
    public function liabality_childs($head_name,$from_date,$to_date)
    {
             $this->db->select("*");
             $this->db->from('acc_coa');
             $this->db->where('PHeadName',$head_name);
             $this->db->group_by('HeadCode');
             $records = $this->db->get()->result_array();  

             return $records;
    }
    public function liabilities_balance($head_code,$from_date,$to_date)
    {
       $this->db->select("(sum(Credit)-sum(Debit)) as balance,COAID");
             $this->db->from('acc_transaction');
             $this->db->where('COAID',$head_code);
             $this->db->where('VDate >=',$from_date);
             $this->db->where('VDate <=',$to_date);
             $this->db->where('IsAppove',1);
           return  $records = $this->db->get()->result_array(); 
    }
    public function income_balance($head_code,$from_date,$to_date)
    {
            $this->db->select("(sum(Debit)-sum(Credit)) as balance,COAID");
             $this->db->from('acc_transaction');
             $this->db->where('COAID',$head_code);
             $this->db->where('VDate >=',$from_date);
             $this->db->where('VDate <=',$to_date);
             $this->db->where('IsAppove',1);
             $records = $this->db->get()->result_array(); 

             return $records;
    }
    public function allincome_balance($from_date,$to_date)
    {
            $this->db->select("sum(Credit) as balance,COAID");
             $this->db->from('acc_transaction');
             $this->db->like('COAID','30','after');
             $this->db->where('VDate >=',$from_date);
             $this->db->where('VDate <=',$to_date);
             $this->db->where('IsAppove',1);
             $records = $this->db->get()->result_array(); 

             return $records;
    }
    public function allexpense_balance($from_date,$to_date)
    {
            $this->db->select("sum(debit) as balance,COAID");
             $this->db->from('acc_transaction');
             $this->db->like('COAID','40','after');
             $this->db->where('VDate >=',$from_date);
             $this->db->where('VDate <=',$to_date);
             $this->db->where('IsAppove',1);
             $records = $this->db->get()->result_array(); 

             return $records;
    }
    
     // get last closed financial year 
    public function last_closed_financial_year()
    {
      $data = $this->db->select("id")
            ->from('financial_year')            
            ->order_by('id', 'DESC')
            ->where('isCloseReq', 1)
            ->limit(1)
            ->get();
        if ($data->num_rows() > 0) {
            $row = $data->row();    
            return $row->id;
        }
        return false;
    }
    // get last active financial year 
    public function last_active_financial_year()
    {
      $data = $this->db->select("id")
            ->from('financial_year')            
            ->order_by('id', 'DESC')
            ->where('status', 1)
            ->limit(1)
            ->get();
        if ($data->num_rows() > 0) { 
            return $data->row(); 
        }
        return false;
    }


}
