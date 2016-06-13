<?php
// Make everything in the vendor folder 
// avaiable to use
require 'vendor/autoload.php';

// Load the appropriate page

// Has the user requested a page?
if( isset( $_GET['page'] ) ) {
	// Requested page
	$page = $_GET['page'];
} else {
	// Home page
	$page = 'landing';
}
// Load the appropriate files based on page
switch($page) {
	
	// Home page
	case 'landing':
	case 'register':
		require 'app/controllers/LandingController.php';
		$controller = new LandingController();
	break;

	// About page
	case 'about':
		echo $plates->render('about');
	break;

	// Contact page
	case 'contact':
		echo $plates->render('contact');

	break;

	// Home page
	case 'login':
		echo $plates->render('login');

	break;

	// Home page
	case 'stream':
		echo $plates->render('stream');

	break;

	default:
		echo $plates->render('error404');
	
	break;

}


$controller->buildHTML();





