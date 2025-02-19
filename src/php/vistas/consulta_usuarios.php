<?php
    require('../controladores/c_usuarios.php');
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
        <div class="liespecial">
            Gestionar usuarios 
        </div>
        <div>
            Profesores
        </div>
        <div>
            Gestión horario 
        </div>
        <div>
            Horas especiales
        </div>
    </div>
    <!-- <div class="thead"> -->
        <h1 id="users">Usuarios de la aplicación</h1>
    <!-- </div> -->
    <div class="tabla_usuarios">
        <?php
            $objeto_controlador = new C_usuarios();
            $datos = $objeto_controlador->mover_a_consulta_usuarios();

            if(!empty($datos))                 
            {

                if(isset($_GET['id']) && isset($_GET['nombreusuario']))
                {
                    $nombreusuario = $_GET['nombreusuario'];

                    echo '<h2 class="warning_message">¿Seguro que quiere eliminar el usuario '.$nombreusuario.'?</h2>
                    <a href="consulta_usuarios.php?id1='.$_GET['id'].'"><img src="../../../diseno/assets/iconos/check-mark.png" class="imgdelete"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="consulta_usuarios.php"><img src="../../../diseno/assets/iconos/x.png" class="imgdelete"></a>';
                } 
                  
                
                echo '<table class="tabla_usuarios">';

                foreach($datos as $dato)
                {
                    echo'
                        <tr>  
                            <td>'.$dato['first_name'].'</td>
                            <td>'.$dato['last_name'].'</td> 
                            <td><a href="consulta_usuarios.php?id='.$dato['id'].'&nombreusuario='.$dato['first_name'].'"><img src="../../../diseno/assets/iconos/borrar.png" alt="icono de borrar" class="imgdelete"></a></td>';
                        
                        $object_controlador = new C_usuarios();
                        $admin = $object_controlador->accion_comprobar_admins($dato['id']);
                        //echo'<td>'.$admin.'</td></tr>';
                        //var_dump($admin['es_admin']);
                        if($admin['es_admin'] == 1)
                        {
                            echo '<td><form  method="POST"><input type="checkbox" name="es_admin" checked> Admin</form></td> </tr>'; 
                            //echo '<td>'.$dato['es_admin'].'</td>';
                            //var_dump($admin['es_admin']); 
                        }
                        else{ 
                            echo '<td><form  method="POST"><input type="checkbox" name="es_admin"> Admin</form></td> </tr>'; 
                            //echo '<td>'.$dato['es_admin'].'</td>';
                            //var_dump($admin['es_admin']);                         
                        }    
                        
                        $objeto_del_controlador = new C_usuarios();
                        $objeto_del_controlador->modificar_check($admin['es_admin'], $dato['es_admin']); 
                }
                echo '</table>';    
                
                // if(isset($_GET['id']) && isset($_GET['nombreusuario']))
                // {
                //     $nombreusuario = $_GET['nombreusuario'];

                //     echo '<h1>¿Seguro que quiere eliminar el usuario '.$nombreusuario.'?</h1>
                //     <a href="consulta_usuarios.php?id1='.$_GET['id'].'">SÍ</a>
                //     <a href="consulta_usuarios.php">NO</a>';
                // }

                if(isset($_GET['id1']))
                {

                    // $objeto_controlador0 = new C_usuarios();
                    // $confirmacion = $objeto_controlador0->confirmar_borrado_usuario();

                    $objeto_controlador1 = new C_usuarios();
                    $id = $objeto_controlador1->accion_al_borrar_usuario($_GET['id1']);
                }
            }

            //if(isset($_POST['es_admin']))
            //{
                
            //}
        ?>
    </div><br><br>









    <!--<div class="div_excel">
        <h2>Exportar ausuarios desde archivos excell</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Importar profesor</label><br><br> 
            <input type="file" name="archivo_profesor" id="elegir_archivo"><br><br>
            <input type="submit" name="bnn_importar_profesor" id="" value="IMPORTAR"> <img src="../../../diseno/assets/iconos/excel.png" class="imgdelete">
        </form>
    </div>-->
    <?php
        // if(isset($_POST['bnn_importar_profesor']))
        // { 
        //     $objeto_controlador3 = new C_usuarios();
        //     $importar = $objeto_controlador3->accion_al_importar_profesor($_FILES['archivo_profesor']['tmp_name']);
        // }
    ?>








    <!-- <table class="tabla_usuarios">
        <tr>
            <td>Antonio Perez Gomez</td>
            <td>antonio@evg.es</td>
        </tr>
        <tr>
            <td>Antonio Perez Gomez</td>
            <td>antonio@evg.es</td> 
        </tr>
        <tr>
            <td>Antonio Perez Gomez</td>
            <td>antonio@evg.es</td>
        </tr>
    </table> -->
    <!-- <a href="alta_usuarios.php"><button><img src="../../../diseno/assets/iconos/anadir (2).png" alt="icono de añadir" class="imgbtn"></button></a> -->
</body>
</html>