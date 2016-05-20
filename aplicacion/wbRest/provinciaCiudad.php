<?php

include '../modelo/dao/provincia.php';
include '../modelo/dao/canton.php';
$pr_nombre = utf8_encode($_POST['pr_nombre']);
$obProvi = new provincia('0');
$arrProv = $obProvi->arregloProvincia;
$pr_id=0;
for ($i = 0; $i < count($arrProv); $i++) {
    if ($arrProv[$i]->pr_nombre == $pr_nombre) {
        $pr_id = $arrProv[$i]->pr_id;
        break;
    }
}

$objCiud = new canton($pr_id, '0');
$arrCiud= $objCiud->arregloCanton;

$data = array();
for ($i = 0; $i < count($arrCiud); $i++) {
    $data["ca" . $i] = $arrCiud[$i]->ca_nombre;
}
print (json_encode($data));

?>

