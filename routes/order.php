<?php
require_once __DIR__ . "/../controllers/OrderController.php";

if ($_SERVER['REQUEST_METHOD'] === "POST"){  
    $data = json_decode(file_get_contents('php://input'), true);
        OrderController::createOrder($conn, $data);
}else{
        jsonResponse(['status'=>'erro','message'=>'metodo nao permitido'], 405);
    }

?>     