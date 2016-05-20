<?php

require_once("../../modelo/dao/canton.php");

$opcion = $_REQUEST['opcion'];
$ca_pr_id = $_REQUEST['ca_pr_id'];
$ca_nombre = $_REQUEST['ca_nombre'];
$ca_descripcion = $_REQUEST['ca_descripcion'];
$ca_poblacion = $_REQUEST['ca_poblacion'];

$objCanton = new canton('0', '0');

if ($opcion == 0) {
    $inserto = $objCanton->insertarImagen($ca_pr_id, $ca_nombre, $ca_descripcion, $ca_poblacion);
    //$inserto = $objCanton->insertarImagen($pr_id, $ca_nombre, $ca_descripcion, $ca_poblacion, $ca_latitud, $ca_longitud);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo ingresar el Canton. Trate de nuevo';
    else
        echo 'Canton Ingresado';
} else if ($opcion == 1) {
    $ca_id = $_REQUEST['ca_id'];
    $inserto = $objCanton->actualiza($ca_pr_id, $ca_id, $ca_nombre, $ca_descripcion, $ca_poblacion);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Editar la Canton. Trate de nuevo';
    else
        echo 'Canton Editado';
}
if ($opcion == 3) {
    $ca_id = $_REQUEST['ca_id'];
    $objCanton->eliminar($ca_pr_id, $ca_id);
}
?>
 
