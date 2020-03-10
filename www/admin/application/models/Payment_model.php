<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Payment_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'payment';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
    
    
    function save_payment($data)
    {
        $this->db->insert('payment',$data);
        return $this->db->insert_id();
    }
    
    function update_payment($data)
    {
        $this->db->where('RefNumber',$data['RefNumber']);
        $this->db->update('payment',$data);
        return true;
    }
    
    function get_subscribtion($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('subscription')->row();
    }
    
    function update_usertype($userid,$type)
    {
        $this->db->where('id',$userid);
        $this->db->update('users',$type);
        return true;
    }
    
     function get_payment($id)
    {
        $this->db->where('RefNumber',$id);
        return $this->db->get('payment')->row();
    }
    function get_payment_all()
    {
       $this->db->order_by('id','DESC');
        return $this->db->get('payment')->result();
    }
	
	 function update_telenor_payment($data)
    {
        $this->db->insert('payment_telenor',$data);
        return $this->db->insert_id();
    }
	function update_telenor_payment_logs($data)
    {
        $this->db->insert('telenor_logs',$data);
        return $this->db->insert_id();
    }
	function get_telenor_subscribtion($product_code)
    {
        $this->db->where('product_code',$product_code);
        return $this->db->get('subscription')->row();
    }
	
	function get_payment_all_telenor()
    {
       $this->db->order_by('id','DESC');
        return $this->db->get('telenor_response')->result();
    }

}
