<?php

require_once("../../modelo/dao/categoria.php");
$cat_id = $_REQUEST['cat_id'];

$objCategoria = new categoria($cat_id);
$objCategoriaPagina = new categoria($cat_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}
//order by cat_nombre ASC;

$script = "SELECT * FROM categoria order by cat_nombre ASC offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$objCategoria->categoriaConsPagina($script);

if ($cat_id == '0') {
    $arrCategoria = $objCategoria->arregloCategoria;
    if (count($arrCategoria) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrCategoria); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrCategoria[$r]->cat_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='cat_nombre" . $r . "'>";
            //$arrCategoria[$r]->cat_nombre .  
            if (strlen($arrCategoria[$r]->cat_nombre) >= 35) {
                echo substr($arrCategoria[$r]->cat_nombre, 0, 35) . '.';
            } else {
                echo $arrCategoria[$r]->cat_nombre;
            }
            echo "</td>";
            echo "<td id='cat_descripcion" . $r . "' style='display:none;'>" . $arrCategoria[$r]->cat_descripcion . "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Categoria " . $arrCategoria[$r]->ca_nombre . "' href='javascript:delCategoria(3,\"" . $arrCategoria[$r]->cat_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Categoria " . $arrCategoria[$r]->ca_nombre . "' href='javascript:editCategoria(\"" . $arrCategoria[$r]->cat_id . "\",\"" . $arrCategoria[$r]->cat_nombre . "\",\"" . $arrCategoria[$r]->cat_descripcion . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objCategoriaPagina->arregloCategoria);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginCategoria('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginCategoria('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginCategoria('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginCategoria('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
