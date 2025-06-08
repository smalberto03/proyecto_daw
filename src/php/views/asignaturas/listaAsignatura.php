<?php
require '../../config/config_horas.php';
require '../../models/ModeloAsignatura.php';
require '../../controllers/ControladorAsignatura.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../inicio_sesion/inicio_sesion.php');
    //exit();
}

// Verificar si el usuario es ASM
if ($_SESSION['usuario']['cod_profesor'] !== 'ASM') {
    header('Location: ../horarios/horarioView_user.php'); // Redirigir a la vista de usuario normal
    exit();
}

$baseDeDatos = new BaseDeDatos();
$modelo = new ModeloAsignatura($baseDeDatos->obtenerConexion());
$controlador = new ControladorAsignatura($modelo);

$asignaturas = $controlador->listarAsignaturas();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $controlador->eliminarAsignatura($id);
    header('Location: listaAsignatura.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Asignaturas</title>
    <link rel="stylesheet" href="../../../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmarEliminar(id) {

            Swal.fire({
                    title: '¿Estás seguro de querer eliminar esta asignatura?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '!Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                if(result.isConfirmed){
                    window.location.href = 'http://localhost/proyecto_daw_2425_def/src/php/views/asignaturas/listaAsignatura.php?id=' + id;
                    //Swal.fire("Saved!", "", "success");
                }
            });
        }

    </script>
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
                <li><a href="../horarios/horarioView.php" >Horarios</a></li>
                <li><a href="" class="active">Asignaturas</a></li>
                <li><a href="../cursos/consulta_curso.php">Curso</a></li>
                <li><a href="../../controllers/ControladorAutenticacion.php?action=cerrarSesion">CERRAR SESIÓN</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Asignaturas</h2>
        <!-- <div><?php  //echo $_SESSION['usuario']['nombre'];     ?></div> -->
        <a href="agregarAsignatura.php" class="button">Añadir Asignatura</a>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Nivel</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($asignaturas as $asignatura): ?>
                <tr>
                    <td><?= $asignatura['nombreAsignatura'] ?></td>
                    <td><?= $asignatura['tipo'] === 'e' ? 'Especial' : 'Lectiva' ?></td>
                    <td><?= $asignatura['nivel'] ?></td>
                    <td>
                        <a href="editarAsignatura.php?id=<?= $asignatura['idAsignatura'] ?>" class="button">Editar</a>
                        <?php if ($asignatura['tipo'] === 'e'): ?>
                            <button onclick="confirmarEliminar(<?= $asignatura['idAsignatura'] ?>)" class="button button-red">Eliminar</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <form action="importarAsignaturas.php" method="post" enctype="multipart/form-data">
            <input type="file" name="archivo_csv" accept=".csv" required>
            <button type="submit" class="button">Importar Asignaturas</button>
        </form>
    </main>
</body>
</html>
