<?php
require_once __DIR__ . "/../controllers/clientesController.php";

if ( $_SERVER['REQUEST_METHOD'] === "GET" ){
    $id = $segments[2] ?? null;

    if(isset($id)){
        clientesController::getById($conn, $id); 
    }else{
        clientesController::getAll($conn, $id);
    } 
}

elseif($_SERVER['REQUEST_METHOD'] == "POST"){
    $data = json_decode(file_get_contents('php://input'), true);
    clientesController::create($conn, $data);
}

elseif($_SERVER['REQUEST_METHOD'] == "PUT"){
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    clientesController::update($conn, $id, $data);
}

if ( $_SERVER['REQUEST_METHOD'] === "DELETE" ){
    $id = $segments[2] ?? null;

    if(isset($id)){
        clientesController::delete($conn);
    }else{
       jsonResponse(['message'=>'ID do cliente é obrigatório'], 404);
    }
}
else{
    jsonResponse([
        'status'=>'erro',
        'message'=>'Método não permitido'
    ], 405);
}

?>
