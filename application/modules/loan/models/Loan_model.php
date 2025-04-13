<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan_model extends CI_Model {
 
    public function viewLoan()
	{
			    return $this->db->select('count(DISTINCT(ln.loan_id)) as loan_id,count(ln.loan_id) as l_id,ln.*,sum(ln.amount) as amount,sum(ln.repayment_amount) as repayment_amount,p.employee_id,p.first_name,p.last_name,,CONCAT_WS(" ",c.first_name,c.last_name) AS Pname')   
            ->from('grand_loan ln')
            ->join('employee_history p', 'ln.employee_id = p.employee_id')
             ->join('employee_history c', 'ln.permission_by = c.employee_id', 'left')
            ->group_by('ln.loan_id')
            ->order_by('ln.loan_id', 'desc')
            ->get()
            ->result();
	}
	 
	  public function LoanList()
	{
			    return $this->db->select('ln.*,p.first_name,p.last_name,CONCAT_WS(" ",c.first_name,c.last_name) AS Pname')   
            ->from('grand_loan ln')
            ->join('employee_history p', 'ln.employee_id = p.employee_id', 'left')
            ->join('employee_history c', 'ln.permission_by = c.employee_id', 'left')
            ->group_by('ln.loan_id')
            ->order_by('ln.loan_id', 'desc')
            ->get()
            ->result();
	}
	public function grndloan_create($data = array())
	{
		return $this->db->insert('grand_loan', $data);
	}

	public function grndloan_delete($id = null)
	{
		$this->db->where('loan_id',$id)
			->delete('grand_loan');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

    public function grndloandropdown()
	{
		$this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_status',1);
        $query = $this->db->get();
        $data = $query->result();
        $list = array('' => 'Select One...');
       	if (!empty($data) ) {
       		foreach ($data as $value) {
       			$list[$value->employee_id] = $value->first_name. $value->last_name."(".$value->employee_id.")";
       		} 
       	}
       	return $list;
	}

 public function supervisorlist()
	{
		$this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_status',1);
        $this->db->where('is_super_visor',1);
        $query = $this->db->get();
        $data = $query->result();
        $list = array('' => 'Select One...');
       	if (!empty($data) ) {
       		foreach ($data as $value) {
       			$list[$value->employee_id] = $value->first_name. $value->last_name."(".$value->employee_id.")";
       		} 
       	}
       	return $list;
	}

public function update_grndloan($data = array())
	{
		return $this->db->where('loan_id', $data["loan_id"])
			->update("grand_loan", $data);
	}
	public function grndloan_updateForm($id){
        $this->db->where('loan_id',$id);
        $query = $this->db->get('grand_loan');
        return $query->row();
    }

 public  function get_dropdown_emp_id($id)
    {
        $query=$this->db->get_where('grand_loan',array('loan_id'=>$id));
        return $query->row_array();
    } 
public  function get_install_empid($id)
    {
        $query=$this->db->get_where('loan_installment',array('loan_inst_id'=>$id));
        return $query->row_array();
    } 

	
/* ###########....Employee Salary Setup Start ....##################################  */

public function installment_view()
	{
			 return $this->db->select("count(DISTINCT(ins.loan_inst_id)) as loan_inst_id,ins.*,p.employee_id,p.first_name,p.last_name,CONCAT_WS(' ', r.first_name, r.last_name) AS receiver")   
            ->from('loan_installment ins')
            ->join('employee_history p', 'ins.employee_id = p.employee_id', 'left')
             ->join('employee_history r', 'ins.received_by = r.employee_id', 'left')
            ->group_by('ins.loan_inst_id')
            ->order_by('ins.loan_inst_id', 'desc')
            ->get()
            ->result();
	}
public function installment_create($data = array())
	{
		return $this->db->insert('loan_installment', $data);
	}
public function emp_salstup_delete($id = null)
	{
		$this->db->where('emp_sal_set_id',$id)
			->delete('employee_salary_setup');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

/*  ################### dropdown installment ###### */
 public function installdropdown()
	{
		$this->db->select('grand_loan.employee_id,employee_history.first_name,employee_history.last_name');
        $this->db->from('grand_loan');
        $this->db->join('employee_history','grand_loan.employee_id =employee_history.employee_id','left');
        $this->db->group_by('grand_loan.loan_id');
        $this->db->order_by('grand_loan.loan_id','desc');
        $query = $this->db->get();
        $data = $query->result();
        $list = array('' => 'Select One...');
       	if (!empty($data) ) {
       		foreach ($data as $value) {
       			$list[$value->employee_id] = $value->first_name.' '.$value->last_name;
       		} 
       	}
       	return $list;
	}

	 public function receiverdropdown()
	{
		$this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('employee_status',1);
        $this->db->where('is_super_visor',1);
        $query = $this->db->get();
        $data = $query->result();
        $list = array('' => 'Select One...');
       	if (!empty($data) ) {
       		foreach ($data as $value) {
       			$list[$value->employee_id] = $value->first_name.' '.$value->last_name;
       		} 
       	}
       	return $list;
	}


public function autoincrement() {
	$data = $this->db->select_max('installment_no')->from('loan_installment')->get()->result();
	return $data;
}




/*  ################### dropdown installment ###### */
	public function update_loanInstall($data = array())
	{
		return $this->db->where('loan_inst_id', $data["loan_inst_id"])
			->update("loan_installment", $data);
	}
	public function installUpdate($id){
        $this->db->where('loan_inst_id',$id);
        $query = $this->db->get('loan_installment');
        return $query->row();
    }
   
 

	public function install_delete($id = null)
	{
		$this->db->where('loan_inst_id',$id)
			->delete('loan_installment');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

/* ######### Loan Report ################### start */

public function report_loan($id = null,$start_date = null,$end_date = null){
	$this->db->select('d.employee_id,d.pos_id,d.first_name,d.last_name,d.picture,b.date_of_approve,b.amount,b.installment,b.loan_id,b.repayment_amount');    
$this->db->from('grand_loan b');
$this->db->join('employee_history d', 'b.employee_id = d.employee_id','left');
$this->db->join('loan_installment c', 'b.employee_id = c.employee_id','left');
$this->db->where('b.employee_id', $id );
$this->db->where('b.date_of_approve >=', $start_date);
$this->db->where('b.date_of_approve <=', $end_date);
$this->db->group_by('b.loan_id');
$query = $this->db->get();
$result = $query->result();

return $result;
}

public function report_loan_by_id($id){
	$this->db->select('d.employee_id,d.pos_id,d.first_name,d.last_name,d.picture,b.date_of_approve,b.amount,b.installment,b.loan_id,b.repayment_amount');    
$this->db->from('grand_loan b');
$this->db->join('employee_history d', 'b.employee_id = d.employee_id','left');
$this->db->join('loan_installment c', 'b.employee_id = c.employee_id','left');
$this->db->where('b.employee_id', $id );
$this->db->group_by('b.loan_id');
$query = $this->db->get();
$result = $query->result();

return $result;
}
public function emp_info($id){
$this->db->select('d.employee_id,d.pos_id,d.first_name,d.last_name,d.picture,e.position_name');    
$this->db->from('employee_history d');
$this->db->join('position e', 'e.pos_id = d.pos_id','left');
$this->db->where('d.employee_id', $id );
$query = $this->db->get();
$result = $query->row();

return $result;	
}

/* ######### Loan Report ################### End */

public function loanViewDetails($id)
	{
		return $this->db->select('*')	
			->from('loan_installment')
			->order_by('loan_inst_id', 'desc')
			->where('loan_id',$id)
			->get()
			->result();
	}



	/*Loan Installment along with salary generate From 16th april 2022*/

	// If loan is created and it's installment not paid yet or all installment not paid, then use this methos...
	public function get_unfinished_installment_loan($emp_id)
	{
		$query = 'SELECT * FROM `grand_loan` WHERE  `employee_id` = '.$emp_id.' AND (`installment_period` - `installment_cleared`) > 0';

		return $this->db->query($query)->row();
	}

	public function get_loan_by_id($id)
	{
		return $this->db->select('*')	
			->from('grand_loan')
			->where('loan_id', $id)
			->get()
			->row();
	}

	// If installment_cleared or not made any installment against the loan, then allow to edit/update the loan..
	public function loan_installment_started($emp_id,$id)
	{
		$query = 'SELECT * FROM `grand_loan` WHERE  `loan_id` = '.$id.' AND `employee_id` = '.$emp_id.' AND `installment_cleared` > 0';

		return $this->db->query($query)->row();
	}

	// If loan_installment_finished, then not allow to edit/update the loan..
	public function loan_installment_finished($emp_id,$id)
	{
		$query = 'SELECT * FROM `grand_loan` WHERE  `loan_id` = '.$id.' AND `employee_id` = '.$emp_id.' AND `employee_id` = '.$emp_id.' AND (`installment_period` - `installment_cleared`) = 0';

		return $this->db->query($query)->row();
	}

	public function report_loan_to_employee($loan_id = null){

		$this->db->select('d.employee_id,d.pos_id,d.first_name,d.last_name,d.picture,b.*');    
		$this->db->from('grand_loan b');
		$this->db->join('employee_history d', 'b.employee_id = d.employee_id','left');
		$this->db->where('b.loan_id', $loan_id );
		$query = $this->db->get();
		$result = $query->row();

		return $result;

	}


}
