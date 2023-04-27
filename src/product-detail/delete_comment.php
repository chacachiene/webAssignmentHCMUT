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

		require_once "../config/config.php";
		$product_id = $_POST['delete'];
		$customer_id = $_SESSION['id'];
		$query = "delete from comment where productID=$product_id and customerID=$customer_id";
		$connection->query($query);
		$connection->close();
		header("Location: /product-detail/detail.php?data=".$product_id."#comment-section");
?>