<?php
require_once '../../config/configdb.php';
require_once '../../models/Profesor.php';
require_once '../../controllers/ProfesoresController.php';

$controller = new ProfesoresController($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller->borrarProfesor($id);
    header("Location: http://localhost/proyecto_daw_2425_def/src/php/index.php");
    exit();
} else {
    echo "ID de profesor no proporcionado.";
}
?>
