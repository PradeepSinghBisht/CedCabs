<?php
	 require "User.php";
	 $user = new User();
	 $db = new Dbconnection();
     $errors = array();
     session_start();
 
    if (isset($_POST['update'])) {
        $password = isset($_POST['password'])?MD5($_POST['password']):'';
        $confirmpassword = isset($_POST['confirmpassword'])?MD5($_POST['confirmpassword']):'';
    
        $errors = $user->changepassword($errors, $password, $confirmpassword, $db->conn);
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
<div class="container-fluid" id='main'>
    <div id = "errors">
        <?php foreach ($errors as $key=>$value) { ?>
            <li> 
                <?php echo $errors[$key]['msg'];
        } ?> 
            </li>
    </div>
	<div class="jumbotron" id='jumb'>
		<div class="col-md-3 col-lg-3 col-sm-1">
		</div>
		<div class="col-md-6 col-lg-6 col-sm-10" id='abc'>
			<center>
				<a href="#"><img style="margin:-65px 0px -60px;" src="cedcabs.png" alt="" /></a>
			</center>
			<h2 style="text-align: center;">Update Information</h2>
			<form action="changepassword.php" method="POST">
				<div class="form-group " style="padding: 5px 0px;">
					<label for='password'>Password:</label>
					<input type="password" class='form-control' name="password">
				</div>
				<div class="form-group " style="padding: 5px 0px;">
					<label for='confirmpassword'>Confirm Password:</label>
					<input type="password" class='form-control' name="confirmpassword">
                </div>
				<div class="form-group " style="padding: 10px 0px;">
					<input type="submit" class="btn btn-success form-control"  name="update" value="Update" style="padding: 5px 30px;">
				</div>
			</form>
			<a class="btn btn-success form-control" href="index.php">Back</a>
	</div>
</div>
</body>
</html>