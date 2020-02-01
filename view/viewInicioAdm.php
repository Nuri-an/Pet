<?php require 'loader.html' ?>
<?php
require '../inc/global/banner.php';
require '../inc/global/head_start.php';
require '../inc/global/config.php';

require_once("../dao/DaoInformacoes.php");

$informacoesDao = new DaoInformacoes();

?>

<link rel="stylesheet" href="../assets/css/inicio.css">

<script type="text/javascript" src="../assets/js/inicio.js"></script>

<div id="atualiza" style="margin-top: 20px; margin-bottom: 20px;">
    <div class="container" style="overflow:hidden;" id="corpoInfo">
        <?php

        $stmtInformacoes = $informacoesDao->runQuery("SELECT * FROM informacoes");
        $stmtInformacoes->execute();

        $stmtGaleria = $informacoesDao->runQuery("SELECT * FROM galeria");
        $stmtGaleria->execute();

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

    <iframe src="../controller/controllerGaleria.php" name="controlador" style="display: none;"> </iframe>

    <div id="carosel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- <form id="adicionarImagem-form" action="../controller/controllerGaleria.php"  method="POST" encyte="multipart/form-data">-->
                <img src="../assets/media/galeria/imagem_0.png" class="rounded mx-auto img-fluid d-block " style=" height: 400px; margin-top:100px; cursor: pointer;" alt="Adicione uma foto" title="Adicione uma foto" onclick="adicionarFoto_modal()">
            </div>
            <?php
            $i = 1;
            while ($rowGaleria = $stmtGaleria->fetch(PDO::FETCH_ASSOC)) {

                $titulo = $rowGaleria['tituloGaleria'];
                $arquivo = "../assets/media/galeria/" . $rowGaleria['fotoGaleria'];

                if (($rowGaleria['fotoGaleria'] != '') && (file_exists($arquivo))) {

                    echo '<div class="carousel-item" >
                        <img src="' . $arquivo . '"  class="rounded mx-auto img-fluid d-block" style=" height: 400px; margin-top:100px;" data-toggle="tooltip" alt="' . $titulo . '" title="Clique para substituir imagem"  id="rowEditarFoto_' . $i . '" data-id="' . $rowGaleria['codGaleria'] . '" data-titulo="' . $rowGaleria['tituloGaleria'] . '" data-foto="' . $rowGaleria['fotoGaleria'] . '" onclick="editarFoto_modal(' . $i . ')">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip" style="position:absolute; left:50%; bottom: 0%; -webkit-transform: translate3d(-50%, -50%, 0); -moz-transform:translate3d(-50%, -50%, 0); transform: translate3d(-50%, -50%, 0);" title="Excluir imagem" id="rowExcluirFoto_' . $i . '" data-id="' . $rowGaleria['codGaleria'] . '" onclick="excluirFoto(' . $i . ')" >
                            <i class="fa fa-trash "></i> 
                        </button>
                    </div>';
                    $i++;
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
</div>

<!-- Normal Modal -->

<div class="modal" id="verEditarInfo" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="editarInfoLabel"> Edite as informações </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="btnEditarInfo" onclick="enviarDadosInfo()">
                    <i class="fa fa-check"></i> Salvar
                </button>
            </div>
        </div>

    </div>
</div>

<div class="modal" id="verModalFoto" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="nomeP"> </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" enctype="multipart/form-data" id="adicionarFoto" name="adicionarFoto" action="../controller/controllerGaleria.php" target="controlador">
                    <input type="hidden" name="acao" id="acao">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="titulo">
                                    <h5> Título da imagem: </h5>
                                </label>
                                <input type="text" class="form-control" id="titulo" name="titulo"> </input>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                    <h5> Upload: </h5>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="arquivo" name="arquivo" lang="pt" onchange="nomeFoto()">
                                        <label class="custom-file-label" for="arquivo" id="foto"> </label>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-lg btn-danger" data-continer="body" data-toggle="popover" data-placement="right" title="Ajuda" data-content="É permitido apenas o envio de imagens com as seguintes extensões: .png, .jpg, .jpeg, .JPG, .PNG, .JPEG">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="btnAdicionarFoto" onclick="enviarFotoG()">
                    <i class="fa fa-check"></i> Adicionar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- END Normal Modal -->
<?php
//$cb->get_js('/js/admin.js');
require '../inc/global/head_end.php';
?>