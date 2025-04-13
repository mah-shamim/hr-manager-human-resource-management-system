<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends MX_Controller {

public function __construct()
	{
		parent::__construct();
		 $this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'Bank_model'
		));	
		if (! $this->session->userdata('isLogIn'))
			redirect('login');	 
	}

public function bank_list(){   
		$data['title']    = display('bank_list');  ;
		$data['banks']     = $this->Bank_model->bank_list();
		$data['module']   = "bank";
		$data['page']     = "bank_list";   
		echo Modules::run('template/layout', $data); 
	} 

public function create_bank($id = null){ 
  $data['title'] = display('add_bank');
  #-------------------------------#
  $this->form_validation->set_rules('bank_name', display('bank_name')  ,'required|max_length[250]');
  $this->form_validation->set_rules('account_number', display('account_number')  ,'required|max_length[100]');
  $this->form_validation->set_rules('account_name', display('account_name')  ,'required|max_length[100]');
  $this->form_validation->set_rules('account_name', display('account_name')  ,'max_length[200]');
  #-------------------------------#
   $data['bank']   = (Object) $postData = [
   'id'             => $this->input->post('id'), 
   'bank_name'      => $this->input->post('bank_name',true),
   'account_name'   => $this->input->post('account_name',true),
   'account_number' => $this->input->post('account_number',true),
   'branch_name'    => $this->input->post('branch_name',true),
  ];


  if ($this->form_validation->run()) { 

   if (empty($postData['id'])) {
    $bank_id = $this->Bank_model->create_bank($postData);   
    if ($bank_id) {  
     $predefineHead = $this->db->select("bankCode")->from('acc_predefine_account')->get()->row();
     $coa = $this->Bank_model->headcode($predefineHead->bankCode);
			if($coa->HeadCode!=NULL){
				$headcode=$coa->HeadCode+1;
			}else{
				$headcode="1020501";
			}
			$headname = $this->input->post('bank_name',true);
			$createby = $this->session->userdata('id');
			$createdate = date('Y-m-d H:i:s');			
      $data['aco']  = (Object) $coaData =  array(
      'HeadCode'         =>  $headcode,
      'pheadcode'        =>  $predefineHead->bankCode,
      'HeadName'         =>  $headname,
      'PHeadName'        =>  'Cash at Bank',
      'HeadLevel'        =>  4,
      'IsActive'         =>  1,
      'isStock'          =>  0,
      'isSubType'        =>  0,
      'DepreciationRate' =>  0,
      'HeadType'         =>  'A',
      'IsBudget'         =>  0,     
      'isCashNature'     =>  0,
      'isBankNature'     =>  1,
      'isFixedAssetSch'  =>  0,
      'assetCode'        =>  null,
      'depCode'          =>  null,
      'subType'          =>  1,
      'noteNo'           =>  null,      
      'CreateBy'         => $createby,
      'CreateDate'       => $createdate,
    ); 

    $acc = $this->Bank_model->create_coa($coaData);
	  $this->session->set_flashdata('message', display('save_successfully'));
     addActivityLog("coa_account", "create", $this->db->insert_id(), "acc_coa", 1, $coaData);       
     if($acc) {
      // update COAID to bank info
       $uparray = array('COAID'=>$headcode);       
       $this->db->where('id',$bank_id )->update('bank_information', $uparray);
       redirect('bank/Bank/bank_list');
     }
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
    }
    redirect("bank/Bank/create_bank"); 

   } else {
    if ($this->Bank_model->update($postData)) { 
    	$upcoa = array(
    	'old_head' => $this->input->post('oldname',true),
        'HeadName' => $this->input->post('bank_name',true),
    	);
    $this->Bank_model->update_coa($upcoa);
     $this->session->set_flashdata('message', display('update_successfully'));
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
    }
     redirect('bank/Bank/bank_list');
   }

  } else { 
   if(!empty($id)) {
    $data['title']    = display('update_bank');
    $data['bankinfo'] = $this->Bank_model->findById($id);
   }
   $data['module'] = "bank";
   $data['page']   = "add_bank"; 
   echo Modules::run('template/layout', $data); 
   }  
}
public function delete_bank($id = null){  
   	if ($this->Bank_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('account_delete_message'));
		}
		redirect("bank/Bank/bank_list");
	}

}
