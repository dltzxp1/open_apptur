<?php

require_once("../../modelo/dao/gastronomia.php");
$ga_id = $_GET['ga_id'];
$ObjGastronomia = new gastronomia(0, 0, 0, 0, 0, 0, 0);
$query = "SELECT * FROM gastronomia where ga_id=$ga_id";
$ObjGastronomia->obtenerPagin($query);
header("Content-type:. $ObjGastronomia->ga_tipo");
echo $ObjGastronomia->ga_archivo_bytea;
?>