<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 	* Patient
	*/
	class Patient extends MY_Controller {

		public function __construct() {
			parent::__construct();
		}

		public function IndoorUpdateFacility(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') { extract($_POST); $TotalAmt = 0;

				for ($i = 0; $i < count($inID); $i++) { 
					$TotalAmt += $amount[$i];
					$InFacility[] = array('id' => $inID[$i], 'amount' => $amount[$i]);
				}
				$FacilityDate = $this->M_Hospital->GetWhere('patient_facility_amt', array('id' => $aID));
				
				if (isset($SpecialDoctorName)) {
					for ($i = 0; $i < count($SpecialDoctorName); $i++) { 
						$OtFacility[] = array(
							'aid' => $aID,
							'pid' => $this->uri->segment(3),
							'category' => $category,
							'subcategory' => $subcategory,
							'type' => 'Doctor',
							'name' => $SpecialDoctorName[$i],
							'amount' => $SpecialDoctorFees[$i],
							'qty' => $SpecialDoctorVisit[$i],
							'created_at'  => $FacilityDate->created_at
						);
						$TotalAmt += $SpecialDoctorFees[$i];
					}
				}
				if (isset($AssDoctorName)) {
					for ($i = 0; $i < count($AssDoctorName); $i++) { 
						$OtFacility[] = array(
							'aid' => $aID,
							'pid' => $this->uri->segment(3),
							'category' => $category,
							'subcategory' => $subcategory,
							'type' => 'Asst. Doctor',
							'name' => $AssDoctorName[$i],
							'amount' => $AssDoctorFees[$i],
							'qty' => $AssDoctorVisit[$i],
							'created_at'  => $FacilityDate->created_at
						);
						$TotalAmt += $AssDoctorFees[$i];
					}
				}
				if (isset($OTSalineName)) {
					for ($i = 0; $i < count($OTSalineName); $i++) { 
						$OtFacility[] = array(
							'aid' => $aID,
							'pid' => $this->uri->segment(3),
							'category' => $category,
							'subcategory' => $subcategory,
							'type' => 'O.T SALINE',
							'name' => $this->my_library->GetParam('saline_master', 'name', array('id' => $OTSalineName[$i])),
							'amount' => $OTSalineAmount[$i],
							'qty' => $OTSalineQty[$i],
							'created_at'  => $FacilityDate->created_at
						);
						$TotalAmt += $OTSalineAmount[$i];
					}
				}
				if (isset($WardSalineName)) {
					for ($i = 0; $i < count($WardSalineName); $i++) { 
						$OtFacility[] = array(
							'aid' => $aID,
							'pid' => $this->uri->segment(3),
							'category' => $category,
							'subcategory' => $subcategory,
							'type' => 'WARD SALINE',
							'name' => $this->my_library->GetParam('saline_master', 'name', array('id' => $WardSalineName[$i])),
							'amount' => $WardSalineAmount[$i],
							'qty' => $WardSalineQty[$i],
							'created_at'  => $FacilityDate->created_at
						);
						$TotalAmt += $WardSalineAmount[$i];
					}
				}

				$myArray = [ 'id' => $aID, 'pKey' => 'id', 'amount' => $TotalAmt ];

				$this->M_Hospital->UpdateBatch('patient_facility', 'id', $InFacility);
				$this->M_Hospital->UpdateData('patient_facility_amt', $myArray);
				$this->M_Hospital->DeleteData('other_facility', array('aid' => $aID));
				$this->M_Hospital->InsertBatch('other_facility', $OtFacility);

				redirect('patient/update-facility/'.$this->uri->segment(3),'refresh');
			}else{
				$Data = [
					'active'  => 'Patient',
		    	    'load'    => 'web-hospital/patient/update-facility',
		    	    'script'  => 'web-hospital/patient/all-feature-js',
		    	    'Amount'  => $this->M_Hospital->GetArray('patient_facility_amt', array('patient' => $this->uri->segment(3)))
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
		    }
		}
		public function RefundAmount(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') { extract($_POST);
				$Patient = $this->M_Hospital->GetWhere('h_patient', array('patient_id' => $id));
				$myArray = [ 'id' => $id, 'pKey' => 'patient_id', 'refund_amt' => $refund_amt, 'refund_dis' => $refund_dis ];
				$this->M_Hospital->UpdateData('h_patient', $myArray);
				$this->session->set_flashdata('added', 'value');
				redirect('patient/refund-amount','refresh');
				
			}else{
				$Data = [
					'active'  => 'Patient',
		    	    'load'    => 'web-hospital/patient/refund-amount',
		    	    'script'  => 'web-hospital/patient/all-feature-js',
		    	    'Patient' => $this->M_Hospital->GetTable('h_patient', 'patient_id', 'DESC')
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
		    }
		}
		
		public function EmergencyList(){
			$Data = [
				'active'   => 'Patient',
	    	    'load'     => 'web-hospital/patient/emergency-list',
	    	    'script'   => 'web-hospital/patient/emergency-js',
	    	    'Patient'  => $this->M_Hospital->GetArray('h_patient', array('patient_type' => 'Emergency'))
	    	];

	    	$this->load->view('web-hospital/layout/layout', $Data);
		}

		public function emergency(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$_POST['facilityhead']   = implode(',', $_POST['facilityhead']);
				$_POST['emfacility']     = implode(',', $_POST['emfacility']);
				$_POST['doctor_fee']     = implode(',', $_POST['doctor_fee']);

				extract($_POST);
				
				$Patient = [
					'name'            => $_POST['name'],
					'age'             => $_POST['age'],
					'age2'            => $_POST['age2'],
					'gender'          => $_POST['gender'],
					'relative'        => $_POST['relative'],
					'relation'        => $_POST['relation'],
					'phone'           => $_POST['phone'],
					'doctor_id'       => $_POST['referred_by'],
					'patient_type'    => 'Emergency',
					'admissionfee'    => $_POST['admissionfee'],
					'collectedby'     => $_POST['collectedby'],
					'service_charge'  => $_POST['service_charge']
				];

				    //$_POST['referred_by']; unset($_POST['referred_by']);

					$PID = $this->M_Hospital->InsertData('h_patient', $Patient);

					if ($PID < 10) {  $code = 'P'.date('Ymd').'00'.$PID;  $AID  = 'AD'.date('Ymd').'00'.$PID; }
					elseif ($PID >= 10 && $PID < 100) { $code = 'P'.date('Ymd').'0'.$PID; $AID  = 'AD'.date('Ymd').'0'.$PID; }
					else{ $code = 'P'.date('Ymd').$PID; $PID  = 'AD'.date('Ymd').$PID; }

					$array = [ 'id'   => $PID, 'code' => $code, 'pKey' => 'patient_id', 'admission_id' => $AID ];

					if ($this->M_Hospital->UpdateData('h_patient', $array)) {
						$Treatment = [
							'patient_id'     => $PID,
							'doctor_id'      => $_POST['referred_by'],
							'allotment_date' => date('Y-m-d', strtotime($_POST['allotment_date'])),
							'allotment_time' => $_POST['allotment_time']
						];
						//print_r($Treatment);exit();
						$TID = $this->M_Hospital->InsertData('h_treatment', $Treatment);
					}


			$Head = $_POST['facilityhead'];

				if ($Head == 'Emergency Facility') {
					$myArray = ['pid' => $PID, 'type' => 'Emergency Facility', 'amount' => $_POST['doctor_fee'] ];
					if ($_POST['emfacility'] == 'Miscellaneous') {
						$myArray['type'] = 'Miscellaneous'; $myArray['name'] = 'Miscellaneous';
					}elseif ($_POST['emfacility'] == 'Bed') {
						$myArray['type'] = 'Bed'; $myArray['name'] = 'Bed';
					}elseif ($_POST['emfacility'] == 'Special Doctor') {
						$myArray['type'] = 'Doctor'; $myArray['name'] = $_POST['doctor_name'];
					}else{
						$myArray['name'] = $this->my_library->GetParam('emergency_facility', 'facility', array('id' => $_POST['emfacility']));
					}
				}

				else if ($Head == 'ECHO Cardiography') {
					$myArray = ['pid' => $PID, 'type' => 'ECHO', 'name' => 'ECHO Cardiography', 'amount' => $_POST['doctor_fee'] ];
				}

				else if ($Head == 'Pathology') {

					for ($i = 0; $i < count($_POST['PathologyTestName']); $i++) { 
						$myArray[] = array('pid' => $PID, 'type' => 'Pathology', 'name' => $_POST['PathologyTestName'][$i], 'amount' => $_POST['TestAmount'][$i] );
					}
				}
			

				else if ($Head == 'U.S.G') {

					$myArray = [
						'pid'    => $PID, 'type' => 'U.S.G', 'amount' => $_POST['doctor_fee'],
						'name'   => $this->my_library->GetParam('outdoor_facility', 'facilit_name', array('od_facilit_id' => $_POST['usg']))
					];
				}

				else if ($Head == 'X-Ray') {
					$myArray = [
						'pid'    => $PID, 'type' => 'X-Ray', 'amount' => $_POST['doctor_fee'],
						'name'   => $this->my_library->GetParam('outdoor_facility', 'facilit_name', array('od_facilit_id' => $_POST['xray']))
					];
				}

				else { $myArray = ['pid' => $PID, 'type' => 'E.C.G', 'name' => 'E.C.G', 'amount' => $_POST['doctor_fee'] ]; }

				$myArray['patient_type'] = 'Emergency';

				if (isset($myArray[0])) $this->M_Hospital->InsertBatch('other_facility', $myArray);
				
				else $this->M_Hospital->InsertData('other_facility', $myArray);

				$this->session->set_flashdata('added', 'value');
				redirect('patient/emergency','refresh');
				
			} else {

				$Data = [
					'active'   => 'Patient',
		    	    'load'     => 'web-hospital/patient/emergency',
		    	    'script'   => 'web-hospital/patient/emergency-js',
		    	    'Doctor'   => $this->M_Hospital->GetTable('h_doctor', 'name', 'ASC'),
		    	    'USG'      => $this->M_Hospital->GetArray('outdoor_facility', array('g_code' => 'G00005')),
		    	    'XRay'     => $this->M_Hospital->GetArray('outdoor_facility', array('g_code' => 'G00004')),
		    	    'Patient'  => $this->M_Hospital->GetArray('h_patient', array('patient_type' => 'Emergency')),
		    	    'Facility' => $this->M_Hospital->GetTable('emergency_facility', 'facility', 'ASC'),
		    	    'Type'     => $this->M_Hospital->RunQuery("SELECT type FROM pathology GROUP BY type ORDER BY type ASC")
		    	];

		    	$this->load->view('web-hospital/layout/layout', $Data);
		    }
		}

		public function printPaymentReport(){

			$code = $this->uri->segment(4);

			$Data = $this->M_Hospital->GetArray('h_payment', array('patient_code' => $code));

			$PID = $this->M_Hospital->GetWhere('h_patient', array('code' => $code));
			$TID = $this->M_Hospital->GetWhere('h_treatment', array('patient_id' => $PID->patient_id));

			$myData->age = $PID->age.' / '.$PID->gender;
			$myData->patient_name = $PID->name;

			$myData->patient_id = $PID->code;
			$myData->regDate    = date('d-M-y', strtotime($TID->allotment_date)).' '.$TID->allotment_time;

			$myData->doctor = $this->my_library->GetParam('h_doctor', 'name', array('doctor_id' => $TID->doctor_id));

			$myData->paidInfo = '';
			foreach ($Data as $key => $value) {

				$myData->paidInfo .= '
					<tr>
						<td align="center">'.date('d-M-y', strtotime($value->added_on)).'</td>
						<td align="center">'.$value->pay_mode.'</td>
						<td align="center">'.
							$this->my_library->GetParam('users', 'name', array('id' => $value->pay_rcv))
						.'</td>
						<td align="center">'.$value->purpose.'</td>
						<td align="center">'.number_format(($value->pay_amt), 2, '.', '').'</td>
					</tr>
				';
			}

			$html = $this->load->view('web-hospital/patient/payment-invoice', $myData, True);

			$pdf = new Mpdf();
            $pdf->SetDisplayMode('real', 'default');
            $pdf->SetPrintHeader(false);

		    $pdf->AddPage();
		    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

		    while (ob_get_level()) ob_end_clean();
		    $pdf->Output('print-bill.pdf', 'I'); 

		}

		public function printPaymentDetails(){
			$code = $this->uri->segment(4);

			//$this->load->view('web-hospital/patient/payment-invoice');

			$Data = $this->M_Hospital->GetWhere('h_payment', array('pay_id' => $code));

			$PID = $this->M_Hospital->GetWhere('h_patient', array('code' => $Data->patient_code));
			$TID = $this->M_Hospital->GetWhere('h_treatment', array('patient_id' => $PID->patient_id));

			$Data->age = $PID->age.' / '.$PID->gender;
			$Data->doctor = $this->my_library->GetParam('h_doctor', 'name', array('doctor_id' => $TID->doctor_id));

			$Data->patient_id = $PID->code;
			$Data->regDate    = date('d-M-y', strtotime($TID->allotment_date)).' '.$TID->allotment_time;

			$Data->paidInfo = '
				<tr>
					<td align="center">'.date('d-M-y', strtotime($Data->pay_date)).'</td>
					<td align="center">'.$Data->pay_mode.'</td>
					<td align="center">'.
						$this->my_library->GetParam('users', 'name', array('id' => $Data->pay_rcv))
					.'</td>
					<td align="center">'.$Data->purpose.'</td>
					<td align="center">'.number_format(($Data->pay_amt), 2, '.', '').'</td>
				</tr>
			';

			$Data->pay_type = ($Data->pay_type) ? date('Ymd', strtotime($Data->pay_date)).'/'.sprintf("%03d", $Data->pay_id) : date('Ymd', strtotime($Data->pay_date)).'/'.sprintf("%03d", $Data->pay_id);

			//echo'<pre>';print_r($Data);exit();

			$html = $this->load->view('web-hospital/patient/payment-invoice', $Data, True);

			$pdf = new Mpdf();

			//$pdf->SetTitle('Money Receipt');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->SetPrintHeader(false);

		    $pdf->AddPage();
		    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

		    while (ob_get_level()) ob_end_clean();
		    $pdf->Output('print-bill.pdf', 'I'); 

		}

		public function payment_details(){

			$tID = $this->my_library->GetParam('h_treatment', 'treatment_id', array('patient_id' => $this->my_library->GetParam('h_patient', 'patient_id', array('code' => $this->uri->segment(3)))));

			$Data = [
				'active'  => 'Patient',
	    	    'load'    => 'web-hospital/patient/payment-details',
	    	    'Payment' => $this->M_Hospital->GetArray('h_payment', array('patient_code' => $this->uri->segment(3))),
	    	    'grandTotal' => number_format((float)$this->GetTotalAmount($tID), 2, '.', ''),
	    	];
	    	
	    	$this->load->view('web-hospital/layout/layout', $Data);
		}

		public function all_feature(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				//echo'<pre>';print_r($_POST);exit();

				$Patient = [
					'name'            => $_POST['name'],
					'nationality'     => $_POST['nationality'],
					'religion'        => $_POST['religion'],
					'gender'          => $_POST['gender'],
					//'category'        => $_POST['category'],
					'age'             => $_POST['age'],
					'age2'            => $_POST['age2'],
					'blood_group'     => $_POST['blood_group'],
					'material_status' => $_POST['material_status'],
					'phone'           => $_POST['phone'],
					//'email'           => $_POST['email'],
					'relative'        => $_POST['relative'],
					'relation'        => $_POST['relation'],
					'address'         => $_POST['address'],
					'patient_type'    => 'Indoor',
					'patient_cat'     => $_POST['patient_cat'],
					'admissionfee'    => $_POST['admissionfee'],
					'bed_type'        => $_POST['bed_type'],
					'bedrent'         => $_POST['bedrent'],
					'staydays'        => $_POST['staydays'],
				];

				if ($_POST['patient_id'] == 'New') {

					$PID = $this->M_Hospital->InsertData('h_patient', $Patient);

					$AID = $this->M_Hospital->GetArray('patient_facility_amt', array('patient' => $tID));

					if ($PID < 10) {  $code = 'P'.date('Ymd').'00'.$PID;  $AID  = 'AD'.date('Ymd').'00'.$PID; }
					elseif ($PID >= 10 && $PID < 100) { $code = 'P'.date('Ymd').'0'.$PID; $AID  = 'AD'.date('Ymd').'0'.$PID; }
					else{ $code = 'P'.date('Ymd').$PID; $PID  = 'AD'.date('Ymd').$PID; }

					$array = [ 'id'   => $PID, 'code' => $code, 'pKey' => 'patient_id', 'admission_id' => $AID ];
					if ($this->M_Hospital->UpdateData('h_patient', $array)) {

						$Treatment = [
							'patient_id'     => $PID,
							'doctor_id'      => $_POST['referred_by'],
							'allotment_date' => date('Y-m-d', strtotime($_POST['allotment_date'])),
							'allotment_time' => $_POST['allotment_time'],
							//'dept_id'        => $_POST['dept_id'],
							//'ward_id'        => $_POST['ward_id'],
							//'bed_id'         => $_POST['bed_id']
						];

						$TID = $this->M_Hospital->InsertData('h_treatment', $Treatment);

						/*$myArray = [
							'treatment_id' => $PID, 
							'mat_name'     => 'Bed',
							'mat_id'       => $_POST['bed_id'],
							'qty'          => 1
						];*/

						//$this->M_Hospital->InsertData('h_treatment_details', $myArray);

						if ($_POST['adv_pay_amt']) {

							if ($_POST['adv_pay_mode'] == 'Cheque') {
								$cheque_dd_num = $_POST['adv_cheque_num'];
								$bank_name     = $_POST['adv_ch_bank_name'];
								$issued_date   = date('Y-m-d', strtotime($_POST['adv_ch_issued_date']));
								$payable_at    = '';
							
							}elseif ($_POST['adv_pay_mode'] == 'Demand Draft') {
								$cheque_dd_num = $_POST['adv_dd_num'];
								$bank_name     = $_POST['adv_dd_bank_name'];
								$issued_date   = date('Y-m-d', strtotime($_POST['adv_dd_issued_date']));
								$payable_at    = $_POST['adv_dd_payable_at'];
							
							}else{ $payable_at = $issued_date = $bank_name = $cheque_dd_num = ''; }

							$Payment = [
								'treatment_id'  => $TID,
								'patient_code'  => $code,
								'admission_id'  => $AID,
								'patient_name'  => $_POST['name'],
								'pay_rcv'       => $_POST['adv_pay_rcv'],
								'pay_amt'       => $_POST['adv_pay_amt'],
								'pay_date'      => date('Y-m-d', strtotime($_POST['adv_pay_date'])),
								'pay_type'      => 'Advance',
								'pay_mode'      => $_POST['adv_pay_mode'],
								'cheque_dd_num' => $cheque_dd_num,
								'bank_name'     => $bank_name,
								'issued_date'   => $issued_date,
								'payable_at'    => $payable_at,
								//'voucher_no'       => $_POST['adv_voucher_no'],
								'purpose'       => $_POST['adv_purpose']
							];
							$PayID = $this->M_Hospital->InsertData('h_payment', $Payment);
						}

					}
				}else{
					$PID = $Patient['id']   = $_POST['patient_id'];
					$Patient['pKey'] = 'patient_id';

					if ($this->M_Hospital->UpdateData('h_patient', $Patient)) {

						$Treatment = [
							'id'             => $PID,
							'pKey'           => 'patient_id',
							'doctor_id'      => $_POST['referred_by'],
							'allotment_date' => date('Y-m-d', strtotime($_POST['allotment_date'])),
							'allotment_time' => $_POST['allotment_time'],
							/*'dept_id'        => $_POST['dept_id'],
							'ward_id'        => $_POST['ward_id'],
							'bed_id'         => $_POST['bed_id']*/
						];

						$this->M_Hospital->UpdateData('h_treatment', $Treatment);

						if ($_POST['pay_amt']) {

							if ($_POST['pay_mode'] == 'Cheque') {
								$cheque_dd_num = $_POST['cheque_num'];
								$bank_name     = $_POST['ch_bank_name'];
								$issued_date   = date('Y-m-d', strtotime($_POST['ch_issued_date']));
								$payable_at    = '';
							
							}elseif ($_POST['pay_mode'] == 'Demand Draft') {
								$cheque_dd_num = $_POST['dd_num'];
								$bank_name     = $_POST['dd_bank_name'];
								$issued_date   = date('Y-m-d', strtotime($_POST['dd_issued_date']));
								$payable_at    = $_POST['dd_payable_at'];
							
							}else{
								$payable_at = $issued_date = $bank_name = $cheque_dd_num = '';
							}

							$Payment = [
								'treatment_id'  => $this->my_library->GetParam('h_treatment', 'treatment_id', array('patient_id' => $PID)),
								'patient_code'  => $this->my_library->GetParam('h_patient', 'code', array('patient_id' => $PID)),
								'admission_id'  => $this->my_library->GetParam('h_patient', 'admission_id', array('patient_id' => $PID)),
								'patient_name'  => $_POST['name'],
								'pay_rcv'       => $_POST['pay_rcv'],
								'pay_amt'       => $_POST['pay_amt'],
								'pay_date'      => date('Y-m-d', strtotime($_POST['pay_date'])),
								'pay_type'      => '',
								'pay_mode'      => $_POST['pay_mode'],
								'cheque_dd_num' => $cheque_dd_num,
								'bank_name'     => $bank_name,
								'issued_date'   => $issued_date,
								'payable_at'    => $payable_at,
								//'voucher_no'  => $_POST['voucher_no'],
								'purpose'       => $_POST['purpose']
							];

							$PID = $this->M_Hospital->InsertData('h_payment', $Payment);
						}

					}
				}

				$tDetails = $this->M_Hospital->GetArray('h_temp', array('col_1' => $PID));
				foreach ($tDetails as $key => $value) {
					
					$myArray = [
						'treatment_id' => $value->col_1, 
						'mat_name'     => 'Particular',
						'mat_id'       => $value->col_2,
						'type'         => $value->col_3,
						'qty'          => $value->col_5
					];

					if ($this->M_Hospital->InsertData('h_treatment_details', $myArray)) {
						
						$this->M_Hospital->DeleteData('h_temp', array('id' => $value->id));
					}

				}

				redirect('patient/all','refresh');

				
			}else{
				$Data = [
					'active' => 'Patient',
		    	    'load'   => 'web-hospital/patient/all-feature',
		    	    'script' => 'web-hospital/patient/all-feature-js',
		    	    'Doctor'  => $this->M_Hospital->GetTable('h_doctor', 'name', 'ASC'),
		    	    'facility'=> $this->M_Hospital->GetTable('h_facility', 'name', 'DESC'),
		    	    'Dept'    => $this->M_Hospital->GetTable('h_dept', 'dept_id', 'DESC'),
		    	    'Users'   => $this->M_Hospital->GetTable('users', 'name', 'ASC'),
		    	    'Patient' => $this->M_Hospital->GetTable('h_patient', 'patient_id', 'DESC')
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);

		    	/*if (isset($this->uri->segment(5))) {
		    		
		    		$myKeys   = array_keys($_POST);
		    		$myValues = array_values($_POST);

		    		foreach ($_POST as $key => $value) {
		    			
		    			$myArray[] = $key." = '".$value."'";
		    		}

		    		$myData = implode(',', $myArray);

		    		$LastID = $this->M_Hospital->InsertData('patient_facility', $myData);
		    	}*/
		    }
		}

		public function registation(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$referred_by = $_POST['referred_by']; unset($_POST['referred_by']);

				//echo "<pre>";print_r($_POST);exit();

				if ($_FILES['photo']['name'] != '') {
					
					$config['upload_path']   = './assets/img/patients/';
					$config['allowed_types'] = 'gif|jpg|png';
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

				$id = $this->M_Hospital->InsertData('h_patient', $_POST);

				if ($id < 10) { 
					$code = 'P'.date('Ymd').'00'.$id; 
					$aid  = 'AD'.date('Ymd').'00'.$id; 
				}
				elseif ($id >= 10 && $id < 100) { 
					$code = 'P'.date('Ymd').'0'.$id; 
					$aid  = 'AD'.date('Ymd').'0'.$id; 
				}
				else{ 
					$code = 'P'.date('Ymd').$id; 
					$aid  = 'AD'.date('Ymd').$id; 
				}

				$array = [
					'id'   => $id,
					'code' => $code,
					'pKey' => 'patient_id',
					'admission_id' => $aid
				];

				if ($this->M_Hospital->UpdateData('h_patient', $array)) {

					$myArray = [
						'patient_id' => $id, 
						'doctor_id'  => $referred_by
					];

					$this->M_Hospital->InsertData('h_treatment', $myArray);

					redirect('patient/indoor/treatment','refresh');
				}

				//redirect('patient/registation','refresh');
			}else{
				$Data = [
					'active' => 'Patient',
		    	    'load'   => 'web-hospital/patient/registation',
		    	    'Doctor'  => $this->M_Hospital->GetTable('h_doctor', 'name', 'ASC'),
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function Patient_list(){
			$Data = [
				'active'  => 'Patient',
	    	    'load'    => 'web-hospital/patient/list',
	    	    'Patient' => $this->M_Hospital->GetTable('h_patient', 'patient_id', 'DESC')
	    	];
	    	$this->load->view('web-hospital/layout/layout', $Data);
		}

		public function discharge_list(){
			$Data = [
				'active'  => 'Patient',
	    	    'load'    => 'web-hospital/patient/discharge-list',
	    	    'Patient' => $this->M_Hospital->GetTable('h_patient', 'patient_id', 'DESC')
	    	];
	    	$this->load->view('web-hospital/layout/layout', $Data);
		}

		public function outdoor_treatment(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				echo "<pre>";print_r($_POST);
			}else{
				$Data = [
					'active'  => 'Patient',
		    	    'load'    => 'web-hospital/patient/outdoor-treatment',
		    	    'Patient' => $this->M_Hospital->GetTable('h_patient', 'name', 'ASC'),
		    	    'Dept'    => $this->M_Hospital->GetTable('h_dept', 'name', 'ASC'),
		    	    'Doctor'  => $this->M_Hospital->GetTable('h_doctor', 'name', 'ASC')
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function indoor_treatment(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				if (isset($_POST['patient-visit'])) {
					$myArray = [
						'patient_id' => $_POST['code'], 
						'agent_id'   => $_POST['agent'], 
						'doctor_id'  => $_POST['referred_by'], 
						'complain'   => $_POST['complain'], 
						'bill_no'    => $_POST['bill_no']
					];

					$this->M_Hospital->InsertData('h_treatment', $myArray);

					redirect('patient/indoor/treatment','refresh');

				}elseif (isset($_POST['bed-allot'])) {

					$myArray = [
						'treatment_id' => $_POST['treatment'],
						'mat_name'     => 'Bed',
						'mat_id'       => $_POST['bed_id'],
						'qty'          => 1
					];
					
					$_POST['allotment_date'] = date('Y-m-d', strtotime($_POST['allotment_date']));
					$_POST['id'] = $_POST['treatment']; $_POST['pKey'] = 'treatment_id';

					unset($_POST['treatment'], $_POST['bed-allot']);

					if ($this->M_Hospital->UpdateData('h_treatment', $_POST)) {
						$this->M_Hospital->InsertData('h_treatment_details', $myArray);
					}

					redirect('patient/indoor/treatment','refresh');
				}else{
					echo "Error";
				}
			}else{

				$Data = [
					'active'  => 'Patient',
		    	    'load'    => 'web-hospital/patient/indoor-treatment',
		    	    'script'  => 'web-hospital/patient/patient-js',
		    	    'Patient' => $this->M_Hospital->GetTable('h_patient', 'name', 'ASC'),
		    	    'Doctor'  => $this->M_Hospital->GetTable('h_doctor', 'name', 'ASC'),
		    	    'Dept'    => $this->M_Hospital->GetTable('h_dept', 'dept_id', 'DESC'),
		    	    'BedAlot' => $this->M_Hospital->GetArray('h_treatment', array('bed_id' => Null))
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function quick_bill(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				echo "<pre>";print_r($_POST);
			}else{
				$Data = [
					'active'  => 'Patient',
		    	    'load'    => 'web-hospital/patient/quick-bill',
		    	    'script'  => 'web-hospital/patient/patient-js',
		    	    'Patient' => $this->M_Hospital->GetArray('h_treatment', array('quick_bill' => Null)),
		    	    'facility'=> $this->M_Hospital->GetTable('h_facility', 'name', 'DESC'),
		    	    'Bed'     => $this->M_Hospital->GetTable('h_bed', 'bed_id', 'DESC')
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function payment_receive(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				//$_POST['pay_date'] = date('Y-m-d', strtotime($_POST['pay_date']));

				unset($_POST['bill_no'], $_POST['total_amt'], $_POST['total_paid']);

				if ($this->M_Hospital->InsertData('h_payment', $_POST)) {
					$this->session->set_flashdata('added', 'value');
				}else{
					$this->session->set_flashdata('error', 'value');
				}

				redirect('patient/indoor/payment-receive','refresh');

			}else{

				$Data = [
					'active'  => 'Patient',
		    	    'load'    => 'web-hospital/patient/payment-receive',
		    	    'script'  => 'web-hospital/patient/patient-js',
		    	    'Patient' => $this->M_Hospital->GetArray('h_treatment', array('quick_bill' => Null)),
		    	    'Payment' => $this->M_Hospital->GetTable('h_payment', 'added_on', 'DESC')
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function patient_discharge(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$myArray = [
					'id'       => $_POST['treatment_id'],
					'pKey'     => 'treatment_id',
					'relation' => $_POST['relation'],
					'relative' => $_POST['relative'],
					'advice'   => $_POST['advice'],
					'discharge_on' => date('Y-m-d')
				];

				$this->M_Hospital->UpdateData('h_treatment', $myArray);
				$this->session->set_flashdata('added', 'patient discharged...!!');
				redirect('patient/indoor/discharge','refresh');

			}else{
				$Data = [
					'active'  => 'Patient',
		    	    'load'    => 'web-hospital/patient/patient-discharge',
		    	    'script'  => 'web-hospital/patient/patient-js',
		    	    //'Patient' => $this->M_Hospital->GetTable('h_patient', 'name', 'ASC')
		    	    'Patient' => $this->M_Hospital->GetArray('h_treatment', array('quick_bill' => Null))
		    	];
		    	$this->load->view('web-hospital/layout/layout', $Data);
			}
		}

		public function patientDischarge(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$tmpArray = explode('&', $_POST['formData']);

				for ($i = 0; $i < count($tmpArray); $i++) { 
					$tmp = explode('=', $tmpArray[$i]);
					$myArray[$tmp[0]] = $tmp[1];
				}$myArray['remarks'] = str_replace('%20', ' ', $myArray['remarks']);

				$Data1 = [
					'id'       => $myArray['pid'],
					'pKey'     => 'treatment_id',
					'quick_bill'   => 'Out',
					'discount_typ' => $myArray['distype'],
					'discount'     => $myArray['disval'],
					'discharge_on' => date('Y-m-d')
				];

				$Data2 = [
					'id'       => $myArray['pid'],
					'pKey'     => 'patient_id',
					'status'   => 'Discharge'
				];

				//exit(json_encode($Data1));

				$this->M_Hospital->UpdateData('h_treatment', $Data1);
				
				$this->M_Hospital->UpdateData('h_patient', $Data2);

				exit(json_encode('Success'));

			}
		}

		public function print_bill() {

			$tID = $this->uri->segment(4);
			$title = explode('-', $this->uri->segment(3));

			$Data = $disTyp = ''; $total = $payTotal = $aftDes = 0;
			
			$Treatment = $this->M_Hospital->GetWhere('h_treatment', array('treatment_id' => $tID));
			$Patient   = $this->my_library->GetRow('h_patient', array('patient_id' => $tID));

			$Data .= '
				<tr><td style="width: 80%">Admission Fee</td>
				<td style="width: 20%" align="right">'.number_format((float)$Patient->admissionfee, 2, '.', '').'</td></tr>

				<tr><td style="width: 80%">'.$Patient->bed_type.'</td>
				<td style="width: 20%" align="right">'.number_format((float)($Patient->bedrent * $Patient->staydays), 2, '.', '').'</td>
				</tr>
			';

			$total += ($Patient->admissionfee + ($Patient->bedrent * $Patient->staydays));

			$AID = $this->M_Hospital->GetArray('patient_facility_amt', array('patient' => $tID));

			foreach ($AID as $key => $aidObject) {
				$total += $aidObject->amount;
				$PFID = $this->M_Hospital->GetArray('patient_facility', array('aid' => $aidObject->id));
				$OFID = $this->M_Hospital->GetArray('other_facility', array('aid' => $aidObject->id));

				$Cat  = $this->my_library->GetParam('facility_catg', 'category', array('cat_id' => $PFID[0]->category));
				$sCat = $this->my_library->GetParam('facility_subcatg', 'subcategory', array('subcat_id' => $PFID[0]->subcategory));

				$Data .= '<tr><td colspan="2" align="center"><strong>'.$Cat.'</strong></td></tr>';
				
				foreach ($PFID as $key => $pfidObject) 
					$Data .= '
						<tr><td style="width: 80%">'.$pfidObject->particular.'</td>
						<td align="right" style="width: 20%">'.number_format((float)$pfidObject->amount, 2, '.', '').'</td></tr>
					';

				foreach ($OFID as $key => $ofidObject) {
					$total += $AMT = ($ofidObject->amount * $ofidObject->qty);
					if($ofidObject->type == 'Doctor') $Dr = 'Special Call on Doctor ('.$ofidObject->name.')';
					else if($ofidObject->type == 'Asst. Doctor') $Dr = 'Ass. Doctor ('.$ofidObject->name.')';
					else $Dr = $ofidObject->type.' ('.$ofidObject->name.')';
					// <tr><td style="width: 80%">'.$ofidObject->name.'</td>
					$Data .= '
						<tr><td style="width: 80%">'.$Dr.'</td>
						<td align="right" style="width: 20%">'.number_format((float)$AMT, 2, '.', '').'</td></tr>
					';
				}
				
			}

			$OthFclt = $this->M_Hospital->GetArray('other_facility', array('pid' => $tID, 'aid' => NULL));
			if (count($OthFclt)) {
				foreach ($OthFclt as $key => $value) {

					$total += $value->amount;
					$Data .= '
						<tr><td style="width: 80%">'.$value->type.' ( '.$value->name.' )</td>
						<td align="right" style="width: 20%">'.number_format((float)$value->amount, 2, '.', '').'</td></tr>
					';
				}
			}
			$AdvPay = $this->my_library->GetRow('h_payment', array('pay_type' => 'Advance', 'treatment_id' => $Patient->patient_id));

			$pay_amt = $this->M_Hospital->GetSum('h_payment', 'pay_amt', array('treatment_id' => $tID));
			if ($Treatment->discount_typ) {
				if ($Treatment->discount_typ == 'Amount') {
					$aftDes = $Treatment->discount;
					$disTyp = ' (Amt.)';

				}elseif ($Treatment->discount_typ == 'Percentage') {
					$aftDes = (($total * $Treatment->discount) / 100);
					$disTyp = ' ('.$Treatment->discount.'%)';
				}elseif ($Treatment->discount_typ == 'Refund') {
					$Refund = $Treatment->discount;
				}
			}

			$dueAmt = $total - ($aftDes + $pay_amt);

			$sendData = [
				'Data'     => $Data,
				'pName'    => $Patient->name,
				'RefundAmt'=> $Patient->refund_amt,
				'dName'    => $this->my_library->GetParam('h_doctor', 'name', array('doctor_id' => $Treatment->doctor_id)),
				'pCode'    => $Patient->code,
				'sDays'    => $Patient->staydays,
				'pAID'     => $Patient->admission_id,
				'aDate'    => date('d-M-Y', strtotime($Treatment->allotment_date)),
				'paytotal' => number_format((float)$payTotal, 2, '.', ''),
				'total'    => number_format((float)$total, 2, '.', ''),
				'disTyp'   => $disTyp,
				'disAmt'   => number_format((float)$aftDes, 2, '.', ''),
				'Refund'   => number_format((float)$Refund, 2, '.', ''),
				'AdvPay'   => number_format((float)$AdvPay->pay_amt, 2, '.', ''),
				'AdvID'    => '('.date('Ymd', strtotime($AdvPay->pay_date)).'/'.sprintf("%03d", $AdvPay->pay_id).')',
				'paidAmt'  => number_format((float)$pay_amt, 2, '.', ''),
				'balAmt'   => number_format((float)$dueAmt, 2, '.', ''),
				'roundAmt' => number_format((float)round($dueAmt), 2, '.', ''),
				'billType' => ucfirst($title[0]).' '.ucfirst($title[1]),
			];

			$html = $this->load->view('web-hospital/patient/provisional-invoice', $sendData, True);
			$pdf  = new Mpdf();

            $pdf->SetDisplayMode('real', 'default');
            $pdf->SetPrintHeader(false);

		    $pdf->AddPage();
		    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

		    while (ob_get_level()) ob_end_clean();
		    $pdf->Output('print-bill.pdf', 'I');

		}
		public function GetTotalAmount($tID){

			$Treatment = $this->M_Hospital->GetWhere('h_treatment', array('treatment_id' => $tID));
			$tDetails  = $this->M_Hospital->GetArray('h_treatment_details', array('treatment_id' => $tID));
			$Patient   = $this->my_library->GetRow('h_patient', array('patient_id' => $Treatment->patient_id));

			$prevDay  = date('Y-m-d', strtotime('-1 day', strtotime($Treatment->allotment_date)));
			$interval = date_diff(date_create($prevDay), date_create(date('Y-m-d')));

			$total = 0;

			foreach ($tDetails as $key => $value) {
				if($value->mat_name == 'Bed'){
					$cost  = $this->my_library->GetParam('h_bed', 'cost', array('bed_id' => $value->mat_id));
					$total += $interval->format("%a") * $cost;
				}else{
					$Col = ($value->type == 'Beneficiaries') ? 'beneficiaries' : 'nonbeneficiaries';

					$cost = $this->my_library->GetParam('h_facility', $Col, array('facility_id' => $value->mat_id));
					$total += ($value->qty * $cost);
				}
			}

			return $total;
		}


		public function ticket() {

	    	$Data = [
	    	    'load'   => 'web-hospital/patient/ticket',
	    	    'script' => 'web-hospital/patient/treatment-js',
	    	    'tData'  => $this->M_Hospital->GetWhere('h_patient', array('patient_id' => $this->uri->segment(3)))
	    	];
	    	$this->load->view('web-hospital/layout/layout', $Data);
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

	  public function getOutDoorFacility(){

			$id  = $_POST['CatID'];
			$Fac = $this->M_Hospital->GetArray('outdoor_facility', array('g_code' => $id));

			$Data = '<option value="" hidden="true">Select Particular</option>';
            foreach ($Fac as $key => $value) {
                $Data .= '<option value="'.$value->od_facilit_id.'">'.$value->facilit_name.'</option>';
            }

            exit(json_encode($Data));
		}



	}
?>