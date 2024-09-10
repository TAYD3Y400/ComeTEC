USE keysforgeeks_DB;

INSERT INTO Plataforma(nombre)
VALUES  ('Steam'),
		('Epic'),
		('Android'),
        ('PlayStation 4'),
        ('PlayStation 5'),
        ('Xbox One'),
        ('Xbox Series'),
        ('Nintendo Switch');
       
INSERT INTO Videojuego(nombre, codigo, plataformaID, precio, imagen, descripcion)
VALUES ('A Hat in Time', '0001', 1, 11950.95, LOAD_FILE('/Producto_AHiT.PNG'), 'Un plataformas en 3D homenaje a los viejos clásicos. Su protagonista es una niña con sombrero, acompañala a explorar mundos inmensos y recoge fragmentos de tiempo para avanzar en la aventura.'),
  	   ('A Hat in Time', '0001', 2, 11950.95, LOAD_FILE('/Producto_AHiT.PNG'), 'Un plataformas en 3D homenaje a los viejos clásicos. Su protagonista es una niña con sombrero, acompañala a explorar mundos inmensos y recoge fragmentos de tiempo para avanzar en la aventura.'),
	   ('A Hat in Time', '0001', 4, 11950.95, LOAD_FILE('/Producto_AHiT.PNG'), 'Un plataformas en 3D homenaje a los viejos clásicos. Su protagonista es una niña con sombrero, acompañala a explorar mundos inmensos y recoge fragmentos de tiempo para avanzar en la aventura.')
       ;
       
SELECT * FROM administrador;
SELECT * FROM carrito; 
SELECT * FROM carritoxvideojuego; 
SELECT * FROM cliente; 
SELECT * FROM descuento; 
SELECT * FROM factura; 
SELECT * FROM genero; 
SELECT * FROM generoxvideojuego;
SELECT * FROM plataforma; 
SELECT * FROM preguntas; 
SELECT * FROM promocion; 
SELECT * FROM promocionxvideojuego;
SELECT * FROM respuestas;
SELECT * FROM usuario; 
SELECT * FROM videojuego;  

SHOW TABLES FROM keysforgeeks_DB;

SELECT NOW();

SELECT LOAD_FILE('C:\xampp\htdocs\ProyectoWeb\BaseDeDatos\Producto_AHiT.png');    
       
INSERT INTO Plataforma(Carnet, nombre, apellidos, telefono, correo)
VALUES (1234, 'Keylor', 'Calderón Vega', 72125875, 'koiscal71@hotmail.com'),
  	   (5678, 'Sisi', 'Brenes Brenes', 49239423, 'sisi920@gmail.com'),
	   (8901, 'Juan', 'Perez Solano', 291822111, 'juanPS@gmail.com');