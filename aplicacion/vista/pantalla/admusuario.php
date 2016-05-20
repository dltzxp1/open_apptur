<?php
/* * **************************** */
session_start();
require_once("../../modelo/dao/pantalla.php");

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admusuario.php";
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../vista/js/estiloadm.css" />
        <script src="../../ese_files/query.css"></script> 
        <style>
            .solobordeIng{
                display: block;
                position: absolute;
                background: white; 
                width: 30%;
                left: 1%;
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
                left:1%; 
                width: 30%;
                z-index: 10;
                height:65%;
                background: white;
            }

            #divFormulario{
                position: absolute;
                top:15%;
                left: 46%; 
                width:40%;
                height: 74%;
                z-index: 0;
            }

        </style>
        <script> 
            window.onload=consUsuario(0,0);
        </script>
    </head>
    <body>
        <div class="solobordeIng" align="center">
            Adminsitración de Usuarios
        </div>
        <div id="cabBotones" style="left:1%; width: 30%;">
            <ul class="nav nav-tabs" style="height: auto;margin-left: 0%;">
                <li><a title="Agregar Usuario" href="javascript:addUsuario();" ><img src="../vista/img/addUser.png" /></a>  </li>
                <li><a title="Edita Usuario" href="javascript:editUsuarioDesdeMenu('chkHijoRol');"><img src="../vista/img/edit.png" /></a> </li>
                <li><a title="Eliminar Usuario" href="javascript:delUsuarioDesdeMenu('chkHijoRol');"><img src="../vista/img/trash.png" /></a>                 </li>
            </ul>  
        </div>
        <div id="divTabla"></div>
        <div id="divFormulario" class="soloborde" >
        </div>
    </body> 
</html>