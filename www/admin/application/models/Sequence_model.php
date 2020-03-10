<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Sequence_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'sequence';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
	
	function get_sequence($id) {
        $sql = "SELECT * FROM sequence WHERE FIND_IN_SET($id, group_id) and status = 'Active' and deleted = '0' order by created_on desc";
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
