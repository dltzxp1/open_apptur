<?php

echo '<div class="tablaFormInsertCabec">&nbsp;Editar Provincia   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none'><td>Codigo:</td><td>  <input type='text' id='pr_id' value='" . $_REQUEST['pr_id'] . "' /></td></tr>
            <tr><td><strong>Nombre:</strong></td><td>                    <input type='text' id='pr_nombre' value='" . $_REQUEST['pr_nombre'] . "' /></td></tr>
            <tr><td><strong>Descripción:</strong></td><td>               <textarea style='width:210px;height:150px;' rows='4' cols='26' id='pr_descripcion' style='width:200px;height:150px;'  >" . $_REQUEST['pr_descripcion'] . "</textarea> </td></tr> 
            <tr><td><strong>Capital:</strong></td><td>                   <input type='text' id='pr_capital' value='" . $_REQUEST['pr_capital'] . "' /></td></tr>
            <tr><td><strong>Población:</strong></td><td>                 <input type='text' id='pr_poblacion' value='" . $_REQUEST['pr_poblacion'] . "' /></td></tr>
            <tr><td><strong>Región:</strong></td><td>                    <input type='text' id='pr_region' value='" . $_REQUEST['pr_region'] . "' /></td></tr>
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposProvincia();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_pr' value='1' style='display:none'/>
    </div>";
?> 