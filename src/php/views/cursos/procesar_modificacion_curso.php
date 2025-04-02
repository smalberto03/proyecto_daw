<?php
require_once '../../controllers/CursoControlador.php';

$controller = new CursoControlador();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $descripcion = $_POST['descripcion'];

    $controller->procesarModificacionCurso($id, $fechaInicio, $fechaFin, $descripcion);
    header("Location: consulta_curso.php");
}
?>
