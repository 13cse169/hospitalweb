<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 	* Master
	*/
	class Master extends MY_Controller {
		
		public function __construct() {
			parent::__construct();
		}

		public function doctor(){
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$_POST['doj'] = date('Y-m-d', strtotime($_POST['doj']));

				if ($_FILES['photo']['name'] != '') {
					
					$config['upload_path']   = './assets/img/doctors/';
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
				
				$id = $this->M_Hospital->InsertData('h_doctor', $_POST);

				if ($id < 10) { $code = 'DID00'.$id; }
				elseif ($id >= 10 && $id < 100) { $code = 'DID0'.$id; }
				else{ $code = 'DID'.$id; }

				$array = [
					'id'   => $id,
					'code' => $code,
					'pKey' => 'doctor_id'
				];

				$this->M_Hospital->UpdateData('h_doctor', $array);

				redirect('master/doctor','refresh');

			}else{

				if ($this->uri->segment(3) == 'add') {
					
					$Data = [
						'active' => 'Master',
			    	    'load'   => 'web-hospital/master/doctor-add',
			    	    'Dept'   => $this->M_Hospital->GetTable('h_dept', 'dept_id', 'DESC') 
			    	];
					
					$this->load->view('web-hospital/layout/layout', $Data);

				}else{

					$Data = [
						'active' => 'Master',
			    	    'load'   => 'web-hospital/master/doctor-list',
			    	    'Doctor' => $this->M_Hospital->GetTable('h_doctor', 'dept_id', 'DESC') 
			    	];
					
					$this->load->view('web-hospital/layout/layout', $Data);
				}
			}
		}

		public function department(){
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {


				if (isset($_POST['update'])) {
					$_POST['pKey'] = 'dept_id'; unset($_POST['update']);

					$this->M_Hospital->UpdateData('h_dept', $_POST);
					redirect('master/department','refresh');	

				}else{
				
					$id = $this->M_Hospital->InsertData('h_dept', $_POST);

					if ($id < 10) { $code = 'DEPT00'.$id; }
					elseif ($id >= 10 && $id < 100) { $code = 'DEPT0'.$id; }
					else{ $code = 'DEPT'.$id; }

					$array = [
						'id'   => $id,
						'code' => $code,
						'pKey' => 'dept_id'
					];

					$this->M_Hospital->UpdateData('h_dept', $array);

					redirect('master/department','refresh');
				}

			}else{
				$Data = [
					'active' => 'Master',
		    	    'load'   => 'web-hospital/master/department-list',
		    	    'Dept'   => $this->M_Hospital->GetTable('h_dept', 'dept_id', 'DESC') 
		    	];

		    	$Get = $this->uri->segment(3);
		    	if (isset($Get)) { $Data['UpdateData'] = $this->M_Hospital->GetWhere('h_dept', array('dept_id' => $Get)); }
				
				$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function ward(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				if (isset($_POST['update'])) {
					$_POST['pKey'] = 'ward_id'; unset($_POST['update']);

					$this->M_Hospital->UpdateData('h_ward', $_POST);
					redirect('master/ward','refresh');	

				}else{
				
					$id = $this->M_Hospital->InsertData('h_ward', $_POST);

					if ($id < 10) { $code = 'W00'.$id; }
					elseif ($id >= 10 && $id < 100) { $code = 'W0'.$id; }
					else{ $code = 'W'.$id; }

					$array = [
						'id'   => $id,
						'code' => $code,
						'pKey' => 'ward_id'
					];

					$this->M_Hospital->UpdateData('h_ward', $array);

					redirect('master/ward','refresh');
				}

			}else{
				$Data = [
					'active' => 'Master',
		    	    'load'   => 'web-hospital/master/ward-list',
		    	    'Dept'   => $this->M_Hospital->GetTable('h_dept', 'dept_id', 'DESC'),
		    	    'Ward'   => $this->M_Hospital->GetTable('h_ward', 'ward_id', 'DESC') 
		    	];

		    	$Get = $this->uri->segment(3);
		    	if (isset($Get)) { $Data['UpdateData'] = $this->M_Hospital->GetWhere('h_ward', array('ward_id' => $Get)); }
				
				$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function bed(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$id = $this->M_Hospital->InsertData('h_bed', $_POST);

				if ($id < 10) { $code = 'BD00'.$id; }
				elseif ($id >= 10 && $id < 100) { $code = 'BD0'.$id; }
				else{ $code = 'BD'.$id; }

				$array = [
					'id'   => $id,
					'code' => $code,
					'pKey' => 'bed_id'
				];

				$this->M_Hospital->UpdateData('h_bed', $array);

				redirect('master/bed','refresh');

			}else{
				$Data = [
					'active' => 'Master',
		    	    'load'   => 'web-hospital/master/bed-list',
		    	    'script' => 'web-hospital/master/master-js',
		    	    'Dept'   => $this->M_Hospital->GetTable('h_dept', 'dept_id', 'DESC'),
		    	    'Bed'    => $this->M_Hospital->GetTable('h_bed', 'bed_id', 'DESC')
		    	];

		    	/*$Get = $this->uri->segment(3);
		    	if (isset($Get)) { $Data['UpdateData'] = $this->M_Hospital->GetWhere('h_ward', array('ward_id' => $Get)); }*/
				
				$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function attendentshift(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$id = $this->M_Hospital->InsertData('h_attendent_shift', $_POST);

				if ($id < 10) { $code = 'ASH00'.$id; }
				elseif ($id >= 10 && $id < 100) { $code = 'ASH0'.$id; }
				else{ $code = 'ASH'.$id; }

				$array = [
					'id'   => $id,
					'code' => $code,
					'pKey' => 'shift_id'
				];

				$this->M_Hospital->UpdateData('h_attendent_shift', $array);

				redirect('master/attendentshift','refresh');

			}else{
				$Data = [
					'active' => 'Master',
		    	    'load'   => 'web-hospital/master/attendent-shift-list',
		    	    'AShift' => $this->M_Hospital->GetTable('h_attendent_shift', 'shift_id', 'DESC') 
		    	];
				
				$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function attendent(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				if (isset($_POST['update'])) {
					$_POST['pKey'] = 'attendent_id'; unset($_POST['update']);

					$this->M_Hospital->UpdateData('h_attendent', $_POST);
					redirect('master/attendent','refresh');	

				}else{

					$_POST['doj'] = date('Y-m-d', strtotime($_POST['doj']));
					
					$id = $this->M_Hospital->InsertData('h_attendent', $_POST);

					if ($id < 10) { $code = 'A00'.$id; }
					elseif ($id >= 10 && $id < 100) { $code = 'A0'.$id; }
					else{ $code = 'A'.$id; }

					$array = [
						'id'   => $id,
						'code' => $code,
						'pKey' => 'attendent_id'
					];

					$this->M_Hospital->UpdateData('h_attendent', $array);

					redirect('master/attendent','refresh');
				}

			}else{
				$Data = [
					'active' => 'Master',
		    	    'load'   => 'web-hospital/master/attendent-list',
		    	    'AShift' => $this->M_Hospital->GetTable('h_attendent_shift', 'shift_id', 'DESC'), 
		    	    'Attendent' => $this->M_Hospital->GetTable('h_attendent', 'attendent_id', 'DESC')
		    	];

		    	$Get = $this->uri->segment(3);
		    	if (isset($Get)) { $Data['UpdateData'] = $this->M_Hospital->GetWhere('h_attendent', array('attendent_id' => $Get)); }

				$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function facility(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				if (isset($_POST['update'])) {
					$_POST['pKey'] = 'facility_id'; unset($_POST['update']);

					$this->M_Hospital->UpdateData('h_facility', $_POST);
					redirect('master/facility-add','refresh');	

				}else{

					$id = $this->M_Hospital->InsertData('h_facility', $_POST);

					if ($id < 10) { $code = 'FC00'.$id; }
					elseif ($id >= 10 && $id < 100) { $code = 'FC0'.$id; }
					else{ $code = 'FC'.$id; }

					$array = [
						'id'   => $id,
						'code' => $code,
						'pKey' => 'facility_id'
					];

					$this->M_Hospital->UpdateData('h_facility', $array);

					redirect('master/facility-add','refresh');
				}

			}else{
				$Data = [
					'active' => 'Master',
		    	    'load'   => 'web-hospital/master/facility-list',
		    	    'script'   => 'web-hospital/master/facility-js',
		    	    'Category' => $this->M_Hospital->GetTable('facility_catg', 'category', 'ASC'),
		    	    'Facility' => $this->M_Hospital->GetTable('h_facility', 'facility_id', 'DESC') 
		    	];

		    	$Get = $this->uri->segment(3);
		    	if (isset($Get)) { $Data['UpdateData'] = $this->M_Hospital->GetWhere('h_facility', array('facility_id' => $Get)); }
				
				$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function facilityCategory(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				if (isset($_POST['updateCat'])) {
					$_POST['pKey'] = 'cat_id'; unset($_POST['updateCat']);

					$this->M_Hospital->UpdateData('facility_catg', $_POST);
					redirect('master/facility-category','refresh');

				}elseif (isset($_POST['subCategory'])) {
					unset($_POST['subCategory']);

					foreach ($_POST['subcategory'] as $key => $value) {
						
						$Insert['cat_id']      = $_POST['cat_id'];
						$Insert['subcategory'] = $value;
						
						$this->M_Hospital->InsertData('facility_subcatg', $Insert);
					}

					redirect('master/facility-category','refresh');

				}else{

					foreach ($_POST['category'] as $key => $value) {
						$Insert['category'] = $value;
						$this->M_Hospital->InsertData('facility_catg', $Insert);
					}

					redirect('master/facility-category','refresh');
				}

			}else{
				$Data = [
					'active' => 'Master',
		    	    'load'   => 'web-hospital/master/facility-category',
		    	    'script'   => 'web-hospital/master/facility-js',
		    	    'Category' => $this->M_Hospital->GetTable('facility_catg', 'category', 'ASC') 
		    	];

		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function facilitySubCategory(){
			
			$Data = '<option value="" hidden="true">Select Sub-Category</option>';
			$SubCategory = $this->M_Hospital->GetArray('facility_subcatg', array('cat_id' => $_POST['catID']));

			if (count($SubCategory)) {
				foreach ($SubCategory as $key => $value) 
					$Data .= '<option value="'.$value->subcat_id.'">'.$value->subcategory.'</option>';
				
			}else $Data .= '<option value="" disabled="true">No Record Found...</option>';

			exit(json_encode($Data));
		}

		public function getFacility(){
			
			$Data = '
				<div class="row">
					<div class="col-md-4 offset-md-3">
		                <div class="form-group">
		                    <label class="form-label">Facility Number <span class="text-danger">*</span></label>
		                </div>
		            </div>
		            <div class="col-md-2">
		                <div class="form-group">
		                    <label class="form-label">Facility Amount <span class="text-danger">*</span></label>
		                </div>
		            </div>
		        </div>
			';
			$Facility = $this->M_Hospital->GetArray('h_facility', array('subcategory' => $_POST['subCatID']));

			if (count($Facility)) {
				foreach ($Facility as $key => $value) {

					if ($_POST['pType'] == 'B') $amt = $value->beneficiaries; 
					else $amt = $value->nonbeneficiaries;
					
					$Data .= '
						<div class="row">
							<div class="col-md-4 offset-md-2">
								<div class="form-group">
				                    <input type="text" name="facility[]" value="'.$value->name.'" class="form-control fac-nme" readonly="true">
				                </div>
				            </div>
				            <div class="col-md-2">
								<div class="form-group">
				                    <input type="number" name="amount[]" class="form-control fac-amt" min="'.$amt.'" value="'.$amt.'">
				                    <input type="hidden" class="fac-id" name="id[]" value="'.$value->facility_id.'">
				                </div>
				            </div>
				            <div class="col-md-2 text-center">
								<div class="form-group">
				                    <!--<button type="button" class="btn btn-pill btn-danger facility-remove">
				                    	<i class="fas fa-times"></i>
				                    </button>-->
				                </div>
				            </div>
				        </div>
				    ';
				}

$Data .= '
	<div class="row OtherFacilityRow">
    	<div class="col-md-6 offset-md-2">
            <div class="form-group">
                <label class="form-label">Select Other Facility <span class="text-danger">*</span></label>
                <select class="form-control OtherFacility">
                    <option value="" hidden="true">Select Other Facility</option>
                    <option value="Doctor">SPECIAL DOCTOR</option>
                    <option value="Ass. Doctor">ASS. DOCTOR</option>
                    <option value="O.T SALINE">O.T SALINE</option>
                    <option value="WARD SALINE">WARD SALINE</option>
                </select>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="SpecialDoctor" style="display: none;"></div>
    <div class="AssDoctor" style="display: none;"></div>
    <div class="OTSalineDiv" style="display: none;"></div>
    <div class="WardSalineDiv" style="display: none;"></div>
';

				
			}else $Data .= '
				<div class="row">
					<div class="col-md-6 offset-md-3 text-center">
		                <div class="form-group">
		                    <label class="form-label text-danger">
		                    	<h4><strong>No Data Found...</strong></h4>
		                    </label>
		                </div>
		            </div>
		        </div>
			';

			exit(json_encode($Data));
		}

	}
?>