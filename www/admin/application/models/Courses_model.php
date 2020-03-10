<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Courses_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'courses';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
        date_default_timezone_set('Asia/Kolkata');
    }
	
	function get_courses($id) {
        $sql = "SELECT * FROM courses WHERE FIND_IN_SET($id, group_id) > 0 order by created_on desc";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }
    
     function get_course_image($id , $type)
    {   
        $this->db->select('raw_name,file_ext,caption');
        $this->db->where('courses_id',$id);
		 $this->db->where('type',$type);
        return $this->db->get('image_files')->row();
    }
	function get_chapter_image($courses_id ,$chapter_id, $type)
    {   
        $this->db->select('raw_name,file_ext,caption');
        $this->db->where('courses_id',$courses_id);
		$this->db->where('chapter_id',$chapter_id);
		 $this->db->where('type',$type);
        return $this->db->get('image_files')->row();
    }
    
    function get_author_by_courses()
    {   
        $this->db->select('users.*,count(favorite_author.author_id) as counts');
        $this->db->where('courses.deleted','0');
        $this->db->where('courses.status','Active');
        $this->db->join('courses','courses.author_id=users.id','left');
        $this->db->join('favorite_author','favorite_author.author_id=courses.author_id','left');
        $this->db->group_by('users.id');
        $this->db->order_by('counts','desc');
        return $this->db->get('users')->result();
    }
    
	function get_courses_by_all_result($id) {
            $this->db->where('status','Active'); 
            $this->db->where('deleted','0');
            $this->db->where('id',$id);
			//$this->db->group_by('common_id');
            $this->db->order_by('sort_order','ASC');
            return $this->db->get('courses')->result();
    }
	function get_chapter_by_all_result($id) {
            $this->db->where('status','Active'); 
            $this->db->where('deleted','0');
            $this->db->where('id',$id);
			//$this->db->group_by('common_id');
            $this->db->order_by('sort_order','ASC');
            return $this->db->get('courses')->result();
    }
     function get_courses_by_author_result($id) {
       // $this->db->where('group_company.company_id',$id);
            $this->db->where('status','Active'); 
            $this->db->where('deleted','0');
            $this->db->where('author_id',$id);
			//$this->db->group_by('common_id');
            $this->db->order_by('sort_order','ASC');
            return $this->db->get('courses')->result();
        
    }
    function get_chapter_video_time($userid,$courses_id,$articleid,$chapter_id)
    {
        //echo '<pre>';print_r($articleid);  exit; 
        $this->db->where('user_id',$userid);
		 $this->db->where('chapter_id',$chapter_id);
        $this->db->where('courses_id',$courses_id);
       $this->db->where('article_id',$articleid);
        return $this->db->get('video_time')->row();
    }
    function get_video_time($user_id,$courses_id,$article_id,$chapter_id)
    {
        //echo '<pre>';print_r($article_id);  exit; 
        $this->db->where('user_id',$user_id);
        $this->db->where('courses_id',$courses_id);
		$this->db->where('chapter_id',$chapter_id);
       $this->db->where('article_id',$article_id);
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
    
	function get_chapter_courses_detail($article_id,$courses_id,$chapter_id)
    {   // echo '<pre>';print_r($coursesid);  exit; 
       $this->db->select('courses_id,user_id,articles.id as article_id,url_duration');
       $this->db->where('articles.id',$article_id);
       $this->db->where('courses_id',$courses_id);
       $this->db->join('courses_detail','courses_detail.article_quiz_id=articles.id','left');
        return $this->db->get('articles')->result();
        
    }
    function get_courses_detail($coursesid)
    {   // echo '<pre>';print_r($coursesid);  exit; 
       $this->db->select('courses_id,user_id,articles.id as article_id,url_duration');
       //$this->db->where('articles.id',$articleid);
       $this->db->where('courses_id',$coursesid);
       $this->db->join('courses_detail','courses_detail.article_quiz_id=articles.id','left');
        return $this->db->get('articles')->result();
        
    }
    
    function get_quiz_answer($userid,$course_id,$chapter_id,$question)
    {
        $this->db->where('user_id',$userid);
         $this->db->where('courses_id',$course_id);
		  $this->db->where('chapter_id',$chapter_id);
          $this->db->where('article_quiz_id',$question);
          $this->db->order_by('id','DESC');
          return $this->db->get('quiz_user_answers')->row();
         
    }
    
    function get_quiz_answer_record($userid,$courses_id,$question,$chapter_id)
    {
        $this->db->where('user_id',$userid);
         $this->db->where('courses_id',$courses_id);
		 $this->db->where('chapter_id',$chapter_id);
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
    
    function get_certificate_user($userid,$courses_id,$chapter_id)
    {
        $this->db->where('user_id',$userid);
        $this->db->where('courses_id',$courses_id);
		$this->db->where('chapter_id',$chapter_id);
        return $this->db->get('certificate_user')->result();
    }
    function get_score($userid,$courses_id,$chapter_id)
    {
        $this->db->where('user_id',$userid);
        $this->db->where('courses_id',$courses_id);
		$this->db->where('chapter_id',$chapter_id);
        $this->db->order_by('id','DESC');
       return  $this->db->get('certificate_user')->row();
		// echo $this->db->last_query(); exit;
    }
    function get_correct_answer($id)
    {
        $this->db->where('id',$id); 
        return $this->db->get('article_quiz')->row();
    }
    
     function get_video_time_for_history($userid,$coursesid,$articleid,$chapterid)
    {
        //echo '<pre>';print_r($articleid);  exit; 
        $this->db->where('user_id',$userid);
        $this->db->where('courses_id',$coursesid);
		$this->db->where('chapter_id',$chapterid);
       $this->db->where('article_id',$articleid);
        return $this->db->get('video_time')->result();
    }
    function get_reorder_courses($article_id)
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
		 //echo $this->db->last_query(); exit;
    }
    
    function get_score_user($userid)
    {   
        $this->db->select('courses.title,certificate_user.*');
		$this->db->where('certificate_user.assesment_id','0');
        $this->db->where('certificate_user.user_id',$userid);
        $this->db->join('courses','courses.id=certificate_user.courses_id','left');
        $this->db->order_by('certificate_user.id','DESC');
        return $this->db->get('certificate_user')->result();
    } 
    
    function get_minicertification()
    {   
        $this->db->where('status','Active');
         $this->db->where('deleted','0');
        $this->db->order_by('sort_order','ASC');
      return  $this->db->get('courses')->result();
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
	function update_chapter_details($course_id , $chapter_id ,$data)
    {
		//echo "<pre>"; echo $course_id .$chapter_id; print_r($data); exit;
		$this->db->where('courses_id',$course_id);
		$this->db->where('chapter_id',$chapter_id);
        $this->db->update('courses_detail',$data);
        return true;
    }
	function insert_course_image($data)
    {
        $this->db->insert('image_files',$data);
        return $this->db->insert_id();
    }
	function update_course_image($course_id , $data)
    {
		$this->db->where('courses_id',$course_id);
        $this->db->update('image_files',$data);
        return $this->db->insert_id();
    }
	function update_pdfs($course_id ,$chapter_id ,$datas)
    {					
	$this->db->where('chapter_id',$chapter_id);
	$this->db->where('courses_id',$course_id);
		$data = array(
			'user_id' => $datas['user_id'],
			
			'orig_name' => $datas['orig_name'],
			'file_type' => $datas['file_type'],
			'file_ext' => $datas['file_ext'],
			'file_size' => $datas['file_size'],
			'file_path' => $datas['file_path'],
			'raw_name' => $datas['raw_name'],
			
			
		); 
		//echo '<pre>'; print_r($data);
        $this->db->update('image_files',$data);
		
		//echo '<pre>'; print_r($this->db->insert_id()); 
        return $this->db->insert_id();
    }
	function insert_pdfs($datas)
    {					
		$data = array(
			'user_id' => $datas['user_id'],
			'courses_id' => $datas['courses_id'],
			'chapter_id' => $datas['chapter_id'],
			'orig_name' => $datas['orig_name'],
			'file_type' => $datas['file_type'],
			'file_ext' => $datas['file_ext'],
			'file_size' => $datas['file_size'],
			'file_path' => $datas['file_path'],
			'raw_name' => $datas['raw_name'],
			'type' => $datas['type'],
			'video_type' => $datas['video_type'],
		); 
		//echo '<pre>'; print_r($data);
        $this->db->insert('image_files',$data);
		
		//echo '<pre>'; print_r($this->db->insert_id()); 
        return $this->db->insert_id();
    }
	function delete_course_images($course_id , $type)
    {
		$this->db->where('courses_id', $course_id);
		$this->db->where('type', '2');
		$this->db->delete('image_files');
	}
}