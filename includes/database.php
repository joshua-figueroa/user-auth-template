<?php
    //Database Information
    $servername = "127.0.0.1:3307";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName1 = "admin";
    $dbName2 = "users";

    //Create & Check Database Connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName1);
    $user_conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName2);
    if($conn -> connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }
    if($user_conn -> connect_error) {
        die("Connection failed: " . $user_conn -> connect_error);
    }