
<?php

include_once '../../modelo/dao/categoria.php';
$objCat = new categoria('0');
$arrCat = $objCat->arregloCategoria;

echo '<div class="tablaFormInsertCabec">&nbsp;Editar Sitio   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
        <table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>
       <tr><td align='center'>
       <table border='0' cellspacing='0px' cellpadding='0px'>
       
        <tr style='display:none;'><td>Pais:</td><td>         <input type='text' id='pr_id' value='" . $_REQUEST['pr_id'] . "' /></td></tr>
        <tr style='display:none;'><td>Usuario:</td><td>      <input type='text' id='ca_id' value='" . $_REQUEST['ca_id'] . "' readonly=readonly/></td></tr>
        <tr style='display:none;'><td>Post:</td><td>         <input type='text' id='si_id' value='" . $_REQUEST['si_id'] . "'  onkeyup='return limiteCadena(this,64)' /></td></tr>   
                
        <tr><td><strong>Categoria</strong>:</td>
        <td><strong> "; 
            if (isset($_REQUEST['cat_id'])) {
                for ($j = 0; $j < count($arrCat); $j++) {
                    if ($arrCat[$j]->cat_id == $_REQUEST['cat_id']) {
                        echo $arrCat[$j]->cat_nombre;
                    }
                }
            }

        echo "</strong> <input type='text' id='cat_id'  value='" . $_REQUEST['cat_id'] . "' style='display:none;'/> 

        </td></tr>
        <tr><td><strong>Nombre</strong>:</td><td>        <input type='text' id='si_nombre' value='" . $_REQUEST['si_nombre'] . "'  /></td></tr>
        <tr><td><strong>Descripción</strong>:</td><td>   <textarea style='width:200px;height:120px;'  size='20' rows='4' cols='26' id='si_descripcion' >" . $_REQUEST['si_descripcion'] . "</textarea> </td></tr>
        <tr><td><strong>Web Site</strong>:</td><td>      <input type='text' id='si_paginaweb' value='" . $_REQUEST['si_paginaweb'] . "' /></td></tr>
        <tr><td><strong>Mail</strong>:</td><td>          <input type='text' id='si_mail' value='" . $_REQUEST['si_mail'] . "' /></td></tr>
        <tr><td><strong>Facebook</strong>:</td><td>      <input type='text' id='si_facebook' value='" . $_REQUEST['si_facebook'] . "'/></td></tr>
        <tr><td><strong>Twitter</strong>:</td><td>       <input type='text' id='si_twitter' value='" . $_REQUEST['si_twitter'] . "' /></td></tr>
        <tr><td><strong>Dirección</strong>:</td><td>     <input type='text' id='si_direccion' value='" . $_REQUEST['si_direccion'] . "' /></td></tr>
        <tr><td><strong>Teléfono</strong>:</td><td>      <input type='text' id='si_telefono' value='" . $_REQUEST['si_telefono'] . "' /></td></tr>
   
         </table></td></tr>
     </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposSitio();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_sit' value='1' style='display:none'/>
    </div>";
?>