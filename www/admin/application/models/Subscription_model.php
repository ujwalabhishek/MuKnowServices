<?php

class Subscription_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'subscription';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
}