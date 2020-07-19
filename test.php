<?php
    require 'includes/email.inc.php';

    $to = "joshuavillartafigueroa@gmail.com";
    $subject = "PHP MAIL!";
    $message = $msg;
    $headers = 'From: Joshua Figueroa' . "\n";
    $headers  .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    
    if(mail($to, $subject, $message, $headers)) {
        echo "Email has been sent.";
    } else {
        echo "An error has occured.";
    }
?>