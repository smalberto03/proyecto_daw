<?php
    require_once '../../controllers/SeccionController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Secciones</title>
</head>
<body>
    <h1>Lista de Secciones</h1>
    <a href="alta_seccion.php">Añadir Sección</a>
    <table>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        <?php 
        
        

        $objeto = new SeccionController();
        $secciones = $objeto->mostrarSecciones();
        
        foreach ($secciones as $seccion): ?>
            <tr>
                <td><?php echo $seccion['codigo_seccion']; ?></td>
                <td><?php echo $seccion['nombreSeccion']; ?></td>
                <td>
                    <a href="modificar_seccion.php?id=<?php echo $seccion['idSeccion']; ?>">Modificar</a>
                    <a href="borrar_seccion.php?id=<?php echo $seccion['idSeccion']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta sección?');">Borrar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2>Importar Secciones desde CSV</h2>
    <form action="importar_secciones.php" method="post" enctype="multipart/form-data">
        <input type="file" name="archivo_secciones" accept=".csv" required>
        <input type="submit" value="Importar">
    </form>
</body>
</html>
