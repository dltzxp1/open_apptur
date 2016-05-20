<?php

require_once("clsConexion.php");

class festivo extends conexion {

    var $pr_id;
    var $ca_id;
    var $cat_id;
    var $si_id;
    var $fe_id;
    var $fe_nombre;
    var $fe_descripcion;
    var $fe_fechainicio;
    var $fe_fechafin;
    var $em_id;
    var $us_id;
    var $arregloFestivo;

    function festivo($pr_id, $ca_id, $cat_id, $si_id, $fe_id, $em_id, $us_id) {
        if ($pr_id != '') {
            if ($fe_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM festivo WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id  AND si_id=$si_id AND fe_id=$fe_id  AND em_id=$em_id AND us_id=$us_id order by fe_nombre ASC";
            } else {
                $this->arregloFestivo = array();
                $queryBusqueda = "SELECT * FROM festivo where pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id  AND em_id=$em_id AND us_id=$us_id order by fe_nombre ASC";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setFestivo($result);
                if ($indice != -1)
                    $this->arregloFestivo[$indice] = $this->setArregloFestivo($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setFestivo($result) {
        $this->pr_id = $this->getField($result, 0);
        $this->ca_id = $this->getField($result, 1);
        $this->cat_id = $this->getField($result, 2);
        $this->si_id = $this->getField($result, 3);
        $this->fe_id = $this->getField($result, 4);
        $this->fe_nombre = $this->getField($result, 5);
        $this->fe_descripcion = $this->getField($result, 6);
        $this->fe_fechainicio = $this->getField($result, 7);
        $this->fe_fechafin = $this->getField($result, 8);
        $this->em_id = $this->getField($result, 9);
        $this->us_id = $this->getField($result, 10);
    }

    function setArregloFestivo($result) {
        $festivo = new festivo(0, 0, 0, 0, 0, 0, 0);
        $festivo->pr_id = $this->getField($result, 0);
        $festivo->ca_id = $this->getField($result, 1);
        $festivo->cat_id = $this->getField($result, 2);
        $festivo->si_id = $this->getField($result, 3);
        $festivo->fe_id = $this->getField($result, 4);
        $festivo->fe_nombre = $this->getField($result, 5);
        $festivo->fe_descripcion = $this->getField($result, 6);
        $festivo->fe_fechainicio = $this->getField($result, 7);
        $festivo->fe_fechafin = $this->getField($result, 8);
        $festivo->em_id = $this->getField($result, 9);
        $festivo->us_id = $this->getField($result, 10);
        return $festivo;
    }

    /* Controla que ingrese solo un numero de festivo asignados */

    function obtenerTamFestivo($em_id, $us_id, $si_id) {
        $script = "SELECT * FROM festivo where em_id=$em_id AND us_id=$us_id AND si_id=$si_id";
        $this->arregloFestivo = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFestivo($result);
            if ($indice != -1)
                $this->arregloFestivo[$indice] = $this->setArregloFestivo($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloFestivo = array();
        $queryBusqueda = "SELECT * FROM festivo;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setFestivo($result);
            if ($indice != -1)
                $this->arregloFestivo[$indice] = $this->setArregloFestivo($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTam() {
        $script = 'SELECT count(*) FROM festivo';
        $result = $this->select($script);
        $array = explode('count', $result);
        return $array[1];
    }

    function obtenerPagin($script) {
        $this->arregloFestivo = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFestivo($result);
            if ($indice != -1)
                $this->arregloFestivo[$indice] = $this->setArregloFestivo($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function insertar($pr_id, $ca_id, $cat_id, $si_id, $fe_nombre, $fe_descripcion, $fe_fechainicio, $fe_fechafin, $em_id, $us_id) {
        $queryBusqueda = "INSERT INTO festivo (pr_id,ca_id,cat_id,si_id,fe_nombre,fe_descripcion,fe_fechainicio,fe_fechafin,em_id,us_id)
                VALUES($pr_id,$ca_id,$cat_id,$si_id,'$fe_nombre','$fe_descripcion','$fe_fechainicio','$fe_fechafin',$em_id,$us_id)";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($pr_id, $ca_id, $cat_id, $si_id, $fe_id, $fe_nombre, $fe_descripcion, $fe_fechainicio, $fe_fechafin, $em_id, $us_id) {
        $queryBusqueda = "UPDATE festivo SET fe_nombre='$fe_nombre',fe_descripcion='$fe_descripcion',fe_fechainicio='$fe_fechainicio',fe_fechafin='$fe_fechafin' WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND fe_id=$fe_id AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($pr_id, $ca_id, $cat_id, $si_id, $fe_id, $em_id, $us_id) {
        $queryBusqueda = "DELETE FROM festivo WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND fe_id=$fe_id AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function historiaConsFestivo($script) {
        $this->arregloFestivo = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFestivo($result);
            if ($indice != -1)
                $this->arregloFestivo[$indice] = $this->setArregloFestivo($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function festivoConsPagina($script) {
        $this->arregloFestivo = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFestivo($result);
            if ($indice != -1)
                $this->arregloFestivo[$indice] = $this->setArregloFestivo($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>