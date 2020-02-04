<?php require 'loader.html' ?>
<?php
require '../inc/global/banner.php';
require '../inc/global/head_start.php';
require '../inc/global/config.php';

require_once("../dao/daoInicio.php");

$inicioDao = new DaoInicio();

?>

<link rel="stylesheet" href="../assets/css/inicio.css">

<script type="text/javascript" src="../assets/js/plugins/jquery-3.3.1.min.js"> </script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/localization/messages_pt_BR.js"></script>
<script type="text/javascript" src="../assets/js/inicio.js"></script>

<div id="atualiza" style="margin-top: 20px; margin-bottom: 20px;">
    <div class="container" style="overflow:hidden;" id="corpoInfo">
        <?php

        $stmtInformacoes = $inicioDao->runQuery("SELECT * FROM informacoes");
        $stmtInformacoes->execute();

        $stmtGaleria = $inicioDao->runQuery("SELECT * FROM galeria WHERE midiaGaleria LIKE 'imagem%'");
        $stmtGaleria->execute();

        $stmtGaleriaV = $inicioDao->runQuery("SELECT * FROM galeria WHERE midiaGaleria LIKE 'video%'");
        $stmtGaleriaV->execute();
        
        $stmtGaleriaVE = $inicioDao->runQuery("SELECT * FROM galeria WHERE urlGaleria is not null");
        $stmtGaleriaVE->execute();

        while ($rowInformacoes = $stmtInformacoes->fetch(PDO::FETCH_ASSOC)) {
            echo '<h1 class="display-4">' . $rowInformacoes['tituloInfo'] . ' </h1>';
            echo '<p class="lead">';
            echo nl2br($rowInformacoes['descricaoInfo']);
            echo '<p> <b>' . $rowInformacoes['subTituloInfo'] . ' </b> </p>';
            echo  nl2br($rowInformacoes['subDescricaoInfo']);
            echo '<p> <br>';
            echo $rowInformacoes['extrasInfo'];
            echo '</p>';
            echo '<br>';
            echo '<br>
                <div style="display: inline;float: right; margin-bottom: 5px;">
                    <button type="button" class="btn btn-primary" data-toggle="tooltip" title="Editar" id="rowEditarInfo" data-id="' . $rowInformacoes['codInfo'] . '" data-tituloP="' . $rowInformacoes['tituloInfo'] . '" data-infoP="' . $rowInformacoes['descricaoInfo'] . '" data-tituloS="' . $rowInformacoes['subTituloInfo'] . '" data-infoS="' . $rowInformacoes['subDescricaoInfo'] . '"  data-extra ="' . $rowInformacoes['extrasInfo'] . '" onclick="editarInfo()" >
                        <i class="fa fa-pencil"></i>
                    </button>
                </div>';
        }
        ?>
    </div>

    <hr>
    </hr>

    <div class=" text-center" style="margin-top:30px;" role="group" aria-label="Exemplo básico">
        <button type="button" class="btn btn-outline-info h5" onclick="escolheGaleria('f')">Galeria de Fotos</button>
        <button type="button" class="btn btn-outline-info h5" onclick="escolheGaleria('v')">Galeria de Vídeos</button>
    </div>

    <div id="caroselFoto" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- <form id="adicionarImagem-form" action="../controller/controllerGaleria.php"  method="POST" encyte="multipart/form-data">-->
                <img src="../assets/media/galeria/imagem_00.png" class="rounded mx-auto img-fluid d-block " style=" height: 400px; margin-top:30px; cursor: pointer;" alt="Adicione uma foto" title="Adicione uma foto" onclick="adicionarFoto_modal()">
            </div>
            <?php
            $i = 1;
            while ($rowGaleria = $stmtGaleria->fetch(PDO::FETCH_ASSOC)) {

                $titulo = $rowGaleria['tituloGaleria'];
                $arquivo = "../assets/media/galeria/" . $rowGaleria['midiaGaleria'];

                if (($rowGaleria['midiaGaleria'] != '') && (file_exists($arquivo))) {

                    echo '<div class="carousel-item" >
                        <img src="' . $arquivo . '"  class="rounded mx-auto img-fluid d-block" style=" height: 400px; margin-top:30px;" data-toggle="tooltip" alt="' . $titulo . '" title="Clique para substituir imagem"  id="rowEditarFoto_' . $i . '" data-id="' . $rowGaleria['codGaleria'] . '" data-titulo="' . $rowGaleria['tituloGaleria'] . '" data-foto="' . $rowGaleria['midiaGaleria'] . '" onclick="editarFoto_modal(' . $i . ')">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip" style="position:absolute; left:50%; bottom: 0%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="Excluir imagem" id="rowExcluirMidia_' . $i . '" data-id="' . $rowGaleria['codGaleria'] . '" onclick="excluirMidia(' . $i . ')" >
                            <i class="fa fa-trash "></i> 
                        </button>
                    </div>';
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

    <div id="caroselVideo" class="carousel slide" data-ride="carousel" style="display:none;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- <form id="adicionarImagem-form" action="../controller/controllerGaleria.php"  method="POST" encyte="multipart/form-data">-->
                <img src="../assets/media/galeria/video_0.png" class="rounded mx-auto img-fluid d-block " style=" height: 400px; margin-top:30px; cursor: pointer;" alt="Adicione uma foto" title="Adicione uma foto" onclick="adicionarVideo_modal()">
            </div>
            <?php
            while ($rowGaleriaV = $stmtGaleriaV->fetch(PDO::FETCH_ASSOC)) {

                $titulo = $rowGaleriaV['tituloGaleria'];
                $arquivo = "../assets/media/galeria/" . $rowGaleriaV['midiaGaleria'];

                if (($rowGaleriaV['midiaGaleria'] != '') && (file_exists($arquivo))) {

                    echo '<div class="carousel-item " align="center"  >
                    <video class="embed-responsive-item" type="video/' . explode('.', $rowGaleriaV['midiaGaleria'])[1] . '" src="' . $arquivo . '"  onclick=controles("' . $i . '","pause") 
                        id="videoG_' . $i . '" align="middle"style=" height: 400px;  width: 100%; margin-top:30px; " data-toggle="tooltip" alt="' . $titulo . '" >
                    </video>
                    <div id="buttons" style="position:absolute; left:50%; bottom: 0%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip"  title="Excluir vídeo" id="rowExcluirMidia_' . $i . '" data-id="' . $rowGaleriaV['codGaleria'] . '" onclick="excluirMidia(' . $i . ')" >
                            <i class="fa fa-trash "></i> 
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="tooltip"  title="Clique para substituir vídeo"  id="rowEditarVideo_' . $i . '" data-id="' . $rowGaleriaV['codGaleria'] . '" data-titulo="' . $rowGaleriaV['tituloGaleria'] . '" data-video="' . $rowGaleriaV['midiaGaleria'] . '" data-link="' . $rowGaleriaV['urlGaleria'] . '" onclick="editarVideo_modal(' . $i . ')" >
                            <i class="fa fa-pencil "></i> 
                        </button>
                    </div>
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
                    echo '<div class="carousel-item " align="center">
                        <embed  src="https://www.youtube.com/embed/' . explode('=', $rowGaleriaVE['urlGaleria'])[1] . '"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen 
                            onclick=controles("' . $i . '","pause") id="videoG_' . $i . '" style=" height: 400px; width: 100%; margin-top:30px;" alt="Youtube - ' . $titulo . '" />
                    <div id="buttons" style="position:absolute; left:50%; bottom: 30px; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip"  title="Excluir vídeo" id="rowExcluirMidia_' . $i . '" data-id="' . $rowGaleriaVE['codGaleria'] . '" onclick="excluirMidia(' . $i . ')" > 
                            <i class="fa fa-trash "></i> 
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="tooltip"  title="Clique para substituir vídeo"  id="rowEditarVideo_' . $i . '" data-id="' . $rowGaleriaVE['codGaleria'] . '" data-titulo="' . $rowGaleriaVE['tituloGaleria'] . '" data-video="' . $rowGaleriaVE['midiaGaleria'] . '" onclick="editarVideo_modal(' . $i . ')" >
                            <i class="fa fa-pencil "></i> 
                        </button>
                    </div>
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

<!-- Normal Modal -->

<div class="modal" id="verEditarInfo" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="editarInfoLabel"> Edite as informações </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="openNewModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editarInfo-form" method="POST">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="tituloP">
                                    <h5> Título: </h5>
                                </label>
                                <input type="text" class="form-control" id="tituloP" name="tituloP"> </input>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="infoP">
                                    <h5> Descrição principal: </h5>
                                </label>
                                <textarea class="form-control" id="infoP" name="infoP" rows="10">  </textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="tituloS">
                                    <h5> Sub Titulo: </h5>
                                </label>
                                <input type="text" class="form-control" wrap="hard" id="tituloS" name="tituloS"> </input>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="infoS">
                                    <h5> Informações complementares: </h5>
                                </label>
                                <textarea class="form-control" id="infoS" name="infoS" rows="40"> </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material tipo">
                                <label for="extra">
                                    <h5> Conteúdo extra:::: </h5>
                                </label>
                                <button type="button" class="" title="Negrito" onclick="negrito()">
                                    <i class="fa fa-bold" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="" title="Italico" onclick="italico()">
                                    <i class="fa fa-italic" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="" title="Sublinhado" onclick="sublinhado()">
                                    <i class="fa fa-underline" aria-hidden="true"></i>
                                </button>
                                <textarea class="form-control" id="extra" name="extra" rows="40"> </textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-lg btn-danger" data-continer="body" data-toggle="popover" data-placement="left" title="Ajuda" data-content="Para adicionar outros títulos e textos utilize o campo de Conteúdo Extra e o seu menu para fazer a formatação. As tags HTML são necessárias, pois a formatação se aplicará ao texto entre elas.">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="openNewModal()">Fechar</button>
                <button type="submit" class="btn btn-primary" id="btnEditarInfo">
                    <i class="fa fa-check"></i> Salvar
                </button>
            </div>
            </form>
        </div>

    </div>
</div>

<div class="modal" id="verModalFoto" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="nomeP"> </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="openNewModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" class="form-horizontal" enctype="multipart/form-data" id="adicionarFoto" name="adicionarFoto">
                <div class="modal-body">
                    <input type="hidden" name="acao" id="acao">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="titulo">
                                    <h5> Título: </h5>
                                </label>
                                <input type="text" class="form-control" id="titulo" name="titulo"> </input>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row" id="divFoto">
                        <div class="col-md-12">
                            <div class="form-material">
                                <h5> Upload: </h5>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto" lang="pt" onchange="nomeFoto()">
                                    <label class="custom-file-label" for="arquivo" id="midia"> </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="divVideo">
                        <div class="col-md-12">
                            <div class="form-material">
                                <h5> Upload: </h5>
                                <div class="custom-file">
                                <div id="delet" style="border-left:10px;"><i class="fa fa-times" aria-hidden="true"></i></div>
                                    <input type="file" class="custom-file-input" id="video" name="video" lang="pt" onchange="nomeFoto()">
                                    <label class="custom-file-label" for="arquivo" id="midia"> </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row" id="divUrl">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="videoLink">
                                    <h5> Vídeo externo (link): </h5>
                                </label>
                                <input type="text" class="form-control" id="videoLink" name="videoLink"> </input>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-lg btn-danger" data-continer="body" data-toggle="popover" data-placement="right" title="Ajuda" data-content="É permitido apenas o envio de vídeos com qualidade igual ou inferior a 360p contendo as seguintes extensões: .avi, .mp4, .flv, .wmv, .ogv, .webm">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="openNewModal()">Fechar</button>
                    <button type="submit" class="btn btn-primary" id="btnAdicionarMidia">
                        <i class="fa fa-check"></i> Adicionar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- END Normal Modal -->
<?php
//$cb->get_js('/js/admin.js');
require '../inc/global/head_end.php';
?>