<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
		* Dashboard
	*/
	class Dashboard extends MY_Controller {
	    
	    public function __construct() {
	        parent::__construct();
	    }

	    public function index() {

	    	$Year = date('Y');
	    	$Data = [
	    		'active'  => 'Dashboard',
	    	    'load'    => 'web-hospital/pages/dashboard',
	    	    'Outdoor' => count($this->M_Hospital->GetTable('outdoor_treat', 'treat_id', 'ASC')),
	    	    'Doctor'  => count($this->M_Hospital->GetTable('h_doctor', 'doctor_id', 'ASC')),
	    	    'Indoor'  => count($this->M_Hospital->GetArray('h_patient', array('patient_type' => 'Indoor'))),
	    	    'Emergency'  => count($this->M_Hospital->GetArray('h_patient', array('patient_type' => 'Emergency')))
	    	];

			$IndoorPatient = $this->M_Hospital->RunQuery("SELECT MONTH(allotment_date) AS Month, COUNT(treatment_id) AS Patient FROM h_treatment WHERE YEAR(allotment_date) = $Year GROUP BY YEAR(allotment_date), MONTH(allotment_date) ORDER BY YEAR(allotment_date), MONTH(allotment_date)");
			if (count($IndoorPatient)) { $j = -1; $Month = array(); $Patient = array();
				foreach ($IndoorPatient as $key => $value) { $Month[] = $value->Month; $Patient[] = $value->Patient; }
				for ($i = 0; $i < 12 ; $i++) {
					if (($i+1) < $Month[0]) $Indoor[] = 0; else if (($i+1) > end($Month)) $Indoor[] = 0;
					else if (!in_array(($i+1), $Month)) $Indoor[] = 0; else $Indoor[] = $Patient[++$j];
				}
			} else { for ($i = 1; $i <= 12; $i++) $Indoor[] = 0; }
			$Data['TotalIndoor'] = implode(', ', $Indoor);

			$OutdoorPatient = $this->M_Hospital->RunQuery("SELECT MONTH(app_date) AS Month, COUNT(treat_id) AS Patient FROM outdoor_treat WHERE YEAR(app_date) = $Year GROUP BY YEAR(app_date), MONTH(app_date) ORDER BY YEAR(app_date), MONTH(app_date)");
			if (count($OutdoorPatient)) { $j = -1; $Month = array(); $Patient = array();
				foreach ($OutdoorPatient as $key => $value) { $Month[] = $value->Month; $Patient[] = $value->Patient; }
				for ($i = 0; $i < 12 ; $i++) {
					if (($i+1) < $Month[0]) $Outdoor[] = 0; else if (($i+1) > end($Month)) $Outdoor[] = 0;
					else if (!in_array(($i+1), $Month)) $Outdoor[] = 0; else $Outdoor[] = $Patient[++$j];
				}
			} else { for ($i = 1; $i <= 12; $i++) $Outdoor[] = 0; }
			$Data['TotalOutdoor'] = implode(', ', $Outdoor);

			$this->load->view('web-hospital/layout/layout', $Data);
		}

	}
?>