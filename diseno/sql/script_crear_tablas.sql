/*CREATE TABLE Cursos (
	idCurso TINYINT PRIMARY KEY NOT NULL,
	codigo_curso CHAR(3) NOT NULL,
	nombreCurso CHAR(5) NOT NULL 
);

CREATE TABLE Asignaturas (
	idAsignatura TINYINT PRIMARY KEY NOT NULL,
	codigo_asignatura CHAR(4) NOT NULL,
	nombreAsignatura VARCHAR(16) NOT NULL,
	tipo CHAR(1) NOT NULL CHECK(tipo IN('e', 'l'))
);

CREATE TABLE AsignaturasLectivas (
	idAsignatura TINYINT PRIMARY KEY NOT NULL,
	CONSTRAINT fk_asignaturaslectivas FOREIGN KEY (idAsignatura) REFERENCES Asignaturas(idAsignatura)
);*/

CREATE TABLE AsignaturasEspeciales (
	idAsignatura TINYINT PRIMARY KEY NOT NULL,
	descripcion VARCHAR(200) NULL,
	CONSTRAINT fk_asignaturasespeciales FOREIGN KEY idAsignatura REFERENCES Asignaturas(idAsignatura)
);

CREATE TABLE Horarios (
	idHorario TINYINT PRIMARY KEY NOT NULL,
	diaSemana CHAR(1) NOT NULL 