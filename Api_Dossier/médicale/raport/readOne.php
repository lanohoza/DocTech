<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include_once '../connect.php';
include_once '../objects/raport.php';

$database= new Database();
$db= $database->getConnection();

$raport= new Raport($db);

$raport->Consultation_idC = isset($_GET['Consultation_idC']) ? $_GET['Consultation_idC'] : die();

$stmt= $raport->readOneP();

$num= $stmt->rowCount();
$stmt1= $raport->readOneD();

$num1= $stmt1->rowCount();

if($num>0&&$num1>0){
  while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
    extract($row1);
$file=fopen("Rapot-Medicale.txt", "a");
    fwrite($file, "Raport:");
    fwrite($file, $Consultation_idC."\n");

    fwrite($file, "Hopital:");
    fwrite($file, $Name."\n");
    
    fwrite($file, "Service:");
    fwrite($file, $NameD."\n");

    fwrite($file, "Doctor details:"."\n");
    fwrite($file, "Dr.");
    fwrite($file, $FullName."\n");

    fwrite($file, "Adresse:");
    fwrite($file, $Adresse."\n");

    fwrite($file, "Phone number:");
    fwrite($file, $Mobile_N."\n");

    http_response_code(200);
    echo json_encode(array($row1));
  }
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
    extract($row);
    
    $file=fopen("Rapot-Medicale.txt", "a");
    fwrite($file, "Consultation:"."\n");

    fwrite($file, "Patient details:"."\n");
    fwrite($file, "Full Name :");
    fwrite($file, $FullName."\n");

    fwrite($file, "Age:");
    fwrite($file, $Age."\n");

    fwrite($file, "Blood type:");
    fwrite($file, $Groupage."\n");

    fwrite($file, "Sexe:");
    fwrite($file, $Sexe."\n");

    fwrite($file, "Phone number:");
    fwrite($file, $Mobile_N."\n");

    fwrite($file, "Appointement Date:");
    fwrite($file, $Appoint."\n");

    fwrite($file, "Diagnostic result:");
    fwrite($file, $Diagnostic."\n");

    fwrite($file, "Notice:");
    fwrite($file, $NameM."\n");

    fwrite($file, "Bill:"."\n");
    fwrite($file, "Mount:");
    fwrite($file, $Mount."\n");

    http_response_code(200);
    echo json_encode(array($row));
  }
  
}
else{
  http_response_code(404);
  echo json_encode(array("message"=>"No raport found."));
}
?>