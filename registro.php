<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8">
        <title>SITIOSECU</title>

        <link href="aplicacion/vista/img/favicon.ico" rel="shortcut icon" type="image/x-icon">

        <link href="aplicacion/vista/smart/css/bootstrap.css" rel="stylesheet">
        <link href="aplicacion/vista/smart/css/css/bootstrap-responsive.css" rel="stylesheet"> 

        <link rel="stylesheet" href="aplicacion/librerias/wrap/bootstrap-combined.no-icons.min.css">
        <link rel="stylesheet" href="aplicacion/librerias/wrap/custom.css"> 
        <link rel="stylesheet" href="aplicacion/librerias/theme-style.css"> 

        <link href="aplicacion/vista/smart/css/parallax-slider.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="aplicacion/vista/smart/css/nuevoJairo.css">

        <script language="javascript" type="text/javascript" src="aplicacion/vista/js/index.js"></script>
        <link rel="stylesheet" type="text/css" href="aplicacion/librerias/index.css" >

    </head>
    <body>  
        <header>
            <div class="container"> 
                <div class="navbar">
                    <div class="navbar-inner">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>

                        <a href="index.php"> <img src="aplicacion/vista/smart/img/sitios.png"></a> 
                        <a href="buscar.php" id="efecto"> <img  src="aplicacion/vista/smart/img/search.png" style="height: 60px;width: 60px;cursor: pointer;" title="Buscar Sitios"></a>

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

        <!--end: Header-->
        <!-- start: Page Title -->
        <div id="page-title">
            <div id="page-title-inner">
                <div class="container">
                    <h2 style="text-align:center; width: 100%; padding: 10px 0px 5px 0px">Regístrate y pública tu sitio.</h2>
                </div>
            </div>	
        </div>
        <div class="container">
            <div class="row-fluid">
                <div class="lr-page span4 offset4">
                    <div id="register-box">
                        <div class="row-fluid">
                            <div id="login-form" class="span12">
                                <div class="page-title-small">
                                    <h3>Obten tu cuenta Gratis!</h3>
                                </div>
                                <form method="post" action="#">
                                    <div class="well">
                                        <input class="span12" id="us_nombre"  type="text" value="" placeholder="Nombres"/>
                                        <input class="span12" id="us_apellido"  type="text" value="" placeholder="Apellidos"/>
                                        <input class="span12" id="us_mail"  type="text" value="" placeholder="Mai"/>
                                        <input class="span12" id="us_alias"  type="text" value="" placeholder="Alias"/> 
                                    </div>
                                    <div class="actions">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="button" class='btn btn-success' id='botonn' onclick="validarCamposUsuario();"><img src="aplicacion/vista/img/userLogin.png"/>Regístrate</button>
                                    </div>
                                    <div id="formularioingreso" style="display: none;margin-top: 10px;"> 
                                    </div>
                                </form>
                            </div>
                        </div>  
                    </div> 
                </div>	 
            </div>  
        </div> 

        <!-- start: Footer -->
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
                            <h3>Regístrate!</h3>
                            <p>Para publicar tu Sitio o Lugar TURÍSTICO.</p>
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

        <script src="aplicacion/vista/smart/js/jquery-1.9.1.min.js"></script>
        <script src="aplicacion/vista/smart/js/bootstrap.min.js"></script>
        <script src="aplicacion/vista/smart/js/jquery.isotope.min.js"></script>
        <script src="aplicacion/vista/smart/js/jquery.imagesloaded.js"></script>
        <script src="aplicacion/vista/smart/js/flexslider.js"></script>
        <script src="aplicacion/vista/smart/js/carousel.js"></script>
        <script src="aplicacion/vista/smart/js/jquery.cslider.js"></script>
        <script src="aplicacion/vista/smart/js/slider.js"></script>
        <script src="aplicacion/vista/smart/js/jquery.fancybox.js"></script>

        <script src="aplicacion/vista/smart/js/excanvas.js"></script>
        <script src="aplicacion/vista/smart/js/jquery.flot.js"></script>
        <script src="aplicacion/vista/smart/js/jquery.flot.pie.min.js"></script>
        <script src="aplicacion/vista/smart/js/jquery.flot.stack.js"></script>
        <script src="aplicacion/vista/smart/js/jquery.flot.resize.min.js"></script>

        <script src="js/custom.js"></script> 
    </body>

</html>