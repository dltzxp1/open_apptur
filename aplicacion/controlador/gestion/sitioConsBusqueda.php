<?php

require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/sitio.php");

$prId = $_REQUEST['prId'];
$caId = $_REQUEST['caId'];
$catId = $_REQUEST['catId'];

session_start();
$_SESSION["prId"] = $prId;
//$emId = $_SESSION['emId'];

$RegistrosAMostrar = 8;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$Objsitio = new sitio('0', '0', '0', '0', '0');
$ObjsitioPagina = new sitio('0', '0', '0', '0', '0');
$query = "SELECT * FROM sitio WHERE pr_id=$prId AND ca_id=$caId AND cat_id=$catId order by si_id offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM sitio WHERE pr_id=$prId AND ca_id=$caId AND cat_id=$catId";

$Objsitio->sitioConsBusquedaPagina($query);
$arrSitio = $Objsitio->arregloSitio;
if (count($arrSitio) > 0) {

    echo "<table class='table table-hover'>";
    echo "<tbody>";
    for ($r = 0; $r < count($arrSitio); $r++) {
        echo "<tr>
            <td>
                <div class='alert alert-info' style='position:relative;' align='center'> <img style='border:0;' src='aplicacion/vista/img/markerSitio.png' />&nbsp;&nbsp;" . substr($arrSitio[$r]->si_nombre, 0, 35) . " </div>
                <div class='alert alert-success' style='position:relative;'>
                <img src='aplicacion/vista/img/network.png' /> " . substr($arrSitio[$r]->si_paginaweb, 0, 50) . "&nbsp;&nbsp;&nbsp;" . "</BR>" .
        '<img src="aplicacion/vista/img/mail.png" /> ' . substr($arrSitio[$r]->si_mail, 0, 50) . "</BR>" .
        '<img src="aplicacion/vista/img/direction.png" /> ' . substr($arrSitio[$r]->si_direccion, 0, 50) . "</BR>" .
        '<img src="aplicacion/vista/img/telephone.png" /> ' . substr($arrSitio[$r]->si_telefono, 0, 50) . "</BR>" .
        '<img src="aplicacion/vista/img/twitter.png" /> ' . substr($arrSitio[$r]->si_twitter, 0, 50) . "</BR>" .
        '<img src="aplicacion/vista/img/FaceBook.png" /> ' . substr($arrSitio[$r]->si_facebook, 0, 50) . "</BR>" .
        ' <pre style="width:100%;"><img src="aplicacion/vista/img/info3.png" /> ' . substr($arrSitio[$r]->si_descripcion, 0, 400) . ".</pre></div>
             </td>
             <td><div class='alert alert-success' style='background:#eeeeee;'>
             
                    <a title='Buscar Historia " . $arrSitio[$r]->si_nombre. "' href='aplicacion/vista/enlaces/historias.php?pr_id=" . $arrSitio[$r]->pr_id . "&ca_id=" . $arrSitio[$r]->ca_id . "&cat_id=" . $arrSitio[$r]->cat_id . "&si_id=" . $arrSitio[$r]->si_id . "');' target='_blank'> <span class='label label-success' style='font-size: 17px;'>HISTORIAS</span> </a></BR></BR>
                    <a title='Buscar Youtube " . $arrSitio[$r]->si_nombre . "' href='aplicacion/vista/enlaces/videos.php?pr_id=" . $arrSitio[$r]->pr_id . "&ca_id=" . $arrSitio[$r]->ca_id . "&cat_id=" . $arrSitio[$r]->cat_id . "&si_id=" . $arrSitio[$r]->si_id . "');' target='_blank'><span class='label label-inverse' style='font-size: 17px;'>VIDEOS</span> </a></BR></BR>
                    <a title='Buscar Ruta " . $arrSitio[$r]->si_nombre . "' href='aplicacion/vista/enlaces/rutas.php?pr_id=" . $arrSitio[$r]->pr_id . "&ca_id=" . $arrSitio[$r]->ca_id . "&cat_id=" . $arrSitio[$r]->cat_id . "&si_id=" . $arrSitio[$r]->si_id . "');' target='_blank'> <span class='label label-primary' style='font-size: 17px;'>RUTAS</span></a></BR></BR>
                    <a title='Buscar Foto " . $arrSitio[$r]->si_nombre . "' href='aplicacion/vista/enlaces/fotos.php?pr_id=" . $arrSitio[$r]->pr_id . "&ca_id=" . $arrSitio[$r]->ca_id . "&cat_id=" . $arrSitio[$r]->cat_id . "&si_id=" . $arrSitio[$r]->si_id . "');' target='_blank'> <span class='label label-warning' style='font-size: 17px;'>FOTOS</span></a></BR></BR>
                    <a title='Buscar Fiestas " . $arrSitio[$r]->si_nombre . "' href='aplicacion/vista/enlaces/fiestas.php?pr_id=" . $arrSitio[$r]->pr_id . "&ca_id=" . $arrSitio[$r]->ca_id . "&cat_id=" . $arrSitio[$r]->cat_id . "&si_id=" . $arrSitio[$r]->si_id . "');' target='_blank'> <span class='label label-important' style='font-size: 17px;'>FIESTAS</span></a></BR></BR>
                    <a title='Buscar Cocina " . $arrSitio[$r]->si_nombre . "' href='aplicacion/vista/enlaces/gastronomias.php?pr_id=" . $arrSitio[$r]->pr_id . "&ca_id=" . $arrSitio[$r]->ca_id . "&cat_id=" . $arrSitio[$r]->cat_id . "&si_id=" . $arrSitio[$r]->si_id . "');' target='_blank'> <span class='label label-info' style='font-size: 17px;'>COCINA</span></a></BR></BR>
                    <a title='Buscar Cocina " . $arrSitio[$r]->si_nombre . "' href='aplicacion/vista/enlaces/mapa.php?x=" . $arrSitio[$r]->si_latitud. "&y=" . $arrSitio[$r]->si_longitud. "');' target='_blank'> <span class='label label-primary' style='font-size: 17px;'>LOCALIZACIÓN</span> </a>
                    </div>
             </td>
        </tr>";
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
    echo '<div class="pagination">';
    echo "<ul>";
    echo "<li><a style='cursor:pointer;' onclick=\"Pagina('1')\">Primero</a> </li>";
    if ($PagAct > 1)
        echo "<li><a style='cursor:pointer;' onclick=\"Pagina('$PagAnt')\">Anterior</a> </li>";
    echo "<li> <a style='cursor:pointer;' <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
    if ($PagAct < $PagUlt)
        echo " <li><a style='cursor:pointer;' onclick=\"Pagina('$PagSig')\">Siguiente</a></li> ";
    echo "<li><a style='cursor:pointer;' onclick=\"Pagina('$PagUlt')\">Ultimo</a></li>";
    echo "</ul>";
    echo "</div>";
} else {
    echo '<div class="alert alert-error">
                 <a class="close" data-dismiss="alert"></a>
                    <strong> <img style="width:30px;height:30px;border:0;" src="aplicacion/vista/img/error.png" /> Su búsqueda no produjo resultados! </strong>
                </div> 
                </div>';
}
?>
