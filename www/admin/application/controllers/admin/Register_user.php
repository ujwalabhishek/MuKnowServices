<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
class Register_user extends Admin_Controller {
    
    public function __construct()
	{
            parent::__construct();
            
            $this->load->model('Smiles_user_model');
                $this->load->library('Aes');
		
	}
          public function index()
	{   
           
            $data['register_user']=$this->Smiles_user_model->get_all();
            $this -> load -> view('admin/dashboard_register', $data);
        }
         public function approveduser_list()
	{   
           
            $data['register_user']=$this->Smiles_user_model->get_all('status','1');
            $this -> load -> view('admin/dashboard_approved', $data);
        }
         public function nonapproved_list()
	{   
           
            $data['register_user']=$this->Smiles_user_model->get_all('status','0');
            $this -> load -> view('admin/dashboard_approved', $data);
        }
           public function change_status()
	{   
               
                $user_id=$this -> input -> post ('user_id');
               if($this -> input -> post ('status')=='1')
               {    $this->load->library('Aes');
                   
                   $getuser=$this->Smiles_user_model->get($user_id);
                   
                   $password=$this->generateStrongPassword();
                   $mobile=$getuser->mobile;
                   $message="Your Login password:".$password;
                   $passwordencrypt = $this->aes->encrypt('AES_KEY', $password); 
                   $payload = file_get_contents('https://mx.fortdigital.net/http/send-message?username=60437&password=GPIdZ1SC&to='.$mobile.'&from=xprienzSMILES-Register-Approved&message='.$message.'');
                   $user_status = array( 'status' => $this -> input -> post ('status'),'password'=>$passwordencrypt);
               }
                  
            $user_status = array( 'status' => $this -> input -> post ('status'));
            //print_r($user_status);
            
            $result = $this -> Smiles_user_model -> update ($user_id,$user_status);
            
            echo ($result) ? 1 : 0 ;
        }
        function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
        {
            $sets = array();
            if(strpos($available_sets, 'l') !== false)
                    $sets[] = 'abcdefghjkmnpqrstuvwxyz';
            if(strpos($available_sets, 'u') !== false)
                    $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
            if(strpos($available_sets, 'd') !== false)
                    $sets[] = '23456789';
            if(strpos($available_sets, 's') !== false)
                    $sets[] = '!@#$%&*?';
            $all = '';
            $password = '';
            foreach($sets as $set)
            {
                    $password .= $set[array_rand(str_split($set))];
                    $all .= $set;
            }
            $all = str_split($all);
            for($i = 0; $i < $length - count($sets); $i++)
                    $password .= $all[array_rand($all)];
            $password = str_shuffle($password);
            if(!$add_dashes)
                    return $password;
            $dash_len = floor(sqrt($length));
            $dash_str = '';
            while(strlen($password) > $dash_len)
            {
                    $dash_str .= substr($password, 0, $dash_len) . '-';
                    $password = substr($password, $dash_len);
            }
            $dash_str .= $password;
            return $dash_str;
        }
        public function do_nonapprove()
        {   

         $data['register_user']=$this->Smiles_user_model->get_all();
         $this -> load -> view('admin/dashboard_register', $data);
        }
}
