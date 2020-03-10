<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashbord_slider extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->original_path = 'assets/uploads/slider_image';
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('Image_upload_model');
        $this->load->model('Slider_model');
        $this->load->library('smiles_file');
        $this->load->model('Articles_model');
        $this->load->model('Articles_view_model');
    }

    public function index() {
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        $this->data['maincategory'] = $this->Slider_model->get_all(array('deleted=' => '0'));
        
            $this->data['categories'] = $this->Slider_model->getall_slider();
        //echo '<pre>';print_r($this->data['categories']); exit;
        $this->data['mode'] = "all";
        $this->load->view('admin/dashboard_slider', $this->data, FALSE);
    }

    public function crop_page() {
        $this->load->view('admin/dashboard_slider_image_crop', $this->data, FALSE);
    }

    public function slider() {

        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        $this->data ['main_category'] = $this->Slider_model->dropdown('id', 'name');
        $this->data['categories'] = $this->Slider_model->slider();
        $this->data['mode'] = "all";
        $this->load->view('admin/dashboard_slider', $this->data, FALSE);
    }

   

    public function reorder_slider_page($id) {

        //print_r( $this->data['groupcategories']);exit();
        //echo $id = $this->uri->segment(3);exit();
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

            $this->data['categories'] = $this->Slider_model->slider();
            $this->data['category_name'] = "Main";
      
            $this->load->view('admin/dashboard_reorderslider', $this->data, FALSE);

    }

    public function save_reoderslider() {
        //echo '<pre>'; print_r($_POST); exit();
        extract($_POST);
        $id = '';
        // $id = $this->uri->segment(4);
        $category_id = json_decode($category_id, true);
        if (!empty($category_id)):
            $i = 1;
            foreach ($category_id as $category_row) {


                $cat_data = array(
                    'sort_order' => $i
                );
                // print_r($squence_det_data);exit();
                @$reorder_update = $this->Slider_model->update($category_row['id'], $cat_data);
                $this->session->set_flashdata('message', 'Reordered sucessfully.');
                $i++;
            }
//           if($reorder_update>0){
//                $this->session->set_flashdata('message', 'Reordered sucessfully.');
//
//            }
            if ($mode == "slider"):
                redirect(site_url('admin/Dashbord_slider/slider'));
            endif;
            if ($mode == "index"):
                redirect(site_url('admin/Dashbord_category/index'));
            endif;
            if ($mode == "subcategory"):
                redirect(site_url("admin/Dashbord_category/subcategory") . "/" . $mode1);
            endif;
            if ($mode == "sub_subcategory"):
                redirect(site_url("admin/Dashbord_category/sub_subcategory") . "/" . $mode1);
            endif;
        else:
            show_404();
        endif;
    }

    public function add_edit() {

        $curl = $this->input->post('curl');

        if ($this->input->post('id') == '') {
            $category = array('name' => $this->input->post('name'),
               
                'url' => $this->input->post('bm_lang_name'),
            );
            $this->Slider_model->insert($category);
            $this->session->set_flashdata('message', 'Successfully Added');
        } else {
            $category = array('name' => $this->input->post('name'),
                'url' => $this->input->post('bm_lang_name'),
            );

            $this->Slider_model->update($this->input->post('id'), $category);
            $this->session->set_flashdata('message', 'Successfully Updated');
        }
        if ($this->input->post('category_type') == 'maincategory')
            redirect(site_url() . '/admin/dashbord_slider/slider');
        else
            redirect($curl);
    }

   

    public function add_slider() {
        //print_r($_POST);exit();
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->session->userdata('session_data'))
            $template_data = $this->session->userdata('session_data');

        $template_data['upload_path_cat_img'] = $upload_path = $this->original_path;
        if ($this->form_validation->run() == FALSE) :
            $message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $message);

        else:
            //print_r($_FILES);exit();
            if (!empty($_FILES['image_file']['name'])) :

                $error = '';
                if (!file_exists($upload_path)) {
                    mkdir($upload_path);
                }
                $upload_error = array();
                $data_param['file_input_params'] = array(
                    'name' => 'image_file'
                );
                $upload_path = $this->original_path;

                if (!file_exists($upload_path)) {
                    mkdir($upload_path);
                }

                $upload_error = array();
                $upload_con = array("allowed_types" => "jpeg|jpg|png", "upload_path" => $upload_path);
                $resize_dim = array("width" => 700);

                $upload_data = $this->smiles_file->uploadforcrop($data_param['file_input_params']['name'], $upload_error, $upload_con, $resize_dim);
                //print_r($upload_data);exit();
                if (!empty($upload_data)) {

                    $template_data['upload_data'] = $upload_data;
                    //$template_data['category_name'] = $this->input->post('name');
                    $template_data['name'] = $this->input->post('name');
                    $template_data['url'] = $this->input->post('bm_lang_name');
                   // $template_data['home_front'] = $this->input->post('home_front');

                    $this->load->view('admin/dashboard_slider_image_crop', $template_data);
                } else {
                    $template_data['upload_data'] = '';
                    //print_r($upload_error);exit();
                    if (!$upload_error) {
                        $this->session->set_flashdata('error', "Please select a file to upload");
                    } else {
                        $this->session->set_flashdata('error', $upload_error);
                    }

                    redirect(site_url() . '/admin/dashbord_slider/slider');
                    exit();
                }

                $message = "Please select a image.";
                $this->session->set_flashdata('error', $message);
            endif;
        endif;
    }

    public function edit_slider() {
         //print_r($_POST);exit();
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->session->userdata('session_data'))
            $template_data = $this->session->userdata('session_data');

        $template_data['upload_path_cat_img'] = $upload_path = $this->original_path;
        if ($this->form_validation->run() == FALSE) :
            $message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $message);

        else:

            if (!empty($_FILES['image_file']['name'])) {

                $error = '';
                if (!file_exists($upload_path)) {
                    mkdir($upload_path);
                }
                $upload_error = array();
                $data_param['file_input_params'] = array(
                    'name' => 'image_file'
                );
                $upload_path = $this->original_path;

                if (!file_exists($upload_path)) {
                    mkdir($upload_path);
                }

                $upload_error = array();
                $upload_con = array("allowed_types" => "jpeg|jpg|png", "upload_path" => $upload_path);
                $resize_dim = array("width" => 700);

                $upload_data = $this->smiles_file->uploadforcrop($data_param['file_input_params']['name'], $upload_error, $upload_con, $resize_dim);
                //print_r($upload_data);exit();
                if (!empty($upload_data)) {

                    $template_data['upload_data'] = $upload_data;
                   // $template_data['category_name'] = $this->input->post('name');
                    $template_data['name'] = $this->input->post('name');
                    $template_data['url'] = $this->input->post('bm_lang_name');
                    $template_data['id'] = $this->input->post('id');
                    $template_data['imgid'] = $this->input->post('imgid');
//                    if (!empty($this->input->post('home_front'))) {
//                        $template_data['home_front'] = $this->input->post('home_front');
//                    }
                    //print_r($template_data);exit();
                    $this->load->view('admin/dashboard_slider_image_crop_edit', $template_data);
                } else {

                    $template_data['upload_data'] = '';
                    //print_r($upload_error);exit();
                    if (!$upload_error) {
                        $this->session->set_flashdata('error', "Please select a file to upload");
                    } else {
                        $this->session->set_flashdata('error', $upload_error);
                    }

                    redirect(site_url() . '/admin/dashbord_slider/slider');
                    exit();
                }

                $message = "Please select a image.";
                $this->session->set_flashdata('error', $message);
            } else {
                //echo '<pre>'; print_r($_POST); exit;
                $category = array(
                    'name' => $this->input->post('name'),
                    'url' => $this->input->post('bm_lang_name'),
                    'id' => $this->input->post('id')
                    //'home_front' => $this->input->post('home_front'),
                    //'parent_id' => 0
                );
                $this->Slider_model->update($this->input->post('id'), $category);
                redirect(site_url() . '/admin/dashbord_slider/slider');
                exit();
            }

        endif;
    }

    public function cropped_categoryimage() {

        $upload_path = $this->original_path;
        $error = '';
        if (!file_exists($upload_path)) {
            mkdir($upload_path);
        }
        $upload_error = array();
        $fileData = $this->input->post('filedata');
        $cropData = $this->input->post('crop');
        $upload_path = $this->original_path;

        if (!file_exists($upload_path)) {
            mkdir($upload_path);
        }

        $upload_error = array();
        $upload_con = array("allowed_types" => "jpeg|jpg|png", "upload_path" => $upload_path);
        $thumb_dim = array("width" => 100);
        $imagelast_id = $this->smiles_file->uploadandcrop($fileData, 0, 4, $upload_error, $upload_con, $cropData, $thumb_dim);
        if (!empty($imagelast_id)) {
            $category = array(
                'name' => $this->input->post('name'),
                'url' => $this->input->post('url'),
               // 'home_front' => $this->input->post('home_front'),
                'deleted' => '0'
            );
            $this->Slider_model->insert($category);
            $datalast_insert_id = $this->db->insert_id();
            if (!empty($datalast_insert_id)) :
                //Email Integration start here
                $img_result = $this->Image_upload_model->get($imagelast_id);
                $this->Image_upload_model->update($img_result->id, array('slider_id' => $datalast_insert_id));
                $this->session->set_flashdata('message', "Slider added successfully.");
            endif;
        } else {

            $this->session->set_flashdata('alerts', array('message' => "Unabel to upload the data.", 'type' => "alert"));
            $message = strip_tags($this->upload->display_errors());
            $this->session->set_flashdata('error', $message);
            redirect(site_url() . 'admin/dashbord_slider/slider');
            exit();
        }


        redirect($base_user_url . 'admin/dashbord_slider/slider');
    }

    public function cropped_categoryimage_edit() {
//echo '<pre>'; print_r($_POST); exit;
        $upload_path = $this->original_path;
        $error = '';
        if (!file_exists($upload_path)) {
            mkdir($upload_path);
        }
        $upload_error = array();
        $fileData = $this->input->post('filedata');
        $cropData = $this->input->post('crop');
        $upload_path = $this->original_path;
//echo '<pre>'; print_r($this->input->post('imgid')); exit;
        if (!file_exists($upload_path)) {
            mkdir($upload_path);
        }

        $upload_error = array();
        $upload_con = array("allowed_types" => "jpeg|jpg|png", "upload_path" => $upload_path);
        $thumb_dim = array("width" => 100);
        // $imagelast_id = $this->smiles_file->update_uploadandcrop($fileData, 0, 4, $upload_error, $upload_con, $cropData, $thumb_dim);
        $imagelast_id = $this->smiles_file->update_uploadandcrop($fileData, 0, 4, $this->input->post('imgid'), $upload_error, $upload_con, $cropData, $thumb_dim);

        //echo '<pre>'; print_r($imagelast_id); exit;

        if (!empty($imagelast_id)) {
            $category = array(
                'name' => $this->input->post('name'),
                'url' => $this->input->post('url'),
               // 'home_front' => $this->input->post('home_front'),
                'id' => $this->input->post('id')
                //'parent_id' => 0
            );
            $this->Slider_model->update($this->input->post('id'), $category);
            $datalast_insert_id = $this->db->insert_id();
            if (!empty($this->input->post('id'))) :
                //Email Integration start here
                $img_result = $this->Image_upload_model->get($imagelast_id);
                $this->Image_upload_model->update($img_result->id, array('slider_id' => $this->input->post('id')));
                $this->session->set_flashdata('message', "Slider Updated successfully.");
            endif;
        } else {

            $this->session->set_flashdata('alerts', array('message' => "Unabel to upload the data.", 'type' => "alert"));
            $message = strip_tags($this->upload->display_errors());
            $this->session->set_flashdata('error', $message);
            redirect(site_url() . 'admin/dashbord_slider/slider');
            exit();
        }


        redirect($base_user_url . 'admin/dashbord_slider/slider');
    }

  

    public function delete_slider() { 
        //echo 'tests';exit;
        $id = $this->input->post('ct_id');
       $data['deleted'] = '1';
        $delete = $this->Slider_model->delete_slider($id,$data);
        if(!empty($delete))
        {
            echo TRUE;
        }
        else {
            echo FALSE;
        }
        
    }

    
    

}
