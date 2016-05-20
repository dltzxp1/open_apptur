<?php

/*$nombre_archivo = $_FILES['archivo']['name'];
$tipo_archivo = $_FILES['archivo']['type'];
$tamano_archivo = $_FILES['archivo']['size'];*/
$tmp_archivo = $_FILES['archivo']['tmp_name'];

echo $tmp_archivo;
echo $_REQUEST['as'];
?>
