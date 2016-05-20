<?php

require_once("../../modelo/dao/pantalla.php");
//emp,usu,rol, res ,pt_id
/* session_start();
  $em_id = $_SESSION['idEmpresa'];
  $us_id = $_SESSION['idUsuario']; */
$emp = $_REQUEST['emp'];
$usu = $_REQUEST['usu'];
$rol = $_REQUEST['rol'];
$res = $_REQUEST['res'];
$pt_id = $_REQUEST['pt_id'];

$objTrama = new pantalla('', '', '', '', '');

$objTrama->eliminar($emp, $usu, $rol, $res, $pt_id);
?> 
