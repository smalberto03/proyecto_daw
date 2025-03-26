<?php
require_once 'controller/CursoController.php';

$controller = new CursoController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idCurso = $_POST['idCurso'];
    $descripcion = $_POST['descripcion'];

    $controller->procesarModificacionCurso($idCurso, $descripcion);
}
?>
