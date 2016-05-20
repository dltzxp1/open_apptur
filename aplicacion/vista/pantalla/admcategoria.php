<?php
/* * **************************** */
session_start();
require_once("../../modelo/dao/pantalla.php");

if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admcategoria.php";
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
                height:65%;
                background: white;
                overflow-y: hidden;
                overflow-x: hidden;
            }

            #divFormulario{
                position: absolute;
                top:15%;
                left: 46%; 
                width:40%;
                height: 76%;
                z-index: 1000;
            }
        </style>
        <script> 
            window.onload=consCategoria('0');
        </script>
    </head>
    <body>
        <div class="solobordeIng"  align="center">
            Adminsitración de Categorias
        </div>
        <div id="cabBotones">
            <ul class="nav nav-tabs" style="height: auto;">
                <li><a title="Agregar Categoria" href="javascript:addCategoria();" ><img src="../vista/img/addCategory.png" /></a></li>
                <li><a title="Edita Categoria" href="javascript:editCategoriaDesdeMenu('chkHijoRol');"><img src="../vista/img/edit.png" /></a></li>
                <li><a title="Eliminar Categoria" href="javascript:delCategoriaDesdeMenu('chkHijoRol');"><img src="../vista/img/trash.png" /></a></li>                 
            </ul> 
        </div> 
        <div id="divTabla"  ></div>
        <div id="divFormulario" style="display: none;" class="soloborde">
        </div>  

    </div>
</body> 
</html>