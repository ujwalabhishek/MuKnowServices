<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Group_member_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'create_group_member';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }

    public function get_distinct_id() {
        $this->db->distinct();
        //$this->db->limit(1);
        $this->db->select('group_id');
        $query = $this->db->from("create_group_member");
        return $this->db->get()->result();
    }

}
