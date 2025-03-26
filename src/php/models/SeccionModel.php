<?php
require_once __DIR__ . '/../config/configdbcurso.php';

class SeccionModel {
    private $pdo;

    public function __construct() {
        $this->pdo = conectar();
    }

    public function getAllSecciones() {
        $stmt = $this->pdo->query("SELECT * FROM Secciones");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSeccionById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Secciones WHERE idSeccion = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteSeccion($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Secciones WHERE idSeccion = ?");
        return $stmt->execute([$id]);
    }

    public function updateSeccion($id, $codigo_seccion, $nombreSeccion) {
        $stmt = $this->pdo->prepare("UPDATE Secciones SET codigo_seccion = ?, nombreSeccion = ? WHERE idSeccion = ?");
        return $stmt->execute([$codigo_seccion, $nombreSeccion, $id]);
    }

    public function addSeccion($codigo_seccion, $nombreSeccion) {
        $stmt = $this->pdo->prepare("INSERT INTO Secciones (codigo_seccion, nombreSeccion) VALUES (?, ?)");
        return $stmt->execute([$codigo_seccion, $nombreSeccion]);
    }

    public function importarSecciones($filePath) {
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $codigo_seccion = $data[0];
                $nombreSeccion = $data[1];
                $stmt = $this->pdo->prepare("INSERT INTO Secciones (codigo_seccion, nombreSeccion) VALUES (?, ?)");
                return $stmt->execute([$codigo_seccion, $nombreSeccion]);
            }
            fclose($handle);
        }
    }
}
?>
