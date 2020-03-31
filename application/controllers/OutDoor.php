<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 	* Hospital OutDoor
	*/
	class OutDoor extends MY_Controller {
		
		public function __construct() {
			parent::__construct();
		}

		public function index() {

			if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
				
				$_POST['category']   = implode(',', $_POST['category']);
				$_POST['particular'] = implode(',', $_POST['particular']);
				$_POST['amount']     = implode(',', $_POST['amount']);
				$_POST['app_date']   = date('Y-m-d', strtotime($_POST['app_date']));

				extract($_POST);

				if ($_POST['referredby'] == 'Name') $_POST['referredby'] = $_POST['ReferredByName'];
				unset($_POST['ReferredByName']);

				$SQL  = "SELECT * FROM outdoor_treat WHERE particular = '$particular' AND app_date = '$app_date'";
				$Data = $this->M_Hospital->RunQuery($SQL);

				if (count($Data)) $_POST['app_que'] = sprintf("%03d", (count($Data) + 1));
				else $_POST['app_que'] = sprintf("%03d", 1);

				$id = $this->M_Hospital->InsertData('outdoor_treat', $_POST);

				redirect('outdoor/ticket/'.$id,'refresh');

			}else{
				$Data = [
					'active' => 'Patient',
		    	    'load'   => 'web-hospital/outdoor/treatment',
		    	    'Category'   => $this->M_Hospital->GetTable('outdoor_facility_group', 'group_name', 'ASC'),
		    	    'Particular' => $this->M_Hospital->GetTable('outdoor_facility', 'facilit_name', 'ASC'),
		    	    'Doctor'     => $this->M_Hospital->GetTable('h_doctor', 'name', 'ASC'),
		    	    'script' => 'web-hospital/outdoor/treatment-js',
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
		    }
		}

		public function update() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
				
				$_POST['category']   = implode(',', $_POST['category']);
				$_POST['particular'] = implode(',', $_POST['particular']);
				$_POST['amount']     = implode(',', $_POST['amount']);
				$_POST['app_date']   = date('Y-m-d', strtotime($_POST['app_date']));

				$_POST['id']   = $this->uri->segment(3);
				$_POST['pKey'] = 'treat_id';

				if ($_POST['referredby'] == 'Name') $_POST['referredby'] = $_POST['ReferredByName'];
				unset($_POST['ReferredByName']);

				$this->M_Hospital->UpdateData('outdoor_treat', $_POST);
				redirect('outdoor/ticket/'.$this->uri->segment(3), 'refresh');

			}else{	
				$Data = [
					'active'  => 'Patient',
		    	    'load'    => 'web-hospital/outdoor/update',
		    	    'script'  => 'web-hospital/outdoor/treatment-js',
		    	    'Category'=> $this->M_Hospital->GetTable('outdoor_facility_group', 'group_name', 'ASC'),
		    	    'Doctor'  => $this->M_Hospital->GetTable('h_doctor', 'name', 'ASC'),
		    	    'tData'   => $this->M_Hospital->GetWhere('outdoor_treat', array('treat_id' => $this->uri->segment(3)))
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
		    }
		}
		public function patientList() {

			$Data = [
				'active' => 'Patient',
	    	    'load'   => 'web-hospital/outdoor/list',
	    	    'script' => 'web-hospital/outdoor/treatment-js',
	    	    'patient'=> $this->M_Hospital->GetTable('outdoor_treat', 'treat_id', 'DESC')
	    	];
	    	$this->load->view('web-hospital/layout/layout', $Data);
		}

		public function ticket() {

	    	/*$Data = [
	    		'Row'  => '<tr>
							<td>'.$this->my_library->GetParam('outdoor_facility_group', 'group_name', array('g_code' => $tData->category)).'</td>
							<td>'.$this->my_library->GetParam('outdoor_facility', 'facilit_name', array('od_facilit_id' => $tData->particular)).'</td>
							<td>'.$tData->patient_type.'</td>
							<td>'.$tData->amount.'</td>
						</tr>',
				'tNo'  => str_replace('-', '', $tData->app_date).'/'.$tData->app_que,
				'rNo'  => 'AD'.sprintf('%04d', $this->uri->segment(3)),
				'name' => $tData->name,
				'aDate' => date('d-M-y', strtotime($tData->app_date)),
				'age'  => $tData->age.' '.$tData->age2.'/'.$tData->gender,
				'referredby'  => $this->my_library->GetParam('h_doctor', 'name', array('doctor_id' => $tData->referredby))
	    	];

	    	$this->load->view('web-hospital/outdoor/ticket', $Data);
	    	*/

	    	$Data = [
				'active' => 'Patient',
	    	    'load'   => 'web-hospital/outdoor/ticket',
	    	    'script' => 'web-hospital/outdoor/treatment-js',
	    	    'tData'  => $this->M_Hospital->GetWhere('outdoor_treat', array('treat_id' => $this->uri->segment(3)))
	    	];
	    	$this->load->view('web-hospital/layout/layout', $Data);
		}
		
			public function ticket1() {

	    	$Data = [
				'active' => 'Patient',
	    	    'load'   => 'web-hospital/outdoor/ticket1',
	    	    'script' => 'web-hospital/outdoor/treatment-js',
	    	    'tData'  => $this->M_Hospital->GetWhere('h_patient', array('patient_id' => $this->uri->segment(3)))
	    	];
	    	$this->load->view('web-hospital/layout/layout', $Data);
		}
		
		

		

		public function getOutDoorFacility(){

			$id  = $_POST['CatID'];
			$Fac = $this->M_Hospital->GetArray('outdoor_facility', array('g_code' => $id));

			$Data = '<option value="" hidden="true">Select Particular</option>';
            foreach ($Fac as $key => $value) {
                $Data .= '<option value="'.$value->od_facilit_id.'">'.$value->facilit_name.'</option>';
            }

            exit(json_encode($Data));
		}

		public function getFacilityAmount(){

			extract($_POST);

			switch ($pType) {
				case 'Pension Holder': $Col = 'rate_c'; break;
				case 'General':        $Col = 'rate_d'; break;
				case 'Beneficiaries':  $Col = 'rate_b'; break;
				default:               $Col = 'rate_nb'; break;
			}

			$amt = $this->my_library->GetParam('outdoor_facility', $Col, array('od_facilit_id' => $pID));

			exit(json_encode($amt));
		}

	}


?>