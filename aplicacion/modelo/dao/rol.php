<?php

require_once("clsConexion.php");

class rol extends conexion {

    var $em_id;
    var $us_id;
    var $ro_id;
    var $ro_nombre;
    var $ro_descripcion;
    var $arregloRol;
    var $filtroBusqueda;

    function rol($em_id, $us_id, $ro_id) {
        if ($em_id != '') {
            if ($ro_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM rol WHERE em_id=$em_id AND us_id=$us_id AND ro_id='$ro_id' order by ro_nombre ASC";
            } else {
                $this->arregloRol = array();
                $queryBusqueda = "SELECT * FROM rol where em_id=$em_id AND us_id=$us_id order by ro_nombre ASC";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setRol($result);
                if ($indice != -1)
                    $this->arregloRol[$indice] = $this->setArregloRol($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setRol($result) {
        $this->em_id = $this->getField($result, 0);
        $this->us_id = $this->getField($result, 1);
        $this->ro_id = $this->getField($result, 2);
        $this->ro_nombre = $this->getField($result, 3);
        $this->ro_descripcion = $this->getField($result, 4);
    }

    function setArregloRol($result) {
        $rol = new rol('0', '0', '0');
        $rol->em_id = $this->getField($result, 0);
        $rol->us_id = $this->getField($result, 1);
        $rol->ro_id = $this->getField($result, 2);
        $rol->ro_nombre = $this->getField($result, 3);
        $rol->ro_descripcion = $this->getField($result, 4);
        return $rol;
    }

    function obtenerTodo() {
        $this->arregloRol = array();
        $queryBusqueda = "SELECT * FROM rol;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setRol($result);
            if ($indice != -1)
                $this->arregloRol[$indice] = $this->setArregloRol($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function insertar($em_id, $us_id, $ro_nombre, $ro_descripcion) {
        $queryBusqueda = "INSERT INTO rol(em_id,us_id,ro_nombre,ro_descripcion)
        values($em_id,$us_id,'$ro_nombre','$ro_descripcion')";
        $result = $this->select($queryBusqueda);
        return $result; //true o false
    }

    function eliminar($em_id, $us_id, $ro_id) {
        $queryBusqueda = "DELETE FROM rol WHERE em_id=$em_id AND us_id=$us_id AND ro_id=$ro_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($em_id, $us_id, $ro_id, $ro_nom, $ro_des) {
        $queryBusqueda = "UPDATE rol SET ro_nombre='$ro_nom',ro_descripcion='$ro_des' WHERE em_id=$em_id AND us_id=$us_id AND ro_id=$ro_id";
        $result = $this->select($queryBusqueda);
        return $result; //true o false
    }

    /* Para Paginacion */

    function rolConsBusquedaPagina($script) {
        $this->arregloRol= array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setRol($result);
            if ($indice != -1)
                $this->arregloRol[$indice] = $this->setArregloRol($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>
