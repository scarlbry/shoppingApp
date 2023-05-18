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
$clientController= new ClientController($db);

$result = $client->listAll(null);
//    $itemCount = $stmt->rowCount();
  $itemCount = sizeof($result);


//    echo json_encode($itemCount);

$response = array();
$response["message"] = '';
$response["total"] = $itemCount;
$response["data"] = null;
    if($itemCount > 0){

        $response["data"] = $result;
//        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//            extract($row);
//            $e = array(
//                "id" => $id,
//                "name" => $name,
//                "email" => $email,
//                "age" => $age,
//                "designation" => $designation,
//                "created" => $created
//            );
//            $employeeArr["body"]
//            array_push(, $e);
//        }
        echo json_encode($response);
    }

    else{
        http_response_code(404);
            $response["message"] =  "Aucun client trouvé." ;
    }
echo json_encode($response);
?>