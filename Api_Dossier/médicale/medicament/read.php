<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include_once '../connect.php';
include_once '../objects/medicament.php';

$database= new Database();
$db= $database->getConnection();

$medicament= new Medicament($db);
$stmt= $medicament->read();
$num= $stmt->rowCount();
if($num>0){
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$Med_item=array(
		 "idM" => $idM,
         "NameM" => $NameM,
            );
		http_response_code(200);
		echo json_encode($Med_item);
	}
}
else{
	http_response_code(404);
	echo json_encode(array("message"=>"No medicaments found."));
}
?>