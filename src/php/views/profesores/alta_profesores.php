<?php
require_once '../../config/configdb.php';
require_once '../../controllers/ProfesoresController.php';

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

// Conexión a la base de datos y obtención de profesores titulares
$controller = new ProfesoresController($conn);
$profesoresTitulares = $controller->obtenerTitulares();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link rel="stylesheet" href="../../../css/styles.css">
    <title>Añadir Profesor</title>
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
                <li><a href="gestion_horario.php">Horarios</a></li>
                <li><a href="../php/views/asignaturas/listaAsignatura.php">Asignaturas</a></li>
                <li><a href="../php/views/cursos/consulta_curso.php">Curso</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Añadir Nuevo Profesor</h1>
        <?php
            // Procesar el formulario si se ha enviado
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $tipo = isset($_POST['tipo']) ? 'on' : 'off';
                $idProfesorSustituto = $tipo === 'on' ? $_POST['idProfesorSustituto'] : null;
                $controller->addProfesor($_POST['cod_profesor'], $_POST['nombre'], $_POST['apellidos'], $_POST['nombreusuario'], $_POST['pass'], $_FILES['imagen'], $tipo, $idProfesorSustituto);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data" class="form-container">
            <input type="hidden" name="action" value="guardar">
            <div class="mb-3">
                <label for="cod_profesor" class="form-label">Código de Profesor</label>
                <input type="text" class="form-control" id="cod_profesor" name="cod_profesor" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <div class="mb-3">
                <label for="nombreusuario" class="form-label">Email</label>
                <input type="text" class="form-control" id="nombreusuario" name="nombreusuario" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="tipo" name="tipo">
                <label class="form-check-label" for="tipo">¿Es profesor sustituto?</label>
            </div>
            <?php if (!empty($profesoresTitulares)): ?>
                <div id="profesores_titulares">
                    <label for="idProfesorSustituto" class="form-label">Seleccionar Profesor Titular</label>
                    <select class="form-select" id="idProfesorSustituto" name="idProfesorSustituto">
                        <?php foreach ($profesoresTitulares as $profesor): ?>
                            <option value="<?php echo $profesor['idProfesor']; ?>">
                                <?php echo $profesor['nombre'] . ' ' . $profesor['apellidos']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary" name="btn">Añadir Profesor</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='../../index.php'">Cancelar</button>
        </form>
    </div>
</body>
</html>
