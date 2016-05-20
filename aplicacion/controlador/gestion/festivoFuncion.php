<?php

require_once("../../modelo/dao/festivo.php");

$opcion = $_REQUEST['opcion'];
$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$fe_nombre = $_REQUEST['fe_nombre'];
$fe_descripcion = $_REQUEST['fe_descripcion'];
$fe_fechainicio = $_REQUEST['fe_fechainicio'];
$fe_fechafin = $_REQUEST['fe_fechafin'];
$objFestivo = new festivo(0, 0, 0, 0, 0, 0, 0);

session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];
$us_t_fes = $_SESSION["usTfes"];

/* tamanio asignado */
$objFestivo->obtenerTamFestivo($em_id, $us_id, $si_id);
$arrFesti = $objFestivo->arregloFestivo;
$total_festivo = count($arrFesti);
$total_festivo+=1;
/* * ********* */

if ($opcion == 3) {
    $fe_id = $_REQUEST['fe_id'];
    $objFestivo->eliminar($pr_id, $ca_id, $cat_id, $si_id, $fe_id, $em_id, $us_id);
}

if ($opcion == 0) {
    ///Validamos para que solo pueda Ingresar 2 Historias.
    if ($total_festivo > $us_t_fes) {
        echo "Usted puede ingresar solo " . $us_t_fes . " dias Festivos !";
        exit;
    }
    if ($objFestivo->insertar($pr_id, $ca_id, $cat_id, $si_id, $fe_nombre, $fe_descripcion, $fe_fechainicio, $fe_fechafin, $em_id, $us_id)) {
        echo utf8_encode("Festivos Ingresados: " . $total_festivo . ', Limite: ' . $us_t_fes);
        exit;
    } else {
        echo utf8_encode("Error1");
        exit;
    }
} else if ($opcion == 1) {
    $fe_id = $_REQUEST['fe_id'];
    if ($objFestivo->actualiza($pr_id, $ca_id, $cat_id, $si_id, $fe_id, $fe_nombre, $fe_descripcion, $fe_fechainicio, $fe_fechafin, $em_id, $us_id)) {
        echo utf8_encode("Edicion Correcta.");
        exit;
    } else {
        echo utf8_encode("Error.e");
        exit;
    }
}
?>