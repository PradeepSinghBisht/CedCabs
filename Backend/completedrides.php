<?php
    require "../Frontend/config.php";
    $db = new Dbconnection();
    session_start();

    if (isset($_GET['id'])) {
        if ($_GET['action'] == 'confirm'){
            $id = $_GET['id'];
            $sql = "UPDATE ride SET `status`='2' WHERE `ride_id`='$id'";
            $result = $db->conn->query($sql);
        }
    }

    if (isset($_GET['id'])) {
        if ($_GET['action'] == 'cancel'){
            $id = $_GET['id'];
            $sql = "UPDATE ride SET `status`='0' WHERE `ride_id`='$id'";
            $result = $db->conn->query($sql);
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
    <title>Completed Rides</title>
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
                            <h2>Completed Rides</h2>            
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Ride Date</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Distance</th>
                                    <th>Luggage</th>
                                    <th>Fare</th>
                                    <th>Status</th>
                                    <th>Customer_Id</th>
                                </tr>
                                </thead>
                                <tbody id= "hello">
                                    <?php
                                        $sql = "SELECT * FROM ride WHERE `status`='2'";
                                        $result = $db->conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                if ($row['status'] == '0') {
                                                    $status = 'Cancelled';
                                                } else if ($row['status'] == '1') {
                                                    $status = 'Pending';
                                                } else if ($row['status'] == '2') {
                                                    $status = 'Confirmed';
                                                }
                                                echo '<tr>
                                                        <td>'.$row['ride_date'].'</td>
                                                        <td>'.$row['from'].'</td>
                                                        <td>'.$row['to'].'</td>
                                                        <td>'.$row['total_distance'].' Km</td>
                                                        <td>'.$row['luggage'].'Kg</td>
                                                        <td>Rs.'.$row['total_fare'].'</td>
                                                        <td>'.$status.'</td>
                                                        <td>'.$row['customer_user_id'].'</td>
                                                    </tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>