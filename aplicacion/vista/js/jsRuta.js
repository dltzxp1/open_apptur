function editRuta(pr_id,ca_id,cat_id,si_id,ru_id){
    $.getJSON('../../controlador/gestion/rutaConsultarCliente.php', {
        pr_id: pr_id,
        ca_id: ca_id,
        cat_id: cat_id,
        si_id: si_id,
        ru_id: ru_id
    }, function(data) {
        agregarCapaEditarRuta(data[0]); 
    }); 
}
            
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
 
    var google_streets = new OpenLayers.Layer.Google(
        "Google Streets",
        {
            numZoomLevels: 20
        }
        );
                
    point_layer = new OpenLayers.Layer.Vector("Puntos",{
        style: {
            'fillColor': '#669933',
            'fillOpacity': .9,
            'pointRadius': 10,
            'cursor':'pointer',
            'externalGraphic': '../img/marker.png'
        }
    });
    osm = new OpenLayers.Layer.OSM(); 
    editingControl = new OpenLayers.Control.EditingToolbar(point_layer);
    modifyControl = new OpenLayers.Control.ModifyFeature(point_layer, {
        toggle: true
    });
    editingControl.addControls([modifyControl]); 
    map.addLayers([osm,google_streets,point_layer,mapQuest]); 
    map.addControl(new OpenLayers.Control.LayerSwitcher());
    map.addControl(new OpenLayers.Control.MousePosition());  
    map.zoomToExtent(new OpenLayers.Bounds(-78.72,-5.10,-77.80,1.14).transform(map.displayProjection,map.projection));
}

function establecerCapa(){
    map.removeLayer(point_layer);
    point_layer = new OpenLayers.Layer.Vector("Ruta",{
        style: {
            'fillColor': '#669933',
            'fillOpacity': .9,
            'pointRadius': 10,
            'cursor':'pointer',
            'externalGraphic': '../vista/img/marker.png'
        }
    });
    editingControl = new OpenLayers.Control.EditingToolbar(point_layer); 
    modifyControl = new OpenLayers.Control.ModifyFeature(point_layer, {
        toggle: true
    }); 
    editingControl.addControls([modifyControl]);
    map.addLayers([point_layer]);
}
 
function borrarFeatures(){
    point_layer.removeAllFeatures()
}

var latitu;
var longit;
 
function js(){
    this.latitu=latitu;
    this.longit=longit; 
}

function getLat(){
    return this.latitu;
}
function getLon(){
    return this.longit;
}
function obtenerPunto(){
    var tam=point_layer.features.length-1;
    point_layer.features[tam].geometry.transform(map.getProjectionObject(),new OpenLayers.Projection("EPSG:4326"));
    latitu=point_layer.features[tam].geometry.x;
    longit=point_layer.features[tam].geometry.y;
//for(i=0; i<point_layer.features.length;i++){ todos los puntos. } 
} 

var vertices;

function js2(){
    this.vertices=vertices;
}
function getVertices(){
    return this.vertices;
} 
 
function obtenerRuta(){
    var tam=point_layer.features.length-1;
    point_layer.features[tam].geometry.transform(map.getProjectionObject(),new OpenLayers.Projection("EPSG:4326"));
    vertices =point_layer.features[tam].geometry.getVertices();
} 

          

function agregarCapaEditarRuta(a){
    var style = { 
        strokeColor: 'red',
        strokeOpacity: 0.5,
        strokeWidth: 5        
    };
    var elem = a.split('LINESTRING');
    var dia = elem[1]; 
    var elem2 = dia.split('(');
    var dia2 = elem2[1];
    var elem3 = dia2.split(')');
    var dia3 = elem3[0];
    var elem4 = dia3.split(','); 
    var points = []; 
    var elem5 ; 
    var punto;
    for(i=0;i<elem4.length;i++){
        elem5 = elem4[i].split(' ');
        if(i==0){
            agregarCapaEditarIni(elem5[0],elem5[1]);
        }
        if(i==elem4.length-1){
            agregarCapaEditarFin(elem5[0],elem5[1]);
        }
        punto=new OpenLayers.Geometry.Point(elem5[0],elem5[1]).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject());
        points.push(punto);
    }

    var feature = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.LineString(points));
    var selected_polygon_style = {
        strokeWidth: 5,
        strokeColor: '#0000FF'
    };

    feature.style = selected_polygon_style;
    point_layer.addFeatures(feature);
    map.addLayer(point_layer);
}
var feature;

function agregarCapaEditar(ca_latitud,ca_longitud){
    feature = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(ca_latitud,ca_longitud).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject()),
    {
        some:'datadatadata'
    },
    {
        externalGraphic: '../img/markerMap.png',
        graphicHeight: 25, 
        graphicWidth: 25
    });
    point_layer.addFeatures(feature);
    map.addLayer(point_layer);
}

function agregarCapaEditarIni(ca_latitud,ca_longitud){
    feature = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(ca_latitud,ca_longitud).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject()),
    {
        some:'datadatadata'
    },
    {
        externalGraphic: '../img/markerGreen.png',
        graphicHeight: 25, 
        graphicWidth: 25
    });
    point_layer.addFeatures(feature);
    map.addLayer(point_layer);
}

function agregarCapaEditarFin(ca_latitud,ca_longitud){
    feature = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(ca_latitud,ca_longitud).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject()),
    {
        some:'datadatadata'
    },
    {
        externalGraphic: '../img/markerMap.png',
        graphicHeight: 25, 
        graphicWidth: 25
    });
    point_layer.addFeatures(feature);
    map.addLayer(point_layer);
}
function agregarPunto(ca_latitud,ca_longitud){
    feature = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(ca_latitud,ca_longitud).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject()),
    {
        some:'datadatadata'
    },
    {
        externalGraphic: '../img/markerMap.png',
        graphicHeight: 25, 
        graphicWidth: 25
    });
    point_layer.addFeatures(feature);
    map.addLayer(point_layer);
//map.zoomToExtent(new OpenLayers.Bounds(-78.72,-5.10,-77.80,1.14).transform(map.displayProjection,map.projection));
}
 