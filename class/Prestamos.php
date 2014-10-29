<?php

require_once ("../class/consultarDB.php");

class Prestamos
{
  private static $instancia;


    public static function singleton()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    

    public function listar_prestamo($valores)
    {
    	$oConectar = new consultarDB;
    	$sql1 = "SELECT COUNT(*) AS count FROM tblPrestamos ";
    	$sql2 = "SELECT  prestamos.id_prestamo AS id,
    					 usuario.usuario AS practicante,
    					 usuario.id_usuario AS idPracticante,
    					 DATE_FORMAT(prestamos.fechaPrestamo, '%d-%m-%Y')  AS prestamo,
						 DATE_FORMAT(prestamos.fechaEntrega, '%d-%m-%Y')  AS entrega,
    					 prestador.usuario AS prestador,
    					 prestador.id_usuario AS idPrestador,
						 DATE_FORMAT(prestamos.fechaRegistro, '%d-%m-%Y')  AS devuelto
    			
				FROM 	tblPrestamos prestamos 
					INNER JOIN tblusuarios usuario ON prestamos.idUsuarios = usuario.id_usuario  
					INNER JOIN tblusuarios prestador ON prestamos.idPrestamista=prestador.id_usuario ";
    
    	$resultados = $oConectar->listarGrid($valores,$sql1,$sql2);
    	 
    	$result = array();
    	$i = 0;
    	foreach ($resultados[0] as $row) {
    		$result[$i]['id']=$row["id"];
    		$result[$i]['cell']=array($row["id"],$row["practicante"],$row["idPracticante"],$row["prestamo"],$row["entrega"],$row["prestador"],$row["idPrestador"],$row["devuelto"]);
    		$i++;
    	}
    	//Asignamos todo esto en variables de json, para enviarlo al navegador.
    	$arr = array('rows' =>$result, 'total' => $resultados[1], 'page' => $resultados[2], 'records' => $resultados[3]);
    	return $arr;
    }
    
    public function insertarEncabezadoPrestamo($valores)
    {		
    	$oConectar = new consultarDB;
    	$sql='INSERT INTO tblPrestamos VALUES (null,?,?,Now(),?,?)';
    	$id = $oConectar->ejecutarSentencia($valores,$sql);
    	return $id;
    }
    
    public function insertarLibroPrestamo($valores)
    {	
    	$oConectar = new consultarDB;
    	$sql='INSERT INTO tblDetallePrestamo VALUES (null,Now(),?,?)';
    	$id =$oConectar->ejecutarSentencia($valores,$sql);
    	return $id;
    }
    
    public function listarDetalleprestamo($valores,$detalle){
    	$oConectar = new consultarDB;
    	$sql1 = "SELECT COUNT(*) AS count FROM tblDetallePrestamo ";
    	$sql2 = "SELECT  detallePrestamo.id_detallePrestamo  AS id,
						libros.codigo as codigo,
						libros.titulo as titulo,
                        libros.id_libro as idLibro
    
				FROM 	tblDetallePrestamo detallePrestamo
					INNER JOIN tblPrestamos prestamos ON detallePrestamo.idPrestamo = prestamos.id_prestamo
					INNER JOIN tblLibros libros ON detallePrestamo.idLibros=libros.id_libro 
    			WHERE prestamos.id_prestamo =".$detalle;
    	
    	$resultados = $oConectar->listarGrid($valores,$sql1,$sql2);
    	
    	$result = array();
    	$i = 0;
    	foreach ($resultados[0] as $row) {
    		$result[$i]['id']=$row["id"];
    		$result[$i]['cell']=array($row["id"],$row["codigo"],$row["titulo"]);
    		$i++;
    	}
    	//Asignamos todo esto en variables de json, para enviarlo al navegador.
    	$arr = array('rows' =>$result, 'total' => $resultados[1], 'page' => $resultados[2], 'records' => $resultados[3]);
    	return $arr;
    }
    
    public function actualizar_prestamo($valores){
    	$oConectar = new consultarDB;
    	$sql='UPDATE tblPrestamos SET fechaPrestamo = ?,fechaEntrega = ?,fechaRegistro = Now() , idUsuarios = ? , idPrestamista = ? WHERE id_prestamo = ?';
    	$oConectar->ejecutarSentencia($valores,$sql);
    }
 
}
?>