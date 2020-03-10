<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Course_subscription_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'course_subscription';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
    
    function get_notify() {
        $check_day1 = date("Y-m-d", strtotime("+0 days"));
        $check_day2 = date("Y-m-d", strtotime("+2 days"));
        $sql = "SELECT * from course_subscription where id IN (SELECT MAX(id) FROM course_subscription GROUP BY user_id) AND (end_date BETWEEN '$check_day1' AND '$check_day2');";
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
        $sql = "SELECT * from course_subscription where id IN (SELECT MAX(id) FROM course_subscription GROUP BY user_id) AND (end_date = '$today');";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }
    
    
    
     function get_scratchcard($id,$date)
    {
        $this->db->where('user_id',$id);
        $this->db->where('scratchcard_id !=','Null');
        $this->db->where('end_date >=',$date);
        return $this->db->get('course_subscription')->result();
    }
	
	function get_max_id($user_id)
    {
        $sql = "SELECT max(id) as id from course_subscription where user_id = $user_id;";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }
    function get_max_subscription_check($user_id,$author_id,$courses_id)
    {
        $sql = "SELECT max(id) as id, DATE_FORMAT(end_date, '%Y-%m-%d')  from course_subscription where user_id = $user_id and author_id = $author_id and courses_id = $courses_id and DATE(end_date) > CURDATE();";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows()) {
          
            return $query->row();
        } else {
            return 0;
        }
    }
    
}
