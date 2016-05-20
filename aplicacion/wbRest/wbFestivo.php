<?php

require_once("../modelo/dao/festivo.php");

//5,21,1,

$pr_id = $_GET['pr_id'];
$ca_id = $_GET['ca_id'];
$cat_id = $_GET['cat_id'];
$si_id = $_GET['si_id'];

/* $pr_id = 5;
  $ca_id = 21;
  $cat_id = 1;
  $si_id = 1; */

$objF = new festivo('0', '0', '0', '0', '0', '0', '0');
$script = "select * from festivo where pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id  order by fe_nombre ASC;";
$objF->obtenerPagin($script);
$arrF = $objF->arregloFestivo;

$response["festivos"] = array();
if (count($arrF) > 0) {
    for ($r = 0; $r < count($arrF); $r++) {
        $festivo = array();
        $festivo["Efe_nombre"] = $arrF[$r]->fe_nombre;
        $festivo["Efe_descripcion"] = $arrF[$r]->fe_descripcion;
        $festivo["Efe_fechainicio"] = $arrF[$r]->fe_fechainicio;
        $festivo["Efe_fechafin"] = $arrF[$r]->fe_fechafin;
        array_push($response["festivos"], $festivo);
    }
    $response["success"] = 1;
    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No sitios found";
    echo json_encode($response);
}
?> 