<?php
    require('../controladores/c_profesores.php');
    require('../controladores/c_usuarios.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--Comprobar que este bien ESCRITO -->
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/style.css">
    <title>Document</title>
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
    <div>
        <h1>LISTA DE PROFESORES</h1>
        <?php
            $objeto_controlador = new C_profesores();
            $datos = $objeto_controlador->mover_a_consulta_profesores();

            if(!empty($datos))
            {

                if(isset($_GET['id']) && isset($_GET['nombre']))
                {
                    $nombre = $_GET['nombre'];

                    echo '<h2 class="warning_message">¿Seguro que quiere eliminar el usuario '.$nombre.'?</h2>
                    <a href="consulta_profesores.php?id1='.$_GET['id'].'"><img src="../../../diseno/assets/iconos/check-mark.png" class="imgdelete"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="consulta_profesores.php"><img src="../../../diseno/assets/iconos/x.png" class="imgdelete"></a>';
                } 


                foreach($datos as $dato)
                {
                    echo '<div class="div_profesores">FOTO '.$dato['nombre'].' '.$dato['apellidos'].'<a href="consulta_profesores.php?id='.$dato['idProfesor'].'&nombre='.$dato['nombre'].'"><img src="../../../diseno/assets/iconos/borrar.png" alt="icono de borrar" class="imgdelete"></a></div>';
                }
            }

        ?>

        <!-- ESPORTAR PROFESORES  -->
        <a href="alta_profesores.php"><button><img src="../../../diseno/assets/iconos/anadir (2).png" alt="icono de añadir" class="imgbtn"></button></a>
        <div class="div_excel">
            <h2>Exportar ausuarios desde archivos excell</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- <label>Importar profesor</label><br><br>  -->
                <input type="file" name="archivo_profesor" id="elegir_archivo"><br><br>
                <input type="submit" name="bnn_importar_profesor" id="" value="IMPORTAR"> <img src="../../../diseno/assets/iconos/excel.png" class="imgdelete">
            </form>
        </div>
        <?php
            if(isset($_POST['bnn_importar_profesor']))
            { 
                $objeto_controlador3 = new C_profesores();
                $importar = $objeto_controlador3->accion_al_importar_profesor($_FILES['archivo_profesor']['tmp_name']);
            }
        ?>
    </div>
    <!-- <a href="alta_profesores.php"><button><img src="../../../diseno/assets/iconos/anadir (2).png" alt="icono de añadir" class="imgbtn"></button></a> -->
</body>
</html>
<?php
     if(isset($_GET['id1']))
     {
        $objeto_controlador1 = new C_profesores();
        $id = $objeto_controlador1->accion_al_borrar_profesor($_GET['id1']);

        // $objeto_controlador1 = new C_usuarios();
        // $id = $objeto_controlador1->accion_al_borrar_usuario($_GET['id1']);
     }
?>