<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income extends MX_Controller {

public function __construct()
  {
    parent::__construct();
    $this->db->query('SET SESSION sql_mode = ""');
    $this->load->model(array(
      'Income_model'
    ));
    if (! $this->session->userdata('isLogIn'))
      redirect('login');     
  }

public function income_list(){   
    $data['title']    = display('income_list');  ;
    $data['incomes']  = $this->Income_model->income_list();
    $data['module']   = "income";
    $data['page']     = "income_list";   
    echo Modules::run('template/layout', $data); 
  } 

public function income_item($id = null){ 
  $data['title'] = display('income_field');
  #-------------------------------#
  $this->form_validation->set_rules('income_field', display('income_field')  ,'required|max_length[250]');

  #-------------------------------#
   $data['income']   = (Object) $postData = [
   'id'             => $this->input->post('id'), 
   'income_field'   => $this->input->post('income_field',true),
  ];


  if ($this->form_validation->run()) { 

   if (empty($postData['id'])) {
    if ($this->Income_model->create_income($postData)) { 
     
     $coa = $this->Income_model->headcode();
      if($coa->HeadCode!=NULL){
        $headcode=$coa->HeadCode+1;
      }else{
        $headcode="301";
      }

      $headname = $this->input->post('income_field',true);
      $createby = $this->session->userdata('fullname');
      $createdate = date('Y-m-d H:i:s');
      $data['aco']  = (Object) $coaData = [
        'HeadCode'         => $headcode,
        'HeadName'         => $headname,
        'PHeadName'        => 'Income',
        'HeadLevel'        => '1',
        'IsActive'         => '1',
        'IsTransaction'    => '1',
        'IsGL'             => '0',
        'HeadType'         => 'I',
        'IsBudget'         => '0',
        'IsDepreciation'   => '0',
        'DepreciationRate' => '0',
        'CreateBy'         => $createby,
        'CreateDate'       => $createdate,
      ];
      $this->Income_model->create_coa($coaData);

      $this->session->set_flashdata('message', display('save_successfully'));

     redirect('income/Income/income_item');
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
    }
    redirect("income/Income/income_item"); 

   } else {
    if ($this->Income_model->update($postData)) { 
      $upcoa = array(
      'old_head' => $this->input->post('oldname',true),
      'HeadName' => $this->input->post('income_name',true),
      );
    $this->Income_model->update_coa($upcoa);
     $this->session->set_flashdata('message', display('update_successfully'));
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
    }
    redirect("income/Income/income_item/".$postData['id']);  
   }

  } else { 
   if(!empty($id)) {
    $data['title']    = display('update_income');
    $data['incomeinfo'] = $this->Income_model->findById($id);
   }
   $data['incomes']     = $this->Income_model->income_list();
   $data['module'] = "income";
   $data['page']   = "add_income"; 
   echo Modules::run('template/layout', $data); 
   }  
}
public function delete_income($id = null){ 
    if ($this->Income_model->delete($id)) {
      #set success message
      $this->session->set_flashdata('message',display('delete_successfully'));
    } else {
      #set exception message
      $this->session->set_flashdata('exception',display('please_try_again'));
    }
    redirect("income/income/income_item");
  }


    public function add_income(){
    $data['title']  = display('add_income');
    $data['income_item']  = $this->Income_model->income_item_list();
    $data['bank_list']    = $this->Income_model->bank_list();
    $data['module']       = "income";
    $data['page']         = "income_form"; 
   echo Modules::run('template/layout', $data); 
    }

     public function create_income(){
    $this->form_validation->set_rules('amount', display('amount')  ,'required|max_length[20]');
     $this->form_validation->set_rules('income_type', display('income_field')  ,'required|max_length[250]');
     $this->form_validation->set_rules('dtpDate', display('date')  ,'required');
      $this->form_validation->set_rules('paytype', display('payment_type')  ,'required');
         if ($this->form_validation->run()) { 
        if ($this->Income_model->income_add()) { 
          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('income/Income/add_income/');
        }else{
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
        redirect("income/Income/add_income");
    }else{
      $this->session->set_flashdata('exception',  display('please_try_again'));
      redirect("income/Income/add_income");
     }

}


 // income statement form
   public function income_statement_form(){
    $income_item  = $this->Income_model->income_item_list();
        $data = array(
            'item_list' => $income_item,
        );
   $data['title']  = display('income_statement_form');
   $data['module'] = "income";
   $data['page']   = "income_statement_form"; 
   echo Modules::run('template/layout', $data); 
}


 public function income_statement(){
    $income_name  = $this->input->get('income_field',true);
    $from_date   = $this->input->get('from_date');
    $to_date     = $this->input->get('to_date');

if($income_name == 'all'){
   $custom_statement = $this->Income_model->get_allincome_statement($income_name,$from_date,$to_date);
 }else{
  $custom_statement = $this->Income_model->get_income_statement($income_name,$from_date,$to_date);
 }
     $income_item  = $this->Income_model->income_item_list();
        $data = array(
            'item_list'          => $income_item,
            'income_statement'   => $custom_statement,
            'from_date'          => $from_date,
            'to_date'            => $to_date,
            'income_id'          => $income_name,
        );
   $data['title']  = display('income_statement');
   $data['setting'] = $this->Income_model->setting();
   $data['module'] = "income";
   if($income_name =='all'){
     $data['page']   = "allincome_statement"; 
   }else{
     $data['page']   = "income_statement"; 
   }
  
   echo Modules::run('template/layout', $data);
 }

     public function income_chart(){
    $expense_item  = $this->Income_model->income_item_list();
    $paytype = $this->Income_model->paytype();
    $balance = $this->Income_model->incomeexpensbalance();
    $cash    =  $this->Income_model->cashinhandbalance();
    $data = array(
        'item_list' => $expense_item,
        'paytype'   => $paytype,
        'balance'   => $balance,
        'cash'      => $cash,
    );
   $data['title']  = display('income');
   $data['module'] = "income";
   $data['page']   = "income_sheet"; 
   echo Modules::run('template/layout', $data); 
}

 public function retrieve_paytypedata()
  { 
    $paytype  = $this->input->post('paytype',true);
    $typeinfo = $this->Income_model->get_paymenthead($paytype);
    echo json_encode($typeinfo);
  }

public function incomeheet_add(){
    $createby = $this->session->userdata('fullname');
    $createdate = date('Y-m-d H:i:s');
    $amount     = $this->input->post('amount',true);
    $date       = $this->input->post('date');
    $particular = $this->input->post('particular',true);
    $voucher_no = $this->input->post('voucher_no',true);
    $paymenttype= $this->input->post('parent_type',true);
    $headcodes   = $this->input->post('headcode',true);
    $remarks    = $this->input->post('remarks',true);

    //Check if amount is number or not
    for ($i=0; $i < count($amount); $i++) {

      if($amount[$i] && !intval($amount[$i])){

        $this->session->set_flashdata('exception', "Amount field must contain number !");      
        redirect("income/income/income_chart");

      }
    }
    // End of checking if amount is number or not

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
        $Vtype="Income";


$paytypcode = $this->db->select('*')->from('acc_coa')->where('HeadName',$singlepayment_type)->get()->row()->HeadCode;

        if(!empty($singleparticular) && !empty($singleamount)){

$check_particular = $this->db->select('*')->from('acc_coa')->where('HeadName',$singleparticular)->get()->row();
if(empty($check_particular)){

    $data['income']   = (Object) $incomeitem = [
     'income_field'   => $singleparticular,
  ];

  $this->Income_model->create_income($incomeitem);
           
      $coa = $this->Income_model->headcode();
      if($coa->HeadCode!=NULL){
        $headcode=$coa->HeadCode+1;
      }else{
        $headcode="301";
      }

      $headname = $singleparticular;
      $data['aco']  = (Object) $coaData = [
        'HeadCode'         => $headcode,
        'HeadName'         => $headname,
       'PHeadName'        => 'Income',
        'HeadLevel'        => '1',
        'IsActive'         => '1',
        'IsTransaction'    => '1',
        'IsGL'             => '0',
        'HeadType'         => 'I',
        'IsBudget'         => '0',
        'IsDepreciation'   => '0',
        'DepreciationRate' => '0',
        'CreateBy'         => $createby,
        'CreateDate'       => $createdate,
      ];
      $this->Income_model->create_coa($coaData);
    }else{
      $headcode=$check_particular->HeadCode;
    }


         $income_acc = array(
      'VNo'            =>  $singlevoucher,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $singledate,
      'COAID'          =>  $headcode,
      'Narration'      =>  $singleremarks,
      'Debit'          =>  0,
      'Credit'         =>  $singleamount,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $createby,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 
     // bank credit
      $debitincome = array(
      'VNo'            =>  $singlevoucher,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $singledate,
      'COAID'          =>  (!empty($singleheadcode)?$singleheadcode:$paytypcode),
      'Narration'      =>  $singleremarks,
      'Debit'          =>  $singleamount,
      'Credit'         =>  0,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $createby,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    );

$this->db->insert('acc_transaction',$income_acc);
$this->db->insert('acc_transaction',$debitincome);
        }

      }

$this->session->set_flashdata('message', display('save_successfully'));      
redirect("income/income/income_chart");

  }
}
