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
  #-------------------------------#
   $data['bank']   = (Object) $postData = [
   'id'             => $this->input->post('id'), 
   'bank_name'      => $this->input->post('bank_name'),
   'account_name'   => $this->input->post('account_name'),
   'account_number' => $this->input->post('account_number'),
   'branch_name'    => $this->input->post('branch_name'),
  ];


  if ($this->form_validation->run()) { 

   if (empty($postData['id'])) {
    if ($this->Bank_model->create_bank($postData)) { 
     
     $coa = $this->Bank_model->headcode();
			if($coa->HeadCode!=NULL){
				$headcode=$coa->HeadCode+1;
			}else{
				$headcode="10201020001";
			}

			$headname = $this->input->post('bank_name');
			$createby = $this->session->userdata('fullname');
			$createdate = date('Y-m-d H:i:s');
			$data['aco']  = (Object) $coaData = [
				'HeadCode'         => $headcode,
				'HeadName'         => $headname,
				'PHeadName'        => 'Cash At Bank',
				'HeadLevel'        => '4',
				'IsActive'         => '1',
				'IsTransaction'    => '1',
				'IsGL'             => '0',
				'HeadType'         => 'A',
				'IsBudget'         => '0',
				'IsDepreciation'   => '0',
				'DepreciationRate' => '0',
				'CreateBy'         => $createby,
				'CreateDate'       => $createdate,
			];
			$this->Bank_model->create_coa($coaData);

	$this->session->set_flashdata('message', display('save_successfully'));

     redirect('bank/Bank/bank_list');
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
    }
    redirect("bank/Bank/create_bank"); 

   } else {
    if ($this->Bank_model->update($postData)) { 
    	$upcoa = array(
    	'old_head' => $this->input->post('oldname'),
        'HeadName' => $this->input->post('bank_name'),
    	);
    $this->Bank_model->update_coa($upcoa);
     $this->session->set_flashdata('message', display('update_successfully'));
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
    }
    redirect("bank/Bank/create_bank/".$postData['id']);  
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
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect("bank/Bank/bank_list");
	}





}
