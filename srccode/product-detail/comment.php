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
	$customer_id = $_SESSION['id'];
	$now =  date('Y-m-d');

	if(isset($_POST['post-comment-btn'])){
		$product_id = $_POST['post-comment-btn'];
		$comment = $_POST['post-comment-field'];
		$query = "insert into comment (productID, customerID, content, comment_date) values ($product_id, $customer_id, '$comment', '$now')";
		$connection->query($query);
		$connection->close();
		header("Location: /product-detail/detail.php?data=".$product_id."#comment-section");
		exit;
	}

	 
	$product_id = $_POST['id'];
	$comment = $_POST['content'];

	$query = "update comment set content='$comment', comment_date='$now' where customerid=$customer_id and productid=$product_id";

	$connection->query($query);
	  
	$connection->close();



?>