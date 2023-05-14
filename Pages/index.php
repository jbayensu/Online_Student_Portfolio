<?php
	require_once("../config/connection.php");

?>

<!DOCTYPE html>
<html>
<head>
	<?php require_once '../Web_Parts/HeaderLinks.php'; ?>
	<title>Home</title>
</head>
<body style="background: gray;padding-top: 70px;">
	<?php require_once '../Web_Parts/Navbar.php'; ?>
	

	<div class="container">	
		<div class="col-md-10 col-md-offset-1">
		<div class="row">
				<?php
				// show potential errors / feedback (from login object)
				if (isset($login)) {
				    if ($login->errors) {
				        foreach ($login->errors as $error) {
				        	
				            echo '<div class="panel" style="background:orange; padding:5px; text-align:center;">'. $error. '</div>';
				           
				        }
				    }
				    if ($login->messages) {
				        foreach ($login->messages as $message) {
				        	
				            echo '<div class="panel" style="background:orange; padding:5px; text-align:center;">'. $message. '</div>';
				           
				        }
				    }
				}

				if (isset($registration)) {
				    if ($registration->errors) {
				        foreach ($registration->errors as $error) {
				            
				            echo '<div class="panel" style="background:orange; padding:5px; text-align:center;">'. $error. '</div>';
				            
				        }
				    }
				    if ($registration->messages) {
				        foreach ($registration->messages as $message) {
				         
				            echo '<div class="panel" style="background:orange; padding:5px; text-align:center;">'. $message. '</div>';
				           
				        }
				    }
				}
				
				?>
		</div>

	<?php
		$query = "SELECT *,(SELECT count(comment) FROM commenttb WHERE portfolioId = a.portfolioId) as 'comnum' FROM portfoliotb a  WHERE postStatus = 1 order by lastEdited desc;";
        $result = mysqli_query($connection, $query);
        
        if(mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_assoc($result)) {
            	
          		

	?>
	<div class="row">
		<div class="panel panel-default">
		  <div class="panel-heading">
		  	<h3><?php echo ' '.$row['username'];?><small> (Developer)</small></h3>
		  	<span><?php echo ' '.$row['DatePosted'];?></span>
		  </div>
		  <div class="panel-body">
		  
		  	<div class="col-sm-6 col-md-3">
			  <div class="thumbnail">
				    <img src="<?php echo '../Images/'.$row['exhibitImgName'] ?>" alt="...">
				</div>
				</div>
				<div class="col-md-9">
			    	<div class="caption">
				        <h3><?php echo $row['exhibitName'];
				        if($row['DatePosted'] != $row['lastEdited']){
				        	echo ' '.'<small style="color:red;">(Edited)</small>&nbsp;';
				        }
				        ?></h3>
				        <p><?php echo $row['exhibitSummary'];?></p>
				     </div>
				     <br/>
				     <a href="Details.php?getPortfolioId=<?php echo $row['portfolioId'];?>" class="btn btn-primary pull-right">read more</a>
				 </div>
		    </div>
		  
		  <div class="panel-footer">
		  	<div class="form-group">
		  		<div class="pull-right">
		  			<span class="glyphicon glyphicon-comment label label-primary" data-toggle="tooltip" data-placement="top" title="Comment"><?php echo ' '.$row['comnum'];?></span>&nbsp;
		  			<span class="glyphicon glyphicon-thumbs-up label label-primary" data-toggle="tooltip" data-placement="top" title="Like"><?php echo ' '.$row['numLike'];?></span>&nbsp;
		  			<span class="glyphicon glyphicon-thumbs-down label label-primary" data-toggle="tooltip" data-placement="top" title="Dislike"><?php echo ' '.$row['numDislike'];?></span>
		  		</div>
		  	</div>
		  </div>
		  </div>
		</div>
	<?php
			}	
		}
	?>
	</div>
</div>


	<?php require_once '../Web_Parts/Footer.php'; ?>
	<?php require_once '../Web_Parts/PageScripts.php'; ?>
	<script type="text/javascript">
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
</body>
</html>