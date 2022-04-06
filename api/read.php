<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/Dogs.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Dogs($db);

    $stmt = $items->getDogs();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $dogsAray = array();
        $dogsAray["body"] = array();
        $dogsAray["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_dog" => $id_dog,
                "race" => $race,
                "type_de_poil" => $type_de_poil,
                "gabarit" => $gabarit,
                "origin" => $origin,
                "caractere" => $caractere,
                "photo" => $photo

            );

            array_push($dogsAray["body"], $e);
        }
        echo json_encode($dogsAray);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>