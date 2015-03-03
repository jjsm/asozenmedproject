<?php

require_once ("../class/Conexion.php");

class Prestamos
{
  private static $instancia;
  private $oConectar;

    private function __construct()
    {
     $this->oConectar = Conexion::singleton();
    }

    public static function singleton()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    

    public function listarPrestamo($valores)
    {
    	$sql1 = "SELECT COUNT(*) AS count FROM tblPrestamos ";
    	$sql2 = "SELECT  prestamos.id_prestamo AS idPrestamo,
    					 usuario.usuario AS practicante,
    					 usuario.id_usuario AS idPracticante,
    					 DATE_FORMAT(prestamos.fechaPrestamo, '%d-%m-%Y')  AS prestamo,
						 DATE_FORMAT(prestamos.fechaEntrega, '%d-%m-%Y')  AS entrega,
    					 prestador.usuario AS prestador,
    					 prestador.id_usuario AS idPrestador,
						 DATE_FORMAT(prestamos.fechaRegistro, '%d-%m-%Y')  AS devuelto,
                         prestamos.estadoPres AS estado
    			
				FROM 	tblPrestamos prestamos 
					INNER JOIN tblusuarios usuario ON prestamos.idUsuarios = usuario.id_usuario  
					INNER JOIN tblusuarios prestador ON prestamos.idPrestamista=prestador.id_usuario ";
    
    	$resultados = $this->oConectar->listarGrid($valores,$sql1,$sql2);
    	 
    	$result = array();
    	$i = 0;
    	foreach ($resultados[0] as $row) {
    		$result[$i]['id']=$row["id"];
    		$result[$i]['cell']=array($row["id"],$row["practicante"],$row["idPracticante"],$row["prestamo"],$row["entrega"],$row["prestador"],$row["idPrestador"],$row["devuelto"],$row["estado"]);
    		$i++;
    	}
    	//Asignamos todo esto en variables de json, para enviarlo al navegador.
    	$arr = array('rows' =>$resultados[0], 'total' => $resultados[1], 'page' => $resultados[2], 'records' => $resultados[3]);
        
    	return $arr;
    }
    
    public function insertarEncabezadoPrestamo($valores)
    {	
    	$sql='INSERT INTO tblPrestamos VALUES (null,?,?,null,?,?,1)';
    	$id = $this->oConectar->ejecutarSentencia($valores,$sql);
    	return $id;
    }
    
    public function insertarLibroPrestamo($valores)
    {	
    	$sql='INSERT INTO tblDetallePrestamo VALUES (null,null,?,?,0)';
    	$id =$this->oConectar->ejecutarSentencia($valores,$sql);
    	return $id;
    }
    
    public function listarDetalleprestamo($valores,$detalle){
    	$sql1 = "SELECT COUNT(*) AS count FROM tblDetallePrestamo ";
    	$sql2 = "SELECT  detallePrestamo.id_detallePrestamo  AS id,
						libros.codigo as codigo,
						libros.titulo as titulo,
                        libros.id_libro as idLibro,
                        detallePrestamo.estadoDetalle  as estado,
                        detallePrestamo.fechaDevuelto as fechaDevuelto
                        
    
				FROM 	tblDetallePrestamo detallePrestamo
					INNER JOIN tblPrestamos prestamos ON detallePrestamo.idPrestamo = prestamos.id_prestamo
					INNER JOIN tblLibros libros ON detallePrestamo.idLibros=libros.id_libro 
    			WHERE prestamos.id_prestamo =".$detalle;
    	
    	$resultados = $this->oConectar->listarGrid($valores,$sql1,$sql2);
    	
    	$result = array();
    	$i = 0;
    	foreach ($resultados[0] as $row) {
    		$result[$i]['id']=$row["id"];
    		$result[$i]['cell']=array($row["id"],$row["codigo"],$row["titulo"],$row["idLibro"],$row["estado"],$row["fechaDevuelto"]);
    		$i++;
    	}
    	//Asignamos todo esto en variables de json, para enviarlo al navegador.
    	$arr = array('rows' =>$result, 'total' => $resultados[1], 'page' => $resultados[2], 'records' => $resultados[3]);
    	return $arr;
    }
    
    public function actualizar_prestamo($valores){
    	$sql='UPDATE tblPrestamos SET fechaPrestamo = ?,fechaEntrega = ?,fechaRegistro = Now() , idUsuarios = ? , idPrestamista = ? WHERE id_prestamo = ?';
    	$this->oConectar->ejecutarSentencia($valores,$sql);
    }
    
    public function actualizarFechaDetalle($valores){
        $sql = 'UPDATE tblDetallePrestamo SET fechaDevuelto= Now(), estadoDetalle=1 WHERE id_detallePrestamo= ? ';
        $this->oConectar->ejecutarSentencia($valores,$sql);
    }
    
    public function actualizarEncabezadoPrestamo($valores){
        $sql = 'UPDATE tblPrestamos SET fechaPrestamo= ?, fechaEntrega=?,fechaRegistro =null,idUsuarios = ?,idPrestamista=? WHERE id_prestamo= ? ';
        $this->oConectar->ejecutarSentencia($valores,$sql); 
    }
    
    public function cerrarPrestamo($valores){
      $sql = 'UPDATE tblDetallePrestamo SET estadoDetalle=1, fechaDevuelto = Now() WHERE idPrestamo = ? AND  estadoDetalle!= 1 ';
      $this->oConectar->ejecutarSentencia($valores,$sql);  
    }
    
    public function consultarLibrosPrestamo($valores){
        $sql = 'SELECT DISTINCT  idLibros  From tblDetallePrestamo WHERE idPrestamo=? ';
        
        $resultados =$this->oConectar->consultar_ac($valores,$sql);
    	$result = array();
        $i=0;
    	foreach ($resultados as $row) {
    		$result[$i]=$row["idLibros"];
            $i++;
    	}
    	return $result;
    }
    
    public function  actEstadoPrestamo($valores){
     $sql = 'UPDATE tblPrestamos SET estadoPres=0,fechaRegistro=Now() WHERE id_prestamo=? '  ;
     $this->oConectar->ejecutarSentencia($valores,$sql);
    }
 
}
?>