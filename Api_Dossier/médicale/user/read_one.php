<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
include_once '../connect.php';
include_once '../objects/user.php';

$database= new Database();
$db= $database->getConnection();

$user= new User($db);
$user->idUser=isset($_GET['idUser'])?$_GET['idUser']:die();
$user->readOne();

if($user->FullName!=null){
	
	$user_arr=array(
		 "idUser" => $idUser,
            "FullName" => $FullName,
            "Mobile_N"=>$Mobile_N,
            "Sexe"=>$Sexe,
            "Adresse"=>$Adresse,
            "Age"=>$Age,
            "Groupage"=>$Groupage,
            );
 http_response_code(200);
 echo "json_encode($user_arr)";
}
else{
	http_response_code(404);
	echo json_encode(array("message"=>"No users found."));
}
?>