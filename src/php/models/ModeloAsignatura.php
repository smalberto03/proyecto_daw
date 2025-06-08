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
        $stmt->execute();

        // $stmt1 = $this->mysqli->prepare("INSERT INTO Asignaturasespeciales () VALUES ()");
        // $stmt1->bind_param("sss");
        // return $stmt1->execute();
    }

    public function actualizarAsignatura($id, $codigo, $nombre, $tipo) {
        $stmt = $this->mysqli->prepare("UPDATE Asignaturas SET codigoAsignatura = ?, nombreAsignatura = ?, tipo = ? WHERE idAsignatura = ?");
        $stmt->bind_param("sssi", $codigo, $nombre, $tipo, $id);
        return $stmt->execute();
    }
    
    public function eliminarAsignatura($id){

        //PRIMERO BORRAMOS LA FILA DE LA TABLA HORARIOS PARA DESPUES BORRARLA DE SU TABLA 

        $query = "DELETE FROM Horarios WHERE idAsignatura = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $stmt = $this->mysqli->prepare("DELETE FROM Asignaturas WHERE idAsignatura = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function procesoImportar()
    {
        $query = "DELETE FROM Asignaturas";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute(); 

        $query = "ALTER TABLE Asignaturas AUTO_INCREMENT = 1";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute();
    }
    
    public function importarAsignatura($codigo, $nombre, $nivel, $tipo) {

        $stmt = $this->mysqli->prepare("INSERT INTO Asignaturas (codigoAsignatura, nombreAsignatura, nivel, tipo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $codigo, $nombre, $nivel, $tipo);
        $stmt->execute();
    }

}
?>
