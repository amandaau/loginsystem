<?php 
    require "header.php"
?>

    <main class="container mt-3">
        <?php 
            //Checks the session to see if a user is logged in
            if(isset($_SESSION['userId'])){
               echo '<div class="alert alert-success" role="alert">You are logged in!</div>';
            }
            else
            {
                echo '<div class="alert alert-warning" role="alert">You are not logged in</div>';
            }
        ?>
    </main>
    <main class="container mt-3 p-4 bg-light">
        Welcome to Rocket<b>Posts</b> home page
    </main>

<?php 
    require "footer.php"
?>