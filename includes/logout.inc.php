<?php 

//We need to start the session as we can not end it if it not started
//As we are only starting it on the header.php we need to add it here as we are not using the header.php here
session_start();

session_unset(); //Takes all session values in the $_SESSION variable and removes them
session_destroy(); //Ends the session

header("Location: ../index.php") //Sends the user back to the home page

?>