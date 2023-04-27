<?php
	session_start();
	require_once('../../config/config.php');
	$total = 0;

	$query = "select id from customer where username='".$_SESSION['username']."'";	
	$res = $connection->query($query);
	$CUSTOMER_ID = $res->fetch_assoc()['id'];

	$query = "select id from cart where customerID=".$CUSTOMER_ID;
	$res = $connection->query($query);
	$CART_ID = $res->fetch_assoc()['id'];

	$query = "select count(*) from bill where CustomerID=".$CUSTOMER_ID ;
	$res = $connection->query($query);
	$Bill_id = $res->fetch_assoc()['count(*)'] + 1;

	$now =  date('Y-m-d H:i:s');

	$paymethod = $_POST['Pay-Method'];
	$query = "insert into bill (id,customerID,date,totalcost,pay_method,status) values ($Bill_id,$CUSTOMER_ID,'$now', 0, '$paymethod','waiting') ";
	echo $query;
	$connection->query($query);

	$query = "select * from keep where cartID=".$CART_ID;
	$result = $connection->query($query);

	$total = 0;

	while($row = $result->fetch_assoc()){
		$product_id = $row['productID'];
		$amount = $row['amount'];


		$query = "select price,amount from products where id=".$product_id;
		$res = $connection->query($query)->fetch_assoc();
		$price = $res['price'];
		$product_amount = $res['amount'];
		
		$total += $amount * $price;

		$query = "insert into products_of_bill values ($Bill_id, $product_id, $amount, $CUSTOMER_ID)";
		echo $query."<br>";
		$res = $connection->query($query);
		$new_product_amount = $product_amount - $amount;
		$query = "update products set amount=".$new_product_amount." where id=".$product_id;
		$connection->query($query);
	
	}

	$query = "Delete from keep where cartID=".$CART_ID;
	$connection->query($query);
	$total = $total + $total*0.1;
	$query = "update bill set totalcost=".$total." where id=".$Bill_id." and customerID=".$CUSTOMER_ID;
	$connection->query($query);

	$connection->close();	
	header('Location: /history/bill.php?id='.$Bill_id);
?>
//		customerID	
