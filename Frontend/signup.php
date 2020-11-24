<?php
     require "User.php";
     $user = new User();
     $db = new Dbconnection();
     $errors = array();

if (isset($_POST['register'])) {
    $username = isset($_POST['username'])?$_POST['username']:'';
    $name = isset($_POST['name'])?$_POST['name']:'';
    $mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';
    $confirmpassword = isset($_POST['confirmpassword'])?$_POST['confirmpassword']:'';
    $isadmin = isset($_POST['isadmin'])?$_POST['isadmin']:'';

    $errors = $user->signup($errors, $username, $name, $mobile, $password, $confirmpassword, $isadmin, $db->conn);

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
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
				<a href="index.html"><img style="margin:-65px 0px -60px;" src="cedcabs.png" alt="" /></a>
			</center>
			<h2 style="text-align: center;">Register Here</h2>
			<form action="signup.php" method="POST">
                <div class="form-group " style="padding: 5px 0px;">
					<label for='username'>Username:</label>
					<input type="text" class='form-control' name="username" required>
				</div>
                <div class="form-group" style="padding: 5px 0px;">
					<label for='name'>Name:</label>
					<input type="text" class='form-control' name="name" required>
				</div>
				<div class="form-group " style="padding: 5px 0px;">
					<label for='mobile'>Mobile:</label>
					<input type="number" class='form-control' name="mobile" required>
				</div>
				<div class="form-group " style="padding: 5px 0px;">
					<label for='password'>Password:</label>
					<input type="password" class='form-control' name="password" required>
				</div>
				<div class="form-group " style="padding: 5px 0px;">
					<label for='confirmpassword'>Confirm Password:</label>
					<input type="password" class='form-control' name="confirmpassword" required>
                </div>
                <div class="form-group" style="padding: 5px 0px;">
                    <label for='isadmin'>Role</label>
                    <select name="isadmin" class="form-control">
                        <option value="">Select From The List</option>
                        <option value="1">Admin</option>
                        <option value="0">Customer</option>
                    </select>
                </div>
				<div class="form-group " style="padding: 10px 0px;">
					<input type="submit" class="btn btn-success form-control"  name="register" value="Register" style="padding: 5px 30px;">
				</div>
				<p style="font-size:16px; font-style:bold;color:white;text-align: center;">Already have account? <a href="login.php"> Click Here</a></p>
			</form>
	</div>
</div>
</body>
</html>