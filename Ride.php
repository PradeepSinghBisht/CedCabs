<?php
    require_once "config.php";

    class Ride {

        public function index($pickup, $drop, $distance, $cabtype, $luggage, $fare, $conn) {
            $user = $_SESSION['userdata']['user_id'];
            $sql = "INSERT INTO ride(`ride_date`, `from`, `to`, `total_distance`, `cab_type`, `luggage`, `total_fare`, `status`, `customer_user_id`) 
                values(NOW(), '".$pickup."', '".$drop."', '".$distance."', '".$cabtype."', '".$luggage."', '".$fare."', 1, '".$user."')";
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

        public function sortingallrides($conn, $action, $order) {

            if ($order == 'asc') {
                $sql = "SELECT * FROM `ride` ORDER BY cast(`$action` as unsigned) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `ride` ORDER BY cast(`$action` as unsigned) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }

        public function sortingpendingrides($conn, $action, $order) {

            if ($order == 'asc') {
                $sql = "SELECT * FROM `ride` WHERE `status`='1' ORDER BY cast(`$action` as unsigned) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `ride` WHERE `status`='1' ORDER BY cast(`$action` as unsigned) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }

        public function sortingcompletedrides($conn, $action, $order) {

            if ($order == 'asc') {
                $sql = "SELECT * FROM `ride` WHERE `status`='2' ORDER BY cast(`$action` as unsigned) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `ride` WHERE `status`='2' ORDER BY cast(`$action` as unsigned) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }

        public function sortingcancelledrides($conn, $action, $order) {

            if ($order == 'asc') {
                $sql = "SELECT * FROM `ride` WHERE `status`='0' ORDER BY cast(`$action` as unsigned) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `ride` WHERE `status`='0' ORDER BY cast(`$action` as unsigned) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }

        public function sortinguserpendingrides($conn, $action, $order) {

            if ($order == 'asc') {
                $sql = "SELECT * FROM `ride` where `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND `status`='1' ORDER BY cast(`$action` as unsigned) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `ride` where `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND `status`='1' ORDER BY cast(`$action` as unsigned) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }

        public function sortingusercompletedrides($conn, $action, $order) {

            if ($order == 'asc') {
                $sql = "SELECT * FROM `ride` where `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND `status`='2' ORDER BY cast(`$action` as unsigned) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `ride` where `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND `status`='2' ORDER BY cast(`$action` as unsigned) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }

        public function sortinguserallrides($conn, $action, $order) {

            if ($order == 'asc') {
                $sql = "SELECT * FROM `ride` where `customer_user_id`='".$_SESSION['userdata']['user_id']."' ORDER BY cast(`$action` as unsigned) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `ride` where `customer_user_id`='".$_SESSION['userdata']['user_id']."' ORDER BY cast(`$action` as unsigned) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }

        public function invoice($conn, $id) {

            $sql = "SELECT * FROM ride WHERE `ride_id`='".$id."'";
            $result = $conn->query($sql);

            return $result;
        }

        public function filterbydate($conn, $date1, $date2) {

            $sql = "SELECT * FROM ride WHERE `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND DATE(`ride_date`) BETWEEN '".$date1."' AND '".$date2."'";
            $result = $conn->query($sql);

            return $result;
        }

        public function filterbydatepending($conn, $date1, $date2) {

            $sql = "SELECT * FROM ride WHERE `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND `status`='1' AND DATE(`ride_date`) BETWEEN '".$date1."' AND '".$date2."'";
            $result = $conn->query($sql);

            return $result;
        }

        public function filterbydatecompleted($conn, $date1, $date2) {

            $sql = "SELECT * FROM ride WHERE `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND `status`='2' AND DATE(`ride_date`) BETWEEN '".$date1."' AND '".$date2."'";
            $result = $conn->query($sql);

            return $result;
        }

        public function filterbyweek($conn, $week) {

            $weeknumber = substr($week,6)-1;
            $sql = "SELECT * FROM ride WHERE `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND WEEK(`ride_date`) = '".$weeknumber."'";
            $result = $conn->query($sql);

            return $result;
        }

        public function filterbyweekpending($conn, $week) {

            $weeknumber = substr($week,6)-1;
            $sql = "SELECT * FROM ride WHERE `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND `status`='1' AND WEEK(`ride_date`) = '".$weeknumber."'";
            $result = $conn->query($sql);

            return $result;
        }

        public function filterbyweekcompleted($conn, $week) {

            $weeknumber = substr($week,6)-1;
            $sql = "SELECT * FROM ride WHERE `customer_user_id`='".$_SESSION['userdata']['user_id']."' AND `status`='2' AND WEEK(`ride_date`) = '".$weeknumber."'";
            $result = $conn->query($sql);

            return $result;
        }
    }
?>