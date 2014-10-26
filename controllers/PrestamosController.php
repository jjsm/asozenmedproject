<?php
require_once '../class/Prestamos.php';

$prestamos = Prestamos::singleton();

switch ($_GET["op"]) {
	case 0:
			listarPrestamo($prestamos);
			break;
	case 1:
			insertarPrestamo($prestamos);
			break;
	case 2:
			listarDetallePrestamo($prestamos,$_GET["id"]);
			break;
	
}


function listarPrestamo($prestamos){
		
	$post=array(
			'limit'=>(isset($_REQUEST['rows']))?$_REQUEST['rows']:'',// Almacena el numero de filas que se van a mostrar por pagina
			'page'=>(isset($_REQUEST['page']))?$_REQUEST['page']:'',// Almacena el numero de pagina actual
			'orderby'=>(isset($_REQUEST['sidx']))?$_REQUEST['sidx']:'',// Almacena el indice por el cual se hará la ordenación de los datos
			'orden'=>(isset($_REQUEST['sord']))?$_REQUEST['sord']:'',  // Almacena el modo de ordenación
	);

	//consultamos los valores
	$array = $prestamos->listar_prestamo($post);

	echo json_encode($array);
}

function insertarPrestamo($prestamos){
	
	$f_prestamo = date('Y-m-d', strtotime($_POST['prestamo']));
	$f_entrega = date('Y-m-d', strtotime($_POST['entrega']));
	$practicante = $_POST['id-practicante'];
	$prestado = $_POST['id-prestado'];
	$idLibro = $_POST['id-libro'];
	$idPrestamo = $_POST['id'];
	//Valida antes si el encabezado ya no fue creado cuando se inserta un libro por primera vez 
	if(empty($idPrestamo)){
		$valores = array($f_prestamo,$f_entrega,$practicante,$prestado);
		$idPrestamo =$prestamos->insertarEncabezadoPrestamo($valores);
	}

	if(!empty($idPrestamo) && !empty($idLibro)){
		$valores2=array($idLibro,$idPrestamo);
		$prestamos->insertarLibroPrestamo($valores2);
	}
	
	echo $idPrestamo;
	
}

function listarDetallePrestamo($prestamos,$detalle){
	$post=array(
			'limit'=>(isset($_REQUEST['rows']))?$_REQUEST['rows']:'',// Almacena el numero de filas que se van a mostrar por pagina
			'page'=>(isset($_REQUEST['page']))?$_REQUEST['page']:'',// Almacena el numero de pagina actual
			'orderby'=>(isset($_REQUEST['sidx']))?$_REQUEST['sidx']:'',// Almacena el indice por el cual se hará la ordenación de los datos
			'orden'=>(isset($_REQUEST['sord']))?$_REQUEST['sord']:'',  // Almacena el modo de ordenación
	);
	
	//consultamos los valores
	$array = $prestamos->listarDetalleprestamo($post,$detalle);
	
	echo json_encode($array);
}

?>