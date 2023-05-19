<?php
require_once '../../../Autoloader.php';
Autoloader::register();

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
    //$data = (object)$data;
    print_r($data);
$database = new Database();
$db = $database->getConnection();

$client = new Client($db);

$client->nom = $data->nom;
$client->prenoms = $data->prenoms;
$client->email = $data->email;
$client->dateNaiss = $data->dateNaiss;
$client->created_at = isset($data->created_at) ? $data->created_at : date('Y-m-d H:i:s');

    if($client->add()){
        http_response_code(201);
        echo json_encode(array("message" => "Client créé avec succès."));
    } else{
        http_response_code(503);
        echo json_encode(array("message" => "Erreur lors de la création du client"));
    }
?>