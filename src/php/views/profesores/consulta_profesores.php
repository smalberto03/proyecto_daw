<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--Comprobar que este bien ESCRITO-->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- <title>Bootstrap demo</title> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <script>
        function confirmarBorrado(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este profesor?")) {
                window.location.href = 'http://localhost/proyecto_daw_2425_def/src/php/views/profesores/borrar_profesor.php?id=' + id;
            }
        }
    </script>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
<div class="nav">
        <div>                                                       
            <img src="../../../diseno/assets/logotipo.png" alt="Logo de la escula" id="logo">
        </div>
        <div class="titulo">ESCUELA VIRGEN DE GUADALUPE</div>
    </div>
    <div class="nav2">
        <div>
            Gestionar usuarios 
        </div>
        <div class="liespecial">
            Profesores
        </div>
        <div>
            Gestión horario 
        </div>
        <div>
            Horas especiales
        </div>
    </div>
    <div>
        <h1 id="titulo_profesores">LISTA DE PROFESORES</h1>

        <h1>Lista de Profesores</h1>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Profesor Sustituto</th>
        </tr>
        <?php foreach ($profesores as $profesor): ?>
            <tr>
                <td><img src="<?php echo $profesor['imagen']; ?>" alt="Imagen de profesor" style="width:50px;"></td>
                <td><?php echo $profesor['nombre']; ?></td>
                <td><?php echo $profesor['apellidos']; ?></td>
                <td><input type="checkbox" <?php echo $profesor['tipo'] == 1 ? 'checked' : ''; ?> disabled></td>
                <td><a href="http://localhost/proyecto_daw_2425_def/src/php/views/profesores/modificar_profesores.php?id=<?php echo $profesor['idProfesor']; ?>">Editar</a></td>
                <td><button type="button" onclick="confirmarBorrado(<?php echo $profesor['idProfesor']; ?>)">Borrar</button></td>
            </tr>
        <?php endforeach; ?>
    </table>

        <!-- ESPORTAR PROFESORES  -->
        <!-- <a href="alta_profesores.php"><button><img src="../../../diseno/assets/iconos/anadir (2).png" alt="icono de añadir" class="imgbtn"></button></a> -->
        <div class="div_excel">
            <h2>Importar profesores desde archivo .csv</h2>
            <form action="http://localhost/proyecto_daw_2425_def/src/php/views/profesores/importar_profesores.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="archivo_profesores" id="elegir_archivo" accept=".csv"><br><br>
                <input type="submit" name="btn_importar_profesores" value="IMPORTAR">
            </form>
        </div>
        
        <div>
        <h2>Descripción del Último Curso</h2>
            <?php if (isset($ultimoCurso)): ?>
                <p><?php echo htmlspecialchars($ultimoCurso['descripcion']); ?></p>
                <form action="procesar_modificacion_curso.php" method="post">
                    <input type="hidden" name="idCurso" value="<?php echo $ultimoCurso['idCurso']; ?>">
                    <textarea name="descripcion" rows="4" cols="50"><?php echo htmlspecialchars($ultimoCurso['descripcion']); ?></textarea><br>
                    <input type="submit" value="Guardar Cambios">
                </form>
            <?php else: ?>
            <p>No hay cursos disponibles.</p>
        <?php endif; ?>
        </div>

        <a href="http://localhost/proyecto_daw_2425_def/src/php/views/profesores/alta_profesores.php">Añadir Profesor</a>
    </div>




    
    <!-- <a href="alta_profesores.php"><button><img src="../../../diseno/assets/iconos/anadir (2).png" alt="icono de añadir" class="imgbtn"></button></a> -->
</body>
</html>
