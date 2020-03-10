<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/core/Admin_Controller.php';
require APPPATH . '/libraries/MY_Model.php';

class Online_chat1 extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        //  $this->load->model('Smiles_user_model');
        $this->load->model('Articles_model');
        $this->load->model('Category_model');
        $this->load->model('Group_member_model', 'Create_group_member_model');
    }

    public function index($id = '') { //echo $id; exit;
        $user_id = $this->ion_auth->user()->row()->id;
        $article_id = $id;
        $url = 'https://onetoonechat-1ab20.firebaseio.com/messages.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $this->data['vals'] = json_decode($data);

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
                $recievers[] = $recieverid;
            }
        }
        $sender = array_unique($senders);
        $reciever = array_unique($recievers);
//echo'<pre>'; print_r($reciever);exit;

        $url = 'https://onetoonechat-1ab20.firebaseio.com/users.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $this->data['val'] = json_decode($data);

//echo'<pre>'; print_r($this->data['val']);exit;
        foreach ($this->data['val'] as $keyid => $res) {
            foreach ($sender as $send) {
                if ($send == $keyid) {
                    if (!empty($res->mobile_number)) {
                        $valuss['mobile_number'] = $res->mobile_number;
                    }
                    if (!empty($res->password)) {
                        $valuss['password'] = $res->password;
                    }
                    if (!empty($res->user_name)) {
                        $valuss['user_name'] = $res->user_name;
                    }
                    if (!empty($res->user_type)) {
                        $valuss['user_type'] = $res->user_type;
                    }
                    if (!empty($keyid)) {
                        $valuss['id'] = $keyid;
                    }
                    $valuss['article_id'] = $article_id;
                    $valus[] = $valuss;
                }
            }
        }
        $this->data['val'] = $valus;
//echo'<pre>'; print_r($this->data['val']);exit;
        $this->load->view('admin/online_chat', $this->data);
    }

    function history($id = '', $article = '') { //echo'<pre>'; print_r($article);exit;
        //get sender and reciever name show it in mesage list then while sending message store in correct format.
        $sender_id = $id;
        $reciever_id = $this->ion_auth->user()->row()->id;
        $article_id = $article;
        $keys = $sender_id . '_-' . $reciever_id . '_' . $article_id;


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
        $urls = 'https://onetoonechat-1ab20.firebaseio.com/messages.json';
        $chs = curl_init($urls);
        curl_setopt($chs, CURLOPT_TIMEOUT, 5);
        curl_setopt($chs, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($chs, CURLOPT_RETURNTRANSFER, true);
        $datas = curl_exec($chs);
        curl_close($chs);
        $this->data['val'] = json_decode($datas);

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
//echo'<pre>'; print_r($this->data);exit;
        $this->load->view('admin/online_chat_message', $this->data);
    }

    function chat($id = '', $article_id = '') {
        $user_id = $this->ion_auth->user()->row()->id;
        //$article_id=31;
        // echo $id;exit();
        if (!empty($id) && !empty($article_id)):
            // echo "<pre>";
            $sender_id = $id;
            $reciever_id = $this->ion_auth->user()->row()->id;
            //$article_id = $article;
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
            $urls = 'https://onetoonechat-1ab20.firebaseio.com/messages.json';
            $chs = curl_init($urls);
            curl_setopt($chs, CURLOPT_TIMEOUT, 5);
            curl_setopt($chs, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($chs, CURLOPT_RETURNTRANSFER, true);
            $datas = curl_exec($chs);
            curl_close($chs);
            $this->data['val'] = json_decode($datas);
            // print_r($this->data['val']);exit();
            foreach ($this->data['val'] as $key => $val) {
                if ($key == $keys) {
                    $vals[] = $val;
                }
            }
            if (!empty($vals)) {
                $this->data['val'] = $vals;
            }

            $this->data['sender_id'] = $sender_id;
            if (!empty($sendername)) {
                $this->data['sendername'] = $sendername;
            }
            $this->data['reciever_id'] = '-' . $reciever_id;
            $this->data['recievername'] = $recievername;
            $this->data['key'] = $keys;
            $this->data['key1'] = $keys1;


        else:
            $this->db->select('u.*,img.raw_name as raw_name,img.file_ext as file_ext,g.name as group_name,ug.group_id,c.name as company_name,d.name as department_name');
            $this->db->from('users u');
            $this->db->join(' users_groups ug', 'u.id = ug.user_id');
            $this->db->join(' groups g', 'g.id = ug.group_id');
            $this->db->join(' department_list d', 'd.id = u.department');
            $this->db->join(' company_list c', 'c.id = u.company');
            $this->db->join(' image_files img', 'img.user_id = u.id', 'left');
            //$this->db->where("u.active='1'");
            $this->db->order_by('u.created_on', 'DESC');
            $this->data['register_user'] = $this->db->get()->result();
            //print_r( $this->data['register_user']);
            //echo $this->db->last_query();exit();
            $article_id = $id;
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
                        $senders[] = $senderid;
                    }
                    $reciever[] = $recieverid;
                }
            }
            $sender = array_unique($senders);
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
        endif;
//echo'<pre>'; print_r($this->data['val']);exit;
        $this->load->view('admin/online_chat_test', $this->data);
    }

    function article($id = '') {
        $user_id = $this->ion_auth->user()->row()->id;
        
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $data['mode'] = 'all';

        //$url = 'https://onetoonechat-1ab20.firebaseio.com/messages.json';
         $url = 'https://zawsmiles.firebaseio.com/messages.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $datas = curl_exec($ch);
        curl_close($ch);
        $this->data['val'] = json_decode($datas);

        foreach ($this->data['val'] as $key => $val) {

            $result = explode("_", $key);
            //echo'<pre>'; print_r( $result);exit;
            if($result[0]== '-'.$user_id || $result[1]== '-'.$user_id){
            $vals['key'][] = $result[2];}
        } 
        $articleids = array_unique($vals['key']);
       // echo'<pre>'; print_r( $articleids);exit;

        foreach ($articleids as $ids) {
            $articlelist[] = $this->Category_model->get_article_id($ids);
        }
        $data['notapprove_articles'] = $articlelist;
      //echo'<pre>'; print_r( $data['notapprove_articles']);exit;

        $this->load->view('admin/chat_article', $data);
    }

    function delete() {
        $keys = $this->input->post('key');
        $id = $this->input->post('id');
        $result = explode(",", $keys);

        $url = 'https://onetoonechat-1ab20.firebaseio.com/messages.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $datas = curl_exec($ch);
        curl_close($ch);
        $this->data['val'] = json_decode($datas);
        //echo '<pre>'; print_r($this->data['val']); exit;
        foreach ($this->data['val'] as $key => $msg) {
            if ($key == $id) {
                foreach ($result as $keyd => $res) {
                    foreach ($msg as $msgkey => $mesg) {
                        if ($res == $msgkey) {
                          
//echo "<script>$(document).ready(function(){
//                                this.messagesRef = database.ref(messages);alert();
//                                this.messagesRef.orderByKey().equalTo(keyss).on(child_added, function (data) {
//                               
//                            });
//                            this.messagesRef.child(keyss).push({
//                                message: text, user: currentuser
//                            })
//                            this.messagesRef.child(keyss1).push({
//                                message: text, user: currentuser
//                            })    
//
//
//});</script>";

                            //write here query for deleting particular record based on this key (msgkey)
                            //echo '<pre>'; print_r($msgkey); exit;    
                        }
                    }
                }
            }
        }
    }

    function push_notification() {
        $message = $this->input->post('message');
        $id = $this->input->post('id');
        // $id      = '-33';
        // echo '<pre>'; print_r($message); exit;
        $url = 'https://onetoonechat-1ab20.firebaseio.com/fcm_token.json';
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
                $headers[] = 'Authorization: key= AAAARu8zzlc:APA91bFrTaACvWb5rRmAKSDrpxBoCxSppMI40XUS7jIsw2dcmkLMic-RMgCn9OnoY_Icj_b93jpCIPAC30y87N9rw3AqxqVSETvsZEIJom3h2eUFJ_D7DQ8v9sJnjy-gtQihUYlpfv8J'; // key here
                //Setup curl, add headers and post parameters.
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                //Send the request
                $response = curl_exec($ch);

                //Close request
                curl_close($ch);
                //echo $response; exit;
                //return $response;
            }
        }
    }

    function push_notification_android() {
        // $message = $this->input->post('message');
        // $id      = $this->input->post('id');
        //$id      = '-2';
        // echo '<pre>'; print_r($message); exit;


        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        //The device token.
        $token = 'cgWahmM1LZI:APA91bGFis3YPC-TfkujAHEHKfqrMRpONMwsxVrY4K4PP0wOFjtqYIt8gWQCV_RPK3DaBDrgybhvjR-P6Xp4FcoEVgpuTyMiMZj_sNZ17Ge3J0zclpctT3zzgUYLFWZJIHDAEwOZguu9'; //token here
        //Title of the Notification.
        $title = "You Have recieved new message";

        //Body of the Notification.
        $body = 'Hello hw r u';

        //Creating the notification array.
        $notification = array('title' => $title, 'text' => $body);

        //This array contains, the token and the notification. The 'to' attribute stores the token.
        $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high');

        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);
        //Setup headers:
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key= AAAARu8zzlc:APA91bFrTaACvWb5rRmAKSDrpxBoCxSppMI40XUS7jIsw2dcmkLMic-RMgCn9OnoY_Icj_b93jpCIPAC30y87N9rw3AqxqVSETvsZEIJom3h2eUFJ_D7DQ8v9sJnjy-gtQihUYlpfv8J'; // key here
        //Setup curl, add headers and post parameters.
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //Send the request
        $response = curl_exec($ch);

        //Close request
        curl_close($ch);
        //echo $response; exit;
        //return $response;
    }

}
