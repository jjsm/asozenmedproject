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

}

function listarLibro($libros){
	
	$post=array(
			'limit'=>(isset($_REQUEST['rows']))?$_REQUEST['rows']:'',// Almacena el numero de filas que se van a mostrar por pagina
			'page'=>(isset($_REQUEST['page']))?$_REQUEST['page']:'',// Almacena el numero de pagina actual
			'orderby'=>(isset($_REQUEST['sidx']))?$_REQUEST['sidx']:'',// Almacena el indice por el cual se hará la ordenación de los datos
			'orden'=>(isset($_REQUEST['sord']))?$_REQUEST['sord']:'',  // Almacena el modo de ordenación
	);
	
	//consultamos los valores
	$array = $libros->listar_libro($post);
	
	echo json_encode($array);
}

function insertarLibro($libros){
	
	$titulo = $_POST['titulo'];
	$codigo = $_POST['codigo'];
	$descripcion = $_POST['descripcion'];
	$editoria = $_POST['editorial'];
	$ano = $_POST['año'];
	$observaciones = $_POST['observaciones'];
	$autores = $_POST['autores'];
	
	$valores = array($titulo,$codigo,$descripcion,$editoria,$ano,$observaciones,$autores);
	$libros->insertar_libro($valores);
}

function editarLibro($libros){
	
	$id = $_POST['id'];
	$titulo = $_POST['titulo'];
	$codigo = $_POST['codigo'];
	$descripcion = $_POST['descripcion'];
	$editoria = $_POST['editorial'];
	$ano = $_POST['año'];
	$observaciones = $_POST['observaciones'];
	$autores = $_POST['autores'];
	
	$valores = array($titulo,$codigo,$descripcion,$editoria,$ano,$observaciones,$autores,$id);
	
	$libros->actualizar_libro($valores);
}

function eliminarLibro($libros){
	
	$id = $_POST['id'];
	$valores = array($id);
	$libros->borrar_libro($valores);
	
}

?>