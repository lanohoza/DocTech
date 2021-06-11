<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include_once '../connect.php';
include_once '../objects/doctor.php';
include_once '../objects/user.php';

$database= new Database();
$db= $database->getConnection();

$doctor= new Doctor($db);
$user= new User($db);

$Username = isset($_GET['Username']) ? $_GET['Username'] : die();
$password = (isset($_GET['password'])) ? $_GET['password'] : die();


$stmt= $doctor->login();
//echo json_encode($stmt);
$num= $stmt->rowCount();
if($num>0){

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		//echo json_encode(json_decode(extract($row),true));
            extract($row);
            echo "Welecome to you Dr.".$row['Username'];
		http_response_code(200);
		//echo json_encode($row);
	}
}
else{
	http_response_code(404);
	echo json_encode(array("message"=>"No account with this infos,Please Sign up"));
}
?>