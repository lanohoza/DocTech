<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  include_once '../connect.php';
  include_once '../objects/user.php';
  include_once '../objects/patient.php';

  $database= new Database();
  $db=$database->getConnection();
  $user=new User($db);
  $data =json_decode(file_get_contents("php://input"));
  $patient=new Patient($db);
  $stmt= $user->getId();
 
 
  
  if (
    !empty($data->FullName)&&
    !empty($data->Mobile_N)&&
    !empty($data->Sexe)&&
    !empty($data->Adresse)&&
    !empty($data->Groupage)&&
    !empty($data->Age)
    
) {

  $user->FullName=$data->FullName;
	$user->Mobile_N = $data->Mobile_N;
	$user->Groupage = $data->Groupage;
	$user->Sexe = $data->Sexe;
	$user->Adresse = $data->Adresse;
	$user->Age=$data->Age;
  $user->User_Role="P";
  

	if ($user->create()) {

     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $d =  json_decode(json_encode($row),true);
    
    $patient->User_idUser=json_decode($d['idUser'])
    ;
    echo json_encode($d['idUser']);
    //echo json_encode($patient->User_idUser);

    if ($patient->createP()) {
      http_response_code(201);
    echo json_encode(array("message"=>"Patient was created"));
    }
    else{
    http_response_code(503);

    echo json_encode(array("message"=>"Unable to create patient"));
  }
		http_response_code(201);
		echo json_encode(array("message"=>"User was created"));
	}
	else{
		http_response_code(503);

		echo json_encode(array("message"=>"Unable to create user"));
	}

  }
  else{
  	http_response_code(400);
  	echo json_encode(array("message"=>"Unable to create user.Data is incomplete"));
  }
  ?>