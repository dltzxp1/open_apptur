<?php
/* * **************************** */
session_start();
require_once("../../modelo/dao/pantalla.php");

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admcontador.php";
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
        <style>
            .solobordeIng{
                display: block;
                position: absolute;
                background: white; 
                left: 20%;
                width: 60%; 
                height: 4%;
                top: 10%;
            }

            #cabBotones{
                display: block;
                top: 15%; 
                padding-top: 1%;
                position: absolute;
                left:20%; 
                width: 60%; 
                z-index: 100;
                height: 10%;
            }

            #divTabla{
                display: block;
                top: 27%;
                position: absolute;
                left:20%; 
                width: 60%;
                z-index: 40;
                height:65%;
                background: white;
                overflow-y: hidden;
                overflow-x: hidden;
            }


        </style>
        <script>
            window.onload=consContador('0');
        </script>
    </head>
    <body>
        <div class="solobordeIng"  align="center">
            Adminsitración de Contador
        </div>
        <div id="cabBotones">
            <ul class="nav nav-tabs" style="height: auto;">
                <li><a title="Eliminar Contador" href="javascript:delContadorDesdeMenu('chkHijoRol');"><img src="../vista/img/trash.png" /></a></li>                 
            </ul> 
        </div> 

        <div id="divTabla"  ></div>
    </div>  

</div>
</body> 
</html>