<?php
/* * **************************** */
require_once("../../modelo/dao/provincia.php");
require_once("../../modelo/dao/canton.php");
require_once("../../modelo/dao/categoria.php");
require_once("../../modelo/dao/sitio.php");
require_once("../../modelo/dao/foto.php");
if (!$_REQUEST['pr_id']) {
    header("Location: ../../../index.php");
}
$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];
session_start();
$emId = $_SESSION['prId'];
if ($emId == '' && $pr_id == '') {
    exit;
} else {
    
}
$objFoto = new foto('0', '0', '0', '0', '0', '0', '0');
$objP = new provincia('0');
$arrP = $objP->arregloProvincia;

$objCan = new canton('0', '0');
$objCan->obtenerTodo();
$arrCan = $objCan->arregloCanton;
$objCat = new categoria('0');
$arrCat = $objCat->arregloCategoria;
$objSit = new sitio('0', '0', '0', '0', '0');
$objSit->obtenerTodo();
$arrSit = $objSit->arregloSitio;
$query = "SELECT * FROM foto WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id";
$objFoto->obtenerPagin($query);
$arrFoto = $objFoto->arregloFoto;

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Imágenes</title>
        <link href="../img/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css" ></link>
        <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap-responsive.css" ></link> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
        <link href="../../librerias/wrap/bootstrap-combined.no-icons.min.css" rel="stylesheet">        
        <link href="../../librerias/wrap/custom.css" rel="stylesheet"> 
        <link href="../../librerias/theme-style.css" rel="stylesheet"> 
        <link rel="stylesheet" type="text/css" href="../../librerias/index.css">
        <script language="javascript" type="text/javascript" src="../js/enlaces.js"></script>

    </head>
    <body> 
        <div class="row-fluid">
            <div class="navbar navbar-inverse">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="nav-collapse collapse">
                            <ul class="nav pull-center" aalign="center"> 
                                <li class="active">
                                    <a href=""><i class="icon-home icon-white"></i>
                                        <?php
                                        if (count($arrFoto) > 0) {
                                            echo "<table class='bordered-table zebra-striped'>";
                                            echo "<tbody>";
                                            for ($r = 0; $r < count($arrFoto); $r++) {
                                                echo "<tr>";
                                                for ($i = 0; $i < count($arrP); $i++) {
                                                    if ($arrP[$i]->pr_id == $arrFoto[$r]->pr_id) {
                                                        echo '' . $arrP[$i]->pr_nombre . ' | ';
                                                    }
                                                }
                                                for ($i = 0; $i < count($arrCan); $i++) {
                                                    if ($arrCan[$i]->ca_id == $arrFoto[$r]->ca_id) {
                                                        echo '' . $arrCan[$i]->ca_nombre . ' | ';
                                                    }
                                                }
                                                for ($i = 0; $i < count($arrCat); $i++) {
                                                    if ($arrCat[$i]->cat_id == $arrFoto[$r]->cat_id) {
                                                        echo $arrCat[$i]->cat_nombre . ' - ';
                                                    }
                                                }
                                                for ($i = 0; $i < count($arrSit); $i++) {
                                                    if ($arrSit[$i]->si_id == $arrFoto[$r]->si_id) {
                                                        echo $arrSit[$i]->si_nombre;
                                                    }
                                                }
                                                break;
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                            echo "</tbody> </table>";
                                        }
                                        ?>
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.nav-collapse -->
                    </div><!-- /.container -->
                </div><!-- /.navbar-inner -->
            </div><!-- /.navbar -->
        </div><!-- /.navbar -->


        <div class="container" style="width: 60%;">
            <div class="bs-docs-example" style="display: block;position: relative;"> 
                <div id="myCarousel" class="carousel slide">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" align="center"> 
                        <div class="item active">
                            <?php
                            if (count($arrFoto) == 0) {
                                echo '<div class="alert alert-error">
                                                <a class="close" data-dismiss="alert"></a>
                                                <strong> <img style="width:30px;height:30px;border:0;" src="../img/error.png" /> Su búsqueda no produjo resultados! </strong>
                                            </div> 
                                            </div><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR />';
                            }
                            echo "<img class='FotoView' src='../../controlador/gestion/verFotoRpt.php?fo_id=" . $arrFoto[0]->fo_id . "'/>  ";
                            ?>
                            <div class="carousel-caption">
                                <h4>
                                    <?php
                                    echo $arrFoto[0]->fo_nombre . '</br>';
                                    ?> </h4>
                                <p>
                                    <?php
                                    echo $arrFoto[0]->fo_descripcion;
                                    ?>
                                </p>
                            </div>
                        </div>
                        <?php
                        for ($r = 1; $r < count($arrFoto); $r++) {
                            ?>
                            <div class="item">
                                <?php
                                echo "<td> <img class='FotoView' src='../../controlador/gestion/verFotoRpt.php?fo_id=" . $arrFoto[$r]->fo_id . "'/>  </td>";
                                ?>
                                <div class="carousel-caption">
                                    <h4>
                                        <?php
                                        echo $arrFoto[$r]->fo_nombre . '</br>';
                                        ?> </h4>
                                    <p>
                                        <?php
                                        echo $arrFoto[$r]->fo_descripcion;
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
                </div>
            </div>
        </div>


        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="span3 col">
                        <div class="block contact-block"> 
                            <!--@todo: replace with company contact details-->
                            <h3>Para mayor información</h3>
                            <address>
                                <p><abbr title="Email"><i class="icon-envelope"></i></abbr> info@info.com</p>
                                <p><abbr title="Address"><i class="icon-home"></i></abbr> Ibarra - Ecuador</p>
                            </address>
                        </div>
                    </div>
                    <div class="span4 col">
                        <div class="block newsletter" id="soloborde">
                            <h3>Regístrate!</h3>
                            <form class="inline">  
                                <table>
                                    <tr><td><strong>Nombre:</strong></td>      <td> <input type='text' placeholder='Pedro' id='us_nombre' value=''/></td><td class='detalleForm'> </td></tr>
                                    <tr><td><strong>Apellido:</strong></td>    <td> <input type='text' placeholder='Díaz' id='us_apellido' value=''/></td><td class='detalleForm'> </td></tr>
                                    <tr><td><strong>Mail:</strong></td>        <td> <input type='text' placeholder='pedro@hotmail.com' id='us_mail' value=''/></td><td class='detalleForm'> </td></tr>
                                    <tr><td><strong>Alias:</strong></td>       <td> <input type='text' placeholder='piter' id='us_alias' value=''/></td><td class='detalleForm'> </td></tr>
                                    <tr>
                                        <td></td>
                                        <td><button type="button" class='btn btn-primary' id='botonn' onclick="validarCamposUsuarioEn();"><img src="../img/userLogin.png"/>Regístrate</button></td>
                                    </tr>
                                    <tr><td></td>
                                        <td>
                                            <div id="formularioingreso" style="display: none;margin-top: 10px;"> 
                                            </div>
                                        </td>
                                    </tr>
                                </table> 
                            </form>
                        </div>
                    </div>

                    <div class="span5 col">
                        <div class="block">
                            <h3>Quíenes somos</h3>
                            <p>UNIVERSIDAD TÉCNICA DEL NORTE</p>
                        </div>
                    </div>

                </div>
                <div class="row-fluid">
                    <div id="toplink"><a href="#top" class="top-link" title="Back to top">Ir arriba <i class="icon-chevron-up"></i></a></div>
                    <!--@todo: replace with company copyright details-->
                    <div class="subfooter">
                        <div class="span6">
                            <p>Desarrollado! <a href="#">codigoflow.net</a> | 2013 Junio</p>
                        </div>
                        <div class="span6">
                            <ul class="inline pull-right">
                                <li><a href="#">El usuario que publique información inconsistente será eliminado,</a></li>
                                <li><a href="#">Privacidad</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer> 

        <script src="../../librerias/wrap/bootstrap.min.js"></script>  <!-- Cerra Alertas Javascript-->
        <script src="../../librerias/bootstrap-typeahead.js"></script>


    </body>
</html>
