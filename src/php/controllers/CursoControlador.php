<?php
require_once __DIR__ . '/../models/CursoModelo.php';

/**
 * Clase Controlador del curso
 */
class CursoControlador {
    private $model;

    /**
     * Constructor por defecto
     */
    public function __construct() {
        $this->model = new CursoModelo();
    }

    /**
     * Manda a la vista donde esta el formulario para añadir curso
     *
     * @return void
     */
    public function mostrarFormularioAlta() {
        require_once 'view/alta_curso.php';
    }

    /**
     * Va al modelo para borrar filas 
     *
     * @param [date] $fechaInicio Fecah Inicio
     * @param [date] $fechaFin Fecha fin
     * @param [String] $descripcion Desxripcion 
     * @return void
     */
    public function procesarAltaCurso($fechaInicio, $fechaFin, $descripcion) {

        if(strtotime($fechaInicio) >= strtotime($fechaFin)) {
            echo "La fecha de inicio debe ser anterior a la fecha de fin.";
            return;
        }

        // Borrar profesores y horarios
        $this->model->borrarHorarios();

        $this->model->borrarProfesores(); //EN ESTA FUNCION SE BORRAN LOS PROFESORES SUSTITUTOS

        $this->model->borrarProfesoresTitulares(); //EN ESTA FUNCION SE BORRA LOS PROFESORES TITULARES 
        
        //$this->reinicioCurso();

        // Añadir el nuevo curso
        $this->model->addCurso($fechaInicio, $fechaFin, $descripcion);

        header("Location: http://localhost/proyecto_daw_2425_def/src/php/index.php");
    } 

    /**
     * Va al modelo y trae ña fila con el ultimo curso añadido
     *
     * @return void
     */
    public function mostrarUltimoCurso() {
        return $this->model->getUltimoCurso();
    }

    /**
     * Para modificar el curso 
     *
     * @param [Integer] $id
     * @param [date] $fechaInicio
     * @param [date] $fechaFin
     * @param [String] $descripcion
     * @return void
     */
    public function procesarModificacionCurso($id, $fechaInicio, $fechaFin, $descripcion) {
        return $this->model->updateCurso($id, $fechaInicio, $fechaFin, $descripcion);
    } 

    /**
     * Cuando se añade un nuevo curso se reinicia el curso 
     */
    public function reinicioCurso()
    {
        $this->model->reinicioCurso();
    }
}
?>
