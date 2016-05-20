<?php

require_once("../../modelo/dao/video.php");

$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$vi_id = $_REQUEST['vi_id'];
session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];

//$objVideo = new video($pr_id, $ca_id, $cat_id, $si_id, 0, $em_id, $us_id);
//$arrVideo = $objVideo->arregloVideo;

$RegistrosAMostrar = 7;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$ObjVideo = new video('0', '0', '0', '0', '0', '0', '0');
$ObjVideoPagina = new Video('0', '0', '0', '0', '0', '0', '0');

$query = "SELECT * FROM video WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by vi_id offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM video WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id";

$ObjVideo->videoConsPagina($query);
$arrVideo = $ObjVideo->arregloVideo;

if ($vi_id == '0') {
    if (count($arrVideo) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Nombre</th> <th>  Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrVideo); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrVideo[$r]->pr_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='caId" . $r . "'   style='display:none;'>" . $arrVideo[$r]->ca_id . "</td>";
            echo "<td id='catId" . $r . "'  style='display:none;'>" . $arrVideo[$r]->cat_id . "</td>";
            echo "<td id='siId" . $r . "'   style='display:none;'>" . $arrVideo[$r]->si_id . "</td>";
            echo "<td id='viId" . $r . "'   style='display:none;'>" . $arrVideo[$r]->vi_id . "</td>";
            echo "<td id='vi_nombre" . $r . "'>";
            //. $arrVideo[$r]->vi_nombre . 
            if (strlen($arrVideo[$r]->vi_nombre) >= 20) {
                echo substr($arrVideo[$r]->vi_nombre, 0, 20) . '.';
            } else {
                echo $arrVideo[$r]->vi_nombre;
            }
            echo "</td>";
            echo "<td id='vi_descripcion" . $r . "' style='display:none;'>" . $arrVideo[$r]->vi_descripcion . "</td>";
            echo "<td id='vi_url" . $r . "' style='display:none;'>" . $arrVideo[$r]->vi_url . "</td>";

            echo "<td align='center'>";
            echo "<a title='Eliminar Video " . $arrVideo[$r]->vi_nombre . "' href='javascript:delVideo(3,\"" . $arrVideo[$r]->pr_id . "\",\"" . $arrVideo[$r]->ca_id . "\",\"" . $arrVideo[$r]->cat_id . "\",\"" . $arrVideo[$r]->si_id . "\",\"" . $arrVideo[$r]->vi_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/delete.png' /></a>";
            echo "<a title='Editar Video" . $arrVideo[$r]->vi_nombre . "' href='javascript:editVideo(\"" . $arrVideo[$r]->pr_id . "\",\"" . $arrVideo[$r]->ca_id . "\",\"" . $arrVideo[$r]->cat_id . "\",\"" . $arrVideo[$r]->si_id . "\",\"" . $arrVideo[$r]->vi_id . "\",\"" . $arrVideo[$r]->vi_nombre . "\",\"" . $arrVideo[$r]->vi_descripcion . "\",\"" . $arrVideo[$r]->vi_url . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/edit_.png' /></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        /* Pagina */
        $ObjVideoPagina->videoConsPagina($query2);
        $arrVideoPagina = $ObjVideoPagina->arregloVideo;
        $NroRegistros = count($arrVideoPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginVideo('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginVideo('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginVideo('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginVideo('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";


        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:none;'type='text' id='SI_id' value='$si_id'>";
    } else {
        echo 'Lo sentimos, su consulta no produjo resultados. <br>';
        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:none;'type='text' id='SI_id' value='$si_id'>";
    }
}
?>