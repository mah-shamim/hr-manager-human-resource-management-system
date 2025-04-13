<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_model extends CI_Model {
 
    public function salary_setupView()
	{
		return $this->db->select('*')	
			->from('salary_type')
			->order_by('salary_type_id', 'desc')
			->get()
			->result();
	}
public function emp_salsetup_create($data = array())
	{
		return $this->db->insert('salary_type', $data);
	}
public function emp_salstup_delete($id = null)
	{
		$this->db->where('employee_id',$id)
			->delete('employee_salary_setup');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function delete_s_type($id = null)
	{
		$this->db->where('salary_type_id',$id)
			->delete('salary_type');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function update_em_salstup($data = array())
	{
		return $this->db->where('salary_type_id', $data["salary_type_id"])
			->update("salary_type", $data);
	}
	public function salarysetup_updateForm($id){
        $this->db->where('salary_type_id',$id);
        $query = $this->db->get('salary_type');
        return $query->row();
    }
/* Salary Setup start ****/

     public function salary_setupindex()
	{

			 return $this->db->select('count(DISTINCT(sstp.e_s_s_id)) as e_s_s_id,sstp.*,p.employee_id,p.*,pos.position_name,dpt.department_name')   
            ->from('employee_salary_setup sstp')
            ->join('employee_history p', 'sstp.employee_id = p.employee_id', 'left')
            ->join('position pos', 'pos.pos_id = p.pos_id', 'left')
            ->join('department dpt', 'dpt.dept_id = p.dept_id', 'left')
            ->group_by('sstp.employee_id')
            ->order_by('sstp.salary_type_id', 'desc')
            ->get()
            ->result();
	}
	public function salary_setup_create($data = array())
	{
		return $this->db->insert('employee_salary_setup', $data);
	}

	 public function salary_typeName()
	{
		return $this->db->select('*')	
			->from('salary_type')
	         ->where('emp_sal_type',1)
			->get()
			->result();
	}
	 public function salary_typedName()
	{
		return $this->db->select('*')	
			->from('salary_type')
	         ->where('emp_sal_type',0)
			->get()
			->result();
	}

	public function s_delete($id = null)
	{
		$this->db->where('employee_id',$id)
			->delete('employee_salary_setup');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function empdropdown()
	{
		$this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_status',1);
        $query = $this->db->get();
        $data = $query->result();
       
        $list = array('' => 'Select One...');
       	if (!empty($data) ) {
       		foreach ($data as $value) {
       			$list[$value->employee_id] = $value->first_name." ".$value->last_name;
       		} 
       	}
       	return $list;
	}

	/* salary sheet generate  */
	public function salary_genrate_create($data = array())
	{
		return $this->db->insert('salary_sheet_generate', $data);
	}
	

	public function salary_generateView($limit = null, $start = null)
	{
			 return $this->db->select('*')   
            ->from('salary_sheet_generate')
            ->group_by('ssg_id')
            ->order_by('ssg_id', 'desc')
            ->limit($limit, $start)
            ->get()
            ->result();
	}

	public function salary_gen_delete($id = null,$salname = null)
	{
		$this->db->where('ssg_id',$id)
			->delete('salary_sheet_generate');
		$this->db->where('salary_name',$salname)
			->delete('employee_salary_payment');
		$this->db->where('VNo',$salname)
			->delete('acc_transaction');	

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function update_sal_gen($data = array())
	{
		return $this->db->where('ssg_id', $data["ssg_id"])
			->update("salary_sheet_generate", $data);
	}
	public function salargen_updateForm($id){
        $this->db->where('ssg_id',$id);
        $query = $this->db->get('salary_sheet_generate');
        return $query->row();
    }
    public function salary_head_create($data = array())
	{
		return $this->db->insert('salary_setup_header', $data);
	}

/* salary setup Update ********************************************/

public function update_sal_stup($data = array())
	{
		$term = array('employee_id' => $data['employee_id'], 'salary_type_id' => $data['salary_type_id']);

		return $this->db->where($term)
			->update("employee_salary_setup", $data);
	}

	public function update_sal_head($data = array())
	{
		return $this->db->where('employee_id', $data["employee_id"])
			->update("salary_setup_header", $data);
	}

	public function salary_s_updateForm($id){
        $this->db->where('employee_id',$id);
        $query = $this->db->get('employee_salary_setup','salary_setup_header');
        return $query->row();
    }
/* salary setup Update ********************************************/



    public function salary_amount($id)
	{
		return $result = $this->db->select('employee_salary_setup.*,salary_type.*')	
			 ->from('employee_salary_setup')
			 ->join('salary_type','salary_type.salary_type_id=employee_salary_setup.salary_type_id')
	         ->where('employee_salary_setup.employee_id',$id)
	         ->where('emp_sal_type',1)
			 ->get()
			 ->result();
	}
	 public function salary_amountlft($id)
	{
		return $result = $this->db->select('employee_salary_setup.*,salary_type.*')	
			 ->from('employee_salary_setup')
			 ->join('salary_type','salary_type.salary_type_id=employee_salary_setup.salary_type_id')
	         ->where('employee_salary_setup.employee_id',$id)
	         ->where('emp_sal_type',0)
			 ->get()
			 ->result();
	}




	public  function get_empid($id)
    {
        $query=$this->db->get_where('employee_salary_setup',array('employee_id'=>$id));
        return $query->row_array();
    } 
    public  function get_type($id)
    {
       
        return $result = $this->db->select('sal_type')
                       ->from('employee_salary_setup')
                       ->where('employee_id',$id)
                       ->get()
                       ->row_array();
    } 


    public function type()
	{
		$this->db->select('*');
        $this->db->from('employee_salary_setup');
        $query = $this->db->get();
        $data = $query->result();
       
        $list = array('' => 'Select One...');
       	if (!empty($data) ) {
       		foreach ($data as $value) {
       			$list[$value->sal_type] = $value->sal_type;
       		} 
       	}
       	return $list;
	}

	public function payable()
	{
		$this->db->select('*');
        $this->db->from('salary_setup_header');
        $query = $this->db->get();
        $data = $query->result();
       
         $list = array('' => 'Select One...');
       	if (!empty($data) ) {
       		foreach ($data as $value) {
       			$list[$value->salary_payable] = $value->salary_payable;
       		} 
       	}
       	return $list;
	}
	public  function get_payable($id)
    {
        
        return $result = $this->db->select('salary_payable')
                       ->from('salary_setup_header')
                       ->where('employee_id',$id)
                       ->get()
                       ->row_array();
    } 


public function create_employee_payment($data = array())
	{
		return $this->db->insert('employee_salary_payment', $data);

	}
	// employee Information
	public function employee_informationId($id)
	{
		return $result = $this->db->select('rate,rate_type')
                       ->from('employee_history')
                       ->where('employee_id',$id)
                       ->get()
                       ->row();

	}


	    public function salary_addition_fields($id)
	{
		return $result = $this->db->select('employee_salary_setup.*,salary_type.*')	
			 ->from('employee_salary_setup')
			 ->join('salary_type','salary_type.salary_type_id=employee_salary_setup.salary_type_id')
	         ->where('employee_salary_setup.employee_id',$id)
	         ->where('emp_sal_type',1)
			 ->get()
			 ->result();
	}

		 public function salary_deduction_fields($id)
	{
		return $result = $this->db->select('employee_salary_setup.*,salary_type.*')	
			 ->from('employee_salary_setup')
			 ->join('salary_type','salary_type.salary_type_id=employee_salary_setup.salary_type_id')
	         ->where('employee_salary_setup.employee_id',$id)
	         ->where('emp_sal_type',0)
			 ->get()
			 ->result();
	}

	public function salary_paymentinfo($id = null){
			return $this->db->select('count(DISTINCT(pment.emp_sal_pay_id)) as emp_sal_pay_id,pment.*,p.employee_id,p.first_name,p.last_name,desig.position_name,p.rate as basic,p.rate_type as salarytype')   
            ->from('employee_salary_payment pment')
            ->join('employee_history p', 'pment.employee_id = p.employee_id', 'left')
            ->join('position desig', 'desig.pos_id = p.pos_id', 'left')
            ->where('pment.emp_sal_pay_id',$id)
            ->group_by('pment.emp_sal_pay_id')
            ->get()
            ->result_array();

	}
	public function setting()
	{
		return $this->db->get('setting')->row();
	}

	public function gmb_salary_generateView($limit = null, $start = null)
	{
			 return $this->db->select('ssg.*,u.firstname,u.lastname,uu.firstname as firstname_apv_by,uu.lastname as lastname_apv_by')   
            ->from('gmb_salary_sheet_generate ssg')
            ->join('user u', 'ssg.generate_by = u.id', 'left')
            ->join('user uu', 'ssg.approved_by = uu.id', 'left')
            ->order_by('ssg_id', 'desc')
            ->limit($limit, $start)
            ->get()
            ->result();
	}

	public function gmb_salary_generate_delete($id = null,$salname = null)
	{
		$this->db->where('ssg_id',$id)
			->delete('gmb_salary_sheet_generate');
		$this->db->where('sal_month_year',$salname)
			->delete('gmb_salary_generate');
	

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function emp_salary_paymentView($limit = null, $start = null)
	{
			return $this->db->select('count(DISTINCT(pment.id)) as emp_sal_pay_id,pment.*,p.employee_id,p.first_name,p.last_name')   
            ->from('gmb_salary_generate pment')
            ->join('employee_history p', 'pment.employee_id = p.employee_id', 'left')
            ->group_by('pment.id')
            ->order_by('pment.id', 'desc')
            ->limit($limit, $start)
            ->get()
            ->result();
	}

	public function salary_sheet_generate_info($ssg_id)
	{

		$salary_sheet_generate_info = $this->db->select('*')
                       ->from('gmb_salary_sheet_generate')
                       ->where('ssg_id',$ssg_id)
                       ->get()
                       ->row();
                       
        return $salary_sheet_generate_info;
	}


	public function employee_salary_charts($ssg_id)
	{
			$salary_sheet_generate_info = $this->db->select('*')
                       ->from('gmb_salary_sheet_generate')
                       ->where('ssg_id',$ssg_id)
                       ->get()
                       ->row();

			return $this->db->select('count(DISTINCT(pment.id)) as emp_sal_pay_id,pment.*,p.employee_id,p.first_name,p.last_name')   
            ->from('gmb_salary_generate pment')
            ->join('employee_history p', 'pment.employee_id = p.employee_id', 'left')
            ->group_by('pment.id')
            ->order_by('pment.id', 'desc')
            ->where('pment.sal_month_year',$salary_sheet_generate_info->name)
            ->get()
            ->result();
	}

	/* Payroll related functionality starts from 16th april 2022*/

	public function salary_advance_deduction($emp_id,$salary_month)
	{

		$query = 'SELECT * FROM `gmb_salary_advance` WHERE `salary_month` = '."'".$salary_month."'".' AND `employee_id` = '.$emp_id.' AND (`amount` - `release_amount`) > 0';

		return $this->db->query($query)->row();
	}

	public function update_sal_advance($data = array())
	{


		return $this->db->where('id', $data['id'])
			->update("gmb_salary_advance", $data);
	}

	public function loan_installment_deduction($emp_id)
	{
		$loan_status = 1;

		$query = 'SELECT * FROM `grand_loan` WHERE `employee_id` = '.$emp_id.' AND `loan_status` = '.$loan_status.' AND (`installment_period` - `installment_cleared`) > 0';

		return $this->db->query($query)->row();
	}

	public function update_loan_installment($data = array())
	{


		return $this->db->where('loan_id', $data['loan_id'])
			->update("grand_loan", $data);
	}

	public function employee_salary_generate_info($id)
	{

		return $this->db->select('pment.*,p.employee_id,p.first_name,p.last_name')   
        ->from('gmb_salary_generate pment')
        ->join('employee_history p', 'pment.employee_id = p.employee_id', 'left')
        ->where('pment.id', $id)
        ->get()
        ->row();
	}

	// employee Information
	public function employee_info($id)
	{
		return $result = $this->db->select('emp.*,p.position_name')
                       ->from('employee_history emp')
                       ->join('position p', 'emp.pos_id = p.pos_id', 'left')
                       ->where('employee_id',$id)
                       ->get()
                       ->row();

	}

	// employee Information
	public function payment_natures()
	{
		$results = $this->db->select('HeadCode,HeadName,PHeadName,IsActive,isCashNature,isBankNature')
                       ->from('acc_coa')
                       ->where('isCashNature',1)
                       ->or_where('isBankNature',1)
                       ->get()
                       ->result();

        $respo_arr = array();
        foreach ($results as $key => $value) {
        	if($value->IsActive == 1){
        		$respo_arr[$value->HeadCode] = $value->HeadName;
        	}
        }
        return $respo_arr;

	}

	// employee Information
	public function payment_natures_bank()
	{
		$results = $this->db->select('HeadCode,HeadName,PHeadName,IsActive,isCashNature,isBankNature')
                       ->from('acc_coa')
                       ->or_where('isBankNature',1)
                       ->get()
                       ->result();

        $respo_arr = array();
        foreach ($results as $key => $value) {
        	if($value->IsActive == 1){
        		$respo_arr[$value->HeadCode] = $value->HeadName;
        	}
        }
        return $respo_arr;

	}

	public function update_salary_as_approved($ssg_id,$data = array())
	{
		return $this->db->where('ssg_id', $ssg_id)
			->update("gmb_salary_sheet_generate", $data);
	}


}
