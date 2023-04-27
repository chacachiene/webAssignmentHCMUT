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
            $sql = "SELECT indx, bill.id, name, totalcost, Pay_method, date, bill.status FROM BILL, CUSTOMER WHERE BILL.customerid = customer.id";
            $path = explode('/', $_SERVER['REQUEST_URI']);
            if( isset($path[5])){
                $sql = "SELECT * FROM BILL WHERE indx = $path[5]";
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
        case 'POST':
            $id=$_POST['id'];
            $status = $_POST['status'];
            $sql = "UPDATE BILL SET status = '$status' WHERE indx = $id";
            $stmt = $con->prepare($sql);
            if( $stmt->execute()){
                $res = ['status'=> 200, 'message'=>
                'order updated successfully'];
            } else{
                $res = ['status'=> 400, 'message'=>
                'order updated failed'];
            }
            $error_info = $stmt->errorInfo();
            if ($error_info[0] != '00000') {
                echo 'PDO Error: ' . $error_info[2];
            }
            echo json_encode($res);
        
        case "DELETE":
            $path = explode('/', $_SERVER['REQUEST_URI']);
            $product = $path[5];
            $sql="DELETE FROM BILL WHERE indx IN ($product)";
            $stmt = $con->prepare($sql);
            if( $stmt->execute()){
                $res = ['status'=> 200, 'message'=>
                'Order deleted successfully'];
            } else{
                $res = ['status'=> 400, 'message'=>
                'Order deleted failed'];
            }
            $error_info = $stmt->errorInfo();
            if ($error_info[0] != '00000') {
                echo 'PDO Error: ' . $error_info[2];
            }
            echo json_encode($res);
            break;
        default:
            echo "Method not allowed";
            break;
    }
?>