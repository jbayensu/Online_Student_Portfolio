<?php
	require_once("../config/connection.php");
	if(isset($_POST['Search'])){
	$value = $_POST['keyWord'];
	$query = "SELECT *, (SELECT count(comment) FROM commenttb WHERE portfolioId = a.portfolioId)  as 'comnum' FROM portfoliotb a WHERE PostStatus = 1 and (username LIKE '%$value%' OR exhibitName LIKE '%$value%' OR exhibitPlatform LIKE '%$value%') order by lastEdited desc;";
	$result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result)>0){
		    	
}
?>

<!DOCTYPE html>
<html>
<head>

	<?php require_once '../Web_Parts/HeaderLinks.php';?>
	<title></title>
</head>
<body style="background: gray;padding-top: 70px;">
	<?php require_once '../Web_Parts/Navbar.php'; ?>

	<div class="container">
		<div class="panel">
			<h3 style="text-align: center;">Search Result</h3>
			<h4 style="text-align: center;"><?php echo "found ". mysqli_num_rows($result);?></h4>
		</div>
		<?php
			
		    	while ($row = mysqli_fetch_assoc($result)) {
		    
	    ?>
		<div class="panel panel-default">
		  <div class="panel-heading">
		  	<h3>Author <?php echo ' '.$row['username'];?></h3>
		  </div>
		  <div class="panel-body">
		  
		  	<div class="col-sm-6 col-md-3">
			  <div class="thumbnail">
				    <img src="../Images/DSC00607.JPG" alt="...">
				</div>
				</div>
				<div class="col-md-9">
			    	<div class="caption">
				        <h3>Topic <?php echo $row['exhibitName']. ' '. '<small>'.$row['exhibitPlatform'].'</small>';
				        if($row['DatePosted'] != $row['lastEdited']){
				        	echo '<small style="color:red;"> (Edited)</small>&nbsp;';
				        }
				        ?></h3>
				        <p><?php echo $row['exhibitSummary'];?></p>
				        <p>Posted on: <?php echo $row['lastEdited'];?></p>
				     </div>
				     <br/>
				     <a href="Details.php?getPortfolioId=<?php echo $row['portfolioId'];?>" class="btn btn-primary pull-right">read more</a>
				 </div>
		    </div>
		  
		  <div class="panel-footer">
		  	<div class="form-group">
		  		<div class="pull-right">
		  			<span class="glyphicon glyphicon-comment badge" data-toggle="tooltip" data-placement="top" title="Comment"><span class="badge"><?php echo $row['comnum'];?></span></span>&nbsp;
		  			<span class="glyphicon glyphicon-thumbs-up badge" data-toggle="tooltip" data-placement="top" title="Like"><span class="badge"><?php echo $row['numLike'];?></span></span>&nbsp;
		  			<span class="glyphicon glyphicon-thumbs-down badge" data-toggle="tooltip" data-placement="top" title="Dislike"><span class="badge"><?php echo $row['numDislike'];?></span></span>
		  		</div>
		  	</div>
		  </div>
		  </div>

		<?php
			}
		}else{
		?>

		<div class="panel">
			<p>
				database not yet connected...
				no result found for your search...
			</p>
		</div>
		<?php
		}
		?>
	</div>

	<?php require_once '../Web_Parts/Footer.php'; ?>
	<?php require_once '../Web_Parts/PageScripts.php'; ?>
</body>
</html>