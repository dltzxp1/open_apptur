<?php

require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/video.php");
//pr_id,ca_id,cat_id,si_id,si_nombre

$pdId = $_REQUEST['pr_id'];
$caId = $_REQUEST['ca_id'];
$catId = $_REQUEST['cat_id'];
$siId = $_REQUEST['si_id'];

//pr_id,ca_id,cat_id,si_id,si_nombre
//echo $pdId . ',' . $caId . ',' . $catId;
//exit;

$script = "SELECT * FROM video WHERE pr_id=$pdId AND ca_id=$caId AND cat_id=$catId AND si_id=$siId";
$objVideo = new video('0', '0', '0', '0', '0', '0', '0');
$objVideo->historiaConsVideo($script);
$arrVideo = $objVideo->arregloVideo;

 
echo "<br />";
if (count($arrVideo) > 0) {
    echo "<table id='tablaReportePlano' align='center' border='0'>";
    echo "<tbody>"; 
    for ($r = 0; $r < count($arrVideo); $r++) {
        echo "<tr>"; 
        echo "<td> ";
        echo "<div class='alert alert-info'>";
        echo "<a href=\"" . $arrVideo[$r]->vi_url . "\" >" . substr($arrVideo[$r]->vi_nombre, 0, 20) . "</a> ";
            echo "</div>
              </td>"; 
        echo "</tr>";
    }
    echo "</tbody> </table>";
} else {
    echo "No hay Datos!!";
}
?>
