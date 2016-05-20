<?php

require_once("clsConexion.php");

class ruta extends conexion {

    var $pr_id;
    var $ca_id;
    var $cat_id;
    var $si_id;
    var $ru_id;
    var $ru_nombre;
    var $ru_descripcion;
    var $em_id;
    var $us_id;
    var $ru_ruta;
    var $arregloRuta;

    function ruta($pr_id, $ca_id, $cat_id, $si_id, $ru_id, $em_id, $us_id) {
        if ($pr_id != '') {
            if ($ru_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM ruta WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id  AND si_id=$si_id AND ru_id=$ru_id AND em_id=$em_id AND us_id=$us_id order by ru_nombre ASC";
            } else {
                $this->arregloRuta = array();
                $queryBusqueda = "SELECT * FROM ruta WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id  AND em_id=$em_id AND us_id=$us_id order by ru_nombre ASC";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setRuta($result);
                if ($indice != -1)
                    $this->arregloRuta[$indice] = $this->setArregloRuta($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setRuta($result) {
        $this->pr_id = $this->getField($result, 0);
        $this->ca_id = $this->getField($result, 1);
        $this->cat_id = $this->getField($result, 2);
        $this->si_id = $this->getField($result, 3);
        $this->ru_id = $this->getField($result, 4);
        $this->ru_nombre = $this->getField($result, 5);
        $this->ru_descripcion = $this->getField($result, 6);
        $this->em_id = $this->getField($result, 7);
        $this->us_id = $this->getField($result, 8);
        $this->ru_ruta = $this->getField($result, 9);
    }

    function setArregloRuta($result) {
        $ruta = new ruta(0, 0, 0, 0, 0, 0, 0);
        $ruta->pr_id = $this->getField($result, 0);
        $ruta->ca_id = $this->getField($result, 1);
        $ruta->cat_id = $this->getField($result, 2);
        $ruta->si_id = $this->getField($result, 3);
        $ruta->ru_id = $this->getField($result, 4);
        $ruta->ru_nombre = $this->getField($result, 5);
        $ruta->ru_descripcion = $this->getField($result, 6);
        $ruta->em_id = $this->getField($result, 7);
        $ruta->us_id = $this->getField($result, 8);
        $ruta->ru_ruta = $this->getField($result, 9);
        return $ruta;
    }

    function obtenerTamRut($em_id, $us_id, $si_id) {
        $script = "SELECT * FROM ruta where em_id=$em_id AND us_id=$us_id AND si_id=$si_id";
        $this->arregloRuta = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setRuta($result);
            if ($indice != -1)
                $this->arregloRuta[$indice] = $this->setArregloRuta($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTam() {
        $script = 'SELECT count(*) FROM ruta';
        $result = $this->select($script);
        $array = explode('count', $result);
        return $array[1];
    }

    function obtenerPagin($script) {
        $this->arregloRuta = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setRuta($result);
            if ($indice != -1)
                $this->arregloRuta[$indice] = $this->setArregloRuta($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloRuta = array();
        $queryBusqueda = "SELECT * FROM ruta;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setRuta($result);
            if ($indice != -1)
                $this->arregloRuta[$indice] = $this->setArregloRuta($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function insertar($pr_id, $ca_id, $cat_id, $si_id, $ru_nombre, $ru_descripcion, $em_id, $us_id, $ru_ruta) {
        $query = "INSERT INTO ruta (pr_id,ca_id,cat_id,si_id,ru_nombre,ru_descripcion,em_id,us_id,ru_ruta) ";
        $query .= "VALUES ($pr_id,$ca_id,$cat_id,$si_id,'$ru_nombre','$ru_descripcion',$em_id,$us_id, GeometryFromText('LINESTRING(";
        $lim = count($ru_ruta) - 1;
        for ($i = 0; $i < count($ru_ruta); $i++) {
            if ($i == $lim)
                $query .= $ru_ruta[$i][0] . " " . $ru_ruta[$i][1];
            else
                $query .= $ru_ruta[$i][0] . " " . $ru_ruta[$i][1] . ",";
        }
        $query .= ")', 4326))";
        return $this->select($query);
    }

    function selectLine($pr_id, $ca_id, $cat_id, $si_id, $ru_id, $em_id, $us_id) {
        $query = "SELECT ST_AsText(ru_ruta) as geom from ruta ";
        $query .= "WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND ru_id=$ru_id AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($query);
        $indice = 0;
        $this->arregloRuta = array();
        while (!$this->siguiente($result)) {
            $this->arregloRuta[$indice] = $this->setArregloRuta($result);
            $result->MoveNext();
            $indice++;
        }
        return $result;
    }

    function selectLineCliente($pr_id, $ca_id, $cat_id, $si_id, $ru_id) {
        $query = "SELECT ST_AsText(ru_ruta) as geom from ruta ";
        $query .= "WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND ru_id=$ru_id";
        $result = $this->select($query);
        $indice = 0;
        $this->arregloRuta = array();
        while (!$this->siguiente($result)) {
            $this->arregloRuta[$indice] = $this->setArregloRuta($result);
            $result->MoveNext();
            $indice++;
        }
        return $result;
    }

    function actualiza($pr_id, $ca_id, $cat_id, $si_id, $ru_id, $ru_nombre, $ru_descripcion, $em_id, $us_id, $vertices) {
        $query = "UPDATE ruta SET ru_nombre='$ru_nombre',ru_descripcion='$ru_descripcion',ru_ruta=GeometryFromText('LINESTRING(";
        $lim = count($vertices) - 1;
        for ($i = 0; $i < count($vertices); $i++) {
            if ($i == $lim)
                $query .= $vertices[$i][0] . " " . $vertices[$i][1];
            else
                $query .= $vertices[$i][0] . " " . $vertices[$i][1] . ",";
        }
        $query .= ")', 4326) ";
        $query .=" WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND ru_id=$ru_id AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($query);
        return $result;
    }

    function eliminar($pr_id, $ca_id, $cat_id, $si_id, $ru_id, $em_id, $us_id) {
        $queryBusqueda = "DELETE FROM ruta WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND ru_id=$ru_id AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function rutaConsPagina($script) {
        $this->arregloRuta = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setRuta($result);
            if ($indice != -1)
                $this->arregloRuta[$indice] = $this->setArregloRuta($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>