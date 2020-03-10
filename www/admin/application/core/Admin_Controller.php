<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
                if(base_url() == admin_url){
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('Dedaabox_dev_authlogin', 'refresh');
		}
                }
                else
                  show_404();
                
	}
}