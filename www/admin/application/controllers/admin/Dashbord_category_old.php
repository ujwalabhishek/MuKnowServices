<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';
class Dashbord_category extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        //$this->load->model('Smiles_user_model');
        $this->original_path = 'assets/uploads/category_image';
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('Image_upload_model');

        //$this->load->library('upload');
        $this->load->model('Category_model');
    }

    public function index() {

        $this->data['maincategory'] = $this->Category_model->get_all(array('parent_id'=>0,'deleted='=>'0'));

        $this->data['categories'] = $this->Category_model->getall_category();
       // echo $this->db->last_query();exit();
        // print_r($this -> data['categories'] );exit();

        $this->load->view('admin/dashboard_category', $this->data, FALSE);
    }

    public function maincategory() {


        $this->data ['main_category'] = $this->Category_model->dropdown('id', 'name');
        $this->db->select('c.*,img.file_ext,img.raw_name');
        $this->db->from('category c');
        $this->db->join(' image_files img', 'img.cat_id = c.id', 'left');
        $this->db->where("c.parent_id='0' AND c.deleted='0'");
        $this->db->order_by('c.created_on', 'DESC');
        $this->data['categories'] = $this->db->get()->result();
        //echo $this->db->last_query();exit();
        // print_r($this -> data['categories'] );exit();

        $this->load->view('admin/dashboard_category', $this->data, FALSE);
    }

    public function add_edit() {



        if ($this->input->post('id') == '') {
            $category = array('name' => $this->input->post('name'),
                'parent_id' => $this->input->post('maincat')
            );
            $this->Category_model->insert($category);
            $this->session->set_flashdata('message', 'Successfully Added');
        } else {
            $category = array('name' => $this->input->post('name')
            );
            $this->Category_model->update($this->input->post('id'), $category);
            $this->session->set_flashdata('message', 'Successfully Updated');
        }
        if ($this->input->post('category_type') == 'maincategory')
            redirect(site_url() . '/admin/dashbord_category/maincategory');
        else
            redirect(site_url() . '/admin/dashbord_category/index');
    }

    public function add_category() {
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[50]');

        if ($this->form_validation->run() == FALSE) :
            $message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $message);

        else:
            //print_r($_FILES);exit();
            if (!empty($_FILES['image_file']['name'])) :
                $upload_path = $this->original_path;
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
                $upload_data = $this->upload($data_param['file_input_params']['name'], $upload_error, $upload_path);

                $error = strip_tags($this->upload->display_errors());


                if (!empty($error)):


                    $message = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $message);
                else:

                    $f_data = array(
                        'orig_name' => $upload_data['orig_name'],
                        'file_type' => $upload_data['file_type'],
                        'file_ext' => $upload_data['file_ext'],
                        'file_size' => $upload_data['file_size'],
                        'is_image' => $upload_data['is_image'],
                        'image_type' => $upload_data['image_type'],
                        'file_path' => $upload_data['file_path'],
                        'raw_name' => $upload_data['raw_name'],
                        'type' => 4,
                    );

                    $db_result = $this->db->insert('image_files', $f_data);
                    $imagelast_insert_id = $this->db->insert_id();
                endif;

                if (empty($imagelast_insert_id)) :

                    $message = strip_tags($this->upload->display_errors());
                    $this->session->set_flashdata('error', $message);

                else:
                    $category = array('name' => $this->input->post('name'),
                        'parent_id' => 0
                    );
                    $this->Category_model->insert($category);
                    $datalast_insert_id = $this->db->insert_id();
                    if (!empty($datalast_insert_id)) :
                        //Email Integration start here
                        $img_result = $this->Image_upload_model->get($imagelast_insert_id);
                        $this->Image_upload_model->update($img_result->id, array('cat_id' => $datalast_insert_id));
                        $this->session->set_flashdata('message', "Category added successfully.");
                    endif;
                endif;
            else:
                $message = "Please select a image.";
                $this->session->set_flashdata('error', $message);
            endif;
        endif;


        if ($this->input->post('category_type') == 'maincategory')
            redirect(site_url() . '/admin/dashbord_category/maincategory');
        else
            redirect(site_url() . '/admin/dashbord_category/index');
    }

    function Upload($fieldname, &$return_message = NULL, $upload_path) {
        $files = $_FILES[$fieldname];
        $upload_config = array("allowed_types" => "jpg|png");
        $resize_dim = array("width" => 400, "height" => 150);
        $thumb_dim = array("width" => 80, "height" => 80);
        if ($upload_config && is_array($upload_config)) {
            if (isset($upload_config['max_size']))
                $my_config['max_size'] = $upload_config['max_size'];
            if (isset($upload_config['max_width']))
                $my_config['max_width'] = $upload_config['max_width'];
            if (isset($upload_config['max_height']))
                $my_config['max_height'] = $upload_config['max_height'];
            if (isset($upload_config['allowed_types']))
                $my_config['allowed_types'] = $upload_config['allowed_types'];
        }
        $this->upload->initialize(array(
            "file_name" => $files['name'],
            'allowed_types' => 'jpeg|jpg|png',
            "upload_path" => $upload_path,
            'max_size' => 8192,
            'max_width' => 0,
            'max_height' => 0,
            'encrypt_name' => TRUE,
            'remove_spaces' => TRUE
        ));
        if (!$this->upload->do_upload($fieldname)) {
            $data['response'] = [
                'messge' => array('error' => $this->upload->display_errors()),
                'status' => 0
            ];
            return $data['response'];
        } else {
            $file_data = $this->upload->data();
            $thumb_path = NULL;
            if ($file_data['is_image']) {
                $original_path = $file_data['file_path'] . $file_data['raw_name'] . "_o" . $file_data['file_ext'];

                $this->load->library('image_lib');

                $img_proc_config = array(
                    "image_library" => "GD2",
                    "maintain_ratio" => TRUE
                );

                $img_proc_errors = array();
                // create thumbnail if requested
                if ($thumb_dim && is_array($thumb_dim)) {
                    $this->image_lib->clear();
                    $thumb_path = $file_data['file_path'] . $file_data['raw_name'] . "_thumb" . $file_data['file_ext'];
                    $img_proc_config['source_image'] = $file_data['full_path'];
                    $img_proc_config['new_image'] = $thumb_path;
                    if (isset($thumb_dim['width']))
                        $img_proc_config['width'] = $thumb_dim['width'];
                    if (isset($thumb_dim['height']))
                        $img_proc_config['height'] = $thumb_dim['height'];
                    $this->image_lib->initialize($img_proc_config);
                    if (!$this->image_lib->resize())
                        $img_proc_errors = array_merge($img_proc_errors, array($this->image_lib->display_errors('', '')));
                }
                $copy_result = copy($file_data['full_path'], $original_path);

                if ($resize_dim && is_array($resize_dim) && $copy_result) {
                    $this->image_lib->clear();
                    $img_proc_config['source_image'] = $original_path;
                    $img_proc_config['new_image'] = $file_data['full_path'];
                    if (isset($resize_dim['width']))
                        $img_proc_config['width'] = $resize_dim['width'];
                    if (isset($resize_dim['height']))
                        $img_proc_config['height'] = $resize_dim['height'];
                    $this->image_lib->initialize($img_proc_config);
                    $this->image_lib->resize();
                    if (!$this->image_lib->resize())
                        $img_proc_errors = array_merge($img_proc_errors, array($this->image_lib->display_errors('', '')));
                }
                if ($return_message !== NULL)
                    $return_message = $img_proc_errors;
            }

            return $file_data;
        }
    }

    public function delete_subcategory() {
        $id = $this->input->post('ct_id');
        //$id = 5;
        $this->db->select('GROUP_CONCAT(id) AS article_id');
        $this->db->from('articles');
        $this->db->where('cat_id', $id);
        $articles_id = $this->db->get()->result();
        //echo $this->db->last_query();exit();
        //print_r()
        if (empty($articles_id[0]->article_id)):
           
        $this -> Category_model ->delete($id); 
        else:
            $update_category = array(
                'deleted' => '1'
            );
            $this->data['categories'] = $this->Category_model->update($id, $update_category);
        endif;

        //$this -> data['categories'] = $this -> Category_model ->get($id);    
    }

    public function delete_maincategory() {
        $id = $this->input->post('ct_id');
        //$articles_id=array();
        //$id = 5;
        $this->db->select('GROUP_CONCAT(id) AS subcategory_id');
        $this->db->from('category');
        $this->db->where('parent_id', $id);
        $subcategory = $this->db->get()->result();

        //echo $subcategory[0]->subcategory_id;
        //echo $this->db->last_query();exit();
        if (!empty($subcategory[0]->subcategory_id)):
            $articles_id1 = $this->Category_model->getall_article($subcategory[0]->subcategory_id);
            $articles_id = $articles_id1->article_id;
        endif;

   
        if (empty($articles_id)):
            $image_details = $this->Image_upload_model->get(array('cat_id' => $id, 'type' => '4'));
           
            if (!empty($image_details)):
                $filepath = "assets/uploads/category_image/";
                echo $oldFile = $filepath . $image_details->raw_name . $image_details->file_ext;
                $oldFile_o = $filepath . $image_details->raw_name . '_o' . $image_details->file_ext;
                $oldFile_thumb = $filepath . $image_details->raw_name . '_thumb' . $image_details->file_ext;
                if ($oldFile) {

                    unlink($oldFile);
                    unlink($oldFile_o);
                    unlink($oldFile_thumb);
                    $this->Image_upload_model->delete($image_details->id);
                }
            endif;
            $this->Category_model->delete($id);
			
			$update_sub_category = array(
                'deleted' => '1'
            );
			$this->db->where('parent_id', $id);
			$this->db->update('category', $update_sub_category); 
            echo TRUE;
        else:

            $update_category = array(
                'deleted' => '1'
            );
            $this->data['categories'] = $this->Category_model->update($id, $update_category);
            echo false;
        endif;

       
    }

}
