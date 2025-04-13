<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_report extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->db->query('SET SESSION sql_mode = ""');
          $this->load->model(array(
             'payroll_model'
        ));

        if (! $this->session->userdata('isLogIn')){
            redirect('login');
        }
                		 
    }

    public function npf3_soc_sec_tax_report(){

        $data['title']      = display('npf3_soc_sec_tax_report');
        $data['module']      = "reports";
        $data['page']        = "payroll/npf3_social_security_tax";
        
        echo Modules::run('template/layout', $data); 
    }

    public function get_npf3_soc_sec_tax(){

        list($year,$month) = explode('-',$this->input->post('month_year',true));

        $month_name = date("F", strtotime($year ."-". $month ."-01"));
        $sal_month_year = $month_name.' '.$year;

        $data['month']      = $month_name;
        $data['year']       = $year;
        $data['month_year'] = $this->input->post('month_year',true);
        $data['tax_data']   = $this->payroll_model->get_npf3_soc_sec_tax_data($sal_month_year);

        $data['setting'] = $this->db->get('setting')->row();
        $data['user_info'] = $this->session->userdata();

        $this->load->library('pdfgenerator');
        $dompdf = new DOMPDF();
        $dompdf->set_paper('Legal', 'landscape');
        $page = $this->load->view('reports/payroll/npf3_social_security_tax_pdf',$data,true);
        $dompdf->load_html($page);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('assets/data/pdf/npf3_social_security_tax_for_'.$data['month_year'].'.pdf', $output);
        $data['pdf']    = 'assets/data/pdf/npf3_social_security_tax_for_'.$data['month_year'].'.pdf'; 


        $data['title']      = display('npf3_soc_sec_tax_report');
        $data['module']      = "reports";
        $data['page']        = "payroll/npf3_social_security_tax";
        
        echo Modules::run('template/layout', $data);
    }

    public function sate_income_tax_report(){

        $data['title']      = display('sate_income_tax_report');
        $data['module']      = "reports";
        $data['page']        = "payroll/sate_income_tax_schedule";
        
        echo Modules::run('template/layout', $data); 
    }

    public function get_sate_income_tax_schedule(){

        list($year,$month) = explode('-',$this->input->post('month_year',true));

        $month_name = date("F", strtotime($year ."-". $month ."-01"));
        $sal_month_year = $month_name.' '.$year;

        $data['month']                 = $month_name;
        $data['year']                  = $year;
        $data['month_year']            = $this->input->post('month_year',true);
        $data['sate_incom_tax_data']   = $this->payroll_model->sate_income_tax_schedule_data($sal_month_year);

        $data['title']      = display('sate_income_tax_report');
        $data['setting'] = $this->db->get('setting')->row();
        $data['user_info'] = $this->session->userdata();

        $this->load->library('pdfgenerator');
        $dompdf = new DOMPDF();
        $dompdf->set_paper('Legal', 'landscape');
        $page = $this->load->view('reports/payroll/sate_income_tax_schedule_pdf',$data,true);
        $dompdf->load_html($page);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('assets/data/pdf/sate_income_tax_schedule_for_'.$data['month_year'].'.pdf', $output);
        $data['pdf']    = 'assets/data/pdf/sate_income_tax_schedule_for_'.$data['month_year'].'.pdf'; 

        $data['module']      = "reports";
        $data['page']        = "payroll/sate_income_tax_schedule";
        
        echo Modules::run('template/layout', $data);
    }

    public function iicf3_contribution(){

        $data['title']      = display('iicf3_contribution_report');
        $data['module']      = "reports";
        $data['page']        = "payroll/iicf3_contribution_report";
        
        echo Modules::run('template/layout', $data); 
    }

    public function get_iicf3_contribution(){

        list($year,$month) = explode('-',$this->input->post('month_year',true));

        $month_name = date("F", strtotime($year ."-". $month ."-01"));
        $sal_month_year = $month_name.' '.$year;

        $data['month']                   = $month_name;
        $data['year']                    = $year;
        $data['month_year']              = $this->input->post('month_year',true);
        $data['iicf3_contribution_data'] = $this->payroll_model->iicf3_contribution_data($sal_month_year);

        $data['setting'] = $this->db->get('setting')->row();
        $data['user_info'] = $this->session->userdata();

        $this->load->library('pdfgenerator');
        $dompdf = new DOMPDF();
        $dompdf->set_paper('Legal', 'landscape');
        $page = $this->load->view('reports/payroll/iicf3_contribution_report_pdf',$data,true);
        $dompdf->load_html($page);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('assets/data/pdf/iicf3_contribution_report_for_'.$data['month_year'].'.pdf', $output);
        $data['pdf']    = 'assets/data/pdf/iicf3_contribution_report_for_'.$data['month_year'].'.pdf'; 

        $data['title']      = display('iicf3_contribution_report');
        $data['module']      = "reports";
        $data['page']        = "payroll/iicf3_contribution_report";
        
        echo Modules::run('template/layout', $data);
    }

    public function gra_ret_5_report(){

        $data['title']      = display('gra_ret_5');
        $data['module']      = "reports";
        $data['page']        = "payroll/gra_ret_5_report";
        
        echo Modules::run('template/layout', $data); 
    }

    public function get_gra_ret_5_report(){

        list($year,$month) = explode('-',$this->input->post('month_year',true));

        $month_name = date("F", strtotime($year ."-". $month ."-01"));
        $sal_month_year = $month_name.' '.$year;

        $data['month']                   = $month_name;
        $data['year']                    = $year;
        $data['month_year']              = $this->input->post('month_year',true);
        $data['gra_ret_5_data']          = $this->payroll_model->gra_ret_5_report_data();
        $data['gra_ret_5_report_monthly']= $this->payroll_model->gra_ret_5_report_monthly($sal_month_year);

        $data['setting'] = $this->db->get('setting')->row();
        $data['user_info'] = $this->session->userdata();

        $this->load->library('pdfgenerator');
        $dompdf = new DOMPDF();
        $dompdf->set_paper('Legal', 'portrait');
        $page = $this->load->view('reports/payroll/gra_ret_5_report_pdf',$data,true);
        $dompdf->load_html($page);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('assets/data/pdf/gra_ret_5_report_for_'.$data['month_year'].'.pdf', $output);
        $data['pdf']    = 'assets/data/pdf/gra_ret_5_report_for_'.$data['month_year'].'.pdf'; 

        $data['title']      = display('gra_ret_5');
        $data['module']      = "reports";
        $data['page']        = "payroll/gra_ret_5_report";
        
        echo Modules::run('template/layout', $data);
    }

    public function social_security_npf_icf(){

        $data['title']      = display('social_security_npf_icf');
        $data['module']      = "reports";
        $data['page']        = "payroll/social_security_npf_icf";  
        
        echo Modules::run('template/layout', $data); 
    }

    public function get_social_security_npf_icf(){

        list($year,$month) = explode('-',$this->input->post('month_year',true));

        $month_name = date("F", strtotime($year ."-". $month ."-01"));
        $sal_month_year = $month_name.' '.$year;

        $data['month']                   = $month_name;
        $data['year']                    = $year;
        $data['month_year']              = $this->input->post('month_year',true);
        $data['soc_sec_npf_icf_data'] = $this->payroll_model->social_security_npf_icf_data($sal_month_year);

        $data['setting'] = $this->db->get('setting')->row();
        $data['user_info'] = $this->session->userdata();

        $this->load->library('pdfgenerator');
        $dompdf = new DOMPDF();
        $dompdf->set_paper('Legal', 'landscape');
        $page = $this->load->view('reports/payroll/social_security_npf_icf_pdf',$data,true);
        $dompdf->load_html($page);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('assets/data/pdf/social_security_npf_icf_for_'.$data['month_year'].'.pdf', $output);
        $data['pdf']    = 'assets/data/pdf/social_security_npf_icf_for_'.$data['month_year'].'.pdf'; 

        $data['title']      = display('social_security_npf_icf');
        $data['module']      = "reports";
        $data['page']        = "payroll/social_security_npf_icf";
        
        echo Modules::run('template/layout', $data);
    }

    public function salary_confirmation_Form(){

        $data['title']      = display('salary_confirmation_Form');
        $data['module']      = "reports";
        $data['page']        = "payroll/salary_confirmation_Form";  
        
        echo Modules::run('template/layout', $data); 
    }

    public function get_salary_confirmation_emp_list(){

        list($year,$month) = explode('-',$this->input->post('month_year',true));

        $month_name = date("F", strtotime($year ."-". $month ."-01"));
        $sal_month_year = $month_name.' '.$year;

        $data['month']                        = $month_name;
        $data['year']                         = $year;
        $data['month_year']                   = $this->input->post('month_year',true);
        $data['salary_confirmation_emp_list'] = $this->payroll_model->salary_confirmation_emp_list($sal_month_year);

        $data['setting'] = $this->db->get('setting')->row();
        $data['user_info'] = $this->session->userdata();

        $this->load->library('pdfgenerator');
        $dompdf = new DOMPDF();
        $dompdf->set_paper('Legal', 'portrait');
        $page = $this->load->view('reports/payroll/salary_confirmation_Form_pdf',$data,true);
        $dompdf->load_html($page);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('assets/data/pdf/salary_confirmation_Form_for_'.$data['month_year'].'.pdf', $output);
        $data['pdf']    = 'assets/data/pdf/salary_confirmation_Form_for_'.$data['month_year'].'.pdf'; 

        $data['title']      = display('social_security_npf_icf');
        $data['module']      = "reports";
        $data['page']        = "payroll/social_security_npf_icf";

        $data['title']      = display('salary_confirmation_Form');
        $data['module']      = "reports";
        $data['page']        = "payroll/salary_confirmation_Form";  

        // echo "<pre>";
        // print_r($data);
        // exit;
        
        echo Modules::run('template/layout', $data);
    }
 
}