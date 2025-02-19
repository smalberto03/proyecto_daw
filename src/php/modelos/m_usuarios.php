<?php

    
    require_once('../config/configdb.php');
    //require('../../../vendor/autoload.php');

    //use PhpOffice\PhpSpreadsheet\IOFactory;
    

    /**
     * Clase Modelo. Es la encargada de realizar las diferentes consultas con la base de datos y mandarlas
     * añl controlador
     */
    class M_usuarios{

        public $conectar;
        //public $array_nombre;

        /**
         * Metodo que se ejecuta siemore que se llama al Modelo. Realiza la conexion cpon la base de datos 
         */
        public function __construct()
        {
            $conexion = new Conexion();
            $this->conectar = $conexion->conectar();
        }

        /**
         * Metodo qiue realiza la consulta para insertar un usuario con los datos qu eel usuario ha escruto en el formulario 
         * @param {String} $nombreusuario Nombre de usuario que se ha introducido por teclado 
         * @param {String} $pass Contraseña que se ha introducido por teclado 
         */
        public function anadir_usuario($nombreusuario, $pass)
        {
            $consulta = "INSERT INTO users VALUES (id, '$nombreusuario', '$pass')";
            $query0 = $this->conectar->query($consulta);
        }

        /**
         * Metodo para hacer la consulta a la tabla usuarios 
         * @return {array} $datos Array con ñlas filas que se enviuaran al controlador y de ahi a la vist correpondiente 
         */
        public function ver_usuarios()
        {
            $consulta1 = "SELECT * FROM users";
            $query1 = $this->conectar->query($consulta1);

            //$fetch = $query1->fetch_array();

            if($query1->num_rows == 0)
            {
                echo 'No hay usuarios en la aplicación';
            }
            else{
             
                $datos = mysqli_fetch_all($query1, MYSQLI_ASSOC);
                return $datos;
      
                // while($fetch = $query1->fetch_array())
                // {
                //     $array = $fetch['nombreusuario']['password'];
                //     //$array = $fetch['password'];
                // }
                // return $array_pass;
            }
        }

        /**
         * Metodo qiue se encarga de realizar el delete del id que nos manda el controlador
         * @param {Integer} $id Id del usuarwio que se quieere borrar 
         */
        public function borrar_usuarios($id)
        {
            $delete = "DELETE FROM users WHERE id = $id";
            $query2 = $this->conectar->query($delete);
        }

        /**
         * Undocumented function
         *
         * @param [type] $id
         * @return [array] $datos Devuelve las filas según la consulta que realiza 
         */
        /*public function comprobar_admin($id)
        {
            $consulta = "SELECT es_admin FROM users WHERE id = $id";
            $query4 = $this->conectar->query($consulta);

            $datos = mysqli_fetch_array($query4);
            return $datos;
        }

        public function anadir_admin($dato)
        {
            $update = "UPDATE users SET es_admin = 1";
            $query5 = $this->conectar->query($update);
        }

        public function quitar_admin($dato)
        {
            $update = "UPDATE users SET es_admin = 0";
            $query6 = $this->conectar->query($update);
        }*/
    }
?>