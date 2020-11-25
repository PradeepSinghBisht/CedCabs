<?php
    require "config.php";
    session_start();

    class Ride {
        public function index($pickup, $drop, $distance, $luggage, $fare, $conn) {
            $user = $_SESSION['userdata']['user_id'];
            $sql = "INSERT INTO ride(`ride_date`, `from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) 
                values(NOW(), '".$pickup."', '".$drop."', '".$distance."', '".$luggage."', '".$fare."', 1, '".$user."')";
            $result = $conn->query($sql);

            if ($result === true) {
                return "Your Ride Booked Successfully";
    
            } else {
                echo "Error: " . $result . "<br>" . $conn->error;
            }     
        }
    }
?>