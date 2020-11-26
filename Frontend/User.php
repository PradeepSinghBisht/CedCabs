<?php
    require "config.php";
    session_start();

    class User {

        public function signup($errors, $username, $name, $mobile, $password, $confirmpassword, $isadmin, $conn) {
            
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
                VALUES("'.$username.'","'.$name.'",NOW(),"'.$mobile.'","'.$isadmin.'","'.$password.'","'.$isadmin.'")';
        
                if ($conn->query($sql) === true) {
                    echo '<script> alert("Registered Successfully")</script>';
        
                } else {
                    $errors[] = array('input'=>'form', 'msg'=>$conn->error);
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            return $errors;
        }


        public function login($errors, $username, $password, $conn) {
            $sql = "SELECT * FROM user WHERE `user_name`='".$username."'
                    AND `password`='".$password."'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['isblock'] == 1 and $row['is_admin'] == 0) {
                        $_SESSION['userdata'] = array('user_id'=>$row['user_id'],
                        'user_name'=>$row['user_name'], 'name'=>$row['name'],
                        'dateofsignup'=>$row['dateofsignup'], 'mobile'=>$row['mobile'], 
                        'isblock'=>$row['isblock'], 'is_admin'=>$row['is_admin']);
                        
                        header('Location: index.php');

                    } else if ($row['isblock'] == 1 and $row['is_admin'] == 1){
                        $_SESSION['userdata'] = array('user_id'=>$row['user_id'],
                        'user_name'=>$row['user_name'], 'name'=>$row['name'],
                        'dateofsignup'=>$row['dateofsignup'], 'mobile'=>$row['mobile'], 
                        'isblock'=>$row['isblock'], 'is_admin'=>$row['is_admin']);

                        header('Location: ../Backend/admindashboard.php');
                        
                    } else if ($row['isblock'] == 0){
                        echo '<script> alert("Please Wait for Admin Approval")</script>';
                    }
                }
            } else {
                $errors[] = array('input'=>'login', 'msg'=>'Invalid Login Details');
            }
            return $errors;
        }

        public function updateinfo($errors, $username, $name, $mobile, $conn) {
        
            $sql = "UPDATE user SET `user_name` = '".$username."', `name` = '".$name."',
                        `mobile` = '".$mobile."' 
                    WHERE `user_id` = '".$_SESSION['userdata']['user_id']."'";
            
            if ($conn->query($sql) === true) {
                echo "<script> alert('Updated Successfully')</script>";
            } else {
                $errors[] = array('input'=>'form', 'msg'=>$conn->error);
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            return $errors;
        }

        public function changepassword($errors, $password, $confirmpassword, $conn) {

            if ($password != $confirmpassword) {
                $errors[] = array('msg'=>'Password Doesn\'t Match');
            }
            
            if (sizeof($errors) == 0) {
                $sql = "UPDATE user SET `password` = '".$password."'
                        WHERE `user_id` = '".$_SESSION['userdata']['user_id']."'";
                
                if ($conn->query($sql) === true) {
                    echo "<script> alert('Updated Successfully')</script>";
                } else {
                    $errors[] = array('input'=>'form', 'msg'=>$conn->error);
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            return $errors;
        }
        
    }

?>