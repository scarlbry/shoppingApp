<?php

use classes\Client;
use config\Database;
use controllers\ClientController;

header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $response = array();
$response["message"] = '';
$response["data"] = null;

    $data = json_decode(file_get_contents("php://input"));
$database = new Database();
$db = $database->getConnection();

$client = new Client($db);

$client->nom = $data->name;
$client->email = $data->email;
$client->dateNaiss = $data->dateNaissance;
$client->prenoms = $data->prenoms;
$client->created = isset($data->created) ? $data->created : date('Y-m-d H:i:s');
    
    if($client->add()){
        http_response_code(201);
        echo json_encode(array("message" => "Client créé avec succès."));
    } else{
        http_response_code(503);
        echo json_encode(array("message" => "Erreur lors de la création du client"));
    }
?>