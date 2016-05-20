<?php

require_once("../../modelo/dao/pantalla.php");

$objTrama = new pantalla('', '', '', '', '');
$arrPanSelected = json_decode($_REQUEST['arrPanSelected']);
//echo count($arrPanSelected );
//arrPanSelected[j] =      [emp . toString(),     usu . toString(),             rol . toString(),           mod . toString(),               pt_id . toString(), pt_nombre . toString(), pt_descripcion . toString()];

$j = 0;
for ($i = 0; $i < count($arrPanSelected); $i++) {
    $objTrama->insertar($arrPanSelected[$i][$j], $arrPanSelected[$i][$j + 1], $arrPanSelected[$i][$j + 2], $arrPanSelected[$i][$j + 3], $arrPanSelected[$i][$j + 4], $arrPanSelected[$i][$j + 5], $arrPanSelected[$i][$j + 6]);
    //echo  ":",$arrPanSelected[$i][$j] . ',' . $arrPanSelected[$i][$j + 1] . ',' . $arrPanSelected[$i][$j + 2] . ',' . $arrPanSelected[$i][$j + 3] . ',' . $arrPanSelected[$i][$j + 4];
    //echo $arrPanSelected[$i][$j]."".$arrPanSelected[$i][$j + 1]."".$arrPanSelected[$i][$j + 2]."".$arrPanSelected[$i][$j + 3]."".$arrPanSelected[$i][$j + 4];
    $j = 0;
}
?>
