<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/*
		* Mylibrary
	*/
	class MY_Library { 

		protected $CI;
	
		public function __construct() {
	        $this->CI =& get_instance();
		}
		
		public function GetParam($table, $column, $where) {
			return $this->CI->M_Hospital->GetWhere($table, $where)->$column;
		}

		public function GetRow($table, $where) {
			return $this->CI->M_Hospital->GetWhere($table, $where);
		}

		public function GetArray($table, $array){
			return  $this->CI->M_Hospital->GetArray($table, $array); 
		}

		public function GetTable($table, $orderBy, $direction){
			return $this->CI->M_Hospital->GetTable($table, $orderBy, $direction);
		}

		public function GetTotalAmount($tID){

			$Treatment = $this->CI->M_Hospital->GetWhere('h_treatment', array('treatment_id' => $tID));
			$tDetails  = $this->CI->M_Hospital->GetArray('h_treatment_details', array('treatment_id' => $tID));
			$Patient   = $this->CI->my_library->GetRow('h_patient', array('patient_id' => $Treatment->patient_id));

			$prevDay  = date('Y-m-d', strtotime('-1 day', strtotime($Treatment->allotment_date)));
			$interval = date_diff(date_create($prevDay), date_create(date('Y-m-d')));

			$total = 0;

			foreach ($tDetails as $key => $value) {
				if($value->mat_name == 'Bed'){
					$cost  = $this->CI->my_library->GetParam('h_bed', 'cost', array('bed_id' => $value->mat_id));
					$total += $interval->format("%a") * $cost;
				}else{
					$Col = ($value->type == 'Beneficiaries') ? 'beneficiaries' : 'nonbeneficiaries';
					
					$cost = $this->CI->my_library->GetParam('h_facility', $Col, array('facility_id' => $value->mat_id));
					$total += ($value->qty * $cost);
				}
			}


			return $total;
		}

		public function GetAmount($pID){

			$Patient = $this->CI->M_Hospital->GetWhere('h_patient', array('patient_id' => $pID));
			$pAmount = (($Patient->bedrent * $Patient->staydays) + $Patient->admissionfee);

			$tAmount = $this->CI->M_Hospital->GetSum('patient_facility_amt', 'amount', array('patient' => $pID));

			$oDetails  = $this->CI->M_Hospital->GetArray('other_facility', array('pid' => $pID));
			$tmpAmount = 0;
			foreach ($oDetails as $key => $value) $tmpAmount += ($value->amount * $value->qty);

			return ($pAmount + $tAmount + $tmpAmount);
		}		
	
	}

	/* End of file MY_Library.php */
	/* Location: ./application/libraries/MY_Library.php */
	
?>