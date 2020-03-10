<?php

class Feedback_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'users_feedback';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
    
    function get_feedback()
    {   
        $this->db->select('users_feedback.id as id,users_feedback.feedback,users_feedback.user_id,users.username,users_feedback.created_on,users.email,users.phone');
        $this->db->join('users','users.id=users_feedback.user_id','left');
        $this->db->order_by('id','DESC');
        return $this->db->get('users_feedback')->result();
    }
}