<?php
require_once '../../config/configdb.php';
require_once '../../models/Profesor.php';
require_once '../../controllers/ProfesoresController.php';

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
