<?php
require_once __DIR__ . '/../config/configdb.php';
require_once __DIR__ . '/../models/Profesor.php';

/**
 * Clase Controlador de profesores, intermediario entre las vistas y el modelo 
 * encargado de los datos de profesores
 */
class ProfesoresController {
    private $model;

    /**
     * Contructor siemore que se instacie un objeto de la clasde ProfesoresController
     * se realiza una intacias del modelo de profesores 
     * @param [type] $db
     */
    public function __construct($db) {
        $this->model = new Profesor($db);
    }

    /**
     * LLama al modelo que realizará una consulta para mostrar profesores 
     *
     * @return void
     */
    public function mostrarProfesores() {
        $profesores = $this->model->obtenerProfesores();
        require_once __DIR__ . '/../views/profesores/consulta_profesores.php';
    }

    /**
     * Llama al modelo para traer las filas de los profesores que tenga el campo 
     * tipo = 0
     *
     * @return [Array Asociativo] Array que trae las filas de los profesores titulares 
     */
    public function obtenerTitulares() {
        return $this->model->obtenerTitulares();
    }

    public function addProfesor($cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto) {
        // Ruta de destino local
        $target_dir = __DIR__ . "/../../../diseno/imagenes/";
        $target_file = $target_dir . basename($imagen["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validar el formato del correo electrónico
        if (!filter_var($nombreusuario, FILTER_VALIDATE_EMAIL) || !preg_match('/@fundacionloyola\.com$/', $nombreusuario)) {
            echo "<h3>El correo electrónico debe ser válido y tener el dominio @fundacionloyola.com</h3>";
            return;
        }

        // Validar la contraseña
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]).{8,}$/', $pass)) {
            echo "<h3>La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un carácter especial.</h3>";
            return;
        }

        // Validar el tipo de archivo de imagen
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $valid_extensions)) {
            echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            return;
        }

        // Mover la imagen al directorio de carga
        if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            echo "Hubo un error al subir la imagen.";
            return;
        }

        // Encriptar la contraseña
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // Determinar el tipo de profesor y el idProfesorSustituto
        if ($tipo == 'on') {
            $tipo_value = 1;
        } else {
            $tipo_value = 0;
            $idProfesorSustituto = null;
        }

        $this->model->addProfesor($cod_profesor, $nombre, $apellidos, $nombreusuario, $hashed_password, $image_path, $tipo_value, $idProfesorSustituto);

        header('Location: ../../index.php');
    }

    public function anadir_desde_exportacion($filePath) {
        $this->model->importarProfesor($filePath);
        header('Location: ../../index.php');
    }

    public function mostrarFormularioModificar($id) {
        $profesor = $this->model->getProfesorById($id);
        $titulares = $this->model->obtenerTitulares();

        // Verifica si se obtuvo el profesor
        if (!$profesor) {
            echo "Profesor no encontrado.";
            exit;
        }

        // Pasa los datos a la vista
        //require_once __DIR__ . '/../views/profesores/modificar_profesores.php'; 
        return $profesor;
    }

    public function procesarModificacionProfesor($id, $cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto) {
        
        // Ruta de destino local
        $target_dir = __DIR__ . "/../../../diseno/imagenes/";
        $target_file = $target_dir . basename($imagen["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validar el formato del correo electrónico
        if (!filter_var($nombreusuario, FILTER_VALIDATE_EMAIL) || !preg_match('/@fundacionloyola\.com$/', $nombreusuario)) {
            echo "El correo electrónico debe ser válido y tener el dominio @fundacionloyola.com.";
            return;
        }

        // Validar el tipo de archivo de imagen
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $valid_extensions)) {
            echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            return;
        }

        // Mover la imagen al directorio de carga
        if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            echo "Hubo un error al subir la imagen.";
            return;
        }

        // Determinar el tipo de profesor y el idProfesorSustituto
        if ($tipo == 'on') {
            $tipo_value = 1;
        } else {
            $tipo_value = 0;
            $idProfesorSustituto = null;
        }

        $this->model->updateProfesor($id, $cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $image_path, $tipo_value, $idProfesorSustituto);

        header('Location: ../../index.php');
    }

    public function borrarProfesor($id) {
        $this->model->deleteProfesor($id);
    }
}
?> 
