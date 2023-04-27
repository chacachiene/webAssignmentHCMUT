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
            $path = explode('/', $_SERVER['REQUEST_URI']);
       
            if(isset($path[6])){
                $sql = "SELECT products.id, bill_id, name, price, products_of_bill.amount FROM products_of_bill join products on products.id = product_id where bill_id=$path[5] and customerId=$path[6]";
            } 
            $stmt = $con->prepare($sql);

            if( $stmt->execute()){
                $res = ['status'=> 200, 'message'=>
                'order get successfully'];
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($result);
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
