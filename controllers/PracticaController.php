<?php
require_once '../class/Practica.php';

$practica= Practica::singleton();

switch ($_GET["op"]) {

	case 1:
			insertarPractica($practica);
			break;
}



function insertarPractica($practica){
	
	$idPractica      = $_GET['idPractica'];
    $idPracticante   = $_GET['idPracticante'];
    $tipopractica    = $_POST['tipopractica'];
    $fechaPractica   = $_POST['fechaPractica'];
    $valor           = $_POST['valor'];

    
    //Valida antes si el encabezado ya no fue creado cuando se inserta una practica por primera vez 
	if(empty($idPractica)){
        
		$valores     = array($tipopractica,$fechaPractica,$valor);
		$idPractica  = $practica->insertarEncabezadoPractica($valores);

	}
    
 
    //Si existe practicante y practica se agrega al detalle
	if(!empty($idPrestamo) && !empty($idPracticante)){
        
		$valores2    = array($idPrestamo,$idPracticante,$valor);

		$practica    -> insertarPracticantePractica($valores2);
        
	}
	
	echo $idPrestamo;
	
}


?>