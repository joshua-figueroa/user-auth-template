<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">
    <link href="css/index.css" rel="stylesheet">
    <title>Login Form</title>
</head>
<body class="text-center">
    <div class="container shadow">
        <?php
            if(isset($_GET['error'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show text-left mt-3" role="alert">
                    <h4 class="alert-heading">Log in Failed!</h4>
                    <hr>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>';
                if($_GET['error'] == 'emptyfield') { 
                    echo '<p>Error: One of the field is missing.</p>
                    </div>';
                }
                else if($_GET['error'] == 'sqlerror') {
                    echo '<p>Error: SQL Failed. Contact the administrator and try again after a couple of minutes.</p>
                    </div>';
                }
                else if($_GET['error'] == 'no_user') { 
                    echo '<p>Error: Account does not exist.</p>
                    </div>';
                }
            } 
            else if(isset($_GET['success'])) {
                echo '<div class="alert alert-success alert-dismissible fade show text-left mt-3" role="alert">
                        <h4 class="alert-heading">Logout Success!</h4>
                        <hr>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <p>You have successfully logout.</p>
                        </div>';
            }
        ?>
        <div class="row">
            <div class="col-6 my-auto">
                <img src="images/undraw_Login_v483.png" alt="login" class="img-fluid">
            </div>
            <div class="col-6 my-auto">
                <form class="form-signin" method="POST" action="includes/login.inc.php">
                    <h1 class="h3 mb-3 font-weight-300">Log in</h1>
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                        </div>   
                        <input type="text" name="user_email" id="inputEmailorID" class="form-control" placeholder="Email / Username">
                    </div>
                    <div class="input-group mb-2 pass">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" data-toggle="password">
                        <div class="input-group-append">
                            <span class="input-group-text eye">
                                <i class="fad fa-eye"></i>
                            </span>
                        </div>   
                    </div>
                    <button class="mt-2 btn btn-purple px-4" type="submit" name="login-btn">Log in</button>
                    <p class="mt-3"> <a href="signup.php">Create Account</a></p>
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