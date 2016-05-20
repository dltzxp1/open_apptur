<?php

require_once("../../modelo/dao/provincia.php");
 
$opcion = $_REQUEST['opcion'];
$pr_nombre = $_REQUEST['pr_nombre'];
$pr_descripcion = $_REQUEST['pr_descripcion'];
$pr_capital = $_REQUEST['pr_capital'];
$pr_poblacion = $_REQUEST['pr_poblacion'];
$pr_region = $_REQUEST['pr_region'];
$objProvincia = new provincia('0');

if ($opcion == 0) {
    $inserto = $objProvincia->insertarImagen($pr_nombre, $pr_descripcion, $pr_capital, $pr_poblacion, $pr_region);
    if (!$inserto) {
        echo 'Lo sentimos, no se pudo ingresar el Provincia. Trate de nuevo';
    } else {
        echo 'Provincia Ingresada!';
    }
} else if ($opcion == 1) {
    $pr_id = $_REQUEST['pr_id'];
    $inserto = $objProvincia->actualiza($pr_id, $pr_nombre, $pr_descripcion, $pr_capital, $pr_poblacion, $pr_region);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Editar el Provincia. Trate de nuevo';
    else
        echo 'Provincia Editado';
}
if ($opcion == 3) {
    $pr_id = $_REQUEST['pr_id'];
    $objProvincia->eliminar($pr_id);
}
?>
 
