<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: *');
include '../connect.php';
$db = new DBconnect;
$con = $db->connect();
//print_r($con);
//print_r(file_get_contents('php://input'));
$method = $_SERVER['REQUEST_METHOD'];
switch($method){
    case 'GET': 
		$macbook = 0;
		$iphone = 0;
		$ipad = 0;
		$apple_watch = 0;
        $sql = "select amount from products where type='Macbook'";
		$stmt = $con->prepare($sql);

        if( $stmt->execute()){
            $res = ['status'=> 200, 'message'=>
            'Orders retrieved successfully'];
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($result as $amount){
				$macbook += $amount['amount'];
			}
			
        } else{
            $res = ['status'=> 400, 'message'=>
            'Failed'];
        }
		$sql = "select amount from products where type='Iphone'";
		$stmt = $con->prepare($sql);
		if( $stmt->execute()){
			$res = ['status'=> 200, 'message'=>
			'Orders retrieved successfully'];
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $amount){
				$iphone += $amount['amount'];
			}
		} else{
			$res = ['status'=> 400, 'message'=>
			'Failed'];
		}
		$sql = "select amount from products where type='Ipad'";
		$stmt = $con->prepare($sql);
		if( $stmt->execute()){
			$res = ['status'=> 200, 'message'=>
			'Orders retrieved successfully'];
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $amount){
				$ipad += $amount['amount'];
			}
		} else{
			$res = ['status'=> 400, 'message'=>
			'Failed'];
		}
		$sql = "select amount from products where type='Apple watch'";
		$stmt = $con->prepare($sql);
		if( $stmt->execute()){
			$res = ['status'=> 200, 'message'=>
			'Orders retrieved successfully'];
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $amount){
				$apple_watch += $amount['amount'];
			}
		} else{
			$res = ['status'=> 400, 'message'=>
			'Failed'];
		}
		$last_result = array("Macbook" => $macbook, "Ipad" => $ipad, "Iphone" => $iphone, "Applewatch" => $apple_watch);

        $error_info = $stmt->errorInfo();
        if ($error_info[0] != '00000') {
            echo 'PDO Error: ' . $error_info[2];
        }
        echo json_encode($last_result);
        break;
}
?>




<?php
	// require_once '../config/config.php';

	// $query = "select amount from products where type='Macbook'";
	// $res = $connection->query($query);
	// $macbook = 0;
	// while($amount = $res->fetch_assoc()){
	// 	$macbook += $amount['amount'];
	// }

	// $query = "select amount from products where type='Iphone'";
	// $res = $connection->query($query);
	// $iphone = 0;
	// while($amount = $res->fetch_assoc()){
	// 	$iphone += $amount['amount'];
	// }

	// $query = "select amount from products where type='Ipad'";
	// $res = $connection->query($query);
	// $ipad = 0;
	// while($amount = $res->fetch_assoc()){
	// 	$ipad += $amount['amount'];
	// }

	// $query = "select amount from products where type='Apple watch'";
	// $res = $connection->query($query);
	// $applewatch = 0;
	// while($amount = $res->fetch_assoc()){
	// 	$applewatch += $amount['amount'];
	// }


	// $last_result = array("Macbook" => $macbook, "Ipad" => $ipad, "Iphone" => $iphone, "Applewatch" => $applewatch);
	// $connection->close();
	// echo json_encode($last_result);
?>