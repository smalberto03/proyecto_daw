<?php
require '../configuracion.php';
require '../modelos/ModeloAsignatura.php';
require '../controladores/ControladorAsignatura.php';

$baseDeDatos = new BaseDeDatos();
$modelo = new ModeloAsignatura($baseDeDatos->obtenerConexion());
$controlador = new ControladorAsignatura($modelo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controlador->agregarAsignatura();
} else {
    $controlador->mostrarFormularioAgregar();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Asignatura</title>
</head>
<body>
    <h1>Añadir Asignatura</h1>
    <form action="agregarAsignatura.php" method="post">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" required><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>
        <label for="tipo">Tipo:</label>
        <select name="tipo" required>
            <option value="l">Lectiva</option>
            <option value="e">Especial</option>
        </select><br>
        <button type="submit">Aceptar</button>
    </form>
</body>
</html>
