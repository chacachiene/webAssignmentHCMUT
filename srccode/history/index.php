<?php
	session_start();

	if(!isset($_SESSION['username']) || $_SESSION['loggedin'] == false){
		//show error page
		echo "You must log in to see this page";
		exit();
	}
	if($_SESSION['role'] != 'customer'){
		//show error page
		echo 'This page is only for customer';
	}else{
		require_once('../config/config.php');

		$query = "select id from customer where username='".$_SESSION['username']."'";
		
		$res = $connection->query($query);
		$CUSTOMER_ID = $res->fetch_assoc()['id'];


		$query = "select * from bill where CustomerID=".$CUSTOMER_ID;
		$res = $connection->query($query);
		$bills = $res->fetch_all(MYSQLI_ASSOC);
			
		$connection->close();
	}
?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Orders</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/history.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
	</head>
	<body style="background-color: #a6a9be;">
	        <!-- Spinner Start -->
			<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

		<?php include('../base/header.php'); ?>
		
			<div class="container-fluid" >
					<div class="container mt-4 mb-4" style="background-color: white;padding:10px;">
				
					
						<table id="history-table" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th >Id</th>
									<th >Date</th>
									<th >Total</th>
									<th>Pay Method</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($bills as $bill){
										echo "<tr style='vertical-align:middle;' name='bill_".$bill['id']."'>";
											echo "<td>#".$bill['id']."</td>";
											echo "<td>".$bill['date']."</td>";
											echo "<td>$".$bill['totalcost']."</td>";
											echo "<td>".$bill['Pay_method']."</td>";	
											echo "<td>".$bill['status']."</td>";
										echo "</tr>";
									}
								?>
						</table>
					</div>
			</div>
		<?php include('../base/footer.html'); ?>
		<script src="js/history.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
	</body>
</html>