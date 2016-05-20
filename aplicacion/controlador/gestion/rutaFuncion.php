<?php

require_once("../../modelo/dao/ruta.php");

$matrizRuta = json_decode($_REQUEST['matrizRuta']);

//$res = '_'; 
/* for ($i = 0; $i < count($matrizRuta); $i++) {
  $res = $res + $matrizRuta[$i][0] . ',' . $matrizRuta[$i][1] + "_";
  } */

/* echo $matrizRuta[0][0] . ',' . $matrizRuta[0][1]."<br />";
  echo $matrizRuta[1][0] . ',' . $matrizRuta[1][1]."<br />";
  echo $matrizRuta[2][0] . ',' . $matrizRuta[2][1]."<br />";
  echo $matrizRuta[3][0] . ',' . $matrizRuta[3][1]."<br />";
 */

$opcion = $_REQUEST['opcion'];
$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$ru_nombre = $_REQUEST['ru_nombre'];
$ru_descripcion = $_REQUEST['ru_descripcion'];
 
$objRuta = new ruta(0, 0, 0, 0, 0, 0, 0);
session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];
$us_t_rut = $_SESSION["usTrut"];

/* tamanio asignado */
$objRuta->obtenerTamRut($em_id, $us_id, $si_id);
$arrGastro = $objRuta->arregloRuta;
$total_ruta = count($arrGastro);
$total_ruta +=1;
/* * ********* */

if ($opcion == 3) {
    $ru_id = $_REQUEST['ru_id'];
    $objRuta->eliminar($pr_id, $ca_id, $cat_id, $si_id, $ru_id, $em_id, $us_id);
}
if ($opcion == 0) {
    ///Validamos para que solo pueda Ingresar 2 Historias.
    if ($total_ruta > $us_t_rut) {
        echo "Usted puede ingresar solo " . $us_t_rut . " Ruta(s) !";
        exit;
    }
    if ($objRuta->insertar($pr_id, $ca_id, $cat_id, $si_id, $ru_nombre, $ru_descripcion, $em_id, $us_id, $matrizRuta)) {
        echo utf8_encode("Ruta(s) Ingresada(s) : " . $total_ruta . ', Limite: ' . $us_t_rut);
        exit;
    } else {
        echo utf8_encode("Error1");
        exit;
    }
} else if ($opcion == 1) {
    $ru_id = $_REQUEST['ru_id'];
    if ($objRuta->actualiza($pr_id, $ca_id, $cat_id, $si_id, $ru_id, $ru_nombre, $ru_descripcion, $em_id, $us_id, $matrizRuta)) {
        echo utf8_encode("Edicion Correcta.");
        exit;
    } else {
        echo utf8_encode("Error");
        exit;
    }
}
?>