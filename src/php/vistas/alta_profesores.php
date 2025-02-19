<?php
    require_once('../controladores/c_profesores.php');
?>
<?php

    // //if(isset($_POST['btn_anadir_usuario2']))    
    // //{
    //     if(isset($_POST['tipo2']))
    //     {
    //         echo'Hola';
    //     }
    //     else{
    //         echo'Hola2';
    //     }
    // //}

    if(isset($_POST['btn_anadir_usuario']))
    {
        if(isset($_POST['tipo']))
        {
            //INSERTAMOS EL PROFESOR
            //$objeto_controlador = new C_profesores();
            //$metodo_controlador = $objeto_controlador->mover_a_alta_profesores($_POST['cod_profesor'], $_POST['nombre'], $_POST['apellidos'], $_POST['email'], 1);

            if(!isset($_POST['profesor']))
            {
                echo'Has pulsado el check pero no has elegido el profesor al que tiene que sustituir<br>
                Si quieres añadir un profesor sustituto debes aceptar el check y seleccionar un profesor';
            }
            else{

                //MODIFICAMOS EL HORARIO DEL PROFESOR
                $objeto_controlador4 = new C_profesores();
                $metodo_controlador = $objeto_controlador4->verID($_POST['cod_profesor']);

                foreach($metodo_controlador as $dato)
                {
                    $id = $dato['idProfesor'];
                }
            
                // if(isset($id))
                // {
                    $objeto_controlador3 = new C_profesores();
                    $metodo_controlador = $objeto_controlador3->mover_a_alta_profesores_sustituto($id, $_POST['cod_profesor'], $_POST['nombre'], $_POST['apellidos'], $_POST['email'], 1, $_REQUEST['profesor']);
                // }
            }

            
        }
        else{
            $objeto_controlador = new C_profesores();
            $metodo_controlador = $objeto_controlador->mover_a_alta_profesores($_POST['cod_profesor'], $_POST['nombre'], $_POST['apellidos'], $_POST['email'], 0);
        }
        
    }
    else{
        // if(isset($_POST['tipo']))
        // {
        //     echo'Hola';
        //     //$objeto_controlador = new C_profesores();
        //    // $metodo_controlador = $objeto_controlador->mover_a_alta_profesores($_POST['cod_profesor'], $_POST['nombre'], $_POST['apellidos'], $_POST['nombre_usuario'], $_POST['pass'], 1);
        // }
        //echo'hola';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/style.css">
    <title>INICIO</title>
</head>
<body>
    <div class="nav">
        <div>
        <img src="../../../diseno/assets/logotipo.png" alt="Logo de la escula" id="logo">
        </div>
        <div class="titulo">ESCUELA VIRGEN DE GUADALUPE</div>
    </div>
    <div class="nav2">
        <div>
            Gestionar usuarios 
        </div>
        <div class="liespecial">
            Profesores
        </div>
        <div>
            Gestión horario 
        </div>
        <div>
            Horas especiales
        </div>
    </div>
    <div class="anadirusuarios">
        <h1 id="tituloform">AÑADIR NUEVO PROFESOR</h1>

        <!-- <input type="checkbox" id="check" value="Chequeado"> -->
        <!-- <form action="" method="POST"> -->
            <!-- <label class="label_anadirusuarios">¿Es un profesor sustituto?</label><input type="submit" class="input_anadirusuarios" name="tipo2" method="POST"><br><br><br>  -->
            <!-- <input type="submit" value="CANCELAR" class="btncancelar1"><input type="submit" value="AÑADIR" class="btnaceptar1" name="btn_anadir_usuario2"> -->
        <!-- </form> -->
        <?php

            if(!empty($metodo_controlador))
            {
                echo '<span class="mensaje_validacion">'.$metodo_controlador.'</span>';
                echo'<br><br>';
            }
        ?>

        
        <form action="" method="POST">
            <label class="label_anadirusuarios">Código del profesor </label><input type="text" class="input_anadirusuarios" name="cod_profesor" placeholder="3 caracteres (Requerido)"><br><br><br>
            <label class="label_anadirusuarios">Nombre </label><input type="text" class="input_anadirusuarios" name="nombre" placeholder="Requerido"><br><br><br>
            <label class="label_anadirusuarios">Apellidos </label><input type="text" class="input_anadirusuarios" name="apellidos" placeholder="Requerido"><br><br><br>
            <label class="label_anadirusuarios">Email </label><input type="text" class="input_anadirusuarios" name="email" placeholder="Debe tener formato email (Puede no rellenarse)"><br><br><br>
            <!-- <label class="label_anadirusuarios">Contraseña </label><input type="password" class="input_anadirusuarios" name="pass"><br><br><br> -->
            <label class="label_anadirusuarios">¿Es un profesor sustituto?</label><input type="checkbox" class="input_anadirusuarios" name="tipo"><br><br><br> 
            
            <?php
                //RADIO BUTTON PARA PROFESOR SUSTITUTO
                $objeto_controlador2 = new C_profesores();
                $datos = $objeto_controlador2->mover_a_consulta_profesores(2);


                if(!empty($datos))
                {
                    //$contador = 0;
                    
                    foreach($datos as $dato)
                    {
                        echo'<input type="radio" name="profesor" value="'.$dato['idProfesor'].'"> <label>'.$dato['nombre'].' '.$dato['apellidos'].'<br>';
                        //$contador++;
                    }

                }else{
                    //echo'No hay profesores';
                }
            
            ?>
            <input type="submit" value="CANCELAR" class="btncancelar1"><input type="submit" value="AÑADIR" class="btnaceptar1" name="btn_anadir_usuario">
        </form>

        

    </div>

    <!-- <script type="text/javascript">
        $(function(){

            $("#check").on('change', function() {
    
                if( $(this).is(':checked') ){

                    console.log(2);
                    //$("#res").html( $(this).val() );

                }else{

                    //$("#res").html( "No Chequeado" );
                }
            });
        })
    </script>  -->



    



</body>
</html>


<!-- <form action="" method="POST">
            <label>Nombre usuario </label><input type="text" name="nombre_usuario"><br><br>
            <label>Pass </label> <input type="text" name="pass"><br><br>
            <input type="submit" name="btn_anadir_usuario">
        </form> -->