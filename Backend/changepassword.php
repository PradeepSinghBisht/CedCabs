<?php
    require "../Frontend/User.php";
    $db = new Dbconnection();
    $user = new User();
    $errors = array();
    session_start();

    if (isset($_POST['update'])) {
        $password = isset($_POST['password'])?MD5($_POST['password']):'';
        $confirmpassword = isset($_POST['confirmpassword'])?MD5($_POST['confirmpassword']):'';
    
       $errors = $user->changepassword($errors, $password, $confirmpassword, $db->conn);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    <a href="../Frontend/logout.php">Logout</a>
                </li>
            </ul>
        </div>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="container">  
                            <div id = "errors">
                                <?php foreach ($errors as $key=>$value) { ?>
                                    <li> 
                                        <?php echo $errors[$key]['msg'];
                                } ?> 
                                    </li>
                            </div>          
                            <h2 style="text-align: center;">Update Password</h2>
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
        </div>
</body>
</html>