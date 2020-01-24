<?php
require '../inc/classes/Config.php';


$cb                             = new Config('PET - Programa de Educação Tutorial', '1.0', '../assets');

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

<?php


if (isset($_SESSION['adm'])){

    //Menu do usuario comum
    require '../inc/configs/administrador.php';
}
else{

    //Menu do administrador do site
    require '../inc/configs/usuario.php';
}

?>