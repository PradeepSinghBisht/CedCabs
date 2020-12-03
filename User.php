<?php
    require_once "config.php";

    class User {

        public function signup($errors, $username, $name, $mobile, $password, $confirmpassword, $conn) {
            
            if ($password != $confirmpassword) {
                $errors[] = array('msg'=>'Password Doesn\'t Match');
            }

            $sql = "SELECT * FROM user WHERE `user_name`='".$username."'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($username == $row['user_name']) {
                       $errors[] = array('input'=>'username',
                                   'msg'=>'Username Already Exists.');
                    }
                }
            }

            if (sizeof($errors) == 0) {
                $sql = 'INSERT INTO user(`user_name`,`name`,`dateofsignup`,`mobile`,`isblock`,`password`,`is_admin`) 
                VALUES("'.$username.'","'.$name.'",NOW(),"'.$mobile.'","0","'.$password.'","0")';
        
                if ($conn->query($sql) === true) {
                    echo '<script>alert("Registered Successfully")</script>';
                    echo '<script> window.location.href = "login.php" </script>';
        
                } else {
                    $errors[] = array('input'=>'form', 'msg'=>$conn->error);
                }
            } 
            return $errors;
        }


        public function login($username, $password, $conn) {
            $sql = "SELECT * FROM user WHERE `user_name`='".$username."'
                    AND `password`='".$password."'";
            $result = $conn->query($sql);

            return $result;
        }

        public function updateinfo($name, $mobile, $conn) {
        
            $sql = "UPDATE user SET `name` = '".$name."',
                        `mobile` = '".$mobile."' 
                    WHERE `user_id` = '".$_SESSION['userdata']['user_id']."'";
            
            return $sql;
        }

        public function changepassword($password, $conn, $errors) {

            $sql = "SELECT * FROM user WHERE `user_id`='".$_SESSION['userdata']['user_id']."'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($password == $row['password']) {
                       $errors[] = array('input'=>'password',
                                   'msg'=>'New Password Required.');
                    }
                }
            }

            if (sizeof($errors) == 0) {
                $sql = "UPDATE user SET `password` = '".$password."'
                WHERE `user_id` = '".$_SESSION['userdata']['user_id']."'";
        
                if ($conn->query($sql) === true) {
                    echo "<script> alert('Updated Successfully')</script>";
                    echo "<script> window.location.href='index.php'</script>";
                } else {
                    $errors[] = array('input'=>'form', 'msg'=>$conn->error);
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }          
            return $errors;
                
        }

        public function allusers($conn) {
            $sql = "SELECT * FROM user WHERE `is_admin`='0'";
            $result = $conn->query($sql);

            return $result;
        }

        public function deleteuser($conn, $id) {
            $sql = "DELETE from user WHERE `user_id`='$id'";
            $result = $conn->query($sql);
        }

        public function updateuserrequest($conn, $id, $action) {

            if ($action == 'Blocked'){
                $sql = "UPDATE user SET `isblock`='1' WHERE `user_id`='$id'";
                $result = $conn->query($sql);
            } else if ($action == 'Unblocked'){
                $sql = "UPDATE user SET `isblock`='0' WHERE `user_id`='$id'";
                $result = $conn->query($sql);
            }
            
        }

        public function approveduser($conn) {
            $sql = "SELECT * FROM user where `isblock`='1' AND `is_admin`='0'";
            $result = $conn->query($sql);

            return $result;
        }

        public function pendinguser($conn) {
            $sql = "SELECT * FROM user where `isblock`='0' AND `is_admin`='0'";
            $result = $conn->query($sql);

            return $result;
        }

        public function sortingpendinguser($conn, $action, $order) {

            if ($order == 'asc') {
                $sql = "SELECT * FROM `user` WHERE (`isblock`='0' AND `is_admin`='0') ORDER BY (`$action`) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `user` where (`isblock`='0' AND `is_admin`='0') ORDER BY (`$action`) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }

        public function sortingapproveduser($conn, $action, $order) {
            
            if ($order == 'asc') {
                $sql = "SELECT * FROM `user` WHERE (`isblock`='1' AND `is_admin`='0') ORDER BY (`$action`) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `user` where (`isblock`='1' AND `is_admin`='0') ORDER BY (`$action`) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }

        public function sortingalluser($conn, $action, $order) {
            
            if ($order == 'asc') {
                $sql = "SELECT * FROM `user` WHERE (`is_admin`='0') ORDER BY (`$action`) ASC";
            } else if ($order == 'desc') {
                $sql = "SELECT * FROM `user` where (`is_admin`='0') ORDER BY (`$action`) DESC";
            }
            $result = $conn->query($sql);

            return $result;
        }

        public function invoice($conn, $id) {

            $sql = "SELECT * FROM user WHERE `user_id`='".$id."'";
            $result = $conn->query($sql);

            return $result;
        }
    }

?>