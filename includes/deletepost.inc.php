<?php
    session_start();
    if(isset($_SESSION['userId'])){
        //Checks the user clicked the submit button from the signup form
        //Connect to the database
        require 'connect.inc.php';

        //Collect the POST information
        $id = mysqli_real_escape_string($conn, $_GET['id']); 
        $id = intval($id);
        $sql = "DELETE FROM posts WHERE id=?"; 
            
        $statement = mysqli_stmt_init($conn); //Inits the statement
        if(!mysqli_stmt_prepare($statement, $sql)) //Checks the prepared sql statement for errors
        {
            header("Location: ../editpost.php?id=$id&error=sqlerror"); //Something went wrong. So we send back a error message using GET
            exit(); 
        }
        else
        {
            mysqli_stmt_bind_param($statement, "i", $id);
            mysqli_stmt_execute($statement);
            header("Location: ../posts.php?id=$id&delete=success"); //Something went wrong. So we send back a error message using GET
            exit();
        }
    }
    else 
    {
        //This will redirect people to the signup page if they try to access this file directly
        header("Location: ../signup.php");
        exit();
    }
?>