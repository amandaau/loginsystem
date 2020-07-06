<?php
    //Starts a session on all pages for the website as the header.php file will be on all pages
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RocketPOST</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css">
</head>

<body>

    <!-- header -->
    <header class="container">
        <div id="logo" class="text-center">
            <img src="./img/rocket.svg" alt="rocket">
            <h1>Rocket<span>POST<span></h1>
        </div>

        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="posts.php">Posts</a>
            </li>
            <?php 
            //Checks the global $_SESSION variable to see if a user is logged in
            if(isset($_SESSION['userId'])){
            echo '<li class="nav-item">
                <a class="nav-link" href="createpost.php">Create Post</a>
            </li>';
            }
            ?>
            <li class="nav-item">
                <a class="nav-link active" href="signup.php">Signup</a>
            </li>

            <?php 

                //Checks the global $_SESSION variable to see if a user is logged in
                if(isset($_SESSION['userId'])){
                    //Displays the logout button
                    echo '<li class="nav-item">
                            <form action="includes/logout.inc.php" method="post">
                            <button type="submit" class="btn btn-primary w-100" name="logout-submit">Logout</button>
                            </form>
                        </li>';
                 }
                 else
                 {
                     //Displays the login button
                    echo '<li class="nav-item">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login-modal">
                                Login
                            </button>
                          </li>';
                 }
            ?>

        </ul>
    </header>
    <!-- /header -->

    <!-- Login Modal -->
    <div class="modal fade" id="login-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- login.inc.php - Will process the data from this form-->
                <form action="includes/login.inc.php" method="POST" class="m-3">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="mailuid" placeholder="email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="pwd" placeholder="password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="login-submit">Login</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /Login Modal -->

    <!-- Error messages from GET -->
    <main class="container mt-3">
    <?php
    $errorMsg="";
        //Check $_GET to see if we have any error messages
        if(isset($_GET['error'])){
            //Displays the appropriate error/success message in a bootstrap alert box
            if($_GET['error'] == "emptyfields")
            {
                $errorMsg = "Please fill in all fields";
            }
            else if ($_GET['error'] == "wrongpwd")
            {
                $errorMsg = "Wrong password";
            }
            else if ($_GET['error'] == "nouser")
            {
                $errorMsg = "The user does not exist";
            }else if($errorMsg!=""){
                                echo '<div class="alert alert-danger" role="alert">'
                        .$errorMsg.
                    '</div>';
            }

            }
            else if (isset($_GET['login']) == "success")
            {
                echo '<div class="alert alert-success" role="alert">
                        You have successfully logged in.
                    </div>';    
            }
    ?>
    </main>
    <!-- Error messages from GET -->