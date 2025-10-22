<?php

class PhotoModel{

    public static function getAll($conn) {
        $sql = "SELECT nome, email, telefone, cpf, cargo_id FROM clientes";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($conn, $id) {
        $sql = "SELECT * FROM imagens_quartos WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create($conn, $name) {
        $sql = "INSERT INTO imagens_quartos (nome) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            return $conn->insert_id;
        }
        return false;
    }

    public static function createRelationRoom($conn, $idRoom, $idPhoto) {
        $sql = "INSERT INTO imagens_quartos (quarto_id, imagem_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $idRoom, $idPhoto);
        if ($stmt->execute()) {
            return $conn->insert_id;
        }
        return false;
    }


    public static function getByRoomId($conn, $id){
        $sql = "SELECT f.nome FROM imagens_quartos qf 
        JOIN fotos f ON qf.foto_id = f.id 
        WHERE qf.quarto_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resiçt = $stmt->get_result();
        $photos = [];
        while($row = $result->fetch_assoc()){
            $photos[] = $row['nome'];
        }
        return $photos;
    }

    public static function delete($conn, $id) {
        $sql = "DELETE FROM imagens_quartos WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function update($conn, $id) {
        $sql = "UPDATE imagens_quartos SET nome = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",
        );
        return $stmt->execute();
    }
}
?>