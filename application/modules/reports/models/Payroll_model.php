<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_model extends CI_Model {

    public function get_npf3_soc_sec_tax_data($sal_month_year)
    {
        return $this->db->select('gsg.*,emp.first_name,emp.last_name,emp.sos as social_security_no')   
            ->from('gmb_salary_generate gsg')
            ->join('employee_history emp', 'gsg.employee_id = emp.employee_id', 'left')
            ->where("gsg.sal_month_year", $sal_month_year)
            ->where('gsg.soc_sec_npf_tax >',0)
            ->get()
            ->result();
    }

    public function sate_income_tax_schedule_data($sal_month_year)
    {
        return $this->db->select('gsg.*,emp.first_name,emp.last_name,emp.sos as social_security_no')   
            ->from('gmb_salary_generate gsg')
            ->join('employee_history emp', 'gsg.employee_id = emp.employee_id', 'left')
            ->where("gsg.sal_month_year", $sal_month_year)
            ->where('gsg.income_tax >',0)
            ->get()
            ->result();
    }

    public function iicf3_contribution_data($sal_month_year)
    {
        return $this->db->select('gsg.*,emp.first_name,emp.last_name,emp.sos as social_security_no')   
            ->from('gmb_salary_generate gsg')
            ->join('employee_history emp', 'gsg.employee_id = emp.employee_id', 'left')
            ->where("gsg.sal_month_year", $sal_month_year)
            ->where('gsg.icf_amount >',0)
            ->get()
            ->result();
    }

    public function gra_ret_5_report_data()
    {
        return $this->db->select('gsg.employee_id,emp.first_name,emp.last_name,empf.tin_no,(sum(coalesce(gsg.gross_salary,0))) as cumilative_gross_salary,(sum(coalesce(gsg.income_tax,0))) as cumilative_income_tax')   
            ->from('gmb_salary_generate gsg')
            ->join('employee_history emp', 'gsg.employee_id = emp.employee_id', 'left')
            ->join('gmb_employee_file empf', 'gsg.employee_id = empf.employee_id', 'left')
            // ->where("gsg.sal_month_year", $sal_month_year)
            ->group_by('gsg.employee_id')
            ->get()
            ->result();

    }

     public function gra_ret_5_report_monthly($sal_month_year)
    {
        $respo = $this->db->select('gsg.employee_id,gsg.income_tax,gsg.gross_salary,gsg.sal_month_year,empf.tin_no')   
            ->from('gmb_salary_generate gsg')
            ->join('gmb_employee_file empf', 'gsg.employee_id = empf.employee_id', 'left')
            ->where("gsg.sal_month_year", $sal_month_year)
            ->get()
            ->result();

        $respo_arr = array();

        foreach ($respo as $key => $row) {

            $temp_arr = array();
            $temp_arr['income_tax']     = $row->income_tax;
            $temp_arr['gross_salary']   = $row->gross_salary;
            $temp_arr['sal_month_year'] = $row->sal_month_year;
            $temp_arr['tin_no']         = $row->tin_no;

            $respo_arr[$row->employee_id] = $temp_arr;
        }

        return $respo_arr;
        
    }

    public function social_security_npf_icf_data($sal_month_year)
    {
        return $this->db->select('gsg.*,emp.first_name,emp.last_name,emp.sos as social_security_no')   
            ->from('gmb_salary_generate gsg')
            ->join('employee_history emp', 'gsg.employee_id = emp.employee_id', 'left')
            ->where("gsg.sal_month_year", $sal_month_year)
            ->where('gsg.soc_sec_npf_tax >',0)
            ->get()
            ->result();
    }

    public function salary_confirmation_emp_list($sal_month_year)
    {
        return $this->db->select('gsg.*,emp.first_name,emp.last_name')   
            ->from('gmb_salary_generate gsg')
            ->join('employee_history emp', 'gsg.employee_id = emp.employee_id', 'left')
            ->where("gsg.sal_month_year", $sal_month_year)
            ->get()
            ->result();
    }
     

 }  
