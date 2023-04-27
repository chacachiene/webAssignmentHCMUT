<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
  //show error page
  header("Location: /login/login.php");
  exit();
}
if($_SESSION['role'] != 'customer'){
  //show error page
  echo 'This page is only for customer';
  exit();
}
// Include config file
require_once "../config/config.php";

$image = "/image/customer/".$_SESSION['username'].".png";
$target_dir = "../image/customer/";
$target_file = $target_dir.basename($_SESSION['username']).".png";

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION));



// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  	echo "Sorry, your file was not uploaded.";

} else {
	if(file_exists($target_file)){
		unlink($target_file);
	}
	echo file_exists($target_file);
	move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
}


if(isset($_POST['update-btn'])){
  // Validate credentials
  	$updatesql = 'UPDATE customer SET name ="'.$_POST['name'].'",phone = "'.$_POST['phone'].'",address ="'.$_POST['address'].'",birthday = "'.$_POST['birthday'].'",image="'.$_SESSION['username'].".png".'" WHERE id ='.$_SESSION["id"];
  	echo $updatesql;
	$connection->query($updatesql);

}

$connection->close();

header("Location: /customer");
?>