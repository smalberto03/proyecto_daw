<?php
require_once __DIR__ . '/../../controllers/HorarioController.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: views/inicio_sesion/inicio_sesion.php');
    //exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excel-file'])) {
    $file = $_FILES['excel-file']['tmp_name'];
    $handle = fopen($file, "r");

    $controller = new HorarioController();

    // Leer el archivo línea por línea
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        // Asumiendo que el orden de las columnas es: diaSemana, hora, codigoAsignatura, cod_profesor, codigo_seccion
        $diaSemana = $data[0];
        $hora = $data[1];
        $codigoAsignatura = $data[2];
        //$cod_profesor = mb_convert_encoding($data[3], 'UTF-8', 'ISO-8859-1');
        $cod_profesor = preg_replace('/\s+/u', '', $data[3]);
        //$cod_profesor = $data[3];
        $codigo_seccion = $data[4];
        //$nombre = mb_convert_encoding($datos[1], 'UTF-8', 'ISO-8859-1');

        // Obtener IDs a partir de los códigos
        $idAsignatura = $controller->obtenerIdAsignaturaPorCodigo($codigoAsignatura);
        $idProfesor = $controller->obtenerIdProfesorPorCodigo($cod_profesor);
        $idSeccion = $controller->obtenerIdSeccionPorCodigo($codigo_seccion);

        if($idAsignatura && $idProfesor && $idSeccion) {
            // Insertar en la base de datos
            $controller->insertarHorario2($diaSemana, $hora, $idAsignatura, $idSeccion, $idProfesor);
        }else{
            echo "Error: No se encontraron IDs para los códigos proporcionados en la línea: " . implode(",", $data) . "<br>";
            echo $idAsignatura.'</br>';
            echo $idProfesor.'</br>';
            echo $idSeccion.'</br>';
        }
    }

    fclose($handle);

    echo "Archivo procesado y datos insertados correctamente.";
} else {
    echo "Error al subir el archivo.";
}
?>
