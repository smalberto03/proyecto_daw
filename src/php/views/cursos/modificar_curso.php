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
$id = $_GET['id'];
$curso = $controller->mostrarUltimoCurso();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Curso</title>
    <link rel="stylesheet" href="../../../css/styles.css">
    <!-- <script>
        function validateDates() {
            var fechaInicio = document.getElementById('fechaInicio').value;
            var fechaFin = document.getElementById('fechaFin').value;

            if (new Date(fechaInicio) >= new Date(fechaFin)) {
                alert("La fecha de inicio debe ser anterior a la fecha de fin.");
                return false;
            }
            return true;
        }
    </script> -->
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../../../diseno/assets/logotipo.png" alt="Logo Escuela Virgen de Guadalupe">
            <h1>Escuela Virgen de Guadalupe</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../secciones/consulta_seccion.php">Secciones</a></li>
                <li><a href="../profesores/consulta_profesores.php">Profesores</a></li>
                <li><a href="">Horarios</a></li>
                <li><a href="../asignaturas/listaAsignatura.php">Asiganturas</a></li>
                <li><a href="../cursos/consulta_curso.php" class="active">Cursos académicos</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="card">
            <h2>Modificar Curso</h2>
            <form action="procesar_modificacion_curso.php" method="post" enctype="multipart/form-data" class="form-container">
                <input type="hidden" name="id" value="<?php echo $curso['idCurso']; ?>">

                <div class="mb-3">
                    <label for="fechaInicio" class="form-label">Fecha de Inicio:</label>
                    <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" value="<?php echo date('Y-m-d\TH:i', strtotime($curso['fechaInicio'])); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="fechaFin" class="form-label">Fecha de Fin:</label>
                    <input type="datetime-local" class="form-control" id="fechaFin" name="fechaFin" value="<?php echo date('Y-m-d\TH:i', strtotime($curso['fechaFin'])); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo $curso['descripcion']; ?></textarea>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='consulta_curso.php'">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
