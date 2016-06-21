<?php

class AccountController extends PageController {

	public function __construct($dbc) {
		parent::__construct();

		$this->dbc = $dbc;

		$this->mustBeLoggedIn();

	}

	public function buildHTML() {
		echo $this->plates->render('account');

	}

}

