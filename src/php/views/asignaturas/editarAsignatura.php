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

$id = $_GET['id'];
$asignatura = $controlador->obtenerDatosEditarAsignatura($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controlador->editarAsignatura($_POST['id'], $_POST['codigo'], $_POST['nombre'], $_POST['tipo']);
    header('Location: listaAsignatura.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Asignatura</title>
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
                <li><a href="../profesores/consulta_profesores.php">Profesores</a></li>
                <li><a href="../php/views/secciones/consulta_seccion.php">Secciones</a></li>
                <li><a href="gestion_horario.php">Horarios</a></li>
                <li><a href="" class="active">Asignaturas</a></li>
                <li><a href="../php/views/cursos/consulta_curso.php">Curso</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="card">
            <h2>Editar Asignatura</h2>
            <form action="editarAsignatura.php" method="post">
                <input type="hidden" name="id" value="<?= $asignatura['idAsignatura'] ?>">
                <div class="form-group">
                    <label for="codigo">Código:</label>
                    <input type="text" name="codigo" id="codigo" value="<?= $asignatura['codigoAsignatura'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?= $asignatura['nombreAsignatura'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <select name="tipo" id="tipo" required>
                        <option value="l" <?= $asignatura['tipo'] === 'l' ? 'selected' : '' ?>>Lectiva</option>
                        <option value="e" <?= $asignatura['tipo'] === 'e' ? 'selected' : '' ?>>Especial</option>
                    </select>
                </div>
                <div class="button-group">
                    <button type="submit" class="button">Aceptar</button>
                    <a href="listaAsignatura.php" class="button cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
