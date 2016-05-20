<?php

require_once("../modelo/dao/video.php");

//5,21,1,

$pr_id = $_GET['pr_id'];
$ca_id = $_GET['ca_id'];
$cat_id = $_GET['cat_id'];
$si_id = $_GET['si_id'];

/* $pr_id = 1;
  $ca_id = 1;
  $cat_id = 1;
  $si_id = 1; */

$objV = new video('0', '0', '0', '0', '0', '0', '0');
$script = "select * from video where pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id  order by vi_nombrie ASC;";
$objV->obtenerPagin($script);
$arrV = $objV->arregloVideo;

$response["videos"] = array();
if (count($arrV) > 0) {
    for ($r = 0; $r < count($arrV); $r++) {
        $video = array();

        $video["Epr_id"] = $arrV[$r]->pr_id;
        $video["Eca_id"] = $arrV[$r]->ca_id;
        $video["Ecat_id"] = $arrV[$r]->cat_id;
        $video["Esi_id"] = $arrV[$r]->si_id;
        $video["Evi_id"] = $arrV[$r]->vi_id;

        $video["Evi_nombre"] = $arrV[$r]->vi_nombre;
        $video["Evi_descripcion"] = $arrV[$r]->vi_descripcion;
        $video["Evi_url"] = $arrV[$r]->vi_url;
        array_push($response["videos"], $video);
    }
    $response["success"] = 1;
    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No sitios found";
    echo json_encode($response);
}
?> 