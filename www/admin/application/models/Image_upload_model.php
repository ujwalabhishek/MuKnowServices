<?php

class Image_upload_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'image_files';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    } 
    
    function video_update($id,$type,$data)
    {
       $this->db->where('article_id',$id); 
       $this->db->where('video_type',$type);
       $this->db->update('image_files',$data);
       $updated_status = $this->db->affected_rows();
        if($updated_status):
            return $id;
        else:
            return false;
        endif;
            }
            
      function get_video_id($id,$type)
      {
          $this->db->where('article_id',$id); 
       $this->db->where('video_type',$type);
     return  $this->db->get('image_files')->row();
      }
public function update_pptpdf($table ,$values)
  {
     $this->db->where('user_id',$values['user_id']);
     $this->db->where('article_id',$values['article_id']);
        $this->db->update('image_files',$values);
        return TRUE;
    
  }
}
