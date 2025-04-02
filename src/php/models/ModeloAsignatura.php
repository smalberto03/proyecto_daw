<?php
class ModeloAsignatura {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function obtenerAsignaturas() {
        $resultado = $this->mysqli->query("SELECT * FROM Asignaturas");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerAsignaturaPorId($id) {
        $stmt = $this->mysqli->prepare("SELECT * FROM Asignaturas WHERE idAsignatura = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function agregarAsignatura($codigo, $nombre, $tipo) {
        $stmt = $this->mysqli->prepare("INSERT INTO Asignaturas (codigoAsignatura, nombreAsignatura, tipo) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $codigo, $nombre, $tipo);
        return $stmt->execute();
    }

    public function actualizarAsignatura($id, $codigo, $nombre, $tipo) {
        $stmt = $this->mysqli->prepare("UPDATE Asignaturas SET codigoAsignatura = ?, nombreAsignatura = ?, tipo = ? WHERE idAsignatura = ?");
        $stmt->bind_param("sssi", $codigo, $nombre, $tipo, $id);
        return $stmt->execute();
    }
    
    public function eliminarAsignatura($id){
        $stmt = $this->mysqli->prepare("DELETE FROM Asignaturas WHERE idAsignatura = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
