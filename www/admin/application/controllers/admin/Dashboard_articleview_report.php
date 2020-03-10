<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/core/Admin_Controller.php';

require APPPATH . '/libraries/MY_Model.php';

class Dashboard_articleview_report extends Admin_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('Register_user_model');

        $this->load->model('Register_user_group_model');

        $this->load->model('Category_model');

        $this->load->model('Ion_auth_model');

        $this->load->model('Articles_model');
        $this->load->model('Articles_tag_model');
        $this->load->model('Quiz_article_model');
        $this->load->model('Articles_view_model');
        $this->load->library('upload');

        $this->load->model('Image_upload_model');

        $this->load->library('image_lib');
        $this->load->library('smiles_file');

        $this->lang->load('auth');

        $this->load->library('Aes');

        $this->articleimage_original_path = 'assets/uploads/articles_image';

        $this->articlevideo_original_path = 'assets/uploads/articles_videos';

        $user_id = $this->ion_auth->user()->row()->id;
        $this->load->library('Gcm');
        $this->load->model('Gcm_model');
    }

    public function index() {

        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');

        $data['mode'] = 'all';

        $invidual_user_report_array = $this->Articles_view_model->individual_user_article_view();



        $invidual_user_report = array();
        $invidual_user_report_linegraph = array();
        // print_r($invidual_user_report);exit();
        if (!empty($invidual_user_report_array) && count($invidual_user_report_array) > 0):
            $i = 1;
            foreach ($invidual_user_report_array as $row) {
                // $get_report = array('x' => $i, 'label' => 'user', 'y' => $row->y, 'label' => 'user');
                @$get_report = array('label' => $row->username, 'y' => $row->y);
                @$get_report_chain = array('x' => $i, 'y' => $row->y);
                array_push($invidual_user_report, $get_report);
                array_push($invidual_user_report_linegraph, $get_report_chain);
                @$user_id_implode.=$row->x . ",";
                $i++;
            }
        else:

            $get_report = array('x' => 0, 'y' => 0);
            array_push($invidual_user_report, $get_report);
            array_push($invidual_user_report_linegraph, $get_report_chain);
        endif;

        @$user_id_implode = rtrim(@$user_id_implode, ",");

        $data['invidual_user_report_json'] = json_encode($invidual_user_report, JSON_NUMERIC_CHECK);
        $data['invidual_user_chaingraph_report_json'] = json_encode($invidual_user_report_linegraph, JSON_NUMERIC_CHECK);
///print_r($data['invidual_user_report_json']);exit();
        $data['register_user'] = $this->Articles_view_model->individual_user_article_view();

        $this->load->view('admin/dashboard_articleview_report', $data);
    }

    public function article_total_duration1() {

        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');

        $data['mode'] = 'all';
        $article_total_duration = $this->Articles_view_model->get_all();
        $register_user = $this->Register_user_model->get_all('active', '1');
        //$invidual_user_report_array = $this->Articles_view_model->individual_user_article_totduration();
        if (!empty($article_total_duration)):
            foreach ($invidual_user_report_array as $row) {
                
            }
        else:
        endif;
        echo $this->db->last_query();
        exit();

        $invidual_user_report = array();
        if (!empty($invidual_user_report_array) && count($invidual_user_report_array) > 0):
            $i = 1;
            foreach ($invidual_user_report_array as $row) {
                //$get_report = array('x' => $i, 'label' => 'user', 'y' => $row->y, 'label' => 'user');
                $get_report = array('x' => $i, 'y' => $row->y);
                array_push($invidual_user_report, $get_report);
                @$user_id_implode.=$row->x . ",";
                $i++;
            }

            $get_report = array('x' => 0, 'y' => 0);
            array_push($invidual_user_report, $get_report);
        endif;

        @$user_id_implode = rtrim(@$user_id_implode, ",");

        $data['invidual_user_report_json'] = json_encode($invidual_user_report, JSON_NUMERIC_CHECK);

        $data['register_user'] = $this->Articles_view_model->individual_user_article_view();

        $this->load->view('admin/dashboard_article_duartion_report', $data);
    }

    public function article_total_duration() {

        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');

        $data['mode'] = 'all';
        $article_total_duration = $this->Articles_view_model->individual_article_totduration();
        $register_user = $this->Articles_view_model->individual_user_article_totduration();
        //$invidual_user_report_array = $this->Articles_view_model->individual_user_article_totduration();
        $user_dtata = array();
        $invidual_user_report = array();
        $invidual_user_report_tabel = array();
        $invidual_user_report_y = array();
        $i = 1;
        $tot_duration = 0;
        if (!empty($register_user)):
            foreach ($register_user as $reg_row) {
            $tot_duration = 0;
                foreach ($article_total_duration as $row) {
                    if ($reg_row->id == $row->user_id):
                        $user_totaltime = explode(".", $row->total_duration);

                        $ss = substr($row->total_duration, 0, 8);

                        $rm_str = str_replace(":", ".", $ss);
                        //convert to HH:MM:SS TO SECONDS
                        $seconds = strtotime("1970-01-01 $rm_str UTC");
                        //convert to SECONDS TO HH:MM:SS
                        /// print date('H:i:s', mktime(0, 0, $seconds));exit();
                        $tot_duration+=$seconds;

                    endif;
                }
                //Calculate the interval for graph starts here//
                $tot_duration;
                $get_report_y = array('y' => $tot_duration);
                //Calculate the interval for graph ends here//
                @$get_report = array('x' => $i, 'y' => $tot_duration, 'view_article' => $reg_row->view_article);
                @$tabel_data = array('id' => $reg_row->id, 'username' => $reg_row->username, 'user_type' => $reg_row->user_type, 'telcode' => $reg_row->telcode, 'phone' => $reg_row->phone, 'y' => $tot_duration);
                array_push($invidual_user_report, $get_report);
                array_push($invidual_user_report_y, $get_report_y);
                array_push($invidual_user_report_tabel, $tabel_data);
                @$user_id_implode.=$row->x . ",";
                $i++;
            }

        else:
            $get_report = array('x' => 0, 'y' => 0);
            array_push($invidual_user_report, $get_report);
        endif;


        @$user_id_implode = rtrim(@$user_id_implode, ",");
        //Calculate the interval for graph//
        $max_yaxis = max($invidual_user_report_y);

        $interval = ceil($max_yaxis['y'] / 10);
        //Calculate the interval for graph//
        $data['invidual_user_report_json'] = json_encode($invidual_user_report, JSON_NUMERIC_CHECK);
        $data['interval'] = json_encode($interval, JSON_NUMERIC_CHECK);
        $data['register_user'] = $invidual_user_report_tabel;

        $this->load->view('admin/dashboard_article_duartion_report', $data);
    }
    
 public function indvidualuser_articleview($user_id) {
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $data['mode'] = 'all';
        $article_total_duration = $this->Articles_view_model->individual_user_individaualarticle_totduration($user_id);
        $articles = $this->Articles_view_model->get_all_article($user_id);

       // echo $this->db->last_query();
        //exit();
        $data['reg_row'] = $this->Register_user_model->get($user_id);
//print_r($articles);exit();
        //$invidual_user_report_array = $this->Articles_view_model->individual_user_article_totduration();
        $user_dtata = array();
        $invidual_user_report = array();
        $invidual_user_report_tabel = array();
        $invidual_user_report_y = array();
        $i = 1;
        $tot_duration = 0;
        if (!empty($article_total_duration)):
            // foreach ($register_user as $reg_row) {
            foreach ($articles as $art_row) {
            $tot_duration = 0;
                foreach ($article_total_duration as $row) {
                    if ($art_row->id == $row->article_id):
                        $user_totaltime = explode(".", $row->total_duration);

                        $ss = substr($row->total_duration, 0, 8);

                        $rm_str = str_replace(":", ".", $ss);
                        //convert to HH:MM:SS TO SECONDS
                        $seconds = strtotime("1970-01-01 $rm_str UTC");
                        //convert to SECONDS TO HH:MM:SS
                        /// print date('H:i:s', mktime(0, 0, $seconds));exit();
                        $tot_duration+=$seconds;
                        $tot_duration;
                    endif;
                }
                //if ($reg_row->id == $row->user_id):

                $get_report_y = array('y' => $tot_duration);
                //Calculate the interval for graph ends here//
                @$get_report = array('x' => $i, 'y' => $tot_duration);
                @$tabel_data = array('id' => $art_row->id, 'user_id'=>$user_id,'title' => $art_row->title, 'username' => $art_row->username, 'category_name' => $art_row->category_name, 'y' => $tot_duration);

                array_push($invidual_user_report, $get_report);
                array_push($invidual_user_report_y, $get_report_y);
                array_push($invidual_user_report_tabel, $tabel_data);
                @$user_id_implode.=$row->x . ",";
                $i++;
                //endif;
            }
        //Calculate the interval for graph starts here//
        // }
        // echo "<pre>";
        //print_r($invidual_user_report);
        ///exit();
        else:
            $get_report = array('x' => 0, 'y' => 0);
            array_push($invidual_user_report, $get_report);
        endif;


        @$user_id_implode = rtrim(@$user_id_implode, ",");
        //Calculate the interval for graph//
        $max_yaxis = max($invidual_user_report_y);

        $interval = ceil($max_yaxis['y'] / 10);
        //Calculate the interval for graph//
        $data['invidual_user_report_json'] = json_encode($invidual_user_report, JSON_NUMERIC_CHECK);
        //      print_r( $data['invidual_user_report_json']);exit();
        $data['interval'] = json_encode($interval, JSON_NUMERIC_CHECK);
        $data['register_user'] = $invidual_user_report_tabel; //        if (!empty($id)):
//            $data['register_user'] = $this->Articles_view_model->individual_user_individaualarticle_totduration($user_id);
//        else:
//            show_404();
//        endif;
        $this->load->view('admin/dashboard_individual_articleduration', $data);
    }

    public function article_view_model() {
        $article_id=$this->input->post('article_id');
        $user_id=$this->input->post('user_id');
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');

        $data['article_view'] = $this->Articles_view_model->get_all(array('user_id' => $user_id, 'article_id' => $article_id));
        //echo $this->db->last_query();
        $result=$this->load->view('admin/article_view_duaration_modal', $data,TRUE);
        echo $result;
        //$this->load->view('admin/dashboard_individual_articleduration', $data);
    }
    public function test() {
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $data['mode'] = 'all';

        $this->load->view('admin/graph', $data);
    }

}
