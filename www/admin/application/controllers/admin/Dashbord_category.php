<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashbord_category extends Admin_Controller {

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
    }

    public function index() {
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        $this->data['maincategory'] = $this->Category_model->get_all(array('parent_id' => 0, 'deleted=' => '0'));
        $this->data['groupcategories'] = $this->Category_model->getgroup_category();
        //print_r( $this->data['groupcategories']);exit();
        if (!empty($this->data['groupcategories']->cat_id)):

            $this->data['categories'] = $this->Category_model->getall_category($this->data['groupcategories']->cat_id);
        else:
            $this->data['categories'] = array();
        endif;

        $this->data['mode'] = "all";
        $this->load->view('admin/dashboard_category', $this->data, FALSE);
    }

    public function crop_page() {
        $this->load->view('admin/dashboard_category_image_crop', $this->data, FALSE);
    }

    public function maincategory() {

        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        $this->data ['main_category'] = $this->Category_model->dropdown('id', 'name');
        $this->data['categories'] = $this->Category_model->maincategory();
        $this->data['mode'] = "all";
        $this->load->view('admin/dashboard_category', $this->data, FALSE);
    }

    public function subcategory($id) {
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        $this->data['maincategory'] = $this->Category_model->get_all('parent_id', 0);
        $this->data['mode'] = 'sub1';
        $this->data['categories'] = $this->Category_model->getall_subcategory($id);
        //  echo '<pre>'; print_r($this->data['categories']); exit;
        $this->data['sub_category'] = $this->Category_model->get($id);
        $this->load->view('admin/dashboard_category', $this->data, FALSE);
    }

    public function sub_subcategory($id) {
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        $this->data['maincategory'] = $this->Category_model->get_all('parent_id', 0);
        $this->data['mode'] = 'sub2';
        $this->data['categories'] = $this->Category_model->getall_subcategory($id);
        $this->data['sub_category'] = $this->Category_model->get($id);
        $this->load->view('admin/dashboard_category', $this->data, FALSE);
    }

    public function reorder_category_page($id) {

        //print_r( $this->data['groupcategories']);exit();
        //echo $id = $this->uri->segment(3);exit();
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');

        if ($id == 'index'):
$this->data['category_name'] = "Main";
            $result1 = array();
            $result2 = array();
            $this->db->order_by('sort_order', 'ASC');
            $categories = $this->Category_model->get_all_admin_categories(array('parent_id' => 0, 'deleted' => '0'));
            if (!empty($categories)) {
                foreach ($categories as $row) {

                    $subcategories = $this->Category_model->get_all_admin_subcategories(array('parent_id' => $row->id, 'deleted' => '0'));
                    if (!$subcategories) {
                        $categories_list = null;
                    } else {
                        foreach ($subcategories as $subcategories_row) {
                            //echo "<pre>";
                            //print_r($subcategories_row);exit();
                            $subcategories_child = $this->Category_model->count_all_results(array('parent_id' => $subcategories_row->id, 'deleted' => '0'));

                            if ($subcategories_child > 0) {
                                $subcategories_child_count = '1';
                            } else {
                                $subcategories_child_count = '0';
                            }
                            $subcategories_menu = array(
                                'id' => $subcategories_row->id,
                                'name' => $subcategories_row->name,
                                'parent_id' => $subcategories_row->parent_id,
                                'deleted' => $subcategories_row->deleted,
                                'created_on' => $subcategories_row->created_on,
                                'child_cat' => $subcategories_child_count
                            );
                            array_push($result2, $subcategories_menu);
                        }
                    }

                    $categories_list = array(
                        'id' => $row->id,
                        'name' => $row->name,
                        'parent_id' => $row->parent_id,
                        'created_on' => $row->created_on,
                      //  'photo_cat' => $photo_cat,
                      //  'photo_cat_thumb' => $photo_cat_thumb,
                        'subcategories' => $result2,
                    );
                    array_push($result1, $categories_list);
                    $result2 = array();
                }
            }
           // print_r($result1);
            //exit;
            $this->data['categories'] = $result1; elseif ($id == 'subcategory'):
            $id1 = $this->uri->segment(5);
            $this->data['categories'] = $this->Category_model->getall_subcategory($id1);
            $this->data['category_name'] = "Sub";

          elseif ($id == 'subcategory'):
            $id1 = $this->uri->segment(5);
            $this->data['categories'] = $this->Category_model->getall_subcategory($id1);
            $this->data['category_name'] = "Sub-Sub";


        elseif ($id == 'sub_subcategory'):
            $id1 = $this->uri->segment(5);
            $this->data['categories'] = $this->Category_model->getall_subcategory($id1);
            $this->data['category_name'] = "Sub-Sub-sub";
            
        elseif ($id == 'maincategory'):

            $this->data['categories'] = $this->Category_model->maincategory();
            $this->data['category_name'] = "Main";
        else:
            show_404();
        endif;
        
               
        // print_r($this->data['groupcategories']);
      // echo "<pre>"; print_r($this->data); exit;
        
        if ($id != 'index')
         $this->load->view('admin/dashboard_reordermaincategory', $this->data, FALSE);
        else
            $this->load->view('admin/dashboard_reordercategory', $this->data, FALSE);

    }

    public function save_reodercategory() {
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
                @$reorder_update = $this->Category_model->update($category_row['id'], $cat_data);
                $this->session->set_flashdata('message', 'Reordered sucessfully.');
                $i++;
            }
//           if($reorder_update>0){
//                $this->session->set_flashdata('message', 'Reordered sucessfully.');
//
//            }
            if ($mode == "maincategory"):
                redirect(site_url('/admin/Dashbord_category/maincategory'));
            endif;
            if ($mode == "index"):
                redirect(site_url('/admin/Dashbord_category/index'));
            endif;
            if ($mode == "subcategory"):
                redirect(site_url("/admin/Dashbord_category/subcategory") . "/" . $mode1);
            endif;
            if ($mode == "sub_subcategory"):
                redirect(site_url("/admin/Dashbord_category/sub_subcategory") . "/" . $mode1);
            endif;
        else:
            show_404();
        endif;
    }

    public function add_edit() {

        $curl = $this->input->post('curl');

        if ($this->input->post('id') == '') {
            $category = array('name' => $this->input->post('name'),
                'parent_id' => $this->input->post('maincat'),
                'ch_lang_name' => $this->input->post('ch_lang_name'),
                'bm_lang_name' => $this->input->post('bm_lang_name'),
            );
            $this->Category_model->insert($category);
            $this->session->set_flashdata('message', 'Successfully Added');
        } else {
            $category = array('name' => $this->input->post('name'),
                //'parent_id' => $this->input->post('maincat'),
                'ch_lang_name' => $this->input->post('ch_lang_name'),
                'bm_lang_name' => $this->input->post('bm_lang_name'),
            );

            $this->Category_model->update($this->input->post('id'), $category);
            $this->session->set_flashdata('message', 'Successfully Updated');
        }
        if ($this->input->post('category_type') == 'maincategory')
            redirect(site_url() . '/admin/dashbord_category/maincategory');
        else
            redirect($curl);
    }

    public function add_subcat_confirm_ajax() {

        $maincat = $this->input->post('maincat');
        // $article_exist = $this->Articles_model->count_all_results(array('cat_id' => $maincat, 'active' => '1', 'deleted' => '0'));
        $article_exist = $this->Articles_model->count_all_results(array('cat_id' => $maincat));
        if ($article_exist > 0):
            echo TRUE;
        else:
            echo FALSE;
        endif;
    }

    public function add_subcat_ajax() {
        $curl = $this->input->post('curl');
        $maincat = $this->input->post('maincat');
        $name = $this->input->post('name');
        if (!empty($name)) :
            $category = array('name' => $name,
                'parent_id' => $maincat
            );
            $this->Category_model->insert($category);
            $last_id = $this->db->insert_id();
            if (!empty($last_id)):
                $articles_id = $this->Category_model->category_article_check($maincat);

                $this->Category_model->update_article_category($articles_id[0]->article_id, $last_id);

                $this->session->set_flashdata('message', 'Successfully Added');

            else:
                $this->session->set_flashdata('error', 'Sorry!, Try again.');
            endif;
        else :
            $this->session->set_flashdata('error', 'Sorry!, Try again.');
        endif;
        redirect($curl);
    }

    public function add_category() {
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
                    $template_data['category_name'] = $this->input->post('name');
                    $template_data['ch_lang_name'] = $this->input->post('ch_lang_name');
                    $template_data['bm_lang_name'] = $this->input->post('bm_lang_name');
                    $template_data['home_front'] = $this->input->post('home_front');

                    $this->load->view('admin/dashboard_category_image_crop', $template_data);
                } else {
                    $template_data['upload_data'] = '';
                    //print_r($upload_error);exit();
                    if (!$upload_error) {
                        $this->session->set_flashdata('error', "Please select a file to upload");
                    } else {
                        $this->session->set_flashdata('error', $upload_error);
                    }

                    redirect(site_url() . '/admin/dashbord_category/maincategory');
                    exit();
                }

                $message = "Please select a image.";
                $this->session->set_flashdata('error', $message);
            endif;
        endif;
    }

    public function edit_category() {
        //  print_r($_POST);exit();
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
                    $template_data['category_name'] = $this->input->post('name');
                    $template_data['ch_lang_name'] = $this->input->post('ch_lang_name');
                    $template_data['bm_lang_name'] = $this->input->post('bm_lang_name');
                    $template_data['id'] = $this->input->post('id');
                    $template_data['imgid'] = $this->input->post('imgid');
                    if (($this->input->post('home_front'))) {
                        $template_data['home_front'] = $this->input->post('home_front');
                    }
                    //print_r($template_data);exit();
                    $this->load->view('admin/dashboard_category_image_crop_edit', $template_data);
                } else {

                    $template_data['upload_data'] = '';
                    //print_r($upload_error);exit();
                    if (!$upload_error) {
                        $this->session->set_flashdata('error', "Please select a file to upload");
                    } else {
                        $this->session->set_flashdata('error', $upload_error);
                    }

                    redirect(site_url() . '/admin/dashbord_category/maincategory');
                    exit();
                }

                $message = "Please select a image.";
                $this->session->set_flashdata('error', $message);
            } else {
                //echo '<pre>'; print_r($_POST); exit;
                $category = array('name' => $this->input->post('name'),
                    'ch_lang_name' => $this->input->post('ch_lang_name'),
                    'bm_lang_name' => $this->input->post('bm_lang_name'),
                    'id' => $this->input->post('id'),
                    'home_front' => $this->input->post('home_front'),
                    'parent_id' => 0
                );
                $this->Category_model->update($this->input->post('id'), $category);
                redirect(site_url() . '/admin/dashbord_category/maincategory');
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
            $category = array('name' => $this->input->post('category_name'),
                'ch_lang_name' => $this->input->post('ch_lang_name'),
                'bm_lang_name' => $this->input->post('bm_lang_name'),
                'home_front' => $this->input->post('home_front'),
                'parent_id' => 0
            );
            $this->Category_model->insert($category);
            $datalast_insert_id = $this->db->insert_id();
            if (!empty($datalast_insert_id)) :
                //Email Integration start here
                $img_result = $this->Image_upload_model->get($imagelast_id);
                $this->Image_upload_model->update($img_result->id, array('cat_id' => $datalast_insert_id));
                $this->session->set_flashdata('message', "Topic added successfully.");
            endif;
        } else {

            $this->session->set_flashdata('alerts', array('message' => "Unabel to upload the data.", 'type' => "alert"));
            $message = strip_tags($this->upload->display_errors());
            $this->session->set_flashdata('error', $message);
            redirect(site_url() . 'admin/dashbord_category/maincategory');
            exit();
        }


        redirect($base_user_url . 'admin/dashbord_category/maincategory');
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

        $upload_error = [];
        $upload_con = array("allowed_types" => "jpeg|jpg|png", "upload_path" => $upload_path);
        $thumb_dim = array("width" => 100);
        // $imagelast_id = $this->smiles_file->update_uploadandcrop($fileData, 0, 4, $upload_error, $upload_con, $cropData, $thumb_dim);
        $imagelast_id = $this->smiles_file->update_uploadandcrop($fileData, 0, 4, $this->input->post('imgid'), $upload_error, $upload_con, $cropData, $thumb_dim);

        //echo '<pre>'; print_r($imagelast_id); exit;

        if (!empty($imagelast_id)) {
            $category = array('name' => $this->input->post('category_name'),
                'ch_lang_name' => $this->input->post('ch_lang_name'),
                'bm_lang_name' => $this->input->post('bm_lang_name'),
                'home_front' => $this->input->post('home_front'),
                'id' => $this->input->post('id'),
                'parent_id' => 0
            );
            $this->Category_model->update($this->input->post('id'), $category);
            $datalast_insert_id = $this->db->insert_id();
            if (($this->input->post('id'))) :
                //Email Integration start here
                $img_result = $this->Image_upload_model->get($imagelast_id);
                $this->Image_upload_model->update($img_result->id, array('cat_id' => $this->input->post('id')));
                $this->session->set_flashdata('message', "Topic Updated successfully.");
            endif;
        } else {

            $this->session->set_flashdata('alerts', array('message' => "Unabel to upload the data.", 'type' => "alert"));
            $message = strip_tags($this->upload->display_errors());
            $this->session->set_flashdata('error', $message);
            redirect(site_url() . '/admin/dashbord_category/maincategory');
            exit();
        }


        redirect($base_user_url . 'admin/dashbord_category/maincategory');
    }

    public function delete_subcategory() {
        $id = $this->input->post('ct_id');


        $articles_id = $this->Category_model->category_article_check($id);
        //echo $this->db->last_query();
        //print_r($articles_id);exit();
        if (!empty($articles_id[0]->article_id)):
            $flag = 0;
        else :

            $child_category = $this->Category_model->getall_childcategory($id);

            // print_r($child_category);
            if (!empty($child_category[0]->category_id)):
                $articles_id1 = $this->Category_model->all_category_article_check($child_category[0]->category_id);

                if (!empty($articles_id1[0]->article_id)):
                    $flag = 0;
                else:
                    $child_childcategory = $this->Category_model->getall_child_childcategory($child_category[0]->category_id);

                    if (!empty($child_childcategory[0]->category_id)):

                        $articles_id2 = $this->Category_model->all_category_article_check($child_childcategory[0]->category_id);
                        //get_subsub_cat = $this->Category_model->get_all(array('id' => $sub_id->parent_id, 'delted' => '0'));
                        if (!empty($articles_id2[0]->article_id)):
                            $flag = 0;
                        else:
                            $flag = 1;
                        endif;
                    else:
                        $flag = 1;
                    endif;


                endif;
            else:
                $flag = 1;

            endif;
        endif;

        if ($flag == 1):
            $update_category = array(
                'deleted' => '1'
            );
            $child = $this->Category_model->get_all(array('parent_id' => $id, 'deleted' => '0'));
            if (!empty($child)):

                foreach ($child as $child_row) {
                    $update_category = array(
                        'deleted' => '1'
                    );
                    $child1 = $this->Category_model->get_all(array('parent_id' => $child_row->id, 'deleted' => '0'));
                    if (!empty($child1)):
                        $update_category = array(
                            'deleted' => '1'
                        );
                        foreach ($child1 as $child1_row) {
                            $this->data['categories'] = $this->Category_model->update($child1_row->id, $update_category);
                        }
                        $this->data['categories'] = $this->Category_model->update($child_row->id, $update_category);

                    else:
                        $this->data['categories'] = $this->Category_model->update($child_row->id, $update_category);
                    endif;
                }
                $this->data['categories'] = $this->Category_model->update($id, $update_category);
                echo TRUE;
            else:
                $update_category = array(
                    'deleted' => '1'
                );
                $this->data['categories'] = $this->Category_model->update($id, $update_category);
                echo TRUE;
            endif;
        else:

            echo FALSE;
        endif;
    }

    public function delete_subcategory1() {
        $id = $this->input->post('ct_id');
        $flag = '';
        $check_article = '';
        $sub_id = $this->Category_model->get($id);

        $articles_id = $this->Category_model->category_article_check($id);

        //print_r($articles_id);
        // $check_article=$articles_id->article_id;
        if (!empty($articles_id[0]->article_id)):

            $flag = 0;
        else :

            $child_category = $this->Category_model->getall_childcategory($id);


            if (!empty($child_category[0]->category_id)):
                $articles_id1 = $this->Category_model->all_category_article_check($child_category[0]->category_id);

                if (!empty($articles_id1[0]->article_id)):
                    $flag = 0;
                else:
                    $flag = 1;
                endif;
            else:
                $flag = 1;

            endif;
        endif;

        if ($flag == 1):
            //$parent_id = $this->Category_model->count_all_results(array('parent_id' => $sub_id->parent_id, 'deleted' => '0'));
            $child = $this->Category_model->get_all(array('parent_id' => $sub_id->id, 'deleted' => '0'));
//            if ($parent_id > 1):
//                $update_category = array(
//                    'deleted' => '1'
//                );
//                $this->data['categories'] = $this->Category_model->update($id, $update_category);
//
//            else:
//                $update_category = array(
//                    'deleted' => '1'
//                );
//                $this->data['categories'] = $this->Category_model->update($id, $update_category);
//                $this->data['categories'] = $this->Category_model->update($sub_id->parent_id, $update_category);
//
//            endif;
            $update_category = array(
                'deleted' => '1'
            );
            if (!empty($child)):
                $update_category = array(
                    'deleted' => '1'
                );
                foreach ($child as $child_row) {
                    $this->data['categories'] = $this->Category_model->update($child_row->id, $update_category);
                }
                $this->data['categories'] = $this->Category_model->update($id, $update_category);
            else:
                $this->data['categories'] = $this->Category_model->update($id, $update_category);
            endif;
            echo TRUE;
        else:
            echo FALSE;
        //echo "you cant delete this subcategory.";
        endif;
    }

    public function delete_subcategory2() {
        $id = $this->input->post('ct_id');
        $sub_id = $this->Category_model->get($id);
        //check any other categories
        //$parent_id = $this->Category_model->count_all_results(array('parent_id' => $sub_id->parent_id, 'deleted' => '0'));
        $articles_id = $this->Category_model->category_article_check($id);

        if (!empty($articles_id[0]->article_id)):
            echo FALSE;
        else :

//            if ($parent_id > 1):
//                $update_category = array(
//                    'deleted' => '1'
//                );
//                $this->data['categories'] = $this->Category_model->update($id, $update_category);
//
//            else:
//                $update_category = array(
//                    'deleted' => '1'
//                );
//
//                $get_parent_id = $this->Category_model->get_all(array('id' => $sub_id->parent_id, 'deleted' => '0'));
//                foreach ($get_parent_id as $get_parent_id_row) {
//                    $parent_id2 = $this->Category_model->get_all(array('parent_id' => $get_parent_id_row->parent_id, 'deleted' => '0'));
//                    if (!empty($parent_id2)):
//                        $update_category = array(
//                            'deleted' => '1'
//                        );
//                        $this->data['categories'] = $this->Category_model->update($get_parent_id_row->id, $update_category);
//                    else:
//                        $this->data['categories'] = $this->Category_model->update($get_parent_id_row->parent_id, $update_category);
//                    endif;
//                }
//                $this->data['categories'] = $this->Category_model->update($id, $update_category);
//                $this->data['categories'] = $this->Category_model->update($sub_id->parent_id, $update_category);
//
//            endif;
            $update_category = array(
                'deleted' => '1'
            );
            $this->data['categories'] = $this->Category_model->update($id, $update_category);
            echo TRUE;

        endif;
    }

    public function delete_maincategory() {
        $id = $this->input->post('ct_id');
//        $this->db->select('GROUP_CONCAT(id) AS subcategory_id');
//        $this->db->from('category');
//        $this->db->where('parent_id', $id);
//        $subcategory = $this->db->get()->result();
//        if (!empty($subcategory[0]->subcategory_id)):
//            $articles_id1 = $this->Category_model->getall_article($subcategory[0]->subcategory_id);
//            $articles_id = $articles_id1->article_id;
//        endif;

        $child_category = $this->Category_model->getall_childcategory($id);

        $flag = '';
        //print_r($child_category);
        if (!empty($child_category[0]->category_id)):
            $articles_id1 = $this->Category_model->all_category_article_check($child_category[0]->category_id);

            if (!empty($articles_id1[0]->article_id)):
                $flag = 0;
            else:
                $child_childcategory = $this->Category_model->getall_child_childcategory($child_category[0]->category_id);

                if (!empty($child_childcategory[0]->category_id)):

                    $articles_id2 = $this->Category_model->all_category_article_check($child_childcategory[0]->category_id);
                    //get_subsub_cat = $this->Category_model->get_all(array('id' => $sub_id->parent_id, 'delted' => '0'));
                    if (!empty($articles_id2[0]->article_id)):
                        $flag = 0;
                    else:
                        $subchild_childcategory = $this->Category_model->getall_child_childcategory($child_childcategory[0]->category_id);

                        if (!empty($subchild_childcategory[0]->category_id)):
                            $articles_id3 = $this->Category_model->all_category_article_check($subchild_childcategory[0]->category_id);


                            //get_subsub_cat = $this->Category_model->get_all(array('id' => $sub_id->parent_id, 'delted' => '0'));
                            if (!empty($articles_id3[0]->article_id)):
                                $flag = 0;
                            else:
                                $flag = 1;
                            endif;
                        else:
                            $flag = 1;
                        endif;

                    endif;
                //$flag = 1;

                else:
                    $flag = 1;
                endif;


            endif;
        else:
            $flag = 1;
        endif;

        if ($flag == 1):
            $image_details = $this->Image_upload_model->get(array('cat_id' => $id, 'type' => '4'));

            if (!empty($image_details)):
                $filepath = "assets/uploads/category_image/";
                $oldFile = $filepath . $image_details->raw_name . $image_details->file_ext;
                $oldFile_o = $filepath . $image_details->raw_name . '_o' . $image_details->file_ext;
                $oldFile_thumb = $filepath . $image_details->raw_name . '_thumb' . $image_details->file_ext;
                if ($oldFile) {

                    unlink($oldFile);
                    unlink($oldFile_o);
                    unlink($oldFile_thumb);
                    $this->Image_upload_model->delete($image_details->id);
                }
            endif;
            $child = $this->Category_model->get_all(array('parent_id' => $id, 'deleted' => '0'));
            if (!empty($child)):

                foreach ($child as $child_row) {
                    $update_category = array(
                        'deleted' => '1'
                    );
                    $child1 = $this->Category_model->get_all(array('parent_id' => $child_row->id, 'deleted' => '0'));
                    if (!empty($child1)):
                        $update_category = array(
                            'deleted' => '1'
                        );

                        foreach ($child1 as $child1_row) {
                            $child2 = $this->Category_model->get_all(array('parent_id' => $child_row->id, 'deleted' => '0'));
                            if (!empty($child2)):
                                foreach ($child2 as $child2_row) {
                                    $this->Category_model->update($child2_row->id, $update_category);
                                }

                                $this->Category_model->update($child1_row->id, $update_category);
                            endif;
                            $this->Category_model->update($child1_row->id, $update_category);
                        }

                        $this->data['categories'] = $this->Category_model->update($child_row->id, $update_category);

                    else:
                        $this->data['categories'] = $this->Category_model->update($child_row->id, $update_category);
                    endif;
                }
                $this->data['categories'] = $this->Category_model->update($id, $update_category);
            else:
                $update_category = array(
                    'deleted' => '1'
                );
                $this->data['categories'] = $this->Category_model->update($id, $update_category);
                echo TRUE;
            endif;

            echo TRUE;
        else:

            echo false;
        endif;
    }

    public function article_view_model() {
        $article_id = $this->input->post('article_id');
        $user_id = $this->input->post('user_id');
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');

        $data['article_view'] = $this->Articles_view_model->get_all(array('user_id' => $user_id, 'article_id' => $article_id));
        //echo $this->db->last_query();
        $result = $this->load->view('admin/article_view_duaration_modal', $data, TRUE);
        echo $result;
        //$this->load->view('admin/dashboard_individual_articleduration', $data);
    }

    //Graph Reprsentation functionalit starts here
    public function category_total_article() {
        //echo $cat_id= $this->uri->segment(4);exit();
        $cat_id = $this->input->post('cat_id');
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $data['mode'] = 'all';
        if (!empty($cat_id)):
            // $user_dtata = array();
            $invidual_user_report = array();
            // $invidual_user_report_tabel = array();
            $get_report_tot_article = array();
            $i = 1;
            $tot_duration = 0;
            $articles = $this->Articles_view_model->category_article($cat_id);
            //echo $this->db->last_query();exit();
            $articles_count = $this->Articles_model->count_all_results(array('active' => '1', 'deleted' => '0'));

            $category_row = $this->Category_model->get($cat_id);
//print_r($articles);
            // foreach ($register_user as $reg_row) {
//echo $articles->total_article;exit();
            if ($articles->total_article > 0):


                // @$get_report = array('y' => $articles->total_article, 'name' => ucfirst($category_row->name) . " Category" . " " . "('No Articles')");
                @$get_report = array('y' => $articles->total_article, 'name' => ucfirst($category_row->name) . " Topic" . " " . "('Articles')");
                $get_report_tot_article = array('y' => $articles_count, 'name' => 'Total Approved Article');

                array_push($invidual_user_report, $get_report);
                array_push($invidual_user_report, $get_report_tot_article);
                // array_push($invidual_user_report_y, $get_report_y);
                //array_push($invidual_user_report_tabel, $tabel_data);
                //@$user_id_implode.=$row->x . ",";
                $i++;
            //endif;
            // }

            else:
                @$get_report = array('y' => 0, 'name' => ucfirst($category_row->name) . " Topic" . " " . "('No Articles')");
                $get_report_tot_article = array('y' => $articles_count, 'name' => 'Total Approved Article');

                array_push($invidual_user_report, $get_report);
                array_push($invidual_user_report, $get_report_tot_article);
            endif;
        else:
            show_404();
        endif;

//print_rr()
        // echo '[{y: 20, name: "Health", exploded: true}, {y: 80, name:"Total Approved article"},]';
        // print_r()
        echo json_encode($invidual_user_report, JSON_NUMERIC_CHECK);
    }

}
