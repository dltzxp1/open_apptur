<?php

echo '<div class="tablaFormInsertCabec">&nbsp;Ingresar Usuario   <img id="btnSalir" style="position:absolute;left:97.5%;margin-top:1px;" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
        
        <tr style='display:none;'><td><strong>Empresa:</strong></td>         <td> <input type='text' id='em_id' value='1'  /></td> </tr> 
        <tr><td><strong>Nombres:</strong></td>       <td> <input placeholder='Mishell Guadalupe' type='text' id='us_nombre'   value=''/></td></tr>
        <tr><td><strong>Apellidos:</strong></td>     <td> <input placeholder='Aux Morales' type='text' id='us_apellido'   value=''/></td></tr>
        <tr><td><strong>Mail:</strong></td>          <td> <input placeholder='mishel@hotmail.com' type='text' id='us_mail'   value=''/></td></tr>
        <tr><td><strong>Usuarios:</strong></td>      <td> <input placeholder='naser' type='text' id='us_usuario' value=''/></td> </tr>
        <tr><td><strong>Clave:</strong></td>         <td> <input placeholder='****' type='password' id='us_clave'  /></td> </tr>
        <tr><td><strong>Repita clave:</strong></td>  <td> <input placeholder='****' type='password' id='us_clave_repita'  /></td> </tr>
       
        <tr><td><strong>Estado:</strong></td>
           <td>
              <div id='msgBox' style='display:none;'>Seleccione un Estado</div>
                    <input type='radio' name='nameRad' value='ACT' checked/> Activar
                    <input type='radio' name='nameRad' value='DES'/> Desactivar
            </td>
        </tr>
         
        </table></td>
        <td>   
        <table>
        <tr><td><strong># Sitios</strong></td>        <td> <input placeholder='2' type='text' id='us_t_sit' style='width:50px;' /></td>  </tr>
        <tr><td><strong># Historia</strong></td>      <td> <input placeholder='2' type='text' id='us_t_his' style='width:50px;' /></td>  </tr>
        <tr><td><strong># Videos</strong></td>        <td> <input placeholder='2' type='text' id='us_t_vid' style='width:50px;' /></td>  </tr>
        <tr><td><strong># Fotos</strong></td>         <td> <input placeholder='2' type='text' id='us_t_fot' style='width:50px;' /></td>  </tr>
        <tr><td><strong># Festivos</strong></td>      <td> <input placeholder='2' type='text' id='us_t_fes' style='width:50px;' /></td>  </tr>
        <tr><td><strong># Gastronomias</strong></td>  <td> <input placeholder='2' type='text' id='us_t_gas' style='width:50px;'/></td> </tr>
        <tr><td><strong># Rutas</strong></td>         <td> <input placeholder='2' type='text' id='us_t_rut' style='width:50px;'/></td> </tr>
        
 </table></td></tr>
    </table>
    
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposUsuario();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_usr' value='0' style='display:none'/>
    </div>";
?>