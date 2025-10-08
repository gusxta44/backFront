<?php
    require_once __DIR__ . "/../models/clientesModel.php";
    require_once "passwordController.php";

    class clientesController{
        public static function create($conn, $data){
            $data['senha'] = passwordController::generateHash($password = $data['senha']);
            $result = clientesModel::create($conn, $data);

            if($result){
                return jsonResponse(['message'=> 'Cliente criado']);
            }else{
            return jsonResponse(['message'=> 'Deu merda'], 400);
            }
        }
        
        public static function getAll($conn) {
            $roomList = clientesModel::getAll($conn);
            return jsonResponse($roomList);
        }

        public static function getById($conn, $id) {
            $result = clientesModel::getById($conn, $id);
            return jsonResponse($result);
        }

        public static function delete($conn, $id){
            $result = clientesModel::delete($conn, $id);
            if($result){
                return jsonResponse(['message'=> 'Cliente deletado']);
            }else{
            return jsonResponse(['message'=> ''], 400);
            }
        }

        public static function update($conn, $id, $data){
            $result = clientesModel::update($conn, $id, $data);
            if($result){
                return jsonResponse(['message'=> 'Cliente atualizado']);
            }else{
                return jsonResponse(['message'=> 'Deu merda'], 400);
            }
        }
}
?>