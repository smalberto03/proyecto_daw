<?php
require '../../config/config_horas.php';
require '../../models/ModeloAsignatura.php';
require '../../controllers/ControladorAsignatura.php';

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

$baseDeDatos = new BaseDeDatos();
$modelo = new ModeloAsignatura($baseDeDatos->obtenerConexion());
$controlador = new ControladorAsignatura($modelo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controlador->agregarAsignatura($_POST["codigo"], $_POST["nombre"], $_POST["tipo"]);
} else {
    //$controlador->mostrarFormularioAgregar();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Asignatura</title>
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
                <li><a href=".,/php/views/profesores/consulta_profesores.php">Profesores</a></li>
                <li><a href="../php/views/secciones/consulta_seccion.php">Secciones</a></li>
                <li><a href="gestion_horario.php">Horarios</a></li>
                <li><a href="" class="active">Asignaturas</a></li>
                <li><a href="../php/views/cursos/consulta_curso.php">Curso</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="card">
            <h2>Añadir Asignatura</h2>
            <form action="agregarAsignatura.php" method="post" enctype="multipart/form-data" class="form-container">
                <div class="mb-3">
                    <label for="codigo" class="form-label">Código:</label>
                    <input type="text" class="form-control" name="codigo" id="codigo" required>
                </div>
                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>
                <div class="fourm-group">
                    <label for="tipo" class="form-label">Tipo:</label>
                    <select class="form-select" name="tipo" id="tipo" required>
                        <option value="e">Especial</option>
                        <option value="l">Lectiva</option>
                    </select>
                </div>
                <div class="fourm-group">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <a href="listaAsignatura.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
