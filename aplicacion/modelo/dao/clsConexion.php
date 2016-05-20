<?php

//requiere('config.ukuku.php');
include('adodb5/adodb.inc.php');
//include("adodb5/adodb-exceptions.inc.php");
include('global.php');

class conexion {

    var $db;

    function conexion() {
        
    }

    function select($queryBusqueda) {
        global $VGmiHost, $VGmiUser, $VGmiPass, $VGmiBdd;

        $this->db = ADONewConnection('postgres');
        //$this->db->Connect("localhost","postgres","sasa","utn_tur");
        $this->db->Connect($VGmiHost, $VGmiUser, $VGmiPass, $VGmiBdd);
        $result = $this->db->Execute($queryBusqueda);
        return $result;
    }

    function strSql($queryBusqueda) {
        global $VGmiHost, $VGmiUser, $VGmiPass, $VGmiBdd;

        $this->db = ADONewConnection('postgres');
        //$this->db->Connect("localhost","postgres","sasa","utn_tur");
        $this->db->Connect($VGmiHost, $VGmiUser, $VGmiPass, $VGmiBdd);
        $result = $this->db->Execute($queryBusqueda);
        return $result;
    }

    function siguiente($result) {
        return $result->EOF;
    }

    function esUltimo($result) {
        return $result->EOF;
    }

    function getField($result, $indice) {
        return $result->fields[$indice];
    }

}

//TEST
//$rs = $db->Execute('select * from jos_imapax_suministroeeq');
//print "<pre>";
//print_r($rs->GetRows());
//print "</pre>";
?>