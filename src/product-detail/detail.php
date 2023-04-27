<?php
	session_start();
    require_once "../config/config.php";

    // get data value from href
    $data=$_GET['data'];
    // echo $data;

    $sql="Select * from `products` where id=$data";
    $result=mysqli_query($connection, $sql);
    if($result) {
        // product from products
        $row=mysqli_fetch_assoc($result);
        // echo $row['name'];
    }
	else{
		echo "product not exist";
	}

	$query = "select * from comment where productid=$data";
	$res = $connection->query($query);
	$comments = $res->fetch_all(MYSQLI_ASSOC);
	
	$cur_user_comment = false;
	if(isset($_SESSION['username']) && $_SESSION['loggedin'] == true){
		foreach($comments as $comment){
			if($comment['customerID'] == $_SESSION['id']){
				$cur_user_comment = $comment;
				break;
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product information</title>


    <link rel="stylesheet" href="./assets/css/style-detail.css">
</head>

<body>

	<?php include "../base/header.php"; ?>

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

		<!-- !Search -->

		<!-- main -->
		<main class="main">

			<!--   product  -->
			<section id="product" class="py-3">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<?php 
								echo '
									<div style="background-image: url(/image/products/'.$row['image'].')" class="img-show">
									</div>
									<div class="img-selects">
										<div style="background-image: url(/image/products/'.$row['image'].')" class="img-select"></div>
										<div style="background-image: url(/image/products/'.$row['image1'].')" class="img-select"></div>
										<div style="background-image: url(/image/products/'.$row['image2'].')" class="img-select"></div>
										<div style="background-image: url(/image/products/'.$row['image3'].')" class="img-select"></div>
									</div>
								'
							?>
							
						</div>
						<div class="col-sm-6 py-5">
							<?php 
								echo '
									<h3>'.$row['name'].'</h3>
								'
							?>
							<small>
								<?php 
									echo ''.$row['type'].''
								?>
							</small>

							<hr class="m-0">

							<!--- product price  -->
							<table class="my-3">
								<tr class="">
									<td>Price:</td>
									<td class="text-danger pl-2">
										<span>
											<?php 
												echo '$ '.$row['price'];
											?>
										</span>
										<small class="text-dark">&nbsp;&nbsp;Tax not included</small>
									</td>
								</tr>
							</table>
							<!--- product price  -->

							<!--    #policy -->
							<div id="policy">
								<div class="d-flex justify-content-between">
									<div class="returning-policy text-center mr-5">
										<div class="my-2">
											<span class="fas fa-retweet border p-3 rounded-pill text-success"></span>
										</div>
										<a href="#" class="  text-decoration-none">Refund within 10 days</a>
									</div>
									<div class="returning-policy text-center mr-5">
										<div class="my-2">
											<span class="fas fa-truck  border p-3 rounded-pill text-success"></span>
										</div>
										<a href="#" class="  text-decoration-none">Fast delivery</a>
									</div>
									<div class="returning-policy text-center mr-5">
										<div class="my-2">
											<span class="fas fa-check-double border p-3 rounded-pill text-success"></span>
										</div>
										<a href="#" class="  text-decoration-none">1 year guarantee</a>
									</div>
								</div>
							</div>
							<!--    !policy -->
							<hr>

							<!-- order-details -->
							<div id="order-details" class="  d-flex flex-column text-dark">
								<small>Delivery duaration: in 5 days</small>
								<small>Product type: <span class="text-primary" href="#"><?php echo ''.$row['type'].'' ?> </span></small>
								<small><i class="fas fa-map-marker-alt color-primary mr-2"></i>Origin : Genuine</small>
							</div>

							<!-- size -->
							<div class="size my-3">
								<div class="d-flex">
									<div class="col-12 d-flex justify-content-center">
										<?php if(!isset($_SESSION['username']) || $_SESSION['loggedin'] == false ){ ?>
										<a class="btn btn-primary" href="/login/login.php" >Add to your cart <i class="fa-solid fa-cart-shopping"></i></a>
										<?php }else{ ?>
										<button type="button" id="add2cart" value="<?php echo $row['id']; ?>" class="btn btn-primary">Add to your cart <i class="fa-solid fa-cart-shopping"></i></button>
										<?php }?>
									</div>
								</div>
							</div>
							<!-- !size -->


						</div>

						<div class="detail col col-12 pt-5" style="margin:auto;">
							<h3>Description</h3>
							<div class="pt-4 pl-2 pr-2 pb-2">
								<!-- Card form tabs -->
								<ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
									<li class="nav-item">
										<a data-toggle="pill" class="nav-link active "> 
											Product Info
										</a>
									</li>
								</ul>
							</div>
							<div class="tab-content">
								<div id="info-product" class="tab-pane fade show active pt-3">
									<h4>Specifications</h4>
									<table class="table table-striped">
										<tr>
											<th>Product type</th>
											<th><?php echo $row['type']; ?></th>
										</tr>
										<tr>
											<th>Model</th>
											<th><?php echo $row['name']; ?></th>
										</tr>
										<tr>
											<th>Chip</th>
											<th><?php echo $row['chip']; ?></th>
										</tr>
										<tr>
											<th>RAM</th>
											<th>
												<?php echo $row['ram']; ?>
											</th>
										</tr>
										<!-- <tr>
											<th>Ổ cứng</th>
											<th>256GB SSD M.2 PCIE, 1x slot SATA3 2.5"</th>
										</tr> -->
	
										<tr>
											<th>Screen</th>
											<th><?php echo $row['screen']; ?></th>
										</tr>
										<tr>
											<th>Battery</th>
											<th><?php echo $row['battery']; ?></th>
										</tr>
									</table>

								</div>
								<div id="outstanding" class="tab-pane fade pt-3">
									<?php echo $row['outstanding']; ?>
								</div>
								<div id="quanranting" class="tab-pane fade pt-3">
									<?php echo $row['guarantee']; ?>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-center">
						<a class="btn btn-primary mt-5" role="button" href="/product-search/index.php">Back to products page</a>
				</div>
				<hr>
			</section>
			<!-- product -->
			<div class="container d-flex justify-content-center mt-100 mb-100" id="comment-section">
				<div class="row" style="width:100%;">
					<div class="col-md-12">

						<div class="card">	
                            <div class="card-body">
                                <h4 class="card-title">Recent Comments</h4>
                                <h6 class="card-subtitle">Latest Comments section by users</h6> </div>
							
							<?php if(!$cur_user_comment && isset($_SESSION['username']) && $_SESSION['loggedin']){ ?>
								<form action="comment.php" method="post">
									<div class="container mb-3">
										<div class="row d-flex justify-content-center">
										<div class="col-md-12 col-lg-10 col-xl-8">
											<div class="card">
											
											<div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
												<div class="d-flex flex-start w-100">
												<img class="rounded-circle shadow-1-strong me-3"
													src="<?php echo $image; ?>" alt="avatar" width="40"
													height="40" />
													<div class="form-outline w-100">
														<textarea class="form-control" name="post-comment-field" rows="4"
														style="background: #fff;"></textarea>
													</div>
												</div>
												<div class="float-end mt-2 pt-1">
													<button type="submit" value="<?php echo $data; ?>" class="btn btn-primary btn-sm" name="post-comment-btn">Post comment</button>
												</div>
											</div>
											</div>
										</div>
										</div>
									</div>
								</form>
							<?php } ?>

                            <div class="comment-widgets m-b-20">
								<?php if($cur_user_comment){ 
									$customer_id = $cur_user_comment['customerID'];
									$query = "select image from customer where id=$customer_id";
									$res = $connection->query($query);
									$customer_data = $res->fetch_assoc();
									$image = "/image/customer/".$customer_data['image'];
								?>
									<div class="d-flex flex-row comment-row" style="width:100%;">
                                    <div class="p-2"><span class="round"><img src="<?php echo $image; ?>" alt="user" width="50"></span></div>
                                    <div class="comment-text w-100">
                                        <h5><?php echo $_SESSION['username'] ; ?></h5>
                                        <div class="comment-footer">
                                            <span class="date"><?php echo $cur_user_comment['comment_date']; ?></span>
                                            <span class="action-icons">
                                                    <a href="" name="show-edit-box" data-abc="true"><i class="fa fa-pencil"></i></a>
													<form action="delete_comment.php" method="post" style="display: inline;">
														<button type="submit" style="color:red;border:none;background-color:inherit;" name="delete" value="<?php echo $data; ?>"><i class="fa fa-close"></i></button>
													</form>
													
												</span>
                                        </div>
										<div class="d-flex">
											<div class="col-12" id="cur_comment">
												<p class="m-b-5 m-t-10" id="comment-content"><?php echo $cur_user_comment['content']; ?></p>
											</div>
											<div class="col-8">
												<textarea style="width:100%; display:none" id="edit-comment"><?php echo $cur_user_comment['content']; ?></textarea>
											</div>
											<div class="col-4 d-flex align-self-center" style="margin-left: 3px;">
												<button value="<?php echo $cur_user_comment['productID']; ?>" style="border: none;background-color:inherit;color:yellowgreen; text-decoration:underline;" id="edit">Edit</button>
											</div>
										</div>
                                        
                                    </div>
                                </div>
								<?php } ?>
								<?php foreach($comments as $comment){ 
									if ($cur_user_comment && $comment['customerID'] == $cur_user_comment['customerID']) continue;
									$customer_id = $comment['customerID'];
									$query = "select image, username from customer where id=$customer_id";
									$res = $connection->query($query);
									$customer_data = $res->fetch_assoc();
									$image = "/image/customer/".$customer_data['image'];
									$name = $customer_data['username'];	
								?>
									<div class="d-flex flex-row comment-row" style="width:100%;">
                                    <div class="p-2"><span class="round"><img src="<?php echo $image; ?>" alt="user" width="50"></span></div>
                                    <div class="comment-text w-100">
                                        <h5><?php echo $name ; ?></h5>
                                        <div class="comment-footer">
                                            <span class="date"><?php echo $comment['comment_date']; ?></span>

                                        </div>
										<div class="d-flex">
											<div class="col-12" id="cur_comment">
												<p class="m-b-5 m-t-10" id="comment-content"><?php echo $comment['content']; ?></p>
											</div>
										</div>
                                        
                                    </div>
                                </div>
								<?php } ?>
                                

                            
                            </div>
                        </div>

      </div>
  </div>
</div>

			<!-- Top Sale -->
			<section id="top-sale">
				<div class="container py-5">
					<!-- <h4 class=" font-size-20">Top Sale</h4> -->
					<h3>Top sale</h3>
					<hr>

					<!-- owl carousel: slider -->
					<div class="owl-carousel owl-theme">
						<?php
							for ($i = 1; $i <= 10; $i++) {
									$sql="Select * from `products` where id='$i'";
									$result=mysqli_query($connection, $sql);
									if(mysqli_num_rows($result) > 0) {
										if($row = mysqli_fetch_assoc($result)){
											// '.$row['name'].'
											$p_img = '/image/products/'.$row['image'];
											echo '
												<a href="/product-detail/detail.php?data='.$row['id'].'" class="recommend-product-link item py-2">
													<div class="product  ">
														<div class="d-flex flex-column">
															<div style="background-image: url('.$p_img.')" class="recommend-product-img img-fluid"></div>
														</div> 
													</div>
													<div class="text-center recommend-product-info">
														<h6 class="recommend-product-name">'.$row['name'].'</h6>
													';
													echo '
		
														<div class="recommend-product-price py-2">
															<span>$ '.$row['price'].'</span>
														</div>
														<button type="submit" class="btn btn-warning mr-5 ml-5">Detail</button>
													</div>
												</a> 
													';
										}
								}
								
							}
							
						?>
					</div>
					<!-- owl carousel: slider -->
				</div>
			</section>
			<!-- Top Sale -->

		</main>
		<!-- main -->
		</div>
	<?php include ('../base/footer.html'); $connection->close();?>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

    <!-- Custom Javascript -->
	<script src="assets/js/alert.js"></script>
    <script src="./assets/js/detail.js"></script>
	<script src="assets/js/add2cart.js"></script>
	<script src="assets/js/post_comment.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
</body>

</html>