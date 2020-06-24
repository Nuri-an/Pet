<?php
(session_status() !== PHP_SESSION_ACTIVE) ? session_start() : ' ';
(isset($_SESSION['adm_session'])) ? ' ' : header("Location: viewNoticiasUser.php"); 

require '../inc/global/head_start.php';
require '../inc/global/banner.php';
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

<div style="margin-top: 20px; margin-bottom: 20px;" id="corpo"> </div>

<!-- Normal Modal -->

</div>
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
                <button type="submit" class="btn btn-warning" id="btnEditarInfo">
                    <i class="fa fa-check"></i> Salvar
                </button>
            </div>
            </form>
        </div>

    </div>
</div>

<div class="modal" id="verModalFoto" role="dialog" data-backdrop="static" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" style="overflow:auto; ">
        <div class="modal-content" style="overflow:auto; ">
            <div class="modal-header  sm-primary">
                <h3 class="modal-title" id="nomeP"> </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="openNewModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" class="form-horizontal" enctype="multipart/form-data" id="adicionarFoto" name="adicionarFoto">
                <div class="modal-body" style="overflow:auto; ">
                    <input type="hidden" name="acao" id="acao">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="idVideo" id="idVideo">
                    <input type="hidden" name="idImagem" id="idImagem">
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
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" style="cursor: pointer; border: 1px solid #ced4da;" onclick="deletVideo()">
                                            <i class="fa fa-times" aria-hidden="true" title="Deletar arquivo"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <div id="delet" style="border-left:10px;"><i class="fa fa-times" aria-hidden="true"></i></div>
                                        <input type="file" class="custom-file-input" id="video" name="video" lang="pt" onchange="nomeFoto()">
                                        <label class="custom-file-label" for="arquivo" id="midia"> </label>
                                    </div>
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
                                <input type="text" class="form-control" id="videoLink" name="videoLink" onchange="changeLinkVideo()"> </input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-lg btn-danger" id="ajuda" data-continer="body" data-toggle="popover" data-placement="right" title="Ajuda">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="openNewModal()">Fechar</button>
                    <button type="submit" class="btn btn-warning" id="btnAdicionarMidia">
                        <i class="fa fa-check"></i> Adicionar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.get("sobre.php", function() {
            var divEditar = $('.editar');

            divEditar.show();

            $('#corpoInfo').addClass('paginacao');
        });
    });
</script>

<?php
//$cb->get_js('/js/admin.js');
require '../inc/global/footer.php';
require '../inc/global/head_end.php';
?>