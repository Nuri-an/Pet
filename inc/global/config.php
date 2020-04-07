<?php
if ( session_status() !== PHP_SESSION_ACTIVE )
 {
    session_start();
}

require '../inc/classes/Config.php';


$cb                             = new Config('PET - Programa de Educação Tutorial', '1.0', '../assets');

?>
<?php


if (isset($_SESSION['adm_session'])){

    //Menu do usuario comum
    require '../inc/configs/administrador.php';
}
else{

    //Menu do administrador do site
    require '../inc/configs/usuario.php';
}

?>