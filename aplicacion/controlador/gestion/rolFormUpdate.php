<?php

echo '<div class="tablaFormInsertCabec">&nbsp;Editar Rol   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div  class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>         
     <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
        
            <tr style='display:none;'><td>EM:</td><td>                   <input type='text' id='ro_em_id' value='" . $_REQUEST['em_id'] . "' /></td></tr>
            <tr style='display:none;'><td>US:</td><td>                   <input type='text' id='ro_us_id' value='" . $_REQUEST['us_id'] . "' /></td></tr>
            <tr style='display:none;'><td>ROL:</td><td>                  <input type='text' id='ro_id' value='" . $_REQUEST['ro_id'] . "'  /></td></tr>
                
            <tr><td><strong>Nombre:</strong></td><td>                    <input type='text' id='ro_nombre' value='" . $_REQUEST['ro_nombre'] . "' onkeyup='return limiteCadena(this,25)' /></td></tr>
            <tr><td><strong>Descripción:</strong></td><td>            <textarea style='width:200px;height:140px;' rows='4' cols='26' id='ro_descripcion' style='width:200px;height:150px;' onkeyup='return limiteCadena(this,255)' >" . $_REQUEST['ro_descripcion'] . "</textarea> </td></tr> 

            </table></td></tr>
    </table>";
 
echo
        "<button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn'  onclick=\"validarCamposRol();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_rol' value='1' style='display:none'/>
    </div>";
?> 