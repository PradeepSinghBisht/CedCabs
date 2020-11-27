<?php
    require_once "config.php";
    
    class Location{

        public function fare($conn) {
            $sql = "SELECT * FROM location WHERE `is_available`='1'";
            $result = $conn->query($sql);

            return $result;
        }

        public function addlocation($name, $distance, $available) {
            $sql = "INSERT INTO location(`name`,`distance`,`is_available`) values('".$name."', '".$distance."', '".$available."')";
            return $sql;
        }

        public function alllocation($conn) {
            $sql = "SELECT * FROM location";
            $result = $conn->query($sql);

            return $result;
        }

        public function deletelocation($conn, $id, $action) {

            if ($action == 'delete') {
                $sql = "DELETE from location WHERE `id`='$id'";
                $result = $conn->query($sql);
            }
        }

        public function selectupdatelocation($conn, $id) {
            $sql = "SELECT * FROM location WHERE `id`='".$id."'";
            $result = $conn->query($sql);

            return $result;
        }

        public function updatelocation($conn, $id, $name, $distance, $available) {
            $sql = "UPDATE location SET `name`='".$name."', `distance`='".$distance."', `is_available`='".$available."' WHERE `id`='".$id."'";

            return $sql;
        }
    }
?>