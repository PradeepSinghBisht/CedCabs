<?php
    $cities = array('Charbagh'=>'0','Indira Nagar'=>'10','BBD'=>'30','Barabanki'=>'60',
                        'Faizabad'=>'100','Basti'=>'150','Gorakhpur'=>'210');
    
    $pickup = $_POST['pickup'];
    $drop = $_POST['drop'];
    $cabtype = $_POST['cabtype'];
    $luggage = $_POST['luggage'];

    foreach($cities as $key => $value){
        if ($pickup == $key){
            $source = $value;
        } 
        if ($drop == $key) {
            $destination = $value;
        } 
    }
    $distance = abs($destination - $source);

    $fare = 0;
    if ($luggage <= 10 && $luggage > 0) {
        $fare = 50;
    } elseif ($luggage > 10 && $luggage <= 20) {
        $fare = 100;
    } elseif ($luggage > 20) {
        $fare = 200;
    }

    if ($cabtype == 'CedMicro') {
        if ($distance <= 10 && $distance > 0) {
            $fare = 50 + $distance * 13.50;
        } elseif ($distance > 10 && $distance <= 60) {
            $fare = 50 + (10 * 13.50) + ($distance-10) * 12;
        } elseif ($distance > 60 && $distance <= 160) {
            $fare = 50 + (10 * 13.50) + (50 * 12) + ($distance-60) * 10.20;
        } elseif ($distance > 160) {
            $fare = 50 + (10 * 13.50) + (50 * 12) + (100 * 10.20) + ($distance-160) * 8.50;
        }
    } else if ($cabtype == 'CedMini') {
        if ($distance <= 10 && $distance > 0) {
            $fare += 150 + $distance * 14.50;
        } elseif ($distance > 10 && $distance <= 60) {
            $fare += 150 + (10 * 14.50) + ($distance-10) * 13;
        } elseif ($distance > 60 && $distance <= 160) {
            $fare += 150 + (10 * 14.50) + (50 * 13) + ($distance-60) * 11.20;
        } elseif ($distance > 160) {
            $fare += 150 + (10 * 14.50) + (50 * 13) + (100 * 11.20) + ($distance-160) * 9.50;
        }
    } else if ($cabtype == 'CedRoyal') {
        if ($distance <= 10 && $distance > 0) {
            $fare += 200 + $distance * 15.50;
        } elseif ($distance > 10 && $distance <= 60) {
            $fare += 200 + (10 * 15.50) + ($distance-10) * 14;
        } elseif ($distance > 60 && $distance <= 160) {
            $fare += 200 + (10 * 15.50) + (50 * 14) + ($distance-60) * 12.20;
        } elseif ($distance > 160) {
            $fare += 200 + (10 * 15.50) + (50 * 14) + (100 * 12.20) + ($distance-160) * 10.50;
        }
    } else if ($cabtype == 'CedSUV') {
        $fare *= 2; //(for double luggage charge)
        if ($distance <= 10 && $distance > 0) {
            $fare += 250 + $distance * 16.50;
        } elseif ($distance > 10 && $distance <= 60) {
            $fare += 250 + (10 * 16.50) + ($distance-10) * 15;
        } elseif ($distance > 60 && $distance <= 160) {
            $fare += 250 + (10 * 16.50) + (50 * 15) + ($distance-60) * 13.20;
        } elseif ($distance > 160) {
            $fare += 250 + (10 * 16.50) + (50 * 15) + (100 * 13.20) + ($distance-160) * 11.50;
        }
    }
    echo $fare;
?>