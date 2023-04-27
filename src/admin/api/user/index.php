<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: *');

    include '../connect.php';
    $db = new DBconnect;
    $con = $db->connect();
    $method = $_SERVER['REQUEST_METHOD'];
    switch($method){
        case 'GET':
            $sql = "SELECT * FROM CUSTOMER";
            $path = explode('/', $_SERVER['REQUEST_URI']);
            if(isset($path[5])){
                $sql = "SELECT * FROM CUSTOMER WHERE id = $path[5]";
            }
            $stmt = $con->prepare($sql);
            if( $stmt->execute()){
                $res = ['status'=> 200, 'message'=>
                'USER get successfully'];
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($result);
                return;
            } else{
                $res = ['status'=> 400, 'message'=>
                'USER get failed'];
            }
            $error_info = $stmt->errorInfo();
            if ($error_info[0] != '00000') {
                echo 'PDO Error: ' . $error_info[2];
            }
            echo json_encode($res);
            break;
        case 'POST':
            if(isset($_POST['id'])){
                    $username = $_POST['username'];
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $birthday = $_POST['birthday'];
                    $status = $_POST['status'];
                    $sql="UPDATE CUSTOMER SET Name = ?, phone = ?, address = ?, birthday = ?, status=? WHERE id = ?";
                    if(isset($_FILES['image'])){
                        
                        $file_name = $username.'.png';
                        $tmp = $_FILES['image']['tmp_name'];
                        $file_path = $_SERVER['DOCUMENT_ROOT'].'./image/customer'.'/'.$file_name;
                        if(file_exists($file_path)){
                            unlink($file_path);
                        }
                        $sql="UPDATE CUSTOMER SET Name = ?, phone = ?, address = ?, birthday = ?, image = ?, status =? WHERE id = ?";
                        $stmt = $con->prepare($sql);
                        $DateCreate = date('Y-m-d');
                        if( $stmt->execute([$name, $phone, $address, $birthday, $file_name, $status, $id])){
                            move_uploaded_file($tmp, $file_path);
                            $res = ['status'=> 200, 'message'=>
                            'USER edited successfully'];
                        } else{
                            $res = ['status'=> 400, 'message'=>
                            'USER edited failed'];
                        }
                        $error_info = $stmt->errorInfo();
                        if ($error_info[0] != '00000') {
                            echo 'PDO Error: ' . $error_info[2];
                        }
                        echo json_encode($res);
                        exit;
                    }
                    $stmt = $con->prepare($sql);
                    $DateCreate = date('Y-m-d');
                    if( $stmt->execute([$name, $phone, $address, $birthday, $status, $id])){
                        $res = ['status'=> 200, 'message'=>
                        'USER edited successfully'];
                    } else{
                        $res = ['status'=> 400, 'message'=>
                        'USER edited failed'];
                    }
                    
                    $error_info = $stmt->errorInfo();
                    if ($error_info[0] != '00000') {
                        echo 'PDO Error: ' . $error_info[2];
                    }
                    echo json_encode($res);
            }
            break;
        case "DELETE":
            $path = explode('/', $_SERVER['REQUEST_URI']);
            $user = $path[5];
            $sql="DELETE FROM CUSTOMER WHERE id IN ($user)";
            $stmt = $con->prepare($sql);
            if( $stmt->execute()){
                $res = ['status'=> 200, 'message'=>
                'user deleted successfully'];
            } else{
                $res = ['status'=> 400, 'message'=>
                'user deleted failed'];
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