<?php
require_once __DIR__ . '/../config/configdb.php';

class HorarioModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

   public function obtenerHorarioPorProfesor($idProfesor) {
        // Verificar si el profesor es sustituto
        $consultaVerificacion = "SELECT tipo, idProfesorSustituto FROM Profesores WHERE idProfesor = ?";
        $stmtVerificacion = $this->conn->prepare($consultaVerificacion);
        $stmtVerificacion->bind_param("i", $idProfesor);
        $stmtVerificacion->execute();
        $resultadoVerificacion = $stmtVerificacion->get_result();
        $profesor = $resultadoVerificacion->fetch_assoc();

        if ($profesor['tipo'] == 1 && $profesor['idProfesorSustituto'] !== null) {
            // Si es sustituto, obtener el horario del profesor titular al que sustituye
            $idProfesorTitular = $profesor['idProfesorSustituto'];
        } else {
            // Si no es sustituto, usar el id del profesor seleccionado
            $idProfesorTitular = $idProfesor;
        }

        $consultaHorario = "SELECT h.diaSemana, h.hora, a.nombreAsignatura, a.tipo AS tipoAsignatura, a.idAsignatura, s.nombreSeccion, p.tipo AS tipoProfesor, p.idProfesorSustituto
                FROM Horarios h
                JOIN Asignaturas a ON h.idAsignatura = a.idAsignatura
                JOIN Secciones s ON h.idSeccion = s.idSeccion
                JOIN Profesores p ON h.idProfesor = p.idProfesor
                WHERE h.idProfesor = ?
                ORDER BY h.diaSemana, h.hora";
        $stmtHorario = $this->conn->prepare($consultaHorario);
        $stmtHorario->bind_param("i", $idProfesorTitular);
        $stmtHorario->execute();
        $resultadoHorario = $stmtHorario->get_result();
        return $resultadoHorario->fetch_all(MYSQLI_ASSOC);
    }




    public function obtenerHorarioPorSeccion($idSeccion) {
        $query = "SELECT h.diaSemana, h.hora, a.nombreAsignatura, p.cod_profesor
                  FROM Horarios h
                  JOIN Asignaturas a ON h.idAsignatura = a.idAsignatura
                  JOIN Profesores p ON h.idProfesor = p.idProfesor
                  WHERE h.idSeccion = ?
                  ORDER BY h.diaSemana, h.hora";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idSeccion);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerProfesores() {
        $query = "SELECT idProfesor as id, nombre as name, apellidos as lastname, tipo, idProfesorSustituto FROM Profesores
                  WHERE tipo=0 AND idProfesor NOT IN (SELECT idProfesorSustituto FROM Profesores WHERE idProfesorSustituto IS NOT NULL)
                  OR tipo=1";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerSecciones() {
        $query = "SELECT idSeccion as id, nombreSeccion as name FROM Secciones";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function borrarHorarios()
    {
        $query = "TRUNCATE TABLE Horarios";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function obtenerAsignaturasEspeciales() {
        $query = "SELECT idAsignatura, nombreAsignatura, tipo FROM Asignaturas WHERE tipo = 'e'";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // public function obtenerSecciones() {
    //     $query = "SELECT idSeccion, nombreSeccion FROM Secciones";
    //     $result = $this->conn->query($query);
    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }

    public function insertarHorario($diaSemana, $hora, $idAsignatura, $idSeccion, $idProfesor) {
        // Obtener el ID del último curso creado
        $queryCurso = "SELECT idCurso FROM Cursos ORDER BY idCurso DESC LIMIT 1";
        $resultCurso = $this->conn->query($queryCurso);
        $curso = $resultCurso->fetch_assoc();
        $idCurso = $curso['idCurso'];

        try {
            // Insertar una nueva fila en la tabla Horarios
            $query = "INSERT INTO Horarios (diaSemana, hora, idAsignatura, idSeccion, idCurso, idProfesor) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("iiiiii", $diaSemana, $hora, $idAsignatura, $idSeccion, $idCurso, $idProfesor);
            $stmt->execute();

            return ["success" => true];
        } catch (mysqli_sql_exception $e) {
            // Verificar si el error es debido a una violación de clave única
            if ($e->getCode() == 1062) { // 1062 es el código de error para violación de clave única en MySQL
                return ["success" => false, "message" => "Error: Ya existe un horario para esta sección en el día y hora especificados."];
            } else {
                return ["success" => false, "message" => "Error al insertar el horario: " . $e->getMessage()];
            }
        }
    }


    public function eliminarHorario($diaSemana, $hora, $idAsignatura, $idProfesor) {
    try {
        // Obtener el ID del último curso creado
        $queryCurso = "SELECT idCurso FROM Cursos ORDER BY idCurso DESC LIMIT 1";
        $resultCurso = $this->conn->query($queryCurso);
        $curso = $resultCurso->fetch_assoc();
        $idCurso = $curso['idCurso'];

        // Eliminar la fila de la tabla Horarios
        $query = "DELETE FROM Horarios WHERE diaSemana = ? AND hora = ? AND idAsignatura = ? AND idProfesor = ? AND idCurso = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiiii", $diaSemana, $hora, $idAsignatura, $idProfesor, $idCurso);
        $stmt->execute();

        return ["success" => true];
        } catch (mysqli_sql_exception $e) {
            return ["success" => false, "message" => "Error al eliminar el horario: " . $e->getMessage()];
        }
    }


    public function obtenerIdAsignaturaPorCodigo($codigoAsignatura) {
        $query = "SELECT idAsignatura FROM Asignaturas WHERE codigoAsignatura = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $codigoAsignatura);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['idAsignatura'] : null;
    }

    public function obtenerIdProfesorPorCodigo($codigoProfesor) {
        $query = "SELECT idProfesor FROM Profesores WHERE cod_profesor = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $codigoProfesor);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['idProfesor'] : null;
    }

    public function obtenerIdSeccionPorCodigo($codigoSeccion) {
        $query = "SELECT idSeccion FROM Secciones WHERE codigo_seccion = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $codigoSeccion);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['idSeccion'] : null;
    }


}
?>
