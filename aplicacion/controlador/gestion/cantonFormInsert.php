<?php

$PR_id = $_REQUEST['PR_id']; 
echo '<div class="tablaFormInsertCabec">&nbsp;Ingresar Ciudad   <img  style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';

echo "<div class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='0px' cellpadding='0px' align='center'>
        <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
        <tr style='display:none;'><td>PR_id:</td>      <td> <input type='text' id='ca_pr_id' value='$PR_id'/></td></tr>
        <tr><td><strong>Nombre:</strong></td>           <td> <input  placeholder='Ibarra'  type='text' id='ca_nombre' /></td></tr>
        <tr><td><strong>Descripción :</strong></td>     <td> <textarea placeholder='Es un lugar..' style='width:210px;height:150px;' rows='4' cols='26' id='ca_descripcion' ></textarea></td></tr>
        <tr><td><strong>Población:</strong></td>        <td> <input placeholder='5433' type='text' id='ca_poblacion'/></td></tr>
   </table></td></tr>    
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposCanton();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_canton' value='0' style='display:none'/>
    </div>";
?>