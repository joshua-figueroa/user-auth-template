<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">
    <link href="css/signup.css" rel="stylesheet">
    <title>Signup</title>
</head>
<body class="text-center">
    <div class="container shadow py-5">
    <?php
		if(isset($_GET['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show text-left" role="alert">
                    <h4 class="alert-heading">Connection Failed!</h4>
                    <hr>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>';
			if($_GET['error'] == 'emptyfields') { 
                echo '<p>Error: Some fields are missing. Fill all the fields and submit again.</p>
                </div>';
            } 
            else if($_GET['error'] == 'invalid_username') {
                echo '<p>Error: Invalid Username. Only letters and numbers are allowed.</p>
                </div>';
            }
            else if($_GET['error'] == 'password_notmatch') {
                echo '<p>Error: Password do not match. Please try again.</p>
                </div>';
            }
            else if($_GET['error'] == 'incorrect_passlen') {
                echo '<p>Error: Password should be greater than 8 characters.</p>
                </div>';
            } 
            else if($_GET['error'] == 'sqlerror') {
                echo '<p>Error: SQL Failed. Contact the administrator and try again after a couple of minutes.</p>
                </div>';
            }
            else if($_GET['error'] == 'username_exist') {
                echo '<p>Error: Username already exists. Try another one.</p>
                </div>';
            }
            else if($_GET['error'] == 'table_failed') {
                echo '<p>Error: Database connection failed. Contact the administrator for the issue.</p>
                </div>';
            }
		} else if(isset($_GET['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show text-left" role="alert">
                    <h4 class="alert-heading">Connection Success!</h4>
                    <hr>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <p>Your account has been created. Please check your email for the verification link.</p>
                    </div>';
        }
    ?>
        <div class="row">
            <div class="col-6 my-auto">
                <img src="images/undraw_secure_login_pdn4.png" alt="signup" class="img-fluid">
            </div>
            <div class="col-6 my-auto">
                <form class="form-signin" method="POST" action="includes/signup.inc.php">
                    <h1 class="h3 mb-3 font-weight-300">Create an Account</h1>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                        </div>
                        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" value='<?php if(isset($_GET['name'])) echo $_GET['name']; ?>' autocomplete="off" required>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                        </div>
                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" value='<?php if(isset($_GET['mail'])) echo $_GET['mail']; ?>' autocomplete="off" required>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" data-toggle="password" required>
                        <div class="input-group-append">
                            <span class="input-group-text eye">
                                <i class="fad fa-eye"></i>
                            </span>
                        </div>  
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password-confirm" id="password-confirm" class="form-control" placeholder="Confirm Password" data-toggle="password" required>
                        <div class="input-group-append">
                            <span class="input-group-text eye">
                                <i class="fad fa-eye"></i>
                            </span>
                        </div>  
                    </div>
                    <button class="mt-2 btn btn-purple px-4" type="submit" name="signup-btn">Sign Up</button>
                    <p class="mt-3"><a href="index.php">Log in</a></p>
                </form>
            </div>
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