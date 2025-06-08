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
$idSeccion = $_POST['idSeccion'];
$idProfesor = $_POST['idProfesor'];

$controller = new HorarioController();
$result = $controller->insertarHorario($diaSemana, $hora, $idAsignatura, $idSeccion, $idProfesor);

header('Content-Type: application/json');
echo json_encode($result);
?>


