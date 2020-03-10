<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('Register_user_model');
//$this->load->helper('email');
        $this->CI = & get_instance();
       // $this->load->model('Company_model');
       // $this->load->model('Department_model');
        $this->load->model('Tele_code_model');
        $this->CI->load->helper('email');
        $this->load->library('smiles_file');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        //$this->load->model('Smiles_user_model');
    }

    // redirect if needed, otherwise display the user list
    function index() {
        if ($this->session->userdata('session_data')) {
            $this->data = $this->session->userdata('session_data');
        }
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('Dedaabox_dev_authlogin', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
            $this->data['users'] = $this->ion_auth->users()->result();
            foreach ($this->data['users'] as $k => $user) {
                $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            }

            $this->_render_page('MuKnow_dev_authlogin', $this->data);
        }
    }

    // log the user in
    function login() {
        if (base_url() == admin_url) {
            $this->data['title'] = "Login";

            //validate form input
            $this->form_validation->set_rules('identity', 'Mobile Number', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == true) {
                // check to see if the user is logging in
                // check for "remember me"
                $remember = (bool) $this->input->post('remember');
                $identity = $this->input->post('identity');
                $identity = preg_replace('/\s+/', '', $identity);
                if ($this->ion_auth->login($identity, $this->input->post('password'), $remember, $this->input->post('telcode'))) {
                    //if the login is successful
                    //redirect them back to the home page
                    if ($this->ion_auth->is_subsciber()):
                        $this->session->set_flashdata('message', 'Sorry,You cant login.');
                        redirect(smils_authlogin);
                    else:
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect('admin/dashbord_welcome', 'refresh');
                    endif;
                } else {
                   // echo "jj";                    die();
                    // if the login was un-successful
                    // redirect them back to the login page
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                     redirect('MuKnow_dev_authlogin'); // use redirects instead of loading views for compatibility with MY_Controller libraries
                }
            } else {
                //echo "hi";exit();
                // the user is not logging in so display the login page
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                $this->data['tele_code'] = $this->Tele_code_model->get_all();
                $this->data['identity'] = array('name' => 'identity',
                    'id' => 'identity',
                    'placeholder' => 'Mobile Number',
                    'type' => 'text',
                    'maxlength'=> '10',
                    'style' => 'margin-top: 30px;',
                    'value' => $this->form_validation->set_value('identity'),
                    'class' => 'form-control number'
                );
                $this->data['password'] = array('name' => 'password',
                    'id' => 'password',
                    'placeholder' => 'Password',
                    'type' => 'password',
                    'class' => 'form-control'
                );

                $this->load->view('admin/auth/login', $this->data);
            }
        } else {
            show_404();
        }
    }

    // log the user out
    function logout() {
        $this->data['title'] = "Logout";

        // log the user out
        $logout = $this->ion_auth->logout();

        // redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect(site_url() . '/MuKnow_dev_authlogin', 'refresh');
    }

    // change password
    function change_password() {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url(), 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == false) {
            // display the form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = array(
                'name' => 'old',
                'id' => 'old',
                'type' => 'password',
                'class' => 'form-control',
                'maxlength' => '25'
            );
            $this->data['new_password'] = array(
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                'class' => 'form-control',
                'maxlength' => '25'
            );
            $this->data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                'class' => 'form-control',
                'maxlength' => '25'
            );
            $this->data['user_id'] = array(
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->id,
                'class' => 'form-control',
            );

            // render
            $this->_render_page('admin/auth/change_password', $this->data);
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout();
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('admin/auth/change_password', 'refresh');
            }
        }
    }

    // forgot password
    function forgot_password() {
        // setting validation rules by checking wheather identity is username or email
        if ($this->config->item('identity', 'ion_auth') != 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
        } else {
            $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }


        if ($this->form_validation->run() == false) {
            $this->data['type'] = $this->config->item('identity', 'ion_auth');
            // setup the input
            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
            );

            if ($this->config->item('identity', 'ion_auth') != 'email') {
                $this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
            } else {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            // set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->_render_page('auth/forgot_password', $this->data);
        } else {
            $identity_column = $this->config->item('identity', 'ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

            if (empty($identity)) {

                if ($this->config->item('identity', 'ion_auth') != 'email') {
                    $this->ion_auth->set_error('forgot_password_identity_not_found');
                } else {
                    $this->ion_auth->set_error('forgot_password_email_not_found');
                }

                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
            }

            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                // if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
            }
        }
    }

    // reset password - final step for forgotten password
    public function reset_password($code = NULL) {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            // if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {
                // display the form
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                // render
                $this->_render_page('auth/reset_password', $this->data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    // something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        // if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("auth/login", 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            // if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    // activate the user
    function activate($id, $code = false) {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            // redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        } else {
            // redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    // deactivate the user
    function deactivate($id = NULL) {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();

            $this->_render_page('auth/deactivate_user', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            // redirect them back to the auth page
            redirect('auth', 'refresh');
        }
    }

// create a new user
    function create_user() { 
      //  echo '<pre>'; print_r($_POST); exit;
        $this->data['title'] = "Create User";
        //$this->data['company'] = $this->Company_model->get_all();
       // $this->data['department'] = $this->Department_model->get_all();
        $email_verify = '';
        if (!$this->ion_auth->logged_in()) {
            redirect('smils_authlogin', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('username', 'Full name', 'required');
        $this->form_validation->set_rules('about', 'About Facilitator', 'required');
        $this->form_validation->set_rules('image_files', 'Image', 'required');
//        if ($identity_column !== 'email') {
//            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
//            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
//        } else {
//            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
//        }
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $about = $this->input->post('about');
        if ($this->input->post('empid')) {
            $empid = $this->input->post('empid');
        } else {
            $empid = null;
        }
        $password_confirm = $this->input->post('password_confirm');
        if (!empty($email)):
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        endif;
        if ($identity_column !== 'phone') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'required|numeric|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim|numeric');
        } else {
            //echo "hi";exit();   
            $exit_phone = $this->Register_user_model->get(array('telcode' => $this->input->post('telcode'), 'phone' => $this->input->post('phone')));
            //echo $this->db->last_query();exit();
            if (empty($phone)):
                $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim|numeric');
            else:

                if (!empty($exit_phone)):
                    //echo "hi";exit();  
                    //$this->form_validation->set_message('phone','phone number');
                    $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim|numeric|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
                    $this->form_validation->set_message('is_unique', 'This %s is already registered.');
                else:
                    $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim|numeric');



                endif;
            endif;
            //$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim|is_unique[' . $tables['users'] . '.phone]');
        }


        //$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
       // $this->form_validation->set_rules('company', 'company', 'required');
        $this->form_validation->set_rules('telcode', 'telcode', 'required');
       // $this->form_validation->set_rules('department', 'department', 'required');
        if (!empty($empid)):
            //$this->form_validation->set_rules('empid', 'learner id', 'required|is_unique[' . $tables['users'] . '.empid]');
            $this->form_validation->set_message('is_unique', 'This %s is already registered.');
        endif;
        if (!empty($password_confirm)):
            $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]|callback_password_check');
            $this->form_validation->set_message('password_check', 'Password should be combination of alphanumeric and minimum 6 character and maximun 25 character.');
        else:
            $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
        endif;
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true) { 
            
            $email = strtolower($email);
            $phone = $this->input->post('phone');
            //$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $telcode = $this->input->post('telcode');
            $identity = ($identity_column === 'phone') ? $telcode . $phone : $this->input->post('identity');

            $password = $this->input->post('password');

            $username = $this->input->post('username');
            if (!empty($email)):
                $email_verify = 'YES';
            endif;
            if (empty($email)):
                $email = null;
            endif;

            $additional_data = array(
                'username' => $this->input->post('username'),
                'user_type' => $this->input->post('user_type'),
                //'email' => $this->input->post('last_name'),
                //'company' => $this->input->post('company'),
                //'department' => $this->input->post('department'),
                'email' => $email,
                //'empid' => $empid,
                'telcode' => $this->input->post('telcode'),
                'phone' => $this->input->post('phone'),
                'mobile_verify' => 'YES',
                'email_verify' => $email_verify,
                'active' => '1',
                'created_on' => date("Y-m-d H:i:s", time()),
                'about' => $about,
            );
            
              if (!empty($caption_image1))
                $caption_image1 = $caption_image1;
            else
                $caption_image1 = null;
           




            if (!file_exists($upload_path)) {
                mkdir($upload_path);
            }

            $upload_error = array();

            if (($this->input->post('image_files'))) {
                $file_data[] = json_decode($this->input->post('image_files'), true);
                 
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
            // print_r($additional_data);
        }
      //  echo '<pre>'; print_r($additional_data); exit; 
      //  
       // $ids = $this->ion_auth->register($identity, $password, $email, $telcode, $additional_data);
        //echo '<pre>'; print_r($ids); exit; 
       // if ($this->form_validation->run() == true && !empty($ids)) { 
          if ($this->form_validation->run() == true) { 
            if ($flag == 1):
                    $i = 1;
            $ids = $this->ion_auth->register($identity, $password, $email, $telcode, $additional_data);
                    foreach ($file_data as $file_data_row) {

                        $f_data = array();
                        $cropData = "";
                        $caption_image = "";
                        if ($i == 1) {
                            $caption_image = $this->input->post('caption_image1');
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
                            'user_id' => $ids,
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
                            'type' => '1',
                            'caption' => $caption_image,
                            
                                // 'user_id' => $user_id
                        );
                      
                        $upload_error = array();
                        $upload_con = array("allowed_types" => "jpeg|jpg|png", "upload_path" => $upload_path);
                        $thumb_dim = array("width" => 100);
                        $cropData = $this->input->post('crop1');
                        $imagelast_id[] = $this->smiles_file->uploadandcrop($f_data, $ids, 1, $upload_error, $upload_con, $cropData, $thumb_dim);
                        
                        $i++;
                    }
                    
                     endif;
            //echo '<pre>'; print_r($_POST); exit;
            // check to see if we are creating the user
            // redirect them back to the admin page
            // megha code for email integartion start here
            // echo $this->db->last_query();
            //print_r($additional_data);exit();
            if (!empty($phone)):
                $sms_message = 'Your+' . project_name . '+account+has+been+created+Link:+http://' . base_url() . '+username:' . $telcode . $phone . '+password:' . $password;
                $mobileto = substr($telcode, 1) . $phone;
                //echo $mobileto=chop($mobile,"+");
                $this->send_sms($mobileto, $sms_message);
            endif;
            if (!empty($email)):
                $emaildata = array(
                    'email' => $email,
                    'username' => $username,
                    'phone' => $telcode . $phone,
                    'password' => $password,
                    'link' => base_url(),
                );
                if (!empty($emaildata)) {
                    $subject = "Account is created.";
                    $this->send_email_to('account_create', $email, $emaildata, $subject);
                }
            endif;
            // print_r($userresult);
            // echo $this->db->last_query();exit();
//            $userdata = array(
//                'email' => $userresult->email,
//                'first_name' => $userresult->first_name,
//                'password' => $password
//            );
//            if (!empty($userdata)) {
//
//                $this->to_send_email('activate', $userresult->email, $userdata);
//            }
            //email integartion ends here
            //$id=$this->db->insert_id();
            //$this->session->set_flashdata('success', $this->ion_auth->messages());
            $this->session->set_flashdata('success', "Trainer created successfully.");
            //echo '<pre>'; print_r($_SESSION); exit;
            redirect(site_url() . '/admin/Dashboard_users/index/facilitator');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            if ($this->session->userdata('session_data'))
                $this->data = $this->session->userdata('session_data');
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

           // $this->data['department'] = $this->Department_model->get_all();
            $this->data['username'] = array(
                'name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('username'),
            );

            $this->data['identity'] = array(
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['about'] = array(
                'name' => 'about',
                'id' => 'about',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('about'),
            );
          
           // $this->data['company'] = $this->Company_model->get_all();
            $this->data['user_type'] = array(
                'name' => 'facilitator', 'name' => 'contributor', 'name' => 'subscriber');
           // $this->data['department'] = $this->Department_model->get_all();
            $this->data['tele_code'] = $this->Tele_code_model->get_all();
            $telcode = $this->input->post('telcode');
            $username = $this->input->post('username');
            // print_r($this->data['company']);exit();
            $this->data['company1'] = array(
                'name' => 'company',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'class' => 'form-control number',
                'maxlength'=>'10',
                'style' => 'margin-top: 30px;',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['empid'] = array(
                'name' => 'empid',
                'id' => 'empid',
                'type' => 'text',
                'class' => 'form-control number',
                'value' => $this->form_validation->set_value('empid'),
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->_render_page('admin/auth/create_user', $this->data);
        }
    }

    function create_contributor() {
        if ($this->session->userdata('session_data'))
            $this->data = $this->session->userdata('session_data');
        $this->data['title'] = "Create Contibutor";
        $this->data['company'] = $this->Company_model->get_all();
        $this->data['department'] = $this->Department_model->get_all();
        $email_verify = '';
        if (!$this->ion_auth->logged_in()) {
            redirect('smils_authlogin', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('username', 'Full name', 'required');
//        if ($identity_column !== 'email') {
//            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
//            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
//        } else {
//            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
//        }
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        if ($this->input->post('empid')) {
            $empid = $this->input->post('empid');
        } else {
            $empid = null;
        }
        $password_confirm = $this->input->post('password_confirm');
        if (!empty($email)):
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        endif;
//        if ($identity_column !== 'phone') {
//            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'required|numeric|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
//            $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim|numeric');
//        } else {
        //echo "hi";exit();   
        if (empty($phone)) {
            $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim|numeric');
        } else {


            $exit_phone = $this->Register_user_model->get(array('telcode' => $this->input->post('telcode'), 'phone' => $this->input->post('phone')));
            //echo $this->db->last_query();exit();
            if (empty($phone)):
                $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim|numeric');
            else:

                if (!empty($exit_phone)):
                    //echo "hi";exit();  
                    //$this->form_validation->set_message('phone','phone number');
                    $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim|numeric|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
                    $this->form_validation->set_message('is_unique', 'This %s is already registered.');
                else:
                    $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim|numeric');


                endif;
            endif;
            //$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim|is_unique[' . $tables['users'] . '.phone]');
        }
        //$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', 'company', 'required');
        $this->form_validation->set_rules('telcode', 'telcode', 'required');
        $this->form_validation->set_rules('department', 'department', 'required');
        if (!empty($empid)):
            $this->form_validation->set_rules('empid', 'learner id', 'required|is_unique[' . $tables['users'] . '.empid]');
            $this->form_validation->set_message('is_unique', 'This %s is already registered.');
        endif;
        if (!empty($password_confirm)):
            $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]|callback_password_check');
            $this->form_validation->set_message('password_check', 'Password should be combination of alphanumeric and minimum 6 character and maximun 25 character.');
        else:
            $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
        endif;
        //$this->form_validation->set_rules('empid', 'employee id', 'required');
        //$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true) {
            $email = strtolower($email);
            $phone = $this->input->post('phone');
            //$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $telcode = $this->input->post('telcode');
            $username = $this->input->post('username');
            $identity = ($identity_column === 'phone') ? $telcode . $phone : $this->input->post('identity');

            $password = $this->input->post('password');
            if (!empty($email)):
                $email_verify = 'YES';
            endif;
            if (empty($email)):
                $email = null;
            endif;
            $additional_data = array(
                'username' => $this->input->post('username'),
                'user_type' => $this->input->post('user_type'),
                //'email' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'department' => $this->input->post('department'),
                'email' => $email,
                'empid' => $empid,
                'telcode' => $this->input->post('telcode'),
                'phone' => $this->input->post('phone'),
                'mobile_verify' => 'YES',
                'email_verify' => $email_verify,
                'active' => '1',
                'created_on' => date("Y-m-d H:i:s", time()),
            );
            // print_r($additional_data);
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $telcode, $additional_data)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            // megha code for email integartion start here
            // echo $this->db->last_query();
            //print_r($additional_data);exit();
            if (!empty($phone)):
                $sms_message = 'Your+' . project_name . '+account+has+been+created+Link:+http://' . base_url() . '+username:' . $telcode . $phone . '+password:' . $password;
                $mobileto = substr($telcode, 1) . $phone;
                //echo $mobileto=chop($mobile,"+");
                $this->send_sms($mobileto, $sms_message);
            endif;
            if (!empty($email)):
                $emaildata = array(
                    'email' => $email,
                    'username' => $username,
                    'phone' => $telcode . $phone,
                    'password' => $password,
                    'link' => base_url(),
                );
                if (!empty($emaildata)) {
                    $subject = "Account is created.";
                    $this->send_email_to('account_create', $email, $emaildata, $subject);
                }
            endif;
            // print_r($userresult);
            // echo $this->db->last_query();exit();
//            $userdata = array(
//                'email' => $userresult->email,
//                'first_name' => $userresult->first_name,
//                'password' => $password
//            );
//            if (!empty($userdata)) {
//
//                $this->to_send_email('activate', $userresult->email, $userdata);
//            }
            //email integartion ends here
            //$id=$this->db->insert_id();
            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect(site_url() . 'admin/auth/create_contributor/');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['department'] = $this->Department_model->get_all();
            $this->data['tele_code'] = $this->Tele_code_model->get_all();
            $this->data['username'] = array(
                'name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('username'),
            );

            $this->data['identity'] = array(
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = $this->Company_model->get_all();
            $this->data['user_type'] = array(
                'name' => 'facilitator', 'name' => 'contributor', 'name' => 'subscriber');
            $this->data['department'] = $this->Department_model->get_all();
            // print_r($this->data['company']);exit();
            $this->data['company1'] = array(
                'name' => 'company',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'class' => 'form-control number',
                'maxlength'=>'10',
                'style' => 'margin-top: 30px;',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['empid'] = array(
                'name' => 'empid',
                'id' => 'empid',
                'type' => 'text',
                'class' => 'form-control number',
                'value' => $this->form_validation->set_value('empid'),
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->_render_page('admin/auth/create_contributor', $this->data);
        }
    }

    function to_send_email($type, $email, $data) {

        //$email = "ujwal.abhishek@ionidea.com";
        $data['base_url'] = base_url();
        $data['site_url'] = base_url();
        $data['site_name'] = 'Hygiene Watch moderator account created!';
        if (isset($data['message'])) {
            $data['message'] = $data['message'];
        }

        $data['recipientname'] = ucfirst($data['first_name']);
        //$data['password'] = ucfirst($data['password']);
        $from_address = isset($data['from_email']) ? $data['from_email'] : 'info@hygienewatch.com';
        $from_name = isset($data['from_name']) ? $data['from_name'] : $data['site_name'];
        $reply_to_address = $from_address;
        $reply_to_name = $from_name;
        $to = $email;


        $this->load->model('Emailcontent_model');
        $email_content_data = $this->Emailcontent_model->get_email_content_by_key($type);
        $subject = $data['site_name'] == "Hygiene Watch";
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
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_alt_message($alt_message);

        return $this->email->send();
    }

    // edit a user
    function edit_user($id) {
        $this->data['title'] = "Edit User";

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $this->input->post('company'),
                    'phone' => $this->input->post('phone'),
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }



                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }
                    }
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    if ($this->ion_auth->is_admin()) {
                        redirect(site_url() . '/admin/Dashboard_createuser/index');
                    } else {
                        redirect('/', 'refresh');
                    }
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    if ($this->ion_auth->is_admin()) {
                        redirect(site_url() . '/admin/Dashboard_createuser/index');
                    } else {
                        redirect('/', 'refresh');
                    }
                }
            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );

        $this->data['company'] = array(
            'name' => 'company',
            'id' => 'company',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('company', $user->company),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'class' => 'form-control',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'class' => 'form-control',
            'type' => 'password'
        );

        $this->_render_page('admin/auth/dashboard_edit_user', $this->data);
    }
    
        // edit a trainer
    function edit_trainer($id) { 
       //echo $id; echo '<pre>'; print_r($_POST); exit;
       $trainer = $this->ion_auth->get_user_details($id);
      // $trainer = $this->db->get($id)->result();
          //echo '<pre>'; print_r($trainer); exit;
        $this->data['title'] = "Edit Trainer";
       // $this->data['company'] = $this->Company_model->get_all();
       // $this->data['department'] = $this->Department_model->get_all();
        $email_verify = '';
        if (!$this->ion_auth->logged_in()) {
            redirect('smils_authlogin', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('username', 'Full name', 'required');
        $this->form_validation->set_rules('about', 'About Facilitator', 'required');
       // $this->form_validation->set_rules('image_files', 'Image', 'required');
        $about = $this->input->post('about');
        
         $email = $this->input->post('email');
       if(!$trainer->email)  {
         if (!empty($email)):
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        endif;
       }
        if ($this->form_validation->run() == true) { 
            
            $username = $this->input->post('username');

            $additional_data = array(
                'username' => $this->input->post('username'),
                'about' => $about,
                'email' => $email,
            );
            $this->ion_auth->edit_trainer($id , $additional_data);
            
              if (!empty($caption_image1))
                $caption_image1 = $caption_image1;
            else
                $caption_image1 = null;
           

            if (!file_exists($upload_path)) {
                mkdir($upload_path);
            }

            $upload_error = array();

            if (($this->input->post('image_files'))) {
                $file_data[] = json_decode($this->input->post('image_files'), true);
                 
            }
            
           //echo '<pre>'; print_r($file_data);exit(); 
//            if (empty($file_data)) {
//                echo "image";
//                exit();
//            }
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
            // print_r($additional_data);
        }

          if ($additional_data) { 
            if ($flag == 1):
                    $i = 1;
           // $ids = $this->ion_auth->edit($identity, $password, $email, $telcode, $additional_data);
                        $this->ion_auth->clear_old_files($id); // delete old file
                       if (!empty($file_data)){
                        foreach ($file_data as $file_data_row) {
                            
                        $f_data = array();
                        $cropData = "";
                        $caption_image = "";
                        if ($i == 1) {
                            $caption_image = $this->input->post('caption_image1');
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
                            'user_id' => $id,
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
                            'type' => '1',
                            'caption' => $caption_image,
                            
                                // 'user_id' => $user_id
                        );
                      
                        $upload_error = array();
                        $upload_con = array("allowed_types" => "jpeg|jpg|png", "upload_path" => $upload_path);
                        $thumb_dim = array("width" => 100);
                        $cropData = $this->input->post('crop1');
                        $imagelast_id[] = $this->smiles_file->uploadandcrop($f_data, $id, 1, $upload_error, $upload_con, $cropData, $thumb_dim);
                        
                        $i++;
                    }
                       }
                     endif;
      
            $this->session->set_flashdata('success', "Trainer Updated successfully.");
            //echo '<pre>'; print_r($_SESSION); exit;
            redirect(site_url() . '/admin/Dashboard_users/index/facilitator');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            if ($this->session->userdata('session_data'))
                $this->data = $this->session->userdata('session_data');
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

           // $this->data['department'] = $this->Department_model->get_all();
            $this->data['username'] = array(
                'name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('username')? $this->form_validation->set_value('username') : $trainer->username,
            );

          
            $this->data['about'] = array(
                'name' => 'about',
                'id' => 'about',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('about') ? $this->form_validation->set_value('about') : $trainer->about,
            );
            
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('email') ? $this->form_validation->set_value('email') : $trainer->email,
            );
            
             $this->data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'disabled' => 'disabled',
                'class' => 'form-control number',
                'maxlength'=>'10',
                'style' => 'margin-top: 30px;',
                'value' => $this->form_validation->set_value('phone') ? $this->form_validation->set_value('phone') : $trainer->phone,
            );
          
           // $this->data['company'] = $this->Company_model->get_all();
            $this->data['user_type'] = array(
                'name' => 'facilitator', 'name' => 'contributor', 'name' => 'subscriber');
           // $this->data['department'] = $this->Department_model->get_all();
            $this->data['tele_code'] = $this->Tele_code_model->get_all();
            $telcode = $this->input->post('telcode');
            $username = $this->input->post('username');
            // print_r($this->data['company']);exit();
            $this->data['company1'] = array(
                'name' => 'company',
                'value' => $this->form_validation->set_value('company'),
            );
            
            $this->data['empid'] = array(
                'name' => 'empid',
                'id' => 'empid',
                'type' => 'text',
                'class' => 'form-control number',
                'value' => $this->form_validation->set_value('empid'),
            );
           
            $this->data['id'] = $id;
            $this->data['trainer'] = $trainer;
                    
            $this->_render_page('admin/auth/edit_user', $this->data);
        }
    }
    
    // create a new group
    function create_group() {
        $this->data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth", 'refresh');
            }
        } else {
            // display the create group form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description'),
            );

            $this->_render_page('auth/create_group', $this->data);
        }
    }

    // edit a group
    function edit_group($id) {
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('auth', 'refresh');
        }

        $this->data['title'] = $this->lang->line('edit_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect("auth", 'refresh');
            }
        }

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $this->data['group_name'] = array(
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
        );
        $this->data['group_description'] = array(
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        $this->_render_page('auth/edit_group', $this->data);
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _render_page($view, $data = null, $returnhtml = false) {//I think this makes more sense
        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);

        if ($returnhtml)
            return $view_html; //This will return html on 3rd argument being true
    }

    public function send_sms($mobile, $message) {

//       $mobile="917411208986";
//       //$message="Your"+" "+"otp"+"is"+" "+" "+"5678";
//       $message='your+otp+is+456';
        $ch = curl_init();

// set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, "https://mx.fortdigital.net/http/send-message?username=60437&password=GPIdZ1SC&to=%2B'$mobile'to&from=Dedaabox&message=$message");
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
        $data['site_name'] = 'Dedaabox';
        if (isset($data['message'])) {
            $data['message'] = $data['message'];
        }

        $data['recipientname'] = ucfirst($data['username']);
        $data['link'] = $data['link'];
        $data['phone'] = $data['phone'];
        $data['password'] = $data['password'];
        //$data['password'] = ucfirst($data['password']);
        //$from_address = isset($data['from_email']) ? $data['from_email'] : 'meghapatil@biipbyte.com';
        $from_address = isset($data['from_email']) ? $data['from_email'] : 'dedaaboxzen@gmail.com';
        $from_name = isset($data['from_name']) ? $data['from_name'] : $data['site_name'];
        $reply_to_address = $from_address;
        $reply_to_name = $from_name;
        $to = $email;


        $this->load->model('Emailcontent_model');
        $email_content_data = $this->Emailcontent_model->get_email_content_by_key($type);
        //$subject = $data['site_name'] == "Grab Flower";
        $subject = $subject;
        $message = $email_content_data->txt;
        //print_r($message);exit();
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
        //$this->email->bcc('grabflowerssingapore@gmail.com');
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
            $payload = file_get_contents('https://mx.fortdigital.net/http/send-message?username=60437&password=GPIdZ1SC&to=' . $mobile . '&from=xprienzSMILES-Register-Approved&message=' . $message . '');
            $user_status = array('status' => $this->input->post('status'), 'password' => $passwordencrypt);
        }

        $user_status = array('status' => $this->input->post('status'));
        //print_r($user_status);

        $result = $this->Smiles_user_model->update($user_id, $user_status);

        echo ($result) ? 1 : 0;
    }

    public function password_check($str) {
        if (preg_match('#[0-9]#', $str) || preg_match('#[@]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
            return TRUE;
        }
        return FALSE;
    }
    
    

}
