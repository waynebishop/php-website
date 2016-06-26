<?php 

class LoginController extends PageController {

	public function __construct($dbc) {
		// Line below required as __construct above overides parent, so parent::__construct makes parent run 
		parent::__construct();

		// save the database connection
		$this->dbc = $dbc;

	}	

	public function buildHTML() {

			

	}


}

