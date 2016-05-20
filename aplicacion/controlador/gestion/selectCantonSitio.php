<?php

require_once("../../modelo/dao/sitio.php");

session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];

$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$objSitio = new sitio($pr_id, $ca_id, '0', $em_id, $us_id);

$arrSitio = $objSitio->arregloSitio;
$arreglo = array();

for ($i = 0; $i < count($arrSitio); $i++) {
    $arreglo[$i][0] = $arrSitio[$i]->pr_id;
    $arreglo[$i][1] = $arrSitio[$i]->ca_id;
    $arreglo[$i][2] = $arrSitio[$i]->cat_id;
    $arreglo[$i][3] = $arrSitio[$i]->si_id;
    $arreglo[$i][4] = $arrSitio[$i]->si_nombre;
}
echo json_encode($arreglo);
?>
