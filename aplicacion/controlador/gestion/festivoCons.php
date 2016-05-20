<?php

require_once("../../modelo/dao/festivo.php");


$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$fe_id = $_REQUEST['fe_id'];

session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];

$RegistrosAMostrar = 7;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$ObjFestivo = new festivo('0', '0', '0', '0', '0', '0', '0');
$ObjFestivoPagina = new festivo('0', '0', '0', '0', '0', '0', '0');

$query = "SELECT * FROM festivo WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by fe_nombre offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM festivo WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by fe_nombre";

$ObjFestivo->FestivoConsPagina($query);
$arrFestivo = $ObjFestivo->arregloFestivo;

//$objFestivo = new festivo($pr_id, $ca_id, $cat_id, $si_id, 0, $em_id, $us_id);
//$arrFestivo = $objFestivo->arregloFestivo;

if ($fe_id == '0') {
    if (count($arrFestivo) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Nombre</th> <th>  Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrFestivo); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrFestivo[$r]->pr_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='caId" . $r . "'   style='display:none;'>" . $arrFestivo[$r]->ca_id . "</td>";
            echo "<td id='catId" . $r . "'  style='display:none;'>" . $arrFestivo[$r]->cat_id . "</td>";
            echo "<td id='siId" . $r . "'   style='display:none;'>" . $arrFestivo[$r]->si_id . "</td>";
            echo "<td id='feId" . $r . "'   style='display:none;'>" . $arrFestivo[$r]->fe_id . "</td>";
            echo "<td id='fe_nombre" . $r . "'>";
            //. $arrFestivo[$r]->fe_nombre
            if (strlen($arrFestivo[$r]->fe_nombre) >= 20) {
                echo substr($arrFestivo[$r]->fe_nombre, 0, 20) . '.';
            } else {
                echo $arrFestivo[$r]->fe_nombre;
            }
            echo "</td>";
            echo "<td id='fe_descripcion" . $r . "' style='display:none;'>" . $arrFestivo[$r]->fe_descripcion . "</td>";
            echo "<td id='fe_fechainicio" . $r . "' style='display:none;'>" . $arrFestivo[$r]->fe_fechainicio . "</td>";
            echo "<td id='fe_fechafin" . $r . "'    style='display:none;'>" . $arrFestivo[$r]->fe_fechafin . "</td>";

            echo "<td align='center'>";
            echo "<a title='Eliminar Festivo " . $arrFestivo[$r]->fe_nombre . "' href='javascript:delFestivo(3,\"" . $arrFestivo[$r]->pr_id . "\",\"" . $arrFestivo[$r]->ca_id . "\",\"" . $arrFestivo[$r]->cat_id . "\",\"" . $arrFestivo[$r]->si_id . "\",\"" . $arrFestivo[$r]->fe_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/delete.png' /></a>";
            echo "<a title='Editar Festivo" . $arrFestivo[$r]->fe_nombre . "' href='javascript:editFestivo(\"" . $arrFestivo[$r]->pr_id . "\",\"" . $arrFestivo[$r]->ca_id . "\",\"" . $arrFestivo[$r]->cat_id . "\",\"" . $arrFestivo[$r]->si_id . "\",\"" . $arrFestivo[$r]->fe_id . "\",\"" . $arrFestivo[$r]->fe_nombre . "\",\"" . $arrFestivo[$r]->fe_descripcion . "\",\"" . $arrFestivo[$r]->fe_fechainicio . "\",\"" . $arrFestivo[$r]->fe_fechafin . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/edit_.png' /></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        /* Pagina */
        $ObjFestivoPagina->FestivoConsPagina($query2);
        $arrFestivoPagina = $ObjFestivoPagina->arregloFestivo;
        $NroRegistros = count($arrFestivoPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginFestivo('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginFestivo('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginFestivo('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginFestivo('$PagUlt')\">Ultimo</a></li>";
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