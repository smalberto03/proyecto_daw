<?php
    require_once('../controladores/c_usuarios.php');
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
            <img src="../../assets/logotipo.png" alt="Logo de la escula" id="logo">
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
    <div class="anadirusuarios">
        <h1 id="tituloform">AÑADIR NUEVO USUARIO</h1>
        <form action="" method="POST">
            <label class="label_anadirusuarios">Nombre de usuario </label><input type="text" class="input_anadirusuarios" name="nombre_usuario"><br><br><br>
            <label class="label_anadirusuarios">Contraseña </label><input type="password" class="input_anadirusuarios" name="pass"><br><br><br>
            <?php
                if(isset($_POST['btn_anadir_usuario']))
                {
                    $objeto_controlador = new C_usuarios();
                    $metodo_controlador = $objeto_controlador->mover_a_alta_usuarios($_POST['nombre_usuario'], $_POST['pass']);
                }
            ?>
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