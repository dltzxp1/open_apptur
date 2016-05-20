<?php

echo '<div class="tablaFormInsertCabec">&nbsp;Editar Usuario   <img id="btnSalir" style="position:absolute;left:97.5%;margin-top:1px;" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr><td>&nbsp</td></tr>
            <tr><td>&nbsp</td></tr>
             
            <tr style='display:none;'><td><strong>Empresa:</strong></td><td>             <input type='text' id='em_id' value='" . $_REQUEST['em_id'] . "'   /></td></tr>    
            <tr style='display:none;'><td>Codigo</td><td>          <input type='text' id='us_id' value='" . $_REQUEST['us_id'] . "'   /></td></tr>
            <tr><td><strong>Nombre:</strong></td><td>              <input type='text' id='us_nombre' value='" . $_REQUEST['us_nombre'] . "'   /></td></tr>
            <tr><td><strong>Apellido:</strong></td><td>            <input type='text' id='us_apellido' value='" . $_REQUEST['us_apellido'] . "'   /></td></tr>
            <tr><td><strong>Mail:</strong></td><td>                <input type='text' id='us_mail' value='" . $_REQUEST['us_mail'] . "'   /></td></tr>
            <tr><td><strong>Usuario:</strong></td><td>             <input type='text' id='us_usuario' value='" . $_REQUEST['us_usuario'] . "'  /></td></tr>
            <tr><td><strong>Clave:</strong></td>  <td>             <input type='text' id='us_clave' value='" . $_REQUEST['us_clave2'] . "'/></td> </tr>
            <tr><td><strong>Repita clave:</strong></td>  <td>      <input type='text' id='us_clave_repita' value='" . $_REQUEST['us_clave2'] . "'/></td> </tr>
            <tr><td><strong># Estado:</strong></td>
             <td>
              <div id='msgBox' style='display:none;'>Seleccione un Estado</div>
              ";
                if($_REQUEST['us_estado']=="ACT"){
                    echo  "<input type='radio' name='nameRad' value='ACT' checked  /> Activar";
                    echo  "<input type='radio' name='nameRad' value='DES'/> Desactivar";
                }else{  
                    echo  "<input type='radio' name='nameRad' value='ACT'/> Activar";
                    echo  "<input type='radio' name='nameRad' value='DES' checked /> Desactivar";
                }
            echo "</td>
            </tr>
            <tr><td>&nbsp</td></tr>
            </table></td>
        <td>   
        <table>
         
         <tr><td><strong># Sitios</strong></td><td>        <input type='text' id='us_t_sit' value='" . $_REQUEST['us_t_sit'] . "'    style='width:50px;' /></td></tr>
         <tr><td><strong># Historia</strong></td><td>      <input type='text' id='us_t_his' value='" . $_REQUEST['us_t_his'] . "'    style='width:50px;' /></td></tr>
         <tr><td><strong># Videos</strong></td><td>        <input type='text' id='us_t_vid' value='" . $_REQUEST['us_t_vid'] . "'    style='width:50px;' /></td></tr>
         <tr><td><strong># Fotos</strong></td><td>         <input type='text' id='us_t_fot' value='" . $_REQUEST['us_t_fot'] . "'    style='width:50px;' /></td></tr>
         <tr><td><strong># Festivos</strong></td><td>      <input type='text' id='us_t_fes' value='" . $_REQUEST['us_t_fes'] . "'    style='width:50px;' /></td></tr>
         <tr><td><strong># Gastronomias</strong></td><td>  <input type='text' id='us_t_gas' value='" . $_REQUEST['us_t_gas'] . "'    style='width:50px;' /></td></tr>
         <tr><td><strong># Rutas</strong></td><td>         <input type='text' id='us_t_rut' value='" . $_REQUEST['us_t_rut'] . "'    style='width:50px;' /></td></tr>

        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposUsuario();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_usr' value='1' style='display:none'/>
    </div>";
?> 