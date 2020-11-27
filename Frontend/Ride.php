<?php
    require_once "config.php";

    class Ride {

        public function index($pickup, $drop, $distance, $luggage, $fare, $conn) {
            $user = $_SESSION['userdata']['user_id'];
            $sql = "INSERT INTO ride(`ride_date`, `from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) 
                values(NOW(), '".$pickup."', '".$drop."', '".$distance."', '".$luggage."', '".$fare."', 1, '".$user."')";
            $result = $conn->query($sql);

            return $result;     
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

        public function previousrides($conn) {
            $sql = "SELECT * FROM ride where `customer_user_id`='".$_SESSION['userdata']['user_id']."'";
            $result = $conn->query($sql);
            
            return $result;
        }

        public function allrides($conn) {
            $sql = "SELECT * FROM ride";
            $result = $conn->query($sql);
            
            return $result;
        }

        public function spent($conn) {
            $sql = "SELECT * FROM ride WHERE `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND (`status`='2' OR `status`='1')";
            $result = $conn->query($sql);
            
            return $result;
        }

        public function earned($conn) {
            $sql = "SELECT * FROM ride WHERE `status`='2' OR `status`='1'";
            $result = $conn->query($sql);
            
            return $result;
        }

        public function deleteride($conn, $id) {
            $sql = "DELETE from ride WHERE `ride_id`='$id'";
            $result = $conn->query($sql);
        }

        public function allcancelledride($conn) {
            $sql = "SELECT * FROM ride WHERE `status`='0'";
            $result = $conn->query($sql);

            return $result;
        }

        public function allcompletedride($conn) {
            $sql = "SELECT * FROM ride WHERE `status`='2'";
            $result = $conn->query($sql);

            return $result;
        }

        public function allpendingride($conn) {
            $sql = "SELECT * FROM ride WHERE `status`='1'";
            $result = $conn->query($sql);

            return $result;
        }

        public function updateriderequest($conn, $id, $action) {

            if ($action == 'confirm'){
                $sql = "UPDATE ride SET `status`='2' WHERE `ride_id`='$id'";
                $result = $conn->query($sql);
            } else if ($action == 'cancel') {
                $sql = "UPDATE ride SET `status`='0' WHERE `ride_id`='$id'";
                $result = $conn->query($sql);
            }
        }
    }
?>