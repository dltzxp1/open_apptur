<?php

require_once("../modelo/dao/foto.php");
$pr_id = $_GET['pr_id'];
$ca_id = $_GET['ca_id'];
$cat_id = $_GET['cat_id'];
$si_id = $_GET['si_id'];
/*
  $pr_id = 5;
  $ca_id = 21;
  $cat_id = 1;
  $si_id = 1;
 */

$objF = new foto('0', '0', '0', '0', '0', '0', '0');
$script = "select * from foto where pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id order by fo_nombre ASC;";
$objF->obtenerPagin($script);
$arrF = $objF->arregloFoto;

header('Content-type: application/json');

$response["fotos"] = array();
if (count($arrF) > 0) {
    for ($r = 0; $r < count($arrF); $r++) {
        $foto = array();
        $foto["Efo_id"] = $arrF[$r]->fo_id;
        $foto["Efo_nombre"] = $arrF[$r]->fo_nombre;
        $foto["Efo_descripcion"] = $arrF[$r]->fo_descripcion;
        $foto["Efo_archivo_bytea"] = base64_encode($arrF[$r]->fo_archivo_bytea);
        array_push($response["fotos"], $foto);
    }
    $response["success"] = 1;
    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No sitios found";
    echo json_encode($response);
}
?> 