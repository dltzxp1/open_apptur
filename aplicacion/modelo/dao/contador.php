<?php

require_once("clsConexion.php");

class contador extends conexion {

    var $id;
    var $ip;
    var $hora;
    var $fecha;
    var $horau;
    var $diau;
    var $aniou;
    var $arregloContador;

    function contador($id) {
        if ($id != '') {
            if ($id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM contador WHERE id=$id";
            } else {
                $this->arregloContador = array();
                $queryBusqueda = "SELECT * FROM contador order by id ASC;";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setContador($result);
                if ($indice != -1)
                    $this->arregloContador[$indice] = $this->setArregloContador($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setContador($result) {
        $this->id = $this->getField($result, 0);
        $this->ip = $this->getField($result, 1);
        $this->hora = $this->getField($result, 2);
        $this->fecha = $this->getField($result, 3);
        $this->horau = $this->getField($result, 4);
        $this->diau = $this->getField($result, 5);
        $this->aniou = $this->getField($result, 6);
    }

    function setArregloContador($result) {
        $contador = new contador(0);
        $contador->id = $this->getField($result, 0);
        $contador->ip = $this->getField($result, 1);
        $contador->hora = $this->getField($result, 2);
        $contador->fecha = $this->getField($result, 3);
        $contador->horau = $this->getField($result, 4);
        $contador->diau = $this->getField($result, 5);
        $contador->aniou = $this->getField($result, 6);
        return $contador;
    }

    function obtenerPagin($script) {
        $this->arregloContador= array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setContador($result);
            if ($indice != -1)
                $this->arregloContador[$indice] = $this->setArregloContador($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTam() {
        $script = 'SELECT count(*) FROM contador';
        $result = $this->select($script);
        $array = explode('count', $result);
        return $array[1];
    }

    function insertar($ip,$hora,$fecha,$horau,$diau,$aniou) {
        $queryBusqueda = "INSERT INTO contador (ip,hora,fecha,horau,diau,aniou) VALUES('$ip','$hora','$fecha','$horau','$diau','$aniou')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($id) {
        $queryBusqueda = "DELETE FROM contador WHERE id=$id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function contadorConsPagina($script) {
        $this->arregloContador= array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setContador($result);
            if ($indice != -1)
                $this->arregloContador[$indice] = $this->setArregloContador($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>
