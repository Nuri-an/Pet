<?php
session_start();

if (isset($_SESSION['adm_session'])){

    //Inicio para visualizacao - para usuarios comuns
    require 'viewNoticiasAdm.php';
}
else{

    //Inicio editavel - para administradores
    require 'viewNoticiasUser.php';
}

?>