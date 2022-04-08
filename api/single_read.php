
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

    $item->id_dog = isset($_GET['id_dog']) ? $_GET['id_dog'] : die();

    $item->getSingleDog();

    if($item->race != null){
        // create array
        $emp_arr = array(
            "id_dog" =>  $item->id_dog,
            "race" => $item->race,
            "type_de_poil" => $item->type_de_poil,
            "gabarit" => $item->gabarit,
            "origine" => $item->origine,
            "caractere" => $item->caractere,
            "photo" => $item->photo
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Dog not found.");
    }
?>

  