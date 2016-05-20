<?php

require_once("../../modelo/dao/provincia.php");
$objProvincia = new provincia('0');
$objProvinciaPagina = new provincia('0');

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}
//order by si_nombre
$script = "SELECT * FROM provincia order by pr_nombre ASC offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$objProvincia->obtenerPagin($script);
$arrProvincia = $objProvincia->arregloProvincia;

if (count($arrProvincia) > 0) {
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th> <th>Nombre</th><th>Acciones</th><th> Link</th>";
    echo "</thead>";
    echo "<tbody>";
    for ($r = 0; $r < count($arrProvincia); $r++) {
        echo "<tr>";
        echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrProvincia[$r]->pr_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
        echo "<td id='pr_nombre" . $r . "'>";
        if (strlen($arrProvincia[$r]->pr_nombre) >= 18) {
            echo substr($arrProvincia[$r]->pr_nombre, 0, 17) . '.';
        } else {
            echo $arrProvincia[$r]->pr_nombre;
        }
        echo "</td>";
        echo "<td id='pr_descripcion" . $r . "' style='display:none;'>" . $arrProvincia[$r]->pr_descripcion . "</td>";
        echo "<td id='pr_capital" . $r . "' style='display:none;'>" . $arrProvincia[$r]->pr_capital . "</td>";
        echo "<td id='pr_poblacion" . $r . "' style='display:none;'>" . $arrProvincia[$r]->pr_poblacion . "</td>";
        echo "<td id='pr_region" . $r . "' style='display:none;'>" . $arrProvincia[$r]->pr_region . "</td>";
        echo "<td align='center'>";
        echo "<a title='Eliminar Provincia " . $arrProvincia[$r]->pr_nombre . "' href='javascript:delProvincia(3,\"" . $arrProvincia[$r]->pr_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
        echo "<a title='Editar Provincia " . $arrProvincia[$r]->pr_nombre . "' href='javascript:editProvincia(\"" . $arrProvincia[$r]->pr_id . "\",\"" . $arrProvincia[$r]->pr_nombre . "\",\"" . $arrProvincia[$r]->pr_descripcion . "\",\"" . $arrProvincia[$r]->pr_capital . "\",\"" . $arrProvincia[$r]->pr_poblacion . "\",\"" . $arrProvincia[$r]->pr_region . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
        echo "</td>";
        echo "<td id='btn_Ciudad'> <a href=\"javascript:irProvCiudad('" . $arrProvincia[$r]->pr_id . "','" . $arrProvincia[$r]->pr_nombre . "');\">Ciudades </a></td>";
        echo "</tr>";
    }
    echo "</tbody> </table>";

    $NroRegistros = count($objProvinciaPagina->arregloProvincia);
    //echo 'VALOR: ' . $NroRegistros;
    $PagAnt = $PagAct - 1;
    $PagSig = $PagAct + 1;
    $PagUlt = $NroRegistros / $RegistrosAMostrar;
    $Res = $NroRegistros % $RegistrosAMostrar;
    if ($Res > 0)
        $PagUlt = floor($PagUlt) + 1;
    echo '<div class="pagination" id="paginar" style="cursor:pointer; cursor: hand">';
    echo "<ul>";
    echo "<li><a onclick=\"PaginProvincia('1')\">Primero</a> </li>";
    if ($PagAct > 1)
        echo "<li><a onclick=\"PaginProvincia('$PagAnt')\"> < </a> </li>";
    echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
    if ($PagAct < $PagUlt)
        echo " <li><a onclick=\"PaginProvincia('$PagSig')\"> > </a></li> ";
    echo "<li><a onclick=\"PaginProvincia('$PagUlt')\">Ultimo</a></li>";
    echo "</ul>";
    echo "</div>";
}
?>
