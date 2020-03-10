<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Assessment_details_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'assessment_detail';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
    
    function get_assessment_order($id)
    {
        $this->db->where('assesment_id',$id);
        // $this->db->order_by('sort_order','ASC');
         return $this->db->get('assessment_detail')->result();
    }
    
    
    
}
