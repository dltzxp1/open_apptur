<?php

require_once("../../modelo/dao/usuario.php");

$em_id = 1;
$us_id = $_REQUEST['us_id'];

//$objUsuario = new usuario($em_id, $$us_id);
$objUsuario = new usuario('0', '0');
$objUsuarioPagina = new usuario('0', '0');

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM usuario where em_id=$em_id order by us_nombre offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$script2 = "SELECT * FROM usuario where em_id=$em_id order by us_nombre";

$objUsuario->usuarioConsPagina($script);


if ($us_id == '0') {
    $arrUsuario = $objUsuario->arregloUsuario;
    if (count($arrUsuario) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th> <th>Nombre</th><th>Acciones</th><th>Link</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrUsuario); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrUsuario[$r]->em_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='usId" . $r . "' style='display:none;'>" . $arrUsuario[$r]->us_id . "</td>";
            echo "<td id='us_nombre" . $r . "'>" . $arrUsuario[$r]->us_nombre . "</td>";

            echo "<td id='us_apellido" . $r . "' style='display:none;'>" . $arrUsuario[$r]->us_apellido . "</td>";
            echo "<td id='us_mail" . $r . "' style='display:none;'>" . $arrUsuario[$r]->us_mail . "</td>";
            echo "<td id='us_usuario" . $r . "' style='display:none;'>" . $arrUsuario[$r]->us_usuario . "</td>";
            echo "<td id='us_clave" . $r . "' style='display:none;'>" . $arrUsuario[$r]->us_clave . "</td>";
            echo "<td id='us_estado" . $r . "' style='display:none;'>" . $arrUsuario[$r]->us_estado . "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Usuario " . $arrUsuario[$r]->us_nombre . "' href='javascript:delUsuario(3,\"" . $arrUsuario[$r]->em_id . "\",\"" . $arrUsuario[$r]->us_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Usuario " . $arrUsuario[$r]->us_nombre . "' href='javascript:editUsuario(\"" . $arrUsuario[$r]->em_id . "\",\"" . $arrUsuario[$r]->us_id . "\",\"" . $arrUsuario[$r]->us_nombre . "\",\"" . $arrUsuario[$r]->us_apellido . "\",\"" . $arrUsuario[$r]->us_mail . "\",\"" . $arrUsuario[$r]->us_usuario . "\",\"" . $arrUsuario[$r]->us_clave . "\",\"" . $arrUsuario[$r]->us_clave2 . "\",\"" . $arrUsuario[$r]->us_estado . "\",\"" . $arrUsuario[$r]->us_t_sit . "\",\"" . $arrUsuario[$r]->us_t_his . "\",\"" . $arrUsuario[$r]->us_t_vid . "\",\"" . $arrUsuario[$r]->us_t_fot . "\",\"" . $arrUsuario[$r]->us_t_fes . "\",\"" . $arrUsuario[$r]->us_t_gas . "\",\"" . $arrUsuario[$r]->us_t_rut. "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "<td id='btn_Ciudad'> <a href=\"javascript:irUsuarioRol('" . $arrUsuario[$r]->em_id . "','" . $arrUsuario[$r]->us_id . "','" . $arrUsuario[$r]->us_nombre . "');\">Roles </a></td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $objUsuarioPagina->usuarioConsPagina($script2);
        $arrUsuarioPagina = $objUsuarioPagina->arregloUsuario;
        $NroRegistros = count($arrUsuarioPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginUsuario('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginUsuario('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginUsuario('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginUsuario('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
