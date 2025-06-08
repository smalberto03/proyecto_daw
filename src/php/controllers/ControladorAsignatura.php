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

    /**
     * Funcion encargada de traer los datos que se han colocado en el formualrio
     * de modificacion de Asiganturas llevarlos al modelo para que este haga 
     * lo oportuno con esos datos
     *
     * @param [Integer] $id Identificativo 
     * @param [String] $codigo Codigo de la asigantura
     * @param [String] $nombre Nombre de la asignatura 
     * @param [String] $tipo Si la asigantura es especial o lectiva 
     * @return void No hace falta que devuelva nada 
     */
    public function editarAsignatura($id, $codigo, $nombre, $tipo) {
        return $this->modelo->actualizarAsignatura($id, $codigo, $nombre, $tipo);
    }

    /**
     * Funcion que coje los datos introducidos por el usuairo 
     * para añadir una nueva asigantura y mandarlos al modelo 
     * para insertar la fila en la bbdd. Luego manda al usuario 
     * a la vista donde aparecen las asignaturas 
     * @param [String] $codigo Codigo de la asigantura
     * @param [String] $nombre Nombre de la asignatura 
     * @param [String] $tipo Si la asigantura es especial o lectiva 
     * @return void No hace falta que devuelva nada 
     */
    public function agregarAsignatura($codigo, $nombre, $tipo) {
        return $this->modelo->agregarAsignatura($codigo, $nombre, $tipo);
        header('Location: ../../views/asignaturas/listaAsignatura.php');
    }

    /**
     * Va al modelo para borrar la fila trayendo el valor 
     * del id
     *
     * @param [Integer] $id Identificativo de la asigantura para saber cual hay que borrar 
     * @return void
     */
    public function eliminarAsignatura($id) {
        return $this->modelo->eliminarAsignatura($id);
        //header('Location: ../views/asignaturas/listaAsignatura.php');
    }

    public function procesoImportar()
    {
        $this->modelo->procesoImportar();
    }

    /**
     * Función para importar una asignatura. Todas las asiganturas que se importen 
     * son directamente del tipo lectivo
     *
     * @param [String] $codigo codigo identificativo 
     * @param [String] $nombre nombre de la signatura 
     * @param [String] $nivel aula o clase en la que se impoarte 
     * @return void
     */
    public function importarAsignatura($codigo, $nombre, $nivel) {
        $tipo = 'l'; // Siempre guardamos 'l' en el campo tipo
        return $this->modelo->importarAsignatura($codigo, $nombre, $nivel, $tipo);
    }
}
?>
