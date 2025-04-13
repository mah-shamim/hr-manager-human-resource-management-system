<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income_model extends CI_Model {
 
    public function income_list()
	{
		return $this->db->select('*')	
			->from('income_area')
			->order_by('income_field', 'asc')
			->get()
			->result();
	}
	public function create_income($data = array())
	{
return $this->db->insert('income_area',$data);
	}

	public function delete($id = null)
	{
		$incomename = $this->db->select('income_field')->from('income_area')->where('id',$id)->get()->row()->income_field;
		$this->db->where('id',$id)
			->delete('income_area');
		$this->db->where('HeadName',$incomename)
			->delete('acc_coa');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

    public function findById($id = null)
    { 
        return $this->db->select("*")->from("income_area")
            ->where('id',$id) 
            ->get()
            ->row();

    } 



public function update($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("income_area", $data);


	}

	 	public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='1' And HeadCode LIKE '30%'");
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


	 public function income_add(){
           $voucher_no = date('Ymdhis');
            $Vtype="income";
            $income_type = $this->input->post('income_type',true);
            $pay_type = $this->input->post('paytype',true);
            $cAID     = $this->input->post('cmbDebit',true);
            $Credit   = $this->input->post('amount',true);
            $VDate    = $this->input->post('dtpDate',true);
            $Narration=addslashes(trim($this->input->post('remark',true)));
            $IsPosted=1;
            $IsAppove=1;
            $CreateBy=$this->session->userdata('id');
            $createdate=date('Y-m-d H:i:s');
           $coid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$income_type)->get()->row()->HeadCode;
           $bankname = $this->input->post('bank_name',true);

         $coaid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$bankname)->get()->row()->HeadCode;

         // income type credit  
     $income_acc = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $coid,
      'Narration'      =>  $Narration,
      'Debit'          =>  0,
      'Credit'         =>  $Credit,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $CreateBy,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 
     // bank credit
      $bankincome = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $coaid,
      'Narration'      =>  $bankname.' income '.$voucher_no,
      'Debit'          =>  $Credit,
      'Credit'         =>  0,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $CreateBy,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    );
      // cash in hand credit
           $cashinhand = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  1020101,
      'Narration'      =>  $income_type.' income'.$voucher_no,
      'Debit'          =>  $Credit,
      'Credit'         =>  0,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $CreateBy,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 

              $this->db->insert('acc_transaction',$income_acc);
                if($pay_type == 1){
                $this->db->insert('acc_transaction',$cashinhand);  
              }else{
                $this->db->insert('acc_transaction',$bankincome);
              }
               
    return true;
}


    // income item list
    public function income_item_list(){
         return $this->db->select('*')   
            ->from('income_area')
            ->order_by('id', 'desc')
            ->get()
            ->result_array();
    }
    // bank list
    public function bank_list(){
     return $this->db->select('*')   
            ->from('bank_information')
            ->get()
            ->result_array();
    }

      public function get_income_statement($income,$from_date,$to_date){
      	$headcode = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$income)->get()->row()->HeadCode;
        $this->db->select('*');
        $this->db->from('acc_transaction');
        $this->db->where('COAID', $headcode);
        $this->db->where('VDate >=', $from_date);
        $this->db->where('VDate <=', $to_date);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

 public function get_allincome_statement($income=null,$from_date,$to_date){
        $this->db->select('a.HeadName,sum(b.Credit) as Credit');
        $this->db->from('acc_coa a');
        $this->db->join('acc_transaction b','b.COAID = a.HeadCode','left');
        $this->db->where('a.PHeadName', 'Income');
        $this->db->where('b.VDate >=', $from_date);
        $this->db->where('b.VDate <=', $to_date);
        $this->db->group_by('b.COAID');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
      }


        public function paytype(){
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('PHeadName','Cash & Cash Equivalent');
        $this->db->order_by('HeadName','asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    // balance from income and expense
  public function incomeexpensbalance(){

    $bankcredit = $this->db->select('*')->from('acc_coa')->where('PHeadName','Cash At Bank')->get()->result_array();
    $bankdebit = $this->db->select('*')->from('acc_coa')->where('PHeadName','Cash At Bank')->get()->result_array();
    $total_credit = 0;
    $totaldebit = 0;
    foreach ($bankcredit as $bankcrdt) {
      $credit = $this->db->select('sum(Credit) as totalcredit')->from('acc_transaction')->where('COAID',$bankcrdt['HeadCode'])->get()->row();
      $total_credit = $total_credit+$credit->totalcredit;
    }


     foreach ($bankdebit as $bankdbt) {
      $debit = $this->db->select('sum(Debit) as totaldebit')->from('acc_transaction')->where('COAID',$bankdbt['HeadCode'])->get()->row();
      $totaldebit = $totaldebit+$debit->totaldebit;
    }

    $balance = (!empty($totaldebit)?$totaldebit:0)-(!empty($total_credit)?$total_credit:0);

    return $balance;

  }

  // cash balance 
    public function cashinhandbalance(){
    $total_credit = 0;
    $totaldebit = 0;

      $credit = $this->db->select('sum(Credit) as totalcredit')->from('acc_transaction')->where('COAID',1020101)->get()->row();
      $total_credit = $total_credit+$credit->totalcredit;

      $debit = $this->db->select('sum(Debit) as totaldebit')->from('acc_transaction')->where('COAID',1020101)->get()->row();
      $totaldebit = $totaldebit+$debit->totaldebit;

    $balance = (!empty($totaldebit)?$totaldebit:0)-(!empty($total_credit)?$total_credit:0);

    return $balance;

  }

     public function get_paymenthead($headname){

        $content = $this->db->select('*')->from('acc_coa')->where('PHeadName',$headname)->get()->result_array();
        $html = "";
        if (empty($content)) {
          $html .="NoT Found !";
      }else{
        // Select option created for product
          $html .="<select name=\"headcode[]\"   class=\"paytype form-control\" id=\"headcode_1\" >";
            $html .= "<option>".display('select_one')."</option>";
            foreach ($content as $coa) {
            $html .="<option value=".$coa['HeadCode'].">".$coa['HeadName']."</option>";
            } 
          $html .="</select>";
      }
      
      $data2['headcode']    = $html;
    
    return $data2;
  }

  public function setting()
  {
    return $this->db->get('setting')->row();
  }

}
