<?php
require_once '../../controllers/CursoControlador.php';

$controller = new CursoControlador();
$id = $_GET['id'];
$curso = $controller->mostrarUltimoCurso();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Curso</title>
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
            <h2>Modificar Curso</h2>
            <form action="procesar_modificacion_curso.php" method="post" class="professor-form">
                <input type="hidden" name="id" value="<?php echo $curso['idCurso']; ?>">

                <label for="fechaInicio">Fecha de Inicio:</label>
                <input type="datetime-local" id="fechaInicio" name="fechaInicio" value="<?php echo date('Y-m-d\TH:i', strtotime($curso['fechaInicio'])); ?>" required>

                <label for="fechaFin">Fecha de Fin:</label>
                <input type="datetime-local" id="fechaFin" name="fechaFin" value="<?php echo date('Y-m-d\TH:i', strtotime($curso['fechaFin'])); ?>" required>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo $curso['descripcion']; ?></textarea>

                <div class="button-group">
                    <button type="button" class="btn cancel-btn" onclick="window.location.href='consulta_curso.php'">Cancelar</button>
                    <button type="submit" class="btn add-btn">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>

