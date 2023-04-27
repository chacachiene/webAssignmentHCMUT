<?php 
	session_start();
	if(!isset($_SESSION['username']) || $_SESSION['loggedin'] == false){
		//show error page
		header("Location: /login/login.php");
		exit();
	}
	if($_SESSION['role'] != 'customer'){
		//show error page
		echo 'This page is only for customer';
		exit();
	}else{ 
		require_once('../config/config.php');

		$query = "select * from customer where username='".$_SESSION['username']."'";
		
		$res = $connection->query($query);
		$CUSTOMER_INFO = $res->fetch_assoc();


		$query = "select id from cart where customerID=".$CUSTOMER_INFO['id'];
		$res = $connection->query($query);
		$cartID = $res->fetch_assoc()['id'];

		$query = "select productID,amount from keep where cartID=".$cartID;
	
		$res = $connection->query($query);
		$products_in_cart_id = $res->fetch_all(MYSQLI_ASSOC);

		$total = 0;
		$PRODUCTS_DETAIL = array();
		foreach($products_in_cart_id as $product_id){
			$query = "select * from products where id=".$product_id['productID'];
			$res = $connection->query($query);
			$detail = $res->fetch_assoc();
			$detail['quantity'] = $product_id['amount'];
			$detail['subtotal'] = $detail['quantity'] * $detail['price'];
			array_push($PRODUCTS_DETAIL, $detail);
			$total +=  $detail['subtotal'];
		}

	
		$connection->close();

	?>
	
		<!DOCTYPE html>
			<html>
			<head>
				<title>Shopping Cart</title>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"">
				<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
				<link rel="stylesheet" href="/utils/css/shoppingcart.css">
			</head>
			<body>
				        <!-- Spinner Start -->
						<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

			<?php include('../base/header.php'); ?>
				<main class="page" >
					<section class="shopping-cart dark" style="background-color: #a6a9be;">
						<div class="container">
							<div class="block-heading">
							<h2>Shopping Cart</h2>

							</div>
							<div class="content">
								<div class="row">
									<div class="col-md-12 col-lg-8 list">
										<div class="items">
										<?php foreach($PRODUCTS_DETAIL as $product){ ?>
											<div class="product" id="product_<?php echo $product['id']; ?>">
												<div class="row">
													<div class="col-md-3">
														<img class="img-fluid mx-auto d-block image" src="<?php echo "/image/products/".$product['image']; ?>" >
													</div>
													<div class="col-md-8">
														<div class="info">
															<div class="row">
																<div class="col-md-5 product-name">
																	<div class="product-name">
																		<a href="#"><?php echo $product['name'] ?></a>
																		<div class="product-info">
																			<div>Display: <span class="value"><?php echo $product['screen']; ?></span></div>
																			<div>RAM: <span class="value"><?php echo $product['ram']; ?></span></div>
																			<div>Chip: <span class="value"><?php echo $product['chip']; ?></span></div>
																		</div>
																	</div>
																</div>
																<div class="col-md-4 quantity">
																	<label for="quantity">Quantity:</label>
																	<input id="quantity_<?php echo $product['id']; ?>" min="1" type="number" max="<?php echo $product['amount']; ?>" value ="<?php echo $product['quantity']; ?>" class="form-control quantity-input">
																	<p id="quantity_err_<?php echo $product['id'];?>" style="color:red"></p>
																</div>
																<div class="col-md-3 price">
																	$<span id="subtotal_<?php echo $product['id']; ?>"><?php echo $product['subtotal']; ?></span>
																</div>
															</div>
															
														</div>
													</div>
													<div class="col-md-1 d-flex justify-content-center align-self-center">
														<div class="close" id="close_<?php echo $product['id']; ?>"><img src="/image/icon/thungrac.png"></div>
													</div>
												</div>
												<hr>
											</div>
										
										<?php 	} ?>
										</div>
									</div>
									<div class="col-md-12 col-lg-4">
										<div class="summary">
											<h3>Summary</h3>
											<div class="summary-item"><span class="text">Subtotal</span><span id="subtotalAll" class="price">$<?php echo $total; ?></span></div>
											<div class="summary-item"><span class="text">Discount</span><span class="price">$0</span></div>
											<div class="summary-item"><span class="text">VAT</span><span class="price">10%</span></div>
											<div class="summary-item"><span class="text">Total</span><span id ="total" class="price">$<?php echo $total + $total*0.1; ?></span></div>
											<form method="post" action="payment/">
												<button type="submit" class="btn btn-primary btn-lg btn-block" id="checkout">Checkout</button>
											</form>
										</div>
									</div>
								</div> 
							</div>
						</div>
					</section>
				</main>
				<?php include('../base/footer.html'); ?>
			</body>
			<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
			<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
			<script src="js/cart.js"></script>

			</body>
			</html>
	<?php } ?>