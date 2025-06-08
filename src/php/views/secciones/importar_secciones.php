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

if (isset($_FILES['archivo_secciones']) && $_FILES['archivo_secciones']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['archivo_secciones']['tmp_name'];
    $controller->procesarImportacionSecciones($fileTmpPath);
}
?>
