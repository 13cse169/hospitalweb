<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class My_Model extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

		public function RunQuery($SQL){
			return $this->db->query($SQL)->result();
		}

		public function InsertData($table, $array){

			if ($this->db->insert($table, $array)) {
				return $this->db->insert_id();
			}else{
				return False;
			}

		}
		public function InsertBatch($table, $array){

			$this->db->insert_batch($table, $array);
			return true;

		}

		public function DeleteData($table, $array){

			if ($this->db->delete($table, $array))
				return True;
			else
				return False;
		}

		public function DeleteBatch($table, $column, $array){

			if (!empty($array)) {

				$this->db->where_in($column, $array);
				$this->db->delete($table);

				return true;
			} else {
				return false;
			}
			
		}

		public function UpdateData($table, $array){
			
			$this->db->where($array['pKey'], $array['id']);
			unset($array['pKey'], $array['id']);
			if ($this->db->update($table, $array)) {
				return true;
			}else{
				return false;
			}
		}

		public function UpdateBatch($table, $column, $array){

			$this->db->update_batch($table, $array, $column);

			return true;
		}

		public function GetWhere($table, $array){

			$query = $this->db->get_where($table, $array);
			$row   = $query->num_rows();

			if ($row >= 1) { 
				return $query->row(); 

			} else{ 
				return False; 
			}
		}

		public function GetArray($table, $array){

			return  $this->db->get_where($table, $array)->result(); 
		}

		public function GetTable($table, $orderBy, $direction){
			return $this->db->order_by($orderBy, $direction)->get($table)->result();
		}

		public function GetSum($table, $column, $array){

			$query = $this->db->select_sum($column)->get_where($table, $array)->row();

			return $query->$column;

			//return $this->db->last_query();
		}
	
	}
	
	/* End of file My_Model.php */
	/* Location: ./application/core/My_Model.php */
?>