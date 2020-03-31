<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_Hospital extends MY_Model {
	
		public function __construct() {
			parent::__construct();
		}

		public function InsertData($table, $array){
			return parent::InsertData($table, $array);
		}

		public function InsertBatch($table, $array){
			return parent::InsertBatch($table, $array);
		}

		public function DeleteData($table, $array){
			return parent::DeleteData($table, $array);
		}

		public function GetWhere($table, $array){
			return parent::GetWhere($table, $array);
		}

		public function UpdateData($table, $array){
			return parent::UpdateData($table, $array);
		}

		public function GetTable($table, $orderBy, $direction){
			return parent::GetTable($table, $orderBy, $direction);
		}

		public function GetSum($table, $column, $array){
			return parent::GetSum($table, $column, $array);
		}

		public function RunQuery($SQL){
			return parent::RunQuery($SQL);
		}
	
	}
	

	/* End of file M_Hospital.php */
	/* Location: ./application/models/M_Hospital.php */
?>