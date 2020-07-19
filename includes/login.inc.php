<?php
    if(isset($_POST['login-btn'])) {
        //Include the database file
        require 'database.php';

        //Variables to be access from the database
        $mail_username = filter_var($_POST['user_email'], FILTER_SANITIZE_STRING);
        $password = $_POST['password'];

        //Error Handlers for Fields
        if(empty($mail_username) || empty($password)) {
            header("Location: ../index.php?error=emptyfield");
            exit();
        }
        else {
            //Checking the username in the database
            $sql = "SELECT * FROM users WHERE username=? OR email=?";
            $stmt = $conn -> stmt_init();
            if(!$stmt -> prepare($sql)) {
                //SQL Error
                header("Location: ../index.php?error=sqlerror");
                exit();
            }
            else {
                //Database connection is established. Binding the username parameter
                $stmt -> bind_param("ss", $mail_username, $mail_username);
                // Execute query
                $stmt -> execute();
                //resultset for successful SELECT query
                $result = $stmt -> get_result();
                //Returns an associative array for username or email
                if($row = $result -> fetch_assoc()) {
                    //Return a boolean for password verification
                    $passwordCheck = password_verify($password, $row['password']);
                    if($passwordCheck == FALSE) {
                        header("Location: ../index.php?error=incorrect_password");
                        exit();
                    }
                    else if($passwordCheck == TRUE) {
                        session_start();
                        $_SESSION['userID'] = $row['id'];
                        $_SESSION['userNAME'] = $row['username'];
                        $_SESSION['userEMAIL'] = $row['email'];
                        header("Location: ../dashboard.php");
                        exit();
                    }
                    else {
                        header("Location: ../index.php?error=incorrect_password");
                        exit();
                    }
                }
                else {
                    //No user exist
                    header("Location: ../index.php?error=no_user");
                    exit();
                }
            }
        }
    }
    else {
        //User will be redirected to index page
        header("Location: ../index.php");
        exit();
    }