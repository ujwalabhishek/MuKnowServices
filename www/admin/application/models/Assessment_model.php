<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Assessment_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'assessment';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
        date_default_timezone_set('Asia/Kolkata');
    }
	
	function get_assessment($id) {
        $sql = "SELECT * FROM assessment WHERE FIND_IN_SET($id, group_id) > 0 order by created_on desc";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }
    
     function get_asses_image($id)
    {   
        $this->db->select('raw_name,file_ext,caption');
        $this->db->where('assesment_id',$id);
        return $this->db->get('image_files')->row();
    }
    
    function get_author_by_assesment()
    {   
        $this->db->select('users.*,count(favorite_author.author_id) as counts');
        $this->db->where('assessment.deleted','0');
        $this->db->where('assessment.status','Active');
        $this->db->join('assessment','assessment.author_id=users.id','left');
        $this->db->join('favorite_author','favorite_author.author_id=assessment.author_id','left');
        $this->db->group_by('users.id');
        $this->db->order_by('counts','desc');
        return $this->db->get('users')->result();
    }
    
     function get_minicertify_by_author_result($id) {
       // $this->db->where('group_company.company_id',$id);
            $this->db->where('status','Active'); 
            $this->db->where('deleted','0');
            $this->db->where('author_id',$id);
            $this->db->order_by('sort_order','ASC');
            return $this->db->get('assessment')->result();
        
    }
    
    function get_video_time($userid,$assessmentid,$articleid)
    {
        //echo '<pre>';print_r($articleid);  exit; 
        $this->db->where('user_id',$userid);
        $this->db->where('assesment_id',$assessmentid);
       $this->db->where('article_id',$articleid);
        return $this->db->get('video_time')->row();
    }
    function save_video_time($data,$id='')
    {  
        if(!empty($id))
        {
            $this->db->where('id',$id);
            $this->db->update('video_time',$data);
            return true;
        }
        else 
        {
            $this->db->insert('video_time',$data); 
            return $this->db->insert_id();
        }
    }
    
    function get_assessment_detail($assesmentid)
    {   // echo '<pre>';print_r($assesmentid);  exit; 
       $this->db->select('assesment_id,user_id,articles.id as article_id,url_duration');
       //$this->db->where('articles.id',$articleid);
       $this->db->where('assesment_id',$assesmentid);
       $this->db->join('assessment_detail','assessment_detail.article_quiz_id=articles.id','left');
        return $this->db->get('articles')->result();
        
    }
    
    function get_quiz_answer($userid,$assessmentid,$question)
    {
        $this->db->where('user_id',$userid);
         $this->db->where('assesment_id',$assessmentid);
          $this->db->where('article_quiz_id',$question);
          $this->db->order_by('id','DESC');
          return $this->db->get('quiz_user_answers')->row();
         
    }
    
    function get_quiz_answer_record($userid,$assessmentid,$question)
    {
        $this->db->where('user_id',$userid);
         $this->db->where('assesment_id',$assessmentid);
          $this->db->where('article_quiz.article_id',$question);
          $this->db->join('article_quiz','article_quiz.id=quiz_user_answers.article_quiz_id','left');
          $this->db->order_by('quiz_user_answers.id','DESC');
          return $this->db->get('quiz_user_answers')->row();
         
    }
    
   
    
    function save_quiz_answer($data)
    {
        $this->db->insert('quiz_user_answers',$data);
        return $this->db->insert_id();
    }
    
     function save_certificate_user($data,$id)
    { 
         if(!empty($id))
         {
              $this->db->where('id',$id);
            $this->db->update('certificate_user',$data);
            return true;
         }
         else {
        $this->db->insert('certificate_user',$data);
        return $this->db->insert_id();
         }
    }
    
    function author_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('users')->row();
    }
    
    function get_feedback($id)
    {
        $this->db->where('user_id',$id);
        return $this->db->get('users_feedback')->row();
    }
    
    function save_feedback($id,$data)
    {
        if($id)
        {
            $this->db->where('id',$id);
            $this->db->update('users_feedback',$data);
            return true;
        }
        else 
        {
            $this->db->insert('users_feedback',$data);
            return $this->db->insert_id();
        }
    } 
    
    function get_money()
    {
       return $this->db->get('money')->row();
    }
    
    function save_score($data)
    {
        $this->db->insert('certificate_user',$data);
        return $this->db->insert_id();
    }
    
    function get_certificate_user($userid,$assesmentid)
    {
        $this->db->where('user_id',$userid);
        $this->db->where('assesment_id',$assesmentid);
        return $this->db->get('certificate_user')->result();
    }
    function get_score($userid,$assesmentid)
    {
        $this->db->where('user_id',$userid);
        $this->db->where('assesment_id',$assesmentid);
        $this->db->order_by('id','DESC');
        return $this->db->get('certificate_user')->row();
    }
    function get_correct_answer($id)
    {
        $this->db->where('id',$id); 
        return $this->db->get('article_quiz')->row();
    }
    
     function get_video_time_for_history($userid,$articleid)
    {
        //echo '<pre>';print_r($articleid);  exit; 
        $this->db->where('user_id',$userid);
        //$this->db->where('assesment_id',$assessmentid);
       $this->db->where('article_id',$articleid);
        return $this->db->get('video_time')->result();
    }
    function get_reorder_assesment($article_id)
    {
         $sql="SELECT `articles`.*, article_quiz.id as article_quiz_id  FROM `article_quiz` LEFT JOIN `articles` ON `articles`.`id`=`article_quiz`.`article_id` WHERE `article_quiz`.`id` IN($article_id) AND `articles`.`deleted` = '0' AND `articles`.`active` = '1'";
    
          $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }
    
    function get_certificate_all_user()
    { 
        $this->db->select('users.*');
        $this->db->group_by('user_id');
        $this->db->join('users','users.id=certificate_user.user_id','left');
        $this->db->order_by('certificate_user.id','DESC');
        return $this->db->get('certificate_user')->result();
    }
    
    function get_score_user($userid)
    {   
        $this->db->select('assessment.title,certificate_user.*');
        $this->db->where('certificate_user.user_id',$userid);
        $this->db->join('assessment','assessment.id=certificate_user.assesment_id','left');
        $this->db->order_by('certificate_user.id','DESC');
        return $this->db->get('certificate_user')->result();
    } 
    
    function get_minicertification()
    {   
        $this->db->where('status','Active');
         $this->db->where('deleted','0');
        $this->db->order_by('sort_order','ASC');
      return  $this->db->get('assessment')->result();
    }
	function check_subscribtion_end_date($user_id)
    {   
		$cdate = date('Y-m-d');
        $this->db->where('user_id',$user_id);
        $this->db->where('end_date >= ',$cdate);
        $this->db->order_by('id','DESC');
       return $this->db->get('users_subscription')->row();
	  //echo $this->db->last_query(); exit;
    }
}
