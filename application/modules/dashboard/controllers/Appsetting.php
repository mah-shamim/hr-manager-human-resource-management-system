<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appsetting extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'app_setting'
		));

		if (!$this->session->userdata('isAdmin')) 
		redirect('login'); 
	}
 

	public function index()
	{
		$data['title'] = display('mobile_app_setting');
		#-------------------------------#
		//check setting table row if not exists then insert a row
		$this->check_setting();
		#-------------------------------#
		   $this->load->library('ciqrcode');
            $qr_image=rand().'.png';
            $params['data'] = base_url().'Api/add_attendance';
            $params['level'] = 'L';
            $params['size'] = 10;
            $params['savename'] =FCPATH."assets/img/qr/".$qr_image;
            if($this->ciqrcode->generate($params))
            {
                $localqr = $qr_image;
            }
		$data['appsetting'] = $this->app_setting->read();
		$data['qr']         = $localqr;
		$data['module']     = "dashboard";  
		$data['page']       = "home/appsetting";  
		echo Modules::run('template/layout', $data); 
	} 

	public function create()
	{
		$data['title'] = display('mobile_app_setting');
		#-------------------------------#
		$this->form_validation->set_rules('googleapi_authkey',display('googleapi_authkey'),'max_length[255]'); 
		
		$ip = $_SERVER['REMOTE_ADDR'];
$locationArray = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));

$latitude =  $locationArray['geoplugin_latitude'];

$longitude =  $locationArray['geoplugin_longitude'];
		#-------------------------------#
		

		$data['setting'] = (object)$postData = [
			'id'                => $this->input->post('id'),
			'latitude'          => $this->input->post('latitude',true),
			'longitude'         => $this->input->post('longitude',true),
			'acceptablerange'   => $this->input->post('acceptablerange',true),
			'googleapi_authkey' => $this->input->post('googleapi_authkey',true),
			
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {
				if ($this->app_setting->create($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
			} else {
				if ($this->app_setting->update($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				} 
			}
 
			redirect('dashboard/appsetting');

		} else { 
			$data['module'] = "dashboard";  
			$data['page']   = "home/appsetting";  
			echo Modules::run('template/layout', $data); 
		} 
	}

	//check setting table row if not exists then insert a row
	public function check_setting()
	{
			$ip = $_SERVER['REMOTE_ADDR'];
            $locationArray = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));
			$latitude =  $locationArray['geoplugin_latitude'];
			$longitude =  $locationArray['geoplugin_longitude'];
		if ($this->db->count_all('appsetting') == 0) {

			$this->db->insert('appsetting',[
				'latitude'        =>  $latitude,
				'longitude'       => $longitude,
				'acceptablerange' => 20,
			]);
		}
	}



}
