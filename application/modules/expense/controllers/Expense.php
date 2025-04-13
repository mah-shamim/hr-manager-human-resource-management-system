<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends MX_Controller {

public function __construct()
  {
    parent::__construct();
    $this->db->query('SET SESSION sql_mode = ""');
    $this->load->model(array(
      'Expense_model'
    )); 
    if (! $this->session->userdata('isLogIn'))
      redirect('login');   
  }

public function expense_list(){   
    $data['title']    = display('expense_list');
    $data['expenses']     = $this->Expense_model->expense_list();
    $data['module']   = "expense";
    $data['page']     = "expense_list";   
    echo Modules::run('template/layout', $data); 
  } 

public function expense_item($id = null){ 
  $data['title'] = display('add_expense');
  #-------------------------------#
  $this->form_validation->set_rules('expense_name', display('expense_name')  ,'required|max_length[250]');

  #-------------------------------#
   $data['expense']   = (Object) $postData = [
   'id'                => $this->input->post('id'), 
   'expense_name'      => $this->input->post('expense_name',true),
  ];


  if ($this->form_validation->run()) { 

   if (empty($postData['id'])) {
    if ($this->Expense_model->create_expense($postData)) { 
     
     $coa = $this->Expense_model->headcode();
      if($coa->HeadCode!=NULL){
        $headcode=$coa->HeadCode+1;
      }else{
        $headcode="402";
      }

      $headname = $this->input->post('expense_name',true);
      $createby = $this->session->userdata('fullname');
      $createdate = date('Y-m-d H:i:s');
      $data['aco']  = (Object) $coaData = [
        'HeadCode'         => $headcode,
        'HeadName'         => $headname,
        'PHeadName'        => 'Expence',
        'HeadLevel'        => '1',
        'IsActive'         => '1',
        'IsTransaction'    => '1',
        'IsGL'             => '0',
        'HeadType'         => 'E',
        'IsBudget'         => '0',
        'IsDepreciation'   => '0',
        'DepreciationRate' => '0',
        'CreateBy'         => $createby,
        'CreateDate'       => $createdate,
      ];
      $this->Expense_model->create_coa($coaData);

      $this->session->set_flashdata('message', display('save_successfully'));

     redirect('expense/expense/expense_item');
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
    }
    redirect("expense/expense/expense_item"); 

   } else {
    if ($this->Expense_model->update($postData)) { 
      $upcoa = array(
      'old_head' => $this->input->post('oldname',true),
        'HeadName' => $this->input->post('expense_name',true),
      );
    $this->Expense_model->update_coa($upcoa);
     $this->session->set_flashdata('message', display('update_successfully'));
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
    }
    redirect("expense/expense/expense_item/".$postData['id']);  
   }

  } else { 
   if(!empty($id)) {
    $data['title']    = display('update_expense');
    $data['expenseinfo'] = $this->Expense_model->findById($id);
   }
   $data['expenses']     = $this->Expense_model->expense_list();
   $data['module'] = "expense";
   $data['page']   = "add_expense"; 
   echo Modules::run('template/layout', $data); 
   }  
}
public function delete_expense($id = null){ 
    if ($this->Expense_model->delete($id)) {
      #set success message
      $this->session->set_flashdata('message',display('delete_successfully'));
    } else {
      #set exception message
      $this->session->set_flashdata('exception',display('please_try_again'));
    }
    redirect("expense/expense/expense_item");
  }


    public function add_expense(){
    $data['title']  = display('add_expense');
    $data['expense_item'] = $this->Expense_model->expense_item_list();
    $data['bank_list']    = $this->Expense_model->bank_list();
    $data['module']       = "expense";
    $data['page']         = "expense_form"; 
   echo Modules::run('template/layout', $data); 
    }

     public function create_expense(){
    $this->form_validation->set_rules('amount', display('amount')  ,'required|max_length[20]');
     $this->form_validation->set_rules('expense_type', display('expense_name')  ,'required|max_length[250]');
     $this->form_validation->set_rules('dtpDate', display('date')  ,'required');
    $this->form_validation->set_rules('paytype', display('payment_type')  ,'required');
    $this->form_validation->set_rules('remark', display('remark')  ,'max_length[250]');
         if ($this->form_validation->run()) { 
        if ($this->Expense_model->expense_add()) { 
          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('expense/Expense/add_expense/');
        }else{
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
        redirect("expense/Expense/add_expense");
    }else{
      $this->session->set_flashdata('exception',  display('please_try_again'));
      redirect("expense/Expense/add_expense");
     }

}


 // expense statement form
   public function expense_statement_form(){
    $expense_item  = $this->Expense_model->expense_item_list();
        $data = array(
            'item_list' => $expense_item,
        );
   $data['title']  = display('expense_statement_form');
   $data['module'] = "expense";
   $data['page']   = "expense_statement_form"; 
   echo Modules::run('template/layout', $data); 
}


 public function expense_statement(){
    $expense_name  = $this->input->get('expense_name',true);
    $from_date     = $this->input->get('from_date');
    $to_date       = $this->input->get('to_date');

if($expense_name =='all'){
$custom_statement = $this->Expense_model->get_allexpense_statement($expense_name,$from_date,$to_date);
}else{
   $custom_statement = $this->Expense_model->get_expense_statement($expense_name,$from_date,$to_date);
 }
     $expense_item  = $this->Expense_model->expense_item_list();
        $data = array(
            'item_list'          => $expense_item,
            'expense_statement'  => $custom_statement,
            'from_date'          => $from_date,
            'to_date'            => $to_date,
            'expense_id'         => $expense_name,
        );
   $data['title']  = display('expense_statement');
   $data['setting'] = $this->Expense_model->setting();
   $data['module'] = "expense";
   if($expense_name =='all'){
   $data['page']   = "allexpense_statement";
   }else{
   $data['page']   = "expense_statement";
   } 
   echo Modules::run('template/layout', $data);
 }

    public function expense_chart(){
    $expense_item  = $this->Expense_model->expense_item_list();
    $paytype = $this->Expense_model->paytype();
    $balance = $this->Expense_model->incomeexpensbalance();
    $cash    =  $this->Expense_model->cashinhandbalance();
        $data = array(
            'item_list' => $expense_item,
            'paytype'   => $paytype,
            'balance'   => $balance,
             'cash'     => $cash,
        );
   $data['title']  = display('expense');
   $data['module'] = "expense";
   $data['page']   = "expense_sheet"; 
   echo Modules::run('template/layout', $data); 
}


  public function retrieve_paytypedata()
  { 
    $paytype  = $this->input->post('paytype',true);
    $typeinfo = $this->Expense_model->get_paymenthead($paytype);
    echo json_encode($typeinfo);
  }

  // Expense sheet insert
  public function expensesheet_add(){
      $createby = $this->session->userdata('fullname');
    $createdate = date('Y-m-d H:i:s');
    $amount     = $this->input->post('amount',true);
    $date       = $this->input->post('date',true);
    $particular = $this->input->post('particular',true);
    $voucher_no = $this->input->post('voucher_no',true);
    $paymenttype= $this->input->post('parent_type',true);
    $headcodes   = $this->input->post('headcode',true);
    $remarks    = $this->input->post('remarks',true);
      for ($i=0; $i < count($amount); $i++) {
        $singleamount   =intval(str_replace(',', '', $amount[$i]));
        $singledate     = $date[$i];
        $singleparticular = $particular[$i];
        $singlevoucher   = $voucher_no[$i];
        $singlepayment_type = $paymenttype[$i];
        $singleheadcode = $headcodes[$i];
        $singleremarks  = $remarks[$i];
        $IsPosted=1;
        $IsAppove=1;
        $Vtype="Expense";


$paytypcode = $this->db->select('*')->from('acc_coa')->where('HeadName',$singlepayment_type)->get()->row()->HeadCode;

        if(!empty($singleparticular) && !empty($singleamount)){

$check_particular = $this->db->select('*')->from('acc_coa')->where('HeadName',$singleparticular)->get()->row();
if(empty($check_particular)){

  $data['expense']   = (Object) $expensitem = [
   'id'                => $this->input->post('id'), 
   'expense_name'      => $singleparticular,
  ];
  $this->Expense_model->create_expense($expensitem);
           
      $coa = $this->Expense_model->headcode();
      if($coa->HeadCode!=NULL){
        $headcode=$coa->HeadCode+1;
      }else{
        $headcode="402";
      }

      $headname = $singleparticular;
      $data['aco']  = (Object) $coaData = [
        'HeadCode'         => $headcode,
        'HeadName'         => $headname,
        'PHeadName'        => 'Expence',
        'HeadLevel'        => '1',
        'IsActive'         => '1',
        'IsTransaction'    => '1',
        'IsGL'             => '0',
        'HeadType'         => 'E',
        'IsBudget'         => '0',
        'IsDepreciation'   => '0',
        'DepreciationRate' => '0',
        'CreateBy'         => $createby,
        'CreateDate'       => $createdate,
      ];
      $this->Expense_model->create_coa($coaData);
    }else{
      $headcode=$check_particular->HeadCode;
    }


         $expense_acc = array(
      'VNo'            =>  $singlevoucher,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $singledate,
      'COAID'          =>  $headcode,
      'Narration'      =>  $singleremarks,
      'Debit'          =>  $singleamount,
      'Credit'         =>  0,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $createby,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 
     // bank credit
      $creditexpense = array(
      'VNo'            =>  $singlevoucher,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $singledate,
      'COAID'          =>  (!empty($singleheadcode)?$singleheadcode:$paytypcode),
      'Narration'      =>  $singleremarks,
      'Debit'          =>  0,
      'Credit'         =>  $singleamount,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $createby,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    );

$this->db->insert('acc_transaction',$expense_acc);
$this->db->insert('acc_transaction',$creditexpense);
        }

      }

$this->session->set_flashdata('message', display('save_successfully'));      
redirect("expense/Expense/expense_chart");

  }

}
