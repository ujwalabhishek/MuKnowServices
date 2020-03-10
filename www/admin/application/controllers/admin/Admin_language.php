<?php

require APPPATH . '/core/Admin_Controller.php';

require APPPATH . '/libraries/MY_Model.php';

class Admin_language extends Admin_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Articles_model');
        $this->load->model('Group_member_model', 'Create_group_member_model');
    }

    public function index() {

        // Send retrieved data to view page
        $this->load->view('admin/auth/select_language_page');
    }

    // Select language and manage view page 
    public function select_language() {

        // Destroy session data
        //$this->session->sess_destroy();
        $language = $this->input->post('language');
        if ($language == 'english') {
            $data['selected'] = 'english';
        } if ($language == 'chinese') {
            $data['selected'] = 'chinese';
        }
        if ($language == 'burmese') {
            $data['selected'] = 'burmese';
        }
        //echo 'admin_menu_'.$language;exit();
        // Load language according to language selected
        $this->lang->load('admin_menu_' . $this->input->post('language') . '_lang', $language);
        $this->data['language'] = $this->lang->line('language');
        $this->data['lang_dashboard'] = $this->lang->line('lang_dashboard');
        $this->data['lang_Hi'] = $this->lang->line('lang_Hi');
        $this->data['lang_menu_category'] = $this->lang->line('lang_menu_category');
        $this->data['lang_menu_maincategory'] = $this->lang->line('lang_menu_maincategory');
        $this->data['lang_menu_subcategory'] = $this->lang->line('lang_menu_subcategory');
        $this->data['lang_menu_article'] = $this->lang->line('lang_menu_article');
        $this->data['lang_menu_xprienzsmiles'] = $this->lang->line('lang_menu_xprienzsmiles');
        $this->data['lang_menu_contributor'] = $this->lang->line('lang_menu_contributor');
        $this->data['lang_menu_facilitator'] = $this->lang->line('lang_menu_facilitator');
        $this->data['lang_menu_subscriber'] = $this->lang->line('lang_menu_subscriber');
        $this->data['lang_menu_createcontributor'] = $this->lang->line('lang_menu_createcontributor');
        $this->data['lang_menu_createfacilitator'] = $this->lang->line('lang_menu_createfacilitator');
        $this->data['lang_menu_createsubscriber'] = $this->lang->line('lang_menu_createsubscriber');
        $this->data['lang_menu_assessment'] = $this->lang->line('lang_menu_assessment');
        $this->data['lang_menu_creategroup'] = $this->lang->line('lang_menu_creategroup');
        $this->data['lang_menu_sendmail'] = $this->lang->line('lang_menu_sendmail');
        $this->data['lang_menu_sequence'] = $this->lang->line('lang_menu_sequence');
        $this->data['lang_menu_passwordchange'] = $this->lang->line('lang_menu_passwordchange');
        $this->data['lang_menu_logout'] = $this->lang->line('lang_menu_logout');
        $this->data['lang_menu_admin'] = $this->lang->line('lang_menu_admin');
        $this->data['lang_menu_users'] = $this->lang->line('lang_menu_users');

		$this->data['lang_menu_subscription'] = $this->lang->line('lang_menu_subscription');
        $this->data['lang_menu_promocode'] = $this->lang->line('lang_menu_promocode');
        $this->data['lang_menu_addsubscription'] = $this->lang->line('lang_menu_addsubscription');
		$this->data['lang_menu_scratch_card'] = $this->lang->line('lang_menu_scratch_card');

        $this->data['lang_details'] = $this->lang->line('lang_details');
        $this->data['lang_articlesdetails'] = $this->lang->line('lang_articlesdetails');
        $this->data['lang_pendingarticles'] = $this->lang->line('lang_pendingarticles');
        $this->data['lang_approvedarticles'] = $this->lang->line('lang_approvedarticles');
        $this->data['lang_viewdetails'] = $this->lang->line('lang_viewdetails');

        $this->data['lang_createarticle'] = $this->lang->line('lang_createarticle');

        $this->data['lang_addarticle'] = $this->lang->line('lang_addarticle');
        $this->data['lang_articletitle'] = $this->lang->line('lang_articletitle');
        $this->data['lang_selectmain_category'] = $this->lang->line('lang_selectmain_category');
        $this->data['lang_selectsub_category'] = $this->lang->line('lang_selectsub_category');
        $this->data['lang_selectmsub_subcategory'] = $this->lang->line('lang_selectmsub_subcategory');
        $this->data['lang_selectsub_subsubcategory'] = $this->lang->line('lang_selectsub_subsubcategory');
        $this->data['lang_typefile_upload'] = $this->lang->line('lang_typefile_upload');
        $this->data['lang_plsselect_file'] = $this->lang->line('lang_plsselect_file');
        $this->data['lang_imageto_upload'] = $this->lang->line('lang_imageto_upload');
        $this->data['lang_accepted_fromat'] = $this->lang->line('lang_accepted_fromat');
        $this->data['lang_caption_image'] = $this->lang->line('lang_caption_image');
        $this->data['lang_valid_youtubeurl'] = $this->lang->line('lang_valid_youtubeurl');
        $this->data['lang_maximum_5tag'] = $this->lang->line('lang_maximum_5tag');
        $this->data['lang_submit'] = $this->lang->line('lang_submit');
        $this->data['lang_cancel'] = $this->lang->line('lang_cancel');
        $this->data['lang_choosecategory'] = $this->lang->line('lang_choosecategory');
        $this->data['lang_choosesubcategory'] = $this->lang->line('lang_choosesubcategory');
        $this->data['lang_choosesub_subcategory'] = $this->lang->line('lang_choosesub_subcategory');
        $this->data['lang_categordoesnotexitmessageedit'] = $this->lang->line('lang_categordoesnotexitmessageedit');
        $this->data['lang_edit'] = $this->lang->line('lang_edit');

        $this->data['lang_tagname'] = $this->lang->line('lang_tagname');
        $this->data['lang_description'] = $this->lang->line('lang_description');
        $this->data['lang_shortdescription'] = $this->lang->line('lang_shortdescription');
        $this->data['lang_image'] = $this->lang->line('lang_image');
        $this->data['lang_video'] = $this->lang->line('lang_video');
        $this->data['lang_link'] = $this->lang->line('lang_link');
        $this->data['lang_choosecategory'] = $this->lang->line('lang_choosecategory');
        $this->data['lang_choosesubcategory'] = $this->lang->line('lang_choosesubcategory');
        $this->data['lang_choosesub_subcategory'] = $this->lang->line('lang_choosesub_subcategory');
        $this->data['lang_choosesub_subsubcategory'] = $this->lang->line('lang_choosesub_subsubcategory');
        $this->data['lang_slectlang'] = $this->lang->line('lang_slectlang');
        $this->data['lang_slectedlang'] = $this->lang->line('lang_slectedlang');

        $this->data['lang_english'] = $this->lang->line('lang_english');
        $this->data['lang_chinese'] = $this->lang->line('lang_chinese');
        $this->data['lang_burmese'] = $this->lang->line('lang_burmese');
        $this->data['lang_enterquiz'] = $this->lang->line('lang_enterquiz');
        $this->data['lang_quizdetails'] = $this->lang->line('lang_quizdetails');
        $this->data['lang_question'] = $this->lang->line('lang_question');
        $this->data['lang_answer'] = $this->lang->line('lang_answer');
        $this->data['lang_option1'] = $this->lang->line('lang_option1');
        $this->data['lang_option2'] = $this->lang->line('lang_option2');
        $this->data['lang_option3'] = $this->lang->line('lang_option3');
        $this->data['lang_option4'] = $this->lang->line('lang_option4');
        $this->data['lang_previousimage'] = $this->lang->line('lang_previousimage');
        $this->data['lang_entertagname'] = $this->lang->line('lang_entertagname');
        $this->data['lang_microlearning'] = $this->lang->line('lang_microlearning');
        $this->data['lang_back'] = $this->lang->line('lang_back');

        $this->data['lang_subcategiryname'] = $this->lang->line('lang_subcategiryname');
        $this->data['lang_username'] = $this->lang->line('lang_username');
        $this->data['lang_status'] = $this->lang->line('lang_status');
        $this->data['lang_createdon'] = $this->lang->line('lang_createdon');
        $this->data['lang_action'] = $this->lang->line('lang_action');
        $this->data['lang_rootcategoryname'] = $this->lang->line('lang_rootcategoryname');
        $this->data['lang_tagname'] = $this->lang->line('lang_tagname');
        $this->data['lang_tagnotfound'] = $this->lang->line('lang_tagnotfound');
        //$this->data['lang_microlaerning'] = $this->lang->line('lang_microlaerning');
        $this->data['lang_subsubcategory_notfound'] = $this->lang->line('lang_subsubcategory_notfound');


        $this->data['lang_reportanalysis'] = $this->lang->line('lang_reportanalysis');
        $this->data['lang_articleview_report'] = $this->lang->line('lang_articleview_report');
         $this->data['lang_article_total_duration'] = $this->lang->line('lang_article_total_duration');
            $this->data['lang_upload_image'] = $this->lang->line('lang_upload_image');
        $this->data['lang_notes'] = $this->lang->line('lang_notes');
         $this->data['lang_crop_image'] = $this->lang->line('lang_crop_image');
         $this->data['lang_crop_img'] = $this->lang->line('lang_crop_img');
        $this->data['lang_upload'] = $this->lang->line('lang_upload');
        $this->data['lang_feedback'] = $this->lang->line('lang_feedback');
        $this->data['lang_article_type'] = $this->lang->line('lang_article_type');
        $this->data['lang_trainername'] = $this->lang->line('lang_trainername');
        $this->data['lang_article_name'] = $this->lang->line('lang_article_name');
         $this->data['lang_payment'] = $this->lang->line('lang_payment');
          $this->data['lang_select_image'] = $this->lang->line('lang_select_image');
        // Set session values according to selected language 
        $this->session->set_userdata('session_data', $this->data);
        //$this->data = $this->session->all_userdata();
        $user_id = $this->ion_auth->user()->row()->id;
        $this->data['approved_articles'] = $this->Articles_model->count_all_results(array('active' => '1', 'user_id' => $user_id, 'deleted' => '0'));
        $this->data['pending_articles'] = $this->Articles_model->count_all_results(array('active' > '0', 'user_id' => $user_id, 'deleted' => '0'));
        $this->data['user_id'] = $this->ion_auth->user()->row()->id;
        //$this->data['pending_articles']=$this->Create_group_member_model->count_all_results(array('active=>'0','user_id'=>$user_id,'deleted'=>'0'));
        // $this->load->view('admin/dashbord_welcome', $this->data);
        redirect('admin/dashbord_welcome', $this->data);
    }

}

?>