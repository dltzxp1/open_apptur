
<?php
 
echo '<div class="tablaFormInsertCabec">&nbsp;Editar Foto <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../php/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
        <table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>         
        <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
        <tr><td>&nbsp</td></tr>
        <tr style='display:none;'><td>Pais:</td><td>         <input type='text' id='pr_id' value='" . $_REQUEST['pr_id'] . "' /></td></tr>
        <tr style='display:none;'><td>Usuario:</td><td>      <input type='text' id='ca_id' value='" . $_REQUEST['ca_id'] . "' readonly=readonly/></td></tr>
        <tr style='display:none;'><td>Usuario:</td><td>      <input type='text' id='cat_id' value='" . $_REQUEST['cat_id'] . "' readonly=readonly/></td></tr>
        <tr style='display:none;'><td>Post:</td><td>         <input type='text' id='si_id' value='" . $_REQUEST['si_id'] . "'  onkeyup='return limiteCadena(this,64)' /></td></tr>
        <tr style='display:none;'><td>Post:</td><td>         <input type='text' id='fo_id' value='" . $_REQUEST['fo_id'] . "'  onkeyup='return limiteCadena(this,64)' /></td></tr>
        <tr><td>Nombre:</td><td>        <input type='text' id='fo_nombre' value='" . $_REQUEST['fo_nombre'] . "'  /></td></tr>
        <tr><td>Descripcion:</td><td>   <textarea style='width:200px;height:140px;' rows='4' cols='26' id='fo_descripcion'  >" . $_REQUEST['fo_descripcion'] . "</textarea> </td></tr>
         
        <tr><td>&nbsp</td></tr>
        <tr><td> <button style = 'margin-top:-20px;' class = 'btn btn-success' onclick = \"mostrarDiv('filaCambioImg');\">Cambiar IMG</button><button style = 'margin-top:-20px;' class = 'btn btn-success' onclick = \"ocultarDiv('filaCambioImg');\">X</button></td>
            <td> <img class='FotoView' src='../verImgFoto.php?pr_id=" . $_REQUEST['pr_id'] . "&ca_id=" . $_REQUEST['ca_id'] . "&cat_id=" . $_REQUEST['cat_id'] . "&si_id=" . $_REQUEST['si_id'] . "&fo_id=" . $_REQUEST['fo_id'] . "'/>  </td>
        </tr> 
        
        <tr id='filaCambioImg' style='display:none; position:absolute;'>
            <td><strong>Cargar IMG</strong></td>
            <td><input style='margin-left:25%; font-size:11px;font-family:verdana,tahoma;'  tabindex='6' size='28' type='file' name='fo_img' id='fo_img'/>
            <input style='margin-left:1%;margin-top:1%;  position:absolute;' class='btn btn-success' type='button' value='X' title='Quitar im&#225;gen' onmouseover=\"this.style.cursor='pointer';\" onclick=\"javascript:document.getElementById('fo_img').value='';\" />
            </td>
        </tr>
        <tr><td>&nbsp</td></tr>
        <tr><td>&nbsp</td></tr> 
        <tr><td>&nbsp</td></tr>   

        </table></td></tr>
      </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposFoto();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_fot' value='1' style='display:none'/>
    </div>";
?>