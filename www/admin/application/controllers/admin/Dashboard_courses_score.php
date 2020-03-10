<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_courses_score extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Courses_model');
        $this->load->model('Register_user_model');
        $this->load->model('Register_user_group_model');
        $this->load->library('Aes');
    }
    
     public function score() {
       // echo '<pre>'; print_r($id); exit; 
         if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
         
     $data['certify_user'] = $this->Courses_model->get_certificate_all_user();    
       //  echo '<pre>'; print_r($certify_user); exit; 
         
        $id = $this->uri->segment(5);
        $data['type'] = $this->uri->segment(3);
          $data['coupon'] = $this->Register_user_model->get_coupon_result($id);
          $data['subscription'] = $this->Register_user_model->get_subscription_result($id);
           //echo '<pre>'; print_r( $data['subscription']); exit;
          $data['scratchcard'] = $this->Register_user_model->get_scratchcard_result($id);
          $this->load->view('admin/dashboard_courses_score', $data);
          
       
         
     }
}