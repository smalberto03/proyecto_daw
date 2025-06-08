<?php
    require_once __DIR__ . '/../../controllers/HorarioController.php';

    session_start();

    if (!isset($_SESSION['usuario'])) {
        header('Location: views/inicio_sesion/inicio_sesion.php');
        //exit();
    }

    $horario = $_GET['URLSearchParams(formData)'] ?? '';
    $controller = new HorarioController();
    $horario = $controller->mostrarHorario();

    header('Content-Type: application/json');
    echo json_encode($horario);

?>