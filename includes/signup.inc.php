<?php

//Checks the user clicked the submit button from the signup form
if(isset($_POST['signup-submit'])){

    //Connect to the database
    require 'connect.inc.php';

    //Collect the POST information
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    //Check if any of the fields are empty
    if (empty($username) || empty($email ) || empty($password) || empty($passwordRepeat)) 
    {
        //Redirect the user back to the signup page and pass in the username and email data via GET. (This will allow us to save the user typing the info in again if they make a mistake)
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit(); //Stops the script from running
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) //Check for invalid email and password
    {
        header("Location: ../signup.php?error=invalidmailuid");
        exit(); //Stops the script from running
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
         //Redirect the user back to the signup page and pass in the username data via GET. (This will allow us to save the user typing the info in again if they make a mistake)
         header("Location: ../signup.php?error=invalidmail&uid=".$username);
         exit(); //Stops the script from running
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) //THis search pattern checks if the password contains a-z, A-Z or 0-9
    {
         //Redirect the user back to the signup page and pass in the username data via GET. (This will allow us to save the user typing the info in again if they make a mistake)
         header("Location: ../signup.php?error=invaliduid&mail=".$email);
         exit(); //Stops the script from running
    }
    else if($password !== $passwordRepeat)
    {
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit(); //Stops the script from running
    }
    else 
    {
        //We will begin by checking to see if the user already exists in the database
        //To avoid sql injects it is not a good idea to pass the data straight into the SQL statement
        //Instead we should use prepared statements. 
        //We use the ? as a place holder for the user data.
        //This will stop any additional sql the user may inject from running
        //We then run the sql statement on the database and check it will run ok
        //We then bind the user data as a specific data type(e.g. String ) to the sql statement. 
        //Finally we execute the statement.
        
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?"; //SQL statement
        $statement = mysqli_stmt_init($conn); //Inits the statement
        //Prepares the statement and makes sure nothing is wrong with it by running it in the database
        if(!mysqli_stmt_prepare($statement, $sql))
        {
            header("Location: ../signup.php?error=sqlerror"); //Something went wrong when preparing the sql
            exit(); //Stops the script from running
        }
        else
        {
            //Now we want to bind our user data with the statement
            //The first value is the statement
            //The second value is the type of data (s = string, b = boolean, i = int)
            //The third value is the user data
            mysqli_stmt_bind_param($statement, "s", $username);
            //This runs the sql statement with the user data
            mysqli_stmt_execute($statement);
            //This gets the result from the database and stores it in $statement
            mysqli_stmt_store_result($statement);
            //Checks how many rows of results did we got back
            $resultCheck = mysqli_stmt_num_rows($statement); // We should get back 0 or 1 as we are only look for one user
            //if the user exists 
            if($resultCheck > 0){
                header("Location: ../signup.php?error=usertaken&mail".$email); //Something went wrong. So we send back a error message using GET
                exit(); 
            }
            else
            {
                //If the user dose not already exist in the database we want to save the new user to the database
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                $statement = mysqli_stmt_init($conn); //Inits the statement
                if(!mysqli_stmt_prepare($statement, $sql)) //Checks the prepared sql statement for errors
                {
                    header("Location: ../signup.php?error=sqlerror"); //Something went wrong. So we send back a error message using GET
                    exit(); 
                }
                else
                {
                    //This will hash the password with bcrypt 
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    //The sss stand for 3 strings $username, $email, $hashedPwd)
                    mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($statement);
                    header("Location: ../signup.php?signup=success"); //Something went wrong. So we send back a error message using GET
                    exit();
                }
            }
        }
    }
    //This is not nessasarry as it is eventually done automatically 
    //However it will free up resources
    mysqli_stmt_close($statement); //Closes the statement
    mysqli_close($conn); //Closes the connection 
}
else 
{
    //This will redirect people to the signup page if they try to access this file directly
    header("Location: ../signup.php");
    exit();
}

?>