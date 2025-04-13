<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice_controller extends MX_Controller {

    public function __construct()
    {
      parent::__construct();
     $this->db->query('SET SESSION sql_mode = ""');
      $this->load->model(array(
         'Notice_model'
     ));
     if (! $this->session->userdata('isLogIn'))
            redirect('login');		 
  }

  public function notice_view(){   
    $this->permission->method('noticeboard','read')->redirect();
    $data['title']    = display('noticeboard');  ;
    $data['mang']     = $this->Notice_model->notice_view();
    $data['module']   = "noticeboard";
    $data['page']     = "notice_view";   
    echo Modules::run('template/layout', $data); 
}


public function create_notice(){ 
   $this->form_validation->set_rules('notice_descriptiion',display('notice_descriptiion'),'max_length[300]');
   $this->form_validation->set_rules('notice_date',display('notice_date'));
   $this->form_validation->set_rules('notice_type',display('notice_type'),'max_length[50]');
   $this->form_validation->set_rules('notice_by',display('notice_by')  ,'max_length[50]');
   $this->load->library('myupload');

   // Check file uploaded then, if the file valid or not
    if(isset($_FILES['notice_attachment']['name']) && !empty($_FILES['notice_attachment']['name'])){ 

        $extension = pathinfo($_FILES['notice_attachment']['name'], PATHINFO_EXTENSION);

        if(!$this->myupload->valid_file_extension($extension)){

            $this->session->set_flashdata('exception',  "Please select a valid file !");
            redirect("noticeboard/Notice_controller/create_notice");
        }
    }
    // End of file extension validation

   $img = $this->myupload->do_upload(
    './application/modules/noticeboard/assets/images/', 
    'notice_attachment');
    $settingdata = $this->db->select('*')->from('appsetting')->get()->row();
     $user_data = $this->db->select('token_id')->from('user')->get()->result_array();
   
     
        
     
        #-------------------------------#
   if ($this->form_validation->run() === true) {
    $postData = [
     'notice_descriptiion' 	  => $this->input->post('notice_descriptiion',true),
     'notice_date'            => $this->input->post('notice_date',true),
     'notice_type' 	          => $this->input->post('notice_type',true),
     'notice_by' 	          => $this->input->post('notice_by',true),
     'notice_attachment'      => $img,
 ];   

 if ($this->Notice_model->notice_create($postData)) { 
    foreach($user_data as $tokendata){
         $icon='https://newhrm.bdtask.com/hrm_app_version/assets/img/icons/2017-07-22/HRM.png';
                		    $fields3 = array(
                    		'to'=> $tokendata['token_id'],
                    		'data'=>array(
                    			'title' =>$this->input->post('notice_type',true),
                    			'body'  => substr($this->input->post('notice_descriptiion',true), 0, 100) ,
                    			'image' =>$icon,
                    			'media_type'=>"image",
                    			"action" => "1",
                    		),
                    		'notification'=>array(
                    			'sound'=>"default",
                    			'title'=>$this->input->post('notice_type',true),
                    			'body'=> $this->input->post('notice_descriptiion',true),
                    			'image'=>$icon,
                    		)
                    	);
                	$post_data3 = json_encode($fields3);
                	$url = "https://fcm.googleapis.com/fcm/send";
                	$ch3  = curl_init($url); 
                	curl_setopt($ch3, CURLOPT_FAILONERROR, TRUE); 
                	curl_setopt($ch3, CURLOPT_RETURNTRANSFER, TRUE);
                	curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0); 
                	curl_setopt($ch3, CURLOPT_POSTFIELDS, $post_data3);
                	curl_setopt($ch3, CURLOPT_HTTPHEADER, array($settingdata->googleapi_authkey,
                	    'Content-Type: application/json')
                	);
                	$result3 = curl_exec($ch3);
                	curl_close($ch3); 
    }
     
    $this->session->set_flashdata('message', display('successfully_created'));
} else {
    $this->session->set_flashdata('exception',  display('please_try_again'));
}
redirect("noticeboard/Notice_controller/create_notice");
} else {
        $data['title']  = display('noticeboard');
        $data['module'] = "noticeboard";
        $data['mang']   = $this->Notice_model->notice_view();
        $data['page']   = "notice_form";   
        echo Modules::run('template/layout', $data); 
        }   
    }


    public function delete_notice($id = null){ 
        $this->permission->method('noticeboard','delete')->redirect();
        if ($this->Notice_model->notice_delete($id)) {
			#set success message
         $this->session->set_flashdata('message',display('delete_successfully'));
     } else {
			#set exception message
         $this->session->set_flashdata('exception',display('please_try_again'));

     }
     redirect("noticeboard/Notice_controller/notice_view");
 }

 public function update_notice_form($id = null){ 
    $data['title'] = display('agent');
        #-------------------------------#
    $this->form_validation->set_rules('notice_id',display('notice_id'));
    $this->form_validation->set_rules('notice_descriptiion',display('notice_descriptiion'));
    $this->form_validation->set_rules('notice_date',display('notice_date'));
    $this->form_validation->set_rules('notice_type',display('notice_type'),'max_length[50]');
    $this->form_validation->set_rules('notice_by',display('notice_by')  ,'max_length[50]');
    $this->load->library('myupload');

    // Check file uploaded then, if the file valid or not
    if(isset($_FILES['notice_attachment']['name']) && !empty($_FILES['notice_attachment']['name'])){ 

        $extension = pathinfo($_FILES['notice_attachment']['name'], PATHINFO_EXTENSION);

        if(!$this->myupload->valid_file_extension($extension)){

            $this->session->set_flashdata('exception',  "Please select a valid file !");
            redirect("noticeboard/Notice_controller/notice_view");
        }
    }
    // End of file extension validation
    
    $img = $this->myupload->do_upload(
        './application/modules/noticeboard/assets/images/', 
        'notice_attachment');

        #-------------------------------#
    if ($this->form_validation->run() === true) {
        $Data = [
        'notice_id'            =>$this->input->post('notice_id',true),
        'notice_descriptiion'  => $this->input->post('notice_descriptiion',true),
        'notice_date'          =>$this->input->post('notice_date',true),
        'notice_type' 	       => $this->input->post('notice_type',true),
        'notice_by' 	       => $this->input->post('notice_by',true),
        'notice_attachment'    =>(!empty($img) ? $img : $this->input->post('notice_attachment')),
    ];   

    if ($this->Notice_model->update_notice($Data)) { 
        $this->session->set_flashdata('message', display('successfully_updated'));
    } else {
        $this->session->set_flashdata('exception',  display('please_try_again'));
    }
    redirect("noticeboard/Notice_controller/notice_view");
} else {
     $data['title']     = display('update');
     $data['data']      = $this->Notice_model->notice_updateForm($id);
     $data['module']    = "noticeboard";    
     $data['page']      = "update_notice_form";   
     echo Modules::run('template/layout', $data);  
}   
}
public function download(){
    $this->load->helper('download');
    $filepath = $this->input->get('file');
    if (file_exists($filepath)) {
        return force_download($filepath, NULL);
    } else {
        return false;
    }
} 



public function view_details(){

    $id             = $this->uri->segment(4);
    $data['title']  = display('Details');  
    $data['detls']  = $this->Notice_model->details($id);
    $data['module'] = "noticeboard";
    $data['page']   = "notice_datails";   
    echo Modules::run('template/layout', $data); 

}

}
