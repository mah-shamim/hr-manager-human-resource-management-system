<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurements_model extends CI_Model {

    public function empdropdown()
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
                $list[$value->employee_id] = $value->first_name." ".$value->last_name;
            } 
        }
        return $list;
    }

    public function departmentdrpdown()
    {
        $this->db->select('*');
        $this->db->from('department');
        $query = $this->db->get();
        $data = $query->result();
       
        $list = array('' => 'Select One...');
        if (!empty($data) ) {
            foreach ($data as $value) {
                $list[$value->dept_id ] = $value->department_name;
            } 
        }
        return $list;
    }

    public function request_data(){

        return $result = $this->db->select('procurement_request_form.*,e.first_name,e.last_name,d.department_name') 
             ->from('procurement_request_form')
             ->join('employee_history e', 'procurement_request_form.requesting_person = e.employee_id', 'left')
             ->join('department d', 'procurement_request_form.requesting_dept = d.dept_id ', 'left')
             ->order_by('procurement_request_form.request_form_id','desc')
             ->get()
             ->result();
    }

    public function single_request_data($id){
          return $result = $this->db->select('procurement_request_form.*,e.first_name,e.last_name,d.department_name') 
             ->from('procurement_request_form')
             ->join('employee_history e', 'procurement_request_form.requesting_person = e.employee_id', 'left')
             ->join('department d', 'procurement_request_form.requesting_dept = d.dept_id ', 'left')
             ->where('procurement_request_form.request_form_id', $id)
             ->get()
             ->row();
    }

    public function request_item_list($id){

        $this->db->select('procurement_items.*,u.unit as unit_name');
        $this->db->from('procurement_items');
        $this->db->join('units u', 'procurement_items.unit = u.id', 'left');
        $this->db->where('procurement_items.form_id', $id);
        $this->db->where('procurement_items.item_type', "request");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    public function create_request($data = []){

        $user = $this->session->userdata();

        $data['created_at'] = date("Y-m-d h:i:sa");
        $data['cteated_by'] = $user['id'];

        return $this->db->insert('procurement_request_form',$data);
    }

    public function update_request($data = [])
    {
        $user = $this->session->userdata();

        $request_form_id = $data['request_form_id'];
        unset($data['request_form_id']);
        
        $data['update_at'] = date("Y-m-d h:i:sa");
        $data['update_by'] = $user['id'];

        return $this->db->where('request_form_id',$request_form_id)
            ->update('procurement_request_form',$data); 
    } 

    public function update_request_from_quote($data = [] , $request_form_id)
    {
        $user = $this->session->userdata();
        
        $data['update_at'] = date("Y-m-d h:i:sa");
        $data['update_by'] = $user['id'];

        return $this->db->where('request_form_id',$request_form_id)
            ->update('procurement_request_form',$data);
    } 

    public function delete_request($id){

        $this->db->where('form_id', $id)
            ->where('item_type', "request")
            ->delete("procurement_items");
        $this->db->where('request_form_id', $id)
            ->delete("procurement_request_form");

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function all_units(){

        return $result = $this->db->select('*') 
             ->from('units')
             ->get()
             ->result();
    }

    /*handling units database starts*/
    public function unit_create($data = array())
    {
        $user = $this->session->userdata();
        $data['created_by'] = $user['id'];
        $data['created_at'] = date("Y-m-d h:i:sa");

        return $this->db->insert('units', $data);
    }

    public function findById_unit($id = null)
    { 
        return $this->db->select("*")->from("units")
            ->where('id',$id)
            ->get()
            ->row();

    } 

     public function unit_update($data = [])
    {
        $user = $this->session->userdata();
        $data['update_by'] = $user['id'];
        $data['update_at'] = date("Y-m-d h:i:sa");

        return $this->db->where('id',$data['id'])
            ->update('units',$data); 
    } 

    public function unit_delete($id = null)
    {
        $this->db->where('id',$id)
            ->delete('units');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function unit_list()
    {
        $this->db->select('*');
        $this->db->from('units');
        $this->db->order_by('unit', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    /*Quotation starts*/

    public function quotation_data(){

        return $result = $this->db->select('*') 
             ->from('procurement_quotation')
             ->order_by('quotation_form_id','desc')
             ->get()
             ->result();
    }

    public function single_quotaion_data($id){
          return $result = $this->db->select('*') 
             ->from('procurement_quotation')
             ->where('quotation_form_id', $id)
             ->get()
             ->row();
    }

    public function get_quotaion_data_from_request($id){
          return $result = $this->db->select('*') 
             ->from('procurement_quotation')
             ->where('request_form_id', $id)
             ->get()
             ->row();
    }

    public function create_quote($data = []){

        $vendor_info = $this->single_vendor_data($data['vendor_id']);

        $user = $this->session->userdata();

        $data['created_by'] = $user['id'];
        $data['name_of_company'] = $vendor_info->vendor_name;

        return $this->db->insert('procurement_quotation',$data);
    }

    public function update_quote($data = [])
    {
        $user = $this->session->userdata();

        $quotation_form_id = $data['quotation_form_id'];
        unset($data['quotation_form_id']);
        
        $data['update_date'] = date("Y-m-d h:i:sa");
        $data['updated_by'] = $user['id'];

        return $this->db->where('quotation_form_id',$quotation_form_id)
            ->update('procurement_quotation',$data); 
    } 

    public function quotaion_item_list($id){
        $this->db->select('procurement_items.*,u.unit as unit_name');
        $this->db->from('procurement_items');
        $this->db->join('units u', 'procurement_items.unit = u.id', 'left');
        $this->db->where('procurement_items.form_id', $id);
        $this->db->where('procurement_items.item_type', "quote");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    public function request_is_quoted($id){

        $data['quoted'] = 1;

        return $this->db->where('request_form_id',$id)
            ->update('procurement_request_form',$data);
    }

    public function delete_quotation($id){

        $this->db->where('form_id', $id)
            ->where('item_type', "quote")
            ->delete("procurement_items");
        $this->db->where('quotation_form_id', $id)
            ->delete("procurement_quotation");

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    /*Quotation ends*/

    /*Bid analysis starts*/

    public function bid_analysis_data(){

        return $result = $this->db->select('*') 
             ->from('procurement_bid_analysis')
             ->order_by('bid_analysis_form_id','desc')
             ->get()
             ->result();
    }

    public function create_bid($data = []){

        $user = $this->session->userdata();

        $data['created_by'] = $user['id'];

        return $this->db->insert('procurement_bid_analysis',$data);
    }

    public function single_bid_analysis($id){
          return $result = $this->db->select('*') 
             ->from('procurement_bid_analysis')
             ->where('bid_analysis_form_id', $id)
             ->get()
             ->row();
    }

    public function bid_analysis_items($id){
        $this->db->select('procurement_items.*,u.unit as unit_name');
        $this->db->from('procurement_items');
        $this->db->join('units u', 'procurement_items.unit = u.id', 'left');
        $this->db->where('procurement_items.form_id', $id);
        $this->db->where('procurement_items.item_type', "bid");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    public function update_bid($data = [])
    {
        $user = $this->session->userdata();

        $bid_analysis_form_id  = $data['bid_analysis_form_id'];
        unset($data['bid_analysis_form_id']);
        
        $data['update_date'] = date("Y-m-d");
        $data['update_by'] = $user['id'];

        return $this->db->where('bid_analysis_form_id',$bid_analysis_form_id)
            ->update('procurement_bid_analysis',$data); 
    }

    public function delete_bid($id){

        $this->db->where('form_id', $id)
            ->where('item_type', "bid")
            ->delete("procurement_items");

        $this->db->where('bid_id', $id)
          ->where('type',"bid")
          ->delete("procurement_commitee_list");

        $this->db->where('bid_analysis_form_id ', $id)
            ->delete("procurement_bid_analysis");

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function quote_list()
    {
        $this->db->select('quotation_form_id,request_form_id,pin_or_equivalent,create_date');
        $this->db->from('procurement_quotation');
        $this->db->order_by('quotation_form_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Quote list for bid analysis , where only quotes which are not used for a bid will show
    public function bid_quote_list()
    {
        $where = "bid_analysis_id is NULL";

        $this->db->select('quotation_form_id,request_form_id,pin_or_equivalent,create_date');
        $this->db->from('procurement_quotation');
        $this->db->where($where);
        $this->db->order_by('quotation_form_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Quote list for purchase order , where only quotes which are used for bid and not used in purchase order will show
    public function purchase_quote_list()
    {
        $where_bid_analysis = "bid_analysis_id is not NULL";
        $where_purchase_order_id = "purchase_order_id is NULL";
        
        $this->db->select('quotation_form_id,request_form_id,pin_or_equivalent,create_date');
        $this->db->from('procurement_quotation');
        $this->db->where($where_bid_analysis);
        $this->db->where($where_purchase_order_id);
        $this->db->order_by('quotation_form_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //updating quote from bis_analysis

    public function quote_update_from_bid($data = [])
    {
        $quotation_form_id = $data['quotation_id'];
        unset($data['quotation_id']);

        return $this->db->where('quotation_form_id',$quotation_form_id)
            ->update('procurement_quotation',$data);
    } 

    //updating quote from bis_analysis

    public function quote_update_from_purchase($data = [])
    {
        $quotation_form_id = $data['quotation_id'];
        unset($data['quotation_id']);

        return $this->db->where('quotation_form_id',$quotation_form_id)
            ->update('procurement_quotation',$data);
    } 

    /*Bid analysis ends*/

    /*Purchase Order starts*/

    public function purchase_order_data(){

        return $result = $this->db->select('*') 
             ->from('procurement_purchase_order')
             ->order_by('purchase_order_id','desc')
             ->get()
             ->result();
    }

    public function bid_list()
    {
        $this->db->select('bid_analysis_form_id,quotation_form_id,sba_no,create_date');
        $this->db->from('procurement_bid_analysis');
        $this->db->order_by('create_date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function create_purchase_order($data = []){

        $user = $this->session->userdata();

        $data['created_by'] = $user['id'];
        $data['created_date'] = date("Y-m-d");

        return $this->db->insert('procurement_purchase_order',$data);
    }

    public function update_purchase_order($data = [])
    {
        $user = $this->session->userdata();

        $purchase_order_id = $data['purchase_order_id'];
        unset($data['purchase_order_id']);
        
        $data['updated_date'] = date("Y-m-d");
        $data['updated_by'] = $user['id'];

        return $this->db->where('purchase_order_id',$purchase_order_id)
            ->update('procurement_purchase_order',$data);
    }

    public function single_purchase_order_data($id){
          return $result = $this->db->select('*') 
             ->from('procurement_purchase_order')
             ->where('purchase_order_id', $id)
             ->get()
             ->row();
    }

    public function purchase_order_item_list($id){
        $this->db->select('procurement_items.*,u.unit as unit_name');
        $this->db->from('procurement_items');
        $this->db->join('units u', 'procurement_items.unit = u.id', 'left');
        $this->db->where('procurement_items.form_id', $id);
        $this->db->where('procurement_items.item_type', "purchase_order");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    public function delete_purchase_order($id){

        $this->db->where('form_id', $id)
            ->where('item_type', "purchase_order")
            ->delete("procurement_items");
        $this->db->where('purchase_order_id', $id)
            ->delete("procurement_purchase_order");

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    //updating purchase_order from good_received

    public function purchase_update_from_good_received($data = [])
    {
        $purchase_order_id = $data['purchase_order_id'];
        unset($data['purchase_order_id']);

        return $this->db->where('purchase_order_id',$purchase_order_id)
            ->update('procurement_purchase_order',$data);
    } 

    /*Purchase Order ends*/

    /*Good Received Starts*/

    public function good_received_data(){

        return $result = $this->db->select('*') 
             ->from('procurement_good_received')
             ->order_by('good_received_id','desc')
             ->get()
             ->result();
    }

    public function purchase_order_list()
    {
        $this->db->select('purchase_order_id ,good_received_id,authorizer_name,created_date');
        $this->db->from('procurement_purchase_order');
        $this->db->order_by('created_date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function create_good_received($data = []){

        $user = $this->session->userdata();

        $data['created_by'] = $user['id'];

        return $this->db->insert('procurement_good_received',$data);
    }

    public function update_good_received($data = [])
    {
        $user = $this->session->userdata();

        $good_received_id = $data['good_received_id'];
        unset($data['good_received_id']);
        
        $data['updated_date'] = date("Y-m-d");
        $data['updated_by'] = $user['id'];

        return $this->db->where('good_received_id',$good_received_id)
            ->update('procurement_good_received',$data);
    }

    public function single_good_received_data($id){
          return $result = $this->db->select('*') 
             ->from('procurement_good_received')
             ->where('good_received_id', $id)
             ->get()
             ->row();
    }

    public function good_received_from_purchase_order($id){
          return $result = $this->db->select('*') 
             ->from('procurement_good_received')
             ->where('purchase_order_id', $id)
             ->get()
             ->row();
    }

    public function good_received_item_list($id){
        $this->db->select('procurement_items.*,u.unit as unit_name');
        $this->db->from('procurement_items');
        $this->db->join('units u', 'procurement_items.unit = u.id', 'left');
        $this->db->where('procurement_items.form_id', $id);
        $this->db->where('procurement_items.item_type', "good_received");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

     public function delete_good_received($id){

        $this->db->where('form_id', $id)
            ->where('item_type', "good_received")
            ->delete("procurement_items");
        $this->db->where('good_received_id', $id)
            ->delete("procurement_good_received");

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    // purchase order list for good_received , where only purchase order which are not used for any good_received will show
    public function good_received_purchase_order_list()
    {
        $where = "good_received_id is NULL";
        
        $this->db->select('purchase_order_id ,good_received_id,authorizer_name,created_date');
        $this->db->from('procurement_purchase_order');
        $this->db->where($where);
        $this->db->order_by('good_received_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    /*Good Received Ends*/

    /*Procurement committee Starts*/

    public function all_committee_list(){

        $where = "type is NULL";

        return $result = $this->db->select('*') 
             ->from('procurement_commitee_list')
             ->where($where)
             ->get()
             ->result();
    }

    public function bid_committee_list($bid_id){

        return $result = $this->db->select('*') 
             ->from('procurement_commitee_list')
             ->where('bid_id',$bid_id)
             ->where('type','bid')
             ->get()
             ->result();
    }

    /*handling units database starts*/
    public function committee_create($data = array())
    {
        $user = $this->session->userdata();
        $data['created_by'] = $user['id'];
        $data['created_at'] = date("Y-m-d h:i:sa");

        return $this->db->insert('procurement_commitee_list', $data);
    }

    public function findById_committee($id = null)
    { 
        return $this->db->select("*")->from("procurement_commitee_list")
            ->where('id',$id)
            ->get()
            ->row();

    } 

    public function committee_update($data = [])
    {
        $user = $this->session->userdata();
        $data['updated_by'] = $user['id'];
        $data['updated_at'] = date("Y-m-d h:i:sa");

        return $this->db->where('id',$data['id'])
            ->update('procurement_commitee_list',$data); 
    } 

     public function committee_delete($id = null)
    {
        $this->db->where('id',$id)
            ->delete('procurement_commitee_list');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    /*Procurement committee Ends*/


    /*Vendor starts*/

    public function vendor_data(){

        return $result = $this->db->select('*') 
             ->from('procurement_vendor')
             ->order_by('id','desc')
             ->get()
             ->result();
    }

    public function create_vendor($data = []){

        $user = $this->session->userdata();
        $data['created_by'] = $user['id'];
        $data['created_at'] = date("Y-m-d");

        return $this->db->insert('procurement_vendor',$data);
    }

    public function single_vendor_data($id){
          return $result = $this->db->select('*') 
             ->from('procurement_vendor')
             ->where('id', $id)
             ->get()
             ->row();
    }

    public function vendor_update($data = [])
    {
        $user = $this->session->userdata();
        $data['updated_by'] = $user['id'];
        $data['updated_at'] = date("Y-m-d");

        return $this->db->where('id',$data['id'])
            ->update('procurement_vendor',$data); 
    } 

    public function delete_vendor($id){

        $this->db->where('id', $id)
            ->delete("procurement_vendor");

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function vendor_list()
    {
        $this->db->select('id,vendor_name');
        $this->db->from('procurement_vendor');
        $this->db->order_by('vendor_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    /*Vendor Ends*/

    /*Purchase order items*/

    public function purchase_item_list($id){
        $this->db->select('procurement_items.*,u.unit as unit_name');
        $this->db->from('procurement_items');
        $this->db->join('units u', 'procurement_items.unit = u.id', 'left');
        $this->db->where('procurement_items.form_id', $id);
        $this->db->where('procurement_items.item_type', "purchase_order");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    // Creating and checking coa related data
    public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='2' And HeadCode LIKE '602020000%'");
        return $query->row();

    }
     public function create_coa($data = [])
    {
        $this->db->insert('acc_coa',$data);
        return true;
    }

    public function get_paymenthead($headname){

        $content = $this->db->select('*')->from('acc_coa')->where('PHeadName',$headname)->get()->result_array();
        $html = "";
        if (empty($content)) {
          $html .="NoT Found !";
      }else{
        // Select option created for product
          $html .="<select name=\"headcode\"   class=\"paytype form-control\" id=\"headcode\" >";
            $html .= "<option>".display('select_one')."</option>";
            foreach ($content as $coa) {
            $html .="<option value=".$coa['HeadCode'].">".$coa['HeadName']."</option>";
            } 
          $html .="</select>";
      }
      
      $data2['headcode']    = $html;
    
      return $data2;
    }

    public function acc_voucher_is_approved($id){

        $result = $this->db->select('*') 
             ->from('acc_vaucher')
             ->where('id', $id)
             ->where('isApproved', 1)
             ->get()
             ->row();

        if($result){
            return true;
        }
        return false;
    }

    public function acc_voucher_is_deleted($id){

        $result = $this->db->where('id', $id)->delete("acc_vaucher");

        if($result){
            return true;
        }
        return false;
    }


}

