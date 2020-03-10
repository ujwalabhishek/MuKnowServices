<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_courses_scratchcard extends Admin_Controller {

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
        $this->load->model('Subscription_model');
		$this->load->model('Courses_scratchcard_model');
    	$this->load->model('Courses_model');
		}

    public function index() {
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        $this->db->order_by('id','desc');
		$this->db->group_by('batch'); 
        $this->data['scratchcard'] = $this->Courses_scratchcard_model->get_all();
		
		$this->data['courses'] = $this->Courses_model->get_all(array('status' => 'Active','deleted' => '0'));

        $this->load->view('admin/dashboard_courses_scratchcard', $this->data, FALSE);
    }

    public function add_scratchcard() {
        //print_r($_POST);exit();
		$courses_id = $this->input->post('courses');
        $batch = trim($this->input->post('batch'));
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $duration = $this->input->post('duration');
        $total = $this->input->post('total');
		$comments = $this->input->post('comments');
		if($duration == 'month')
		{
			$validity = $total * 28 .' days';
		}
		else if($duration == 'year'){
			$validity = $total * 365 .' days';
		}
		$status = 0;
		
		$check_batch = $this->Courses_scratchcard_model->get_all(array('batch' => $batch));
		
		if(!empty($check_batch)){
			$this->session->set_flashdata('error', " $batch Batch is already exists. Please Use Another Batch Number.");
			redirect(site_url() . 'admin/dashboard_courses_scratchcard');
		}
		else {
		
				for ($a = 0; $a < $quantity; $a++) {
					$str = $this->random_string();
					
					$spl_char = array('@','#','$','%','^','&','*');
					$spl_char1 = array_rand($spl_char,6);
					//print_r($spl_char[$spl_char1[2]]);
					$str[2] = $spl_char[$spl_char1[2]];
					$str[5] = $spl_char[$spl_char1[3]];
					
					$check1 = $this->Courses_scratchcard_model->get_all(array('name' => $str));
					$check2 = $this->Subscription_model->get_all(array('name' => $str));
					
					if ((empty($check1)) && (empty($check2))) {
						$data_scratchcard = array(
							'courses_id' => $courses_id,
							'batch' => $batch,
							'name' => $str,
							'price' => $price,
							'comments' => $comments,
							'validity' => $validity,
							'status' => $status,
						);
					}
					$this->Courses_scratchcard_model->insert($data_scratchcard);
					echo $str;
					echo '<hr>';
				}
				
				$this->session->set_flashdata('message', "Scratch Card Added Successfully.");
				redirect(site_url() . 'admin/dashboard_courses_scratchcard');
					
		}
	}
	
	public function random_string()
	{
		$character_set_array = array();
		$character_set_array[] = array('count' => 8, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
		//$character_set_array[] = array('count' => 2, 'characters' => '@#');
		$temp_array = array();
		foreach ($character_set_array as $character_set) {
			for ($i = 0; $i < $character_set['count']; $i++) {
				$temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
			}
		}
		shuffle($temp_array);
		return implode('', $temp_array);
	}
	
	public function view_scratchcard() {
		//print_r($_POST);exit();
		
		if ($this->session->userdata('session_data'))
        $this->data = $this->session->userdata('session_data');

		$batch = $this->uri->segment(4);
		//$batch = rawurlencode($batch);
		$batch = str_replace("%20"," ", $batch);
		$this->data['batch'] = $batch;
		$this->data['scratchcard_details'] = $this->Courses_scratchcard_model->get_all(array('batch' => $batch));
		//echo $this->db->last_query();
		//print_r($this->data[scratchcard_details]);exit();
		
		$this->load->view('admin/dashboard_courses_scratchcard_details', $this->data);
		
	}

}
