<?php
    require "config.php";
    class Location{
        public function fare($conn) {
            $sql = "SELECT * FROM location WHERE `is_available`='1'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                }
            }
        }
    }
?>