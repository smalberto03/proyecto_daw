<?php
// src/views/inicio_sesion/tablero.php

//session_start(); // Asegúrate de iniciar la sesión

if (!isset($_SESSION['usuario'])) {
    header('Location: inicio_sesion.php');
    exit();
}else{
    echo"HOLA";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tablero</title>
</head>
<body>
    <h1>Bienvenido al Tablero, <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></h1>
    <a href="ControladorTablero.php?action=otraVista">Ir a Otra Vista</a>
    <a href="ControladorAutenticacion.php?action=cerrarSesion">Cerrar sesión</a>
</body>
</html>
