<?php

require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/festivo.php");
//pr_id,ca_id,cat_id,si_id,si_nombre

$pdId = $_REQUEST['pr_id'];
$caId = $_REQUEST['ca_id'];
$catId = $_REQUEST['cat_id'];
$siId = $_REQUEST['si_id'];


$script = "SELECT * FROM festivo WHERE pr_id=$pdId AND ca_id=$caId AND cat_id=$catId AND si_id=$siId";
$objFestivo = new festivo('0', '0', '0', '0', '0', '0', '0');
$objFestivo->historiaConsFestivo($script);
$arrFestivo = $objFestivo->arregloFestivo;
 
if (count($arrFestivo) > 0) {
    echo "<table class='table table-hover' id='tablaReportePlano' align='center' border='0'>";
    echo "<thead>";
    echo "<th>Evento</th> <th> Inicio </th><th> Fin</th>";
    echo "</thead>";
    echo "<tbody>";
    for ($r = 0; $r < count($arrFestivo); $r++) {
        echo "<tr>";

        echo "<td> ";
        echo "<div class='alert alert-info'>";
        echo "<strong>" . $arrFestivo[$r]->fe_nombre . "</strong><br>";
        echo $arrFestivo[$r]->fe_descripcion . "";
        echo "</div>";
        echo "</td>";

        echo "<td> "; 
        echo "".substr($arrFestivo[$r]->fe_fechainicio, 0, 10) . "<br/> ";  
        echo "</td>";
        
        echo "<td> ";  
        echo "".substr($arrFestivo[$r]->fe_fechafin, 0, 10) . "";
        echo "</td>";

        echo "</tr>";
    }
    echo "</tbody> </table>";
} else {
    echo "No hay Datos!!";
}
?>
