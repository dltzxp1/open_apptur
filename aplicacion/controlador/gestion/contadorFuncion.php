<?php

require_once("../../modelo/dao/contador.php");

$opcion = $_REQUEST['opcion'];
$id = $_REQUEST['id'];

$objContador = new contador('0');


if ($opcion == 3) { 
    $objContador->eliminar($id);
}
?>
 
