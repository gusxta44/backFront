<?php
require_once __DIR__ . "/../controllers/reservasController.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $pedido_id =  $segments[2] ?? null;
    if(isset($pedido_id)){
        reservasController::procurarId($conn, $pedido_id);
    }else{
        reservasController::getAll($conn);
    }

}elseif ($_SERVER['REQUEST_METHOD'] === "POST"){  
    $data = json_decode(file_get_contents('php://input'), true);
    
    if(isset($data)){
        reservasController::create($conn, $data);
    }else{
        jsonResponse(['message'=>"Atributos invalidos"], 400);
    }
}

else{
    jsonResponse([
    "status"=> "error",
    "message"=> "metodo nao premitiodo"
    ], 405);
}
?>