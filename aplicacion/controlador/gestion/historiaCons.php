<?php

require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/historia.php");

$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$hi_id = $_REQUEST['hi_id'];
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

$ObjHistoria = new historia('0', '0', '0', '0', '0', '0', '0');
$ObjHistoriaPagina = new historia('0', '0', '0', '0', '0', '0', '0'); 
$query = "SELECT * FROM historia WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by hi_nombre offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM historia WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by hi_nombre";
$ObjHistoria->historiaConsPagina($query);
$arrHistoria = $ObjHistoria->arregloHistoria;

if ($hi_id == '0') {
    if (count($arrHistoria) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Nombre</th> <th>  Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrHistoria); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrHistoria[$r]->pr_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='caId" . $r . "'   style='display:none;'>" . $arrHistoria[$r]->ca_id . "</td>";
            echo "<td id='catId" . $r . "'  style='display:none;'>" . $arrHistoria[$r]->cat_id . "</td>";
            echo "<td id='siId" . $r . "'   style='display:none;'>" . $arrHistoria[$r]->si_id . "</td>";
            echo "<td id='hiId" . $r . "'   style='display:none;'>" . $arrHistoria[$r]->hi_id . "</td>";
            echo "<td id='hi_nombre" . $r . "'>";
            //. $arrHistoria[$r]->hi_nombre . 
            if (strlen($arrHistoria[$r]->hi_nombre) >= 20) {
                echo substr($arrHistoria[$r]->hi_nombre, 0, 20) . '.';
            } else {
                echo $arrHistoria[$r]->hi_nombre;
            }
            echo "</td>";

            echo "<td id='hi_descripcion" . $r . "' style='display:none;'>" . $arrHistoria[$r]->hi_descripcion . "</td>";

            echo "<td align='center'>";
            echo "<a title='Eliminar Historia " . $arrHistoria[$r]->hi_nombre . "' href='javascript:delHistoria(3,\"" . $arrHistoria[$r]->pr_id . "\",\"" . $arrHistoria[$r]->ca_id . "\",\"" . $arrHistoria[$r]->cat_id . "\",\"" . $arrHistoria[$r]->si_id . "\",\"" . $arrHistoria[$r]->hi_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/delete.png' /></a>";
            echo "<a title='Editar Historia" . $arrHistoria[$r]->hi_nombre . "' href='javascript:editHistoria(\"" . $arrHistoria[$r]->pr_id . "\",\"" . $arrHistoria[$r]->ca_id . "\",\"" . $arrHistoria[$r]->cat_id . "\",\"" . $arrHistoria[$r]->si_id . "\",\"" . $arrHistoria[$r]->hi_id . "\",\"" . $arrHistoria[$r]->hi_nombre . "\",\"" . $arrHistoria[$r]->hi_descripcion . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/edit_.png' /></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        /* Pagina */
        $ObjHistoriaPagina->historiaConsPagina($query2);
        $arrHisoriaPagina = $ObjHistoriaPagina->arregloHistoria;
        $NroRegistros = count($arrHisoriaPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginHistoria('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginHistoria('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginHistoria('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginHistoria('$PagUlt')\">Ultimo</a></li>";
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