<?php 
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
		//show error page
		header("Location: /login/login.php");
		exit();
	  }
	  if($_SESSION['role'] != 'customer'){
		//show error page
		echo 'This page is only for customer';
		exit();
	  }
	  // Include config file
	  require_once "../config/config.php";

	  $id = $_SESSION['id'];
	  $query = "select password from customer where id=$id";
	  $res = $connection->query($query);
	  $pass = $res->fetch_assoc()['password'];

	  if(!password_verify($_POST['old'], $pass)){
		echo "Old password is not correct";
		exit();
	  }
	  


	  $new = $_POST['new'];
	  $retype = $_POST['rt'];
	  
	  if(strlen($new) < 6){
		echo "New password length must be over 6";
		exit();
	  }

	  if($retype != $new){
		echo "New password and retype does not match";
		exit();
	  }

	  $newpass_hash = password_hash($_POST['new'], PASSWORD_DEFAULT);
	  $query = "UPDATE CUSTOMER SET password='$newpass_hash'where id=$id";
	  $connection->query($query);
	  $connection->close();

?>