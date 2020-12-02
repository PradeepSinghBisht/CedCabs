<?php
    require "User.php";
    $user = new User();
    $db = new Dbconnection();
	$errors = array();
	session_start();

if (isset($_POST['login'])) {
    $username = isset($_POST['username'])?$_POST['username']:'';
	$password = isset($_POST['password'])?md5($_POST['password']):'';
	$remember = isset($_POST['remember'])?$_POST['remember']:'';
	
	$rows = $user->login($username, $password, $db->conn);
	
	foreach ($rows as $row) {

		if ($remember != '') {
			setcookie('username', $username, time() + (86400 * 1)); // 1 day
		} else {
			setcookie("username", "", time() - 3600); // Delete Cookie
		}

		if ($row['isblock'] == 1 and $row['is_admin'] == 0) {
			$_SESSION['userdata'] = array('user_id'=>$row['user_id'],
			'user_name'=>$row['user_name'], 'name'=>$row['name'],
			'dateofsignup'=>$row['dateofsignup'], 'mobile'=>$row['mobile'], 
			'isblock'=>$row['isblock'], 'is_admin'=>$row['is_admin']);

			if (time() - $_SESSION['timer'] > 180) {  
				unset($_SESSION['landingdata']);
				header('location:userdashboard.php');
			} else {
				header('Location: confirmbooking.php');
			}

		} else if ($row['isblock'] == 1 and $row['is_admin'] == 1){
			$_SESSION['userdata'] = array('user_id'=>$row['user_id'],
			'user_name'=>$row['user_name'], 'name'=>$row['name'],
			'dateofsignup'=>$row['dateofsignup'], 'mobile'=>$row['mobile'], 
			'isblock'=>$row['isblock'], 'is_admin'=>$row['is_admin']);

			header('Location: Backend/admindashboard.php');
			
		} else if ($row['isblock'] == 0){
			echo '<script> alert("Please Wait for Admin Approval")</script>';
		}
	}
	if ($rows->num_rows == 0){
		$errors[] = array('input'=>'login', 'msg'=>'Invalid Login Details');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
		<?php foreach ($errors as $key=>$value) { 
				echo "<h3 class='text-center'><li>".$errors[$key]['msg']."</li></h3>";  
			}
		?>
    </div>
	<div class="jumbotron" id='jumb'>
		<div class="col-md-3 col-lg-3 col-sm-1">
		</div>
		<div class="col-md-6 col-lg-6 col-sm-10" id='abc'>
			<center>
				<a href="index.php"><img src="cedcabs.png" style="margin:-65px 0px -60px;" alt="" /></a>
			</center>
			<div class="text-center"><a href="index.php" class="btn btn-primary text-center">Home</a></div>
			<h2 style="text-align: center">Login Here</h2>
			<form action="login.php" method="POST">
                <div class="form-group " style="padding: 5px 0px;">
					<label for='username'>Username:</label>
					<input type="text" class='form-control' name="username" value="<?php if (isset($_COOKIE['username'])) {echo $_COOKIE['username'];}?>">
				</div>
				<div class="form-group " style="padding: 5px 0px;">
					<label for='password'>Password:</label>
					<input type="password" class='form-control' name="password">
				</div>
				<div class="form-group " style="padding: 5px 0px;">
					<input type="checkbox" name="remember"> Remember Me !!
				</div>
				<div class="form-group " style="padding: 10px 0px;">
					<input type="submit" class="btn btn-success form-control"  name="login" value="Login" style="padding: 5px 30px;">
				</div>
				<p style="font-size:16px; font-style:bold;color:white;text-align: center;">Don't have account? <a href="signup.php"> Click Here</a></p>
			</form>
	</div>
</div>
</body>
</html>