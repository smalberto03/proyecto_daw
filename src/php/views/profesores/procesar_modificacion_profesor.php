<?php
require_once '../../controllers/ProfesoresController.php';

$controller = new ProfesoresController($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $nombreusuario = $_POST['nombreusuario'];
    $pass = $_POST['pass'];
    $imagen = $_POST['imagen'];
    $tipo = isset($_POST['tipo']) ? 1 : 0;
    $idProfesorSustituto = $tipo == 1 ? $_POST['idProfesorSustituto'] : null;

    $controller->procesarModificacionProfesor($id, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto);
    header("Location: consulta_profesores.php");
}
?>
