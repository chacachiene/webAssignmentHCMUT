<?php 
	session_start();
	if(!isset($_SESSION['username']) || $_SESSION['loggedin'] == false || $_SESSION['role'] != 'customer'){
		//return error code
	}else{
		require_once('../../config/config.php');

		if (isset($_POST['upd_id'])){
			$query = 'select id from customer where username="'.$_SESSION['username'].'"';
			$res = $connection->query($query);
			$Customer_id = $res->fetch_assoc();

			$query = 'select id from cart where CustomerID='.$Customer_id['id'];
			$res = $connection->query($query);
			$Cart_id = $res->fetch_assoc();
			
			$query = "select amount from products where ID=".$_POST['upd_id'];
			$res = $connection->query($query);
			$amount_left = $res->fetch_assoc()['amount'];
			if($amount_left < $_POST['amount']){
				$connection->close();
				echo json_encode([ 'amount_left' => $amount_left]);
				exit();
			}

			$query = 'update keep set amount='.$_POST['amount'].' where cartID='.$Cart_id['id'].' and productID='.$_POST['upd_id'];
			$connection->query($query);

			$query = 'select price from products where ID='.$_POST['upd_id'];
			$res = $connection->query($query);
			$price = $res->fetch_assoc()['price'];
			echo json_encode(['update_amount' => intval($price * $_POST['amount']*1000)/1000]); 
			
		}else {
			//return error code
		}
		$connection->close();
	}
?>