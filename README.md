asozenmedproject


###Por hacer

- bloquear usuarios con mas de tres libros prestados o desees prestar mas de tres libros
- restringir libros en 0
- hacer filtro en prestamo con prestamos cerrados o abiertos
- al crear libro o usuario o prestamo dejarlo en la pagina y solo actualizar el grid
- al editar prestamo o cerrar prestamo actualizar el grid
- no mostrar los prestamos entregados - habilitar un dropdown para mostrar - prestados y no prestados
- al abrir la primera vez el primer grid, este se carga sin datos - el de prestamos
- prestamos -autocomplete de libros - me muestra un libro inactivo pero carga otro en el grid de detaller prestamo
- habilitar search
- ###Por hacer
- bloquear usuarios con mas de tres libros prestados o desees prestar mas de tres libros
- restringir libros en 0
- hacer filtro en prestamo con prestamos cerrados o abiertos
- al nombre del libro no restringir con menos de 10 caracteres


tabla estado --->parcial/ completo,aplazado, pasofecha

CREATE DATABASE asozenmed;

CREATE TABLE tblusuarios(
id_usuario integer auto_increment,
cedula varchar(20)  not null,
usuario varchar(50) not null,
correo varchar(50) not null,
celular varchar(15) not null,
telefono varchar(15) not null,

- edad integer not null,
- fechaIngreso datetime not null,
- direccion varchar(100),
- profesion varchar(100),
- descubrio varchar(150),
PRIMARY KEY (id_usuario)
);

CREATE TABLE tblLibros(
id_libro integer auto_increment,
- numeroAcceso,
codigo varchar(50) not null,
autores varchar(30), - mencion de responsabilidad
titulo varchar(500) not null,
editorial varchar(100) not null,
año integer not null,
- isbn
- serie
- pais
- paginas
- ejemplares
- descFisica
- observaciones
- encuadernar
descripcion varchar(500) not null,

observaciones varchar(500) not null,
estado boolean ,

PRIMARY KEY (id_libro)
);


CREATE TABLE  tblPrestamos(
id_prestamo integer auto_increment,
fechaPrestamo datetime,
fechaEntrega datetime,
fechaRegistro datetime, --cierra prestamo
idUsuarios integer,
idPrestamista integer,
estadoPres boolean,
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
