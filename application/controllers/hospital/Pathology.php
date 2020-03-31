<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 	* Pathology
	*/
	class Pathology extends MY_Controller {
		
		public function __construct() {
			parent::__construct();
		}

		/*
			*Pathology Master
		*/

		public function master_dept_test(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$this->M_Hospital->InsertData('h_ptl_dept', $_POST);

				redirect('pathology/master/department-test','refresh');

			}else{

				$Data = [
					'active' => 'Pathology',
		    	    'load'   => 'web-hospital/pathology/master/dept_test',
		    	    'Dept'   => $this->M_Hospital->GetTable('h_ptl_dept', 'dept_id', 'DESC')
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function master_test_head(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$this->M_Hospital->InsertData('h_ptl_thead', $_POST);

				redirect('pathology/master/test-head','refresh');

			}else{

				$Data = [
					'active' => 'Pathology',
		    	    'load'   => 'web-hospital/pathology/master/test_head',
		    	    'Dept'   => $this->M_Hospital->GetTable('h_ptl_dept', 'name', 'ASC'),
		    	    'Head'   => $this->M_Hospital->GetTable('h_ptl_thead', 'head_id', 'DESC')
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function master_add_test(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				echo "<pre>";print_r($_POST);exit();

			}else{
				
				$Data = [
					'active' => 'Pathology',
		    	    'load'   => 'web-hospital/pathology/master/add_test'
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function master_doctor_comission(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$this->M_Hospital->InsertData('h_ptl_docomm', $_POST);

				redirect('pathology/master/doctor-comission','refresh');

			}else{
				
				$Data = [
					'active' => 'Pathology',
		    	    'load'   => 'web-hospital/pathology/master/doctor_comission',
		    	    'Dept'   => $this->M_Hospital->GetTable('h_ptl_dept', 'name', 'ASC'),
		    	    'Doctor' => $this->M_Hospital->GetTable('h_doctor', 'name', 'ASC'),
		    	    'Comm'   => $this->M_Hospital->GetTable('h_ptl_docomm', 'docomm_id', 'DESC')
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function master_agent_collection_list(){
			$Data = [
				'active' => 'Pathology',
	    	    'load'   => 'web-hospital/pathology/master/agent_collection_list',
	    	    'Coll'   => $this->M_Hospital->GetTable('h_ptl_agentcoll', 'agentcoll_id', 'DESC')
	    	];
	    	$this->load->view('web-hospital/layout/layout', $Data);
		}

		public function master_agent_collection(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$_POST['dob'] = date('Y-m-d', strtotime($_POST['dob']));

				if ($_FILES['photo']['name'] != '') {
					
					$config['upload_path']   = './assets/img/agent/';
					$config['allowed_types'] = '*';
					$config['max_size']      = '*';
					$config['max_width']     = '*';
					$config['max_height']    = '*';
					
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('photo')){
						$error = array('error' => $this->upload->display_errors());
					}
					else{
						$data = array('upload_data' => $this->upload->data());
						$_POST['photo'] = $_FILES['photo']['name'];
					}
				}

				$this->M_Hospital->InsertData('h_ptl_agentcoll', $_POST);

				redirect('pathology/master/agent-collection-list','refresh');

			}else{
				
				$Data = [
					'active' => 'Pathology',
		    	    'load'   => 'web-hospital/pathology/master/agent_collection',
		    	    'Dept'   => $this->M_Hospital->GetTable('h_ptl_dept', 'name', 'ASC')
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function master_agent_comission(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				echo "<pre>";print_r($_POST);exit();

			}else{
				
				$Data = [
					'active' => 'Pathology',
		    	    'load'   => 'web-hospital/pathology/master/agent_comission'
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		/*
			*Pathology Entry
		*/

		public function booking_entry(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				echo "<pre>";print_r($_POST);exit();

			}else{

				if ($this->uri->segment(4) == 'add') {

					$Data = [
						'active'  => 'Pathology',
			    	    'load'    => 'web-hospital/pathology/entry/booking-entry',
			    	    'Patient' => $this->M_Hospital->GetTable('h_patient', 'name', 'ASC'),
			    	    'Dept'    => $this->M_Hospital->GetTable('h_dept', 'dept_id', 'DESC'),
			    	];
					
				}else{

					$Data = [
						'active' => 'Pathology',
			    	    'load'   => 'web-hospital/pathology/entry/booking-entry-list'
			    	];

				}
				
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

	}
?>