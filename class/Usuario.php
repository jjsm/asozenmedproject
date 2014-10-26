<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once ("../class/consultarDB.php");

class Usuario
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
    
    public function listar_usuario($valores)
    {
    	$oConectar = new consultarDB;
    	$sql1 = "SELECT COUNT(*) AS count FROM tblusuarios ";
		$sql2 = "SELECT id_usuario,cedula,usuario,correo,celular,telefono FROM tblusuarios ";
    	$resultados = $oConectar->listarGrid($valores,$sql1,$sql2);
    	
    	$result = array();
    	$i = 0;
    	foreach ($resultados[0] as $row) {
    		$result[$i]['id']=$row["id_usuario"];
    		$result[$i]['cell']=array($row["id_usuario"],$row["cedula"],$row["usuario"],$row["correo"],$row["celular"],$row["telefono"]);
    		$i++;
    	}
    	//Asignamos todo esto en variables de json, para enviarlo al navegador.
    	$arr = array('rows' =>$result, 'total' => $resultados[1], 'page' => $resultados[2], 'records' => $resultados[3]);
    	// close the database connection
    	return $arr;
    }
    
    public function insert_usuario($valores)
    {		
    	$oConectar = new consultarDB;
    	$sql='INSERT INTO tblusuarios VALUES (null,?,?,?,?,?)';
    	$oConectar->ejecutarSentencia($valores,$sql);
    }
    
    public function actualizar_usuario($valores){
    	$oConectar = new consultarDB;
    	$sql='UPDATE tblusuarios SET cedula = ?,usuario = ?, correo =?,celular = ?,telefono = ? WHERE id_usuario= ?';
    	$oConectar->ejecutarSentencia($valores,$sql);
    }
    
    
    public function borrar_usuario($valores){
    	$oConectar = new consultarDB;
    	$sql='DELETE FROM tblusuarios WHERE id_usuario = ?';
    	$oConectar->ejecutarSentencia($valores,$sql);
    }
    
    public function autoComplete($valores){
    	$oConectar = new consultarDB;
    	$sql = "SELECT id_usuario,usuario FROM tblusuarios WHERE usuario LIKE ?";
    	$resultados =$oConectar->consultar_ac($valores,$sql);
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