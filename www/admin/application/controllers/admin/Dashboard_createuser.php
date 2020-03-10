<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_createuser extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Register_user_model');
        $this->load->model('Image_upload_model');
        ////$this->load->model('Posting_model');
        $this->load->model('Category_model');
        $this->load->model('Company_model');
        $this->load->model('Department_model');
        //$this->load->model('Advertise_model');
        $this->load->library('upload');

        $this->load->library('image_lib');
        $this->load->model('Ion_auth_model');
        $this->load->library('gcm');
         $this->load->model('Gcm_model');
    }

    public function index($id) {
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');
        $id = $this->uri->segment(4);
        if (!empty($id)):
            //$this->db->order_by("created_on", "desc");
            $this->data['all_user'] = $this->Register_user_model->get_all_adminuser($id);
            //echo $this->db->last_query();exit();
            //print_r($this -> data['all_user']);exit();
            $this->data['mode'] = 'all';
            $this->load->view('admin/auth/view_user', $this->data, FALSE);
        endif;
//         $this->data['all_user'] = $this->Register_user_model->get_all_adminuser();
//         //echo $this->db->last_query();exit();
//        //print_r($this -> data['all_user']);exit();
//            $this->data['mode'] = 'all';
//            $this->load->view('admin/auth/view_user', $this->data, FALSE);
    }

    public function delete() {
        $id = $this->input->post('id');
        if (!empty($id)) {
            $delete_groupusers = $this->Register_user_model->delete_adminuser_group($id);
            echo $this->db->last_query();
            if ($delete_groupusers) {
                $this->Smiles_user_model->delete_adminuser($id);
            }
        }
    }

   public function active() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if (!empty($id)) {
            $update_result = $this->Register_user_model->update($id, array('active'=>$status));
            $userresult = $this->Register_user_model->get('id', $id);
            if ($update_result > 0):
                if (!empty($userresult->phone)):
                    if ($status == '1'):
                        $sms_message = 'Your+' . project_name . '+account+has+been+activated+by+Admin.';
                    else:
                        $sms_message = 'Your+' . project_name . '+account+has+been+Deactivated+by+Admin.';
                    endif;

                    echo $mobileto = substr($userresult->telcode, 1) . $userresult->phone;
                    //echo $mobileto=chop($mobile,"+");
                    $this->send_sms($mobileto, $sms_message);
                endif;

            endif;
        }
    }

    public function department($id) {
        $options = $this->Department_model->custom_dropdown('id', 'name', array('company_id' => $id));
        //echo $this->db->last_query();exit();
        //print_r($options);
        if (!empty($options)):
            $result = '<option value="" selected="selected">Choose a department</option>';
            foreach ($options as $key => $value) {
                $result.='<option value="' . $key . '">' . $value . '</option>';
            }
        else:
            $result = '<option value="" selected="selected">Department not found</option>';
        endif;

        echo $result;
    }

    public function user_type() {
        $id = $this->input->post('id');
        $user_type = $this->input->post('user_type');
         $result1 = $this->Register_user_model->get($id);
         @$previous_user_type=$result1->user_type;
        //print_r($_POST);exit();
        if (!empty($id)) {
            $user_udate_data = $this->Register_user_model->update($id, array('user_type' => $user_type));
            if (count($user_udate_data) > 0):
                // Message & notification
                $result = $this->Register_user_model->get($id);

                $sms_message = project_name.':+Your+User+Type+has+been+updated+from+' .$previous_user_type .'+to+'. $result->user_type;
                $mobileto = substr($result->telcode, 1) . $result->phone;
                $this->send_sms($mobileto, $sms_message);
                
                $this->send_pushnotification($result->id,$user_type,$previous_user_type);
                $this->send_ios($result->id,$user_type,$previous_user_type);
                echo TRUE;

            else:
                echo FALSE;
            endif;
        }
    }

//Function: To send message
    public function send_sms($mobile, $message) {

//       $mobile="917411208986";
//       //$message="Your"+" "+"otp"+"is"+" "+" "+"5678";
//       $message='your+otp+is+456';
        $ch = curl_init();

// set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, "https://mx.fortdigital.net/http/send-message?username=60437&password=GPIdZ1SC&to=%2B'$mobile'to&from=xprienzSMILES&message=$message");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// grab URL and pass it to the browser
        curl_exec($ch);

// close cURL resource, and free up system resources
        curl_close($ch);

        return true;
    }
    public function send_pushnotification($all_user_id, $usertype,$previous_user_type) {
        $title = 1;
//        $all_user_id = '34';
//        $usertype ='subscriber';
//        $previous_user_type ='contributor';
        //print_r($all_user_id);exit();
         $response = "Your user type has been updated from $previous_user_type to $usertype by Admin";

        $this->db->select('*');
        $this->db->from('gcm_users');
        //$this->db->join(' users u', 'u.id = gu.user_id');
        $this->db->where("user_id ='$all_user_id' AND type='android'");
        $androidresult = $this->db->get()->row();
        //print_r($androidresult);exit();
        //$gcm_regid='APA91bFyoQY7s1WuKZmnaJ-qfLAbBR4K2Y2SOoOFvb4SNrDyQKXFgUPyyOqHvd1MokGWoLy5qmfhCP834UMt4mOP8PMLMN1zB-7TpmKVXO69lKsZsizoTepQDGW4HrIPKrqbMeDT6jbb';
        //$androidresult=$this->Gcm_model->get_all('type','android');
        // print_r($androidresult);exit();
        if (isset($androidresult) && count($androidresult)):
           // foreach ($androidresult as $row) {
                $this->gcm->addRecepient($androidresult->gcm_regid);
            //}
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

    function send_ios($all_user_id,$usertype,$previous_user_type) {
        $this->db->select('*');
        $this->db->from('gcm_users ');
        //$this->db->join(' users u', 'u.id = gu.user_id');
        $this->db->where("user_id = '$all_user_id' AND type='ios'");

        $ios_results = $this->db->get()->row();

        // print_r($androidresult);exit();
        $title2 =1;
      // $response = "Your user type has been updated from $previous_user_type to $usertype by Admin";
        $message1 ="Your user type has been updated from $previous_user_type to $usertype by Admin";
        // $rr=$this->apn->setData($title);
        if (isset($ios_results) && count($ios_results)):
           // foreach ($ios_results as $row) {
                //$this->apn->sendMessage($row->gcm_regid,$title.$message1);
                $device = $ios_results->gcm_regid;
                $last_id = $this->Gcm_model->insert_pushnotification($device, $title2, $message1);
                //echo $this->db->last_query();exit();
                if (!empty($last_id))
                    if ($this->sendnotification_ios($last_id))
                        $flag = TRUE;
                    else
                        $flag = FALSE;
           // }
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

}

?>