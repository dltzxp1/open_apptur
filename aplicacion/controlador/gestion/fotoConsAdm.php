<?php

require_once("../../modelo/dao/foto.php");

$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];

$fo_id = $_REQUEST['fo_id'];
session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];
$_SESSION["prId"] = $_REQUEST['pr_id'];
$_SESSION["caId"] = $_REQUEST['ca_id'];
$_SESSION["catId"] = $_REQUEST['cat_id'];
$_SESSION["siId"] = $_REQUEST['si_id'];

$RegistrosAMostrar = 6;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$ObjFoto = new foto('0', '0', '0', '0', '0', '0', '0');
$ObjFotoPagina = new foto('0', '0', '0', '0', '0', '0', '0');

$query = "SELECT * FROM foto  WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by fo_nombre offset " . ($RegistrosAEmpezar) . " LIMIT " . $RegistrosAMostrar;
$query2 = "SELECT * FROM foto  WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by fo_nombre";

$ObjFoto->fotoConsPagina($query);
$arrFoto = $ObjFoto->arregloFoto;

if ($fo_id == '0') {
    if (count($arrFoto) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead><th>Nombre</th><th>Tipo</th><th>Tamaño</th><th>Descripción</th><th> Ver</th><th>Acciones</th></thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrFoto); $r++) {
            echo "<tr>";
            echo "<td>" . $arrFoto[$r]->fo_nombre . "</td>";
            //echo "<td>" . $arrFoto[$r]->fo_archivo_nombre . "</td>";
            echo "<td>" . $arrFoto[$r]->fo_mime . "</td>";
            echo "<td>" . substr($arrFoto[$r]->size / 1024, 0, 5) . "<strong> KB</strong></td>";
            echo "<td><pre>" . $arrFoto[$r]->fo_descripcion. "</pre></td>";
            echo "<td><img style='width:200px;height:200px;' src='../../../controlador/gestion/verFotoRpt.php?fo_id=" . $arrFoto[$r]->fo_id . "' /></td>";

            echo "<td valign='center'><a title='Eliminar Foto " . $arrFoto[$r]->fo_nombre . "' href='javascript:delFotoAdm(3,\"" . $arrFoto[$r]->pr_id . "\",\"" . $arrFoto[$r]->ca_id . "\",\"" . $arrFoto[$r]->cat_id . "\",\"" . $arrFoto[$r]->si_id . "\",\"" . $arrFoto[$r]->fo_id . "\");'><img style='width:16px;height:16px;border:0;' src='../../img/eliminar.png' /></a>";
            //cho "<a title='Editar Foto " . $arrFoto[$r]->fo_nombre . "' href='admfoto.php?efo_id=\"" . $arrFoto[$r]->fo_id . "\"&efo_nombre=\"" . $arrFoto[$r]->fo_nombre . "\"&efo_descripcion=\"" . $arrFoto[$r]->fo_descripcion . "\"'> <img style='width:16px;height:16px;border:0;' src='../../img/editarx.png' /></a></td>";
            echo "<a title='Editar Foto " . $arrFoto[$r]->fo_nombre . "' href='javascript:editFoto(\"" . $arrFoto[$r]->fo_id . "\",\"" . $arrFoto[$r]->fo_nombre . "\",\"" . $arrFoto[$r]->fo_descripcion . "\");'><img style='width:16px;height:16px;border:0;' src='../../img/editarx.png' /></a> </td>"; 

            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        /* Pagina */

        $ObjFotoPagina->fotoConsPagina($query2);
        $arrFotoPagina = $ObjFotoPagina->arregloFoto;
        $NroRegistros = count($arrFotoPagina);

        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar2" style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginFotoAdm('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginFotoAdm('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginFotoAdm('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginFotoAdm('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";

        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:none;'type='text' id='SI_id' value='$si_id'>";
    } else {
        echo "<input  style='display:none;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:none;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:none;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:none;'type='text' id='SI_id' value='$si_id'>";
    }
}
?>