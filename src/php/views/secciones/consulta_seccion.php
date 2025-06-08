<?php
    require_once '../../controllers/SeccionController.php';

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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Secciones</title>
    <link rel="stylesheet" href="../../../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function confirmarBorrado(id) {

            Swal.fire({
                    title: '¿Estás seguro de querer eliminar esta seccion?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '!Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                if(result.isConfirmed){
                    window.location.href = 'http://localhost/proyecto_daw_2425_def/src/php/views/secciones/borrar_seccion.php?id=' + id;
                    //Swal.fire("Saved!", "", "success");
                }
            });


            // if (confirm("¿Estás seguro de que deseas eliminar este profesor?")) {
            //     window.location.href = 'http://localhost/proyecto_daw_2425_def/src/php/views/profesores/borrar_profesor.php?id=' + id;
            // }
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
                <li><a href="" class="active">Secciones</a></li>
                <li><a href="../horarios/horarioView.php">Horarios</a></li>
                <li><a href="../asignaturas/listaAsignatura.php">Asignaturas</a></li>
                <li><a href="../cursos/consulta_curso.php">Curso</a></li>
                <li><a href="../../controllers/ControladorAutenticacion.php?action=cerrarSesion">CERRAR SESIÓN</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Lista de Secciones</h2>
        <a href="alta_seccion.php" class="button">Añadir Sección</a>
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
                        <a href="modificar_seccion.php?id=<?php echo $seccion['idSeccion']; ?>" class="button">Modificar</a>
                        <button class="button button-red" onclick="confirmarBorrado(<?php echo $seccion['idSeccion']; ?>)">Borrar</button>
                        <!-- <a href="" class="button button-red" onclick="confirmarBorrado(<?php echo $seccion['idSeccion']; ?>)">Borrar</a> -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h3>Importar Secciones desde CSV</h3>
        <form action="importar_secciones.php" method="post" enctype="multipart/form-data">
            <input type="file" name="archivo_secciones" accept=".csv" required>
            <input type="submit" value="Importar" class="button">
        </form>
    </main>
</body>
</html>
