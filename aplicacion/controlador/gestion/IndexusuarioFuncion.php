<?php

require_once("../../modelo/dao/usuario.php");

$us_nombre = $_REQUEST['us_nombre'];
$us_apellido = $_REQUEST['us_apellido'];
$us_mail = $_REQUEST['us_mail'];
$us_usuario = $_REQUEST['us_usuario'];
$objUsuario = new usuario('0', '0');

if ($objUsuario->insertarIndex($us_nombre, $us_apellido, $us_mail, $us_usuario)) {
    echo '
     <div class="alert alert-success">
                 <a class="close" data-dismiss="alert">  </a>
                    <strong>Usuario Ingresado!</strong>
                </div> 
                </div>';
    exit;
} else {
    echo '<div class="alert alert-error">
                 <a class="close" data-dismiss="alert"></a>
                    <strong>Intente de nuevo!!</strong>
                </div> 
                </div>';
    exit;
}
?>