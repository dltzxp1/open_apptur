<?php

require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/historia.php");
//pr_id,ca_id,cat_id,si_id,si_nombre

$pdId = $_REQUEST['pr_id'];
$caId = $_REQUEST['ca_id'];
$catId = $_REQUEST['cat_id'];
$siId = $_REQUEST['si_id'];
//pr_id,ca_id,cat_id,si_id,si_nombre
//echo $pdId . ',' . $caId . ',' . $catId;
//exit;

$script = "SELECT * FROM historia WHERE pr_id=$pdId AND ca_id=$caId AND cat_id=$catId AND si_id=$siId";
$objHistoria = new historia('0', '0', '0', '0', '0', '0', '0');
$objHistoria->historiaConsBusqueda($script);
$arrHistoria = $objHistoria->arregloHistoria;

if (count($arrHistoria) > 0) {
    echo "<table id='tablaReportePlano' align='center'>"; 
    echo "<tbody>";
    for ($r = 0; $r < count($arrHistoria); $r++) {
        echo "<tr>";
        echo "<td>" . substr($arrHistoria[$r]->hi_nombre, 0, 23) . "<br />";   
        echo "<div class='alert alert-info'> 
            ".substr($arrHistoria[$r]->hi_descripcion, 0, 355) ."</div>"; 
        echo "</tr>";
    }
    echo "</tbody> </table>";
} else {
    echo "No hay Datos!!";
}
?>
