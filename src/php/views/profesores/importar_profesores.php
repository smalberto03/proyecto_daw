<?php
require_once '../../config/configdb.php';
require_once '../../models/Profesor.php';
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

$controller = new ProfesoresController($conn);

if (isset($_FILES['archivo_profesores']) && $_FILES['archivo_profesores']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['archivo_profesores']['tmp_name'];
    $controller->anadir_desde_exportacion($fileTmpPath);
    //header('Location: ')
}



































































// $controller = new ProfesoresController($conn);

// if (isset($_FILES['archivo_profesores']) && $_FILES['archivo_profesores']['error'] == UPLOAD_ERR_OK) {
//     $fileTmpPath = $_FILES['archivo_profesores']['tmp_name'];
//     $fileExtension = pathinfo($_FILES['archivo_profesores']['name'], PATHINFO_EXTENSION);

//     // if ($fileExtension != '.csv') {
//     //     die("Error: El archivo debe ser un .csv");
//     // }

//     if(($handle = fopen($fileTmpPath, "r")) !== FALSE) {
//         // Ignorar la primera fila si contiene encabezados
//         //fgetcsv($handle, 1000, ";");

//         while(($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
//             // Asegúrate de que el archivo tiene las columnas correctas
//             if(count($data) < 7) {
//                 die("Error: El archivo no tiene el formato correcto.");
//             }

            
//             list($cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $tipo, $imagen) = $data; 

//             //echo($nombre);

//             // Determinar idProfesorSustituto basado en el tipo
//             $idProfesorSustituto = ($tipo == 0) ? null : $data[7] ?? null;

//             // Insertar el profesor en la base de datos
//             $controller->anadir_desde_exportacion($cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto);
//         }
//         fclose($handle);
//     } else {
//         die("Error al abrir el archivo.");
//     }

//     header("Location: http://localhost/proyecto_daw_2425_def/src/php/index.php");
//     exit();
// } else {
//     echo "Error al subir el archivo.";
// }
// ?>
