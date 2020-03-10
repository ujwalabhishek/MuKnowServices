<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Dashboard_users extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Register_user_model');
        $this->load->model('Register_user_group_model');
        $this->load->library('Aes');
    }

    public function index($id,$logintype='') {
         if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        //echo '<pre>'; print_r($logintype); exit;
       $this->db->select('`u`.about,`u`.id,`u`.username,`u`.user_type,`u`.email,`u`.created_on,`u`.mobile_verify,`u`.status,`u`.email_verify,`u`.first_name,`u`.last_name,`u`.telcode,`u`.phone,`u`.status,`u`.login_type,img.raw_name as raw_name,img.file_ext as file_ext');
       // $this->db->select('u.*,g.name as group_name,ug.group_id');
        $this->db->from('users u');
       // $this->db->join(' users_groups ug', 'u.id = ug.user_id');
       // $this->db->join(' groups g', 'g.id = ug.group_id');
        //$this->db->join(' department_list d', 'd.id = u.department');
        //$this->db->join(' company_list c', 'c.id = u.company');
        $this->db->join(' image_files img', 'img.user_id = u.id AND img.type = 1', 'left');
        $this->db->where("u.user_type='$id'");
        if(!empty($logintype) && $id!='facilitator')
        {
           $this->db->where("u.login_type='fb_login'"); 
        }
        elseif($id !='facilitator') { 
           $this->db->where('u.login_type =',NULL); 
        }
		$this->db->order_by('u.created_on', 'DESC');
        $data['register_user'] = $this->db->get()->result();
		
       // echo '<pre>'; print_r($data['register_user']); exit;
        //$fbusers = $this->Register_user_model->get_fbuser_all($id);
        // $data['register_user'] = $fbusers;
//        echo '<pre>'; print_r($data); exit;
        $this->load->view('admin/dashboard_users', $data);
    }

    public function approve_status() {
        $id = $this->input->post('user_id');
        $status = $this->input->post('status');
        $userseult = $this->Register_user_model->get('id', $id);
        if ($status == 1):
            $update_result = $this->Register_user_model->update($id, array('active' => $status));
            $userresult = $this->Register_user_model->get('id', $id);
            if ($update_result > 0):
                if (!empty($userresult->phone)):
                    $sms_message = 'Your+'.project_name.'+account+has+been+activated.';
                    echo $mobileto = substr($userresult->telcode, 1) . $userresult->phone;
                    //echo $mobileto=chop($mobile,"+");
                    $this->send_sms($mobileto, $sms_message);
                endif;
                if (!empty($userresult->email)):
                    $emaildata = array(
                        'email' => $userresult->email,
                        'username' => $userresult->full_name,
                    );
                    if (!empty($emaildata)) {
                        $subject = "Account Activated.";
                        $this->send_email_to('approved', $userresult->email, $emaildata, $subject);
                    }
                endif;
            endif;

        endif;



        echo TRUE;
    }

    public function send_sms($mobile, $message) {

//       $mobile="917411208986";
//       //$message="Your"+" "+"otp"+"is"+" "+" "+"5678";
//       $message='your+otp+is+456';
        $ch = curl_init();

// set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, "https://mx.fortdigital.net/http/send-message?username=60437&password=GPIdZ1SC&to=%2B'$mobile'to&from=".project_name."&message=$message");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// grab URL and pass it to the browser
        curl_exec($ch);

// close cURL resource, and free up system resources
        curl_close($ch);

        return true;
    }

//Function: To send the email notifction
    function send_email_to($type, $email, $data, $subject) {

        //$email = "ujwal.abhishek@ionidea.com";
        $data['base_url'] = base_url();
        $data['site_url'] = base_url();
        $data['site_name'] =project_name;
        if (isset($data['message'])) {
            $data['message'] = $data['message'];
        }

        $data['recipientname'] = ucfirst($data['username']);
        //$data['password'] = ucfirst($data['password']);
        //$from_address = isset($data['from_email']) ? $data['from_email'] : 'meghapatil@biipbyte.com';
		$from_address = isset($data['from_email']) ? $data['from_email'] : 'enquiries@xprienz.com';
        $from_name = isset($data['from_name']) ? $data['from_name'] : $data['site_name'];
        $reply_to_address = $from_address;
        $reply_to_name = $from_name;
        $to = $email;


        $this->load->model('Emailcontent_model');
        $email_content_data = $this->Emailcontent_model->get_email_content_by_key($type);
        //$subject = $data['site_name'] == "Grab Flower";
        $subject = $subject;
        $message = $email_content_data->txt;
        $alt_message = $email_content_data->txt;
        foreach ($data as $key => $value) {
            $message = str_replace('{' . $key . '}', $value, $message);
            $alt_message = str_replace('{' . $key . '}', $value, $alt_message);
        }

        $this->load->library('Email');
        $this->email->set_mailtype("html");
        $this->email->from($from_address, $from_name);
        $this->email->reply_to($reply_to_address, $reply_to_name);
        $this->email->to($email);
        $this->email->bcc('grabflowerssingapore@gmail.com');
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_alt_message($alt_message);

        return $this->email->send();
        //echo $this->email->print_debugger();exit();
    }

    public function nonapproved_list() {

        $data['register_user'] = $this->Smiles_user_model->get_all('status', '0');
        $this->load->view('admin/dashboard_approved', $data);
    }

    public function change_status() {

        $user_id = $this->input->post('user_id');
        if ($this->input->post('status') == '1') {
            $this->load->library('Aes');

            $getuser = $this->Smiles_user_model->get($user_id);

            $password = $this->generateStrongPassword();
            $mobile = $getuser->mobile;
            $message = "Your Login password:" . $password;
            $passwordencrypt = $this->aes->encrypt('AES_KEY', $password);
            $payload = file_get_contents('https://mx.fortdigital.net/http/send-message?username=60437&password=GPIdZ1SC&to=' . $mobile . '&from='.project_name.''.project_name.'-Register-Approved&message=' . $message . '');
            $user_status = array('status' => $this->input->post('status'), 'password' => $passwordencrypt);
        }

        $user_status = array('status' => $this->input->post('status'));
        //print_r($user_status);

        $result = $this->Smiles_user_model->update($user_id, $user_status);

        echo ($result) ? 1 : 0;
    }

    function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds') {
        $sets = array();
        if (strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if (strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if (strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if (strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if (!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

    public function do_nonapprove() {

        $data['register_user'] = $this->Smiles_user_model->get_all();
        $this->load->view('admin/dashboard_register', $data);
    }

    public function add_picture() {

        $return_message = "";
        $config = array(
            'upload_path' => "assets/uploads/profile_image",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE
        );
        $upload_error = array();
        $resize_dim = array("width" => 700, "height" => 600);
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
    
     public function view_coupon() {
       // echo '<pre>'; print_r($id); exit; 
         if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $id = $this->uri->segment(5);
        $data['type'] = $this->uri->segment(3);
          $data['coupon'] = $this->Register_user_model->get_coupon_result($id);
          $data['subscription'] = $this->Register_user_model->get_subscription_result($id);
           //echo '<pre>'; print_r( $data['subscription']); exit;
          $data['scratchcard'] = $this->Register_user_model->get_scratchcard_result($id);
          $this->load->view('admin/view_coupon', $data);
          
         // echo '<pre>'; print_r($coupon); exit;
         
     }
}
