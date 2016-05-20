<?php

require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/sitio.php");

$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$si_id = $_REQUEST['si_id'];

session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$Objsitio = new sitio('0', '0', '0', '0', '0');
$ObjsitioPagina = new sitio('0', '0', '0', '0', '0');
//cat_nombre ASC
$query = "SELECT * FROM sitio WHERE pr_id=$pr_id AND ca_id=$ca_id AND em_id=$em_id AND us_id=$us_id order by si_nombre offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM sitio WHERE pr_id=$pr_id AND ca_id=$ca_id AND em_id=$em_id AND us_id=$us_id order by si_nombre";
 
$Objsitio->sitioConsBusqueda($query);
$arrSitio = $Objsitio->arregloSitio;

if ($si_id == '0') {
    if (count($arrSitio) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Nombre</th> <th>Categoria</th> <th>  Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrSitio); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrSitio[$r]->pr_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='ca_id" . $r . "'  style='display:none;'>" . $arrSitio[$r]->ca_id . "</td>";
            echo "<td id='cat_id" . $r . "'  style='display:none;'>" . $arrSitio[$r]->cat_id . "</td>";
            echo "<td id='si_id" . $r . "'  style='display:none;'>" . $arrSitio[$r]->si_id . "</td>";
            echo "<td id='si_nombre" . $r . "'>";
            if (strlen($arrSitio[$r]->si_nombre) >= 15) {
                echo substr($arrSitio[$r]->si_nombre, 0, 15) . '.';
            } else {
                echo $arrSitio[$r]->si_nombre;
            }
            echo "</td>"; 

            echo "<td id='cat_id" . $r . "'>";
            $objCat = new categoria('0');
            $arrCat = $objCat->arregloCategoria;

            for ($i = 0; $i < count($arrCat); $i++) {
                if ($arrCat[$i]->cat_id == $arrSitio[$r]->cat_id) {
                    //echo $arrCat[$i]->cat_nombre;
                    if (strlen($arrCat[$i]->cat_nombre) >= 15) {
                        echo substr($arrCat[$i]->cat_nombre, 0, 15) . '.';
                    } else {
                        echo $arrCat[$i]->cat_nombre;
                    }
                }
            }

            echo "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Sitio " . $arrSitio[$r]->po_titulo . "' href='javascript:delSitio(3,\"" . $arrSitio[$r]->pr_id . "\",\"" . $arrSitio[$r]->ca_id . "\",\"" . $arrSitio[$r]->si_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/delete.png' /></a>";
            echo "<a title='Editar Sitio" . $arrSitio[$r]->po_titulo . "' href='javascript:establecerCapa();editSitio(\"" . $arrSitio[$r]->pr_id . "\",\"" . $arrSitio[$r]->ca_id . "\",\"" . $arrSitio[$r]->cat_id . "\",\"" . $arrSitio[$r]->si_id . "\",\"" . $arrSitio[$r]->si_nombre . "\",\"" . $arrSitio[$r]->si_descripcion . "\",\"" . $arrSitio[$r]->si_paginaweb . "\",\"" . $arrSitio[$r]->si_mail . "\",\"" . $arrSitio[$r]->si_facebook . "\",\"" . $arrSitio[$r]->si_twitter . "\",\"" . $arrSitio[$r]->si_direccion . "\",\"" . $arrSitio[$r]->si_telefono . "\",\"" . $arrSitio[$r]->si_latitud . "\",\"" . $arrSitio[$r]->si_longitud . "\");verMapa();'><img style='width:16px;height:16px;border:0;' src='../vista/img/edit_.png' /></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        /* Pagina */
        $ObjsitioPagina->sitioConsBusquedaPagina($query2);
        $arrSitioPagina = $ObjsitioPagina->arregloSitio;
        $NroRegistros = count($arrSitioPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginSitio('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginSitio('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginSitio('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginSitio('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
        
        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
    } else {
        echo 'Lo sentimos, su consulta no produjo resultados. <br>';
        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
    }
}
?>