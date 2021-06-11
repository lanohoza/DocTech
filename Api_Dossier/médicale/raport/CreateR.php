<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  include_once '../connect.php';
  include_once '../objects/raport.php';
   include_once '../objects/consultation.php';
    include_once '../objects/medicament.php';
  include_once '../objects/patient.php';
   include_once '../objects/doctor.php';
    include_once '../objects/user.php';
  $database= new Database();
  $db=$database->getConnection();

  $raport=new Raport($db);
  $user=new User($db);
  $doctor=new Doctor($db);
  $patient=new Patient($db);
  $consultation=new Consultation($db);
  $medicament=new Medicament($db);

  $data =json_decode(file_get_contents("php://input"));

  //get id patient
  $stmt= $patient->getIdP();
  $idp=json_decode($stmt);

// get doctor id
 $stmt1= $doctor->getIdD();
  $idd=json_decode($stmt1);

//get id of the last consult=Raport number
  $stmt2= $consultation->getId();
 
 
  
  if (
    !empty($data->Diagnostic)&&
    !empty($data->Mount)
    
) {

  $consultation->Diagnostic=$data->Diagnostic;
  $consultation->Mount = $data->Mount;
  $consultation->Patient_idP = $idp;
  $consultation->Doctor_id = $idd;
  $consultation->Appoint=date('Y-m-d');
  

	if ($consultation->create()) {

     $row = $stmt2->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $d =  json_decode(json_encode($row),true);
    
    $raport->Consultation_idC=json_decode($d['idC'])
    ;
    echo json_encode($d['idC']);
    //echo json_encode($patient->User_idUser);
   
    $raport->Medicament_idM=json_decode($medicament->SelectidM($data->NameM));

 
    if ($raport->createR()) {
      http_response_code(201);
    echo json_encode(array("message"=>"Raport was created"));
    }
    else{
    http_response_code(503);

    echo json_encode(array("message"=>"Unable to create raport"));
  }
  
		http_response_code(201);
		echo json_encode(array("message"=>"Consultation was created"));
	}
	else{
		http_response_code(503);

		echo json_encode(array("message"=>"Unable to create consultation"));
	}

  }
  else{
  	http_response_code(400);
  	echo json_encode(array("message"=>"Unable to create consultation.Data is incomplete"));
  }
  ?>