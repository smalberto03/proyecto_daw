<?php
    require_once('../controladores/c_profesores.php');

    $id_a_modificar = $_GET['id']; //Dato que traemos al pulsar en el icono de editar 

    // echo $id_a_modificar;

    $objeto_controlador1 = new C_profesores();
    $datos_profesor_a_sustituir = $objeto_controlador1->accion_al_modificar_profesor($id_a_modificar);

?>
<?php
    if(isset($_POST['btn_anadir_usuario']))
    {
        if(isset($_POST['tipo']))//MODIFICAR PROFESOR SUSTITUTO
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
            

                $objeto_controlador3 = new C_profesores();
                $metodo_controlador = $objeto_controlador3->mover_a_alta_profesores_sustituto_modificado($id, $_POST['cod_profesor'], $_POST['nombre'], $_POST['apellidos'], $_POST['email'], 1, $_REQUEST['profesor'], $id_a_modificar);

            }

            
        }
        else{
            $objeto_controlador = new C_profesores();
            $metodo_controlador = $objeto_controlador->mover_a_alta_profesores_modificado($_POST['cod_profesor'], $_POST['nombre'], $_POST['apellidos'], $_POST['email'], 0, $id_a_modificar);
        }
        
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
        <h1 id="tituloform">MODIFICAR PROFESOR</h1>
      
        <form action="" method="POST">
            <label class="label_anadirusuarios">Código del profesor </label><input type="text" class="input_anadirusuarios" name="cod_profesor" value="<?php foreach($datos_profesor_a_sustituir as $dato){echo $dato['cod_profesor'];}?>"><br><br><br>
            <label class="label_anadirusuarios">Nombre </label><input type="text" class="input_anadirusuarios" name="nombre" value="<?php foreach($datos_profesor_a_sustituir as $dato){echo $dato['nombre'];}?>"><br><br><br>
            <label class="label_anadirusuarios">Apellidos </label><input type="text" class="input_anadirusuarios" name="apellidos" value="<?php foreach($datos_profesor_a_sustituir as $dato){echo $dato['apellidos'];}?>"><br><br><br>
            <label class="label_anadirusuarios">Email </label><input type="text" class="input_anadirusuarios" name="email" value="<?php foreach($datos_profesor_a_sustituir as $dato){echo $dato['email'];}?>"><br><br><br>
            <!-- <label class="label_anadirusuarios">Contraseña </label><input type="password" class="input_anadirusuarios" name="pass"><br><br><br> -->
            <label class="label_anadirusuarios">¿Es un profesor sustituto?</label><input type="checkbox" class="input_anadirusuarios" name="tipo" <?php foreach($datos_profesor_a_sustituir as $dato){if($dato['tipo']==0){echo 'unchecked';}else{echo 'checked';}} ?>><br><br><br>                
            
        
            <?php
                //RADIO BUTTON PARA PROFESOR SUSTITUTO
                $objeto_controlador2 = new C_profesores();
                $datos = $objeto_controlador2->mover_a_consulta_profesores(2);


                if(!empty($datos))
                {
                    //$contador = 0;
                    
                    foreach($datos as $dato)
                    {
                        if($dato['idProfesor']!=$id_a_modificar)
                        {
                            echo'<input type="radio" name="profesor" value="'.$dato['idProfesor'].'"> <label>'.$dato['nombre'].' '.$dato['apellidos'].'<br>';
                            //$contador++;
                        }
                        
                    }

                }else{
                    //echo'No hay profesores';
                }
            
            ?>

            <input type="submit" value="CANCELAR" class="btncancelar1"><input type="submit" value="MODIFICAR" class="btnaceptar1" name="btn_anadir_usuario">
        
        </form>
    </div>
</body>