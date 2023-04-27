<?php 
	session_start();
	require_once('../../config/config.php');

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
			$query = "select id, name, price from products where id=".$product_id['productID'];
			$res = $connection->query($query);
			$detail = $res->fetch_assoc();
			$detail['quantity'] = $product_id['amount'];
			$detail['subtotal'] = $detail['quantity'] * $detail['price'];
			array_push($PRODUCTS_DETAIL, $detail);
			$total +=  $detail['subtotal'];
		}

		$connection->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="/utils/css/payment.css">
</head>
<body>
	        <!-- Spinner Start -->
			<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

<?php include('../../base/header.php') ?>
  <main class="page payment-page" >
    <section class="payment-form dark" style="background-color: #a6a9be;">
      <div class="container">
        <div class="block-heading">
          <h2>Payment</h2>
        </div>
        <form method="post" action="pay.php">
          <div class="products">
            <h3 class="title">Checkout</h3>
			<?php foreach($PRODUCTS_DETAIL as $product){ ?>
				<div class="item">
					<span class="price">$<?php echo $product['subtotal']; ?></span>
					<p class="item-name"><?php echo $product['name']; ?></p>
					<p class="item-description">Description</p>
				</div>

			<?php } ?>
				<div class="item">
					<span class="price">10%</span>
					<p class="item-name">VAT</p>
				</div>
            <div class="total">Total<span class="price">$<?php echo $total*0.1 + $total; ?></span></div>
          </div>
          <div class="card-details">
            <h3 class="title">Pay Method</h3>
            <div class="row">
              <div class="form-group col-sm-2 d-flex align-self-center">
                <input id="tienmat" type="radio" name="Pay-Method" value="cash">
				<label for="tienmat" style="margin: 0px;"><img src="/image/icon/tienmat.png" class="icon"></label>
              </div>
			<div class="form-group col-sm-10 d-flex align-self-center">
				Thanh toán bằng tiền mặt khi nhận hàng	
			</div>
              <div class="form-group col-sm-2  d-flex align-self-center">
                <input id="momo" type="radio" name="Pay-Method" value="momo">
				<label for="momo" style="margin: 0px;"><img src="/image/icon/momo.png" class="icon"></label>
              </div>
			  <div class="form-group col-sm-10 d-flex align-self-center">
				Thanh toán bằng ví Momo
			</div>
			  <div class="form-group col-sm-2 d-flex align-self-center">
                <input id="zalopay" type="radio" name="Pay-Method" value="zalopay">
				<label for="zalopay" style="margin: 0px;"><img src="/image/icon/zalopay.png" class="icon"></label>
              </div>
			  <div class="form-group col-sm-10 d-flex align-self-center">
				Thanh toán bằng ví ZaloPay
			</div>
			<div class="row" id="method-err" style="color:red;display:none;">
				Please choose a method
			</div>
              <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary btn-block" id="proceed">Proceed</button>
              </div>
            </div>
          </div>
	
        </form>
      </div>
    </section>
  </main>
  <?php include('../../base/footer.html') ?>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/payment.js"></script>
</body>
</html>