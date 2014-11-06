asozenmedproject


###Por hacer

- Cuadrar el paginador del jqgrid
- Al crear libro ingresar el estado 1 (activo)
- un boton en la lista de prestamos para cerrar el prestamo solo si todos los libros estan en 1
- bloquear usuarios con mas de tres libros prestados
- al editar fecha guardar en ok


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
fechaRegistro datetime, --cierra prestamo
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
 estadoDetalle boolean,
 FOREIGN KEY (idPrestamo) REFERENCES tblPrestamos(id_prestamo),
 FOREIGN KEY (idLibros) REFERENCES tblLibros(id_libro),
PRIMARY KEY (id_detallePrestamo)
);
=================
HACER COMMIT
# Inicializamos el repositorio local Git
    git init
    # Agregamos todo (archivos y directorios) al repositorio
    git add .
    # Hacemos un commit al repositorio
    git commit -m "Initial commit"
    # Muestra el log (un historial)
    git log
    
# git push

# parts install php5 php5-apache2 php5-pdo-mysql php5-zlib mysql
================

Setting up a MySQL Database

We now need to get a MySQL database setup and usable by Wordpress.

    Log into the MySQL shell mysql -u root -p
    Press Enter when asked for a password (you can/should set one up, but by default there is none after the install).
    You should now see the '>' prompt. Enter the following CREATE DATABASE wordpress;
    We'll create a user CREATE USER wordpressuser@localhost;
    ... and a password SET PASSWORD FOR wordpressuser@localhost= PASSWORD("password");
    Now we'll grant that user all privileges GRANT ALL PRIVILEGES ON wordpress.* TO wordpressuser@localhost IDENTIFIED BY 'password';
    Let's flush privileges FLUSH PRIVILEGES;
    and exit the MySQL shell by entering exit

================
