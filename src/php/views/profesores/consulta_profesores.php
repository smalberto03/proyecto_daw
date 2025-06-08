<?php

    require_once 'controllers/CursoControlador.php';

    // Verificar si el usuario es ASM
    if ($_SESSION['usuario']['cod_profesor'] !== 'ASM') {
        header('Location: ../horarios/horarioView_user.php'); // Redirigir a la vista de usuario normal
        exit();
    }

    $objetoCurso = new CursoControlador();
    $ultimoCurso = $objetoCurso->mostrarUltimoCurso();

    if(empty($profesores))
    {
        $filas_vacias = "No hay profesores en la aplicación";
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/proyecto_daw_2425_def/src/css/styles.css">
    <title>Escuela Virgen de Guadalupe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmarBorrado(id) {

            Swal.fire({
                    title: '¿Estás seguro de querer eliminar este profesor?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '!Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                if(result.isConfirmed){
                    window.location.href = 'http://localhost/proyecto_daw_2425_def/src/php/views/profesores/borrar_profesor.php?id=' + id;
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
                <li><a href="" class="active">Profesores</a></li>
                <li><a href="../php/views/secciones/consulta_seccion.php">Secciones</a></li>
                <li><a href="../php/views/horarios/horarioView.php">Horarios</a></li>
                <li><a href="../php/views/asignaturas/listaAsignatura.php">Asignaturas</a></li>
                <li><a href="../php/views/cursos/consulta_curso.php">Curso</a></li>
                <li><a href=" controllers/ControladorAutenticacion.php?action=cerrarSesion">CERRAR SESIÓN</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <div class="table-container">
            <h1>Lista de Profesores</h1>
            <a href="http://localhost/proyecto_daw_2425_def/src/php/views/profesores/alta_profesores.php"><button class="button button-blue">Añadir Profesor</button></a>
            <table>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Profesor Sustituto</th>
                    <th>Acciones</th>
                </tr>
                <?php 
                    if(isset($filas_vacias))
                    {
                        echo $filas_vacias;
                    }
                    
                    foreach ($profesores as $profesor): ?>
                    <tr>
                        <td>
                            <img src="<?php echo htmlspecialchars('http://localhost/proyecto_daw_2425_def/diseno/imagenes/' . basename($profesor['imagen'])); ?>" alt="Imagen de profesor" style="width:100px;">
                        </td>
                        <td><?php echo $profesor['nombre']; ?></td>
                        <td><?php echo $profesor['apellidos']; ?></td>
                        <td><input type="checkbox" <?php echo $profesor['tipo'] == 1 ? 'checked' : ''; ?> disabled></td>
                        <td>
                            <a href="http://localhost/proyecto_daw_2425_def/src/php/views/profesores/modificar_profesores.php?id=<?php echo $profesor['idProfesor']; ?>"><button class="button button-blue">Editar</button></a>
                            <button type="button" class="button button-red" onclick="confirmarBorrado(<?php echo $profesor['idProfesor']; ?>)">Borrar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="div_excel">
            <h2>Importar profesores desde archivo .csv</h2>
            <form action="http://localhost/proyecto_daw_2425_def/src/php/views/profesores/importar_profesores.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="archivo_profesores" id="elegir_archivo" accept=".csv"><br><br>
                <input type="submit" name="btn_importar_profesores" value="IMPORTAR">
            </form>
        </div>
        <div class="form-container">
            <h2>Descripción del Último Curso</h2>
            <?php if (isset($ultimoCurso)): ?>
                <p><?php echo htmlspecialchars($ultimoCurso['fechaInicio']); ?></p>
                <p><?php echo htmlspecialchars($ultimoCurso['fechaFin']); ?></p>
                <p><?php echo htmlspecialchars($ultimoCurso['descripcion']); ?></p>
            <?php else: ?>
                <p>No hay cursos disponibles.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
<footer class="footer">
    <div class="footer-section">
        <h3>VIRGEN DE GUADALUPE</h3>
        <img src="../../../../diseno/assets/logotipo.png" alt="Logo" class="footer-logo">
    </div>
    <div class="footer-section">
        <h3>COLABORADORES</h3>
        <ul>
            <li>FUNDACIÓN ATABAL</li>
            <li>AYTO. BADAJOZ</li>
            <li>AEXPAINBA</li>
            <li>FIDES</li>
        </ul>
    </div>
    <div class="footer-section">
        <h3>ENLACES AMIGOS</h3>
        <ul>
            <li>ERASMUS+</li>
            <li>ENTRECULTURAS</li>
            <li>ESCUELAS CATÓLICAS</li>
        </ul>
    </div>
    <div class="footer-section">
        <h3>CONTACTAR</h3>
        <p>C/ Corte de Peleas, 79 06009 Badajoz</p>
        <p>+34 924 25 17 61</p>
        <ul>
            <li><a href="https://fundacionloyola.com/vguadalupe/aviso-legal/">Aviso Legal</a></li>
            <li><a href="https://fundacionloyola.com/vguadalupe/politica-de-privacidad/">Política de Privacidad</a></li>
            <li><a href="https://fundacionloyola.com/vguadalupe/politica-de-cookies/">Política de Cookies</a></li>
            <li><a href="https://fundacionloyola.com/vguadalupe/entorno-seguro/">Entorno Seguro</a></li>
            <li><a href="https://7f712bc7d2390e280c3f.canal.h2c.app/new-form.html">Canal de Denuncias WEB</a></li>
        </ul>
    </div>
</footer>
</html>
