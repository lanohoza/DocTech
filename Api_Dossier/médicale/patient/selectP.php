<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../connect.php';
include_once '../objects/user.php';
include_once '../objects/patient.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$patient = new Patient($db);

$user->FullName = isset($_GET['FullName']) ? $_GET['FullName'] : die();
$stmt=$patient->getIdP();
$num=$stmt->rowCount();
if($num>0){
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	extract((array)$row);
    $d =  json_decode(json_encode($row),true);
    
    $patient->idP=json_decode($d['idP'])
    ;
    $idp=$d['idP'];
    echo json_encode($idP);
    return ($d['idP']);
}
}
else
	echo "no patient with this name";
    
?>