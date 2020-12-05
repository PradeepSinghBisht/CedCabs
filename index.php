<?php
    require_once "Location.php";
    require_once "Ride.php";
    $db = new Dbconnection();
    $location = new Location();
    $ride = new Ride();
    session_start();

    if (isset($_SESSION['userdata'])) {
        if ($_SESSION['userdata']['is_admin'] == '1') {
            header('Location: Backend/admindashboard.php');
        } else if (isset($_SESSION['landingdata'])) {
            header('Location: confirmbooking.php');
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto" id="navbtn">
                        <a class="nav-item btn mx-3 py-2" href="#taxifare" id="book">Book Now<span
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
                                      <a class="nav-item nav-link ml-3" href="signup.php">Sign Up</a>
                                      <a class="nav-item nav-link ml-3" href="login.php">Login</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <section>
        <div class="container-fluid bg-overlay py-5" id="taxifare">
            <div class="row text-center py-1">
                <div class="col-sm-2 col-md-2 col-lg-2"></div>
                <div id="section1" class="col-sm-8 col-md-8 col-lg-8">
                    <h1>Book a City Taxi to your Destination in Town</h1>
                    <p>Choose from a range of categories and prices</p>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2"></div>
            </div>
            <div class="row text-center my-5">
                <div class="col-sm-2 col-md-1 col-lg-1"></div>
                <div class="col-sm-8 col-md-5 col-lg-4 " id="form">
                    <h5 class="my-3">CedCabs City Fare</h5>
                    <h6>Your everyday travel partner</h6>
                    <p class="mb-3">AC Cabs for point to point travel</p>
                    <form action="#">
                        <div class="form-group">
                            <select name="pickup" class="form-control location" id="pickup">
                                <option value="">Select Your Pickup Location</option>
                                <?php
                                    $rows = $location->fare($db->conn);    
                                    
                                    foreach ($rows as $row) {
                                        echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="drop" class="form-control" id="drop">
                                <option value="">Select Your Drop Location</option>
                                <?php
                                    $rows = $location->fare($db->conn);  
                                    
                                    foreach ($rows as $row) {
                                        echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="cabtype" class="form-control" id="cabtype">
                                <option value="">Select Cab Type</option>
                                <option value="CedMicro">CedMicro</option>
                                <option value="CedMini">CedMini</option>
                                <option value="CedRoyal">CedRoyal</option>
                                <option value="CedSUV">CedSUV</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="luggage" placeholder="Luggage in KG">
                        </div>
                        <p>
                            <button type="button" id="fare" class="btn btn-primary">Calculate Fare</button>
                        </p>
                    </form>
                    <?php
                        if (isset($_SESSION['userdata'])) {
                            echo '<p>
                                    <button type="button" name="book" class="book btn btn-primary" id="booknow">Book Now</button>
                                  </p>';
                        } else {
                            echo '<p>
                                    <a class="nav-item nav-link" id="booknow" style="background-color: greenyellow; color:black; 
                                    width:420px; border-radius:5px;" href="login.php">Wanna Book Ride? Login First</a>
                                  </p>';
                        }
                    ?>

                </div>
                <div class="col-sm-2 col-md-6 col-lg-7"></div>
            </div>
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
                    <p><i class="fa fa-heart" aria-hidden="true" style="color: red;"></i> Designed by <strong>Pradeep
                            Singh Bisht</strong></p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
