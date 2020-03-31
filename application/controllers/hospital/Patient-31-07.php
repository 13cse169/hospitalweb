<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 	* Patient
	*/
	class Patient extends MY_Controller {
		
		public function __construct() {
			parent::__construct();
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

		public function print_bill() {

			$tID = $this->uri->segment(4);
			$title = explode('-', $this->uri->segment(3));

			if ($title[0] == 'final') {
				$updateArray = [
					'id'         => $tID,
					'pKey'       => 'treatment_id',
					'quick_bill' => 'Out'
				];
				$this->M_Hospital->UpdateData('h_treatment', $updateArray);
			}

			$tDetails = $this->M_Hospital->RunQuery("SELECT pay_amt AS mat_name, voucher AS mat_id, pay_date AS qty, added_on FROM h_payment WHERE treatment_id = '$tID' UNION SELECT mat_name, mat_id, qty, added_on FROM h_treatment_details WHERE treatment_id = '$tID' ORDER BY added_on ASC");

			//echo'<pre>';print_r($Payment);exit();

			$Treatment = $this->M_Hospital->GetWhere('h_treatment', array('treatment_id' => $tID));
			$Patient   = $this->my_library->GetRow('h_patient', array('patient_id' => $Treatment->patient_id));

			$prevDay  = date('Y-m-d', strtotime('-1 day', strtotime($Treatment->allotment_date)));
			$interval = date_diff(date_create($prevDay), date_create(date('Y-m-d')));

			$Data = $disTyp = ''; $total = $payTotal = $aftDes = 0;

			//$tDetails  = $this->M_Hospital->GetArray('h_treatment_details', array('treatment_id' => $tID));
			foreach ($tDetails as $key => $value) {
				if($value->mat_name == 'Bed'){
					$BedD = $this->my_library->GetRow('h_bed', array('bed_id' => $value->mat_id));
					$tmp  = number_format((float)($interval->format("%a") * $BedD->cost), 2, '.', '');
					$total += $tmp;

					$Data .= '
						<tr>
							<td>'.date('d-M-y', strtotime($value->added_on)).'</td>
							<td>Bed Charge</td>
							<td align="right">'.number_format((float)$BedD->cost, 2, '.', '').'</td>
							<td align="right">'.$value->qty.'</td>
							<td align="right">1</td>
							<td align="right">--</td>
							<td align="right">'.$tmp.'</td>
						</tr>
					';
				}elseif($value->mat_name == 'Particular'){
					$FacD = $this->my_library->GetRow('h_facility', array('facility_id' => $value->mat_id));
					$tmp  = number_format((float)($value->qty * $FacD->rate), 2, '.', '');
					$total += $tmp;

					$Data .= '
						<tr>
							<td>'.date('d-M-y', strtotime($value->added_on)).'</td>
							<td>'.$FacD->name.'</td>
							<td align="right">'.number_format((float)$FacD->rate, 2, '.', '').'</td>
							<td align="right">'.$value->qty.'</td>
							<td align="right">'.$FacD->unit.'</td>
							<td align="right">--</td>
							<td align="right">'.$tmp.'</td>
						</tr>
					';
				}else{
					$payTotal += $value->mat_name;
					$Data .= '
						<tr class="rounded">
							<td>'.date('d-M-y', strtotime($value->added_on)).'</td>
							<td>Payment</td>
							<td align="right">--</td>
							<td align="right">--</td>
							<td align="right">--</td>
							<td align="right">'.number_format((float)$value->mat_name, 2, '.', '').'</td>
							<td align="right">--</td>
						</tr>
					';
				}
			}

			$pay_amt = $this->M_Hospital->GetSum('h_payment', 'pay_amt', array('treatment_id' => $tID));
			if ($Treatment->discount_typ) {
				if ($Treatment->discount_typ == 'Amount') {
					$aftDes = $Treatment->discount;
					$disTyp = ' (Amt.)';

				}elseif ($Treatment->discount_typ == 'Percentage') {
					$aftDes = (($total * $Treatment->discount) / 100);
					$disTyp = ' ('.$Treatment->discount.'%)';
				}
			}

			$dueAmt = $total - ($aftDes + $pay_amt);

		   	$html ='
		   		<!DOCTYPE html>
				<html>
					<head>
						<title>Print Bill</title>
						<style type="text/css">
							.h2{ font-weight: 600; font-size: 16px; }
							.h3{ font-weight: 600; font-size: 20px; }
							.h4{ font-weight: 600; font-size: 13px; }
							.rounded{ background-color: #e0e0e0; }
						</style>
					</head>
					<body>
						<table width="100%">
							<tr>
								<td align="center" rowspan="3" width="20%"><img src="'.base_url('assets/img/h-logo.png').'" width="100px"></td>
								<td width="90%" style="padding-right: 80px;"><span class="h2">
									<strong>
										&nbsp;&nbsp;DR. B.C ROY GENERAL HOSPITAL & <br> 
										
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

										MATERNITY HOME
									</strong>
								</span></td>
							</tr>
							<tr>
								<td><span class="h4">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									WEST BENGAL
								</span></td>
							</tr>
							<tr>
								<td><span class="h3">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									'.ucfirst($title[0]).' Bill
								</span></td>
							</tr>
						</table>
						<hr>
						<table width="100%" cellpadding="0" cellspacing="5">
							<tr>
								<td><strong>Bill No.</strong></td>
								<td>: '.$Treatment->bill_no.'</td>
								<td><strong>Bill Date</strong></td>
								<td>: '.date('d-M-Y').'</td>
							</tr>
							<tr>
								<td><strong>Name</strong></td>
								<td colspan="3">: '.$Patient->name.'</td>
							</tr>
							<tr>
								<td><strong>Doctor</strong></td>
								<td>: '.$this->my_library->GetParam('h_doctor', 'name', array('doctor_id' => $Treatment->doctor_id)).'</td>
							</tr>
							<tr>
								<td><strong>Patient ID</strong></td>
								<td>: '.$Patient->code.'</td>
								<td><strong>Stay</strong></td>
								<td>: '.$interval->format("%a").' Days</td>
							</tr>
							<tr>
								<td><strong>Admission ID</strong></td>
								<td>: '.$Patient->admission_id.'</td>
								<td><strong>Admission Date</strong></td>
								<td>: '.date('d-M-Y', strtotime($Patient->added_on)).'</td>
							</tr>
							<tr>
								<td><strong>Department</strong></td>
								<td>: '.$this->my_library->GetParam('h_dept', 'name', array('dept_id' => $Treatment->dept_id)).'</td>
								<td><strong>Ward</strong></td>
								<td>: '.$this->my_library->GetParam('h_ward', 'name', array('ward_id' => $Treatment->ward_id)).'</td>
							</tr>
							<tr>
								<td><strong>Bed</strong></td>
								<td  colspan="3">: '.$this->my_library->GetParam('h_bed', 'name', array('bed_id' => $Treatment->bed_id)).'</td>
							</tr>
						</table>
						<table width="100%" border="1" cellpadding="2" cellspacing="0">
							<tr class="rounded">
								<th><strong>Date</strong></th>
								<th><strong>Charges</strong></th>
								<th><strong>Amount</strong></th>
								<th><strong>Qty</strong></th>
								<th><strong>UOM</strong></th>
								<th><strong>Credit</strong></th>
								<th><strong>Debit</strong></th>
							</tr>
							'.$Data.'
						</table>
						<table width="100%" cellpadding="2" cellspacing="0">
							<tr>
								<td align="right" colspan="4"><strong>Total Amount</strong></td>
								<td align="center">:</td>
								<td align="right">'.number_format((float)$payTotal, 2, '.', '').'</td>
								<td align="right">'.number_format((float)$total, 2, '.', '').'</td>
							</tr>
							<tr>
								<td align="right" colspan="4"><strong>Discount'.$disTyp.'</strong></td>
								<td align="center">:</td>
								<td align="right" colspan="2">'.number_format((float)$aftDes, 2, '.', '').'</td>
							</tr>
							<tr>
								<td align="right" colspan="4"><strong>Paid Amount</strong></td>
								<td align="center">:</td>
								<td align="right" colspan="2">'.number_format((float)$pay_amt, 2, '.', '').'</td>
							</tr>
							<tr>
								<td align="right" colspan="4"><strong>Balance Amount</strong></td>
								<td align="center">:</td>
								<td align="right" colspan="2">'.number_format((float)$dueAmt, 2, '.', '').'</td>
							</tr>
							<tr class="rounded">
								<td align="right" colspan="4"><strong>Round Amount</strong></td>
								<td align="center">:</td>
								<td align="right" colspan="2">'.number_format((float)round($dueAmt), 2, '.', '').'</td>
							</tr>
						</table>
					</body>
				</html>
		   	';

		    $pdf = new Mpdf();
		    $pdf->AddPage();
		    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
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
					$cost = $this->my_library->GetParam('h_facility', 'rate', array('facility_id' => $value->mat_id));
					$total += ($value->qty * $cost);
				}
			}

			return $total;
		}

	}
?>