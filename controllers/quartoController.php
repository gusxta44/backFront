<?php
require_once __DIR__ . "/../models/quartoModel.php";

class quartoController{
    public static function create($conn, $data){
        $camposObrigatorios = [
            'disponivel' => "disponível",
            'nome' => "nome", 
            'preco' => "preco",
            'qnt_cama_casal' => "qnt_cama_casal",
            'qnt_cama_solteiro' => "qnt_cama_solteiro"
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
        return jsonResponse($result);
    }

    public static function delete($conn, $id){
        $result = quartoModel::delete($conn, $id);
        if($result){
            return jsonResponse(['message'=> 'quarto deletado']);
        }else{
            return jsonResponse(['message'=> 'deu ruim'], 400);
        }
    }

    public static function update($conn, $id, $data){
        $result = quartoModel::update($conn, $id, $data);
        if($result){
            return jsonResponse(['message'=> 'quarto atualizado']);
        }else{
            return jsonResponse(['message'=> 'deu ruim'], 400);
        }
    }
}
?>