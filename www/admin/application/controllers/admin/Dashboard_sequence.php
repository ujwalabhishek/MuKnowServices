<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_sequence extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Register_user_model');
        $this->load->model('Category_model');
        $this->load->model('Articles_model');
        $this->load->model('Articles_tag_model');
        $this->load->model('Quiz_article_model');
        $this->load->model('Assessment_model', 'Assesment_model');
        $this->load->model('Assessment_details_model');
        $this->load->model('Sequence_model', 'Sequence_model');
        $this->load->model('Sequence_details_model');
        $this->load->model('Department_model');
        $this->load->model('Image_upload_model');
        $this->load->model('Gcm_model');
        $this->load->model('Create_group_model');
        $this->load->library('Gcm');
        $this->load->library('pagination');

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
        $this->db->from('sequence');
        $this->db->where("deleted='0'");
        $data['sequence_list'] = $this->db->get()->result();
        $this->load->view('admin/dashboard_sequence', $data);
    }

    //function :Add article
    public function add_edit() {
        $id = '';
        $data['mode'] = 'add';

        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $id = $this->uri->segment(5);
        if (empty($id)):
            $data['mode'] = 'add';
            //$this->db->select('GROUP_CONCAT(department_id) as department_id');
            //$exit_department = $this->Assesment_model->get();
            // echo $this->db->last_query();exit();
            //print_r($exit_department);exit();

            $data ['group'] = $this->Create_group_model->get_group();
            //echo $this->db->last_query();exit();

            $data ['main_category'] = $this->Category_model->get_all();

            //echo $this->db->last_query();exit();

            $this->db->select('GROUP_CONCAT( DISTINCT cat_id) as cat_id');
            $this->db->from('articles a');
            $this->db->where("a.deleted='0' AND a.active='1'");
            $group_category = $this->db->get()->row();
            //echo $this->db->last_query();exit();
            //print_r($group_category);exit();
            if (!empty($group_category->cat_id)):
                $this->db->where("id IN ($group_category->cat_id)");
                $data ['category'] = $this->Category_model->get_all('deleted', '0');
            else:
                $data ['category'] = array();
            endif;
            //echo count($data ['category']);
            //exit();
            //pagination settings
            $config['base_url'] = site_url('admin/Dashboard_sequence/add_edit');
            $config['total_rows'] = count($data ['category']);
            $config['per_page'] = "2";
            $config["uri_segment"] = 4;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);

            // integrate bootstrap pagination
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '<<';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '>>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);

            $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            // get books list
            //echo $group_category->cat_id;
//            if (!empty($group_category->cat_id)):
//                $this->db->select('*');
//                $this->db->from(' category');
//                $this->db->where("id IN ($group_category->cat_id) AND deleted='0' limit " . $data['page'] . ", " . $config["per_page"]);
//                $data ['category'] = $this->db->get()->result();
//            else:
//                $data ['category'] = array();
//            endif;

            $this->db->select('a.*');
            $this->db->from(' articles a');
            $this->db->where("a.deleted='0' AND a.active='1' ");
            $data ['article'] = $this->db->get()->result();
            // $data['article'] = $this->pagination_model->get_books($config["per_page"], $data['page'], NULL);
            $data['pagination'] = $this->pagination->create_links();

        // load view
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
        $this->load->view('admin/dashboard_sequence', $data);
    }

    public function search_article() {
        $id = '';
        extract($_POST);
        $data['mode'] = 'add';
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $id = $this->uri->segment(5);
        if (!empty($search)):
            $data ['group'] = $this->Create_group_model->get_group();
            $data ['main_category'] = $this->Category_model->get_all();
            $this->db->select('GROUP_CONCAT( DISTINCT cat_id) as cat_id');
            $this->db->from('articles a');
            $this->db->where("a.deleted='0' AND a.active='1'");
            $group_category = $this->db->get()->row();

            if (!empty($group_category->cat_id)):
                $this->db->where("id IN ($group_category->cat_id)");
                $data ['category'] = $this->Category_model->get_all('deleted', '0');
            else:
                $data ['category'] = array();
            endif;

            $config['base_url'] = site_url('admin/Dashboard_sequence/add_edit');
            $config['total_rows'] = count($data ['category']);
            $config['per_page'] = "2";
            $config["uri_segment"] = 4;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);

            // integrate bootstrap pagination
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '<<';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '>>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);

            $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            // get books list
            echo $group_category->cat_id;
            if (!empty($group_category->cat_id)):
                $this->db->select('*');
                $this->db->from(' category');
                $this->db->where("id IN ($group_category->cat_id) AND deleted='0' AND likelimit " . $data['page'] . ", " . $config["per_page"]);
                $data ['category'] = $this->db->get()->result();
            else:
                $data ['category'] = array();
            endif;

            $this->db->select('a.*');
            $this->db->from(' articles a');
            $this->db->where("a.deleted='0' AND a.title LIKE " % $search % " AND a.active='1' ");
            $data ['article'] = $this->db->get()->result();
            // $data['article'] = $this->pagination_model->get_books($config["per_page"], $data['page'], NULL);
            $data['pagination'] = $this->pagination->create_links();
        else:
            $this->session->set_flashdata('search_error', 'Please enter the article to search.');
        endif;




        $this->load->view('admin/dashboard_sequence', $data);
    }

    public function show_all_article() {
        $id = '';
        $data['mode'] = 'add';

        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $id = $this->uri->segment(5);
        if (empty($id)):
            $data['mode'] = 'add';
            //$this->db->select('GROUP_CONCAT(department_id) as department_id');
            //$exit_department = $this->Assesment_model->get();
            // echo $this->db->last_query();exit();
            //print_r($exit_department);exit();

            $data ['group'] = $this->Create_group_model->get_group();
            //echo $this->db->last_query();exit();

            $data ['main_category'] = $this->Category_model->get_all();

            //echo $this->db->last_query();exit();

            $this->db->select('GROUP_CONCAT( DISTINCT cat_id) as cat_id');
            $this->db->from('articles a');
            $this->db->where("a.deleted='0' AND a.active='1'");
            $group_category = $this->db->get()->row();
            //echo $this->db->last_query();exit();
            //print_r($group_category);exit();
            if (!empty($group_category->cat_id)):
                $this->db->where("id IN ($group_category->cat_id)");
                $data ['category'] = $this->Category_model->get_all('deleted', '0');
            else:
                $data ['category'] = array();
            endif;
            $this->db->select('a.*');
            $this->db->from(' articles a');
            $this->db->where("a.deleted='0' AND a.active='1' ");
            $data ['article'] = $this->db->get()->result();
            $data['pagination'] = $this->pagination->create_links();

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
        $this->load->view('admin/dashboard_sequence', $data);
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
        extract($_POST);
        $id = '';
        $id = $this->input->post('article_id');
        $article = json_decode($article, true);
        // print_r($article);

        if (empty($id)):
            // print_r($article);exit();
            if (!empty($group)):
                if (!empty($article)):
                    $group_id_implode = implode(',', $group);
                    $add_data = array(
                        'group_id' => $group_id_implode,
                        'title' => $title,
                        'status' => 'Active',
                    );
                    $this->Sequence_model->insert($add_data);
                    @$sequence_id = $this->db->insert_id();

                    if (!empty($sequence_id)):
                        $i = 1;
                        // echo "<pre>";
                        // print_r($article);
                        foreach ($article as $article_row) {


                            $squence_det_data = array(
                                'sequence_id' => $sequence_id,
                                'article_id' => $article_row['id'],
                                'sort_order' => $i
                            );
                            // print_r($squence_det_data);exit();
                            $this->Sequence_details_model->insert($squence_det_data);
                            $i++;
                        }
                        $get_sequence = $this->Sequence_model->get($sequence_id);
                        if (!empty($get_sequence)):
                            //$this->Create_group_model->
                            $this->db->select('group_concat(cm.user_id) as user_id');
                            $this->db->from('create_group cg');
                            $this->db->join(' create_group_member cm ', 'cm.group_id = cg.id');
                            $this->db->where("cg.status='Active' AND cg.deleted='0' AND cm.group_id IN($get_sequence->group_id)");
                            $all_user_id = $this->db->get()->row();
                            //echo $this->db->last_query();exit();
                            $this->send_pushnotification($all_user_id->user_id);
                            $this->send_ios($all_user_id->user_id);
                        endif;
                    endif;

                    if ($assest_id):

                    endif;

                    $this->session->set_flashdata('message', 'Mini-Lesson added sucessfully.');
                    redirect(site_url() . 'admin/Dashboard_sequence/add_edit');
                else:
                    $this->session->set_flashdata('error', 'Please select any article.');
                    redirect($curl);
                endif;
            else:
                $this->session->set_flashdata('error', 'Please select any group.');
                redirect($curl);
            endif;

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
            redirect(site_url() . 'admin/Dashboard_assesment/index');
        endif;
    }

    public function send_pushnotification($all_user_id) {
        $title = project_name;
        $response = "You have a new Mini-Lesson.";

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
        $message1 = "You have a new Mini-Lesson.";
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
                $apns_cert = APPPATH . 'apn/'.IOS_PEM_FILE; // relative address to an App Specific Certificate     file 
            } else {
                $apns_url = 'gateway.push.apple.com';
                $apns_cert = APPPATH . 'apn/'.IOS_PEM_FILE;
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
            $this->Sequence_model->update($id, $update_data);
            // $this->Articles_model->update($id, $update_data);
            echo TRUE;
        else:
            echo FALSE;
        endif;
    }

    public function active() {
        $id = $this->input->post('id');
        echo $status = $this->input->post('status');
        if (!empty($id)) :
            $actiive_data = array(
                'status' => $status,
            );
            $this->Sequence_model->update($id, $actiive_data);
            echo TRUE;
        else:
            echo FALSE;
        endif;
    }

    public function reorder_article_page() {
        extract($_POST);
        $user_id = $this->ion_auth->user()->row()->id;
        $get_art = $this->session->userdata('selected_article');
        $exp_art = explode(',', $get_art);
        @$exp_art_sort = array_unique($exp_art);
        $article_id = implode(',', $exp_art_sort);
        $data['article_id'] = rtrim($article_id, ",");
        $article_id = $data['article_id'];
        $data['group'] = $group;
        $data['title'] = $title;
        $article_id;
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        extract($_POST);
        $id = '';
        $id = $this->input->post('article_id');
        //print_r($_POST);
        //exit();
        // print_r($article);exit();
        if (!empty($group)):
            if (!empty($article_id)):


                $this->db->select('*');
                $this->db->from(' articles ');
                $this->db->where("deleted='0' AND active='1' AND id IN($article_id) ");
                $data ['article'] = $this->db->get()->result();
                $data['group'] = $group;
                $data['title'] = $title;
            else:
                $this->session->set_flashdata('error', 'Please select any article.');
                redirect($curl);
            endif;
        else:
            $this->session->set_flashdata('error', 'Please select any group.');
            redirect($curl);
        endif;


//        print_r($data);
//        exit();

        $this->load->view('admin/dashboard_reorderarticle', $data);
    }

    public function set_article() {
        extract($_POST);
        // print_r($_POST);
        $get_art1 = '';
        //$select_article=array();
        $select_article = $this->input->post('select_article');
        $get_art = $this->session->userdata('selected_article');
// print_r($data['get_art']);
        if (!empty($get_art)):
            //print_r($get_art);
            // echo "1-".$get_art;
            //echo "<pre>";
            $get_art = $this->session->userdata('selected_article');
            // $exp_art=explode(',',$get_art);
            //print_r($get_art);
            //array_unique($exp_art)
            $get_art1 = $get_art . $select_article;
            // print_r($get_art1);
            $this->session->set_userdata('selected_article', $get_art1);
        else:
            $this->session->set_userdata('selected_article', $select_article);
        endif;



        //print_r($get_art);
    }

    public function destory_selectearticle() {
        $this->session->unset_userdata('selected_article');
    }

    public function view_details() {

        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');

        $data['mode'] = 'view';

        $id = $this->uri->segment(4);


        $this->db->select('s.title');

        $this->db->from('sequence s');

        $this->db->where("s.id=$id");

        $data['view_sequence'] = $this->db->get()->result();



        $this->db->select('s.article_id,a.title,c.name');

        $this->db->from('sequence_details s');
        $this->db->from('articles a');
        $this->db->from('category c');

        $this->db->where("s.sequence_id=$id");
        $this->db->where("a.id=s.article_id");
        $this->db->where("c.id=a.cat_id AND a.active='1' AND a.deleted='0'");

        $data['article_sequence'] = $this->db->get()->result();



        $this->load->view('admin/dashboard_sequence_details', $data);
        //echo '<pre>';print_r($data) ; exit();
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

}
