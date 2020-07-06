<?php

//Checks the user clicked the submit button from the login form
if(isset($_POST['login-submit'])){

    require 'connect.inc.php'; // Establishes a connection
    // Gets username and password from POST
    $mailuid = $_POST['mailuid']; 
    $password = $_POST['pwd'];
    
    // Checks that the username and password fields were not blank
    if(empty($mailuid) || empty($password)){
        header("Location: ../index.php?error=emptyfields"); // Sends emptyfields error
        exit(); // Stops the code from running 
    }
    else
    {
        //SQL for finding the user in the database
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?"; // the ? acts as a place holder for the user values we will pass in. (This is for security as it will stop sql injections)
        $statement = mysqli_stmt_init($conn); //Inits a sql staatment
        if(!mysqli_stmt_prepare($statement, $sql)) //Sends the statement to the database to check for errors
        {
            header("Location: ../signup.php?error=sqlerror"); //Something went wrong when preparing the sql
            exit(); //Stops the script from running
        }else {
            //Now we want to run our statement with the user data
            //The first value is the statement we want to run
            //The second value is the type of data we are passing as values into the statement (s = string, b = boolean, i = int)
            //The third value is the user data
            mysqli_stmt_bind_param($statement, "ss", $mailuid, $mailuid); //Binds the params from the user to the statement
            //This runs the sql statement with the user data
            mysqli_stmt_execute($statement);
            //Gets the result
            $result = mysqli_stmt_get_result($statement); 
            //This will convert the data from the database to an array and check we have data
            if($row = mysqli_fetch_assoc($result)){    
                //Check if the password match using bcrypt
                $pwdCheck = password_verify($password, $row['pwdUsers']); 
                if($pwdCheck == false){
                    header("Location: ../index.php?error=wrongpwd");
                    exit(); 
                }
                else if ($pwdCheck == true) {
                    //Starts a session
                    session_start();
                    $_SESSION['userId'] = $row['idUsers']; //Adds the data from $row['idUsers'] to the session variable 
                    $_SESSION['userUid'] = $row['uidUsers']; //Adds the data from $row['uidUsers']; to the session variable
                    header("Location: ../index.php?login=success");
                    exit(); 
                }
                else {
                    //Just incase some unexpected error occurs 
                    header("Location: ../index.php?error=wrongpwd");
                    exit(); 
                }
            }   
            else 
            {
                //If no user was found in the database
                header("Location: ../index.php?error=nouser");
                exit(); 
            }
        }
    }

}
else 
{
    //This will redirect people to the index page if they try to access this file directly
    header("Location: ../index.php");
    exit();
}

?>