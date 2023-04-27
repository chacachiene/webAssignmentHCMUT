<?php 
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
		//show error page
		http_response_code(400);
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
	  $product_id = $_POST['id'];
	  $query = "select id from cart where customerID=$customer_id";
	  $cart_id = $connection->query($query)->fetch_assoc()['id'];

	  $query = "select * from keep where cartID=$cart_id and productID=$product_id";
	  $connection->query($query);
	  if($connection->affected_rows != 0){
		echo "This product has been in your cart";
		$connection->close();
		exit;
	  }

	  $query = "insert into keep values ($cart_id, $product_id, 1)";
	  $connection->query($query);
	  $connection->close();

?>