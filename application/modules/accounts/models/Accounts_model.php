<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_model extends CI_Model {


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
        $this->db->where('PHeadName','Cash & Cash Equivalent');
        $this->db->order_by('HeadName','asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function dfs($HeadName,$HeadCode,$oResult,$visit,$d)
    {
        if($d==0) echo "<li class=\"jstree-open \">$HeadName";
        else if($d==1) echo "<li class=\"jstree-open\"><a href='javascript:' onclick=\"loadData('".$HeadCode."')\">$HeadName</a>";
        else echo "<li><a href='javascript:' onclick=\"loadData('".$HeadCode."')\">$HeadName</a>";
        $p=0;
        for($i=0;$i< count($oResult);$i++)
        {

            if (!$visit[$i])
            {
                if ($HeadName==$oResult[$i]->PHeadName)
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
    // Insert Debit voucher 
    public function insert_debitvoucher(){
           $voucher_no = addslashes(trim($this->input->post('txtVNo')));
            $Vtype="DV";
            $cAID = $this->input->post('cmbDebit');
            $dAID = $this->input->post('txtCode');
            $Debit =$this->input->post('txtAmount');
            $Credit= $this->input->post('grand_total');
            $VDate = $this->input->post('dtpDate');
            $Narration=addslashes(trim($this->input->post('txtRemarks')));
            $IsPosted=1;
            $IsAppove=0;
            $CreateBy=$this->session->userdata('id');
           $createdate=date('Y-m-d H:i:s');

           
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Debit[$i];
           
            $debitinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $dbtid,
      'Narration'      =>  $Narration,
      'Debit'          =>  $Damnt,
      'Credit'         =>  0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
           // print_r($debitinsert);exit;
              $this->db->insert('acc_transaction',$debitinsert);
              $headinfo = $this->db->select('HeadName')->from('acc_coa')->where('HeadCode',$dbtid)->get()->row()->HeadName;
              
    $cinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  1020101,
      'Narration'      =>  'Debit voucher from '.$headinfo,
      'Debit'          =>  0,
      'Credit'         =>  $Damnt,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 1
    ); 
  
       $this->db->insert('acc_transaction',$cinsert);

    }
    return true;
}

// Update debit voucher
   public function update_debitvoucher(){
           $voucher_no = $this->input->post('txtVNo');
            $Vtype="DV";
            $cAID = $this->input->post('cmbDebit');
            $dAID = $this->input->post('txtCode');
            $Debit =$this->input->post('txtAmount');
            $Credit= $this->input->post('grand_total');
            $VDate = $this->input->post('dtpDate');
            $Narration=addslashes(trim($this->input->post('txtRemarks')));
            $IsPosted=1;
            $IsAppove=0;
            $CreateBy=$this->session->userdata('id');
           $createdate=date('Y-m-d H:i:s');

            
            $this->db->where('VNo',$voucher_no)
            ->delete('acc_transaction');

  
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Debit[$i];
           
            $debitinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $dbtid,
      'Narration'      =>  $Narration,
      'Debit'          =>  $Damnt,
      'Credit'         =>  0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
           // print_r($debitinsert);exit;
              $this->db->insert('acc_transaction',$debitinsert);
              $headinfo = $this->db->select('HeadName')->from('acc_coa')->where('HeadCode',$dbtid)->get()->row()->HeadName;
              
    $cinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  1020101,
      'Narration'      =>  'Debit voucher from '.$headinfo,
      'Debit'          =>  0,
      'Credit'         =>  $Damnt,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 1
    ); 
  
       $this->db->insert('acc_transaction',$cinsert);

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
           // print_r($data);exit;
    }

    public function Cashvoucher()
    {
      return  $data = $this->db->select("VNo as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'CHV-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->row();
           // print_r($data);exit;
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
           // print_r($data);exit;
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
           // print_r($data);exit;
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
           // print_r($data);exit;
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
           // print_r($data);exit;
    }


  // Insert Credit voucher 
    public function insert_creditvoucher(){
           $voucher_no = addslashes(trim($this->input->post('txtVNo')));
            $Vtype="CV";
            $dAID = $this->input->post('cmbDebit');
            $cAID = $this->input->post('txtCode');
            $Credit =$this->input->post('txtAmount');
            $debit= $this->input->post('grand_total');
            $VDate = $this->input->post('dtpDate');
            $Narration=addslashes(trim($this->input->post('txtRemarks')));
            $IsPosted=1;
            $IsAppove=0;
            $CreateBy=$this->session->userdata('id');
           $createdate=date('Y-m-d H:i:s');

            
            for ($i=0; $i < count($cAID); $i++) {
                $crtid=$cAID[$i];
                $Cramnt=$Credit[$i];
           
            $debitinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $crtid,
      'Narration'      =>  $Narration,
      'Debit'          =>  0,
      'Credit'         =>  $Cramnt,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
           // print_r($debitinsert);exit;
              $this->db->insert('acc_transaction',$debitinsert);
              $this->db->insert('acc_transaction',$debitinsert);
    $headinfo = $this->db->select('HeadName')->from('acc_coa')->where('HeadCode',$crtid)->get()->row()->HeadName;
    
      $cinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  1020101,
      'Narration'      =>  'Credit Vourcher from '.$headinfo,
      'Debit'          =>  $Cramnt,
      'Credit'         =>  0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 1
    ); 

       $this->db->insert('acc_transaction',$cinsert);

    }
    return true;
}

// Insert Countra voucher 
    public function insert_contravoucher(){
           $voucher_no = addslashes(trim($this->input->post('txtVNo')));
            $Vtype="Contra";
            $dAID = $this->input->post('cmbDebit');
            $cAID = $this->input->post('txtCode');
            $debit =$this->input->post('txtAmount');
            $credit= $this->input->post('txtAmountcr');
            $VDate = $this->input->post('dtpDate');
            $Narration=addslashes(trim($this->input->post('txtRemarks')));
            $IsPosted=1;
            $IsAppove=0;
            $CreateBy=$this->session->userdata('id');
           $createdate=date('Y-m-d H:i:s');

            for ($i=0; $i < count($cAID); $i++) {
                $crtid=$cAID[$i];
                $Cramnt=$credit[$i];
                $debit =$debit[$i]; 
           
            $contrainsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $crtid,
      'Narration'      =>  $Narration,
      'Debit'          =>  $debit,
      'Credit'         =>  $Cramnt,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
           //print_r($debitinsert);exit;
              $this->db->insert('acc_transaction',$contrainsert);

    }
    return true;
}
// Insert journal voucher 
    public function insert_journalvoucher(){
           $voucher_no = addslashes(trim($this->input->post('txtVNo')));
            $Vtype="JV";
            $dAID = $this->input->post('cmbDebit');
            $cAID = $this->input->post('txtCode');
            $debit =$this->input->post('txtAmount');
            $credit= $this->input->post('txtAmountcr');
            $VDate = $this->input->post('dtpDate');
            $Narration=addslashes(trim($this->input->post('txtRemarks')));
            $IsPosted=1;
            $IsAppove=0;
            $CreateBy=$this->session->userdata('id');
           $createdate=date('Y-m-d H:i:s');

            for ($i=0; $i < count($cAID); $i++) {
                $crtid=$cAID[$i];
                $Cramnt=$credit[$i];
                $debit =$debit[$i]; 
           
            $contrainsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $crtid,
      'Narration'      =>  $Narration,
      'Debit'          =>  $debit,
      'Credit'         =>  $Cramnt,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
           //print_r($debitinsert);exit;
              $this->db->insert('acc_transaction',$contrainsert);

    }
    return true;
}
// journal voucher
public function journal()
    {
      return  $data = $this->db->select("Max(VNo) as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'Journal-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->result_array();
           // print_r($data);exit;
    }

    // voucher Aprove 
    public function approve_voucher(){
        $values = array("DV", "CV", "JV","Contra");
      
       return $approveinfo = $this->db->select('*')
                               ->from('acc_transaction')
                               ->where_in('Vtype',$values)
                               ->where('IsAppove',0)
                               ->group_by('VNo')
                               ->get()
                               ->result();
                               // print_r($approveinfo);exit;

    }
//approved
        public function approved($data = [])
    {
        return $this->db->where('VNo',$data['VNo'])
            ->update('acc_transaction',$data); 
    } 

    //debit update voucher
    public function dbvoucher_updata($id){
      return  $vou_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Credit <',1)
                 ->get()
                 ->result();
   // print_r($vou_info);exit;
    }

     //credit voucher update 
    public function crdtvoucher_updata($id){
      return  $vou_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Debit <',1)
                 ->get()
                 ->result();
   // print_r($vou_info);exit;
    }
    //Debit voucher inof
     //credit voucher update 
    public function debitvoucher_updata($id){
      return $cr_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Credit<',1)
                 ->get()
                 ->row();
   // print_r($vou_info);exit;
    }
     // debit update voucher credit info
    public function crvoucher_updata($id){
       return $v_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Debit<',1)
                 ->get()
                 ->row();
    //print_r($v_info);exit;
    }

    // update Credit voucher
     public function update_creditvoucher(){
           $voucher_no = addslashes(trim($this->input->post('txtVNo')));
            $Vtype="CV";
            $dAID = $this->input->post('cmbDebit');
            $cAID = $this->input->post('txtCode');
            $Credit =$this->input->post('txtAmount');
            $debit= $this->input->post('grand_total');
            $VDate = $this->input->post('dtpDate');
            $Narration=addslashes(trim($this->input->post('txtRemarks')));
            $IsPosted=1;
            $IsAppove=0;
            $CreateBy=$this->session->userdata('id');
           $createdate=date('Y-m-d H:i:s');

          
              $this->db->where('VNo',$voucher_no)
            ->delete('acc_transaction');

       $this->db->insert('acc_transaction',$cinsert);
            for ($i=0; $i < count($cAID); $i++) {
                $crtid=$cAID[$i];
                $Cramnt=$Credit[$i];
           
            $debitinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $crtid,
      'Narration'      =>  $Narration,
      'Debit'          =>  0,
      'Credit'         =>  $Cramnt,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
           // print_r($debitinsert);exit;
              $this->db->insert('acc_transaction',$debitinsert);
              $this->db->insert('acc_transaction',$debitinsert);
    $headinfo = $this->db->select('HeadName')->from('acc_coa')->where('HeadCode',$crtid)->get()->row()->HeadName;
    
      $cinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  1020101,
      'Narration'      =>  'Credit Vourcher from '.$headinfo,
      'Debit'          =>  $Cramnt,
      'Credit'         =>  0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 1
    ); 

       $this->db->insert('acc_transaction',$cinsert);

    }
    return true;
}

 //Trial Balance Report 
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

     //al hassan working
      public  function get_vouchar(){


         $date=date('Y-m-d');
          $sql="SELECT *, VNo, Vtype,VDate, SUM(Debit+Credit)/2 as Amount FROM acc_transaction  WHERE VDate='$date' AND VType IN ('DV','JV','CV') GROUP BY VNO, Vtype, VDate ORDER BY VDate";
         // $sql="SELECT VNo, Vtype,VDate, SUM(Debit+Credit)/2 as Amount FROM acc_transaction where Vdate='$date' AND VType IN('DV','JV','CV') GROUP BY VNo, Vtype, VDate ORDER BY VDate";
          $query = $this->db->query($sql);
          return $query->result();
    }
    //al hassan working
    public  function get_vouchar_view($date){
        $sql="SELECT acc_income_expence.COAID,SUM(acc_income_expence.Amount) AS Amount, acc_coa.HeadName FROM acc_income_expence INNER JOIN acc_coa ON acc_coa.HeadCode=acc_income_expence.COAID WHERE Date='$date' AND acc_income_expence.IsApprove=1 AND acc_income_expence.Paymode='Cash' GROUP BY acc_income_expence.COAID, acc_coa.HeadName ORDER BY acc_coa.HeadName";
        $query = $this->db->query($sql);
        return $query->result();
    }
    //al hassan working
    public  function get_cash(){
        $date=date('Y-m-d');


        $sql="SELECT SUM(Debit) as Amount FROM acc_transaction WHERE VDate='$date' AND COAID ='1020101' AND VType NOT IN ('DV','JV','CV') AND IsAppove='1'";
        $query = $this->db->query($sql);
        return $query->row();

    }
    //al hassan working
    public  function get_general_ledger(){

        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('IsGL',1);
        $this->db->order_by('HeadName', 'asc');
        $query = $this->db->get();
        return $query->result();

//        $sql="SELECT * FROM acc_coa WHERE IsGL='1' ORDER BY HeadName";
//        $query = $this->db->query($sql);
//        return $query->result();
    }
    //al hassan working
    public function general_led_get($Headid){

        $sql="SELECT * FROM acc_coa WHERE HeadCode='$Headid' ";
        $query = $this->db->query($sql);
        $rs=$query->row();


        $sql="SELECT * FROM acc_coa WHERE IsTransaction=1 AND PHeadName='".$rs->HeadName."' ORDER BY HeadName";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function voucher_report_serach($vouchar){
        $sql="SELECT SUM(Debit) as Amount FROM acc_transaction WHERE VDate='$vouchar' AND COAID ='1020101' AND VType NOT IN ('DV','JV','CV') AND IsAppove='1'";
        $query = $this->db->query($sql);
        return $query->row();

    }


    public function general_led_report_headname($cmbGLCode){
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('HeadCode',$cmbGLCode);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function general_led_report_headname2($cmbGLCode,$cmbCode,$dtpFromDate,$dtpToDate,$chkIsTransction){

            if($chkIsTransction){
                //$cmbCode1=$cmbCode;
                $this->db->select('acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Narration, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID,acc_coa.HeadName, acc_coa.PHeadName, acc_coa.HeadType');
                $this->db->from('acc_transaction');
                $this->db->join('acc_coa','acc_transaction.COAID = acc_coa.HeadCode', 'left');
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('VDate BETWEEN "'.$dtpFromDate. '" and "'.$dtpToDate.'"');
                $this->db->where('acc_transaction.COAID',$cmbCode);
                //$this->db->like('acc_transaction.COAID',$cmbGLCode,'after');

                $query = $this->db->get();
                return $query->result();
            }
            else{
               // $cmbCode1=$cmbCode;
                $this->db->select('acc_transaction.COAID,acc_transaction.Debit, acc_transaction.Credit,acc_coa.HeadName,acc_transaction.IsAppove, acc_coa.PHeadName, acc_coa.HeadType');
                $this->db->from('acc_transaction');
                $this->db->join('acc_coa','acc_transaction.COAID = acc_coa.HeadCode', 'left');
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('VDate BETWEEN "'.$dtpFromDate. '" and "'.$dtpToDate.'"');
                $this->db->where('acc_transaction.COAID',$cmbCode);
               //$this->db->like('acc_transaction.COAID',$cmbGLCode,'after');
                $query = $this->db->get();
                return $query->result();
            }
//            $sql="SELECT acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID, acc_coa.HeadName, acc_coa.PHeadName, acc_coa.HeadType, FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode
//      WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '$dtpFromDate' AND '$dtpToDate' AND acc_transaction.COAID LIKE '$cmbGLCode%' ";
//            $query = $this->db->query($sql);
//            return $query->result();
    }
    // prebalance calculation
      public function general_led_report_prebalance($cmbCode,$dtpFromDate){

            
                //$cmbCode1=$cmbCode;
                $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
                $this->db->from('acc_transaction');
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('VDate < ',$dtpFromDate);
                $this->db->where('acc_transaction.COAID',$cmbCode);
                //$this->db->like('acc_transaction.COAID',$cmbGLCode,'after');

                $query = $this->db->get()->row();
               // print_r($query);exit;
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
       // $sql="SELECT * FROM acc_coa WHERE HeadCode LIKE '1020102%' AND IsTransaction=1 ORDER BY HeadName";
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
           // print_r($data);exit;
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
           // print_r($data);exit;
    }

public function insert_cashadjustment(){
           $voucher_no = $this->input->post('txtVNo');
            $Vtype="AD";
            $amount =$this->input->post('txtAmount');
            $type = $this->input->post('type');
            if($type == 1){
              $debit = $amount;
              $credit = 0;
            }
            if($type == 2){
              $debit = 0;
              $credit = $amount;
            }
            $VDate = $this->input->post('dtpDate');
            $Narration=$this->input->post('txtRemarks');
            $IsPosted=1;
            $IsAppove=1;
            $CreateBy=$this->session->userdata('user_id');
           $createdate=date('Y-m-d H:i:s');
 
     $cc = array(
      'VNo'            =>  $voucher_no,
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
           $voucher_no = $this->input->post('txtVNo');
           $headname = $this->input->post('bank_name');
           $headcode = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$headname)->get()->row()->HeadCode;
            $Vtype="BAD";
            $amount =$this->input->post('txtAmount');
            $type = $this->input->post('type');
            if($type == 1){
              $debit = $amount;
              $credit = 0;
            }
            if($type == 2){
              $debit = 0;
              $credit = $amount;
            }
            $VDate = $this->input->post('dtpDate');
            $Narration=$this->input->post('txtRemarks');
            $IsPosted=1;
            $IsAppove=1;
            $CreateBy=$this->session->userdata('user_id');
           $createdate=date('Y-m-d H:i:s');
 
     $cc = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $headcode,
      'Narration'      =>  'Bank Adjustment ',
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
        return true;
    }

  // Balance Adjustment
  public function insert_balanceadjustment(){
           $voucher_no = $this->input->post('txtVNo');
            $Vtype="ADJ";
            $amount = $this->input->post('amount');
            $parenthead = $this->input->post('parent_type');
            $parentheadcode = $this->db->select('*')->from('acc_coa')->where('HeadName',$parenthead)->get()->row()->HeadCode;
            $childheadcodes   = $this->input->post('headcode');
            $type = $this->input->post('type');
            if($type == 1){
              $debit = intval(str_replace(',', '', $amount));
              $credit = 0;
            }
            if($type == 2){
              $debit = 0;
              $credit = intval(str_replace(',', '', $amount));
            }
            $VDate = $this->input->post('dtpDate');
            $Narration=$this->input->post('txtRemarks');
            $IsPosted=1;
            $IsAppove=1;
            $CreateBy=$this->session->userdata('user_id');
           $createdate=date('Y-m-d H:i:s');
 
     $cc = array(
      'VNo'            =>  $voucher_no,
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
}
