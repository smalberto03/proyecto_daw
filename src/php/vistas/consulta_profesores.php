<?php
    require('../controladores/c_profesores.php');
    require('../controladores/c_usuarios.php');

    if(!isset($_GET['pagina']))
    {
        $_GET['pagina']=1;
    }
?>
<?php
     if(isset($_GET['id1']))
     {
        $objeto_controlador1 = new C_profesores();
        $id = $objeto_controlador1->accion_al_borrar_profesor($_GET['id1']);

        // $objeto_controlador1 = new C_usuarios();
        // $id = $objeto_controlador1->accion_al_borrar_usuario($_GET['id1']);
     }
?>
<?php
    if(isset($_POST['bnn_importar_profesor']))
    { 
        $objeto_controlador3 = new C_profesores();
        $importar = $objeto_controlador3->accion_al_importar_profesor($_FILES['archivo_profesor']['tmp_name']); //$_FILES['archivo_profesor']['tmp_name']
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--Comprobar que este bien ESCRITO-->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- <title>Bootstrap demo</title> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../../css/style.css">
    <title>Document</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
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
        <h1 id="titulo_profesores">LISTA DE PROFESORES</h1>


        <?php
            $objeto_controlador = new C_profesores();
            $datos = $objeto_controlador->mover_a_consulta_profesores(1);

            if(!empty($datos))
            {

                if(isset($_GET['id']) && isset($_GET['nombre']))
                {
                    $nombre = $_GET['nombre'];

                    echo '<h2 class="warning_message">¿Seguro que quiere eliminar el usuario '.$nombre.'?</h2>
                    <a href="consulta_profesores.php?id1='.$_GET['id'].'"><img src="../../../diseno/assets/iconos/check-mark.png" class="imgdelete"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="consulta_profesores.php"><img src="../../../diseno/assets/iconos/x.png" class="imgdelete"></a>';
                }
                
                $articulos_por_pestaña = 5;

                $articulos = count($datos);

                $pestañas = $articulos/$articulos_por_pestaña;
                $pestañas = ceil($pestañas);

                // echo $pestañas;
                // var_dump($datos);

                $iniciar = ($_GET['pagina']-1)*$articulos_por_pestaña;






                //  ESTO HAY QUE HACERLO CON PROGRMACION ORIENTADA A OBJETOS

                $mysqli = new mysqli('localhost', 'root', '','proyecto_daw_def');


                $sql_filas_concretas = "SELECT idProfesor, nombre, apellidos, tipo FROM profesores LIMIT $iniciar,$articulos_por_pestaña";

                $query = $mysqli->query($sql_filas_concretas);
                //$query = $this->conectar->query($sql_filas_concretas);


                $datos_nuevos = mysqli_fetch_all($query, MYSQLI_ASSOC);


                foreach($datos_nuevos as $dato)
                {



                    echo '<div class="alert alert-primary p-4" role="alert" >FOTO '.$dato['nombre'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$dato['apellidos'].'';



                    // echo '<div class="lista_profesores">FOTO '.$dato['nombre'].' '.$dato['apellidos'].'';
                    
                    if($dato['tipo']==1)
                    {
                        echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" checked>&nbsp;&nbsp;';
                    }
                    else{

                        echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox">&nbsp;&nbsp;';
                    }
                    
                    echo'<a href="modificar_profesores.php?id='.$dato['idProfesor'].'"><img src="../../../diseno/assets/iconos/boligrafo.png" alt="icono de editar" class="imgdelete"></a>&nbsp;&nbsp;';
                    echo'<a href="consulta_profesores.php?id='.$dato['idProfesor'].'&nombre='.$dato['nombre'].'">';
                    echo'<img src="../../../diseno/assets/iconos/borrar.png" alt="icono de borrar" class="imgdelete"></a></div>';
                }
            }

        ?>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="consulta_profesores.php?pagina=<?php  if($_GET['pagina']==1){echo 0;}else{echo $_GET['pagina']-1;}  ?>">Anterior</a></li>

                <?php
                    for($i=0; $i<$pestañas; $i++)
                    {
                        if($_GET['pagina']==$i+1)
                        {
                            echo'<li class="page-item active"><a class="page-link" href="consulta_profesores.php?pagina='.($i + 1).'">'.($i + 1).'</a></li>';
                        }
                        else{
                            echo'<li class="page-item"><a class="page-link" href="consulta_profesores.php?pagina='.($i + 1).'">'.($i + 1).'</a></li>';
                        }
                       
                    }
                   
                ?>

                <li class="page-item"><a class="page-link" href="consulta_profesores.php?pagina=<?php  echo $_GET['pagina']+1;  ?>">Siguiente</a></li>
            </ul>
        </nav>

        <!-- ESPORTAR PROFESORES  -->
        <a href="alta_profesores.php"><button><img src="../../../diseno/assets/iconos/anadir (2).png" alt="icono de añadir" class="imgbtn"></button></a>
        <div class="div_excel">
            <h2>Importar ausuarios desde archivos excell</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="archivo_profesor" id="elegir_archivo"><br><br>
                <input type="submit" name="bnn_importar_profesor" id="" value="IMPORTAR"> <img src="../../../diseno/assets/iconos/excel.png" class="imgdelete">
            </form>
        </div>
        
    </div>
    <!-- <a href="alta_profesores.php"><button><img src="../../../diseno/assets/iconos/anadir (2).png" alt="icono de añadir" class="imgbtn"></button></a> -->
</body>
</html>
