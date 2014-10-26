asozenmedproject


###Por hacer
vaciar campos ,validar alinear

en prestamos al abrir dialogo poner fecha actual
y segun fecha actual poner la fecha de quince dias hacia adelante

en prestamos al seleccionar libro e insertar borrarlo del campo

tabla estado --->parcial/ completo,aplazado, pasofecha

CREATE DATABASE asozenmed;

CREATE TABLE tblusuarios(
id_usuario integer auto_increment,
cedula varchar(20)  not null,
usuario varchar(50) not null,
correo varchar(50) not null,
celular varchar(15) not null,
telefono varchar(15) not null,
PRIMARY KEY (id_usuario)
);

CREATE TABLE tblLibros(
id_libro integer auto_increment,
titulo varchar(500) not null,
codigo varchar(50) not null,
descripcion varchar(500) not null,
editorial varchar(100) not null,
año integer not null,
observaciones varchar(500) not null,
estado boolean ,
autores varchar(30),
PRIMARY KEY (id_libro)
);


CREATE TABLE  tblPrestamos(
id_prestamo integer auto_increment,
fechaPrestamo datetime,
fechaEntrega datetime,
fechaRegistro datetime,
idUsuarios integer,
idPrestamista integer,
 FOREIGN KEY (idUsuarios) REFERENCES tblusuarios(id_usuario),
 FOREIGN KEY (idPrestamista) REFERENCES tblusuarios(id_usuario),
PRIMARY KEY (id_prestamo)
);


CREATE TABLE tblDetallePrestamo(
id_detallePrestamo integer auto_increment,
fechaDevuelto datetime,
idLibros integer,
idPrestamo integer,
 FOREIGN KEY (idPrestamo) REFERENCES tblPrestamos(id_prestamo),
 FOREIGN KEY (idLibros) REFERENCES tblLibros(id_libro),
PRIMARY KEY (id_detallePrestamo)
);

================
