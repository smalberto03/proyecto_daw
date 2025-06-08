<?php
    require_once '../../controllers/SeccionController.php';

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

    $controller = new SeccionController();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $codigo_seccion = $_POST['codigo_seccion'];
        $nombreSeccion = $_POST['nombreSeccion'];

        $controller->procesarAltaSeccion($codigo_seccion, $nombreSeccion);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Sección</title>
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
                <li><a href="gestionar_usuarios.php">Gestionar usuarios</a></li>
                <li><a href="secciones.php">Secciones</a></li>
                <li><a href="gestion_horario.php">Gestión horario</a></li>
                <li><a href="horas_especiales.php">Horas especiales</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Alta de Sección</h2>
        <form action="" method="POST" enctype="multipart/form-data" class="form-container">
            <div class="mb-3">
                <label for="codigo_seccion" class="form-label">Código:</label>
                <input type="text" class="form-control" id="codigo_seccion" name="codigo_seccion" required>
            </div>
            <div class="mb-3">
                <label for="nombreSeccion" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombreSeccion" name="nombreSeccion" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="btn">Agregar Sección</button>
                <a href="consulta_seccion.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>
