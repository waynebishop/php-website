<?php

session_start();

// Make everything in the vendor folder 
// avaiable to use
require 'vendor/autoload.php';
require'app/controllers/PageController.php';

// Has the user requested a page?
// if( isset( $_GET['page'] ) ) {
// 	// Requested page
// 	$page = $_GET['page'];
// } else {
// 	// Home page
// 	$page = 'landing';
// }
// Terniary code below \/ replaces if/else above /\ 
$page = isset($_GET['page']) ? $_GET['page'] : 'landing'; 


// Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'pinterest');

// Load the appropriate files based on page
switch($page) {
	
	// Home page
	case 'landing':
	case 'register':
		require 'app/controllers/LandingController.php';
		$controller = new LandingController($dbc);
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
		require 'app/controllers/LoginController.php';
		$controller = new LoginController($dbc);
	break;

	// Stream page
	case 'stream':
		require 'app/controllers/StreamController.php';
		$controller = new StreamController($dbc);
	break;

	// Account page *********
	case 'account':
		require 'app/controllers/AccountController.php';
		$controller = new AccountController($dbc);
	break;

	// Post page
	case 'post':
		require 'app/controllers/PostController.php';
		$controller = new PostController($dbc);
	break;

	case 'edit-comment':
		require 'app/controllers/EditCommentController.php';
		$controller = new EditCommentController($dbc);
	break;

	case 'edit-post':
		require 'app/controllers/EditPostController.php';
		$controller = new EditPostController($dbc);
	break;


	default: // This is incomplete as we need a Error404.php template!
		require 'app/controllers/Error404Controller.php';
		$controller = new Error404Controller();
	break;

}


$controller->buildHTML();





