<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Users_subscription_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'users_subscription';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
    
    function get_notify() {
        $check_day1 = date("Y-m-d", strtotime("+0 days"));
        $check_day2 = date("Y-m-d", strtotime("+2 days"));
        $sql = "SELECT * from users_subscription where id IN (SELECT MAX(id) FROM users_subscription GROUP BY user_id) AND (end_date BETWEEN '$check_day1' AND '$check_day2');";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }
    
    function get_today() {
        $today = date("Y-m-d", strtotime("-1 days"));
        $sql = "SELECT * from users_subscription where id IN (SELECT MAX(id) FROM users_subscription GROUP BY user_id) AND (end_date = '$today');";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }
    
    function get_coupon($id,$date)
    {
        $this->db->where('user_id',$id);
        $this->db->where('coupon_id !=','Null');
        $this->db->where('users_subscription.end_date >=',$date);
        return $this->db->get('users_subscription')->result();
    }
    
     function get_subscription($id,$date)
    {   
        $this->db->select('users_subscription.*,subscription.name,subscription.validity,subscription.created_on'); 
        $this->db->where('user_id',$id);
        $this->db->where('users_subscription.end_date >=',$date);
        $this->db->where('subscription_id !=','Null');
        $this->db->join('subscription','subscription.id=users_subscription.subscription_id','left');
        return $this->db->get('users_subscription')->result();
    }
    
     function get_scratchcard($id,$date)
    {
        $this->db->where('user_id',$id);
        $this->db->where('scratchcard_id !=','Null');
        $this->db->where('users_subscription.end_date >=',$date);
        return $this->db->get('users_subscription')->result();
    }
	
	function get_max_id($user_id)
    {
        $sql = "SELECT max(id) as id from users_subscription where user_id = $user_id;";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }
    
    
}
