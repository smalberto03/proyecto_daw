<?php
require_once __DIR__ . '/../config/configdbcurso.php';

class CursoModelo{
    private $pdo;

    public function __construct(){
        $this->pdo = conectar();
    }

    public function addCurso($fechaInicio, $fechaFin, $descripcion){
        $stmt = $this->pdo->prepare("INSERT INTO Cursos (fechaInicio, fechaFin, descripcion) VALUES (?, ?, ?)");
        return $stmt->execute([$fechaInicio, $fechaFin, $descripcion]);
    }

    public function borrarProfesores() {
        $stmt = $this->pdo->prepare("DELETE FROM Profesores WHERE tipo = 1");
        return $stmt->execute();
    }

    public function borrarProfesoresTitulares()
    {
        $stmt = $this->pdo->prepare("DELETE FROM Profesores WHERE idProfesor != 1 AND tipo = 0");
        $stmt->execute();

        $stmt = $this->pdo->prepare("ALTER TABLE Profesores AUTO_INCREMENT = 2");
        $stmt->execute();
    }

    public function borrarHorarios() {
        $stmt = $this->pdo->prepare("DELETE FROM Horarios");
        $stmt->execute();

        $stmt = $this->pdo->prepare("ALTER TABLE Horarios AUTO_INCREMENT = 1");
        $stmt->execute();
    } 

    public function getUltimoCurso() {
        $stmt = $this->pdo->prepare("SELECT * FROM Cursos ORDER BY idCurso DESC LIMIT 1");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCurso($id, $fechaInicio, $fechaFin, $descripcion) {
        // Asegúrate de que la consulta SQL tenga el número correcto de marcadores de posición
        $stmt = $this->pdo->prepare("UPDATE Cursos SET fechaInicio = :fechaInicio, fechaFin = :fechaFin, descripcion = :descripcion WHERE idCurso = :id");
    
        // Pasa los parámetros como un array asociativo
        return $stmt->execute([
            ':fechaInicio' => $fechaInicio,
            ':fechaFin' => $fechaFin,
            ':descripcion' => $descripcion,
            ':id' => $id
        ]);
    }

    public function reinicioCurso()
    {
        $stmt = $this->pdo->prepare("TRUNCATE TABLE Cursos");
        $stmt->execute();
        //return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>



