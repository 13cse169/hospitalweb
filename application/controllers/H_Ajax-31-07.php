<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 	* Hospital Ajax
	*/
	class H_Ajax extends MY_Controller {
		
		public function __construct() {
			parent::__construct();
		}

		public function GetDept(){
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$Data = '<option value="" hidden="true">Select Ward</option>';
				
				$Ward = $this->M_Hospital->GetArray('h_ward', array('dept_id' => $this->input->post('Dept')));

				if ($Ward) {
					foreach ($Ward as $key => $value) {
						$Data .= '<option value="'.$value->ward_id.'">'.$value->name.'</option>';	
					}
				}else{
					$Data .= '<option value="" disabled="true">No Data Found...</option>';	
				}
			
				echo json_encode($Data);

			}
		}

		public function GetBed(){
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$Data = '<option value="" hidden="true">Select Bed</option>';
				
				$Bed = $this->M_Hospital->GetArray('h_bed', array('bed_id' => $this->input->post('Ward')));

				if ($Bed) {
					foreach ($Bed as $key => $value) {
						$Data .= '<option value="'.$value->bed_id.'">'.$value->name.'</option>';	
					}
				}else{
					$Data .= '<option value="" disabled="true">No Data Found...</option>';	
				}
			
				echo json_encode($Data);

			}
		}

		public function GetPatient(){
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$Patient = $this->M_Hospital->GetWhere('h_patient', array('patient_id' => $this->input->post('pid')));

				echo json_encode($Patient);

			}
		}

		public function GetTreatment(){
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$Treatment = $this->M_Hospital->GetWhere('h_treatment', array('treatment_id' => $this->input->post('tid')));


				$discount = $disTyp = ''; $aftDes = 0; $total = $this->GetTotalAmount($_POST['tid']);
				if ($Treatment->discount_typ) {

					$discount = $Treatment->discount;

					if ($Treatment->discount_typ == 'Amount') {
						$aftDes = $discount; $disTyp = 'Amount';

					}elseif ($Treatment->discount_typ == 'Percentage') {
						$aftDes = (($total * $discount) / 100); $disTyp = 'Percentage';
					}
				
				} $dueAmt = ($total - $aftDes);

				$Patient   = $this->my_library->GetRow('h_patient', array('patient_id' => $Treatment->patient_id));
				$Doctor    = $this->my_library->GetRow('h_doctor', array('doctor_id' => $Treatment->doctor_id));
				
				$Dept      = $this->my_library->GetRow('h_dept', array('dept_id' => $Treatment->dept_id));
				$Ward      = $this->my_library->GetRow('h_ward', array('ward_id' => $Treatment->ward_id));
				$Bed       = $this->my_library->GetRow('h_bed', array('bed_id' => $Treatment->bed_id));

				$pay_amt   = $this->M_Hospital->GetSum('h_payment', 'pay_amt', array('treatment_id' => $Treatment->treatment_id));

				$prevDay  = date('Y-m-d', strtotime('-1 day', strtotime($Treatment->allotment_date)));
				$interval = date_diff(date_create($prevDay), date_create(date('Y-m-d')));

				$myArray = [
					'admission_id'   => $Patient->admission_id,
					'admission_date' => date('d-M-Y', strtotime($Patient->added_on)),
					'department'     => $Dept->name,
					'ward'           => $Ward->name,
					'bed'            => $Bed->name,
					'doctor'         => $Doctor->name,
					'length'         => $interval->format("%a Days"),
					'bill_no'        => $Treatment->bill_no,
					'disTyp'         => $disTyp,
					'discount'       => $discount,
					'dueAmt'         => $dueAmt,
					'rounddueAmt'    => round($dueAmt),
					'DueReport'      => ($pay_amt == $dueAmt)?'Yes':'No'
				];

				$tDetails1 = $this->M_Hospital->GetArray('h_treatment_details', array('treatment_id' => $Treatment->treatment_id));
				$Data1 = '';
				foreach ($tDetails1 as $key => $value) {
					if($value->mat_name == 'Bed'){
						$BedD = $this->my_library->GetRow('h_bed', array('bed_id' => $value->mat_id));

						$Data1 .= '
							<tr>
								<td>Bed [ '.$BedD->name.' ]</td>
								<td>'.$BedD->cost.'</td>
								<td>1</td>
								<td>--</td>
								<td class="tableTotal">'.($interval->format("%a") * $BedD->cost).'</td>
								<td>'.date('d-M-Y', strtotime($value->added_on)).'</td>
								<td>--</td>
							</tr>
						';
					}else{
						$FacD = $this->my_library->GetRow('h_facility', array('facility_id' => $value->mat_id));

						$Data1 .= '
							<tr>
								<td>'.$FacD->name.'</td>
								<td>'.$FacD->rate.'</td>
								<td>'.$value->qty.'</td>
								<td>'.$FacD->unit.'</td>
								<td class="tableTotal">'.($value->qty * $FacD->rate).'</td>
								<td>'.date('d-M-Y', strtotime($value->added_on)).'</td>
								<td>--</td>
							</tr>
						';
					}
				}

				$tDetails2 = $this->M_Hospital->GetArray('h_temp', array('col_1' => $Treatment->treatment_id));
				$Data2 = '';
				foreach ($tDetails2 as $key => $value) {
					
					$FacD = $this->my_library->GetRow('h_facility', array('facility_id' => $value->col_2));

					$Data1 .= '
						<tr class=temp-'.$value->id.'>
							<td>'.$FacD->name.'</td>
							<td>'.$FacD->rate.'</td>
							<td>'.$value->col_3.'</td>
							<td>'.$FacD->unit.'</td>
							<td class="tableTotal">'.($value->col_3 * $FacD->rate).'</td>
							<td>'.date('d-M-Y', strtotime($value->added_on)).'</td>
							<td>
								<button class="btn btn-outline-danger remove-particular btn-pill">
									<i class="fas fa-times"></i>
								</button>
							</td>
						</tr>
					';
				}

				$myArray['facility_data'] = $Data1;

				echo json_encode($myArray);

			}
		}

		public function PostParticular(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$variable = explode('&', $_POST['Data']);
				foreach ($variable as $key => $value) { $Data = explode('=', $value); $myArray[$Data[0]] = $Data[1]; }

				$myArray['uom'] = str_replace('%20', ' ', $myArray['uom']);

				if ($myArray['particular']) {

					$tmp   = [ 'col_1' => $_POST['tID'], 'col_2' => $myArray['particular'], 'col_3' => $myArray['quantity'] ];
					$rowID = $this->M_Hospital->InsertData('h_temp', $tmp);
					
					$facility = $this->my_library->GetParam('h_facility', 'name', array('facility_id' => $myArray['particular']));
					$Data = '
						<tr class=temp-'.$rowID.'>
							<td>'.$facility.'</td>
							<td>'.$myArray['amount'].'</td>
							<td>'.$myArray['quantity'].'</td>
							<td>'.$myArray['uom'].'</td>
							<td class="tableTotal">'.$myArray['particular_total'].'</td>
							<td>'.date('d-M-Y').'</td>
							<td>
								<button class="btn btn-outline-danger remove-particular btn-pill">
									<i class="fas fa-times"></i>
								</button>
							</td>
						</tr>
					';
					
					echo json_encode($Data);
				}
			}
		}

		public function RemoveParticular(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$tmp = explode('-', $_POST['tID']);

				if ($tmp[0] == 'temp') {
					
					if ($this->M_Hospital->DeleteData('h_temp', array('id' => $tmp[1])))
						echo json_encode('Deleted');
						
				}

			}
		}

		public function ConfirmParticular(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$tDetails = $this->M_Hospital->GetArray('h_temp', array('col_1' => $_POST['tID']));
				foreach ($tDetails as $key => $value) {
					
					$myArray = [
						'treatment_id' => $value->col_1, 
						'mat_name'     => 'Particular',
						'mat_id'       => $value->col_2,
						'qty'          => $value->col_3
					];

					if ($this->M_Hospital->InsertData('h_treatment_details', $myArray)) {
						
						$this->M_Hospital->DeleteData('h_temp', array('id' => $value->id));
					}

				}

				$myArray = [ 
					'discount_typ' => $_POST['dTyp'], 
					'discount'     => $_POST['dAmt'],
					'pKey'         => 'treatment_id',
					'id'     => $_POST['tID']
				];

				$this->M_Hospital->UpdateData('h_treatment', $myArray);

				echo json_encode('Done');
			}
		}

		public function GetPatientAmount(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$tID = $_POST['tID'];

				$Treatment = $this->M_Hospital->GetWhere('h_treatment', array('treatment_id' => $tID));
				$Patient   = $this->my_library->GetRow('h_patient', array('patient_id' => $Treatment->patient_id));
				$pay_amt   = $this->M_Hospital->GetSum('h_payment', 'pay_amt', array('treatment_id' => $tID));

				if (! $pay_amt) $pay_amt = 0;

				$myArray = [
					'patient_code' => $Patient->code,
					'admission_id' => $Patient->admission_id,
					'patient_name' => $Patient->name,
					'bill_no'      => $Treatment->bill_no,
					'pay_date'     => date('d-m-Y'),
					'total_paid'   => $pay_amt,
					'total_amt'    => number_format((float)$this->GetTotalAmount($tID), 2, '.', '')
				];
				echo json_encode($myArray);
			}
		}

		public function DischargePatient(){
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') { extract($_POST);
				$tID = $_POST['tID'];

				$pay_amt = $this->M_Hospital->GetSum('h_payment', 'pay_amt', array('treatment_id' => $tID));
				$ttl_amt = $this->GetTotalAmount($tID);

				if ( ($ttl_amt - $pay_amt) > 0) echo json_encode('Due');
				else{
					$Treatment = $this->M_Hospital->GetWhere('h_treatment', array('treatment_id' => $tID));
					$Patient   = $this->my_library->GetRow('h_patient', array('patient_id' => $Treatment->patient_id));
					
					$myArray = [
						'admission_id' => $Patient->admission_id,
						'name'         => $Patient->name,
						'phone'        => $Patient->phone,
						'added_on'     => $Patient->added_on,
						'age'          => $Patient->age.' '.$Patient->age2,
						'gender'       => $Patient->gender,
						'relative'     => $Patient->relative,
						'relation'     => $Patient->relation,
						'dept'         => $this->my_library->GetParam('h_dept', 'name', array('dept_id' => $Treatment->dept_id)),
						'ward'         => $this->my_library->GetParam('h_ward', 'name', array('ward_id' => $Treatment->ward_id)),
						'bed'          => $this->my_library->GetParam('h_bed', 'name', array('bed_id' => $Treatment->bed_id))
					];

					echo json_encode($myArray);
				}

			}
		}

		public function GetTableRow(){
			
			if ($_SERVER['REQUEST_METHOD'] == 'POST') { extract($_POST);

				echo json_encode($this->M_Hospital->GetWhere($TableName, array($ColumnName => $Key)));

			}
		}

		public function GetDataAmount(){
			if ($this->input->server('REQUEST_METHOD') == 'POST')
				echo "POST REQUEST";
			else
				echo "GET REQUEST";


		}

		public function UserDefine(){
			
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