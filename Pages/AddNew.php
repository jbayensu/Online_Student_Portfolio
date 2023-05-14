
<?php
	require_once("../config/connection.php");
	require_once '../config/sessionConfig.php';
	$image = "3.jpg";
	$SoftName = "";
	$SoftPlatform = "";
	$SoftDesc = "";
	$SumDesc = "";
	$PostID = 0;

	if(isset($_GET['edit'])){

		$query = "SELECT * from portfoliotb where portfolioId = '{$_GET['edit']}';";
		$result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result)>0){
        	$row = mysqli_fetch_assoc($result);
			$SoftName = $row['exhibitName'];
			$SoftPlatform = $row['exhibitPlatform'];
			$SoftDesc = $row['exhibitDescription'];
			$SumDesc = $row['exhibitSummary'];
			$PostID = $row['portfolioId'];
			$image = $row['exhibitImgName'];
			$FileName_ = $row['exhibitFileName'];

			
		}

	}
		if(isset($_POST['submit'], $_FILES['imageUpload'])){

		$image_name = $_FILES['imageUpload']['name'];
        $image_size = $_FILES['imageUpload']['size'];
        $image_tmp = $_FILES['imageUpload']['tmp_name'];
        $image_type = $_FILES['imageUpload']['type'];
        $image_ext = strtolower(end(explode('.',$_FILES['imageUpload']['name'])));
        $expensions = array("jpeg", "jpg", "png");

        

		$File_name = $_FILES['softwareUpload']['name'];
        $File_size = $_FILES['softwareUpload']['size'];
        $File_tmp = $_FILES['softwareUpload']['tmp_name'];
        $File_type = $_FILES['softwareUpload']['type'];
        $File_ext = strtolower(end(explode('.',$_FILES['softwareUpload']['name'])));
        $File_expensions = array("rar", "zip");



        	if(in_array($image_ext, $expensions)===false){
	          	$error[]="extention not allowed, please choose a JPEG or PNG file.";
	        }
			if(in_array($File_ext, $File_expensions)===false){
		        $error[]="extention not allowed, please choose a rar or zip file.";
	        }

	        if($image_size > 2097152){
	          $error[]="file must be less or equal to 2 mb.";
	        }
	        if($File_size > 10485760){
	          $error[]="file must be less or equal to 10 mb.";
	        }

	        if(empty($error) == true){

	          	if($PostID == "0"){
		       	$query="INSERT into portfoliotb (username, exhibitName, exhibitPlatform, exhibitDescription, exhibitSummary) values ('".$_SESSION['user_name']."','".$_POST['SoftName']."','".$_POST['SoftPlatform']."','".$_POST['SoftDesc']."','".$_POST['SumDesc']."')";
					$is_inserted = mysqli_query($connection, $query);

	           
		           	if($is_inserted == 1){

		           		$query = "SELECT portfolioId, exhibitName from portfoliotb where username = '".$_SESSION['user_name']."' order by DatePosted desc limit 1";
		           		$rowk = mysqli_fetch_assoc(mysqli_query($connection, $query));
		           		$imgName = $rowk['exhibitName'] .".".$image_ext;
        				$fileName = $rowk['portfolioId'] .".".$File_ext;
        				$query="UPDATE portfoliotb set exhibitImgName = '".$imgName."', exhibitFileName = '".$fileName."' WHERE portfolioId = '".$rowk['portfolioId']."'";
						$is_updated = mysqli_query($connection, $query);
						if($is_updated == 1){
			           		move_uploaded_file($image_tmp, "../Images/".$imgName);
		          			move_uploaded_file($File_tmp, "../Files/".$fileName);
			                echo "success posting";  
			            }else{
		                	echo "error updating";
		            	}
		            }
		            else{
		                echo "error posting";
		            }			        

				}else{
					$imgName = $row['exhibitName'] .".".$image_ext;
        			$fileName = $row['portfolioId'] .".".$File_ext;
					$query="UPDATE portfoliotb set exhibitName = '".$_POST['SoftName']."', exhibitPlatform = '".$_POST['SoftPlatform']."', exhibitDescription = '".$_POST['SumDesc']."', exhibitImgName = '".$imgName."', exhibitFileName = '".$fileName."',exhibitSummary = '".$_POST['SumDesc']."', lastEdited = current_timestamp WHERE portfolioId = '".$PostID."'";
					$is_updated = mysqli_query($connection, $query);
	           
		           	if($is_updated == 1){
		           		
		           		move_uploaded_file($image_tmp, "../Images/".$imgName);
	          			move_uploaded_file($File_tmp, "../Files/".$fileName);
		                echo "success updating";  
		            }
		            else{
		                echo "error updating";
		            }
		        }
		        echo "success";
			}else{
	          	print_r($error);
	        }
		}
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once '../Web_Parts/HeaderLinks.php'; ?>
	<?php //require_once '../Web_Parts/WebControl.php'; ?>
	<script src="../Web_Resources/plugins/ckeditor/ckeditor.js"></script>


	<title>Add new</title>
</head>
<body style="background: gray; color: white;padding-top: 70px;">
	<?php require_once '../Web_Parts/Navbar.php'; ?>

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2>Add a New Software</h2>
			</div>
		</div>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-9">
					<div class="form-group">
						<label class="sr-only" for="SoftName">Name of software:</label>
						<input class="form-control" type="text" name="SoftName" value="<?php echo $SoftName; ?>" placeholder="Enter name of Software, media or material"/>
					</div>
					<div class="form-group">
						<label class="sr-only" for="SoftPlatform">Platform:</label>
						<input class="form-control" type="text" name="SoftPlatform" value="<?php echo $SoftPlatform; ?>" placeholder="Enter Platform"/>
					</div>
					<div class="form-group">
						<label class="" for="SoftDesc">Description, Requirement and Installation Information:</label>
						<textarea class="form-control" id="SoftDesc" value="<?php echo $SoftDesc; ?>" name="SoftDesc">
						<?php echo htmlspecialchars($SoftDesc); ?>
						</textarea>
						<script type="text/javascript">
							CKEDITOR.replace('SoftDesc',{
								toolbar : 'Basic',
								uiColor : '#9AB8F3'
							});
						</script>
					</div>
					<div class="form-group">
						<label class="" for="SumDesc">Summary:</label>
						<textarea class="form-control" id="SumDesc" value="<?php echo $SumDesc; ?>" name="SumDesc">
							<?php echo htmlspecialchars($SumDesc); ?>
						</textarea>
						<script type="text/javascript">
							CKEDITOR.replace('SumDesc',{
								toolbar : 'Basic',
								uiColor : '#9AB8F3'
							});
						</script>
					</div>
					
					<div class="form-group">
						<button class="btn btn-success form-control" type="submit" name="submit">Submit</button>
					</div>
				</div>
				<div class="col-md-3">
					<div class="panel" style="padding: 10px;">
						<img id="logoa" src="<?php echo '../Images/'.$image;?>" alt="<?php echo $image;?>" style="width: 100%; height: 230px;"/>
						<br><br>
						<label for="imageUpload" class="btn btn-primary form-control">Upload Software Image:</label>
						<input type="file" name="imageUpload" id="imageUpload" value="<?php echo '../Images/'.$image?>" style="position: fixed; top: -100em;"/>
					</div>
					<div class="panel" style="padding: 10px; color: black; overflow: hidden;">
						<label for="softwareUpload" class="btn btn-primary form-control">
							<input id="softwareUpload" type="file" name="softwareUpload" style="display: none;" onchange="$('#softwareInfo').html($(this).val());">Upload Software:
						</label>
						<span class="label label-info" id="softwareInfo"></span>
						<br>
						<br>
						<p>Note:
							<ul>
								<li>
									max file size: 10mb,
								</li>
								<li>
									compress with WinRar or 7zip
								</li>
							</ul>
						</p>
					</div>
					
				</div>
			</div>
		</form>
		
	</div>


	<?php require_once '../Web_Parts/Footer.php'; ?>
	<?php require_once '../Web_Parts/PageScripts.php'; ?>
	<script>
          function readURL(input){
            if(input.files && input.files[0]){
              var reader = new FileReader();

              reader.onload = function(e){
                $('#logoa').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
            }
          }

          $("#imageUpload").change(function(){
            readURL(this);
          })
      </script>
</body>
</html>