<?php
require_once '../../controllers/CursoControlador.php';

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

$controller = new CursoControlador();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $descripcion = $_POST['descripcion'];

    if(strtotime($fechaInicio) >= strtotime($fechaFin)) {
        echo "La fecha de inicio debe ser anterior a la fecha de fin.";
        //return;
    }else{
        $controller->procesarModificacionCurso($id, $fechaInicio, $fechaFin, $descripcion);
        header("Location: consulta_curso.php");
    }
    
}
?>
