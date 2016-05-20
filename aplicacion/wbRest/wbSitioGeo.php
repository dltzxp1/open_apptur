<?php

require_once("../modelo/dao/provincia.php");
require_once("../modelo/dao/canton.php");
require_once("../modelo/dao/categoria.php");
require_once("../modelo/dao/sitio.php");

//5,21,1,
$pr_id = $_GET['pr_id'];
$ca_id = $_GET['ca_id'];
$cat_id = $_GET['cat_id'];

$objP = new provincia('0');
$arrP = $objP->arregloProvincia;
$objCan = new canton('0', '0');
$objCan->obtenerTodo();
$arrCan = $objCan->arregloCanton;
$objCat = new categoria('0');
$arrCat = $objCat->arregloCategoria;

$pr_id_1 = 0;
$ca_id_1 = 0;
$cat_id_1 = 0;

for ($i = 0; $i < count($arrP); $i++) {
    if ($arrP[$i]->pr_nombre == $pr_id) {
        $pr_id_1 = $arrP[$i]->pr_id;
    }
}
for ($i = 0; $i < count($arrCan); $i++) {
    if ($arrCan[$i]->ca_nombre == $ca_id) {
        $ca_id_1 = $arrCan[$i]->ca_id;
    }
}
for ($i = 0; $i < count($arrCat); $i++) {
    if ($arrCat[$i]->cat_nombre == $cat_id) {
        $cat_id_1 = $arrCat[$i]->cat_id;
    }
}

$objSitio = new sitio('0', '0', '0', '0', '0');
$script = "SELECT * FROM sitio WHERE pr_id=$pr_id_1  AND ca_id=$ca_id_1 AND cat_id=$cat_id_1  order by si_nombre ASC;";
$objSitio->sitioswb($script);
$arrSitio = $objSitio->arregloSitio;

$response["sitios"] = array();
if (count($arrSitio) > 0) {
    for ($r = 0; $r < count($arrSitio); $r++) {
        $provincia = array();
        $provincia["si_nombre"] = $arrSitio[$r]->si_nombre;
        $provincia["si_latitud"] = $arrSitio[$r]->si_latitud;
        $provincia["si_longitud"] = $arrSitio[$r]->si_longitud;
        array_push($response["sitios"], $provincia);
    }
    $response["success"] = 1;
    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No sitios found";
    echo json_encode($response);
}
?> 