<?php
require_once '../../controllers/SeccionController.php';

$controller = new SeccionController();

if (isset($_FILES['archivo_secciones']) && $_FILES['archivo_secciones']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['archivo_secciones']['tmp_name'];
    $controller->procesarImportacionSecciones($fileTmpPath);
}
?>
