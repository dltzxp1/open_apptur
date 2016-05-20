<?php

echo '<div  class="tablaFormInsertCabec"  style="color:black;margin-top:0px;">  &nbsp;Ingresar Provincia   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>";
echo "<table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>         
     <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
     
        <tr><td><strong>Nombre:</strong></td>         <td> <input placeholder='Imbabura' type='text' id='pr_nombre'  /></td>  </tr> 
        <tr><td><strong>Descripción:</strong></td>    <td> <textarea placeholder='Es la provincia más alegre..' style='width:210px;height:150px;' rows='4' cols='26' id='pr_descripcion' value='' ></textarea>  </td></tr>
        <tr><td><strong>Capital:</strong></td>        <td> <input placeholder='Ibarra' type='text' id='pr_capital'  value=''  /></td></tr>
        <tr><td><strong>Población:</strong></td>      <td> <input placeholder='43454' type='text' id='pr_poblacion'  value='' /></tr>
        <tr><td><strong>Región natural:</strong></td> <td> <input placeholder='Sierra' type='text' id='pr_region' value='' /></tr>
    
        </table></td></tr>
    </table>";
echo "
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposProvincia();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_pr' value='0' style='display:none'/> 
    </div>";
?>