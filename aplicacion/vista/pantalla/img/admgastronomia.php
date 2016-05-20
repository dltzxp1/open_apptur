<?php
/* * **************************** */
session_start();
require_once("../../../modelo/dao/provincia.php");
require_once("../../../modelo/dao/canton.php");
require_once("../../../modelo/dao/categoria.php");
require_once("../../../modelo/dao/sitio.php");
require_once("../../../modelo/dao/pantalla.php");
require_once("../../../modelo/dao/gastronomia.php");

$objGastronomia = new gastronomia(0, 0, 0, 0, 0, 0, 0);

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../../index.php");
} else {
    $pantalla = "admgastronomia.php";
    $emId = $_SESSION['emId'];
    $usId = $_SESSION['usId'];
    $objPant = new pantalla('', '', '', '', '');
    $objPant->obtenerPantallas($emId, $usId);
    $arrPant = $objPant->arregloPantalla;

    for ($q = 0; $q < count($arrPant); $q++) {
        if ($arrPant[$q]->pa_nombre == $pantalla) {
            $existe = 1;
        }
    }
    if ($existe == 0) {
        echo '<div class="alert alert-error">
                 <a class="close" data-dismiss="alert"></a>
                    <strong>No tiene Pemisos !!</strong>
                </div> 
                </div>';
        exit;
    }
}
/* * **************************** */

# Muestra el mensaje de confirmación
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
if (!$tam) {
    $ban = 0;
} else {
    $ban = 1;
}
$banImg = 0;

if ($postback) {
    if (!$_POST['ga_nombre'] == "" && !$_POST['ga_descripcion'] == "" && !$_FILES["archivo"]["name"] == "" && $ban == 1) {
        if ($tam < 204800) {
            $ga_nombre = $_POST['ga_nombre'];
            $ga_descripcion = $_POST['ga_descripcion'];
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
                $sql = "INSERT INTO gastronomia(pr_id,ca_id,cat_id,si_id,ga_nombre,ga_descripcion,ga_fecha,ga_archivo_nombre,ga_archivo_bytea,ga_mime,size,em_id,us_id)
            VALUES ($pr_id,$ca_id,$cat_id,$si_id,'$ga_nombre','$ga_descripcion',CURRENT_TIMESTAMP,'$nombre','$buffer','$type',$size,$em_id,$us_id)";
            }
            if ($objGastronomia->insertar($sql)) {
                $banImg = 1;
            }
        }
    } else {
        $banImg = 10;
    }
}

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    <head>
        <title>Insertar archivos en un campo blob de PostgreSQL</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/bootstrap/css/bootstrap.css" ></link>
        <link rel="stylesheet" type="text/css" href="../../../librerias/bootstrap/css/bootstrap-responsive.css" ></link>  
        <script src="../../js/ajax.js"></script>
        <link rel="stylesheet" type="text/css" href="../../../librerias/select2/js/jquery-1.7.1.min.js" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/select2/js/jQuery-form.js" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/select2/js/alert.js" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/select2/js/jQuery-File-Upload.js" />
        <link rel="stylesheet" type="text/css" href="../../../librerias/jquery.js" />

    </head>
    <body onload="consGastronomiaAdm('<?php echo $pr_id; ?>','<?php echo $ca_id; ?>','<?php echo $cat_id; ?>','<?php echo $si_id; ?>','<?php echo 0; ?>')">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse collapse navbar-responsive-collapse">
                        <ul class="nav pull-center"> 
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="../../img/city.png"></img> Administración de Fotos /

                                    <?php
                                    $objProvin = new provincia('0');
                                    $arrProvin = $objProvin->arregloProvincia;
                                    for ($i = 0; $i < count($arrProvin); $i++) {
                                        if ($arrProvin[$i]->pr_id == $pr_id) {
                                            echo $arrProvin[$i]->pr_nombre . ' / ';
                                        }
                                    }

                                    $objCantones = new canton('0', '0');
                                    $objCantones->obtenerPagin("select * from canton");
                                    $arrCantons = $objCantones->arregloCanton;

                                    for ($j = 0; $j < count($arrCantons); $j++) {
                                        if ($arrCantons[$j]->ca_id == $ca_id) {
                                            echo $arrCantons[$j]->ca_nombre . ' / ';
                                        }
                                    }

                                    $objCategoria = new categoria('0');
                                    $objCategoria->obtenerPagin("select * from categoria");
                                    $arrCategoria = $objCategoria->arregloCategoria;

                                    for ($j = 0; $j < count($arrCategoria); $j++) {
                                        if ($arrCategoria[$j]->cat_id == $cat_id) {
                                            echo $arrCategoria[$j]->cat_nombre . ' / ';
                                        }
                                    }

                                    $objSitio = new sitio('0', '0', '0', '0', '0');
                                    $objSitio->obtenerPagin("select * from sitio");
                                    $arrSitio = $objSitio->arregloSitio;

                                    for ($j = 0; $j < count($arrSitio); $j++) {
                                        if ($arrCategoria[$j]->cat_id == $cat_id) {
                                            echo $arrCategoria[$j]->cat_nombre . '  ';
                                        }
                                    }
                                    ?>
                                </a>
                            </li>  
                        </ul>  
                    </div> 
                </div>
            </div> 
        </div>
        <div>
            <?php
            if ($banImg == 1) {
                echo ' <div class="alert alert-success">
                 <a class="close" data-dismiss="alert">  </a>
                    <strong><img src="../../img/ok.png"/> Imagen insertada ! </strong>
                </div> 
                </div>';
            } else if ($banImg == 10 && !$_POST['ga_nombre'] == "" && !$_POST['ga_descripcion'] == "" && !$_FILES["archivo"]["name"] == "") {
//                if (!$_POST['ga_nombre'] == "" && !$_POST['ga_descripcion'] == "" && !$_FILES["archivo"]["name"] == "" && $ban == 1) {
                echo ' <div class="alert alert-error">
                 <a class="close" data-dismiss="alert">  </a>
                    <strong><img src="../../img/error.png"/> Imagen NO insertada ! </strong>
                </div> 
                </div>';
            }
            ?></div>

        <div id="contenedor">
            <div id="postform">
                <div id="error" style="display: block;"> </div>
                <form  name="frmblob" id="frmblob" method="POST" enctype="multipart/form-data" action="admgastronomia.php">
                    <table>
                        <tr>
                            <td><strong>Nombre:</strong></td><td><input placeholder='Nombre [5-32]' type="text" id="ga_nombre" name="ga_nombre" /></td>
                        </tr>
                        <tr>
                            <td><strong>Descripción</strong></td><td><textarea placeholder='Tras esto quedaron unos pocos bastiones de....' style='width:250px;height:100px;' rows='4' cols='26' id="ga_descripcion" name="ga_descripcion" ></textarea> </td>
                        </tr>
                        <tr>
                            <td><strong>Foto</strong></td><td><span class="btn btn-file"><input type="file" id="archivo" name="archivo" title="Archivo a subir" size="50" /> Tamaño Imagen < 200KB</span></td>
                            <td colspan="3"> 
                                <button type="submit" name="botonn" id="botonn" onclick="validarCamposGastronomia();"> <img src="../../img/save.png"/> </button>
                                <a href="" style="color: white;"> <img src="../../img/reload.png"/></a>
                            </td>
                        </tr>
                    </table>  
                </form>
            </div>
        </div>

        <div id="contenedorRpt">

        </div>
        <script src="../../../librerias/bootstrap-typeahead.js"></script>
        <script src="../../../librerias/jquery.js"></script>

    </body>
</html>
