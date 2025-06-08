<?php
require_once __DIR__ . '/../models/SeccionModel.php';

class SeccionController {
    private $model;

    public function __construct() {
        $this->model = new SeccionModel();
    }

    public function mostrarSecciones() {
        $secciones = $this->model->getAllSecciones();
        return $secciones;
        //require_once '../views/secciones/consulta_secciones.php';
    }

    public function mostrarFormularioModificar($id) {
        $seccion = $this->model->getSeccionById($id);
        return $seccion;
    }

    public function procesarModificacionSeccion($id, $codigo_seccion, $nombreSeccion) {
        return $this->model->updateSeccion($id, $codigo_seccion, $nombreSeccion);
        //header('Location: ../views/secciones/consulta_seccion.php');
    }

    public function borrarSeccion($id) {
        $this->model->deleteSeccion($id);
        header("Location: consulta_seccion.php");
    }

    public function procesarAltaSeccion($codigo_seccion, $nombreSeccion) {
        $this->model->addSeccion($codigo_seccion, $nombreSeccion);
        header("Location: consulta_seccion.php");
    }

    public function procesarImportacionSecciones($filePath) {
        $this->model->importarSecciones($filePath);
        header("Location: consulta_seccion.php");
    }
}
?>

