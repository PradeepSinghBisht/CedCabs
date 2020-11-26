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

        public function completedrides($conn) {

            $sql = "SELECT * FROM ride where `customer_user_id`='".$_SESSION['userdata']['user_id']."'AND `status`='2'";
            $result = $conn->query($sql);
    
            return $result;
        }

        public function pendingrides($conn) {
            $sql = "SELECT * FROM ride where `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND `status`='1'";
            $result = $conn->query($sql);
            
            return $result;
        }

        public function allrides($conn) {
            $sql = "SELECT * FROM ride where `customer_user_id`='".$_SESSION['userdata']['user_id']."'";
            $result = $conn->query($sql);
            
            return $result;
        }

        public function spent($conn) {
            $sql = "SELECT * FROM ride WHERE `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND (`status`='2' OR `status`='1')";
            $result = $conn->query($sql);
            
            return $result;
        }
    }
?>