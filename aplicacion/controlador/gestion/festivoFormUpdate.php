
<?php

echo '<div class="tablaFormInsertCabec">&nbsp;Editar Festivo   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>
        <tr><td align='center'>
        <table>
        <tr style='display:none;'><td>Pais:</td><td>         <input type='text' id='pr_id' value='" . $_REQUEST['pr_id'] . "' /></td></tr>
        <tr style='display:none;'><td>Usuario:</td><td>      <input type='text' id='ca_id' value='" . $_REQUEST['ca_id'] . "' readonly=readonly/></td></tr>
        <tr style='display:none;'><td>Usuario:</td><td>      <input type='text' id='cat_id' value='" . $_REQUEST['cat_id'] . "' readonly=readonly/></td></tr>
        <tr style='display:none;'><td>Post:</td><td>         <input type='text' id='si_id' value='" . $_REQUEST['si_id'] . "'  onkeyup='return limiteCadena(this,64)' /></td></tr>
        <tr style='display:none;'><td>Post:</td><td>         <input type='text' id='fe_id' value='" . $_REQUEST['fe_id'] . "'  onkeyup='return limiteCadena(this,64)' /></td></tr>
        
        <tr><td>Nombre:</td><td>        <input type='text' id='fe_nombre' value='" . $_REQUEST['fe_nombre'] . "' onkeyup='return limiteCadena(this,64)' /></td></tr>
        <tr><td>Descripción:</td><td>   <textarea style='width:200px;height:140px;' rows='4' cols='26' id='fe_descripcion' onkeyup='return limiteCadena(this,1255)' >" . $_REQUEST['fe_descripcion'] . "</textarea> </td></tr>
         
         
        <tr><td><strong>Fecha Inicio</strong>  :</td> 
        <td> 
            <div id='datetimepicker4' class='input-append'>
                <input data-format='yyyy-MM-dd' type='text' id='fe_fechainicio' value='" . $_REQUEST['fe_fechainicio'] . "' readonly></input>
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
                <input data-format='yyyy-MM-dd' type='text' id='fe_fechafin' value='" . $_REQUEST['fe_fechafin'] . "' readonly></input>
                <span class='add-on'>
                  <i data-time-icon='icon-time' data-date-icon='icon-calendar'>
                  </i>
                </span>
            </div>
         
            <script type='text/javascript'>
            $(function() {
                $('#datetimepicker5').datetimepicker({
                  pickTime: false,
                  language: 'es',
                  dateFormat: 'dd-M-yy'
                });
            });
            </script> 
        </td>
        </tr>
        
      
        </table></td></tr>
      </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposFestivo();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_fes' value='1' style='display:none'/>
    </div>";
?>