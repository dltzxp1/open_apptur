<?php

require_once("../../modelo/dao/rol.php");
require_once("../../modelo/dao/responsabilidad.php");

$em_id = $_REQUEST['em_id'];
$us_id = $_REQUEST['us_id'];
$ro_id = $_REQUEST['ro_id'];
$re_id = $_REQUEST['re_id'];

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}
$ObjResp = new responsabilidad('0', '0', '0', '0');
$ObjRespPagina = new responsabilidad('0', '0', '0', '0');

$query = "SELECT * FROM responsabilidad WHERE em_id=$em_id AND us_id=$us_id AND ro_id=$ro_id order by re_id offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM responsabilidad WHERE em_id=$em_id AND us_id=$us_id AND ro_id=$ro_id";

$ObjResp->responConsPagina($query);
//$objResponsabilidad = new responsabilidad($em_id, $us_id, $ro_id, '0');
//echo "OK " . $em_id . ',' . $us_id . ',' . $ro_id . ',' . $re_id;

if ($re_id == '0') {
    $arrResponsabilidad = $ObjResp->arregloResponsabilidad;
    if (count($arrResponsabilidad) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrResponsabilidad); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrResponsabilidad[$r]->em_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='usId" . $r . "' style='display:none;'>" . $arrResponsabilidad[$r]->us_id . "</td>";
            echo "<td id='roId" . $r . "' style='display:none;'>" . $arrResponsabilidad[$r]->ro_id . "</td>";
            echo "<td id='reId" . $r . "' style='display:none;'>" . $arrResponsabilidad[$r]->re_id . "</td>";

            echo "<td id='re_nombre" . $r . "' style='display:block;'>" . $arrResponsabilidad[$r]->re_nombre . "</td>";
            echo "<td id='re_descripcion" . $r . "' style='display:none;'>" . $arrResponsabilidad[$r]->re_descripcion . "</td>";

            echo "<td align='center'>";
            echo "<a title='Eliminar Responsabilidad " . $arrResponsabilidad[$r]->ca_nombre . "' href='javascript:delResponsabilidad(3,\"" . $arrResponsabilidad[$r]->em_id . "\",\"" . $arrResponsabilidad[$r]->us_id . "\",\"" . $arrResponsabilidad[$r]->ro_id . "\",\"" . $arrResponsabilidad[$r]->re_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Responsabilidad " . $arrResponsabilidad[$r]->ca_nombre . "' href='javascript:editResponsabilidad(\"" . $arrResponsabilidad[$r]->em_id . "\",\"" . $arrResponsabilidad[$r]->us_id . "\",\"" . $arrResponsabilidad[$r]->ro_id . "\",\"" . $arrResponsabilidad[$r]->re_id . "\",\"" . $arrResponsabilidad[$r]->re_nombre . "\",\"" . $arrResponsabilidad[$r]->re_descripcion . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            //echo "<td id='btn_Responsabilidad'> <a href=\"javascript:irResponsabilidadPermisos('" . $arrResponsabilidad[$r]->ro_id . "','" . $arrResponsabilidad[$r]->re_id . "','" . $arrResponsabilidad[$r]->re_nombre . "');\">Permisos </a></td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";


        /* Pagina */
        $ObjRespPagina->responConsPagina($query2);
        $arrResPagina = $ObjRespPagina->arregloResponsabilidad;
        $NroRegistros = count($arrResPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginRespon('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginRespon('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginRespon('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginRespon('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";


        echo "<input style='display:none;' type='text' id='EM_id' value='$em_id'>";
        echo "<input style='display:none;' type='text' id='US_id' value='$us_id'>";
        echo "<input style='display:none;' type='text' id='RO_id' value='$ro_id'>";
    } else {
        echo "<input style='display:none;' type='text' id='EM_id' value='$em_id'>";
        echo "<input style='display:none;' type='text' id='US_id' value='$us_id'>";
        echo "<input style='display:none;' type='text' id='RO_id' value='$ro_id'>";
    }
}
?>
