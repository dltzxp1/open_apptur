<?php

require_once("clsConexion.php");

class gastronomia extends conexion {

    var $pr_id;
    var $ca_id;
    var $cat_id;
    var $si_id;
    var $ga_id;
    var $ga_nombre;
    var $ga_descripcion;
    var $ga_fecha;
    var $ga_archivo_nombre;
    var $ga_archivo_bytea;
    var $ga_archivo_oid;
    var $ga_mime;
    var $size;
    var $em_id;
    var $us_id;
    var $arregloGastronomia;

    function gastronomia($pr_id, $ca_id, $cat_id, $si_id, $ga_id, $em_id, $us_id) {
        if ($pr_id != '') {
            if ($ga_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM gastronomia WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id  AND si_id=$si_id AND ga_id=$ga_id  AND em_id=$em_id AND us_id=$us_id order by ga_nombre ASC";
            } else {
                $this->arregloGastronomia = array();
                $queryBusqueda = "SELECT * FROM gastronomia where pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by ga_nombre ASC";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setGastronomia($result);
                if ($indice != -1)
                    $this->arregloGastronomia[$indice] = $this->setArregloGastronomia($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setGastronomia($result) {
        $this->pr_id = $this->getField($result, 0);
        $this->ca_id = $this->getField($result, 1);
        $this->cat_id = $this->getField($result, 2);
        $this->si_id = $this->getField($result, 3);
        $this->ga_id = $this->getField($result, 4);
        $this->ga_nombre = $this->getField($result, 5);
        $this->ga_descripcion = $this->getField($result, 6);
        $this->ga_fecha = $this->getField($result, 7);
        $this->ga_archivo_nombre = $this->getField($result, 8);
        $this->ga_archivo_bytea = $this->getField($result, 9);
        $this->ga_archivo_oid = $this->getField($result, 10);
        $this->ga_mime = $this->getField($result, 11);
        $this->size = $this->getField($result, 12);
        $this->em_id = $this->getField($result, 13);
        $this->us_id = $this->getField($result, 14);
    }

    function setArregloGastronomia($result) {
        $gastronomia = new gastronomia(0, 0, 0, 0, 0, 0, 0);
        $gastronomia->pr_id = $this->getField($result, 0);
        $gastronomia->ca_id = $this->getField($result, 1);
        $gastronomia->cat_id = $this->getField($result, 2);
        $gastronomia->si_id = $this->getField($result, 3);
        $gastronomia->ga_id = $this->getField($result, 4);
        $gastronomia->ga_nombre = $this->getField($result, 5);
        $gastronomia->ga_descripcion = $this->getField($result, 6);
        $gastronomia->ga_fecha = $this->getField($result, 7);
        $gastronomia->ga_archivo_nombre = $this->getField($result, 8);
        $gastronomia->ga_archivo_bytea = $this->getField($result, 9);
        $gastronomia->ga_archivo_oid = $this->getField($result, 10);
        $gastronomia->ga_mime = $this->getField($result, 11);
        $gastronomia->size = $this->getField($result, 12);
        $gastronomia->em_id = $this->getField($result, 13);
        $gastronomia->us_id = $this->getField($result, 14);
        return $gastronomia;
    }

    /* Controla que ingrese solo un numero de gastronomia asignados */

    function obtenerTamGas($em_id, $us_id, $si_id) {
        $script = "SELECT * FROM gastronomia where em_id=$em_id AND us_id=$us_id AND si_id=$si_id";
        $this->arregloGastronomia = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setGastronomia($result);
            if ($indice != -1)
                $this->arregloGastronomia[$indice] = $this->setArregloGastronomia($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTam() {
        $script = 'SELECT count(*) FROM gastronomia';
        $result = $this->select($script);
        $array = explode('count', $result);
        return $array[1];
    }

    function obtenerPagin($script) {
        $this->arregloGastronomia = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setGastronomia($result);
            if ($indice != -1)
                $this->arregloGastronomia[$indice] = $this->setArregloGastronomia($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloGastronomia = array();
        $queryBusqueda = "SELECT * FROM gastronomia;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setGastronomia($result);
            if ($indice != -1)
                $this->arregloGastronomia[$indice] = $this->setArregloGastronomia($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function insertar($queryBusqueda) {
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($pr_id, $ca_id, $cat_id, $si_id, $ga_id, $em_id, $us_id) {
        $queryBusqueda = "DELETE FROM gastronomia WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND ga_id=$ga_id  AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function gastronomiaConsBusqueda($script) {
        $this->arregloGastronomia = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setGastronomia($result);
            if ($indice != -1)
                $this->arregloGastronomia[$indice] = $this->setArregloGastronomia($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function gastronomiaConsPagina($script) {
        $this->arregloGastronomia = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setGastronomia($result);
            if ($indice != -1)
                $this->arregloGastronomia[$indice] = $this->setArregloGastronomia($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>