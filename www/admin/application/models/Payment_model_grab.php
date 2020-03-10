<?php

class Payment_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'payment_detail';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
    
    public function get_all() {
                $this->db->select('*');
                $this->db->from('order');
                $sql = $this->db->get();
                return $sql->result_array();
            }
            
    public function get_payment_details($id) {
                $this->db->select('*');
                $this->db->from('order');
                $this->db->where('id', $id);
                $sql = $this->db->get();
                return $sql->row();
            }
    
    public function notpaid() {
        $sql = "SELECT o.id as order_id, o.uniq_id as order_uniq_id, p.transactionid as transaction_id, r.full_name as seller_name, rb.full_name as buyer_name, r.paypal_email as paypal_email, o.total_price as total_price, o.total_qty as total_qty, o.created_at as created_at, o.status as order_status  FROM `order` o, `payment_detail` p, `register_user` r, `register_user` rb where o.seller_id=r.id and o.user_id=rb.id and p.order_id=o.id AND p.payment_status='approved'  AND (o.status='payment_success' OR o.status='delivered' OR o.status='delivery_fail' OR o.status='shipped') order by order_id desc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
            }
            
    public function notpaid_details($id) {
        $sql = "SELECT o.id as order_id, o.uniq_id as order_uniq_id, r.full_name as seller_name, rb.full_name as buyer_name, r.email as email, r.gender as gender, r.paypal_email as paypal_email, r.nric_num as nric_num, r.mobile_no as mobile_no, r.country as country, r.account_number as account_number, r.account_type as account_type, r.bank_name as bank_name, r.account_name as account_name, o.total_price as total_price, o.total_qty as total_qty, o.product_type as product_type, o.delivery_type as delivery_type, o.status as delivery_status, o.delivery_datetime as delivery_datetime, o.deliveryfail_reason as deliveryfail_reason, o.reject_reason as reject_reason, o.created_at as created_at FROM `order` o, `register_user` r, `register_user` rb where o.id=$id AND o.seller_id=r.id and o.user_id=rb.id ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
            }
            
    public function paid() {
        $sql = "SELECT o.id as order_id, o.uniq_id as order_uniq_id, p.transactionid as transaction_id, r.full_name as seller_name, rb.full_name as buyer_name, r.paypal_email as paypal_email, o.total_price as total_price, o.total_qty as total_qty, o.created_at as created_at  FROM `order` o, `payment_detail` p, `register_user` r, `register_user` rb where o.seller_id=r.id and o.user_id=rb.id and p.order_id=o.id AND p.payment_status='paid'  AND (o.status='payment_success' OR o.status='delivered' OR o.status='delivery_fail' OR o.status='shipped') order by order_id desc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
            }
            
    public function paid_details($id) {
        $sql = "SELECT o.id as order_id, o.uniq_id as order_uniq_id, r.full_name as seller_name, rb.full_name as buyer_name, r.email as email, r.gender as gender, r.paypal_email as paypal_email, r.nric_num as nric_num, r.mobile_no as mobile_no, r.country as country, r.account_number as account_number, r.account_type as account_type, r.bank_name as bank_name, r.account_name as account_name, o.total_price as total_price, o.total_qty as total_qty, o.product_type as product_type, o.delivery_type as delivery_type, o.delivery_datetime as delivery_datetime, o.deliveryfail_reason as deliveryfail_reason, o.reject_reason as reject_reason, o.created_at as created_at FROM `order` o, `register_user` r, `register_user` rb where o.id=$id AND o.seller_id=r.id and o.user_id=rb.id ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
            }
    
    public function update_paid($id) {
        $sql = "UPDATE payment_detail SET payment_status='paid' WHERE order_id=$id";
        $query = $this->db->query($sql);
       
            }
            
    public function update_unpaid($id) {
        $sql = "UPDATE payment_detail SET payment_status='approved' WHERE order_id=$id";
        $query = $this->db->query($sql);
       
            }
            
    public function cancel() {
        $sql = "SELECT o.id as order_id, o.uniq_id as order_uniq_id, p.payment_fail_message as payment_fail_message, r.full_name as seller_name, rb.full_name as buyer_name, r.paypal_email as paypal_email, o.total_price as total_price, o.total_qty as total_qty, o.created_at as created_at FROM `order` o, `payment_detail` p, `register_user` r, `register_user` rb where o.seller_id=r.id and o.user_id=rb.id and p.order_id=o.id AND p.payment_status='cancelled' AND o.status='payment_fail' order by order_id desc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
            }
            
    public function cancel_details($id) {
        $sql = "SELECT o.id as order_id, o.uniq_id as order_uniq_id, r.full_name as seller_name, rb.full_name as buyer_name, r.email as email, r.gender as gender, r.paypal_email as paypal_email, r.nric_num as nric_num, r.mobile_no as mobile_no, r.country as country, r.account_number as account_number, r.account_type as account_type, r.bank_name as bank_name, r.account_name as account_name, o.total_price as total_price, o.total_qty as total_qty, o.product_type as product_type, o.delivery_type as delivery_type, o.delivery_datetime as delivery_datetime, o.deliveryfail_reason as deliveryfail_reason, o.reject_reason as reject_reason, o.created_at as created_at FROM `order` o, `register_user` r, `register_user` rb where o.id=$id AND o.seller_id=r.id and o.user_id=rb.id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
            }
            
}
?>