<?php
    require_once __DIR__ . "/../models/adicionaisModel.php";

    class adicionaisController{
        public static function create($conn, $data){
            $result = adicionaisModel::create($conn, $data);
            if($result){
                return jsonResponse(['message'=> 'criado']);
            }else{
            return jsonResponse(['message'=> 'Deu merda'], 400);
            }
        }
        
        public static function getAll($conn) {
            $roomList = adicionaisModel::getAll($conn);
            return jsonResponse($roomList);
        }

        public static function getById($conn, $id) {
            $result = adicionaisModel::getById($conn, $id);
            return jsonResponse($result);
        }

        public static function delete($conn, $id){
            $result = adicionaisModel::delete($conn, $id);
            if($result){
                return jsonResponse(['message'=> 'deletado']);
            }else{
            return jsonResponse(['message'=> ''], 400);
            }
        }

        public static function update($conn, $id, $data){
            $result = adicionaisModel::update($conn, $id, $data);
            if($result){
                return jsonResponse(['message'=> 'atualizado']);
            }else{
                return jsonResponse(['message'=> 'Deu merda'], 400);
            }
        }
}
?>