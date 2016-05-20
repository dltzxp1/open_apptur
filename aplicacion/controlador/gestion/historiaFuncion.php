<?php

require_once("../../modelo/dao/historia.php"); 

$opcion = $_REQUEST['opcion'];
$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$hi_nombre = $_REQUEST['hi_nombre'];
$hi_descripcion = $_REQUEST['hi_descripcion'];

$objHistoria = new historia(0, 0, 0, 0, 0, 0, 0);
session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];
$us_t_his = $_SESSION["usThis"];

/* tamanio asignado */
$objHistoria->obtenerTamHisto($em_id, $us_id, $si_id);
$arrHisto = $objHistoria->arregloHistoria;
$total_historia = count($arrHisto);
$total_historia +=1;
/* * ********* */

if ($opcion == 3) {
    $hi_id = $_REQUEST['hi_id'];
    $objHistoria->eliminar($pr_id, $ca_id, $cat_id, $si_id, $hi_id, $em_id, $us_id);
}

if ($opcion == 0) {
    ///Validamos para que solo pueda Ingresar 2 Historias.
    if ($total_historia > $us_t_his) {
        echo "Usted puede ingresar solo " . $us_t_his . " Historias !";
        exit;
    }
    if ($objHistoria->insertar($pr_id, $ca_id, $cat_id, $si_id, $hi_nombre, $hi_descripcion, $em_id, $us_id)) {
        echo utf8_encode("Historias Ingresados: " . $total_historia . ', Limite: ' . $us_t_his);
        exit;
    } else {
        echo utf8_encode("Error1");
        exit;
    }
} else if ($opcion == 1) {
    $hi_id = $_REQUEST['hi_id'];
    if ($objHistoria->actualiza($pr_id, $ca_id, $cat_id, $si_id, $hi_id, $hi_nombre, $hi_descripcion, $em_id, $us_id)) {
        echo utf8_encode("Edicion Correcta.");
        exit;
    } else {
        echo utf8_encode("Error.e");
        exit;
    }
}
?>