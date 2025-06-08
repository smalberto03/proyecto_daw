<?php

    require_once('../modelos/m_usuarios.php');

    /**
     * Controlador de los usuarios. Desde aquí se puede gestionar todo lo relacionado
     * con los usuarios y su CRUD
     */
    class C_usuarios{

        /**
         * Método que trae los datos del modelo y los envía la vista correpondiente
         * @param {String} $nombreusuario Nombre de usuario que se ha introducido por teclado 
         * @param {String} $nombrcontraseña Contraseña que se ha introducido por teclado 
         */
        public function mover_a_alta_usuarios($nombreusuario, $contraseña)
        {
            if(empty($nombreusuario) || empty($contraseña))
            {
                echo 'Debes rellenar todos los campos<br>';
            }
            else{

                $objeto_modelo = new M_usuarios();
                //$metodo = $objeto_modelo->anadir_usuario($_POST['nombre_usuario'], $_POST['pass']);
                $metodo = $objeto_modelo->anadir_usuario($nombreusuario, $contraseña);

                header('Location: ../vistas/consulta_usuarios.php');

            }
        }

        /**
         * Metodo que recoge las filas del modelo y las manda a la vista
         * @return {array} Devuelve un array con los datos de los usuarios qie estan en la base de datos 
         */
        public function mover_a_consulta_usuarios()
        {
            $datos;

            $objeto_modelo = new M_usuarios(); //Instaciamos la clase 
            $datos = $objeto_modelo->ver_usuarios();//Con el objeto realizamos el metodo. Ahora en $table tenemos el array que devuelbe el metodo del modelo
            
            return $datos;
        }


        /**
         * Metodo que manda el id del usuario que se quiere borrar al modelo y al devolver vulve a la vista 
         * @param {Integer} $id Idi del usuario que se quiere eliminar 
         */
        public function accion_al_borrar_usuario($id)
        {
            
            $objeto_modelo = new M_usuarios();
            $borrar = $objeto_modelo->borrar_usuarios($id);

            header('Location: ../vistas/consulta_usuarios.php');
            
        }


        /**
         * Comprueba si el usuario es administrador
         *
         * @param [Integer] $id
         * @return void
         */
        public function accion_comprobar_admins($id)
        {
            $object_model = new M_usuarios();
            $respuesta = $object_model->comprobar_admin($id);

            return $respuesta;
        }

        /**
         * Undocumented function
         *
         * @param [type] $check
         * @param [type] $dato
         * @return void
         */
        public function modificar_check($check, $dato)
        {
            if($check == 1)
            {
                $objeto_modelo = new M_usuarios();
                $objeto_modelo->anadir_admin($dato);
            }
            else{
                $objeto_modelo = new M_usuarios();
                $objeto_modelo->quitar_admin($dato);
            }
        }
    }
?>