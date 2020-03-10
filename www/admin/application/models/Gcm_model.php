<?php

class Gcm_model extends MY_Model
{
    public function __construct()
    {
         parent::__construct();
         $this->load->database();
        $this -> table = 'gcm_users';
		$this -> result_mode = 'object';
		$this -> primary_key = 'id';
       

    }
      function insert_pushnotification($gcm_regid,$title,$message)
    {
       // print_r($gcmresult);exit();
           $data = array(
            'gcm_regid' => $gcm_regid,
            'title' => $title,
            'message' => $message,
            'badge' =>'1'
          
           
        );

        $this->db->insert('send_pushnotification', $data);
        $insert_id = $this->db->insert_id();
        if(!empty($insert_id))
        {
             return $insert_id;
        }
        return null;
        
    }
    function get_pushnotification($id)
    {
        $sql="select * from send_pushnotification where id='$id'";
        $query = $this->db->query($sql);
          if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }
      function get_budgecount($gcm_regid)
    {
        $sql="select SUM(badge) as badgecount from send_pushnotification where gcm_regid='$gcm_regid'";
        $query = $this->db->query($sql);
          if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }
    function update_budge($gcm_regid)
    {
       $data = array(
           'badge'=>'0'
            
        );
        //print_r($data);

        $this->db->where('gcm_regid', $gcm_regid);
        $this->db->update('send_pushnotification', $data);
        $this->db->trans_complete();
    //echo $this->db->last_query();exit();
        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }
     function getall_registergcmid($type)
    {
        $sql="select  * from gcm_users where user_id!='0' and type='$type'";
        $query = $this->db->query($sql);
          if ($query->num_rows() > 0) {
           $row = $query->result();
         return $row;
        } else {
            return null;
        }
    }
}