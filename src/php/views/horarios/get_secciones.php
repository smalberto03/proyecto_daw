<?php
    require_once __DIR__ . '/../../controllers/HorarioController.php';

    session_start();

    if (!isset($_SESSION['usuario'])) {
        header('Location: views/inicio_sesion/inicio_sesion.php');
        //exit();
    }

    $controller = new HorarioController();
    $secciones = $controller->obtenerSecciones();

    header('Content-Type: application/json');
    echo json_encode($secciones);
?>