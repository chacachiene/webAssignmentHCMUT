<?php
// Include config file
require_once "../config/config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = $name_err = $Address_err = $Date_err= $Phone_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM customer WHERE username = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
	//Validate Name
	if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name";     
	}else{
		$name = trim($_POST['name']);
	}

	//Validate address
	if(empty(trim($_POST["address"]))){
        $Address_err = "Please enter your address";     
	}else{
		$address = trim($_POST['address']);
	}

	if(empty(trim($_POST["phone"]))){
        $Phone_err = "Enter your phone number";     
	}else if (!preg_match('/^[0-9]+$/', trim($_POST["phone"])) && sizeof(str_split($_POST['phone']))<9){
			$Phone_err = "Invalid phone number";
		}else{
			$phone = trim($_POST['phone']);
		}

	//Validate date
	if(empty(trim($_POST["day"])) || empty(trim($_POST["month"])) || empty(trim($_POST["year"])) || !checkdate($_POST['month'], $_POST['day'], $_POST['year'])){
        $Date_err = "Invalid date";     
	}else{
		$day = $_POST['day'];
		$month = $_POST['month'];
		$year = $_POST['year'];
	}

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err) && empty($Address_err) && empty($Date_err) && empty($Phone_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO customer (username, password, name, address, birthday, phone,image, status) VALUES (?, ?, ?, ?, ?, ?,?, ?)";

        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
			
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_username, $param_password, $param_name, $param_address, $param_date, $param_phone, $param_image, $param_status);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_name = $name;
			$param_address = $address;
			$param_date = $year.'-'.$month.'-'.$day;
			$param_phone = $phone;
			$param_image = "default.png";
			$param_status = "normal";

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
				$sql = "select id from customer where username='".$username."'";
				$connection = new mysqli('localhost','root','','laptrinhweb_db');
				$res = $connection->query($sql);
				$customer_id = $res->fetch_assoc()['id'];
				$sql = "insert into cart values (".$customer_id.",".$customer_id.")";
				$connection->query($sql);
				$connection->close();

                header("location: login.php");
				mysqli_close($connection);
				exit;
            } else{
                echo "Oops! Something went wrong. Please try again later.";
				
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

</head>

<body>
    <div class="container-fluid bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


		<?php include('../base/header.php'); ?>

            <div class="container-fluid py-5 bg-dark hero-login mb">
                <div class="d-flex flex-column container my-5 pt-5 pb-4">
                    <div class="d-flex justify-content-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Register</h1>
                    </div>
                    <?php 
                    if(!empty($login_err)){
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }        
                    ?>
                    <div style="padding: 20px;" class="d-flex justify-content-center">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group" style="width:400px;">
                                <label>Username</label>
                                <input type="text" name="username" placeholder="Username" style="height: 50px" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div><br>    
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Password" style="height: 50px" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div><br>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" placeholder="Confirm Password" style="height: 50px" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div><br>
							<div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="Name" style="height: 50px" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>">
                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                            </div><br>
							<div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" placeholder="Address" style="height: 50px" class="form-control <?php echo (!empty($Address_err)) ? 'is-invalid' : ''; ?>">
                                <span class="invalid-feedback"><?php echo $Address_err; ?></span>
                            </div><br>
							<div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" placeholder="Phone Number" style="height: 50px" class="form-control <?php echo (!empty($Phone_err)) ? 'is-invalid' : ''; ?>">
                                <span class="invalid-feedback"><?php echo $Phone_err; ?></span>
                            </div><br>
							 <div class="form-outline datepicker w-100">
								Your Birthdate
								<div class="d-flex">

									<div class="col-4">
										<label for="birthday" class="form-label">Day</label>
										<select class="form-select birth" id="birthday" name="day" style="width:70px"></select>
									</div>


									<div class="col-4">
										<label for="birthmonth" class="form-label">Month </label>
										<select class="form-select birth" id="birthmonth" name="month" style="width:70px"></select>
									</div>

									<div class="col-4">
										<label for="birthyear" class="form-label">Year </label>
										<select class="form-select birth" id="birthyear" name="year" style="width:100px"></select>
									</div>
								</div>
								<input type="hidden" class="form-control <?php echo (!empty($Date_err)) ? 'is-invalid' : ''; ?>">						
								<span class="invalid-feedback"><?php echo $Date_err; ?></span>
							</div><br>
                            <div class="form-group"> 
                                <input type="submit" class="btn btn-primary" value="Submit" style="width:200px;">
                                <input type="reset" class="btn btn-danger ml-2" value="Reset" style="width:200px;">
                            </div><br>
                            <p>Already have an account? <a href="login.php">Login here</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <?php include('../base/footer.html') ?>


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

	<script src="js/register.js"></script>
</body>

</html>