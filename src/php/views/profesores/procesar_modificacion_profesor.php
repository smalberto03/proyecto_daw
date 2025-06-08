<?php
require_once '../../config/configdb.php';
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

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $id = $_POST['id'];
    $cod_profesor = $_POST['cod_profesor'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $nombreusuario = $_POST['nombreusuario'];
    $pass = $_POST['pass'];
    $imagen = $_FILES['imagen'];
    $tipo = isset($_POST['tipo']) ? 'on' : 'off';
    $idProfesorSustituto = $tipo === 'on' ? $_POST['idProfesorSustituto'] : null;

    // Crear una instancia del controlador
    $controller = new ProfesoresController($conn);

    // Llamar al método del controlador para procesar la modificación
    $controller->procesarModificacionProfesor($id, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto);
} else {
    // Si no se ha enviado el formulario, redirigir o mostrar un error
    echo "Acceso no válido.";
}
?>

