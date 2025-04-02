<?php
/**
 * Clase controlador de Asignaturas que funciona como intermediario entre las vistas y el modelo 
 * pasando información entre ellas. 
 */
class ControladorAsignatura {
    private $modelo;

    /**
     * Metodo que se realiza siempre al instaciar el controlador
     *
     * @param [Integer] $modelo Datos de la conexion
     */
    public function __construct($modelo) {
        $this->modelo = $modelo;
    }

    /**
     * Llama al modelo y retorna los datos que recibe del modelo 
     *
     * @return Array Array asociativo donde estan las filas de las asignaturas que hay 
     */
    public function listarAsignaturas() {
        return $this->modelo->obtenerAsignaturas();
    }

    /**
     * Se obtienen los datos de la asignatura que se ah escogiso para 
     *
     * @param [type] $id
     * @return void
     */
    public function obtenerDatosEditarAsignatura($id) {
        return $this->modelo->obtenerAsignaturaPorId($id);
    }

    public function editarAsignatura($id, $codigo, $nombre, $tipo) {
        return $this->modelo->actualizarAsignatura($id, $codigo, $nombre, $tipo);
    }

    public function agregarAsignatura($codigo, $nombre, $tipo) {
        return $this->modelo->agregarAsignatura($codigo, $nombre, $tipo);
    }

    public function eliminarAsignatura($id) {
        return $this->modelo->eliminarAsignatura($id);
    }
}
?>
