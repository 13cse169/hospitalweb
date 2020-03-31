<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
		* MY_Controller
	*/
	class MY_Controller extends CI_Controller {

		protected $Data = array();
	    
	    public function __construct() {
	        parent::__construct();

	        if (!$this->session->userdata('logged_in')) {
	        	redirect('login','refresh');
	        }
	    }

	}
?>