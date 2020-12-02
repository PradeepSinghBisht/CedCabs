<?php
    require "Ride.php";
    $db = new Dbconnection();
    $ride = new Ride();
    session_start();
    $select = '';

    if (isset($_SESSION['userdata'])) {
        if ($_SESSION['userdata']['is_admin'] == '1') {
            header('Location: Backend/admindashboard.php');
        }
    } else {
        header('Location: index.php');
    }

    if (isset($_GET['order'])) {
        $action = $_GET['action'];
        $order = $_GET['order'];
        
        $select = $ride->sortinguserallrides($db->conn, $action, $order);
    }

    if (isset($_GET['apply'])) {
        $date1 = $_GET['date1'];
        $date2 = $_GET['date2'];
       
        $select = $ride->filterbydate($db->conn, $date1, $date2);
    }

    if (isset($_GET['applyweek'])) {
        $week = $_GET['week'];
       
        $select = $ride->filterbyweek($db->conn, $week);
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
    <title>All Rides Details</title>
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
                                echo '<a class="nav-item nav-link ml-3" href="login.php">Login</a>
                                      <a class="nav-item nav-link mx-3" href="#">Our Services</a>
                                      <a class="nav-item nav-link mx-3" href="#">About Us</a>
                                      <a class="nav-item nav-link ml-3" href="#">Contact Us</a>';
                            }
                        ?>                       
                        
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <section>
        <div class="container">
            <h2>All Rides Details</h2>
            <div class="row">
                <div class="col-md-2 col-lg-1"></div>
                <div class="col-md-6 col-lg-6">
                    <form action="previousrides.php" method="GET">
                        <p>
                            <h6>DateWise Filter</h6>
                            From :- <input name="date1" type="date" value="<?php echo $date1; ?>" required>  
                            To :- <input name="date2" type="date" value="<?php echo $date2; ?>" required>
                            <input type="submit" name="apply" value="Apply" class="btn btn-primary">
                        </p>
                    </form>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <form action="previousrides.php" method="GET">
                        <p>
                            <h6>WeekWise Filter</h6>
                            <input name="week" type="week" value="<?php echo $week; ?>" required>  
                            <input type="submit" name="applyweek" value="Apply" class="btn btn-primary">
                        </p>
                    </form>
                </div>
            </div>
                  
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Ride Date<a href="previousrides.php?action=ride_date&order=desc"> <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                        <a href="previousrides.php?action=ride_date&order=asc"> <i class="fa fa-caret-up" aria-hidden="true"></i></a></th>
                    <th>From</th>
                    <th>To</th>
                    <th>Distance</th>
                    <th>Cab Type</th>
                    <th>Luggage</th>
                    <th>Fare<a href="previousrides.php?action=total_fare&order=desc"> <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                        <a href="previousrides.php?action=total_fare&order=asc"> <i class="fa fa-caret-up" aria-hidden="true"></i></a></th>
                    <th>Status</th>
                    <th>Customer_Id</th>
                </tr>
                </thead>
                <tbody id= "hello">
                    <?php
                        if ($select != '') {
                            $rows = $select;
                        } else {
                            $rows = $ride->previousrides($db->conn);
                        }
                        
                        foreach ($rows as $row) {
                            if ($row['status'] == '0') {
                                $status = 'Cancelled';
                            } else if ($row['status'] == '1') {
                                $status = 'Pending';
                            } else if ($row['status'] == '2') {
                                $status = 'Confirmed';
                            }

                            if ($row['luggage'] == '') {
                                $luggage = 0;
                            } else {
                                $luggage = $row['luggage'];
                            }

                            echo '<tr>
                                    <td>'.$row['ride_date'].'</td>
                                    <td>'.$row['from'].'</td>
                                    <td>'.$row['to'].'</td>
                                    <td>'.$row['total_distance'].' Km</td>
                                    <td>'.$row['cab_type'].'</td>
                                    <td>'.$luggage.' Kg</td>
                                    <td>Rs.'.$row['total_fare'].'</td>
                                    <td>'.$status.'</td>
                                    <td>'.$row['customer_user_id'].'</td>
                                </tr>';
                        }
                    ?>
                </tbody>
            </table>      
            <?php 
                $rows = $ride->spent($db->conn);

                $totalfare = 0;
                foreach ($rows as $row) {
                    $totalfare += $row['total_fare'];
                }
                echo '<h2 class="text-center">You have Spent Total Rs.'.$totalfare.' On Cab</h2>';
            ?>
               
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