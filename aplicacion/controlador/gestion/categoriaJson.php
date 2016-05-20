<?php

require_once("../../modelo/dao/categoria.php");

$objCategoria = new categoria('0');
$arrCategoria = $objCategoria->arregloCategoria;

$arreglo = array();

for ($i = 0; $i < count($arrCategoria); $i++) {
    $arreglo[$i] = $arrCategoria[$i]->cat_nombre;
}

echo json_encode($arreglo);
?>

