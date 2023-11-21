<?php

    
    require_once('../config/configdb.php');
    require('../../../vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\IOFactory;
    

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
         * Metodo que importa que inserta al o a los profesores en la basse de datos 
         * @param {fyle} $profesor Archivo que se introduce en la vista 
         */
        public function importar_profesor($profesor)
        {


            //$archivo = '../../../vendor/Libro3.xlsx';
            $archivo = $profesor;
            $documento = IOFactory::load($archivo);

            $hoja = $documento->getSheet(0);

            $numeroFilas = $hoja->getHighestDataRow();
            $numeroColumnas = $hoja->getHighestColumn();

            

            for($indiceFila = 1; $indiceFila <= $numeroFilas; $indiceFila++)
            {
                
                $campo1 = $hoja->getCellByColumnAndRow(1,$indiceFila);
                $campo2 = $hoja->getCellByColumnAndRow(2,$indiceFila);
                $campo3 = $hoja->getCellByColumnAndRow(3,$indiceFila);
                $campo4 = $hoja->getCellByColumnAndRow(4,$indiceFila);
                $campo5 = $hoja->getCellByColumnAndRow(5,$indiceFila);
                $campo6 = $hoja->getCellByColumnAndRow(6,$indiceFila);
                $campo7 = $hoja->getCellByColumnAndRow(7,$indiceFila);
                $campo8 = $hoja->getCellByColumnAndRow(8,$indiceFila);
                $campo9 = $hoja->getCellByColumnAndRow(9,$indiceFila);

                $insertexcel = "INSERT INTO users VALUES (id, '$campo1', '$campo2', '$campo3', '$campo4', '$campo5', '$campo6', '$campo7', '$campo8', '$campo9')";
                $query3 = $this->conectar->query($insertexcel);

            }


            return 'Añadido con exito';
            
                
        }

        public function comprobar_admin($id)
        {
            $consulta = "SELECT es_admin FROM users WHERE id = $id";
            $query4 = $this->conectar->query($consulta);

            $datos = mysqli_fetch_array($query4);
            return $datos;
        }
    }
?>