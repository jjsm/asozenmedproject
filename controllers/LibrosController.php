<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../class/Libros.php';

    $libros = Libros::singleton();

switch ($_GET["op"]) {
	case 0:
		listarLibro($libros);
		break;
	case 1:
		insertarLibro($libros);
		break;
	case 2:
		editarLibro($libros);
		break;
	case 3:
		eliminarLibro($libros);
		break;
    case 4:
		buscarLibroAutoComplete($libros);
		break;

}

function listarLibro($libros){
	
	$post=array(
			'limit'=>(isset($_REQUEST['rows']))?$_REQUEST['rows']:'',// Almacena el numero de filas que se van a mostrar por pagina
			'page'=>(isset($_REQUEST['page']))?$_REQUEST['page']:'',// Almacena el numero de pagina actual
			'orderby'=>(isset($_REQUEST['sidx']))?$_REQUEST['sidx']:'',// Almacena el indice por el cual se hará la ordenación de los datos
			'orden'=>(isset($_REQUEST['sord']))?$_REQUEST['sord']:'',  // Almacena el modo de ordenación
	);
	
	//consultamos los valores
	$array = $libros->listarLibro($post);
	
	echo json_encode($array);
}

function insertarLibro($libros){
	
          $numeroAcceso= $_POST['numeroAcceso'];
          $codigo= $_POST['codigo'];
          $autor= $_POST['autor'];
          $titulo= $_POST['titulo'];
          $editorial= $_POST['editorial'];
          $ano= $_POST['ano'];
          $isbn= $_POST['isbn'];
          $serie= $_POST['serie'];
          $pais= $_POST['pais'];
          $pagina= $_POST['pagina'];
          $ejemplares= $_POST['ejemplares'];
          $descripcion= $_POST['descripcion'];
          $observaciones= $_POST['observaciones'];
          $encuadernar= $_POST['encuadernar'];
	
	$valores = array($numeroAcceso,$codigo,$autor,$titulo,$editorial,$ano,$isbn,$serie,$pais,$pagina,$ejemplares,$descripcion,$observaciones,$encuadernar);
	$libros->insertarLibro($valores);
}

function editarLibro($libros){
	
	$id = $_GET['idLibro'];
    echo "Identificador: ".$id;
    $numeroAcceso= $_POST['numeroAcceso'];
    $codigo= $_POST['codigo'];
    $autor= $_POST['autor'];
    $titulo= $_POST['titulo'];
    $editorial= $_POST['editorial'];
    $ano= $_POST['ano'];
    $isbn= $_POST['isbn'];
    $serie= $_POST['serie'];
    $pais= $_POST['pais'];
    $pagina= $_POST['pagina'];
    $ejemplares= $_POST['ejemplares'];
    $descripcion= $_POST['descripcion'];
    $observaciones= $_POST['observaciones'];
    $encuadernar= $_POST['encuadernar'];
	
    $valores = array($numeroAcceso,$codigo,$autor,$titulo,$editorial,$ano,$isbn,$serie,$pais,$pagina,$ejemplares,$descripcion,$observaciones,$encuadernar,$id);
	
	$libros->actualizarLibro($valores);
}

function eliminarLibro($libros){
	
	$id = $_POST['id'];
    echo "id del usuario a eliminar".$id;
	$valores = array($id);
	$libros->borrarLibro($valores);
	
}


function buscarLibroAutoComplete($libros){
    
    $term = $_GET['term'];
    
    //concatena
    $valores = array("%".$term."%");

    $result = $libros->autoComplete($valores);

    echo json_encode($result);
    
}

?>