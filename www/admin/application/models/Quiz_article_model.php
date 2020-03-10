<?php

class Quiz_article_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'article_quiz';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }
	
	function get_answer($answer_key, $id) {
        $sql = "SELECT $answer_key FROM article_quiz where id = $id;";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

}

?>