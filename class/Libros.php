<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once ("../class/consultarDB.php");

class Libros
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
    
    public function listar_libro($valores)
    {
    	$oConectar = new consultarDB;
    	$sql1 = "SELECT COUNT(*) AS count FROM tblLibros ";
		$sql2 = "SELECT id_libro,titulo,codigo,descripcion,editorial,año,observaciones,estado,autores  FROM tblLibros ";
		
    	$resultados = $oConectar->listarGrid($valores,$sql1,$sql2);
    	
    	$result = array();
    	$i = 0;
    	foreach ($resultados[0] as $row) {
    		$result[$i]['id']=$row["id_libro"];
    		$result[$i]['cell']=array($row["id_libro"],$row["titulo"],$row["codigo"],$row["descripcion"],$row["editorial"],$row["año"],$row["observaciones"],$row["estado"],$row["autores"]);
    		$i++;
    	}
    	//Asignamos todo esto en variables de json, para enviarlo al navegador.
    	$arr = array('rows' =>$result, 'total' => $resultados[1], 'page' => $resultados[2], 'records' => $resultados[3]);
    	return $arr;
    }
    
    public function insertar_libro($valores)
    {		
    	$oConectar = new consultarDB;
    	$sql='INSERT INTO tblLibros (titulo,codigo,descripcion,editorial,año,observaciones,estado,autores)VALUES (?,?,?,?,?,?,1,?)';
    	$oConectar->ejecutarSentencia($valores,$sql);
    }
    
    public function actualizar_libro($valores){
    	$oConectar = new consultarDB;
    	$sql='UPDATE tblLibros SET titulo = ?,codigo = ?,descripcion = ?,editorial = ?, año = ? , observaciones = ? , autores = ? WHERE id_libro = ?';
    	$oConectar->ejecutarSentencia($valores,$sql);
    }
    
    
    public function borrar_libro($valores){
    	$oConectar = new consultarDB;
    	$sql='DELETE FROM tblLibros WHERE id_libro ?';
    	$oConectar->ejecutarSentencia($valores,$sql);
    }
    
    public function autoComplete($valores){
    	$oConectar = new consultarDB;
    	$sql = "SELECT id_libro,titulo FROM tblLibros WHERE titulo LIKE ? ";//and estado!=0";
    	$resultados =$oConectar->consultar_ac($valores,$sql);
    	$result = array();
    	$i = 0;
    	foreach ($resultados as $row) {
    		$result[$i]=array('id'=>$row["id_libro"],'value'=>$row["titulo"]);
    		$i++;
    	}
    	return $result;
    }
    
    public function actualizarEstadoLibro($estado,$valores){
        $oConectar = new consultarDB;
    	$sql='UPDATE tblLibros SET estado ='.$estado.' WHERE id_libro IN (?)';
    	$oConectar->ejecutarSentencia($valores,$sql);
    }
}
?>