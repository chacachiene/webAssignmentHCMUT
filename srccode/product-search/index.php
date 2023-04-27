<?php
    session_start();
	require_once "../config/config.php";


		$products = array();

		$order = False;
		if(isset($_GET['decrease'])){
			$order = " ORDER BY price DESC";
		}else if (isset($_GET['increase'])){
			$order =" ORDER BY price ASC";
		}

		if(!isset($_GET['search']) || $_GET['search'] == "") {
			$sql = "SELECT * FROM `products`";
			if($order){
				$sql .= $order;
			}
			$result = mysqli_query($connection, $sql);

			if (!$result) {
				die("Query failed: " . mysqli_error($connection));
			}

			while ($row = mysqli_fetch_assoc($result)) {
				$product = array("id" => $row['id'], "image" => $row['image'], "name" =>  $row['name'], "price"=> $row['price']);
				array_push($products, $product);
			}
		} else {
			$search = $_GET['search'];
			$sql="Select * from `products` where id like '%$search%'
			or name like '%$search%'
			or price like '%$search%'
			or type='$search'";    
			if($order){
				$sql .= $order;
			}
			$_SESSION['sql_data'] = $sql;
			$result=mysqli_query($connection, $sql);
			if($result) {
				// Num of products > 0
				if(mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)){
						$product = array("id" => $row['id'], "image" => $row['image'], "name" =>  $row['name'], "price"=> $row['price']);
						array_push($products, $product);
					}
				} 
			}

		}
		


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4Tech Product</title>




    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body style="background-color: #a6a9be;">
	<?php include "../base/header.php" ?>

	<div class="row" id="alert-row" style="display:none">
				<div class="col-12 d-flex justify-content-end">
					<div class="alert-box" style="width:fit-content;">
						<div class="alert alert-warning d-flex" style="padding:0px 5px 0px 5px;">
							<div class="col-10 d-flex align-self-center">
								<strong id='alert-message'>Added</strong>
							</div>
							<div class="col-2 d-flex justify-content-end">
								<button type="button" class="close" id="close-alert" aria-label="Close" style="background-color: inherit;border:none">
									<h3><span aria-hidden="true" style="color:red; font-size:15;">&times;</span></h3>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>

	<div class="container bg-white " style="padding-top: 10px;">
		<form class="search-bar" method="get">
					<div class="col-12">
						<div class="row mb-2">
							<div class="col-7 d-flex justify-content-end"><input class="search-input pl-3"  type="text" placeholder="Input keyword..." name="search" /></div>
							<div class="col-5"><button class="search-btn btn btn-primary">Search</button></div>
						</div>
						<div class="row">
							<div class="col-6 d-flex justify-content-end">
								<button class="search-btn btn btn-primary" name="increase" value="true">Low to High</button>
								<?php if(isset($_GET['search'])) {?> <input type="hidden" name="search" value="<?php echo $_GET['search']; ?>"> <?php }?>
							</div>

							<div class="col-6">
								<button class="search-btn btn btn-primary" name="decrease" value="true">High to Low</button>
								<?php if(isset($_GET['search']))  {?> <input type="hidden" name="search" value="<?php echo $_GET['search']; ?>"> <?php }?>
							</div>	
						
						</div>
					</div>
				</form>
		<nav class="navbar-expand-md navbar-light bg-white">
			<div class="container-fluid p-0"> 
				<button class="navbar-toggler" style="margin: 5px 0px 5px 90%;" type="button" data-bs-toggle="collapse" data-bs-target="#myNav" aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation"> 
					<span class="fas fa-bars"></span> 		
				</button>
				<div class="collapse navbar-collapse" id="myNav">
					<div class="navbar-nav ms-auto"> 
						<a class="nav-link <?php if(!isset($_GET['search']) || $_GET['search'] == ""){echo "active";} ?>" aria-current="page" href=".">All</a> 
						<a class="nav-link <?php if(isset($_GET['search']) && $_GET['search'] == "Macbook"){echo "active";} ?>" href="./?search=Macbook">Macbook</a> 
						<a class="nav-link <?php if(isset($_GET['search']) && $_GET['search'] == "Iphone"){echo "active";} ?>" href="./?search=Iphone">Iphone</a> 
						<a class="nav-link <?php if(isset($_GET['search']) && $_GET['search'] == "Ipad"){echo "active";} ?>" href="./?search=Ipad">Ipad</a> 
						<a class="nav-link <?php if(isset($_GET['search']) && $_GET['search'] == "Apple+watch"){echo "active";} ?>" href="./?search=Apple+watch">Apple watch</a> 
					</div>
				</div>
		</nav>
		<?php 
		$count = 0;
		foreach($products as $product){ 
			if($count % 4 == 0) echo '<div class="row">';
		?>
				<div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center justify-content-center product-item my-3">
					<div class="product"> <img src="/image/products/<?php echo $product['image']; ?>" alt="">
						<ul class="d-flex align-items-center justify-content-center list-unstyled icons">
							<li class="icon" name="add_<?php echo $product['id']; ?>"><span class="fa fa-cart-shopping"></span></li>
							<a href="/product-detail/detail.php?data=<?php echo $product['id']; ?>"><li class="icon mx-3"><span class="fa fa-exclamation"></span></li></a>
						</ul>
					</div>
					<div class="title pt-4 pb-1"><?php echo $product['name']; ?></div>
					<div class="price">$ <?php echo $product['price']; ?></div>
				</div>
		<?php 
			if($count % 4 == 3) echo '</div>';
			$count += 1;
		}
		if(!$products){
			echo '<h3 style="color:red;"> Cannot find products relate to this keyword </h3>';
		} 
		?>

			
	</div></div>

				
						
	<?php include "../base/footer.html"; ?>
	<script src='./assets/js/add2cart.js'></script>
    <script src='./assets/js/search.js'></script>
</body>

</html>