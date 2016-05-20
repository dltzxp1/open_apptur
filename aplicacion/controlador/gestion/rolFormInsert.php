<?php
$em_id=$_REQUEST['em_id'];
$us_id=$_REQUEST['us_id'];
echo '<div class="tablaFormInsertCabec">&nbsp;Ingresar Rol   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div  class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>         
     <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
        
        <tr  style='display:none;'><td><strong>EM:</strong></td>           <td> <input type='text' id='ro_em_id' value='$em_id' /></td> </tr>
        <tr  style='display:none;'><td><strong>US:</strong></td>           <td> <input type='text' id='ro_us_id' value='$us_id' /></td> </tr>

        <tr><td><strong>Nombre:</strong></td>       <td> <input placeholder='Administrador' type='text' id='ro_nombre' /></td><td class='detalleForm'> </td> </tr> 
        <tr><td><strong>Descripción:</strong></td>  <td> <textarea placeholder='Tiene acceso hacia..' style='width:200px;height:140px;' rows='4' cols='26' id='ro_descripcion' value='' ></textarea>  </td><td class='detalleForm'></td></tr>
 
        </table></td></tr>
    </table> 
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposRol();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_rol' value='0' style='display:none'/>
    </div>";
?>