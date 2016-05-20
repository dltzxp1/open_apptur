<?php

require_once("../modelo/dao/usuario.php");

function conexiones($email, $pass) {
    $objUsuario = new usuario('', '');
    $arrUser = $objUsuario->arregloUsuario;

    for ($i = 0; $i < count($arrUser); $i++) {
        if ($arrUser[$i]->us_mail == $email && $arrUser[$i]->us_clave == md5(trim($pass)) && $arrUser[$i]->us_estado = "ACT") {
            $emailDB = $arrUser[$i]->us_mail;
            session_start();
            $_SESSION["usMail"] = $arrUser[$i]->us_mail;
            $_SESSION["usClave"] = $arrUser[$i]->us_clave;
            $_SESSION["emId"] = $arrUser[$i]->em_id;
            $_SESSION["usId"] = $arrUser[$i]->us_id;
            $_SESSION["usUsuario"] = $arrUser[$i]->us_usuario;
            $_SESSION["usImagen"] = $arrUser[$i]->us_imagen;
            $_SESSION["idUsuario"] = $arrUser[$i]->us_id;
            $_SESSION["usTsit"] = $arrUser[$i]->us_t_sit;
            $_SESSION["usThis"] = $arrUser[$i]->us_t_his;
            $_SESSION["usTvid"] = $arrUser[$i]->us_t_vid;
            $_SESSION["usTfot"] = $arrUser[$i]->us_t_fot;
            $_SESSION["usTfes"] = $arrUser[$i]->us_t_fes;
            $_SESSION["usTgas"] = $arrUser[$i]->us_t_gas;
            $_SESSION["usTrut"] = $arrUser[$i]->us_t_rut;
        }
    }
    if ($email == $emailDB) {
        return true;
    } else {
        return false;
    }
}

function verificar_usuario() {
    session_start();
    /* if ($_SESSION["usMail"] && $_SESSION["usClave"] && $_SESSION["emId"] && $_SESSION["usId"] && $_SESSION["usUsuario"]
      && $_SESSION["usImagen"] && $_SESSION["idUsuario"] && $_SESSION["usRegistros"] && $_SESSION["usTsit"] && $_SESSION["usThis"] && $_SESSION["usTvid"] && $_SESSION["usTfot"] && $_SESSION["usTfes"] && $_SESSION["usTgas"]) {
      return true;
      } */
    if ($_SESSION["usMail"]) {
        return true;
    }
}

?>