<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Sección</title>
</head>
<body>
    <h1>Modificar Sección</h1>
    <form action="procesar_modificacion_seccion.php" method="post">
        <input type="hidden" name="id" value="<?php echo $seccion['idSeccion']; ?>">
        <label for="codigo_seccion">Código:</label>
        <input type="text" id="codigo_seccion" name="codigo_seccion" value="<?php echo $seccion['codigo_seccion']; ?>" required><br>
        <label for="nombreSeccion">Nombre:</label>
        <input type="text" id="nombreSeccion" name="nombreSeccion" value="<?php echo $seccion['nombreSeccion']; ?>" required><br>
        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
