<?php
require_once "ValidatorController.php";
require_once __DIR__ . "/../models/OrderModel.php";

class OrderController{

    public static function create($conn, $data){
        return;
    }

    public static function createOrder($conn, $data){
        $data["usuario_id"] = isset($data['usuario_id']) ? $data['usuario_id'] : null;

        ValidatorController::validate_data($data, ["cliente_id", "pagamento", "quartos"]);

        foreach($data['quartos'] as $index => $quarto){
            ValidatorController::validate_data($quarto, ["id", "inicio", "fim"]);
            $quarto["inicio"] = ValidatorController::fix_dateHour($quarto["inicio"], 14);
            $quarto["fim"] = ValidatorController::fix_dateHour($quarto["fim"], 12);

        }    
        if (count ($data["quartos"]) == 0){
            return jsonResponse(['message'=> 'não existe reserva'], 400);
        }

        try {
            $resultado = OrderModel::createOrder($conn, $data);
            return jsonResponse(['message'=> $resultado]);

        }catch(RuntimeException $erro) {
            return jsonResponse(['message' => 'erro ao criar reserva'], 500);
        }

    }

    public static function getAll($conn) {
        $order = OrderModel::getAll($conn);
        return jsonResponse($order);
    }

    public static function getById($conn, $id) {
        $result = OrderModel::getById($conn, $id);
        return jsonResponse($result);
    }

    public static function delete($conn, $id){
        $delet = OrderModel::delete($conn, $id);
        if ($delet){
            return jsonResponse(['mesage'=>"quarto excluido com sucesso"]);
        }else{
            return jsonResponse(['mesage'=>"Não foi possivel ser deletar esse quarto"]);
        }
    }

    public static function update($conn, $id, $data){
        $result = clientesModel::update($conn, $id, $data);
            if($result){
                return jsonResponse(['message'=> 'atualizado']);
            }else{
                return jsonResponse(['message'=> 'deu merda'], 400);
            }
    }


}