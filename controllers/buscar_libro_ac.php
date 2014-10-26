<?php
require_once '../class/Libros.php';

$libros = Libros::singleton();

$term = $_GET['term'];

$valores = array("%".$term."%");

$result = $libros->autoComplete($valores);

echo json_encode($result);
?>