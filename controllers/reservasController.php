<?php
require_once __DIR__ . "/../models/reservasModel.php";

class reservasController{

    public static function create($conn, $data){
        $result = quartoModel::create($conn, $data);
        if ($result){
            return jsonResponse(['mesage'=>"reserva criada com sucesso"]);
        }else{
            return jsonResponse(['mesage'=>"nao criado"]);
        }
    }

    public static function getAll($conn){
        $roomList = reservasModel::getAll($conn);
        return jsonResponse($roomList);
    }

    public static function getById($conn, $id){
        $buscId = reservasModel::getById($conn, $id);
        return jsonResponse($buscId);
    }

    public static function delete($conn, $id){
        $delet =  reservasModel::delete($conn, $data);
        if ($delet){
            return jsonResponse(['mesage'=>"reserva excluida com sucesso"]);
        }else{
            return jsonResponse(['mesage'=>"nao criado"]);
        }
    }

    public static function update($conn, $id, $data){
        $result = reservasModel::update($conn, $id, $data);
        if($result){
            return jsonResponse(['message'=> 'reserva atualizada']);
        } else{
            return jsonResponse(['message'=> 'Deu merda'], 400);
        }
    }
 
 

    

}
?>