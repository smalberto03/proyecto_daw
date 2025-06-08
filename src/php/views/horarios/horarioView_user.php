<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../inicio_sesion/inicio_sesion.php');
    //exit();
}

// Obtener la información del usuario de la sesión
// $usuario = $_SESSION['usuario'];

// // Depuración: Imprimir el contenido de la sesión para verificar los datos
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
//echo $_SESSION['usuario']['google_picture'];

// echo $_SESSION['usuario']['nombre'];
// echo $_SESSION['usuario']['apellidos'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horarios</title>
    <link rel="stylesheet" href="../../../css/styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../../../diseno/assets/logotipo.png" alt="Logo Escuela Virgen de Guadalupe">
            <h1>Escuela Virgen de Guadalupe</h1>
            <div class="user-image">
                <img src="<?php echo htmlspecialchars($_SESSION['usuario']['google_picture']); ?>" alt="Imagen de usuario">
            </div>
            <ul>
                <li><a href="../../controllers/ControladorAutenticacion.php?action=cerrarSesion" id="cerrarsesion">CERRAR SESIÓN</a></li>
            </ul>
        </div>
    </header>
    <h1>Horario</h1>
    <!-- <h1>Bienvenido a tu horario, <?php //echo htmlspecialchars($usuario['nombre']); ?></h1>
    <p>URL de la imagen: <?php //echo htmlspecialchars($usuario['imagen']); ?></p> -->

    <!-- <div class="upload-card">
        <form id="upload-form" method="post" enctype="multipart/form-data" action="importar_horario.php">
            <div class="form-field">
                <label for="excel-file">Subir archivo Excel:</label>
                <input type="file" name="excel-file" id="excel-file" accept=".csv" required>
            </div>
            <button type="submit" name="btnsubir">Subir</button>
        </form>
    </div> -->


    <div class="schedule-card">
        <form id="search-form" method="get">
            <div class="form-field">
                <label for="search-type">Buscar por:</label>
                <select name="tipo" id="search-type" onchange="fetchOptions()">
                    <option value="">Seleccione...</option>
                    <option value="profesor">Profesor</option>
                    <option value="seccion">Sección</option>
                </select>
                <select name="id" id="search-id" required>
                    <option value="">Seleccione...</option>
                </select>
            </div>
            <button type="submit" name="btnbuscar">Buscar</button>
        </form>
    </div>

    <table id="horario-table" style="display: none;">
        <thead>
            <tr>
                <th>Hora/Día</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
        </thead>
        <tbody>
            <!-- La tabla se llenará con los resultados de la búsqueda -->
        </tbody>
    </table>

    <!-- Contenedor para asignaturas especiales -->
    <div id="asignaturas-especiales-container" style="display: none;">
        <h3>Asignaturas Especiales</h3>
        <div id="asignaturas-especiales"></div>
    </div>

    <!-- Contenedor para secciones -->
    <div id="secciones-container" style="display: none;">
        <h3>Secciones</h3>
        <div id="secciones"></div>
    </div>

    <script src="../../../js/scriptHorarios_user.js"></script>
</body>
</html>
