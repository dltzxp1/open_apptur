<?php

require_once("clsConexion.php");

class provincia extends conexion {

    var $pr_id;
    var $pr_nombre;
    var $pr_descripcion;
    var $pr_capital;
    var $pr_poblacion;
    var $pr_region;
    
    var $arregloProvincia;

    function provincia($pr_id) {
        if ($pr_id != '') {
            if ($pr_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM provincia WHERE pr_id=$pr_id by pr_nombre ASC;";
            } else {
                $this->arregloProvincia = array();
                $queryBusqueda = "SELECT * FROM provincia order by pr_nombre ASC;";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setProvincia($result);
                if ($indice != -1)
                    $this->arregloProvincia[$indice] = $this->setArregloProvincia($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setProvincia($result) {
        $this->pr_id = $this->getField($result, 0);
        $this->pr_nombre = $this->getField($result, 1);
        $this->pr_descripcion = $this->getField($result, 2);
        $this->pr_capital = $this->getField($result, 3);
        $this->pr_poblacion = $this->getField($result, 4);
        $this->pr_region = $this->getField($result, 5);
    }

    function obtenerTamProvincia() {
        $script = "SELECT * FROM provincia";
        $this->arregloProvincia = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setProvincia($result);
            if ($indice != -1)
                $this->arregloProvincia[$indice] = $this->setArregloProvincia($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerPagin($script) {
        $this->arregloProvincia = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setProvincia($result);
            if ($indice != -1)
                $this->arregloProvincia[$indice] = $this->setArregloProvincia($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setArregloProvincia($result) {
        $provincia = new provincia(0);
        $provincia->pr_id = $this->getField($result, 0);
        $provincia->pr_nombre = $this->getField($result, 1);
        $provincia->pr_descripcion = $this->getField($result, 2);
        $provincia->pr_capital = $this->getField($result, 3);
        $provincia->pr_poblacion = $this->getField($result, 4);
        $provincia->pr_region = $this->getField($result, 5);
        return $provincia;
    }

    function insertarImagen($pr_nombre, $pr_descripcion, $pr_capital, $pr_poblacion, $pr_region) {
        $queryBusqueda = "INSERT INTO provincia (pr_nombre, pr_descripcion, pr_capital, pr_poblacion,pr_region)
          VALUES('$pr_nombre', '$pr_descripcion', '$pr_capital', $pr_poblacion,'$pr_region')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($pr_id) {
        $queryBusqueda = "DELETE FROM provincia WHERE pr_id=$pr_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($pr_id, $pr_nombre, $pr_descripcion, $pr_capital, $pr_poblacion, $pr_region) {
        $queryBusqueda = "UPDATE provincia SET pr_nombre='$pr_nombre',pr_descripcion='$pr_descripcion',pr_capital='$pr_capital',pr_poblacion=$pr_poblacion,pr_region='$pr_region' WHERE pr_id=$pr_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>