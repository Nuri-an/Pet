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

<hr>
</hr>

<div class="container" style="overflow:hidden;">
  <div class=" text-center" role="group" aria-label="Exemplo básico" style="margin-top:20px;">
    <button type="button" class="btn btn-outline-info h5" onclick="escolheGaleria('f')">Galeria de Fotos</button>
    <button type="button" class="btn btn-outline-info h5" onclick="escolheGaleria('v')">Galeria de Vídeos</button>
  </div>

  <div id="caroselFoto" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" >
<<<<<<< HEAD
        <img src="../assets/media/galeria/imagem_2.png" class="rounded mx-auto img-fluid d-block carouselItemFoto" alt="capa" title="Capa">
=======
        <img src="../assets/media/galeria/imagem_2.png" class="rounded mx-auto img-fluid d-block" alt="capa" title="Capa" style=" height: 400px; margin-top:30px;">
>>>>>>> e9111380f06c02f3c445003019b3eb39a06a1853
      </div>
      <?php
      while ($rowGaleria = $stmtGaleria->fetch(PDO::FETCH_ASSOC)) {

        $titulo = $rowGaleria['tituloGaleria'];
        $arquivo = "../assets/media/galeria/" . $rowGaleria['midiaGaleria'];

        if (($rowGaleria['tituloGaleria'] != '') && (file_exists($arquivo))) {

          echo '<div class="carousel-item">
<<<<<<< HEAD
                    <img src="' . $arquivo . '"  class="rounded mx-auto img-fluid d-block carouselItemFoto"  data-toggle="tooltip"  alt="' . $titulo . '" title="' . $titulo . '">
                  </div>';
        }
      }
      ?> 
=======
                    <img src="' . $arquivo . '"  class="rounded mx-auto img-fluid d-block" style=" height: 400px; margin-top:30px;" data-toggle="tooltip"  alt="' . $titulo . '" title="' . $titulo . '">
                  </div>';
        }
      }
      ?>
>>>>>>> e9111380f06c02f3c445003019b3eb39a06a1853

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
        <img src="../assets/media/galeria/video_0.png" class="rounded mx-auto img-fluid d-block " style=" height: 400px; margin-top:30px; cursor: pointer;" alt="Adicione uma foto" title="Adicione uma foto" onclick="adicionarVideo_modal()">
      </div>
      <?php
      $i = 1;
      while ($rowGaleriaV = $stmtGaleriaV->fetch(PDO::FETCH_ASSOC)) {

        $titulo = $rowGaleriaV['tituloGaleria'];
        $arquivo = "../assets/media/galeria/" . $rowGaleriaV['midiaGaleria'];

        if (($rowGaleriaV['midiaGaleria'] != '') && (file_exists($arquivo))) {

          echo '<div class="carousel-item " align="center" style=" height: 400px; width: 100%; margin-top:30px;" >
                    <video class="embed-responsive-item" type="video/' . explode('.', $rowGaleriaV['midiaGaleria'])[1] . '" src="' . $arquivo . '"  onclick=controles("' . $i . '","pause") 
                        id="videoG_' . $i . '" align="middle"style=" height: 400px;  width: 100%;" data-toggle="tooltip" alt="' . $titulo . '" >
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
          echo '<div class="carousel-item " align="center" style=" height: 400px; width: 100%; margin-top:30px;">
                    <embed  src="https://www.youtube.com/embed/' . explode('=', $rowGaleriaVE['urlGaleria'])[1] . '"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen 
                       onclick=controles("' . $i . '","pause") id="videoG_' . $i . '" style=" height: 340px; width: 100%;" alt="Youtube - ' . $titulo . '" />
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