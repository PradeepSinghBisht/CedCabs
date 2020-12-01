<?php
    require_once "Ride.php";
    $db = new Dbconnection();
    $ride = new Ride();
    session_start();

    if (isset($_SESSION['userdata'])) {
        if ($_SESSION['userdata']['is_admin'] == '1') {
            header('Location: Backend/admindashboard.php');
        }
    } else {
        header('Location: index.php');
    }

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'confirm') {

            $pickup = $_SESSION['landingdata']['pickup'];
            $drop = $_SESSION['landingdata']['drop'];
            $distance = $_SESSION['landingdata']['distance'];
            $cabtype = $_SESSION['landingdata']['cabtype'];
            $luggage = $_SESSION['landingdata']['luggage'];
            $fare = $_SESSION['landingdata']['fare'];

            $result = $ride->index($pickup, $drop, $distance, $cabtype, $luggage, $fare, $db->conn);

            if ($result === true) {
                echo "<script> alert('Your Ride Booked Successfully'); window.location.href='pendingrides.php'; </script>";
                unset($_SESSION['landingdata']);

            } else {
                echo "Error: " . $result . "<br>" . $conn->error;
            }
        } else if ($_GET['action'] == 'cancel') {
            unset($_SESSION['landingdata']);
            echo "<script> window.location.href='index.php'; </script>";
        }
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
    <script src="action.js"></script>
    <title>CedCabs</title>
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
                        <a class="nav-item btn mx-3 py-2" href="#taxifare" id="book">Book Now<span class="sr-only">(current)</span></a>
                        <?php 
                            if (isset($_SESSION['userdata'])) {
                                echo '<li class="nav-item dropdown ml-3">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Rides
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="pendingrides.php">Pending Rides</a>
                                        <a class="dropdown-item" href="completedrides.php">Completed Rides</a>
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
                                        <a class="nav-item nav-link ml-3" href="#">'.$_SESSION['userdata']['name'].'</a>
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
    
    <section>
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-8 col-lg-8">
                <div class="text-center mt-4 py-1" style="background-color:lightgrey"><h3>Confirm Your Booking</h3></div>
                <div class="row py-3" >
                    <div class="col-md-6 col-lg-6 text-center">
                        <h3>From:</h3>
                        <h3>To:</h3>
                        <h3>Total Distance: </h3>
                        <h3>Luggage:</h3>
                        <h3>Cab Type:</h3>
                        <h3>Fare:</h3>
                    </div>
                    <div class="col-md-6 col-lg-6 text-center">
                        <h3><?php echo $_SESSION['landingdata']['pickup']; ?></h3>
                        <h3><?php echo $_SESSION['landingdata']['drop']; ?></h3>
                        <h3><?php echo $_SESSION['landingdata']['distance'].' Km'; ?></h3>
                        <h3><?php echo $_SESSION['landingdata']['luggage'].' Kg'; ?></h3>   
                        <h3><?php echo $_SESSION['landingdata']['cabtype']; ?></h3>
                        <h3><?php echo 'Rs. '.$_SESSION['landingdata']['fare']; ?></h3>     
                    </div>
                </div>
                <div class="text-center">
                    <a href="confirmbooking.php?action=confirm" class="btn btn-success">Confirm</a>
                    <a href="confirmbooking.php?action=cancel" class="btn btn-danger">Cancel</a>
                </div>
            </div>
            <div class="col-md-2 col-lg-2"></div>
        </div>
    </section>

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
</html>