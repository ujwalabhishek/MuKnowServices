<?php

class Register_user_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->load->database();
        $this -> table = 'users';
		$this -> result_mode = 'object';
		$this -> primary_key = 'id';
       
    }

  public function get_all_adminuser($id)
    {
       $sql="SELECT u.*,g.group_id FROM `users` u JOIN users_groups g ON u.id=g.user_id 
            
              where g.group_id='2' AND u.user_type='$id' order by u.id DESC";
       $query = $this->db->query($sql);
       if($query->num_rows() > 0)
       {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
        
    }
     public function get_adminuser($email)
    {
       $sql="SELECT u.*,g.group_id FROM `users` u JOIN users_groups g ON u.id=g.user_id 
              where g.group_id='2' AND u.email='$email' order by u.id DESC";
       $query = $this->db->query($sql);
       if($query->num_rows() > 0)
       {
            $row = $query->row();
            return $row;
        } else {
            return null;
        }
        
    }
    function activate_adminuser($id,$status)
    {
        $sql="UPDATE users SET active='$status' where id='$id'";
        $query = $this->db->query($sql);
       return TRUE;
    }
    
    function get_facilitator()
    {
        $this->db->where('user_type','facilitator');
        $this->db->where('active','1');
        //$this->db->where('status','1');
        return $this->db->get('users')->result();
    }
    function get_count_user($type) {
        $this->db->select('users.*');
        $this->db->where('user_type',$type);
        $query = $this->db->get('users');
        
       if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
    }
    
    function get_coupon($userid)
    {
        $this->db->where('user_id',$userid);
        $this->db->join('coupon','coupon.id=users_subscription.coupon_id','left');
        $this->db->order_by('users_subscription.id','DESC');
        return $this->db->get('users_subscription')->row();
    }
    
    function get_coupon_result($userid)
    {
        $this->db->where('user_id',$userid);
        $this->db->join('coupon','coupon.id=users_subscription.coupon_id','left');
        $this->db->where('users_subscription.coupon_id !=',''); 
        $this->db->order_by('users_subscription.id','DESC');
        return $this->db->get('users_subscription')->result();
    }
    
    
    function get_subscription_result($userid)
    {   
        $this->db->select('subscription.name,users_subscription.*');
        $this->db->where('user_id',$userid);
        $this->db->join('subscription','subscription.id=users_subscription.subscription_id','left');
       $this->db->where('users_subscription.subscription_id !=',''); 
        $this->db->order_by('users_subscription.id','DESC');
        return $this->db->get('users_subscription')->result();
    }
    function get_scratchcard_result($userid)
    {    
        $this->db->select('scratchcard.name,users_subscription.*');
        $this->db->where('user_id',$userid);
        $this->db->join('scratchcard','scratchcard.id=users_subscription.scratchcard_id','left');
       $this->db->where('users_subscription.scratchcard_id !=',''); 
        $this->db->order_by('users_subscription.id','DESC');
        return $this->db->get('users_subscription')->result();
    }
    
    function get_user_certificate($userid)
    {
        $this->db->select('certificate_user.*,assessment.title as assessment');
       $this->db->where('user_id',$userid); 
       $this->db->where('result','pass');
       $this->db->where('redemed','yes');
       $this->db->join('assessment','assessment.id=certificate_user.assesment_id','left');
       return $this->db->get('certificate_user')->result();
    }
    
      function get_user_certificate_row($userid)
    {
        $this->db->select('certificate_user.*,assessment.title as assessment');
       $this->db->where('user_id',$userid); 
       $this->db->where('result','pass');
       $this->db->where('redemed','yes');
       $this->db->order_by('id','DESC');
       $this->db->join('assessment','assessment.id=certificate_user.assesment_id','left');
       return $this->db->get('certificate_user')->row();
    }
    
    function get_fbuser($fbid)
    {
     $this->db->where('fb_id',$fbid);   
     return $this->db->get('users')->row();
    }
    
    function update_fbuser($fbid,$data)
    {
         $this->db->where('fb_id',$fbid); 
         $this->db->update('users',$data);
         return true;
    }
      function save_fbuser($data)
    { 
         $this->db->insert('users',$data);
         return $this->db->insert_id();
    }
    
     function get_fbuser_all($fbid)
    {
     $this->db->where('user_type',$fbid);   
     $this->db->order_by('created_on', 'DESC');
     return $this->db->get('users')->result();
    }
    
    function update_fbimage($userid,$data)
    {
      $this->db->where('user_id',$userid);
      $this->db->update('image_files',$data);
      return true;
    }
	 function get_payment_telenor($user_id)
    {
		$this->db->where('user_id',$user_id);   
        return $this->db->get('payment_telenor')->row();
	}
	function check_payment_telenor($user_id , $phone)
    {
		$this->db->where('user_id',$user_id);  
		$this->db->where('msisdn',$phone); 
		$this->db->select('MAX(id) as id');		
        return $this->db->get('payment_telenor')->row();
	}
}