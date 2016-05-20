<?php
if (!$_REQUEST['x']) {
    header("Location: ../../../index.php");
}
$x = $_REQUEST['x'];
$y = $_REQUEST['y'];
session_start();
$emId = $_SESSION['prId'];
if ($emId == '' && $pr_id == '') {
    exit;
} else {
    
}
?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Mapa</title>
        <link href="../img/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css" ></link>
        <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap-responsive.css" ></link>
        <script language="javascript" type="text/javascript" src="../../librerias/select2/js/jquery-1.7.1.min.js"></script> 

        <link rel="stylesheet" type="text/css" href="../../librerias/wrap/bootstrap-combined.no-icons.min.css">        
        <link rel="stylesheet" type="text/css" href="../../librerias/wrap/custom.css"> 
        <link rel="stylesheet" type="text/css"href="../../librerias/theme-style.css">
        <link rel="stylesheet" type="text/css" href="../../librerias/index.css">

        <script language="javascript" type="text/javascript" src="../js/OpenLayers/OpenLayers.js"></script>
        <script language="javascript" type="text/javascript" src="../js/jsRuta.js"></script>
        <script language="javascript" type="text/javascript" src="../js/enlaces.js"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=false&v=3.2"></script>
        <style>
            body{
                /*background: rgb(51, 51, 51);*/
                background: #eeeeee;
            }
            #map{
                top:20px;
                display: block; 
                width: 50%;
                height: 560px;
                border: white solid 10px;
                z-index: 0;
                left: 25%;
                position: relative;
            }
        </style> 
    </head>
    <body onload="init();consMapAdm('<?php echo $x; ?>','<?php echo $y; ?>');">
        <div class="row-fluid">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-center" aalign="center"> 
                            <li class="active">
                                Posición
                            </li>
                        </ul>
                    </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
            </div><!-- /.navbar -->
        </div><!-- /.navbar -->

        <div id="map" class="soloborde">
        </div>

        <footer id="footer" style="margin-top: 10%;position: relative;">
            <div class="container">
                <div class="row">
                    <div class="span3 col">
                        <div class="block contact-block">
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
        <script src="../../librerias/wrap/bootstrap.min.js"></script> 
        <script src="../../librerias/bootstrap-carousel.js"></script>
        <script src="../../librerias/bootstrap-typeahead.js"></script>
    </body>
</html>
