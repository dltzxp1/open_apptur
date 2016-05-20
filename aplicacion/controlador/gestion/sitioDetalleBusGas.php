<?php

require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/gastronomia.php");
//pr_id,ca_id,cat_id,si_id,si_nombre

$pdId = $_REQUEST['pr_id'];
$caId = $_REQUEST['ca_id'];
$catId = $_REQUEST['cat_id'];
$siId = $_REQUEST['si_id'];

$script = "SELECT * FROM gastronomia WHERE pr_id=$pdId AND ca_id=$caId AND cat_id=$catId AND si_id=$siId";
$objGastronomia = new gastronomia('0', '0', '0', '0', '0', '0', '0');
$objGastronomia->gastronomiaConsBusqueda($script);
$arrGastronomia = $objGastronomia->arregloGastronomia;

if (count($arrGastronomia) > 0) {
    echo "<table class='table table-hover' id='tablaReportePlano' align='center' border='0'>";
    echo "<thead>";
    echo "<th>Foto</th> <th> Descripción</th>";
    echo "</thead>";
    echo "<tbody>";
    for ($r = 0; $r < count($arrGastronomia); $r++) {
        echo "<tr>";
        echo "<td> ";
        echo "<img  class='FotoView' src='web/php/verImgGas.php?pr_id=" . $pdId . "&ca_id=" . $caId . "&cat_id=" . $catId . "&si_id=" . $siId . "&ga_id=" . $arrGastronomia[$r]->ga_id . "'/>";
        echo "</td>";

        echo "<td> ";
        echo "<div class='alert alert-info'>";
        echo "<strong>" . $arrGastronomia[$r]->ga_nombre . "</strong><br>";
        echo $arrGastronomia[$r]->ga_descripcion . "";
        echo "</div>";
        echo "</td>";

        echo "</tr>";
    }
    echo "</tbody> </table>";
} else {
    echo "No hay Datos!!";
}
?>
