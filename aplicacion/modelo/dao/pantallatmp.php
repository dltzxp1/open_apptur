<?php

require_once("clsConexion.php");

class pantallatmp extends conexion {

    var $utp_id; // PK, varchar el mismo q llega en la trama
    var $utp_nom;
    var $utp_des;
    var $arregloPantallaTemp;

    function pantallatmp($val) {
        if ($val > 0) {
            $filtroBusqueda = "";
            $indice = 0;
            $this->arregloPantalla = array();
            $queryBusqueda = "SELECT * FROM pantallatmp";
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setPantallaTemp($result);
                if ($indice != -1)
                    $this->arregloPantallaTemp[$indice] = $this->setArregloPantallaTemp($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setPantallaTemp($result) {
        $this->utp_id = $this->getField($result, 0);
        $this->utp_nom = $this->getField($result, 1);
        $this->utp_des = $this->getField($result, 2);
    }

    function setArregloPantallaTemp($result) {
        $PantallaTemp = new pantallatmp(0);
        $PantallaTemp->utp_id = $this->getField($result, 0);
        $PantallaTemp->utp_nom = $this->getField($result, 1);
        $PantallaTemp->utp_des = $this->getField($result, 2);
        return $PantallaTemp;
    }

    /* function consultar() {
      $queryBusqueda = "SELECT * FROM pantallatmp";
      $result = $this->select($queryBusqueda);
      $indice = 0;
      $this->arregloPantallaTemp = array();
      while (!$this->siguiente($result)) {
      $this->arregloPantallaTemp[$indice] = $this->setArregloPantallaTemp($result);
      $result->MoveNext();
      $indice++;
      }
      } */
}

?>