<?php
    require "../Frontend/config.php";
    $db = new Dbconnection();
    session_start();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "UPDATE user SET `isblock`='1'  WHERE `user_id`='$id'";
        $result = $db->conn->query($sql);
        
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
    <title>User Request</title>
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
                <li>
                    <a href="userrequest.php">User Request</a>
                </li>
                <li>
                    <a href="riderequest.php">Ride Request</a>
                </li>
                <li>
                    <a href="allrides.php">All Rides</a>
                </li>
                <li>
                    <a href="allusers.php">All Users</a>
                </li>
                <li>
                    <a href="location.php">Location</a>
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
                            <h2>User Request</h2>            
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>DateOfSignup</th>
                                    <th>Mobile</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id= "hello">
                                    <?php
                                        $sql = "SELECT * FROM user where `isblock`='0'";
                                        $result = $db->conn->query($sql);
                                        
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo '<tr>
                                                        <td>'.$row['user_name'].'</td>
                                                        <td>'.$row['name'].'</td>
                                                        <td>'.$row['dateofsignup'].'</td>
                                                        <td>'.$row['mobile'].'</td>
                                                        <td>'.$row['password'].'</td>
                                                        <td><a href="userrequest.php?id='.$row['user_id'].'">Unblock</a></td>
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