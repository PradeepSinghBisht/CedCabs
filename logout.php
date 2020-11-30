<?php
    session_start();
    unset($_SESSION['userdata']);
    unset($_SESSION['landingdata']);
    header ('location: index.php');
 ?>