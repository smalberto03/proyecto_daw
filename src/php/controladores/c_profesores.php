<?php

    require_once('../modelos/m_profesores.php');

    /**
     * Controlador de los ptofresores. Desde aquí se puede gestionar todo lo relacionado
     * con los profesores y su CRUD
     */
    class C_profesores{


        public function mover_a_consulta_profesores()
        {
            $datos;

            $objeto_modelo = new M_profesores(); //Instaciamos la clase 
            $datos = $objeto_modelo->ver_profesores();//Con el objeto realizamos el metodo. Ahora en $table tenemos el array que devuelbe el metodo del modelo
            
            return $datos;

        }

        /**
         * Método que trae los datos del modelo y los envía la vista correpondiente
         * @param {String} $nombreusuario Nombre de usuario que se ha introducido por teclado 
         * @param {String} $nombrcontraseña Contraseña que se ha introducido por teclado 
         */
        public function mover_a_alta_profesores($cod_profesor, $nombre, $apellidos, $nombreusuario, $contraseña, $tipo)
        {
            if(empty($cod_profesor) || empty($nombre) || empty($apellidos) || empty($nombreusuario) || empty($contraseña) || empty($tipo))
            {
                echo '<span class="empty">¡DEBES RELLENAR TODOS LOS CAMPOS!</span><br>';
            }
            else{

                $objeto_modelo = new M_profesores();
                //$metodo = $objeto_modelo->anadir_usuario($_POST['nombre_usuario'], $_POST['pass']);
                $metodo = $objeto_modelo->anadir_profesores($cod_profesor, $nombre, $apellidos, $nombreusuario, $contraseña, $tipo);

                header('Location: ../vistas/consulta_profesores.php');

            }
        }
        
        
        public function accion_al_borrar_profesor($id)
        { 
            $objeto_modelo = new M_profesores(); 
            $borrar = $objeto_modelo->borrar_profesores($id);

            header('Location: ../vistas/consulta_profesores.php');           
        }
        
        public function accion_al_importar_profesor($profesor) //ESTO HAY QUE MOVERLO AL CONTROLADOR DE LOS PROFESORES 
        {
            
            $objeto_modelo = new M_profesores();
            $importacion = $objeto_modelo->importar_profesor($profesor);

            header('Location: ../vistas/consulta_profesores.php');

            echo $importacion;             
        }
        

    }

?>