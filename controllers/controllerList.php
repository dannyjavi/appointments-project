<?php
declare(strict_types = 1);
require_once '../models/Personas.php';

$persona = new Personas();
$data = array();
$paginacion = array();
$pagina = $_POST['pagina'] ?? 1 ;
$termino = $_POST['termino'] ?? '';

$paginacion = $persona->getPagination();
#$filasTotal creo que no se usa luego...
$filasTotal  = $paginacion['filasTotal'];
$filasPagina = $paginacion['filasPagina'];

$empezarDesde = ($pagina - 1) * $filasPagina;

if($termino != ''){
	$data = $persona->getSearch($termino);
}else{
	$data=$persona->getAll($empezarDesde,$filasPagina);	
}
echo $persona->showTable($data);

