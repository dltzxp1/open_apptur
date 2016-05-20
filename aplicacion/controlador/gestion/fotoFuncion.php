<?php

require_once("../../modelo/dao/foto.php");

$opcion = $_REQUEST['opcion'];
$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$fo_nombre = $_REQUEST['fo_nombre'];
$fo_descripcion = $_REQUEST['fo_descripcion'];

$nombre = basename($_FILES["archivo"]["name"]);
$type = $_FILES["archivo"]["type"];
$tmp_name = $_FILES["archivo"]["tmp_name"];
$size = $_FILES["archivo"]["size"];


$objFoto = new foto(0, 0, 0, 0, 0, 0, 0);
session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];
$us_t_fot = $_SESSION["usTfot"];

/* tamanio asignado */
$objFoto->obtenerTamFoto($em_id, $us_id, $si_id);
$arrFoto = $objFoto->arregloFoto;
$total_foto = count($arrFoto);
$total_foto +=1;
/* * ********* */

if ($opcion == 3) {
    $fo_id = $_REQUEST['fo_id'];
    $objFoto->eliminar($pr_id, $ca_id, $cat_id, $si_id, $fo_id, $em_id, $us_id);
}

if ($opcion == 0) {
    if ($total_foto > $us_t_fot) {
        echo "Usted puede ingresar solo " . $us_t_fot . " Fotos !";
        exit;
    }
    if ($size > 0) {
        if ($objFoto->insertar($pr_id, $ca_id, $cat_id, $si_id, $fo_nombre, $fo_descripcion, $nombre, $tmp_name, $type, $size, $em_id, $us_id)) {
            echo utf8_encode("Fotos Ingresados: " . $total_foto . ', Limite: ' . $us_t_fot);
            exit;
        } else {
            echo utf8_encode("Error1");
            exit;
        }
    }
} else if ($opcion == 1) {
    $fo_id = $_REQUEST['fo_id'];
    if (strlen($fo_img) > 0) {
        if ($objFoto->actualiza($pr_id, $ca_id, $cat_id, $si_id, $fo_id, $fo_nombre, $fo_descripcion, $fo_img, $em_id, $us_id)) {
            echo utf8_encode("Edicion Correcta.");
            exit;
        } else {
            echo utf8_encode("Error.e");
            exit;
        }
    } else {
        if ($objFoto->actualizaSinImg($pr_id, $ca_id, $cat_id, $si_id, $fo_id, $fo_nombre, $fo_descripcion, $em_id, $us_id)) {
            echo utf8_encode("Foto sin Img Editado!");
            exit;
        } else {
            echo utf8_encode("Error.");
            exit;
        }
    }
}
?>