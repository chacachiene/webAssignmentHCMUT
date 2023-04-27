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
        $sql = "SELECT indx, id, customerID, date FROM bill";
        $stmt = $con->prepare($sql);

        if( $stmt->execute()){
            $res = ['status'=> 200, 'message'=>
            'Orders retrieved successfully'];
            $dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $num_product_sell_in_day = 0;
            foreach($dates as $date){
                if($now == explode(' ', $date['date'])[0]){
                    $billid = $date['id'];
                    $customerid = $date['customerID'];
                    $sql = "SELECT amount FROM products_of_bill WHERE bill_id=$billid AND customerID=$customerid";
                    $stmt = $con->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $num_product_sell_in_day += $result[0]['amount'];
                }
            }
            echo json_encode($num_product_sell_in_day);
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
