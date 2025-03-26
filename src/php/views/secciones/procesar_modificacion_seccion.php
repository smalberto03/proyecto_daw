<?php
require_once 'controller/SeccionController.php';

$controller = new SeccionController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $codigo_seccion = $_POST['codigo_seccion'];
    $nombreSeccion = $_POST['nombreSeccion'];

    $controller->procesarModificacionSeccion($id, $codigo_seccion, $nombreSeccion);
}
?>
