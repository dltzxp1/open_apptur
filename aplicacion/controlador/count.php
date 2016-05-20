<?php
 
$ip = "IP $_SERVER[REMOTE_ADDR]"; 
$fecha = date("j \d\e\l n \d\e Y");
$hora = date("h:i:s");
$horau = date("h");
$diau = date("z");
$aniou = date("Y");
require_once("aplicacion/modelo/dao/contador.php");
$objContador = new contador('0');
$objContador->insertar($ip, $hora, $fecha, $horau, $diau, $aniou);
?> 
