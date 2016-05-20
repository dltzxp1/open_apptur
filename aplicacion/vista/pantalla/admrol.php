<?php
/* * **************************** */
session_start();
require_once("../../modelo/dao/pantalla.php");

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admrol.php";
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
$em_id = "";
$us_id = "";
if (isset($_REQUEST['em_id'])) {
    $em_id = $_REQUEST['em_id'];
    $us_id = $_REQUEST['us_id'];
    $us_nombre = $_REQUEST['us_nombre'];
}

$objUsuario = new usuario('0', '');
$arrUsuario = $objUsuario->arregloUsuario;
//echo "SS :" . count($arrUsuario);
//exit;
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
                z-index: 0;
                height:65%;
                background: white;
            }

            #divFormulario{
                position: absolute;
                top:15%;
                left: 46%; 
                width:40%;
                height: 74%;
                z-index: 1000;
            }

        </style>
    </head>
    <body>
        <div class="solobordeIng"  align="center">
            Adminsitración de Roles
        </div>
        <div id="cabBotones" style="left:10%; width: 35%;"> 
            <ul class="nav nav-tabs" style="height: auto;margin-left: 0%;">
                <li><a title="Agregar Rol" href="javascript:addRol();" ><img src="../vista/img/agregar.png" /></a> </li>
                <li><a title="Edita Rol" href="javascript:editRolDesdeMenu('chkHijoRol');"><img src="../vista/img/edit.png" /></a></li>
                <li><a title="Eliminar Rol" href="javascript:delRolDesdeMenu('chkHijoRol');"><img src="../imgvista/trash.png" /></a></li>
                <li>
                    <div class="btn-group" style="left: 10%;margin-top: 5%;">
                        <button class="btn" id="us_nombre" style="width: 150px;">Seleccione Usuario</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <?php
                            for ($r = 0; $r < count($arrUsuario); $r++) {
                                echo "<li> <a href=\"javascript:consRol('" . $arrUsuario[$r]->em_id . "','" . $arrUsuario[$r]->us_id . "','" . '0' . "');asignarUsuario('" . $arrUsuario[$r]->us_nombre . "')\">" . $arrUsuario[$r]->us_nombre . "</a></li>";
                            }
                            ?>
                        </ul>
                    </div> 
                </li>
        </div>
        <div id="divTabla"  ></div>
        <div id="divFormulario" class="soloborde">
        </div>
    </body>
</html>