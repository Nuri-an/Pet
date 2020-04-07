<?php
session_start();

if (isset($_SESSION['adm_session'])){

    //Inicio para visualizacao - para usuarios comuns
    require 'viewInicioAdm.php';
}
else{

    //Inicio editavel - para administradores
    require 'viewInicioUser.php';
}

?>