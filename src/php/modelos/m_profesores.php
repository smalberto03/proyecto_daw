<?php

    require_once('../config/configdb.php');
    // require('../../../vendor/autoload.php');

    // use PhpOffice\PhpSpreadsheet\IOFactory;



    /**
     * Clase Modelo. Es la encargada de realizar las diferentes consultas con la base de datos y mandarlas
     * al controlador relacioando con los profesores de la aplicación 
     */
    class M_profesores{

        public $conectar;

        public $num_filas;

         /**
         * Metodo que se ejecuta siemore que se llama al Modelo. Realiza la conexion cpon la base de datos 
         */
        public function __construct()
        {
            $conexion = new Conexion();
            $this->conectar = $conexion->conectar();
        }



        public function ver_profesores()
        {
            $consulta1 = "SELECT idProfesor, nombre, apellidos, tipo FROM profesores";
            $query1 = $this->conectar->query($consulta1);

            //$fetch = $query1->fetch_array();

            if($query1->num_rows == 0)
            {
                echo 'No hay profesores en la aplicación';
            }
            else{

                // $this->num_filas = $query1->num_rows;
             
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

        public function obtener_datos_profesor_a_modificar($id_a_modificar)
        {
            $consulta = "SELECT cod_profesor, nombre, apellidos, email, tipo FROM profesores WHERE idProfesor = $id_a_modificar";
            $query = $this->conectar->query($consulta);

            $datos = mysqli_fetch_all($query, MYSQLI_ASSOC);
            return $datos;
        }


        public function ver_profesores_titulares()
        {
            $consulta1 = "SELECT idProfesor, nombre, apellidos, tipo FROM profesores WHERE tipo = 0";
            $query1 = $this->conectar->query($consulta1);

            //$fetch = $query1->fetch_array();

            if($query1->num_rows == 0)
            {
                echo 'No hay profesores en la aplicación';
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
         * Metodo qiue realiza la consulta para insertar un usuario con los datos qu eel usuario ha escruto en el formulario 
         * @param {String} $nombreusuario Nombre de usuario que se ha introducido por teclado 
         * @param {String} $pass Contraseña que se ha introducido por teclado 
         */
        public function anadir_profesores($cod_profesor, $nombre, $apellidos, $email, $tipo, $num)
        {
            if($num==1)
            {
                $consulta = "INSERT INTO profesores VALUES (idProfesor, '$cod_profesor', '$nombre', '$apellidos', email, '$tipo', idProfesorSustituto)"; //'s' SUSTITUTO
                $query0 = $this->conectar->query($consulta);
            }else{
                $consulta = "INSERT INTO profesores VALUES (idProfesor, '$cod_profesor', '$nombre', '$apellidos', '$email', '$tipo', idProfesorSustituto)"; //'s' SUSTITUTO
                $query0 = $this->conectar->query($consulta);
            }
            //if(isset($tipo))
            //{
                
            //}
            // else{
            //     $consulta = "INSERT INTO profesores VALUES (idProfesor, '$cod_profesor', '$nombre', '$apellidos', '$nombreusuario', '$contraseña', $tipo)"; //'t' TRABAJADOR 
            //     $query0 = $this->conectar->query($consulta);
            // }
            
        }

        public function anadir_profesores_modificado($cod_profesor, $nombre, $apellidos, $email, $tipo, $id_a_modificar)
        {
            //if(isset($tipo))
            //{
                // $consulta = "INSERT INTO profesores VALUES (idProfesor, '$cod_profesor', '$nombre', '$apellidos', '$email', '$tipo', idProfesorSustituto)"; //'s' SUSTITUTO
                $consulta = "UPDATE profesores SET cod_profesor = '$cod_profesor', nombre = '$nombre', apellidos = '$apellidos', email = '$email', tipo = $tipo, idProfesorSustituto = NULL  WHERE idProfesor = $id_a_modificar";
                $query0 = $this->conectar->query($consulta);
            //}
            // else{
            //     $consulta = "INSERT INTO profesores VALUES (idProfesor, '$cod_profesor', '$nombre', '$apellidos', '$nombreusuario', '$contraseña', $tipo)"; //'t' TRABAJADOR 
            //     $query0 = $this->conectar->query($consulta);
            // }
            
        }
        
        /**
         * Metodo qiue se encarga de realizar el delete del id que nos manda el controlador
         * @param {Integer} $id Id del usuarwio que se quieere borrar 
         */
        public function borrar_profesores($id)
        {
            $delete = "DELETE FROM profesores WHERE idProfesor = $id";
            $query2 = $this->conectar->query($delete);
        }

        public function modificar_profesor($id, $cod_profesor, $nombre, $apellidos, $email, $tipo, $id_profesor_a_sustituir, $num)
        { 
            if($num==1)
            {

                $insert = "INSERT INTO profesores VALUES (idProfesor, '$cod_profesor', '$nombre', '$apellidos', email, '$tipo', '$id_profesor_a_sustituir')";
                //$select = "SELECT idProfesor WHERE cod_profesor = $cod_profesor";
                $query1 = $this->conectar->query($insert); 

            }else{
                $insert = "INSERT INTO profesores VALUES (idProfesor, '$cod_profesor', '$nombre', '$apellidos', '$email', '$tipo', '$id_profesor_a_sustituir')";
                //$select = "SELECT idProfesor WHERE cod_profesor = $cod_profesor";
                $query1 = $this->conectar->query($insert);  
            }  
        }

        public function modificar_profesor_modificado($id, $cod_profesor, $nombre, $apellidos, $email, $tipo, $id_profesor_a_sustituir, $id_a_modificar)
        { 
            // $insert = "INSERT INTO profesores VALUES (idProfesor, '$cod_profesor', '$nombre', '$apellidos', '$email', '$tipo', '$id_profesor_a_sustituir')";
            $insert = "UPDATE profesores SET cod_profesor = '$cod_profesor', nombre = '$nombre', apellidos = '$apellidos', email = '$email', tipo = $tipo, idProfesorSustituto = $id_profesor_a_sustituir WHERE idProfesor = $id_a_modificar";
            //$select = "SELECT idProfesor WHERE cod_profesor = $cod_profesor";
            $query1 = $this->conectar->query($insert);    
        }

        public function verID($codigo_profesor)
        {
            $select = "SELECT idProfesor FROM profesores WHERE cod_profesor = '$codigo_profesor'";
            $query1 = $this->conectar->query($select);    

            $datos = mysqli_fetch_all($query1, MYSQLI_ASSOC);

            return $datos;
        }
        
        /**
         * Metodo que importa que inserta al o a los profesores en la basse de datos ESTO HAY QUE METERLO EN EL MODELO DE LSO PROFESROES 
         * @param {fyle} $profesor Archivo que se introduce en la vista 
         */
        public function importar_profesor($profesor)
        {
            $i = 0;

            //$archivo = $FILES['archivo_profesor']['tmp_name'];
            $lineas = file($profesor); 

            foreach($lineas as $linea)
            {
                //if($i!=0)
                //{
                    $datos = explode(";", $linea); 

                    $cod_profesor = !empty($datos[0]) ? ($datos[0]) : '';
                    $nombre = !empty($datos[1]) ? ($datos[1]) : '';
                    $apellidos = !empty($datos[2]) ? ($datos[2]) : ''; 
                    $email = !empty($datos[3]) ? ($datos[3]) : '';
                    $tipo = !empty($datos[4]) ? ($datos[4]) : '';
                    //$idProfesorsustituto = !empty($datos[5]) ? ($datos[5]) : ''; 

                    // $cod_profesor = $datos[0];
                    // $nombre = $datos[1];
                    // $apellidos = $datos[2]; 
                    // $email = $datos[3];
                    // $tipo = $datos[4];
                    // $idProfesorsustituto = $datos[5]; 
                    

                    $consulta = "INSERT INTO profesores (idProfesor, cod_profesor, nombre, apellidos, email, tipo, idProfesorsustituto) VALUES (idProfesor, '$cod_profesor', '$nombre', '$apellidos', '$email', '$tipo', idProfesorsustituto)"; //, '$idProfesorSustituto')"; 
                    $query = $this->conectar->query($consulta);
                //}

                //$i++;
            }

            
        }
    }
?>