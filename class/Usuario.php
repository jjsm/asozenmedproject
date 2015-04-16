<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once ("../class/Conexion.php");

class Usuario
{
    private static $instancia;
    private $oConectar ;
    
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
    
    public function listarUsuario($valores)
    {
    	$sql1 = "SELECT COUNT(*) AS count FROM tblusuarios ";
		$sql2 = "SELECT id_usuario,cedula,usuario,correo,celular,telefono FROM tblusuarios ";
    
        $resultados = $this->oConectar->listarGrid($valores,$sql1,$sql2);
    	
    	$result = array();
    	$i = 0;
    	
        foreach ($resultados[2] as $row) {
    		//$result[$i]['id']=$row["id_usuario"];
    		$result=array($row["id_usuario"],$row["cedula"],$row["usuario"],$row["correo"],$row["celular"],$row["telefono"]);

    	}
        
    	//Asignamos todo esto en variables de json, para enviarlo al navegador.
    	//$arr = array('rows' =>$result, 'total' => $resultados[1], 'page' => $resultados[2], 'records' => $resultados[3]);    	
    	
        
      $arr = array('current' =>$resultados[0], 'rowCount' =>$resultados[1] , 'rows' =>$result , 'total' =>$resultados[3] );
    //{"current": 1,"rowCount": 10,"rows": [{"id": 19,"sender": "123@test.de","received": "2014-05-30T22:15:00"}],"total": 1123}
        
        
    	return $arr;
    }
    
    public function insertUsuario($valores)
    {		
    	$sql='INSERT INTO tblusuarios VALUES (null,?,?,?,?,?,?,?,?,?,?)';
    	$this->oConectar->ejecutarSentencia($valores,$sql);
    }
    
    public function actualizarUsuario($valores){
    	$sql='UPDATE tblusuarios SET cedula = ?,usuario = ?, correo =?,celular = ?,telefono = ? ,
        edad = ?, ingreso = ?, direccion = ?, profesion = ?, descubrio = ?  WHERE id_usuario= ?';
    	$this->oConectar->ejecutarSentencia($valores,$sql);
    }
    
    
    public function borrarUsuario($valores){
    	$sql='DELETE FROM tblusuarios WHERE id_usuario = ?';
    	$this->oConectar->ejecutarSentencia($valores,$sql);
    }
    
    public function autoComplete($valores){
    	$sql = "SELECT id_usuario,usuario FROM tblusuarios WHERE usuario LIKE ?";
    	$resultados =$this->oConectar->consultar_ac($valores,$sql);
    	$result = array();
    	$i = 0;
        
    	foreach ($resultados as $row) {
    		$result[$i]=array('id'=>$row["id_usuario"],'value'=>$row["usuario"]);
    		$i++;
    	}
        
    	return $result;
    }
}
?>