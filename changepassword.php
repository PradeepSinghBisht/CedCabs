<?php
	 require "User.php";
	 $user = new User();
	 $db = new Dbconnection();
	 $errors = array();
	 session_start();

	if (isset($_SESSION['userdata'])) {
        if ($_SESSION['userdata']['is_admin'] == '1') {
            header('Location: Backend/admindashboard.php');
        }
    } else {
        header('Location: index.php');
    }
 
    if (isset($_POST['update'])) {
		$password = isset($_POST['password'])?MD5($_POST['password']):'';
		
		$confirmpassword = isset($_POST['confirmpassword'])?MD5($_POST['confirmpassword']):'';
		
		if ($password != $confirmpassword) {
			$errors[] = array('msg'=>'Password Doesn\'t Match');
		}

		if (sizeof($errors) == 0) {
			$errors = $user->changepassworduser($password, $db->conn, $errors);
			
		}
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Password</title>
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="style.css">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
	body{
		margin: 0;
		padding: 0;
		font-family:century gothic;
		color:white;
	}
	#main{
		background-image:linear-gradient(#B81D22,grey,black);
		background-size:100% 100%;
	}
	#jumb{
		position:relative;
		background-color: rgba(0,0,0,0);
		color:white;
	}
	a{
		color:white;
	}
	#abc{
		background-color: rgba(0,0,0,0.1);
		padding: 50px;
		margin-bottom:100px;
	}
	</style>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-md navbar-light py-2">
            <div class="container">
                <img src="cedcabs.png" alt="CedCabs" id="logo">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto" id="navbtn">
                        <a class="nav-item btn mx-3 py-2" href="index.php" id="book">Book Now<span
                                class="sr-only">(current)</span></a>
                        <?php 
                            if (isset($_SESSION['userdata'])) {
                                echo '<li class="nav-item dropdown ml-3">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Rides
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="pendingrides.php">Pending Rides</a>
                                        <a class="dropdown-item" href="completedrides.php">Completed Rides</a>
                                        <a class="dropdown-item" href="cancelledrides.php">Cancelled Rides</a>
                                        <a class="dropdown-item" href="previousrides.php">All Rides</a>
                                      </li>  
                                      <li class="nav-item dropdown ml-3">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Account Info
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="updateinfo.php">Update Account</a>
                                        <a class="dropdown-item" href="changepassword.php">Change Password</a>
                                       </li>
                                       <li> 
                                        <a class="nav-item nav-link ml-3" href="userdashboard.php">DashBoard</a>
                                    </li>
                                    <a class="nav-item nav-link ml-3" href="logout.php">Logout</a>';
                            } else {
                                echo '<a class="nav-item nav-link mx-3" href="#">Our Services</a>
                                      <a class="nav-item nav-link mx-3" href="#">About Us</a>
                                      <a class="nav-item nav-link ml-3" href="#">Contact Us</a>
                                      <a class="nav-item nav-link ml-3" href="login.php">Login</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
<div class="container-fluid" id='main'>
    <div id = "errors">
		<?php foreach ($errors as $key=>$value) { 
				echo "<h3 class='text-center'><li>".$errors[$key]['msg']."</li></h3>";  
			}
		?> 
    </div>
	<div class="jumbotron row pt-5 pb-0 mb-0" id='jumb'>
		<div class="col-md-3 col-lg-3 col-sm-1">
		</div>
		<div class="col-md-6 col-lg-6 col-sm-10 mb-4" id='abc'>
			
			<h2 style="text-align: center;">Change Password</h2>
			<form action="changepassword.php" method="POST">
				<div class="form-group " style="padding: 5px 0px;">
					<label for='password'>New Password:</label>
					<input type="password" class='form-control' name="password" required>
				</div>
				<div class="form-group " style="padding: 5px 0px;">
					<label for='confirmpassword'>Confirm Password:</label>
					<input type="password" class='form-control' name="confirmpassword" required>
                </div>
				<div class="form-group " style="padding: 10px 0px;">
					<input type="submit" class="btn btn-success form-control"  name="update" value="Update" style="padding: 5px 30px;">
				</div>
			</form>
			<a class="btn btn-primary form-control" href="index.php">Back</a>
	</div>
</div>
</div>
<footer>
        <div id="footer" class="container">
            <div class="row my-4 text-center">
                <div id="footer1" class="col-md-4 col-lg-4 py-4">
                    <i class="fa fa-facebook" aria-hidden="true" style="padding: 13px 16px;font-size: 22px;"></i>
                    <i class="fa fa-twitter" aria-hidden="true" style="padding: 13px;font-size: 22px;"></i>
                    <i class="fa fa-instagram" aria-hidden="true" style="padding: 13px;font-size: 22px;"></i>
                </div>
                <div id="footer3" class="col-md-4 col-lg-4 py-4">
                    <ul>
                        <li><a href="#features">FEATURES</a></li>
                        <li><a href="#reviews">REVIEWS</a></li>
                        <li><a href="#signup">SIGNUP</a></li>
                    </ul>
                </div>
                <div id="footer2" class="col-md-4 col-lg-4">
                    <img src="cedcabs.png" alt="CedCabs" id="logo">
                    <p style="color:black"><i class="fa fa-heart" aria-hidden="true" style="color: red;"></i> Designed by <strong>Pradeep
                            Singh Bisht</strong></p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>