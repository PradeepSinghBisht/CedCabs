<?php
    require "../Frontend/User.php";
    $db = new Dbconnection();
    $user = new User();
    session_start();
    $select = '';

    if (isset($_SESSION['userdata'])) {
        if ($_SESSION['userdata']['is_admin'] == '0') {
            header('Location: ../Frontend/index.php');
        }
    } else {
        header('Location: ../Frontend/index.php');
    }

    if (isset($_GET['order'])) {
        $action = $_GET['action'];
        $order = $_GET['order'];
        
        $select = $user->sortingpendinguser($db->conn, $action, $order);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $action = $_GET['action'];
        $user->updateuserrequest($db->conn, $id, $action);
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
    <title>Pending User Request</title>
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
                            <h2>Pending User Request</h2>            
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Name<a href="userrequest.php?action=name&order=desc"> Down</a>
                                    <a href="userrequest.php?action=name&order=asc"> Up</a></th>
                                    <th>DateOfSignup</th>
                                    <th>Mobile<a href="userrequest.php?action=mobile&order=desc"> Down</a>
                                    <a href="userrequest.php?action=mobile&order=asc"> Up</a></th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id= "hello">
                                    <?php
                                        if ($select != '') {
                                            $rows = $select;
                                        } else {
                                            $rows = $user->pendinguser($db->conn);
                                        }
                                        
                                        
                                        foreach ($rows as $row) {
                                            echo '<tr>
                                                    <td>'.$row['user_name'].'</td>
                                                    <td>'.$row['name'].'</td>
                                                    <td>'.$row['dateofsignup'].'</td>
                                                    <td>'.$row['mobile'].'</td>
                                                    <td>'.$row['password'].'</td>
                                                    <td><a href="userrequest.php?id='.$row['user_id'].'&action=Blocked">Unblock</a></td>
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