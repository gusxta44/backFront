<?php
require_once __DIR__ . "/../models/quartoModel.php";
require_once __DIR__ . "/../models/PhotoModel.php";
require_once "ValidatorController.php";
require_once "UploadController.php";

class quartoController {

    public static function create($conn, $data) {
        $camposObrigatorios = [
            'disponivel' => "disponível",
            'nome' => "nome", 
            'preco' => "preço",
            'qnt_cama_casal' => "quantidade de camas casal",
            'qnt_cama_solteiro' => "quantidade de camas solteiro",
            'numero' => "número do quarto"
        ];

        $camposFaltantes = [];
        foreach ($camposObrigatorios as $campo => $nomeExibicao) {
            if (!isset($data[$campo])) {
                $camposFaltantes[] = $nomeExibicao;
            }
        }
        if (!empty($camposFaltantes)) {
            if (count($camposFaltantes) === 1) {
                $mensagem = "Erro, falta preencher o campo: " . $camposFaltantes[0];
            } else {
                $mensagem = "Erro, faltam preencher os campos: " . implode(', ', $camposFaltantes);
            }
            return jsonResponse(['message' => $mensagem], 400); 
        }

        $result = quartoModel::create($conn, $data);
        if($result){
            if ($data['fotos']){
                $pictures = UploadController::upload($data['fotos']);
                foreach ($pictures['saves'] as $name) {
                    $idPhoto = PhotoModel::create($conn, $name['name']);
                    if ($idPhoto) {
                        PhotoModel::createRelationRoom($conn, $result, $idPhoto);
                    }
                }
            }
            return jsonResponse(['message'=> 'Quarto criado com sucesso!'], 201);
        }else{
            return jsonResponse(['message'=> 'Erro ao criar quarto'], 500);
        }
    }

    public static function getAll($conn) {
        $roomList = quartoModel::getAll($conn);
        return jsonResponse($roomList);
    }

    public static function getById($conn, $id) {
        $result = quartoModel::getById($conn, $id);
        if ($result) {
            return jsonResponse($result);
        } else {
            return jsonResponse(['message' => 'Quarto não encontrado'], 404);
        }
    }

    public static function delete($conn, $id) {
        $result = quartoModel::delete($conn, $id);
        if($result){
            return jsonResponse(['message'=> 'Quarto deletado com sucesso']);
        }else{
            return jsonResponse(['message'=> 'Erro ao deletar quarto'], 400);
        }
    }

    public static function update($conn, $id, $data) {
        $result = quartoModel::update($conn, $id, $data);
        if($result){
            return jsonResponse(['message'=> 'Quarto atualizado com sucesso']);
        }else{
            return jsonResponse(['message'=> 'Erro ao atualizar quarto'], 400);
        }
    }

    public static function searchAvailable($conn, $data) {
        ValidatorController::validate_data($data, ["inicio", "fim", "capacidade"]);

        $data["inicio"] = ValidatorController::fix_dateHour($data["inicio"], 14);
        $data["fim"] = ValidatorController::fix_dateHour($data["fim"], 12);

        $result = quartoModel::searchAvailable($conn, $data);
        if($result){
            foreach ($result as $quarto) {
                $quarto['fotos'] = PhotoModel::getByRoomId($conn, $quarto['id']);
            }
            return jsonResponse(['quartos_disponiveis'=> $result]);
        }else{
            return jsonResponse(['message'=> 'não tem quartos disponiveis'], 400);
        }
    }
}
?>
