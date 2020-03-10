<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_articles extends Admin_Controller {

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

    public function index($id) {
        $user_id = $this->ion_auth->user()->row()->id;
        $data['mode'] = 'all';
        $data ['main_category'] = $this->Category_model->dropdown('id', 'name');
        if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()):
            $this->db->select('a.*,u.username,c.name as category_name');
            $this->db->from('articles a');
            $this->db->join(' users u', 'u.id = a.user_id');
            $this->db->join(' category c', 'c.id = a.cat_id');

            $this->db->where("a.active='1' AND a.deleted='0'");
            $this->db->order_by('u.created_on', 'DESC');
            $data['approved_articles'] = $this->db->get()->result();
            // echo $this->db->last_query();exit();

            $this->db->select('a.*,u.username,c.name as category_name');
            $this->db->from('articles a');
            $this->db->join(' users u', 'u.id = a.user_id');
            $this->db->join(' category c', 'c.id = a.cat_id');

            $this->db->where("a.active='0' AND a.deleted='0'");
            $this->db->order_by('u.created_on', 'DESC');
            $data['notapprove_articles'] = $this->db->get()->result();



            $this->db->select('a.*,u.username,c.name as category_name');
            $this->db->from('articles a');
            $this->db->join(' users u', 'u.id = a.user_id');
            $this->db->join(' category c', 'c.id = a.cat_id');

            $this->db->where("a.deleted='0'");
            $this->db->order_by('u.created_on', 'DESC');
            $data['articles'] = $this->db->get()->result();
        else:
            $this->db->select('a.*,u.username,c.name as category_name');
            $this->db->from('articles a');
            $this->db->join(' users u', 'u.id = a.user_id');
            $this->db->join(' category c', 'c.id = a.cat_id');
            $this->db->where("a.active='1' AND a.deleted='0' AND a.user_id=$user_id");
            $this->db->order_by('u.created_on', 'DESC');
            $data['approved_articles'] = $this->db->get()->result();
            // echo $this->db->last_query();exit();

            $this->db->select('a.*,u.username,c.name as category_name');
            $this->db->from('articles a');
            $this->db->join(' users u', 'u.id = a.user_id');
            $this->db->join(' category c', 'c.id = a.cat_id');

            $this->db->where("a.active='0' AND a.deleted='0' AND a.user_id=$user_id");
            $this->db->order_by('u.created_on', 'DESC');
            $data['notapprove_articles'] = $this->db->get()->result();



            $this->db->select('a.*,u.username,c.name as category_name');
            $this->db->from('articles a');
            $this->db->join(' users u', 'u.id = a.user_id');
            $this->db->join(' category c', 'c.id = a.cat_id');

            $this->db->where("a.deleted='0' AND a.user_id=$user_id");
            $this->db->order_by('u.created_on', 'DESC');
            $data['articles'] = $this->db->get()->result();
        endif;
        //echo $this->db->last_query();exit();

        $this->load->view('admin/dashboard_articles', $data);
    }

    //function :Add article
    public function add_edit_article() {
        $id = '';
        $id = $this->uri->segment(4);
        if (empty($id)):
            $data['mode'] = 'add';
            $this->db->where("parent_id=0 AND deleted='0'");
            $data ['main_category'] = $this->Category_model->dropdown('id', 'name');
        //$this->session->set_flashdata('message', 'Successfully Added');
        else:
            if (!empty($id)):
                $data['mode'] = 'edit';
                $data ['article'] = $this->Articles_model->get($id);
                //$data ['article'] = $this->Articles_model->get($id);
                $data ['quiz_row'] = $this->Quiz_article_model->get('article_id', $id);
                $data ['image_files'] = $this->Image_upload_model->get_all(array('article_id' => $id));
//                echo $this->db->last_query();
//                exit();
                $this->db->select('type');
                $this->db->from('image_files');
                $this->db->where("article_id='$id' group by type");
                $data['imagefiles_type'] = $this->db->get()->row();
                //echo $this->db->last_query();exit();
                //echo "<pre>";
                // print_r($data ['image_files'] );exit();
                $this->db->last_query();
            endif;


        //$this -> Category_model -> update($this -> input -> post('id'),$category);
        endif;
        $this->load->view('admin/dashboard_articles', $data);
    }

    public function view_article() {
        $id = '';
        $id = $this->uri->segment(4);
        if (!empty($id)):
            $data['mode'] = 'view';
            $this->db->select('a.*,u.username,c.name as category_name');
            $this->db->from('articles a');
            $this->db->join(' users u', 'u.id = a.user_id');
            $this->db->join(' category c', 'c.id = a.cat_id');
            $this->db->where("a.id=$id");
            $data['view_article'] = $this->db->get()->result();

            $data ['image_files'] = $this->Image_upload_model->get_all(array('article_id' => $id));
            $data['article_microlearning'] = $this->Quiz_article_model->get(array('article_id' => $id));


            $this->load->view('admin/dashboard_articles', $data);
        endif;
    }

    public function add_article() {
        extract($_POST);
//print_r($_POST);
//echo $this->input->post('type');exit();
        $user_id = $this->ion_auth->user()->row()->id;
        //echo "<pre>";
        //echo $image_files[name][0];

        if ($type == '3'):


            $data_param['file_input_params'] = array(
                'name1' => 'image_files',
                'name2' => 'image_files1',
                'name3' => 'image_files2',
            );


            $upload_path = $this->articleimage_original_path;

            if (!file_exists($upload_path)) {
                mkdir($upload_path);
            }

            $upload_error = array();


            if (!empty($_FILES['image_files']['name'])) {
                $file_data[] = $this->upload($data_param['file_input_params']['name1'], $upload_error, $upload_path);
            }
            if (!empty($_FILES['image_files1']['name'])) {
                $file_data[] = $this->upload($data_param['file_input_params']['name2'], $upload_error, $upload_path);
            }
            if (!empty($_FILES['image_files2']['name'])) {
                $file_data[] = $this->upload($data_param['file_input_params']['name3'], $upload_error, $upload_path);
            }
            $flag = 0;

            if (!empty($file_data) && count($file_data)):
                foreach ($file_data as $file_data_row) {
                    //print_r($file_data_row);                                                                                                                       
                    ///print_r($file_data_row['messge']['error']);
                    if (array_key_exists("messge", $file_data_row)):
                        $flag = 2;

                        $message = $file_data_row['messge']['error'];
                        $staus = 0;
                        echo $staus;


                    //$error_message=$file_data_row['messge']['error'];
                    else:
                        $flag = 1;
                    endif;
                }
            else:

                $flag = 2;

            endif;
            //echo $flag;
            if ($flag == 1):
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
                        'type' => '2',
                        'user_id' => $user_id
                    );
                }

                $imageupload_result = $this->db->insert_batch('image_files', $f_data);

            endif;
            if (empty($imageupload_result)) {

                $message = strip_tags($this->upload->display_errors());
                $status = 0;
                echo $status;
                //print json_encode(array("status" => "error", "message" => $message));
            } else {
                $product_data = array(
                    'title' => $title,
                    'cat_id' => $cat_id,
                    'user_id' => $user_id,
                    'description' => $description,
                    'short_description' => $short_description,
                    'active' => '0',
                );
                // print_r($product_data);exit();
                $start = 0;
                $limit = $imageupload_result;
                $db_result = $this->Articles_model->insert($product_data);
                $article_id = $this->db->insert_id();
                $this->Image_upload_model->limit($limit, $start);
                $this->Image_upload_model->order_by('id', 'desc');
                $image_result = $this->Image_upload_model->get_all(array('user_id' => $user_id, 'type' => '2'));

                if (!empty($image_result)) {
                    foreach ($image_result as $row) {
                        $this->Image_upload_model->update($row->id, array('article_id' => $article_id));
                    }
                }
                echo $article_id;
                //$message = "Article created sucessfully.";
                //print json_encode(array("status" => "success", "message" => $message));
            }
        else:
            $files = $_FILES['file_name'];
            $upload_path = $this->articlevideo_original_path;
            if (!file_exists($upload_path)) {
                mkdir($upload_path);
            }
            //echo "<pre>";
            //print_r($files);exit();
            $err_msgs = '';
            $db_result = '';
            $type = $this->input->post('type');
            $config['file_name'] = $files['name'];

            $config['upload_path'] = 'assets/uploads/articles_videos';
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
                $status = 0;
                echo $status;
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
                        'type' => '3',
                        //'product_id'=>$product_id,
                        //'user_id'=>$user_id,
                        'user_id' => $user_id
                    );
                    // print_r($f_data);exit();
                    $ffmpeg = "ffmpeg";

                    //$videoFile = "/home/hygienewatch/www/admin/assets/uploads/articles_videos/" . $f_data['raw_name'] . $f_data['file_ext'];
                    //$imageFile = "/home/hygienewatch/www/admin/assets/uploads/articles_videos/" . $f_data['raw_name'] . "_thumb" . ".jpg";
                    $videoFile = $upload_path . "/" . $f_data['raw_name'] . $f_data['file_ext'];
                    $imageFile = $upload_path . "/" . $f_data['raw_name'] . "_thumb" . ".jpg";
                    $size = '80X80';
                    $interval = 2; // At what time the screenshot to be taken after video is started
                    $cmd = "$ffmpeg -i $videoFile -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $imageFile 2>&1";
                    shell_exec($cmd);
                    $imagelast_insert_id = $this->db->insert('image_files', $f_data);
                    $image_result = $this->db->insert_id();
                endif;
            }
            //echo $image_result;exit();
            if (empty($image_result)) {

                $message = strip_tags($this->upload->display_errors());
                echo $status = 0;
                //print json_encode(array("status" => "error", "message" => $message));
            } else {
                $product_data = array(
                    'title' => $title,
                    'cat_id' => $cat_id,
                    'user_id' => $user_id,
                    'description' => $description,
                    'short_description' => $short_description,
                    'active' => '0',
                );
                // print_r($product_data);exit();
                //$start = 0;
                //$limit = $imageupload_result;
                $db_result = $this->Articles_model->insert($product_data);
                $article_id = $this->db->insert_id();
                // echo $this->db->last_query();
                //$this->Image_upload_model->limit($limit, $start);
                // $this->Image_upload_model->order_by('id', 'desc');
                $image_get_result = $this->Image_upload_model->get($image_result);


                $this->Image_upload_model->update($image_get_result->id, array('article_id' => $article_id));

                $message = "Article created sucessfully.";
                echo $article_id;
                //print json_encode(array("status" => "success", "message" => $message));
            }
        endif;

        //$this->load->view('admin/dashboard_articles', $data);
    }

//Function : to edit atricle
    function edit_article() {
        extract($_POST);
        $tab = $this->uri->segment(4);
        $user_id = $this->ion_auth->user()->row()->id;

        if (!empty($id)):
           // prnit_r($_FILES);exit();
            $user_id = $this->ion_auth->user()->row()->id;
            //echo "<pre>";
            //echo $image_files[name][0];
            if ($type == '2'):
                $data_param['file_input_params'] = array(
                    'name1' => 'image_files',
                    'name2' => 'image_files1',
                    'name3' => 'image_files2',
                );


                $upload_path = $this->articleimage_original_path;

                if (!file_exists($upload_path)) {
                    mkdir($upload_path);
                }

                $upload_error = array();
                $imageupload_result = array();
                $imageup_result = array();
                $file_data[1]['status'] = '';
                $file_data[2]['status'] = '';
                $file_data[3]['status'] = '';
//print_r($_FILES);
                if (!empty($_FILES['image_files']['name'])) {
                    $file_data1 = $this->upload($data_param['file_input_params']['name1'], $upload_error, $upload_path);
                }
                if (!empty($_FILES['image_files1']['name'])) {
                    $file_data2 = $this->upload($data_param['file_input_params']['name2'], $upload_error, $upload_path);
                }
                if (!empty($_FILES['image_files2']['name'])) {
                    $file_data3 = $this->upload($data_param['file_input_params']['name3'], $upload_error, $upload_path);
                }
                $flag = 0;
//print_r($file_data1);exit();
                if (!empty($file_data1) && count($file_data1)):
//                    foreach ($file_data as $file_data_row) {
                    //print_r($file_data_row);                                                                                                                       
                    ///print_r($file_data_row['messge']['error']);
                    if (array_key_exists("messge", $file_data1)):
                        $flag = 2;

                        $message = $file_data1['messge']['error'];
                        echo $message;


                    //$error_message=$file_data_row['messge']['error'];
                    else:
                        $flag = 1;
                        $file_data1['status'] = 4;
                        if ((!empty($file_data1) && $file_data1['status'] != 0)):

                            $f_data = array(
                                'orig_name' => $file_data1['orig_name'],
                                'file_type' => $file_data1['file_type'],
                                'file_ext' => $file_data1['file_ext'],
                                'file_size' => $file_data1['file_size'],
                                'is_image' => $file_data1['is_image'],
                                'image_type' => $file_data1['image_type'],
                                'image_width' => $file_data1['image_width'],
                                'image_height' => $file_data1['image_height'],
                                'file_path' => $file_data1['file_path'],
                                'raw_name' => $file_data1['raw_name'],
                                'type' => '2',
                                // 'user_id' => $user_id,
                                'article_id' => $id
                            );
                            if (!empty($image1_id)):
                                //echo "hi";
                                // $filepath = "assets/uploads/category_image/";
                                $image_details = $this->Image_upload_model->get($image1_id);
                                $oldFile = $upload_path . "/" . $image_details->raw_name . $image_details->file_ext;
                                $oldFile_o = $upload_path . "/" . $image_details->raw_name . '_o' . $image_details->file_ext;
                                $oldFile_thumb = $upload_path . "/" . $image_details->raw_name . '_thumb' . $image_details->file_ext;
                                if ($oldFile) {

                                    unlink($oldFile);
                                    unlink($oldFile_o);
                                    unlink($oldFile_thumb);
                                }
                                $imageup_result = $this->Image_upload_model->update($image1_id, $f_data);
                            //echo $this->db->last_query();exit();
                            else:
                                $imageup_result = $this->Image_upload_model->insert($f_data);
                            endif;

                        endif;
                    endif;

                else:

                    $flag = 2;

                endif;
                if (!empty($file_data2) && count($file_data2)):
//                    foreach ($file_data as $file_data_row) {
                    //print_r($file_data_row);                                                                                                                       
                    ///print_r($file_data_row['messge']['error']);
                    if (array_key_exists("messge", $file_data2)):
                        $flag = 2;

                        $message = $file_data2['messge']['error'];
                        echo $message;


                    //$error_message=$file_data_row['messge']['error'];
                    else:
                        $flag = 1;
                        $file_data2['status'] = 4;
                        // foreach ($file_data as $file_data_row) {
                        //print_r($file_data2['status'] );exit();

                        if ((!empty($file_data2) && $file_data2['status'] != 0)):
                            $f_data = array(
                                'orig_name' => $file_data2['orig_name'],
                                'file_type' => $file_data2['file_type'],
                                'file_ext' => $file_data2['file_ext'],
                                'file_size' => $file_data2['file_size'],
                                'is_image' => $file_data2['is_image'],
                                'image_type' => $file_data2['image_type'],
                                'image_width' => $file_data2['image_width'],
                                'image_height' => $file_data2['image_height'],
                                'file_path' => $file_data2['file_path'],
                                'raw_name' => $file_data2['raw_name'],
                                'type' => '2',
                                // 'user_id' => $user_id,
                                'article_id' => $id
                            );
                            if (!empty($image2_id)):
                                $image_details = $this->Image_upload_model->get($image2_id);
                                $oldFile = $upload_path . "/" . $image_details->raw_name . $image_details->file_ext;
                                $oldFile_o = $upload_path . "/" . $image_details->raw_name . '_o' . $image_details->file_ext;
                                $oldFile_thumb = $upload_path . "/" . $image_details->raw_name . '_thumb' . $image_details->file_ext;
                                if ($oldFile) {

                                    unlink($oldFile);
                                    unlink($oldFile_o);
                                    unlink($oldFile_thumb);
                                }
                                $imageup_result = $this->Image_upload_model->update($image2_id, $f_data);
                            //echo $this->db->last_query();exit();

                            else:
                                $imageup_result = $this->Image_upload_model->insert($f_data);
                            endif;
                        endif;
                    endif;

                else:

                    $flag = 2;

                endif;
                if (!empty($file_data3) && count($file_data3)):
//                    foreach ($file_data as $file_data_row) {
                    //print_r($file_data_row);                                                                                                                       
                    ///print_r($file_data_row['messge']['error']);
                    if (array_key_exists("messge", $file_data3)):
                        $flag = 2;

                        $message = $file_data3['messge']['error'];

                        $this->session->set_flashdata('error', $message);


                    //$error_message=$file_data_row['messge']['error'];
                    else:
                        $flag = 1;
                        $file_data3['status'] = 4;
                        if ((!empty($file_data3)) && $file_data3['status'] != 0):
                            $f_data = array(
                                'orig_name' => $file_data3['orig_name'],
                                'file_type' => $file_data3['file_type'],
                                'file_ext' => $file_data3['file_ext'],
                                'file_size' => $file_data3['file_size'],
                                'is_image' => $file_data3['is_image'],
                                'image_type' => $file_data3['image_type'],
                                'image_width' => $file_data3['image_width'],
                                'image_height' => $file_data3['image_height'],
                                'file_path' => $file_data3['file_path'],
                                'raw_name' => $file_data3['raw_name'],
                                'type' => '2',
                                // 'user_id' => $user_id,
                                'article_id' => $id
                            );
                            if (!empty($image3_id)):
                                $image_details = $this->Image_upload_model->get($image3_id);
                                $oldFile = $upload_path . "/" . $image_details->raw_name . $image_details->file_ext;
                                $oldFile_o = $upload_path . "/" . $image_details->raw_name . '_o' . $image_details->file_ext;
                                $oldFile_thumb = $upload_path . "/" . $image_details->raw_name . '_thumb' . $image_details->file_ext;
                                if ($oldFile) {

                                    unlink($oldFile);
                                    unlink($oldFile_o);
                                    unlink($oldFile_thumb);
                                }
                                $imageup_result = $this->Image_upload_model->update($image3_id, $f_data);
                            else:
                                $imageup_result = $this->Image_upload_model->insert($f_data);
                            endif;
                        endif;
                    endif;

                else:

                    $flag = 2;

                endif;
                //$file_data[0]['status']='';
                //$file_data[1]['status']='';
                //$file_data[2]['status']='';
                // echo "<pre>";
                //print_r($file_data);
                //echo $file_data[0]['status'];
                //if ($flag == 1):
                // $i = 0;
//                    $f_data = array(
//                        'orig_name' => $file_data_row['orig_name'],
//                        'file_type' => $file_data_row['file_type'],
//                        'file_ext' => $file_data_row['file_ext'],
//                        'file_size' => $file_data_row['file_size'],
//                        'is_image' => $file_data_row['is_image'],
//                        'image_type' => $file_data_row['image_type'],
//                        'image_width' => $file_data_row['image_width'],
//                        'image_height' => $file_data_row['image_height'],
//                        'file_path' => $file_data_row['file_path'],
//                        'raw_name' => $file_data_row['raw_name'],
//                        'type' => '2',
//                        // 'user_id' => $user_id,
//                        'article_id' => $id
//                    );
//                    if ($i == '0'):
//                        if (!empty($image1_id)):
//                            //echo "hi";
//                            // $filepath = "assets/uploads/category_image/";
//                            $image_details = $this->Image_upload_model->get($image1_id);
//                            $oldFile = $upload_path . "/" . $image_details->raw_name . $image_details->file_ext;
//                            $oldFile_o = $upload_path . "/" . $image_details->raw_name . '_o' . $image_details->file_ext;
//                            $oldFile_thumb = $upload_path . "/" . $image_details->raw_name . '_thumb' . $image_details->file_ext;
//                            if ($oldFile) {
//
//                                unlink($oldFile);
//                                unlink($oldFile_o);
//                                unlink($oldFile_thumb);
//                            }
//                            $imageup_result = $this->Image_upload_model->update($image1_id, $f_data);
//                        //echo $this->db->last_query();exit();
//                        else:
//                            $imageup_result = $this->Image_upload_model->insert($f_data);
//                        endif;
//
//                    endif;
//                    if ($i == '1'):
//                        if (!empty($image2_id)):
//                            $image_details = $this->Image_upload_model->get($image2_id);
//                            $oldFile = $upload_path . "/" . $image_details->raw_name . $image_details->file_ext;
//                            $oldFile_o = $upload_path . "/" . $image_details->raw_name . '_o' . $image_details->file_ext;
//                            $oldFile_thumb = $upload_path . "/" . $image_details->raw_name . '_thumb' . $image_details->file_ext;
//                            if ($oldFile) {
//
//                                unlink($oldFile);
//                                unlink($oldFile_o);
//                                unlink($oldFile_thumb);
//                            }
//                            $imageup_result = $this->Image_upload_model->update($image2_id, $f_data);
//                        else:
//                            $imageup_result = $this->Image_upload_model->insert($f_data);
//                        endif;
//
//                    endif;
//                    if ($i == '2'):
//                        if (!empty($image3_id)):
//                            $image_details = $this->Image_upload_model->get($image3_id);
//                            $oldFile = $upload_path . "/" . $image_details->raw_name . $image_details->file_ext;
//                            $oldFile_o = $upload_path . "/" . $image_details->raw_name . '_o' . $image_details->file_ext;
//                            $oldFile_thumb = $upload_path . "/" . $image_details->raw_name . '_thumb' . $image_details->file_ext;
//                            if ($oldFile) {
//
//                                unlink($oldFile);
//                                unlink($oldFile_o);
//                                unlink($oldFile_thumb);
//                            }
//                            $imageup_result = $this->Image_upload_model->update($image3_id, $f_data);
//                        else:
//                            $imageup_result = $this->Image_upload_model->insert($f_data);
//                        endif;
//
//                    endif;
                //$imageupload_result=array_merge($imageupload_result,$imageup_result);
                //$i++;
                //$imageupload_result = $this->db->insert_batch('image_files', $f_data);
                //$imageupload_result = $this->db->insert_batch('image_files', $f_data);
                //endif;
                //print_r($imageupload_result);exit();

                $update_data = array(
                    'title' => $title,
                    'description' => $description,
                    'short_description' => $short_description
                );
                //$get_quiz=$this->Quiz_article_model->get()
                if (!empty($quiz_id)):
                    $update_quiz = array(
                        'question' => $question,
                        'option1' => $option1,
                        'option2' => $option2,
                        'option3' => $option3,
                        'option4' => $option4,
                        'answer_key' => $answer_key,
                    );
                    //print_r($update_quiz);exit();
                    $this->Quiz_article_model->update($quiz_id, $update_quiz);

                endif;

                $db_result = $this->Articles_model->update($id, $update_data);
                if ($db_result > 0):
                    $message = "Article updated sucessfully.";
                    $this->session->set_flashdata('message', $message);
                else:
                    $message = "Article already updated.";
                    $this->session->set_flashdata('message', $message);
                endif;


            else:
                $files = $_FILES['file_name'];
                if (!empty($files)):
                    $upload_path = $this->articlevideo_original_path;
                    if (!file_exists($upload_path)) {
                        mkdir($upload_path);
                    }
                    //echo "<pre>";
                    //print_r($files);exit();
                    $err_msgs = '';
                    $db_result = '';
                    $type = $this->input->post('type');
                    $config['file_name'] = $files['name'];

                    $config['upload_path'] = 'assets/uploads/articles_videos';
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
                        $this->session->set_flashdata('error', $err_msgs);
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
                                'type' => '3',
                                //'product_id'=>$product_id,
                                //'user_id'=>$user_id,
                                'user_id' => $user_id
                            );
                            /// print_r($f_data);exit();
                            $ffmpeg = "ffmpeg";

                            //$videoFile = "/home/hygienewatch/www/admin/assets/uploads/articles_videos/" . $f_data['raw_name'] . $f_data['file_ext'];
                            //$imageFile = "/home/hygienewatch/www/admin/assets/uploads/articles_videos/" . $f_data['raw_name'] . "_thumb" . ".jpg";
                            $videoFile = $upload_path . "/" . $f_data['raw_name'] . $f_data['file_ext'];
                            $imageFile = $upload_path . "/" . $f_data['raw_name'] . "_thumb" . ".jpg";
                            $size = '80X80';
                            $interval = 2; // At what time the screenshot to be taken after video is started
                            $cmd = "$ffmpeg -i $videoFile -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $imageFile 2>&1";
                            shell_exec($cmd);
                            //echo $image1_id;
                            if (!empty($image1_id)):
                                //echo "hi";
                                $image_details = $this->Image_upload_model->get($image1_id);
                                $oldFile = $upload_path . "/" . $image_details->raw_name . $image_details->file_ext;
                                $oldFile_thumb = $upload_path . "/" . $image_details->raw_name . '_thumb' . ".jpg";
                                if (!empty($oldFile)) {

                                    unlink($oldFile);
                                    unlink($oldFile_thumb);
                                }
                                $imageup_result = $this->Image_upload_model->update($image1_id, $f_data);
                            //echo $this->db->last_query();exit();
                            else:
                                $imagelast_insert_id = $this->db->insert('image_files', $f_data);
                                echo $this->db->last_query();
                                exit();
                            endif;

                            $image_result = $this->db->insert_id();
                        endif;
                    }
                endif;

                $update_data = array(
                    'description' => $description,
                    'short_description' => $short_description
                );
                if (!empty($quiz_id)):
                    $update_quiz = array(
                        'question' => $question,
                        'option1' => $option1,
                        'option2' => $option2,
                        'option3' => $option3,
                        'option4' => $option4,
                        'answer_key' => $answer_key,
                    );
                    $this->Quiz_article_model->update($quiz_id, $update_quiz);
                endif;
                $db_result = $this->Articles_model->update($id, $update_data);
                $message = "Article updated sucessfully.";
                $this->session->set_flashdata('message', $message);
            endif;

        endif;
        redirect(site_url() . 'admin/Dashboard_articles/index/' . $user_id . "/?tab=" . $tab);
    }

//Function: To upload the image
    function Upload($fieldname, &$return_message = NULL, $upload_path) {
        $files = $_FILES[$fieldname];
        $upload_config = array("allowed_types" => "jpg|png|gif");
        $resize_dim = array("width" => 300, "height" => 300);
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

    public function subcategory($id) {
        $options = $this->Category_model->custom_dropdown('id', 'name', array('parent_id' => $id));
        //echo $this->db->last_query();exit();
        //print_r($options);
        if (!empty($options)):
            $result = '<option value="" selected="selected">Choose a Subcategory</option>';
            foreach ($options as $key => $value) {
                $result.='<option value="' . $key . '">' . $value . '</option>';
            }
        else:
            $result = '<option value="" selected="selected">Subcategory not found</option>';
        endif;

        echo $result;
    }

    public function delete_article() {
        $id = $this->input->post('at_id');
        //$articles_id=array();
        //$id = 5;
        if (!empty($id)):
            $update_data = array(
                'deleted' => '1',
            );
            $this->Quiz_article_model->delete(array('article_id' => $id));
            $this->Articles_model->update($id, $update_data);
            echo TRUE;
        else:
            echo FALSE;
        endif;
    }

    public function active() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if (!empty($id)) {
            $update_art = array(
                'active' => $status,
            );
            $this->Articles_model->update($id, $update_art);
        }
    }

}
