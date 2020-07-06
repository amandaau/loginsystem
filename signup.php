<?php 
    require "header.php"
?>

<main class="container p-4 bg-light mt-3">
    <!-- signup.inc.php - Will process the data from this form-->
    <form action="includes/signup.inc.php" method="post">
        <h2>Signup</h2>
        <!-- If there is a error/success in $_GET displays appropriate error/success message-->
        <?php
            if(isset($_GET['error'])){

                if($_GET['error'] == "emptyfields")
                {
                    $errorMsg = "Please fill in all fields";
                }
                else if ($_GET['error'] == "invalidmailuid")
                {
                    $errorMsg = "Invalid email and Password";
                }
                else if ($_GET['error'] == "invalidmail")
                {
                    $errorMsg = "Invalid email";
                }
                else if ($_GET['error'] == "invaliduid")
                {
                    $errorMsg = "Invalid username";
                }
                else if ($_GET['error'] == "passwordcheck")
                {
                    $errorMsg = "Passwords do not match";
                }
                else if ($_GET['error'] == "usertaken")
                {
                    $errorMsg = "Username already taken";
                }
                echo '<div class="alert alert-danger" role="alert">'
                        .$errorMsg.
                     '</div>';
            }
            else if (isset($_GET['signup']) == "success")
            {
                echo '<div class="alert alert-success" role="alert">
                        You have successfully signed up.
                     </div>';    
            }
        ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" name="uid" placeholder="username">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="mail" placeholder="email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="pwd" placeholder="password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Repeat Password</label>
            <input type="password" class="form-control" name="pwd-repeat" placeholder="repeat password">
        </div>

        <button type="submit" name="signup-submit" class="btn btn-primary w-100">Signup</button>

    </form>
</main>

<?php 
    require "footer.php"
?>