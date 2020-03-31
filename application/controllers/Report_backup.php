<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 	* Report
	*/
	class Report extends MY_Controller {
		
		public function __construct() {
			parent::__construct();
		}

		public function OperativeSurgeon(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST'){				
	    		redirect('report/operativesurgeon/'.base64_encode(json_encode($_POST)),'refresh');
			} else {

				$Data = [
					'Row'    => '',
					'active' => 'Report',
		    	    'load'   => 'web-hospital/report/operativesurgeon',
		    	    'script' => 'web-hospital/report/amount-js',
		    	    'Fclty'  => $this->M_Hospital->GetTable('facility_catg', 'category', 'ASC'),
		    	    'Doctor' => $this->M_Hospital->GetTable('h_doctor', 'name', 'ASC')
		    	];

		    	if ($this->uri->segment(3)) {
		    		$UrlData = json_decode(base64_decode($this->uri->segment(3)));
		    		$count = $TotalAmt = 0; $TR = '';

		    		$UrlData->f_date = date('Y-m-d', strtotime($UrlData->f_date));
		    		$UrlData->t_date = date('Y-m-d', strtotime($UrlData->t_date));

		    		if( ($UrlData->doc_type == 'Doctor') || ($UrlData->doc_type == 'Asst. Doctor') ){
		    			$Where = ($UrlData->cat_id == 'ALL') ? '' : " AND category = '$UrlData->cat_id'";
		    			$SQL = "SELECT * FROM other_facility WHERE type = '$UrlData->doc_type' $Where AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'";
		    		} else {
		    			$SQL = "SELECT * FROM patient_facility WHERE operative_surgeon = '$UrlData->doc_id' AND category = '$UrlData->cat_id' AND particular = 'OPERATION' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date' GROUP BY aid";
		    		}
		    		$ResData = $this->M_Hospital->RunQuery($SQL);
		    		foreach ($ResData as $key => $value) {
		    			
		    			$DOC =  ($UrlData->doc_type == 'OPERATIVESURGEON') ? $this->my_library->GetParam('h_doctor', 'name', array('doctor_id' => $value->operative_surgeon)) : $value->name;
		    			
		    			$TR .= '
		    				<tr>
		    					<td>'.++$count.'</td>
		    					<td>'.date('d-M-y', strtotime($value->created_at)).'</td>
		    					<td>'.$DOC.'</td>
		    					<td>'.$this->my_library->GetParam('facility_catg', 'category', array('cat_id' => $value->category)).'</td>
		    					<td>'.number_format((float)$value->amount, 2, '.', '').'</td>
		    				</tr>
		    			';
		    			$TotalAmt += $value->amount;
		    		}

		    		$TR .= '<tr class="bg-info text-white"><td>'.++$count.'.</td>
	    					<td></td><td><strong>Total Amount</stromg></td>
	    					<td></td><td>'.number_format((float)$TotalAmt, 2, '.', '').'</td></tr>';

		    		$Data['Row'] = $TR;
		    	}

		    	$this->load->view('web-hospital/layout/layout', $Data);
			}

		}

		public function details(){
			$OtherFclt = array('Advance', 'FinalIPD', 'AMBULANCE', 'E.C.G', 'ECHO', 'PATHOLOGY TEST', 'U.S.G', 'X-RAY');
			$UrlData = json_decode(base64_decode($this->uri->segment(3)));
			$Row = ''; $total = $count = 0;
			if (in_array($UrlData->cat_id, $OtherFclt)) {
    			switch ($UrlData->cat_id) {
    				case 'Advance':
    					$SQL = "SELECT * FROM h_payment WHERE pay_type = 'Advance' AND CAST(pay_date AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date' ORDER BY pay_date";
    					break;
    				
    				case 'FinalIPD':
    					$SQL = "SELECT * FROM h_payment WHERE pay_type = '' AND CAST(pay_date AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date' ORDER BY pay_date";
    					break;
    				
    				default:
    					$SQL = "SELECT * FROM other_facility WHERE type = '$UrlData->cat_id' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date' ORDER BY created_at";
    					break;
    			}

	    		$myData = $this->M_Hospital->RunQuery($SQL);
	    		if (count($myData)) {
		    		foreach ($myData as $key => $value) {
		    			if ($UrlData->cat_id == 'Advance' || $UrlData->cat_id == 'FinalIPD') {
		    				$total += $value->pay_amt;
		    				$pDetails = $this->my_library->GetRow('h_patient', array('patient_id' => $value->treatment_id));
		    				$Row .= '
		    					<tr>
		    						<td>'.++$count.'.</td>
		    						<td>'.date('d-M-y', strtotime($value->pay_date)).'</td>
		    						<td>'.$pDetails->name.' ['.$pDetails->code.']</td>
		    						<td>'.number_format((float)$value->pay_amt, 2, '.', '').'</td>
		    					</tr>
		    				';
		    			}else{
		    				$total += $value->amount;
		    				$pDetails = $this->my_library->GetRow('h_patient', array('patient_id' => $value->pid));
			    			$Row .= '
		    					<tr>
		    						<td>'.++$count.'.</td>
			    					<td>'.date('d-M-y', strtotime($value->created_at)).'</td>
			    					<td>'.$pDetails->name.' ['.$pDetails->code.']</td>
			    					<td>'.number_format((float)$value->amount, 2, '.', '').'</td>
		    					</tr>
		    				';
		    			}
		    		}
		    		$Row .= '
			    		<tr class="bg-info text-white">
						    <td>'.++$count.'.</td>
						    <td>'.date('d-M-y', strtotime($UrlData->f_date)).' to '.date('d-M-y', strtotime($UrlData->t_date)).'</td>
						    <td><strong>Total Amount</strong></td>
						    <td>'.number_format((float)$total, 2, '.', '').'</td>
						</tr>
					';
				}else{
					$Row .= '
			    		<tr class="bg-danger text-white font-weight-bold">
						    <td colspan="4" align="center">No data available...</td>
						</tr>
					';
				}
    		} else {
    			$SQL = "SELECT aid, category, created_at FROM patient_facility WHERE category = '$UrlData->cat_id' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date' GROUP BY aid, category, created_at";
	    		$myData = $this->M_Hospital->RunQuery($SQL);

		    	if (count($myData)) {
		    		foreach ($myData as $key => $value) {
		    			$sum1 =  $this->M_Hospital->GetSum('patient_facility', 'amount', array('aid' => $value->aid));
		    			$sum2 =  $this->M_Hospital->GetSum('other_facility', 'amount', array('aid' => $value->aid));
		    			$total += $sum = ($sum1 + $sum2);

		    			$Row .= '
		    				<tr>
		    					<td>'.++$count.'.</td>
		    					<td>'.date('d-M-y', strtotime($value->created_at)).'</td>
		    					<td>'.$this->my_library->GetParam('facility_catg', 'category', array('cat_id' => $value->category)).'</td>
		    					<td>'.$sum.'</td>
		    				</tr>
		    			';
		    		}

		    		$Row .= '
			    		<tr class="bg-info text-white">
						    <td>'.++$count.'.</td>
						    <td>'.date('d-M-y', strtotime($UrlData->f_date)).' to '.date('d-M-y', strtotime($UrlData->t_date)).'</td>
						    <td><strong>Total Amount</strong></td>
						    <td>'.number_format((float)$total, 2, '.', '').'</td>
						</tr>
					';
		    	}else{
		    		$Row .= '
			    		<tr class="bg-danger text-white font-weight-bold">
						    <td colspan="4" align="center">No data available...</td>
						</tr>
					';
		    	}
    		}

			$Data = [
				'active' => 'Report',
	    	    'load'   => 'web-hospital/report/details',
	    	    'Row'    => $Row
	    	];
			
			$this->load->view('web-hospital/layout/layout', $Data);
		}

		public function indoor(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST')
	    		redirect('report/indoor/'.base64_encode(json_encode($_POST)),'refresh');
			
			$Data = [
				'Row'    => '',
				'active' => 'Report',
	    	    'load'   => 'web-hospital/report/indoor',
	    	    'script' => 'web-hospital/report/amount-js',
	    	    'Fclty'  => $this->M_Hospital->GetTable('facility_catg', 'category', 'ASC')
	    	];

	    	if ($this->uri->segment(3)) {
	    		$OtherFclt = array('Advance', 'FinalIPD', 'AMBULANCE', 'EMERGENCY', 'E.C.G', 'ECHO', 'PATHOLOGY TEST', 'U.S.G', 'X-RAY');
	    		$UrlData   = json_decode(base64_decode($this->uri->segment(3)));
	    		
	    		$UrlData->f_date = date('Y-m-d', strtotime($UrlData->f_date));
	    		$UrlData->t_date = date('Y-m-d', strtotime($UrlData->t_date));

	    		$Row = ''; $total = $count = 0;

	    		if ($UrlData->cat_id == 'All') {
	    			$Advance = $this->M_Hospital->RunQuery("SELECT SUM(pay_amt) AS amount FROM h_payment WHERE pay_type = 'Advance' AND CAST(pay_date AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'");
	    			$FinalIPD = $this->M_Hospital->RunQuery("SELECT SUM(pay_amt) AS amount FROM h_payment WHERE pay_type = '' AND CAST(pay_date AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'");
	    			$Ambulance = $this->M_Hospital->RunQuery("SELECT SUM(amount) AS amount FROM other_facility WHERE type = 'AMBULANCE' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'");
	    		        $Emergency = $this->M_Hospital->RunQuery("SELECT SUM(amount) AS amount FROM other_facility WHERE type = 'EMERGENCY FACILITY' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'");
                                $ECG = $this->M_Hospital->RunQuery("SELECT SUM(amount) AS amount FROM other_facility WHERE type = 'E.C.G' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'");
	    			$ECHO = $this->M_Hospital->RunQuery("SELECT SUM(amount) AS amount FROM other_facility WHERE type = 'ECHO' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'");
	    			$Pathology = $this->M_Hospital->RunQuery("SELECT SUM(amount) AS amount FROM other_facility WHERE type = 'PATHOLOGY TEST' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'");
	    			$USG = $this->M_Hospital->RunQuery("SELECT SUM(amount) AS amount FROM other_facility WHERE type = 'U.S.G' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'");
	    			$XRAY = $this->M_Hospital->RunQuery("SELECT SUM(amount) AS amount FROM other_facility WHERE type = 'X-RAY' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'");

	    			$AllArray = [
						'Advance'   => $Advance[0]->amount, 
						'FinalIPD'  => $FinalIPD[0]->amount, 
                                                'Emergency' => $Emergency[0]->amount,
						'Ambulance' => $Ambulance[0]->amount, 
						'ECG'       => $ECG[0]->amount, 
						'ECHO'      => $ECHO[0]->amount, 
						'Pathology' => $Pathology[0]->amount, 
						'USG'       => $USG[0]->amount, 
						'XRAY'      => $XRAY[0]->amount
                                                
                                               
					];
					
	    			foreach ($AllArray as $key => $value) {
	    				$total += $value;
	    				$myArray = ['cat_id' => $key, 'f_date' => $UrlData->f_date, 't_date' => $UrlData->t_date];
		    			$Row .= '
	    					<tr>
	    						<td>'.++$count.'.</td>
		    					<td>'.date('d-m-y', strtotime($UrlData->f_date)).' to '.date('d-m-y', strtotime($UrlData->t_date)).'</td>
		    					<td class="font-weight-bold">'.$key.'</td>
		    					<td>
		    						<span class="badge badge-secondary font-weight-bold">
		    							'.number_format((float)$value, 2, '.', '').'
		    						</span>
		    						<a href="'.base_url('report/details/'.base64_encode(json_encode($myArray))).'" class="btn btn-sm btn-outline-primary float-right">
		    							<i class="far fa-folder-open"></i>
		    						</a>
		    					</td>
	    					</tr>
	    				';
	    			}

	    			/*$FacilityCatg = $this->M_Hospital->GetTable('facility_catg', 'category', 'ASC');
	    			foreach ($FacilityCatg as $key => $value) {
	    				$SQL1 = "SELECT SUM(amount) AS amount FROM patient_facility WHERE category = '$value->cat_id' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'";
	    				$myData1 = $this->M_Hospital->RunQuery($SQL1);

	    				$SQL2 = "SELECT SUM(amount) AS amount FROM other_facility WHERE category = '$value->cat_id' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'";
	    				$myData2 = $this->M_Hospital->RunQuery($SQL2);

	    				$total += ($myData1[0]->amount + $myData2[0]->amount);
	    				$myArray = ['cat_id' => $value->cat_id, 'f_date' => $UrlData->f_date, 't_date' => $UrlData->t_date];

		    			$Row .= '
		    				<tr>
		    					<td>'.++$count.'.</td>
		    					<td>'.date('d-m-y', strtotime($UrlData->f_date)).' to '.date('d-m-y', strtotime($UrlData->t_date)).'</td>
		    					<td class="font-weight-bold">'.$value->category.'</td>
		    					<td>
		    						<span class="badge badge-secondary font-weight-bold">
		    							'.number_format((float)($myData1[0]->amount + $myData2[0]->amount), 2, '.', '').'
		    						</span>
		    						<a href="'.base_url('report/details/'.base64_encode(json_encode($myArray))).'" class="btn btn-sm btn-outline-primary float-right">
		    							<i class="far fa-folder-open"></i>
		    						</a>
		    					</td>
		    				</tr>
		    			';
	    			}*/

	    			$Row .= '
			    		<tr class="bg-info text-white">
						    <td>'.++$count.'.</td>
						    <td>'.date('d-M-y', strtotime($UrlData->f_date)).' to '.date('d-M-y', strtotime($UrlData->t_date)).'</td>
						    <td><strong>Total Amount</strong></td>
						    <td>'.number_format((float)$total, 2, '.', '').'</td>
						</tr>
					';
	    		} else {
		    		if (in_array($UrlData->cat_id, $OtherFclt)) {
		    			switch ($UrlData->cat_id) {
		    				case 'Advance':
		    					$SQL = "SELECT * FROM h_payment WHERE pay_type = 'Advance' AND CAST(pay_date AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date' ORDER BY pay_date";
		    					break;
		    				
		    				case 'FinalIPD':
		    					$SQL = "SELECT * FROM h_payment WHERE pay_type = '' AND CAST(pay_date AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date' ORDER BY pay_date";
		    					break;
		    				
		    				default:
		    					$SQL = "SELECT * FROM other_facility WHERE type = '$UrlData->cat_id' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date' ORDER BY created_at";
		    					break;
		    			}

			    		$myData = $this->M_Hospital->RunQuery($SQL);
			    		if (count($myData)) {
				    		foreach ($myData as $key => $value) {
				    			if ($UrlData->cat_id == 'Advance' || $UrlData->cat_id == 'FinalIPD') {
				    				$total += $value->pay_amt;
				    				$pDetails = $this->my_library->GetRow('h_patient', array('patient_id' => $value->treatment_id));
				    				$Row .= '
				    					<tr>
				    						<td>'.++$count.'.</td>
				    						<td>'.date('d-M-y', strtotime($value->pay_date)).'</td>
				    						<td>'.$pDetails->name.' ['.$pDetails->code.']</td>
				    						<td>'.number_format((float)$value->pay_amt, 2, '.', '').'</td>
				    					</tr>
				    				';
				    			}else{
				    				$total += $value->amount;
				    				$pDetails = $this->my_library->GetRow('h_patient', array('patient_id' => $value->pid));
					    			$Row .= '
				    					<tr>
				    						<td>'.++$count.'.</td>
					    					<td>'.date('d-M-y', strtotime($value->created_at)).'</td>
					    					<td>'.$pDetails->name.' ['.$pDetails->code.']</td>
					    					<td>'.number_format((float)$value->amount, 2, '.', '').'</td>
				    					</tr>
				    				';
				    			}
				    		}
				    		$Row .= '
					    		<tr class="bg-info text-white">
								    <td>'.++$count.'.</td>
								    <td>'.date('d-M-y', strtotime($UrlData->f_date)).' to '.date('d-M-y', strtotime($UrlData->t_date)).'</td>
								    <td><strong>Total Amount</strong></td>
								    <td>'.number_format((float)$total, 2, '.', '').'</td>
								</tr>
							';
						}else{
							$Row .= '
					    		<tr class="bg-danger text-white font-weight-bold">
								    <td colspan="4" align="center">No data available...</td>
								</tr>
							';
						}
		    		} else {
		    			$SQL = "SELECT aid, category, created_at FROM patient_facility WHERE category = '$UrlData->cat_id' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date' GROUP BY aid, category, created_at";
			    		$myData = $this->M_Hospital->RunQuery($SQL);

				    	if (count($myData)) {
				    		foreach ($myData as $key => $value) {
				    			$sum1 =  $this->M_Hospital->GetSum('patient_facility', 'amount', array('aid' => $value->aid));
				    			$sum2 =  $this->M_Hospital->GetSum('other_facility', 'amount', array('aid' => $value->aid));
				    			$total += $sum = ($sum1 + $sum2);

				    			$Row .= '
				    				<tr>
				    					<td>'.++$count.'.</td>
				    					<td>'.date('d-M-y', strtotime($value->created_at)).'</td>
				    					<td>'.$this->my_library->GetParam('facility_catg', 'category', array('cat_id' => $value->category)).'</td>
				    					<td>'.$sum.'</td>
				    				</tr>
				    			';
				    		}

				    		$Row .= '
					    		<tr class="bg-info text-white">
								    <td>'.++$count.'.</td>
								    <td>'.date('d-M-y', strtotime($UrlData->f_date)).' to '.date('d-M-y', strtotime($UrlData->t_date)).'</td>
								    <td><strong>Total Amount</strong></td>
								    <td>'.number_format((float)$total, 2, '.', '').'</td>
								</tr>
							';
				    	}else{
				    		$Row .= '
					    		<tr class="bg-danger text-white font-weight-bold">
								    <td colspan="4" align="center">No data available...</td>
								</tr>
							';
				    	}
		    		}
		    	}
				$Data['Row'] = $Row;
	    	}

			$this->load->view('web-hospital/layout/layout', $Data);
		}

		public function amount(){
			
			$Data = [
				'active' => 'Report',
	    	    'load'   => 'web-hospital/report/amount',
	    	    'script' => 'web-hospital/report/amount-js',
	    	    'amount' => $this->M_Hospital->GetTable('h_payment', 'pay_id', 'DESC')
	    	];
			
			$this->load->view('web-hospital/layout/layout', $Data);
		}

		public function laser(){
			$Data = [
				'active' => 'Report',
	    	    'load'   => 'web-hospital/report/laser',
	    	    'script' => 'web-hospital/report/laser-js',
	    	    'facility' => $this->M_Hospital->GetTable('h_facility', 'name', 'ASC')
	    	];
			$this->load->view('web-hospital/layout/layout', $Data);
		}

		public function GetLaserReport(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$Data = explode('&', $_POST['Data']);

				$tmp0 = explode('=', $Data[0]);
				$fid  = $tmp0[1];

				$tmp1  = explode('=', $Data[1]);
				$fDate = date('Y-m-d', strtotime($tmp1[1]));

				$tmp2  = explode('=', $Data[2]);
				$tDate = date('Y-m-d', strtotime($tmp2[1]));

				$SQL = "SELECT TD.added_on, HP.code, HP.name FROM h_treatment_details AS TD LEFT JOIN h_treatment AS HT ON HT.treatment_id = TD.treatment_id LEFT JOIN h_patient AS HP ON HP.patient_id = HT.patient_id WHERE TD.added_on >= '$fDate' AND TD.added_on <= '$tDate' AND TD.mat_name = 'Particular' AND TD.mat_id = '$fid'";
				$Res = $this->M_Hospital->RunQuery($SQL);

				$Data = ''; $count = $total = 0;
				foreach ($Res as $key => $value) {
					$Data .= '
						<tr>
							<td>'.++$count.'.</td>
							<td>'.date('d-M-Y', strtotime($value->added_on)).'</td>
							<td>'.$value->code.'</td>
							<td>'.$value->name.'</td>
							<td>--</td>
						</tr>
					';
				}
				exit(json_encode($Data));

			}
		}

		public function outdoor(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST')
	    		redirect('report/outdoor/'.base64_encode(json_encode($_POST)),'refresh');
			
			$Data = [
				'Row'         => '',
				'active'      => 'Report',
	    	    'load'        => 'web-hospital/report/outdoor',
	    	    'script'      => 'web-hospital/report/amount-js',
	    	    'Category'   => $this->M_Hospital->GetTable('outdoor_facility_group', 'group_name', 'ASC'),
		    	'Particular' => $this->M_Hospital->GetTable('outdoor_facility', 'facilit_name', 'ASC')
	    	];

			
	    	if ($this->uri->segment(3)) {
	    		$UrlData   = json_decode(base64_decode($this->uri->segment(3)));

	    		$UrlData->f_date = date('Y-m-d', strtotime($UrlData->f_date));
	    		$UrlData->t_date = date('Y-m-d', strtotime($UrlData->t_date));

	    		$Row = ''; $Total = $count = 0;

	    		  if($UrlData->code == 'All'){

					 $con = mysqli_connect('localhost', 'root', 'bcroyserver', 'hospitalweb');
					 $query = "SELECT *
					        FROM outdoor_treat, outdoor_facility_group
					        WHERE CAST(app_date AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date' AND outdoor_treat.category = outdoor_facility_group.g_code ORDER BY category";

					$result = mysqli_query($con, $query);
					$last_category='';

					if (count($result)) {

					  while($row=mysqli_fetch_array($result)){

						 $User = $this->my_library->GetParam('outdoor_treat', 'collectedby', array('treat_id' => $row['treat_id']));
	                        if ($User) {
	                            $this->my_library->GetParam('users', 'name', array('id' => $User));
	                        }

                       $Total += $row['amount'];

					    if ($last_category!= $row['category']){

					      $Data['Row'] .= " 
		    			     <tr>
		    			       <td></td>
		    			       <td></td>
		    			       <td></td>
		    			       <td>" .'<strong>'.$this->my_library->GetParam('outdoor_facility_group', 'group_name', array('g_code' => $row['category']))."</strong></td>
		    			      </tr>";
					        $last_category = $row['category'];
					      }


						   $Data['Row'] .= " 
			    			<tr>
			    			  <td>".++$count."</td>
			    			  <td> " . $row["app_date"] . "</td>
			    			  <td>" . $row["name"] . "</td> 
			    			  <td>" . $this->my_library->GetParam('users', 'name', array('id' => $User)) . "</td>
			    			  <td>" . $this->my_library->GetParam('outdoor_facility_group', 'group_name', array('g_code' => $row['category'])) . " <td>" . $row["amount"] . "</td>
			    			</tr>";

					      }

					      $Data['Row'] .= '
			    				<tr class="bg-info text-white">
			    					<td>'.++$count.'.</td>
			    					<td></td><td></td>
			    					<td class="font-weight-bold">Total Amount</td>
			    					<td></td><td>'.number_format((float)$Total, 2, '.', '').'</td>
			    				</tr>
				    		';
					
                     }
	                  else {
		    			$Data['Row'] .= '
		    				<tr class="bg-danger text-white">
		    					<td></td><td></td>
		    					<td class="font-weight-bold">No Data Found...</td>
		    					<td></td><td></td>
		    				</tr>
			    		';
		    		}

		    		} else {
		    			$SQL = "SELECT * FROM outdoor_treat WHERE category LIKE '%$UrlData->code%' AND CAST(app_date AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'";

		    			$ResData = $this->M_Hospital->RunQuery($SQL);

	    		    if (count($ResData)) {

	    			   $previous_category = "";
		    		      foreach ($ResData as $key => $value) {

		    		    $User = $this->my_library->GetParam('outdoor_treat', 'collectedby', array('treat_id' => $value->treat_id));
                        if ($User) {
                            $this->my_library->GetParam('users', 'name', array('id' => $User));
                        }
                    
		    			
		    			$amount     = explode(',', $value->amount);
		    			$category   = explode(',', $value->category);
		    			$particular = explode(',', $value->particular);
		    			$index      = array_search($UrlData->code, $category);

		    			$Total += $amount[$index];



		    			$Data['Row'] .= '
		    				<tr>
		    					<td>'.++$count.'.</td>
		    					<td>'.date('d-M-y', strtotime($value->app_date)).'</td>
		    					
		    					<td>'.$value->name.'</td>
		    					<td>'.$this->my_library->GetParam('users', 'name', array('id' => $User)).'</td>
		    					<td>'.$this->my_library->GetParam('outdoor_facility_group', 'group_name', array('g_code' => $category[$index])).'</td>
		    				
		    					<td>'.number_format((float)$amount[$index], 2, '.', '').'</td>
		    				</tr>
		    			';
		    		}

		    		$Data['Row'] .= '
	    				<tr class="bg-info text-white">
	    					<td>'.++$count.'.</td>
	    					<td></td><td></td><td></td>
	    					<td class="font-weight-bold">Total Amount</td>
	    					<td>'.number_format((float)$Total, 2, '.', '').'</td>
	    				</tr>
		    		';
		    		
	    		} else {
	    			$Data['Row'] .= '
	    				<tr class="bg-danger text-white">
	    					<td></td><td></td><td></td>
	    					<td class="font-weight-bold">No Data Found...</td>
	    					<td></td><td></td>
	    				</tr>
		    		';
	    		}
		    		}

		    		

			}

			$this->load->view('web-hospital/layout/layout', $Data);
		}

		public function emergency(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
	    		redirect('report/emergency/'.base64_encode(json_encode($_POST)),'refresh');
			
			$Data = [
				'Row'      => '',
				'active'   => 'Report',
	    	                'load'     => 'web-hospital/report/emergency',
	    	                'script'   => 'web-hospital/report/amount-js',
                                'Doctor'   => $this->M_Hospital->GetTable('h_doctor', 'name', 'ASC'),
	    	                'USG'      => $this->M_Hospital->GetArray('outdoor_facility', array('g_code' => 'G00005')),
	    	                'ECG'      => $this->M_Hospital->GetArray('outdoor_facility', array('g_code' => 'G00003')),
	    	                'XRay'     => $this->M_Hospital->GetArray('outdoor_facility', array('g_code' => 'G00004')),
	    	                'Patient'  => $this->M_Hospital->GetArray('h_patient', array('patient_type' => 'Emergency')),
	    	                'Facility' => $this->M_Hospital->GetTable('emergency_facility', 'facility', 'ASC'),
	    	                'ALL'      => $this->M_Hospital->GetTable('outdoor_facility', 'facilit_name', 'ASC'),
	    	                'Type'     => $this->M_Hospital->RunQuery("SELECT type FROM pathology GROUP BY type ORDER BY type ASC")
	    	];
			
	    	if ($this->uri->segment(3)) {
	    		$UrlData   = json_decode(base64_decode($this->uri->segment(3)));

	    		$UrlData->f_date = date('Y-m-d', strtotime($UrlData->f_date));
	    		$UrlData->t_date = date('Y-m-d', strtotime($UrlData->t_date));

	    		$Row = ''; $Total = $count = 0;

	    		if ($UrlData->code == 'Emergency Facility')
	    			$type = "type IN ('Emergency Facility', 'Bed', 'Miscellaneous', 'Special Doctor')";
	    		else $type = "type = '$UrlData->code'";

	    		//$Result = $this->M_Hospital->RunQuery("SELECT * FROM other_facility WHERE patient_type = 'Emergency' AND $type AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'");
	    		
			
                         if($UrlData->code == 'All'){
		    		    $SQL = "SELECT * FROM other_facility WHERE patient_type = 'Emergency' AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'";
		    		} else {
		    		    $SQL = "SELECT * FROM other_facility WHERE patient_type = 'Emergency' AND $type AND CAST(created_at AS DATE) BETWEEN '$UrlData->f_date' AND '$UrlData->t_date'";
		    		}

		    		$ResData = $this->M_Hospital->RunQuery($SQL);

	    		if (count($ResData)) {
		    		foreach ($ResData as $key => $value) {
		    			$Total += $value->amount;

					$User = $this->my_library->GetParam('h_patient', 'collectedby', array('patient_id' => $value->pid));
                                         if ($User) {
                                            $this->my_library->GetParam('users', 'name', array('id' => $User));
                                          }
		    			$Data['Row'] .= '
		    				<tr>
		    					<td>'.++$count.'.</td>
		    					<td>'.date('d-M-Y', strtotime($value->created_at)).'</td>
		    					<!--<td>'.$value->type.'</td>-->
		    					<td>'.$value->name.'</td>
		    					<td>'.$this->my_library->GetParam('h_patient', 'name', array('patient_id' => $value->pid)).'</td>
                                                        <td>'.$this->my_library->GetParam('users', 'name', array('id' => $User)).'</td>
		    					<td>'.number_format((float)$value->amount, 2, '.', '').'</td>
		    				</tr>
		    			';
		    		}

		    		$Data['Row'] .= '
	    				<tr class="bg-info text-white">
	    					<td>'.++$count.'.</td>
	    					<td></td><td></td>
	    					<td class="font-weight-bold">Total Amount</td>
	    					<td></td><td></td>
	    					<td>'.number_format((float)$Total, 2, '.', '').'</td>
	    				</tr>
		    		';
	    		} else {
	    			$Data['Row'] .= '
	    				<tr class="bg-danger text-white">
	    					<td></td><td></td><td></td>
	    					<td class="font-weight-bold">No Data Found...</td>
	    					<td></td><td></td>
	    				</tr>
		    		';
	    		}
			}

			$this->load->view('web-hospital/layout/layout', $Data);
		}

	         public function getOutDoorFacility(){

			$id  = $_POST['CatID'];
			$Fac = $this->M_Hospital->GetArray('outdoor_facility', array('g_code' => $id));
			//$allFac = $this->M_Hospital->GetTable('outdoor_facility', 'facility', 'ASC');

			$Data = '<option value="" hidden="true">Select Sub Category</option>';
			
            foreach ($Fac as $key => $value) {

        	        $Data .= '<option value="'.$value->od_facilit_id.'">'.$value->facilit_name.'</option>';
            }
       

            exit(json_encode($Data));

		}
	}
?>