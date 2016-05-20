<?php

require_once("../../modelo/dao/foto.php");
$fo_id = $_GET['fo_id'];
$ObjFoto = new foto(0, 0, 0, 0, 0, 0, 0);
$query = "SELECT * FROM foto where fo_id=$fo_id";
$ObjFoto->obtenerPagin($query);
header("Content-type:. $ObjFoto->fo_tipo");
echo $ObjFoto->fo_archivo_bytea;
?>

