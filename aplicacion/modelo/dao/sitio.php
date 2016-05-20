<?php

require_once("clsConexion.php");

class sitio extends conexion {

    var $pr_id;
    var $ca_id;
    var $cat_id;
    var $si_id;
    var $si_nombre;
    var $si_descripcion;
    var $si_paginaweb;
    var $si_mail;
    var $si_facebook;
    var $si_twitter;
    var $si_direccion;
    var $si_telefono;
    var $si_latitud;
    var $si_longitud;
    var $si_punto;
    var $em_id;
    var $us_id;
    var $arregloSitio;

    function sitio($pr_id, $ca_id, $si_id, $em_id, $us_id) {
        if ($pr_id != '') {
            if ($si_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM sitio WHERE pr_id=$pr_id AND ca_id=$ca_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by si_nombre ASC";
            } else {
                $this->arregloSitio = array();
                $queryBusqueda = "SELECT * FROM sitio where pr_id=$pr_id AND ca_id=$ca_id AND em_id=$em_id AND us_id=$us_id order by si_nombre ASC";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setSitio($result);
                if ($indice != -1)
                    $this->arregloSitio[$indice] = $this->setArregloSitio($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setSitio($result) {
        $this->pr_id = $this->getField($result, 0);
        $this->ca_id = $this->getField($result, 1);
        $this->cat_id = $this->getField($result, 2);
        $this->si_id = $this->getField($result, 3);
        $this->si_nombre = $this->getField($result, 4);
        $this->si_descripcion = $this->getField($result, 5);
        $this->si_paginaweb = $this->getField($result, 6);
        $this->si_mail = $this->getField($result, 7);
        $this->si_facebook = $this->getField($result, 8);
        $this->si_twitter = $this->getField($result, 9);
        $this->si_direccion = $this->getField($result, 10);
        $this->si_telefono = $this->getField($result, 11);
        $this->si_latitud = $this->getField($result, 12);
        $this->si_longitud = $this->getField($result, 13);
        $this->si_punto = $this->getField($result, 14);
        $this->em_id = $this->getField($result, 15);
        $this->us_id = $this->getField($result, 16);
    }

    function setArregloSitio($result) {
        $sitio = new sitio(0, 0, 0, 0, 0);
        $sitio->pr_id = $this->getField($result, 0);
        $sitio->ca_id = $this->getField($result, 1);
        $sitio->cat_id = $this->getField($result, 2);
        $sitio->si_id = $this->getField($result, 3);
        $sitio->si_nombre = $this->getField($result, 4);
        $sitio->si_descripcion = $this->getField($result, 5);
        $sitio->si_paginaweb = $this->getField($result, 6);
        $sitio->si_mail = $this->getField($result, 7);
        $sitio->si_facebook = $this->getField($result, 8);
        $sitio->si_twitter = $this->getField($result, 9);
        $sitio->si_direccion = $this->getField($result, 10);
        $sitio->si_telefono = $this->getField($result, 11);
        $sitio->si_latitud = $this->getField($result, 12);
        $sitio->si_longitud = $this->getField($result, 13);
        $sitio->si_punto = $this->getField($result, 14);
        $sitio->em_id = $this->getField($result, 15);
        $sitio->us_id = $this->getField($result, 16);
        return $sitio;
    }

    /* Control para que un usuario inrgrese los sitios aginados */

    function obtenerTamSitio($em_id, $us_id) {
        $script = "SELECT * FROM sitio where em_id=$em_id AND us_id=$us_id";
        $this->arregloSitio = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setSitio($result);
            if ($indice != -1)
                $this->arregloSitio[$indice] = $this->setArregloSitio($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTam() {
        $script = 'SELECT count(*) FROM sitio';
        $result = $this->select($script);
        $array = explode('count', $result);
        return $array[1];
    }

    function obtenerPagin($script) {
        $this->arregloSitio = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setSitio($result);
            if ($indice != -1)
                $this->arregloSitio[$indice] = $this->setArregloSitio($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloSitio = array();
        $queryBusqueda = "SELECT * FROM sitio;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setSitio($result);
            if ($indice != -1)
                $this->arregloSitio[$indice] = $this->setArregloSitio($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function consultarLT($pr_id, $ca_id, $si_id) {
        $queryBusqueda = "SELECT * from f_reporte_parking('" . $pr_id . "','" . $ca_id . "','" . $si_id . "') ";
        $result = $this->select($queryBusqueda);
        $indice = 0;
        $this->arregloSitio = array();
        while (!$this->siguiente($result)) {
            $this->arregloSitio[$indice] = $this->setArregloSitio($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function insertar($pr_id, $ca_id, $cat_id, $si_nombre, $si_descripcion, $si_paginaweb, $si_mail, $si_facebook, $si_twitter, $si_direccion, $si_telefono, $si_latitud, $si_longitud, $em_id, $us_id) {
        $queryBusqueda = "INSERT INTO sitio (pr_id, ca_id, cat_id, si_nombre, si_descripcion, si_paginaweb, si_mail, si_facebook, si_twitter, si_direccion,si_telefono, si_latitud, si_longitud, si_punto,em_id,us_id)
                VALUES($pr_id, $ca_id, $cat_id, '$si_nombre', '$si_descripcion', '$si_paginaweb', '$si_mail', '$si_facebook', '$si_twitter', '$si_direccion','$si_telefono', $si_latitud, $si_longitud, ST_GeomFromText('POINT(" . $si_latitud . " " . $si_longitud . ")', 4326),$em_id,$us_id)";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($pr_id, $ca_id, $cat_id, $si_id, $si_nombre, $si_descripcion, $si_paginaweb, $si_mail, $si_facebook, $si_twitter, $si_direccion, $si_telefono, $si_latitud, $si_longitud) {
        $queryBusqueda = "UPDATE sitio SET cat_id=$cat_id,si_nombre='$si_nombre',si_descripcion='$si_descripcion',si_paginaweb='$si_paginaweb',si_mail='$si_mail',si_facebook='$si_facebook',si_twitter='$si_twitter',si_direccion='$si_direccion',si_telefono='$si_telefono',si_latitud='$si_latitud',si_longitud='$si_longitud',si_punto=ST_GeomFromText('POINT(" . $si_latitud . " " . $si_longitud . ")', 4326)  WHERE pr_id=$pr_id AND ca_id=$ca_id AND si_id=$si_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($pr_id, $ca_id, $si_id, $em_id, $us_id) {
        $queryBusqueda = "DELETE FROM sitio WHERE pr_id = $pr_id AND ca_id = $ca_id AND si_id = $si_id AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function sitioConsBusqueda($script) {
        $this->arregloSitio = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setSitio($result);
            if ($indice != -1)
                $this->arregloSitio[$indice] = $this->setArregloSitio($result);
            $result->MoveNext();
            $indice++;
        }
    }

    /* Para Paginacion */

    function sitioConsBusquedaPagina($script) {
        $this->arregloSitio = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setSitio($result);
            if ($indice != -1)
                $this->arregloSitio[$indice] = $this->setArregloSitio($result);
            $result->MoveNext();
            $indice++;
        }
    }
    /*Para servicios web */
      function sitioWS($pr_id) {
        if ($pr_id) {
            if ($pr_id > 0) {
                $indice = 0;
                $queryBusqueda = "SELECT * FROM sitio WHERE pr_id=$pr_id";
            } else {
                /*$this->arregloSitio = array();
                $queryBusqueda = "SELECT * FROM sitio where pr_id=$pr_id AND ca_id=$ca_id AND em_id=$em_id AND us_id=$us_id";
                $indice = 0;*/
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setSitio($result);
                if ($indice != -1)
                    $this->arregloSitio[$indice] = $this->setArregloSitio($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }
    /*WEB service MATERS FLOW*/
     function sitioswb($script) {
        $this->arregloSitio = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setSitio($result);
            if ($indice != -1)
                $this->arregloSitio[$indice] = $this->setArregloSitio($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>