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

    $item->race = $data->race;
    $item->type_de_poil = $data->type_de_poil;
    $item->gabarit = $data->gabarit;
    $item->origine = $data->origine;
    $item->caractere = $data->caractere;
    $item->photo = $data->photo;

    
    if($item->createDogs()){
        echo 'Dog created successfully.';
    } else{
        echo 'Dog could not be created.';
    }
?>