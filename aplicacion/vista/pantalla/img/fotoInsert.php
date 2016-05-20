<?php
require_once("../../../modelo/dao/provincia.php");
require_once("../../../modelo/dao/canton.php");
require_once("../../../modelo/dao/categoria.php");
require_once("../../../modelo/dao/sitio.php");
require_once("../../../modelo/dao/pantalla.php");
require_once("../../../modelo/dao/foto.php"); 


$objFoto = new foto(0, 0, 0, 0, 0, 0, 0);

$postback = (isset($_POST["botonn"])) ? true : false;
session_start();
$pr_id = $_SESSION["prId"];
$ca_id = $_SESSION["caId"];
$cat_id = $_SESSION["catId"];
$si_id = $_SESSION["siId"];
$em_id = $_SESSION["emId"];
$us_id = $_SESSION["usId"];
$tam = $_FILES["archivo"]["size"];
$ban = 0;

if ($postback) {
    if (!$_POST['fo_nombre'] == "" && !$_POST['fo_descripcion'] == "" && !$_FILES["archivo"]["name"] == "" && $ban == 1) {
        if ($tam < 204800) {
            $fo_nombre = $_POST['fo_nombre'];
            $fo_descripcion = $_POST['fo_descripcion'];
            $nombre = basename($_FILES["archivo"]["name"]);
            $type = $_FILES["archivo"]["type"];
            $tmp_name = $_FILES["archivo"]["tmp_name"];
            $size = $_FILES["archivo"]["size"];

            # Contenido del archivo
            $fp = fopen($tmp_name, "rb");
            $buffer = fread($fp, filesize($tmp_name));
            fclose($fp);
            $isoid = $_POST['bytea'];

            if (!$isoid) {
                $buffer = pg_escape_bytea($buffer);
                $sql = "INSERT INTO foto(pr_id,ca_id,cat_id,si_id,fo_nombre,fo_descripcion,fo_fecha,fo_archivo_nombre,fo_archivo_bytea,fo_mime,size,em_id,us_id)
            VALUES ($pr_id,$ca_id,$cat_id,$si_id,'$fo_nombre','$fo_descripcion',CURRENT_TIMESTAMP,'$nombre','$buffer','$type',$size,$em_id,$us_id)";
            }
            if ($objFoto->insertar($sql)) {
                $banImg = 1;
            }
        }
    } else {
        $banImg = 10;
    }
}
?>
