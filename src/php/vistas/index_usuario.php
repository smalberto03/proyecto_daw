<?php
    require_once '../config/config.php';

    if (isset($_SESSION['user_token'])) 
    { 
        header("Location: index_def_usuario.php"); 

    }else {

        echo "<a href='" . $client->createAuthUrl() . "'>Google Login</a>";
    }
?>