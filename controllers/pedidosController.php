<?php
require_once __DIR__ . "/../models/pedidosModel.php";

class pedidosController{
    public static function create($conn, $data){
        $result = pedidosModel::create($conn, $data);
        if($result){
            return jsonResponse(['message'=> 'pedido criado']);
        }else{
        return jsonResponse(['message'=> 'deu ruim'], 400);
        }
    }
    
    public static function getAll($conn) {
        $pedido = pedidosModel::getAll($conn);
        return jsonResponse($pedido);
    }
    public static function getById($conn, $id) {
        $result = pedidosModel::getById($conn, $id);
        return jsonResponse($result);
    }
}
?>