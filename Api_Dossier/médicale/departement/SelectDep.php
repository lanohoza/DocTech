<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../connect.php';
include_once '../objects/departement.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();

$departement = new Departement($db);


$departement->NameD = isset($_GET['NameD']) ? $_GET['NameD'] : die();
$stmt=$departement->getIdD();


$row = $stmt->fetch(PDO::FETCH_ASSOC);


    extract((array)$row);
    $d =  json_decode(json_encode($row),true);
    $departement->idDepartement=json_decode($d['idDepartement']);
    echo json_encode($d['idDepartement']);
?>