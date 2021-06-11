<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include_once '../connect.php';
include_once '../objects/hopital.php';

$database= new Database();
$db= $database->getConnection();
$hopital= new Hopital($db);
$stmt= $hopital->read();
$num= $stmt->rowCount();
if($num>0){
	
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$h_item=array(
		 "Name" => $Name,
            );
	
		http_response_code(200);
		echo json_encode($h_item);
	}
}
else{
	http_response_code(404);
	echo json_encode(array("message"=>"No hopitals found."));
}
?>