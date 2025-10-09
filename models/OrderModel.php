<?php
require_once "quartoModel.php";
require_once "reservasModel.php";


class OrderModel{
    
    public static function create($conn, $data) {
        $sql = "INSERT INTO pedidos(usuario_id, cliente_id, pagamento) VALUES  (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis",
            $data["usuario_id"],
            $data["cliente_id"],
            $data["pagamento"]
        );
        $resultado = $stmt->execute();
        if ($resultado){
            return $conn->insert_id;
        }
        return false;
    }

    public static function getAll($conn) {
        $sql = "SELECT * FROM pedidos";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($conn, $id) {
        $sql = "SELECT * FROM pedidos WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

       public static function delete($conn, $id){
        $sql = "DELETE FROM pedidos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt_bin_param("i", $id);
        return $stmt->execute();
    }
 
    public static function update($conn, $id, $data){
        $sql = "UPDATE pedidos SET usuario_id = ?, cliente_id = ?, pagamento = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis",
            $data["usuario_id"],
            $data["cliente_id"],
            $data["pagamento"]
        )
        return $stmt->execute();
    }

    public static function createOrder($conn, $data){
        $cliente_id = $data['cliente_id'];
        $pagamento = $data['pagamento'];
        $usuario_id =$data['usuario_id'];
        $reservas = [];
        $reservas = false;

        $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

        try {
            $order_id = self::create($conn, [
                "usuario_id" => $usuario_id
                "cliente_id" => $cliente_id
                "pagamento" => $pagamento
            ]);
            if(!$order_id){
                throw new RuntimeException("erro ao criar o pedido");
            }

            foreach($data['quartos'] as $quarto){
                $id = $quarto["id"];
                $inicio = $inicio["inicio"];
                $fim = $fim["fim"];
            }    

            if (!quartoModel::lockById($conn, $id)){
                $reservas[] = "quarto ($id) indisponivel";   
                continue;         
            }

            //criar um metodo na classe reserve model para avaliar se o quarto esta disponivel no intervalo de datas. ReservasModel::IsConflict();
            
            $reserveResult = quartoModel::create($conn, [
                "pedido_id" >= $order_id,
                "quarto_id" >= $id,
                "adicional_id" >= null,
                "inicio" >= $inicio,
                "fim" >= $fim
            ])
        } catch (\Throwable $th) {
            try {
                $conn->rollback();
            } catch (\Throwable $th2) {}
            throw $th;
        }
        
    
    }
}
?>