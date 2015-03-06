<?php

 abstract class configuracion {
 	protected $datahost;
	protected function conectar($archivo = 'configuracion.ini'){

		if (!$ajustes = parse_ini_file($archivo, true)) throw new exception ('No se puede abrir el archivo ' . $archivo . '.');
		$controlador = $ajustes["database"]["driver"]; //controlador (MySQL la mayoría de las veces)
		$servidor = $ajustes["database"]["host"]; //servidor como localhost o 127.0.0.1 usar este ultimo cuando el puerto sea diferente
		$puerto = $ajustes["database"]["port"]; //Puerto de la BD
		$basedatos = $ajustes["database"]["schema"]; //nombre de la base de datos
        $usuario = $ajustes['database']['username'];
        $contrasena = $ajustes['database']['password'];
        $options = array(
        PDO::ATTR_PERSISTENT    => true,
        PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    );
        $dsn = 'mysql:host=' . $servidor . ';dbname=' . $basedatos;
		try{
			return $this->datahost = new PDO($dsn,$usuario,$contrasena, $options);
		}
		catch(PDOException $e){
			echo "Error en la conexión: ".$e->getMessage();
		}
	}
}

?>