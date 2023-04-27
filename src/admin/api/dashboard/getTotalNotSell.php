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
        $now =  date('Y-m-d');
        $sql = "select amount from products";
        $stmt = $con->prepare($sql);
		$total_amount_not_sell = 0;
        if( $stmt->execute()){
            $res = ['status'=> 200, 'message'=>
            'Orders retrieved successfully'];
           
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $amount){
				$total_amount_not_sell += $amount['amount'];
			}
            echo json_encode($total_amount_not_sell);
            return;
        } else{
            $res = ['status'=> 400, 'message'=>
            'Failed'];
        }
        $error_info = $stmt->errorInfo();
        if ($error_info[0] != '00000') {
            echo 'PDO Error: ' . $error_info[2];
        }
        echo json_encode($res);
        break;
}
?>