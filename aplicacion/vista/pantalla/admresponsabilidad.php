<?php
/* * **************************** */
session_start();
require_once("../../modelo/dao/pantalla.php");

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admresponsabilidad.php";
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
$objUsuario = new usuario('', '');
$arrUsuario = $objUsuario->arregloUsuario;
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
                width: 35%; 
                z-index: 100;
                height: 8%;
                left: 10%; 
                height: 12%; 
            }

            #divTabla{
                display: block;
                top: 29%;
                position: absolute;
                left:10%; 
                width: 35%;
                z-index: 40;
                height:63%;
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
    </head>
    <body>
        <div class="solobordeIng" align="center">
            Adminsitración de responsabilidades
        </div>
        <div id="cabBotones">
            <ul class="nav nav-tabs" style="height: auto;margin-left: 0%;border-bottom: transparent solid 1px;">
                <li><a title="Agregar Responsabilidad" href="javascript:addResponsabilidad();" ><img src="../vista/img/agregar.png" /></a></li>
                <li><a title="Edita Responsabilidad" href="javascript:editResponsabilidadDesdeMenu('chkHijoRol');"><img src="../vista/img/edit.png" /></a></li>
                <li><a title="Eliminar Responsabilidad" href="javascript:delResponsabilidadDesdeMenu('chkHijoRol');"><img src="../vista/img/trash.png" /></a></li> 
            </ul>   
            <ul class="nav nav-tabs nav-stacked" style="position: relative;margin-left: 50%;margin-top: -16%;"> 
                <li>
                    <div class="btn-group" style="border-bottom: transparent solid 7px;">
                        <button class="btn" id="us_nombre" style="width: 150px;">Seleccione Usuario</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown" >
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu"  style="left: 0%;">
                            <?php
                            for ($r = 0; $r < count($arrUsuario); $r++) {
                                echo "<li> <a href=\"javascript:selectUsuarioRol('" . $arrUsuario[$r]->em_id . "','" . $arrUsuario[$r]->us_id . "','" . '0' . "');asignarUsuario('" . $arrUsuario[$r]->us_nombre . "');\">" . $arrUsuario[$r]->us_nombre . "</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="btn-group" style="border-bottom: transparent solid 7px;">
                        <button class="btn" id="ro_nombre" style="width: 150px;">Seleccione Rol </button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dropdown-menu" style="left: 0%;">
                            <li>
                                <a>Seleccione un Rol</a>
                            </li>
                        </ul>
                    </div>  
                </li>
            </ul>
        </div>

        <div id="divTabla" ></div>
        <div id="divFormulario" class="soloborde">
        </div> 

    </body>
</html>