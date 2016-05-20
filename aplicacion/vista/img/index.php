<?php
require_once("aplicacion/modelo/dao/provincia.php");
require_once("aplicacion/modelo/dao/canton.php");
require_once("aplicacion/modelo/dao/categoria.php");

$objCategoria = new categoria('0');
$arrCategoria = $objCategoria->arregloCategoria;

$arreglo = array();

for ($i = 0; $i < count($arrCategoria); $i++) {
    $arreglo[$i] = $arrCategoria[$i]->cat_nombre;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8"> 
        <title>Portal temático </title> 
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/js/json2.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/js/jquery-1.7.1.min.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/js/jquery-ui-1.8.20.custom.min.js"></script> <!-- for sortable example -->
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/js/jquery.mousewheel.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/prettify/prettify.min.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/select2-master/select24155.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/typeahead/typeahead.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/typeahead/typeahead.min.js"></script>

        <!--<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css"/>
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css"/>-->
        <link rel="stylesheet" type="text/css" href="aplicacion/librerias/bootstrap/css/bootstrap.css" ></link>
        <link rel="stylesheet" type="text/css" href="aplicacion/librerias/bootstrap/css/bootstrap-responsive.css" ></link>

        <link rel="stylesheet" href="aplicacion/librerias/wrap/bootstrap-combined.no-icons.min.css">
        <link rel="stylesheet" href="aplicacion/librerias/wrap/custom.css"> 
        <link rel="stylesheet" href="aplicacion/librerias/theme-style.css">
        <link rel="stylesheet" href="aplicacion/librerias/select2/select2-master/select24155.css"/>

        <script src="http://maps.google.com/maps/api/js?sensor=false&v=3.2"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/vista/js/OpenLayers/OpenLayers.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/vista/js/funcionesGrafico.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/vista/js/jsGrafico.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/vista/js/index.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/vista/usuario/user.js"></script>

        <link rel="stylesheet" href="aplicacion/librerias/index.css" >
        <style>
            body{
                background: white;
            }  
        </style>
    </head>
    <body onload="init();">

        <?php
        require('count.php');
        //echo "SI" . $men;
        ?>
        <!--
        JAIRO MORALES
        DESARROLLADOR WEB
        CODIGOFLOW.NET
        -->

        <header id="header" class="site-header" style="border-bottom: white solid 20px;">
            <div class="container">
                <div class="row-fluid">
                    <div class="span12"> 
                        <div class="header-description">
                            <h2>Publica tu sitio!</h2>
                        </div>
                        <div class="header-features">
                            <div class="row-fluid">
                                <div class="span6 header-feature">
                                    <div class="row-fluid">
                                        <div class="span6" id="">
                                            <p>Regístrate y publica tus sitios Geo-localizados como: Hoteles, Centro educativos, Restaurantes, Deportes, Servicios, Hogar, Oficina, Joyerías, Vestimenta, Regalos, Florería, Artesanías, Eventos y Rutas.</p>
                                        </div>
                                        <div class="span6" id="">
                                            <p>Para recibir más información envíanos tus dudas hacia el correo infor@tursmo.com, y un agente atenderá tu solicitud, para brindarte mas informacón de normas establecidas para administrar la informacion de tu  sitio  </p>
                                        </div>
                                        <div class="span12" style="top: 50px; position: relative;">
                                            <div class="purchase-button">

                                                <a href="login.php">
                                                    <i class="icon-tablet"></i> 
                                                    <img src="aplicacion/vista/img/publicarSitio.png"/> Publicar !</a>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="iphone">
                                        <div class="slider">
                                            <div id="myCarousel" class="carousel slide">
                                                <div class="carousel-inner">
                                                    <div class="item active">
                                                        <img src="aplicacion/vista/img/slider-1.jpg" alt="">
                                                    </div>
                                                    <div class="item">
                                                        <img src="aplicacion/vista/img/slider-2.jpg" alt="">
                                                    </div>
                                                    <div class="item">
                                                        <img src="aplicacion/vista/img/slider-3.jpg" alt="">
                                                    </div>
                                                    <div class="item">
                                                        <img src="aplicacion/vista/img/slider-4.jpg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ol class="carousel-indicators">
                                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#myCarousel" data-slide-to="1"></li>
                                            <li data-target="#myCarousel" data-slide-to="2"></li>
                                            <li data-target="#myCarousel" data-slide-to="3"></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </header>

        <div class="container" style="position: relative;border-bottom: white solid 15px;">
            <div class="row-fluid">
                <div class="span13"> 
                    <div class="notify-wrapper">
                        <div class="notify-inner">
                            <a class="notify" href="#">Aplicativo Movil(Android) .APK!</a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <?php
        require_once("aplicacion/modelo/dao/provincia.php");
        $objProvincia = new provincia('0');
        $arr = $objProvincia->arregloProvincia;
        ?> 

        <div class="navbar  navbar-fixed-top" style=" top: 10%;left: 0%;" id="menuOpciones">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="nav-collapse transparent collapse">

                    <ul class="nav pull-center" style="left: 0%;">
                        <li class="dropdown" style="border:transparent solid 5px;"> 
                            <p style="display: none;">
                                <select style="width:250px" id="selection1">
                                    <?php
                                    for ($i = 0; $i < count($arr); $i++) {
                                        ?>  
                                        <option value='<?php echo $arr[$i]->pr_id ?>'><?php echo $arr[$i]->pr_nombre ?>   </option>
                                        <?php
                                    }
                                    ?>   
                                </select>
                            </p>
                            <p>
                                <select id="e1" class="populate placeholder" placeholder="Seleccione provincia" style="width:250px"></select>
                            </p> 
                        </li>

                        <li class="dropdown" style="border:transparent solid 5px">     
                            <script id="script_e2">
                                $(document).ready(function() {
                                    $("#e2").select2({ 
                                        placeholder: "Seleccione canton"
                                    });
                                    $("#e2").click(function() {
                                        var $selectedOption2 = $('#e2 option:selected'); 
                                        var selectedValue2 = $selectedOption2.val();
                                        document.getElementById("caId").value=selectedValue2;
                                    }
                                );
                                });   
                            </script>

                            <p style="display: none;">Selecicon 2
                                <select  style="width:250px" id="selection2" >
                                </select>
                            </p>
                            <p> 
                                <select id="e2" class="populate placeholder" placeholder="Seleccione Ciudad" style="width:250px"></select>
                            </p> 
                        </li>

                        <li class="dropdown" style="left:10px; ">
                            <div class="bs-docs-example" style="background-color: transparent;" >
                                <input type="text"  placeholder="Buscar" id="catNom" style="width: 200px; height: 20px;margin-top: 5px; " data-provide="typeahead" data-items="7" data-source='<?php echo json_encode($arreglo) ?>'>
                            </div>
                        </li>

                        <li class="dropdown" style="left:30px;">
                            <div class="btn-group" data-toggle="buttons-radio">
                                <button type="button" class='btn btn-inverse' id='botonn' onclick="sitioConsBusqueda();ocultarDiv('map');"><img src="aplicacion/vista/img/rptPlano.png"/>Texto</button>
                                <button type="button" class='btn btn-inverse' id='botonn' onclick="sitioConsMapa();ocultarDiv('rptPlano');"><img src="aplicacion/vista/img/rprGis.png"/>Mapa</button>    
                            </div> 
                        </li>
                        <li class="dropdown" style="left:20px;display: block; " id="arrowLeft">
                            <a href="#" onclick="moverIzq();" ><img src="aplicacion/vista/img/Arrow-Left.png" style="width: 20px;height: 20px;"/> </a> 
                        </li>
                        <li class="dropdown" style="left:20px; display: none;" id="arrowRight" >
                            <a href="#" onclick="moverDer();" ><img src="aplicacion/vista/img/Arrow-Right.png" style="width: 20px;height: 20px;"/> </a> 
                        </li>

                    </ul>
                </div>
            </div>  
        </div>  

        <div id="rptPlano" class="soloborde"></div>
        <div id="map" class="soloborde"></div>

        <div style="display: none; top: 550px;position: absolute;">
            <input type="text" id="prId" style="display: block; "/>
            <input type="text" id="caId" style="display: block;"/> 
            <input type="text" id="catId" style="display: block;"/>
        </div>

        <footer id="footer" style="margin-top: 3%;">
            <div class="container">
                <div class="row">
                    <div class="span3 col">
                        <div class="block contact-block"> 
                            <!--@todo: replace with company contact details-->
                            <h3>Para mayor información</h3>
                            <address>
                                <p><abbr title="Phone"><i class="icon-phone"></i></abbr> 019223 8092344</p>
                                <p><abbr title="Email"><i class="icon-envelope"></i></abbr> info@appstrap.me</p>
                                <p><abbr title="Address"><i class="icon-home"></i></abbr> Ibarra - Ecuador</p>
                            </address>
                        </div>
                    </div>
                    <div class="span4 col">
                        <div class="block newsletter" id="soloborde">
                            <h3>Registrate!</h3>
                            <p>Y publica un tu sitio.</p>
                            <form class="inline">  
                                <table>
                                    <tr><td><strong>Nombre:</strong></td>      <td> <input type='text' placeholder='Pedro' id='us_nombre' onkeyup='return maximaLongitud(this,32)' value=''/></td><td class='detalleForm'> </td></tr>
                                    <tr><td><strong>Apellido:</strong></td>    <td> <input type='text' placeholder='Díaz' id='us_apellido' onkeyup='return maximaLongitud(this,32)' value=''/></td><td class='detalleForm'> </td></tr>
                                    <tr><td><strong>Mail:</strong></td>        <td> <input type='text' placeholder='pedro@hotmail.com' id='us_mail' onkeyup='return maximaLongitud(this,32)' value=''/></td><td class='detalleForm'> </td></tr>
                                    <tr><td><strong>Alias:</strong></td>       <td> <input type='text' placeholder='piter' id='us_alias' onkeyup='return maximaLongitud(this,32)' value=''/></td><td class='detalleForm'> </td></tr>
                                    <tr>
                                        <td></td>
                                        <td><button type="button" class='btn btn-primary' id='botonn' onclick="validarCamposUsuario();"><img src="aplicacion/vista/img/userLogin.png"/>Regístrate</button></td>
                                    </tr>  
                                </table>
                                <div class="alert fade in" id="formularioingreso" style="display: none;"> 
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> <div id="mensaje"></div> </strong>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="span5 col">
                        <div class="block">
                            <h3>Quienes somos</h3>
                            <p>Una empresa que se dedica a realizar portales temáticos, para promocionar un sitios o lugar de interés.!</p>
                        </div>
                    </div>

                </div>
                <div class="row-fluid">
                    <div id="toplink"><a href="#top" class="top-link" title="Back to top">Ir arriba <i class="icon-chevron-up"></i></a></div>
                    <div class="subfooter">
                        <div class="span6">
                            <p>Desarrollado! <a href="#">codigoflow.net</a> | Copyright 2013 Junio</p>
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
        <input type="text" id="verde" value="0"/>
        
        <script src="aplicacion/librerias/wrap/bootstrap.min.js"></script> 
        <script src="aplicacion/librerias/bootstrap-carousel.js"></script>
        <script src="aplicacion/librerias/bootstrap-typeahead.js"></script>
    </body> 
</html>
