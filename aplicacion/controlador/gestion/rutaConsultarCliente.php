<?php

require_once("../../modelo/dao/ruta.php");

$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$ru_id = $_REQUEST['ru_id']; 
 
$objRuta = new ruta('0', '0', '0', '0', '0', '0', '0');
$objRuta->selectLineCliente($pr_id, $ca_id, $cat_id, $si_id, $ru_id); 
$arrRuta = $objRuta->arregloRuta; 
$arreglo = array();
$arreglo[0] = $arrRuta[0]->pr_id;
echo json_encode($arreglo);

?>