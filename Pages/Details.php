<?php
	require_once("../config/connection.php");
	require_once("../classes/Login.php");
	$login = new Login();
	global $dow;

	if($login->isUserLoggedIn() == true){
		$username = $_SESSION['user_name'];
		$query = "SELECT * FROM likedisliketb WHERE portfolioId = '{$_GET['getPortfolioId']}' and username = '$username'";
		$rowc = mysqli_fetch_assoc(mysqli_query($connection, $query));
		$like = $rowc['likeStatus'];
		$dislike = $rowc['dislikeStatus'];
	}else{
		$like = 0;
		$dislike = 0;
	}


	if(isset($_POST['submitComment'])){

		if($_POST['formid'] == $_SESSION['formid']){
			$_SESSION['formid'] = "";
			if($login->isUserLoggedIn() == true){
				$username = $_SESSION['user_name'];
				$portfolioId = $_GET['getPortfolioId'];
				if(!empty($_POST['comment'])){
						$query = "INSERT INTO commenttb (commentorName, portfolioId, comment) values ('$username', '$portfolioId', '".$_POST['comment']."')";
						mysqli_query($connection, $query);
						//header('Location: Details.php?getPortfolioId');
				}else
				{
					echo "you must first register or log in.";
				}
			}
		}
	}else{
		$_SESSION['formid'] = md5(rand(0,10000000));
	}

	if(isset($_GET['like'])){
		if($login->isUserLoggedIn() == true){
			$username = $_SESSION['user_name'];
			$portfolioId = $_GET['getPortfolioId'];
			$query = "INSERT INTO likedisliketb (username, portfolioId, likeStatus) values ('$username', '$portfolioId', 1)";
			mysqli_query($connection, $query);
			$like = 1;
			$query = "UPDATE portfoliotb set numLike = numLike + 1 WHERE portfolioId = '$portfolioId'";
			mysqli_query($connection, $query);
			//header('details.php');
		}else
		{
			echo "you must first register or log in.";

		}
	}

	if(isset($_GET['dislike'])){
		if($login->isUserLoggedIn() == true){
			$username = $_SESSION['user_name'];
			$portfolioId = $_GET['getPortfolioId'];
			$query = "INSERT INTO likedisliketb (username, portfolioId, dislikeStatus) values ('$username', '$portfolioId', 1)";
			mysqli_query($connection, $query);
			$dislike = 1;
			$query = "UPDATE portfoliotb set numDislike = numDislike + 1 WHERE portfolioId = '$portfolioId'";
			mysqli_query($connection, $query);
		}else
		{
			echo "you must first register or log in.";

		}
	}

	
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once '../Web_Parts/HeaderLinks.php'; ?>
	<script src="../Web_Resources/plugins/ckeditor/ckeditor.js"></script>
	<title></title>
</head>
<body style="background: gray;padding-top: 70px;">
	<?php require_once '../Web_Parts/Navbar.php'; ?>

		<div class="container">
			<div class="col-md-10 col-md-offset-1">
			<?php
			if(isset($_GET['getPortfolioId'])){
				$_SESSION['downnum'] = $_GET['getPortfolioId'];
				$query = "SELECT * FROM portfoliotb	WHERE portfolioId = '{$_GET['getPortfolioId']}'";
			    $result = mysqli_query($connection, $query);
			    if(mysqli_num_rows($result)>0){
			    	$row = mysqli_fetch_assoc($result);
			    	$numDownloaded = $row['numDownloaded'];
			    }
			?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-8">
								<div>
									<h1><?php echo $row['exhibitName'];?> <small><?php echo $row['exhibitPlatform'];?></small></h1>
									<h3><small><?php echo $row['DatePosted'];?></small></h3>
								</div>
							</div>
							<div class="col-md-4">
								<div class="pull-right">
									<img src="../Images/3.JPG" alt="" style="width: 70px; height: 70px;">
									<h4><?php echo $row['username'];?><br> <small>(developer)</small></h4>
								</div>
							</div>	
						</div>
					</div>
					<div class="panel-body">

						<div class="col-xs-6 col-md-3 pull-right">
						    <a href="#" class="thumbnail">
						      <img src="<?php echo '../Images/'.$row['exhibitImgName'] ?>" alt="3">
						    </a>
						</div>
						
						<h2>Description:</h2>
						<p>
							<?php echo ' '.$row['exhibitDescription'];?>

						</p>
						
						<a href="<?php echo '../Files/'.$row['exhibitFileName'];?>" id="a" class="btn btn-success" name="SoftDownload">Download Software&nbsp;<span class="glyphicon glyphicon-download"></span></a><br>
						<span>number downloaded: <span id="dwNum" class="label label-success"></span></span><br><br>
						

					</div>
					<div class="panel-footer">
						<a href="#collapseComment" role="button" data-toggle="collapse" aria-expended = "false" aria-control="collapseComment"><span class="glyphicon glyphicon-comment"><span><?php //echo $b?></span></span></a>&nbsp;
						<?php
							if($like == 0 && $dislike == 0){
								?>
								<a href="Details.php?like&getPortfolioId=<?php echo $_GET['getPortfolioId']; ?>"><span class="glyphicon glyphicon-thumbs-up"><span><?php //echo $b?></span></span></a>&nbsp;
								<a href="Details.php?dislike&getPortfolioId=<?php echo $_GET['getPortfolioId']; ?>"><span class="glyphicon glyphicon-thumbs-down"><span><?php //echo $c?></span></span></a>;
								<?php
							}else{
								if($like == 1){
									?>
									<a href="#"><span class="badge"><span class="glyphicon glyphicon-thumbs-up"></span></span></a>&nbsp;
									<a href="#"><span class="glyphicon glyphicon-thumbs-down"><span><?php //echo $c?></span></span></a>;
									<?php
								}elseif($dislike == 1){
									?>
									<a href="#"><span class="glyphicon glyphicon-thumbs-up"><span><?php //echo $b?></span></span></a>&nbsp;
									<a href="#"><span class="badge"><span class="glyphicon glyphicon-thumbs-down"></span></span></a>;
									<?php
								}
							}
						?>
						
						<div class="collapse" id="collapseComment">
							<div class="form-group">
								<form method="POST" action="">
									<label class="" for="commentorName">User Name:</label>
									<input type="text" name="commentorName" class="form-control"/><br>
									<label class="" for="comment">Post a Comment:</label>
									<textarea class="form-control" id="comment" name="comment">&lt;Initial value.&lt;/p&gt;</textarea>
									<script type="text/javascript">
										CKEDITOR.replace('comment',{
											toolbar : 'Basic'
										});
									</script><br>
									<input type="hidden" name="formid" value="<?php echo $_SESSION['formid'];?>"/>
									<input type="submit" name="submitComment" class="btn btn-success form-control" value="Submit"/>
								</form>
							</div>
							
						</div>
					</div>
				</div>

				<div class="panel panel-default">

					
							<div class="panel-heading">Commnents</div>
							<div class="panel-body">
							<?php
								$a = $row['portfolioId'];
								$queryb = "SELECT * FROM commenttb WHERE portfolioId = '$a'";
							    $resultb = mysqli_query($connection, $queryb);
							    if(mysqli_num_rows($resultb)>0){
							    	while($rowb = mysqli_fetch_assoc($resultb)){
							    ?>
									<div class="panel panel-info">
										<div class="panel-heading"><h4><?php echo $rowb['commentorName'];?><small><?php echo ' '.$rowb['datePosted'];?></small></h4></div>
										<div class="panel-body">
											<?php echo $rowb['comment'];?>
										</div>
										<div class="panel-footer">
											<a href="#" role="button"><span class="glyphicon glyphicon-thumbs-up"><span><?php $rowb['numLike'];?></span></span></a>&nbsp;
		  									<a href="#" role="button"><span class="glyphicon glyphicon-thumbs-down"><span><?php $rowb['numDislike'];?></span></span></a>
										</div>
									</div>
									<?php
								}
							}else{
								?>
								no comment...

								<?php
							}
						}

							?>
							</div>
						</div>
			</div>
		</div>
		<div id="downloadDiv" class="hidden"></div>
		<div id="showdownl" class="hidden"></div>

	<?php require_once '../Web_Parts/Footer.php'; ?>
	<?php require_once '../Web_Parts/PageScripts.php'; ?>
	<script type="text/javascript">
		
		$('#a').click(function(){
			$('#downloadDiv').load('../classes/downloadnum.php');
		});

		$(document).ready(function() {
			
			clock = $('.clock').FlipClock({
		        clockFace: 'MinuteCounter',
		        callbacks: {
		        	interval: function() {
		        		$("#showdownl").load('../classes/showDownload.php');
                        $("#dwNum").text($("#downData").text());
                                        
		        	}
		        }
		    });
		});

	</script>
	
</body>
</html>