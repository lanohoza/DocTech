<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../connect.php';
include_once '../objects/raport.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare  object raport
$raport = new Raport($db);
  
// get raport id witch = idC

  // set raport id to be deleted
$raport->Consultation_idC = isset($_GET['Consultation_idC']) ? $_GET['Consultation_idC'] : die();


  
// delete the raport
if($raport->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("me" => "raport was deleted."));
}
  
// if unable to delete the raport
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to delete raport."));
}
?>