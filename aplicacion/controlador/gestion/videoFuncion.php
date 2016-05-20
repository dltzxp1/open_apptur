<?php

require_once("../../modelo/dao/video.php");

$opcion = $_REQUEST['opcion'];
$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
$vi_nombre = $_REQUEST['vi_nombre'];
$vi_descripcion = $_REQUEST['vi_descripcion'];
$vi_url = $_REQUEST['vi_url'];
$objVideo = new video(0, 0, 0, 0, 0, 0, 0);

session_start();
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];
$us_t_vid = $_SESSION["usTvid"];

/* tamanio asignado */
$objVideo->obtenerTamVideo($em_id, $us_id, $si_id);
$arrVideo = $objVideo->arregloVideo;
$total_video = count($arrVideo);
$total_video +=1;

/* * ********* */

if ($opcion == 3) {
    $vi_id = $_REQUEST['vi_id'];
    $objVideo->eliminar($pr_id, $ca_id, $cat_id, $si_id, $vi_id, $em_id, $us_id);
}

if ($opcion == 0) {
    ///Validamos para que solo pueda Ingresar 2 Historias.
    if ($total_video > $us_t_vid) {
        echo "Usted puede ingresar solo " . $us_t_vid . " Videos !";
        exit;
    }
    if ($objVideo->insertar($pr_id, $ca_id, $cat_id, $si_id, $vi_nombre, $vi_descripcion, $vi_url, $em_id, $us_id)) {
        echo utf8_encode("Videos Ingresados: " . $total_video . ', Limite: ' . $us_t_vid);
        exit;
    } else {
        echo utf8_encode("Error1");
        exit;
    }
} else if ($opcion == 1) {
    $vi_id = $_REQUEST['vi_id'];
    if ($objVideo->actualiza($pr_id, $ca_id, $cat_id, $si_id, $vi_id, $vi_nombre, $vi_descripcion, $vi_url, $em_id, $us_id)) {
        echo utf8_encode("Edicion Correcta.");
        exit;
    } else {
        echo utf8_encode("Error.e");
        exit;
    }
}
?>