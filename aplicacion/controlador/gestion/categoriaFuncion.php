<?php

require_once("../../modelo/dao/categoria.php");

$opcion = $_REQUEST['opcion'];
$cat_nombre = $_REQUEST['cat_nombre'];
$cat_descripcion = $_REQUEST['cat_descripcion'];

$objCategoria = new categoria('');

if ($opcion == 0) {
    if ($objCategoria->insertar($cat_nombre, $cat_descripcion))
        echo 'categoria Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar la Categoria. Trate de nuevo';
}else if ($opcion == 1) {
    $cat_id = $_REQUEST['cat_id'];
    $inserto = $objCategoria->actualiza($cat_id, $cat_nombre, $cat_descripcion);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita ral categoria. Trate de nuevo';
    else
        echo 'categoria Editada';
}
if ($opcion == 3) {
    $cat_id = $_REQUEST['cat_id'];
    $objCategoria->eliminar($cat_id);
}
?>
 
