<script type="text/javascript" src="../assets/js/settings.js" defer></script>

<nav class="navbar navbar-expand-lg navbar-light container" id="navbar" style=" background-color: #8FBC8F; width: 100vw;">
  <button class="navbar-toggler" type="button" style="background-color:#E9ECEF;" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span> MENU
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" id="noticias" href='index.php'> <font size="4"> Início </font> </a>
      </li>  
      <li class="nav-item">
        <a class="nav-link" id="sobre" href='sobre.php'> <font size="4"> Sobre </font> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="publicacoes" href='publicacoes.php' > <font size="4"> Publicações </font> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="projetos"  href='projetos.php' > <font size="4"> Projetos </font> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="integrantes" href='integrantes.php' > <font size="4"> Integrantes </font> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="downloads" href="downloads.php"> <font size="4"> Downloads </font> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="administradores" href='administradores.php' > <font size="4"> Administradores </font> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../controller/controllerLogin.php?acao=logout" id="btnlogout" > <font size="4"> Sair </font> </a>
      </li>
    </ul>
  </div>
  <div style="float:rigth; margin-right: 10px;">
    <?php
      require_once("../dao/daoSettings.php");

      $settingsDao = new DaoSettings();

      $stmtSettings = $settingsDao->runQuery("SELECT * FROM configuracoes WHERE 1");
      $stmtSettings->execute();
      $settingsRow = $stmtSettings->fetch(PDO::FETCH_ASSOC);
      
      echo '
        <a href="'. $settingsRow['facebook'] .'" target="_blank">
          <i class="fa fa-facebook-square fa-2x" aria-hidden="true" style="color: #000; cursor: pointer;" title="Página do grupo"></i>
        </a>
        <a href="'. $settingsRow['instagram'] .'">
          <i class="fa fa-instagram fa-2x" aria-hidden="true" style="color: #000; cursor: pointer; margin-left:10px;" title="Perfil do grupo"></i>
        </a>
      ';
    ?>
    <i class="fa fa-cogs fa-2x" aria-hidden="true" style="color: #000; cursor: pointer; margin-left:10px;" onclick="editar_configs()"></i>
  </div>
</nav>

<div class="jumbotron container" style="background-color: #f4f4f4; display: flow-root; min-height: 100vh;">

<?php require 'postSettings.php'; ?>