<?php

echo '<div class="tablaFormInsertCabec">&nbsp;Editar Responsabilidad   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='0px' cellpadding='0px' align='center'>
        <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
            <tr style='display:none;'><td>rol:</td><td>           <input type='text' id='re_em_id' value='" . $_REQUEST['em_id'] . "' onkeyup='return limiteCadena(this,8)' /></td></tr>
            <tr style='display:none;'><td>modulo:</td><td>        <input type='text' id='re_us_id' value='" . $_REQUEST['us_id'] . "' onkeyup='return limiteCadena(this,8)' /></td></tr>
            <tr style='display:none;'><td>rol:</td><td>           <input type='text' id='re_ro_id' value='" . $_REQUEST['ro_id'] . "' onkeyup='return limiteCadena(this,8)' /></td></tr>
            <tr style='display:none;'><td>modulo:</td><td>        <input type='text' id='re_re_id' value='" . $_REQUEST['re_id'] . "' onkeyup='return limiteCadena(this,8)' /></td></tr>

            <tr><td><strong>Nombre:</strong></td><td>         <input type='text' id='re_nombre' value='" . $_REQUEST['re_nombre'] . "' /></td></tr>
            <tr><td><strong>Descripción:</strong></td><td>    <textarea style='width:200px;height:140px;' rows='4' cols='26' id='re_descripcion'>" . $_REQUEST['re_descripcion'] . "</textarea> </td></tr>
                
    </table></td></tr> 
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposResponsabilidad();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_resp' value='1' style='display:none'/>
    </div>";
?>