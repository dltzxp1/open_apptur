<?php

require_once("clsConexion.php");

class foto extends conexion {

    var $pr_id;
    var $ca_id;
    var $cat_id;
    var $si_id;
    var $fo_id;
    var $fo_nombre;
    var $fo_descripcion;
    var $fo_fecha;
    var $fo_archivo_nombre;
    var $fo_archivo_bytea;
    var $fo_archivo_oid;
    var $fo_mime;
    var $size;
    var $em_id;
    var $us_id;
    var $arregloFoto;

    function foto($pr_id, $ca_id, $cat_id, $si_id, $fo_id, $em_id, $us_id) {
        if ($pr_id != '') {
            if ($fo_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM foto WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id  AND si_id=$si_id AND fo_id=$fo_id AND em_id=$em_id AND us_id=$us_id order by fo_nombre ASC";
            } else {
                $this->arregloFoto = array();
                $queryBusqueda = "SELECT * FROM foto where pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND em_id=$em_id AND us_id=$us_id order by fo_nombre ASC";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setFoto($result);
                if ($indice != -1)
                    $this->arregloFoto[$indice] = $this->setArregloFoto($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setFoto($result) {
        $this->pr_id = $this->getField($result, 0);
        $this->ca_id = $this->getField($result, 1);
        $this->cat_id = $this->getField($result, 2);
        $this->si_id = $this->getField($result, 3);
        $this->fo_id = $this->getField($result, 4);
        $this->fo_nombre = $this->getField($result, 5);
        $this->fo_descripcion = $this->getField($result, 6);
        $this->fo_fecha = $this->getField($result, 7);
        $this->fo_archivo_nombre = $this->getField($result, 8);
        $this->fo_archivo_bytea = $this->getField($result, 9);
        $this->fo_archivo_oid = $this->getField($result, 10);
        $this->fo_mime = $this->getField($result, 11);
        $this->size = $this->getField($result, 12);
        $this->em_id = $this->getField($result, 13);
        $this->us_id = $this->getField($result, 14);
    }

    function setArregloFoto($result) {
        $foto = new foto(0, 0, 0, 0, 0, 0, 0);
        $foto->pr_id = $this->getField($result, 0);
        $foto->ca_id = $this->getField($result, 1);
        $foto->cat_id = $this->getField($result, 2);
        $foto->si_id = $this->getField($result, 3);
        $foto->fo_id = $this->getField($result, 4);
        $foto->fo_nombre = $this->getField($result, 5);
        $foto->fo_descripcion = $this->getField($result, 6);
        $foto->fo_fecha = $this->getField($result, 7);
        $foto->fo_archivo_nombre = $this->getField($result, 8);
        $foto->fo_archivo_bytea = $this->getField($result, 9);
        $foto->fo_archivo_oid = $this->getField($result, 10);
        $foto->fo_mime = $this->getField($result, 11);
        $foto->size = $this->getField($result, 12);
        $foto->em_id = $this->getField($result, 13);
        $foto->us_id = $this->getField($result, 14);
        return $foto;
    }

    /* Controla que ingrese solo un numero de fotos asignados */

    function obtenerTamFoto($em_id, $us_id, $si_id) {
        $script = "SELECT * FROM foto where em_id=$em_id AND us_id=$us_id AND si_id=$si_id";
        $this->arregloFoto = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFoto($result);
            if ($indice != -1)
                $this->arregloFoto[$indice] = $this->setArregloFoto($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerPagin($script) {
        $this->arregloFoto = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFoto($result);
            if ($indice != -1)
                $this->arregloFoto[$indice] = $this->setArregloFoto($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloHistoria = array();
        $queryBusqueda = "SELECT * FROM foto;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setFoto($result);
            if ($indice != -1)
                $this->arregloFoto[$indice] = $this->setArregloFoto($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function editar($queryBusqueda) {
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function insertar($pr_id, $ca_id, $cat_id, $si_id, $fo_nombre, $fo_descripcion, $fo_archivo_nombre, $tmp_name, $fo_mime, $size, $em_id, $us_id) {
        $fp = fopen($tmp_name, "rb");
        $buffer = fread($fp, filesize($tmp_name));
        fclose($fp);
        $buffer = pg_escape_bytea($buffer);

        $queryBusqueda = "INSERT INTO foto(pr_id,ca_id,cat_id,si_id,fo_nombre,fo_descripcion,fo_fecha,fo_archivo_nombre,fo_archivo_bytea,fo_mime,size,em_id,us_id)
            VALUES ($pr_id,$ca_id,$cat_id,$si_id,'$fo_nombre','$fo_descripcion',CURRENT_TIMESTAMP,'$fo_archivo_nombre','$buffer','$fo_mime',$size,$em_id,$us_id)";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($pr_id, $ca_id, $cat_id, $si_id, $fo_id, $fo_nombre, $fo_descripcion, $fo_img, $em_id, $us_id) {
        $direc = "C:/Users/flow/Pictures/" . $fo_img;
        $data = file_get_contents($direc);
        $image = pg_escape_bytea($data);
        $queryBusqueda = "UPDATE foto SET fo_nombre='$fo_nombre',fo_descripcion='$fo_descripcion',fo_img='{$image}'  WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND fo_id=$fo_id  AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($pr_id, $ca_id, $cat_id, $si_id, $fo_id, $em_id, $us_id) {
        $queryBusqueda = "DELETE FROM foto WHERE pr_id=$pr_id AND ca_id=$ca_id AND cat_id=$cat_id AND si_id=$si_id AND fo_id=$fo_id AND em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function fotoConsPagina($script) {
        $this->arregloFoto = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setFoto($result);
            if ($indice != -1)
                $this->arregloFoto[$indice] = $this->setArregloFoto($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>