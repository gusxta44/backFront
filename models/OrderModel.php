<?php
require_once __DIR__ . "/../models/quartoModel.php";
require_once __DIR__ . "/../models/reservasModel.php";
class OrderModel {

    public static function create($conn, $data){
        $sql = "INSERT INTO pedidos (usuario_id, cliente_id, pagamento) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $data["usuario_id"], $data["cliente_id"], $data["pagamento"]);
        $resultado = $stmt->execute();
        if ($resultado) {
            return $conn->insert_id;
        }
        return false;
    }

    public static function createOrder($conn, $data) {
        $cliente_id = $data['cliente_id'];
        $pagamento = $data['pagamento'];
        $usuario_id = $data['usuario_id'];
        $reservas = [];
        $reservou = false;

        $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

        try {
            $order_id = self::create($conn, [
                "usuario_id" => $usuario_id,
                "cliente_id" => $cliente_id,
                "pagamento" => $pagamento
            ]);

            if (!$order_id) {
                throw new RuntimeException("Erro ao criar o pedido");
            }

            foreach ($data['quartos'] as $quarto) {
                $id = $quarto["id"];
                $inicio = $quarto["inicio"];
                $fim = $quarto["fim"];

                if (!quartoModel::lockById($conn, $id)) {
                    $reservas[] = "Quarto ($id) indisponível";
                    continue;
                }

                if (!reservasModel::isQuartoDisponivel($conn, $id, $inicio, $fim)) {
                    $reservas[] = "Quarto {$id} indisponível no período de {$inicio} a {$fim}";
                    continue;
                }

                $reserveResult = reservasModel::create($conn, [
                    "pedido_id" => $order_id,
                    "quarto_id" => $id,
                    "adicional_id" => null,
                    "inicio" => $inicio,
                    "fim" => $fim
                ]);

                
                $reservou = true;
                $reservas[] = [
                    "reserva_id" => $conn->insert_id,
                    "quarto_id" => $id
                ];
            }

            if ($reservou == true) {
                $conn->commit();
                return [
                    "pedido_id" => $order_id,
                    "reservas" => $reservas,
                    "message" => "Reservas criadas com sucesso!"
                ];
            } else {
                throw new RuntimeException("Pedido não realizado. Nenhum quarto pôde ser reservado.");
            }

        } catch (\Throwable $th) {
            $conn->rollback();
            throw $th;
        }
    }

}
?>
