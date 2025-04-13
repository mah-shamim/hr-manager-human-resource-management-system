<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_controller extends MX_Controller {

public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'asset_model','accounts/accounts_model'
		));
    if (! $this->session->userdata('isLogIn'))
      redirect('login');		 
	}

   public function equipment_list()
    {   
        $this->permission->method('asset','read')->redirect();
        $data['title']    = display('equipment_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('asset/Equipment_controller/equipment_list');
        $config["total_rows"]  = $this->asset_model->count_equipment();
        $config["per_page"]    = 25;
        $config["uri_segment"] = 4;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["equipment"] = $this->asset_model->read_equipment($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #   
        $data['module'] = "asset";
        $data['page']   = "equipment_list";   
        echo Modules::run('template/layout', $data); 
    }  


public function equipment_form($id = null)
 {
  $this->permission->check_label('equipment')->read()->redirect();
  $data['title'] = display('add_equipment');
  #-------------------------------#
  $this->form_validation->set_rules('equipment_name', display('equipment_name')  ,'required|max_length[100]');
  $this->form_validation->set_rules('model', display('model')  ,'max_length[100]');
  $this->form_validation->set_rules('price', display('price')  ,'required|numeric|max_length[100]');
  #-------------------------------#
   $data['division']   = (Object) $postData = [
   'equipment_id'     => $this->input->post('equipment_id',true), 
   'equipment_name'   => $this->input->post('equipment_name',true),
   'type_id'          => $this->input->post('type_id'),
   'model'            => $this->input->post('model',true),
   'serial_no'        => $this->input->post('serial_no',true),
   'price'            => $this->input->post('price',true),
  ];


  if ($this->form_validation->run()) { 

   if (empty($postData['equipment_id'])) {

    $this->permission->check_label('equipment')->create()->redirect();
    if ($this->asset_model->equipment_create($postData)) { 
     $this->session->set_flashdata('message', display('save_successfully'));
     redirect('asset/Equipment_controller/equipment_form');
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
    }
    redirect("asset/Equipment_controller/equipment_form"); 

   } else {

    $this->permission->check_label('equipment')->update()->redirect();

    if ($this->asset_model->update_equipment($postData)) { 
     $this->session->set_flashdata('message', display('update_successfully'));
     redirect("asset/Equipment_controller/equipment_form/");  
    } else {
     $this->session->set_flashdata('exception',  display('please_try_again'));
     redirect("asset/Equipment_controller/equipment_form/".$postData['equipment_id']);  
    }
    
   }

  } else { 
   if(!empty($id)) {
    $data['title'] = display('update_equipment');
    $data['equipmentinfo']   = $this->asset_model->findById_equipment($id);
   }
   $data['type']   =  $this->asset_model->type_dropdown();
   $data['module'] = "asset";
   $data['equipment'] = $this->asset_model->equipment_list();
    //PDF Generator for equipment list
    $data['setting'] = $this->accounts_model->setting();
    $this->load->library('pdfgenerator');
    $dompdf = new DOMPDF();
    $page = $this->load->view('asset/equipment_list_pdf',$data,true);
    $dompdf->load_html($page);
    $dompdf->render();
    $output = $dompdf->output();
    file_put_contents('assets/data/pdf/Equipment List Pdf As On '.date("Y-m-d").'.pdf', $output);
    $data['pdf']    = 'assets/data/pdf/Equipment List Pdf As On '.date("Y-m-d").'.pdf';
    //PDF Generator Ends

   $data['page']   = "equipment_form";   
   echo Modules::run('template/layout', $data); 
   }   
 }


 public function delete_equipment($id=null){
        $this->permission->module('asset','delete')->redirect();
        if($this->asset_model->equipment_delete($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect('asset/Equipment_controller/equipment_form');
    }

    

}
