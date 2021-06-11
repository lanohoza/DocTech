<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include_once '../connect.php';
include_once '../objects/hopital.php';

$database= new Database();
$db= $database->getConnection();
$hopital= new Hopital($db);
$hopital->Name = isset($_GET['Name']) ? $_GET['Name'] : die();
$stmt= $hopital->getNameH();
$num= $stmt->rowCount();
if($num>0){
	$h_arr=array();
	$h_arr["Hopitals"]=array();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$h_item=array(
		 "Name" => $Name,
            );
		array_push($h_arr["Hopitals"],$h_item);
		http_response_code(200);
		echo json_encode($h_arr);
	}
}
else{
	http_response_code(404);
	echo json_encode(array("message"=>"No hopitals found."));
}
?>