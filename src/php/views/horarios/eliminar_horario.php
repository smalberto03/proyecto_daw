<?php
require_once __DIR__ . '/../../controllers/HorarioController.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: views/inicio_sesion/inicio_sesion.php');
    //exit();
}

$diaSemana = $_POST['diaSemana'];
$hora = $_POST['hora'];
$idAsignatura = $_POST['idAsignatura'];
$idProfesor = $_POST['idProfesor'];

$controller = new HorarioController();
$result = $controller->eliminarHorario($diaSemana, $hora, $idAsignatura, $idProfesor);

header('Content-Type: application/json');
echo json_encode($result);
?>


