<?php

include_once '../../modelo/dao/categoria.php';
$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];

$objCat = new categoria('0');
$arrCat = $objCat->arregloCategoria;

echo '<div class="tablaFormInsertCabec">&nbsp;Ingresar Sitio   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div  class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>
       <tr><td align='center'>
       <table border='0' cellspacing='0px' cellpadding='0px'>
       
        <tr style='display:none;'><td>provincia:</td><td> <input type='text' id='pr_id' value='$pr_id' /></td></tr> 
        <tr style='display:none;'><td>canton:</td><td> <input type='text' id='ca_id' value='$ca_id' /></td></tr>
        
        <tr><td><strong>Categoria</strong></td><td>
                <div class='btn-group' style='width: 200px;position: relative;'>
                    <button class='btn' id='cat_nombre' style='width: 196px;'>Seleccione Categoria</button>
                    <button class='btn dropdown-toggle' data-toggle='dropdown'>
                        <span class='caret'></span>
                    </button>
                    <ul class='dropdown-menu'  style='left:-100px; overflow-x:hidden;overflow-y: auto;height: 300px;'>";
for ($r = 0; $r < count($arrCat); $r++) {
    echo "<li> <a href=\"javascript:asignarCategoria('" . $arrCat[$r]->cat_id . "','" . $arrCat[$r]->cat_nombre . "');\">" . $arrCat[$r]->cat_nombre . "</a></li>";
}
echo "</ul>
                </div>       
                <input type='text' id='cat_id' style='display:none;'/>
       </td>
       </tr>
       
        <tr><td><strong>Nombre</strong>       :</td><td> <input placeholder='Ajavi' type='text' id='si_nombre' /> </td></tr>    
        <tr><td><strong>Descripción</strong>  :</td><td> <textarea placeholder='Es un sitio adecuado..' style='width:200px;height:100px;' size='20' rows='4' cols='26' id='si_descripcion'></textarea></td></tr>
        <tr><td><strong>Web</strong>          :</td><td> <input placeholder='www.hotelajavi.com' type='text' id='si_paginaweb' /> </td></tr>
        <tr><td><strong>Mail</strong>         :</td><td> <input placeholder='reservas@hotelajavi.com' type='text' id='si_mail' /> </td></tr>
        <tr><td><strong>Facebook</strong>     :</td><td> <input placeholder='www.facebook.com/hotel.ajavi'  type='text' id='si_facebook' /> </td></tr>
        <tr><td><strong>Twitter</strong>      :</td><td> <input placeholder='@hotelajavi' type='text' id='si_twitter' /> </td></tr>
        <tr><td><strong>Dirección</strong>    :</td><td> <input placeholder='Avenida Mariano Acosta 16-38' type='text' id='si_direccion' /> </td></tr>
        <tr><td><strong>Teléfono</strong>     :</td><td> <input placeholder='(593) 06 2955-555, 2955-221' type='text' id='si_telefono' /> </td></tr>
        
        </table></td></tr>
     </table>
        
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposSitio();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_sit' value='0' style='display:none'/> 
        
    </div>";
?>