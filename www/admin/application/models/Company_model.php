<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Company_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'company_list';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
    
    
}
