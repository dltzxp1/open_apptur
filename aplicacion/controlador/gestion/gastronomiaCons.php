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

$query = "SELECT * FROM gastronomia WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by ga_nombre offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM gastronomia WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by ga_nombre";

$ObjGastronomia->gastronomiaConsPagina($query);
$arrGastronomia = $ObjGastronomia->arregloGastronomia;

if ($ga_id == '0') {
    if (count($arrGastronomia) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Nombre</th> <th>  Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrGastronomia); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrGastronomia[$r]->pr_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='caId" . $r . "'   style='display:none;'>" . $arrGastronomia[$r]->ca_id . "</td>";
            echo "<td id='catId" . $r . "'  style='display:none;'>" . $arrGastronomia[$r]->cat_id . "</td>";
            echo "<td id='siId" . $r . "'   style='display:none;'>" . $arrGastronomia[$r]->si_id . "</td>";
            echo "<td id='gaId" . $r . "'   style='display:none;'>" . $arrGastronomia[$r]->ga_id . "</td>";
            echo "<td id='ga_nombre" . $r . "'>";
            //. $arrGastronomia[$r]->ga_nombre .
            if (strlen($arrGastronomia[$r]->ga_nombre) >= 20) {
                echo substr($arrGastronomia[$r]->ga_nombre, 0, 20) . '.';
            } else {
                echo $arrGastronomia[$r]->ga_nombre;
            }
            echo "</td>";
            echo "<td id='ga_descripcion" . $r . "' style='display:none;'>" . $arrGastronomia[$r]->ga_descripcion . "</td>";

            echo "<td align='center'>";
            echo "<a title='Eliminar Gastronomia " . $arrGastronomia[$r]->ga_nombre . "' href='javascript:delGastronomia(3,\"" . $arrGastronomia[$r]->pr_id . "\",\"" . $arrGastronomia[$r]->ca_id . "\",\"" . $arrGastronomia[$r]->cat_id . "\",\"" . $arrGastronomia[$r]->si_id . "\",\"" . $arrGastronomia[$r]->ga_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/delete.png' /></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        /* Pagina */
        $ObjGastronomiaPagina->gastronomiaConsPagina($query2);
        $arrGastronomiaPagina = $ObjGastronomiaPagina->arregloGastronomia;
        $NroRegistros = count($arrGastronomiaPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginGastronomia('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginGastronomia('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginGastronomia('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginGastronomia('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";

        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:none;'type='text' id='SI_id' value='$si_id'>";
    } else {
        echo 'Lo sentimos, su consulta no produjo resultados. <br>';
        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:none;'type='text' id='SI_id' value='$si_id'>";
    }
}
?>