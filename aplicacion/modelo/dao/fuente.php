<?php

require_once("clsConexion.php");

class fuente extends conexion {

    var $id; 
    var $descripcion;
    var $arregloFuente;

    function fuente($id) {
        if ($id != '') {
            if ($id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM fuente WHERE id=$id";
            } else {
                $this->arregloFuente = array();
                $queryBusqueda = "SELECT * FROM fuente order by id ASC;";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setFuente($result);
                if ($indice != -1)
                    $this->arregloFuente[$indice] = $this->setArregloFuente($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setFuente($result) {
        $this->id = $this->getField($result, 0); 
        $this->descripcion = $this->getField($result, 1);
    }

    function setArregloFuente($result) {
        $fuente = new fuente(0);
        $fuente->id = $this->getField($result, 0); 
        $fuente->descripcion = $this->getField($result, 1);
        return $fuente;
    }

    function obtenerPagin($script) {
        $this->arregloFuente = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFuente($result);
            if ($indice != -1)
                $this->arregloFuente[$indice] = $this->setArregloFuente($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTam() {
        $script = 'SELECT count(*) FROM fuente';
        $result = $this->select($script);
        $array = explode('count', $result);
        return $array[1];
    }

    function insertar($cat_nombre, $descripcion) {
        $queryBusqueda = "INSERT INTO fuente (cat_nombre,descripcion) VALUES('$cat_nombre','$descripcion')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($id) {
        $queryBusqueda = "DELETE FROM fuente WHERE id=$id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($id, $cat_nombre, $descripcion) {
        $queryBusqueda = "UPDATE fuente SET cat_nombre='$cat_nombre',descripcion='$descripcion'WHERE id=$id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function fuenteConsPagina($script) {
        $this->arregloFuente = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFuente($result);
            if ($indice != -1)
                $this->arregloFuente[$indice] = $this->setArregloFuente($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>