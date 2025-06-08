<?php
require_once '../../controllers/SeccionController.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: views/inicio_sesion/inicio_sesion.php');
    //exit();
}

// Verificar si el usuario es ASM
if ($_SESSION['usuario']['cod_profesor'] !== 'ASM') {
    header('Location: ../horarios/horarioView_user.php'); // Redirigir a la vista de usuario normal
    exit();
}

$controller = new SeccionController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $codigo_seccion = $_POST['codigo_seccion'];
    $nombreSeccion = $_POST['nombreSeccion'];

    $controller->procesarModificacionSeccion($id, $codigo_seccion, $nombreSeccion);
    header("Location: consulta_seccion.php");
}
?>
