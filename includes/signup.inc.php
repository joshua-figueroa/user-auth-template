<?php
    if(isset($_POST['signup-btn'])) {
        //Include the admin database file
        require 'database.php';

        //Variables to be added to the Database
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $passwordCheck = $_POST['password-confirm'];
        $token = bin2hex(random_bytes(75)); // generate unique token

        //Error Handlers for Fields
        if(empty($username) || empty($email) || empty($password) || empty($passwordCheck)) {
            if(empty($username) && !empty($email)) {
                header("Location: ../signup.php?error=emptyfields&mail=$email");
                exit();
            } else if(empty($email) && !empty($username)) {
                header("Location: ../signup.php?error=emptyfields&name=$username");
                exit();
            } else {
                header("Location: ../signup.php?error=emptyfields");
                exit();
            }
        }
        else if(!preg_match("/^[a-zA-Z\d]*$/", $username)) {
            //Return to signup page if username is does not match the characters above
            header("Location: ../signup.php?error=invalid_username&mail=$email");
            exit();
        }
        else if($password !== $passwordCheck) {
            //Return to signup page if password is not equal to passwordCheck
            header("Location: ../signup.php?error=password_notmatch&name=$username&mail=$email");
            exit();
        }
        else if(strlen($password) < 8) {
            //Return to signup page if password is less than 8 characters
            header("Location: ../signup.php?error=incorrect_passlen&name=$username&mail=$email");
            exit();
        }
        else {
            //Usage of prepared statements for more secure database connection
            $sql = "SELECT username FROM users WHERE username=?";
            $stmt = $conn -> stmt_init();
            if(!$stmt -> prepare($sql)) {
                //SQL Error
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }
            else {
                //Database connection is established. Binding the username parameter
                $stmt -> bind_param("s", $username);
                // Execute query
                $stmt -> execute();
                //Storing the result
                $stmt -> store_result();
                //Storing the number of rows that has the variable username in the database
                $resultCheck = $stmt -> num_rows(); 
                //Cheking for duplicate of username in the database
                if($resultCheck > 0) {
                    //Username already exists
                    header("Location: ../signup.php?error=username_exist");
                    exit();
                }
                else {
                    //No duplicate exist. Creating a new record to the database
                    $sql = "INSERT INTO users (username, email, password, token) VALUES (?, ?, ?, ?)";
                    //Prepared statements for secure connection to the database. Just like the code above
                    $stmt = $conn -> stmt_init();
                    if(!$stmt -> prepare($sql)) {
                        //SQL Error
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    }
                    else {
                        //Creating the table for each user
                        $user_table = "CREATE TABLE $username (
                            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            time_submitted TIMESTAMP,
                            random_text VARCHAR(255),
                            comment VARCHAR(255)
                            )";
    
                        if($user_conn -> query($user_table) === TRUE) {
                            //Hashing the password for much secure connection
                            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                            //Three(3) s because 3 parameters are being passed to the SQL statement
                            $stmt -> bind_param("ssss", $username, $email, $hashedPwd, $token);
                            $stmt -> execute();
                            //Creating mail for verification link
                            $to = $email;
                            $subject = 'Signup | Verification';
                            $message = '
                            <!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
                                <style>
                                    .bg-purple, .btn-purple {
                                        background-color: #6f42c1 !important;
                                        color: whitesmoke !important;
                                    }
                                    .btn-purple:hover {
                                        background-color: #523091 !important;
                                        color: whitesmoke !important;
                                    }
                                    #navbar-title {
                                        font-size: 1.7rem !important;
                                    }
                                    .font-300 {
                                        font-weight: 300 !important;
                                    }
                                    @media (max-width: 500px) {
                                        .navbar {
                                            padding-top: 0rem !important;
                                            padding-bottom: 0rem !important;
                                        }
                                        #navbar-title {
                                            font-size: 1.1rem !important;
                                        }
                                        h4 {
                                            font-size: 1rem !important;
                                        }
                                    }
                                </style>
                                <title>Email</title>
                            </head>
                            <body>
                                <nav class="navbar navbar-dark bg-purple">
                                    <div class="container-fluid">
                                        <a class="navbar-brand mx-auto" href="javascript:void(0)" id="navbar-title">Email Verification</a>
                                    </div>
                                </nav>
                            
                                <main role="main" class="mt-3">
                                    <div class="container-fluid">
                                        <h4>Thanks for signing up, '. $username .'!</h4>
                                        <h4>Your account has been created, you can now login after clicking the verification button below:</h4>
                                        <a href="http://localhost/create-acc/verify.php?email='. $email .'&token=' .$token. '" class="btn btn-purple mt-1">Verify Email</a>
                                    </div>
                                </main>
                            </body>
                            </html>';
                            // To send HTML mail, the Content-type header must be set
                            $headers  = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                            mail($to, $subject, $message, $headers); //Send email
                            //Session start for email and token
                            session_start();
                            $_SESSION['mail'] = $email;
                            $_SESSION['token'] = $token;
                            //Signup is successful. Returning to the signup page
                            header("Location: ../signup.php?success=200");
                            exit();
                        } 
                        else {
                            //Table not successful
                            header("Location: ../signup.php?error=table_failed");
                            exit();
                        }
                    }
                }
            }
        }
        //Close Database Connection & Prepared Statement
        $stmt -> close();
        $user_conn -> close();
        $conn -> close();
    } 
    else {
        //User will be redirected to signup page
        header("Location: ../signup.php");
        exit();
    }