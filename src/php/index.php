<?php
require_once 'config/configdb.php';
require_once 'controllers/ProfesoresController.php';

$controller = new ProfesoresController($conn);
$controller->mostrarProfesores();

$conn->close();
?>

