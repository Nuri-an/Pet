<?php 
require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';

require_once("../dao/daoInicio.php");

$inicioDao = new DaoInicio(); ?>

<link rel="stylesheet" href="../assets/css/inicio.css">

<script type="text/javascript" src="../assets/js/inicio.js"></script>

<div class="container" style="overflow:hidden; border-bottom:30px;">
  <?php
  $stmtInformacoes = $inicioDao->runQuery("SELECT * FROM informacoes");
  $stmtInformacoes->execute();

  $stmtGaleria = $inicioDao->runQuery("SELECT * FROM galeria WHERE midiaGaleria LIKE 'imagem%'");
  $stmtGaleria->execute();

  $stmtGaleriaV = $inicioDao->runQuery("SELECT * FROM galeria WHERE midiaGaleria LIKE 'video%'");
  $stmtGaleriaV->execute();

  $stmtGaleriaVE = $inicioDao->runQuery("SELECT * FROM galeria WHERE urlGaleria is not null");
  $stmtGaleriaVE->execute();
  ?>
  <?php while ($rowInformacoes = $stmtInformacoes->fetch(PDO::FETCH_ASSOC)) {
    echo '<h1 class="display-4">' . $rowInformacoes['tituloInfo'] . ' </h1>';
    echo '<p class="lead">';
    echo nl2br($rowInformacoes['descricaoInfo']);
    echo '<p> <b>' . $rowInformacoes['subTituloInfo'] . ' </b> </p>';
    echo  nl2br($rowInformacoes['subDescricaoInfo']);
  }
  ?>
</div>

<hr class="line">
</hr>

<div class="container" style="overflow:hidden;">
  <div class=" text-center" role="group" aria-label="Exemplo básico" style="margin-top:20px;">
    <button type="button" class="btn btn-outline-info h5" onclick="escolheGaleria('f')">Galeria de Fotos</button>
    <button type="button" class="btn btn-outline-info h5" onclick="escolheGaleria('v')">Galeria de Vídeos</button>
  </div>

  <div id="caroselFoto" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" >
        <img src="../assets/media/galeria/imagem_2.png" class="rounded mx-auto img-fluid d-block carouselItemFoto" alt="capa" title="Capa">
      </div>
      <?php
      while ($rowGaleria = $stmtGaleria->fetch(PDO::FETCH_ASSOC)) {

        $titulo = $rowGaleria['tituloGaleria'];
        $arquivo = "../assets/media/galeria/" . $rowGaleria['midiaGaleria'];

        if (($rowGaleria['tituloGaleria'] != '') && (file_exists($arquivo))) {

          echo '<div class="carousel-item">
                    <img src="' . $arquivo . '"  class="rounded mx-auto img-fluid d-block carouselItemFoto"  data-toggle="tooltip"  alt="' . $titulo . '" title="' . $titulo . '">
                  </div>';
        }
      }
      ?> 

      <a class="carousel-control-prev" href="#caroselFoto" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="carousel-control-next" href="#caroselFoto" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Proximo</span>
      </a>
    </div>
  </div>
  <div id="caroselVideo" class="carousel slide" data-ride="carousel" style="display:none;">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <!-- <form id="adicionarImagem-form" action="../controller/controllerGaleria.php"  method="POST" encyte="multipart/form-data">-->
        <img src="../assets/media/galeria/video_0.png" class="rounded mx-auto img-fluid d-block carouselItemVideo" style="margin-top:30px; width: auto;" >
      </div>
      <?php
      $i = 1;
      while ($rowGaleriaV = $stmtGaleriaV->fetch(PDO::FETCH_ASSOC)) {

        $titulo = $rowGaleriaV['tituloGaleria'];
        $arquivo = "../assets/media/galeria/" . $rowGaleriaV['midiaGaleria'];

        if (($rowGaleriaV['midiaGaleria'] != '') && (file_exists($arquivo))) {

          echo '<div class="carousel-item carouselItemVideo" align="center" style="margin-top:30px;" >
                    <video class="embed-responsive-item carouselItemVideo" type="video/' . explode('.', $rowGaleriaV['midiaGaleria'])[1] . '" src="' . $arquivo . '"  onclick=controles("' . $i . '","pause") 
                        id="videoG_' . $i . '" align="middle" data-toggle="tooltip" alt="' . $titulo . '" >
                    </video>
                    <div  id="playV_' . $i . '">
                        <img class="rounded mx-auto img-fluid d-block " src="../assets/media/galeria/player.png" title="Play" onclick=controles("' . $i . '","play") style="cursor: pointer; height: 100px; position:absolute; left:50%; top: 50%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);">
                    </div>
                        </div>';
        }
        $i++;
      }

      while ($rowGaleriaVE = $stmtGaleriaVE->fetch(PDO::FETCH_ASSOC)) {

        $titulo = $rowGaleriaVE['tituloGaleria'];

        if ($rowGaleriaVE['urlGaleria'] != '') {
          echo '<div class="carousel-item carouselItemVideo" align="center" style="margin-top:30px;">
                    <embed class="carouselItemVideoYt" src="https://www.youtube.com/embed/' . explode('=', $rowGaleriaVE['urlGaleria'])[1] . '"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen 
                       onclick=controles("' . $i . '","pause") id="videoG_' . $i . '" alt="Youtube - ' . $titulo . '" />
                    <div style=" text-align:center;">
                        <h5> Conheça nosso canal no Youtube! </h5>
                    </div>
                </div>';
        }
        $i++;
      }
      ?>
      <a class="carousel-control-prev" href="#caroselVideo" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="carousel-control-next" href="#caroselVideo" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Proximo</span>
      </a>
    </div>
  </div>
</div>
    </div>
<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>