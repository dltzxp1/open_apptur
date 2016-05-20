<?php

require_once("clsConexion.php");

class video extends conexion {

    var $pr_id;
    var $ca_id;
    var $cat_id;
    var $si_id;
    var $vi_id;
    var $vi_nombre;
    var $vi_descripcion;
    var $vi_url;
    var $em_id;
    var $us_id;
    var $arregloVideo;

    function video($pr_id, $ca_id, $cat_id, $si_id, $vi_id, $em_id, $us_id) {
        if ($pr_id != '') {
            if ($vi_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM video WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id  AND si_id=$si_id AND vi_id=$vi_id AND em_id=$em_id AND us_id=$us_id";
            } else {
                $this->arregloVideo = array();
                $queryBusqueda = "SELECT * FROM video where pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id;";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setVideo($result);
                if ($indice != -1)
                    $this->arregloVideo[$indice] = $this->setArregloVideo($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setVideo($result) {
        $this->pr_id = $this->getField($result, 0);
        $this->ca_id = $this->getField($result, 1);
        $this->cat_id = $this->getField($result, 2);
        $this->si_id = $this->getField($result, 3);
        $this->vi_id = $this->getField($result, 4);
        $this->vi_nombre = $this->getField($result, 5);
        $this->vi_descripcion = $this->getField($result, 6);
        $this->vi_url = $this->getField($result, 7);
        $this->em_id = $this->getField($result, 8);
        $this->us_id = $this->getField($result, 9);
    }

    function setArregloVideo($result) {
        $video = new video(0, 0, 0, 0, 0, 0, 0);
        $video->pr_id = $this->getField($result, 0);
        $video->ca_id = $this->getField($result, 1);
        $video->cat_id = $this->getField($result, 2);
        $video->si_id = $this->getField($result, 3);
        $video->vi_id = $this->getField($result, 4);
        $video->vi_nombre = $this->getField($result, 5);
        $video->vi_descripcion = $this->getField($result, 6);
        $video->vi_url = $this->getField($result, 7);
        $video->em_id = $this->getField($result, 8);
        $video->us_id = $this->getField($result, 9);
        return $video;
    }

    /* Controla que ingrese solo un numero de videos asignados */

    function obtenerTamVideo($em_id, $us_id, $si_id) {
        $script = "SELECT * FROM video where em_id=$em_id AND us_id=$us_id AND si_id=$si_id";
        $this->arregloVideo = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setVideo($result);
            if ($indice != -1)
                $this->arregloVideo[$indice] = $this->setArregloVideo($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTam() {
        $script = 'SELECT count(*) FROM video';
        $result = $this->select($script);
        $array = explode('count', $result);
        return $array[1];
    }

    function obtenerPagin($script) {
        $this->arregloVideo = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setVideo($result);
            if ($indice != -1)
                $this->arregloVideo[$indice] = $this->setArregloVideo($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloVideo = array();
        $queryBusqueda = "SELECT * FROM video;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setVideo($result);
            if ($indice != -1)
                $this->arregloVideo[$indice] = $this->setArregloVideo($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function insertar($pr_id, $ca_id, $cat_id, $si_id, $vi_nombre, $vi_descripcion, $vi_url, $em_id, $us_id) {
        $queryBusqueda = "INSERT INTO video (pr_id,ca_id,cat_id,si_id,vi_nombre,vi_descripcion,vi_url,em_id,us_id)
                VALUES($pr_id,$ca_id,$cat_id,$si_id,'$vi_nombre','$vi_descripcion','$vi_url',$em_id, $us_id)";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($pr_id, $ca_id, $cat_id, $si_id, $vi_id, $vi_nombre, $vi_descripcion, $vi_url, $em_id, $us_id) {
        $queryBusqueda = "UPDATE video SET vi_nombre='$vi_nombre',vi_descripcion='$vi_descripcion',vi_url='$vi_url' WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND vi_id=$vi_id AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($pr_id, $ca_id, $cat_id, $si_id, $vi_id, $em_id, $us_id) {
        $queryBusqueda = "DELETE FROM video WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND vi_id=$vi_id AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function videoConsPagina($script) {
        $this->arregloVideo = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setVideo($result);
            if ($indice != -1)
                $this->arregloVideo[$indice] = $this->setArregloVideo($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>