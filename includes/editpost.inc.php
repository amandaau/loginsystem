<?php
session_start();
//Checks the user clicked the submit button from the signup form
if(isset($_POST['edit-submit']) && isset($_SESSION['userId'])){
        //Connect to the database
        require 'connect.inc.php';

        //Collect the POST information
        $id = mysqli_real_escape_string($conn, $_GET['id']); 
        $id = intval($id);
        $title = $_POST['title'];
        $imageURL = $_POST['imageurl'];
        $comment = $_POST['comment'];
        $websiteURL = $_POST['websiteurl'];
        $websiteTitle = $_POST['websitetitle'];

        //Check if any of the fields are empty
        if (empty($id) || empty($title ) || empty($imageURL) || empty($comment) || empty($websiteURL) || empty($websiteTitle)) 
        {
            //Redirect the user back to the signup page and pass in the username and email data via GET. (This will allow us to save the user typing the info in again if they make a mistake)
            header("Location: ../editpost.php?id=$id&error=emptyfields");
            exit(); //Stops the script from running
        }
        else 
        {
            //$sql = "UPDATE posts SET title='$title', imageurl='$imageURL', comment='$comment', websiteurl='$websiteURL', websitetitle='$websiteTitle' WHERE id=$id"; 
            //$sql = "UPDATE posts SET (title, imageurl, comment, websiteurl, websitetitle) VALUES (?, ?, ?, ?, ?)  WHERE id=$id";
            $sql = "UPDATE posts SET title=?, imageurl=?, comment=?, websiteurl=?, websitetitle=? WHERE id=?"; 
            
                $statement = mysqli_stmt_init($conn); //Inits the statement
                if(!mysqli_stmt_prepare($statement, $sql)) //Checks the prepared sql statement for errors
                {
                    header("Location: ../editpost.php?id=$id&error=sqlerror"); //Something went wrong. So we send back a error message using GET
                    exit(); 
                }
                else
                {
                    mysqli_stmt_bind_param($statement, "sssssi", $title, $imageURL, $comment, $websiteURL, $websiteTitle, $id);
                    mysqli_stmt_execute($statement);
                    header("Location: ../posts.php?id=$id&signup=success"); //Something went wrong. So we send back a error message using GET
                    exit();
                }
        }

}
else 
{
    //This will redirect people to the signup page if they try to access this file directly
    header("Location: ../signup.php");
    exit();
}


?>