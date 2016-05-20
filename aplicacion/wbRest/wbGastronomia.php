<?php

require_once("../modelo/dao/gastronomia.php");

$pr_id = $_GET['pr_id'];
$ca_id = $_GET['ca_id'];
$cat_id = $_GET['cat_id'];
$si_id = $_GET['si_id'];


/*  $pr_id = 5;
  $ca_id = 21;
  $cat_id = 1;
  $si_id = 1;
 */

$objG = new gastronomia('0', '0', '0', '0', '0', '0', '0');
$script = "select * from gastronomia where pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id order by ga_nombre ASC;";
$objG->obtenerPagin($script);
$arrG = $objG->arregloGastronomia;

header('Content-type: application/json');

$response["gastronomias"] = array();
if (count($arrG) > 0) {
    for ($r = 0; $r < count($arrG); $r++) {
        $gastronomia = array();
        $gastronomia["Ega_id"] = $arrG[$r]->ga_id;
        $gastronomia["Ega_nombre"] = $arrG[$r]->ga_nombre;
        $gastronomia["Ega_descripcion"] = $arrG[$r]->ga_descripcion;
        $gastronomia["Ega_archivo_bytea"] = base64_encode($arrG[$r]->ga_archivo_bytea);
        array_push($response["gastronomias"], $gastronomia);
    }
    $response["success"] = 1;
    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No sitios found";
    echo json_encode($response);
}
?> 