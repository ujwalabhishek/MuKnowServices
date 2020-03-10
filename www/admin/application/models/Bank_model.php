<?php

class Bank_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'money';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
    
    function update_bank($data)
    { //echo '<pre>'; print_r($data); exit;
        $this->db->where('id','1');
        $this->db->update('money',$data);
    }
}