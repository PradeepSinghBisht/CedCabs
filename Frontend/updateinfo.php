<?php
     require "config.php";
     $errors = array();
     //$_SESSION['userdata'] = array();
     session_start();
 
 if (isset($_POST['submit'])) {
     $username = isset($_POST['username'])?$_POST['username']:'';
     $newpassword = isset($_POST['password'])?$_POST['password']:'';
     $confirmpassword = isset($_POST['password2'])?$_POST['password2']:'';
     $email = isset($_POST['email'])?$_POST['email']:'';
     $role = isset($_POST['role'])?$_POST['role']:'';
 
     if ($newpassword != $confirmpassword) {
         $errors[] = array('input'=>'password', 'msg'=>'password doesnt match');
     }
 
     $sql2 = "SELECT * FROM users WHERE `username`='".$username."'
              OR `email`='".$email."'";
     $result = $conn->query($sql2);
 
     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
             $user_id = $_SESSION['userdata']['user_id'];
             if ($user_id != $row['user_id'] && $username == $row['username']) {
                  $errors[] = array('input'=>'username',
                              'msg'=>'username already exists.');
             }
             if ($user_id != $row['user_id'] && $email == $row['email']) {
                 $errors[] = array('input'=>'email',
                             'msg'=>'email already exists.');
             }
         }
     }
 
     if (sizeof($errors) == 0) {
        $sql = "UPDATE users SET `username` = '".$username."',
                 `password` = '".$newpassword."', `email` = '".$email."',
                  `role` = '".$role."'
                 WHERE `user_id` = '".$_SESSION['userdata']['user_id']."'";
      
        if ($conn->query($sql) === true) {
             echo "<br> Updated successfully";
        } else {
             $errors[] = array('input'=>'form', 'msg'=>$conn->error);
             echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Info</title>
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
			<h2 style="text-align: center;">Update Information</h2>
			<form action="signup.php" method="POST">
                <div class="form-group " style="padding: 5px 0px;">
					<label for='username'>Username:</label>
					<input type="text" class='form-control' name="username" value="<?php 
                    echo $_SESSION['userdata']['user_name'];?>" readonly>
				</div>
                <div class="form-group" style="padding: 5px 0px;">
					<label for='name'>Name:</label>
					<input type="text" class='form-control' name="name" value="<?php 
                    echo $_SESSION['userdata']['name'];?>" required>
				</div>
				<div class="form-group " style="padding: 5px 0px;">
					<label for='mobile'>Mobile:</label>
					<input type="number" class='form-control' name="mobile" value="<?php 
                    echo $_SESSION['userdata']['mobile'];?>" >
				</div>
				<div class="form-group " style="padding: 5px 0px;">
					<label for='password'>Password:</label>
					<input type="password" class='form-control' name="password">
				</div>
				<div class="form-group " style="padding: 5px 0px;">
					<label for='confirmpassword'>Confirm Password:</label>
					<input type="password" class='form-control' name="confirmpassword">
                </div>
                <div class="form-group" style="padding: 5px 0px;">
                    <label for='isadmin'>Are You Admin?</label>
                    <select name="isadmin" class="form-control">
                        <option value="">Select From The List</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
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