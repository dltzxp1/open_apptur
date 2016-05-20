<?php

require_once("../../modelo/dao/ruta.php");

$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$ru_id = $_REQUEST['ru_id'];

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

$objRuta = new ruta('0', '0', '0', '0', '0', '0', '0');
$objRutaPagina = new ruta('0', '0', '0', '0', '0', '0', '0');
$query = "SELECT * FROM ruta WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by ru_nombre ASC offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM ruta WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by ru_nombre ASC";
$objRuta->rutaConsPagina($query);
$arrRuta = $objRuta->arregloRuta;

if ($ru_id == '0') {
    if (count($arrRuta) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Nombre</th> <th>  Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrRuta); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrRuta[$r]->pr_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='caId" . $r . "'   style='display:none;'>" . $arrRuta[$r]->ca_id . "</td>";
            echo "<td id='catId" . $r . "'  style='display:none;'>" . $arrRuta[$r]->cat_id . "</td>";
            echo "<td id='siId" . $r . "'   style='display:none;'>" . $arrRuta[$r]->si_id . "</td>";
            echo "<td id='ruId" . $r . "'   style='display:none;'>" . $arrRuta[$r]->ru_id . "</td>";
            echo "<td id='ru_nombre" . $r . "'>" . $arrRuta[$r]->ru_nombre . "</td>";
            echo "<td id='ru_descripcion" . $r . "' style='display:none;'>" . $arrRuta[$r]->ru_descripcion . "</td>";

            echo "<td align='center'>";
            echo "<a title='Eliminar Ruta " . $arrRuta[$r]->ru_nombre . "' href='javascript:delRuta(3,\"" . $arrRuta[$r]->pr_id . "\",\"" . $arrRuta[$r]->ca_id . "\",\"" . $arrRuta[$r]->cat_id . "\",\"" . $arrRuta[$r]->si_id . "\",\"" . $arrRuta[$r]->ru_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/delete.png' /></a>";
            echo "<a title='Editar Ruta" . $arrRuta[$r]->ru_nombre . "' href='javascript:establecerCapa();editRuta(\"" . $arrRuta[$r]->pr_id . "\",\"" . $arrRuta[$r]->ca_id . "\",\"" . $arrRuta[$r]->cat_id . "\",\"" . $arrRuta[$r]->si_id . "\",\"" . $arrRuta[$r]->ru_id . "\",\"" . $arrRuta[$r]->ru_nombre . "\",\"" . $arrRuta[$r]->ru_descripcion . "\",\"" . $arrRuta[$r]->ru_ruta . "\");verMapa();'><img style='width:16px;height:16px;border:0;' src='../vista/img/edit_.png' /></a>";
            //echo "<a title='Editar Ruta" . $arrRuta[$r]->ru_nombre . "' href='javascript:editRuta(\"" . $arrRuta[$r]->pr_id . "\",\"" . $arrRuta[$r]->ca_id . "\",\"" . $arrRuta[$r]->cat_id . "\",\"" . $arrRuta[$r]->si_id . "\",\"" . $arrRuta[$r]->ru_id . "\");'><img style='width:16px;height:16px;border:0;' src='../img/edit_.png' /></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        /* Pagina */
        $objRutaPagina->rutaConsPagina($query2);
        $arrRutaPagina = $objRutaPagina->arregloRuta;
        $NroRegistros = count($arrRutaPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginRuta('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginRuta('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginRuta('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginRuta('$PagUlt')\">Ultimo</a></li>";
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