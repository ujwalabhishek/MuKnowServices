<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Smiles_file
 *
 * @author Ujwal
 */
require APPPATH . '/models/smiles_file_model.php';
class Smiles_file {

    /**
     * CodeIgniter global
     *
     * @var string
     */
    protected $ci;
    protected $default_max_size = '2048'; // 2MB
    protected $default_max_width = '0'; // no limit
    protected $default_max_height = '0'; // no limit
    protected $default_file_types = 'gif|jpg|png|pdf|psd|ai|eps|ps|xls|ppt|zip|tif'; // default

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->config('upload', TRUE);
        $this->ci->load->model('smiles_file_model');
        $this->ci->load->library('upload');
    }

    /**
     * __call
     *
     * Acts as a simple way to call model methods without loads of stupid alias'
     */
    public function __call($method, $arguments) {
        if (!method_exists($this->ci->smiles_file_model, $method)) {
            throw new Exception('Undefined method biipmi_attachment::' . $method . '() called');
        }

        return call_user_func_array(array($this->ci->smiles_file_model, $method), $arguments);
    }

    /**
     * Process image upload. Returns image filename if successful, else returns FALSE.
     * 
     * @access  public
     * @param   string      $field_name (file upload path of field in form)
     * @param   int         $owner_entity_id owner entity id
     * @param   reference   $return_message (for error messages or uploaded file data)
     * @param   array       $upload_config array of file upload configuration
     * @param   array       $resize_dim array of width and height
     * @param   array       $thumb_dim array of width and height for thumbnail
     * @return  mixed
     */
    public function upload($field_name, $owner_entity_id, &$return_message = NULL, $upload_config = NULL, $resize_dim = NULL, $thumb_dim = NULL) {
        $my_config = array();
        $my_config['upload_path'] = $this->ci->config->item('upload_path', 'upload');
        $my_config['encrypt_name'] = $this->ci->config->item('encrypt_name', 'upload');
        $my_config['remove_spaces'] = $this->ci->config->item('remove_spaces', 'upload');
        $my_config['max_size'] = $this->default_max_size;
        $my_config['max_width'] = $this->default_max_width;
        $my_config['max_height'] = $this->default_max_height;
        $my_config['allowed_types'] = $this->default_file_types;

        if ($upload_config && is_array($upload_config)) {
            if (isset($upload_config['max_size']))
                $my_config['max_size'] = $upload_config['max_size'];
            if (isset($upload_config['max_width']))
                $my_config['max_width'] = $upload_config['max_width'];
            if (isset($upload_config['max_height']))
                $my_config['max_height'] = $upload_config['max_height'];
            if (isset($upload_config['allowed_types']))
                $my_config['allowed_types'] = $upload_config['allowed_types'];
        }

        $this->ci->upload->initialize($my_config);

        if ($this->ci->upload->do_upload($field_name, true)) {
            $file_data = $this->ci->upload->data();
            $original_path = NULL;
            $thumb_path = NULL;
            if ($file_data['is_image']) {
                $original_path = $file_data['file_path'] . $file_data['raw_name'] . "_o" . $file_data['file_ext'];

                $this->ci->load->library('image_lib');

                $img_proc_config = array(
                    "image_library" => "GD2",
                    "maintain_ratio" => FALSE
                );

                $img_proc_errors = array();
                // create thumbnail if requested
                if ($thumb_dim && is_array($thumb_dim)) {
                    $this->ci->image_lib->clear();
                    $thumb_path = $file_data['file_path'] . $file_data['raw_name'] . "_thumb" . $file_data['file_ext'];
                    $img_proc_config['source_image'] = $file_data['full_path'];
                    $img_proc_config['new_image'] = $thumb_path;
                    if (isset($thumb_dim['width']))
                        $img_proc_config['width'] = $thumb_dim['width'];
                    if (isset($thumb_dim['height']))
                        $img_proc_config['height'] = $thumb_dim['height'];
                    $this->ci->image_lib->initialize($img_proc_config);
                    if (!$this->ci->image_lib->resize())
                        $img_proc_errors = array_merge($img_proc_errors, array($this->ci->image_lib->display_errors('', '')));
                }

                // copy original
                $copy_result = copy($file_data['full_path'], $original_path);

                if ($resize_dim && is_array($resize_dim) && $copy_result) {
                    // process image
                    $this->ci->image_lib->clear();
                    $img_proc_config['source_image'] = $original_path;
                    $img_proc_config['new_image'] = $file_data['full_path'];
                    if (isset($resize_dim['width']))
                        $img_proc_config['width'] = $resize_dim['width'];
                    if (isset($resize_dim['height']))
                        $img_proc_config['height'] = $resize_dim['height'];
                    $this->ci->image_lib->initialize($img_proc_config);
                    $this->ci->image_lib->resize();
                    if (!$this->ci->image_lib->resize())
                        $img_proc_errors = array_merge($img_proc_errors, array($this->ci->image_lib->display_errors('', '')));
                }
                if ($return_message !== NULL)
                    $return_message = $img_proc_errors;
            }
            $db_result = $this->ci->smiles_file_model->create_file($file_data, $owner_entity_id);
            if ($db_result)
                return $db_result;

            // delete files if failed
            if (file_exists($file_data['full_path']))
                unlink($file_data['full_path']);

            if ($original_path && file_exists($original_path))
                unlink($original_path);

            if ($thumb_path && file_exists($thumb_path))
                unlink($thumb_path);

            return FALSE;
        } else {
            if ($return_message !== NULL)
                $return_message = $this->ci->upload->display_errors('', '');
            return FALSE;
        }
    }

    /**
     * Process image crop. Returns image filename if successful, else returns FALSE.
     * 
     * @access  public
     * @param   array      $file_data (file upload data)
     * @param   int         $owner_entity_id owner entity id
     * @param   reference   $return_message (for error messages or uploaded file data)
     * @param   array       $upload_config array of file upload configuration
     * @param   array       $resize_dim array of width and height and crop parameters
     * @param   array       $thumb_dim array of width and height for thumbnail
     * @return  mixed
     */
    public function uploadandcrop($file_data, $owner_entity_id, $owner_entity_type ,&$return_message = NULL, $upload_config = NULL, $resize_dim = NULL, $thumb_dim = NULL) {
        
        $my_config = array();
        $my_config['upload_path'] = $this->ci->config->item('upload_path', 'upload');
        $my_config['encrypt_name'] = $this->ci->config->item('encrypt_name', 'upload');
        $my_config['remove_spaces'] = $this->ci->config->item('remove_spaces', 'upload');
        $my_config['max_size'] = $this->default_max_size;
        $my_config['max_width'] = $this->default_max_width;
        $my_config['max_height'] = $this->default_max_height;
        $my_config['allowed_types'] = $this->default_file_types;

        if ($upload_config && is_array($upload_config)) {
            if (isset($upload_config['max_size']))
                $my_config['max_size'] = $upload_config['max_size'];
            if (isset($upload_config['max_width']))
                $my_config['max_width'] = $upload_config['max_width'];
            if (isset($upload_config['max_height']))
                $my_config['max_height'] = $upload_config['max_height'];
            if (isset($upload_config['allowed_types']))
                $my_config['allowed_types'] = $upload_config['allowed_types'];
            if (isset($upload_config['upload_path']))
                $my_config['upload_path'] = $upload_config['upload_path'];
        }

        $this->ci->upload->initialize($my_config);
 
        if (!empty($file_data)) {
            $original_path = NULL;
            $thumb_path = NULL;
           if ($file_data['is_image']) {
                $original_path = $file_data['file_path'] . $file_data['raw_name'] . "_orig" . $file_data['file_ext'];

                $this->ci->load->library('image_lib');

                $img_proc_config = array(
                    "image_library" => "GD2",
                    "maintain_ratio" => FALSE
                );

                $img_proc_errors = array();

                // copy original
                $copy_result = copy($file_data['full_path'], $original_path);

                if ($resize_dim && is_array($resize_dim) && $copy_result) {
                    // process image
                   
                    $this->ci->image_lib->clear();
                    $resize_path = $file_data['file_path'] . $file_data['raw_name'] . "_oig" . $file_data['file_ext'];
                    $img_proc_config['source_image'] = $file_data['full_path'];                 
                    $img_proc_config['new_image'] = $file_data['full_path'];
                    
                    if (isset($resize_dim['w']))
                        $img_proc_config['width'] = $resize_dim['w'];
                    if (isset($resize_dim['h']))
                        $img_proc_config['height'] = $resize_dim['h'];
                    if (isset($resize_dim['x']))
                        $img_proc_config['x_axis'] = $resize_dim['x'];
                    if (isset($resize_dim['y']))
                        $img_proc_config['y_axis'] = $resize_dim['y'];
                    //print_r($img_proc_config);exit;
                    
                    $this->ci->image_lib->initialize($img_proc_config);
                    $this->ci->image_lib->crop();
                    if (!$this->ci->image_lib->crop())
                        $img_proc_errors = array_merge($img_proc_errors, array($this->ci->image_lib->display_errors('', '')));
                }
                if ($return_message !== NULL)
                    $return_message = $img_proc_errors;
                
                // create rename cropped image
                
                    $this->ci->image_lib->clear();
                    $resize_path = $file_data['file_path'] . $file_data['raw_name'] . "_o" . $file_data['file_ext'];
                    $img_proc_config['source_image'] = $file_data['full_path'];
                    $img_proc_config['maintain_ratio'] = TRUE;
                    $img_proc_config['new_image'] = $resize_path;
                    
                    $this->ci->image_lib->initialize($img_proc_config);
                    if (!$this->ci->image_lib->resize())
                        $img_proc_errors = array_merge($img_proc_errors, array($this->ci->image_lib->display_errors('', '')));
                
                // create thumbnail if requested
                if ($thumb_dim && is_array($thumb_dim)) {
                    $this->ci->image_lib->clear();
                    $thumb_path = $file_data['file_path'] . $file_data['raw_name'] . "_thumb" . $file_data['file_ext'];
                    $img_proc_config['source_image'] = $file_data['full_path'];
                    $img_proc_config['maintain_ratio'] = TRUE;
                    $img_proc_config['new_image'] = $thumb_path;
                    if (isset($thumb_dim['width']))
                        $img_proc_config['width'] = $thumb_dim['width'];
                    if (isset($thumb_dim['height']))
                        $img_proc_config['height'] = $thumb_dim['height'];
                    $this->ci->image_lib->initialize($img_proc_config);
                    if (!$this->ci->image_lib->resize())
                        $img_proc_errors = array_merge($img_proc_errors, array($this->ci->image_lib->display_errors('', '')));
                }
            }
            
            $db_result = $this->ci->smiles_file_model->create_file($file_data, $owner_entity_id, $owner_entity_type);
              //echo '<pre>'; print_r($db_result); exit; 
            if ($db_result)
                return $db_result;

            // delete files if failed
            if (file_exists($file_data['full_path']))
                unlink($file_data['full_path']);

            if ($original_path && file_exists($original_path))
                unlink($original_path);

            if ($thumb_path && file_exists($thumb_path))
                unlink($thumb_path);

            return FALSE;
        } else {
            if ($return_message !== NULL)
                $return_message = $this->ci->upload->display_errors('', '');
            return FALSE;
        }
    }
     public function update_uploadandcrop($file_data, $owner_entity_id, $owner_entity_type ,$image_id,&$return_message = NULL, $upload_config = NULL, $resize_dim = NULL, $thumb_dim = NULL) {
 //print_r($resize_dim);echo "hello";exit();
        $my_config = array();
        $my_config['upload_path'] = $this->ci->config->item('upload_path', 'upload');
        $my_config['encrypt_name'] = $this->ci->config->item('encrypt_name', 'upload');
        $my_config['remove_spaces'] = $this->ci->config->item('remove_spaces', 'upload');
        $my_config['max_size'] = $this->default_max_size;
        $my_config['max_width'] = $this->default_max_width;
        $my_config['max_height'] = $this->default_max_height;
        $my_config['allowed_types'] = $this->default_file_types;

        if ($upload_config && is_array($upload_config)) {
            if (isset($upload_config['max_size']))
                $my_config['max_size'] = $upload_config['max_size'];
            if (isset($upload_config['max_width']))
                $my_config['max_width'] = $upload_config['max_width'];
            if (isset($upload_config['max_height']))
                $my_config['max_height'] = $upload_config['max_height'];
            if (isset($upload_config['allowed_types']))
                $my_config['allowed_types'] = $upload_config['allowed_types'];
            if (isset($upload_config['upload_path']))
                $my_config['upload_path'] = $upload_config['upload_path'];
        }

        $this->ci->upload->initialize($my_config);

        if (!empty($file_data)) {
            $original_path = NULL;
            $thumb_path = NULL;
            if ($file_data['is_image']) {
                $original_path = $file_data['file_path'] . $file_data['raw_name'] . "_orig" . $file_data['file_ext'];

                $this->ci->load->library('image_lib');

                $img_proc_config = array(
                    "image_library" => "GD2",
                    "maintain_ratio" => FALSE
                );

                $img_proc_errors = array();

                // copy original
                $copy_result = copy($file_data['full_path'], $original_path);

                if ($resize_dim && is_array($resize_dim) && $copy_result) {
                    // process image
                 
                    $this->ci->image_lib->clear();
                    $resize_path = $file_data['file_path'] . $file_data['raw_name'] . "_oig" . $file_data['file_ext'];
                    $img_proc_config['source_image'] = $file_data['full_path'];                 
                    $img_proc_config['new_image'] = $file_data['full_path'];
                    
                    if (isset($resize_dim['w']))
                        $img_proc_config['width'] = $resize_dim['w'];
                    if (isset($resize_dim['h']))
                        $img_proc_config['height'] = $resize_dim['h'];
                    if (isset($resize_dim['x']))
                        $img_proc_config['x_axis'] = $resize_dim['x'];
                    if (isset($resize_dim['y']))
                        $img_proc_config['y_axis'] = $resize_dim['y'];
                    //print_r($img_proc_config);exit;
                    
                    $this->ci->image_lib->initialize($img_proc_config);
                    $this->ci->image_lib->crop();
                    if (!$this->ci->image_lib->crop())
                        $img_proc_errors = array_merge($img_proc_errors, array($this->ci->image_lib->display_errors('', '')));
                }
                if ($return_message !== NULL)
                    $return_message = $img_proc_errors;
                
                // create rename cropped image
                
                    $this->ci->image_lib->clear();
                    $resize_path = $file_data['file_path'] . $file_data['raw_name'] . "_o" . $file_data['file_ext'];
                    $img_proc_config['source_image'] = $file_data['full_path'];
                    $img_proc_config['maintain_ratio'] = TRUE;
                    $img_proc_config['new_image'] = $resize_path;
                    
                    $this->ci->image_lib->initialize($img_proc_config);
                    if (!$this->ci->image_lib->resize())
                        $img_proc_errors = array_merge($img_proc_errors, array($this->ci->image_lib->display_errors('', '')));
                
                // create thumbnail if requested
                if ($thumb_dim && is_array($thumb_dim)) {
                      //print_r($thumb_dim);exit();
                    $this->ci->image_lib->clear();
                    $thumb_path = $file_data['file_path'] . $file_data['raw_name'] . "_thumb" . $file_data['file_ext'];
                    $img_proc_config['source_image'] = $file_data['full_path'];
                    $img_proc_config['maintain_ratio'] = TRUE;
                    $img_proc_config['new_image'] = $thumb_path;
                    if (isset($thumb_dim['width']))
                        $img_proc_config['width'] = $thumb_dim['width'];
                    if (isset($thumb_dim['height']))
                        $img_proc_config['height'] = $thumb_dim['height'];
                    $this->ci->image_lib->initialize($img_proc_config);
                    if (!$this->ci->image_lib->resize())
                        $img_proc_errors = array_merge($img_proc_errors, array($this->ci->image_lib->display_errors('', '')));
                }
               // print_r($img_proc_errors);exit();
            }
            $db_result = $this->ci->smiles_file_model->update_file($file_data, $owner_entity_id, $owner_entity_type,$image_id);
           
            if ($db_result)
                return $db_result;

            // delete files if failed
//            if (file_exists($file_data['full_path']))
//                unlink($file_data['full_path']);
//
//            if ($original_path && file_exists($original_path))
//                unlink($original_path);
//
//            if ($thumb_path && file_exists($thumb_path))
//                unlink($thumb_path);

            return FALSE;
        } else {
            if ($return_message !== NULL)
                $return_message = $this->ci->upload->display_errors('', '');
            return FALSE;
        }
    }
    /**
     * Process image crop. Returns image filename if successful, else returns FALSE.
     * 
     * @access  public
     * @param   array      $file_data (file upload data)
     * @param   int         $owner_entity_id owner entity id
     * @param   reference   $return_message (for error messages or uploaded file data)
     * @param   array       $upload_config array of file upload configuration
     * @param   array       $resize_dim array of width and height and crop parameters
     * @param   array       $thumb_dim array of width and height for thumbnail
     * @return  mixed
     */
    public function uploadforcrop($field_name, &$return_message = NULL, $upload_config = NULL, $resize_dim = NULL) {

        $my_config = array();
        $my_config['upload_path'] = $this->ci->config->item('upload_path', 'upload');
        $my_config['encrypt_name'] = $this->ci->config->item('encrypt_name', 'upload');
        $my_config['remove_spaces'] = $this->ci->config->item('remove_spaces', 'upload');
        $my_config['max_size'] = $this->default_max_size;
        $my_config['max_width'] = $this->default_max_width;
        $my_config['max_height'] = $this->default_max_height;
        $my_config['allowed_types'] = $this->default_file_types;

        if ($upload_config && is_array($upload_config)) {
            if (isset($upload_config['max_size']))
                $my_config['max_size'] = $upload_config['max_size'];
            if (isset($upload_config['max_width']))
                $my_config['max_width'] = $upload_config['max_width'];
            if (isset($upload_config['max_height']))
                $my_config['max_height'] = $upload_config['max_height'];
            if (isset($upload_config['allowed_types']))
                $my_config['allowed_types'] = $upload_config['allowed_types'];
            if (isset($upload_config['upload_path']))
                $my_config['upload_path'] = $upload_config['upload_path'];
        }

        $this->ci->upload->initialize($my_config);

        if ($this->ci->upload->do_upload($field_name, TRUE)) {
            $file_data = $this->ci->upload->data();

            $original_path = NULL;
            if ($file_data['is_image']) {
                $original_path = $file_data['file_path'] . $file_data['raw_name'] . "_org" . $file_data['file_ext'];

                $this->ci->load->library('image_lib');
                $img_proc_config = array(
                    "image_library" => "GD2",
                    "maintain_ratio" => TRUE
                );

                $img_proc_errors = array();


                // copy original
                $copy_result = copy($file_data['full_path'], $original_path);
                if ($file_data['image_width'] > $resize_dim['width']) {
                    if ($resize_dim && is_array($resize_dim) && $copy_result) {
                        // process image
                        $this->ci->image_lib->clear();
                        $img_proc_config['source_image'] = $original_path;
                        $img_proc_config['new_image'] = $file_data['full_path'];
                        if (isset($resize_dim['width']))
                            $img_proc_config['width'] = $resize_dim['width'];
                        if (isset($resize_dim['height']))
                            $img_proc_config['height'] = $resize_dim['height'];
                        $this->ci->image_lib->initialize($img_proc_config);
                        $this->ci->image_lib->resize();
                        if (!$this->ci->image_lib->resize())
                            $img_proc_errors = array_merge($img_proc_errors, array($this->ci->image_lib->display_errors('', '')));
                    }
                  
                    //print_r($file_data);exit();
                }
                if ($return_message !== NULL)
                    $return_message = $img_proc_errors;
            }else {
                if ($return_message !== NULL)
                    $return_message = array('Please upload a valid image file.');
            }
            if ($original_path && file_exists($original_path))
                unlink($original_path);
            if (!empty($file_data))
                return $file_data;


            // delete files if failed
            if (file_exists($file_data['full_path']))
                unlink($file_data['full_path']);

            return FALSE;
        } else {
            if ($return_message !== NULL)
                $return_message = $this->ci->upload->display_errors('', '');
            return FALSE;
        }
    }

    function delete_uploaded_file($filedata) {
        if (file_exists($filedata['full_path'])){
            if(unlink($filedata['full_path'])){
               $return_message ='The uploaded file has been removed successfully from the server.'; 
            }
        }
       else{
           $return_message = 'This file no longer exists.';
           
       }
       return $return_message;
    }

    function delete_file($file_id) {
        $file = $this->ci->smiles_file_model->get_file_by_id($file_id);

        if (!$file)
            return FALSE;

        $file_path = $file->file_path . $file->raw_name . $file->file_ext;
        $orig_file_path = $file->file_path . $file->raw_name . "_o" . $file->file_ext;
        $thumb_file_path = $file->file_path . $file->raw_name . "_thumb" . $file->file_ext;

        $db_result = $this->ci->smiles_file_model->delete_file_by_id($file_id);
        if (!$db_result)
            return FALSE;

        // delete files
        if (file_exists($file_path))
            unlink($file_path);

        if (file_exists($orig_file_path))
            unlink($orig_file_path);

        if (file_exists($thumb_file_path))
            unlink($thumb_file_path);

        return $db_result;
    }

    function get_file($file_id) {
        return $this->ci->smiles_file_model->get_file_by_id($file_id);
    }

    function get_original_file_name($file_id) {
        $file = $this->get_file($file_id);
        if (!$file)
            return FALSE;
        return $file->raw_name . "_o" . $file->file_ext;
    }

    function get_file_name($file_id) {
        $file = $this->get_file($file_id);
        if (!$file)
            return FALSE;
        return $file->raw_name . $file->file_ext;
    }

    function get_thumbnail_file_name($file_id) {
        $file = $this->get_file($file_id);
        if (!$file)
            return FALSE;
        return $file->raw_name . "_thumb" . $file->file_ext;
    }

}

?>
