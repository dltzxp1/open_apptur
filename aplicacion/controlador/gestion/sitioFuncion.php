<?php

require_once("../../modelo/dao/sitio.php");

$opcion = $_REQUEST['opcion'];
$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_nombre = $_REQUEST['si_nombre'];
$si_descripcion = $_REQUEST['si_descripcion'];
$si_paginaweb = $_REQUEST['si_paginaweb'];
$si_mail = $_REQUEST['si_mail'];
$si_facebook = $_REQUEST['si_facebook'];
$si_twitter = $_REQUEST['si_twitter'];
$si_direccion = $_REQUEST['si_direccion'];
$si_telefono = $_REQUEST['si_telefono'];
$si_latitud = $_REQUEST['lat_x'];
$si_longitud = $_REQUEST['lon_y'];

$objSitio = new sitio('0', '0', '0', '0', '0');

session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];
$usTsit = $_SESSION["usTsit"];

/* tamanio asignado */
$objSitio->obtenerTamSitio($em_id, $us_id);
$arrSitio = $objSitio->arregloSitio;
$total_sitio = count($arrSitio);
$total_sitio+=1;
/* * ********* */

if ($opcion == 3) {
    $si_id = $_REQUEST['si_id'];
    $objSitio->eliminar($pr_id, $ca_id, $si_id, $em_id, $us_id);
}

if ($opcion == 0) {
    if ($total_sitio > $usTsit) {
        echo "Usted puede ingresar solo " . $usTsit." Sitios !";
        exit;
    }
    if ($objSitio->insertar($pr_id, $ca_id, $cat_id, $si_nombre, $si_descripcion, $si_paginaweb, $si_mail, $si_facebook, $si_twitter, $si_direccion, $si_telefono, $si_latitud, $si_longitud, $em_id, $us_id)) {
        echo utf8_encode("Sitio Ingresados: " . $total_sitio . ', Limite: ' . $usTsit);
        exit;
    } else {
        echo utf8_encode("Error1");
        exit;
    }
} else if ($opcion == 1) {
    $si_id = $_REQUEST['si_id'];
    if ($objSitio->actualiza($pr_id, $ca_id, $cat_id, $si_id, $si_nombre, $si_descripcion, $si_paginaweb, $si_mail, $si_facebook, $si_twitter, $si_direccion, $si_telefono, $si_latitud, $si_longitud, $em_id, $us_id)) {
        echo utf8_encode("Edicion Correcta.");
    } else {
        echo utf8_encode("Error.");
    }
}
?>