<?php

require_once("../../modelo/dao/canton.php");
$pr_id = $_REQUEST['pr_id'];
$objCanton = new canton($pr_id, '0');
$arrCanton = $objCanton->arregloCanton;
$arreglo = array();
for ($i = 0; $i < count($arrCanton); $i++) {
    $arreglo[$i][0] = $arrCanton[$i]->pr_id;
    $arreglo[$i][1] = $arrCanton[$i]->ca_id;
    $arreglo[$i][2] = $arrCanton[$i]->ca_nombre;
}
echo json_encode($arreglo);
?>
