<?php

require_once("../modelo/dao/historia.php");

 $pr_id = $_GET['pr_id'];
  $ca_id = $_GET['ca_id'];
  $cat_id = $_GET['cat_id'];
  $si_id = $_GET['si_id'];
 
/*$pr_id = 5;
$ca_id = 21;
$cat_id = 1;
$si_id = 1;
*/
$objH = new historia('0', '0', '0', '0', '0', '0', '0');
$script = "select * from historia where pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id  order by hi_nombre ASC;";
$objH->obtenerPagin($script);
$arrH = $objH->arregloHistoria;

$response["historias"] = array();
if (count($arrH) > 0) {
    for ($r = 0; $r < count($arrH); $r++) {
        $festivo = array();
        $festivo["Ehi_nombre"] = $arrH[$r]->hi_nombre;
        $festivo["Ehi_descripcion"] = $arrH[$r]->hi_descripcion;
        array_push($response["historias"], $festivo);
    }
    $response["success"] = 1;
    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No sitios found";
    echo json_encode($response);
}
?> 