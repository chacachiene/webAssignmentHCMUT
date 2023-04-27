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
            $sql = "SELECT id, name, price, amount,image FROM PRODUCTS";
            $path = explode('/', $_SERVER['REQUEST_URI']);
            if( isset($path[5])){
                $sql = "SELECT * FROM PRODUCTS WHERE id = $path[5]";
            }
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
            echo json_encode($res);
            break;
        case 'POST':
            if(isset($_POST['id'])){
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $amount = $_POST['amount'];
                    $type = $_POST['type'];
                    $rating = $_POST['rating'];
                    $chip = $_POST['chip'];
                    $screen = $_POST['screen'];
                    $ram  = $_POST['ram'];
                    $screen = $_POST['screen'];
                    $battery = $_POST['battery'];
                    $guarantee = $_POST['guarantee'];
                    $outstanding  = $_POST['outstanding'];

                    if(isset($_FILES['image']) ){
                        $file_name = $_FILES['image']['name'];
                        $tmp = $_FILES['image']['tmp_name'];
                        $file_path = $_SERVER['DOCUMENT_ROOT'].'./image/products'.'/'.$file_name;
                        $sql="UPDATE PRODUCTS SET image=? WHERE id = ?";
                        $stmt = $con->prepare($sql);
                        $stmt->execute([$file_name,$id]);
                        move_uploaded_file($tmp, $file_path);                        
                    } 
                     if(isset($_FILES['image1']) ){
                        $file_name1 = $_FILES['image1']['name'];
                        $tmp1 = $_FILES['image1']['tmp_name'];
                        $file_path1 = $_SERVER['DOCUMENT_ROOT'].'./image/products'.'/'.$file_name1;
                        $sql="UPDATE PRODUCTS SET image1=? WHERE id = ?";
                        $stmt = $con->prepare($sql);
                        $stmt->execute([$file_name1,$id]);
                        move_uploaded_file($tmp1, $file_path1);

                    } 
                     if(isset($_FILES['image2']) ){
                        $file_name2 = $_FILES['image2']['name'];
                        $tmp2 = $_FILES['image2']['tmp_name'];
                        $file_path2 = $_SERVER['DOCUMENT_ROOT'].'./image/products'.'/'.$file_name2;
                        $sql="UPDATE PRODUCTS SET image2=? WHERE id = ?";
                        $stmt = $con->prepare($sql);
                        $stmt->execute([$file_name2,$id]);
                        move_uploaded_file($tmp2, $file_path2);
                    } 
                    if(isset($_FILES['image3']) ){
                        $file_name3 = $_FILES['image3']['name'];
                        $tmp3 = $_FILES['image3']['tmp_name'];
                        $file_path3 = $_SERVER['DOCUMENT_ROOT'].'./image/products'.'/'.$file_name3;
                        $sql="UPDATE PRODUCTS SET image3=? WHERE id = ?";
                        $stmt = $con->prepare($sql);
                        $stmt->execute([$file_name3,$id]);
                        move_uploaded_file($tmp3, $file_path3);
                    }
    
                    $sql="UPDATE PRODUCTS SET Name = ?, price = ?, amount = ?,type=?, rating=?, chip=?, ram=?, screen=?, battery=?, guarantee=?, outstanding=? WHERE id = ?";
                    $stmt = $con->prepare($sql);
                    $DateCreate = date('Y-m-d');
                    $type = "no";
                    
        
                    if( $stmt->execute([$name, $price,$type,$amount, $rating, $chip, $ram, $screen, $battery, $guarantee, $outstanding,$id ])){
                        $res = ['status'=> 200, 'message'=>
                        'Product edited successfully'];
                    } else{
                        $res = ['status'=> 400, 'message'=>
                        'Product edited failed'];
                    }
                    $error_info = $stmt->errorInfo();
                    if ($error_info[0] != '00000') {
                        echo 'PDO Error: ' . $error_info[2];
                    }
                    echo json_encode($res);
            }
            else if(isset($_FILES['image']) ){
                $name = $_POST['name'];
                $price = $_POST['price'];
                $amount = $_POST['amount'];
                $type = $_POST['type'];
                $rating = $_POST['rating'];
                $chip = $_POST['chip'];
                $screen = $_POST['screen'];
                $ram  = $_POST['ram'];
                $screen = $_POST['screen'];
                $battery = $_POST['battery'];
                $guarantee = $_POST['guarantee'];
                $outstanding  = $_POST['outstanding'];

                $file_name = $_FILES['image']['name'];
                $tmp = $_FILES['image']['tmp_name'];
                $file_path = $_SERVER['DOCUMENT_ROOT'].'./image/products'.'/'.$file_name;
               
                $file_name1 = $_FILES['image1']['name'];
                $tmp1 = $_FILES['image1']['tmp_name'];
                $file_path1 = $_SERVER['DOCUMENT_ROOT'].'./image/products'.'/'.$file_name1;
               
                $file_name2 = $_FILES['image2']['name'];
                $tmp2 = $_FILES['image2']['tmp_name'];
                $file_path2 = $_SERVER['DOCUMENT_ROOT'].'./image/products'.'/'.$file_name2;
               
                $file_name3 = $_FILES['image3']['name'];
                $tmp3 = $_FILES['image3']['tmp_name'];
                $file_path3 = $_SERVER['DOCUMENT_ROOT'].'./image/products'.'/'.$file_name3;
               
                $sql="insert into products(name, price, type, image, image1, image2, image3, amount, rating, chip, ram, screen, battery, outstanding, guarantee) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $con->prepare($sql);
                $DateCreate = date('Y-m-d');
                $type = "no";

                if( $stmt->execute([$name, $price,$type,$file_name, $file_name1, $file_name2, $file_name3,$amount, $rating, $chip, $ram, $screen, $battery, $outstanding, $guarantee ])){
                    move_uploaded_file($tmp, $file_path);
                    move_uploaded_file($tmp1, $file_path1);
                    move_uploaded_file($tmp2, $file_path2);
                    move_uploaded_file($tmp3, $file_path3);
                    $res = ['status'=> 200, 'message'=>
                    'Product created successfully'];
                } else{
                    $res = ['status'=> 400, 'message'=>
                    'Product created failed'];
                }
                $error_info = $stmt->errorInfo();
                if ($error_info[0] != '00000') {
                    echo 'PDO Error: ' . $error_info[2];
                }
                echo json_encode($res);
            } else{
                die( "POST_ERROR: file not read");
            }
            break;
        
        case "DELETE":
            $path = explode('/', $_SERVER['REQUEST_URI']);
             $product = $path[5];
            
            print_r($product);
            $sql="DELETE FROM PRODUCTS WHERE id IN ($product)";
            $stmt = $con->prepare($sql);
            if( $stmt->execute()){
                $res = ['status'=> 200, 'message'=>
                'Product deleted successfully'];
            } else{
                $res = ['status'=> 400, 'message'=>
                'Product deleted failed'];
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