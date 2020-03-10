<?php

class Coupon_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'coupon';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
}