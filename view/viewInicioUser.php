<?php
require '../inc/global/banner.php';
require '../inc/global/head_start.php';
require '../inc/global/config.php';

require_once("../dao/DaoInformacoes.php");   

$informacoesDao = new DaoInformacoes();

$stmtInformacoes = $informacoesDao->runQuery("SELECT * FROM informacoes");
$stmtInformacoes->execute();

$stmtGaleria = $informacoesDao->runQuery("SELECT * FROM galeria");
$stmtGaleria->execute();
?>

<div class="container" style="overflow:hidden;">
    <?php while ($rowInformacoes = $stmtInformacoes->fetch(PDO::FETCH_ASSOC)) {
        echo '<h1 class="display-4">' .$rowInformacoes['tituloInfo']. ' </h1>'; 
        echo '<p class="lead">';
        echo nl2br($rowInformacoes['descricaoInfo']); 
        echo '<p> <b>' .$rowInformacoes['subTituloInfo']. ' </b> </p>'; 
        echo  nl2br($rowInformacoes['subDescricaoInfo']); 
        }
      ?>   
  </div>

  <div id="carosel" class="carousel slide" data-ride="carousel" >
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets/media/galeria/imagem_2.png" class="rounded mx-auto img-fluid d-block" alt="capa" title="Capa" style=" height: 400px; margin-top:100px;"> 
      </div>
      <?php 
        while ($rowGaleria = $stmtGaleria->fetch(PDO::FETCH_ASSOC)) {

          $titulo = $rowGaleria['tituloGaleria'];
          $arquivo="../assets/media/galeria/". $rowGaleria['fotoGaleria'];

          if (($rowGaleria['tituloGaleria'] != '') && (file_exists($arquivo))){

            echo '<div class="carousel-item" >
                    <img src="'. $arquivo .'"  class="rounded mx-auto img-fluid d-block" style=" height: 400px; margin-top:100px;" data-toggle="tooltip"  alt="'. $titulo .'" title="'. $titulo .'">
                  </div>';
          }
        }
      ?>
      
      <a class="carousel-control-prev" href="#carosel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Anterior</span>
        </a>
      <a class="carousel-control-next" href="#carosel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Proximo</span>
      </a>
    </div>
  </div>

<?php
require '../inc/global/head_end.php';
?>