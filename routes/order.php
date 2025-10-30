<?php
require_once __DIR__ . "/../controllers/OrderController.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $id = $segments[2] ?? null;
 
    if (isset($id)) {
        OrderController::getById($conn, $id);
    } else {
        OrderController::getAll($conn);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
    $user = validateTokenAPI("cliente");

    $opcao = $segments[2] ?? null;
    $data = json_decode(file_get_contents('php://input'), true);
    $data['cliente_id'] = $user['id'];

    if ($opcao == "reservation"){
        OrderController::createOrder($conn, $data);
    }else{
        OrderController::create($conn, $data);
    }
}

else{
    jsonResponse(['status'=>'erro','message'=>'Método não permitido'], 405);
}

?>