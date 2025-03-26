<?php
require_once __DIR__ . '/../config/configdb.php';
require_once __DIR__ . '/../models/Profesor.php';

class ProfesoresController {
    private $model;

    public function __construct($db) {
        $this->model = new Profesor($db);
    }

    public function mostrarProfesores() {
        $profesores = $this->model->obtenerProfesores();
        require_once __DIR__ . '/../views/profesores/consulta_profesores.php';
    }

    public function obtenerTitulares() {
        return $this->model->obtenerTitulares();
    }

    public function addProfesor($cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $idProfesorSustituto) {     
            $cod_profesor = $_POST['cod_profesor'];
            $nombre =$_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $nombreusuario = $_POST['nombreusuario'];
            $pass = $_POST['pass'];
            //$tipo = $_POST['tipo'];
            $imagen = $_POST['imagen'];
            //$idProfesorSustituto = isset($_POST['idProfesorSustituto']) ? $_POST['idProfesorSustituto'] : null;
            //$idProfesorSustituto = $_POST["idProfesorSustituto"];

            if($idProfesorSustituto==null)
            {
                $metodo = $this->model->addProfesor($cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, 0, null);
            }else{
                $metodo = $this->model->addProfesor($cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, 1, $idProfesorSustituto);
            }
            
            // if($this->model->addProfesor($cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $tipo, $imagen, $idProfesorSustituto)) {
            //     echo "Profesor añadido exitosamente.";
            // } else {
            //     echo "Error al añadir el profesor.";
            // }
    }

    public function anadir_desde_exportacion($cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto)
    {
        $metodo = $this->model->addProfesor($cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $imagen, $tipo, $idProfesorSustituto);
    }

    public function mostrarFormularioModificar($id) {
        return $this->model->getProfesorById($id);
        //var_dump($profesor);
    }

    public function guardarModificaciones($id, $cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $tipo, $imagen, $idProfesorSustituto) {
        $this->model->updateProfesor($id, $cod_profesor, $nombre, $apellidos, $nombreusuario, $pass, $tipo, $imagen, $idProfesorSustituto);
    }

    public function borrarProfesor($id) {
        $this->model->deleteProfesor($id);
    }
}
?>

