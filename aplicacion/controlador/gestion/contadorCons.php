<?php

require_once("../../modelo/dao/contador.php");
$id = $_REQUEST['id'];


$objContador = new contador($id);
$objContadorPagina = new contador($id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM contador order by id offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$objContador->contadorConsPagina($script);

if ($id == '0') {
    $arrContador = $objContador->arregloContador;
    if (count($arrContador) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th> <th>ID</th> <th>IP</th> <th>HORA</th><th>Fecha</th><th>horau</th><th>diau</th><th>horau</th><th>Eliminar</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrContador); $r++) {
            echo "<tr>"; 
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrContador[$r]->id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='catId1" . $r . "'   >" . $arrContador[$r]->id . "</td>"; 
            echo "<td id='catId2" . $r . "'   >" . $arrContador[$r]->ip . "</td>"; 
            echo "<td id='catId3" . $r . "'   >" . $arrContador[$r]->hora . "</td>"; 
            echo "<td id='catId1" . $r . "'   >" . $arrContador[$r]->fecha . "</td>"; 
            echo "<td id='catId2" . $r . "'   >" . $arrContador[$r]->horau . "</td>"; 
            echo "<td id='catId3" . $r . "'   >" . $arrContador[$r]->diau . "</td>"; 
            echo "<td id='catId3" . $r . "'   >" . $arrContador[$r]->aniou . "</td>"; 
            echo "<td align='center'>";
            echo "<a title='Eliminar Canton " . $arrContador[$r]->ip . "' href='javascript:delContador(3,\"" . $arrContador[$r]->id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objContadorPagina->arregloContador);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginContador('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginContador('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginContador('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginContador('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
