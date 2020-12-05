<?php
    require_once "../Ride.php";
    require_once "../User.php";
    $db = new Dbconnection();
    $ride = new Ride();
    $user = new User();
    session_start();

    if (isset($_SESSION['userdata'])) {
        if ($_SESSION['userdata']['is_admin'] == '0') {
            header('Location: ../index.php');
        }
    } else {
        header('Location: ../index.php');
    }
$rows = $ride->fetchRides($db->conn);
$rideDates = [];
$rideEarning = [];
foreach($rows as $row) {
    $rideDates[] = $row['ride_date'];
    $rideEarning[] = $row['total'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Admin Dashboard</title>
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
                    <a href="#">Dashboard</a>
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
                        <h1>Welcome <?php echo $_SESSION['userdata']['name']?></h1>
                        <div class="container mt-2">
                            <h2>Dashboard</h2>  
                            <div class="row mt-3">
                                <div class="card text-white bg-warning mb-5 col-md-3" style="max-width: 18rem;">
                                    <div class="card-body">
                                        <h3 class="card-title">Pending Rides</h3>
                                        <p class="card-text "><h1 class="text-center"><?php $rows = $ride->allpendingride($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?></h1></p>
                                    </div>
                                    <div class="card-header"><a style="color:white" href="riderequest.php">View Details</a></div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="card text-white bg-success mb-5 col-md-4" style="max-width: 18rem;">
                                    <div class="card-body">
                                        <h3 class="card-title">Completed Rides</h3>
                                        <p class="card-text"><h1 class="text-center"><?php $rows = $ride->allcompletedride($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?></h1></p>
                                    </div>
                                    <div class="card-header"><a style="color:white" href="completedrides.php">View Details</a></div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="card text-white bg-danger mb-5 col-md-3" style="max-width: 18rem;"> 
                                    <div class="card-body">
                                        <h4 class="card-title">Cancelled Rides</h4>
                                        <p class="card-text"><h1 class="text-center"><?php $rows = $ride->allcancelledride($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?></h1></p>
                                    </div>
                                    <div class="card-header"><a style="color:white" href="cancelledrides.php">View Details</a></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="card text-white bg-info mb-3 col-md-3" style="max-width: 18rem;">
                                    <div class="card-body">
                                        <h3 class="card-title">Users Request</h3>
                                        <p class="card-text"><h1 class="text-center"><?php $rows = $user->pendinguser($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?></h1></p>
                                    </div>
                                    <div class="card-header"><a style="color:white" href="userrequest.php">View Details</a></div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="card text-white bg-secondary mb-3 col-md-4" style="max-width: 18rem;">
                                    <div class="card-body">
                                        <h3 class="card-title">Total Earned</h3>
                                        <p class="card-text"><h1 class="text-center"><?php $rows = $ride->earned($db->conn); $total = 0; foreach($rows as $row) {$total += $row['total_fare'];} echo $total;?></h1></p>
                                    </div>
                                    <div class="card-header"><a style="color:white" href="allrides.php">View Details</a></div>
                                </div><!-- Type a message -->
                                <div class="col-md-1"></div>
                                <div class="card text-white bg-primary mb-3 col-md-3" style="max-width: 18rem;">
                                    <div class="card-body">
                                        <h3 class="card-title">All Users</h3>
                                        <p class="card-text"><h1 class="text-center"><?php $rows = $user->allusers($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?></h1></p>
                                    </div>
                                    <div class="card-header"><a style="color:white" href="allusers.php">View Details</a></div>
                                </div> 
                            </div>   
                            
                            <div class="row">
                                <div id="piechart-users" class="col-md-5 col-lg-5"></div>
                                <div id="piechart-rides" class="col-md-5 col-lg-5"></div> 
                            </div>
                            <canvas id="myChart"></canvas>
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                            <script type="text/javascript">
                                // Load google charts
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawChart);

                                // Draw the chart and set the chart values
                                function drawChart() {
                                var row = google.visualization.arrayToDataTable([
                                ['Users', 'Number of Users'],
                                ['Approved Users', <?php $rows = $user->approveduser($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?> ],
                                ['Pending Users', <?php $rows = $user->pendinguser($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?> ],
                                ]);

                                // Optional; add a title and set the width and height of the chart
                                var options = {'title':'All Users', 'width':550, 'height':400};

                                // Display the chart inside the <div> element with id="piechart"
                                var chart = new google.visualization.PieChart(document.getElementById('piechart-users'));
                                chart.draw(row, options);
                                }    
                            </script>       

                            <script type="text/javascript">
                                // Load google charts
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawChart);

                                // Draw the chart and set the chart values
                                function drawChart() {
                                var row = google.visualization.arrayToDataTable([
                                ['Rides', 'Number of Rides'],
                                ['Completed Rides', <?php $rows = $ride->allcompletedride($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?> ],
                                ['Cancelled Rides', <?php $rows = $ride->allcancelledride($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?> ],
                                ['Pending Rides', <?php $rows = $ride->allpendingride($db->conn); $count = 0; foreach($rows as $row) {$count++;} echo $count;?> ]
                                ]);

                                // Optional; add a title and set the width and height of the chart
                                var options = {'title':'All Rides', 'width':550, 'height':400};

                                // Display the chart inside the <div> element with id="piechart"
                                var chart = new google.visualization.PieChart(document.getElementById('piechart-rides'));
                                chart.draw(row, options);
                                }
                            </script>

                            <script type="text/javascript">
                                var rideDates = <?php echo json_encode($rideDates); ?>;
                                var rideEarning = <?php echo json_encode($rideEarning); ?>;
                                var ctx = document.getElementById('myChart').getContext('2d');
                                var chart = new Chart(ctx, {
                                    // The type of chart we want to create
                                    type: 'bar',

                                    // The row for our dataset
                                    data: {
                                        labels: rideDates,
                                        datasets: [{
                                            label: 'DateWise Earning',
                                            backgroundColor: 'greenyellow',
                                            borderColor: 'greenyellow',
                                            data: rideEarning
                                        }]
                                    },

                                    // Configuration options go here
                                    options: {}
                                });
                                
                            </script>     
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
                    <img src="../cedcabs.png" alt="CedCabs" id="logo">
                    <p style="color:black"><i class="fa fa-heart" aria-hidden="true" style="color: red;"></i> Designed by <strong>Pradeep
                            Singh Bisht</strong></p>
                </div>
            </div>
        </div>
    </footer>
    </div>
    
</body>