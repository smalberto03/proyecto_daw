<?php
    
    require_once '../../controllers/SeccionController.php';
    
    $controller = new SeccionController();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $codigo_seccion = $_POST['codigo_seccion'];
        $nombreSeccion = $_POST['nombreSeccion'];
    
        $controller->procesarAltaSeccion($codigo_seccion, $nombreSeccion);
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Sección</title>
</head>
<body>
    <h1>Alta de Sección</h1>
    <form action="" method="POST">
        <label for="codigo_seccion">Código:</label>
        <input type="text" id="codigo_seccion" name="codigo_seccion" required><br>
        <label for="nombreSeccion">Nombre:</label>
        <input type="text" id="nombreSeccion" name="nombreSeccion" required><br>
        <input type="submit" value="Agregar Sección">
    </form>
</body>
</html>
