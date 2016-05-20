<?php

include('funciones.php');

$us_mail = $_REQUEST['us_mail'];
$us_clave = $_REQUEST['us_clave'];

echo $us_mail . ',' . $us_clave;

if (conexiones($us_mail, $us_clave)) {
    header('Location: ingreso.php');
} else {
    header('Location: ../../login.php?e=0');
}
?>
