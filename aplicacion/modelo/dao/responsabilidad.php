<?php

require_once("clsConexion.php");

class responsabilidad extends conexion {

    var $em_id;
    var $us_id;
    var $ro_id;
    var $re_id;
    var $re_nombre;
    var $re_descripcion;
    var $re_fec_mod;
    var $arregloResponsabilidad;

    function responsabilidad($em_id, $us_id, $ro_id, $re_id) {
        if ($em_id != '') {
            if ($re_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM responsabilidad WHERE em_id=$em_id AND us_id=$us_id AND ro_id=$ro_id AND re_id=$re_id order by re_nombre ASC";
            } else {
                $this->arregloResponsabilidad = array();
                $queryBusqueda = "SELECT * FROM responsabilidad WHERE em_id=$em_id AND us_id=$us_id AND ro_id=$ro_id order by re_nombre ASC";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setResponsabilidad($result);
                if ($indice != -1)
                    $this->arregloResponsabilidad[$indice] = $this->setArregloResponsabilidad($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setResponsabilidad($result) {
        $this->em_id = $this->getField($result, 0);
        $this->us_id = $this->getField($result, 1);
        $this->ro_id = $this->getField($result, 2);
        $this->re_id = $this->getField($result, 3);
        $this->re_nombre = $this->getField($result, 4);
        $this->re_descripcion = $this->getField($result, 5);
        $this->re_fec_mod = $this->getField($result, 6);
    }

    function setArregloResponsabilidad($result) {
        $responsabilidad = new responsabilidad(0, 0, 0, 0);
        $responsabilidad->em_id = $this->getField($result, 0);
        $responsabilidad->us_id = $this->getField($result, 1);
        $responsabilidad->ro_id = $this->getField($result, 2);
        $responsabilidad->re_id = $this->getField($result, 3);
        $responsabilidad->re_nombre = $this->getField($result, 4);
        $responsabilidad->re_descripcion = $this->getField($result, 5);
        $responsabilidad->re_fec_mod = $this->getField($result, 6);
        return $responsabilidad;
    }

    function insertar($em_id, $us_id, $ro_id, $re_nombre, $re_descripcion) {
        $queryBusqueda = "INSERT INTO responsabilidad (em_id,us_id,ro_id,re_nombre,re_descripcion,re_fec_mod) VALUES ($em_id,$us_id,$ro_id,'$re_nombre','$re_descripcion', CURRENT_TIMESTAMP)";
        $result = $this->select($queryBusqueda);
        return $result; //true o false
    }

    function eliminar($em_id, $us_id, $ro_id, $re_id) {
        $queryBusqueda = "DELETE FROM responsabilidad WHERE em_id=$em_id AND us_id=$us_id AND ro_id=$ro_id AND re_id=$re_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($em_id, $us_id, $ro_id, $re_id, $re_nombre, $re_descripcion) {
        $queryBusqueda = "UPDATE responsabilidad SET re_nombre='$re_nombre',re_descripcion='$re_descripcion' where em_id=$em_id AND us_id=$us_id AND ro_id=$ro_id AND re_id=$re_id";
        $result = $this->select($queryBusqueda);
        return $result; //true o false
    }

    function responConsPagina($script) {
        $this->arregloResponsabilidad = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setResponsabilidad($result);
            if ($indice != -1)
                $this->arregloResponsabilidad[$indice] = $this->setArregloResponsabilidad($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>