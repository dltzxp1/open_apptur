<?php
/* * **************************** */
session_start();
require_once("../../modelo/dao/pantalla.php");

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admvideo.php";
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


require_once("../../modelo/dao/provincia.php");
require_once("../../modelo/dao/canton.php");
require_once("../../modelo/dao/sitio.php");

$pr_id = $_REQUEST['pr_id'];
$pr_nombre = $_REQUEST['pr_nombre'];
$objProvincia = new provincia('0');
$arrProvincia = $objProvincia->arregloProvincia;

$ca_id = $_REQUEST['ca_id'];
$ca_nombre = $_REQUEST['ca_nombre'];
$objCanton = new canton($pr_id, $ca_id);
$arrCanton = $objCanton->arregloCanton;

$si_id = $_REQUEST['si_id'];
$si_nombre = $_REQUEST['si_nombre'];

/* session_start(); 3 REDIRECCION
  $em_id = $_SESSION["emId"];
  $us_id = $_SESSION["usId"];
 */

$objSitio = new sitio($pr_id, $ca_id, $si_id, 0, 0);
$arrSitio = $objSitio->arregloSitio;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../vista/js/estiloadm.css" />
        <style>
            .solobordeIng{
                display: block;
                position: absolute;
                background: white; 
                width: 35%;
                left: 13%;
                height: 4%;
                top: 10%;
            }

            #cabBotones{
                display: block;
                top: 15%; 
                padding-top: 1%;
                position: absolute;
                left:13%; 
                width: 35%; 
                z-index: 400;
                height: 20%;
            }

            #divTabla{
                display: block;
                top: 37%;
                position: absolute;
                left:13%; 
                width: 35%;
                z-index: 40;
                height:55%;
                background: white;
            }

            #divFormulario{
                position: absolute;
                top:15%;
                left: 50%; 
                width:40%;
                height: 80%;
                z-index: 50;
            }
        </style>
        <script> 
            window.onload=consVideo(0,0,0,0,0);
        </script>
    </head> 
    <body>
        <div class="solobordeIng"  align="center">
            Adminsitración de Video
        </div>
        <div id="cabBotones"> 
            <ul class="nav nav-tabs" style="height: auto;border-bottom: transparent solid 1px;margin-top: 5%;">
                <li><a title="Agregar Video" href="javascript:addVideo();" ><img src="../vista/img/addYoutube.png" /></a></li>
                <li><a title="Edita Video" href="javascript:editVideoDesdeMenu('chkHijoRol');"><img src="../vista/img/edit.png" /></a></li>
                <li><a title="Eliminar Video" href="javascript:delVideoDesdeMenu('chkHijoRol');"><img src="../vista/img/trash.png" /></a></li>
            </ul>

            <ul class="nav nav-tabs nav-stacked" style="position: relative;margin-left: 50%;margin-top: -18%;">
                <li> 
                    <div class="btn-group" style="border-bottom: transparent solid 7px;">
                        <button class="btn" id="pr_nombre" style="width: 150px;">Seleccione Provincia</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown" >
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu"  style="left: 0%;">
                            <?php
                            for ($r = 0; $r < count($arrProvincia); $r++) {
                                echo "<li> <a href=\"javascript:selectProvinciaCanton_tri('" . $arrProvincia[$r]->pr_id . "','" . $arrProvincia[$r]->pr_nombre . "','consVideo');asignarProvincia('" . $arrProvincia[$r]->pr_nombre . "');\">" . $arrProvincia[$r]->pr_nombre . "</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </li>
                <li>

                    <div class="btn-group" style="border-bottom: transparent solid 7px;">
                        <button class="btn" id="ca_nombre" style="width: 150px;">Seleccione Ciudad </button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dropdown-menu_doble" style="left: 0%;">
                            <li>
                                <a>Seleccione una Ciudad</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="btn-group" style="border-bottom: transparent solid 7px;">
                        <button class="btn" id="si_nombre" style="width: 150px;">Seleccione Sitio </button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dropdown-menu_triple" style="left: 0%;overflow-x:hidden;overflow-y: auto;height: 300px;">
                            <li>
                                <a>Seleccione una Sitio</a>
                            </li>
                        </ul>
                    </div> 
                </li>
            </ul>
        </div>
    </div>

    <div id='divTabla'   ></div>
    <div id="divFormulario"   class="soloborde">
    </div>  

</body>
</html>