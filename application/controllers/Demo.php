<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 	* Master
	*/
	class Demo extends MY_Controller {
		
		public function __construct() {
			parent::__construct();
		}

		public function index(){
			
			echo $this->add(5);
			
		}

		public function add($x){

			if ($x) {
				echo $x + $this->add(--$x);
			}

		}

	}
?>