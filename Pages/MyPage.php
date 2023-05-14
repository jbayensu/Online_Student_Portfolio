<?php
	require_once("../config/connection.php");

	if(isset($_GET['show'])){
		$portfolioId = $_GET['getPortfolioId'];
		$query = "UPDATE portfoliotb set PostStatus = 1 WHERE portfolioId = '$portfolioId'";
		mysqli_query($connection, $query);
		//header('details.php');
		
	}elseif(isset($_GET['hide'])){
		$portfolioId = $_GET['getPortfolioId'];
		$query = "UPDATE portfoliotb set PostStatus = 0 WHERE portfolioId = '$portfolioId'";
		mysqli_query($connection, $query);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once '../Web_Parts/HeaderLinks.php';
	require_once '../config/sessionConfig.php'; ?>
	<?php //require_once '../Web_Parts/WebControl.php'; ?>
	<link href="../Web_Resources/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
	<title>My Portfolio</title>
</head>
<body style="background: gray;padding-top: 70px;">
	<?php require_once '../Web_Parts/Navbar.php'; ?>

	<div class="container">
	<div class="row">
		<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				My Portfolios
		  		<a href="AddNew.php" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"></span></a>
		  	
			</div>
			<div class="panel-body">
				<div class="row table-responsive">
				<div class="col-md-12">
					<table id="example2" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>no.</th>
								<th>Material Name</th>
								<th>Date Posted</th>
								<th>Last Edited</th>
								<th><span class="glyphicon glyphicon-comment" data-toggle="tooltip" data-placement="top" title="number of comments"></span></th>
								<th><span class="glyphicon glyphicon-thumbs-up" data-toggle="tooltip" data-placement="top" title="number of likes"></span></th>
								<th><span class="glyphicon glyphicon-thumbs-down" data-toggle="tooltip" data-placement="top" title="number of Dislike"></span></th>
								<th><span class="glyphicon glyphicon-download" data-toggle="tooltip" data-placement="top" title="Number of downloads"></span></th>
								<th>Update</th>
								<th>Visible</th>
								<th>delete</th>
							</tr>
						</thead>

						
<?php
		$username = $_SESSION['user_name'];
		$query = "SELECT *,(SELECT count(comment) FROM commenttb WHERE portfolioId = a.portfolioId)  as 'comnum' FROM portfoliotb a 
		WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        $i = 0;
        if(mysqli_num_rows($result)>0){
        	
            while ($row = mysqli_fetch_assoc($result)) {
            $i++;	
          		

	?>					
						<tbody>
							<tr>
								<td style="width: 5px;"><?php echo $i?></td>
								<td><a href="Details.php?getPortfolioId=<?php echo $row['portfolioId'];?>">Topic <?php echo $row['exhibitName'];?></a></td>
								<td><?php echo $row['DatePosted'];?></td>
								<td><?php echo $row['lastEdited'];?></td>
								<td><?php echo $row['comnum'];?></td>
								<td><?php echo $row['numLike'];?></td>
								<td><?php echo $row['numDislike'];?></td>
								<td><?php echo $row['numDownloaded'];?></td>
								<td style="width: 20px;"><a href="addnew.php?edit=<?php echo $row['portfolioId']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
								<td style="width: 20px;">
								<label id="labl" for="btnShow" class="sr-only"><?php echo 1?></label>
								<?php
									if($row['PostStatus'] == 0){
										?>
										<a href="mypage.php?show&getPortfolioId=<?php echo $row['portfolioId'];?>" class="btn btn-success"><span class="glyphicon glyphicon-ok" data-toggle="tooltip" data-placement="top" title="display to public"></span></a></td>
										<?php
									}else{
										?>
										<a href="mypage.php?hide&getPortfolioId=<?php echo $row['portfolioId'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="hide from public"></span></a></td>
										<?php
									}
								?>
								
								<td><a href="javascript:;" class="item-delete" id="Activities.php?deleteid=<?php echo $row['portfolioId'];?>"><span class="glyphicon glyphicon-trash"></span></a></td>
							</tr>
						
	<?php
		}
	}
	?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--<div class="col-md-2">
		<div class="form-group">
			<a href="AddNew.php" class="btn btn-success form-control">Post New</a>
		</div>-->
	</div>
</div>
</div>

	<?php require_once '../Web_Parts/Footer.php'; ?>
	<?php require_once '../Web_Parts/PageScripts.php'; ?>
	<script src="../Web_Resources/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
      <script src="../Web_Resources/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
	<script>
	$(function() {
	        $("#example1").dataTable({
	            
	        });
	        $('#example2').dataTable({
	            "bPaginate": true,
	            "bLengthChange": false,
	            "bFilter": true,
	            "bSort": false,
	            "bInfo": true,
	            "bAutoWidth": true
        });
    });

    $(function(){
 		$('.item-delete').click(function(){
 			var id=$(this).attr('id');
 			if(confirm('Do you want to delete this Exhibit?')){

 				window.location.href=id;
 			}
 			
 		})
 		
 	})

    function changeIcon(button){
    	var x = document.getElementById("visible");
    	var y= document.getElementById("labl").innerHTML;
    	if(y==1){
    		document.getElementById("visible").class = "btn btn-success";
    		$(button).find(".glyphicon").removeClass("glyphicon-remove").addClass("glyphicon-ok");
    		document.getElementById("labl").innerHTML = 0;
    	}else{
    		document.getElementById("visible").class = "btn btn-warning";
    		$(button).find(".glyphicon").removeClass("glyphicon-ok").addClass("glyphicon-remove");
    		document.getElementById("labl").innerHTML = 1;
    	}
    	
    }

	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
	
	</script>
</body>
</html>