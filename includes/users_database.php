<?php
    //Database Information
    $servername1 = "localhost";
    $dbUsername1 = "joshuafigueroa";
    $dbPassword1 = "joshua234";
    $dbName1 = "users";

    //Create & Check Database Connection
    $user_conn = new mysqli($servername1, $dbUsername1, $dbPassword1, $dbName1);
    if($user_conn -> connect_error) {
        die("Connection failed: " . $user_conn -> connect_error);
    }