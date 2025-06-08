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

        $stmt = $this->pdo->prepare("DELETE FROM Horarios WHERE idSeccion = ?");
        $stmt->execute([$id]);

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

        $stmt = $this->pdo->prepare("DELETE FROM Secciones");
        $stmt->execute();
        
        $stmt = $this->pdo->prepare("ALTER TABLE Secciones AUTO_INCREMENT = 1");
        $stmt->execute();

        if(($handle = fopen($filePath, "r")) !== FALSE) {
            while(($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                echo $data[0];

                $codigo_seccion = $data[0];
                $nombreSeccion = mb_convert_encoding($data[1], 'UTF-8', 'ISO-8859-1'); 

                //$nombre = mb_convert_encoding($datos[1], 'UTF-8', 'ISO-8859-1');
                
                $stmt = $this->pdo->prepare("INSERT INTO Secciones (codigo_seccion, nombreSeccion) VALUES (?, ?)");
                $stmt->execute([$codigo_seccion, $nombreSeccion]);
            }
            fclose($handle);
        }
    }
}
?>
