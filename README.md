asozenmedproject


###Por hacer

- bloquear usuarios con mas de tres libros prestados o desees prestar mas de tres libros
- hacer filtro en prestamo con prestamos cerrados o abiertos
- no mostrar los prestamos entregados - habilitar un dropdown para mostrar - prestados y no prestados
- al abrir la primera vez el primer grid, este se carga sin datos - el de prestamos
- prestamos -autocomplete de libros - me muestra un libro inactivo pero carga otro en el grid de detaller prestamo
- habilitar search
- validar libro si hay disponibe segun numero de ejemplares
- al darle cerrar al prestamo actualizar grid - y actualizar fecha de Devuelto
- IMPORTANTE al ingresar el primer libro a un prestamo recien creado no carga ningun libro en el  grid
- IMPORTANTE en el detalle del prestamo al entregar un libro se pone 0 pero en el encabezado del prstamo al cerrarlo el libro o el detale se pone en 1 de nuevo
- Pensar la forma de entregsr los libros de manera  diferente

CREATE DATABASE asozenmed;

CREATE TABLE tblusuarios(
id_usuario integer auto_increment,
cedula varchar(20)  not null,
usuario varchar(50) not null,
correo varchar(50) not null,
celular varchar(15) not null,
telefono varchar(15) not null,
edad integer not null,
fechaIngreso datetime not null,
direccion varchar(100),
profesion varchar(100),
descubrio varchar(150),
PRIMARY KEY (id_usuario)
);

CREATE TABLE tblLibros(
id_libro integer auto_increment,
numeroAcceso varchar(100),
codigo varchar(50) not null,
autores varchar(30), - mencion de responsabilidad
titulo varchar(500) not null,
editorial varchar(100) not null,
año integer not null,
isbn varchar(100),
serie varchar(100),
pais  varchar(100),
paginas integer,
ejemplares integer,
descripcion varchar(500),
observaciones varchar(500),
encuadernar boolean,
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


CREATE TABLE tblPracticas(
id_practica integer auto_increment,
practica varchar(200),
fechapractica datetime,
valorPract integer,
PRIMARY KEY (id_practica)
);

CREATE TABLE tblDetallePracticas(
id_detallePractica integer auto_increment,
idUsuarios integer,
valorpago integer,
idPractica integer,
PRIMARY KEY (id_detallePractica),
 FOREIGN KEY (idPractica) REFERENCES tblPracticas(id_practica)
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
