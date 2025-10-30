<?php
require_once __DIR__ . "/../controllers/AuthController.php";

if ( $_SERVER['REQUEST_METHOD'] === "POST" ){
    $opcao = $segments[2] ?? null;
    $data = json_decode(file_get_contents('php://input'), true);

    if ($opcao == "client"){// login do cliente
        AuthController::loginClient($conn, $data);

    }else if ($opcao == "employee"){// login do funcionario
        AuthController::login($conn, $data);
    }else{
        jsonResponse(['status'=>'erro', 'message'=>'rota não existe'], 405);
    }
}
else{
    jsonResponse(['status'=>'erro','message'=>'Método não permitido'], 405);
}


?>