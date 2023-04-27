<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION['role'] == 'customer'){
    header("location: /homepage");
    exit;
}else{
	//navigate to admin page
}
 
// Include config file
require_once "../config/config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
	if(isset($_POST['customer-login-btn'])){
		// Validate credentials
		if(empty($username_err) && empty($password_err)){
			// Prepare a select statement
			$sql = "SELECT id, username, password FROM customer WHERE username = ?";
			
			if($stmt = mysqli_prepare($connection, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);
				
				// Set parameters
				$param_username = $username;
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Store result
					mysqli_stmt_store_result($stmt);
					
					// Check if username exists, if yes then verify password
					if(mysqli_stmt_num_rows($stmt) == 1){                    
						// Bind result variables
						mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
						if(mysqli_stmt_fetch($stmt)){
							if(password_verify($password, $hashed_password)){
								// Password is correct, so start a new session
								// session_start();
								
								// Store data in session variables
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $username;                            
								$_SESSION["role"] = "customer";  

								$sql = "UPDATE customer set active=1 where username = '".$username."'";
								$connection->query($sql);

								mysqli_close($connection);
								$stmt->close();
								// Redirect user to welcome page
								header("location: /homepage");
								exit;
								
							} else{
								// Password is not valid, display a generic error message
								$login_err = "Invalid username or password.";
							}
						}
					} else{
						// Username doesn't exist, display a generic error message
						$login_err = "Invalid username or password.";
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}

				// Close statement
				mysqli_stmt_close($stmt);
			}
		}
	}
    else{
        if(empty($username_err) && empty($password_err)){
			// Prepare a select statement
			$sql = "SELECT COUNT(*) FROM admin WHERE username = '$username' && password = SHA('$password');";
            $res = mysqli_query($connection, $sql);
            $val = mysqli_fetch_assoc($res);
            
			if ($val['COUNT(*)'] == 1) {
                // session_start();						
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username; 
                $_SESSION["role"] = "admin";                                                                           
                // header("location: /dashboard");
                echo "<script>window.location.href = 'http://localhost:3000/dashboard'</script>";
				mysqli_close($link);
            } else{
                // Password is not valid, display a generic error message
                $login_err = "Invalid username or password.";
            }
		}
    }
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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


        <?php include('../base/header.php');?>

            <div class="container-fluid py-5 bg-dark hero-login mb">
                <div class="d-flex flex-column container my-5 pt-5 pb-4">
                    <div class="d-flex justify-content-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Login</h1>
                    </div>
                    <?php 
                    if(!empty($login_err)){
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }        
                    ?>
                    <div style="padding: 20px;" class="d-flex justify-content-center">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" placeholder="Username" style="height: 50px" class="form-control  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div><br>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Password" style="height: 50px" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div><br>
                            <div class="form-group row">
								<div class="col d-flex justify-content-center mt-3">
								<input type="submit" name="customer-login-btn" class="btn btn-primary" value="Login as customer" style="width:200px;">
								</div>
								<div class="col d-flex justify-content-center mt-3">
								<input type="submit" name="admin-login-btn" class="btn btn-primary	" value="Login as admin" style="width:200px;">
								</div>
                                
                            </div><br>
                            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->



        <?php include('../base/footer.html'); ?>


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>


</body>

</html>