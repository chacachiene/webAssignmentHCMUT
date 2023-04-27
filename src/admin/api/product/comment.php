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
            if( isset($path[5])){
                $sql = "SELECT comment.indx, customer.name, customer.image, content, comment_date FROM comment join customer on comment.customerId=customer.id WHERE comment.productid = $path[5]";
                $stmt = $con->prepare($sql);
                // $stmt->execute();
                // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // echo json_encode($result);
                if( $stmt->execute()){
                    $res = ['status'=> 200, 'message'=>
                    'Product created successfully'];
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode($result);
                    return;
                } else{
                    $res = ['status'=> 400, 'message'=>
                    'Product created failed'];
                }
                $error_info = $stmt->errorInfo();
                if ($error_info[0] != '00000') {
                    echo 'PDO Error: ' . $error_info[2];
                }
            }
            echo json_encode($res);
            break;
            case 'DELETE':
                $path = explode('/', $_SERVER['REQUEST_URI']);
                if( isset($path[5])){
                    $sql = "DELETE FROM comment WHERE indx = $path[5]";
                    $stmt = $con->prepare($sql);
                    if( $stmt->execute()){
                        $res = ['status'=> 200, 'message'=>
                        'Product created successfully'];
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        echo json_encode($result);
                        return;
                    } else{
                        $res = ['status'=> 400, 'message'=>
                        'Product created failed'];
                    }
                    $error_info = $stmt->errorInfo();
                    if ($error_info[0] != '00000') {
                        echo 'PDO Error: ' . $error_info[2];
                    }
                }
                echo json_encode($res);
                break;
        }
