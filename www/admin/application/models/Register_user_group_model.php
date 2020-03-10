<?php

class Register_user_group_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->load->database();
        $this -> table = 'users_groups';
		$this -> result_mode = 'object';
		$this -> primary_key = 'id';
       
    }
}