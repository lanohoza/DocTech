<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include_once '../connect.php';
include_once '../objects/patient.php';

$database= new Database();
$db= $database->getConnection();

$patient= new Patient($db);
$patient->idP = isset($_GET['idP']) ? $_GET['idP'] : die();
$stmt= $patient->readOne();
$num= $stmt->rowCount();
if($num>0){
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$patient_item=array(
		 "idP" => $idP,
            "FullName" => $FullName,
            "User_idUser"=>$User_idUser,
            "Mobile_N"=>$Mobile_N,
            "Sexe"=>$Sexe,
            "Adresse"=>$Adresse,
            "Age"=>$Age,
            "User_Role"=>$User_Role,
            "Groupage"=>$Groupage,
            );
		//array_push($patient_arr["users"],$patient_item);
		http_response_code(200);
		echo json_encode($patient_item);
	}
}
else{
	http_response_code(404);
	echo json_encode(array("message"=>"Nousers found."));
}
?>