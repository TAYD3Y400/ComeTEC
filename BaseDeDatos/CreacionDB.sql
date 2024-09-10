CREATE DATABASE cometec_DB;

USE cometec_DB;
                        
CREATE TABLE Administrador(ID INT PRIMARY KEY AUTO_INCREMENT,
						usuario VARCHAR(50),
                        contrasena VARCHAR(50));

CREATE TABLE Estudiante(ID INT PRIMARY KEY AUTO_INCREMENT,
						nombre VARCHAR(100),
                        apellidos VARCHAR(100),
						identificacion VARCHAR(50));
                        
CREATE TABLE Institucion(ID INT PRIMARY KEY AUTO_INCREMENT,
						usuario VARCHAR(50),
                        contrasena VARCHAR(50),
                        nombre VARCHAR(50),
                        estado BIT);

CREATE TABLE Grado(ID INT PRIMARY KEY AUTO_INCREMENT,
					nombre VARCHAR(200));

CREATE TABLE Equipo(ID INT PRIMARY KEY AUTO_INCREMENT,
					institucionID INT,
					gradoID INT,
                    nombre VARCHAR(200),
                    codigo VARCHAR(50),
					FOREIGN KEY (gradoID) REFERENCES Grado(ID),
                    FOREIGN KEY (institucionID) REFERENCES Institucion(ID));

CREATE TABLE EstudianteXEquipo(ID INT PRIMARY KEY AUTO_INCREMENT,
                    estudianteID INT,
                    equipoID INT,
                    FOREIGN KEY (estudianteID) REFERENCES Estudiante(ID),
                    FOREIGN KEY (equipoID) REFERENCES Equipo(ID));
                                
CREATE TABLE Examen(ID INT PRIMARY KEY AUTO_INCREMENT,
					gradoID INT,
					nombre VARCHAR(200),
                    fechaEjecucion DATE,
					FOREIGN KEY (gradoID) REFERENCES Grado(ID));
   
CREATE TABLE Pregunta(ID INT PRIMARY KEY AUTO_INCREMENT,
					examenID INT,
                    pregunta VARCHAR(500),
                    puntos INT,
                    FOREIGN KEY (examenID) REFERENCES Examen(ID));

CREATE TABLE Distractor(ID INT PRIMARY KEY AUTO_INCREMENT,
                    distractor VARCHAR(500));

CREATE TABLE PreguntaXDistractor(ID INT PRIMARY KEY AUTO_INCREMENT,
                    preguntaID INT,
                    distractorID INT,
                    FOREIGN KEY (preguntaID) REFERENCES Pregunta(ID),
                    FOREIGN KEY (distractorID) REFERENCES Distractor(ID));

                    
CREATE TABLE Respuesta(ID INT PRIMARY KEY AUTO_INCREMENT,
                    preguntaID INT,
                    respuesta VARCHAR(500),
                    correcta BOOLEAN,
                    FOREIGN KEY (preguntaID) REFERENCES Pregunta(ID));

CREATE TABLE Imagen(ID INT PRIMARY KEY AUTO_INCREMENT,
                    direccion VARCHAR(500));

CREATE TABLE PreguntaXImagen(ID INT PRIMARY KEY AUTO_INCREMENT,
                    preguntaID INT,
                    imagenID INT,
                    FOREIGN KEY (preguntaID) REFERENCES Pregunta(ID),
                    FOREIGN KEY (imagenID) REFERENCES Imagen(ID));

CREATE TABLE Calificacion(ID INT PRIMARY KEY AUTO_INCREMENT,
                    examenID INT,
                    estudianteID INT,
                    nota DECIMAL(10,2),
                    FOREIGN KEY (examenID) REFERENCES Examen(ID),
                    FOREIGN KEY (estudianteID) REFERENCES Estudiante(ID));

CREATE TABLE CalificacionPregunta(ID INT PRIMARY KEY AUTO_INCREMENT,
                    calificacionID INT,
                    nota DECIMAL(10,2),
                    FOREIGN KEY (calificacionID) REFERENCES Calificacion(ID));