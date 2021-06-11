<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  include_once '../connect.php';
  include_once '../objects/user.php';

  $database= new Database();
  $db=$database->getConnection();
  $user=new User($db);
  $data =json_decode(file_get_contents("php://input"));
  if (
    !empty($data->FullName)&&
  !empty($data->User_Role) &&
    !empty($data->Mobile_N)&&
    !empty($data->Sexe)&&
    !empty($data->Adresse)&&
    !empty($data->Groupage)&&
    !empty($data->Age)
) {
    $user->FullName=$data->FullName;
    $user->User_Role = $data->User_Role;
  $user->Mobile_N = $data->Mobile_N;
  $user->Groupage = $data->Groupage;
  $user->Sexe = $data->Sexe;
  $user->Adresse = $data->Adresse;
  $user->Age=$data->Age;
  if ($user->create()) {
    http_response_code(201);
    echo json_encode(array("message"=>"User was created"));
  }
  else{
    http_response_code(503);

    echo json_encode(array("message"=>"Unable to create user"));
  }

  }
  else{
    http_response_code(400);
    echo json_encode(array("message"=>"Unable to create user.Data is incomplete"));
  }
  ?>