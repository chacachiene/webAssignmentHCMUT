
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
        
        $sql = "select count(*) from customer where active=1";
        $stmt = $con->prepare($sql);
        if( $stmt->execute()){
            $res = ['status'=> 200, 'message'=>
            'Orders retrieved successfully'];
           
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $active = $result[0]['count(*)'];
        } else{
            $res = ['status'=> 400, 'message'=>
            'Failed'];
        }

        $sql = "select count(*) from customer where active=0";
        $stmt = $con->prepare($sql);
        if( $stmt->execute()){
            $res2 = ['status'=> 200, 'message'=>
            'Orders retrieved successfully'];

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $inactive = $result[0]['count(*)'];

        } else{
            $res2 = ['status'=> 400, 'message'=>
            'Failed'];
        }
        $last_result = array("active" => $active, "off" => $inactive);

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

	// $query = "select count(*) from customer where active=1";
	// $res = $connection->query($query);
	// $active = $res->fetch_assoc()['count(*)'];

	// $query = "select count(*) from customer where active=0";
	// $res = $connection->query($query);
	// $inactive = $res->fetch_assoc()['count(*)'];

	// $last_result = array("active" => $active, "inactive" => $inactive);
	// $connection->close();
	// echo json_encode($last_result);
?>