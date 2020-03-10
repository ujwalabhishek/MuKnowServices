<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Favorite_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'favourite_article';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }

    
    function get_fav_articles($user_id)
    {
        $this->db->select('favourite_article.*');
        $this->db->where('favourite_article.user_id',$user_id);
        $this->db->where('articles.deleted','0');
        $this->db->where('articles.active','1');
        $this->db->where('articles.article_type !=','mini_certification');
        $this->db->join('articles','articles.id=favourite_article.article_id','left');
        return $this->db->get('favourite_article')->result();
    }
}
