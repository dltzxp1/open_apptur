var map; 
var point_layer;
var osm;
var mapQuest;
var editingControl;
var modifyControl ;
var pointLayer ;

function init() {
    arrayOSM = ["http://otile1.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg",
    "http://otile2.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg",
    "http://otile3.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg",
    "http://otile4.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg"]; 
    mapQuest = new OpenLayers.Layer.OSM("MapQuest", arrayOSM); 
    
    map = new OpenLayers.Map('map', {
        maxResolution: 156543.0339,
        units: 'm',
        projection: new OpenLayers.Projection('EPSG:900913'),
        displayProjection: new OpenLayers.Projection("EPSG:4326")
    });
                
    point_layer = new OpenLayers.Layer.Vector("Puntos",{
        style: {
            'fillColor': '#669933',
            'fillOpacity': .9,
            // 'strokeColor': '#aaee77',
            //'strokeWidth': 3,
            //'graphicHeight': 25,
            // 'graphicWidth': 20,
            'pointRadius': 10,
            'cursor':'pointer',
            //'externalGraphic': 'http://www.openlayers.org/dev/img/marker.png'
            'externalGraphic': '../img/marker.png'
        }
    });
    var google_streets = new OpenLayers.Layer.Google(
        "Google Streets",
        {
            numZoomLevels: 20
        }
        );
            
         
    pointLayer = new OpenLayers.Layer.Vector("Editar");
    osm = new OpenLayers.Layer.OSM();
    map.addLayers([google_streets,mapQuest,osm]);
    
    map.addControl(new OpenLayers.Control.LayerSwitcher());
    map.addControl(new OpenLayers.Control.MousePosition());
    editingControl = new OpenLayers.Control.EditingToolbar(point_layer);
    modifyControl = new OpenLayers.Control.ModifyFeature(point_layer, {
        toggle: true
    });
    editingControl.addControls([modifyControl]);
    map.zoomToExtent(new OpenLayers.Bounds(-78.72,-5.10,-77.80,1.14).transform(map.displayProjection,map.projection));
}
var features = [];

 
var j=1;
function graFicarbuscarSitioMapa(arreglo){
    if(j<11){
        j++;
        for(var i = 0; i < arreglo.length; i++) {
            features[i] = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(arreglo[i][0],arreglo[i][1]).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject()), 
            {
                lati:arreglo[i][0],
                longi:arreglo[i][1],
                nombre:arreglo[i][2],
                paginaweb:arreglo[i][3],
                mail:arreglo[i][4], 
                facebook:arreglo[i][5], 
                twitter:arreglo[i][6],
                direccion:arreglo[i][7],
                telefono:arreglo[i][8]
            }, {
                strokeOpacity : 1,
                strokeWidth : 18,
                pointRadius : 18, 
                cursor:'Pointer',
                externalGraphic: 'aplicacion/vista/js/OpenLayers/img/img'+arreglo[i][9]+'.png'
            });
            r=arreglo[i][10];
        }
        point_layer= new OpenLayers.Layer.Vector(""+r,{
            eventListeners:{
                'featureselected':function(evt){
                    var feature = evt.feature;
                    var popup = new OpenLayers.Popup.FramedCloud(
                        "popup",
                        OpenLayers.LonLat.fromString(feature.geometry.toShortString()),
                        null,
                        "<div class='alert alert-info' style='width:400px;'> \n\
                    <table>\n\
                    <tr> <td><strong>Nombre:</strong></td><td> "+feature.attributes.nombre +" </td></tr>\n\
                    <tr> <td>Latitud:</td> <td> "+feature.attributes.lati +" </td></tr>\n\
                    <tr> <td>Longitud:</td><td> "+feature.attributes.lati +" </td></tr>\n\
                    <tr> <td><img src='aplicacion/vista/img/network.png' /></td> <td> <a href="+ feature.attributes.paginaweb +">"+feature.attributes.paginaweb+"</a> </td></tr>\n\
                    <tr> <td><img src='aplicacion/vista/img/mail.png' /></td><td> "+feature.attributes.mail +" </td></tr>\n\
                    <tr> <td><img src='aplicacion/vista/img/FaceBook.png' /></td><td> "+feature.attributes.facebook +" </td></tr>\n\
                    <tr> <td><img src='aplicacion/vista/img/twitter.png' /></td><td> "+feature.attributes.twitter +" </td></tr>\n\
                    <tr> <td><img src='aplicacion/vista/img/direction.png' /></td><td> "+feature.attributes.direccion +" </td></tr>\n\
                    <tr> <td><img src='aplicacion/vista/img/telephone.png' /></td><td> "+feature.attributes.telefono +" </td></tr>\n\
                    </table>\n\
                    </div>",
                        null, 
                        true
                        );
                    feature.popup = popup;
                    map.addPopup(popup);
                },
                'featureunselected':function(evt){
                    var feature = evt.feature;
                    map.removePopup(feature.popup);
                    feature.popup.destroy();
                    feature.popup = null;
                }
            }
        });
    
        point_layer.addFeatures(features);
        features=[];
        var selector = new OpenLayers.Control.SelectFeature(point_layer,{
            click:true,
            autoActivate:true
        });
        map.addLayers([osm,point_layer]); 
        map.addControl(selector);
    }else{
        location.reload();
    }
}

function establecerCapaIndex(){
    map.removeLayer(point_layer);
    point_layer = new OpenLayers.Layer.Vector("Busquedas",{
        style: {
            'fillColor': '#669933',
            'fillOpacity': .9,
            'pointRadius': 10,
            'cursor':'pointer',
            'externalGraphic': 'aplicacion/vista/js/OpenLayers/img/markerMap.png'
        } 
    });
    editingControl = new OpenLayers.Control.EditingToolbar(point_layer); 
    modifyControl = new OpenLayers.Control.ModifyFeature(point_layer, {
        toggle: true
    }); 
    editingControl.addControls([modifyControl]);
    map.addLayers([point_layer]);
    map.addControl(new OpenLayers.Control.EditingToolbar(point_layer));
    map.addControl(editingControl);
}