<?php

class Articles_tag_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->load->database();
        $this -> table = 'article_tag';
		$this -> result_mode = 'object';
		$this -> primary_key = 'id';
       
    }
}