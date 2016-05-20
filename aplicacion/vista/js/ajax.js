//-------------------------------------------------------------------------------------------------------------------FUNCIONES GLOBALES
function soportaAjax()
{
    //Navegadores diferentes a IE (Firefox, Netscape, Opera, Safari y Opera)F
    if (window.XMLHttpRequest)
    {
        request=new XMLHttpRequest();
    }
    else if (window.ActiveXObject) //Navegadores IE
    {
        request=new ActiveXObject("Msxml2.XMLHTTP");
        if(!request)
        {
            request=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    
    if(!request)
    {
        alert("Su navegador no permite el uso de todas las funcionalidades de esta aplicaci�n, por lo que podria comportarse de manera inesperada.");
        return false;
    }
    else
    {        
        return true;
    }
}

//http://www.cristalab.com/tutoriales/introduccion-a-ajax-con-php-y-formularios-c165l/

function nuevoAjax()
{ 
    var xmlhttp=false;
    try { 
        // Creación del objeto ajax para navegadores diferentes a Explorer 
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
    }
    catch (e) { 
        // o bien 
        try { 
            // Creación del objet ajax para Explorer 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) { 
            xmlhttp = false; 
        } 
    } 
    
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') { 
        xmlhttp = new XMLHttpRequest(); 
    } 
    return xmlhttp; 
} 

function vistas(url){
    $.ajax({
        url: url,
        type: 'post',
        beforeSend: function () {
            $("#detailMenu").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
        }
    });
}

/* PROVINCIA */

function irProvCiudad(pr_id,pr_nombre){
    var parametros = {
        "pr_id" : pr_id,
        "pr_nombre" : pr_nombre
    };
    $.ajax({
        data: parametros,
        url: '../vista/pantalla/admcanton.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
            consCanton(pr_id, '0');
            asignarProvincia(pr_nombre);
        }
    });
} 

function irProvCiudad(pr_id,pr_nombre){
    var parametros = {
        "pr_id" : pr_id,
        "pr_nombre" : pr_nombre
    };
    $.ajax({
        data: parametros,
        url: '../vista/pantalla/admcanton.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
            consCanton(pr_id, '0');
            asignarProvincia(pr_nombre);
        }
    });
} 

function consProvincia(pr_id){
    var parametros = {
        "pr_id" : pr_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/provinciaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginProvincia(nropagina){
    var parametros = {
        "pag" : nropagina
    };
    $.ajax({
        data: parametros,
        url: 'gestion/provinciaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
      
function addProvincia(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:50px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/provinciaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}  
  
function validarCamposProvincia() {
    var cadena = /^[a-z]+$/;
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#pr_nombre").val() == ""){
            $("#pr_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#pr_nombre").val().length<=4  || $("#pr_nombre").val().length>32 ){
            $("#pr_nombre").focus().after("<span class='errorE'>Ingresar un valor entre [5–32 caracteres]</span>");
            return false;
        }else if($("#pr_descripcion").val() == ""){
            $("#pr_descripcion").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#pr_descripcion").val().length<=4  || $("#pr_descripcion").val().length>500 ){
            $("#pr_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–500 caracteres]</span>");
            return false;
        }else if($("#pr_capital").val() == "" ){
            $("#pr_capital").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#pr_capital").val().length<=4  || $("#pr_capital").val().length>24){
            $("#pr_capital").focus().after("<span class='errorE'>Ingrese un valor [5–24 caracteres]</span>");
            return false;
        }
        else if($("#pr_poblacion").val() == ""){
            $("#pr_poblacion").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#pr_poblacion").val().length<=4  || $("#pr_poblacion").val().length>10){
            $("#pr_poblacion").focus().after("<span class='errorE'>Ingrese un valor [5–10 caracteres]</span>");
            return false;
        } 
        else if(isNaN($("#pr_poblacion").val()) ){
            $("#pr_poblacion").focus().after("<span class='errorE'>Ingresar solo números. </span>");
            return false;
        }else if($("#pr_region").val() == ""){ 
            $("#pr_region").focus().after("<span class='errorE'>Este campo es requerido</span>");
            return false;
        }else if($("#pr_region").val().length<=4  || $("#pr_region").val().length>15){
            $("#pr_region").focus().after("<span class='errorE'>Ingresar un valor entre[5–15 caracteres] </span>");
            return false;
        }else{
            var opcion=$("#opcion_pr").val();
            var pr_id;
            if(opcion==0){
                insertProvincia(opcion,$("#pr_nombre").val(),$("#pr_descripcion").val(),$("#pr_capital").val(),$("#pr_poblacion").val(),$("#pr_region").val()); 
            }else{
                pr_id=$("#pr_id").val();
                updaProvincia(opcion,pr_id,$("#pr_nombre").val(),$("#pr_descripcion").val(),$("#pr_capital").val(),$("#pr_poblacion").val(),$("#pr_region").val());
            }    
        } 
    });
    //if ($("#texto").attr("value").match('^([0-9]*)$')) {
    
    $("#pr_nombre, #pr_descripcion, #pr_capital, #pr_poblacion, #pr_region").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
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

function insertProvincia(opcion,pr_nombre,pr_descripcion,pr_capital,pr_poblacion,pr_region){
    var parametros = {
        "opcion" : opcion,
        "pr_nombre" : pr_nombre,
        "pr_descripcion" : pr_descripcion,
        "pr_capital" : pr_capital,
        "pr_poblacion" : pr_poblacion,
        "pr_region" : pr_region
    };
    $.ajax({
        data: parametros,
        url: 'gestion/provinciaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consProvincia('0'); 
            $('#divFormulario').fadeOut(5000);
        }
    });
}

var strCmd;
var waitseconds;
var timeOutPeriod;
var hideTimer;

function cerrarAuto1Segundo(){
    document.getElementById("msgBox").setAttribute('style', 'display:block;');
    strCmd = "document.getElementById('msgBox').style.display = 'none'";
    waitseconds = 1;
    timeOutPeriod = waitseconds * 1000;
    hideTimer = setTimeout(strCmd, timeOutPeriod);
}    


function cerrarAuto(){
    strCmd = "document.getElementById('divFormulario').style.display = 'none'";
    waitseconds = 2;
    timeOutPeriod = waitseconds * 1000;
    hideTimer = setTimeout(strCmd, timeOutPeriod);
}    

function cerrarAutoMapa(){
    strCmd = "document.getElementById('map').style.display = 'none'";
    waitseconds = 2;
    timeOutPeriod = waitseconds * 1000;
    hideTimer = setTimeout(strCmd, timeOutPeriod);
}    

function updaProvincia(opcion,pr_id,pr_nombre,pr_descripcion,pr_capital,pr_poblacion,pr_region){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "pr_nombre" : pr_nombre,
        "pr_descripcion" : pr_descripcion,
        "pr_capital" : pr_capital,
        "pr_poblacion" : pr_poblacion,
        "pr_region" : pr_region
    };
    $.ajax({
        data: parametros,
        url: 'gestion/provinciaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consProvincia('0');
        }
    });
}

function selecAllChkBox(chkBoxPadreId, chkBoxHijosName) {
    var arrChkBoxHijos = document.getElementsByName(chkBoxHijosName);
    var chkPadre = document.getElementById(chkBoxPadreId); 
    /* accedo solo al  elemento del  Padre */
    for (i = 0; i < arrChkBoxHijos.length; i++)
        if (chkPadre.checked)
            arrChkBoxHijos[i].checked = true;
        else
            arrChkBoxHijos[i].checked = 0;
}

function deselecChkPadre(chkBoxPadreId) {
    document.getElementById(chkBoxPadreId).checked = 0;
}

function editProvinciaDesdeMenu(chkBoxHijosName) {
    var pr_id, pr_nombre,pr_descripcion,pr_capital,pr_poblacion,pr_region, checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        //pr_id = document.getElementById('pr_id' + i).innerHTML;
        pr_nombre = document.getElementById('pr_nombre' + i).innerHTML;
        pr_descripcion = document.getElementById('pr_descripcion' + i).innerHTML;
        pr_capital= document.getElementById('pr_capital' + i).innerHTML;
        pr_poblacion= document.getElementById('pr_poblacion' + i).innerHTML;
        pr_region= document.getElementById('pr_region' + i).innerHTML; 
        if (arrChkBox[i].checked) {
            editProvincia(arrChkBox[i].id, pr_nombre, pr_descripcion,pr_capital,pr_poblacion,pr_region);
            checkeado = 1;
        }
    }
    if (!checkeado){
        mostrarDiv("divFormulario")
        imprimeError("Seleccione al menos una Provincia !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function editProvincia(pr_id,pr_nombre,pr_descripcion,pr_capital,pr_poblacion,pr_region){
    mostrarDiv("divFormulario");
    var parametros = {
        "pr_id" : pr_id,
        "pr_nombre" : pr_nombre,
        "pr_descripcion" : pr_descripcion,
        "pr_capital" : pr_capital,
        "pr_poblacion" : pr_poblacion,
        "pr_region" : pr_region
    };
    $.ajax({
        data: parametros,
        url: 'gestion/provinciaFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delProvinciaDesdeMenu(chkBoxHijosName) {
    var pr_id,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        if (arrChkBox[i].checked) {
            delProvincia(3,arrChkBox[i].id);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delProvincia(opcion,pr_id){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/provinciaFuncion.php',
        type: 'post',
        success: function () { 
            consProvincia('0'); 
        }
    }); 
}

function changeProvincia(id_descripcion){
    document.getElementById('id_descripcion').innerHTML=id_descripcion;
}

/*---------------------------------------CANTON--------------------------------------*/

function asignarProvincia(pr_nombre){
    if(pr_nombre.length>=18){
        document.getElementById('pr_nombre').innerHTML=pr_nombre.substring(0, 18)+'.';
    }else{
        document.getElementById('pr_nombre').innerHTML=pr_nombre.substring(0, 18);
    } 
}

function consCanton(pr_id,ca_id){ 
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cantonCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginCanton(nropagina){
    var pr_id= $("#PR_id").val();
    var ca_id=0;
    var parametros = {
        "pag" : nropagina,
        "pr_id" : pr_id,
        "ca_id" : ca_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cantonCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
 

function addCanton(){   
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:50px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    var PR_id= $("#PR_id").val();
    var parametros = {
        "PR_id" : PR_id 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cantonFormInsert.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposCanton(){
    var ca_pr_id=  $("#ca_pr_id").val();
    $("#botonn").ready(function (){
        $(".errorE").remove(); 
        if($("#ca_nombre").val() == ""){
            $("#ca_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        } else if($("#ca_nombre").val().length<=4  || $("#ca_nombre").val().length>29){
            $("#ca_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–29 caracteres]</span>");
            return false;
        }else if($("#ca_descripcion").val() == "" ){
            $("#ca_descripcion").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#ca_descripcion").val().length<=4  || $("#ca_descripcion").val().length>500){
            $("#ca_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–500 caracteres]</span>");
            return false;
        } else if($("#ca_poblacion").val() == ""){
            $("#ca_poblacion").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#ca_poblacion").val().length<=4  || $("#ca_poblacion").val().length>10){
            $("#ca_poblacion").focus().after("<span class='errorE'>Ingrese un valor [5–10 caracteres] </span>");
            return false;
        }else if(isNaN($("#ca_poblacion").val()) ){
            $("#ca_poblacion").focus().after("<span class='errorE'>Ingresar solo números. </span>");
            return false;
        }else if(isNaN($("#ca_poblacion").val()) ){
            $("#ca_poblacion").focus().after("<span class='errorE'>Ingresar solo números. </span>");
            return false;
        } else{
            var opcion=$("#opcion_canton").val();// document.getElementById('opcion_pr').value;
            var ca_id;
            if(opcion==0){
                insertCanton(opcion,ca_pr_id,$("#ca_nombre").val(),$("#ca_descripcion").val(),$("#ca_poblacion").val()); 
            }else{
                ca_id=$("#ca_id").val();
                updaCanton(opcion,ca_id,ca_pr_id,$("#ca_nombre").val(),$("#ca_descripcion").val(),$("#ca_poblacion").val());
            }
        }
    });     
    
    $("#ca_nombre, #ca_descripcion, #ca_poblacion").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}

function insertCanton(opcion,ca_pr_id,ca_nombre,ca_descripcion,ca_poblacion){
    establecerCapa();
    var parametros = {
        "opcion" : opcion,
        "ca_pr_id" : ca_pr_id,
        "ca_nombre" : ca_nombre,
        "ca_descripcion" : ca_descripcion,
        "ca_poblacion" : ca_poblacion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cantonFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consCanton(ca_pr_id,'0');
            cerrarAuto(); 
        }
    });
}

function updaCanton(opcion,ca_id,ca_pr_id,ca_nombre,ca_descripcion,ca_poblacion){
    borrarFeatures();
    var parametros = {
        "opcion" : opcion,
        "ca_id" : ca_id,
        "ca_pr_id" : ca_pr_id,
        "ca_nombre" : ca_nombre,
        "ca_descripcion" : ca_descripcion,
        "ca_poblacion" : ca_poblacion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cantonFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consCanton(ca_pr_id, '0');
        }
    });
}

function editCantonDesdeMenu(chkBoxHijosName) {
    var ca_id , ca_nombre,ca_descripcion,ca_poblacion, checkeado;
    checkeado = 0; 
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        ca_id = document.getElementById('ca_id' + i).innerHTML;
        ca_nombre = document.getElementById('ca_nombre' + i).innerHTML;
        ca_descripcion = document.getElementById('ca_descripcion' + i).innerHTML;
        ca_poblacion= document.getElementById('ca_poblacion' + i).innerHTML;
        if (arrChkBox[i].checked) {
            editCanton(arrChkBox[i].id,ca_id,ca_nombre,ca_descripcion,ca_poblacion);
            checkeado = 1;
        }
    }
    if (!checkeado){
        mostrarDiv("divFormulario")
        imprimeError("Seleccione al menos un Ciudad!"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function editCanton(ca_pr_id,ca_id,ca_nombre,ca_descripcion,ca_poblacion){
    mostrarDiv("divFormulario");
    var parametros = {
        "ca_pr_id" : ca_pr_id,
        "ca_id" : ca_id,
        "ca_nombre" : ca_nombre,
        "ca_descripcion" : ca_descripcion,
        "ca_poblacion" : ca_poblacion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cantonFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delCantonDesdeMenu(chkBoxHijosName) {
    var ca_id,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        ca_id = document.getElementById('ca_id' + i).innerHTML;
        if (arrChkBox[i].checked) {
            delCanton(3,arrChkBox[i].id,ca_id);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delCanton(opcion,ca_pr_id,ca_id){  
    var parametros = {
        "opcion" : opcion,
        "ca_pr_id" : ca_pr_id,
        "ca_id" : ca_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/cantonFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
            consCanton(ca_pr_id, '0');
        }
    });     
}

function changeCanton(id_descripcion){
    document.getElementById('id_descripcion').innerHTML=id_descripcion;
}

/* Categoria*/


function consCategoria(cat_id){
    var parametros = {
        "cat_id" : cat_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/categoriaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginCategoria(nropagina){ 
    var cat_id=0;
    var parametros = {
        "pag" : nropagina,
        "cat_id":cat_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/categoriaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function consContador(id){
    var parametros = {
        "id" : id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/contadorCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 
 
function PaginContador(nropagina){
    var id=0;
    var parametros = {
        "pag" : nropagina,
        "id" : id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/contadorCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function delContadorDesdeMenu(chkBoxHijosName) {
    var cat_id,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        //pr_id = document.getElementById('pr_id' + i).innerHTML; 
        if (arrChkBox[i].checked) {
            delContador(3,arrChkBox[i].id);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delContador(opcion,id){
    var parametros = {
        "opcion" : opcion,
        "id" : id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/contadorFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consContador('0');
        }
    });
}

function addCategoria(){
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:50px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
     
    $.ajax({
        url: 'gestion/categoriaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposCategoria(){
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#cat_nombre").val() == ""){
            $("#cat_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#cat_nombre").val().length<=4  || $("#cat_nombre").val().length>45){
            $("#cat_nombre").focus().after("<span class='errorE'>Ingrese un valor entre[5–45 caracteres]</span>");
            return false;
        }
        else if($("#cat_descripcion").val() == "" ){
            $("#cat_descripcion").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#cat_descripcion").val().length<=4  || $("#cat_descripcion").val().length>255){
            $("#cat_descripcion").focus().after("<span class='errorE'>Ingrese un valor entre[5–255 caracteres]</span>");
            return false;
        }
        
        else{
            var opcion=$("#opcion_cat").val();
            var cat_id;
            if(opcion==0){
                insertCategoria(opcion,$("#cat_nombre").val(),$("#cat_descripcion").val());
            }else{
                cat_id=$("#cat_id").val();
                updaCategoria(opcion,cat_id,$("#cat_nombre").val(),$("#cat_descripcion").val());
            }
        }
    });
    
    $("#cat_nombre, #cat_descripcion").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}

function insertCategoria(opcion,cat_nombre,cat_descripcion){
    var parametros = {
        "opcion" : opcion,
        "cat_nombre" : cat_nombre,
        "cat_descripcion" : cat_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/categoriaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consCategoria('0');
            cerrarAuto();
        }
    });
}

function updaCategoria(opcion,cat_id,cat_nombre,cat_descripcion){
    var parametros = {
        "opcion" : opcion,
        "cat_id" : cat_id,
        "cat_nombre" : cat_nombre,
        "cat_descripcion" : cat_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/categoriaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consCategoria('0');
        }
    }); 
}

function editCategoriaDesdeMenu(chkBoxHijosName) {
    var cat_id, cat_nombre,cat_descripcion,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        //cat_id = document.getElementById('cat_id' + i).innerHTML;
        cat_nombre = document.getElementById('cat_nombre' + i).innerHTML;
        cat_descripcion = document.getElementById('cat_descripcion' + i).innerHTML;
        if (arrChkBox[i].checked) {
            editCategoria(arrChkBox[i].id, cat_nombre, cat_descripcion);
            checkeado = 1;
        }
    }
    if (!checkeado){
        mostrarDiv("divFormulario")
        imprimeError("Seleccione al menos un Categoria !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function editCategoria(cat_id,cat_nombre,cat_descripcion){
    mostrarDiv("divFormulario");
    var parametros = {
        "cat_id" : cat_id,
        "cat_nombre" : cat_nombre,
        "cat_descripcion" : cat_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/categoriaFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delCategoriaDesdeMenu(chkBoxHijosName) {
    var cat_id,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        //pr_id = document.getElementById('pr_id' + i).innerHTML; 
        if (arrChkBox[i].checked) {
            delCategoria(3,arrChkBox[i].id);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delCategoria(opcion,cat_id){
    var parametros = {
        "opcion" : opcion,
        "cat_id" : cat_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/categoriaFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
            consCategoria('0');
        }
    });
}

/*SITIOS*/

function verMapa(){
    mostrarDiv('head_map');
    mostrarDiv('map'); 
}

function cerrarMapa(){
    ocultarDiv('map');
    ocultarDiv('head_map');
}

function asignarCanton(ca_nombre){
    //document.getElementById('ca_nombre').innerHTML = ca_nombre.toString();
    if(ca_nombre.length>=18){
        document.getElementById('ca_nombre').innerHTML=ca_nombre.substring(0, 18)+'.';
    }else{
        document.getElementById('ca_nombre').innerHTML=ca_nombre.substring(0, 18);
    } 
} 

/*function asignarProvincia(pr_nombre){
    if(pr_nombre.length>=18){
        document.getElementById('pr_nombre').innerHTML=pr_nombre.substring(0, 18)+'.';
    }else{
        document.getElementById('pr_nombre').innerHTML=pr_nombre.substring(0, 18);
    } 
}*/

//http://www.helloandroid.com/tutorials/connecting-mysql-database

function irCiudadSitio(pr_id,ca_id,ca_nombre){
    var pr_nombre=document.getElementById('pr_nombre').innerHTML;
    var parametros = {
        "pr_id" : pr_id,
        "pr_nombre" : pr_nombre,
        "ca_id" : ca_id
    };
    $.ajax({
        data: parametros,
        url: '../vista/pantalla/admsitio.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response); 
            selectProvinciaCanton(pr_id, ca_id);
            asignarProvincia(pr_nombre);
            
            consSitio(pr_id, ca_id, '0');
            asignarCanton(ca_nombre);
        }
    });
} 
 

function cambio(){
    document.getElementById('inicio').className = "active";
}


function selectProvinciaCanton(pr_id,ca_id){
    var i=0; 
    var elemento='';
    var texto='';
    var ancla=''; 
    //var encoded = JSON.stringify(data);
    $.getJSON('gestion/selectProvinciaCanton.php', {
        pr_id: pr_id,
        ca_id: ca_id
    }, function(data) {
        var ul=document.getElementById('dropdown-menu');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][2]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href',' javascript:consSitio("'+data[i][0]+'","'+data[i][1]+'","'+0+'");asignarCanton("'+data[i][2]+'");');
                ul.appendChild(elemento);
            }
        }
    });
}

function consSitio(pr_id,ca_id,si_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "si_id" : si_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/sitioCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function asignarCategoria(cat_id,cat_nombre){  
    if(cat_nombre.length>=18){
        document.getElementById('cat_nombre').innerHTML=cat_nombre.substring(0, 18)+'.';
    }else{
        document.getElementById('cat_nombre').innerHTML=cat_nombre.substring(0, 18);
    }
    
    document.getElementById('cat_id').value = cat_id; 
}

function PaginSitio(nropagina){
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var si_id= 0;
    var parametros = {
        "pag" : nropagina,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "si_id" : si_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/sitioCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function addSitio(){
    document.getElementById("map").setAttribute('style', 'left:10.5%;display:block; top:100%;width:75%;height:80%;');
    
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:50px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
     
     
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var parametros = {
        "pr_id" : pr_id ,
        "ca_id" : ca_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/sitioFormInsert.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

var objPuntos;
 
function validarCamposSitio(){ 
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    obtenerPunto();
    objPuntos= new js();
    var pr_id=$("#pr_id").val();
    var ca_id=$("#ca_id").val();
    var cat_id=$("#cat_id").val(); 
    
    $("#botonn").ready(function (){
        $("#botonn").ready(function (){
            $(".errorE").remove();
            if($("#cat_id").val() == ""){
                $("#cat_id").focus().after("<span class='errorE'>Seleccione Una categoria </span>");
                return false;
            }
            else if($("#si_nombre").val() == ""){
                $("#si_nombre").focus().after("<span class='errorE'>Este campo es requerido. </span>");
                return false;
            }
            else if($("#si_nombre").val().length<=4  || $("#si_nombre").val().length>32){
                $("#si_nombre").focus().after("<span class='errorE'> Ingrese un valor [5–32 caracteres]</span>");
                return false;
            }
            else if($("#si_descripcion").val() == ""){
                $("#si_descripcion").focus().after("<span class='errorE'>Este campo es requerido.</span>");
                return false;
            }
            else if($("#si_descripcion").val().length<=4  || $("#si_descripcion").val().length>255){
                $("#si_descripcion").focus().after("<span class='errorE'> Ingrese un valor [5–255 caracteres]</span>");
                return false;
            }
            else if($("#si_paginaweb").val() == "" ){
                $("#si_paginaweb").focus().after("<span class='errorE'>Este campo es requerido. </span>");
                return false;
            }
            else if($("#si_paginaweb").val().length<=4  || $("#si_paginaweb").val().length>32){
                $("#si_paginaweb").focus().after("<span class='errorE'> Ingrese un valor [5–32 caracteres]</span>");
                return false;
            }
            else if($("#si_mail").val() == ""){
                $("#si_mail").focus().after("<span class='errorE'>Este campo es requerido. </span>");
                return false;
            }
            else if(!emailreg.test($("#si_mail").val()) ){
                $("#si_mail").focus().after("<span class='errorE'>Ingrese un email válido!.</span>");
                return false;
            }
            else if($("#si_mail").val().length<=4  || $("#si_mail").val().length>32){
                $("#si_mail").focus().after("<span class='errorE'> Ingrese un valor [5–32 caracteres]</span>");
                return false;
            }
            else if($("#si_facebook").val() == ""){
                $("#si_facebook").focus().after("<span class='errorE'>Este campo es requerido.</span>");
                return false;
            }
            else if($("#si_facebook").val().length<=4  || $("#si_facebook").val().length>32){
                $("#si_facebook").focus().after("<span class='errorE'> Ingrese un valor [5–32 caracteres]</span>");
                return false;
            }
            else if($("#si_twitter").val() == "" ){
                $("#si_twitter").focus().after("<span class='errorE'>Este campo es requerido.</span>");
                return false;
            }
            else if($("#si_twitter").val().length<=4  || $("#si_twitter").val().length>23){
                $("#si_twitter").focus().after("<span class='errorE'> Ingrese un valor [5–24 caracteres]</span>");
                return false;
            }
            else if($("#si_direccion").val() == ""){
                $("#si_direccion").focus().after("<span class='errorE'>Este campo es requerido.</span>");
                return false;
            }
            else if($("#si_direccion").val().length<=4  || $("#si_direccion").val().length>54){
                $("#si_direccion").focus().after("<span class='errorE'> Ingrese un valor [5–55 caracteres]</span>");
                return false;
            }
            else if($("#si_telefono").val() == "" ){
                $("#si_telefono").focus().after("<span class='errorE'>Este campo es requerido.</span>");
                return false;
            }
            else if($("#si_telefono").val().length<=4  || $("#si_telefono").val().length>31){
                $("#si_telefono").focus().after("<span class='errorE'> Ingrese un valor [5–32 caracteres]</span>");
                return false;
            }else{
                var opcion=$("#opcion_sit").val();
                if(opcion==0){
                    insertSitio(opcion,pr_id,ca_id,cat_id,$("#si_nombre").val(),$("#si_descripcion").val(),$("#si_paginaweb").val(),$("#si_mail").val(),$("#si_facebook").val(),$("#si_twitter").val(),objPuntos.latitu,objPuntos.longit,$("#si_direccion").val(),$("#si_telefono").val());
                }else{
                    var si_id=$("#si_id").val();
                    updaSitio(opcion,pr_id,ca_id,cat_id,si_id,$("#si_nombre").val(),$("#si_descripcion").val(),$("#si_paginaweb").val(),$("#si_mail").val(),$("#si_facebook").val(),$("#si_twitter").val(),objPuntos.latitu,objPuntos.longit,$("#si_direccion").val(),$("#si_telefono").val());
                }
            }
        });
    });
    $("#cat_id, #si_nombre, #si_descripcion, #si_paginaweb, #si_mail, #si_facebook, #si_twitter").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}         

function insertSitio(opcion,pr_id,ca_id,cat_id,si_nombre,si_descripcion,si_paginaweb,si_mail,si_facebook,si_twitter, lat_x,lon_y,si_direccion,si_telefono){
    establecerCapa();
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_nombre" : si_nombre,
        "si_descripcion" : si_descripcion,
        "si_paginaweb" : si_paginaweb,
        "si_mail" : si_mail,
        "si_facebook" : si_facebook,
        "si_twitter" : si_twitter,  
        "lat_x" : lat_x,
        "lon_y" : lon_y,
        "si_direccion" : si_direccion,
        "si_telefono" : si_telefono
    };
    $.ajax({
        data: parametros,
        url: 'gestion/sitioFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consSitio(pr_id, ca_id, '0');
            cerrarAuto();
            cerrarAutoMapa();
        }
    });
}

function updaSitio(opcion,pr_id,ca_id,cat_id,si_id,si_nombre,si_descripcion,si_paginaweb,si_mail,si_facebook,si_twitter,lat_x,lon_y,si_direccion,si_telefono){
    borrarFeatures();
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "si_nombre" : si_nombre,
        "si_descripcion" : si_descripcion ,
        "si_paginaweb" : si_paginaweb,
        "si_mail" : si_mail,
        "si_facebook" : si_facebook,
        "si_twitter" : si_twitter,
        "lat_x" : lat_x,
        "lon_y" : lon_y,
        "si_direccion" : si_direccion,
        "si_telefono" : si_telefono
    };
    $.ajax({
        data: parametros,
        url: 'gestion/sitioFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consSitio(pr_id, ca_id, '0');
        }
    });
}

function kz(){
    alert("xxDD");
}

function editSitio(pr_id,ca_id,cat_id,si_id,si_nombre,si_descripcion,si_paginaweb,si_mail,si_facebook,si_twitter,si_direccion,si_telefono,si_latitud,si_longitud){
    document.getElementById("map").setAttribute('style', 'left:10.5%;display:block; top:100%;width:75%;height:80%;');
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:50px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    agregarCapaEditar(si_latitud,si_longitud);
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "si_nombre" : si_nombre,
        "si_descripcion" : si_descripcion,
        "si_paginaweb" : si_paginaweb,
        "si_mail" : si_mail,
        "si_facebook" : si_facebook,
        "si_twitter" : si_twitter,
        "si_direccion" : si_direccion,
        "si_telefono" : si_telefono,
        "si_latitud" : si_latitud,
        "si_longitud" : si_longitud
    };
    $.ajax({
        data: parametros,
        url: 'gestion/sitioFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delSitioDesdeMenu(chkBoxHijosName) {
    var pr_id,ca_id,si_id,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        ca_id = document.getElementById('ca_id' + i).innerHTML;
        si_id = document.getElementById('si_id' + i).innerHTML; 
        if (arrChkBox[i].checked) {
            delSitio(3,arrChkBox[i].id,ca_id,si_id);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario");
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delSitio(opcion,pr_id,ca_id,si_id){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "si_id" : si_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/sitioFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
            consSitio(pr_id, ca_id, '0');
        }
    }); 
}

/* FIN SITIO */

function selectProvinciaCanton_tri(pr_id,pr_nombre,consulta){
    var i=0; 
    var elemento='';
    var texto='';
    var ancla=''; 
    //var encoded = JSON.stringify(data);
    $.getJSON('gestion/selectProvinciaCanton.php', {
        pr_id: pr_id,
        pr_nombre: pr_nombre
    }, function(data) {
        var ul=document.getElementById('dropdown-menu_doble');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][2]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href',' javascript:selectCantonSitio_tri("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+consulta+'");asignarCanton("'+data[i][2]+'");');
                ul.appendChild(elemento);
            }
        }
    });
}

function selectCantonSitio_tri(pr_id,ca_id,ca_nombre,consulta){
    var i=0; 
    var elemento='';
    var texto='';
    var ancla=''; 
    //var encoded = JSON.stringify(data);
    $.getJSON('gestion/selectCantonSitio.php', {
        pr_id: pr_id,
        ca_id: ca_id,
        ca_nombre: ca_nombre
    }, function(data) {
        var ul=document.getElementById('dropdown-menu_triple');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][4]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                if(consulta=="consHistoria") {
                    ancla.setAttribute('href',' javascript:consHistoria("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+data[i][3]+'","'+0+'");asignarSitio("'+data[i][4]+'");');
                }
                else if(consulta=="consVideo") {
                    ancla.setAttribute('href',' javascript:consVideo("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+data[i][3]+'","'+0+'");asignarSitio("'+data[i][4]+'");');
                } 
                else if(consulta=="consFoto") {
                    ancla.setAttribute('href',' javascript:consFoto("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+data[i][3]+'","'+0+'");asignarSitio("'+data[i][4]+'");');
                } 
                else if(consulta=="consFestivo") {
                    ancla.setAttribute('href',' javascript:consFestivo("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+data[i][3]+'","'+0+'");asignarSitio("'+data[i][4]+'");');
                } 
                else if(consulta=="consGastronomia") {
                    ancla.setAttribute('href',' javascript:consGastronomia("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+data[i][3]+'","'+0+'");asignarSitio("'+data[i][4]+'");');
                } 
                else if(consulta=="consRuta") {
                    ancla.setAttribute('href',' javascript:consRuta("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+data[i][3]+'","'+0+'");asignarSitio("'+data[i][4]+'");');
                } 
                ul.appendChild(elemento);
            }
        }
    });
}

function asignarSitio(si_nombre){
    if(si_nombre.length>=16){
        document.getElementById('si_nombre').innerHTML=si_nombre.substring(0, 16)+'.';
    }else{
        document.getElementById('si_nombre').innerHTML=si_nombre.substring(0, 16);
    }
}

function consHistoria(pr_id,ca_id,cat_id,si_id,hi_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "hi_id" : hi_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/historiaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function PaginHistoria(nropagina){
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
        url: 'gestion/historiaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function addHistoria(){
    document.getElementById("divFormulario").setAttribute('style', 'left:50%;display:block; top:55px;width: 37%;height:75%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var cat_id= $("#CAT_id").val();
    var si_id= $("#SI_id").val();
    var parametros = {
        "pr_id" : pr_id , 
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/historiaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposHistoria(){ 
    var pr_id=$("#pr_id").val();
    var ca_id=$("#ca_id").val();
    var cat_id=$("#cat_id").val();
    var si_id=$("#si_id").val();
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#hi_nombre").val() == ""){
            $("#hi_nombre").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#hi_nombre").val().length<=4  || $("#hi_nombre").val().length>31){
            $("#hi_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–32 caracteres]</span>");
            return false;
        }else if($("#hi_descripcion").val() == ""){
            $("#hi_descripcion").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#hi_descripcion").val().length<=4  || $("#hi_descripcion").val().length>299){
            $("#hi_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–300 caracteres]</span>");
            return false;
        }
        else{
            var opcion=$("#opcion_his").val();
            if(opcion==0){
                insertHistoria(opcion,pr_id,ca_id,cat_id,si_id,$("#hi_nombre").val(),$("#hi_descripcion").val());
            }else{
                var hi_id=$("#hi_id").val();
                updaHistoria(opcion,pr_id,ca_id,cat_id,si_id,hi_id,$("#hi_nombre").val(),$("#hi_descripcion").val());
            }
        }
    });
    
    $("#hi_nombre, #hi_descripcion").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}         

function insertHistoria(opcion,pr_id,ca_id,cat_id,si_id,hi_nombre,hi_descripcion){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "hi_nombre" : hi_nombre,
        "hi_descripcion" : hi_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/historiaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consHistoria(pr_id, ca_id, cat_id, si_id, '0');
            cerrarAuto();
        }
    });

}

function updaHistoria(opcion,pr_id,ca_id,cat_id,si_id,hi_id,hi_nombre,hi_descripcion){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "hi_id" : hi_id,
        "hi_nombre" : hi_nombre,
        "hi_descripcion" : hi_descripcion 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/historiaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consHistoria(pr_id, ca_id, cat_id, si_id, '0');
        }
    });
}

function editHistoriaDesdeMenu(chkBoxHijosName){
    var pr_id,ca_id,cat_id,si_id,hi_id,hi_nombre,hi_descripcion, checkeado;
    checkeado = 0; 
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {        
        ca_id = document.getElementById('ca_id' + i).innerHTML;
        cat_id = document.getElementById('cat_id' + i).innerHTML;
        si_id= document.getElementById('si_id' + i).innerHTML;
        hi_id = document.getElementById('hi_id' + i).innerHTML;
        hi_nombre = document.getElementById('hi_nombre' + i).innerHTML;
        hi_descripcion = document.getElementById('hi_descripcion' + i).innerHTML;
        if (arrChkBox[i].checked) {
            alert("S1");
            editHistoria(arrChkBox[i].id,ca_id,cat_id,si_id,hi_id,hi_nombre,hi_descripcion);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione una Canton !!");
    }
}

function editHistoria(pr_id,ca_id,cat_id,si_id,hi_id,hi_nombre,hi_descripcion){
    mostrarDiv("divFormulario");    
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "hi_id" : hi_id,
        "hi_nombre" : hi_nombre,
        "hi_descripcion" : hi_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/historiaFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delHistoriaDesdeMenu(chkBoxHijosName) {
    var pr_id,caId,catId,siId,hiId,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        caId = document.getElementById('caId' + i).innerHTML;
        catId = document.getElementById('catId' + i).innerHTML;
        siId = document.getElementById('siId' + i).innerHTML; 
        hiId = document.getElementById('hiId' + i).innerHTML;
        if (arrChkBox[i].checked) {
            delHistoria(3,arrChkBox[i].id,caId,catId,siId,hiId);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delHistoria(opcion,pr_id,ca_id,cat_id,si_id,hi_id){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "hi_id" : hi_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/historiaFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
            consHistoria(pr_id, ca_id, cat_id, si_id, '0');
        }
    }); 
}

/*INICIO VIDEOS*/
 
function consVideo(pr_id,ca_id,cat_id,si_id,vi_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "vi_id" : vi_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/videoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginVideo(nropagina){
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
        url: 'gestion/videoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function addVideo(){
    document.getElementById("divFormulario").setAttribute('style', 'left:50%;display:block; top:55px;width: 37%;height:75%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var cat_id= $("#CAT_id").val();
    var si_id= $("#SI_id").val();
    var parametros = {
        "pr_id" : pr_id , 
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/videoFormInsert.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposVideo(){ 
    var pr_id=$("#pr_id").val();
    var ca_id=$("#ca_id").val();
    var cat_id=$("#cat_id").val();
    var si_id=$("#si_id").val();
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#vi_nombre").val() == ""){
            $("#vi_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false; 
        }
        else if($("#vi_nombre").val().length<=4  || $("#vi_nombre").val().length>28){
            $("#vi_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–29 caracteres]</span>");
            return false;
        }else if($("#vi_descripcion").val() == ""){
            $("#vi_descripcion").focus().after("<span class='errorE'>Este campo es requerido.  </span>");
            return false;
        }
        else if($("#vi_descripcion").val().length<=4  || $("#vi_descripcion").val().length>127){
            $("#vi_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–128 caracteres]</span>");
            return false;
        }else if($("#vi_url").val() == ""){
            $("#vi_url").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#vi_url").val().length<=4  || $("#vi_url").val().length>63){
            $("#vi_url").focus().after("<span class='errorE'>Ingrese un valor [5–64 caracteres]</span>");
            return false;
        }
        else{
            var opcion=$("#opcion_vid").val();
            if(opcion==0){
                insertVideo(opcion,pr_id,ca_id,cat_id,si_id,$("#vi_nombre").val(),$("#vi_descripcion").val(),$("#vi_url").val());
            }else{
                var vi_id=$("#vi_id").val();
                updaVideo(opcion,pr_id,ca_id,cat_id,si_id,vi_id,$("#vi_nombre").val(),$("#vi_descripcion").val(),$("#vi_url").val());
            }
        }
    });
    $("#vi_nombre, #vi_descripcion, #vi_url").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}         

function insertVideo(opcion,pr_id,ca_id,cat_id,si_id,vi_nombre,vi_descripcion,vi_url){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "vi_nombre" : vi_nombre,
        "vi_descripcion" : vi_descripcion,
        "vi_url" : vi_url
    };
    $.ajax({
        data: parametros,
        url: 'gestion/videoFuncion.php',
        type: 'post',
        beforeSend: function () {
        // $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consVideo(pr_id, ca_id, cat_id, si_id, '0');
            cerrarAuto();
        }
    }); 
}

//updaVideo(opcion,pr_id,ca_id,cat_id,si_id,vi_id,$("#vi_nombre").val(),$("#vi_descripcion").val(),$("#vi_url").val());
function updaVideo(opcion,pr_id,ca_id,cat_id,si_id,vi_id,vi_nombre,vi_descripcion,vi_url){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "vi_id" : vi_id,
        "vi_nombre" : vi_nombre,
        "vi_descripcion" : vi_descripcion,
        "vi_url" : vi_url
    };
    $.ajax({
        data: parametros,
        url: 'gestion/videoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consVideo(pr_id, ca_id, cat_id, si_id, '0');
        }
    });
}

function editVideoDesdeMenu(chkBoxHijosName){
    var pr_id,ca_id,cat_id,si_id,vi_id,vi_nombre,vi_descripcion,vi_url, checkeado;
    checkeado = 0; 
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {        
        ca_id = document.getElementById('ca_id' + i).innerHTML;
        cat_id = document.getElementById('cat_id' + i).innerHTML;
        si_id= document.getElementById('si_id' + i).innerHTML;
        vi_id = document.getElementById('vi_id' + i).innerHTML;
        vi_nombre = document.getElementById('vi_nombre' + i).innerHTML;
        vi_descripcion = document.getElementById('vi_descripcion' + i).innerHTML;
        vi_url= document.getElementById('vi_url' + i).innerHTML;
        if (arrChkBox[i].checked) {
            alert("S1");
            editVideo(arrChkBox[i].id,ca_id,cat_id,si_id,vi_id,vi_nombre,vi_descripcion,vi_url);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione una Canton !!");
    }
}

function editVideo(pr_id,ca_id,cat_id,si_id,vi_id,vi_nombre,vi_descripcion,vi_url){
    mostrarDiv("divFormulario");
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "vi_id" : vi_id,
        "vi_nombre" : vi_nombre,
        "vi_descripcion" : vi_descripcion,
        "vi_url" : vi_url
    };
    $.ajax({
        data: parametros,
        url: 'gestion/videoFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function delVideoDesdeMenu(chkBoxHijosName) {
    var pr_id,caId,catId,siId,viId,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        caId = document.getElementById('caId' + i).innerHTML;
        catId = document.getElementById('catId' + i).innerHTML;
        siId = document.getElementById('siId' + i).innerHTML; 
        viId = document.getElementById('viId' + i).innerHTML;
        if (arrChkBox[i].checked) {
            delVideo(3,arrChkBox[i].id,caId,catId,siId,viId);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delVideo(opcion,pr_id,ca_id,cat_id,si_id,vi_id){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "vi_id" : vi_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/videoFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
            consVideo(pr_id, ca_id, cat_id, si_id, '0');
        }
    }); 
}

/*FOTO*/

function consFoto(pr_id,ca_id,cat_id,si_id,fo_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "fo_id" : fo_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/fotoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function addFoto(){
    document.getElementById("divFormulario").setAttribute('style', 'left:50%;display:block; top:55px;width: 37%;height:75%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var cat_id= $("#CAT_id").val();
    var si_id= $("#SI_id").val();
    var parametros = {
        "pr_id" : pr_id , 
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/fotoFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function PaginFoto(nropagina){
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
        "fo_id" : '0'
    };
    $.ajax({
        data: parametros,
        url: 'gestion/fotoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function consFotoAdm(pr_id,ca_id,cat_id,si_id,fo_id){
    //alert("SS");
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "fo_id" : fo_id
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/fotoConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<img  style='width:100%; height:161px' src='../../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    }); 
}

//location.reload();

function closer() {
    var ventana = window.self;
    ventana.opener = window.self;
    ventana.close();
}

function PaginFotoAdm(nropagina){
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
        "fo_id" : 0
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/fotoConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<img  style='width:100%; height:161px' src='../../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    });
}

 
function validarFotos(mensaje){ 
    var divFormulario = document.getElementById('error');
    divFormulario.innerHTML = '\n\
                <div class="alert alert-message">\n\
                 <a class="close" data-dismiss="alert">  </a>\n\
                    <strong>'+"<img src='../img/ok.png'/>"+'   '+mensaje+'</strong>\n\
                </div> \n\
                </div>';
}  
 
function validarCamposFoto(){
        
    var pr_id=$("#pr_id").val();
    var ca_id=$("#ca_id").val();
    var cat_id=$("#cat_id").val();
    var si_id=$("#si_id").val();
    var fo_img = $("#fo_img").val(); 
    
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#fo_nombre").val() == ""){
            $("#fo_nombre").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#fo_descripcion").val() == ""){
            $("#fo_descripcion").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#archivo").val() == ""){
            $("#archivo").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else{
            var opcion=$("#opcion_fot").val();
            if(opcion==0){
                insertFoto(opcion,pr_id,ca_id,cat_id,si_id,$("#fo_nombre").val(),$("#fo_descripcion").val());
            }else{
                var fo_id=$("#fo_id").val();
                updaFoto(opcion,pr_id,ca_id,cat_id,si_id,fo_id,$("#fo_nombre").val(),$("#fo_descripcion").val());
            }
        }
    });
    $("#fo_nombre, #fo_descripcion, #archivo").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
} 


 
function insertFoto(opcion,pr_id,ca_id,cat_id,si_id,fo_nombre,fo_descripcion){
    var inputFileImage = document.getElementById('archivo');
    var file = inputFileImage.files[0];
    var data = new FormData();
    data.append('archivo',file);
    $.ajax({
        url: 'gestion/fotoFuncion.php?opcion='+opcion+'&pr_id='+pr_id+'&ca_id='+ca_id+'&cat_id='+cat_id+'&si_id='+si_id+'&fo_nombre='+fo_nombre+'&fo_descripcion='+fo_descripcion,
        type:'POST',
        contentType:false,
        data:data,
        processData:false, 
        cache:false,
        beforeSend: function () {
        },
        success: function (response) {
            //document.getElementById('xxx').innerHTML=response;
            imprimeExito(response);
            consFoto(pr_id, ca_id, cat_id, si_id, '0');
            cerrarAuto();
        }
    });
    
    
}

function updaFoto(opcion,pr_id,ca_id,cat_id,si_id,fo_id,fo_nombre,fo_descripcion,fo_img){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "fo_id" : fo_id,
        "fo_nombre" : fo_nombre,
        "fo_descripcion" : fo_descripcion,
        "fo_img" : fo_img
    };
    $.ajax({
        data: parametros,
        url: '../modelo/exeg/fotoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consFoto(pr_id, ca_id, cat_id, si_id, '0');
        }
    });
}

function editFotoDesdeMenu(chkBoxHijosName){
    var pr_id,ca_id,cat_id,si_id,vi_id,vi_nombre,vi_descripcion,vi_url, checkeado;
    checkeado = 0; 
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {        
        ca_id = document.getElementById('ca_id' + i).innerHTML;
        cat_id = document.getElementById('cat_id' + i).innerHTML;
        si_id= document.getElementById('si_id' + i).innerHTML;
        vi_id = document.getElementById('vi_id' + i).innerHTML;
        vi_nombre = document.getElementById('vi_nombre' + i).innerHTML;
        vi_descripcion = document.getElementById('vi_descripcion' + i).innerHTML;
        vi_url= document.getElementById('vi_url' + i).innerHTML;
        if (arrChkBox[i].checked) {
            alert("S1");
            editFoto(arrChkBox[i].id,ca_id,cat_id,si_id,vi_id,vi_nombre,vi_descripcion,vi_url);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione una Canton !!");
    }
}

function editFoto(fo_id,fo_nombre,fo_descripcion){
    
    document.frmblob.fo_id.value=fo_id.toString();
    document.frmblob.fo_nombre.value=fo_nombre.toString();
    document.frmblob.fo_descripcion.value=fo_descripcion.toString();
/*mostrarDiv("divFormulario");
    var parametros = {
        "fo_id" : fo_id,
        "fo_descripcion" : fo_descripcion,
        "fo_nombre" : fo_nombre
    };
    $.ajax({
        data: parametros,
        url: 'gestion/fotoFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });*/
}
 
function delFotoDesdeMenu(chkBoxHijosName) {
    var pr_id,caId,catId,siId,foId,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        caId = document.getElementById('caId' + i).innerHTML;
        catId = document.getElementById('catId' + i).innerHTML;
        siId = document.getElementById('siId' + i).innerHTML; 
        foId = document.getElementById('foId' + i).innerHTML;
        if (arrChkBox[i].checked) {
            delFoto(3,arrChkBox[i].id,caId,catId,siId,foId);
            checkeado = 1;
        }
    }
    if(checkeado==0){
        mostrarDiv("divFormulario");
        imprimeError("Seleccione al menos una Provincia !"); 
        $('#divFormulario').fadeOut(4000);
    }else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campos Eliminados!"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delFoto(opcion,pr_id,ca_id,cat_id,si_id,fo_id){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "fo_id" : fo_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/fotoFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consFoto(pr_id, ca_id, cat_id, si_id, '0');
        }
    }); 
}

/*Interfaz ADM*/

function delFotoAdm(opcion,pr_id,ca_id,cat_id,si_id,fo_id){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "fo_id" : fo_id
    };
    //url: '../../../controlador/gestion/fotoConsAdm.php',
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/fotoFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consFotoAdm(pr_id, ca_id, cat_id, si_id, '0');
        }
    }); 
}

/*FESTIVO*/
function consFestivo(pr_id,ca_id,cat_id,si_id,fe_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "fe_id" : fe_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/festivoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginFestivo(nropagina){
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
        url: 'gestion/festivoCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function addFestivo(){
    document.getElementById("divFormulario").setAttribute('style', 'left:50%;display:block; top:55px;width: 37%;height:75%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var cat_id= $("#CAT_id").val();
    var si_id= $("#SI_id").val();
    var parametros = {
        "pr_id" : pr_id , 
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/festivoFormInsert.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposFestivo(){
    var pr_id=$("#pr_id").val();
    var ca_id=$("#ca_id").val();
    var cat_id=$("#cat_id").val();
    var si_id=$("#si_id").val();
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#fe_nombre").val() == ""){
            $("#fe_nombre").focus().after("<span class='errorE'>Seleccione Una categoria </span>");
            return false;
        }
        else if($("#fe_nombre").val().length<=4  || $("#fe_nombre").val().length>31){
            $("#fe_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–32 caracteres]</span>");
            return false;
        }else if($("#fe_descripcion").val() == ""){
            $("#fe_descripcion").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#fe_descripcion").val().length<=4  || $("#fe_descripcion").val().length>99){
            $("#fe_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–100 caracteres]</span>");
            return false;
        }else if($("#fe_fechainicio").val() == ""){
            $("#fe_fechainicio").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#fe_fechafin").val() == ""){
            $("#fe_fechafin").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else{
            var opcion=$("#opcion_fes").val();
            if(opcion==0){
                insertFestivo(opcion,pr_id,ca_id,cat_id,si_id,$("#fe_nombre").val(),$("#fe_descripcion").val(),$("#fe_fechainicio").val(),$("#fe_fechafin").val());
            }else{
                var fe_id=$("#fe_id").val();
                updaFestivo(opcion,pr_id,ca_id,cat_id,si_id,fe_id,$("#fe_nombre").val(),$("#fe_descripcion").val(),$("#fe_fechainicio").val(),$("#fe_fechafin").val());
            }
        }
    });
    $("#fe_nombre, #fe_descripcion, #fe_fechainicio, #fe_fechafin").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}         

function insertFestivo(opcion,pr_id,ca_id,cat_id,si_id,fe_nombre,fe_descripcion,fe_fechainicio,fe_fechafin){
    if (f1meno1f2() == false) {
        imprimeError("Fechas incorrectas! ");
        cerrarAuto();
        return;
    }
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "fe_nombre" : fe_nombre,
        "fe_descripcion" : fe_descripcion,
        "fe_fechainicio" : fe_fechainicio,
        "fe_fechafin" : fe_fechafin
    };
    $.ajax({
        data: parametros,
        url: 'gestion/festivoFuncion.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consFestivo(pr_id, ca_id, cat_id, si_id, '0');
            cerrarAuto();
        }
    });
}

function updaFestivo(opcion,pr_id,ca_id,cat_id,si_id,fe_id,fe_nombre,fe_descripcion,fe_fechainicio,fe_fechafin){
    if (f1meno1f2() == false) {
        imprimeError("Fechas incorrectas! ");
        cerrarAuto();
        return;
    }
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "fe_id" : fe_id,
        "fe_nombre" : fe_nombre,
        "fe_descripcion" : fe_descripcion,
        "fe_fechainicio" : fe_fechainicio,
        "fe_fechafin" : fe_fechafin
    };
    $.ajax({
        data: parametros,
        url: 'gestion/festivoFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consFestivo(pr_id, ca_id, cat_id, si_id, '0');
        }
    });
}

function editFestivoDesdeMenu(chkBoxHijosName){
    var pr_id,ca_id,cat_id,si_id,fe_id,fe_nombre,fe_descripcion,fe_fechainicio,fe_fechafin, checkeado;
    checkeado = 0; 
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {        
        ca_id = document.getElementById('ca_id' + i).innerHTML;
        cat_id = document.getElementById('cat_id' + i).innerHTML;
        si_id= document.getElementById('si_id' + i).innerHTML;
        fe_id = document.getElementById('fe_id' + i).innerHTML;
        fe_nombre = document.getElementById('fe_nombre' + i).innerHTML;
        fe_descripcion = document.getElementById('fe_descripcion' + i).innerHTML;
        fe_fechainicio= document.getElementById('fe_fechainicio' + i).innerHTML;
        fe_fechafin= document.getElementById('fe_fechafin' + i).innerHTML;
        if (arrChkBox[i].checked) {
            editFestivo(arrChkBox[i].id,ca_id,cat_id,si_id,fe_id,fe_nombre,fe_descripcion,fe_fechainicio,fe_fechafin);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione un Festivo !!");
    }
}

function editFestivo(pr_id,ca_id,cat_id,si_id,fe_id,fe_nombre,fe_descripcion,fe_fechainicio,fe_fechafin){
    mostrarDiv("divFormulario");
    var parametros = {
        "pr_id" : pr_id , 
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id ,
        "fe_id" : fe_id , 
        "fe_nombre" : fe_nombre,
        "fe_descripcion" : fe_descripcion,
        "fe_fechainicio" : fe_fechainicio,
        "fe_fechafin" : fe_fechafin 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/festivoFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function f1meno1f2() {
    var f1 = document.getElementById('fe_fechainicio').value;
    var f2 = document.getElementById('fe_fechafin').value;
    var f1Anio = f1.substring(0, 4);
    var f1Mes = f1.substring(5, 7);
    var f1Dia = f1.substring(8, 10);
    var f1Hora = f1.substring(11, 13);
    var f1Minu = f1.substring(14, 16);
    var f1Segu = f1.substring(17, 19);
    var f2Anio = f2.substring(0, 4);
    var f2Mes = f2.substring(5, 7);
    var f2Dia = f2.substring(8, 10);
    var f2Hora = f2.substring(11, 13);
    var f2Minu = f2.substring(14, 16);
    var f2Segu = f2.substring(17, 19);
    if (f1Anio > f2Anio) {
        return false;
    } else if (f1Anio == f2Anio) {
        if (f2Mes > f1Mes) {
            return true;
        }
        if (f2Mes == f1Mes) {
            if (f2Dia > f1Dia) {
                return true;
            }
            if (f2Dia == f1Dia) {
                if (f1Hora > f2Hora) {
                    return false;
                }
                if (f2Hora == f1Hora) {
                    if (f1Minu > f2Minu) {
                        return false;
                    }
                    if (f1Minu == f2Minu) {
                        if (f1Segu > f2Segu) {
                            return false;
                        }
                        if (f2Segu == f1Segu) {
                            return false;
                        }
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

function delFestivoDesdeMenu(chkBoxHijosName) {
    var pr_id,caId,catId,siId,feId,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        caId = document.getElementById('caId' + i).innerHTML;
        catId = document.getElementById('catId' + i).innerHTML;
        siId = document.getElementById('siId' + i).innerHTML; 
        feId = document.getElementById('feId' + i).innerHTML;
        if (arrChkBox[i].checked) {
            delFestivo(3,arrChkBox[i].id,caId,catId,siId,feId);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delFestivo(opcion,pr_id,ca_id,cat_id,si_id,fe_id){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "fe_id" : fe_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/festivoFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consFestivo(pr_id, ca_id, cat_id, si_id, '0');
        }
    }); 
}

/*Gastronomia*/

function consGastronomia(pr_id,ca_id,cat_id,si_id,ga_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ga_id" : ga_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/gastronomiaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginGastronomia(nropagina){
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
        "ga_id" : 0
    };
    $.ajax({
        data: parametros,
        url: 'gestion/gastronomiaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 


function consGastronomiaAdm(pr_id,ca_id,cat_id,si_id,ga_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ga_id" : ga_id
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/gastronomiaConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<img  style='width:100%; height:161px' src='../../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    });
} 

function PaginGastronomiaAdm(nropagina){
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
        "ga_id" : 0
    };
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/gastronomiaConsAdm.php',
        type: 'post',
        beforeSend: function () {
            $("#contenedorRpt").html("<img  style='width:100%; height:161px' src='../../img/marca.gif'/> <br /><br />");
        },
        success: function (response) {
            $("#contenedorRpt").html(response);
        }
    });
} 

function delGastronomiaAdm(opcion,pr_id,ca_id,cat_id,si_id,ga_id){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ga_id" : ga_id
    };
    //url: '../../../controlador/gestion/fotoConsAdm.php',
    $.ajax({
        data: parametros,
        url: '../../../controlador/gestion/gastronomiaFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consGastronomiaAdm(pr_id, ca_id, cat_id, si_id, '0');
        }
    }); 
}


function addGastronomia(){
    document.getElementById("divFormulario").setAttribute('style', 'left:47%;display:block; top:55px;width: 37%;height:78%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var cat_id= $("#CAT_id").val();
    var si_id= $("#SI_id").val();
    var parametros = {
        "pr_id" : pr_id , 
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/gastronomiaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function validarCamposGastronomia(){
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#ga_nombre").val() == ""){
            $("#ga_nombre").focus().after("<span class='errorE'>Este campo es requerido.  </span>");
            return false;
        } else if($("#ga_descripcion").val().length<=4  || $("#ga_descripcion").val().length>31){
            $("#ga_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–32 caracteres]</span>");
            return false;
        }
        else if($("#archivo").val() == ""){
            $("#archivo").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        } else{ 
        //alert("SSSS"); 
        }
    });
    
    $("#ga_nombre, #ga_descripcion, #archivo").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}         

function insertGastronomia(opcion,pr_id,ca_id,cat_id,si_id,ga_nombre,ga_descripcion,ga_img){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ga_nombre" : ga_nombre,
        "ga_descripcion" : ga_descripcion,
        "ga_img" : ga_img
    };
    $.ajax({
        data: parametros,
        url: 'gestion/gastronomiaFuncion.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consGastronomia(pr_id, ca_id, cat_id, si_id, '0');
            cerrarAuto();
        }
    });
}

function updaGastronomia(opcion,pr_id,ca_id,cat_id,si_id,ga_id,ga_nombre,ga_descripcion,ga_img){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ga_id" : ga_id,
        "ga_nombre" : ga_nombre,
        "ga_descripcion" : ga_descripcion,
        "ga_img" : ga_img
    };
    $.ajax({
        data: parametros,
        url: 'gestion/gastronomiaFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consGastronomia(pr_id, ca_id, cat_id, si_id, '0');
        }
    });
}

function editGastronomiaDesdeMenu(chkBoxHijosName){
    var pr_id,ca_id,cat_id,si_id,ga_id,ga_nombre,ga_descripcion, checkeado;
    checkeado = 0; 
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {        
        ca_id = document.getElementById('ca_id' + i).innerHTML;
        cat_id = document.getElementById('cat_id' + i).innerHTML;
        si_id= document.getElementById('si_id' + i).innerHTML;
        ga_id = document.getElementById('ga_id' + i).innerHTML;
        ga_nombre = document.getElementById('ga_nombre' + i).innerHTML;
        ga_descripcion = document.getElementById('ga_descripcion' + i).innerHTML;
        if (arrChkBox[i].checked) {
            editGastronomia(arrChkBox[i].id,ca_id,cat_id,si_id,ga_id,ga_nombre,ga_descripcion);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione un Gastronomia !!");
    }
}

function editGastronomia(pr_id,ca_id,cat_id,si_id,ga_id,ga_nombre,ga_descripcion){
    mostrarDiv("divFormulario");
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ga_id" : ga_id,
        "ga_nombre" : ga_nombre,
        "ga_descripcion" : ga_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/gastronomiaFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}
 
function delGastronomiaDesdeMenu(chkBoxHijosName) {
    var pr_id,caId,catId,siId,gaId,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        caId = document.getElementById('caId' + i).innerHTML;
        catId = document.getElementById('catId' + i).innerHTML;
        siId = document.getElementById('siId' + i).innerHTML; 
        gaId = document.getElementById('gaId' + i).innerHTML;
        if (arrChkBox[i].checked) {
            delGastronomia(3,arrChkBox[i].id,caId,catId,siId,gaId);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delGastronomia(opcion,pr_id,ca_id,cat_id,si_id,ga_id){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ga_id" : ga_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/gastronomiaFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consGastronomia(pr_id, ca_id, cat_id, si_id, '0');
        }
    }); 
}

/*Ruta*/

 
function consRuta(pr_id,ca_id,cat_id,si_id,ru_id){
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ru_id" : ru_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rutaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginRuta(nropagina){
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
        url: 'gestion/rutaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function addRuta(){
    document.getElementById("map").setAttribute('style', 'left:14%;display:block; top:100%;width:75%;height:80%;');
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:50px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
     
    
    var pr_id= $("#PR_id").val();
    var ca_id= $("#CA_id").val();
    var cat_id= $("#CAT_id").val();
    var si_id= $("#SI_id").val();
    var parametros = {
        "pr_id" : pr_id , 
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rutaFormInsert.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function validarCamposRuta(){
    var pr_id=$("#pr_id").val();
    var ca_id=$("#ca_id").val();
    var cat_id=$("#cat_id").val();
    var si_id=$("#si_id").val();
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#ru_nombre").val() == ""){
            $("#ru_nombre").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#ru_nombre").val().length<=4  || $("#ru_nombre").val().length>28){
            $("#ru_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–29 caracteres]</span>");
            return false;
        }
        else if($("#ru_descripcion").val() == ""){
            $("#ru_descripcion").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#ru_descripcion").val().length<=4  || $("#ru_descripcion").val().length>124){
            $("#ru_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–125 caracteres]</span>");
            return false;
        }
        else
        {
            var opcion=$("#opcion_rut").val();
            if(opcion==0){
                insertRuta(opcion,pr_id,ca_id,cat_id,si_id,$("#ru_nombre").val(),$("#ru_descripcion").val());
            }
            else{
                var ru_id=$("#ru_id").val();
                updaRuta(opcion,pr_id,ca_id,cat_id,si_id,ru_id,$("#ru_nombre").val(),$("#ru_descripcion").val());
            }
        }
    });
    $("#ru_nombre, #ru_descripcion").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }
    });
}

var objPuntosRuta;
var matrizRuta;
var tm=0;
var x='';

function insertRuta(opcion,pr_id,ca_id,cat_id,si_id,ru_nombre,ru_descripcion){
    obtenerRuta();
    objPuntosRuta=new js2(); 
    tm=objPuntosRuta.vertices.length;
    matrizRuta=new Array(tm);
    for(i=0; i<matrizRuta.length;i++)
        matrizRuta[i]=new Array(2);
    for(i=0; i<tm;i++){
        matrizRuta[i][0]=objPuntosRuta.vertices[i].x;
        matrizRuta[i][1]=objPuntosRuta.vertices[i].y;
    }
    var ajaxinsRuta=nuevoAjax();
    ajaxinsRuta.onreadystatechange=function(){
        if(ajaxinsRuta.readyState==4){
            imprimeExito(ajaxinsRuta.responseText);
            consRuta(pr_id, ca_id, cat_id, si_id, '0');
            cerrarAuto();
        }
    };
    ajaxinsRuta.open('post','gestion/rutaFuncion.php', true);
    ajaxinsRuta.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajaxinsRuta.send(returnGuardarRutas(matrizRuta,opcion,pr_id,ca_id,cat_id,si_id,ru_nombre,ru_descripcion));
}

function returnGuardarRutas(matrizRuta,opcion,pr_id,ca_id,cat_id,si_id,ru_nombre,ru_descripcion) {
    var cad = 'matrizRuta='+ (JSON.stringify(matrizRuta)) +
    '&opcion=' + encodeURIComponent(opcion)+
    '&pr_id=' + encodeURIComponent(pr_id)+
    '&ca_id=' + encodeURIComponent(ca_id)+
    '&cat_id=' + encodeURIComponent(cat_id)+
    '&si_id=' + encodeURIComponent(si_id)+
    '&ru_nombre=' + encodeURIComponent(ru_nombre)+
    '&ru_descripcion=' + encodeURIComponent(ru_descripcion);
    return cad;
}

function updaRuta(opcion,pr_id,ca_id,cat_id,si_id,ru_id,ru_nombre,ru_descripcion){
    obtenerRuta();
    objPuntosRuta=new js2(); 
    tm=objPuntosRuta.vertices.length;
    matrizRuta=new Array(tm);
    for(i=0; i<matrizRuta.length;i++)
        matrizRuta[i]=new Array(2);    
    
    for(i=0; i<tm;i++){ 
        matrizRuta[i][0]=objPuntosRuta.vertices[i].x;
        matrizRuta[i][1]=objPuntosRuta.vertices[i].y;
    } 
    var ajaxinsRuta=nuevoAjax();
    ajaxinsRuta.onreadystatechange=function(){
        if(ajaxinsRuta.readyState==4){
            imprimeExito(ajaxinsRuta.responseText);
            consRuta(pr_id, ca_id, cat_id, si_id, '0');
            cerrarAuto();
        }
    };
    ajaxinsRuta.open('post','gestion/rutaFuncion.php', true);
    ajaxinsRuta.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajaxinsRuta.send(returnGuardarRutas2(matrizRuta,opcion,pr_id,ca_id,cat_id,si_id,ru_id,ru_nombre,ru_descripcion));
    
}

function returnGuardarRutas2(matrizRuta,opcion,pr_id,ca_id,cat_id,si_id,ru_id,ru_nombre,ru_descripcion) {
    var cad = 'matrizRuta='+ (JSON.stringify(matrizRuta)) +
    '&opcion=' + encodeURIComponent(opcion)+
    '&pr_id=' + encodeURIComponent(pr_id)+
    '&ca_id=' + encodeURIComponent(ca_id)+
    '&cat_id=' + encodeURIComponent(cat_id)+
    '&si_id=' + encodeURIComponent(si_id)+
    '&ru_id=' + encodeURIComponent(ru_id)+
    '&ru_nombre=' + encodeURIComponent(ru_nombre)+
    '&ru_descripcion=' + encodeURIComponent(ru_descripcion);
    return cad;
}

function editRutaDesdeMenu(chkBoxHijosName){
    var pr_id,ca_id,cat_id,si_id,ru_id,ru_nombre,ru_descripcion, checkeado;
    checkeado = 0; 
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {        
        ca_id = document.getElementById('ca_id' + i).innerHTML;
        cat_id = document.getElementById('cat_id' + i).innerHTML;
        si_id= document.getElementById('si_id' + i).innerHTML;
        ru_id = document.getElementById('ru_id' + i).innerHTML;
        ru_nombre = document.getElementById('ru_nombre' + i).innerHTML;
        ru_descripcion = document.getElementById('ru_descripcion' + i).innerHTML;
        if (arrChkBox[i].checked) {
            editRuta(arrChkBox[i].id,ca_id,cat_id,si_id,ru_id,ru_nombre,ru_descripcion);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione un Ruta !!");
    }
}

var rutas;

function editRuta(pr_id,ca_id,cat_id,si_id,ru_id,ru_nombre,ru_descripcion){
    mostrarDiv("divFormulario");
    document.getElementById("map").setAttribute('style', 'left:14%;display:block; top:100%;width:75%;height:80%;');
    document.getElementById("divFormulario").setAttribute('style', 'display:block; top:50px;width: 40%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    var parametros0 = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ru_id" : ru_id
    };
    $.ajax({
        data: parametros0,
        url: 'gestion/rutaConsultar.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            agregarCapaEditarRuta(response);
        }
    });
    var parametros = {
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ru_id" : ru_id,
        "ru_nombre" : ru_nombre,
        "ru_descripcion" : ru_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rutaFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}
 
function delRutaDesdeMenu(chkBoxHijosName) {
    var pr_id,caId,catId,siId,ruId,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        caId = document.getElementById('caId' + i).innerHTML;
        catId = document.getElementById('catId' + i).innerHTML;
        siId = document.getElementById('siId' + i).innerHTML; 
        ruId = document.getElementById('ruId' + i).innerHTML;
        if (arrChkBox[i].checked) {
            delRuta(3,arrChkBox[i].id,caId,catId,siId,ruId);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delRuta(opcion,pr_id,ca_id,cat_id,si_id,ru_id){
    var parametros = {
        "opcion" : opcion,
        "pr_id" : pr_id,
        "ca_id" : ca_id,
        "cat_id" : cat_id,
        "si_id" : si_id,
        "ru_id" : ru_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rutaFuncion.php',
        type: 'post',
        beforeSend: function () {
        
        },
        success: function () {
            consRuta(pr_id, ca_id, cat_id, si_id, '0');
        }
    }); 
}

/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
/*ADMINISTRACION*/

function consUsuario(em_id,us_id){
    var parametros = {
        "em_id" : em_id,
        "us_id" : us_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function PaginUsuario(nropagina){
    var parametros = {
        "pag" : nropagina,
        "us_id" : 0
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function addUsuario(){
    document.getElementById("divFormulario").setAttribute('style', 'left:35%;display:block; top:55px;width:63%;height:75%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    
    $.ajax({
        url: 'gestion/usuarioFormInsert.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposUsuario(){    
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;  
    $("#botonn").ready(function (){
        $(".errorE").remove();
        var em_id=$("#em_id").val();
        if($("#us_nombre").val() == ""){
            $("#us_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#us_nombre").val().length<=4  || $("#us_nombre").val().length>31){
            $("#us_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–32 caracteres]</span>");
            return false;
        }
        else if($("#us_apellido").val() == "" ){
            $("#us_apellido").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#us_apellido").val().length<=4  || $("#us_apellido").val().length>31){
            $("#us_apellido").focus().after("<span class='errorE'>Ingrese un valor [5–32 caracteres]</span>");
            return false;
        }
        else if($("#us_mail").val() == "" ){
            $("#us_mail").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if(!emailreg.test($("#us_mail").val()) ){
            $("#us_mail").focus().after("<span class='errorE'>Ingrese un email válido!.</span>");
            return false;
        }
        else if($("#us_mail").val().length<=4  || $("#us_mail").val().length>23){
            $("#us_mail").focus().after("<span class='errorE'>Ingrese un valor [5–24 caracteres]</span>");
            return false;
        }
        else if($("#us_usuario").val() == "" ){
            $("#us_usuario").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#us_usuario").val().length<=4  || $("#us_usuario").val().length>11){
            $("#us_usuario").focus().after("<span class='errorE'>Ingrese un valor [5–12 caracteres]</span>");
            return false;
        }
        else if($("#us_clave").val() == "" ){
            $("#us_clave").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#us_clave").val().length<=4  || $("#us_clave").val().length>14){
            $("#us_clave").focus().after("<span class='errorE'>Ingrese un valor [5–15 caracteres]</span>");
            return false;
        }
        else if($("#us_clave_repita").val() == "" ){
            $("#us_clave_repita").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else if($("#us_clave_repita").val().length<=4  || $("#us_clave_repita").val().length>14){
            $("#us_clave_repita").focus().after("<span class='errorE'>Ingrese un valor [5–15 caracteres]</span>");
            return false;
        }
        else if($("#us_clave_repita").val() != $("#us_clave").val() ){
            $("#us_clave_repita").focus().after("<span class='errorE'>Claves no coinciden</span>");
            return false;
        }
        else if($('input:radio[name=nameRad]:checked').val()==""){
            //$("#us_clave_repita").focus().after("<span class='errorE'>Seleccione un Estado</span>");
            cerrarAuto1Segundo();
            return false;
        }
        else if($("#us_t_sit").val() == "" ){
            $("#us_t_sit").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#us_t_his").val() == "" ){
            $("#us_t_his").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#us_t_vid").val() == "" ){
            $("#us_t_vid").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#us_t_fot").val() == "" ){
            $("#us_t_fot").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }else if($("#us_t_fes").val() == "" ){
            $("#us_t_fes").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#us_t_gas").val() == "" ){
            $("#us_t_gas").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }else if($("#us_t_rut").val() == "" ){
            $("#us_t_rut").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        }
        else{
            var opcion=$("#opcion_usr").val();
            var us_id;
            var us_estado=$('input:radio[name=nameRad]:checked').val();
            if(opcion==0){                
                insertUsuario(opcion,em_id,$("#us_nombre").val(),$("#us_apellido").val(),$("#us_mail").val(),$("#us_usuario").val(),$("#us_clave").val(),$("#us_clave_repita").val(),us_estado,$("#us_t_sit").val(),$("#us_t_his").val(),$("#us_t_vid").val(),$("#us_t_fot").val(),$("#us_t_fes").val(),$("#us_t_gas").val(),$("#us_t_rut").val()); 
            }else{
                us_id=$("#us_id").val();
                updaUsuario(opcion,em_id,us_id,$("#us_nombre").val(),$("#us_apellido").val(),$("#us_mail").val(),$("#us_usuario").val(),$("#us_clave").val(),$("#us_clave_repita").val(),us_estado,$("#us_t_sit").val(),$("#us_t_his").val(),$("#us_t_vid").val(),$("#us_t_fot").val(),$("#us_t_fes").val(),$("#us_t_gas").val(),$("#us_t_rut").val());
            }    
        }
    });
    
    $("#us_nombre, #us_apellido, #us_mail, #us_usuario, #us_clave, #us_clave_repita, #us_estado, #us_t_sit, #us_t_his, #us_t_vid, #us_t_fot, #us_t_fes, #us_t_gas, #us_t_rut").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertUsuario(opcion,em_id,us_nombre,us_apellido,us_mail,us_usuario,us_clave,us_clave_repita,us_estado,us_t_sit,us_t_his,us_t_vid,us_t_fot,us_t_fes,us_t_gas,us_t_rut){
    var parametros = {
        "opcion" : opcion,
        "em_id" : em_id,
        "us_nombre" : us_nombre,
        "us_apellido" : us_apellido,
        "us_mail" : us_mail,
        "us_usuario" : us_usuario,
        "us_clave" : us_clave,
        "us_clave_repita" : us_clave_repita,
        "us_estado" : us_estado,
        "us_t_sit" : us_t_sit,
        "us_t_his" : us_t_his,
        "us_t_vid" : us_t_vid,
        "us_t_fot" : us_t_fot,
        "us_t_fes" : us_t_fes,
        "us_t_gas" : us_t_gas,
        "us_t_rut" : us_t_rut
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            imprimeExito(response);
            consUsuario(em_id,'0');
            cerrarAuto();
        }
    });
}

function updaUsuario(opcion,em_id,us_id,us_nombre,us_apellido,us_mail,us_usuario,us_clave,us_clave_repita,us_estado,us_t_sit,us_t_his,us_t_vid,us_t_fot,us_t_fes,us_t_gas,us_t_rut){
    //alert(opcion+','+em_id+','+us_id+','+us_nombre+','+us_apellido+','+us_mail+','+us_usuario+','+us_clave+','+
    //  us_imagen+','+us_estado+','+us_t_sit+','+us_t_his+','+us_t_vid+','+us_t_fot+','+us_t_fes+','+us_t_gas+','+us_t_rut);
    //return;
    var parametros = {
        "opcion" : opcion,
        "em_id" : em_id,
        "us_id" : us_id,
        "us_nombre" : us_nombre,
        "us_apellido" : us_apellido,
        "us_mail" : us_mail,
        "us_usuario" : us_usuario,
        "us_clave" : us_clave,
        "us_clave_repita" : us_clave_repita,
        "us_estado" : us_estado,
        "us_t_sit" : us_t_sit,
        "us_t_his" : us_t_his,
        "us_t_vid" : us_t_vid,
        "us_t_fot" : us_t_fot,
        "us_t_fes" : us_t_fes,
        "us_t_gas" : us_t_gas,
        "us_t_rut" : us_t_rut
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consUsuario(em_id, '0');
            cerrarAuto();
        }
    });
}

function editUsuarioDesdeMenu(chkBoxHijosName) {
    var em_id,us_id, us_nombre,us_apellido,us_mail,us_usuario,us_clave,us_estado,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        us_id = document.getElementById('us_id' + i).innerHTML;
        us_nombre = document.getElementById('us_nombre' + i).innerHTML;
        us_apellido = document.getElementById('us_apellido' + i).innerHTML;
        us_mail = document.getElementById('us_mail' + i).innerHTML;
        us_usuario= document.getElementById('us_usuario' + i).innerHTML;
        us_clave= document.getElementById('us_clave' + i).innerHTML;
        us_estado= document.getElementById('us_estado' + i).innerHTML; 
        if (arrChkBox[i].checked) {
            editUsuario(arrChkBox[i].id,us_id,us_nombre,us_apellido,us_mail,us_usuario,us_clave,us_estado);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione una Usuario !!");
    }
}

function editUsuario(em_id,us_id,us_nombre,us_apellido,us_mail,us_usuario,us_clave,us_clave2,us_estado,us_t_sit,us_t_his,us_t_vid,us_t_fot,us_t_fes,us_t_gas,us_t_rut){
    document.getElementById("divFormulario").setAttribute('style', 'left:35%;display:block; top:55px;width:63%;height:75%;');
    $("#divFormulario").animate({
        "top": "+=55px"
    }, "slow");
    //mostrarDiv("divFormulario");
    var parametros = {
        "em_id" : em_id,
        "us_id" : us_id,
        "us_nombre" : us_nombre,
        "us_apellido" : us_apellido,
        "us_mail" : us_mail,
        "us_usuario" : us_usuario,
        "us_clave" : us_clave,
        "us_clave2" : us_clave2,
        "us_estado" : us_estado,
        "us_t_sit" : us_t_sit,
        "us_t_his" : us_t_his,
        "us_t_vid" : us_t_vid,
        "us_t_fot" : us_t_fot,
        "us_t_fes" : us_t_fes,
        "us_t_gas" : us_t_gas,
        "us_t_rut" : us_t_rut
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delUsuarioDesdeMenu(chkBoxHijosName) {
    var usId,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        usId = document.getElementById('usId' + i).innerHTML; 
        if (arrChkBox[i].checked) {
            delUsuario(3,arrChkBox[i].id,usId);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delUsuario(opcion,em_id,us_id){
    var parametros = {
        "opcion" : opcion,
        "em_id" : em_id,
        "us_id" : us_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/usuarioFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
            consUsuario(em_id, '0');
        }
    }); 
}

function irUsuarioRol(em_id,us_id,us_nombre){
    var parametros = {
        "em_id" : em_id,
        "us_id" : us_id,
        "us_nombre" : us_nombre
    };
    $.ajax({
        data: parametros,
        url: '../vista/pantalla/admrol.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
            consRol(em_id, us_id, '0');
            asignarUsuario(us_nombre);
        }
    });
} 

function asignarUsuario(us_nombre){
    document.getElementById('us_nombre').innerHTML=us_nombre;
}

/*Rol*/

function consRol(em_id,us_id,ro_id){
    var parametros = {
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginRol(nropagina){
    var em_id= $("#EM_id").val();
    var us_id= $("#US_id").val();
    var parametros = {
        "pag" : nropagina,
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : 0
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}  

function addRol(){
    mostrarDiv("divFormulario");
    var EM_id= $("#EM_id").val();
    var US_id= $("#US_id").val();
    var parametros = {
        "em_id" : EM_id,
        "us_id" : US_id 
    }; 
    $.ajax({
        data: parametros,
        url: 'gestion/rolFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposRol(){
    var em_id=$("#ro_em_id").val();
    var us_id=$("#ro_us_id").val();
    $("#botonn").ready(function (){
        $(".errorE").remove();    
        if($("#ro_nombre").val() == ""){
            $("#ro_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#ro_nombre").val().length<=4  || $("#ro_nombre").val().length>19){
            $("#ro_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–20 caracteres]</span>");
            return false;
        }else if($("#ro_descripcion").val() == "" ){
            $("#ro_descripcion").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#ro_descripcion").val().length<=4  || $("#ro_descripcion").val().length>63){
            $("#ro_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–64 caracteres]</span>");
            return false;
        }
        else{
            var opcion=$("#opcion_rol").val();
            var ro_id;
            if(opcion==0){
                insertRol(opcion,em_id,us_id,$("#ro_nombre").val(),$("#ro_descripcion").val()); 
            }else{
                ro_id=$("#ro_id").val();
                updaRol(opcion,em_id,us_id,ro_id,$("#ro_nombre").val(),$("#ro_nombre").val());
            }    
        }
    });
    
    $("#ro_nombre, #ro_descripcion").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    });
}

function insertRol(opcion,em_id,us_id,ro_nombre,ro_descripcion){
    var parametros = {
        "opcion" : opcion,
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_nombre" : ro_nombre,
        "ro_descripcion" : ro_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolFuncion.php',
        type: 'post',
        beforeSend: function () {
        //  $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consRol(em_id, us_id, '0');
            cerrarAuto();
        }
    });
}

function updaRol(opcion,em_id,us_id,ro_id,ro_nombre,ro_descripcion){
    var parametros = {
        "opcion" : opcion,
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "ro_nombre" : ro_nombre,
        "ro_descripcion" : ro_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consRol(em_id, us_id, '0');
        }
    });
}

function editRolDesdeMenu(chkBoxHijosName) {
    var em_id,us_id,ro_id, ro_nombre,ro_descripcion,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) { 
        us_id = document.getElementById('us_id' + i).innerHTML;
        ro_id = document.getElementById('ro_id' + i).innerHTML; 
        ro_nombre = document.getElementById('ro_nombre' + i).innerHTML;
        ro_descripcion = document.getElementById('ro_descripcion' + i).innerHTML; 
        if (arrChkBox[i].checked) {
            editRol(arrChkBox[i].id,us_id,ro_id,ro_nombre,ro_descripcion);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione una Rol !!");
    }
}

function editRol(em_id,us_id,ro_id,ro_nombre,ro_descripcion){
    mostrarDiv("divFormulario");
    var parametros = {
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "ro_nombre" : ro_nombre,
        "ro_descripcion" : ro_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}
 
function delRolDesdeMenu(chkBoxHijosName) {
    var em_id,usId,roid,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        usId = document.getElementById('usId' + i).innerHTML;
        roId = document.getElementById('roId' + i).innerHTML;
        if (arrChkBox[i].checked) {
            delRol(3,arrChkBox[i].id,usId,roId);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delRol(opcion,em_id,us_id,ro_id){
    var parametros = {
        "opcion" : opcion,
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/rolFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consRol(em_id, us_id, '0');
        }
    }); 
}

/*Modulo*/

function selectUsuarioRol(em_id,us_id,ro_id){
    var i=0;
    var elemento='';
    var texto='';
    var ancla='';
    $.getJSON('gestion/selectUsuarioRol.php', {
        em_id: em_id,
        us_id: us_id,
        ro_id: ro_id
    }, function(data) {
        var ul=document.getElementById('dropdown-menu');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][3]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href',' javascript:consResponsabilidad("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+0+'");asignarRol("'+data[i][3]+'");');
                ul.appendChild(elemento);
            }
        }
    });
} 

function asignarRol(ro_nombre){
    document.getElementById('ro_nombre').innerHTML = ro_nombre.toString();
}

function consResponsabilidad(em_id,us_id,ro_id,re_id){
    var parametros = {
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function PaginRespon(nropagina){
    var em_id=$("#EM_id").val();
    var us_id=$("#US_id").val();
    var ro_id=$("#RO_id").val();
    var parametros = {
        "pag" : nropagina,
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : 0
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
} 

function addResponsabilidad(){
    mostrarDiv("divFormulario");
    var EM_id=$("#EM_id").val();
    var US_id=$("#US_id").val();
    var RO_id=$("#RO_id").val();
    
    var parametros = {
        "em_id" : EM_id,
        "us_id" : US_id,
        "ro_id" : RO_id 
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFormInsert.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
} 

function validarCamposResponsabilidad(){
    var em_id=  $("#re_em_id").val();
    var us_id=  $("#re_us_id").val();
    var ro_id=  $("#re_ro_id").val();    
    $("#botonn").ready(function (){
        $(".errorE").remove();
        if($("#re_nombre").val() == "" ){
            $("#re_nombre").focus().after("<span class='errorE'>Este campo es requerido.</span>");
            return false;
        }
        else if($("#re_nombre").val().length<=4  || $("#re_nombre").val().length>19){
            $("#re_nombre").focus().after("<span class='errorE'>Ingrese un valor [5–20 caracteres]</span>");
            return false;
        }
        else if($("#re_descripcion").val() == ""){
            $("#re_descripcion").focus().after("<span class='errorE'>Este campo es requerido. </span>");
            return false;
        } 
        else if($("#re_descripcion").val().length<=4  || $("#re_descripcion").val().length>63){
            $("#re_descripcion").focus().after("<span class='errorE'>Ingrese un valor [5–64 caracteres]</span>");
            return false;
        }
        else{
            var opcion=$("#opcion_resp").val();
            if(opcion==0){
                insertResponsabilidad(opcion,em_id,us_id,ro_id,$("#re_nombre").val(),$("#re_descripcion").val());
            }
            else{
                var re_id=$("#re_re_id").val();
                updaResponsabilidad(opcion,em_id,us_id,ro_id,re_id,$("#re_nombre").val(),$("#re_descripcion").val());
            }
        }
    });
    
    $("#re_nombre, #re_descripcion").keyup(function(){
        if( $(this).val() != "" ){
            $(".errorE").fadeOut();
            return false;
        }		
    }); 
}

function insertResponsabilidad(opcion,em_id,us_id,ro_id,re_nombre,re_descripcion){
    var parametros = {
        "opcion" : opcion,
        "em_id" : em_id,
        "us_id" : us_id, 
        "ro_id" : ro_id,
        "re_nombre" : re_nombre,
        "re_descripcion" : re_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFuncion.php',
        type: 'post',
        beforeSend: function () {
        //$("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            //alert(response);
            consResponsabilidad(em_id, us_id, ro_id, '0');
            cerrarAuto();
        }
    });
}

function updaResponsabilidad(opcion,em_id,us_id,ro_id,re_id,re_nombre,re_descripcion){
    var parametros = {
        "opcion" : opcion,
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id,
        "re_nombre" : re_nombre,
        "re_descripcion" : re_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFuncion.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../php/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            imprimeExito(response);
            consResponsabilidad(em_id, us_id, ro_id, '0');
        }
    });
}

function editResponsabilidadDesdeMenu(chkBoxHijosName) {
    var em_id,us_id,ro_id ,re_id, re_nombre,re_descripcion,checkeado;
    checkeado = 0; 
    var arrChkBox = document.getElementsByName(chkBoxHijosName);
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        us_id = document.getElementById('us_id' + i).innerHTML;
        ro_id = document.getElementById('ro_id' + i).innerHTML;
        re_id = document.getElementById('re_id' + i).innerHTML;
        re_nombre = document.getElementById('re_nombre' + i).innerHTML;
        re_descripcion = document.getElementById('re_descripcion' + i).innerHTML;
        if (arrChkBox[i].checked) {
            editResponsabilidad(arrChkBox[i].id,us_id,ro_id, re_id,re_nombre,re_descripcion);
            checkeado = 1;
        }
    }
    if (!checkeado){
        imprimeError("Seleccione una Responsabilidad !!");
    }
}

function editResponsabilidad(em_id,us_id,ro_id,re_id,re_nombre,re_descripcion){
    mostrarDiv("divFormulario");
    var parametros = {
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id,
        "re_nombre" : re_nombre,
        "re_descripcion" : re_descripcion
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFormUpdate.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:30px; height:30px' src='../vista/img/ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divFormulario").html(response);
        }
    });
}

function delResponsabilidadDesdeMenu(chkBoxHijosName) {
    var es_id,usId,roId,reId,checkeado;
    checkeado = 0;
    var arrChkBox = document.getElementsByName(chkBoxHijosName); 
    for (i = arrChkBox.length - 1; i >= 0; i--) {
        usId = document.getElementById('usId' + i).innerHTML;
        roId = document.getElementById('roId' + i).innerHTML;
        reId = document.getElementById('reId' + i).innerHTML;
        if (arrChkBox[i].checked) {
            delResponsabilidad(3,arrChkBox[i].id,usId,roId,reId);
            checkeado = 1;
        }
    }
    if (checkeado==0){
        mostrarDiv("divFormulario")
        imprimeError("Seleccionar al menos un campo !");
        $('#divFormulario').fadeOut(4000);
    }
    else if(checkeado==1){
        mostrarDiv("divFormulario");
        imprimeExito("Campo(s) eliminados !"); 
        $('#divFormulario').fadeOut(4000);
    }
}

function delResponsabilidad(opcion,em_id,us_id,ro_id,re_id){  
    var parametros = {
        "opcion" : opcion,
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/responsabilidadFuncion.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () {
            consResponsabilidad(em_id, us_id, ro_id, '0');
        }
    });     
}
function irRolResponsabilidad(em_id,us_id,ro_id,ro_nombre){
    var us_nombre=document.getElementById('us_nombre').innerHTML;
    var parametros = {
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "ro_nombre" : ro_nombre
    };
    $.ajax({
        data: parametros,
        url: '../vista/pantalla/admresponsabilidad.php',
        type: 'post',
        beforeSend: function () {
            $("#divFormulario").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#detailMenu").html(response);
            selectUsuarioRol(em_id, us_id, ro_id);
            asignarUsuario(us_nombre);
            consResponsabilidad(em_id, us_id, ro_id, '0');
            asignarRol(ro_nombre) 
        }
    });
} 

/*PANTALLAS*/

function asignarResponsabilidad(re_nombre){
    document.getElementById('re_nombre').innerHTML=re_nombre;
}

function selectUsuarioRol_pantalla(em_id,us_id,us_nombre){
    var i=0;
    var elemento='';
    var texto='';
    var ancla='';
    $.getJSON('gestion/selectUsuarioRol.php', {
        em_id: em_id,
        us_id: us_id,
        us_nombre: us_nombre
    }, function(data) {
        var ul=document.getElementById('dropdown-menu_doble');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][3]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href',' javascript:consRolResponsabilidad_pantalla("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+0+'");asignarRol("'+data[i][3]+'");');
                ul.appendChild(elemento);
            }
        }
    });
} 

function consRolResponsabilidad_pantalla(em_id,us_id,ro_id,ro_nombre){
    var i=0;
    var elemento='';
    var texto='';
    var ancla='';
    $.getJSON('gestion/selectRolResponsabilidad.php', {
        em_id: em_id,
        us_id: us_id,
        ro_id: ro_id,
        ro_nombre: ro_nombre
    }, function(data) {
        var ul=document.getElementById('dropdown-menu_triple');
        ul.innerHTML="";
        if(data.length >0){
            for(i=0;i<data.length;i++){
                elemento=document.createElement('li');
                ancla= document.createElement('a');
                texto=document.createTextNode(data[i][4]);
                ancla.appendChild(texto);
                elemento.appendChild(ancla);
                ancla.setAttribute('href','javascript:consPantalla("'+data[i][0]+'","'+data[i][1]+'","'+data[i][2]+'","'+data[i][3]+'","'+0+'");asignarResponsabilidad("'+data[i][4]+'");');
                ul.appendChild(elemento);
            }
        }
    });
} 

function consPantalla(em_id,us_id,ro_id,re_id,pa_id){
    var parametros = {
        "em_id" : em_id,
        "us_id" : us_id,
        "ro_id" : ro_id,
        "re_id" : re_id,
        "pa_id" : pa_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pantallaCons.php',
        type: 'post',
        beforeSend: function () {
            $("#divTabla").html("<br /> <img  style='width:50px; height:50px' src='../vista/img/loading_ajax.gif'/> Cargando..<br /><br />");
        },
        success: function (response) {
            $("#divTabla").html(response);
        }
    });
}

function activarChkBox(nameChkBox) {
    var arreglock = document.getElementsByName(nameChkBox);
    for (i = 0; i < arreglock.length; i++)
        arreglock[i].removeAttribute("disabled");
    var chkpadre=document.getElementById('chkPadreRol'); 
    if(chkpadre)
        chkpadre.removeAttribute("disabled");
}

function consultarPantallasAsignadas() {
    var p_em_id=  $("#PA_em_id").val();
    var p_us_id=  $("#PA_us_id").val();
    var p_ro_id=  $("#PA_ro_id").val();
    var p_re_id=  $("#PA_re_id").val();
    $.getJSON('gestion/pantallaSelect.php', {
        p_em_id: p_em_id,
        p_us_id: p_us_id,
        p_ro_id: p_ro_id,
        p_re_id: p_re_id
    } ,function(data) {
        marcarChkBox("chkHijoRol", data);
    });
}

function marcarChkBox(chkBoxName, elementSelecteds) {
    var listChkBox = document.getElementsByName(chkBoxName);
    for (i = 0; i < elementSelecteds.length; i++) {
        for (j = 0; j < listChkBox.length; j++)
            if (elementSelecteds[i] == listChkBox[j].id)
                listChkBox[j].checked = true;
    }
}

function insertarPantallas() {
    var arrPanSelected = new Array();
    var arrChkBox = new Array();
    var j = 0;
    var emp,usu,rol, res ,pt_id, pt_nombre, pt_descripcion;
    arrChkBox = document.getElementsByName('chkHijoRol');    
    for (i = 0; i <arrChkBox.length; i++) { 
        emp = document.getElementById('pt_em_id' + i).innerHTML;
        usu = document.getElementById('pt_us_id' + i).innerHTML;
        rol = document.getElementById('pt_ro_id' + i).innerHTML;
        res = document.getElementById('pt_re_id' + i).innerHTML;
        pt_id = document.getElementById('pt_id' + i).innerHTML;
        pt_nombre = document.getElementById('pt_nom' + i).innerHTML;
        pt_descripcion = document.getElementById('pt_des' + i).innerHTML;
        if (arrChkBox[i].checked) {
            //alert(emp+','+usu+','+rol+','+mod+','+pt_id+','+pt_nombre+','+pt_descripcion); 
            arrPanSelected[j] = [emp.toString(),usu.toString(),rol.toString(),res.toString(),pt_id.toString(),pt_nombre.toString(),pt_descripcion.toString()];
            j++;
        }else
        {
            eliminarPantalla(emp,usu,rol, res ,pt_id);
            j++;
        }
    }
    
    var	ajaxGuardarPantallas = nuevoAjax();
    ajaxGuardarPantallas.onreadystatechange = function() {
        if (ajaxGuardarPantallas.readyState == 4)
            if (ajaxGuardarPantallas.responseText) {
                alert(ajaxGuardarPantallas.responseText);
                document.getElementById('resultadoPantalla').innerHTML = ajaxGuardarPantallas.responseText;
            }
            else{ 
                document.getElementById('resultadoPantalla').innerHTML = "<img src='img/loading2.gif' /> Cargando...";
            }
    };
    ajaxGuardarPantallas.open('post', 'gestion/pantallaInsert.php', true);
    ajaxGuardarPantallas.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajaxGuardarPantallas.send(returnGuardarPantallas(arrPanSelected, arrChkBox));
    ComprobarSeleCheckHijos(); // comprobamos en el caso de que no tengamos
}

function returnGuardarPantallas(arrPanSelected, arrChkBox) {
    var cad = '';
    cad = 'arrPanSelected='+ encodeURIComponent(JSON.stringify(arrPanSelected)) + '&arrChkBox=' + encodeURIComponent(JSON.stringify(arrChkBox));
    return cad;
}

function eliminarPantalla(emp,usu,rol, res ,pt_id) {
    var parametros = {
        "emp" : emp,
        "usu" : usu,
        "rol" : rol,
        "res" : res,
        "pt_id" : pt_id
    };
    $.ajax({
        data: parametros,
        url: 'gestion/pantallaDel.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function () { 
        }
    });     
} 

function ComprobarSeleCheckHijos(){
    var arrChkBox = document.getElementsByName('chkHijoRol');
    var cont=0;
    for (i = 0; i < arrChkBox.length; i++) {
        if (arrChkBox[i].checked==1)
            cont++;
    }
    if(cont>0){
    //mostrarMensaje("Cambios Realizados");
    }
}

function DesactivarChkBox(){
    document.getElementById('chkPadreRol').disabled='disabled';
    var arreglochekHijo = document.getElementsByName('chkHijoRol');
    for (i = 0; i < arreglochekHijo.length; i++)
        arreglochekHijo[i].disabled='disabled';
}

/*-----------------------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------------------*/

/*Login*/
function asignarRolLogin(ro_id,ro_nombre){
    document.getElementById('ro_id').value=ro_id;
    document.getElementById('ro_nombre').innerHTML=ro_nombre;
}

function obtenerValores(vector){
    var vec = new Array();
    for ( var i = 0; i < vector.length; i++) {
        vec [i] = document.getElementById(vector[0]).value;
    }
    return vec;
}

/*******************************************************************************
 * Para mostrar y cerrar combos al dar click
 ******************************************************************************/
 
var JSON;
if (!JSON) {
    JSON = {};
}

(function() {
    'use strict';
    function f(n) {
        // Format integers to have at least two digits.
        return n < 10 ? '0' + n : n;
    }
    if (typeof Date.prototype.toJSON !== 'function') {
        Date.prototype.toJSON = function(key) {
            return isFinite(this.valueOf()) ? this.getUTCFullYear() + '-'
            + f(this.getUTCMonth() + 1) + '-' + f(this.getUTCDate())
            + 'T' + f(this.getUTCHours()) + ':'
            + f(this.getUTCMinutes()) + ':' + f(this.getUTCSeconds())
            + 'Z' : null;
        };
        
        String.prototype.toJSON = Number.prototype.toJSON = Boolean.prototype.toJSON = function(
            key) {
            return this.valueOf();
        };
    }
    
    var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g, escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g, gap, indent, meta = { // table
        // of
        // character
        // substitutions
        '\b' : '\\b',
        '\t' : '\\t',
        '\n' : '\\n',
        '\f' : '\\f',
        '\r' : '\\r',
        '"' : '\\"',
        '\\' : '\\\\'
    }, rep;
    
    function quote(string) {
        // If the string contains no control characters, no quote characters,
        // and no
        // backslash characters, then we can safely slap some quotes around it.
        // Otherwise we must also replace the offending characters with safe
        // escape
        // sequences.
        
        escapable.lastIndex = 0;
        return escapable.test(string) ? '"'
        + string.replace(escapable,
            function(a) {
                var c = meta[a];
                return typeof c === 'string' ? c : '\\u'
                + ('0000' + a.charCodeAt(0).toString(16))
                .slice(-4);
            }) + '"' : '"' + string + '"';
    }
    function str(key, holder) {
        // Produce a string from holder[key].
        var i, // The loop counter.
        k, // The member key.
        v, // The member value.
        length, mind = gap, partial, value = holder[key];
        // If the value has a toJSON method, call it to obtain a replacement
        // value.
        if (value && typeof value === 'object'
            && typeof value.toJSON === 'function') {
            value = value.toJSON(key);
        }
        // If we were called with a replacer function, then call the replacer to
        // obtain a replacement value.
        if (typeof rep === 'function') {
            value = rep.call(holder, key, value);
        }
        // What happens next depends on the value's type.
        switch (typeof value) {
            case 'string':
                return quote(value);
            case 'number':
                
                // JSON numbers must be finite. Encode non-finite numbers as null.
                return isFinite(value) ? String(value) : 'null';
            case 'boolean':
            case 'null':
                // If the value is a boolean or null, convert it to a string. Note:
                // typeof null does not produce 'null'. The case is included here in
                // the remote chance that this gets fixed someday.
                return String(value);
            // If the type is 'object', we might be dealing with an object or an
            // array or
            // null.
            case 'object':
                // Due to a specification blunder in ECMAScript, typeof null is
                // 'object',
                // so watch out for that case.
                if (!value) {
                    return 'null';
                }
                // Make an array to hold the partial results of stringifying this
                // object value.
                gap += indent;
                partial = [];
                // Is the value an array?
                if (Object.prototype.toString.apply(value) === '[object Array]') {
                    // The value is an array. Stringify every element. Use null as a
                    // placeholder
                    // for non-JSON values.
                    length = value.length;
                    for (i = 0; i < length; i += 1) {
                        partial[i] = str(i, value) || 'null';
                    }
                    // Join all of the elements together, separated with commas, and
                    // wrap them in
                    // brackets.
                    
                    v = partial.length === 0 ? '[]' : gap ? '[\n' + gap
                    + partial.join(',\n' + gap) + '\n' + mind + ']' : '['
                    + partial.join(',') + ']';
                    gap = mind;
                    return v;
                }
                // If the replacer is an array, use it to select the members to be
                // stringified.
                if (rep && typeof rep === 'object') {
                    length = rep.length;
                    for (i = 0; i < length; i += 1) {
                        if (typeof rep[i] === 'string') {
                            k = rep[i];
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v);
                            }
                        }
                    }
                } else {
                    // Otherwise, iterate through all of the keys in the object.
                    for (k in value) {
                        if (Object.prototype.hasOwnProperty.call(value, k)) {
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v);
                            }
                        }
                    }
                }
                // Join all of the member texts together, separated with commas,
                // and wrap them in braces.
                v = partial.length === 0 ? '{}' : gap ? '{\n' + gap
                + partial.join(',\n' + gap) + '\n' + mind + '}' : '{'
                + partial.join(',') + '}';
                gap = mind;
                return v;
        }
    }
    // If the JSON object does not yet have a stringify method, give it one.
    if (typeof JSON.stringify !== 'function') {
        JSON.stringify = function(value, replacer, space) {
            // The stringify method takes a value and an optional replacer, and
            // an optional
            // space parameter, and returns a JSON text. The replacer can be a
            // function
            // that can replace values, or an array of strings that will select
            // the keys.
            // A default replacer method can be provided. Use of the space
            // parameter can
            // produce text that is more easily readable.
            var i;
            gap = '';
            indent = '';
            // If the space parameter is a number, make an indent string
            // containing that
            // many spaces.
            if (typeof space === 'number') {
                for (i = 0; i < space; i += 1) {
                    indent += ' ';
                }
            // indent string.
            } else if (typeof space === 'string') {
                indent = space;
            }
            // If there is a replacer, it must be a function or an array.
            // Otherwise, throw an error.
            rep = replacer;
            if (replacer
                && typeof replacer !== 'function'
                && (typeof replacer !== 'object' || typeof replacer.length !== 'number')) {
                throw new Error('JSON.stringify');
            }
            // Make a fake root object containing our value under the key of ''.
            // Return the result of stringifying the value.
            return str('', {
                '' : value
            });
        };
    }
    // If the JSON object does not yet have a parse method, give it one.
    if (typeof JSON.parse !== 'function') {
        JSON.parse = function(text, reviver) {
            // The parse method takes a text and an optional reviver function,
            // and returns
            // a JavaScript value if the text is a valid JSON text.
            var j;
            function walk(holder, key) {
                // The walk method is used to recursively walk the resulting
                // structure so
                // that modifications can be made.
                var k, v, value = holder[key];
                if (value && typeof value === 'object') {
                    for (k in value) {
                        if (Object.prototype.hasOwnProperty.call(value, k)) {
                            v = walk(value, k);
                            if (v !== undefined) {
                                value[k] = v;
                            } else {
                                delete value[k];
                            }
                        }
                    }
                }
                return reviver.call(holder, key, value);
            }
            // Parsing happens in four stages. In the first stage, we replace
            // certain
            // Unicode characters with escape sequences. JavaScript handles many
            // characters
            // incorrectly, either silently deleting them, or treating them as
            // line endings.
            text = String(text);
            cx.lastIndex = 0;
            if (cx.test(text)) {
                text = text.replace(cx,
                    function(a) {
                        return '\\u'
                        + ('0000' + a.charCodeAt(0).toString(16))
                        .slice(-4);
                    });
            }
            // In the second stage, we run the text against regular expressions
            // that look
            // for non-JSON patterns. We are especially concerned with '()' and
            // 'new'
            // because they can cause invocation, and '=' because it can cause
            // mutation.
            // But just to be safe, we want to reject all unexpected forms.
            // We split the second stage into 4 regexp operations in order to
            // work around
            // crippling inefficiencies in IE's and Safari's regexp engines.
            // First we
            // replace the JSON backslash pairs with '@' (a non-JSON character).
            // Second, we
            // replace all simple value tokens with ']' characters. Third, we
            // delete all
            // open brackets that follow a colon or comma or that begin the
            // text. Finally,
            // we look to see that the remaining characters are only whitespace
            // or ']' or
            // ',' or ':' or '{' or '}'. If that is so, then the text is safe
            // for eval.
            if (/^[\],:{}\s]*$/
                .test(text
                    .replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@')
                    .replace(
                        /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
                        ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                // In the third stage we use the eval function to compile the
                // text into a
                // JavaScript structure. The '{' operator is subject to a
                // syntactic ambiguity
                // in JavaScript: it can begin a block or an object literal. We
                // wrap the text
                // in parens to eliminate the ambiguity.
                j = eval('(' + text + ')');
                // In the optional fourth stage, we recursively walk the new
                // structure, passing
                // each name/value pair to a reviver function for possible
                // transformation.
                return typeof reviver === 'function' ? walk({
                    '' : j
                }, '') : j;
            }
            // If the text is not JSON parseable, then a SyntaxError is thrown.
            throw new SyntaxError('JSON.parse');
        };
    }
}());
 
function ocultarDiv(div) {
    document.getElementById(div).style.display = 'none';
}

function mostrarDiv(div) {
    document.getElementById(div).style.display = 'block';
}

/*--------------------- Usuarios ---------------------*/

function carga()
{
    posicion=0;
    if(navigator.userAgent.indexOf("MSIE")>=0) navegador=0;
    else navegador=1;
}

function evitaEventos(event)
{
    if(navegador==0)
    {
        window.event.cancelBubble=true;
        window.event.returnValue=false;
    }
    if(navegador==1) event.preventDefault();
}

function comienzoMovimiento(event, id)
{
    elMovimiento=document.getElementById(id);
    if(navegador==0)
    {
        cursorComienzoX=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
        cursorComienzoY=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
        document.attachEvent("onmousemove", enMovimiento);
        document.attachEvent("onmouseup", finMovimiento);
    }
    if(navegador==1)
    {
        cursorComienzoX=event.clientX+window.scrollX;
        cursorComienzoY=event.clientY+window.scrollY;
        document.addEventListener("mousemove", enMovimiento, true);
        document.addEventListener("mouseup", finMovimiento, true);
    }
    elComienzoX=parseInt(elMovimiento.style.left);
    elComienzoY=parseInt(elMovimiento.style.top);
    elMovimiento.style.zIndex=++posicion;
    evitaEventos(event);
}

function enMovimiento(event)
{
    var xActual, yActual;
    if(navegador==0)
    {
        xActual=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
        yActual=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
    }
    if(navegador==1)
    {
        xActual=event.clientX+window.scrollX;
        yActual=event.clientY+window.scrollY;
    }
    elMovimiento.style.left=(elComienzoX+xActual-cursorComienzoX)+"px";
    elMovimiento.style.top=(elComienzoY+yActual-cursorComienzoY)+"px";
    evitaEventos(event);
}

function finMovimiento()
{
    if(navegador==0)
    {
        document.detachEvent("onmousemove", enMovimiento);
        document.detachEvent("onmouseup", finMovimiento);
    }
    if(navegador==1)
    {
        document.removeEventListener("mousemove", enMovimiento, true);
        document.removeEventListener("mouseup", finMovimiento, true);
    }
}