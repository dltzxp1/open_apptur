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
        <title>SITIOSECU</title>
        <link href="aplicacion/vista/img/favicon.ico" rel="shortcut icon" type="image/x-icon">

        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/js/json2.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/js/jquery-1.7.1.min.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/js/jquery-ui-1.8.20.custom.min.js"></script> <!-- for sortable example -->
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/js/jquery.mousewheel.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/prettify/prettify.min.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/select2/select2-master/select24155.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/typeahead/typeahead.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/librerias/typeahead/typeahead.min.js"></script>

        <link rel="stylesheet" type="text/css" href="aplicacion/librerias/bootstrap/css/bootstrap.css" ></link>
        <link rel="stylesheet" type="text/css" href="aplicacion/librerias/bootstrap/css/bootstrap-responsive.css" ></link>

        <link rel="stylesheet" href="aplicacion/librerias/wrap/bootstrap-combined.no-icons.min.css">
        <link rel="stylesheet" href="aplicacion/librerias/wrap/custom.css"> 
        <link rel="stylesheet" href="aplicacion/librerias/theme-style.css">

        <link rel="stylesheet" href="aplicacion/librerias/select2/select2-master/select24155.css"/>
        <script src="http://maps.google.com/maps/api/js?sensor=false&v=3.2"></script>

        <script language="javascript" type="text/javascript" src="aplicacion/vista/js/OpenLayers/OpenLayers.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/vista/js/jsGrafico.js"></script>
        <script language="javascript" type="text/javascript" src="aplicacion/vista/js/index.js"></script>
        <link rel="stylesheet" type="text/css" href="aplicacion/librerias/index.css" >

        <style>
            body{
                background: white;
            }  
        </style>
    </head>
    <body onload="init();">

        <!--start: Header -->
        <header> 
            <div class="container"> 
                <div class="navbar">
                    <div class="navbar-inner">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a href="index.php"><img src="aplicacion/vista/smart/img/sitios.png"></a>

                        <a href="" id="efecto"> <img  src="aplicacion/vista/smart/img/search.png" style="height: 60px;width: 60px;cursor: pointer;" title="Buscar Sitios"></a> 

                        <div class="nav-collapse collapse">
                            <ul class="nav">
                                <li class="active dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="ico-color ico-home"></i>Home<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index.php">Pantalla Principal</a></li> 
                                    </ul>
                                </li>
                                <!--<li ><a class="dropdown-toggle" href="precios.php">Precios</a></li> -->
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="ico-color ico-home"></i>Administración<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="login.php">Publicar Sitio</a></li> 
                                        <li><a href="registro.php">Obtener una cuenta</a></li> 
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="ico-color ico-home"></i> APP Android<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="https://play.google.com/store/apps/details?id=com.codigoflow.net&hl=es">Google Play</a></li> 
                                        <li><a href="index.php">Versiones</a></li> 
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <?php
        require_once("aplicacion/modelo/dao/provincia.php");
        $objProvincia = new provincia('0');
        $arr = $objProvincia->arregloProvincia;
        ?> 

        <section id="features" class="features">
            <div class="container"> 
                <div class="row">
                    <div class="navbar">
                        <div class="nav-inner">
                            <ul class="nav pull-center" style="left: 12%;">
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
                                        <button type="button" class='btn btn-primary' id='botonn' onclick="sitioConsBusqueda();ocultarDiv('map');"><img src="aplicacion/vista/img/rptPlano.png"/>Texto</button>
                                        <button type="button" class='btn btn-primary' id='botonn' onclick="sitioConsMapa();ocultarDiv('rptPlano');"><img src="aplicacion/vista/img/rprGis.png"/>Mapa</button>    
                                    </div> 
                                </li> 
                            </ul> 
                        </div>
                    </div> 

                </div>

                <div class="row">
                    <div id="rptPlano" class="container"></div>
                    <div id="map" class="soloborde"></div>
                </div> 
            </div>
        </section>


        <div style="display: none; top: 550px;position: absolute;">
            <input type="text" id="prId" style="display: block; "/>
            <input type="text" id="caId" style="display: block;"/> 
            <input type="text" id="catId" style="display: block;"/>
        </div>

        <footer id="footer" style="margin-top: 3%;" >
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
                            <h3>Registrate!</h3>
                            <p>Para publicar tu Sitio o Lugar TURISTICO.</p>

                        </div>
                    </div>
                    <div class="span5 col">
                        <div class="block">
                            <h3>Quíenes somos</h3>
                            <p>Tesis</p>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div id="toplink"><a href="#top" class="top-link" title="Back to top">Ir arriba <i class="icon-chevron-up"></i></a></div>
                    <div class="subfooter">
                        <div class="span6">
                            <p>Desarrollado! <a href="#">codigoflow.net</a> |  TESÍS</p>
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
        <input type="text" id="verde" value="0" style="display: none;"/>
        <script src="aplicacion/librerias/wrap/bootstrap.min.js"></script> 
        <script src="aplicacion/librerias/bootstrap-carousel.js"></script>
        <script src="aplicacion/librerias/bootstrap-typeahead.js"></script>
    </body> 
</html>
