<?php

    require_once '../../controllers/CursoControlador.php';
    $controller = new CursoControlador(); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];
        $descripcion = $_POST['descripcion'];
    
        $controller->procesarAltaCurso($fechaInicio, $fechaFin, $descripcion);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Curso</title>
</head>
<body>
    <h1>Alta de Curso Académico</h1>
    <form action="" method="post">
        <label for="fechaInicio">Fecha de Inicio:</label>
        <input type="datetime-local" id="fechaInicio" name="fechaInicio" required><br><br>

        <label for="fechaFin">Fecha de Fin:</label>
        <input type="datetime-local" id="fechaFin" name="fechaFin" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea><br><br>

        <input type="submit" value="Crear Curso">
    </form>
</body>
</html>
