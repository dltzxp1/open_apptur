<?php

echo '<div class="tablaFormInsertCabec">&nbsp;Ingresar categoría   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div  class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>         
     <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'> 
        <tr><td><strong>Nombre:</strong></td>       <td><input placeholder='Destinos Turísticos' type='text' id='cat_nombre' /></td></tr>
        <tr><td><strong>Descripción:</strong></td>  <td><textarea placeholder='Es un lugar muy placentero..' style='width:210px;height:150px;' rows='4' cols='26' id='cat_descripcion'></textarea>  </td></tr>
        <tr><td colspan='2'></td></tr>
        </table></td></tr>
    </table>

        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposCategoria();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_cat' value='0' style='display:none'/>  
        
    </div>";
?>