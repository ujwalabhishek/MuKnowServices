<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Sequence_details_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'sequence_details';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
		//$this->order_by("sort_order", "asc");
    }
    
    
    
}
