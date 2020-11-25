<?php
    require "allusers.php";
    $id = $_POST['id'];
    $sql = "SELECT * FROM user where `user_id` = '$id'";
    $result = $db->conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['isblock'] == '0') {
                $row['isblock'] = '1';
            } else {
                $row['isblock'] = '0';
            }
        }
    }
?>