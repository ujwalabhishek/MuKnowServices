<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';

class Dashboard_infosnippet extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Smiles_user_model');
        $this->load->model('Image_upload_model');
        $this->load->model('Info_snippet_model');
        $this->load->model('Category_model');
        $this->load->library('Aes');
        $this->load->library('Gcm');
        $this->load->model('Gcm_model');
        $this->infosnippet_path = 'assets/uploads/infosnippet_image';
        $this->infosnippet_path_videos = 'assets/uploads/infosnippet_videos';
        $this->load->library('upload');
        $this->load->library('image_lib');
    }

    public function index() {

        $this->Info_snippet_model->order_by('id', 'desc');

        $this->data ['maincategory'] = $this->Category_model->get_all('parent_id', '2');

        $this->db->where("type='3' OR type='4'");
        $this->data['post_image'] = $this->Image_upload_model->get_all();

        $this->data['view_access'] = array('MODERATOR' => 'MODRATOR', 'PUBLIC' => 'PUBLIC', 'REGISTER' => 'REGISTER');
        $this->data ['view_acess'] = $this->Category_model->custom_dropdown('id', 'name', array('parent_id' => 1));
        if ($this->uri->segment(4) == 'active')
            $this->data['post_data'] = $this->Info_snippet_model->get_all_posting('ACTIVE');
        else if ($this->uri->segment(4) == 'inactive')
            $this->data['post_data'] = $this->Info_snippet_model->get_all_posting('INACTIVE');

        //$this->data['post_data'] = $this->Info_snippet_model->get_all_posting('NEW');
        // echo  $this->db->last_query();exit();
        $this->data['image_data'] = $this->Image_upload_model->get_all();
        //echo  $this->db->last_query();exit();
        $this->data['categories'] = $this->Category_model->getall_category();

        $this->load->view('admin/dashboard_infosnippet', $this->data, FALSE);
    }

    public function maincategory() {

        $this->data['categories'] = $this->Category_model->get_all('parent_id', 0);
        //$this -> data['categories'] = $this -> Category_model -> getall_category();
        //echo $this->db->last_query();
        // print_r($this -> data['categories'] );exit();

        $this->load->view('admin/dashboard_postdeatils', $this->data, FALSE);
    }

    public function add_edit() {


         $url = $this->input->post('segment');
        $type = $this->input->post('type');
        $id = $this->input->post('id');
        if (empty($id)) {
            $posting_data = array(
                'title' => $this->input->post('posting_title'),
                'description' => $this->input->post('description'),
                'category_id' => $this->input->post('category_id1'),
                'status' => $this->input->post('status'),
                'user_type' => 'MODERATOR',
                'viewer_access' => 'PUBLIC',
            );
            $last_id = $this->Info_snippet_model->insert($posting_data);
            if (count($last_id) > 0) {
                switch ($type) {

                    case "3":

                        $data_param['file_input_params'] = array(
                            'name1' => 'files1',
                            'name2' => 'files2',
                            'name3' => 'files3',
                            'name4' => 'files4'
                        );

                        //print_r($data_param);exit();

                        $upload_path = $this->infosnippet_path;

                        if (!file_exists($upload_path)) {
                            mkdir($upload_path);
                        }

                        $upload_error = array();
                        // $file_data=array();
                        if (!empty($_FILES['files1']['name'])) {
                            $file_data[] = $this->upload($data_param['file_input_params']['name1'], $upload_error, $upload_path);
                        }
                        if (!empty($_FILES['files2']['name'])) {
                            $file_data[] = $this->upload($data_param['file_input_params']['name2'], $upload_error, $upload_path);
                        }
                        if (!empty($_FILES['files3']['name'])) {
                            $file_data[] = $this->upload($data_param['file_input_params']['name3'], $upload_error, $upload_path);
                        }
                        if (!empty($_FILES['files4']['name'])) {
                            $file_data[] = $this->upload($data_param['file_input_params']['name4'], $upload_error, $upload_path);
                        }

                        if (isset($file_data) && count($file_data)):
                            foreach ($file_data as $file_data_row) {
                                // print_r($file_data_row);exit();
                                $f_data[] = array(
                                    'orig_name' => $file_data_row['orig_name'],
                                    'file_type' => $file_data_row['file_type'],
                                    'file_ext' => $file_data_row['file_ext'],
                                    'file_size' => $file_data_row['file_size'],
                                    'is_image' => $file_data_row['is_image'],
                                    'image_type' => $file_data_row['image_type'],
                                    'image_width' => $file_data_row['image_width'],
                                    'image_height' => $file_data_row['image_height'],
                                    'file_path' => $file_data_row['file_path'],
                                    'raw_name' => $file_data_row['raw_name'],
                                    'type' => $type,
                                    //'product_id'=>$product_id,
                                    //'user_id'=>$user_id,
                                    'posting_id' => $last_id
                                );
                                //$this->Image_upload_model->createproduct_profile($file_data_row,$user_id,$product_id,$type);
                            }
                            //echo "<pre>";
                            //print_r($f_data);exit();
                            $db_result = $this->db->insert_batch('image_files', $f_data);
                        //$this->db->last_query();exit();
                        endif;

//                                       

                        if ($db_result) {

                            $message = 'Upload file is success' . ' ' . 'and  data inserted is successfully.';


                            return TRUE;
                        } else {

                            $message = 'Upload file is not sucess' . ' ' . 'and  data insert is successfuly.';

                            return FALSE;
                        }

                          header("Location: www.google.com");
                             exit;

                        break;
                    case "4":
                        $files = $_FILES['file_name'];
                        $upload_path = $this->infosnippet_path_videos;

                        if (!file_exists($upload_path)) {
                            mkdir($upload_path);
                        }

                        $err_msgs = '';
                        $db_result = '';
                        $type = $this->input->post('type');
                        $config['file_name'] = $files['name'];
                        $config['upload_path'] = 'assets/uploads/infosnippet_videos';
                        $config['allowed_types'] = 'mov|mpeg|mp3|avi|mp4';
                        $config['max_size'] = '';
                        $config['overwrite'] = FALSE;
                        $config['remove_spaces'] = TRUE;
                        $config['encrypt_name'] = TRUE;

                        $this->upload->initialize($config);
                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('file_name')) {
                            // If there is any error
                            $err_msgs .= 'Error in Uploading video ' . $this->upload->display_errors() . '<br />';
                        } else {
                            $upload_data = $this->upload->data();
                            $video_path = $upload_data['file_name'];

                            // ffmpeg command to convert video
                            exec("ffmpeg -i " . $upload_data['full_path'] . " " . $upload_data['file_path'] . $upload_data['raw_name'] . ".flv");
                            //print_r($upload_data);exit();
                            /// In the end update video name in DB
                            if (isset($upload_data) && count($upload_data)):


                                $f_data = array(
                                    'orig_name' => $upload_data['orig_name'],
                                    'file_type' => $upload_data['file_type'],
                                    'file_ext' => $upload_data['file_ext'],
                                    'file_size' => $upload_data['file_size'],
                                    'is_image' => $upload_data['is_image'],
                                    'image_type' => $upload_data['image_type'],
//                                         'image_width'=>$upload_data['image_width'],
//                                         'image_height'=>$upload_data['image_height'],
                                    'file_path' => $upload_data['file_path'],
                                    'raw_name' => $upload_data['raw_name'],
                                    'type' => $type,
                                    //'product_id'=>$product_id,
                                    //'user_id'=>$user_id,
                                    'posting_id' => $last_id
                                );
                                //print_r($f_data);exit();
                                $db_result = $this->db->insert('image_files', $f_data);
                            endif;
                        }
                        if ($db_result) {

                            $message = 'Upload Video is success' . ' ' . 'and post data insert is successfuly.';
                            return TRUE;
                        } else {

                            $message = strip_tags($err_msgs) . ' ' . 'and post data insert is successfuly.';
                            return FALSE;
                        }
                          header("Location: http://www.domain.de/de/");
            exit;

                        break;

                    default:
                         header("Location: http://www.domain.de/de/"    );
            exit;


                        break;
                }
            }
            $this->session->set_flashdata('message', $message);
           header("Location: http://www.domain.de/de/");
            exit;

        } else {
            $posting_data = array(
                'title' => $this->input->post('posting_title'),
                'description' => $this->input->post('description'),
                'category_id' => $this->input->post('category_id1'),
                'status' => $this->input->post('status'),
                'user_type' => 'MODERATOR',
                'viewer_access' => 'PUBLIC',
            );
            $last_id = $this->Info_snippet_model->update($this->input->post('id'), $posting_data);


            if (count($last_id) > 0) {
                switch ($type) {

                    case "3":

                        $data_param['file_input_params'] = array(
                            'name1' => 'files1',
                            'name2' => 'files2',
                            'name3' => 'files3',
                            'name4' => 'files4'
                        );

                        //print_r($data_param);exit();

                        $upload_path = $this->infosnippet_path;

                        if (!file_exists($upload_path)) {
                            mkdir($upload_path);
                        }

                        $upload_error = array();
                        // $file_data=array();
                        if (!empty($_FILES['files1']['name'])) {
                            $file_data[] = $this->upload($data_param['file_input_params']['name1'], $upload_error, $upload_path);
                        }
                        if (!empty($_FILES['files2']['name'])) {
                            $file_data[] = $this->upload($data_param['file_input_params']['name2'], $upload_error, $upload_path);
                        }
                        if (!empty($_FILES['files3']['name'])) {
                            $file_data[] = $this->upload($data_param['file_input_params']['name3'], $upload_error, $upload_path);
                        }
                        if (!empty($_FILES['files4']['name'])) {
                            $file_data[] = $this->upload($data_param['file_input_params']['name4'], $upload_error, $upload_path);
                        }

                        if (isset($file_data) && count($file_data)):
                            foreach ($file_data as $file_data_row) {
                                // print_r($file_data_row);exit();
                                $f_data[] = array(
                                    'orig_name' => $file_data_row['orig_name'],
                                    'file_type' => $file_data_row['file_type'],
                                    'file_ext' => $file_data_row['file_ext'],
                                    'file_size' => $file_data_row['file_size'],
                                    'is_image' => $file_data_row['is_image'],
                                    'image_type' => $file_data_row['image_type'],
                                    'image_width' => $file_data_row['image_width'],
                                    'image_height' => $file_data_row['image_height'],
                                    'file_path' => $file_data_row['file_path'],
                                    'raw_name' => $file_data_row['raw_name'],
                                    'type' => $type,
                                    //'product_id'=>$product_id,
                                    //'user_id'=>$user_id,
                                    'posting_id' => $last_id
                                );
                            }

                            $db_result = $this->db->insert_batch('image_files', $f_data);
                        //$this->db->last_query();exit();
                        endif;

//                                       

                        if ($db_result) {

                            $message = 'Upload file is success' . ' ' . 'and  data inserted is successfully.';


                            return TRUE;
                        } else {

                            $message = 'Upload file is not sucess' . ' ' . 'and  data insert is successfuly.';

                            return FALSE;
                        }


                        break;
                    case "4":
                        $files = $_FILES['file_name'];
                        $upload_path = $this->infosnippet_path_videos;

                        if (!file_exists($upload_path)) {
                            mkdir($upload_path);
                        }

                        $err_msgs = '';
                        $db_result = '';
                        $type = $this->post('type');
                        $config['file_name'] = $files['name'];
                        $config['upload_path'] = 'assets/uploads/infosnippet_videos';
                        $config['allowed_types'] = 'mov|mpeg|mp3|avi|mp4';
                        $config['max_size'] = '';
                        $config['overwrite'] = FALSE;
                        $config['remove_spaces'] = TRUE;
                        $config['encrypt_name'] = TRUE;

                        $this->upload->initialize($config);
                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('file_name')) {
                            // If there is any error
                            $err_msgs .= 'Error in Uploading video ' . $this->upload->display_errors() . '<br />';
                        } else {
                            $upload_data = $this->upload->data();
                            $video_path = $upload_data['file_name'];

                            // ffmpeg command to convert video
                            exec("ffmpeg -i " . $upload_data['full_path'] . " " . $upload_data['file_path'] . $upload_data['raw_name'] . ".flv");
                            //print_r($upload_data);exit();
                            /// In the end update video name in DB
                            if (isset($upload_data) && count($upload_data)):


                                $f_data = array(
                                    'orig_name' => $upload_data['orig_name'],
                                    'file_type' => $upload_data['file_type'],
                                    'file_ext' => $upload_data['file_ext'],
                                    'file_size' => $upload_data['file_size'],
                                    'is_image' => $upload_data['is_image'],
                                    'image_type' => $upload_data['image_type'],
//                                         'image_width'=>$upload_data['image_width'],
//                                         'image_height'=>$upload_data['image_height'],
                                    'file_path' => $upload_data['file_path'],
                                    'raw_name' => $upload_data['raw_name'],
                                    'type' => $type,
                                    //'product_id'=>$product_id,
                                    //'user_id'=>$user_id,
                                    'posting_id' => $last_id
                                );
                                //print_r($f_data);exit();
                                $db_result = $this->db->insert('image_files', $f_data);
                            endif;
                        }
                        if ($db_result) {

                            $message = 'Upload Video is success' . ' ' . 'and post data insert is successfuly.';
                            return TRUE;
                        } else {

                            $message = strip_tags($err_msgs) . ' ' . 'and post data insert is successfuly.';
                            return FALSE;
                        }
                        break;

                    default:

                        break;
                }

                $this->session->set_flashdata('message', $message);
                redirect(site_url() . '/admin/dashboard_infosnippet/index/' . $url . '');
            }
            redirect(site_url() . '/admin/dashboard_infosnippet/index/' . $url . '');
        }
       header("Location: http://www.domain.de/de/",TRUE,301);
            exit;

//        if (!empty($url))
//                redirect(site_url() . '/admin/dashboard_infosnippet/index/' . $url . '');
//            else
//                redirect(site_url() . '/admin/dashboard_infosnippet/index');
    }

    function Upload($fieldname, &$return_message = NULL, $upload_path) {
        $files = $_FILES[$fieldname];
        $upload_config = array("allowed_types" => "jpg|png");
        $resize_dim = array("width" => 300, "height" => 300);
        $thumb_dim = array("width" => 80, "height" => 80);

        //$return_message = $upload_error;
//                                   $my_config = array();
//                                $my_config['upload_path'] = $this->original_path.'/'.$email;
//                                $my_config['encrypt_name'] = TRUE;
//                                $my_config['remove_spaces'] = TRUE;
//                                $my_config['max_size'] = $this->default_max_size;
//                                $my_config['max_width'] = $this->default_max_width;
//                                $my_config['max_height'] = $this->default_max_height;
//                                $my_config['allowed_types'] = $this->default_file_types;

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
        //print_r($my_config);exit();
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


        ///$this->upload->initialize($my_config);

        if (!$this->upload->do_upload($fieldname)) {
            $data['response'] = [
                'messge' => array('error' => $this->upload->display_errors()),
                'status' => 0
            ];
            return $data['response'];
        } else {
            $file_data = $this->upload->data();
            //print_r($file_data);exit();
            // $original_path = NULL;
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

                // copy original
                $copy_result = copy($file_data['full_path'], $original_path);

                if ($resize_dim && is_array($resize_dim) && $copy_result) {
                    // process image
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

    public function delete() {
        echo $id = $this->input->post('post_id');
        if (!empty($id)) {
            $this->db->where("(type='3' OR type='4')");
            $image_details = $this->Image_upload_model->get_all('posting_id', $id);
            //echo $this->db->last_query();exit();
            // print_r($image_details);exit();
            if (!empty($image_details)):
                foreach ($image_details as $image_row) {
                    if ($image_row->type == 3) {
                        $filepath = "assets/uploads/infosnippet_image/";
                        $oldFile = $filepath . $image_row->raw_name . $image_row->file_ext;
                        $oldFile_o = $filepath . $image_row->raw_name . '_o' . $image_row->file_ext;
                        $oldFile_thumb = $filepath . $image_row->raw_name . '_thumb' . $image_row->file_ext;
                        if ($oldFile) {

                            unlink($oldFile);
                            unlink($oldFile_o);
                            unlink($oldFile_thumb);
                            $this->Image_upload_model->delete($image_row->id);
                        }
                    } else {
                        $filepath = "assets/uploads/infosnippet_videos/";
                        $oldFile = $filepath . $image_row->raw_name . $image_row->file_ext;
                        if ($oldFile) {

                            unlink($oldFile);
                            $this->Image_upload_model->delete($image_row->id);
                        }
                    }
                }
            endif;
            $this->Info_snippet_model->delete($id);
        }
    }

}
