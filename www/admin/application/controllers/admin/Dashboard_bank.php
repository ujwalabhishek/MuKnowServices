<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_bank extends Admin_Controller {

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
        $this->load->model('Bank_model');
    }

    public function index() {
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        //$this->db->order_by('id','desc');
        $this->data['coupon'] = $this->Bank_model->get_all();
            $this->data['bank'] = $this->Bank_model->get();
        $this->load->view('admin/dashboard_bank', $this->data, FALSE);
    }

    function edit_coupon() {
        //print_r($_POST);exit();
        
        $bank1 = $this->input->post('bank1');
        $bank2 = $this->input->post('bank2');
        $bank3 = $this->input->post('bank3');
        $account1 = $this->input->post('account1');
        $account2 = $this->input->post('account2');
        $account3 = $this->input->post('account3');
        $account_holder_name = $this->input->post('account_holder_name');
         $helpline = $this->input->post('helpline');
          $amount = $this->input->post('amount');
           
		
		$check = $this->Bank_model->get();
		
		if(empty($check)){
			$this->session->set_flashdata('error', " Bank details doesn't exist.");
			redirect(site_url() . 'admin/Dashboard_bank');
		}
		else {
       
        $this->form_validation->set_rules('bank1', 'Bank1', 'required', array('required' => 'Please Enter %s.'));
        $this->form_validation->set_rules('bank2', 'Bank2', 'required', array('required' => 'Please Select %s.'));
        $this->form_validation->set_rules('bank3', 'Bank3', 'required', array('required' => 'Please Select %s.'));
        if ($this->session->userdata('session_data'))
            $template_data = $this->session->userdata('session_data');

        if ($this->form_validation->run() == FALSE) :
            $message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $message);

        else:
            $data_money = array(
                'bank1' => $bank1,
                'bank2' => $bank2,
                'bank3' => $bank3,
                'account1' => $account1,
                'account2' => $account2,
                'account3' => $account3,
                'account_holder_name' => $account_holder_name,
                'helpline' => $helpline,
                'amount' => $amount,
            );
            
            $this->Bank_model->update_bank($data_money);
            //print_r($data_coupon);exit();
            $this->session->set_flashdata('message', "Bank Details Updated Successfully.");
            redirect(site_url() . 'admin/Dashboard_bank');
        endif;
        redirect(site_url() . 'admin/Dashboard_bank');
		}
    }

}
