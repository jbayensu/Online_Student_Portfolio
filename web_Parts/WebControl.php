<?php
	
	//session_start();
	$userid="none";
	if(isset($_SESSION['userid'])){
		$userid = $_SESSION['userid'];

	}
	
	if($userid == "none"){
		header("Location:../Pages/index.php");
	}
	
	date_default_timezone_get("Europe/London");

?>