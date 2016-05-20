<?php

require_once("../../modelo/dao/responsabilidad.php");

//var arregloAtract = new Array('em_id',em_id,'us_id',us_id,'ro_id',ro_id,'ro_nombre',ro_nombre);

$em_id = $_REQUEST['em_id'];
$us_id = $_REQUEST['us_id'];
$ro_id = $_REQUEST['ro_id'];
$ro_nombre = $_REQUEST['ro_nombre'];
//$objResponsabilidad = new responsabilidad($em_id, $us_id, $ro_id, '0');
$objResponsabilidad = new responsabilidad($em_id, $us_id, $ro_id, '0');

$arrResponsabilidad = $objResponsabilidad->arregloResponsabilidad;
$arreglo = array();

for ($i = 0; $i < count($arrResponsabilidad); $i++) {
    $arreglo[$i][0] = $arrResponsabilidad[$i]->em_id;
    $arreglo[$i][1] = $arrResponsabilidad[$i]->us_id;
    $arreglo[$i][2] = $arrResponsabilidad[$i]->ro_id;
    $arreglo[$i][3] = $arrResponsabilidad[$i]->re_id;
    $arreglo[$i][4] = $arrResponsabilidad[$i]->re_nombre;
}
echo json_encode($arreglo);
?>
