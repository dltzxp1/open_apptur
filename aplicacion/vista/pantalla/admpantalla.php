<?php
/* * **************************** */
session_start();
require_once("../../modelo/dao/pantalla.php");

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admpantalla.php";
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


require_once("../../modelo/dao/usuario.php");
require_once("../../modelo/dao/rol.php");
require_once("../../modelo/dao/responsabilidad.php");

$us_id = $_REQUEST['us_id'];
$us_nombre = $_REQUEST['us_nombre'];
$objUsuario = new usuario('', '');
$arrUsuario = $objUsuario->arregloUsuario;

/* $ro_id = $_REQUEST['ro_id'];
  $ro_nombre = $_REQUEST['ro_nombre'];
  $objRol = new rol($us_id, $ro_id);
  $arrRol = $objRol->arregloRol;

  $mo_id = $_REQUEST['mo_id'];
  $mo_nombre = $_REQUEST['mo_nombre'];
  $objModulo = new responsabilidad($us_id, $ro_id, $mo_id);
  $arrModulo = $objModulo->arregloModulo;

 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Tranresponsabilidadnal//EN">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../vista/js/estiloadm.css" />
        <style>
            .solobordeIng{
                display: block;
                position: absolute;
                background: white; 
                width: 30%;
                left: 15%;
                height: 4%;
                top: 10%;
            }

            #cabBotones{
                display: block;
                top: 15%; 
                padding-top: 1%;
                position: absolute;
                z-index: 100;
                height: 20%; 
                left:50%;  
                margin-left: -450px;
                width:900px;
            }

            #divTabla{
                display: block;
                top: 37%;
                position: absolute;
                left:15%; 
                width: 30%;
                z-index: 40;
                height:55%;
                background: white;
            }

            #divFormulario{
                position: absolute;
                top:15%;
                left: 46%; 
                width:40%;
                height: 80%;
                z-index: 50;
            }
        </style>
        <script> 
            window.onload=consPantalla(0,0,0,0,0);
        </script>
    </head> 
    <body>  
        <div class="solobordeIng" style="width: 30%; left: 35%; position: absolute;background: white;" align="center">
            Adminsitración de Pantallas
        </div>
        <div id="cabBotones">
            <ul class="nav nav-tabs" style="margin-left: 30%; height: auto;border-bottom: transparent solid 1px;">
                <li><a title="Edita Pantalla" href="javascript:javascript:activarChkBox('chkHijoRol');consultarPantallasAsignadas();"><img src="../vista/img/edit.png" /></a></li>
                <li><a title="Gurdar Pantalla" href="javascript:javascript:insertarPantallas();DesactivarChkBox();"><img src="../vista/img/guardarPan.png" /></a></li>
            </ul>
            <ul class="nav nav-tabs nav-stacked" style="position: relative;margin-left: 50%;margin-top: -7%;"> 
                <li>
                    <div class="btn-group" style="border-bottom: transparent solid 7px;">
                        <button class="btn" id="us_nombre" style="width: 210px;">Seleccione Usuario</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown" >
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu"  style="left: 0%;">
                            <?php
                            for ($r = 0; $r < count($arrUsuario); $r++) {
                                echo "<li> <a href=\"javascript:selectUsuarioRol_pantalla('" . $arrUsuario[$r]->em_id . "','" . $arrUsuario[$r]->us_id . "','" . $arrUsuario[$r]->us_nombre . "');asignarUsuario('" . $arrUsuario[$r]->us_nombre . "');\">" . $arrUsuario[$r]->us_nombre . "</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="btn-group" style="border-bottom: transparent solid 7px;">
                        <button class="btn" id="ro_nombre" style="width: 210px;">Seleccione Rol </button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dropdown-menu_doble" style="left: 0%;">
                            <li>
                                <a>Seleccione Rol</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="btn-group" style="border-bottom: transparent solid 7px;">
                        <button class="btn" id="re_nombre" style="width: 210px;">Seleccione Responsabilidad </button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dropdown-menu_triple" style="left: 0%;">
                            <li>
                                <a>Seleccione Responsabilidad</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>


        <div id='divTabla' style='top: 37%; height: 60%;left: 50%; margin-left: -450px; width:900px;' ></div>

    </body>
</html>