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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action='modificar_profesor.php' method='post'>
            Código: <input type='text' name='cod_profesor' value='<?php foreach($profesores as $profesor){echo $profesor['cod_profesor'];} ?>'><br>
            Nombre: <input type='text' name='nombre' value='<?php foreach($profesores as $profesor){echo $profesor['nombre'];} ?>'><br>
            Apellidos: <input type='text' name='apellidos' value='<?php foreach($profesores as $profesor){echo $profesor['apellidos'];} ?>'><br>
            Nombre de Usuario: <input type='text' name='nombreusuario' value='<?php foreach($profesores as $profesor){echo $profesor['email'];} ?>'><br>
            Contraseña: <input type='password' name='pass' value='<?php foreach($profesores as $profesor){echo $profesor['pass'];} ?>'><br>
            Tipo: <input type='checkbox' name='tipo' value='<?php foreach($profesores as $profesor){echo $profesor['tipo'] == 1 ? 'checked' : '';} ?>'><br>
            Imagen: <input type='text' name='imagen' value='<?php foreach($profesores as $profesor){echo $profesor['imagen'];} ?>'><br>
            ID Sustituto: <input type='number' name='idProfesorSustituto' value='<?php echo htmlspecialchars($profesor['idProfesorSustituto']); ?>'><br>
                <?php if ($profesor['tipo'] == 1 && $profesor['idProfesorSustituto'] !== null): ?>
                    Profesor Sustituido: <?php echo htmlspecialchars($profesor['nombre']); ?>
                <?php endif; ?>
        </form>
</body>
</html>
        


   

