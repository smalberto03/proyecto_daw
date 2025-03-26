<?php
require_once '../../config/configdb.php';
require_once '../../controllers/ProfesoresController.php';

// Conexión a la base de datos y obtención de profesores titulares
$controller = new ProfesoresController($conn);
$profesoresTitulares = $controller->obtenerTitulares();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link rel="stylesheet" href="../../../css/style.css">
    <title>Añadir Profesor</title>
</head>
<body>
    <div class="container">
        <h1>Añadir Profesor</h1>
        <form action="" method="POST">
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
                <label for="imagen" class="form-label">URL de Imagen</label>
                <input type="text" class="form-control" id="imagen" name="imagen" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="tipo" name="tipo">
                <label class="form-check-label" for="tipo">Sustituto</label>
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
            <button type="submit" class="btn btn-primary" name="btn">Guardar</button>
        </form>
        <?php
            if(isset($_POST["btn"]))
            {
                if(!isset($_POST["tipo"]))
                {
                    $metdo = $controller->addProfesor($_POST['cod_profesor'], $_POST['nombre'], $_POST['apellidos'], $_POST['nombreusuario'], $_POST['pass'], $_POST['imagen'], null);
                }
                else{
                    $metdo = $controller->addProfesor($_POST['cod_profesor'], $_POST['nombre'], $_POST['apellidos'], $_POST['nombreusuario'], $_POST['pass'], $_POST['imagen'], $_POST['idProfesorSustituto']); 
                }
                //$objeto = new ProfesoresController();

                
            }
        ?>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>




