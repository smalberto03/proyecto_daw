<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../../../css/styles.css">
</head>
<body>
    <div id="login-container">
        <header>
            <div class="logo">
                <img src="../../../../diseno/assets/logotipo.png" alt="Logo Escuela Virgen de Guadalupe">
                <h1>Escuela Virgen de Guadalupe</h1>
            </div>
            <nav>
                <!--
                <ul>
                    <li><a href="../../../../src/php">Profesores</a></li>
                    <li><a href="../secciones/consulta_seccion.php">Secciones</a></li>
                    <li><a href="../horarios/horarioView.php">Horarios</a></li>
                    <li><a href="" class="active">Asignaturas</a></li>
                    <li><a href="../cursos/consulta_curso.php">Curso</a></li>
                </ul>
                -->
            </nav>
        </header>
        <h2>GESTIÓN HORARIOS</h2>
        <h2>Bienvenido, inicia sesión con Google</h2>
        <a href="../../controllers/ControladorAutenticacion.php" id="login-button">Iniciar sesión</a>
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'dominio_no_valido') {
            echo '<p class="error-message">No es posible acceder a la aplicación.</p>';
        }
        if (isset($_GET['error']) && $_GET['error'] === 'usuario_no_encontrado') {
            echo '<p class="error-message">Usuario no encontrado. Por favor, contacta al administrador.</p>';
        }
        ?>
    </div>
</body>
</html>
