/*Busqueda Plana*/
$(document).ready(function() {
    var opts=$("#selection1").html();
    opts="<option></option>"+opts;
    $("select.populate").each(function() {
        var e1=$("#e1"); 
        e1.html(e1.hasClass("placeholder")?opts:opts);
    });
    $(".examples article:odd").addClass("zebra"); 
                    
    $("#e1").select2({
        placeholder: "Seleccione provincia"
    });
    $("#e1").click(function() {
        var $selectedOption = $('#e1 option:selected');
        var selectedValue = $selectedOption.val();  // id prov 
        document.getElementById("prId").value=selectedValue;
        $.getJSON('aplicacion/controlador/gestion/selectProvinciaCanton.php', {
            pr_id: selectedValue
        }, function(data) {
            var select2=document.getElementById('selection2'); 
            select2.options.length=0;
            for(i=0;i<data.length;i++)
            {  
                var op=document.createElement("option");   
                op.value = data[i][1];
                op.text = data[i][2];
                select2.appendChild(op); 
            }
            var opts3=$("#selection2").html();
            opts3="<option></option>"+opts3;
            $("select.populate").each(function() {
                $("#e2").select2({ 
                    placeholder: "Seleccione canton"
                });
                var e2=$("#e2"); 
                e2.html(e2.hasClass("placeholder")?opts3:opts3);
            });
            $(".examples article:odd").addClass("zebra");            
        });     
    });
});
 
//-------------------------------------------------------------------------------------------------------------------
function Pagina(nropagina){    
    var parametros = {
        "pag" : nropagina,
        "prId" : $('#prId').val(),
        "caId" : $('#caId').val(),
        "catId" : $('#catId').val()
    };
    $.ajax({
        data: parametros,
        url: 'aplicacion/controlador/gestion/sitioConsBusqueda.php',
        type: 'post',
        beforeSend: function () {
            $("#rptPlano").html("<img  style='width:100%; height:161px' src='aplicacion/vista/img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#rptPlano").html(response);
        }
    });
} 

function imprimeErrorBuscar(mensaje){
    var divFormulario = document.getElementById('divFormulario');
    divFormulario.innerHTML = '\n\
                <div class="alert alert-error">\n\
                 <a class="close" data-dismiss="alert"></a>\n\
                    <strong>'+mensaje+'</strong>\n\
                </div> \n\
                </div>';
    $('#divFormulario').fadeOut(10000);
}

function sitioConsBusqueda(){
    if(!$("#caId").val()){
        imprimeErrorBuscar("Seleccione datos correctos !");
        return;
    }
    mostrarDiv('rptPlano');
    ocultarDiv('map');
    var catNom= $('#catNom').val();  
    var parametros = {
        "catNom" : catNom
    };
    $.ajax({
        data: parametros,
        url: 'aplicacion/controlador/gestion/categoriaNombre.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            document.getElementById('catId').value=response;
            buscarSitio($('#prId').val(),$('#caId').val(),$('#catId').val());
        }
    });
}

function moverIzq(){ 
    document.getElementById("menuOpciones").setAttribute('style','left:200px;width:315px;;top:50%; height:500px;');
    $("#menuOpciones").animate({
        "left": "-=215px"
    }, "slow");
    mostrarDiv("arrowRight");
    ocultarDiv("arrowLeft");
}

function moverDer(){ 
    document.getElementById("menuOpciones").setAttribute('style', 'left:2%;width: 80%;top:50%;');
    $("#menuOpciones").animate({
        "left": "-=10px"
    }, "slow");
    mostrarDiv("arrowLeft");
    ocultarDiv("arrowRight");
}

function buscarSitio(prId,caId,catId){
    var parametros = {
        "prId" : prId,
        "caId" : caId,
        "catId" : catId
    };
    $.ajax({
        data: parametros,
        url: 'aplicacion/controlador/gestion/sitioConsBusqueda.php',
        type: 'post',
        beforeSend: function () {
            $("#rptPlano").html("<img  style='width:100%; height:161px' src='aplicacion/vista/img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#rptPlano").html(response);
        }
    });
}

/*Busqueda mapa*/
function sitioConsMapa(){
    mostrarDiv('map');
    ocultarDiv('rptPlano');
    var catNom= $('#catNom').val();  
    var parametros = {
        "catNom" : catNom
    };
    $.ajax({
        data: parametros,
        url: 'aplicacion/controlador/gestion/categoriaNombre.php',
        type: 'post',
        beforeSend: function () {
            
        },
        success: function (response) {
            document.getElementById('catId').value=response; 
            buscarSitioMapa($('#prId').val(), $('#caId').val(), document.getElementById('catId').value);
        }
    });
}

function buscarSitioMapa(pdId,caId,catId){
    $.getJSON('aplicacion/controlador/gestion/sitioConsBusquedaJson.php', {
        pdId: pdId,
        caId: caId,
        catId: catId
    }, function(data) {
        graFicarbuscarSitioMapa(data);
    }); 
}

function buscHistoria(pr_id,ca_id,cat_id,si_id,si_nombre){ 
    mostrarDiv('rptPlanoDetalle');
    ocultarDiv('map');
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "si_nombre" : si_nombre
    };
    $.ajax({
        data: parametros,
        url: 'aplicacion/controlador/gestion/sitioDetalleBusHist.php',
        type: 'post',
        beforeSend: function () {
            document.getElementById('rptPlanoDetalle').innerHTML = "<br /><br /><br /><img style='width:50px; height:50px'  src='web/php/img/ajax.gif'/> Cargando..";
        },
        success: function (response) {
            document.getElementById('rptPlanoDetalle').innerHTML=response;
        }
    });   
}

function buscYoutube(pr_id,ca_id,cat_id,si_id,si_nombre){ 
    mostrarDiv('rptPlanoDetalle'); 
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "si_nombre" : si_nombre
    };
    $.ajax({
        data: parametros,
        url: 'aplicacion/controlador/gestion/sitioDetalleBusVid.php',
        type: 'post',
        beforeSend: function () {
            document.getElementById('rptPlanoDetalle').innerHTML = "<br /><br /><br /><img style='width:50px; height:50px'  src='web/php/img/ajax.gif'/> Cargando..";
        },
        success: function (response) {
            document.getElementById('rptPlanoDetalle').innerHTML=response;
        }
    });   
}
 
function buscFestivo(pr_id,ca_id,cat_id,si_id,si_nombre){ 
    mostrarDiv('rptPlanoDetalle'); 
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "si_nombre" : si_nombre
    };
    $.ajax({
        data: parametros,
        url: 'aplicacion/controlador/gestion/sitioDetalleBusFest.php',
        type: 'post',
        beforeSend: function () {
            document.getElementById('rptPlanoDetalle').innerHTML = "<br /><br /><br /><img style='width:50px; height:50px'  src='web/php/img/ajax.gif'/> Cargando..";
        },
        success: function (response) {
            document.getElementById('rptPlanoDetalle').innerHTML=response;
        }
    });   
}
 
function buscGastronomia(pr_id,ca_id,cat_id,si_id,si_nombre){
    mostrarDiv('rptPlanoDetalle'); 
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "si_nombre" : si_nombre
    };
    $.ajax({
        data: parametros,
        url: 'aplicacion/modelo/exeg/sitioDetalleBusGas.php',
        type: 'post',
        beforeSend: function () {
            document.getElementById('rptPlanoDetalle').innerHTML = "<br /><br /><br /><img style='width:50px; height:50px'  src='web/php/img/ajax.gif'/> Cargando..";
        },
        success: function (response) {
            document.getElementById('rptPlanoDetalle').innerHTML=response;
        }
    });   
}

function imprimeExito(mensaje){
    var divFormulario = document.getElementById('divFormulario');
    divFormulario.innerHTML = '\n\
                <div class="alert alert-success">\n\
                 <a class="close" data-dismiss="alert">  </a>\n\
                    <strong>'+"<img src='../img/ok.png'/>"+'   '+mensaje+'</strong>\n\
                </div> \n\
                </div>';
}

function imprimeError(mensaje){
    var divFormulario = document.getElementById('divFormulario');
    divFormulario.innerHTML = '\n\
                <div class="alert alert-error">\n\
                 <a class="close" data-dismiss="alert"></a>\n\
                    <strong>'+mensaje+'</strong>\n\
                </div> \n\
                </div>';
}
/*á > &aacute;
é > &eacute;
í > &iacute;
ó > &oacute;
ú > &uacute;
Á > &Aacute;
 */
  
function changeProvincia(id_descripcion){
    document.getElementById('id_descripcion').innerHTML=id_descripcion;
}

/*---------------------------------------CANTON--------------------------------------*/

function asignarProvincia(pr_nombre,pr_id){
    //document.getElementById('pr_nombre').innerHTML=pr_nombre+' &nbsp; <b class="caret">';
    if(pr_nombre.length>=17){
        document.getElementById('pr_nombre').innerHTML=pr_nombre.substring(0, 15)+'.<b class="caret">';
    }else{
        document.getElementById('pr_nombre').innerHTML=pr_nombre.substring(0, 17)+' <b class="caret">';
    }
    document.getElementById('prId').value=pr_id;
}
  
/*SITIOS*/

function verMapa(){
    mostrarDiv('map'); 
}

function cerrarMapa(){
    ocultarDiv('map'); 
   
}

function asignarCanton(ca_nombre,ca_id){
    if(ca_nombre.length>=17){
        document.getElementById('ca_nombre').innerHTML=ca_nombre.substring(0, 15)+'.<b class="caret">';
    }else{
        document.getElementById('ca_nombre').innerHTML=ca_nombre.substring(0, 17)+' <b class="caret">';
    }
    document.getElementById('caId').value = ca_id;
}

function asignarCategoria(cat_id,cat_nombre){
    document.getElementById('cat_nombre').innerHTML = cat_nombre.toString(); 
    document.getElementById('cat_id').value = cat_id.toString(); 
}
  
function asignarSitio(si_nombre){
    document.getElementById('si_nombre').innerHTML = si_nombre.toString();
}

 
function obtenerValores(vector){
    var vec = new Array();
    for ( var i = 0; i < vector.length; i++) {
        vec [i] = document.getElementById(vector[0]).value;
    }
    return vec;
}

function ocultarDiv(div) {
    document.getElementById(div).style.display = 'none';
}

function mostrarDiv(div) {
    document.getElementById(div).style.display = 'block';
}

/*--------------------- Usuarios ---------------------*/
 

/*USUARIOS*/
function validarCamposUsuario(){
    $("#botonn").ready(function (){
        var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/; 
        $(".errorE").remove();
        if($("#us_nombre").val() == ""){
            $("#us_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#us_apellido").val() == "" ){
            $("#us_apellido").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#us_mail").val() == "" || !emailreg.test($("#us_mail").val()) ){
            $("#us_mail").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#us_alias").val() == "" ){
            $("#us_alias").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        } 
        else{ 
            insertUsuario($("#us_nombre").val(),$("#us_apellido").val(),$("#us_mail").val(),$("#us_alias").val());
        }
    });
    
    $("#us_nombre, #us_apellido, #us_mail,#us_alias").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertUsuario(us_nombre,us_apellido,us_mail,us_usuario){
    var parametros = {
        "us_nombre" : us_nombre,
        "us_apellido" : us_apellido,
        "us_mail" : us_mail,
        "us_usuario" : us_usuario
    };
    $.ajax({
        data: parametros,
        url: 'aplicacion/controlador/gestion/IndexusuarioFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            mostrarDiv("formularioingreso");
            document.getElementById('formularioingreso').innerHTML= response;
            $('#formularioingreso').fadeOut(5000);
        }
    });
} 
function sss(){
    alert("sss");
}
//verMapa();ocultarDiv('detailMenu')"