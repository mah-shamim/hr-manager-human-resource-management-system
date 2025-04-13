<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {


	public function checkUser($data = array())
	{
		return $this->db->select("
				user.id, 
				CONCAT_WS(' ', user.firstname, user.lastname) AS fullname,
				user.email, 
				user.image, 
				user.last_login,
				user.last_logout, 
				user.ip_address, 
				user.status, 
				user.is_admin, 
				IF (user.is_admin=1, 'Admin', 'User') as user_level
			")
			->from('user')
			->where('email', $data['email'])
			->where('password', md5($data['password']))
			->get();
	}

	public function userPermission($id = null)
	{
		return $this->db->select("
			module.controller, 
			module_permission.fk_module_id, 
			module_permission.create, 
			module_permission.read, 
			module_permission.update, 
			module_permission.delete
			")
			->from('module_permission')
			->join('module', 'module.id = module_permission.fk_module_id', 'full')
			->where('module_permission.fk_user_id', $id)
			->get()
			->result();
	}


	public function last_login($id = null)
	{
		return $this->db->set('last_login', date('Y-m-d H:i:s'))
			->set('ip_address', $this->input->ip_address())
			->where('id',$this->session->userdata('id'))
			->update('user');
	}

	public function last_logout($id = null)
	{
		return $this->db->set('last_logout', date('Y-m-d H:i:s'))
			->where('id', $this->session->userdata('id'))
			->update('user');
	}

	public function profile($id = null)
	{
		return $this->db->select("
			*, 
				CONCAT_WS(' ', firstname, lastname) AS fullname,
				IF (user.is_admin=1, 'Admin', 'User') as user_level
			")
			->from("user")
			->where("id", $id)
			->get()
			->row();
	}

	public function setting($data = array())
	{
		return $this->db->where('id', $data['id'])
			->update('user', $data);
	}

	public function empnumber()
	{
		return $this->db->select('COUNT(DISTINCT(employee_id)) AS employee_id')
			->from("employee_history")
			->get()
			->row();
	}



	public function atntd()
	{
		$date=date('Y-m-d');
	    $this->db->select('*,DATE(time) as mydate');
        $this->db->from('attendance_history');
        $this->db->like('time',$date,'after');
        $this->db->group_by('uid');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}


	public function loanamnt()
	{
		
		return $this->db->select('SUM(amount) AS amount')
			->from("grand_loan")
			->get()
			->row();
	}
	

	public function atnwork(){
		
		$d=date('Y-m-d');

			$att_in = $this->db->select('MIN(time) as intime,MAX(time) as outtime,uid')
			->from('attendance_history')
			->like('time',$d,'after')
			->group_by('uid')
			->get()
			->result();

			 $idx=1;
            $totalhour=[];
            foreach ($att_in as $attendancedata) {
            	$date_a = new DateTime($attendancedata->outtime);
                $date_b = new DateTime($attendancedata->intime);
                $interval = date_diff($date_a,$date_b);
              $totalwhour = $interval->format('%h:%i:%s');
              $totalhour[$idx] = $totalwhour;
              $idx++;
            }
            $seconds = 0;
			foreach($totalhour as $t)
			{
			$timeArr = array_reverse(explode(":", $t));

			foreach ($timeArr as $key => $value)
			{
			    if ($key > 2) break;
			    $seconds += pow(60, $key) * $value;
			}

			}

			$hours = floor($seconds / 3600);
			$mins = floor(($seconds - ($hours*3600)) / 60);
			$secs = floor($seconds % 60);
			$totalworkinghours =  $hours.':'.$mins.':'.$secs;
			 $totalworkinghours = array(
             'hours' => $hours,
             'minutes' => $mins,
             'sec' => $secs
			 );
			return $totalworkinghours;

	}

// 	public function totaltransaction()
// 	{
//    $tdate=date('Y-m-d');
// 	$this->db->select('SUM(amount) AS amount');
//     $this->db->from('acn_account_transaction');
//     $this->db->join('acc_account_name','acn_account_transaction.account_id = acc_account_name.account_id');
//     $this->db->where('acc_account_name.account_type',1);
//     $this->db->where('acn_account_transaction.tran_date',$tdate);
//   $query = $this->db->get();
//  return $dtaa=$query->row();

// }

// public function totaltransactiondeduct()
// 	{
//    $tdate=date('Y-m-d');
// 	$this->db->select('SUM(amount) AS amount');
//     $this->db->from('acn_account_transaction');
//     $this->db->join('acc_account_name','acn_account_transaction.account_id = acc_account_name.account_id');
//     $this->db->where('acc_account_name.account_type',0);
//      $this->db->where('acn_account_transaction.tran_date',$tdate);

//   $query = $this->db->get();
//  return $dtaa=$query->row();

// }

 public function details($id)
    {
            return $this->db->select('*')	
			->from('notice_board')
			 ->where('notice_id',$id)
			->get()
			->result();
    }

    public function monthlyincome($year,$month){
        $head = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName','Income')->get()->result_array();
        $totalcredit = 0;
       foreach ($head as $headcode) {
       $income = $this->db->select('sum(Credit) as totalamount')->from('acc_transaction')->where('COAID',$headcode['HeadCode'])->where('YEAR(VDate)',$year)->where('MONTH(VDate)',$month)->get()->row();
       $totalcredit = $totalcredit+(!empty($income->totalamount)?$income->totalamount:0);
       }
       return (!empty($totalcredit)?$totalcredit:0);

    }
    //Expence
    public function monthlyexpense($year,$month){
    	 $head = $this->db->select('HeadCode')->from('acc_coa')->where('PHeadName','Expence')->get()->result_array();
        $totalexpense = 0;
       foreach ($head as $headcode) {
       $expense = $this->db->select('sum(Debit) as totalamount')->from('acc_transaction')->where('COAID',$headcode['HeadCode'])->where('YEAR(VDate)',$year)->where('MONTH(VDate)',$month)->get()->row();
       $totalexpense = $totalexpense+(!empty($expense->totalamount)?$expense->totalamount:0);
       }
       return (!empty($totalexpense)?$totalexpense:0);
    }

}
 