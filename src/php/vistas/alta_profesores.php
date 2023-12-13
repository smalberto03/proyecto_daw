<?php
    require_once('../controladores/c_profesores.php');
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
        <h1 id="tituloform">AÑADIR NUEVO USUARIO</h1>
        <?php
            if(isset($_POST['btn_anadir_usuario']))
            {
                $objeto_controlador = new C_profesores();
                $metodo_controlador = $objeto_controlador->mover_a_alta_profesores($_POST['cod_profesor'], $_POST['nombre'], $_POST['apellidos'], $_POST['nombre_usuario'], $_POST['pass'], $_POST['tipo']);
            }
        ?>
        <form action="" method="POST">
            <label class="label_anadirusuarios">Códiog del profesor </label><input type="text" class="input_anadirusuarios" name="cod_profesor"><br><br><br>
            <label class="label_anadirusuarios">Nombre </label><input type="text" class="input_anadirusuarios" name="nombre"><br><br><br>
            <label class="label_anadirusuarios">Apellidos </label><input type="text" class="input_anadirusuarios" name="apellidos"><br><br><br>
            <label class="label_anadirusuarios">Nombre de usuario </label><input type="text" class="input_anadirusuarios" name="nombre_usuario"><br><br><br>
            <label class="label_anadirusuarios">Contraseña </label><input type="password" class="input_anadirusuarios" name="pass"><br><br><br>
            <label class="label_anadirusuarios">¿Es un profesor sustituto?</label><input type="checkbox" class="input_anadirusuarios" name="tipo"><br><br><br>  
            <input type="submit" value="CANCELAR" class="btncancelar1"><input type="submit" value="AÑADIR" class="btnaceptar1" name="btn_anadir_usuario">
        </form>
    </div>
</body>
</html>


<!-- <form action="" method="POST">
            <label>Nombre usuario </label><input type="text" name="nombre_usuario"><br><br>
            <label>Pass </label> <input type="text" name="pass"><br><br>
            <input type="submit" name="btn_anadir_usuario">
        </form> -->