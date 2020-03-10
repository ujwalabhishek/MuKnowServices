<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Smiles_microlearning_admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('Smiles_user_model');
        // $this->load->model('Posting_model');
        $this->load->model('Articles_model');
        $this->load->model('Group_member_model', 'Create_group_member_model');
    }

    public function index() {
        $user_id = $this->ion_auth->user()->row()->id;
        $this->data['approved_articles'] = $this->Articles_model->count_all_results(array('active' => '1', 'user_id' => $user_id, 'deleted' => '0'));
        $this->data['pending_articles'] = $this->Articles_model->count_all_results(array('active' > '0', 'user_id' => $user_id, 'deleted' => '0'));
        $this->data['user_id'] = $this->ion_auth->user()->row()->id;
        //$this->data['pending_articles']=$this->Create_group_member_model->count_all_results(array('active=>'0','user_id'=>$user_id,'deleted'=>'0'));
        $this->load->view('admin/dashbord_welcome', $this->data);
    }

}
