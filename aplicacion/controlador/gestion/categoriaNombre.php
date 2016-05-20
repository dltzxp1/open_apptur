<?php

require_once("../../modelo/dao/categoria.php");
$catNom = $_REQUEST['catNom'];

$objCategoria = new categoria('0');
$script = "select cat_id from categoria where cat_nombre='$catNom'";
$objCategoria->obtenerPagin($script);
echo "$objCategoria->cat_id";
?>
