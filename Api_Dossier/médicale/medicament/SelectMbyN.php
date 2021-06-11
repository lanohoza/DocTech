<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../connect.php';
include_once '../objects/medicament.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();

$medicament = new Medicament($db);

//$user->FullName = isset($_GET['FullName']) ? $_GET['FullName'] : die();
$stmt=$medicament->SelectidM();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row['idM']);
?>