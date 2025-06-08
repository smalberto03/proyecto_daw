CREATE TABLE Cursos(
    idCurso tinyint NOT NULL,
    codigo_curso char(3) NOT NULL,
    nombreCurso char(5) NOT NULL,
	CONTRAINT pk PRIMARY KEY (idCurso)
);

CREATE TABLE Asignaturas(
	idAsignatura tinyint NOT NULL,
	codigo_asignatura char(4) NOT NULL,
	nombreAsignatura varchar(16) NOT NULL,
	tipo char(1) NOT NULL CHECK(tipo IN('e','l')),
	CONTRAINT pk PRIMARY KEY (idAsignatura)
);

CREATE TABLE AsignaturasLectivas (
	idAsignatura TINYINT PRIMARY KEY NOT NULL,
	CONSTRAINT fk_asignaturaslectivas FOREIGN KEY (idAsignatura) REFERENCES Asignaturas(idAsignatura)
);

CREATE TABLE AsignaturasEspeciales (
	idAsignatura TINYINT PRIMARY KEY NOT NULL,
	descripcion VARCHAR(200) NULL,
	CONSTRAINT fk_asignaturasespeciales FOREIGN KEY idAsignatura REFERENCES Asignaturas(idAsignatura)
);
	
CREATE TABLE Profesores (
	idProfesores TINYINT NOT NULL AUTO_INCREMENT,
	cod_profesor CHAR(3) NOT NULL,
	nombre VARCHAR(100) NOT NULL,
	apellidos VARCHAR(100) NOT NULL,
	nombreususario VARCHAR(150) NOT NULL,
	pass VARCHAR(255) NOT NULL,
	tipo BOOLEAN NOT NULL,
	CONSTRAINT pk1_profesores PRIMARY KEY (idProfesores, cod_profesor)profesores
	-- CONSTRAINT pk2_profesores PRIMARY KEY (cod_profesor)
); 
	
CREATE TABLE Horarios(
	idHorario tinyint NOT NULL AUTO_INCREMENT,
	diaSemana char(1) NOT NULL CHECK (diaSemana BETWEEN 1 and 5),
	hora char(1) NOT NULL CHECK(hora BETWEEN 1 AND 7),
    idAsignatura tinyint NOT NULL,
    idProfesor tinyint NOT NULL,
    idCurso tinyint NOT NULL,
    CONSTRAINT pk_horarios PRIMARY KEY (idHorario),
    CONSTRAINT fk_asignaturas FOREIGN KEY (idAsignatura) REFERENCES Asignaturas(idAsignatura),
    CONSTRAINT fk_profesores FOREIGN KEY (idProfesor) REFERENCES Profesores(idProfesor),
    CONSTRAINT fk_cursos FOREIGN KEY (idCurso) REFERENCES Cursos(idCurso),
    CONSTRAINT csu_horarios UNIQUE (diaSemana, hora, idProfesor)
);
