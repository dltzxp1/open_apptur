<?php
 
echo '<div class="tablaFormInsertCabec">&nbsp;Editar categoría   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='cat_id' value='" . $_REQUEST['cat_id'] . "'   /></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='cat_nombre' value='" . $_REQUEST['cat_nombre'] . "'  /></td></tr>
            <tr><td><strong>Descripción:</strong></td>    <td><textarea style='width:210px;height:150px;' rows='4' cols='26' id='cat_descripcion' >" . $_REQUEST['cat_descripcion'] . "</textarea> </td></tr>
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposCategoria();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_cat' value='1' style='display:none'/> 
    </div>";
?>