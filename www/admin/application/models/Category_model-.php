<?php

/**
 * Created by PhpStorm.
 * User: HoangLeHuy
 * Date: 7/10/15
 * Time: 6:45 PM
 */
//require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/libraries/MY_Model.php';

class Category_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'category';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }

    public function maincategory() {
        $this->db->select('c.*,img.file_ext,img.raw_name,img.id as imgid');
        $this->db->from('category c');
        $this->db->join(' image_files img', 'img.cat_id = c.id', 'left');
        $this->db->where("c.parent_id='0' AND c.deleted='0'");
        $this->db->order_by('c.sort_order', 'ASC');
        return $this->db->get()->result();
    }

    public function getgroup_category() {
        $sql = "SELECT GROUP_CONCAT(id) as cat_id from category where parent_id=0";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        } else {
            return null;
        }
    }

    public function getall_category($id) {


        $sql = "SELECT root1.id as parent_id, root1.name as maincategory, root.name as name,root.ch_lang_name as chname,root.bm_lang_name as bm_name,root.id as id
        FROM category root 
         JOIN category root1 ON root.parent_id=root1.id where root.parent_id!=0 AND root.parent_id IN($id) AND root.deleted='0' order by root.sort_order";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

    public function getall_subcategory($id) {
        $sql = "SELECT root1.id as parent_id, root1.name as maincategory, root.name as name,root.ch_lang_name as chname,root.bm_lang_name as bm_name,root.id as id
        FROM category root 
        LEFT JOIN category root1 ON root.parent_id=root1.id where root.parent_id=$id AND root.deleted='0' order by root.sort_order";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

    function getall_article($id) {
        $sql = "select group_concat(id)as article_id from articles where cat_id IN($id)";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        } else {
            return null;
        }
    }

    public function category_article_check($id) {
        $this->db->select('GROUP_CONCAT(id) AS article_id');
        $this->db->from('articles');
        //$this->db->where("cat_id=$id AND active='1' AND deleted='0'");
        $this->db->where("cat_id=$id");
        return $this->db->get()->result();
    }

    public function all_category_article_check($id) {
        $this->db->select('GROUP_CONCAT(id) AS article_id');
        $this->db->from('articles');
        $this->db->where("cat_id IN($id) AND active='1' AND deleted='0'");
        return $this->db->get()->result();
    }

    function getall_childcategory($id) {
        $sql = "select group_concat(id)as category_id from category where parent_id=$id AND deleted='0'";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

    function getall_child_childcategory($id) {
        $sql = "select group_concat(id)as category_id from category where parent_id IN($id) AND deleted='0'";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

    function update_article_category($id, $cat_id) {
        $sql = "update articles SET cat_id=$cat_id where id IN($id)";
        $query = $this->db->query($sql);

        if ($query) {

            return TRUE;
        } else {
            return null;
        }
    }

    function dropdown_maincategory() {
        $sql = "SELECT distinct root.id,root.name FROM `category` as root 
JOIN `category` as root1 ON root1.parent_id=root.id
 Where root.parent_id='0' AND root.deleted='0'";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

    function dropdown_zh_maincategory() {
        $sql = "SELECT distinct root.id,root.ch_lang_name as name FROM `category` as root 
JOIN `category` as root1 ON root1.parent_id=root.id
 Where root.parent_id='0' AND root.deleted='0'";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

    function dropdown_my_maincategory() {
        $sql = "SELECT distinct root.id,root.bm_lang_name as name FROM `category` as root 
JOIN `category` as root1 ON root1.parent_id=root.id
 Where root.parent_id='0' AND root.deleted='0'";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

    function get_article_id($articleid) {//echo'<pre>'; print_r($articleid );exit;
        $this->db->where('articles.id', $articleid);
        $this->db->select('articles.*,u.username,c.name as category_name');
        $this->db->join(' users u', 'u.id = articles.user_id');
        $this->db->join(' category c', 'c.id = articles.cat_id');
        return $this->db->get('articles')->row();
    }
    
     function get_subcategory($id)
    { 
        $this->db->where('deleted','0');
        $this->db->where('parent_id',$id);
        return $this->db->get('category')->result();
    }
    
     function get_cat_art()
    {
         $this->db->where('deleted','0');
          $this->db->where('parent_id !=','0');
          $this->db->where_in('id',array('28','29','30','31','32','33'));
          return $this->db->get('category')->result();
    }

     public function get_category() {
        $this->db->select('category.*');
        $this->db->from('category');   
        $this->db->where("parent_id",'0');
        $this->db->where("deleted",'0');
        $this->db->where("home_front",'yes');
        $this->db->order_by('sort_order', 'ASC');
        return $this->db->get()->result();
    }
}
