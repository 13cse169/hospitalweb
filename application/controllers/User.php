<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 	* Hospital User
	*/
	class User extends MY_Controller {
		
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
				//echo'<pre>';print_r($_POST);exit();
				if (isset($_POST['id'])) $this->M_Hospital->UpdateData('users', $_POST);
				else {
					$_POST['pwd'] = substr(str_shuffle("1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz"), 0, 7);
					$id = $this->M_Hospital->InsertData('users', $_POST);
				}
				redirect('user', 'refresh');
			}else{
				$Data = [
					'active' => 'Master',
		    	    'load'   => 'web-hospital/users/user-list',
		    	    //'script' => 'web-hospital/user/treatment-js',
		    	    'Users'   => $this->M_Hospital->GetTable('users', 'name', 'ASC')
		    	];
		    	if ($this->uri->segment(3)) {
		    		$Data['UpdateData'] = $this->M_Hospital->GetWhere('users', array('id' => $this->uri->segment(3)));
		    	}
		    	$this->load->view('web-hospital/layout/layout', $Data);
		    }
		}

		public function setting() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') { extract($_POST);
				
				$Data = $this->M_Hospital->GetWhere('users', array('id' => $_SESSION['userID']));

				if( ($Data->pwd == $old) && ($new == $renew) ){
					$this->M_Hospital->UpdateData('users', array('id' => $_SESSION['userID'], 'pKey' => 'id', 'pwd' => $new));
					$this->session->set_flashdata('added', 'Check'); 
					redirect('user/setting','refresh');
				} else {
					$this->session->set_flashdata('old', $old);
					$this->session->set_flashdata('new', $new);
					$this->session->set_flashdata('renew', $renew);
					
					$this->session->set_flashdata('credentials', 'Check'); 
					redirect('user/setting','refresh');
				}
			}else{
				$Data = [
					'active' => 'Master',
		    	    'load'   => 'web-hospital/users/setting',
		    	    //'script' => 'web-hospital/user/treatment-js',
		    	];
		    	
		    	$this->load->view('web-hospital/layout/layout', $Data);
		    }
		}
	}
?>
