<?php
require_once '../../controllers/CursoControlador.php';

$controller = new CursoControlador();
$ultimoCurso = $controller->mostrarUltimoCurso();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Curso</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="logo.png" alt="Logo Escuela Virgen de Guadalupe">
        </div>
        <h1>Escuela Virgen de Guadalupe</h1>
    </header>
    <nav class="navbar">
        <a href="#" class="nav-item">Gestionar usuarios</a>
        <a href="#" class="nav-item active">Cursos</a>
        <a href="#" class="nav-item">Gestión horario</a>
        <a href="#" class="nav-item">Horas especiales</a>
    </nav>
    <main class="main-content">
        <div class="card">
            <h2>Último Curso Creado</h2>
            <?php if ($ultimoCurso): ?>
                <p><strong>Fecha de Inicio:</strong> <?php echo $ultimoCurso['fechaInicio']; ?></p>
                <p><strong>Fecha de Fin:</strong> <?php echo $ultimoCurso['fechaFin']; ?></p>
                <p><strong>Descripción:</strong> <?php echo $ultimoCurso['descripcion']; ?></p>
                <a href="modificar_curso.php?id=<?php echo $ultimoCurso['idCurso']; ?>" class="btn edit-btn">Modificar Curso</a>
            <?php else: ?>
                <p>No hay cursos disponibles.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
