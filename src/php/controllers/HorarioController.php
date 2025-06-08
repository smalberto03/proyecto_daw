<?php
require_once __DIR__ . '/../models/HorarioModel.php';

class HorarioController {
    private $model;

    public function __construct() {
        $this->model = new HorarioModel();
    }

    public function mostrarHorario() {
        $horario = [];
        if(isset($_GET['tipo']) && isset($_GET['id'])) {
            $tipo = $_GET['tipo'];
            $id = $_GET['id'];

            if ($tipo == 'profesor') {
                $horario = $this->model->obtenerHorarioPorProfesor($id);
            } elseif ($tipo == 'seccion') {
                $horario = $this->model->obtenerHorarioPorSeccion($id);
            }

            header('Content-Type: application/json');
            echo json_encode($horario);
            exit;
        } else {
            echo json_encode(["error" => "Hay que pulsar el botón"]);
        }
    }

    public function obtenerOpcionesPorTipo($tipo) {
        if ($tipo == 'profesor') {
            return $this->model->obtenerProfesores();
        } elseif ($tipo == 'seccion') {
            return $this->model->obtenerSecciones();
        }
        return [];
    }

    public function obtenerAsignaturasEspeciales() {
        return $this->model->obtenerAsignaturasEspeciales();
    }

    public function obtenerSecciones() {
        return $this->model->obtenerSecciones();
    }

    public function insertarHorario($diaSemana, $hora, $idAsignatura, $idSeccion, $idProfesor) {
        $result = $this->model->insertarHorario($diaSemana, $hora, $idAsignatura, $idSeccion, $idProfesor);

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function insertarHorario2($diaSemana, $hora, $idAsignatura, $idSeccion, $idProfesor) {
        $result = $this->model->insertarHorario($diaSemana, $hora, $idAsignatura, $idSeccion, $idProfesor);
    }

    public function eliminarHorario($diaSemana, $hora, $idAsignatura, $idProfesor) {
        $result = $this->model->eliminarHorario($diaSemana, $hora, $idAsignatura, $idProfesor);

        return $result;
    }

    public function obtenerIdAsignaturaPorCodigo($codigoAsignatura) {
        return $this->model->obtenerIdAsignaturaPorCodigo($codigoAsignatura);
    }

    public function obtenerIdProfesorPorCodigo($codigoProfesor) {
        return $this->model->obtenerIdProfesorPorCodigo($codigoProfesor);
    }

    public function obtenerIdSeccionPorCodigo($codigoSeccion) {
        return $this->model->obtenerIdSeccionPorCodigo($codigoSeccion);
    }


}
?>

