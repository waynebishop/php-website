<?php

class AccountController extends PageController {

	public function __construct($dbc) {
		parent::__construct();

		$this->dbc = $dbc;

		$this->mustBeLoggedIn();

		// Did the user submit new contact details
		if( isset( $_POST['update-contact'] ) ) {
			$this->processNewContactDetails();

		}

		// Did the user submit a new post form?
		if( isset($_POST['new-post']) ) {
			$this->processNewPost();
		} 

	}

	public function buildHTML() {
		
		echo $this->plates->render('account', $this->data);

	}

	private function processNewContactDetails () {
		
		// Validation
		$totalErrors = 0;

		// Validate the first name
		if( strlen($_POST['first-name']) > 50 ) {
			$this->data['firstNameMessage'] = '<p>Must be at most 50 characters</p>';
			$totalErrors++;
		}

		// Validate the last name
		if( strlen($_POST['last-name']) > 50 ) {
			$this->data['lastNameMessage'] = '<p>Must be at most 50 characters</p>';
			$totalErrors++;
		}

		// if total errors is still 0 (Yay!)
		if( $totalErrors == 0) {
			// Form validation passed!
			// Time to update the database
			$firstName = $this->dbc->real_escape_string($_POST['first-name']);
			$lastName = $this->dbc->real_escape_string($_POST['last-name']);

			$userID = $_SESSION['id'];

			// Prepare the SQL
			$sql = "UPDATE users
					SET first_name = '$firstName',
						last_name = '$lastName'
					WHERE id = $userID ";

			// Run the query
			$this->dbc->query( $sql );	

		}

	}

	private function processNewPost() {

		// Count errors
		$totalErrors = 0;

		$title = trim($_POST['title']);
		$desc = trim($_POST['desc']);

		// Title
		if( strlen( $title ) == 0) {
			$this->data['titleMessage'] = '<p>Required</p>';
			$totalErrors++;
		} elseif( strlen( $title ) > 100 ) {
			$this->data['titleMessage'] = '<p>Cannot be more than 100 characters</p>';
			$totalErrors++;
		}

		// Description
		if( strlen( $desc ) == 0) {
			$this->data['descMessage'] = '<p>Required</p>';
			$totalErrors++;
		} elseif( strlen( $desc ) > 1000 ) {
			$this->data['descMessage'] = '<p>Cannot be more than 1000 characters</p>';
			$totalErrors++;
		}

		// If there are no errors
		if( $totalErrors == 0) {

			// Filter the data
			$title = $this->dbc->real_escape_string($title);
			$desc = $this->dbc->real_escape_string($desc);

			// Get the ID of the logged in user
			$userID = $_SESSION['id'];

			// SQL (INSERT)
			$sql = "INSERT INTO posts (title, description, user_id)
					VALUES ('$title', '$desc', $userID) ";

			$this->dbc->query( $sql );
			
			// Make sure that it worked
			if( $this->dbc->affected_rows ) {
				$this->data['postMessage'] = 'Success!';	
			} else { 
				$this->data['postMessage'] = 'Something went wrong!';
			}

			// Success message! (or error message)

		}		

	}

}

