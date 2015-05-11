<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once ("../class/Conexion.php");

class Practica
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
    

   public function insertarEncabezadoPractica($valores)
    {	$oCnx = new Conexion(); 
    	$sql='INSERT INTO tblPracticas VALUES (?,?,?)';
    	$id = $oCnx->ejecutarSentencia($valores,$sql);
    	return $id;
    }
    
    public function insertarPracticantePractica($valores)
    {	$oCnx = new Conexion();
        $sql='INSERT INTO tblDetallePracticas VALUES (?,?,?)';
    	$id =$oCnx->ejecutarSentencia($valores,$sql);
    	return $id;
    }
}
?>