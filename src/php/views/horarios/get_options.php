<?php
require_once __DIR__ . '/../../controllers/HorarioController.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: views/inicio_sesion/inicio_sesion.php');
    //exit();
}

$tipo = $_GET['tipo'] ?? '';
$controller = new HorarioController();
$options = $controller->obtenerOpcionesPorTipo($tipo);

header('Content-Type: application/json');
echo json_encode($options);
?>
