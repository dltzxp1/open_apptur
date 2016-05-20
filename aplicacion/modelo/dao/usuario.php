<?php

require_once("clsConexion.php");

class usuario extends conexion {

    var $em_id; // Integer PK
    var $us_id; // Integer PK
    var $us_nombre;
    var $us_apellido;
    var $us_mail;
    var $us_usuario;
    var $us_clave;
    var $us_clave2;
    var $us_estado;
    var $us_t_sit;
    var $us_t_his;
    var $us_t_vid;
    var $us_t_fot;
    var $us_t_fes;
    var $us_t_gas;
    var $us_t_rut;
    var $arregloUsuario;

    function usuario($em_id, $us_id) {
        if ($us_id != '0') {
            if ($us_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM usuario where em_id=$em_id us_id=$us_id order by us_nombre ASC";
            } else {
                $this->arregloUsuario = array();
                $queryBusqueda = "SELECT * FROM usuario order by us_nombre ASC";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setUsuario($result);
                if ($indice != -1)
                    $this->arregloUsuario[$indice] = $this->setArregloUsuario($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setUsuario($result) {
        $this->em_id = $this->getField($result, 0);
        $this->us_id = $this->getField($result, 1);
        $this->us_nombre = $this->getField($result, 2);
        $this->us_apellido = $this->getField($result, 3);
        $this->us_mail = $this->getField($result, 4);
        $this->us_usuario = $this->getField($result, 5);
        $this->us_clave = $this->getField($result, 6);
        $this->us_clave2 = $this->getField($result, 7);
        $this->us_estado = $this->getField($result, 8);
        $this->us_t_sit = $this->getField($result, 9);
        $this->us_t_his = $this->getField($result, 10);
        $this->us_t_vid = $this->getField($result, 11);
        $this->us_t_fot = $this->getField($result, 12);
        $this->us_t_fes = $this->getField($result, 13);
        $this->us_t_gas = $this->getField($result, 14);
        $this->us_t_rut = $this->getField($result, 15);
    }

    function setArregloUsuario($result) {
        $usuario = new usuario('0', '0');
        $usuario->em_id = $this->getField($result, 0);
        $usuario->us_id = $this->getField($result, 1);
        $usuario->us_nombre = $this->getField($result, 2);
        $usuario->us_apellido = $this->getField($result, 3);
        $usuario->us_mail = $this->getField($result, 4);
        $usuario->us_usuario = $this->getField($result, 5);
        $usuario->us_clave = $this->getField($result, 6);
        $usuario->us_clave2 = $this->getField($result, 7);
        $usuario->us_estado = $this->getField($result, 8);
        $usuario->us_t_sit = $this->getField($result, 9);
        $usuario->us_t_his = $this->getField($result, 10);
        $usuario->us_t_vid = $this->getField($result, 11);
        $usuario->us_t_fot = $this->getField($result, 12);
        $usuario->us_t_fes = $this->getField($result, 13);
        $usuario->us_t_gas = $this->getField($result, 14);
        $usuario->us_t_rut = $this->getField($result, 15);
        return $usuario;
    }

    function insertarIndex($us_nombre, $us_apellido, $us_mail, $us_usuario) {
        $queryBusqueda = "INSERT INTO usuario (em_id,us_nombre,us_apellido,us_mail,us_usuario,us_estado) 
        VALUES(1,'$us_nombre','$us_apellido','$us_mail','$us_usuario','DES')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function insertar($em_id, $us_nombre, $us_apellido, $us_mail, $us_usuario, $us_clave, $us_clave2, $us_estado, $us_t_sit, $us_t_his, $us_t_vid, $us_t_fot, $us_t_fes, $us_t_gas, $us_t_rut) {
        $queryBusqueda = "INSERT INTO usuario (em_id,us_nombre,us_apellido,us_mail,us_usuario,us_clave,us_clave2,us_estado,us_t_sit,us_t_his,us_t_vid,us_t_fot,us_t_fes,us_t_gas,us_t_rut)
            VALUES($em_id,'$us_nombre','$us_apellido','$us_mail','$us_usuario',md5('$us_clave'),$us_clave2,'$us_estado',$us_t_sit,$us_t_his,$us_t_vid, $us_t_fot, $us_t_fes, $us_t_gas, $us_t_rut)";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualizar($em_id, $us_id, $us_nombre, $us_apellido, $us_mail, $us_usuario, $us_clave, $us_estado, $us_t_sit, $us_t_his, $us_t_vid, $us_t_fot, $us_t_fes, $us_t_gas, $us_t_rut) {
        $queryBusqueda = "UPDATE usuario SET us_nombre='$us_nombre',us_apellido='$us_apellido',us_mail='$us_mail',us_usuario='$us_usuario',us_clave=md5('$us_clave'),us_estado='$us_estado',us_t_sit=$us_t_sit, us_t_his=$us_t_his, us_t_vid=$us_t_vid, us_t_fot=$us_t_fot,us_t_fes=$us_t_fes,us_t_gas=$us_t_gas,us_t_rut=$us_t_rut WHERE em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($em_id, $us_id) {
        $queryBusqueda = "DELETE FROM usuario WHERE em_id=$em_id AND us_id=$us_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function obtenerTodo() {
        $this->arregloHistoria = array();
        $queryBusqueda = "SELECT * FROM usuario;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setUsuario($result);
            if ($indice != -1)
                $this->arregloUsuario[$indice] = $this->setArregloUsuario($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function usuarioConsPagina($script) {
        $this->arregloUsuario = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setUsuario($result);
            if ($indice != -1)
                $this->arregloUsuario[$indice] = $this->setArregloUsuario($result);
            $result->MoveNext();
            $indice++;
        }
    }

}

?>