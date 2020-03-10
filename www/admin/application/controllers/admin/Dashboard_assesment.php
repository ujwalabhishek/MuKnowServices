<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_assesment extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Register_user_model');
        $this->load->model('Category_model');
        $this->load->model('Articles_model');
        $this->load->model('Articles_tag_model');
        $this->load->model('Quiz_article_model');
        $this->load->model('Assessment_model', 'Assesment_model');
        $this->load->model('Assessment_details_model');
        $this->load->model('Department_model');
        $this->load->model('Image_upload_model');
        $this->load->model('Gcm_model');
        $this->load->model('Create_group_model');
        $this->load->library('Gcm');
        $this->load->library('smiles_file');
        $this->articleimage_original_path = 'assets/uploads/assesment_image';
        $user_id = $this->ion_auth->user()->row()->id;
    }

    public function index() {
        $user_id = $this->ion_auth->user()->row()->id;

        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $data['mode'] = 'all';

        $this->data ['main_category'] = $this->Category_model->dropdown('id', 'name');
//        $this->db->select('am.*,a.id as article_id,a.title,d.name,c.name as category_name,d.name as department_name ,aq.question,aq.option1,aq.option2,aq.option3,aq.option4,aq.answer_key');
//        $this->db->from('assessment am');
//        $this->db->join(' article_quiz aq', 'aq.id = am.article_quiz_id');
//        $this->db->join(' articles a', 'a.id = aq.article_id');
//        $this->db->join(' category c', 'c.id = a.cat_id');
//        $this->db->join(' department_list d', 'd.id = am.department_id');
//        //  $this->db->join(' Image_upload_model img', 'img.article_id = a.id', 'LEFT');
//        //  $this->db->where('img.limit 1');
//        $data['assesment_list'] = $this->db->get()->result();
        $this->db->select('*');
        $this->db->from('assessment');
        $this->db->where("deleted='0'");
        $this->db->order_by('sort_order','ASC');
        $data['assesment_list'] = $this->db->get()->result();
        $data ['authors'] = $this->Register_user_model->get_facilitator();
        $this->load->view('admin/dashboard_assesment', $data);
    }

    public function view_detail($id) {
        //echo $id;exit();
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        if (!empty($id)):
            $data['mode'] = 'view_det';

            $data['assesment_view'] = $this->Assesment_model->get($id);
            //echo $this->db->last_query();exit();
            //print_r($this->data['assesment_view']);exit();
            $data['assesment_det'] = $this->Assessment_details_model->get_all(array('assesment_id' => $id));
            $data['group_id'] = explode(',', $data['assesment_view']->group_id);
            //print_r($data['group_id']);exit();
            $data['group'] = $this->Create_group_model->get_all(array('status' => 'Active', 'deleted' => '0'));
            //$this->data['article_quiz'] = $this->Create_group_model->get_all(array('status' => 'Active', 'deleted' => '0'));
            $this->db->select('aq.*,a.title as article_title,c.name as category_name');
            $this->db->from('articles a');
            $this->db->join(' article_quiz aq', 'aq.article_id = a.id');
            $this->db->join(' category c', 'c.id = a.cat_id');


            $data['article_quiz'] = $this->db->get()->result();

            $data['assesment_image'] = $this->Assesment_model->get_asses_image($id);
            ////echo "<pre>";
            //print_r($id);exit();
            $this->load->view('admin/dashboard_assesment', $data);
        endif;
    }

    //function :Add article
    public function add_edit() {
        $id = '';
        $data['mode'] = 'add';
        $id = $this->uri->segment(4);
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        if (empty($id)):
            $data['mode'] = 'add';
            //$this->db->select('GROUP_CONCAT(department_id) as department_id');
            //$exit_department = $this->Assesment_model->get();
            // echo $this->db->last_query();exit();
            //print_r($exit_department);exit();

            $data ['group'] = $this->Create_group_model->get_group();
            //echo $this->db->last_query();exit();

            $data ['main_category'] = $this->Category_model->get_all();
            $this->db->select('aq.*,a.id as article_id,a.title,a.cat_id');
            $this->db->from('article_quiz aq');
            $this->db->join(' articles a', 'a.id = aq.article_id');
            $this->db->where("a.deleted='0' AND a.active='1'");
            $this->db->where("a.article_type='mini_certification'");
            $data ['article'] = $this->db->get()->result();
            //echo $this->db->last_query();exit();

            $this->db->select('GROUP_CONCAT( DISTINCT cat_id) as cat_id');
            $this->db->from('article_quiz aq');
            $this->db->join(' articles a', 'a.id = aq.article_id');
            $this->db->where("a.deleted='0' AND a.active='1'");
            $group_category = $this->db->get()->row();
            //echo $this->db->last_query();exit();
            //print_r($group_category);exit();
            if (!empty($group_category->cat_id)):
                $this->db->where("id IN ($group_category->cat_id)");
                $data ['category'] = $this->Category_model->get_all();
            else:
                $data ['category'] = array();
            endif;
        // echo $this->db->last_query();exit();
        //print_r($data ['category']);exit();
//echo $this->db->last_query();exit();
        //
        //$this->session->set_flashdata('message', 'Successfully Added');
        else:
            if (!empty($id)):
                //$data ['selected_article']='';
                $data['mode'] = 'edit';
                $data ['assessment'] = $this->Assesment_model->get($id);

                $data ['department'] = $this->Department_model->get('id', $data ['assessment']->department_id);

                $this->db->select('aq.*,a.id as article_id,a.title,a.cat_id');
                $this->db->from('article_quiz aq');
                $this->db->join(' articles a', 'a.id = aq.article_id');
                $this->db->where("a.deleted='0' AND a.active='1'");
                $data ['article'] = $this->db->get()->result();
                //$this->db->select('GROUP_CONCAT( DISTINCT cat_id) as cat_id');
                //echo $this->db->last_query();exit();
                $data ['assesment'] = $this->Assesment_model->get($id);
                $data ['selected_article'] = explode(',', $data ['assesment']->article_quiz_id);
                //print_r($data ['selected_article']);exit();
                $this->db->select('GROUP_CONCAT( DISTINCT cat_id) as cat_id');
                $this->db->where("deleted='0' AND active='1'");
                $group_category = $this->Articles_model->get();
                //echo $this->db->last_query();exit();
                if (!empty($group_category)):
                    $this->db->where("id IN ($group_category->cat_id)");
                    $data ['category'] = $this->Category_model->get_all();
                else:
                    $data ['category'] = array();
                endif;
            endif;


        //$this -> Category_model -> update($this -> input -> post('id'),$category);
        endif;
        $data ['authors'] = $this->Register_user_model->get_facilitator();
        $this->load->view('admin/dashboard_assesment', $data);
    }

    public function add_edit_assesment() {
        $id = '';
        $author = $this->input->post('author');
        //echo 'sdcs';exit;
        $this->form_validation->set_rules('author', 'author', 'required|callback_author_check');
        if ($this->form_validation->run() == FALSE) {
            $message = 'Selected Trainer doesnt have any article.Please add Mini certification article and then try to select this Mini Certification';
            $this->session->set_flashdata('error', $message);
            redirect('admin/dashboard_assesment/index');
        } else {
            $data['mode'] = 'add';
            $id = $this->uri->segment(4);
            if ($this->session->userdata('session_data'))
                $data = $this->session->userdata('session_data');
            if (empty($id)):
                $data['mode'] = 'add';
                //$this->db->select('GROUP_CONCAT(department_id) as department_id');
                //$exit_department = $this->Assesment_model->get();
                // echo $this->db->last_query();exit();
                //print_r($exit_department);exit();

                $data ['group'] = $this->Create_group_model->get_group();
                //echo $this->db->last_query();exit();

                $data ['main_category'] = $this->Category_model->get_all();
                $this->db->select('aq.*,a.id as article_id,a.title,a.cat_id');
                $this->db->from('article_quiz aq');
                $this->db->join(' articles a', 'a.id = aq.article_id');
                $this->db->where("a.deleted='0' AND a.active='1'");
                $this->db->where("a.article_type='mini_certification'");
                $this->db->where('author_id', $author);
                $data ['article'] = $this->db->get()->result();
                //echo $this->db->last_query();exit();

                $this->db->select('GROUP_CONCAT( DISTINCT cat_id) as cat_id');
                $this->db->from('article_quiz aq');
                $this->db->join(' articles a', 'a.id = aq.article_id');
                $this->db->where('a.author_id', $author);
                $this->db->where("a.deleted='0' AND a.active='1'");
                $group_category = $this->db->get()->row();
                //echo $this->db->last_query();exit();
                //print_r($group_category);exit();
                if (!empty($group_category->cat_id)):
                    $this->db->where("id IN ($group_category->cat_id)");
                    $data ['category'] = $this->Category_model->get_all();
                else:
                    $data ['category'] = array();
                endif;
                $data['authorid'] = $author;
            // echo $this->db->last_query();exit();
            //print_r($data ['category']);exit();
//echo $this->db->last_query();exit();
            //
        //$this->session->set_flashdata('message', 'Successfully Added');
            else:
                if (!empty($id)):
                    //$data ['selected_article']='';
                    $data['mode'] = 'edit';
                    $data ['assessment'] = $this->Assesment_model->get($id);

                    $data ['department'] = $this->Department_model->get('id', $data ['assessment']->department_id);

                    $this->db->select('aq.*,a.id as article_id,a.title,a.cat_id');
                    $this->db->from('article_quiz aq');
                    $this->db->join(' articles a', 'a.id = aq.article_id');
                    $this->db->where("a.deleted='0' AND a.active='1'");
                    $data ['article'] = $this->db->get()->result();
                    //$this->db->select('GROUP_CONCAT( DISTINCT cat_id) as cat_id');
                    //echo $this->db->last_query();exit();
                    $data ['assesment'] = $this->Assesment_model->get($id);
                    $data ['selected_article'] = explode(',', $data ['assesment']->article_quiz_id);
                    //print_r($data ['selected_article']);exit();
                    $this->db->select('GROUP_CONCAT( DISTINCT cat_id) as cat_id');
                    $this->db->where("deleted='0' AND active='1'");
                    $group_category = $this->Articles_model->get();
                    //echo $this->db->last_query();exit();
                    if (!empty($group_category)):
                        $this->db->where("id IN ($group_category->cat_id)");
                        $data ['category'] = $this->Category_model->get_all();
                    else:
                        $data ['category'] = array();
                    endif;
                endif;


            //$this -> Category_model -> update($this -> input -> post('id'),$category);
            endif;
            $data ['authors'] = $this->Register_user_model->get_facilitator();
            $this->load->view('admin/dashboard_assesment', $data);
        }
    }

    public function view($id) {
        if (!empty($id)):
            $data['mode'] = 'view';
            $data ['assessment'] = $this->Assesment_model->get($id);

            $data ['department'] = $this->Department_model->get('id', $data ['assessment']->department_id);


            //echo $this->db->last_query();exit();
            $data ['assesment'] = $this->Assesment_model->get($id);
            $quiz_id = $data ['assesment']->article_quiz_id;
            $data ['selected_article'] = explode(',', $data ['assesment']->article_quiz_id);
            $this->db->select('aq.*,a.id as article_id,a.title,a.cat_id,c.name as category_name');
            $this->db->from('article_quiz aq');
            $this->db->join(' articles a', 'a.id = aq.article_id');
            $this->db->join(' category c', 'c.id = a.cat_id');
            $this->db->where("a.deleted='0' AND a.active='1' AND aq.id IN($quiz_id)");
            $data ['article'] = $this->db->get()->result();
            //echo $this->db->last_query();
            //exit();
            //print_r($data ['selected_article']);exit();
            $this->db->select('GROUP_CONCAT( DISTINCT cat_id) as cat_id');
            $this->db->where("deleted='0' AND active='1'");
            $group_category = $this->Articles_model->get();
            //echo $this->db->last_query();exit();
            if (!empty($group_category)):
                $this->db->where("id IN ($group_category->cat_id)");
                $data ['category'] = $this->Category_model->get_all();
            else:
                $data ['category'] = array();
            endif;
            $this->load->view('admin/dashboard_assesment', $data);
        else:
            show_404();
        endif;
    }

    Public function add_edit_data() {
        //echo '<pre>'; print_r($_POST);exit();
        $upload_path = $this->articleimage_original_path;
        //echo '<pre>'; print_r($upload_path);exit();
        extract($_POST);
        $id = '';
         $id = $this->input->post('assess_id');
        if (empty($id)):

            // echo '<pre>'; print_r($image_files);exit(); 
            //print_r($question);exit();
            // if (!empty($group)):
//            $get_art = $this->session->userdata('selected_article_question');
//
//            $exp_art = explode(',', $get_art);
//
//            $art_question = array_filter(array_unique($exp_art));
 $art_question=  json_decode($article_quiz, true);
            if (!empty($art_question)):
                //   $group_id_implode = implode(',', $group);

                if (!empty($caption_image1))
                    $caption_image1 = $caption_image1;
                else
                    $caption_image1 = null;





                if (!file_exists($upload_path)) {
                    mkdir($upload_path);
                }

                $upload_error = array();

                if (!empty($image_files)) {
                    $file_data[] = json_decode($image_files, true);
                }


                //echo '<pre>'; print_r($file_data);exit(); 
                if (empty($file_data)) {
                    echo "image";
                    exit();
                }
                $flag = 0;

                if (!empty($file_data) && count($file_data)):

                    foreach ($file_data as $file_data_row) {
                        // print_r($file_data_row);
                        $flag = 1;
//                    if (array_key_exists("messge", $file_data_row)):
//                        $flag = 2;
//                        $message = $file_data_row['messge']['error'];
//                        $staus = 0;
//                        echo $staus;
//                    //$error_message=$file_data_row['messge']['error'];
//                    else:
//                        $flag = 1;
//                    endif;
                    }
                else:
                    $flag = 2;
                endif;

                $add_data = array(
                    // 'group_id' => $group_id_implode,
                    'title' => $title,
                    'overview' => $overview,
                    'author_id' => $author,
                    'status' => 'Active',
                );
                $this->Assesment_model->insert($add_data);
                @$assest_id = $this->db->insert_id();
//                 $sort_count = $this->Assessment_details_model->count_all_results();
//              //  exit();
//                if ($sort_count > 0):
//                    $sort_count = $sort_count + 1;
//                else:
//                    $sort_count = 1;
//                endif;

            endif;
//echo '<pre>'; print_r($file_data);exit(); 
//print_r($art_question);
            if ($assest_id) {
                if ($flag == 1):
                    $i = 1;


                    if (!empty($assest_id)):
 $i = 1;
                        foreach ($art_question as $question_row) {
                          ///  echo $question_row[id];exit();
                            $sort_count = $this->Assessment_details_model->count_all_results();
                           
                            if ($sort_count > 0):
                                $sort_count = $sort_count + 1;
                            else:
                                $sort_count = 1;
                            endif;
                            $asset_det_data = array(
                                'assesment_id' => $assest_id,
                                'article_quiz_id' => $question_row[id],
                                'sort_order' => $sort_count
                            );
                            $this->Assessment_details_model->insert($asset_det_data);
                            $i++;
                        }
                        $get_asset = $this->Assesment_model->get($assest_id);
//                           if (!empty($get_asset)):
//                            //$this->Create_group_model->
//                            $this->db->select('group_concat(cm.user_id) as user_id');
//                            $this->db->from('create_group cg');
//                            $this->db->join(' create_group_member cm ', 'cm.group_id = cg.id');
//                            $this->db->where("cg.status='Active' AND cg.deleted='0' AND cm.group_id IN($get_asset->group_id)");
//                            $all_user_id = $this->db->get()->row();
//                            //echo $this->db->last_query();exit();
//                            $this->send_pushnotification($all_user_id->user_id);
//                            $this->send_ios($all_user_id->user_id);
//                        endif;
                    endif;
                    foreach ($file_data as $file_data_row) {

                        $f_data = array();
                        $cropData = "";
                        $caption_image = "";
                        if ($i == 1) {
                            $caption_image = $caption_image1;
                            $crop1 = explode(",", $crop1);
                            $cropData = $crop1;
                        }
                        if ($i == 2) {
                            $caption_image = $caption_image2;
                            $cropData = $crop2;
                        }
                        if ($i == 3) {
                            $caption_image = $caption_image3;
                            $cropData = $crop3;
                        }

                        $f_data = array(
                            'assesment_id' => $assest_id,
                            'orig_name' => $file_data_row['msg']['orig_name'],
                            'file_type' => $file_data_row['msg']['file_type'],
                            'file_ext' => $file_data_row['msg']['file_ext'],
                            'file_size' => $file_data_row['msg']['file_size'],
                            'is_image' => $file_data_row['msg']['is_image'],
                            'image_type' => $file_data_row['msg']['image_type'],
                            'image_width' => $file_data_row['msg']['image_width'],
                            'image_height' => $file_data_row['msg']['image_height'],
                            'file_path' => $file_data_row['msg']['file_path'],
                            'full_path' => $file_data_row['msg']['full_path'],
                            'raw_name' => $file_data_row['msg']['raw_name'],
                            'type' => '2',
                            'caption' => $caption_image,
                                // 'user_id' => $user_id
                        );
                        $upload_error = array();
                        $upload_con = array("allowed_types" => "jpeg|jpg|png", "upload_path" => $upload_path);
                        $thumb_dim = array("width" => 100);
                        $cropData = $this->input->post('crop1');

                        $imagelast_id[] = $this->smiles_file->uploadandcrop($f_data, 0, 2, $upload_error, $upload_con, $cropData, $thumb_dim);

                        $i++;
                    }
                else:
                    $this->session->set_flashdata('error', 'Please upload the image.');
                    redirect($curl);
                endif;
                if ($notification) {

                    $this->article_send_pushnotification($title);
                    $this->article_send_ios($title);
                }
                $this->session->set_flashdata('message', 'Mini Certification added sucessfully.');
                redirect(site_url() . 'admin/Dashboard_assesment/index');
                // echo $article_id;
            } else {
                $this->session->set_flashdata('error', 'Please select any article question.');
                redirect($curl);
            }




//            else:
//                $this->session->set_flashdata('error', 'Please select any group.');
//                redirect($curl);
//                
        //endif;
//        else:
//            $article_quiz_id = implode(',', $question);
//            $add_data = array(
//                'article_quiz_id' => $article_quiz_id,
//                    //'department_id' => $department_id,
//            );
//            $udate_count = $this->Assesment_model->update($id, $add_data);
//            if ($udate_count > 0):
//                $this->session->set_flashdata('message', 'updated sucessfully.');
//            else:
//                $this->session->set_flashdata('warning', 'Already updated.');
//            endif;
//
//            redirect(site_url() . 'admin/Dashboard_assesment/index');
        endif;
    }

    public function add_picture() {

        $return_message = "";
        $config = array(
            'upload_path' => "assets/uploads/assesment_image",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE
        );
        $upload_error = array();
        $resize_dim = array("width" => '700', "height" => '600');
        $this->load->library('smiles_file');
        $data['file_input_params'] = array(
            'name' => 'picture_file'
        );

        $file_data = $this->smiles_file->uploadforcrop($data['file_input_params']['name'], $upload_error, $config, $resize_dim);
        //echo '<pre>'; print_r($file_data); exit;
        if (!empty($file_data)) {
            $returndata = array("type" => "success", "msg" => $file_data);
        } else {

            if (!$upload_error)
                $returndata = array("type" => "alert", "msg" => "Please select a file to upload");
            else
                $returndata = array("type" => "alert", "msg" => $upload_error);
        }

        echo json_encode($returndata);
    }

    public function send_pushnotification($all_user_id) {
        $title = project_name;
        $response = "You have a new assessment.";

        $this->db->select('*');
        $this->db->from('gcm_users ');
        //$this->db->join(' users u', 'u.id = gu.user_id');
        $this->db->where("user_id IN($all_user_id) AND type='android'");
        $androidresult = $this->db->get()->result();
        //$gcm_regid='APA91bFyoQY7s1WuKZmnaJ-qfLAbBR4K2Y2SOoOFvb4SNrDyQKXFgUPyyOqHvd1MokGWoLy5qmfhCP834UMt4mOP8PMLMN1zB-7TpmKVXO69lKsZsizoTepQDGW4HrIPKrqbMeDT6jbb';
        //$androidresult=$this->Gcm_model->get_all('type','android');
        // print_r($androidresult);exit();
        if (isset($androidresult) && count($androidresult)):
            foreach ($androidresult as $row) {
                $this->gcm->addRecepient($row->gcm_regid);
            }
            //$this->gcm->setMessage($message.date('d.m.Y H:s:i'));
            $this->gcm->setMessage($response);

            $this->gcm->setData(array(
                'title' => $title,
                'response' => $response,
            ));
            $this->gcm->setTtl(500);
            $this->gcm->setTtl(false);
            //$ee=$this->gcm->send();
            //print_r($ee);exit();
            if ($this->gcm->send()):

                return 1;



            else:

                return 0;
            // echo $message="No GCM registartion id found";
            endif;


        else:
            return 0;
        endif;
    }

    function send_ios($all_user_id) {
        $this->db->select('*');
        $this->db->from('gcm_users ');
        //$this->db->join(' users u', 'u.id = gu.user_id');
        $this->db->where("user_id IN($all_user_id) AND type='ios'");

        $result = $this->db->get()->result();

        // print_r($androidresult);exit();
        $title = project_name;
        $message1 = "You have a new assessment.";
        $title.=$title . "\n";
        // $rr=$this->apn->setData($title);
        if (isset($result) && count($result)):
            foreach ($result as $row) {
                //$this->apn->sendMessage($row->gcm_regid,$title.$message1);
                $device = $row->gcm_regid;
                $last_id = $this->Gcm_model->insert_pushnotification($device, $title, $message1);
                //echo $this->db->last_query();exit();
                if (!empty($last_id))
                    if ($this->sendnotification_ios($last_id))
                        $flag = TRUE;
                    else
                        $flag = FALSE;
            }
            if ($flag == TRUE) {
                $message = "sucess for all messages";
                $status = 1;
            } else {
                echo $message = "Some messages have errors";
                $status = 0;
            }


        endif;
    }

    function sendnotification_ios($id) {


        $data_notification = $this->Gcm_model->get_pushnotification($id);


        if (!empty($data_notification)) {
            $badge_count = $this->Gcm_model->get_budgecount($data_notification->gcm_regid);
            $sound = 'chime'; // string - sound name
            $development = IOS_GCM_DEV_MODE; // boolean
            //echo $this->setapnbadge();

            $payload = array();
            $payload['aps'] = array('alert' => $data_notification->message, 'badge' => intval($badge_count->badgecount), 'sound' => $sound);
            $payload = json_encode($payload);

            $apns_url = NULL; // Set Later
            $apns_cert = NULL; // Set Later
            $apns_port = 2195;

            if ($development) {
                $apns_url = 'gateway.sandbox.push.apple.com';
                $apns_cert = APPPATH . 'apn/' . IOS_PEM_FILE; // relative address to an App Specific Certificate     file 
            } else {
                $apns_url = 'gateway.push.apple.com';
                $apns_cert = APPPATH . 'apn/' . IOS_PEM_FILE;
            }

            $stream_context = stream_context_create();
            stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);

            $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);

            $device_tokens = array($data_notification->gcm_regid); // tokens!!!


            foreach ($device_tokens as $device_token) {
                $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', str_replace('    ', '', $device_token)) . chr(0) . chr(strlen($payload)) . $payload;
                fwrite($apns, $apns_message);
            }
            @$badgedata = $badgedata + 1;

            @socket_close($apns);
            @fclose($apns);
            return TRUE;
        } else
            return FALSE;
    }

    public function delete() {
        $id = $this->input->post('id');
        //$articles_id=array();
        //$id = 5;
        if (!empty($id)):
            $update_data = array('deleted' => '1');
            $this->Assesment_model->update($id, $update_data);
            // $this->Articles_model->update($id, $update_data);
            echo TRUE;
        else:
            echo FALSE;
        endif;
    }

    public function active() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if (!empty($id)) :
            $actiive_data = array(
                'status' => $status,
            );
            $this->Assesment_model->update($id, $actiive_data);
            echo TRUE;
        else:
            echo FALSE;
        endif;
    }

    public function set_article() {

        extract($_POST);
        
        $get_art1 = '';
        //$select_article=array();
        $select_article1 = $this->input->post('select_article_question');
        $select_article2 = explode('_', $select_article1);
        $select_article = $select_article2[0] . ',';
        $sort_order = $select_article2[1];
       $select_article_check = $select_article2[0];
        $get_art = $this->session->userdata('selected_article_question');
 
        if (!empty($get_art)):
           //echo '<pre>';print_r($get_art); 
           $get_art_check = explode(',', $get_art);
            //echo '<pre>';print_r($get_art_check); 
            if (in_array($select_article_check, $get_art_check)) {
                $session_check = explode(',', $this->session->userdata('selected_article_question')); 
                $sort_check = explode(',', $_SESSION['selected_article_sort']);
                foreach($session_check as $key=> $sess_check)
                { //echo '<pre>';print_r($session_check);
                     if($sess_check == $select_article_check)
                     {//echo '<pre>';print_r('test');
                            //echo '<pre>';print_r($this->session->userdata('selected_article_question'));
                          $this->session->unset_userdata('selected_article_question');
                       
                         $arr = array_diff($session_check, array($select_article_check));
                        // echo '<pre>';print_r($arr);
                          $arr_check = implode(',', $arr);
                          //echo '<pre>';print_r($arr_check);
                          $this->session->set_userdata('selected_article_question',$arr_check);
                        //  echo '<pre>';print_r($this->session->userdata('selected_article_question'));
                         //echo '<pre>';print_r($arr);exit;
                         // unset($session_check[$key]);
                       //  $this->session->unset_userdata('selected_article_question', $session_check[$key]);
                         //  unset($sort_check[$key]);
                    //echo '<pre>';print_r($this->session->userdata('selected_article_question'));  
                     }
                }//exit;
              //echo '<pre>';print_r($sess_check);  
            }
            else {
            //print_r($get_art);
            // echo "1-".$get_art;
           //print_r($get_art);exit;
            $get_art = $this->session->userdata('selected_article_question');
            $get_sort = $this->session->userdata('selected_article_sort'); 
            // $exp_art=explode(',',$get_art);
            //print_r($get_art);
            //array_unique($exp_art)
            $get_art1 = $get_art . $select_article;
            $get_sort1 = $get_sort . $sort_order;
            //print_r($get_art1);exit;
            $this->session->set_userdata('selected_article_question', $get_art1);
            $this->session->set_userdata('selected_article_sort', $get_sort1);
            }
        // print_r($s2);
        else:
            echo $select_article;
            echo $ii = $this->session->set_userdata('selected_article_question', $select_article);
            echo $sort_order;
            echo $iii = $this->session->set_userdata('selected_article_sort', $sort_order);
        endif;



        // print_r($get_art);
    }

    public function preview_article() {

        $id = '';
        $data ['cat'] = '';
        $id = $this->uri->segment(4);
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        if (!empty($id)):

            if ($this->session->userdata('session_data'))
                $data = $this->session->userdata('session_data');
            $data['mode'] = 'preview';

            $this->db->select('a.*,u.username,c.name as category_name');

            $this->db->from('articles a');

            $this->db->join(' users u', 'u.id = a.user_id');

            $this->db->join(' category c', 'c.id = a.cat_id');

            $this->db->where("a.id=$id");

            $data['view_article'] = $this->db->get()->result();

            $data ['image_files'] = $this->Image_upload_model->get_all(array('article_id' => $id));

            $data ['article_tag'] = $this->Articles_tag_model->get_all(array('article_id' => $id));


            $data['article_microlearning'] = $this->Quiz_article_model->get(array('article_id' => $id));
            $get_cat_id = $this->Category_model->get($data['view_article'][0]->cat_id);
            $get_parent_id = $this->Category_model->get($get_cat_id->parent_id);
            if (!empty($get_parent_id)):
                @$data ['cat'] .= $get_parent_id->name;
                $get_parent_id1 = $this->Category_model->get($get_parent_id->parent_id);
                if (!empty($get_parent_id1)):
                    $data ['cat'] .= "<i class='fa fa-arrow-right'></i>" . $get_parent_id1->name;
                    // array_push($add_cat,$data['view_article ']['parent_name1']);
                    $get_parent_id2 = $this->Category_model->get($get_parent_id1->parent_id);
                    if (!empty($get_parent_id2)):
                        $data ['cat'] .= "<i class='fa fa-arrow-right'></i>" . $get_parent_id2->name;
                    //array_push($add_cat,$data['view_article ']['parent_name2']);

                    endif;
                endif;
            endif;
            $this->load->view('admin/dashboard_articlepreview', $data);

        endif;
    }

    public function destory_selectearticle() {
        // echo '<pre>'; print_r($_SESSION()); exit;
        $this->session->unset_userdata('selected_article_sort');
        $this->session->unset_userdata('selected_article_question');
    }

    public function author_check($str) {

        $group = $this->Articles_model->get_article_by_author_row($str);
        //   echo $group; exit;
        if (!empty($group)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function reorder_assess_article_page() {
        extract($_POST);
    //echo '<pre>';print_r($this->session->userdata('selected_article_question'));
        //  $user_id = $this->ion_auth->user()->row()->id;
        $get_art = $this->session->userdata('selected_article_question');
        
        $exp_art = explode(',', $get_art);
     
        @$exp_art_sort = array_unique($exp_art);
        $article_id = implode(',', $exp_art_sort);
        $data['article_id'] = rtrim($article_id, ",");
        $article_id = $data['article_id'];
        $article_id;
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        extract($_POST);
        $id = '';
        $id = $this->input->post('article_id');
        //  print_r($_POST);
       
     //  echo $article_id;
        if (!empty($article_id)):


//                $this->db->select('articles.*');
//                $this->db->from(' article_quiz');
//                $this->db->join('articles','articles.id=article_quiz.article_id','left');
//                $this->db->where_in('article_quiz.id',$article_id); 
//                $this->db->where('articles.deleted','0');
//                $this->db->where('articles.active','1');
//                //$this->db->where("articles.deleted='0' AND articles.active='1' AND article_quiz.id IN($article_id) ");
//                $data ['article'] = $this->db->get()->result();
            $data ['article'] = $this->Assesment_model->get_reorder_assesment($article_id);
            // echo $this->db->last_query();exit();
            //$data['group'] = $group;
            //$data['title'] = $title;
            if (!empty($caption_image1)):
                $data['caption_image1'] = $caption_image1;
            else:
                $caption_image1 = '';
            endif;
            $data['image_files'] = $image_files;
            $data['overview'] = $overview;
            $data['author'] = $author;
            $data['title'] = $title;
            $data['notification'] = $notification;
            $crop1 = $this->input->post('crop1');
            $crodata = implode(",", $crop1);
            $data['crop1'] = $crodata;
        //echo $crop1;exit();
        //echo '<pre>';print_r($data ['crop1']);exit();
        else:
            $this->session->set_flashdata('error', 'Please select any article.');
            redirect($curl);
        endif;
        //echo "<pre>";
        // print_r($data);
        
       // exit();
        $this->load->view('admin/dashboard_reorderassessment', $data);


//        print_r($data);
//        exit();
    }

    public function article_send_pushnotification($titles = '') {
        $title = $titles . ' Mini Certification has been added';
        $response = $titles . ' Mini Certification has been added';

        $this->db->select('gcm_users.*');
        $this->db->from('gcm_users');
        $this->db->join('users', 'users.id = gcm_users.user_id', 'left');
        $this->db->where('gcm_users.type', 'android');
        $this->db->where_in('users.user_type', 'subscriber');
        $androidresult = $this->db->get()->result();
        //$gcm_regid='APA91bFyoQY7s1WuKZmnaJ-qfLAbBR4K2Y2SOoOFvb4SNrDyQKXFgUPyyOqHvd1MokGWoLy5qmfhCP834UMt4mOP8PMLMN1zB-7TpmKVXO69lKsZsizoTepQDGW4HrIPKrqbMeDT6jbb';
        //$androidresult=$this->Gcm_model->get_all('type','android');
        // print_r($androidresult);exit();
        if (isset($androidresult) && count($androidresult)):
            foreach ($androidresult as $row) {
                $this->gcm->addRecepient($row->gcm_regid);
            }
            //$this->gcm->setMessage($message.date('d.m.Y H:s:i'));
            $this->gcm->setMessage($response);

            $this->gcm->setData(array(
                'title' => $title,
                'response' => $response,
            ));
            $this->gcm->setTtl(500);
            $this->gcm->setTtl(false);
            //$ee=$this->gcm->send();
            //print_r($ee);exit();
            if ($this->gcm->send()):

                return 1;



            else:

                return 0;
            // echo $message="No GCM registartion id found";
            endif;


        else:
            return 0;
        endif;
    }

    function article_send_ios($title = '') {
        $this->db->select('gcm_users.*');
        $this->db->from('gcm_users');
        $this->db->join('users', 'users.id = gcm_users.user_id', 'left');
        $this->db->where('gcm_users.type', 'ios');
        $this->db->where_in('users.user_type', 'subscriber');


        $ios_results = $this->db->get()->result();

        // print_r($androidresult);exit();
        $title2 = $title . ' Mini Certification has been added';

        $message1 = $title . ' Mini Certification has been added';
        // $rr=$this->apn->setData($title);
        if (isset($ios_results) && count($ios_results)):
            foreach ($ios_results as $row) {
                //$this->apn->sendMessage($row->gcm_regid,$title.$message1);
                $device = $row->gcm_regid;
                //$last_id = $this->Gcm_model->insert_pushnotification($device, $title2, $message1);
                //echo $this->db->last_query();exit();
                if (!empty($device))
                    if ($this->article_sendnotification_ios($device, $message1, $title2))
                        $flag = TRUE;
                    else
                        $flag = FALSE;
            }
            if ($flag == TRUE) {
                $message = "sucess for all messages";
                $status = 1;
            } else {
                echo $message = "Some messages have errors";
                $status = 0;
            }


        endif;
    }

    function article_sendnotification_ios($id, $message, $title) {


        // $data_notification = $this->Gcm_model->get_pushnotification($id);


        if (!empty($id)) {
            $badge_count = $this->Gcm_model->get_budgecount($id);
            $sound = 'chime'; // string - sound name
            $development = IOS_GCM_DEV_MODE; // boolean
            //echo $this->setapnbadge();

            $payload = array();
            $payload['aps'] = array('alert' => $message, 'badge' => intval($badge_count->badgecount), 'sound' => $sound);
            $payload = json_encode($payload);

            $apns_url = NULL; // Set Later
            $apns_cert = NULL; // Set Later
            $apns_port = 2195;

            if ($development) {
                $apns_url = 'gateway.sandbox.push.apple.com';
                $apns_cert = APPPATH . 'apn/' . IOS_PEM_FILE; // relative address to an App Specific Certificate     file 
            } else {
                $apns_url = 'gateway.push.apple.com';
                $apns_cert = APPPATH . 'apn/' . IOS_PEM_FILE;
            }

            $stream_context = stream_context_create();
            stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);

            $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);

            $device_tokens = array($id); // tokens!!!


            foreach ($device_tokens as $device_token) {
                $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', str_replace('    ', '', $device_token)) . chr(0) . chr(strlen($payload)) . $payload;
                fwrite($apns, $apns_message);
            }
            @$badgedata = $badgedata + 1;

            @socket_close($apns);
            @fclose($apns);
            return TRUE;
        } else
            return FALSE;
    }

    
     public function reorder_assesment_page() {

        //print_r( $this->data['groupcategories']);exit();
        //echo $id = $this->uri->segment(3);exit();
        if ($this->session->userdata('session_data')):
            $this->data = $this->session->userdata('session_data');

   
            $this->data['categories'] = $this->Assesment_model->get_minicertification();
         //   print_r( $this->data['categories']);exit();
            $this->data['category_name'] = "Main";
        else:
            show_404();
        endif;
        
               
        // print_r($this->data['groupcategories']);
        // print_r($this->data['categories']); exit;
     
         $this->load->view('admin/dashboard_reorderassesment_order', $this->data, FALSE);
       

    }
    
     public function save_reoderassesment() {
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
                @$reorder_update = $this->Assesment_model->update($category_row['id'], $cat_data);
                $this->session->set_flashdata('message', 'Reordered sucessful.');
                $i++;
            }
//           if($reorder_update>0){
//                $this->session->set_flashdata('message', 'Reordered sucessfully.');
//
//            }
          
                redirect(site_url('admin/Dashboard_assesment/index'));
           
        else:
            show_404();
        endif;
    }
}
