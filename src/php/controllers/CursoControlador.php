<?php
require_once __DIR__ . '/../models/CursoModelo.php';

class CursoControlador {
    private $model;

    public function __construct() {
        $this->model = new CursoModelo();
    }

    public function mostrarFormularioAlta() {
        require_once 'view/alta_curso.php';
    }

    public function procesarAltaCurso($fechaInicio, $fechaFin, $descripcion) {
        // Borrar profesores y horarios
        $this->model->borrarProfesores();
        $this->model->borrarHorarios();

        // Añadir el nuevo curso
        $this->model->addCurso($fechaInicio, $fechaFin, $descripcion);

        header("Location: http://localhost/proyecto_daw_2425_def/src/php/index.php");
    } 

    public function mostrarUltimoCurso() {
        $ultimoCurso = $this->model->getUltimoCurso();
        require_once '../views/profesores/consulta_profesores.php';
    }

    public function procesarModificacionCurso($idCurso, $descripcion) {
        $this->model->updateCurso($idCurso, $descripcion);
        header("Location: consulta_profesores.php");
    }
}
?>
