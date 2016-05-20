
<?php

echo '<div class="tablaFormInsertCabec">&nbsp;Editar video   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>
        <tr><td align='center'>
        <table>
        <tr style='display:none;'><td>Pais:</td><td>         <input type='text' id='pr_id' value='" . $_REQUEST['pr_id'] . "' /></td></tr>
        <tr style='display:none;'><td>Usuario:</td><td>      <input type='text' id='ca_id' value='" . $_REQUEST['ca_id'] . "' readonly=readonly/></td></tr>
        <tr style='display:none;'><td>Usuario:</td><td>      <input type='text' id='cat_id' value='" . $_REQUEST['cat_id'] . "' readonly=readonly/></td></tr>
        <tr style='display:none;'><td>Post:</td><td>         <input type='text' id='si_id' value='" . $_REQUEST['si_id'] . "'/></td></tr>
        <tr style='display:none;'><td>Post:</td><td>         <input type='text' id='vi_id' value='" . $_REQUEST['vi_id'] . "'/></td></tr>
            
        <tr><td>Nombre:</td><td>        <input type='text' id='vi_nombre' value='" . $_REQUEST['vi_nombre'] . "' /></td></tr>
        <tr><td>Descripción:</td><td>   <textarea style='width:200px;height:140px;' rows='4' cols='26' id='vi_descripcion' >" . $_REQUEST['vi_descripcion'] . "</textarea> </td></tr>
        <tr><td>Video:</td><td>        <input type='text' id='vi_url' value='" . $_REQUEST['vi_url'] . "' /></td></tr>
  
        </table></td></tr>
      </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposVideo();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_vid' value='1' style='display:none'/>
    </div>";
?>