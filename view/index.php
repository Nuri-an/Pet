<?php


if (isset($_SESSION['adm'])){

    //Inicio para visualizacao - para usuarios comuns
    require 'viewInicioAdm.php';
}
else{

    //Inicio editavel - para administradores
    require 'viewInicioUser.php';
}

?>