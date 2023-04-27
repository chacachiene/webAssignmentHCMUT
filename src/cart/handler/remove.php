<?php 
	session_start();
	if(!isset($_SESSION['username']) || $_SESSION['loggedin'] == false || $_SESSION['role'] != 'customer'){
		//return error code
	}else{
		require_once('../../config/config.php');

		if (isset($_POST['rm_id'])){
			$query = 'select id from customer where username="'.$_SESSION['username'].'"';
			$res = $connection->query($query);
			$Customer_id = $res->fetch_assoc();

			$query = 'select id from cart where CustomerID='.$Customer_id['id'];
			$res = $connection->query($query);
			$Cart_id = $res->fetch_assoc();

			$query = 'delete from keep where cartID='.$Cart_id['id'].' and productID='.$_POST['rm_id'];
			$res = $connection->query($query);
			//header('Location: /cart');
		}else {
			//return error code
		}
		$connection->close();
	}
?>