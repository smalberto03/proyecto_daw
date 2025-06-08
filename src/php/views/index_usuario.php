<?php
    require_once '../config/config.php';
    // require_once 'index_def_usuario.php';  
    // requiere('index_def_usuario.php');  
?>
<?php
    //require_once '../config/config.php';

    session_start(); 

    if(isset($_SESSION['user_token'])) 
    { 
        //echo 'hola esoy aqui';  
        header("Location: index_def_usuario.php");
             
    }else{
        
        echo '<div id="div_login"><a href="' . $client->createAuthUrl() . '">Iniciar sesión con Google &nbsp; &nbsp;  <img src="../../../diseno/assets/iconos/search.png"></a></div>'; 
        // echo '<a href="' . $client->createAuthUrl() . '">Iniciar sesión </a>';    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="nav">
        <div>
            <img src="../../../diseno/assets/logotipo.png" alt="Logo de la escula" id="logo">
        </div>
        <div class="titulo">ESCUELA VIRGEN DE GUADALUPE</div>
    </div>
    <h1 id="presentacion">GESTIÓN Y VISUALIZACIÓN DE HORARIOS EVG</h1><br><br>
</body>
</html>

