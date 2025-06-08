<?php
//require_once '../../vendor/autoload.php';
require_once 'config/configdb.php';
require_once 'controllers/ProfesoresController.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: php/views/inicio_sesion/inicio_sesion.php');
    //exit();
}

$controller = new ProfesoresController($conn);
$controller->mostrarProfesores();

$conn->close();
?>

