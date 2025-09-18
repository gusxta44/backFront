<?php
    class reservasModel{
        public static function create($conn, $data){
            $sql = "INSERT INTO reservas (inicio, fim) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("dd", 
                $data["inicio"],
                $data["fim"]
        );
        return $stmt->execute();
        }

    public static function getAll($conn){
        $Mysql = "SELECT * FROM reservas";
        $result = $conn->query($Mysql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }   

    public static function getById($conn, $id){
        $sql = "SELECT * FROM reservas WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function delete($conn, $id){
        $sql = "DELETE FROM reservas WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function update($conn, $id, $data) {
        $sql = "UPDATE reservas SET inicio = ?, fim = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
            $stmt->bind_param("ddi",
            $data["inicio"],
            $data["fim"]
            $id
        );
        return $stmt->execute();
    }
 

    }

?>