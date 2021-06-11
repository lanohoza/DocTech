<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include_once '../connect.php';
include_once '../objects/consultation.php';

$database= new Database();
$db= $database->getConnection();

$consultation= new Consultation($db);
$stmt= $consultation->read();
$num= $stmt->rowCount();
if($num>0){
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$Consultation_item=array(
		 	"idC" => $idC,
            "Diagnostic" => $Diagnostic,
            "Mount"=>$Mount,
            "Appoint"=>$Appoint,
            "Patient_idP"=>$Patient_idP,
            "Doctor_id"=>$Doctor_id,
            );
		
		http_response_code(200);
		echo json_encode($Consultation_item);
	}
}
else{
	http_response_code(404);
	echo json_encode(array("message"=>"No consultation found."));
}
?>