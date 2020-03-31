<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 	* Hospital Ajax
	*/
	class H_Ajax extends MY_Controller {
		
		public function __construct() {
			parent::__construct();
		}

		public function GetEmergencyPatient(){ extract($_POST);

			$Patient   = $this->M_Hospital->GetWhere('h_patient', array('patient_id' => $PID));
			$Treatment = $this->M_Hospital->GetWhere('h_treatment', array('patient_id' => $PID));
			$Facility  = $this->M_Hospital->GetArray('other_facility', array('pid' => $PID));
			$Treatment->allotment_date = date('d-m-Y', strtotime($Treatment->allotment_date));
			$count = 0;$Row = '';
			foreach ($Facility as $key => $value) {
				$Row .='<tr><td>'.++$count.'</td><td>'.$value->type.'</td><td>'.$value->name.'</td><td>'.date('d-M-y', strtotime($value->created_at)).'</td><td>'.number_format((float)$value->amount, 2, '.', '').'</td></tr>';
			}
			exit(json_encode(array($Patient, $Treatment, $Row)));
		}

		public function GetOutdoorFclty(){ extract($_POST);

            $Res = $this->M_Hospital->GetArray('outdoor_facility', array('g_code' => $Cat));
			
			$Data = '
				<div class="form-group">
                    <label class="form-label">Select Facility <span class="text-danger">*</span></label>
                    <select class="form-control OtherFacilityItem">
                        <option value="" hidden="true">Select Facility Test</option>';
                        foreach ($Res as $key => $value){
                        	$amt = ($pType == 'NB') ? $value->rate_nb : $value->rate_b;
                        	$Data .= '<option value="'.$value->facilit_name.'" amt="'.$amt.'">'.$value->facilit_name.'</option>';	
                        } 
                    $Data .= '</select>
                </div>
            ';

            exit(json_encode($Data));
		}

		public function GetPathologyTest(){ extract($_POST);

			$Option = '<option value="" hidden="true">Select Test</option>';

			if ($Type == 'All') {
				$Data = $this->M_Hospital->GetTable('pathology', 'testname', 'ASC');
				$HistoData = $this->M_Hospital->GetArray('outdoor_facility', array('g_code' => 'G00013'));

				foreach ($HistoData as $key => $value) {
					$Amt    = ($pType == 'B') ? $value->rate_b : $value->rate_nb;
					$Option .= '<option value="'.$value->facilit_name.'" amt="'.$Amt.'">'.$value->facilit_name.'</option>';
				}
			}
			
			else if ($Type == 'G00013')  $Data = $this->M_Hospital->GetArray('outdoor_facility', array('g_code' => $Type));
			else $Data   = $this->M_Hospital->GetArray('pathology', array('type' => $Type));

			foreach ($Data as $key => $value) {
				
				if ($Type == 'G00013'){
					$Amt    = ($pType == 'B') ? $value->rate_b : $value->rate_nb;
					$Option .= '<option value="'.$value->facilit_name.'" amt="'.$Amt.'">'.$value->facilit_name.'</option>';
				}
				else{
					$Amt    = ($pType == 'B') ? $value->beneficiaries : $value->nonbeneficiaries;
					$Option .= '<option value="'.$value->testname.'" amt="'.$Amt.'">'.$value->testname.'</option>';
				}

			}
			$Html = '
				<div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Select Test <span class="text-danger">*</span></label>
                            <select class="form-control PathologyTestName" name="PathologyTestName[]">'.$Option.'</select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Test Amount</label>
                        <input type="number" name="TestAmount[]" class="form-control TestAmount">
                    </div>
                    <div class="col-md-4 text-center">
                        <label class="form-label">&nbsp;</label>
                        <span href="#" class="btn btn-outline-primary PathologyBtn AddPathology"><i class="fas fa-plus"></i></span>
                    </div>
                </div>
			';
			exit(json_encode($Html));
		}

		public function GetPathologyType(){
			$Type = $this->M_Hospital->RunQuery("SELECT type FROM pathology GROUP BY type ORDER BY type ASC");
			$Data = '
				<div class="form-group">
                    <label class="form-label">Select Pathology Test <span class="text-danger">*</span></label>
                    <select class="form-control PathologyTest">
                        <option value="" hidden="true">Select Pathology Test</option>
                        <option value="All">All</option>
                        <option value="G00013">HISTOPATHOLOGY</option>';
                        foreach ($Type as $key => $value) $Data .= '<option value="'.$value->type.'">'.$value->type.'</option>';
                    $Data .= '</select>
                </div>
            ';
            exit(json_encode($Data));
		}

		public function GetSalineData(){
			exit(json_encode($this->my_library->GetRow('saline_master', array('id' => $_POST['sID']))));
		}

		public function GetSaline(){
			$Data = '<option value="" hidden="true">Select Saline</option>';
			$Saline = $this->M_Hospital->GetArray('saline_master', array('category' => $_POST['Cat']));
			foreach ($Saline as $key => $value) $Data .= '<option value="'.$value->id.'">'.$value->name.'</option>';
			exit(json_encode($Data));
		
		}

		public function OtherFacility(){ extract($_POST);
			if ($Category == 'Doctor') {
				
				$Data = explode('&', $Data);
				foreach ($Data as $key => $value) { $tmp = explode('=', $value); $DataArray[$tmp[0]] = $tmp[1]; }
				$DataArray['doctor_name']   = str_replace('%20', ' ', $DataArray['doctor_name']);
				$DataArray['a_doctor_name'] = str_replace('%20', ' ', $DataArray['a_doctor_name']);

				extract($DataArray);
				$myArray = array(
					array('pid' => $pID, 'type' => 'Doctor', 'name' => $doctor_name, 'amount' => $doctor_fees, 'qty' => $visitno),
					array('pid' => $pID, 'type' => 'Asst. Doctor', 'name' => $a_doctor_name, 'amount' => $a_doctor_fees, 'qty' => $a_visitno)
				);
				$this->M_Hospital->InsertBatch('other_facility', $myArray);
				$Html = '
					<tr>
						<td>Special Doctor</td> <td>'.$doctor_name.'</td> <td>'.($doctor_fees * $visitno).'</td>
						<td>'.date('d-M-Y').'</td> <td>--</td>
					</tr>
					<tr>
						<td>Asst. Doctor</td> <td>'.$a_doctor_name.'</td> <td>'.($a_doctor_fees * $a_visitno).'</td>
						<td>'.date('d-M-Y').'</td> <td>--</td>
					</tr>
				';

				exit(json_encode(array('Category' => $Category, 'Data' => $Html)));
			}else if ($Category == 'Pathology') {
				$Html = '';
				for ($i = 0; $i < count($Data[0]); $i++) { 
					// $myArray[] = array('pid' => $pID, 'type' => $Data[2], 'name' => $Data[0][$i], 'amount' => $Data[1][$i]);
					$myArray[] = array('pid' => $pID, 'type' => 'PATHOLOGY TEST', 'name' => $Data[0][$i], 'amount' => $Data[1][$i]);
					$Html .= '
						<tr>
							<td>'.$Data[2].'</td> <td>'.$Data[0][$i].'</td> <td>'.$Data[1][$i].'</td>
							<td>'.date('d-M-Y').'</td> <td>--</td>
						</tr>
					';
				}
				$this->M_Hospital->InsertBatch('other_facility', $myArray);
				exit(json_encode(array('Category' => $Category, 'Data' => $Html)));
			}else{
				$Type = $this->my_library->GetParam('outdoor_facility_group', 'group_name', array('g_code' => $Category));
				$myArray = array('pid' => $pID, 'type' => $Type, 'name' => $Data[1], 'amount' => $Data[2]);

				$Html = '
					<tr>
						<td>'.$Type.'</td> <td>'.$Data[1].'</td> <td>'.$Data[2].'</td>
						<td>'.date('d-M-Y').'</td> <td>--</td>
					</tr>
				';

				$this->M_Hospital->InsertData('other_facility', $myArray);
				exit(json_encode(array('Category' => $Category, 'Data' => $Html)));
			}
		}

		public function getAmountReport(){

			$Data = explode('&', $_POST['Data']);
			foreach ($Data as $key => $value) { $tmp = explode('=', $value); $Date[] = date('Y-m-d', strtotime($tmp[1])); }
			$fDate = $Date[0]; $tDate = $Date[1];

			$SQL = "SELECT * FROM h_payment WHERE pay_date >= '$fDate' AND pay_date <= '$tDate'";
			$Res = $this->M_Hospital->RunQuery($SQL);

			$Data = ''; $count = $total = 0;
			foreach ($Res as $key => $value) {
				$total += $value->pay_amt;
				$Data .= '
					<tr>
						<td>'.++$count.'.</td>
						<td>'.date('d-M-Y', strtotime($value->pay_date)).'</td>
						<td>'.$value->patient_code.'</td>
						<td>'.$value->patient_name.'</td>
						<td>'.$value->pay_mode.'</td>
						<td>--</td>
						<td align="right">'.number_format((float)$value->pay_amt, 2, '.', '').'</td>
					</tr>
				';
			}
			$Data .= '
				<tr class="bg-info text-white">
				    <td>'.++$count.'.</td>
				    <td></td><td></td>
				    <td><strong>Total Paid Amount</strong></td>
				    <td></td><td></td>
				    <td align="right">'.number_format((float)$total, 2, '.', '').'</td>
				</tr>
			';

			echo json_encode($Data);
		}

		public function all_patient_details(){

			//$pid =7;

			$pid = $_POST['pid'];

			$Patient = $this->M_Hospital->GetWhere('h_patient', array('patient_id' => $pid));

			$prevDay  = date('Y-m-d', strtotime('-1 day', strtotime($Patient->added_on)));
			$interval = date_diff(date_create($prevDay), date_create(date('Y-m-d')));

			$Treatment = $this->my_library->GetRow('h_treatment', array('patient_id' => $pid));

			$Data1 = '
				<tr>
					<td>--</td>
					<td>Admission Fee</td>
					<td>'.$Patient->admissionfee.'</td>
					<td>'.date('d-m-Y', strtotime($Treatment->allotment_date)).'</td>
					<td>--</td>
				</tr>
				<tr>
					<td>--</td>
					<td>'.$Patient->bed_type.'</td>
					<td>'.($Patient->bedrent * $Patient->staydays).'</td>
					<td>'.date('d-m-Y', strtotime($Treatment->allotment_date)).'</td>
					<td>--</td>
				</tr>
			';

			$fAmt = $this->M_Hospital->GetArray('patient_facility_amt', array('patient' => $pid));
			foreach ($fAmt as $key => $value) {

				$pFac   = $this->M_Hospital->RunQuery("SELECT * FROM patient_facility WHERE aid = ".$value->id." LIMIT 1");
				$Cat    = $this->my_library->GetParam('facility_catg', 'category', array('cat_id' => $pFac[0]->category));
				$subCat = $this->my_library->GetParam('facility_subcatg', 'subcategory', array('subcat_id' => $pFac[0]->subcategory));

				$Data1 .= '
					<tr>
						<td>'.$Cat.'</td>
						<td>'.$subCat.'</td>
						<td>'.$value->amount.'</td>
						<td>'.date('d-m-Y', strtotime($value->created_at)).'</td>
						<td>--</td>
					</tr>
				';	
			}

			$OthFclty = $this->M_Hospital->GetArray('other_facility', array('pid' => $pid));
			foreach ($OthFclty as $key => $value) {
				$Data1 .= '
					<tr>
						<td>'.$value->type.'</td>
						<td>'.$value->name.'</td>
						<td>'.($value->amount * $value->qty).'</td>
						<td>'.date('d-m-Y', strtotime($value->created_at)).'</td>
						<td>--</td>
					</tr>
				';	
			}
			

			$Patient->facility_data = $Data1;

			$pay_amt = $this->M_Hospital->GetSum('h_payment', 'pay_amt', array('treatment_id' => $Treatment->treatment_id));
			$Patient->accTotal = number_format((float)$this->my_library->GetAmount($pid), 2, '.', '');
			$Patient->accPaid  = number_format((float)$pay_amt, 2, '.', '');
			if ($Patient->accTotal > $Patient->accPaid) { $Due = $Patient->accTotal - $Patient->accPaid; }else{ $Due = 0; }
			$Patient->accDue   = number_format((float)$Due, 2, '.', '');

			$Patient->referred_by = $Treatment->doctor_id;
			$Patient->dept_id     = $Treatment->dept_id;
			$Patient->allotment_date = ($Treatment->allotment_date == '') ? date('d-m-Y'):date('d-m-Y',strtotime($Treatment->allotment_date));
			$Patient->allotment_time = ($Treatment->allotment_time == '') ? date('H:i'):$Treatment->allotment_time;

			$WardDetails = $this->M_Hospital->GetArray('h_ward', array('dept_id' => $Treatment->dept_id));
			$ward = '';
			foreach ($WardDetails as $key => $value) {
				if ($Treatment->ward_id == $value->ward_id) {
					$ward .= '<option value="'.$value->ward_id.'" selected>'.$value->name.'</option>';
				} else {
					$ward .= '<option value="'.$value->ward_id.'">'.$value->name.'</option>';
				}
				
			}$Patient->ward = $ward;

			$BedDetails = $this->M_Hospital->GetArray('h_bed', array('ward_id' => $Treatment->ward_id));
			$bed = '';
			foreach ($BedDetails as $key => $value) {
				if ($Treatment->bed_id == $value->bed_id) {
					$bed .= '<option value="'.$value->bed_id.'" selected>'.$value->name.'</option>';
				} else {
					$bed .= '<option value="'.$value->bed_id.'">'.$value->name.'</option>';
				}
				
			}$Patient->bed = $bed;

			$AdvPay = $this->M_Hospital->GetWhere('h_payment', array('patient_code' => $Patient->code, 'purpose' => 'Advance IPD'));
			if (!empty($AdvPay)){
				$Patient->advPrint = '
					Advance Payment
                    <a href="payment/invoice/'.$AdvPay->pay_id.'" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-print"></i>
                    </a>
				';
			}else{
				$Patient->advPrint = 'Advance Payment';
			}
			echo json_encode($Patient);
		}

		public function PostParticularNew(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') { extract($_POST);
				
				$FacilityDate = $FacilityDate.' '.date('H:i:s');
				$FacilityDate = date('Y-m-d H:i:s', strtotime($FacilityDate));
				
				$aID = $this->M_Hospital->InsertData('patient_facility_amt', array('created_at' => $FacilityDate, 'patient' => $pID, 'amount'  => array_sum($Amt)));
				$fDetails = $this->M_Hospital->GetWhere('h_facility', array('facility_id' => $ID[0]));

				for ($i=0; $i < count($ID); $i++) {
					$myArray[] = array(
						'aid'         => $aID,
						'patient'     => $pID, 
						'operative_surgeon' => $OpSurgeon, 
						'category'    => $fDetails->category,
						'subcategory' => $fDetails->subcategory,
						'facility'    => $ID[$i], 
						'particular'  => $Name[$i], 
						'amount'      => $Amt[$i],
						'created_at'  => $FacilityDate
					);
				}

				if ($this->M_Hospital->InsertBatch('patient_facility', $myArray)) {
					
					$Cat = $this->my_library->GetParam('facility_catg', 'category', array('cat_id' => $fDetails->category));
					$Sub = $this->my_library->GetParam('facility_subcatg', 'subcategory', array('subcat_id' => $fDetails->subcategory));

					$Data = '
						<tr>
							<td>'.$Cat.'</td>
							<td>'.$Sub.'</td>
							<td>'.array_sum($Amt).'</td>
							<td>'.date('d-m-Y', strtotime($FacilityDate)).'</td>
							<td>
								--
								<!--<button type="button" class="btn btn-pill btn-danger remove-myFacility" id="'.$aID.'">
			                    	<i class="fas fa-times"></i>
			                    </button>-->
							</td>
						</tr>
					';


					if (isset($OtherFacility)) { $Data2 = ''; $myCount = 0;
						foreach ($OtherFacility as $key => $OthFcltyArray) {
							if (count($OthFcltyArray) > 1) {
								$Zero = $OthFcltyArray[0]; $One = $OthFcltyArray[1]; $Tow = $OthFcltyArray[2];

								for ($i = 0; $i <= (count($Zero) - 1); $i++) { 
									if (is_numeric($Zero[$i]))
										$Name  = $this->my_library->GetParam('saline_master', 'name', array('id' => $Zero[$i]));
									else $Name = $Zero[$i];

									$FacilityArray[] = array(
										'aid'         => $aID,
										'pid'         => $pID, 
										'category'    => $fDetails->category,
										'subcategory' => $fDetails->subcategory,
										'type'        => $OthFcltyArray[3], 
										'name'        => $Name, 
										'amount'      => $One[$i], 
										'qty'         => $Tow[$i],
										'created_at'  => $FacilityDate
									);
									++$myCount;
									$Data2 .= '
										<tr>
											<td>'.$OthFcltyArray[3].'</td>
											<td>'.$Name.'</td>
											<td>'.($One[$i] * $Tow[$i]).'</td>
											<td>'.date('d-m-Y', strtotime($FacilityDate)).'</td>
											<td>--</td>
										</tr>
									';
								}
							}
						} if ($myCount) { if ($this->M_Hospital->InsertBatch('other_facility', $FacilityArray)) $Data .= $Data2; }
					}

					exit(json_encode($Data));
				}

			}
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
							<td>'.$value->col_4.'</td>
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

		public function RemoveRecords(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				extract($_POST);

				if ($this->M_Hospital->DeleteData($table, array($col => $colid))) 
					echo json_encode('Deleted');						
			}
		}
	}

?>