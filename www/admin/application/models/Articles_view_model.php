<?php

class Articles_view_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'user_article_view';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }

    function article_duration_sum($article_id) {
        $sql = "SELECT user_id, count(user_id) as count,SEC_TO_TIME(SUM(TIME_TO_SEC(total_duration))) as total_duration, SEC_TO_TIME(AVG(TIME_TO_SEC(`total_duration`))) as avg_duration FROM `user_article_view` where article_id=$article_id AND year(created_on) = 2017 group by user_id";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
        return null;
    }

    function article_duration_month($article_id, $year) {
        $sql = "SELECT count(user_id) as count,monthname(created_on) as month, SEC_TO_TIME(SUM(TIME_TO_SEC(total_duration))) as total_duration, SEC_TO_TIME(AVG(TIME_TO_SEC(`total_duration`))) as avg_duration, year(created_on) as year FROM `user_article_view` where article_id=$article_id and year(created_on) = $year group by month(created_on), year(created_on)";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
        return null;
    }

    function article_user_details($article_id, $month) {
        $sql = "SELECT monthname(created_on) as month, user_id, count(user_id) as count, monthname(created_on) as month FROM `user_article_view` where article_id=$article_id and month(created_on)=$month group by user_id,month";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
        return null;
    }

    function username($id) {
        $sql = "SELECT username FROM users WHERE id = $id";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        }
        return null;
    }

    //Megha written function starts here

    function individual_user_article_view() {
        $sql = "SELECT u.* ,count(DISTINCT av.article_id) y ,av.user_id as x FROM user_article_view as av
                JOIN users as u ON  u.id=av.user_id 
                JOIN articles as a ON a.id=av.article_id 
                WHERE a.active='1' AND a.deleted='0' AND u.active='1' GROUP BY u.id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
    }
function individual_user_article_totduration() {
        $sql = "SELECT u.*,av.user_id as x,count(DISTINCT av.article_id) view_article FROM user_article_view as av
                JOIN users as u ON  u.id=av.user_id AND u.active='1'
                 JOIN articles as a ON a.id=av.article_id 
                WHERE a.active='1' AND a.deleted='0' AND u.active='1' GROUP BY u.id
              
              ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
    }
//      function individual_user_article_totduration() {
//        $sql = "SELECT DISTINCT u.*,av.user_id as x FROM user_article_view as av
//                JOIN users as u ON  u.id=av.user_id AND u.active='1'
//              
//              ";
//        $query = $this->db->query($sql);
//        if ($query->num_rows() > 0) {
//            $row = $query->result();
//            return $row;
//        }
//    }
     
    function individual_user_individaualarticle_totduration($user_id) {
        $sql = "SELECT av.*,u.id,u.username FROM user_article_view as av
                JOIN users as u ON  u.id=av.user_id AND u.active='1'
                 JOIN articles as a ON a.id=av.article_id 
                WHERE u.id='$user_id' AND a.active='1' AND a.deleted='0' 
              
              ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
    }

  function get_all_article($user_id) {

        $this->db->distinct();
        $this->db->select(" a.*,u.username,c.name as category_name");

        $this->db->from('articles a');

       

        $this->db->join(' category c', 'c.id = a.cat_id');
        $this->db->join(' user_article_view av', 'av.article_id = a.id');
         $this->db->join(' users u', 'u.id = av.user_id');
        $this->db->where("a.active='1' AND a.deleted='0' AND av.user_id=$user_id");

        $this->db->order_by('a.created_on', 'DESC');

        return $this->db->get()->result();
    }
    
     function category_article($cat_id) {
        $sql = "SELECT cat_id,count(DISTINCT id) as total_article FROM articles  
                WHERE cat_id=$cat_id AND active='1' AND deleted='0' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        }
    }
    function individual_article_totduration()
    {
        $sql = "SELECT av.* FROM user_article_view as av                
                 JOIN articles as a ON av.article_id=a.id
                WHERE a.active='1' AND a.deleted='0'               
              ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
    }
    //Megha written function ends here
}
