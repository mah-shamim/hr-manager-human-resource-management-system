<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules extends MX_Controller {

    public function __construct()
    {
        parent::__construct(); 
        $this->db->query('SET SESSION sql_mode = ""'); 

        $this->load->model('dashboard/rules_model');
        
        if (! $this->session->userdata('isLogIn'))
            redirect('login');   
        
        $timeZone = 'Asia/Dhaka';
        @date_default_timezone_set($timeZone);
    } 

    public function index()
    {

        $data['title']  = "Rules";
        $data['module'] = "dashboard";
        $data['page']   = "rules/list";
        $data['rules']  = $this->rules_model->get_all_rules();

        echo modules::run('template/layout', $data);
    }

    public function rules_view()
    {   
        $data['title']    = display('rules');
        $data['rules']  = $this->rules_model->get_all_rules();
        $data['module']   = "dashboard";
        $data['page']     = "rules/rules_view"; 

        echo Modules::run('template/layout', $data); 
    }

    public function create_rule()
    { 
        $data['title'] = display('rule');
        #-------------------------------#
        $this->form_validation->set_rules('name',display('name'),'required|max_length[150]');
        $this->form_validation->set_rules('type',display('type'),'required');
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $type = $this->input->post('type',true);
            $name = $this->input->post('name',true);

            // Check Rule name of similar type already exists
            $rule_info = $this->rules_model->get_rule_by_type_name($type,$name);
            if($rule_info){
                $this->session->set_flashdata('exception', "Rule name of similar type already exists !");
                redirect("dashboard/rules/");
            }
            // Ends

            $postData = [
                'name'         => $name,
                'type'         => $type, 
                'description'  => $this->input->post('description',true),            
            ];   
            // Check based on the type select value, all the required fileds value are coming as input
            $required_values_missing = false;
            if($type == "time"){
                $postData['start_time'] = $this->input->post('start_time',true);
                $postData['end_time'] = $this->input->post('end_time',true); 

                if($postData['start_time'] == "" || $postData['end_time'] == ""){
                    $required_values_missing = true;
                }           
            }
            if($type == "basic"){
                $postData['fixed'] = $this->input->post('basic',true);

                if($this->input->post('basic',true) == ""){
                    $required_values_missing = true;
                } 
            }
            if($type == "allowance"){
                $postData['fixed'] = $this->input->post('allowance_amount',true);

                if($this->input->post('allowance_amount',true) == ""){
                    $required_values_missing = true;
                } 
            }
            if($type == "tax"){
                $postData['percent'] = $this->input->post('percent',true);

                if($this->input->post('percent',true) == ""){
                    $required_values_missing = true;
                } 
            }

            // id any required fields value is missing, then give error
            if($required_values_missing){
                $this->session->set_flashdata('exception', "Please fill up all the required fields value !");
                    redirect("dashboard/rules/rules_view");
            }

            $postData['created_at'] = date('Y-m-d h:i:s');
            $user = $this->session->userdata();
            $postData['created_by'] = $user['id'];

            // Ends  

            if ($rule_id = $this->rules_model->create($postData)) {

                addActivityLog("rule", "create", $rule_id, "gmb_setup_rules", 1, $postData);

                $this->session->set_flashdata('message', display('successfully_saved'));

            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("dashboard/rules/");

        } else {

            $this->session->set_flashdata('exception', validation_errors());
            redirect("dashboard/rules/");
        }   
    }

    public function update_rule_form($rule_id = null)
    {
        $data['title']    = display('update').' '.display('rule');
        $data['rule']  = $this->rules_model->get_rule_by_id($rule_id);
        $data['module']   = "dashboard";
        $data['page']     = "rules/rule_update"; 

        echo Modules::run('template/layout', $data); 
    }

    public function update_rule($rule_id = null)
    { 
        $data['title'] = display('rule');

        if((int)$rule_id != $this->input->post('rule_id',true)){

            $this->session->set_flashdata('exception',  display('please_try_again'));
            redirect("dashboard/rules/rules_view");
        }

        $rule_id = $this->input->post('rule_id',true);
        $rule_info    = $this->rules_model->get_rule_by_id($rule_id);

        #-------------------------------#
        $this->form_validation->set_rules('name',display('name'),'required|max_length[150]');
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            $type = $rule_info->type;
            $name = $this->input->post('name',true);

            // Check Rule name of similar type already exists
            if($name != $rule_info->name){
                $rule_info = $this->rules_model->get_rule_by_type_name($type,$name);
                if($rule_info){
                    $this->session->set_flashdata('exception', "Rule name of similar type already exists !");
                    redirect("dashboard/rules/rules_view");
                }
            }
            // Ends

            $postData = [
                'rule_id'      => $rule_id,
                'name'         => $name,
                'description'  => $this->input->post('description',true),
            ];   
            // Check based on the type select value, all the required fileds value are coming as input
            $required_values_missing = false;
            if($type == "time"){
                $postData['start_time'] = $this->input->post('start_time',true);
                $postData['end_time'] = $this->input->post('end_time',true); 

                if($postData['start_time'] == "" || $postData['end_time'] == ""){
                    $required_values_missing = true;
                }           
            }
            if($type == "basic"){
                $postData['fixed'] = $this->input->post('basic',true);

                if($this->input->post('basic',true) == ""){
                    $required_values_missing = true;
                } 
            }
            if($type == "allowance"){
                $postData['fixed'] = $this->input->post('allowance_amount',true);

                if($this->input->post('allowance_amount',true) == ""){
                    $required_values_missing = true;
                } 
            }
            if($type == "tax"){
                $postData['percent'] = $this->input->post('percent',true);

                if($this->input->post('percent',true) == ""){
                    $required_values_missing = true;
                } 
            }

            // id any required fields value is missing, then give error
            if($required_values_missing){
                $this->session->set_flashdata('exception', "Please fill up all the required fields value !");
                    redirect("dashboard/rules/rules_view");
            }

            $postData['updated_at'] = date('Y-m-d h:i:s');
            $user = $this->session->userdata();
            $postData['updated_by'] = $user['id'];

            // Ends  

            if ($this->rules_model->update($postData)) {

                addActivityLog("rule", "update", $rule_id, "gmb_setup_rules", 2, $postData);

                #set success message
                $this->session->set_flashdata('message', display('save_successfully'));

            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("dashboard/rules/rules_view");

        } else {

            $this->session->set_flashdata('exception', validation_errors());
            redirect("dashboard/rules/rules_view");
        }   
    }

    public function delete_rule($rule_id = null){

        $postData = [
            'rule_id'      => $rule_id,
            'is_deleted'   => 1,
        ]; 

        if ($this->rules_model->delete($postData)) {

            

            $this->session->set_flashdata('message', display('delete_successfully'));

        } else {

            $this->session->set_flashdata('exception', display('please_try_again'));
        }

        redirect("dashboard/rules/rules_view");
    }

}



 