<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include_once '../connect.php';
include_once '../objects/doctor.php';

$database= new Database();
$db= $database->getConnection();

$doctor= new Doctor($db);
$doctor->idDoctor = isset($_GET['idDoctor']) ? $_GET['idDoctor'] : die();
$stmt= $doctor->readOne();
$num= $stmt->rowCount();
if($num>0){
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$doctor_item=array(
		 "idDoctor" => $idDoctor,
            "FullName" => $FullName,
            "Username"=>$Username,
            "password"=>$password,
            "Mobile_N"=>$Mobile_N,
            "Sexe"=>$Sexe,
            "Adresse"=>$Adresse,
            "Age"=>$Age,
            "User_Role"=>$User_Role,
            "Groupage"=>$Groupage,
            "TimeB"=>$TimeB,
            "TimeC"=>$TimeC,
            "Departement_idDepartement"=>$Departement_idDepartement,
            "Hopital_Name"=>$Hopital_Name,
            "User_idUser"=>$User_idUser
            
            );
		//array_push($patient_arr["users"],$patient_item);
		http_response_code(200);
		echo json_encode($doctor_item);
	}
}
else{
	http_response_code(404);
	echo json_encode(array("message"=>"No doctor found."));
}
?>