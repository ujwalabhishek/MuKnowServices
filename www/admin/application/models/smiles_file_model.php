<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of biipmi_file_model
 *
 * @author Ujwal
 */
class Smiles_file_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
        $this->tables = array();
        $this->tables['files'] = 'image_files';
    }

    function create_file($data, $owner_entity_id, $owner_entity_type) {
        
        $this->load->helper('array');

        $fields = $this->db->list_fields($this->tables['files']);

        $file_data = elements($fields, $data, NULL);

        foreach ($file_data as $key => $value) {
            if ($value === NULL)
                unset($file_data[$key]);
        }

        $file_data['created_on'] = now();
        $file_data['user_id'] = $owner_entity_id;
        $file_data['type'] = $owner_entity_type;
        $this->db->insert($this->tables['files'], $file_data);

        return $this->db->affected_rows() == 1 ? $this->db->insert_id() : FALSE;
    }

    function update_file($data, $owner_entity_id, $owner_entity_type, $image_id) {
        $this->load->helper('array');

        $fields = $this->db->list_fields($this->tables['files']);

        $file_data = elements($fields, $data, NULL);

        foreach ($file_data as $key => $value) {
            if ($value === NULL)
                unset($file_data[$key]);
        }

        $file_data['created_on'] = now();
        $file_data['user_id'] = $owner_entity_id;
        $file_data['type'] = $owner_entity_type;
        $this->db->where('id', $image_id);
        $this->db->update($this->tables['files'], $file_data);

       // return $this->db->affected_rows() == 1 ? $this->db->insert_id() : FALSE;
         return $image_id;
    }

    function get_file_by_id($file_id) {
        $this->db->where($this->tables['files'] . '.id', $file_id);

        $query = $this->db->get($this->tables['files']);

        return $query->row();
    }

    function get_file_by_name($file_name) {
        $file_parts = pathinfo($file_name);

        $raw_name = $file_parts['filename'];

        if (!$raw_name)
            return FALSE;

        $this->db->where($this->tables['files'] . '.raw_name', $raw_name);

        $file_ext = isset($file_parts['extension']) ? $file_parts['extension'] : "";

        if ($file_ext)
            $this->db->where($this->tables['files'] . '.file_ext', '.' . $file_ext);

        $query = $this->db->get($this->tables['files']);

        return $query->row();
    }

    function get_file_by_org_name($file_name) {
        $file_parts = pathinfo($file_name);

        $raw_name = $file_parts['filename'];

        if (!$raw_name)
            return FALSE;

        $this->db->where($this->tables['files'] . '.raw_name', $raw_name);
        //$this->db->select($this->tables['files'] . '.orig_name');

        $file_ext = isset($file_parts['extension']) ? $file_parts['extension'] : "";

        if ($file_ext)
            $this->db->where($this->tables['files'] . '.file_ext', '.' . $file_ext);

        $query = $this->db->get($this->tables['files']);
        log_message('debug', 'This is in file' . print_r($query->row(), true));
        return $query->row();
    }

    function delete_file_by_id($file_id) {
        $this->db->where($this->tables['files'] . '.id', $file_id);
        $this->db->delete($this->tables['files']);

        return $this->db->affected_rows() == 1;
    }

}

/* End of file biipmi_file_model.php */
/* Location: ./application/models/biipmi_file_model.php */