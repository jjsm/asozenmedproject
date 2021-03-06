<?php
require_once '../class/Prestamos.php';
require_once '../class/Libros.php';

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
    case 3:
            $id= $_GET["id"];
    
			actualizarEstadoLibro($id);
			break;
    case 4: 
            $id= $_GET["id"];
            actualizarFechaDetalle($prestamos,$id);
        break;
				break;
    case 5: 
            actualizarPrestamo($prestamos);
        break;
    
    case 6: 
            cerrarPrestamo($prestamos);
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
	$array = $prestamos->listarPrestamo($post);
    
	echo json_encode($array);
}

function insertarPrestamo($prestamos){
	
	$f_prestamo = date('Y-m-d', strtotime($_POST['prestamo']));
	$f_entrega = date('Y-m-d', strtotime($_POST['entrega']));
	$practicante = $_POST['id-practicante'];
	$prestado = $_POST['id-prestado'];
	$idLibro = $_GET['id-libro'];
	$idPrestamo = $_GET["id-prestamo"];
    $libros = Libros::singleton();
	    
   // echo "fprestamo ". $f_prestamo." f entrega  ". $f_entrega." practicante ". $practicante ." idprestadopor ".$prestado." idlibro ". $idLibro ." id prestamo ".$idPrestamo;
    
    //Valida antes si el encabezado ya no fue creado cuando se inserta un libro por primera vez 
	if(empty($idPrestamo)){
        
		$valores = array($f_prestamo,$f_entrega,$practicante,$prestado);
		$idPrestamo =$prestamos->insertarEncabezadoPrestamo($valores);

	}
    
 
    //Si existe libro y prestamo se agrega al detalle
	if(!empty($idPrestamo) && !empty($idLibro)){
        
		$valores2=array($idLibro,$idPrestamo);

		$prestamos->insertarLibroPrestamo($valores2);
        
        $valores3=array($idLibro);
        //ESTADOLIBRO 0 NO DISPONIBLE
        $libros->actualizarEstadoLibro(0,$valores3);
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

function actualizarEstadoLibro($id){
    $valores=array($id);
    $libros = Libros::singleton();
    //ESTADOLIBRO 1 dISPONIBLE
    $libros->actualizarEstadoLibro(1,$valores);
}

function actualizarFechaDetalle($prestamo,$id){
    
    $valores = array ($id);
    $prestamo->actualizarFechaDetalle($valores);
    
}

function actualizarPrestamo($prestamos){
   $f_prestamo = date('Y-m-d', strtotime($_POST['prestamo']));
	$f_entrega = date('Y-m-d', strtotime($_POST['entrega']));
	$practicante = $_POST['id-practicante'];
	$prestado = $_POST['id-prestado'];
	$idPrestamo = $_POST['id'];
   

	//Valida antes si el encabezado ya no fue creado cuando se inserta un libro por primera vez 
	if(!empty($idPrestamo)){
		$valores = array($f_prestamo,$f_entrega,$practicante,$prestado,$idPrestamo);
		$prestamos->actualizarEncabezadoPrestamo($valores);
	}
    
}

function cerrarPrestamo($prestamos){
    $idPrestamo= $_GET['id'];
    $valores = array($idPrestamo);
    //Cambia  fecha de  entrega del libro y estado del detalle en detalleprestamo
    $prestamos->cerrarPrestamo($valores);
    
    //cambia el estado del prestamo y fecha de entregado en prestamo
    $prestamos->actEstadoPrestamo($valores);
    
    //consulta lo libros que no han sido entregados(estado 1)
    $result = $prestamos->consultarLibrosPrestamo($valores);
    
    //devuelve string de los libros
    $idLibros = implode(",", $result);    

    //cambia el estado del libro para poner disponible
    $valores2 =  explode(",",$idLibros);
   // echo "1: ".$valores2[0]." 2: ".$valores2[1];
    $libros = Libros::singleton();
    
    
    
    for ($i = 0; $i < count($valores2); $i++) {
        $arra= array($valores2[$i]);
        $libros->actualizarEstadoLibro(1,$arra);
    }
    
   
}

?>