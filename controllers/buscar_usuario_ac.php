<?php
require_once '../class/Usuario.php';

$usuario = Usuario::singleton();

$term = $_GET['term'];

$valores = array("%".$term."%");

 $result = $usuario->autoComplete($valores);
 
 echo json_encode($result);

?>