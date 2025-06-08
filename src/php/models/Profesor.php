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

    public function updateProfesor($id, $cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto) {
        $query = "UPDATE Profesores SET cod_profesor = ?, nombre = ?, apellidos = ?, email = ?, pass = ?, imagen = ?, tipo = ?, idProfesorSustituto = ? WHERE idProfesor = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssiiii", $cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto, $id);
        return $stmt->execute();
    }

    public function deleteProfesor($id) {

        $query = "DELETE FROM Horarios WHERE idProfesor = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $query = "DELETE FROM Profesores WHERE idProfesor = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function importarProfesor($filePath)
    {
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                if (count($data) < 7) {
                    continue; // Saltar filas que no tienen el formato correcto
                }

                $cod_profesor = $data[0];
                $nombre = mb_convert_encoding($data[1], 'UTF-8', 'ISO-8859-1');
                //$nombre = mb_convert_encoding($datos[1], 'UTF-8', 'ISO-8859-1');
                $apellidos = mb_convert_encoding($data[2], 'UTF-8', 'ISO-8859-1');
                $email = $data[3];
                $pass = $data[4];
                $tipo = $data[5];
                //$imagen = $data[6];
                $imagen = "logotipo.png";
                //../../../diseno/assets/logotipo.png
                $idProfesorSustituto = (isset($data[7]) && $tipo == 1) ? $data[7] : null;

                $query = "INSERT INTO Profesores (cod_profesor, nombre, apellidos, email, pass, imagen, tipo, idProfesorSustituto)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($query);

                if ($idProfesorSustituto === null) {
                    $idProfesorSustituto = NULL; // Asegurarse de que sea NULL si no está definido
                    $stmt->bind_param("ssssssis", $cod_profesor, $nombre, $apellidos, $email, $pass, $imagen, $tipo, $idProfesorSustituto);
                } else {
                    $stmt->bind_param("ssssssii", $cod_profesor, $nombre, $apellidos, $email, $pass, $imagen, $tipo, $idProfesorSustituto);
                }

                if (!$stmt->execute()) {
                    echo "Error al insertar datos: " . $stmt->error;
                }
            }
            fclose($handle);
        }
    }

    public function buscarPorEmail($email)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM Profesores WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
}
?>
