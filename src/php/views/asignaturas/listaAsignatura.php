<?php
require '../configuracion.php';
require '../modelos/ModeloAsignatura.php';
require '../controladores/ControladorAsignatura.php';

$baseDeDatos = new BaseDeDatos();
$modelo = new ModeloAsignatura($baseDeDatos->obtenerConexion());
$controlador = new ControladorAsignatura($modelo);

$asignaturas = $controlador->listarAsignaturas();

if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $controlador->eliminarAsignatura($id);
    header('Location: listaAsignaturas.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Asignaturas</title>
    <script>
        function confirmarEliminar(id) {
            if (confirm("¿Estás seguro de que deseas eliminar esta asignatura?")) {
                window.location.href = "listaAsignaturas.php?eliminar=" + id;
            }
        }
    </script>
</head>
<body>
    <h1>Asignaturas</h1>
    <a href="agregarAsignatura.php">Añadir Asignatura</a>
    <ul>
        <?php foreach ($asignaturas as $asignatura): ?>
            <li>
                <?= $asignatura['nombreAsignatura'] ?> (<?= $asignatura['tipo'] === 'e' ? 'Especial' : 'Lectiva' ?>)
                <?= $asignatura['tipo'] === 'e' ? '✔' : '' ?>
                <a href="editarAsignatura.php?id=<?= $asignatura['idAsignatura'] ?>">Editar</a>
                <?php if ($asignatura['tipo'] === 'e'): ?>
                    <button onclick="confirmarEliminar(<?= $asignatura['idAsignatura'] ?>)">Eliminar</button>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
