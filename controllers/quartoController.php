<?php
require_once __DIR__ . "/../models/quartoModel.php";

class quartoController{

    public static function create($conn, $data){
        $result = quartoModel::create($conn, $data);
        if ($result){
            return jsonResponse(['mesage'=>"quarto criado com sucesso"]);
        }else{
            return jsonResponse(['mesage'=>"nao criado"]);
        }
    }

    public static function getAll($conn){
        $roomList = quartoModel::getAll($conn);
        return jsonResponse($roomList);
    }

    public static function getById($conn, $id){
        $buscId = quartoModel::getById($conn, $id);
        return jsonResponse($buscId);
    }

    public static function delete($conn, $id){
        $delet = quartoModel::delete($conn, $data);
        if ($delet){
            return jsonResponse(['mesage'=>"quarto excluido com sucesso"]);
        }else{
            return jsonResponse(['mesage'=>"nao criado"]);
        }

    }
    
}
?>