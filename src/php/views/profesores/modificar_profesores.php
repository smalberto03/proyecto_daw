<?php
// modificar_profesor.php
require_once '../../config/configdb.php';
require '../../models/Profesor.php';
require_once '../../controllers/ProfesoresController.php';

//$pdo = conectar();
//$model = new Profesor($db);
$controller = new ProfesoresController($conn);
$id = $_GET['id'];



    $profesores = $controller->mostrarFormularioModificar($_GET['id']);
    
?>  
<?php
//require_once 'controller/ProfesorController.php';

//$controller = new ProfesoresController();
$id = $_GET['id'];
$profesor = $controller->mostrarFormularioModificar($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Profesor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="logo.png" alt="Logo Escuela Virgen de Guadalupe">
        </div>
        <h1>Escuela Virgen de Guadalupe</h1>
    </header>
    <nav class="navbar">
        <a href="#" class="nav-item">Gestionar usuarios</a>
        <a href="#" class="nav-item active">Profesores</a>
        <a href="#" class="nav-item">Gestión horario</a>
        <a href="#" class="nav-item">Horas especiales</a>
    </nav>
    <main class="main-content">
        <div class="card">
            <h2>Modificar Profesor</h2>
            <form action="procesar_modificacion_profesor.php" method="post" class="professor-form">
                <input type="hidden" name="id" value="<?php echo $profesor['idProfesor']; ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $profesor['nombre']; ?>" required>

                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo $profesor['apellidos']; ?>" required>

                <label for="nombreusuario">Nombre de Usuario:</label>
                <input type="text" id="nombreusuario" name="nombreusuario" value="<?php echo $profesor['nombreusuario']; ?>" required>

                <label for="pass">Contraseña:</label>
                <input type="password" id="pass" name="pass" value="<?php echo $profesor['pass']; ?>" required>

                <label for="imagen">Imagen (URL):</label>
                <input type="text" id="imagen" name="imagen" value="<?php echo $profesor['imagen']; ?>" required>

                <label for="tipo">¿Es profesor sustituto?</label>
                <input type="checkbox" id="tipo" name="tipo" <?php echo $profesor['tipo'] == 1 ? 'checked' : ''; ?>>

                <?php if ($profesor['tipo'] == 1): ?>
                    <label for="idProfesorSustituto">Profesor Sustituido (ID):</label>
                    <input type="text" id="idProfesorSustituto" name="idProfesorSustituto" value="<?php echo $profesor['idProfesorSustituto']; ?>" required>
                <?php endif; ?>

                <div class="button-group">
                    <button type="button" class="btn cancel-btn" onclick="window.location.href='consulta_profesores.php'">Cancelar</button>
                    <button type="submit" class="btn add-btn">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>

        


   

