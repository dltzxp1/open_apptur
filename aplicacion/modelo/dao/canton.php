<?php

require_once("clsConexion.php");

class canton extends conexion {

    var $pr_id;
    var $ca_id;
    var $ca_nombre;
    var $ca_descripcion;
    var $ca_poblacion; 
    var $arregloCanton;

    function canton($pr_id, $ca_id) {
        if ($pr_id != '') {
            if ($ca_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM canton WHERE pr_id=$pr_id AND ca_id=$ca_id order by ca_nombre ASC;";
            } else {
                $this->arregloCanton = array();
                $queryBusqueda = "SELECT * FROM canton where pr_id=$pr_id order by ca_nombre;";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setCanton($result);
                if ($indice != -1)
                    $this->arregloCanton[$indice] = $this->setArregloCanton($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setCanton($result) {
        $this->pr_id = $this->getField($result, 0);
        $this->ca_id = $this->getField($result, 1);
        $this->ca_nombre = $this->getField($result, 2);
        $this->ca_descripcion = $this->getField($result, 3);
        $this->ca_poblacion = $this->getField($result, 4);
    }

    function setArregloCanton($result) {
        $canton = new canton(0, 0);
        $canton->pr_id = $this->getField($result, 0);
        $canton->ca_id = $this->getField($result, 1);
        $canton->ca_nombre = $this->getField($result, 2);
        $canton->ca_descripcion = $this->getField($result, 3);
        $canton->ca_poblacion = $this->getField($result, 4);
        return $canton;
    }

    function insertarImagen($pr_id, $ca_nombre, $ca_descripcion, $ca_poblacion) {
        $queryBusqueda = "INSERT INTO canton (pr_id,ca_nombre, ca_descripcion,ca_poblacion)
          VALUES($pr_id,'$ca_nombre', '$ca_descripcion',$ca_poblacion)";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($pr_id, $ca_id, $ca_nombre, $ca_descripcion, $ca_poblacion) {
        $queryBusqueda = "UPDATE canton SET ca_nombre='$ca_nombre',ca_descripcion='$ca_descripcion',ca_poblacion=$ca_poblacion WHERE pr_id=$pr_id AND ca_id=$ca_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function obtenerTamCanton() {
        $script = "SELECT * FROM canton";
        $this->arregloCanton = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setCanton($result);
            if ($indice != -1)
                $this->arregloCanton[$indice] = $this->setArregloCanton($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloCanton = array();
        $queryBusqueda = "SELECT * FROM canton;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setCanton($result);
            if ($indice != -1)
                $this->arregloCanton[$indice] = $this->setArregloCanton($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerPagin($script) {
        $this->arregloCanton = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setCanton($result);
            if ($indice != -1)
                $this->arregloCanton[$indice] = $this->setArregloCanton($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function eliminar($pr_id, $ca_id) {
        $queryBusqueda = "DELETE FROM canton WHERE pr_id=$pr_id AND ca_id=$ca_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>