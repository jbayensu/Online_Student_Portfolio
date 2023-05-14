<?php
	require_once("../config/connection.php");
	require_once("../classes/Login.php");
	$login = new Login();
	
	$portfolioId = $_SESSION['downnum'];
	$query = "select numDownloaded from portfoliotb where portfolioId = '$portfolioId'";
	$row = mysqli_fetch_assoc(mysqli_query($connection, $query));
	
	$numDownloaded = $row['numDownloaded'];
	
	if($numDownloaded ===0){?>
		<div id="downData"></div>
	<?php }else{ ?>
		<div id="downData"><?php echo $numDownloaded; ?></div>
	<?php }

?>