<?php

require_once("../../modelo/dao/pantalla.php");

$em_id = $_REQUEST['p_em_id'];
$us_id = $_REQUEST['p_us_id'];
$ro_id = $_REQUEST['p_ro_id'];
$re_id = $_REQUEST['p_re_id'];

$objPantalla = new pantalla($em_id, $us_id, $ro_id, $re_id, '0');
$arrPantalla = $objPantalla->arregloPantalla;

$arregloSelec = array();

if (count($arrPantalla) > 0)
    for ($r = 0; $r < count($arrPantalla); $r++)
        $arregloSelec[$r] = array($arrPantalla[$r]->pa_id);

echo json_encode($arregloSelec);
?>