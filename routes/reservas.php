<?php
require_once __DIR__ . "/../controllers/reservasController.php";

if ( $_SERVER['REQUEST_METHOD'] === "GET" ){
    $id = $segments[2] ?? null;

    if(isset($id)){
        reservasController::getById($conn, $id); 
    }else{
        reservasController::getAll($conn);
    } 
}

elseif($_SERVER['REQUEST_METHOD'] == "POST"){
    $data = json_decode(file_get_contents('php://input'), true);
    reservasController::create($conn, $data);
}

elseif($_SERVER['REQUEST_METHOD'] == "PUT"){
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    reservasController::update($conn, $id, $data);
}

if ( $_SERVER['REQUEST_METHOD'] === "DELETE" ){
    $id = $segments[2] ?? null;

    if(isset($id)){
        reservasController::delete($conn);
    }else{
       jsonResponse(['message'=>'ID da reserva é obrigatório'], 404);
    }
}
else{
    jsonResponse([
        'status'=>'erro',
        'message'=>'Método não permitido'
    ], 405);
}

?>
