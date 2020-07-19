<?php
    //Session start
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">
    <link href="css/verify.css" rel="stylesheet">
    <title>Verify Email</title>
</head>
<body class="text-center">
    <div class="container shadow">
        <div class="row">
        <?php
            if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['token']) && !empty($_GET['token']) && ($_GET['email'] === $_SESSION['mail']) && ($_GET['token'] === $_SESSION['token'])) {
                //Include the admin database file
                require 'includes/database.php';
                //Get the email and token variables
                $email = $_GET['email'];
                $token = $_GET['token'];
                //SQL string to select the row query
                $sql = "SELECT email, token, verified FROM users WHERE email=? AND token=? AND verified='0'";
                //Prepared statements
                $stmt = $conn -> stmt_init();
                if($stmt -> prepare($sql)) {
                    //Binding parameters
                    $stmt -> bind_param("ss", $email, $token);
                    // Execute query
                    $stmt -> execute();
                    //Storing the result
                    $stmt -> store_result();
                    //Storing the number of rows that has the variable username in the database
                    $resultCheck = $stmt -> num_rows();
                    if($resultCheck > 0) {
                        //Email and token exist
                        $sql = "UPDATE users SET verified='1' WHERE email=? AND verified='0'";
                        $stmt = $conn -> stmt_init();
                        $stmt -> prepare($sql);
                        //Binding parameters
                        $stmt -> bind_param("s", $email);
                        // Execute query
                        $stmt -> execute();
                 
        ?>
                    <div class="col-6 my-auto">
                        <img src="images/undraw_authentication_fsn5.png" alt="verify" class="img-fluid">
                    </div>
                    <div class="col-6 my-auto py-10">
                        <h1 class="h3 mb-3 font-weight-300" style="line-height: 1.5;">Email Verification Successful!</h1>
                        <a href="index.php" class="mt-2 btn btn-purple px-4">Log in</a>
                    </div>
                <?php
                    }
                    else {
                ?>
                    <div class="col-6 my-auto">
                        <img src="images/undraw_two_factor_authentication_namy.png" alt="exist" class="img-fluid">
                    </div>
                    <div class="col-6 my-auto py-10">
                        <h1 class="h3 mb-3 font-weight-300" style="line-height: 1.5;">Email is already verified!</h1>
                        <a href="index.php" class="mt-2 btn btn-purple px-4">Log in</a>
                    </div>
        <?php
                    }
                }
            }
            else {
        ?>
            <div class="col-6 my-auto">
                <img src="images/undraw_server_down_s4lk.png" alt="denied" class="img-fluid">
            </div>
            <div class="col-6 my-auto py-10">
                <h1 class="h3 mb-3 font-weight-300" style="line-height: 1.5;">Access Denied!</h1>
                <a href="index.php" class="mt-2 btn btn-purple px-4">Log in Page</a>
            </div>
            <?php
            }
        ?>
        </div>
    </div>
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- Local Javascript -->
    <script src="js/script.js"></script>
</body>
</html>