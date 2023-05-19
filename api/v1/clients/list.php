<?php
require_once '../../../Autoloader.php';
Autoloader::register();

use classes\Client;
use config\Database;
use controllers\ClientController;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $database = new Database();
    $db = $database->getConnection();

$client = new Client($db);
//$clientController= new ClientController($db);

$response = array();
$response["message"] = '';
$response["total"] = 0;
$response["data"] = null;
try{

    $result = $client->listAll(null);
//    $itemCount = $stmt->rowCount();
    $itemCount = sizeof($result);
    $response["total"] = $itemCount;

//    echo json_encode($itemCount);

    if($itemCount > 0){

        $response["data"] = $result;

    }

    else{
        http_response_code(404);
        $response["message"] =  "Aucun client trouvé." ;
    }
}catch(PDOException $exception){
    http_response_code(404);
    $response["message"] =  "Erreur lors de la récupération $exception." ;
}catch(Exception $exception){
    http_response_code(404);
    $response["message"] =  "Erreur lors de la récupération". $exception->getMessage() ;
}
echo json_encode($response);

?>