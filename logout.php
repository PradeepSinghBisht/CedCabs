<?php
    session_start();
    if ($_SESSION['userdata']['is_admin'] == '1') {
        unset($_SESSION['userdata']);
    } else if ($_SESSION['userdata']['is_admin'] == '0') {
        unset($_SESSION['userdata']);
        unset($_SESSION['landingdata']);
    }
    header ('location: index.php');
 ?>