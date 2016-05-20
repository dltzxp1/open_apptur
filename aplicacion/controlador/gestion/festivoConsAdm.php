<?php

require_once("../../modelo/dao/festivo.php");
require_once("../../modelo/dao/provincia.php");
require_once("../../modelo/dao/canton.php");
require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/sitio.php");

$objP = new provincia('0');
$arrP = $objP->arregloProvincia;

$objCan = new canton('0', '0');
$objCan->obtenerTodo();
$arrCan = $objCan->arregloCanton;

$objCat = new categoria('0');
$arrCat = $objCat->arregloCategoria;

$objSit = new sitio('0', '0', '0', '0', '0');
$objSit->obtenerTodo();
$arrSit = $objSit->arregloSitio;

$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$fe_id = $_REQUEST['fe_id'];

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$ObjFestivo = new festivo('0', '0', '0', '0', '0', '0', '0');
$ObjFestivoPagina = new festivo('0', '0', '0', '0', '0', '0', '0');
$query = "SELECT * FROM festivo WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id order by fe_nombre offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM festivo WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id order by fe_nombre";
$ObjFestivo->festivoConsPagina($query);
$arrFestivo = $ObjFestivo->arregloFestivo;

echo '<div class="row-fluid">
            <div class="navbar navbar-inverse">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="nav-collapse collapse">
                            <ul class="nav pull-center" aalign="center"> 
                                <li class="active">
                                    <a href=""><i class="icon-home icon-white"></i>';

if (count($arrFestivo) > 0) {
    echo "<table class='bordered-table zebra-striped'>";
    echo "<tbody>";
    for ($r = 0; $r < count($arrFestivo); $r++) {
        echo "<tr>";
        for ($i = 0; $i < count($arrP); $i++) {
            if ($arrP[$i]->pr_id == $arrFestivo[$r]->pr_id) {
                echo '' . $arrP[$i]->pr_nombre . ' | ';
            }
        }
        for ($i = 0; $i < count($arrCan); $i++) {
            if ($arrCan[$i]->ca_id == $arrFestivo[$r]->ca_id) {
                echo '' . $arrCan[$i]->ca_nombre . ' | ';
            }
        }
        for ($i = 0; $i < count($arrCat); $i++) {
            if ($arrCat[$i]->cat_id == $arrFestivo[$r]->cat_id) {
                echo $arrCat[$i]->cat_nombre . ' - ';
            }
        }
        for ($i = 0; $i < count($arrSit); $i++) {
            if ($arrSit[$i]->si_id == $arrFestivo[$r]->si_id) {
                echo $arrSit[$i]->si_nombre;
            }
        }
        break;
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody> </table>";
}

echo '</a>
                                </li>
                            </ul>
                        </div>
                    </div> 
                </div> 
            </div> 
        </div> ';

if ($fe_id == '0') {
    if (count($arrFestivo) > 0) {
        echo "<table class='table table-hover'>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrFestivo); $r++) {
            echo "<tr>";

            echo "<td><div class='alert alert-success' style='position:relative;'>";
            echo "<img style='border:0;' src='../img/event.png'/></BR>";
            echo $arrFestivo[$r]->fe_nombre;
            echo "</div></td>";

            echo "<td><div class='alert alert-info' style='position:relative;'>";
            echo "<img style='border:0;' src='../img/textDet.png'/></BR>";
            echo $arrFestivo[$r]->fe_descripcion;
            echo "</div></td>";
            echo "<td><div class='alert alert-info' style='position:relative;' ><h4>Inicio: " . $arrFestivo[$r]->fe_fechainicio . " <BR /> Fin: " . $arrFestivo[$r]->fe_fechafin . "</h4></div></td>";

            echo "</tr>";
        }
        echo "</tbody> </table>";

        /* Pagina */
        $ObjFestivoPagina->festivoConsPagina($query2);
        $arrHisoriaPagina = $ObjFestivoPagina->arregloFestivo;
        $NroRegistros = count($arrHisoriaPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2"  style="cursor:pointer; cursor: hand;">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginFestivoAdm('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginFestivoAdm('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginFestivoAdm('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginFestivoAdm('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";

        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:none;'type='text' id='SI_id' value='$si_id'>";
    } else {
        echo '<div class="alert alert-error">
                 <a class="close" data-dismiss="alert"></a>
                    <strong> <img style="width:30px;height:30px;border:0;" src="../img/error.png" /> Su búsqueda no produjo resultados! </strong>
                </div> 
                </div>';

        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:none;'type='text' id='SI_id' value='$si_id'>";
    }
}
?>