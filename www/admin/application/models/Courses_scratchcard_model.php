<?php

class Courses_scratchcard_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'courses_scratchcard';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
}