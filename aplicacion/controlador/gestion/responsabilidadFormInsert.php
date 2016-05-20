<?php

$em_id = $_REQUEST['em_id'];
$us_id = $_REQUEST['us_id'];
$ro_id = $_REQUEST['ro_id'];

echo '<div class="tablaFormInsertCabec">&nbsp;Ingresar Responsabilidad   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='0px' cellpadding='0px' align='center'>
        <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
        <tr style='display:none;'><td>EM</td>      <td> <input type='text' id='re_em_id' value='$em_id'/></td></tr>
        <tr style='display:none;'><td>US</td>      <td> <input type='text' id='re_us_id' value='$us_id'/></td></tr>
        <tr style='display:none;'><td>Rol</td>     <td> <input type='text' id='re_ro_id' value='$ro_id'/></td></tr>        
       
        <tr><td><strong>Nombre:</strong></td>       <td> <input placeholder='Crud' type='text' id='re_nombre' /></td></tr>
        <tr><td><strong>Descripción :</strong>      </td><td> <textarea placeholder='Realiza el crud..' style='width:200px;height:140px;' rows='4' cols='26' id='re_descripcion'></textarea></td></tr>
   </table></td></tr>    
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposResponsabilidad();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_resp' value='0' style='display:none'/>
    </div>";
?>