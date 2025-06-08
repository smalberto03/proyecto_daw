<?php
class BaseDeDatos {
    private $host = 'localhost';
    private $db = 'proyecto_daw_2425_def';
    private $usuario = 'root';
    private $contraseña = '';
    private $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli($this->host, $this->usuario, $this->contraseña, $this->db);

        if ($this->mysqli->connect_error) {
            die("Error de conexión: " . $this->mysqli->connect_error);
        }
    }

    public function obtenerConexion() {
        return $this->mysqli;
    }

    public function cerrarConexion() {
        $this->mysqli->close();
    }
}
?>
