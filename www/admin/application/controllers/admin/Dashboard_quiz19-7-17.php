<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_quiz extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Register_user_model');
        $this->load->model('Register_user_group_model');
        $this->load->model('Category_model');
        $this->load->model('Ion_auth_model');
        $this->load->model('Articles_model');
        $this->load->model('Quiz_article_model');
        $this->load->library('upload');
        $this->load->model('Image_upload_model');
        $this->load->library('image_lib');
        $this->lang->load('auth');
        $this->load->library('Aes');
        $this->articleimage_original_path = 'assets/uploads/articles_image';
        $this->articlevideo_original_path = 'assets/uploads/articles_videos';
        $user_id = $this->ion_auth->user()->row()->id;
    }

    public function index() {
        $id = $this->uri->segment(5);
         if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
      
        $user_id = $this->ion_auth->user()->row()->id;
         
        if (empty($id)):
            $data['mode'] = 'quiz_add';
        else:
            $data['mode'] = 'quiz_edit';
        endif;

        $this->load->view('admin/dashboard_articles', $data);
    }

    public function edit($id) {
        $user_id = $this->Quiz_article_model->get();
        $data['mode'] = 'quiz_add';
        $this->load->view('admin/dashboard_articles', $data);
    }

    public function add_edit() {
        extract($_POST);
        //echo $article_id=$this->uri->segment('4');exit();
        $user_id = $this->ion_auth->user()->row()->id;
        //echo $this->input->post('quiz_id');exit();
        if ($this->input->post('quiz_id') == '') {
            $quiz_data = array(
            'question' => $this->input->post('question'),
            'article_id' => $article_id,
            'option1' => $this->input->post('option1'),
            'option2' => $this->input->post('option2'),
            'option3' => $this->input->post('option3'),
            'option4' => $this->input->post('option4'),
            'answer_key' => $this->input->post('answer_key'),
            );
            //print_r($quiz_data);
            //exit();
            $this->Quiz_article_model->insert($quiz_data);
            $this->session->set_flashdata('message', 'Successfully Added');
        } else {
            $quiz_data = array(
                'name' => $this->input->post('name'),
                'article_id' => $article_id,
                'option2' => $this->input->post('question'),
                'option1' => $this->input->post('option1'),
                'option2' => $this->input->post('option2'),
                'option2' => $this->input->post('option3'),
                'option2' => $this->input->post('option4')
            );
            $this->Quiz_article_model->update($this->input->post('quiz_id'), $quiz_data);
            $this->session->set_flashdata('message', 'Successfully Updated');
            //redirect(site_url() . '/admin/dashbord_category/maincategory');
        }
        redirect(site_url() . 'admin/Dashboard_articles/index/' . $user_id);
    }

}
