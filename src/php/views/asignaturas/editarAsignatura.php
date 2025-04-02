<?php
require '../configuracion.php';
require '../modelos/ModeloAsignatura.php';
require '../controladores/ControladorAsignatura.php';

$baseDeDatos = new BaseDeDatos();
$modelo = new ModeloAsignatura($baseDeDatos->obtenerConexion());
$controlador = new ControladorAsignatura($modelo);

$id = $_GET['id'];
$asignatura = $controlador->obtenerDatosEditarAsignatura($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controlador->editarAsignatura($_POST['id'], $_POST['codigo'], $_POST['nombre'], $_POST['tipo']);
    header('Location: listaAsignaturas.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Asignatura</title>
</head>
<body>
    <h1>Editar Asignatura</h1>
    <form action="editarAsignatura.php" method="post">
        <input type="hidden" name="id" value="<?= $asignatura['idAsignatura'] ?>">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" value="<?= $asignatura['codigoAsignatura'] ?>" required><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= $asignatura['nombreAsignatura'] ?>" required><br>
        <label for="tipo">Tipo:</label>
        <select name="tipo" required>
            <option value="l" <?= $asignatura['tipo'] === 'l' ? 'selected' : '' ?>>Lectiva</option>
            <option value="e" <?= $asignatura['tipo'] === 'e' ? 'selected' : '' ?>>Especial</option>
        </select><br>
        <button type="submit">Aceptar</button>
    </form>
</body>
</html>
