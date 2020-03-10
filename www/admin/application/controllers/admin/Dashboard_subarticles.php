<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/core/Admin_Controller.php';

require APPPATH . '/libraries/MY_Model.php';

class Dashboard_subarticles extends Admin_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('Register_user_model');

        $this->load->model('Register_user_group_model');

        $this->load->model('Category_model');

        $this->load->model('Ion_auth_model');

        $this->load->model('Articles_model');
        $this->load->model('Articles_tag_model');
        $this->load->model('Quiz_article_model');

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
        $this->load->model('Sub_articles_model');
    }

    public function index() {

        $user_id = $this->ion_auth->user()->row()->id;
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        $data['mode'] = 'all';

        if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()):
            $data['approved_articles'] = $this->Sub_articles_model->approved_admin_articles($user_id);
        else:
            $data['approved_articles'] = $this->Sub_articles_model->approved_articles($user_id);
        endif;
        $this->load->view('admin/dashboard_subarticles', $data);
    }

    public function add_subarticles() {
        // extract($array)
        extract($_POST);
        if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()):
            @$active = "1";
        else:

            @$active = "0";
        endif;
        $user_id = $this->ion_auth->user()->row()->id;
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        if (!empty($article_id)):
            $subarticleform_data = array('article_id' => $article_id,
                'user_id' => $user_id,
                'title' => $title,
                'description' => $description);
            $insert_id = $this->Sub_articles_model->insert($subarticleform_data);
            if (!empty($insert_id)):
                $this->Articles_model->update($article_id, array('active' => $active));
            endif;
            $this->session->set_flashdata('message', 'sub Article Successfully Added');
        else:
            show_404();
        endif;
        redirect(site_url('admin/Dashboard_subarticles/index') . "/" . $user_id, $data);
        //$this->load->view('admin/dashboard_subarticles', $data);
    }

    public function view_article() {

        $id = '';
        $data ['cat'] = '';
        $id = $this->uri->segment(4);
        $user_id = $this->ion_auth->user()->row()->id;
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        //print_r($data);exit();
        if (!empty($id)):

            if ($this->session->userdata('session_data'))
                $data = $this->session->userdata('session_data');
            $data['mode'] = 'view';

            $this->db->select('a.*,u.username,c.name as category_name,c.ch_lang_name as category_ch_lang_name,c.bm_lang_name as category_bm_lang_name');

            $this->db->from('articles a');

            $this->db->join(' users u', 'u.id = a.user_id');

            $this->db->join(' category c', 'c.id = a.cat_id');

            $this->db->where("a.id=$id");

            $data['view_article'] = $this->db->get()->result();

            $data ['image_files'] = $this->Image_upload_model->get_all(array('article_id' => $id));

            $data ['article_tag'] = $this->Articles_tag_model->get_all(array('article_id' => $id));


            $data['article_microlearning'] = $this->Quiz_article_model->get(array('article_id' => $id));
            $data['sub_articles'] = $this->Sub_articles_model->get_all(array('article_id' => $id));
            $get_cat_id = $this->Category_model->get($data['view_article'][0]->cat_id);
            $get_parent_id = $this->Category_model->get($get_cat_id->parent_id);
            if (!empty($get_parent_id)):

                if ($data['language'] == 'en'):
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
                if ($data['language'] == 'zh'):
                    @$data ['cat'] .= $get_parent_id->ch_lang_name;
                    $get_parent_id1 = $this->Category_model->get($get_parent_id->parent_id);
                    if (!empty($get_parent_id1)):
                        $data ['cat'] .= "<i class='fa fa-arrow-right'></i>" . $get_parent_id1->ch_lang_name;
                        // array_push($add_cat,$data['view_article ']['parent_name1']);
                        $get_parent_id2 = $this->Category_model->get($get_parent_id1->parent_id);
                        if (!empty($get_parent_id2)):
                            $data ['cat'] .= "<i class='fa fa-arrow-right'></i>" . $get_parent_id2->ch_lang_name;
                        //array_push($add_cat,$data['view_article ']['parent_name2']);

                        endif;
                    endif;
                endif;
                if ($data['language'] == 'my'):
                    @$data ['cat'] .= $get_parent_id->bm_lang_name;
                    $get_parent_id1 = $this->Category_model->get($get_parent_id->parent_id);
                    if (!empty($get_parent_id1)):
                        $data ['cat'] .= "<i class='fa fa-arrow-right'></i>" . $get_parent_id1->bm_lang_name;
                        // array_push($add_cat,$data['view_article ']['parent_name1']);
                        $get_parent_id2 = $this->Category_model->get($get_parent_id1->parent_id);
                        if (!empty($get_parent_id2)):
                            $data ['cat'] .= "<i class='fa fa-arrow-right'></i>" . $get_parent_id2->bm_lang_name;
                        //array_push($add_cat,$data['view_article ']['parent_name2']);

                        endif;
                    endif;
                endif;

            endif;
            $this->load->view('admin/dashboard_subarticles', $data);

        endif;
    }

    public function delete_subarticle() {

        $id = $this->input->post('id');

        //$articles_id=array();
        //$id = 5;

        if (!empty($id)):

            $update_data = array(
                'deleted' => '1',
            );

            $this->Sub_articles_model->delete($id);



            echo TRUE;

        else:

            echo FALSE;

        endif;
    }

    Public function edit_subarticle() {
        $id = $this->uri->segment(4);
        $user_id = $this->ion_auth->user()->row()->id;
        if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        if (!empty($id)):
            $data['mode'] = 'edit';
            $data ['article'] = $this->Articles_model->get($id);
            // echo "<pre>";

            $data ['category'] = $this->Category_model->get('id', $data ['article']->cat_id);
            //  print_r( $data ['category']);exit();
            $data ['sub_article'] = $this->Sub_articles_model->get_all(array('article_id' => $data ['article']->id));
            //redirect(admin/dashboard_subarticles)
            $this->load->view('admin/dashboard_subarticles', $data);
        else:
            show_404();
        endif;
    }

    Public function update_subarticle($id) {
        extract($_POST);

        if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()):
            @$active = "1";
        else:

            @$active = "0";
        endif;
        if (!empty($id)):
            $user_id = $this->ion_auth->user()->row()->id;
            if ($this->session->userdata('session_data'))
                $data = $this->session->userdata('session_data');
            $updated_data = array();
            if (!empty($sub_article_id1)):
                $updated_data1 = array('sub_article_id' => $sub_article_id1, 'title' => $title1, 'description' => $description1);
                array_push($updated_data, $updated_data1);

            endif;
            if (!empty($sub_article_id2)):
                $updated_data2 = array('sub_article_id' => $sub_article_id2, 'title' => $title2, 'description' => $description2);
                array_push($updated_data, $updated_data2);

            endif;
            if (!empty($sub_article_id3)):
                $updated_data3 = array('sub_article_id' => $sub_article_id3, 'title' => $title3, 'description' => $description3);
                array_push($updated_data, $updated_data3);


            endif;
            // print_r($updated_data);exit();
            if (!empty($updated_data)):
                $j = 0;
                foreach ($updated_data as $row) {

                    $updated_data_as = array('article_id' => $id, 'title' => $row['title'], 'description' => $row['description'], 'user_id' => $user_id);
                    //exit();
                    $this->Sub_articles_model->update($row['sub_article_id'], $updated_data_as);
                    // echo $this->db->last_query();
                    if ($this->ion_auth->is_admin() || $this->ion_auth->is_facilitator()):
                        $this->session->set_flashdata('message', 'Updated successfully.');
                    else:
                        $this->session->set_flashdata('message', 'Updated successfully and Article moved to pending section please approve the article.');
                    endif;
                    
                    $j++;
                }
                // exit();
                if ($j > 0):
                    $this->Articles_model->update($id, array('active' => $active));
                endif;
                redirect(site_url('admin/dashboard_subarticles/index') . "/" . $id, $data);
            else:
                $this->session->set_flashdata('error', 'tragin');
                redirect(site_url('admin/edit_subarticle') . "/" . $id, $data);
            endif;

        else:
            show_404();
        endif;
    }

}
