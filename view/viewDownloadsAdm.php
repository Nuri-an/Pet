<?php
session_start();
(isset($_SESSION['adm_session'])) ? ' ' : header("Location: viewNoticiasUser.php"); 

require '../inc/global/head_start.php';
require '../inc/global/banner.php';
require '../inc/global/config.php';
?>

<link rel="stylesheet" href="../assets/css/downloads.css">

<script type="text/javascript" src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/jquery-validation/localization/messages_pt_BR.js"></script>
<script type="text/javascript" src="../assets/js/downloads.js"></script>

<div id="corpo"></div>


<div class="modal" id="verDownloads" role="dialog" data-backdrop="static" aria-labelledby="moda-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="tituloP"> </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="openNewModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="Downloads-form" name="Downloads-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="acao" id="acao">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="idSlides" id="idSlides">
                    <input type="hidden" name="idAlgoritmo" id="idAlgoritmo">
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
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label class="" for="descricao">
                                    <h5> Referência: </h5>
                                </label>
                                <input type="text" class="form-control" id="referencia" name="referencia" rows="10" placeholder="Ex: minicurso, palestra, webinar, ...">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <h5> Arquivo - slides: </h5>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" style="cursor: pointer; border: 1px solid #ced4da;" onclick="deletSlides()">
                                            <i class="fa fa-times" aria-hidden="true" title="Deletar arquivo"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="slides" id="midiaS"></label>
                                        <input type="file" class="custom-file-input" id="slides" name="slides" lang="pt" onchange="nomeAquivoSlide()">
                                    </div>
                                </div>
                                <small id="codHelp" class="form-text text-muted">
                                    Para envio de multiplos arquivos, compacte-os em formato .zip. Para entender como compactar
                                    <a href="https://tecnoblog.net/265035/como-zipar-um-arquivo-ou-pastas-compactar-e-descompactar/" target="_blank">
                                        clique aqui.
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <h5> Arquivo - algoritmo: </h5>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" style="cursor: pointer; border: 1px solid #ced4da;" onclick="deletAlgoritmo()">
                                            <i class="fa fa-times" aria-hidden="true" title="Deletar arquivo"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="algoritmo" name="algoritmo" lang="pt" onchange="nomeAquivoAlgoritmo()">
                                        <label class="custom-file-label" for="algoritmo" id="midiaA"> </label>
                                    </div>
                                </div>
                                <small id="codHelp" class="form-text text-muted">
                                    Permitido apenas arquivos compactados em formato .zip. Para entender como compactar
                                    <a href="https://tecnoblog.net/265035/como-zipar-um-arquivo-ou-pastas-compactar-e-descompactar/" target="_blank">
                                        clique aqui.
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-material">
                                <label for="link">
                                    <h5> Link para download externo: </h5>
                                </label>
                                <input type="url" class="form-control" id="link" name="link"> </input>
                            </div>
                        </div>
                    </div>
            </div>
            <div style="width: 100%; border-top: 1px solid #dee2e6;">
                <div class="modal-footer" style="width: 50%; float: right; border-top: 0px solid #fff;">
                    <button type="button" class="btn btn-secondary" style="float: right; margin-left: 10px; margin-top: 0px;" data-dismiss="modal" onclick="openNewModal()">Fechar</button>
                    <button type="submit" class="btn btn-warning" style="float: right" id="btnDownload">
                        <i class="fa fa-check"></i> Salvar
                    </button>
                </div>
                </form>
                <div id="excluir" style="width: 30%; float: left; margin: 15px; margin-right: 0px;">
                    <form class="form-horizontal" id="excluirDownloads-form" name="excluirDownloads-form" method="POST">
                        <input type="hidden" name="acao" id="acao" value="excluir">
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-lg btn-danger" id="btnExcluirDownload" title="Excluir download">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

<script>
    $(document).ready(function() {
        $.get("downloads.php", function() {

            var divEditar = $('.editar');
            divEditar.show();

            $('li').addClass('paginacao');
        });
    });
</script>
<?php
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>