<?php

$pr_id = $_REQUEST['pr_id'];
$ca_id = $_REQUEST['ca_id'];
$cat_id = $_REQUEST['cat_id'];
$si_id = $_REQUEST['si_id'];

echo '<div class="tablaFormInsertCabec">&nbsp;Ingresar Festivo   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div  class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>         
     <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
        <tr style='display:none;'><td>provincia:</td><td> <input type='text' id='pr_id' value='$pr_id' /></td></tr> 
        <tr style='display:none;'><td>canton:</td><td>    <input type='text' id='ca_id' value='$ca_id' /></td></tr>
        <tr style='display:none;'><td>categor:</td><td>   <input type='text' id='cat_id' value='$cat_id' /></td></tr>
        <tr style='display:none;'><td>sitio:</td><td>     <input type='text' id='si_id' value='$si_id' /></td></tr>

        <tr><td><strong>Nombre</strong>        :</td><td> <input placeholder='Fiestas patronales' type='text' id='fe_nombre' onkeyup='return limiteCadena(this,32)'/> </td></tr>    
        <tr><td><strong>Descripción</strong>   :</td><td> <textarea placeholder='En esta fecha.. ' style='width:200px;height:100px;' rows='4' cols='26' id='fe_descripcion' onkeyup='return limiteCadena(this,1255)'></textarea></td></tr>
        
        <tr><td><strong>Fecha Inicio</strong>  :</td> 
        <td> 
            <div id='datetimepicker4' class='input-append'>
                <input data-format='yyyy-MM-dd' type='text' id='fe_fechainicio' readonly></input>
                <span class='add-on'>
                  <i data-time-icon='icon-time' data-date-icon='icon-calendar'>
                  </i>
                </span>
            </div>
            <script type='text/javascript'>
            $(function() {
                $('#datetimepicker4').datetimepicker({
                  pickTime: false,
                  language: 'es'
                });
            });
            </script> 
      </td> 
      </tr> 
        <tr><td><strong>Fecha fin</strong>     :</td>
        <td> 
            <div id='datetimepicker5' class='input-append'>
                <input data-format='yyyy-MM-dd' type='text' id='fe_fechafin' readonly></input>
                <span class='add-on'>
                  <i data-time-icon='icon-time' data-date-icon='icon-calendar'>
                  </i>
                </span>
            </div>
         
            <script type='text/javascript'>
            $(function() {
                $('#datetimepicker5').datetimepicker({
                  pickTime: false,
                  language: 'es'
                });
            });
            </script> 
        </td>
        </tr>
        
        </table></td></tr>
     </table>
        
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposFestivo();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_fes' value='0' style='display:none'/>
    </div>
";
?>