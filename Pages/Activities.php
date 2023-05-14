<?php
require_once("../config/connection.php");
if(isset($_GET['deleteid'])){
	$query = "SELECT portfolioId from commenttb where portfolioId = {$_GET['deleteid']}'";
	if(mysqli_query($connection, $query)){
		$query="DELETE FROM commenttb WHERE portfolioId ='{$_GET['deleteid']}'";
		if(mysqli_query($connection, $query)){

		}else{
			echo "error: could not delete item from commenttb";
		}
	}else{
		echo "error: item not found in commenttb";
	}
	
	$query="DELETE FROM portfoliotb WHERE portfolioId ='{$_GET['deleteid']}'";
	if(mysqli_query($connection, $query)){
		header('Refresh:0; MyPage.php');

	}else{
		echo "error: could not delete item from portfoliotb";
	}
	
}

?>
