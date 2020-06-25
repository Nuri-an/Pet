<?php

require_once("../dao/daoInicio.php");

$inicioDao = new DaoInicio();

?>

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


<p class="badge badge-danger text-wrap" id="adm">Sobre</p>
<hr class="bg-danger" style="margin-top: -17px; margin-bottom: 20px;" />

<div class="container" style="overflow:hidden;" id="corpoInfo">

    <?php while ($rowInformacoes = $stmtInformacoes->fetch(PDO::FETCH_ASSOC)) {
        echo '<h1 class="display-4">' . $rowInformacoes['tituloInfo'] . ' </h1>';
        echo '<p class="lead">';
        echo nl2br($rowInformacoes['descricaoInfo']);
        echo '<p> <b>' . $rowInformacoes['subTituloInfo'] . ' </b> </p>';
        echo  nl2br($rowInformacoes['subDescricaoInfo']);
        echo '<p><br /> <br />';
        echo $rowInformacoes['extrasInfo'];
        echo '</p>';
        echo '<br>';
        echo '<br>
        <div class="editar"  style="display: inline; display: none; float: right; margin-bottom: 5px;">
            <button type="button" class="btn btn-success" data-toggle="tooltip" title="Editar" id="rowEditarInfo" data-id="' . $rowInformacoes['codInfo'] . '" data-tituloP="' . $rowInformacoes['tituloInfo'] . '" data-infoP="' . $rowInformacoes['descricaoInfo'] . '" data-tituloS="' . $rowInformacoes['subTituloInfo'] . '" data-infoS="' . $rowInformacoes['subDescricaoInfo'] . '"  data-extra ="' . $rowInformacoes['extrasInfo'] . '" onclick="editarInfo()" >
                <i class="fa fa-pencil"></i>
            </button>
        </div>';
    }
    ?>
</div>

<hr class="line">
</hr>

<div class=" text-center" style="margin-top:30px; margin-bottom:30px;" role="group" aria-label="Exemplo básico">
    <button type="button" class="btn btn-outline-success h5" onclick="escolheGaleria('f')">Galeria de Fotos</button>
    <button type="button" class="btn btn-outline-success h5" onclick="escolheGaleria('v')">Galeria de Vídeos</button>
</div>

<div id="caroselFoto" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">

        <?php
        $i = 1;
        while ($rowGaleria = $stmtGaleria->fetch(PDO::FETCH_ASSOC)) {

            $titulo = $rowGaleria['tituloGaleria'];
            $arquivo = "../assets/media/galeria/" . $rowGaleria['midiaGaleria'];


            if (($rowGaleria['tituloGaleria'] != '') && (file_exists($arquivo))) {

                if ($i == 1) {
                    echo '<div class="carousel-item active">
                            <img src="' . $arquivo . '"  style="cursor:pointer;" class="editar rounded mx-auto img-fluid d-block carouselItemFoto" data-toggle="tooltip" alt="' . $titulo . '" title="' . $titulo . '"  id="rowEditarFoto_' . $i . '" data-id="' . $rowGaleria['codGaleria'] . '" data-titulo="' . $rowGaleria['tituloGaleria'] . '" data-foto="' . $rowGaleria['midiaGaleria'] . '" onclick="editarFoto_modal(' . $i . ')">
                            <button type="button" class="btn btn-danger editar" data-toggle="tooltip" style=" display: none; position:absolute; left:50%; bottom: 0%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="Excluir imagem" id="rowExcluirMidia_' . $i . '" data-id="' . $rowGaleria['codGaleria'] . '" onclick="excluirMidia(' . $i . ')" >
                                <i class="fa fa-trash "></i> 
                            </button>
                        </div> ';
                } else {
                    echo '<div class="carousel-item">
                            <img src="' . $arquivo . '"  style="cursor:pointer;"  class="editar rounded mx-auto img-fluid d-block carouselItemFoto" data-toggle="tooltip" alt="' . $titulo . '" title="' . $titulo . '"  id="rowEditarFoto_' . $i . '" data-id="' . $rowGaleria['codGaleria'] . '" data-titulo="' . $rowGaleria['tituloGaleria'] . '" data-foto="' . $rowGaleria['midiaGaleria'] . '" onclick="editarFoto_modal(' . $i . ')">
                            <button type="button" class="btn btn-danger editar" data-toggle="tooltip" style=" display: none; position:absolute; left:50%; bottom: 0%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="Excluir imagem" id="rowExcluirMidia_' . $i . '" data-id="' . $rowGaleria['codGaleria'] . '" onclick="excluirMidia(' . $i . ')" >
                                <i class="fa fa-trash "></i> 
                            </button>
                        </div>';
                }
                $i++;
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

<div class="editar text-center slidesFotos" style="display: none; margin-top: 50px;">
    <button type="button" class="btn btn-success" data-toggle="tooltip" alt="Adicione uma foto" title="Adicione uma foto" onclick="adicionarFoto_modal()" style="border-radius: 50px;">
        <i class="fa fa-plus "></i>
    </button>
</div>

<div id="caroselVideo" class="carousel slide" data-ride="carousel" style="display:none;">
    <div class="carousel-inner">

        <?php
        $j = 1;
        while ($rowGaleriaV = $stmtGaleriaV->fetch(PDO::FETCH_ASSOC)) {

            $titulo = $rowGaleriaV['tituloGaleria'];
            $arquivo = "../assets/media/galeria/" . $rowGaleriaV['midiaGaleria'];

            if (($rowGaleriaV['midiaGaleria'] != '') && (file_exists($arquivo))) {

                if($j == 1){
                    echo '<div class="carousel-item active">
                            <video class="embed-responsive-item carouselItemVideoSrc" type="video/' . explode('.', $rowGaleriaV['midiaGaleria'])[1] . '" src="' . $arquivo . '"  onclick=controles("' . $j . '","pause") 
                                id="videoG_' . $j . '" align="middle" data-toggle="tooltip" alt="' . $titulo . '" >
                            </video>
                            <div  id="playV_' . $j . '">
                                <img class="rounded mx-auto img-fluid d-block " src="../assets/media/galeria/player.png" title="Play" onclick=controles("' . $j . '","play") style="cursor: pointer; height: 100px; position:absolute; left:50%; top: 50%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);">
                            </div>
                            <div style=" text-align:center; padding-bottom: 36px;" class="editar">
                                <div id="buttons" style="bottom: 0%;">
                                    <button type="button" class="btn btn-danger" data-toggle="tooltip"  title="Excluir vídeo" id="rowExcluirMidia_' . $j . '" data-id="' . $rowGaleriaV['codGaleria'] . '" onclick="excluirMidia(' . $j . ')" >
                                        <i class="fa fa-trash "></i> 
                                    </button>
                                    <button type="button" class="btn btn-success" data-toggle="tooltip"  title="Clique para substituir vídeo"  id="rowEditarVideo_' . $j . '" data-id="' . $rowGaleriaV['codGaleria'] . '" data-titulo="' . $rowGaleriaV['tituloGaleria'] . '" data-video="' . $rowGaleriaV['midiaGaleria'] . '" data-link="' . $rowGaleriaV['urlGaleria'] . '" onclick="editarVideo_modal(' . $j . ')" >
                                        <i class="fa fa-pencil "></i> 
                                    </button>
                                </div>
                            </div>
                        </div>';
                } else {
                    echo '<div class="carousel-item carouselItemVideo" align="center"  >
                        <video class="embed-responsive-item carouselItemVideoSrc" type="video/' . explode('.', $rowGaleriaV['midiaGaleria'])[1] . '" src="' . $arquivo . '"  onclick=controles("' . $j . '","pause") 
                            id="videoG_' . $j . '" align="middle" data-toggle="tooltip" alt="' . $titulo . '" >
                        </video>
                        <div  id="playV_' . $j . '">
                            <img class="rounded mx-auto img-fluid d-block " src="../assets/media/galeria/player.png" title="Play" onclick=controles("' . $j . '","play") style="cursor: pointer; height: 100px; position:absolute; left:50%; top: 50%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);">
                        </div>
                        <div style=" text-align:center; padding-bottom: 36px;" class="editar">
                            <div id="buttons">
                                <button type="button" class="btn btn-danger" data-toggle="tooltip"  title="Excluir vídeo" id="rowExcluirMidia_' . $j . '" data-id="' . $rowGaleriaV['codGaleria'] . '" onclick="excluirMidia(' . $j . ')" >
                                    <i class="fa fa-trash "></i> 
                                </button>
                                <button type="button" class="btn btn-success" data-toggle="tooltip"  title="Clique para substituir vídeo"  id="rowEditarVideo_' . $j . '" data-id="' . $rowGaleriaV['codGaleria'] . '" data-titulo="' . $rowGaleriaV['tituloGaleria'] . '" data-video="' . $rowGaleriaV['midiaGaleria'] . '" data-link="' . $rowGaleriaV['urlGaleria'] . '" onclick="editarVideo_modal(' . $j . ')" >
                                    <i class="fa fa-pencil "></i> 
                                </button>
                            </div>
                        </div>
                    </div>';
                }
            $j++;
            }
        }

        while ($rowGaleriaVE = $stmtGaleriaVE->fetch(PDO::FETCH_ASSOC)) {

            $titulo = $rowGaleriaVE['tituloGaleria'];

            if ($rowGaleriaVE['urlGaleria'] != '') {
                echo '<div class="carousel-item carouselItemVideo" align="center" style="margin-top:30px;">
                        <embed class="carouselItemVideoYt" src="https://www.youtube.com/embed/' . explode('=', $rowGaleriaVE['urlGaleria'])[1] . '"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen 
                        onclick=controles("' . $j . '","pause") id="videoG_' . $j . '" alt="Youtube - ' . $titulo . '" />
                        <div style=" text-align:center;">
                            <h5> Conheça nosso canal no Youtube! </h5>
                            <div id="buttons" class="editar" style="padding-bottom: 50px;  display: none;">
                                <button type="button" class="btn btn-danger" data-toggle="tooltip"  title="Excluir vídeo" id="rowExcluirMidia_' . $j . '" data-id="' . $rowGaleriaVE['codGaleria'] . '" onclick="excluirMidia(' . $j . ')" > 
                                    <i class="fa fa-trash "></i> 
                                </button>
                                <button type="button" class="btn btn-success" data-toggle="tooltip"  title="Clique para substituir vídeo"  id="rowEditarVideo_' . $j . '" data-id="' . $rowGaleriaVE['codGaleria'] . '" data-titulo="' . $rowGaleriaVE['tituloGaleria'] . '" data-link="' . $rowGaleriaVE['urlGaleria'] . '" data-video="' . $rowGaleriaVE['midiaGaleria'] . '" onclick="editarVideo_modal(' . $j . ')" >
                                    <i class="fa fa-pencil "></i> 
                                </button>
                            </div>
                        </div>
                    </div>';
            }
            $j++;
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

<div class="text-center slidesVideos" style="display: none; margin-top: 0px;">
    <button type="button" class="btn btn-success" data-toggle="tooltip" alt="Adicione um video" title="Adicione um video" onclick="adicionarVideo_modal()" style="border-radius: 50px;">
        <i class="fa fa-plus "></i>
    </button>
</div>