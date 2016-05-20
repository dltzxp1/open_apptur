<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
            <link rel="stylesheet" href="aplicacion/librerias/cap_files/jquery.css"/>
            <link rel="stylesheet" href="aplicacion/librerias/cap_files/motionCaptcha.css"/>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
            <style>
                body{
                    background: white;
                }
                #soloborde{
                    box-shadow: 2px 2px 5px Rgba(0, 0, 0, 0.5);
                    -webkit-box-shadow: 2px 2px 5px Rgba(0, 0, 0, 0.5);
                    -moz-box-shadow: 2px 2px 5px Rgba(0, 0, 0, 0.5);
                    -webkit-border-top-left-radius: 5px;
                    -webkit-border-top-right-radius: 5px;
                    -moz-border-radius-topleft: 5px;
                    -moz-border-radius-topright: 5px;
                    border-top-left-radius: 5px;
                    border-top-right-radius: 5px;
                    -webkit-border-bottom-right-radius: 5px;
                    -webkit-border-bottom-left-radius: 5px;
                    -moz-border-radius-bottomright: 5px;
                    -moz-border-radius-bottomleft: 5px;
                    border-bottom-right-radius: 5px;
                    border-bottom-left-radius: 5px;
                } 

                .soloborde{
                    box-shadow: 2px 2px 5px Rgba(0, 0, 0, 0.5);
                    -webkit-box-shadow: 2px 2px 5px Rgba(0, 0, 0, 0.5);
                    -moz-box-shadow: 2px 2px 5px Rgba(0, 0, 0, 0.5);
                    -webkit-border-top-left-radius: 5px;
                    -webkit-border-top-right-radius: 5px;
                    -moz-border-radius-topleft: 5px;
                    -moz-border-radius-topright: 5px;
                    border-top-left-radius: 5px;
                    border-top-right-radius: 5px;
                    -webkit-border-bottom-right-radius: 5px;
                    -webkit-border-bottom-left-radius: 5px;
                    -moz-border-radius-bottomright: 5px;
                    -moz-border-radius-bottomleft: 5px;
                    border-bottom-right-radius: 5px;
                    border-bottom-left-radius: 5px;
                } 
                #backUp{
                    top:0px;
                    position: fixed;
                    display: block;
                    z-index:0;
                    width: 100%;
                    height: 28%;   
                    /*background: #3d3d3d;*/
                    /*background: #97c000;*/
                    background: red;
                    border-bottom: white solid 1px;
                }
                /*
                .error{
                    background-color: #93BC0C;
                    padding: 6px 12px;
                    border-radius: 4px;
                    color: black;
                    margin-left: 16px;
                    margin-top: 6px;
                    position: absolute;
                }
    
                .error:before{
                    content: '';
                    border-top: 8px solid transparent;
                    border-bottom: 8px solid transparent;
                    border-right: 8px solid #93BC0C;
                    border-left: 8px solid transparent;
                    left: -16px;
                    position: absolute;
                    top: 5px;
                }*/

            </style>
            <script>
                $(document).ready(function () {
                    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
                    $("#botonn").click(function (){
                        $(".error").remove();		
                        if( $(".us_mail").val() == "" || !emailreg.test($(".us_mail").val())){
                            $(".us_mail").focus().after("<span class='error'>Ingrese un email correcto</span>");
                            return false;
                        }else if( $(".us_clave").val() == ""){
                            $(".us_clave").focus().after("<span class='error'>Ingrese un pass</span>");
                            return false;
                        }else{
                            //alert($(".email").val()+','+$(".pass").val());
                            var parametros = {
                                "us_mail" : $(".us_mail").val(),
                                "us_clave" :$(".us_clave").val()
                            };
                            $.ajax({
                                data: parametros,
                                url: 'aplicacion/controlador/login.php',
                                type: 'post',
                                beforeSend: function () {
                                },
                                success: function (response) {
                                    //&&alert("ss");
                                }
                            });  
                        }
                    });
                    $(".us_mail, .us_clave").keyup(function(){
                        if( $(this).val() != "" ){
                            $(".error").fadeOut();			
                            return false;
                        }		
                    });
                });
            </script>
            <script async="" src="aplicacion/librerias/cap_files/cbgapi.loaded_0"></script>
            <script src="aplicacion/librerias/cap_files/load.js" async="" type="text/javascript"></script>
            <script gapi_processed="true" src="aplicacion/librerias/cap_files/plusone.js" async="" type="text/javascript"> </script>
            <script src="aplicacion/librerias/cap_files/widgets.js" async=""></script>
            <script src="aplicacion/librerias/cap_files/ga.js" async="" type="text/javascript"></script>
            <script src="aplicacion/librerias/cap_files/jquery.js" type="text/javascript"></script>
            <script src="aplicacion/librerias/cap_files/jquery_002.js" type="text/javascript"></script>
            <script src="aplicacion/librerias/cap_files/jquery_003.js"></script>
            <script async="" src="aplicacion/librerias/base.css"></script>

    </head>  
    <body data-twttr-rendered="true">

        <div id="Mod_Theme_Background" class="layout-body-background" style="width: 100%;height: 100%;position: relative;">
            <img class="i-width100p i-height100p" src="aplicacion/vista/img/background.jpg" style="width: 100%;height: 100%">
        </div>

        <div class="container" style="position: absolute; top: 10%;left: 50%;margin-left: -250px;width: 500px;background: dodgerblue;" id="soloborde">
            <form class="mc-active" action="#" method="post" id="formulario">
                <div align="center">  
                    <img src="aplicacion/vista/img/useaar2.png" width="42px" height="42px"/>
                    <?php
                    if (isset($_GET['e'])) {
                        echo "Acceso denegado!!";
                    }
                    ?>
                    <div><input type='text' placeholder="email" name='us_mail' class='us_mail' value='' style="width: 200px;"/></div>
                    <div><input type='password' placeholder="clave" name='us_clave' class='us_clave' value='' style="width: 200px;"/></div>
                </div>

                <div id="mc" style="position: relative;">
                    <p>Dibujar la forma de la caja para enviar el formulario: (<a onclick="window.location.reload()" href="#" title="Click for a new shape">Otra forma!</a>)</p>
                    <canvas class="triangle" height="154" width="220" id="mc-canvas">
                        Su navegador no soporta el elemento canvas - visite en un navegador moderno.
                    </canvas>
                    <input id="mc-action" value="aplicacion/controlador/login.php" type="hidden">
                </div>
                <p><input disabled="disabled" autocomplete="false" value="Login" type="submit" id="botonn"></p>

            </form>
            <div class="clear"></div>
        </div>


        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('#formulario').motionCaptcha({
                    shapes: ['triangle', 'x', 'rectangle', 'circle', 'check', 'zigzag', 'arrow', 'delete', 'pigtail']
                });
                $("input.placeholder").placeholder();
            });
        </script>

        <script type="text/javascript"> 
            // analytics
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-17884149-1']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

            // twitter:
            (function(d, t) {
                var g = d.createElement(t),
                s = d.getElementsByTagName(t)[0];
                g.async = true;
                g.src = 'http://platform.twitter.com/widgets.js';
                s.parentNode.insertBefore(g, s);
            })(document, 'script');

            // google plus:
            window.___gcfg = {lang: 'en-GB'};
            (function() {
                var po = document.createElement('script');
                po.type = 'text/javascript';
                po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0]; 
                s.parentNode.insertBefore(po, s);
            })();
		
            // flattr
            (function() {
                var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
                s.type = 'text/javascript';
                s.async = true;
                s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';
                t.parentNode.insertBefore(s, t);
            })();
        </script>  
    </body>
</html>