<?php
    require_once "config.php";
    
    class Location{

        public function fare($conn) {
            $sql = "SELECT * FROM location WHERE `is_available`='1'";
            $result = $conn->query($sql);

            return $result;
        }

        public function addlocation($conn, $errors, $name, $distance, $available) {

            $sql = "SELECT * FROM location WHERE `name`='".$name."'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($name == $row['name']) {
                       $errors[] = array('input'=>'name',
                                   'msg'=>'Location Already Exists.');
                    }
                }
            }

            if (sizeof($errors) == 0) {
                $sql = "INSERT INTO location(`name`,`distance`,`is_available`) values('".$name."', '".$distance."', '".$available."')";
        
                if ($conn->query($sql) === true) {
                    echo '<script>alert("Location Added Successfully")</script>';
        
                } else {
                    $errors[] = array('input'=>'form', 'msg'=>$conn->error);
                }
            } 

            return $errors;

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