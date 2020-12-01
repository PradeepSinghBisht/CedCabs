<?php
    require "../Ride.php";
    $db = new Dbconnection();
    $ride = new Ride();
    session_start();
    $select = "";

    if (isset($_SESSION['userdata'])) {
        if ($_SESSION['userdata']['is_admin'] == '0') {
            header('Location: ../index.php');
        }
    } else {
        header('Location: ../index.php');
    }

    if (isset($_GET['order'])) {
        $action = $_GET['action'];
        $order = $_GET['order'];
        
        $select = $ride->sortingpendingrides($db->conn, $action, $order);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $action = $_GET['action'];
        $ride->updateriderequest($db->conn, $id, $action);
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Pending Rides</title>
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
                            <h2>Pending Rides</h2>            
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Ride Date <a href="riderequest.php?action=ride_date&order=desc"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <a href="riderequest.php?action=ride_date&order=asc"><i class="fa fa-caret-up" aria-hidden="true"></i></a></th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Distance</th>
                                    <th>Cab Type</th>
                                    <th>Luggage</th>
                                    <th>Fare<a href="riderequest.php?action=total_fare&order=desc"> <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <a href="riderequest.php?action=total_fare&order=asc"> <i class="fa fa-caret-up" aria-hidden="true"></i></a></th>
                                    <th>Status</th>
                                    <th>Id</th>
                                    <th>Action</th>
                                </tr>   
                                </thead>
                                <tbody id= "hello">
                                    <?php
                                        if($select != ""){
                                            $rows = $select;
                                        } else {
                                            $rows = $ride->allpendingride($db->conn);
                                        }

                                        foreach ($rows as $row) {
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
                                                    <td>'.$row['cab_type'].'</td>
                                                    <td>'.$row['luggage'].' Kg</td>
                                                    <td>Rs.'.$row['total_fare'].'</td>
                                                    <td>'.$status.'</td>
                                                    <td>'.$row['customer_user_id'].'</td>
                                                    <td><a href="riderequest.php?id='.$row['ride_id'].'&action=confirm" class="btn btn-success">Confirm</a>
                                                    <a href="riderequest.php?id='.$row['ride_id'].'&action=cancel" class="btn btn-danger">Cancel</a></td>
                                                </tr>';
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