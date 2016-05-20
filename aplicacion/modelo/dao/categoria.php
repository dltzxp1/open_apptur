<?php

require_once("clsConexion.php");

class categoria extends conexion {

    var $cat_id;
    var $cat_nombre;
    var $cat_descripcion;
    var $arregloCategoria;

    function categoria($cat_id) {
        if ($cat_id != '') {
            if ($cat_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM categoria WHERE cat_id=$cat_id order by cat_nombre ASC;";
            } else {
                $this->arregloCategoria = array();
                $queryBusqueda = "SELECT * FROM categoria order by cat_nombre ASC;";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setCategoria($result);
                if ($indice != -1)
                    $this->arregloCategoria[$indice] = $this->setArregloCategoria($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setCategoria($result) {
        $this->cat_id = $this->getField($result, 0);
        $this->cat_nombre = $this->getField($result, 1);
        $this->cat_descripcion = $this->getField($result, 2);
    }

    function setArregloCategoria($result) {
        $categoria = new categoria(0);
        $categoria->cat_id = $this->getField($result, 0);
        $categoria->cat_nombre = $this->getField($result, 1);
        $categoria->cat_descripcion = $this->getField($result, 2);
        return $categoria;
    }

    function obtenerPagin($script) {
        $this->arregloCategoria = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setCategoria($result);
            if ($indice != -1)
                $this->arregloCategoria[$indice] = $this->setArregloCategoria($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTam() {
        $script = 'SELECT count(*) FROM categoria';
        $result = $this->select($script);
        $array = explode('count', $result);
        return $array[1];
    }

    function insertar($cat_nombre, $cat_descripcion) {
        $queryBusqueda = "INSERT INTO categoria (cat_nombre,cat_descripcion) VALUES('$cat_nombre','$cat_descripcion')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($cat_id) {
        $queryBusqueda = "DELETE FROM categoria WHERE cat_id=$cat_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($cat_id, $cat_nombre, $cat_descripcion) {
        $queryBusqueda = "UPDATE categoria SET cat_nombre='$cat_nombre',cat_descripcion='$cat_descripcion'WHERE cat_id=$cat_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function categoriaConsPagina($script) {
        $this->arregloCategoria = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setCategoria($result);
            if ($indice != -1)
                $this->arregloCategoria[$indice] = $this->setArregloCategoria($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>