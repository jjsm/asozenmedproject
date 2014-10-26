<?php

require_once ("../cfg/configuracion.php");

class consultarDB extends configuracion //clase principal de conexion y consultas
{
    private static $instancia;
    private $conexion;

    public function __construct()
    {
            $this->conexion = parent::conectar(); //creo una variable con la conexión configuracion.php
            return $this->conexion;
    }

    public static function singleton()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    
    
    public function ejecutarSentencia($valores,$sql)
    {
    	try {
    		$this->conexion->beginTransaction();
    		$query = $this->conexion->prepare($sql);
    		
    		if (!$query->execute($valores)) { //si no se ejecuta la consulta...
    			print_r($query->errorInfo()); //imprimir errores
    		}
    		
    		$id = $this->conexion->lastInsertId();
    		
    		$this->conexion->commit();
    
    	} catch (PDOException $e) {
    		$this->conexion->rollBack();
    		$e->getMessage();
    	}
    	$this->conexion = null;
    	
    	return $id;
    }

    public function listarGrid($post,$sql1,$sql2)
    {	
    	//Realizamos la consulta para saber el numero de filas que hay en la tabla con los filtros
    	$count = $this->conexion->query($sql1)->fetchColumn();
    	if(!$count)
    		echo mysql_error();
    	
    	if( $count > 0 && $post['limit'] > 0) {
    		//Calculamos el numero de paginas que tiene el sistema
    		$total_pages = ceil($count/$post['limit']);
    		if ($post['page'] > $total_pages) $post['page']=$total_pages;
    		//calculamos el offset para la consulta mysql.
    		$post['offset']=$post['limit']*$post['page'] - $post['limit'];
    	} else {
    		$total_pages = 0;
    		$post['page']=0;
    		$post['offset']=0;
    	}
    	//Creamos la consulta que va a ser enviada de una ves con la parte de filtrado
    	if( !empty($post['orden']) && !empty($post['orderby']))
    		//Añadimos de una ves la parte de la consulta para ordenar el resultado
    		$sql1 .= " ORDER BY $post[orderby] $post[orden] ";
    	if($post['limit'] && $post['offset']) $sql.=" limit $post[offset], $post[limit]";
    	//añadimos el limite para solamente sacar las filas de la apgina actual que el sistema esta consultando
    	elseif($post['limit']) $sql1 .=" limit 0,$post[limit]";
    	
    	//$query = mysql_query($sql);
    	$query = $this->conexion->prepare($sql2);
    	$query->execute();
    	if(!$query)
    		echo mysql_error();
    	$records=$query->fetchAll();
    	
    	$result=array($records,$total_pages,$post['page'],$count);
    	
    	$this->conexion = null;
		return $result;   	 
    }
    
    public function consultar_ac($valores,$sql){
	    $query = $this->conexion->prepare($sql);
	    $query->execute($valores);
	    if(!$query)
	    	echo mysql_error();
	    $records=$query->fetchAll();
	     
	    $this->conexion = null;
	    return $records;	    
    }
}
?>