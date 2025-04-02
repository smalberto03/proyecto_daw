<?php
require_once __DIR__ . '/../config/configdb.php';

class Profesor {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerProfesores() {
        $query = "SELECT idProfesor, nombre, apellidos, imagen, tipo FROM Profesores";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerTitulares() {
        $query = "SELECT idProfesor, nombre, apellidos FROM Profesores WHERE tipo = 0";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addProfesor($cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto) 
    {
        $query = "INSERT INTO Profesores (cod_profesor, nombre, apellidos, email, pass, imagen, tipo, idProfesorSustituto)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssssii", $cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto);
        $stmt->execute();
    }

    public function getProfesorById($id) {
        $query = "SELECT * FROM Profesores WHERE idProfesor = $id";
        $query = $this->db->query($query);
        $datos = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return $datos;
    }

    public function updateProfesor($id, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto) {
        $stmt = $this->pdo->prepare("UPDATE Profesores SET nombre = ?, apellidos = ?, nombreusuario = ?, pass = ?, imagen = ?, tipo = ?, idProfesorSustituto = ? WHERE idProfesor = ?");
        return $stmt->execute([$nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto, $id]);
    }

    public function deleteProfesor($id) {
        $query = "DELETE FROM Profesores WHERE idProfesor = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
