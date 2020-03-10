<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Courses_details_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'courses_detail';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
    
    function get_courses_order($id)
    {
        $this->db->where('courses_id',$id);
        // $this->db->order_by('sort_order','ASC');
         return $this->db->get('courses_detail')->result();
    }
	function get_courses_orders($id)
    {
		 $this->db->group_by('chapter_id');
        $this->db->where('courses_id',$id);
        // $this->db->order_by('sort_order','ASC');
         return $this->db->get('courses_detail')->result();
    }
	function get_chapterss_orders($courses_id , $chapter_id)
    {
		$this->db->where('chapter_id',$chapter_id);
        $this->db->where('courses_id',$courses_id);
        // $this->db->order_by('sort_order','ASC');
         return $this->db->get('courses_detail')->result();
    }
    function get_chapter_order($courses_id, $chapter_id)
    {
		$this->db->where('courses_id',$courses_id);
        $this->db->where('chapter_id',$chapter_id);
         return $this->db->get('courses_detail')->result();
    }
    function delete_existings($courses_id, $chapter_id)
    {
		$this->db->where('courses_id',$courses_id);
        $this->db->where('chapter_id',$chapter_id);
         return $this->db->delete('courses_detail');
    }
	function get_all_view_chapter_lists($courses_id)
    {
		
        $sql = "SELECT courses_id,chapter_id,title, COUNT(*) count,GROUP_CONCAT(article_quiz_id) 
AS article_quiz_id FROM courses_detail where courses_id = $courses_id GROUP BY chapter_id HAVING count > 1;";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
}
