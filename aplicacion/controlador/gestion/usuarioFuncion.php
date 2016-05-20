<?php

require_once("../../modelo/dao/usuario.php");

$opcion = $_REQUEST['opcion'];
$em_id = $_REQUEST['em_id'];
$us_nombre = $_REQUEST['us_nombre'];
$us_apellido = $_REQUEST['us_apellido'];
$us_mail = $_REQUEST['us_mail'];
$us_usuario = $_REQUEST['us_usuario'];
$us_clave = $_REQUEST['us_clave'];
//$us_clave = $_REQUEST['us_clave_repita'];
$us_estado = $_REQUEST['us_estado'];

$us_t_sit = $_REQUEST['us_t_sit'];
$us_t_his = $_REQUEST['us_t_his'];
$us_t_vid = $_REQUEST['us_t_vid'];
$us_t_fot = $_REQUEST['us_t_fot'];
$us_t_fes = $_REQUEST['us_t_fes'];
$us_t_gas = $_REQUEST['us_t_gas'];
$us_t_rut = $_REQUEST['us_t_rut'];

$objUsuario = new usuario('0', '0');

if ($opcion == 0) {
    if ($objUsuario->insertar($em_id, $us_nombre, $us_apellido, $us_mail, $us_usuario, $us_clave, $us_clave,$us_estado, $us_t_sit, $us_t_his, $us_t_vid, $us_t_fot, $us_t_fes, $us_t_gas, $us_t_rut)) {
        echo utf8_encode("Usuario insertado ! ");
        exit;
    } else {
        echo utf8_encode("Por favor, ingrese de nuevo !");
        exit;
    }
} else if ($opcion == 1) {
    $us_id = $_REQUEST['us_id'];
    if ($objUsuario->actualizar($em_id, $us_id, $us_nombre, $us_apellido, $us_mail, $us_usuario, $us_clave, $us_estado, $us_t_sit, $us_t_his, $us_t_vid, $us_t_fot, $us_t_fes, $us_t_gas, $us_t_rut)) {
        echo utf8_encode("Usuario editado ! ");
    } else {
        echo utf8_encode("Por favor, ingrese de nuevo !");
    }
}
if ($opcion == 3) {
    $us_id = $_REQUEST['us_id'];
    $objUsuario->eliminar($em_id, $us_id);
}
?>