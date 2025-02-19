<?php
    require_once('config.php');

    class Conexion{

        private $servidor;
        private $usuario;
        private $password;
        private $bbdd;
        
        public function conectar()
        {
            $this->servidor = constant('SERVIDOR');
            $this->usuario = constant('USUARIO');
            $this->password = constant('PASSWORD');
            $this->bbdd = constant('BBDD'); 

            $conexion = new mysqli($this->servidor, $this->usuario, $this->password, $this->bbdd); //$conexion es un objeto de la clase mysqli
            $conexion->set_charset('utf8');  
            return $conexion; //Retornamos el objeto porque lo vamos a usar fuera del metodo y fuera de la clase 
        }

    }

?>