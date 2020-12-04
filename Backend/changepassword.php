<?php
    require "../User.php";
    $db = new Dbconnection();
    $user = new User();
    $errors = array();
    session_start();

    if (isset($_SESSION['userdata'])) {
        if ($_SESSION['userdata']['is_admin'] == '0') {
            header('Location: ../index.php');
        }
    } else {
        header('Location: ../index.php');
    }

    if (isset($_POST['update'])) {
        $password = isset($_POST['password'])?MD5($_POST['password']):'';
		$confirmpassword = isset($_POST['confirmpassword'])?MD5($_POST['confirmpassword']):'';
		
		if ($password != $confirmpassword) {
			$errors[] = array('msg'=>'Password Doesn\'t Match');
		}

		if (sizeof($errors) == 0) {
			$errors = $user->changepasswordadmin($errors, $password, $db->conn);
		}
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <title>Approved User Request</title>
</head>
<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Admin Panel
                    </a>
                </li>
                <li>
                    <a href="admindashboard.php">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Rides
                    </a>
                    <div class="dropdown-menu" id="dr" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" id="d" href="riderequest.php">Pending Rides</a>
                    <a class="dropdown-item" id="d" href="completedrides.php">Completed Rides</a>
                    <a class="dropdown-item" id="d" href="cancelledrides.php">Cancelled Rides</a>
                    <a class="dropdown-item" id="d" href="allrides.php">All Rides</a>
                </li> 

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Users
                    </a>
                    <div class="dropdown-menu" id="dr" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" id="d" href="userrequest.php">Pending User Request</a>
                    <a class="dropdown-item" id="d" href="approveduser.php">Approved User Request</a>
                    <a class="dropdown-item" id="d" href="allusers.php">All Users</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Location
                    </a>
                    <div class="dropdown-menu" id="dr" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" id="d" href="location.php">All Location</a>
                    <a class="dropdown-item" id="d" href="addlocation.php">Add New Location</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                    </a>
                    <div class="dropdown-menu" id="dr" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" id="d" href="changepassword.php">Change Password</a>
                </li>
                <li>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="container">           
                            <h2 style="text-align: center;">Update Password</h2>
                            <div id = "errors">
                                <?php foreach ($errors as $key=>$value) { 
                                        echo "<h4><li>".$errors[$key]['msg']."</li></h4>";  
                                    }
                                ?> 
                            </div>
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
                        </div>
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
                        <img src="../cedcabs.png" alt="CedCabs" id="logo">
                        <p style="color:black"><i class="fa fa-heart" aria-hidden="true" style="color: red;"></i> Designed by <strong>Pradeep
                                Singh Bisht</strong></p>
                    </div>
                </div>
            </div>
        </footer>
        </div>
</body>
</html>