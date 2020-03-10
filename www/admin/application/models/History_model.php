<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class History_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'articles_view_count';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }

    
    function get_fav_articles($user_id)
    {
        $this->db->select('articles_view_count.*,articles.article_type,articles.url_duration');
        $this->db->where('articles_view_count.user_id',$user_id);
        $this->db->where('articles.deleted','0');
        $this->db->where('articles.active','1');
        $this->db->where('articles.article_type !=','mini_certification');
        $this->db->join('articles','articles.id=articles_view_count.article_id','left');
        return $this->db->get('articles_view_count')->result();
    }
	
	function delete_histories($user_id)
    {
			//$this->db->where('article_id',$article_id);
			$this->db->where('user_id',$user_id);
			$this->db->delete('articles_view_count');
    }
}
