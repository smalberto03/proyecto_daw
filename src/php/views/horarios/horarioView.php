<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../inicio_sesion/inicio_sesion.php');
    //exit();
}

// Verificar si el usuario es ASM
if ($_SESSION['usuario']['cod_profesor'] !== 'ASM') {
    header('Location: horarioView_user.php'); // Redirigir a la vista de usuario normal
    exit();
}

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
        </div>
        <nav>
            <ul>
                <li><a href="../../../../src/php">Profesores</a></li>
                <li><a href="../secciones/consulta_seccion.php">Secciones</a></li>
                <li><a href="" class="active">Horarios</a></li>
                <li><a href="../asignaturas/listaAsignatura.php">Asignaturas</a></li>
                <li><a href="../cursos/consulta_curso.php">Curso</a></li>
                <li><a href="../../controllers/ControladorAutenticacion.php?action=cerrarSesion">CERRAR SESIÓN</a></li>
            </ul>
        </nav>
    </header>
    <h1>Horario</h1>

    <div class="upload-card">
        <form id="upload-form" method="post" enctype="multipart/form-data" action="importar_horario.php">
            <div class="form-field">
                <label for="excel-file">Subir archivo Excel:</label>
                <input type="file" name="excel-file" id="excel-file" accept=".csv" required>
            </div>
            <button type="submit" name="btnsubir">Subir</button>
        </form>
    </div>


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

    <script src="../../../js/scriptHorarios.js"></script>
</body>
</html>
