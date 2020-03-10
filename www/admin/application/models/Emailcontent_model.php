<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of biipmi_mail_model
 *
 * @author user
 */
class Emailcontent_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }     
    function get_email_content_by_key($key)
    {
        $this->db->where('key',$key);
        return $this->db->get('core_email_contents')->row();
    }
}
