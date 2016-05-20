<?php

require_once("../../modelo/dao/gastronomia.php");

$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];

$ga_id = $_REQUEST['ga_id'];
session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];
$_SESSION["prId"] = $_REQUEST['pr_id'];
$_SESSION["caId"] = $_REQUEST['ca_id'];
$_SESSION["catId"] = $_REQUEST['cat_id'];
$_SESSION["siId"] = $_REQUEST['si_id'];

$RegistrosAMostrar = 7;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$ObjGastronomia = new gastronomia('0', '0', '0', '0', '0', '0', '0');
$ObjGastronomiaPagina = new gastronomia('0', '0', '0', '0', '0', '0', '0');

$query = "SELECT * FROM gastronomia  WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by ga_nombre offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM gastronomia  WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by ga_nombre";

$ObjGastronomia->gastronomiaConsPagina($query);
$arregloGastronomia = $ObjGastronomia->arregloGastronomia;

if ($ga_id == '0') {
    if (count($arregloGastronomia) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead><th>Nombre</th><th>Raiz</th><th>Tipo</th><th>Tamaño</th><th>Ver</th><th>Descargar</th><th>Acciones</th></thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arregloGastronomia); $r++) {
            echo "<tr>";
            echo "<td>" . $arregloGastronomia[$r]->ga_nombre . "</td>";
            echo "<td>" . $arregloGastronomia[$r]->ga_archivo_nombre . "</td>";
            echo "<td>" . $arregloGastronomia[$r]->ga_mime . "</td>";
            echo "<td>" . substr($arregloGastronomia[$r]->size / 1024, 0, 5) . "<strong> KB</strong></td>";
            echo "<td><a href=verimg.php?id=" . $arregloGastronomia[$r]->ga_id . "> <img style='width:16px;height:16px;border:0;' src='../../img/zoom.png' /> </a></td>";
            echo "<td><a href=verimg.php?id=" . $arregloGastronomia[$r]->ga_id . "&f=1> <img style='width:16px;height:16px;border:0;' src='../../img/download.png' /></a></td>";
            echo "<td valign='center'><a title='Eliminar Gastronomia " . $arregloGastronomia[$r]->ga_nombre . "' href='javascript:delGastronomiaAdm(3,\"" . $arregloGastronomia[$r]->pr_id . "\",\"" . $arregloGastronomia[$r]->ca_id . "\",\"" . $arregloGastronomia[$r]->cat_id . "\",\"" . $arregloGastronomia[$r]->si_id . "\",\"" . $arregloGastronomia[$r]->ga_id . "\");'><img style='width:16px;height:16px;border:0;' src='../../img/eliminar.png' /></a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        /* Pagina */

        $ObjGastronomiaPagina->gastronomiaConsPagina($query2);
        $arregloGastronomiaPagina = $ObjGastronomiaPagina->arregloGastronomia;
        $NroRegistros = count($arregloGastronomiaPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2" style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginGastronomiaAdm('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginGastronomiaAdm('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginGastronomiaAdm('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginGastronomiaAdm('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";

        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:none;'type='text' id='SI_id' value='$si_id'>";
    } else {
        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:none;'type='text' id='SI_id' value='$si_id'>";
    }
}
?>