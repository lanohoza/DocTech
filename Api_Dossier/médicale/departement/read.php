<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include_once '../connect.php';
include_once '../objects/departement.php';
include_once '../objects/hopital.php';

$database= new Database();
$db= $database->getConnection();

$departement= new Departement($db);
$hopital= new Hopital($db);


$hopital->Name = isset($_GET['Name']) ? $_GET['Name'] : die();
$stmtH= $hopital->getNameH();
//echo json_encode($stmtH);
$rowH = $stmtH->fetch(PDO::FETCH_ASSOC);
    extract($rowH);
    
    $N=json_decode(json_encode($rowH['Name']));
   

$stmt= $departement->read($N);

$num= $stmt->rowCount();
if($num>0){
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$departement_item=array(
		 "idDepartement" => $idDepartement,
            "NameD" => $NameD,
            "Hopital_Name"=>$N,
            );
		http_response_code(200);
		echo json_encode($departement_item);
	}
}
else{
	http_response_code(404);
	echo json_encode(array("message"=>"No departements found."));
}
?>