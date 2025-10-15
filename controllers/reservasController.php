<?php
require_once __DIR__ . "/../models/reservasModel.php";

class reservasController{

    public static function create($conn, $data){
        ValidatorController::validate_data($data, ["pedido_id", "quarto_id", "adicional_id", "inicio", "fim"])

        $data["inicio"] = ValidatorController::fix_dateHour($data["inicio"], 14)
        $data["fim"] = ValidatorController::fix_dateHour($data["fim"], 12)

        $result = reservasModel::create($conn, $data);
        if($result){
            return jsonResponse(['message'=> 'Reserva Criado com sucesso']);
        }else{
            return jsonResponse(['message'=> 'Erro ao criar reserva!'], 400);
        }
    }

    public static function procurarId($conn, $pedido_id) {
        $result = reservasModel::procurarId($conn, $pedido_id);
        return jsonResponse($result); 
    }   
    public static function getAll($conn) {
        $reservasList = reservasModel::getAll($conn);
        return jsonResponse($reservasList);
    }

    
    
}
?>