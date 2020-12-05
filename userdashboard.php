<?php
    require_once "Ride.php";
    require_once "User.php";
    $db = new Dbconnection();
    $ride = new Ride();
    $user = new User();
    session_start();

    if (isset($_SESSION['userdata'])) {
        if ($_SESSION['userdata']['is_admin'] == '1') {
            header('Location: Backend/admindashboard.php');
        } else if (isset($_SESSION['landingdata'])) {
            header('location:confirmbooking.php'); 
        }
    } else {
        header('Location: index.php');
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>User Dashboard</title>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-md navbar-light py-2">
            <div class="container">
                <img src="cedcabs.png" alt="CedCabs" id="logo">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto" id="navbtn">
                        <a class="nav-item btn mx-3 py-2" href="index.php" id="book">Book Now<span class="sr-only">(current)</span></a>
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
    <div class="container">    
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <h1>Welcome <?php echo $_SESSION['userdata']['name']?></h1>
                        <div class="container mt-4">
                            <h2>Dashboard</h2>  
                            <div class="row mt-4">
                                <div class="col-lg-3 col-md-6">
                                    <div class="card text-white bg-warning mb-5" style="max-width: 18rem;">
                                        <div class="card-body">
                                            <h3 class="card-title">Pending Rides</h3>
                                            <p class="card-text "><h1 class="text-center"><?php $rows = $ride->pendingrides($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?></h1></p>
                                        </div>
                                        <div class="card-header"><a style="color:white" href="pendingrides.php">View Details</a></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-md-6">
                                    <div class="card text-white bg-success mb-5" style="max-width: 18rem;">
                                        <div class="card-body">
                                            <h4 class="card-title">Completed Rides</h4>
                                            <p class="card-text"><h1 class="text-center"><?php $rows = $ride->completedrides($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?></h1></p>
                                        </div>
                                        <div class="card-header"><a style="color:white" href="completedrides.php">View Details</a></div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="card text-white bg-danger mb-5" style="max-width: 18rem;"> 
                                        <div class="card-body">
                                            <h4 class="card-title">Cancelled Rides</h4>
                                            <p class="card-text"><h1 class="text-center"><?php $rows = $ride->cancelledrides($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?></h1></p>
                                        </div>
                                        <div class="card-header"><a style="color:white" href="cancelledrides.php">View Details</a></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-md-6">
                                    <div class="card text-white bg-secondary mb-5" style="max-width: 18rem;">
                                        <div class="card-body">
                                            <h3 class="card-title">Total Spent</h3>
                                            <p class="card-text"><h1 class="text-center"><?php $rows = $ride->spent($db->conn); $total = 0; foreach($rows as $row) {$total += $row['total_fare'];} echo $total;?></h1></p>
                                        </div>
                                        <div class="card-header"><a style="color:white" href="previousrides.php">View Details</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <img src="cedcabs.png" alt="CedCabs" id="logo">
                    <p><i class="fa fa-heart" aria-hidden="true" style="color: red;"></i> Designed by <strong>Pradeep Singh Bisht</strong></p>
                </div>
            </div>
        </div>
    </footer>
</body>
