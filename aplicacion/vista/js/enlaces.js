function validarCamposUsuarioEn(){
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
            insertUsuarioEn($("#us_nombre").val(),$("#us_apellido").val(),$("#us_mail").val(),$("#us_alias").val());
        }
    });
    
    $("#us_nombre, #us_apellido, #us_mail,#us_alias").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertUsuarioEn(us_nombre,us_apellido,us_mail,us_usuario){
    var parametros = {
        "us_nombre" : us_nombre,
        "us_apellido" : us_apellido,
        "us_mail" : us_mail,
        "us_usuario" : us_usuario
    };
    $.ajax({
        data: parametros,
        url: '../../controlador/gestion/IndexusuarioFuncion.php',
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
function verMapa(){
    mostrarDiv('map'); 
}

function cerrarMapa(){
    ocultarDiv('map');
}

function consHisAdm(pr_id,ca_id,cat_id,si_id,hi_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "hi_id" : hi_id
    };
    $.ajax({
        data: parametros,
        url: '../../controlador/gestion/historiaConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#reporte").html("<img  style='width:100%; height:161px' src='../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#reporte").html(response);
        }
    });
} 
    
function PaginHistoriaAdm(nropagina){
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var cat_id= $("#CAT_id").val();
    var si_id= $("#SI_id").val();
    var parametros = {
        "pag" : nropagina,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "hi_id" : 0
    };
    $.ajax({
        data: parametros,
        url: '../../controlador/gestion/historiaConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#reporte").html("<img  style='width:100%; height:161px' src='../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#reporte").html(response);
        }
    });
}

function consVidAdm(pr_id,ca_id,cat_id,si_id,vi_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "vi_id" : vi_id
    };
    $.ajax({
        data: parametros,
        url: '../../controlador/gestion/videoConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#reporte").html("<img  style='width:100%; height:161px' src='../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#reporte").html(response);
        }
    });
} 
    
function PaginVideoAdm(nropagina){
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var cat_id= $("#CAT_id").val();
    var si_id= $("#SI_id").val();
    var parametros = {
        "pag" : nropagina,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "vi_id" : 0
    };
    $.ajax({
        data: parametros,
        url: '../../controlador/gestion/videoConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#reporte").html("<img  style='width:100%; height:161px' src='../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#reporte").html(response);
        }
    });
}

function consFesAdm(pr_id,ca_id,cat_id,si_id,fe_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "fe_id" : fe_id
    };
    $.ajax({
        data: parametros,
        url: '../../controlador/gestion/festivoConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#reporte").html("<img  style='width:100%; height:161px' src='../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#reporte").html(response);
        }
    });
} 
    
function PaginFestivoAdm(nropagina){
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var cat_id= $("#CAT_id").val();
    var si_id= $("#SI_id").val();
    var parametros = {
        "pag" : nropagina,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "fe_id" : 0
    };
    $.ajax({
        data: parametros,
        url: '../../controlador/gestion/festivoConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#reporte").html("<img  style='width:100%; height:161px' src='../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#reporte").html(response);
        }
    });
}
function consRutAdm(pr_id,ca_id,cat_id,si_id,ru_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ru_id" : ru_id
    };
    $.ajax({
        data: parametros,
        url: '../../controlador/gestion/rutaConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#reporte").html("<img  style='width:100%; height:161px' src='../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#reporte").html(response);
        }
    });
} 

function consMapAdm(x,y){
    agregarPunto(x,y);
} 
    
function PaginRutaAdm(nropagina){
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var cat_id= $("#CAT_id").val();
    var si_id= $("#SI_id").val();
    var parametros = {
        "pag" : nropagina,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ru_id" : 0
    };
    $.ajax({
        data: parametros,
        url: '../../controlador/gestion/rutaConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#reporte").html("<img  style='width:100%; height:161px' src='../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#reporte").html(response);
        }
    });
}

function ocultarDiv(div) {
    document.getElementById(div).style.display = 'none';
}

function mostrarDiv(div) {
    document.getElementById(div).style.display = 'block';
}