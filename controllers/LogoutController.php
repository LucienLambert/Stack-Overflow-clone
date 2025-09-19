<?php 
class LogoutController{

	public function __construct() {
	
	}
		
	public function run() {
        # (re-)initialize the table of session variables
		$_SESSION = array();

		# Destroy the session
		#session_destroy();

		# his controllers does not display a view, it redirects to the home.
		header("Location: index.php"); 
		die();
	}
	
} 
?>