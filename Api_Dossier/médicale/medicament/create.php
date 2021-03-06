<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  include_once '../connect.php';
  include_once '../objects/medicament.php';

  $database= new Database();
  $db=$database->getConnection();
  $medicament=new Medicament($db);
  
 
  $medicament->NameM=isset($_GET['NameM']) ? $_GET['NameM'] : die();
  

  if (
  	!empty($medicament->NameM)
) {
    if ($medicament->ExsistM()) {
    echo ("Medicamente already exist");
  } 
  
  
  else{
	if ($medicament->create()) {
		http_response_code(201);
		echo json_encode(array("message"=>"Medicament was created"));
	}
	else{
		http_response_code(503);

		echo json_encode(array("message"=>"Unable to create medicament"));
	}

  }
}
  else{
  	http_response_code(400);
  	echo json_encode(array("message"=>"Unable to create medicament.Data is incomplete"));
  }
  ?>