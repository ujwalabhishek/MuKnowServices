<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_coupon extends Admin_Controller {

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
        $this->load->model('Coupon_model');
    }

    public function index() {
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        $this->db->order_by('id','desc');
        $this->data['coupon'] = $this->Coupon_model->get_all();

        $this->load->view('admin/dashboard_coupon', $this->data, FALSE);
    }

    function add_coupon() {
        //print_r($_POST);exit();

        $code = $this->input->post('code');
        $start_date = $this->input->post('start_date');
        $expiry_date = $this->input->post('expiry_date');
		
		$check = $this->Coupon_model->get_all(array('name' => $code));
		
		if(!empty($check)){
			$this->session->set_flashdata('error', " $code Promocode already exists.");
			redirect(site_url() . 'admin/Dashboard_coupon');
		}
		else {
       
        $this->form_validation->set_rules('code', 'Code', 'required|min_length[5]|max_length[10]', array('required' => 'Please Enter %s.'));
        $this->form_validation->set_rules('start_date', 'Start Date', 'required', array('required' => 'Please Select %s.'));
        $this->form_validation->set_rules('expiry_date', 'Expiry Date', 'required', array('required' => 'Please Select %s.'));
        if ($this->session->userdata('session_data'))
            $template_data = $this->session->userdata('session_data');

        if ($this->form_validation->run() == FALSE) :
            $message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $message);

        else:
            $data_coupon = array(
                'name' => $code,
                'start_date' => $start_date,
                'end_date' => $expiry_date,
            );

            $this->Coupon_model->insert($data_coupon);
            //print_r($data_coupon);exit();
            $this->session->set_flashdata('message', "Promocode Added Successfully.");
            redirect(site_url() . 'admin/Dashboard_coupon');
        endif;
        redirect(site_url() . 'admin/Dashboard_coupon');
		}
    }

}
