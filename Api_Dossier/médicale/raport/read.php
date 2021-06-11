<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include_once '../connect.php';
include_once '../objects/raport.php';

$database= new Database();
$db= $database->getConnection();

$raport= new Raport($db);
$stmt= $raport->readInfoP();
$stmt1= $raport->readInfoD();
$num= $stmt->rowCount();
$num1= $stmt1->rowCount();
if($num>0&&$num1>0){
	while(($row = $stmt->fetch(PDO::FETCH_ASSOC))&&($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))){
		extract($row1);
		extract($row);
		http_response_code(200);
		echo json_encode(array($row,$row1));
		//echo json_encode($row1);
	}
}
else{
	http_response_code(404);
	echo json_encode(array("message"=>"No raport found."));
}
?>