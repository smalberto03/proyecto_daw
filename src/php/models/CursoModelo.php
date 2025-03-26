<?php
require_once __DIR__ . '/../config/configdbcurso.php';

class CursoModelo {
    private $pdo;

    public function __construct() {
        $this->pdo = conectar();
    }

    public function addCurso($fechaInicio, $fechaFin, $descripcion) {
        $stmt = $this->pdo->prepare("INSERT INTO Cursos (fechaInicio, fechaFin, descripcion) VALUES (?, ?, ?)");
        return $stmt->execute([$fechaInicio, $fechaFin, $descripcion]);
    }

    public function borrarProfesores() {
        $stmt = $this->pdo->prepare("DELETE FROM Profesores");
        return $stmt->execute();
    }

    public function borrarHorarios() {
        $stmt = $this->pdo->prepare("DELETE FROM Horarios");
        return $stmt->execute();
    } 

    public function getUltimoCurso() {
        $stmt = $this->pdo->prepare("SELECT * FROM Cursos ORDER BY idCurso DESC LIMIT 1");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCurso($idCurso, $descripcion) {
        $stmt = $this->pdo->prepare("UPDATE Cursos SET descripcion = ? WHERE idCurso = ?");
        return $stmt->execute([$descripcion, $idCurso]);
    }
}
?>



