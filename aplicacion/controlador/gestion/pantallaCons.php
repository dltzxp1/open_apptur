<?php

require_once("../../modelo/dao/pantallatmp.php");

$em_id = $_REQUEST['em_id'];
$us_id = $_REQUEST['us_id'];
$ro_id = $_REQUEST['ro_id'];
$re_id = $_REQUEST['re_id'];

$objTrama = new pantallatmp(1);

$arrPantalla = $objTrama->arregloPantallaTemp;
if (count($arrPantalla) > 0) {
    //echo "<table cellspacing='0' cellpadding='1' width='100%' class='tablaReporte'>";
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<th>Id </th> <th>Nombre </th><th>Descripcion</th><th><input type='checkbox' disabled='disabled' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /> </th>";
    echo "</thead>";
    echo "<tbody>";
    for ($r = 0; $r < count($arrPantalla); $r++) {
        echo "<tr>";
        echo "<td id='pt_em_id" . $r . "' style='display:none;'>" . $em_id . "</td>";
        echo "<td id='pt_us_id" . $r . "' style='display:none;'>" . $us_id . "</td>";
        echo "<td id='pt_ro_id" . $r . "' style='display:none;'>" . $ro_id . "</td>";
        echo "<td id='pt_re_id" . $r . "' style='display:none;'>" . $re_id . "</td>";
        echo "<td id='pt_id" . $r . "'>" . $arrPantalla[$r]->utp_id . "</td>";
        echo "<td id='pt_nom" . $r . "'>" . $arrPantalla[$r]->utp_nom . "</td>";
        echo "<td id='pt_des" . $r . "'>" . $arrPantalla[$r]->utp_des . "</td>";
        echo "<td id='c' align='center'><input type='checkbox' disabled='disabled' name='chkHijoRol' id='" . $arrPantalla[$r]->utp_id . "' onclick='deselecChkPadre(\"chkPadreRol\");'/> </td>";
        echo "</tr>";
    }
    echo "</tbody> </table>";
} else {
    echo 'Lo sentimos, su consulta no produjo resultados.';
}

echo "<input type='text' style='display:block' value='$em_id' id='PA_em_id'>";
echo "<input type='text' style='display:block' value='$us_id' id='PA_us_id'>";
echo "<input type='text' style='display:block' value='$ro_id' id='PA_ro_id'>";
echo "<input type='text' style='display:block' value='$re_id' id='PA_re_id'>";
?>