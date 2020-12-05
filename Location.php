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
                    echo '<script> window.location.href = "location.php" </script>';
        
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

        public function updatelocation($conn, $errors, $id, $name, $distance, $available) {

            $sql = "SELECT * FROM location WHERE `name`='".$name."'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($id != $row['id'] and $name == $row['name']) {
                       $errors[] = array('input'=>'name',
                                   'msg'=>'Location Already Exists.');
                    }
                }
            }

            if (sizeof($errors) == 0) {
                $sql = "UPDATE location SET `name`='".$name."', `distance`='".$distance."', `is_available`='".$available."' WHERE `id`='".$id."'";
                
                if ($conn->query($sql) === true) {
                    echo '<script> alert("Location Updated Successfully")</script>';
                    echo '<script> window.location.href = "location.php" </script>';
                    
    
                } else {
                    $errors[] = array('input'=>'form', 'msg'=>$conn->error);
                }
            }

            return $errors;
        }

        public function sortinglocation($conn, $action, $order ) {
            
            if ($order == 'asc') {
                $sql = "SELECT * FROM `location` ORDER BY (`$action`) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `location` ORDER BY (`$action`) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }

        public function sortinglocationdistance($conn, $action, $order ) {
            
            if ($order == 'asc') {
                $sql = "SELECT * FROM `location` ORDER BY cast(`$action` as unsigned) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `location` ORDER BY cast(`$action` as unsigned) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }
    }
?>