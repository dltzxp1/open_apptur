<?php

include '../modelo/dao/categoria.php';
$obCatg = new categoria('0');
$arrCatg = $obCatg->arregloCategoria;
$data = array();
for ($i = 0; $i < count($arrCatg); $i++) {
    $data["cat" . $i] = $arrCatg[$i]->cat_nombre;
}
print (json_encode($data));
?>
