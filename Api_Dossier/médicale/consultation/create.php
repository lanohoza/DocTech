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
   include_once '../objects/consultation.php';
    include_once '../objects/doctor.php';
  


  $database= new Database();
  $db=$database->getConnection();
  $consultation=new Consultation($db);
  $user=new User($db);
  $patient=new Patient($db);
  $doctor=new Doctor($db);

  $data =json_decode(file_get_contents("php://input"));

  $stmt= $patient->getIdP();
   //echo json_encode(array("patient"=>json_encode($stmt)));
    $idp=json_decode($stmt);
 $stmt1= $doctor->getIdD();
   //echo json_encode($stmt1);
    $idd=json_decode($stmt1);
 
  
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

     
    echo json_encode(array("message"=>"Consultation created with succefull"));
    }
  else{
    http_response_code(503);

    echo json_encode(array("message"=>"Unable to create consultation"));
  }

  }
  else{
    http_response_code(400);
    echo json_encode(array("message"=>"Unable to create user.Data is incomplete"));
  }
  ?>