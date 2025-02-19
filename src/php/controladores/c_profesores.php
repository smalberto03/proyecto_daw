<?php

    require_once('../modelos/m_profesores.php');

    /**
     * Controlador de los ptofresores. Desde aquí se puede gestionar todo lo relacionado
     * con los profesores y su CRUD
     */
    class C_profesores{


        /**
         * Recibe las filas del modelo y mandamos esos datos a la vista correspondiente
         *
         * @return $datos
         */
        public function mover_a_consulta_profesores($numero)
        {
            $datos;

            if($numero==1)
            {
                $objeto_modelo = new M_profesores(); //Instaciamos la clase 
                $datos = $objeto_modelo->ver_profesores();//Con el objeto realizamos el metodo. Ahora en $table tenemos el array que devuelbe el metodo del modelo
            }
            elseif($numero==2)
            {
                $objeto_modelo = new M_profesores(); //Instaciamos la clase 
                $datos = $objeto_modelo->ver_profesores_titulares();//Con el objeto realizamos el metodo. Ahora en $table tenemos el array que devuelbe el metodo del modelo
            }

            
            return $datos;

        }

        /**
         * Método que trae los datos del modelo y los envía la vista correpondiente
         * @param {String} $nombreusuario Nombre de usuario que se ha introducido por teclado 
         * @param {String} $nombrcontraseña Contraseña que se ha introducido por teclado 
         */
        public function mover_a_alta_profesores($cod_profesor, $nombre, $apellidos, $email, $tipo)
        {
            if(empty($cod_profesor) || empty($nombre) || empty($apellidos))// || empty($tipo))
            {
                echo '<span class="empty">¡DEBES RELLENAR TODOS LOS CAMPOS!</span><br>';
            }     
            else{
      
                $cod_profesor = strtoupper($cod_profesor);

                if(empty($email))
                {
                    $objeto_modelo = new M_profesores();
                    //$metodo = $objeto_modelo->anadir_usuario($_POST['nombre_usuario'], $_POST['pass']);
                    $metodo = $objeto_modelo->anadir_profesores($cod_profesor, $nombre, $apellidos, $email, $tipo, 1);

                    header('Location: ../vistas/consulta_profesores.php');
                }
                else{

                    if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($cod_profesor) != 3)
                    {
                        //echo'El email debe tener un formato correcto';
                        $mensaje_error = "No has añadido con el formato correcto o el email o el codigo del profesor.";
                        return $mensaje_error;

                    }else{

                        $objeto_modelo = new M_profesores();
                        //$metodo = $objeto_modelo->anadir_usuario($_POST['nombre_usuario'], $_POST['pass']);
                        $metodo = $objeto_modelo->anadir_profesores($cod_profesor, $nombre, $apellidos, $email, $tipo, 2);

                        header('Location: ../vistas/consulta_profesores.php');
                    }
                }
                
                
            }
        }

        public function mover_a_alta_profesores_modificado($cod_profesor, $nombre, $apellidos, $email, $tipo, $id_a_modificar)
        {
            if(empty($cod_profesor) || empty($nombre) || empty($apellidos))// || empty($tipo))
            {
                echo '<span class="empty">¡DEBES RELLENAR TODOS LOS CAMPOS!</span><br>';
            }     
            else{
      
                $cod_profesor = strtoupper($cod_profesor);

                if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($cod_profesor) != 3)
                {
                    //echo'El email debe tener un formato correcto';
                    $mensaje_error = "No has añadido con el formato correcto o el email o el codigo del profesor.";
                    return $mensaje_error;

                }else{

                    $objeto_modelo = new M_profesores();
                    //$metodo = $objeto_modelo->anadir_usuario($_POST['nombre_usuario'], $_POST['pass']);
                    $metodo = $objeto_modelo->anadir_profesores_modificado($cod_profesor, $nombre, $apellidos, $email, $tipo, $id_a_modificar);

                    header('Location: ../vistas/consulta_profesores.php');
                }
                
            }
        }

        public function mover_a_alta_profesores_sustituto($id, $cod_profesor, $nombre, $apellidos, $email, $tipo, $id_profesor_a_sustituir)
        {
            if(empty($cod_profesor) || empty($nombre) || empty($apellidos))// || empty($tipo))
            {
                echo '<span class="empty">¡DEBES RELLENAR TODOS LOS CAMPOS!</span><br>';
            }
            else{

                if(empty($email))
                {
                    $objeto_modelo = new M_profesores();
                    //$metodo = $objeto_modelo->anadir_usuario($_POST['nombre_usuario'], $_POST['pass']);
                    $metodo = $objeto_modelo->modificar_profesor($id, $cod_profesor, $nombre, $apellidos, $email, $tipo, $id_profesor_a_sustituir, 1);

                    header('Location: ../vistas/consulta_profesores.php');
                }
                else{

                    if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($cod_profesor) != 3)
                    {
                        $mensaje_error = "No has añadido con el formato correcto o el email o el codigo del profesor.";
                        return $mensaje_error;

                    }else{

                        $objeto_modelo = new M_profesores();
                        //$metodo = $objeto_modelo->anadir_usuario($_POST['nombre_usuario'], $_POST['pass']);
                        $metodo = $objeto_modelo->modificar_profesor($id, $cod_profesor, $nombre, $apellidos, $email, $tipo, $id_profesor_a_sustituir, 2);
                    
                        header('Location: ../vistas/consulta_profesores.php');
                    }
                }

                
            }
            
        }

        public function mover_a_alta_profesores_sustituto_modificado($id, $cod_profesor, $nombre, $apellidos, $email, $tipo, $id_profesor_a_sustituir, $id_a_modificar)
        {
            if(empty($cod_profesor) || empty($nombre) || empty($apellidos))// || empty($tipo))
            {
                echo '<span class="empty">¡DEBES RELLENAR TODOS LOS CAMPOS!</span><br>';
            }
            else{

                if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($cod_profesor) != 3)
                {
                    $mensaje_error = "No has añadido con el formato correcto o el email o el codigo del profesor.";
                    return $mensaje_error;

                }else{

                    $objeto_modelo = new M_profesores();
                    //$metodo = $objeto_modelo->anadir_usuario($_POST['nombre_usuario'], $_POST['pass']);
                    $metodo = $objeto_modelo->modificar_profesor_modificado($id, $cod_profesor, $nombre, $apellidos, $email, $tipo, $id_profesor_a_sustituir, $id_a_modificar);
                
                    header('Location: ../vistas/consulta_profesores.php');
                }
            }
            
        }
        
        
        /**
         * LLama al metodo del modelo que borra la fila de un profesor y manda al usuario a la casilla correspondiente 
         *
         * @param [Integer] $id  
         * @return void
         */
        public function accion_al_borrar_profesor($id)
        { 
            $objeto_modelo = new M_profesores(); 
            $borrar = $objeto_modelo->borrar_profesores($id);

            header('Location: ../vistas/consulta_profesores.php');           
        }


        public function accion_al_modificar_profesor($id_a_modificar)
        {
            $objeto_modelo = new M_profesores(); 
            $fila = $objeto_modelo->obtener_datos_profesor_a_modificar($id_a_modificar);

            return $fila;

            // header('Location: ../vistas/consulta_profesores.php');
        }

        
        /**
         * Se llama al modelo para impoertar a un profesor y se devuelve al usuario a la vista 
         * de consultar profesores 
         * @param [Object] $profesor
         * @return void
         */
        public function accion_al_importar_profesor($profesor) //ESTO HAY QUE MOVERLO AL CONTROLADOR DE LOS PROFESORES 
        {
            
            $objeto_modelo = new M_profesores();
            $importacion = $objeto_modelo->importar_profesor($profesor);

            //header('Location: ../vistas/consulta_profesores.php');

            //echo $importacion;             
        }


        public function verID($codigo_profesor)
        {
            $id;

            $objeto_modelo = new M_profesores();
            $id = $objeto_modelo->verId($codigo_profesor);

            return $id;
        }
        

    }

?>