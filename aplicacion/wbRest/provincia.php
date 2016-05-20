<?php

include '../modelo/dao/provincia.php';
$objProcia = new provincia('0');
$arrProcia = $objProcia->arregloProvincia;
//$id = $_POST['id'];
$data = array();
for ($i = 0; $i < count($arrProcia); $i++) {
    $data["pr" . $i] = $arrProcia[$i]->pr_nombre;
}

print (json_encode($data));
?>
