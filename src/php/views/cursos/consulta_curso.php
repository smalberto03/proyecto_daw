<?php
require_once '../../controllers/CursoControlador.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../inicio_sesion/inicio_sesion.php');
    //exit();
}

// Verificar si el usuario es ASM
if ($_SESSION['usuario']['cod_profesor'] !== 'ASM') {
    header('Location: ../horarios/horarioView_user.php'); // Redirigir a la vista de usuario normal
    exit();
}

$controller = new CursoControlador();
$ultimoCurso = $controller->mostrarUltimoCurso();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Curso</title>
    <link rel="stylesheet" href="../../../css/styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../../../diseno/assets/logotipo.png" alt="Logo Escuela Virgen de Guadalupe">
            <h1>Escuela Virgen de Guadalupe</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../../../../src/php">Profesores</a></li>
                <li><a href="../secciones/consulta_seccion.php">Secciones</a></li>
                <li><a href="../horarios/horarioView.php" >Horarios</a></li>
                <li><a href="../asignaturas/listaAsignatura.php" >Asignaturas</a></li>
                <li><a href="" class="active">Curso</a></li>
                <li><a href="../../controllers/ControladorAutenticacion.php?action=cerrarSesion">CERRAR SESIÓN</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="card">
            <h2>Último Curso Creado</h2>
            <?php if ($ultimoCurso): ?>
                <p><strong>Fecha de Inicio:</strong> <?php echo $ultimoCurso['fechaInicio']; ?></p>
                <p><strong>Fecha de Fin:</strong> <?php echo $ultimoCurso['fechaFin']; ?></p>
                <p><strong>Descripción:</strong> <?php echo $ultimoCurso['descripcion']; ?></p>
                <a href="modificar_curso.php?id=<?php echo $ultimoCurso['idCurso']; ?>" class="button">Modificar Curso</a>
                <a href="alta_curso.php" class="button">Añadir Curso</a>
            <?php else: ?>
                <p>No hay cursos disponibles.</p>
                <a href="alta_curso.php" class="button">Añadir Curso</a>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
