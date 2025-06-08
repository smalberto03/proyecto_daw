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
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $descripcion = $_POST['descripcion'];

    $controller->procesarAltaCurso($fechaInicio, $fechaFin, $descripcion);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Curso</title>
    <link rel="stylesheet" href="../../../css/styles.css">
    <script>
        function validateDates() {
            var fechaInicio = document.getElementById('fechaInicio').value;
            var fechaFin = document.getElementById('fechaFin').value;

            if (new Date(fechaInicio) >= new Date(fechaFin)) {
                alert("La fecha de inicio debe ser anterior a la fecha de fin.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../../../diseno/assets/logotipo.png" alt="Logo Escuela Virgen de Guadalupe">
            <h1>Escuela Virgen de Guadalupe</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../secciones/consulta_seccion.php">Gestionar Secciones</a></li>
                <li><a href="../profesores/consulta_profesores.php">Profesores</a></li>
                <li><a href="">Gestión horario</a></li>
                <li><a href="../asignaturas/listaAsignatura.php">Horas especiales</a></li>
                <li><a href="../cursos/consulta_curso.php" class="active">Cursos académicos</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="card">
            <h2>Alta de Curso Académico</h2>
            <form action="" method="post" onsubmit="return validateDates()" enctype="multipart/form-data" class="form-container">
                <div class="mb-3">
                    <label for="fechaInicio" class="form-label">Fecha de Inicio:</label>
                    <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" required>
                </div>

                <div class="mb-3">
                    <label for="fechaFin" class="form-label">Fecha de Fin:</label>
                    <input type="datetime-local" class="form-control" id="fechaFin" name="fechaFin" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Crear Curso</button>
                    <a href="consulta_curso.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
