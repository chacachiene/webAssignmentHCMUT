<?php
// Initialize the session
session_start();
 // Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("location: /login/login.php");
    exit;
}else{
	//navigate to admin page
}
 
// Destroy the session.

require_once "../config/config.php";
$query = "update customer set active=0 where username='".$_SESSION['username']."'";

$connection->query($query);
$connection->close();

unset($_SESSION['username']);
$_SESSION['loggedin'] = false;
session_destroy();
// Redirect to login page
header("location: login.php");
exit;
?>