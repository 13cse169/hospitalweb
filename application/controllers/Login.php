<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 	* Login Class
	*/
	class Login extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
		}

		public function index(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$user_name = $this->input->post('user_name');
				$password  = $this->input->post('password');

				$this->session->set_flashdata('user_name', $user_name);
				$this->session->set_flashdata('password', $password);
				// $this->session->set_flashdata('error', 'Error');

				$this->form_validation->set_rules('user_name', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[10]');

				if ($this->form_validation->run() == TRUE) {

					$Data = $this->M_Hospital->GetWhere('users', array('email' => $user_name, 'pwd' => $password));

					if ($Data) {
						if ($Data->pwd == $password) {

							$logged_in = ['userID' => $Data->id, 'name' => $Data->name, 'email' => $Data->email, 'phone' => $Data->phone, 'logged_in' => True];
							$this->session->set_userdata($logged_in); redirect('dashboard','refresh');

						}else{ $this->session->set_flashdata('error', 'Check'); redirect('login','refresh'); }

					} else{ $this->session->set_flashdata('error', 'Check'); redirect('login','refresh'); }
					
				} else { redirect('login','refresh'); }

			}else{ 
				if ($this->session->userdata('logged_in')) { redirect('dashboard','refresh'); }
		        else{ $this->load->view('web-hospital/pages/login'); }
			}
		}

		public function logout(){
			$this->session->unset_userdata(array('name', 'email', 'logged_in'));
			redirect('dashboard','refresh');	
		}
	}
?>