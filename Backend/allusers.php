<?php
    require "../Frontend/config.php";
    $db = new Dbconnection();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Frontend/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Admin Dashboard</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-light py-2">
            <div class="container">
                <img src="../Frontend/cedcabs.png" alt="CedCabs" id="logo">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto" id="navbtn">
                        <a class="nav-item btn mx-3 py-2" href="../Frontend/logout.php" id="book">Logout<span class="sr-only">(current)</span></a>
                        <?php 
                            if (isset($_SESSION['userdata'])) {
                                echo '<a class="nav-item nav-link ml-3" href="">Ride Request</a>
                                      <a class="nav-item nav-link mx-3" href="allusers.php">All Users</a>
                                      <a class="nav-item nav-link mx-3" href="#">All Rides</a>
                                      <a class="nav-item nav-link ml-3" href="#">Update Location</a>';
                            } else {
                                echo '<a class="nav-item nav-link ml-3" href="../Frontend/login.php">Login</a>
                                      <a class="nav-item nav-link mx-3" href="#">Our Services</a>
                                      <a class="nav-item nav-link mx-3" href="#">About Us</a>';
                            }
                        ?>                       
                        
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="container">
            <h2>All Users Details</h2>            
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Date Of SignUp</th>
                    <th>Mobile</th>
                    <th>Is_Block</th>
                    <th>Password</th>
                    <th>Is_Admin</th>
                    
                </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM user";
                        $result = $db->conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<tr>
                                        <td>'.$row['user_name'].'</td>
                                        <td>'.$row['name'].'</td>
                                        <td>'.$row['dateofsignup'].'</td>
                                        <td>'.$row['mobile'].'</td>
                                        <td><button type="button" class="btn btn-primary">'if ($row['isblock'] == '1'){'Unblock'} else{'Block'}'</button></td>
                                        <td>'.$row['password'].'</td>
                                        <td>'.$row['is_admin'].'</td>
                                      </tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>       
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
                    <img src="../Frontend/cedcabs.png" alt="CedCabs" id="logo">
                    <p><i class="fa fa-heart" aria-hidden="true" style="color: red;"></i> Designed by <strong>Pradeep Singh Bisht</strong></p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>





