<?php
require_once __DIR__ . "/../controllers/adicionaisController.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $id =  $segments[2] ?? null;
    
    if(isset($id)){
        adicionaisController::getById($conn, $id);
    }else{
        adicionaisController::getAll($conn);
    }


}elseif ($_SERVER['REQUEST_METHOD'] === "DELETE"){
    $id =  $segments[2] ?? null;
    
    if(isset($id)){
        adicionaisController::delete($conn, $id);
    }else{
        jsonResponse(['message'=>"ID necessario"], 400);
    }


}elseif ($_SERVER['REQUEST_METHOD'] === "POST"){  
    validateTokenAPI("funcionario");
    $data = json_decode(file_get_contents('php://input'), true);
    adicionaisController::create($conn, $data);

}elseif ($_SERVER['REQUEST_METHOD'] === "PUT"){  
    $data = json_decode(file_get_contents('php://input'), true);
    $id =  $data['id'];
    
    if(isset($data)){
        adicionaisController::update($conn, $id, $data);
    }else{
        jsonResponse(['message'=>"Atributos invalidos"], 400);
    }

}
else{
    jsonResponse([
    "status"=> "error",
    "message"=> "metodo nao premitido"
    ], 405);
}
?>