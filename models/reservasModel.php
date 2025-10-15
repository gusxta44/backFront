<?php
class reservasModel{

    public static function procurarId($conn, $pedido_id){
        $sql = "SELECT * FROM reservas WHERE pedido_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $pedido_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function getAll($conn) {
        $sql = "SELECT * FROM reservas";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function update($conn, $id, $data) {
        $sql = "UPDATE reservas SET pedido_id = ?, quarto_id = ?, adicional_id = ?, fim = ?, inicio = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiss",
            $data["pedido_id"],
            $data["quarto_id"],
            $data["adicional_id"],
            $data["fim"],
            $data["inicio"],
            $id
        );
        return $stmt->execute();
    }
 
    public static function create($conn, $data) {
        $sql = "INSERT INTO reservas (pedido_id, quarto_id, adicional_id , fim, inicio) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiss",
            $data["pedido_id"],
            $data["quarto_id"],
            $data["adicional_id"],
            $data["fim"],
            $data["inicio"]
        );
        return $stmt->execute();
    }

    public static function isQuartoDisponivel($conn, $quarto_id, $inicio, $fim) {
        $sql = "SELECT COUNT(*) as conflitos
                FROM reservas
                WHERE quarto_id = ?
                AND (
                    (inicio <= ? AND fim > ?) OR
                    (inicio < ? AND fim >= ?) OR
                    (inicio >= ? AND fim <= ?)
                )";
       
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssss",
            $quarto_id,
            $fim, $inicio,
            $inicio, $fim,
            $inicio, $fim
        );
       
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['conflitos'] == 0;
    }
}
?>