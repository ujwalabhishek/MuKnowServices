<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_create_group extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Register_user_model');
        $this->load->model('Category_model');
        $this->load->model('Articles_model');
        $this->load->model('Quiz_article_model');
        $this->load->model('Assessment_model', 'Assesment_model');
        $this->load->model('Department_model');
        $this->load->model('Image_upload_model');
        $this->load->model('Gcm_model');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->group_path = 'assets/uploads/create_group_image';
        $this->load->model('Create_group_model');
        $this->load->model('Group_member_model', 'Create_group_member_model');
        $this->load->library('Gcm');
        $user_id = $this->ion_auth->user()->row()->id;
		$this->original_path = 'assets/uploads/create_group_image';
        $this->load->library('smiles_file');
    }

    public function index() {
        $user_id = $this->ion_auth->user()->row()->id;
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $data['mode'] = 'all';

        //  $this->db->where('img.limit 1');
        $this->db->distinct();
        $this->db->select("g.*,gm.group_id, i.raw_name, i.file_ext,i.id as imgid");
        $this->db->from('create_group g, image_files i');
        $this->db->join('create_group_member gm', 'gm.group_id=g.id', 'left');
        $this->db->where("g.id=i.group_id");
        $this->db->where("g.deleted='0'");
        $data['create_group_list'] = $this->db->get()->result();
        //echo $this->db->last_query();exit();
        //$data['create_group_list'] = $this->Create_group_model->get_all();
        //$data['get_group_member'] = $this->Create_group_member_model->get_distinct_id();
        // print_r($data['get_group_member']);

        $data['create_group_member_count'] = $this->Create_group_member_model->count_all_result();
        $this->load->view('admin/dashboard_create_group', $data);
    }

    public function add($id) {
        // $member_id = $this->uri->segment(5);

        $data['mode'] = 'add_memeber';
        $this->db->distinct();
        $this->db->select('u.*,gm.user_id,g.name as group_name,c.name as company_name,d.name as department_name');
        $this->db->from('users u');
        $this->db->join(' users_groups ug', 'u.id = ug.user_id');
        $this->db->join(' groups g', 'g.id = ug.group_id');
        $this->db->join(' department_list d', 'd.id = u.department');
        $this->db->join(' company_list c', 'c.id = u.company');
        // $this->db->join(' create_group_member gm', 'gm.user_id = u.id', 'left');
        //$this->db->join(' image_files img', 'img.user_id = u.id', 'left');
        $this->db->where('u.active', '1');
        $this->db->order_by('u.created_on', 'DESC');
        $data['register_user'] = $this->db->get()->result();
        // echo $this->db->last_query();exit();
        $data['get_group'] = $this->Create_group_model->get($id);
        // $data['get_group_member'] = $this->Create_group_member_model->get_all('group_id', $id);
        // print_r($dat['get_group']);exit();

        $this->load->view('admin/dashboard_create_group', $data);
    }

    public function add_edit($id) {
        // $member_id = $this->uri->segment(5);
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $data['mode'] = 'addedit_memeber';
        $this->db->distinct();
        $this->db->select('u.*,g.name as group_name,c.name as company_name,d.name as department_name');
        $this->db->from('users u');
        $this->db->join(' users_groups ug', 'u.id = ug.user_id');
        $this->db->join(' groups g', 'g.id = ug.group_id');
        $this->db->join(' department_list d', 'd.id = u.department');
        $this->db->join(' company_list c', 'c.id = u.company');
        //$this->db->join(' create_group_member gm', 'gm.user_id = u.id', 'left');
        //$this->db->join(' image_files img', 'img.user_id = u.id', 'left');
        $this->db->where("u.active='1'");
        $this->db->order_by('u.created_on', 'DESC');
        $data['register_user'] = $this->db->get()->result();
        // echo $this->db->last_query();
        //exit();
        $data['get_group'] = $this->Create_group_model->get($id);
        $data['get_group_member'] = $this->Create_group_member_model->get_all('group_id', $id);
        //echo $this->db->last_query();exit();

        $this->load->view('admin/dashboard_create_group', $data);
    }

    public function add_group() {
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
                if (!empty($upload_data)) {
                    $template_data['upload_data'] = $upload_data;
                    $template_data['category_name'] = $this->input->post('name');
                    $this->load->view('admin/dashboard_create_group_image_crop', $template_data);
                } else {
                    $template_data['upload_data'] = '';
                    if (!$upload_error)
                        $this->session->set_flashdata('alerts', array('message' => "Please select a file to upload", 'type' => "alert"));
                    else
                        $this->session->set_flashdata('alerts', array('message' => $upload_error, 'type' => "alert"));
                    redirect(site_url() . 'admin/Dashboard_create_group/index/');
                    exit();
                }

                $message = "Please select a image.";
                $this->session->set_flashdata('error', $message);
            endif;
        endif;


        //redirect(site_url() . 'admin/dashboard_create_group/add_edit/' . $datalast_insert_id);
    }
	public function edit_group() { 
        //echo '<pre>'; print_r($_POST); exit;
        $this->form_validation->set_rules('name', 'Name', 'required');
		if ($this->session->userdata('session_data'))
            $template_data = $this->session->userdata('session_data');
        $template_data['upload_path_cat_img'] = $upload_path = $this->original_path;
        if ($this->form_validation->run() == FALSE) :
            $message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $message);

        else:
            //print_r($_FILES);exit();
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
                if (!empty($upload_data)) {
                    $template_data['upload_data'] = $upload_data;
                    $template_data['category_name'] = $this->input->post('name');
                    $template_data['id'] = $this->input->post('id');
                    $template_data['imgid'] = $this->input->post('imgid');

                    $this->load->view('admin/dashboard_create_group_image_crop_edit', $template_data);
                } else {
                    $template_data['upload_data'] = '';
                    if (!$upload_error)
                        $this->session->set_flashdata('alerts', array('message' => "Please select a file to upload", 'type' => "alert"));
                    else
                        $this->session->set_flashdata('alerts', array('message' => $upload_error, 'type' => "alert"));
                    redirect(site_url() . 'admin/Dashboard_create_group/index/');
                    exit();
                }

                $message = "Please select a image.";
                $this->session->set_flashdata('error', $message);
            }
        else {//echo '<pre>'; print_r($_POST); exit;
            $category = array('title' => $this->input->post('name'),
                'status' => 'Active',
                 'id' => $this->input->post('id'),              
                'deleted' => '0'
            );
            $this->Create_group_model->update($this->input->post('id'),$category); 
             redirect(site_url() . 'admin/Dashboard_create_group/index/');
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
            $category = array('title' => $this->input->post('category_name'),
                'status' => 'Active',
                'deleted' => '0'
            );
            $this->Create_group_model->insert($category);
            $datalast_insert_id = $this->db->insert_id();
            if (!empty($datalast_insert_id)) :
                //Email Integration start here
                $img_result = $this->Image_upload_model->get($imagelast_id);
                $this->Image_upload_model->update($img_result->id, array('group_id' => $datalast_insert_id,'type' => 5));
                $this->session->set_flashdata('message', "Group is created successfully.\n Please add member in this group.");
            endif;
        } else {

            $this->session->set_flashdata('alerts', array('message' => "Unabel to upload the data.", 'type' => "alert"));
            $message = strip_tags($this->upload->display_errors());
            $this->session->set_flashdata('error', $message);
            redirect(site_url() . 'admin/Dashboard_create_group/index/');
            exit();
        }


        redirect($base_user_url . 'admin/dashboard_create_group/add_edit/'.$datalast_insert_id);
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

        if (!file_exists($upload_path)) {
            mkdir($upload_path);
        }

        $upload_error = array();
        $upload_con = array("allowed_types" => "jpeg|jpg|png", "upload_path" => $upload_path);
        $thumb_dim = array("width" => 100);
        //$imagelast_id = $this->smiles_file->uploadandcrop($fileData, 0, 4, $upload_error, $upload_con, $cropData, $thumb_dim);
        $imagelast_id = $this->smiles_file->update_uploadandcrop($fileData, 0, 4,$this->input->post('imgid'), $upload_error, $upload_con, $cropData, $thumb_dim);
       // print_r($imagelast_id);exit();
        if (!empty($imagelast_id)) {
            $category = array('title' => $this->input->post('category_name'),
                'status' => 'Active',
                 'id' => $this->input->post('id'),              
                'deleted' => '0'
            );
            $this->Create_group_model->update($this->input->post('id'),$category);
            $datalast_insert_id = $this->db->insert_id();
            if (!empty($this->input->post('id'))) :
                //Email Integration start here
                $img_result = $this->Image_upload_model->get($imagelast_id);
                $this->Image_upload_model->update($img_result->id, array('group_id' => $this->input->post('id'),'type' => 5));
                $this->session->set_flashdata('message', "Group is created successfully.\n Please add member in this group.");
            endif;
        } else {

            $this->session->set_flashdata('alerts', array('message' => "Unabel to upload the data.", 'type' => "alert"));
            $message = strip_tags($this->upload->display_errors());
            $this->session->set_flashdata('error', $message);
            redirect(site_url() . 'admin/Dashboard_create_group/index/');
            exit();
        }


        redirect($base_user_url . 'admin/dashboard_create_group/index/');
    }

    public function add_group_members() {
        extract($_POST);
        $user_id_data = '';
        // $array
        //  echo $curl;exit();

        if (!empty($user)):
            $count_user = count($user);
            $i = 1;
            foreach ($user as $user_row) {

                $member_data = array(
                    'group_id' => $group_id,
                    'user_id' => $user_row
                );
                @$memberinsert_id = $this->Create_group_member_model->insert($member_data);


                if (@$memberinsert_id):
                    if ($count_user == $i):
                        $user_id_data.=$user_row;
                    else:
                        $user_id_data.=$user_row . ",";
                    endif;

                endif;
                $i++;
            }
            //print_r($user_id_data);exit();
            if (!empty($user_id_data)):
                $get_group = $this->Create_group_model->get($group_id);
                $response = "You have added to the group " . $get_group->title;
                $this->send_pushnotification($user_id_data, $response);
                $this->send_ios($user_id_data, $response);
            endif;

            $this->session->set_flashdata('message', "Member added to group successfully.");
            redirect(site_url() . 'admin/dashboard_create_group');
        else:
            $this->session->set_flashdata('error', "Please select  the any member.");
            redirect($curl);
        endif;
    }

    public function addedit_group_members() {
        //echo "<pre>";
//        $foo = array(1, 5, 9, 14, 23, 31, 45);
// $bar = array(14);
// if (in_array("14", $foo)):
//    $data = array_diff($foo,$bar); 
// print_r($data);
// endif;
// 
// exit();
        extract($_POST);
        $user_id_data = '';
        $user_id_data = array();
        $rm_user_id_data = array();
        //$rm_user_id_data = '';
        $get_member = $this->Create_group_member_model->get_all('group_id', $group_id);
        //echo "<pre>";
        //print_r($get_member);
// print_r($user);
        if (!empty($get_member)):
            if (!empty($user)):
                foreach ($get_member as $get_member_row) {
                    if (in_array($get_member_row->user_id, $user)):
                        // $user_final=$user;
//                        if($key = array_search($get_member_row->user_id, $user_final)):
//                          unset($user_final[$key]);  
//                        endif;
                        //print_r($user);
                        $bar = array($get_member_row->user_id);
                        $user = array_diff($user, $bar);
                        $user_final = $user;
                    else:
                        $this->Create_group_member_model->delete('user_id', $get_member_row->user_id);
                        array_push($rm_user_id_data, $get_member_row->user_id);
                    endif;
                    //print_r($user_final);
                    //exit();
                }
            //print_r($user_final);
            else:
                $this->session->set_flashdata('error', "Please select atleast one member in group.");
                redirect($base_user_url . 'admin/dashboard_create_group/add_edit/'.$group_id);
            endif;
        else:
            if (!empty($user)):
                foreach ($user as $user_row) {
                    $get_member = $this->Create_group_member_model->get_all('group_id', $group_id);
                    if (!empty($get_member)):
                        foreach ($get_member as $get_member_row) {
                            if (in_array($get_member_row->user_id, $user)):
                                $user_final = array_diff($user, array($get_member_row->user_id));
                            else:
                                $this->Create_group_member_model->delete('user_id', $get_member_row->user_id);
                                array_push($rm_user_id_data, $get_member_row->user_id);
                            endif;
                        }
                    else:
                        $member_data = array(
                            'group_id' => $group_id,
                            'user_id' => $user_row
                        );
                        $this->Create_group_member_model->insert($member_data);
                        array_push($user_id_data, $user_row);
                    endif;
                }
            else:
                $this->session->set_flashdata('error', "Please select atleast one member in group.");
                redirect($base_user_url . 'admin/dashboard_create_group/add_edit/'.$group_id);
            endif;

        endif;
//print_r($user_final);
        if (!empty($user_final)):
            foreach ($user_final as $user_final_row) {
                $member_data = array(
                    'group_id' => $group_id,
                    'user_id' => $user_final_row
                );
                $this->Create_group_member_model->insert($member_data);
                array_push($user_id_data, $user_final_row);
            }
        endif;
        //exit();
        //print_r($user_id_data);
        //print_r($rm_user_id_data);
        if (!empty($user_id_data)):
            $user_id_data = implode(',', $user_id_data);
            $get_group = $this->Create_group_model->get($group_id);
            $response = "You have added to the group " . $get_group->title;
            $this->send_pushnotification($user_id_data, $response);
            $this->send_ios($user_id_data, $response);
        endif;

        if (!empty($rm_user_id_data)):
            $rm_user_id_data = implode(',', $rm_user_id_data);
            $get_group = $this->Create_group_model->get($group_id);
            $response = "You have removed from the group " . $get_group->title;
            $this->send_pushnotification($rm_user_id_data, $response);
            $this->send_ios($rm_user_id_data, $response);
        endif;
        $this->session->set_flashdata('message', "Member updated in group successfully.");

        //endif;
        redirect(site_url() . 'admin/dashboard_create_group');
    }

    public function send_pushnotification($user_id_data, $response) {
        // echo $user_id_data;exit();
        $title = project_name;
        //$response = "You have a new assessment.";

        $this->db->select('*');
        $this->db->from('gcm_users');
        // $this->db->join(' users u', 'u.id = gu.user_id');
        $this->db->where("user_id IN($user_id_data) AND type='android'");
        $androidresult = $this->db->get()->result();
        //echo $this->db->last_query();
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

    function send_ios($user_id_data, $response) {
        $this->db->select('*');
        $this->db->from('gcm_users');
        // $this->db->join(' users u', 'u.id = gu.user_id');
        $this->db->where("user_id IN($user_id_data) AND type='ios'");
        $iosresult = $this->db->get()->result();
//echo $this->db->last_query();
        //print_r($iosresult);exit();
        $title = project_name;
        $message1 = $response;
        $title.=$title . "\n";
        // $rr=$this->apn->setData($title);
        if (isset($iosresult) && count($iosresult)):
            foreach ($iosresult as $row) {
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

//function: upload image
    function Upload($fieldname, &$return_message = NULL, $upload_path) {
        $files = $_FILES[$fieldname];
        $upload_config = array("allowed_types" => "jpg|png");
        $resize_dim = array("width" => 400, "height" => 200);
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

    public function delete() {
        $id = $this->input->post('id');
        //$articles_id=array();
        //$id = 5;
        if (!empty($id)):

            $this->Create_group_model->update($id, array('deleted' => '1'));
            // $this->Articles_model->update($id, $update_data);
            echo TRUE;
        else:
            echo FALSE;
        endif;
    }

    public function active() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        //$articles_id=array();
        //$id = 5;
        if (!empty($id)):

            $this->Create_group_model->update($id, array('status' => $status));
            // $this->Articles_model->update($id, $update_data);
            echo TRUE;
        else:
            echo FALSE;
        endif;
    }

}
