<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once ("../class/Conexion.php");

class Libros
{
  private static $instancia;
  private   $oConectar;
    
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
    
    public function listarLibro($valores)
    {
    	$sql1 = "SELECT COUNT(*) AS count FROM tblLibros ";
		$sql2 = "SELECT id_libro,titulo,codigo,descripcion,editorial,año,observaciones,estado,autores  FROM tblLibros ";
		
    	$resultados = $this->oConectar->listarGrid($valores,$sql1,$sql2);
    	
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
    
    public function insertarLibro($valores)
            {		
        
        
    	$sql='INSERT INTO tblLibros (numeroAcceso ,codigo ,autores ,titulo ,editorial ,año ,isbn ,serie ,pais ,paginas ,ejemplares ,descripcion ,observaciones,encuadernar ,estado )VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,1)';
    	$this->oConectar->ejecutarSentencia($valores,$sql);
    }
    
    public function actualizarLibro($valores){
    	$sql='UPDATE tblLibros SET numeroAcceso=? ,codigo=? ,autores=? ,titulo=? ,editorial=? ,año=? ,isbn=? ,serie=? ,pais=? ,paginas=? ,ejemplares=? ,descripcion=? ,observaciones=?,encuadernar=?  WHERE id_libro = ?';
    	$this->oConectar->ejecutarSentencia($valores,$sql);
    }
    
    
    public function borrarLibro($valores){
    	$sql='DELETE FROM tblLibros WHERE id_libro = ?';
    	$this->oConectar->ejecutarSentencia($valores,$sql);
    }
    
    public function autoComplete($valores){
    	$sql = "SELECT id_libro,titulo FROM tblLibros WHERE titulo LIKE ? and estado!=0";
    	$resultados =$this->oConectar->consultar_ac($valores,$sql);
    	$result = array();
    	$i = 0;
    	foreach ($resultados as $row) {
    		$result[$i]=array('id'=>$row["id_libro"],'value'=>$row["titulo"]);
    		$i++;
    	}
    	return $result;
    }
    
    public function actualizarEstadoLibro($estado,$valores){
    	$oCnx = new Conexion();
        
       // echo "1: ".$valores[0]." 2: ".$valores[1]." 3: ".$valores[2];
            
            $sql='UPDATE tblLibros SET estado ='.$estado.' WHERE id_libro IN (?)';
            $oCnx->ejecutarSentencia($valores,$sql);            

        

    }
}
?>