<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../class/Usuario.php';

	$usuarios = Usuario::singleton();

switch ($_GET["op"]) {
	case 0:
		listarUsuario($usuarios);
		break;
	case 1:
		insertarUsuario($usuarios);
		break;
	case 2:
		editarUsuario($usuarios);
		break;
	case 3:
		eliminarUsuario($usuarios);
		break;
    case 4:
        buscarUsuariosAutoComplete($usuarios);
        break;
}


function listarUsuario($usuarios){
	$post=array(
			'limit'=>(isset($_REQUEST['rows']))?$_REQUEST['rows']:'',// Almacena el numero de filas que se van a mostrar por pagina
			'page'=>(isset($_REQUEST['page']))?$_REQUEST['page']:'',// Almacena el numero de pagina actual
			'orderby'=>(isset($_REQUEST['sidx']))?$_REQUEST['sidx']:'',// Almacena el indice por el cual se hará la ordenación de los datos
			'orden'=>(isset($_REQUEST['sord']))?$_REQUEST['sord']:'',  // Almacena el modo de ordenación
	);
	echo "Hola";
	$resultados = $usuarios->listarUsuario($post);
	
	echo json_encode($resultados);
	
}

function insertarUsuario($usuarios){
	$cedula = $_POST['cedula'];
	$usuario = $_POST['usuario'];
	$correo = $_POST['correo'];
	$celular = $_POST['celular'];
	$telefono = $_POST['telefono'];
    $edad = $_POST['edad'];
    $ingreso = date('Y-m-d', strtotime($_POST['ingreso']));
    $direccion = $_POST['direccion'];
    $profesion = $_POST['profesion'];
    $descubrio = $_POST['descubrio'];
	
	$valores = array($cedula,$usuario,$correo,$celular,$telefono,$edad,$ingreso,$direccion,$profesion,$descubrio);
	
    $usuarios->insertUsuario($valores);	
}

function editarUsuario($usuarios){
	$id = $_POST['id'];
    echo "prueba2".$_POST['id'];
	$cedula = $_POST['cedula'];
	$usuario = $_POST['usuario'];
	$correo = $_POST['correo'];
	$celular = $_POST['celular'];
	$telefono = $_POST['telefono'];
	$valores=array($cedula,$usuario,$correo,$celular,$telefono,$id);
    $usuarios->actualizarUsuario($valores);
}

function eliminarUsuario($usuarios){
	$id = $_POST['id'];
	$valores=array($id);
    echo "Id Usuario".$id;
	$usuarios->borrarUsuario($valores);	
}


function buscarUsuariosAutoComplete($usuarios){
    $term = $_GET['term'];
    $valores = array("%".$term."%");

    $result = $usuarios->autoComplete($valores);
 
    echo json_encode($result);
     
}


?>