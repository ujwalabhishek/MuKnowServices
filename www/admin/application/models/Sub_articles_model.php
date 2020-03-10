<?php

class Sub_articles_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'sub_articles';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }

    //Megha code starts here
    function approved_articles($user_id) {
        $this->db->select('a.*,u.username,c.name as category_name');

        $this->db->from('articles a');

        $this->db->join(' users u', 'u.id = a.user_id');

        $this->db->join(' category c', 'c.id = a.cat_id');
        //$this->db->join(' sub_articles sb', 'sb.article_id = a.id', 'left');
        $this->db->where("a.active='1' AND a.deleted='0' AND a.user_id=$user_id");

        $this->db->order_by('a.created_on', 'DESC');

        return $this->db->get()->result();
    }

    function approved_admin_articles($user_id) {
        $this->db->select('a.*,u.username,c.name as category_name');

        $this->db->from('articles a');

        $this->db->join(' users u', 'u.id = a.user_id');

        $this->db->join(' category c', 'c.id = a.cat_id');

        $this->db->where("a.active='1' AND a.deleted='0'");

        $this->db->order_by('a.created_on', 'DESC');

        return $this->db->get()->result();
    }

    //Megha code ends here
}
