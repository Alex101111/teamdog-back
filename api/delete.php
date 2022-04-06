<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/Dogs.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Dogs($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id_dog = $data->id_dog;
    
    if($item->deleteDog()){
        echo json_encode("Dog deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }
?>