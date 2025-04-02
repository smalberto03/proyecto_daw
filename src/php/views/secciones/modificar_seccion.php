<?php
    require_once '../../controllers/SeccionController.php';;

    $controller = new SeccionController();
    $id = $_GET['id'];
    $seccion = $controller->mostrarFormularioModificar($id);
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar Sección</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <header class="header">
            <div class="logo">
                <img src="logo.png" alt="Logo Escuela Virgen de Guadalupe">
            </div>
            <h1>Escuela Virgen de Guadalupe</h1>
        </header>
        <nav class="navbar">
            <a href="#" class="nav-item">Gestionar usuarios</a>
            <a href="#" class="nav-item active">Secciones</a>
            <a href="#" class="nav-item">Gestión horario</a>
            <a href="#" class="nav-item">Horas especiales</a>
        </nav>
        <main class="main-content">
            <div class="card">
                <h2>Modificar Sección</h2>
                <form action="procesar_modificacion_seccion.php" method="post" class="professor-form">
                    <input type="hidden" name="id" value="<?php echo $seccion['idSeccion']; ?>">
    
                    <label for="codigo_seccion">Código:</label>
                    <input type="text" id="codigo_seccion" name="codigo_seccion" value="<?php echo $seccion['codigo_seccion']; ?>" required>
    
                    <label for="nombreSeccion">Nombre:</label>
                    <input type="text" id="nombreSeccion" name="nombreSeccion" value="<?php echo $seccion['nombreSeccion']; ?>" required>
    
                    <div class="button-group">
                        <button type="button" class="btn cancel-btn" onclick="window.location.href='consulta_secciones.php'">Cancelar</button>
                        <button type="submit" class="btn add-btn">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </main>
    </body>
    </html>
