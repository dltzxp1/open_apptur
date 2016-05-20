<?php

require_once("../../modelo/dao/responsabilidad.php");
$opcion = $_REQUEST['opcion'];

$em_id = $_REQUEST['em_id'];
$us_id = $_REQUEST['us_id'];
$ro_id = $_REQUEST['ro_id'];
$re_nombre = $_REQUEST['re_nombre'];
$re_descripcion = $_REQUEST['re_descripcion'];
//echo $em_id.','.$us_id.','.$ro_id.','.$re_nombre.','.$re_descripcion;
$objResponsabilidad = new responsabilidad('0', '0', '0', '0');

if ($opcion == 0) {
    $inserto = $objResponsabilidad->insertar($em_id, $us_id, $ro_id, $re_nombre, $re_descripcion);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo ingresar el Responsabilidad. Trate de nuevo';
    else
        echo 'Responsabilidad Ingresado';
} else if ($opcion == 1) {
    $re_id = $_REQUEST['re_id'];
    $inserto = $objResponsabilidad->actualiza($em_id, $us_id, $ro_id, $re_id, $re_nombre, $re_descripcion);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Editar la Responsabilidad. Trate de nuevo';
    else
        echo 'Responsabilidad Editado';
}
if ($opcion == 3) {
    $re_id = $_REQUEST['re_id'];
    $objResponsabilidad->eliminar($em_id, $us_id, $ro_id, $re_id);
}
?>
 
