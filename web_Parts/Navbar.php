
<?php
	// include the configs / constants for the database connection
require_once("../config/connection.php");
require_once("../config/db.php");

// load the login class
require_once("../classes/Login.php");
$login = new Login();
require_once("../classes/Registration.php");
$registration = new Registration();
$image = "../Images/3.JPG";

?>


	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myLinks" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">E-Portfolio</a>
			</div>

			<div class="collapse navbar-collapse" id="myLinks">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="index.php"><span class="glyphicon glyphicon-home"></span></a>
					</li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-option-vertical"></span></a>
			          <ul class="dropdown-menu">
			          	<?php
			          		if($login->isUserLoggedIn() == true){
			          			$username = $_SESSION['user_name'];
								$query = "SELECT count(*) as 'postNum' FROM portfoliotb WHERE username = '$username'";
								$row = mysqli_fetch_assoc(mysqli_query($connection, $query));
			          	?>
			          			<div class="panel panel-default" style="width: 300px;">
					          		<div class="panel-heading">
						          		<a href="profile.php"><img src="<?php echo $image;?>" alt="" style="margin-left: 90px; width: 70px; height: 70px;"></a>
						          		<br><br>
										<label style="margin-left: 90px;">developer:</label>
										<h3 style="text-align: center;"><?php echo $_SESSION['user_name']; ?></h3>

						          	</div>
						          	<div class="panel-body">
						          		<a href="MyPage.php">number of posts</a>:
						          		<span class="badge"><?php echo $row['postNum'];?></span>
						          	</div>
					            	<div class="panel-footer">
					            		<a href="AddNew.php" class="btn btn-primary">Post New</a>
					            		<a href="MyPage.php" class="btn btn-primary">My Posts</a>
					            		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myLogOutModal">Log out</button>
					            	</div>
					          	</div>
					    <?php
			          		}
			          		else{

			          	?>		
			          		<div class="panel panel-default" style="width: 200px;">
			          			<div class="panel-heading">
			          				<h5>Hello Guest..</h5>
			          			</div>
			          			<div class="panel-body">
			          				<label>Already a member?</label>
			          				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myLogInModal">Log in</button>
			          			</div>
			          			<div class="panel-footer">
			          				<label>Become a member?</label>
			          				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myRegModal">Sign Up</button>
			          			</div>
			          		</div>
			          			
			          	<?php
			          		}
			          	?>
			          	
			          </ul>
			        </li>
			      </ul>
				<form class="navbar-form navbar-right" role="search" method="POST" action="SearchResult.php">
					<div class="form-group">
						<input type="text" class="form-control" name="keyWord" placeholder="Search"></input>
					</div>
					<button type="submit" name="Search" class="btn btn-default">Submit</button>
					
				</form>

			</div>
		</div>
	</nav>

	<!-- Log In Modal -->
	<div class="modal fade" id="myLogInModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Log in</h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-bottom">
				<form role="form" action="index.php" method="post" class="login-form">
	            	<div class="form-group">
	            		<label class="sr-only" for="form-username">Username</label>
	                	<input type="text" name="user_name" placeholder="Username..." class="form-control" id="form-username" required/>
	                </div>
	                <div class="form-group">
	                	<label class="sr-only" for="form-password">Password</label>
	                	<input type="password" name="user_password" placeholder="Password..." class="form-control" id="form-password" autocomplete="off" required>
	                </div>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        		<input name="login" type="submit" class="btn btn-success" value="Log in"></input>
	            </form>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <a href="#">Having problem signing up?</a>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Log Out Modal -->
	<div class="modal fade" id="myLogOutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">You will be Logged out</h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-bottom">
				<form role="form" action="" method="post" class="login-form">
	                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
	        		<a href="index.php?logout" class="btn btn-success">Ok!</a>
	            </form>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Register Modal -->
	<div class="modal fade" id="myRegModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">New Developer</h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-bottom">
				<form role="form" action="index.php" method="post" class="login-form">
					<div class="form-group">
	                	<label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
    					<input id="login_input_username" class="login_input form-control" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
	                </div>
	            	<div class="form-group">
	            		<!-- the email input field uses a HTML5 email type check -->
					    <label for="login_input_email">User's email</label>
					    <input id="login_input_email" class="login_input form-control" type="email" name="user_email" required />
	                </div>
	                <div class="form-group">
	                	<label for="login_input_password_new">Password (min. 6 characters)</label>
    					<input id="login_input_password_new" class="login_input form-control" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
	                </div>
	                <div class="form-group">
	                	<label for="login_input_password_repeat">Repeat password</label>
    					<input id="login_input_password_repeat" class="login_input form-control" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
   
	                </div>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        		<button name="register" type="submit" class="btn btn-success">Submit!</button>
	            </form>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <a href="#">Having problem signing up?</a>
	      </div>
	    </div>
	  </div>
	</div>