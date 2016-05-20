<?php
/* * **************************** */
session_start();
require_once("../../modelo/dao/pantalla.php");

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admsitio.php";
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

$pr_id = $_REQUEST['pr_id'];
$pr_nombre = $_REQUEST['pr_nombre'];
$objProvincia = new provincia('0');
$arrProvincia = $objProvincia->arregloProvincia;

$ca_id = $_REQUEST['ca_id'];
$ca_nombre = $_REQUEST['ca_nombre'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../vista/js/estiloadm.css" />
    </head> 
    <style>
        .solobordeIng{
            display: block;
            position: absolute;
            background: white; 
            width: 35%;
            left: 10%;
            height: 4%;
            top: 10%;
        }

        #cabBotones{
            display: block;
            top: 15%; 
            padding-top: 1%;
            position: absolute;
            left:10%; 
            width: 35%; 
            z-index: 100;
            height: 10%;
        }

        #divTabla{
            display: block;
            top: 27%;
            position: absolute;
            left:10%; 
            width: 35%;
            z-index: 40;
            height:69%;
            background: white;
            overflow-y: hidden;
            overflow-x: hidden;
        }

        #divFormulario{
            position: absolute;
            top:15%;
            left: 46%; 
            width:40%;
            height: 80%;
            z-index: 0;
        }
    </style>
    <script> 
        window.onload=consSitio(0,0,0);
    </script>
    <body>
        <div class="solobordeIng" align="center">
            Adminsitración de Sitios
        </div>
        <div id="cabBotones">
            <ul class="nav nav-tabs" style="height: auto;margin-left: 0%;">
                <li><a title="Agregar Sitio" href="javascript:establecerCapa();addSitio();verMapa();" ><img src="../vista/img/markerGreen.png" /></a> </li>
                <li><a title="Eliminar Sitio" href="javascript:delSitioDesdeMenu('chkHijoRol');"><img src="../vista/img/trash.png" /></a></li>
                <li> 
                    <div class="btn-group" style="border-bottom: transparent solid 7px;">
                        <button class="btn" id="pr_nombre" style="width: 150px;">Seleccione Provincia</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown" >
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu"  style="left: 0%;">
                            <?php
                            for ($r = 0; $r < count($arrProvincia); $r++) {
                                echo "<li> <a href=\"javascript:selectProvinciaCanton('" . $arrProvincia[$r]->pr_id . "','" . '0' . "');asignarProvincia('" . $arrProvincia[$r]->pr_nombre . "');\">";
                                if (strlen($arrProvincia[$r]->pr_nombre) >= 18) {
                                    echo substr($arrProvincia[$r]->pr_nombre, 0, 18) . '.';
                                } else {
                                    echo $arrProvincia[$r]->pr_nombre;
                                }
                                echo "</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="btn-group" style="border-bottom: transparent solid 7px;z-index: 100;">
                        <button class="btn" id="ca_nombre" style="width: 150px;">Seleccione Ciudad </button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dropdown-menu" style="left: 0%;">
                            <li>
                                <a>Seleccione un Canton</a>
                            </li>
                        </ul>
                    </div>  
                </li>
            </ul>
        </div>

        <div id="divTabla"  ></div>
        <div id="divFormulario" style="display: none;" class="soloborde">
        </div>  

    </body>
</html>