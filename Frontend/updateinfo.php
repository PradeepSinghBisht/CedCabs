<?php
	 require "User.php";
	 $user = new User();
	 $db = new Dbconnection();
	 $errors = array();
	 session_start();

	 if (isset($_SESSION['userdata'])) {
        if ($_SESSION['userdata']['is_admin'] == '1') {
            header('Location: ../Backend/admindashboard.php');
        }
    } else {
        header('Location: ../Frontend/index.php');
    }
 
 if (isset($_POST['update'])) {
	 $username = isset($_POST['username'])?$_POST['username']:'';
	 $name = isset($_POST['name'])?$_POST['name']:'';
	 $mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
 
	 $sql = $user->updateinfo($errors, $username, $name, $mobile, $db->conn);

	if ($db->conn->query($sql) === true) {
		echo "<script> alert('Updated Successfully')</script>";
	} else {
		$errors[] = array('input'=>'form', 'msg'=>$conn->error);
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
 }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Account</title>
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
			<form action="updateinfo.php" method="POST">
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
				<div class="form-group " style="padding: 10px 0px;">
					<input type="submit" class="btn btn-success form-control"  name="update" value="Update" style="padding: 5px 30px;">
				</div>
			</form>
			<a class="btn btn-success form-control" href="index.php">Back</a>
	</div>
</div>
</body>
</html>