<?php
	require_once("../config/connection.php");
	require_once("../classes/Login.php");
	$login = new Login();
	
		$portfolioId = $_SESSION['downnum'];
		
		$query = "UPDATE portfoliotb set numDownloaded = numDownloaded + 1 WHERE portfolioId = '$portfolioId'";
		if(mysqli_query($connection, $query)){
			$query = "select numDownloaded from portfoliotb where portfolioId = '$portfolioId'";
			$row = mysqli_fetch_assoc(mysqli_query($connection, $query));
			$numDownloaded = $row['numDownloaded'];
		}else{
			echo 'not done';
		}
	
		
?>