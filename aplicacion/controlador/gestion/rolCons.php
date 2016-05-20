<?php

require_once("../../modelo/dao/rol.php");

$em_id = $_REQUEST['em_id'];
$us_id = $_REQUEST['us_id'];
$ro_id = $_REQUEST['ro_id'];

//$objRol = new rol($em_id, $us_id, $ro_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$ObjRol = new rol('0', '0', '0');
$ObjRolPagina = new rol('0', '0', '0');

$query = "SELECT * FROM rol WHERE em_id=$em_id AND us_id=$us_id order by ro_nombre ASC offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM rol WHERE em_id=$em_id AND us_id=$us_id order by ro_nombre ASC";

$ObjRol->rolConsBusquedaPagina($query);
//$arrRol= $ObjRol->arregloRol;


if ($ro_id == '0') {
    $arrRol = $ObjRol->arregloRol;
    if (count($arrRol) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th> <th>Nombre</th><th>Acciones</th><th> Link</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrRol); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrRol[$r]->em_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='usId" . $r . "' style='display:none;'>" . $arrRol[$r]->us_id . "</td>";
            echo "<td id='roId" . $r . "' style='display:none;'>" . $arrRol[$r]->ro_id . "</td>";
            echo "<td id='ro_nombre" . $r . "'>" . $arrRol[$r]->ro_nombre . "</td>";
            echo "<td id='ro_descripcion" . $r . "' style='display:none;'>" . $arrRol[$r]->ro_descripcion . "</td>";

            echo "<td align='center'>";
            echo "<a title='Eliminar Rol " . $arrRol[$r]->ro_nombre . "' href='javascript:delRol(3,\"" . $arrRol[$r]->em_id . "\",\"" . $arrRol[$r]->us_id . "\",\"" . $arrRol[$r]->ro_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Rol " . $arrRol[$r]->ro_nombre . "' href='javascript:editRol(\"" . $arrRol[$r]->em_id . "\",\"" . $arrRol[$r]->us_id . "\",\"" . $arrRol[$r]->ro_id . "\",\"" . $arrRol[$r]->ro_nombre . "\",\"" . $arrRol[$r]->ro_descripcion . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "<td id='btn_Ciudad'> <a href=\"javascript:irRolResponsabilidad('" . $arrRol[$r]->em_id . "','" . $arrRol[$r]->us_id . "','" . $arrRol[$r]->ro_id . "','" . $arrRol[$r]->ro_nombre . "');\">Responsabilidad </a></td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        /* Pagina */
        $ObjRolPagina->rolConsBusquedaPagina($query2);
        $arrRolPagina = $ObjRolPagina->arregloRol;
        $NroRegistros = count($arrRolPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar" style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginRol('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginRol('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginRol('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginRol('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
    echo "<input style='display:none;' type='text' id='EM_id' value='$em_id'>";
    echo "<input style='display:none;' type='text' id='US_id' value='$us_id'>";
}
?>
