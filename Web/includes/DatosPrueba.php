<?php

function borrarBD($conn){
    try {
        $sql= "DROP TABLE CalificacionPregunta;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Calificacion;" ;
        $conn->query($sql);

        $sql= "DROP TABLE PreguntaXImagen;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Imagen;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Respuesta;" ;
        $conn->query($sql);

        $sql= "DROP TABLE PreguntaXDistractor;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Distractor;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Pregunta;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Examen;" ;
        $conn->query($sql);

        $sql= "DROP TABLE EstudianteXEquipo;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Equipo;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Grado;" ;
        $conn->query($sql);

        $sql= "DROP TABLE Institucion;" ;
        $conn->query($sql);

        $sql = "DROP TABLE Estudiante; ";
        $conn->query($sql);

        $sql = "DROP TABLE Administrador; ";
        $conn->query($sql);

        echo 'Eliminación de tablas exitosa', "\n";
    } catch (Exception $e) {
        echo 'Error al borrar las tablas: ',  $e->getMessage(), "\n";
    }
}

function crearBD($conn){
    try {
        $sql = "CREATE TABLE Administrador(ID INT PRIMARY KEY AUTO_INCREMENT,
        usuario VARCHAR(50),
        contrasena VARCHAR(50));";
        $conn->query($sql);

        $sql= "CREATE TABLE Estudiante(ID INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(100),
        apellidos VARCHAR(100),
        identificacion VARCHAR(50));" ;
        
        $conn->query($sql);

        $sql= "CREATE TABLE Institucion(ID INT PRIMARY KEY AUTO_INCREMENT,
        usuario VARCHAR(50),
        contrasena VARCHAR(50),
        nombre VARCHAR(250),
        estado BIT, 
        correoElectronico VARCHAR(255),
        telefono INT,
        nombreResponsable VARCHAR(128));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Grado(ID INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(200));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Equipo(ID INT PRIMARY KEY AUTO_INCREMENT,
        institucionID INT,
        gradoID INT,
        nombre VARCHAR(200),
        codigo VARCHAR(50),
        FOREIGN KEY (gradoID) REFERENCES Grado(ID),
        FOREIGN KEY (institucionID) REFERENCES Institucion(ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE EstudianteXEquipo(ID INT PRIMARY KEY AUTO_INCREMENT,
        estudianteID INT,
        equipoID INT,
        FOREIGN KEY (estudianteID) REFERENCES Estudiante(ID),
        FOREIGN KEY (equipoID) REFERENCES Equipo(ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Examen(ID INT PRIMARY KEY AUTO_INCREMENT,
        gradoID INT,
        nombre VARCHAR(200),
        fechaEjecucion DATE,
        FOREIGN KEY (gradoID) REFERENCES Grado(ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Pregunta(ID INT PRIMARY KEY AUTO_INCREMENT,
        examenID INT,
        pregunta VARCHAR(2000),
        puntos INT,
        FOREIGN KEY (examenID) REFERENCES Examen(ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Distractor(ID INT PRIMARY KEY AUTO_INCREMENT,
        distractor VARCHAR(500));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE PreguntaXDistractor(ID INT PRIMARY KEY AUTO_INCREMENT,
        preguntaID INT,
        distractorID INT,
        FOREIGN KEY (preguntaID) REFERENCES Pregunta(ID),
        FOREIGN KEY (distractorID) REFERENCES Distractor(ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Respuesta(ID INT PRIMARY KEY AUTO_INCREMENT,
        preguntaID INT,
        respuesta VARCHAR(500),
        correcta BOOLEAN,
        FOREIGN KEY (preguntaID) REFERENCES Pregunta(ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Imagen(ID INT PRIMARY KEY AUTO_INCREMENT,
        direccion VARCHAR(500));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE PreguntaXImagen(ID INT PRIMARY KEY AUTO_INCREMENT,
        preguntaID INT,
        imagenID INT,
        FOREIGN KEY (preguntaID) REFERENCES Pregunta(ID),
        FOREIGN KEY (imagenID) REFERENCES Imagen(ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE Calificacion(ID INT PRIMARY KEY AUTO_INCREMENT,
        examenID INT,
        estudianteID INT,
        nota DECIMAL(10,2),
        FOREIGN KEY (examenID) REFERENCES Examen(ID),
        FOREIGN KEY (estudianteID) REFERENCES Estudiante(ID));" ;
        $conn->query($sql);

        $sql= "CREATE TABLE CalificacionPregunta(ID INT PRIMARY KEY AUTO_INCREMENT,
        calificacionID INT,
        nota DECIMAL(10,2),
        FOREIGN KEY (calificacionID) REFERENCES Calificacion(ID));" ;
        $conn->query($sql);

        echo 'Creación de tablas éxitosa', "\n";
    } catch (Exception $e) {
        echo 'Error al crear las tablas: ',  $e->getMessage(), "\n";
    }
}


function cargarDatos($conn){
    try {
        $sql = "INSERT INTO Administrador(usuario, contrasena)
        VALUES  ('Admin1', '123'),
                ('Admin2', '456');";
        $conn->query($sql);

        $sql = "INSERT INTO Estudiante(nombre, apellidos, identificacion)
        VALUES  ('Juan', 'Soto Solano', '291383129'),
                ('Luis', 'Solano Calderas', '938129'),
                ('Juana', 'Perezz Lopez', '429392'),
                ('Kiara', 'Mendez Coto', '912812'),
                ('Edgard', 'Pinos Arias', '837233'),

                ('Luis', 'Pineda Gonzales', '3283329'),
                ('Santiago', 'Mendez Mendez', '210292'),
                ('Pepe', 'Soto Solano', '291383129'),
                ('Pedro', 'Soto Solano', '291383129'),
                ('Manuel', 'Soto Solano', '291383129'),

                ('Vanessa', 'Soto Solano', '291383129'),
                ('Nataly', 'Soto Solano', '291383129'),
                ('Jeimy', 'Soto Solano', '291383129'),
                ('María', 'Soto Solano', '291383129'),
                ('Angie', 'Soto Solano', '291383129'),
                
                ('Kennet', 'Soto Solano', '291383129'),
                ('Hat', 'Soto Solano', '291383129'),
                ('Marlen', 'Soto Solano', '291383129'),
                ('Brayan', 'Soto Solano', '291383129'),
                ('Natalie', 'Soto Solano', '291383129'),
                
                ('Persy', 'Soto Solano', '291383129'),
                ('Sergio', 'Soto Solano', '291383129'),
                ('Daniel', 'Soto Solano', '291383129'),
                ('Kendall', 'Soto Solano', '291383129'),
                ('Andrés', 'Soto Solano', '291383129'),
                
                ('Miguel', 'Soto Solano', '291383129'),
                ('Jean', 'Soto Solano', '291383129'),
                ('Barbara', 'Soto Solano', '291383129'),
                ('Yeiselyn', 'Soto Solano', '291383129'),
                ('Fabiola', 'Marin Quiros', '291383129'),
                
                ('Danna', 'Soto Solano', '291383129'),
                ('Dariana', 'Soto Solano', '291383129'),
                ('Monserat', 'Soto Solano', '291383129'),
                ('Alonso', 'Soto Solano', '291383129'),
                ('Juan', 'Soto Solano', '291383129'),
                
                ('Tyler', 'Soto Solano', '291383129'),
                ('Benedicto', 'Soto Solano', '291383129'),
                ('David', 'Soto Solano', '291383129'),
                ('Gabriel', 'Soto Solano', '291383129'),
                ('Alejandro', 'Soto Solano', '291383129'),
                
                ('Elizabeth', 'Soto Solano', '291383129'),
                ('Rachel', 'Soto Solano', '291383129'),
                ('Raquel', 'Soto Solano', '291383129'),
                ('Gloriana', 'Quiros Solano', '291383129'),
                ('Gustavo','Brenes Brenes', '12039122') ;";
        $conn->query($sql);

        $sql = "INSERT INTO Institucion(usuario, contrasena, nombre, estado)
        VALUES  ('Ins1', 'prueba1', 'TEC', 0),
                ('Ins2', 'prueba2', 'Colegio San Luis', 0),
                ('Ins3', 'prueba3', 'UL', 0),
                ('Ins4', 'prueba4', 'SUS', 1),
                ('Ins5', 'prueba5', 'UNAM', 1);";
        $conn->query($sql);

        $sql = "INSERT INTO Grado(nombre)
        VALUES  ('Primario'),
                ('Secundaria'),
                ('Preparatoria');";
        $conn->query($sql);

        $sql = "INSERT INTO Equipo(institucionID, gradoID, nombre, codigo)
        VALUES  (1,1, 'equipo 1', 'sajsjakss'),
                (2,2, 'equipo 2', 'assasss'),
                (3,3, 'equipo 3', 'sajsxssxss'),
                (4,1, 'equipo 4', '12212sjakss'),
                (5,2, 'equipo 5', 'sa31122akss'),
                (1,3, 'equipo 6', 's122ss'),
                (2,1, 'equipo 7', 'asasxkss'),
                (3,2, 'equipo 8', 'kklmds921'),
                (4,3, 'equipo 9', 'kjasbyd563'),
                (5,1, 'equipo A', 'ppsai281'),
                (1,2, 'equipo B', 'dsams1627'),
                (2,1, 'equipo C', 'askmaid'),
                (3,2, 'equipo D', 'amogsu8192'),
                (4,3, 'equipo E', 'soraltd127'),
                (5,2, 'equipo F', 'chultu8172');";

        $conn->query($sql);

        $sql = "INSERT INTO EstudianteXEquipo(estudianteID, equipoID)
        VALUES  (1, 1),
                (2, 2),
                (3, 3),
                (4, 4),
                (5, 5),
                (6, 6),
                (7, 7),
                (8, 8),
                (9, 9),
                (10, 10),
                (11, 11),
                (12, 12),
                (13, 13),
                (14, 14),
                (15, 15),
                (16, 1),
                (17, 2),
                (18, 3),
                (19, 4),
                (20, 5),
                (21, 6),
                (22, 7),
                (23, 8),
                (24, 9),
                (25, 10),
                (26, 11),
                (27, 12),
                (28, 13),
                (29, 14),
                (30, 15),
                (31, 1),
                (32, 2),
                (33, 3),
                (34, 4),
                (35, 5),
                (36, 6),
                (37, 7),
                (38, 8),
                (39, 9),
                (40, 10),
                (41, 11),
                (42, 12),
                (43, 13),
                (44, 14),
                (45, 15);";
        $conn->query($sql);

        $sql = "INSERT INTO Examen(gradoID, nombre, fechaEjecucion)
        VALUES  (1,'Examen básico', '2021-09-21'),
                (2,'Funciones lineales', '2023-09-21'),
                (2,'Funciones cuadraticas', '2022-09-21'),
                (3,'Derivadas e Integrales', '2021-11-21');";
        $conn->query($sql);

        $sql = "INSERT INTO Pregunta(examenID, pregunta, puntos)
        VALUES  (1, 'Cuanto es 2+2', 15),
                (1, 'Cuanto es 5*3', 25),
                (2, 'Cuanto es 5+2', 10),
                (2, 'Cuanto es 2*3', 5),
                (3, 'Cuanto es 3/2', 30),
                (3, 'Cuanto es 2-9*2', 50),
                (4, 'Cuanto es 5*0+300', 60),
                (4, 'Cuanto es 5039*129218-12', 25);";
        $conn->query($sql);

        $sql = "INSERT INTO Distractor(distractor)
        VALUES  ('45'),
                ('45'),
                ('45'),
                ('45'),
                ('45'),
                
                ('45'),
                ('45'),
                ('45'),
                ('45'),
                ('45'),
                
                ('45'),
                ('45'),
                ('45'),
                ('45'),
                ('45'),
                
                ('45'),
                ('45'),
                ('45'),
                ('45'),
                ('45'),
                
                ('45'),
                ('45'),
                ('45'),
                ('45');";
        $conn->query($sql);

        $sql = "INSERT INTO PreguntaXDistractor(preguntaID, distractorID)
        VALUES  (1, 1),
                (2, 2),
                (3, 3),
                (4, 4),
                (5, 5),
        
                (6, 6),
                (7, 7),
                (8, 8),
                (1, 9),
                (2, 10),
                
                (3, 11),
                (4, 12),
                (5, 13),
                (6, 14),
                (7, 15),
                
                (8, 16),
                (1, 17),
                (2, 18),
                (3, 19),
                (4, 20),
                
                (5, 21),
                (6, 22),
                (7, 23),
                (8, 24);";
        $conn->query($sql);

        $sql = "INSERT INTO Respuesta(preguntaID, respuesta, correcta)
        VALUES  (1,'Correcta', 0),
                (2,'Correcta', 0),
                (3,'Correcta', 0),
                (4,'Correcta', 1),
                (5,'Correcta', 0),
                (6,'Correcta', 0),
                (7,'Correcta', 1),
                (7,'Correcta', 0),
                (8,'Correcta', 0);";
        $conn->query($sql);
/*
        $sql = "INSERT INTO Imagen(direccion)
        VALUES  ('2021-08-06');";
        $conn->query($sql);

        $sql = "INSERT INTO PreguntaXImagen(preguntaID, imagenID)
        VALUES  (3, 1);";
        $conn->query($sql);
*/
        $sql = "INSERT INTO Calificacion(examenID, estudianteID, nota)
        VALUES  (1, 1, 80),
                (2, 2, 14),
                (3, 3, 12),
                (4, 4, 1),
                (1, 5, 10),

                (2, 6, 19),
                (3, 7, 18),
                (4, 8, 74),
                (1, 9, 15),
                (2, 10, 34),

                (3, 11, 97.5),
                (4, 12, 100);";
        $conn->query($sql);

        $sql = "INSERT INTO CalificacionPregunta(calificacionID, nota)
        VALUES  (1,100),
                (2,23),
                (3,30),
                (4,1),
                (5,15),
                (6,12),
                (7,11),
                (8,3),
                (9,5),
                (10,7),
                (11,77),
                (12,79);";
        $conn->query($sql);

        echo 'Cargado de datos éxitoso', "\n";
    } catch (Exception $e) {
        echo 'Error al cargar datos: ',  $e->getMessage(), "\n";
    }
}
?>
