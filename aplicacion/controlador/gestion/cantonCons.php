<?php

require_once("../../modelo/dao/provincia.php");
require_once("../../modelo/dao/canton.php");

$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];

$objCanton = new canton($pr_id, $ca_id);
$objCantonPagina = new canton($pr_id, $ca_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM canton WHERE pr_id=$pr_id order by ca_nombre ASC offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
//$script2 = "SELECT * FROM canton WHERE pr_id=$pr_id";

$objCanton->obtenerPagin($script);

if ($ca_id == '0') {
    $arrCanton = $objCanton->arregloCanton;
    if (count($arrCanton) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Nombre</th><th> Acciones</th><th> Link</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrCanton); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrCanton[$r]->pr_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            // echo "<td id='pr_nombre" . $r . "'>" . substr($arrProvincia[$r]->pr_nombre, 0, 17) . "</td>";
            echo "<td id='ca_id" . $r . "' style='display:none;'>" . $arrCanton[$r]->ca_id . "</td>";
            echo "<td id='ca_nombre" . $r . "' style='display:block;'>";
            if (strlen($arrCanton[$r]->ca_nombre) >= 18) {
                echo substr($arrCanton[$r]->ca_nombre, 0, 18) . '.';
            } else {
                echo $arrCanton[$r]->ca_nombre;
            }
            echo "</td>";
            echo "<td id='ca_descripcion" . $r . "' style='display:none;'>" . $arrCanton[$r]->ca_descripcion . "</td>";
            echo "<td id='ca_poblacion" . $r . "' style='display:none;'>" . $arrCanton[$r]->ca_poblacion . "</td>";

            echo "<td align='center'>";
            echo "<a title='Eliminar Canton " . $arrCanton[$r]->ca_nombre . "' href='javascript:delCanton(3,\"" . $arrCanton[$r]->pr_id . "\",\"" . $arrCanton[$r]->ca_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Canton " . $arrCanton[$r]->ca_nombre . "' href='javascript:establecerCapa();editCanton(\"" . $arrCanton[$r]->pr_id . "\",\"" . $arrCanton[$r]->ca_id . "\",\"" . $arrCanton[$r]->ca_nombre . "\",\"" . $arrCanton[$r]->ca_descripcion . "\",\"" . $arrCanton[$r]->ca_poblacion . "\",\"" . $arrCanton[$r]->ca_latitud . "\",\"" . $arrCanton[$r]->ca_longitud . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "<td id='btn_Canton'> <a href=\"javascript:irCiudadSitio('" . $arrCanton[$r]->pr_id . "','" . $arrCanton[$r]->ca_id . "','" . $arrCanton[$r]->ca_nombre . "');\">Sitios </a></td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";
        /* Paginacion */
        $NroRegistros = count($objCantonPagina->arregloCanton);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginCanton('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginCanton('$PagAnt')\"  > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a  onclick=\"PaginCanton('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginCanton('$PagUlt')\">Último</a></li>";
        echo "</ul>";
        echo "</div>";
    }
    echo "<input style='display:none;' type='text' id='PR_id' value='$pr_id'>";
}
?>
