<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Create_group_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'create_group';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
	
	function get_group() {
        //$sql1 = "SELECT distinct article_id FROM favourite_article ORDER BY created_on DESC LIMIT 5;";
        $sql = "SELECT DISTINCT g.* FROM create_group as g, create_group_member as gm WHERE gm.group_id = g.id and g.status = 'active' and g.deleted = '0';";
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
