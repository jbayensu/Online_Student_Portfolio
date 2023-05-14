<?php
	require_once '../config/sessionConfig.php';
	$image = "../Images/me.jpg";
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once '../Web_Parts/HeaderLinks.php'; ?>
	<title></title>
</head>
<body style="background: gray;padding-top: 70px;">
	<?php require_once '../Web_Parts/Navbar.php'; ?>>
<form method="POST" action="">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel">
					<img id="logoa" src="<?php echo $image?>" alt="myImage" style="width: 100%; height: 230px;"/>
					<br><br>
					<label for="imageUpload" class="btn btn-primary form-control">Upload Software Image:</label>
					<input type="file" name="imageUpload" id="imageUpload" value="<?php echo $image?>" style="position: fixed; top: -100em;"/>
				</div>
			</div>
		</div>
	</div>
</form>


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