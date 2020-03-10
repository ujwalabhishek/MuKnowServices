<?php

class Article_department_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'article_department';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }

}
