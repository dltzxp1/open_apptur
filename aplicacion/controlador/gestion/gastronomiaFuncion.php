<?php

require_once("../../modelo/dao/gastronomia.php");

$opcion = $_REQUEST['opcion'];
$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$ga_nombre = $_REQUEST['ga_nombre'];
$ga_descripcion = $_REQUEST['ga_descripcion'];
$ga_img = $_REQUEST['ga_img'];

$objGastronomia = new gastronomia(0, 0, 0, 0, 0, 0, 0);
session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];
$us_t_gas = $_SESSION["usTgas"];

/* tamanio asignado */
$objGastronomia->obtenerTamGas($em_id, $us_id, $si_id);
$arrGastro = $objGastronomia->arregloGastronomia;
$total_gastr = count($arrGastro);
$total_gastr +=1;

/* * ********* */

if ($opcion == 3) {
    $ga_id = $_REQUEST['ga_id'];
    $objGastronomia->eliminar($pr_id, $ca_id, $cat_id, $si_id, $ga_id, $em_id, $us_id);
}
if ($opcion == 0) {
    ///Validamos para que solo pueda Ingresar 2 Historias.
    if ($total_gastr > $us_t_gas) {
        echo "Usted puede ingresar solo " . $us_t_gas . " Gastronomias !";
        exit;
    }
    if (strlen($ga_img) > 0) {
        if ($objGastronomia->insertar($pr_id, $ca_id, $cat_id, $si_id, $ga_nombre, $ga_descripcion, $ga_img, $em_id, $us_id)) {
            echo utf8_encode("Gastronomias Ingresadas: " . $total_gastr . ', Limite: ' . $us_t_gas);
            exit;
        } else {
            echo utf8_encode("Error1");
            exit;
        }
    }
} else if ($opcion == 1) {
    $ga_id = $_REQUEST['ga_id'];
    if (strlen($ga_img) > 0) {
        if ($objGastronomia->actualiza($pr_id, $ca_id, $cat_id, $si_id, $ga_id, $ga_nombre, $ga_descripcion, $ga_img, $em_id, $us_id)) {
            echo utf8_encode("Edicion Correcta.");
            exit;
        } else {
            echo utf8_encode("Error.e");
            exit;
        }
    } else {
        if ($objGastronomia->actualizaSinImg($pr_id, $ca_id, $cat_id, $si_id, $ga_id, $ga_nombre, $ga_descripcion, $em_id, $us_id)) {
            echo utf8_encode("Gastronomia sin Img Editado!");
            exit;
        } else {
            echo utf8_encode("Error.");
            exit;
        }
    }
}
?>