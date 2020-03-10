<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_payment extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->original_path = 'assets/uploads/category_image';
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('Image_upload_model');
        $this->load->model('Category_model');
        $this->load->library('smiles_file');
        $this->load->model('Articles_model');
        $this->load->model('Articles_view_model');
        $this->load->model('Payment_model');
    }

    public function index() {
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        //$this->db->order_by('id','desc');
        $this->data['payment'] = $this->Payment_model->get_payment_all();
        
//echo '<pre>'; print_r($this->data['feedback']); exit;
        $this->load->view('admin/dashboard_payment', $this->data, FALSE);
    }
	public function telenor() {
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        //$this->db->order_by('id','desc');
        $this->data['payment'] = $this->Payment_model->get_payment_all_telenor();
        
//echo '<pre>'; print_r($this->data['feedback']); exit;
        $this->load->view('admin/dashboard_payment_telenor', $this->data, FALSE);
    }
    

}
