<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  include_once '../connect.php';
  include_once '../objects/user.php';
  include_once '../objects/doctor.php';
   include_once '../objects/hopital.php';
   include_once '../objects/departement.php';

  $database= new Database();
  $db=$database->getConnection();
  $user=new User($db);
  $data =json_decode(file_get_contents("php://input"));
  $doctor=new Doctor($db);
  $stmt= $user->getId();
  $hopital=new Hopital($db);
  $departement=new Departement($db);
  $stmtH=$hopital->getNameH();
 
  
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
  $user->User_Role="D";
$doctor->Username=$data->Username;
  $doctor->password=base64_encode($data->password);
  $doctor->TimeB=$data->time('H:i');
  $doctor->TimeC=$data->time('H:i');
  
if ($doctor->ExsistD()) {
    echo ("You are already exist");
  } 
  else{ 
  
	if ($user->create()) {

     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $d =  json_decode(json_encode($row),true);
    
    $doctor->User_idUser=json_decode($d['idUser'])
    ;
    echo json_encode($d['idUser']);
    
 //get Name of hopital withch choose by doctor
$rowH = $stmtH->fetch(PDO::FETCH_ASSOC);
// json_encode($rowH);
    extract($rowH);
    //echo json_encode($rowH);
    $dH =  json_decode(json_encode($rowH),true);
   $nh=json_encode($dH['Name']);
  // echo json_decode($nh);
   $doctor->Hopital_Name=json_decode($nh);
    echo json_encode($doctor->Hopital_Name);



//get id departement of this hopital witch choose by doctor
$departement->NameD = isset($_GET['NameD']) ? $_GET['NameD'] : die();
  $stmtD=$departement->getIdD();
  echo json_encode($stmtD);

$rowD = $stmtD->fetch(PDO::FETCH_ASSOC);
//echo json_encode($rowD);
    extract((array)$row);

    $dD =  json_decode(json_encode($rowD),true);
    $doctor->Departement_idDepartement=json_decode(json_encode($dD['idDepartement']));
    echo json_encode($doctor->Departement_idDepartement);
    //echo json_decode($d['idDepartement']);

//$st=$doctor->signup();

//echo json_encode($st);

    if ($doctor->signup()) {
      http_response_code(201);
    echo json_encode(array("message"=>"Doctor was created"));
    }
    else{

    http_response_code(503);

    echo json_encode(array("message"=>"Unable to create doctor"));
  }


		http_response_code(201);
		echo json_encode(array("message"=>"User was created"));
	}//3
	else{
		http_response_code(503);

		echo json_encode(array("message"=>"Unable to create user"));
	}
}
}
  
  else{
  	http_response_code(400);
    echo json_encode($data);
  	echo json_encode(array("message"=>"Unable to create user.Data is incomplete"));
  }

  ?>