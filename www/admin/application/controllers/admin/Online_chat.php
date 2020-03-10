<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Online_chat extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        //  $this->load->model('Smiles_user_model');
        $this->load->model('Articles_model');
        $this->load->model('Image_upload_model');
        $this->load->model('Group_member_model', 'Create_group_member_model');
          $this->load->library('Fcm');
    }

    public function index() {
        $user_id = $this->ion_auth->user()->row()->id;
        $article_id = '31';
        $url = 'https://onetoonechat-1ab20.firebaseio.com/messages.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $this->data['vals'] = json_decode($data);
//echo'<pre>'; print_r($this->data);exit;
        foreach ($this->data['vals'] as $key => $val) {
            $parent = $key;
            $result = explode("_", $parent);
            $senderid = $result[0];
            $recieverid = $result[1];
            $parentid = $result[2];
            if ($article_id == $parentid) {
                $values[] = $val;
                if ($senderid != '-' . $user_id) {
                    $sender[] = $senderid;
                }
                $reciever[] = $recieverid;
            }
        }
//echo'<pre>'; print_r($sender);exit;

        $url = 'https://onetoonechat-1ab20.firebaseio.com/users.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $this->data['val'] = json_decode($data);


        foreach ($this->data['val'] as $keyid => $res) {
            foreach ($sender as $send) {
                if ($send == $keyid) {

                    $valuss['mobile_number'] = $res->mobile_number;
                    $valuss['password'] = $res->password;
                    $valuss['user_name'] = $res->user_name;
                    $valuss['user_type'] = $res->user_type;
                    $valuss['id'] = $keyid;
                    $valuss['article_id'] = $article_id;
                    $valus[] = $valuss;
                }
            }
        }
        $this->data['val'] = $valus;
//echo'<pre>'; print_r($this->data['val']);exit;
        $this->load->view('admin/online_chat', $this->data);
    }

    function chat($id = '', $article_id = '') {
        $user_id = $this->ion_auth->user()->row()->id;
        //$article_id=31;
        // echo $id;exit();

        if (!empty($id) && !empty($article_id)):
            // echo "<pre>";
            //echo "hi";exit();
            $sender_id = $id;
            $reciever_id = $this->ion_auth->user()->row()->id;
            //$article_id = $article;
             $this->data['key2'] = $sender_id . '_-' . $reciever_id . '_' . $article_id;
            $this->data['key3'] = '-' . $reciever_id . '_' . $sender_id . '_' . $article_id;
            $keys = $sender_id . '_-' . $reciever_id . '_' . $article_id;
            $keys1 = '-' . $reciever_id . '_' . $sender_id . '_' . $article_id;
            //echo $keys1;exit();
            $reciever_image_path = '';
            $sender_image_path = '';
            $reciever_image = $this->Image_upload_model->get(array('user_id' => $reciever_id, 'cat_id' => '0', 'article_id' => '0', 'group_id' => '0'));
            $sender_image = $this->Image_upload_model->get(array('user_id' => substr($sender_id,1), 'cat_id' => '0', 'article_id' => '0', 'group_id' => '0'));
            //echo $this->db->last_query();exit();

            if (!empty($sender_image)):
                $sender_image_path = base_url() . 'assets/uploads/profile_image/' . $sender_image->raw_name . $sender_image->file_ext;
            else:
                $sender_image_path = base_url() . 'assets/uploads/profile_image/noimage.png';

            endif;
            if (!empty($reciever_image)):
                $reciever_image_path = base_url() . 'assets/uploads/profile_image/' . $reciever_image->raw_name . $reciever_image->file_ext;
            else:
                $reciever_image_path = base_url() . 'assets/uploads/profile_image/noimage.png';
            endif;
            // print_r($reciever_image_path);exit();
            //$url = 'https://onetoonechat-1ab20.firebaseio.com/users.json';
            $url = 'https://zawsmiles.firebaseio.com/users.json';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            curl_close($ch);
            $userlist = json_decode($data);
            // echo "<pre>";
//print_r($userlist);
            foreach ($userlist as $keyid => $result) {
//print_r($sender_image);exit();
                if ($keyid == $sender_id) {
                    // $keyid."hi";
                    // $sender_id."hi";
                    $sendername = $result->user_name;
                }

                if ($keyid == '-' . $reciever_id) {
                    $recievername = $result->user_name;
                }
            }


            //echo'<pre>'; print_r($key);exit;
            //$urls = 'https://onetoonechat-1ab20.firebaseio.com/messages.json';
            $urls = 'https://zawsmiles.firebaseio.com/messages.json';
            $chs = curl_init($urls);
            curl_setopt($chs, CURLOPT_TIMEOUT, 5);
            curl_setopt($chs, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($chs, CURLOPT_RETURNTRANSFER, true);
            $datas = curl_exec($chs);
            curl_close($chs);
            $this->data['chat_m'] = json_decode($datas);
           // echo "<pre>";
           //print_r($this->data['chat_m']);

            foreach ($this->data['chat_m'] as $key => $val) {
                // echo $key.'hi';

                if ($key == $keys1) {
                    // echo "megha";
                    $md[] = $val;
                }
            }
           // echo $keys1;
            // print_r($md);
            //exit();
            if (!empty($md)) {
                //$this->data['val'] = $vals;
                $this->data['chat_message_data'] = $md;
            }
            //echo "<pre>";
         //  print_r($this->data['chat_message_data']);exit();
            $this->data['sender_id'] = $sender_id;
            if (!empty($sendername)) {
                $this->data['sendername'] = $sendername;
                $this->data['sender_image'] = $sender_image_path;
            }
            $this->data['reciever_id'] = '-' . $reciever_id;
            $this->data['reciever_id1'] = $reciever_id;
            $this->data['recievername'] = $recievername;
            $this->data['reciever_image'] = $reciever_image_path;

            $this->data['key'] = $keys;
            $this->data['key1'] = $keys1;
            // $this->data['chat_message'] = '';
//Display user list;
             
//            $this->db->select('u.*,img.raw_name as raw_name,img.file_ext as file_ext,g.name as group_name,ug.group_id,c.name as company_name,d.name as department_name');
//            $this->db->from('users u');
//            $this->db->join(' users_groups ug', 'u.id = ug.user_id');
//            $this->db->join(' groups g', 'g.id = ug.group_id');
//            $this->db->join(' department_list d', 'd.id = u.department');
//            $this->db->join(' company_list c', 'c.id = u.company');
//            $this->db->join(' image_files img', 'img.user_id = u.id', 'left');
//            $this->db->where("u.active='1' AND img.cat_id = '0' AND img.article_id = '0'AND  img.group_id = '0'");
//           //$this->db->where("u.active='1' AND img.cat_id = '0'");
//            $this->db->order_by('u.created_on', 'DESC');
//            $this->data['register_user'] = $this->db->get()->result();
         $this->data['register_user'] = $this->Articles_model->get_user_list();
            //     //print_r( $this->data['register_user']);
            //echo $this->db->last_query();exit();
            // $article_id = $id;
           // $url = 'https://onetoonechat-1ab20.firebaseio.com/messages.json';
              $url = 'https://zawsmiles.firebaseio.com/messages.json';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            curl_close($ch);
            $this->data['vals'] = json_decode($data);
//echo'<pre>'; print_r($this->data);exit;
            foreach ($this->data['vals'] as $key => $val) {
                $parent = $key;
                $result = explode("_", $parent);
                $senderid = $result[0];
                $recieverid = $result[1];
                $parentid = $result[2];
                //$senders=array();
                if ($article_id == $parentid) {
                    $values[] = $val;
                    if ($senderid != '-' . $user_id) {
                        $senders[] = $senderid;
                    }
                    $reciever[] = $recieverid;
                }
            }
            // print_r($senders);exit();
            $sender = array_unique($senders);
           // $url = 'https://onetoonechat-1ab20.firebaseio.com/users.json';
              $url = 'https://zawsmiles.firebaseio.com/users.json';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            curl_close($ch);
            $this->data['val'] = json_decode($data);

//print_r($this->data['val']);exit();
            foreach ($this->data['val'] as $keyid => $res) {
                foreach ($sender as $send) {
                    if ($send == $keyid) {

                        //$valuss['mobile_number'] = $res->mobile_number;
                        ///$valuss['password'] = $res->password;
                        //$valuss['user_name'] = $res->user_name;
                        //$valuss['user_type'] = $res->user_type;
                        $valuss['id'] = $keyid;
                        $valuss['article_id'] = $article_id;
                        $valus[] = $valuss;
                    }
                }
            }
            $this->data['val'] = $valus;
        else:
            $user_record = $this->Articles_model->get_user_list();
        
       //echo '<pre>';print_r( $user_record); exit;
//            $this->db->select('u.*,img.raw_name as raw_name,img.file_ext as file_ext,g.name as group_name,ug.group_id,c.name as company_name,d.name as department_name');
//            $this->db->from('users u');
//            $this->db->join(' users_groups ug', 'u.id = ug.user_id');
//            $this->db->join(' groups g', 'g.id = ug.group_id');
//            $this->db->join(' department_list d', 'd.id = u.department');
//            $this->db->join(' company_list c', 'c.id = u.company');
//            $this->db->join(' image_files img', 'img.user_id = u.id', 'left');
//          //  $this->db->where("u.active='1' AND img.cat_id = '0' ");
//           $this->db->where("u.active='1' AND img.cat_id = '0' AND img.article_id = '0'AND  img.group_id = '0'");
//            $this->db->order_by('u.created_on', 'DESC');
//            $this->data['register_user'] = $this->db->get()->result();
             $this->data['register_user'] = $this->Articles_model->get_user_list();
           // print_r( $this->data['register_user']);
            //echo $this->db->last_query();exit();
            $article_id = $id;
            //$url = 'https://onetoonechat-1ab20.firebaseio.com/messages.json';
            $url = 'https://zawsmiles.firebaseio.com/messages.json';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            curl_close($ch);
            $this->data['vals'] = json_decode($data);
//echo'<pre>'; print_r($this->data);exit;
            foreach ($this->data['vals'] as $key => $val) {
                $parent = $key;
                $result = explode("_", $parent);
                $senderid = $result[0];
                $recieverid = $result[1];
                $parentid = $result[2];
                if ($article_id == $parentid) {
                    $values[] = $val;
                    if ($senderid != '-' . $user_id) {
                        $senders[] = $senderid;
                    }
                    $reciever[] = $recieverid;
                }
            }
            $sender = array_unique($senders);
           // print_r($sender);exit();
            //$url = 'https://onetoonechat-1ab20.firebaseio.com/users.json';
              $url = 'https://zawsmiles.firebaseio.com/users.json';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            curl_close($ch);
            $this->data['val'] = json_decode($data);


            foreach ($this->data['val'] as $keyid => $res) {
                foreach ($sender as $send) {
                    if ($send == $keyid) {

                        //$valuss['mobile_number'] = $res->mobile_number;
                        ///$valuss['password'] = $res->password;
                        //$valuss['user_name'] = $res->user_name;
                        //$valuss['user_type'] = $res->user_type;
                        $valuss['id'] = $keyid;
                        $valuss['article_id'] = $article_id;
                        $valus[] = $valuss;
                    }
                }
            }
           
            $this->data['val'] = $valus; //echo '<pre>'; print_r($this->data['val']); exit;
            $this->data['chat_user_data'] = '1';
        endif;
         $this->data['articlesid'] = $article_id;
//echo'<pre>'; print_r($this->data['articlesid']);exit;
        $this->load->view('admin/online_chat', $this->data);
    }

    function history($id = '', $article = '') { //echo'<pre>'; print_r($article);exit;
        //get sender and reciever name show it in mesage list then while sending message store in correct format.
        $sender_id = $id;
        $reciever_id = $this->ion_auth->user()->row()->id;
        $article_id = $article;
        $keys = $sender_id . '_-' . $reciever_id . '_' . $article_id;
        $keys1 = '-' . $reciever_id . '_' . $sender_id . '_' . $article_id;

        $url = 'https://onetoonechat-1ab20.firebaseio.com/users.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $this->datas['userlist'] = json_decode($data);

        foreach ($this->datas['userlist'] as $keyid => $result) {

            if ($keyid == $sender_id) {
                $sendername = $result->user_name;
            }
            if ($keyid == '-' . $reciever_id) {
                $recievername = $result->user_name;
            }
        }


        //echo'<pre>'; print_r($key);exit;
        $url = 'https://onetoonechat-1ab20.firebaseio.com/messages.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $this->data['val'] = json_decode($data);

        foreach ($this->data['val'] as $key => $val) {
            if ($key == $keys) {
                $vals[] = $val;
            }
        }
        $this->data['val'] = $vals;
        $this->data['sender_id'] = $sender_id;
        $this->data['sendername'] = $sendername;
        $this->data['reciever_id'] = '-' . $reciever_id;
        $this->data['recievername'] = $recievername;
        $this->data['key'] = $keys;
        $this->data['key1'] = $keys1;
//echo'<pre>'; print_r($this->data);exit;


        $this->load->view('admin/online_chat_message', $this->data);
    }

    function push_notification_old() {
        $message = $this->input->post('message');
        $id = $this->input->post('id');
        // $id      = '-33';
        // echo '<pre>'; print_r($message); exit;
        $url = 'https://zawsmiles.firebaseio.com/fcm_token.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $datas = curl_exec($ch);
        curl_close($ch);
        $this->data['val'] = json_decode($datas);

        foreach ($this->data['val'] as $key => $value) {//echo '<pre>'; print_r($key); exit;
            if ($key == $id) {
                $result = $value;
            }
        }
        if (!empty($result)) {
            foreach ($result as $res) {

                $ch = curl_init("https://fcm.googleapis.com/fcm/send");

                //The device token.
                $token = $res->fcm_id; //token here
                //Title of the Notification.
                $title = "You Have recieved new message";

                //Body of the Notification.
                $body = $message;

                //Creating the notification array.
                $notification = array('title' => $title, 'text' => $body);

                //This array contains, the token and the notification. The 'to' attribute stores the token.
                $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high');

                //Generating JSON encoded string form the above array.
                $json = json_encode($arrayToSend);
                //Setup headers:
                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Authorization: key= AAAAwbsNfHk:APA91bHZXzjAHpQwNDWIW5tEln-sbF7-zum46RQqx1TG-C57DaGjpG0DlhjPnwxO9Kydrr8jG5EJginp3hfOh1DpasY8gcbURj2wwLJ6Xx5RNppHxxWNxutmMQhxbGRwG2QCfO_mGYSq'; // key here
                //Setup curl, add headers and post parameters.
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                //Send the request
                $response = curl_exec($ch);

                //Close request
                curl_close($ch);
               echo $response; exit;
                //return $response;
            }
        }
    }
    
    
    function push_notification() { 
        $json = '';
        $response = '';
        $message = $this->input->post('message');
        $id = $this->input->post('id');
        $receiver_usename = $this->input->post('receiver_usename');
        $receiver_profileimg = $this->input->post('receiver_profileimg');
        $receiver_userid = $this->input->post('receiver_userid');
        $receiver_artical_id = $this->input->post('receiver_artical_id');
//echo '<pre>'; print_r($_POST); exit;
        
            $title = "2";
            $this->fcm->setTitle($title);

            $url = 'https://zawsmiles.firebaseio.com/fcm_token.json';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $datas = curl_exec($ch);
            curl_close($ch);
            $this->data['val'] = json_decode($datas);

            foreach ($this->data['val'] as $key => $value) {//echo '<pre>'; print_r($key); exit;
                if ($key == $id) {
                    $result = $value;
                }
            }
//PRINT_R($this->data['val']);EXIT();
            if (!empty($result)) :
                foreach ($result as $res) {

                    $token = $res->fcm_id; //token here
                    if ($res->type == 'android'):
                       
                        $this->fcm->setPayload(array(
                            'receiver_usename' => $receiver_usename,
                            'receiver_userid' => $receiver_userid,
                            'receiver_artical_id' => $receiver_artical_id
                        ));

                        $this->fcm->setMessage($message);
                        if ($receiver_profileimg) {
                            $this->fcm->setImage($receiver_profileimg);
                        } else {
                            $this->fcm->setImage('');
                        }
                       // $this->fcm->setIsBackground(TRUE);
                        // $push->setPayload($payload);
                        $json = $this->fcm->getPush();
                       // PRINT_R($json);exit();
                        $response = $this->fcm->send($token, $json);
                        echo $response;
                    endif;
                    if ($res->type == 'ios'):
                        $this->push_notification_ios($token, $message, $receiver_usename, $receiver_profileimg, $receiver_userid, $receiver_artical_id);
                    endif;
                }
            else:
                echo "no data";
            endif;


    }

    function push_notification_ios($fcm_id, $message, $receiver_usename, $receiver_profileimg, $receiver_userid, $receiver_artical_id) {


        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
//
//                    //The device token.
        $token = $fcm_id; //token here
        //Title of the Notification.
        //$title = "You Have recieved new message";
        $title = $receiver_usename;
        //Body of the Notification.
        $body = array('message' => $message, 'data' => $data);

        //Creating the notification array.
        $notification = array('text' => $message, 'title' => $title, "sound" => "default",'receiver_usename' => $receiver_usename, 'receiver_profileimg' => $receiver_profileimg, 'receiver_userid' => $receiver_userid, 'receiver_artical_id' => $receiver_artical_id);

        //This array contains, the token and the notification. The 'to' attribute stores the token.
        // $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high', 'receiver_usename' => $receiver_usename, 'receiver_profileimg' => $receiver_profileimg, 'receiver_userid' => $receiver_userid, 'receiver_artical_id' => $receiver_artical_id);
        $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high');
        // echo "<pre>";
//print_r($arrayToSend);exit();
        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);
        //Setup headers:
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key= AAAAwbsNfHk:APA91bHZXzjAHpQwNDWIW5tEln-sbF7-zum46RQqx1TG-C57DaGjpG0DlhjPnwxO9Kydrr8jG5EJginp3hfOh1DpasY8gcbURj2wwLJ6Xx5RNppHxxWNxutmMQhxbGRwG2QCfO_mGYSq'; // key here
        //Setup curl, add headers and post parameters.
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //Send the request
        $response = curl_exec($ch);

        //Close request
        curl_close($ch);
        // echo $response; exit;
        //return $response;
    }


}
