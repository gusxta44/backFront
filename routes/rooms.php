<?php
require_once __DIR__ . "/../controllers/quartoController.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $id = $segments[2] ?? null;

    if (isset($id)) {
        if (is_numeric($id)) {
            quartoController::getById($conn, $id);

        } elseif ($id === "disponiveis") {
            $data = [
                "inicio" => $_GET['inicio'] ?? null,
                "fim" => $_GET['fim'] ?? null,
                "capacidade" => $_GET['capacidade'] ?? null  
            ];

            quartoController::searchAvailable($conn, $data);

        } else {
            jsonResponse(['message' => "Essa rota não existe"], 400);
        }
    } else {
        quartoController::getAll($conn);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    quartoController::create($conn, $data);

} elseif ($_SERVER['REQUEST_METHOD'] === "PUT") {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;

    if ($id) {
        quartoController::update($conn, $id, $data);
    } else {
        jsonResponse(['message' => "ID do quarto é obrigatório para atualizar"], 400);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === "DELETE") {
    $id = $segments[2] ?? null;

    if (isset($id)) {
        quartoController::delete($conn, $id);
    } else {
        jsonResponse(['message' => "ID do quarto é obrigatório para deletar"], 400);
    }

} else {
    jsonResponse(['status' => 'erro', 'message' => 'Método não permitido'], 405);
}
