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

$RegistrosAMostrar = 7;
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
        echo "<thead>";
        echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Nombre</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrFoto); $r++) {
            echo "<tr>";
            echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrFoto[$r]->pr_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='caId" . $r . "'   style='display:none;'>" . $arrFoto[$r]->ca_id . "</td>";
            echo "<td id='catId" . $r . "'  style='display:none;'>" . $arrFoto[$r]->cat_id . "</td>";
            echo "<td id='siId" . $r . "'   style='display:none;'>" . $arrFoto[$r]->si_id . "</td>";
            echo "<td id='foId" . $r . "'   style='display:none;'>" . $arrFoto[$r]->fo_id . "</td>";
            echo "<td id='foNombre" . $r . "'>";
            if (strlen($arrFoto[$r]->fo_nombre) >= 20) {
                echo substr($arrFoto[$r]->fo_nombre, 0, 20) . '.';
            } else {
                echo $arrFoto[$r]->fo_nombre;
            }
            echo "</td>";
            echo "<td id='fo_descripcion" . $r . "' style='display:none;'>" . $arrFoto[$r]->fo_descripcion . "</td>";
            echo "<td id='fo_url" . $r . "' style='display:none;'>" . $arrFoto[$r]->fo_url . "</td>";

            echo "</tr>";
        }
        echo "</tbody> </table>";

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
        echo '<div class="pagination" id="paginar2"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginFoto('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginFoto('$PagAnt')\"> < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginFoto('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginFoto('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";

        echo "<input  style='display:block;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:block;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:block;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:block;'type='text' id='SI_id' value='$si_id'>";
    } else {
        echo "<input  style='display:block;'type='text' id='PR_id' value='$pr_id'>";
        echo "<input  style='display:block;'type='text' id='CA_id' value='$ca_id'>";
        echo "<input  style='display:block;'type='text' id='CAT_id' value='$cat_id'>";
        echo "<input  style='display:block;'type='text' id='SI_id' value='$si_id'>";
    }
}
?>