<?php

require_once("clsConexion.php");

class historia extends conexion {

    var $pr_id;
    var $ca_id;
    var $cat_id;
    var $si_id;
    var $hi_id;
    var $hi_nombre;
    var $hi_descripcion;
    var $em_id;
    var $us_id;
    var $arregloHistoria;

    function historia($pr_id, $ca_id, $cat_id, $si_id, $hi_id, $em_id, $us_id) {
        if ($pr_id != '') {
            if ($hi_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM historia WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id  AND si_id=$si_id AND hi_id=$hi_id AND em_id=$em_id AND us_id=$us_id order by hi_nombre ASC";
            } else {
                $this->arregloHistoria = array();
                $queryBusqueda = "SELECT * FROM historia where pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id  AND em_id=$em_id AND us_id=$us_id order by hi_nombre ASC";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setHistoria($result);
                if ($indice != -1)
                    $this->arregloHistoria[$indice] = $this->setArregloHistoria($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setHistoria($result) {
        $this->pr_id = $this->getField($result, 0);
        $this->ca_id = $this->getField($result, 1);
        $this->cat_id = $this->getField($result, 2);
        $this->si_id = $this->getField($result, 3);
        $this->hi_id = $this->getField($result, 4);
        $this->hi_nombre = $this->getField($result, 5);
        $this->hi_descripcion = $this->getField($result, 6);
        $this->em_id = $this->getField($result, 7);
        $this->us_id = $this->getField($result, 8);
    }

    function setArregloHistoria($result) {
        $historia = new historia(0, 0, 0, 0, 0, 0, 0);
        $historia->pr_id = $this->getField($result, 0);
        $historia->ca_id = $this->getField($result, 1);
        $historia->cat_id = $this->getField($result, 2);
        $historia->si_id = $this->getField($result, 3);
        $historia->hi_id = $this->getField($result, 4);
        $historia->hi_nombre = $this->getField($result, 5);
        $historia->hi_descripcion = $this->getField($result, 6);
        $historia->em_id = $this->getField($result, 7);
        $historia->us_id = $this->getField($result, 8);
        return $historia;
    }

    function obtenerTamHisto($em_id, $us_id, $si_id) {
        $script = "SELECT * FROM historia where em_id=$em_id AND us_id=$us_id AND si_id=$si_id";
        $this->arregloHistoria = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setHistoria($result);
            if ($indice != -1)
                $this->arregloHistoria[$indice] = $this->setArregloHistoria($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTamHis($em_id, $us_id, $si_id) {
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

    function obtenerPagin($script) {
        $this->arregloHistoria = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setHistoria($result);
            if ($indice != -1)
                $this->arregloHistoria[$indice] = $this->setArregloHistoria($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloHistoria = array();
        $queryBusqueda = "SELECT * FROM historia;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setHistoria($result);
            if ($indice != -1)
                $this->arregloHistoria[$indice] = $this->setArregloHistoria($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function insertar($pr_id, $ca_id, $cat_id, $si_id, $hi_nombre, $hi_descripcion, $em_id, $us_id) {
        $queryBusqueda = "INSERT INTO historia (pr_id,ca_id,cat_id,si_id,hi_nombre,hi_descripcion,em_id,us_id)
                VALUES($pr_id,$ca_id,$cat_id,$si_id,'$hi_nombre','$hi_descripcion',$em_id,$us_id)";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($pr_id, $ca_id, $cat_id, $si_id, $hi_id, $hi_nombre, $hi_descripcion, $em_id, $us_id) {
        $queryBusqueda = "UPDATE historia SET hi_nombre='$hi_nombre',hi_descripcion='$hi_descripcion' WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND hi_id=$hi_id AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($pr_id, $ca_id, $cat_id, $si_id, $hi_id, $em_id, $us_id) {
        $queryBusqueda = "DELETE FROM historia WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND hi_id=$hi_id AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function historiaConsPagina($script) {
        $this->arregloHistoria = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setHistoria($result);
            if ($indice != -1)
                $this->arregloHistoria[$indice] = $this->setArregloHistoria($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>