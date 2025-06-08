<?php
require '../../config/config_horas.php';
require '../../models/ModeloAsignatura.php';
require '../../controllers/ControladorAsignatura.php';

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

$baseDeDatos = new BaseDeDatos();
$modelo = new ModeloAsignatura($baseDeDatos->obtenerConexion());
$controlador = new ControladorAsignatura($modelo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo_csv'])) {
    $archivo = $_FILES['archivo_csv']['tmp_name'];

    if(($gestor = fopen($archivo, "r")) !== FALSE) {
        // Leer y omitir la primera fila (encabezados)
        //fgetcsv($gestor, 1000, ",");

        $controlador->procesoImportar();

        while (($datos = fgetcsv($gestor, 1000, ";", "'")) !== FALSE) {
            // Verificar que el array tenga al menos 3 elementos
            //if (count($datos) >= 3) {
                $codigo = mb_convert_encoding($datos[0], 'UTF-8', 'ISO-8859-1');
                $nombre = mb_convert_encoding($datos[1], 'UTF-8', 'ISO-8859-1');
                $nivel = mb_convert_encoding($datos[2], 'UTF-8', 'ISO-8859-1'); // Campo nivel

                // Insertar los datos en la base de datos
                $controlador->importarAsignatura($codigo, $nombre, $nivel);
            //}
        }
        fclose($gestor); // Cerrar el archivo
    }

    header('Location: listaAsignatura.php');
}
?>
